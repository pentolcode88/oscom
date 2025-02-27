<?php
/*
  $Id: paypal_wpp.php,v 1.0.0.0 2007/11/13 13:41:11 datazen Exp $

  CRE Loaded, Open Source E-Commerce Solutions
  http://www.creloaded.com

  Copyright (c) 2007 CRE Loaded
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

*/

require_once(dirname(__FILE__) . '/paypal_wpp/paypal_wpp_base.php');
class paypal_wpp extends paypal_wpp_base {

    var $cards = array(array('id' => 'Visa', 'text' => 'Visa'),
                       array('id' => 'MasterCard', 'text' => 'MasterCard'),
                       array('id' => 'Discover', 'text' => 'Discover'),
                       array('id' => 'Amex', 'text' => 'American Express'));

    var $code, $title, $description, $enabled, $zone, $token, $avs, $cvv2, $trans_id, $response;
    
    function paypal_wpp() {
      global $order, $_SESSION;
      parent::paypal_wpp_base();
      $this->code = 'paypal_wpp';
      $this->enableDirectPayment = (MODULE_PAYMENT_PAYPAL_WPP_DIRECT_ENABLED == 'True');
      
      $this->avs = 'N/A';
      
      if ( strpos($GLOBALS['PHP_SELF'], 'admin') !== false ) {
          $this->title = MODULE_PAYMENT_PAYPAL_WPP_MODULE_TITLE;
      } else {
          if ( $_SESSION['skip_payment'] == '1' ) {
              $this->title = MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE;
          } else {
              $this->title = MODULE_PAYMENT_PAYPAL_WPP_TEXT_TITLE;
          }
      }
      $this->description = MODULE_PAYMENT_PAYPAL_WPP_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYPAL_WPP_SORT_ORDER;
      $this->enabled = (MODULE_PAYMENT_PAYPAL_WPP_STATUS == 'True');
      if ((int)MODULE_PAYMENT_PAYPAL_WPP_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYPAL_WPP_ORDER_STATUS_ID;
      }

      $this->zone = (int)MODULE_PAYMENT_PAYPAL_WPP_ZONE;
      if (is_object($order)) $this->update_status();
    }
    
    function update_status() {
        global $order;

        if ($this->enabled && ($this->zone > 0)) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . $this->zone . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            if (!$check_flag) {
                $this->enabled = false;
            }
        }
    }

    function javascript_validation() {
      global $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;

      if ( $_SESSION['skip_payment'] == '1' ) {
        return false;
      } else {
        $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
              '    var cc_firstname = document.checkout_payment.paypalwpp_cc_firstname.value;' . "\n" .
              '    var cc_lastname = document.checkout_payment.paypalwpp_cc_lastname.value;' . "\n" .
              '    var cc_number = document.checkout_payment.paypalwpp_cc_number.value;' . "\n" .
              '    var cc_checkcode = document.checkout_payment.paypalwpp_cc_checkcode.value;' . "\n" .
              '    if (cc_firstname == "" || cc_lastname == "" || eval(cc_firstname.length) + eval(cc_lastname.length) < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
              '      error_message = error_message + "' . MODULE_PAYMENT_PAYPAL_WPP_TEXT_JS_CC_OWNER . '";' . "\n" .
              '      error = 1;' . "\n" .
              '    }' . "\n" .
              '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
              '      error_message = error_message + "' . MODULE_PAYMENT_PAYPAL_WPP_TEXT_JS_CC_NUMBER . '";' . "\n" .
              '      error = 1;' . "\n" .
              '    }' . "\n" .
              '    if (cc_checkcode == "" || cc_checkcode.length < "3") {' . "\n".
            '      error_message = error_message + "' . MODULE_PAYMENT_PAYPAL_WPP_TEXT_JS_CC_CVC . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
              '  }' . "\n";

        return $js;
      }
    }

    function selection() {
      global $order;
      $selection = array();
      if ($this->enableDirectPayment) {
        for ($i=1; $i < 13; $i++) {
          $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
        }

        $today = getdate();
        for ($i=$today['year']; $i < $today['year']+15; $i++) {
          $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
        }        
        $module_str = MODULE_PAYMENT_PAYPAL_WPP_TEXT_TITLE . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="' .  MODULE_PAYMENT_PAYPAL_EC_MARK_IMG . '" />';
        $selection = array('id' => $this->code,
                           'module' => $module_str,
                           'fields' => array(
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_FIRSTNAME,
                                   'field' => tep_draw_input_field('paypalwpp_cc_firstname', $order->billing['firstname'])),
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_LASTNAME,
                                   'field' => tep_draw_input_field('paypalwpp_cc_lastname', $order->billing['lastname'])),
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_TYPE,
                                   'field' => tep_draw_pull_down_menu('paypalwpp_cc_type', $this->cards)),
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_NUMBER,
                                   'field' => tep_draw_input_field('paypalwpp_cc_number', '')),
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_EXPIRES,
                                   'field' => tep_draw_pull_down_menu('paypalwpp_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('paypalwpp_cc_expires_year', $expires_year)),
                             array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_CHECKNUMBER . ' ' .'<a href="javascript:CVVPopUpWindow(\'' . tep_href_link('cvv.html') . '\')">' . '<u><i>' . '(' . MODULE_PAYMENT_PAYPAL_WPP_TEXT_CVV_LINK . ')' . '</i></u></a>',
      'field' => tep_draw_input_field('paypalwpp_cc_checkcode','',"SIZE=4, MAXLENGTH=4"))));
      }
      return $selection;
    }

    function pre_confirmation_check() {
      global $_SESSION, $_POST;

      // If this is an EC checkout, do nothing.
      if ( $_SESSION['skip_payment'] == '1' ) {
        return false;
      }

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($_POST['paypalwpp_cc_number'], $_POST['paypalwpp_cc_expires_month'], $_POST['paypalwpp_cc_expires_year'], $_POST['paypalwpp_cc_checkcode'], $_POST['paypalwpp_cc_type']);

      $error = '';

      switch($result) {
        case -1:
          $error = (MODULE_PAYMENT_PAYPAL_WPP_DIRECT_ENABLED == 'True') ? sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4)) : MODULE_PAYMENT_PAYPAL_WPP_DIRECTPAY_ERROR;
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if(($result == false) || ($result < 1)) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['paypalwpp_cc_owner']) . '&cc_expires_month=' . $_POST['paypalwpp_cc_expires_month'] . '&cc_expires_year=' . $_POST['paypalwpp_cc_expires_year'];
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      switch($cc_validation->cc_type) {
        case 'Master Card':
          $this->cc_card_type = 'MasterCard';
          break;
        case 'Mastercard':
          $this->cc_card_type = 'MasterCard';
          break;
        case 'American Express':
          $this->cc_card_type = 'Amex';
          break;
        default:
          $this->cc_card_type = $cc_validation->cc_type; // Visa, Discover
          break;
      }

      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expires_month = $cc_validation->cc_expiry_month;
      $this->cc_expires_year = $cc_validation->cc_expiry_year;
    }

    function confirmation() {
      global $_POST, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;

      if ( $_SESSION['skip_payment'] == '1' ) {
        $confirmation = array('title' => MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE, 'fields' => array());
      } else {
        $confirmation = array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_TITLE,
                              'fields' => array(array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_FIRSTNAME,
                                                      'field' => $_POST['paypalwpp_cc_firstname']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_LASTNAME,
                                                      'field' => $_POST['paypalwpp_cc_lastname']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_TYPE,
                                                      'field' => $_POST['paypalwpp_cc_type']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_NUMBER,
                                                      'field' => substr($_POST['paypalwpp_cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['paypalwpp_cc_number']) - 8)) . substr($_POST['paypalwpp_cc_number'], -4)),
                                                array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_EXPIRES,
                                                      'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['paypalwpp_cc_expires_month'], 1, '20' . $_POST['paypalwpp_cc_expires_year'])))));

        if (tep_not_null($_POST['paypalwpp_cc_checkcode'])) {
          $confirmation['fields'][] = array('title' => MODULE_PAYMENT_PAYPAL_WPP_TEXT_CREDIT_CARD_CHECKNUMBER,
                                            'field' => $_POST['paypalwpp_cc_checkcode']);
        }
      }
      return $confirmation;
    }
    
    
    function process_button() {
      global $_SESSION, $_POST;

      if ( $_SESSION['skip_payment'] == '1' ) {
        return '';
      } else {
          $process_button_string = tep_draw_hidden_field('wpp_cc_type', $_POST['paypalwpp_cc_type']) .
              tep_draw_hidden_field('wpp_cc_expdate_month', $_POST['paypalwpp_cc_expires_month']) .
              tep_draw_hidden_field('wpp_cc_expdate_year', $_POST['paypalwpp_cc_expires_year']) .
              tep_draw_hidden_field('wpp_cc_number', $_POST['paypalwpp_cc_number']) .
              tep_draw_hidden_field('wpp_cc_checkcode', $_POST['paypalwpp_cc_checkcode']) .
              tep_draw_hidden_field('wpp_payer_firstname', $_POST['paypalwpp_cc_firstname']) .
              tep_draw_hidden_field('wpp_payer_lastname', $_POST['paypalwpp_cc_lastname']) .
              tep_draw_hidden_field('wpp_redirect_url', tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true));

          return $process_button_string;
      }
    }
    
    function ec_step1() {
      global $order, $currency, $customer_first_name, $languages_id, $currencies;
      require(DIR_WS_CLASSES . 'order.php');
      if ( !is_object($order) ) {
        $order = new order;
      }
      $params['RETURNURL'] = tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL');
      $params['CANCELURL'] = tep_href_link(FILENAME_SHOPPING_CART);
      $params['REQCONFIRMSHIPPING'] = '0';
      $params['AMT'] = number_format($order->info['total'] * $currencies->get_value($currency), 2);
      if (isset($_SESSION['customer_id'])) {
        if ($_SESSION['sendto'] == false) {
          $shipping_name = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
          $shipping_street = $order->customer['street_address'];
          $shipping_city = $order->customer['city'];
          $shipping_postcode = $order->customer['postcode'];
          $country_id = $order->customer['country_id'];
          $zone_id = $order->customer['zone_id'];
          $state = $order->customer['state'];
        } else {
          $shipping_name = $order->delivery['firstname'] . ' ' . $order->delivery['lastname'];
          $shipping_street = $order->delivery['street_address'];
          $shipping_city = $order->delivery['city'];
          $shipping_postcode = $order->delivery['postcode'];
          $country_id = $order->delivery['country_id'];
          $zone_id = $order->delivery['zone_id'];
          $state = $order->delivery['state'];
        }
        
        $country = tep_get_countries($country_id, true);
        
        $billing_country = tep_get_countries($order->billing['country_id'], true);
        
        if ( $zone_id != 0 ) {
          $zone_id = tep_db_prepare_input($zone_id);
          $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_id = '" . $zone_id . "'"));  
          $state = $zone['zone_code'];
        } else {
          $zone_name = tep_db_prepare_input($state);
          $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = '" . $zone_name . "' AND zone_country_id = '" . $country_id . "'"));
          if (tep_not_null($zone['zone_code'])) {
            $state = $zone['zone_code'];
          } else {
            $state = $zone_name;
          }
        }
      
        $address = array('SHIPTONAME' => $shipping_name,
                         'SHIPTOSTREET' => $shipping_street,
                         'SHIPTOCITY' => $shipping_city,
                         'SHIPTOSTATE' => $state,
                         'SHIPTOCOUNTRYCODE' => $country['countries_iso_code_2'],
                         'SHIPTOZIP' => $shipping_postcode);
        $params['ADDROVERRIDE'] = '1';
        $params['LOCALECODE'] = $billing_country['countries_iso_code_2'];
        $params = array_merge($params, $address);
      }
      $response = $this->SetExpressCheckout($params);
      if ($this->is_successful($response) === true) {
        $token = $this->getField($response, 'TOKEN');
        tep_redirect($this->paypal_url . '?cmd=_express-checkout&token=' . $token);
      } else {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, 'error=' . $this->error_msg));
      }
    }
    
    function ec_step2() {
      global $order, $_SESSION, $sendto, $currency, $currencies;
      if ( !tep_not_null($_SESSION['token']) ) {
        $this->ec_step1();
      }
      if ($sendto == false) {
        $shipping_name = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
        $shipping_street = $order->customer['street_address'];
        $shipping_city = $order->customer['city'];
        $shipping_postcode = $order->customer['postcode'];
        $country_id = $order->customer['country_id'];
        $zone_id = $order->customer['zone_id'];
        $state = $order->customer['state'];
      } else {
        $shipping_name = $order->delivery['firstname'] . ' ' . $order->delivery['lastname'];
        $shipping_street = $order->delivery['street_address'];
        $shipping_city = $order->delivery['city'];
        $shipping_postcode = $order->delivery['postcode'];
        $country_id = $order->delivery['country_id'];
        $zone_id = $order->delivery['zone_id'];
        $state = $order->delivery['state'];
      }
      
      $country = tep_get_countries($country_id, true);
      if ( tep_not_null($zone_id) ) {
        $zone_id = tep_db_prepare_input($zone_id);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_id = '" . $zone_id . "'"));  
        $state = $zone['zone_code'];
      } else {
        $zone_name = tep_db_prepare_input($state);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = '" . $zone_name . "' AND zone_country_id = '" . $country_id . "'"));
        if (tep_not_null($zone['zone_code'])) {
          $state = $zone['zone_code'];
        } else {
          $state = $zone_name;
        }
      }
      
      $address = array('SHIPTONAME' => $shipping_name,
                       'SHIPTOSTREET' => $shipping_street,
                       'SHIPTOCITY' => $shipping_city,
                       'SHIPTOSTATE' => $state,
                       'SHIPTOCOUNTRY' => $country['countries_iso_code_2'],
                       'SHIPTOZIP' => $shipping_postcode);
      $response = $this->DoExpressCheckoutPayment($_SESSION['token'], $_SESSION['PayerID'], $address, number_format($order->info['total'] * $currencies->get_value($currency), 2));
      $this->response = $response;
      if ( !$this->is_successful($response) ) {
        unset($_SESSION['skip_payment']);
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, 'error=' . $this->error_msg, 'SSL'));
      } else {
        $this->trans_id = $this->getField($response, 'TRANSACTIONID');
      }
    }
    
    function dp_step1() {
      global $order, $currency, $customer_first_name, $languages_id, $currencies;
      $params['RETURNURL'] = tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL');
      $params['CANCELURL'] = tep_href_link(FILENAME_SHOPPING_CART);
      $params['REQCONFIRMSHIPPING'] = '0';
      $params['AMT'] = number_format($order->info['total'] * $currencies->get_value($currency), 2);
      $response = $this->SetExpressCheckout($params);
      if ($this->is_successful($response) === true) {
        $this->token = $this->getField($response, 'TOKEN');
      } else {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . $this->error_msg . ' ( code: ' . $this->error_no . ' )';
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }
    }
    
    function dp_step2() {
      global $order, $_SESSION, $sendto, $_SERVER, $currency, $currencies;
      
      if ($sendto == false) {
        $shipping_name = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
        $shipping_street = $order->customer['street_address'];
        $shipping_city = $order->customer['city'];
        $shipping_postcode = $order->customer['postcode'];
        $country_id = $order->customer['country_id'];
        $zone_id = $order->customer['zone_id'];
        $state = $order->customer['state'];
      } else {
        $shipping_name = $order->delivery['firstname'] . ' ' . $order->delivery['lastname'];
        $shipping_street = $order->delivery['street_address'];
        $shipping_city = $order->delivery['city'];
        $shipping_postcode = $order->delivery['postcode'];
        $country_id = $order->delivery['country_id'];
        $zone_id = $order->delivery['zone_id'];
        $state = $order->delivery['state'];
      }
      
      $country = tep_get_countries($country_id, true);
      if ( tep_not_null($zone_id) ) {
        $zone_id = tep_db_prepare_input($zone_id);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_id = '" . $zone_id . "'"));  
        $state = $zone['zone_code'];
      } else {
        $zone_name = tep_db_prepare_input($state);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = '" . $zone_name . "' AND zone_country_id = '" . $country_id . "'"));
        if (tep_not_null($zone['zone_code'])) {
          $state = $zone['zone_code'];
        } else {
          $state = $zone_name;
        }
      }
      
      $address = array('SHIPTONAME' => $shipping_name,
                       'SHIPTOSTREET' => $shipping_street,
                       'SHIPTOCITY' => $shipping_city,
                       'SHIPTOSTATE' => $state,
                       'SHIPTOCOUNTRY' => $country['countries_iso_code_2'],
                       'SHIPTOZIP' => $shipping_postcode);
      
      $billing_firstname = $order->billing['firstname'];
      $billing_lastname = $order->billing['lastname'];
      $billing_street = $order->billing['street_address'];
      $billing_city = $order->billing['city'];
      $billing_postcode = $order->billing['postcode'];
      $country_id = $order->billing['country_id'];
      $zone_id = $order->billing['zone_id'];
      $state = $order->billing['state'];
      
      $country = tep_get_countries($country_id, true);
      if ( tep_not_null($zone_id) ) {
        $zone_id = tep_db_prepare_input($zone_id);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_id = '" . $zone_id . "'"));  
        $state = $zone['zone_code'];
      } else {
        $zone_name = tep_db_prepare_input($state);
        $zone = tep_db_fetch_array(tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = '" . $zone_name . "' AND zone_country_id = '" . $country_id . "'"));
        if (tep_not_null($zone['zone_code'])) {
          $state = $zone['zone_code'];
        } else {
          $state = $zone_name;
        }
      }
   
      $cc_info = array('CREDITCARDTYPE' => $order->info['cc_type'],
                       'ACCT' => $order->info['cc_number'],
                       'EXPDATE' => substr($order->info['cc_expires'], 0, 2) . substr(date('Y'), 0, 2) . substr($order->info['cc_expires'], 2),
                       'CVV2' => $order->info['cc_ccv'],
                       'FIRSTNAME' => $billing_firstname,
                       'LASTNAME' => $billing_lastname,
                       'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
                       'STREET' => $billing_street,
                       'CITY' => $billing_city,
                       'STATE' => $state,
                       'COUNTRY' => $country['countries_name'],
                       'ZIP' => $billing_postcode,
                       'COUNTRYCODE' => $country['countries_iso_code_2']);
      $response = $this->DoDirectPayment($this->token, $cc_info, $address, number_format($order->info['total'] * $currencies->get_value($currency), 2));
      $this->response = $response;
      if ( !$this->is_successful($response) ) {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code . '&error=' . $this->error_msg . ' ( code: ' . $this->error_no . ' )', 'SSL'));
      } else {
        $this->avs = $this->getAVSCODE($this->getField($response, 'AVSCODE'));
        $this->cvv2 = $this->getCVV2MATCH($this->getField($response, 'CVV2MATCH'));
        $this->trans_id = $this->getField($response, 'TRANSACTIONID');
      }
    }
    
    function before_process() {
      global $_POST, $order, $currency, $_SESSION;

      if ( $_SESSION['skip_payment'] == '1' ) {
        // Do EC checkout 
        $this->ec_step2();
      } else {
        // Do DP checkout
        $cc_type = $_POST['wpp_cc_type'];
        $cc_number = $_POST['wpp_cc_number'];
        $cc_checkcode = $_POST['wpp_cc_checkcode'];
        $cc_first_name = $_POST['wpp_payer_firstname'];
        $cc_last_name = $_POST['wpp_payer_lastname'];
        $cc_owner_ip = $_SERVER['REMOTE_ADDR'];
        $cc_expdate_month = $_POST['wpp_cc_expdate_month'];
        $cc_expdate_year = $_POST['wpp_cc_expdate_year'];
        if (strlen($cc_expdate_year) < 4) $cc_expdate_year = '20'.$cc_expdate_year;

        //If they're still here, and awake, set some of the order object's variables
        $order->info['cc_type'] = $cc_type;
        $order->info['cc_number'] = $cc_number;
        $order->info['cc_owner'] = $cc_first_name . ' ' . $cc_last_name;
        $order->info['cc_expires'] = $cc_expdate_month . substr($cc_expdate_year, -2);
        $order->info['cc_ccv'] = $cc_checkcode;
        
        $order->billing['firstname'] = $cc_first_name;
        $order->billing['lastname'] = $cc_last_name;
        
        $this->dp_step1();
        $this->dp_step2();
      }
    }
    
    function after_process() {
      global $insert_id, $_SESSION, $_POST, $customer_id, $language, $currency, $order;
      
      tep_db_query("update ".TABLE_ORDERS_STATUS_HISTORY. " set comments = concat(if (trim(comments) != '', concat(trim(comments), '\n'), ''), 'Transaction ID: ".$this->trans_id.($this->avs != 'N/A' ? "\nAVS Code: ".$this->avs."\nCVV2 Code: ".$this->cvv2 : '')."') where orders_id = ".$insert_id);
      
      if ( isset($_POST['create_account']) && $_POST['create_account'] == '1' ) {
        require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
        
        $customers = tep_db_fetch_array(tep_db_query("select customers_gender, customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'"));
        $customer_name = $customers['customers_firstname'] . ' ' . $customers['customers_lastname'];
        if (ACCOUNT_GENDER == 'true') {
          if ($customers['customers_gender'] == 'm') {
            $email_text = sprintf(EMAIL_GREET_MR, $customers['customers_lastname']);
          } else {
            $email_text = sprintf(EMAIL_GREET_MS, $customers['customers_lastname']);
          }
        } else {
          $email_text = sprintf(EMAIL_GREET_NONE, $customers['customers_firstname']);
        }
        if (EMAIL_USE_HTML == 'true') {
          $formated_store_owner_email = '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">' . STORE_OWNER . ': ' . STORE_OWNER_EMAIL_ADDRESS . '</a>';
        } else {
          $formated_store_owner_email = STORE_OWNER . ': ' . STORE_OWNER_EMAIL_ADDRESS;
        }
        $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . $formated_store_owner_email . "\n\n" . EMAIL_WARNING . $formated_store_owner_email . "\n\n";
        $email_text .= EMAIL_TEXT_PASSWORD . $_SESSION['temp_password'] . "\n\n";
        
        tep_mail($customer_name, $customers['customers_email_address'], EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      } elseif ( $_SESSION['paypalwpp_create_account'] == '1' ) {
        $_SESSION['noaccount'] = '1';
      }
      
      $txn_id = $this->getField($this->response, 'TRANSACTIONID');
      $txn_query = tep_db_query("select paypal_id from paypal where txn_id = '" . $txn_id . "'");
      if ( tep_db_num_rows($txn_query) == 0 ) {
        $sql_data = array('payment_type' => $this->getField($this->response, 'PAYMENTTYPE'),
                          'payment_status' => $this->getField($this->response, 'PAYMENTSTATUS'),
                          'mc_currency' => $this->getField($this->response, 'CURRENCYCODE'),
                          'payer_id' => $_SESSION['PayerID'],
                          'receiver_id' => $_SESSION['token'],
                          'txn_id' => $txn_id,
                          'date_added' => 'now()');
        tep_db_perform('paypal', $sql_data);
        $paypal_id = tep_db_insert_id();
      } else {
        $txn_data = tep_db_fetch_array($txn_query);
        $paypal_id = $txn_data['paypal_id'];
      }
      tep_db_query("update " . TABLE_ORDERS . " set payment_id = '" . $paypal_id . "' where orders_id = '" . $insert_id . "'");      
    }
    
    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_WPP_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_PAYPAL_WPP_STATUS', 'True', 'Do you want to enable this payment module?&nbsp;<a style=\"color: #0033cc;\" href=\"" . tep_href_link(FILENAME_PAYPAL, 'action=help', 'NONSSL') . "\" target=\"paypalHelp\">[Help]</a>', '6', '10', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Direct Payment', 'MODULE_PAYMENT_PAYPAL_WPP_DIRECT_ENABLED', 'False', 'Would you like to enable credit card payments through PayPal?', '6', '20', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_PAYPAL_WPP_DEBUGGING', 'False', 'Would you like to enable debug mode?  A complete dump of transactions will be logged to the debug file.', '6', '30', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Live or Sandbox API', 'MODULE_PAYMENT_PAYPAL_WPP_SERVER', 'sandbox', 'Live: Live transactions<br>Sandbox: For developers and testing', '6', '40', 'tep_cfg_select_option(array(\'live\', \'sandbox\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Username', 'MODULE_PAYMENT_PAYPAL_WPP_API_USERNAME', '', 'Your PayPal WPP API Username', '6', '50', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Password', 'MODULE_PAYMENT_PAYPAL_WPP_API_PASSWORD', '', 'Your PayPal WPP API Password', '6', '60', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Signature', 'MODULE_PAYMENT_PAYPAL_WPP_API_SIGNATURE', '', 'Your PayPal WPP API Signature', '6', '70', now())");
//      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Proxy Address', 'MODULE_PAYMENT_PAYPAL_WPP_PROXY', '', 'If curl transactions need to go through a proxy, type the address here.  Otherwise, leave it blank.', '6', '80', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Type', 'MODULE_PAYMENT_PAYPAL_WPP_TRXTYPE', 'Sale', 'Should customers be charged immediately, or should we perform an authorization? If we perform authorizations, capture must be handled manually by the store owner.)', '6', '90', 'tep_cfg_select_option(array(\'Sale\', \'Authorization\'), ', now())");
//      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Confirmed Address', 'MODULE_PAYMENT_PAYPAL_WPP_CONFIRMED', 'No', 'Do you want to require that your customers\' shipping address with PayPal is confirmed?', '6', '100',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
//      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Display Payment Page', 'MODULE_PAYMENT_PAYPAL_WPP_DISPLAY_PAYMENT_PAGE', 'No', 'If someone\'s checking out with Express Checkout, do you want to display the checkout_payment.php page?  The payment options will be hidden.  (Yes, if you have CCGV installed)', '6', '110',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
//      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Automatic Account Creation', 'MODULE_PAYMENT_PAYPAL_WPP_NEW_ACCT_NOTIFY', 'Yes', 'If a visitor is not an existing customer, an account is created for them.  Would you like make it a permanent account and send them an email containing their login information?', '6', '120', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Merchant Country', 'MODULE_PAYMENT_PAYPAL_WPP_MERCHANT_COUNTRY', 'US', 'The country of merchant', '6', '120', 'tep_cfg_select_option(array(\'US\', \'UK\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_WPP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '130', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_WPP_ZONE', '0', 'If a zone is selected, enable this payment method for that zone only.', '6', '140', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPAL_WPP_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '150', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_PAYPAL_WPP_REFUND_ORDER_STATUS_ID', '0', 'Set the status of refund orders made with this payment module to this value', '6', '150', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }
    
    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
    
    function keys() {
      return array('MODULE_PAYMENT_PAYPAL_WPP_STATUS', 'MODULE_PAYMENT_PAYPAL_WPP_DIRECT_ENABLED', 'MODULE_PAYMENT_PAYPAL_WPP_DEBUGGING', 'MODULE_PAYMENT_PAYPAL_WPP_SERVER', 'MODULE_PAYMENT_PAYPAL_WPP_API_USERNAME', 'MODULE_PAYMENT_PAYPAL_WPP_API_PASSWORD', 'MODULE_PAYMENT_PAYPAL_WPP_API_SIGNATURE', 'MODULE_PAYMENT_PAYPAL_WPP_TRXTYPE', 'MODULE_PAYMENT_PAYPAL_WPP_MERCHANT_COUNTRY', 'MODULE_PAYMENT_PAYPAL_WPP_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_WPP_ZONE', 'MODULE_PAYMENT_PAYPAL_WPP_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_WPP_REFUND_ORDER_STATUS_ID');
    }
    
    function get_error() {
        global $_GET, $language;
        require(DIR_WS_LANGUAGES . $language . '/modules/payment/' . FILENAME_PAYPAL_WPP);

        $error = array('title' => MODULE_PAYMENT_PAYPAL_WPP_ERROR_HEADING,
                       'error' => ((isset($_GET['error'])) ? stripslashes(urldecode($_GET['error'])) : MODULE_PAYMENT_PAYPAL_WPP_TEXT_CARD_ERROR));

        return $error;
    }
    
}
?>
