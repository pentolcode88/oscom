<?php
/*
  $Id: login.php,v 1.1.1.1 2004/03/04 23:38:00 ccwjr Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

//ITSZ: after login redirect to previos page PART 1/2 START
// PART 2/2: same file, see below
$current_page_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(!empty($_SERVER[HTTP_REFERER]) && $current_page_link != $_SERVER[HTTP_REFERER]){
    $_SESSION['prev_page_uri'] = $_SERVER['HTTP_REFERER'];
}
//ITSZ: after login redirect to previos page PART 1/2 EOF

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
if ($session_started == false) {
  tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
}
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
$error = false;
if (isset($_GET['login']) && $_GET['login'] == 'fail') {
  $fail_reason = (!empty($_GET['reason'])) ? urldecode($_GET['reason']): TEXT_LOGIN_ERROR;
  $messageStack->add('login', $fail_reason);
}
if ( (isset($_POST['action']) && ($_POST['action'] == 'process')) || (isset($_POST['password']) && isset($_POST['email_address'])) ) {
  $email_address = strtolower(tep_db_prepare_input($_POST['email_address']));
  $password = tep_db_prepare_input($_POST['password']);

  if(ACCOUNT_EMAIL_CONFIRMATION=='true') {
    if (isset($_POST['pass'])) {
      $check_customer_query_val = tep_db_query("select customers_id, customers_group_id, customers_email_address, customers_default_address_id,customers_validation_code from " . TABLE_CUSTOMERS . " where lower(customers_email_address) = '" . tep_db_input($email_address) . "'");
      $new_query_for_val = tep_db_fetch_array($check_customer_query_val);   
      if ($new_query_for_val['customers_validation_code'] == $_POST['pass']) {
        tep_db_query("update " . TABLE_CUSTOMERS . " set customers_validation = '1', customers_email_registered = '" . tep_db_input($email_address) . "' where customers_id = '" . $new_query_for_val['customers_id']  . "'");
      } else {
        tep_redirect(tep_href_link('pw.php', 'verifyid=' . $new_query_for_val['customers_id'] . '&pass=' . $_POST['pass'], SSL));
      }
    }
  }
  // check if email exists
  if(B2B_REQUIRE_ACCOUNT_APPROVAL=='true') {
    $check_customer_query_val = tep_db_query("select customers_id,customers_account_approval  from " . TABLE_CUSTOMERS . " where lower(customers_email_address) = '" . tep_db_input($email_address) . "'");
    $new_query_for_val = tep_db_fetch_array($check_customer_query_val);   
    if(tep_not_null($new_query_for_val['customers_account_approval']) && $new_query_for_val['customers_account_approval']!="Approve") {
      tep_redirect(tep_href_link('pw.php', 'verifyid=' . $new_query_for_val['customers_id'] . '&pass=' . $_POST['pass'].'&b2bwarning=1', SSL));
    }
  }
  $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_validation, customers_default_address_id, customers_group_id from " . TABLE_CUSTOMERS . " where lower(customers_email_address) = '" . tep_db_input($email_address) . "'");
  if (!tep_db_num_rows($check_customer_query)) {
    $error = true;
  } else {
    $check_customer = tep_db_fetch_array($check_customer_query);
    // check that password is good
    if(ACCOUNT_EMAIL_CONFIRMATION=='true') {
      $customers_validation=$check_customer['customers_validation'];
    } else {
      $customers_validation = 1;
    }
    if ((!tep_validate_password($password, $check_customer['customers_password'])) ||  $customers_validation== '0') {
      $error = true;
      if ($customers_validation == '0') $setme = true;
    } else {
      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }
      // note that tax rates depend on your registered address!
      if (isset($_GET['skip']) && $_GET['skip'] != 'true' && isset($_POST['email_address']) && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD ) {
        $existing_customers_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");
        echo '<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">';
        print ("\n<html ");
        echo HTML_PARAMS;
        print (">\n<head>\n<title>".LOGIN_TITLE1."</title>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=");
        echo CHARSET;
        print ("\"\n<base href=\"");
        echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;
        print ("\">\n<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesheet.css\">\n");
        echo '<body bgcolor="#ffffff" style="margin:0">';
        print ("\n<table border=\"0\" width=\"100%\" height=\"100%\">\n<tr>\n<td style=\"vertical-align: middle\" align=\"middle\">\n");
        echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, '', 'SSL'),'get').tep_draw_hidden_field('action','process').tep_draw_hidden_field('skip',true);
        print ("\n<table border=\"0\" bgcolor=\"#f1f9fe\" cellspacing=\"10\" style=\"border: 1px solid #7b9ebd;\">\n<tr>\n<td class=\"main\">\n");
        $index = 0;
        while ($existing_customers =  tep_db_fetch_array($existing_customers_query)) {
          $existing_customers_array[] = array("id" => $existing_customers['customers_group_id'], "text" => "&#160;".$existing_customers['customers_group_name']."&#160;");
          ++$index;
        }
        print ("<h1>".LOGIN_TITLE1."</h1>\n</td>\n</tr>\n<tr>\n<td align=\"center\">\n");
        echo tep_draw_pull_down_menu('new_customers_group_id', $existing_customers_array, $check_customer['customers_group_id']);
        print ("\n<tr>\n<td class=\"main\">&#160;<br>\n&#160;");
        print ("<input type=\"hidden\" name=\"email_address\" value=\"".strtolower($_POST['email_address'])."\">");
        print ("<input type=\"hidden\" name=\"password\" value=\"".$_POST['password']."\">\n</td>\n</tr>\n<tr>\n<td align=\"right\">\n");
        echo tep_template_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE);
        print ("</td>\n</tr>\n</table>\n</form>\n</td>\n</tr>\n</table>\n</body>\n</html>\n");
        exit;
      }
      $check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
      $check_country = tep_db_fetch_array($check_country_query);
      $_SESSION['customer_id'] = $check_customer['customers_id'];
      $_SESSION['customer_default_address_id'] = $check_customer['customers_default_address_id'];
      $_SESSION['customer_first_name'] = $check_customer['customers_firstname'];
      if (isset($_GET['skip']) && $_GET['skip'] == 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD && isset($_GET['new_customers_group_id']))  {
        $_SESSION['sppc_customer_group_id'] = $_GET['new_customers_group_id'] ;
        $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt,group_hide_show_prices,allow_add_to_cart from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$_GET['new_customers_group_id'] . "'");
      } else {
        $_SESSION['sppc_customer_group_id'] = $check_customer['customers_group_id'];
        $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt,group_hide_show_prices,allow_add_to_cart from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$check_customer['customers_group_id'] . "'");
      }
      $customer_group_tax = tep_db_fetch_array($check_customer_group_tax);
      $_SESSION['sppc_customer_group_show_tax'] = (int)$customer_group_tax['customers_group_show_tax'];
      $_SESSION['sppc_customer_group_tax_exempt'] = (int)$customer_group_tax['customers_group_tax_exempt'];
      $_SESSION['group_hide_show_prices'] = (int)$customer_group_tax['group_hide_show_prices'];
      $_SESSION['allow_add_to_cart'] = (int)$customer_group_tax['allow_add_to_cart'];
      $_SESSION['customer_country_id'] = $check_country['entry_country_id'];
      $_SESSION['customer_zone_id'] = $check_country['entry_zone_id'];
      $_SESSION[hide_form] = 'no'; //ITSZ: Homepage tbdf_card form show after re-login
      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$_SESSION['customer_id'] . "'");

      // restore cart contents
//henry disable this, even in PHP5.6
//      $cart->restore_contents();

      /*ITSZ: popup login form PART 3/4 START- henry 2017-04/11: dont use this logic any more
        Code Location:
        -- include\bottom.htm PART 1/4
        -- sp\templates\default\boxes\loginbox_popup.php PART 2/4
        -- sp\login.php PART 3/4
        -- include\right_shop_files.htm PART 4/4
        -- /sp/js/magnific-popup/*
      */
      //itsz: redirect current page after login (request comes from loginbox_popup.php)
      if(isset($_POST['redirect_uri'])){
        $url = $_POST['redirect_uri'];
            header('Location: ' . $url);
      }
      else
      {
          //$_SESSION['prev_page_uri'] = '';
        if (sizeof($navigation->snapshot) > 0) {
          $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
          $navigation->clear_snapshot();
          tep_redirect($origin_href);
        } else {
          //henry:  redirect sau khi login thanh cong : thay vi redirect ve index page thi chay ve shopping_cart.php
           // tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'));
          //tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'NONSSL'));
         // tep_redirect(tep_href_link('shopping_cart.php', '', 'NONSSL'));

            //ITSZ: after login redirect to previos page PART 2/2 START
            //PART 1/2: same file, see above
			$previous_file = basename($_SESSION['prev_page_uri']);
			IF ($previous_file =='password_forgotten.php' or $previous_file =='logoff.php' or $previous_file =='login.php' ){
                tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'NONSSL'));
			}
			else 
			{
            tep_redirect($_SESSION['prev_page_uri']); // after login redirect to previous page
			}
            //ITSZ: after login redirect to previos page PART 2/2 EOF


        }
      }
      /*ITSZ: popup login form PART 3/4 START*/
    }
  }
}
if(!isset($setme)) {
  $setme = false;
}
if ($error == true) {
  if ($setme != ''){
    $messageStack->add('login', TEXT_LOGIN_ERROR_VALIDATION);
  } else {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }
}
$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
$content = CONTENT_LOGIN;
$javascript = $content . '.js';
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
