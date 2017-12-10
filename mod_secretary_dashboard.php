<?php
/**
 * @version     1.0.0
 * @package     mod_secretary_dashboard
 * @copyright   Copyright (C) 2014. Alle Rechte vorbehalten.
 * @license     GNU General Public License version 2 oder später; siehe LICENSE.txt
 * @author      Fjodor Schäfer - https://www.schefa.com
 */

// no direct access
defined('_JEXEC') or die ;

$user = JFactory::getUser();
if (!$user->authorise('core.manage', 'com_secretary'))
{
	return;
}

define( 'SECRETARY_ADMIN_PATH', JPATH_ADMINISTRATOR .'/components/com_secretary');

// API
$mod_name = "mod_secretary_dashboard";
$mainframe = JFactory::getApplication();
$document = JFactory::getDocument();
JHTML::_('behavior.modal');

$update = false;
$xmlPath = SECRETARY_ADMIN_PATH.'/secretary.xml';
if(file_exists($xmlPath)) {
	$xml = JFactory::getXML( $xmlPath );		
	if(version_compare($xml->version,'2.0.0') < 0) {
		echo 'Please update to Secretary 2.0.0';
		return false;
	}
} else {
	echo 'Please install the latest version of Secretary';
	return false;
}

			
// Secretary
$language = JFactory::getLanguage();
$language->load('com_secretary', JPATH_ADMINISTRATOR);

// Get Business Data
$business	= array();
if(file_exists(SECRETARY_ADMIN_PATH.'/helpers/factory.php')) {
	require_once SECRETARY_ADMIN_PATH.'/helpers/factory.php';
	$business	= SecretaryFactory::getBusiness();
}

/******************************************
*************      Version    *************
*******************************************/

JLoader::register('SecretaryAccounts', JPATH_ADMINISTRATOR . '/components/com_secretary/helpers/accounts.php');
JLoader::register('SecretaryMessages', JPATH_ADMINISTRATOR . '/components/com_secretary/helpers/messages.php');
JLoader::register('SecretaryTimes', JPATH_ADMINISTRATOR . '/components/com_secretary/helpers/times.php');


$document->addStyleSheet(JURI::root().'media/secretary/fontawesome/css/font-awesome.min.css');
$document->addStyleSheet(JURI::base(true).'/modules/'.$mod_name.'/tmpl/css/style.css?v=2.2');
$document->addScript(JURI::base(true).'/modules/'.$mod_name.'/tmpl/js/masonry.js');

require (JModuleHelper::getLayoutPath($mod_name, 'default'));
