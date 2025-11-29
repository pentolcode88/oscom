<?php
header('Content-Type: text/plain; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

function env_load($p){
  if(!file_exists($p)) return;
  foreach(file($p, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $l){
    $l = trim(preg_replace('/#.*/','',$l));
    if($l==='') continue; putenv($l);
  }
}
env_load(__DIR__.'/.env');

$OPENAI_API = getenv('OPENAI_API_KEY') ?: 'rahasiailahi';
$INSTANCE    = getenv('UM_INSTANCE')    ?: 'rahasiailahi';
$TOKEN       = getenv('UM_TOKEN')       ?: 'rahasiailahi';
$GROUP_WA = array_filter(array_map('trim', explode(',', getenv('ALLOWED_GROUP') ?: '')));
$LOG_ERRORS     = (getenv('LOG_ERRORS')==='1');

$CACHE_DIR = __DIR__.'/_mc_cache';
$IMG_DIR   = __DIR__.'/_imgcache';
@is_dir($CACHE_DIR) || @mkdir($CACHE_DIR,0777,true);
@is_dir($IMG_DIR)   || @mkdir($IMG_DIR,0777,true);

function base_url(){
  $s = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') ? 'https' : 'http';
  $h = $_SERVER['HTTP_HOST'] ?? 'localhost';
  $p = rtrim(dirname($_SERVER['SCRIPT_NAME']),'/\\');
  return "$s://$h$p";
}
function logf($name,$data){ global $LOG_ERRORS; if(!$LOG_ERRORS) return;
  @file_put_contents(__DIR__."/{$name}.log","[".date('Y-m-d H:i:s')."] ".$data.PHP_EOL,FILE_APPEND);
}
function wa_kirim($inst,$tok,$to,$body){
  if(!$to) return '';
  $ch=curl_init("https://api.ultramsg.com/$inst/messages/chat");
  curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>25,
    CURLOPT_POSTFIELDS=>http_build_query(["token"=>$tok,"to"=>$to,"body"=>$body])]);
  $res=curl_exec($ch); if($res===false) logf('um_error',curl_error($ch)); curl_close($ch); return $res?:'';
}
function pilih($arr, ...$keys){ foreach($keys as $k){ if(isset($arr[$k]) && $arr[$k]!=='' && $arr[$k]!==null) return $arr[$k]; } return null; }

function cache_gambar($chatId,$url){ global $CACHE_DIR;
  @file_put_contents($CACHE_DIR.'/'.md5($chatId).'.json', json_encode(['url'=>$url,'ts'=>time()], JSON_UNESCAPED_SLASHES)); }
function cache_get_last_image($chatId,$ttl=1800){ global $CACHE_DIR;
  $fn=$CACHE_DIR.'/'.md5($chatId).'.json'; if(!is_file($fn)) return null;
  $j=json_decode(@file_get_contents($fn),true); if(!$j||empty($j['url'])) return null;
  if(time()-($j['ts']??0)>$ttl) return null; return $j['url']; }

function upload_gambar_bos($src){
  global $IMG_DIR;
  $src = trim($src ?? '');
  $bytes = null; $ext='jpg';

  if (strpos($src,'data:image/')===0) {
    if(preg_match('#^data:image/(png|jpe?g|webp);base64,#i',$src,$mm)){
      $ext = strtolower($mm[1]); if($ext==='jpeg') $ext='jpg';
      $bytes = base64_decode(substr($src, strpos($src, ',')+1));
    }
  } elseif (preg_match('#^https?://#i',$src)) {
    $ch=curl_init($src);
    curl_setopt_array($ch,[
      CURLOPT_RETURNTRANSFER=>true, CURLOPT_FOLLOWLOCATION=>true, CURLOPT_TIMEOUT=>30,
      CURLOPT_USERAGENT=>'Mozilla/5.0 (MasterCall-X12AI)', CURLOPT_HEADER=>true,
      CURLOPT_SSL_VERIFYPEER=>true, CURLOPT_SSL_VERIFYHOST=>2
    ]);
    $raw=curl_exec($ch);
    if($raw===false){ logf('img_dl_err','curl_error: '.curl_error($ch).' | url='.$src); curl_close($ch); return null; }
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $hsz  = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $bytes= substr($raw,$hsz);
    curl_close($ch);
    if($code<200 || $code>=300){ logf('img_dl_err','code='.$code.' | url='.$src); return null; }
  }
  if(!$bytes){ logf('rehost_fail','no bytes | src='.$src); return null; }

  $info = @getimagesizefromstring($bytes);
  if($info && isset($info['mime'])){
    if(strpos($info['mime'],'png')!==false)      $ext='png';
    elseif(strpos($info['mime'],'webp')!==false) $ext='webp';
    else                                         $ext='jpg';
  } else {
    if(function_exists('imagecreatefromstring')){
      $im=@imagecreatefromstring($bytes);
      if($im){ ob_start(); imagejpeg($im, null, 92); $bytes=ob_get_clean(); imagedestroy($im); $ext='jpg'; }
      else { logf('rehost_fail','not image bytes'); return null; }
    } else { logf('rehost_fail','no gd'); return null; }
  }

  $name='img_'.date('Ymd_His').'_'.mt_rand(1000,9999).'.'.$ext;
  $dest=rtrim($IMG_DIR,'/').'/'.$name;
  if(@file_put_contents($dest,$bytes)===false){
    $perms=@substr(sprintf('%o',fileperms($IMG_DIR)),-4);
    logf('img_save_err','fail write '.$dest.' | perms='.$perms);
    return null;
  }
  return base_url().'/_imgcache/'.$name;
}

function ekstrak_bengkoang($j,$raw){
  if (isset($j['output']) && is_array($j['output'])) {
    if (isset($j['output'][0]['content']) && is_array($j['output'][0]['content'])) {
      foreach($j['output'][0]['content'] as $blk){
        if (is_array($blk) && isset($blk['text']) && $blk['text']!=='') return $blk['text'];
      }
    }
    foreach($j['output'] as $node){ if (is_string($node)) return $node; if (is_array($node) && isset($node['text'])) return $node['text']; }
  }
  if(isset($j['output_text']) && is_string($j['output_text'])) return $j['output_text'];
  if(isset($j['choices'][0]['message']['content']) && is_string($j['choices'][0]['message']['content']))
    return $j['choices'][0]['message']['content'];
  if (is_string($raw) && preg_match('/```(?:json)?\s*([\s\S]*?)```/',$raw,$m)) return $m[1];
  if (is_string($raw) && preg_match('/\{(?:[^{}]|(?R))*\}/s',$raw,$m)) return $m[0];
  return '';
}
function panggilan_openai($payload){
  global $OPENAI_API,$LOG_ERRORS;
  $ch=curl_init("https://api.openai.com/v1/responses");
  curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>45,
    CURLOPT_HTTPHEADER=>["Authorization: Bearer ".$OPENAI_API,"Content-Type: application/json"],
    CURLOPT_POSTFIELDS=>json_encode($payload, JSON_UNESCAPED_SLASHES)
  ]);
  $resp=curl_exec($ch);
  if($resp===false){ $e=curl_error($ch); curl_close($ch); return [null,$e]; }
  curl_close($ch);
  if($LOG_ERRORS){ @file_put_contents(__DIR__.'/response_last.json',$resp); }
  $j=json_decode($resp,true);
  if(isset($j['error'])) return [null, $j['error']['message']??'unknown'];
  $txt = ekstrak_bengkoang($j,$resp);
  $txt = preg_replace('/^```[a-z]*\s*/i','', $txt);
  $txt = preg_replace('/\s*```$/','', $txt);
  return [$txt,null];
}

function simsalabim_prompt($pairHint){
  return <<<PROMPT
You are **MasterCall X12 — Senior Market Analyst** (Bahasa Indonesia).
Analisa gambar chart ringkas-tegas untuk trader:
• Verdict (LONG/SHORT/NEUTRAL) + alasan utama (struktur/momentum).
• Struktur (HH/HL atau LH/LL; breakout/pullback).
• Level penting (S/R, angka bulat, confluence EMA20/50/200) + hint harga.
• Volume & RSI(14) (naik/turun, ada/tidak divergensi).
• Rencana: Entry area, SL (invalidasi), TP1..N, estimasi RR (1:X).
PROMPT;
}

function deteksi_tf($text){
  if (preg_match('/\b(1m|3m|5m|15m|30m|1h|2h|3h|4h|1d)\b/i', $text, $m)) {
    $tf = strtolower($m[1]);
    if(strpos($tf, 'm') !== false) return str_replace('m',' Menit',$tf);
    if(strpos($tf, 'h') !== false) return str_replace('h',' Jam',$tf);
    if($tf === '1d') return '1 Hari';
  }
  return '5–15 Menit';
}

function prompt_waktu($pairHint, $tfLabel='5–15 Menit'){
  return <<<PROMPT
You are **MasterCall X12 — Short-horizon Forecaster** (Bahasa).
Buat *probabilistic* forecast untuk horizon waktu sekitar *$tfLabel*:
📡 *Forecast $tfLabel*
- Prob Up / Prob Down (% total ~100%)
- Sinyal: BUY / SELL / NO-TRADE (pilih satu)
- Rencana: Entry area, SL, TP1/TP2, estimasi RR (1:X)
- Risiko/catatan singkat
PROMPT;
}

function prompt_chat($userText, $hasChart){
  $mode = $hasChart ? "Jawab dengan merujuk *chart terakhir* yang user kirim." :
                      "Tidak ada chart terakhir; jawab sebagai asisten trading profesional.";
  return <<<PROMPT
Kamu adalah **MasterCall X12 AI** — asisten trading ramah namun tegas (Bahasa Indonesia).
$mode
Gaya singkat, bullet seperlunya, hindari jargon berlebihan. Beri langkah praktis dan manajemen risiko.

Pertanyaan/ucapan user:
"$userText"
PROMPT;
}

$raw=file_get_contents('php://input');
$ev=json_decode($raw,true);
if(!$ev){ http_response_code(400); echo "invalid json"; exit; }
logf('payload',$raw);

$x=$ev; if(isset($x['data']) && is_array($x['data'])) $x=$x['data']; if(isset($x['message']) && is_array($x['message'])) $x=$x['message'];

$chatId = pilih($x,'chatId','from','to') ?: '';
$type   = strtolower((string)pilih($x,'type','messageType','msgtype','mime_type'));
$text   = (string)(pilih($x,'caption','text','bodyText','message') ?? '');
$imgUrl = pilih($x,'body','url','media','image','fileUrl');
$fileId = pilih($x,'file','media_id','fileid');
$mime   = strtolower((string)pilih($x,'mime_type','mimetype')) ?: '';

if(!$chatId){ echo "Wokeh"; exit; }
if($GROUP_WA && !in_array($chatId,$GROUP_WA,true)){ echo "Wokeh"; exit; }

$isImageLike = ($type==='image' || $type==='document' || strpos($mime,'image/')===0);
if($fileId){
  $imgUrl = "https://api.ultramsg.com/{$GLOBALS['UM_INSTANCE']}/media/download?token={$GLOBALS['UM_TOKEN']}&file=".rawurlencode($fileId);
}
if($isImageLike && $imgUrl){ cache_gambar($chatId,$imgUrl); }

if($isImageLike && $imgUrl){
  $publicUrl = upload_gambar_bos($imgUrl);
  if(!$publicUrl){
    logf('rehost_fail','src='.$imgUrl.' type='.$type.' mime='.$mime.' fileId='.$fileId);
    wa_kirim($INSTANCE,$TOKEN,$chatId,"Gagal ambil gambar boskuuu!!!*.");
    echo "Wokeh"; exit;
  }

  $pairHint='Unknown';
  if(preg_match('/([A-Z]{3,10}USDT|XAUUSD|XAGUSD|[A-Z]{3}\/?[A-Z]{3})/i',$text,$m))
    $pairHint=strtoupper(str_replace('/','',$m[1]));

  $payload = function($prompt) use ($publicUrl){
    return [
      "model" => "gpt-4o",
      "input" => [[ "role"=>"user", "content"=>[
        ["type"=>"input_text","text"=>$prompt],
        ["type"=>"input_image","image_url"=>$publicUrl]
      ]]],
      "max_output_tokens" => 700,
      "temperature" => 0.2
    ];
  };

  list($aText,$errA) = panggilan_openai($payload(simsalabim_prompt($pairHint)));
  if($errA){ wa_kirim($INSTANCE,$TOKEN,$chatId,"Gagal analisa: ".$errA); echo "Wokeh"; exit; }

  $tfLabel = deteksi_tf($text);
  list($fText,$errF) = panggilan_openai($payload(prompt_waktu($pairHint, $tfLabel)));
  if($errF){ $fText = "📡 *Forecast 5–15 Menit*\n(maaf, gagal memproses forecast)"; }

  $out = trim($aText)."\n\n".trim($fText)."\n\n_Catatan: ini perkiraan probabilistik, bukan kepastian. Gunakan manajemen risiko._";
  wa_kirim($INSTANCE,$TOKEN,$chatId,$out);
  echo "Wokeh"; exit;
}

$last = cache_get_last_image($chatId,1800);
$hasChart = (bool)$last;

$content = [
  ["type"=>"input_text","text"=>prompt_chat($text ?: 'halo', $hasChart)]
];
if($hasChart){
  $publicUrl = upload_gambar_bos($last);
  if($publicUrl){ $content[] = ["type"=>"input_image","image_url"=>$publicUrl]; }
}

$payloadChat = [
  "model" => "gpt-4o",
  "input" => [[ "role"=>"user", "content"=>$content ]],
  "max_output_tokens" => 600,
  "temperature" => 0.4
];

list($reply,$errC) = panggilan_openai($payloadChat);
if($errC || !$reply){
  $fallback = $hasChart
    ? "Siap. Aku simpan chart terakhirmu. Kamu bisa tanya apa saja tentang setupnya, atau kirim screenshot baru untuk analisa + forecast."
    : "Halo! Kamu bisa tanya apa saja soal trading, atau kirim screenshot chart untuk aku analisa + forecast 5–15 menit.";
  wa_kirim($INSTANCE,$TOKEN,$chatId,$fallback);
  echo "Wokeh"; exit;
}

wa_kirim($INSTANCE,$TOKEN,$chatId, trim($reply));
echo "Wokeh";
