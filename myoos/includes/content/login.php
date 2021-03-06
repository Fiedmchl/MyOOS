<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2018 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: login.php,v 1.75 2003/02/13 03:01:49 hpdl
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce

   Max Order - 2003/04/27 JOHNSON - Copyright (c) 2003 Matti Ressler - mattifinn@optusnet.com.au
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

$bError = FALSE;

// start the session
if ( $session->hasStarted() === FALSE ) $session->start();

if (!isset($_SESSION['user'])) {
	$_SESSION['user'] = new oosUser();
	$_SESSION['user']->anonymous();
}


// require  the password crypto functions
require_once MYOOS_INCLUDE_PATH . '/includes/functions/function_password.php';
require_once MYOOS_INCLUDE_PATH . '/includes/languages/' . $sLanguage . '/user_login.php';
  
if ( isset($_POST['action']) && ($_POST['action'] == 'process') && 
	( isset($_SESSION['formid']) && ($_SESSION['formid'] == $_POST['formid'])) ){

    $email_address = oos_prepare_input($_POST['email_address']);
    $password = oos_prepare_input($_POST['password']);
	
    if ( empty( $email_address ) || !is_string( $email_address ) ) {
        $_SESSION['error_message'] = $aLang['text_login_error'];
        oos_redirect(oos_href_link($aContents['login']));
    }

    if ( empty( $password ) || !is_string( $password ) ) {
        $_SESSION['error_message'] = $aLang['text_login_error'];
        oos_redirect(oos_href_link($aContents['login']));
    }

	/* Check if it is ok to login */
    if (!isset($_SESSION['password_forgotten_count'])) {
        $_SESSION['login_count'] = 1;
    } else {
        $_SESSION['login_count'] ++;
    }

    if ( $_SESSION['login_count'] > 3) {
        oos_redirect(oos_href_link($aContents['403']));
    }
	
	// Check if email exists
	$customerstable = $oostable['customers'];
	$sql = "SELECT customers_id, customers_gender, customers_firstname, customers_lastname,
                   customers_password, customers_wishlist_link_id, customers_language,
                   customers_email_address, customers_default_address_id, customers_max_order 
            FROM $customerstable
            WHERE customers_login = '1'
              AND customers_email_address = '" . oos_db_input($email_address) . "'";
	$check_customer_result = $dbconn->Execute($sql);

	if (!$check_customer_result->RecordCount()) {
		$bError = TRUE;
	} else {
		$check_customer = $check_customer_result->fields;

		// Check that password is good
		if (!oos_validate_password($password, $check_customer['customers_password'])) {
			$bError = TRUE;
		} else {
			$address_booktable = $oostable['address_book'];
			$sql = "SELECT entry_vat_id, entry_vat_id_status, entry_country_id, entry_zone_id
					FROM $address_booktable
					WHERE customers_id = '" . intval($check_customer['customers_id']) . "'
						AND address_book_id = '" . intval($check_customer['customers_default_address_id']) . "'";
			$check_country = $dbconn->GetRow($sql);

			if ($check_customer['customers_language'] == '') {
				$customerstable = $oostable['customers'];
				$dbconn->Execute("UPDATE $customerstable
									SET customers_language = '" . oos_db_input($sLanguage) . "'
								WHERE customers_id = '" . intval($check_customer['customers_id']) . "'");
			}


			$_SESSION['login_count'] = 1;
			$_SESSION['customer_wishlist_link_id'] = $check_customer['customers_wishlist_link_id'];
			$_SESSION['customer_id'] = $check_customer['customers_id'];
			$_SESSION['customer_default_address_id'] = $check_customer['customers_default_address_id'];
			if (ACCOUNT_GENDER == 'true') $_SESSION['customer_gender'] = $check_customer['customers_gender'];
			$_SESSION['customer_first_name'] = $check_customer['customers_firstname'];
			$_SESSION['customer_lastname'] = $check_customer['customers_lastname'];
			$_SESSION['customer_max_order'] = $check_customer['customers_max_order'];
			$_SESSION['customer_country_id'] = $check_country['entry_country_id'];
			$_SESSION['customer_zone_id'] = $check_country['entry_zone_id'];
			if (ACCOUNT_VAT_ID == 'true') $_SESSION['customers_vat_id_status'] = $check_country['entry_vat_id_status'];
			
			$_SESSION['user']->restore_group();
			$aUser = $_SESSION['user']->group;
			
			$customers_infotable = $oostable['customers_info'];
			$dbconn->Execute("UPDATE $customers_infotable
								SET customers_info_date_of_last_logon = now(),
									customers_info_number_of_logons = customers_info_number_of_logons+1
								WHERE customers_info_id = '" . intval($_SESSION['customer_id']) . "'");

			// restore cart contents
			$_SESSION['cart']->restore_contents();

			if (count($_SESSION['navigation']->snapshot) > 0) {
				$origin_href = oos_href_link($_SESSION['navigation']->snapshot['content'], $_SESSION['navigation']->snapshot['get']);
				$_SESSION['navigation']->clear_snapshot();
				oos_redirect($origin_href);
			} else {
				oos_redirect(oos_href_link($aContents['account']));
			}
        }
	}
}


// links breadcrumb
$oBreadcrumb->add($aLang['navbar_title'], oos_href_link($aContents['login']));
$sCanonical = oos_href_link($aContents['login'], '', FALSE, TRUE);

if (isset($bError) && ($bError == TRUE)) {
    $sErrorMessage = $aLang['text_login_error'];
} 
  
if (isset($_SESSION) && is_object($_SESSION['cart']) && ($_SESSION['cart']->count_contents()) ) {
    $sInfoMessage = $aLang['text_visitors_cart'];
}

$aTemplate['page'] = $sTheme . '/page/user_login.html';

$nPageType = OOS_PAGE_TYPE_SERVICE;
$sPagetitle = $aLang['heading_title'] . ' ' . OOS_META_TITLE;

if ($oMessage->size('login') > 0) {
	$aInfoMessage = array_merge ($aInfoMessage, $oMessage->output('login') );
}

require_once MYOOS_INCLUDE_PATH . '/includes/system.php';
if (!isset($option)) {
	require_once MYOOS_INCLUDE_PATH . '/includes/message.php';
	require_once MYOOS_INCLUDE_PATH . '/includes/blocks.php';
}

// assign Smarty variables;
$smarty->assign(
      array(
          'breadcrumb'		=> $oBreadcrumb->trail(),
          'heading_title'	=> $aLang['navbar_title'],
		  'robots'			=> 'noindex,follow,noodp,noydir',
		  'login_active'	=> 1,

		  'canonical'		=> $sCanonical
      )
);

// display the template
$smarty->display($aTemplate['page']);
