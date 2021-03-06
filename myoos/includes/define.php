<?php
/* ----------------------------------------------------------------------

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2018 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) OR die( 'Direct Access to this location is not allowed.' );

define('OOS_LOG_SQL', 'false');    // OOS Performance Monitor
define('USE_DB_CACHE', 'false');   // OOS SQL-Layer Cache 
define('USE_DB_CACHE_LEVEL_HIGH', 'false');  // OOS SQL-Layer Cache HIGH

define('WARN_INSTALL_EXISTENCE', 'false');
define('WARN_CONFIG_WRITEABLE', 'false');
define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'false');

define('DECIMAL_CART_QUANTITY', 'false');

// define('UNITS_DELIMITER', '&nbsp;/&nbsp;');
define('UNITS_DELIMITER', '');
define('ACCOUNT_COMPANY_VAT_ID_CHECK', 'true');

define('OOS_PAGE_TYPE_MAINPAGE',  1);
define('OOS_PAGE_TYPE_CATALOG',   2);
define('OOS_PAGE_TYPE_PRODUCTS',  3);
define('OOS_PAGE_TYPE_SERVICE',   4);
define('OOS_PAGE_TYPE_CHECKOUT',  5);
define('OOS_PAGE_TYPE_ACCOUNT',   6);
define('OOS_PAGE_TYPE_REVIEWS',   7);

define('LOGIN_FOR_PRICE', 'false');

