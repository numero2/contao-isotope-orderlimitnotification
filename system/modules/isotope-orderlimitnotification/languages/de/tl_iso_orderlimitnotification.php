<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2013
 * @author     numero2 - Agentur für Internetdienstleistungen
 * @package    Isotope eCommerce
 * @license    LGPL
 * @filesource
 */

 
/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['type'] 		= array( 'Art der Benachrichtigung', 'Wählen Sie eine Basis für die Benachrichtigung.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['category']	= array( 'Kategorie', 'Benachrichtigung für Produkte aus einer ganzen Kategorie aktivieren.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['category_values']	= array( 'category' => 'Basierend auf einer ganzen Kategorie', 'product' => 'Basierend auf einem einzelnen Produkt' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['product'] 	= array( 'Produkt', 'Benachrichtigung für ein spezielles Produkt aktivieren.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['price']		= array( 'Preis', 'Preisgrenze damit die Benachrichtigung ausgelöst wird.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['qty']			= array( 'Anzahl', 'Anzahl der zu bestellenden Produkte damit die Benachrichtigung ausgelöst wird.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['notification']= array( 'Benachrichtigungstext', 'Eine kurze Beschreibung für die Benachrichtigung.' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['enabled']		= array( 'Benachrichtigung aktivieren', 'Klicken Sie hier wenn diese Benachrichtigung aktiv sein soll.' );


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['type_legend']		= 'Art der Benachrichtigung';
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['config_legend']	= 'Allgemeine Einstellungen';
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['enabled_legend']	= 'Aktivierung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['new']		= array( 'Neue Benachrichtigung', 'Erstellen Sie eine neue Benachrichtigung' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['edit']	= array( 'Benachrichtigung bearbeiten', 'Benachrichtigung ID %s bearbeiten' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['copy']	= array( 'Benachrichtigung kopieren', 'Benachrichtigung ID %s kopieren' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['delete']	= array( 'Benachrichtigung löschen', 'Benachrichtigung ID %s löschen' );
$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['show']	= array( 'Benachrichtigungsdetails', 'Details der Benachrichtigung ID %s anzeigen' );

?>