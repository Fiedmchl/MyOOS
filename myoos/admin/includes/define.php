<?php
/* ----------------------------------------------------------------------
   $Id: oos_define.php,v 1.2 2007/10/29 18:21:06 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de

   Copyright (c) 2003 - 2018 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   BruttoAdmin V1.1 for OSC http://www.oscommerce.com

   Images_resize Vs 1.3 for OSC http://www.oscommerce.com
   Copyright 2003 Henri Schmidhuber
   mailto: info@in-solution.de http://www.in-solution.de 

   osCommerce 2.2 Milestone 1
   Copyright (c) osCommerce 2003

   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

/** ensure this file is being included by a parent file */
defined( 'OOS_VALID_MOD' ) or die( 'Direct Access to this location is not allowed.' );

if(!defined('MYOOS_INCLUDE_PATH')) {
	define('MYOOS_INCLUDE_PATH', OOS_ABSOLUTE_PATH);
}

define('OOS_LOG_SQL', 'false');    // OOS Performance Monitor
define('USE_DB_CACHE', 'false');   // OOS SQL-Layer Cache 
define('USE_DB_CACHE_LEVEL_HIGH', 'false');  // OOS SQL-Layer Cache HIGH

  
define('OOS_BASE_PRICE', 'true');
define('DECIMAL_CART_QUANTITY', 'false');


// Define how do we update currency exchange rates
// Possible values are 'oanda' 'xe' or ''
define('CURRENCY_SERVER_PRIMARY', 'oanda');
define('CURRENCY_SERVER_BACKUP', 'xe');

