<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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


class IsotopeOrderLimitNotification extends Frontend {
	
	
	/**
	 * Checks and sends notifications
	 * @param object The order object
	 * @return none
	 */
	public function checkForNotifications( IsotopeOrder $oOrder=NULL, $arrItemIds, $arrData ) {
	
		$this->import('FrontendUser', 'User');
		
		if( !$this->User->id )
			return;
	
		// get list of bough items
		$oItems = NULL;
		$oItems = $this->Database->prepare("SELECT oi.product_id AS id, p.pages AS categories, oi.product_quantity AS qty, (oi.price * oi.product_quantity) AS sum FROM tl_iso_order_items AS oi JOIN tl_iso_products p ON (p.id = oi.product_id) WHERE oi.id IN(?);")->executeUncached($arrItemIds);
		
		$aItems = array();
		$aItems = $oItems->fetchAllAssoc();
		
		$oBoughtProducts = NULL;
		$oBoughtProducts = $this->Database->prepare("SELECT oi.product_id AS id, p.pages AS categories, SUM(oi.product_quantity) AS qty, SUM(oi.price * oi.product_quantity) AS sum FROM tl_iso_order_items AS oi JOIN tl_iso_products p ON (p.id = oi.product_id) JOIN tl_iso_orders o ON (o.id = oi.pid) WHERE o.pid = ? GROUP BY oi.product_id")->executeUncached($this->User->id);
		
		$aBoughtProducts = array();
		$aBoughtProducts = $oBoughtProducts->fetchAllAssoc();
		
		$aProductCategories = array();
		
		if( !empty($aBoughtProducts) ) {
		
			foreach( $aBoughtProducts as $product ) {

				$categories = unserialize($product['categories']);

				foreach( $categories as $i => $c ) {
					$aProductCategories[$c]['sum'] += $product['sum'];
					$aProductCategories[$c]['qty'] += $product['qty'];
				}
			}
		}
		
		// get list of active notifications
		$oNotifications = NULL;
		$oNotifications = $this->Database->prepare("SELECT n.* FROM tl_iso_orderlimitnotification AS n WHERE n.enabled = 1 AND n.id NOT IN( SELECT nr.notification FROM tl_iso_orderlimitnotification_raised AS nr WHERE nr.pid = ? )")->executeUncached($this->User->id);
		
		while( $oNotifications->next() ) {
		
			$bSendNotification = false;

			if( $oNotifications->type == 'product' ) {

				// check if current order raises a notification
				foreach( $aItems as $item ) {
				
					if(
						$oNotifications->price && $item['sum'] >= $oNotifications->price
					OR	$oNotifications->qty && $item['qty'] >= $oNotifications->qty
					) {
						$bSendNotification = true;
						break;
					}
				}
				
				// check if all orders raise an exception
				foreach( $aBoughtProducts as $item ) {
				
					if(
						$oNotifications->price && $item['sum'] >= $oNotifications->price
					OR	$oNotifications->qty && $item['qty'] >= $oNotifications->qty
					) {
						$bSendNotification = true;
						break;
					}
				}

			} else if( $oNotifications->type == 'category' ) {
			
				if( empty($aProductCategories[$oNotifications->category]) )
					continue;
					
				if(
					$oNotifications->price && $aProductCategories[$oNotifications->category]['sum'] >= $oNotifications->price
				OR	$oNotifications->qty && $aProductCategories[$oNotifications->category]['qty'] >= $oNotifications->qty
				) {
					$bSendNotification = true;
				}
			}
		
			if( $bSendNotification ) {
			
				$b = $this->Database->prepare("INSERT INTO tl_iso_orderlimitnotification_raised (tstamp, pid, notification) VALUES( ?, ?, ?);")->execute( time(), $this->User->id, $oNotifications->id );
			
				$oMail = NULL;
				$oMail = new Email();
				
				$oTemplate = NULL;
				$oTemplate = new FrontendTemplate("notification_mail");
				
				$oTemplate->firstname = $this->User->firstname;
				$oTemplate->lastname = $this->User->lastname;
				$oTemplate->email = $this->User->email;
				
				$oMail->subject = $oNotifications->notification;
				
				$oMail->text = $oTemplate->parse();
				
				$oMail->sendTo($GLOBALS['TL_CONFIG']['adminEmail']);
				
				$this->log('New order notification Mail has been sent', __METHOD__, TL_ACCESS);
			}
		}
	}
}

?>