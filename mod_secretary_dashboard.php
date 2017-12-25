<?php
/**
 * @version     3.0.0
 * @package     com_secretary
 *
 * @author       Fjodor Schaefer (schefa.com)
 * @copyright    Copyright (C) 2015-2017 Fjodor Schaefer. All rights reserved.
 * @license      GNU General Public License version 2 or later.
 */

// no direct access
defined('_JEXEC') or die ;

$user = JFactory::getUser();
if (!$user->authorise('core.manage', 'com_secretary'))
{
	return;
}

// Attributes 
if(!defined('SECRETARY_ADMIN_PATH')) define('SECRETARY_ADMIN_PATH', JPATH_ADMINISTRATOR .'/components/com_secretary');
$mod_name = "mod_secretary_dashboard"; 
$document = JFactory::getDocument();
JHTML::_('behavior.modal');

// Version
$update = false;
$xmlPath = SECRETARY_ADMIN_PATH.'/secretary.xml';
if(file_exists($xmlPath)) {
	$xml = JFactory::getXML( $xmlPath );		
	if(version_compare($xml->version,'3.0.0') < 0) {
		echo 'Please update to Secretary 3.0.0';
		return false;
	}
} else {
	echo 'Please install the latest version of Secretary';
	return false;
}

			
// Language files
$language = JFactory::getLanguage();
$language->load('com_secretary', JPATH_ADMINISTRATOR);

// Get Business Data
$business	= array();
if(file_exists(SECRETARY_ADMIN_PATH.'/application/Secretary.php')) { 
    require_once SECRETARY_ADMIN_PATH .'/application/Secretary.php';
	$business	= \Secretary\Application::company();
}

$document->addStyleSheet(JURI::root().'media/secretary/fontawesome/css/font-awesome.min.css');
$document->addStyleSheet(JURI::base(true).'/modules/'.$mod_name.'/tmpl/css/style.css?v=3.1');
$document->addScript(JURI::base(true).'/modules/'.$mod_name.'/tmpl/js/masonry.js');

require (JModuleHelper::getLayoutPath($mod_name, 'default'));
