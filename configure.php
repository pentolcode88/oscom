<?php

/*

  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2003 osCommerce



  Released under the GNU General Public License

*/



// Define the webserver and path parameters

// * DIR_FS_* = Filesystem directories (local/physical)

// * DIR_WS_* = Webserver directories (virtual/URL)

  define('HTTP_SERVER', 'https://www.pedispasofamerica.com'); // eg, http://localhost - should not be empty for productive servers

  define('HTTPS_SERVER', 'https://www.pedispasofamerica.com'); // eg, https://localhost - should not be empty for productive servers

  define('ENABLE_SSL', true); // secure webserver for checkout procedure?

  define('HTTP_COOKIE_DOMAIN', 'www.pedispasofamerica.com');

  define('HTTPS_COOKIE_DOMAIN', 'www.pedispasofamerica.com');

  define('HTTP_COOKIE_PATH', '/shop/');

  define('HTTPS_COOKIE_PATH', '/shop/');

  define('DIR_WS_HTTP_CATALOG', '/shop/');

  define('DIR_WS_HTTPS_CATALOG', '/shop/');

  define('DIR_WS_IMAGES', 'images/');

  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');

  define('DIR_WS_INCLUDES', 'includes/');

  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');

  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');

  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');

  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');

  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');



//Added for BTS1.0

  define('DIR_WS_TEMPLATES', 'templates/');

  define('DIR_WS_CONTENT', DIR_WS_TEMPLATES . 'content/');

  define('DIR_WS_JAVASCRIPT', DIR_WS_INCLUDES . 'javascript/');

//End BTS1.0

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');

  define('DIR_FS_CATALOG', '/home/pedispa/public_html/shop/');

  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');

  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');



// define our database connection

  define('DB_SERVER', 'localhost'); // eg, localhost - should not be empty for productive servers

  define('DB_SERVER_USERNAME', 'pedispa_staff');

  define('DB_SERVER_PASSWORD', 'dasvu9');

  define('DB_DATABASE', 'pedispa_shop2');

  define('USE_PCONNECT', 'false'); // use persistent connections?

  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'


/* henry bo sung: turn on quote request system. Quote request must turn on. Besides, need to change followign setting in admin backend
- payment method: need to blank
- shipping method: need to blank
- module total: remove total, shipping, tax, coupon so that we dont see zero amount
*/
  define('QUOTE_REQUEST', 'no'); //yes if quote request, no if shopping cart
  define('DEBUG_EMAIL', 'henry@sea-lion.biz'); 	//henry khai bao them bien debug

  define('ADMIN_FOLDER', 'adm/'); 								//henry khai bao them feature CMS folder
  define('CMS_FOLDER', 'cms/'); 								//henry khai bao them feature CMS folder
  define('CMS_ADMIN_FOLDER', 'cms/adm/'); 						//henry khai bao them feature CMS folder

  define('PHOTO_CAT_ORDDER', 'order by photocat_order ASC'); 		//photo section :  order by photocat_id DESC or  order by photocat_order ASC
  define('PHOTO_CAT_LIST_ALL_ID', '38'); 						//photo section 
  define('PHOTO_CAT_SLIDESHOW_ID', '36'); 						//photo section 
  define('PHOTO_CAT_SLIDESHOW_HOME_ID', '21'); 						//photo section 
  define('PHOTO_SHOW_IMAGE_HEADING', 'no'); 						//photo section 

  define('BANNER_TIMER', 'no'); 						//yes if you want to set banner timer, no is default


  define('LOAD_TIME_DEBUG', 'no'); 						//if value =yes, it will show load time in different section 

  define('HIDE_ROOT_FOLDER_IN_URL', 'no'); 						//yes if you want to hide "shop" folder in URL (for SEO purpose) 
  define('HIDE_SESSION_VARIABLE_IN_URL', 'yes'); 					//yes if you want to hide session variable in URL (for SEO purpose) 
  define('STYLE_TOP_HEADING', '1'); 					//1: logo on top of menu, 2: logo below menu, 3: logo align with menu  

  define('IN_CART_NOTIFICATION', 'yes'); 					//yes: email owner and admin whenever sombody go to order_checkout.php page  



?>
