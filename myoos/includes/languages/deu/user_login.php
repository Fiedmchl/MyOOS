<?php
/* ----------------------------------------------------------------------
   $Id: user_login.php,v 1.3 2007/06/12 16:36:39 r23 Exp $

   MyOOS [Shopsystem]
   https://www.oos-shop.de
   
   
   Copyright (c) 2003 - 2018 by the MyOOS Development Team.
   ----------------------------------------------------------------------
   Based on:

   File: login.php,v 1.12 2002/06/17 23:10:03 harley_vb
   ----------------------------------------------------------------------
   osCommerce, Open Source E-Commerce Solutions
   http://www.oscommerce.com

   Copyright (c) 2003 osCommerce
   ----------------------------------------------------------------------
   Released under the GNU General Public License
   ---------------------------------------------------------------------- */

if (isset($_GET['origin']) && ($_GET['origin'] == $aContents['checkout_payment'])) {
  $aLang['navbar_title'] = 'Bestellen';
  $aLang['heading_title'] = 'Eine Online-Bestellung ist einfach.';
} else {
  $aLang['navbar_title'] = 'Anmelden';
  $aLang['heading_title'] = 'Melden Sie sich an';
}

$aLang['heading_new_customer'] = 'Neuer Kunde';
$aLang['text_new_customer'] = 'Sind Sie Neukunde?';
$aLang['link_new_customer'] = 'Jetzt registrieren.';

$aLang['heading_returning_customer'] = 'Bereits Kunde';
$aLang['text_returning_customer'] = 'Ich bin bereits Kunde.';

$aLang['text_password_forgotten'] = 'Sie haben Ihr Passwort vergessen?';
$aLang['link_password_forgotten'] = 'Dann klicken Sie <u>hier</u>';

$aLang['text_login_error'] = '<strong>FEHLER:</strong> Keine Übereinstimmung der eingebenen \'eMail-Adresse\' und/oder dem \'Passwort\'.';
$aLang['text_visitors_cart'] = '<strong>ACHTUNG:</strong> Ihre Besuchereingaben werden automatisch mit Ihrem Kundenkonto verbunden.[Mehr Information]</a>';

$aLang['sub_heading_title'] = 'Warenkorb';
$aLang['sub_heading_title_1'] = 'Besucherwarenkorb';
$aLang['sub_heading_title_2'] = 'Kundenwarenkorb';
$aLang['sub_heading_title_3'] = 'Information';
$aLang['sub_heading_text_1'] = 'Jeder Besucher unseres Online-Shops bekommt einen \'Besucherwarenkorb\'. Damit kann er seine ausgewählten Produkte sammeln. Sobald der Besucher den Online-Shop verlässt, verfällt dessen Inhalt.';
$aLang['sub_heading_text_2'] = 'Jeder angemeldete Kunde verfügt über einen \'Kundenwarenkorb\' zum Einkaufen, mit dem er auch zu einem späterem Zeitpunkt den Einkauf beenden kann. Jeder Artikel bleibt darin registriert bis der Kunde zur Kasse geht, oder die Produkte darin löscht.';
$aLang['sub_heading_text_3'] = 'Die Besuchereingaben werden automatisch bei der Registrierung als Kunde in den Kundenwarenkorb übernommen.';
$aLang['text_close_window'] = '<strong><u>[Fenster schließen]</strong></u>';
