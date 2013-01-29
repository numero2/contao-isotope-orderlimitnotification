<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * Table tl_iso_bonuspoints
 */
$GLOBALS['TL_DCA']['tl_iso_orderlimitnotification'] = array(

	'config' => array(
		'dataContainer'               => 'Table'
	,	'enableVersioning'            => true
	,	'closed'					  => true
	,	'onload_callback'			  => array(
			array('IsotopeBackend', 'initializeSetupModule')
		,	array('tl_iso_orderlimitnotification', 'checkPermission'),
		)
	)
	
,	'list' => array(

		'sorting' => array(
			'mode'                    => 1
		,	'fields'                  => array('type')
		,	'flag'                    => 11
		,	'panelLayout'             => 'sort,filter;search,limit'
		)
	,	'label' => array(
			'fields'                  => array('product','category')
		,	'format'                  => '%s%s'
		,	'label_callback'		  => array('tl_iso_orderlimitnotification', 'generateLabel')
		)
	,	'global_operations' => array(
			'back' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['backBT']
			,	'href'                => 'mod=&table='
			,	'class'               => 'header_back'
			,	'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		,	'new' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['new']
			,	'href'                => 'act=create'
			,	'class'               => 'header_new'
			,	'attributes'          => 'onclick="Backend.getScrollOffset();"',
			)
		,	'all' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all']
			,	'href'                => 'act=select'
			,	'class'               => 'header_edit_all'
			,	'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		)
	,	'operations' => array(
			'edit' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['edit']
			,	'href'                => 'act=edit'
			,	'icon'                => 'edit.gif'
			)
		,	'delete' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['delete']
			,	'href'                => 'act=delete'
			,	'icon'                => 'delete.gif'
			,	'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			,	'button_callback'     => array('tl_iso_orderlimitnotification', 'deleteOrderLimitNotification'),
			)
		,	'show' => array(
				'label'               => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['show']
			,	'href'                => 'act=show'
			,	'icon'                => 'show.gif'
			)
		)
	)
	
,	'palettes' => array(
		'__selector__'			=> array('type')
	,	'default'				=> '{type_legend},type,category;{config_legend},price,qty,notification;{enabled_legend},enabled'
	,	'product'				=> '{type_legend},type,product;{config_legend},price,qty,notification;{enabled_legend},enabled'
	)

,	'fields' => array(

		'type' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['type']
		,	'exclude'                 => true
		,	'filter'                  => true
		,	'inputType'               => 'select'
		,	'default'				  => 'category'
		,	'options'        		  => array(
				'category' => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['category_values']['category']
			,	'product'  => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['category_values']['product']
			)
		,	'eval'                    => array( 'submitOnChange'=>true, 'tl_class'=>'w50' )
		)
	,	'category' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['category']
		,	'exclude'                 => true
		,	'inputType'               => 'select'
		,	'default'				  => 'product'
		,	'options_callback' 		  => array( 'tl_iso_orderlimitnotification', 'getCategories' )
		,	'eval'                    => array( 'submitOnChange'=>true, 'chosen'=>true, 'tl_class'=>'w50' )
		)
	,	'product' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['product']
		,	'exclude'                 => true
		,	'inputType'               => 'select'
		,	'default'				  => 'prod1'
		,	'options_callback' 		  => array( 'tl_iso_orderlimitnotification', 'getProducts' )
		,	'eval'                    => array( 'submitOnChange'=>true, 'chosen'=>true, 'tl_class'=>'w50' )
		)
	,	'price' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['price']
		,	'exclude'                 => true
		,	'inputType'               => 'text'
		,	'default'                 => 0
		,	'eval'                    => array( 'maxlength'=>255, 'rgxp'=>'price', 'tl_class'=>'clr w50' )
		)
	,	'qty' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['qty']
		,	'exclude'                 => true
		,	'inputType'               => 'text'
		,	'default'                 => 0
		,	'eval'                    => array( 'maxlength'=>255, 'rgxp'=>'digit', 'tl_class'=>'w50' )
		)
	,	'notification' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['notification']
		,	'exclude'                 => true
		,	'inputType'               => 'text'
		,	'default'                 => ''
		,	'eval'                    => array( 'tl_class'=>'clr' )
		)
	,	'enabled' => array(
			'label'                   => &$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification']['enabled']
		,	'exclude'                 => true
		,	'inputType'               => 'checkbox'
		),
	)
);


class tl_iso_orderlimitnotification extends Backend {


	/**
	 * Format rows
	 * @param array
	 * @return string
	 */
	public function generateLabel( $row=NULL ) {
	
		if( $row['type'] == 'product' ) {
		
			$aProducts = $this->getProducts();
			$name = $aProducts[ $row['product'] ];
		
		} else {
		
			$aCategories = $this->getCategories();
			$name = $aCategories[ $row['category'] ];
		}
		
		$label = sprintf(
			'<span style="color:#BBB;">[<span style="display: inline-block; width: 50px; text-align:center;">%s</span>]</span> %s'
		,	$GLOBALS['TL_LANG']['tl_iso_orderlimitnotification'][ ($row['qty'] ? 'qty' : 'price') ][0]
		,	$name
		);
	
		$image = 'published';

		if( !$row['enabled'] ) {
			$image = 'un'.$image;
		}

		return sprintf('<div class="list_icon" style="background-image:url(\'system/themes/%s/images/%s.gif\');">%s</div>', $this->getTheme(), $image, $label);
	}


	/**
	 * Generate a list of categories already used
	 * @return array
	 */
	public function getCategories() {
	
		$oCategories = NULL;
		$oCategories = $this->Database->prepare("SELECT pc.id, p.title FROM tl_iso_product_categories AS pc JOIN tl_page p ON (p.id = pc.page_id) GROUP BY pc.page_id ORDER BY p.title ASC")->execute();
		
		$aCategories = array();
		
		while( $oCategories->next() ) {
			$aCategories[ $oCategories->id ] = $oCategories->title;
		}
	
		return $aCategories;
	}

	
	/**
	 * Generate a list of products available
	 * @return array
	 */
	public function getProducts() {
	
		$oProducts = NULL;
		$oProducts = $this->Database->prepare("SELECT id, name, sku FROM tl_iso_products ORDER BY name ASC")->execute();
		
		$aProducts = array();
		
		while( $oProducts->next() ) {
			$aProducts[ $oProducts->id ] = $oProducts->name." (".$oProducts->sku.")";
		}
	
		return $aProducts;
	}


	/**
	 * Check permissions to edit table tl_iso_orderlimitnotification
	 * @return void
	 */
	public function checkPermission() {

		$this->import('BackendUser', 'User');

		// Return if user is admin
		if( $this->User->isAdmin ){
			return;
		}

		// Set root IDs
		if( !is_array($this->User->iso_bonuspoints) || count($this->User->iso_bonuspoints) < 1 ) {
			$root = array(0);
		} else {
			$root = $this->User->iso_bonuspoints;
		}

		$GLOBALS['TL_DCA']['tl_iso_orderlimitnotification']['list']['sorting']['root'] = $root;

		// Check permissions to add payment modules
		if( !$this->User->hasAccess('create', 'iso_payment_modulep') ) {
			$GLOBALS['TL_DCA']['tl_iso_orderlimitnotification']['config']['closed'] = true;
			unset($GLOBALS['TL_DCA']['tl_iso_orderlimitnotification']['list']['global_operations']['new']);
		}

		// Check current action
		switch( $this->Input->get('act') ) {
			case 'paste':
				break;

			case '':
			case 'create':
			case 'select':
				// Allow
				break;

			case 'edit':
				// Dynamically add the record to the user profile
				if( !in_array($this->Input->get('id'), $root) ) {

					$arrNew = $this->Session->get('new_records');

					if( is_array($arrNew['tl_iso_orderlimitnotification']) && in_array($this->Input->get('id'), $arrNew['tl_iso_orderlimitnotification']) ) {
					
						// Add permissions on user level
						if( $this->User->inherit == 'custom' || !$this->User->groups[0] ) {

							$objUser = $this->Database->prepare("SELECT iso_orderlimitnotification, iso_orderlimitnotificationp FROM tl_user WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->id);

							$arrPermissions = deserialize($objUser->iso_orderlimitnotificationp);

							if( is_array($arrPermissions) && in_array('create', $arrPermissions) ) {
								$arrAccess = deserialize($objUser->iso_orderlimitnotification);
								$arrAccess[] = $this->Input->get('id');

								$this->Database->prepare("UPDATE tl_user SET iso_orderlimitnotification=? WHERE id=?")
											   ->execute(serialize($arrAccess), $this->User->id);
							}

						// Add permissions on group level
						} elseif( $this->User->groups[0] > 0 ) {

							$objGroup = $this->Database->prepare("SELECT iso_orderlimitnotification, iso_orderlimitnotificationp FROM tl_user_group WHERE id=?")
													   ->limit(1)
													   ->execute($this->User->groups[0]);

							$arrPermissions = deserialize($objGroup->iso_orderlimitnotificationp);

							if( is_array($arrPermissions) && in_array('create', $arrPermissions) ) {
								$arrAccess = deserialize($objGroup->iso_orderlimitnotification);
								$arrAccess[] = $this->Input->get('id');

								$this->Database->prepare("UPDATE tl_user_group SET iso_orderlimitnotification=? WHERE id=?")
											   ->execute(serialize($arrAccess), $this->User->groups[0]);
							}
						}

						// Add new element to the user object
						$root[] = $this->Input->get('id');
						$this->User->iso_orderlimitnotification = $root;
					}
				}
				// No break;

			case 'copy':
			case 'delete':
			case 'show':
				if( !in_array($this->Input->get('id'), $root) || ($this->Input->get('act') == 'delete' && !$this->User->hasAccess('delete', 'iso_orderlimitnotificationp')) ) {
					$this->log('Not enough permissions to '.$this->Input->get('act').' order limit notification ID "'.$this->Input->get('id').'"', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;

			case 'editAll':
			case 'deleteAll':
			case 'overrideAll':
				$session = $this->Session->getData();
				if( $this->Input->get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'iso_orderlimitnotificationp') ) {
					$session['CURRENT']['IDS'] = array();
				} else {
					$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				}
				$this->Session->setData($session);
				break;

			default:
				if( strlen($this->Input->get('act')) ) {
					$this->log('Not enough permissions to '.$this->Input->get('act').' order limit notification', __METHOD__, TL_ERROR);
					$this->redirect('contao/main.php?act=error');
				}
				break;
		}
	}


	/**
	 * Return the delete notification button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function deleteOrderLimitNotification( $row, $href, $label, $title, $icon, $attributes ) {
		return ($this->User->isAdmin || $this->User->hasAccess('delete', 'iso_bonuspointsp')) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}
}

?>