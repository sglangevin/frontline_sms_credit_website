<?php
/**
 * @version		$Id: k2.php 566 2010-09-23 11:50:06Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_COMPONENT.DS.'helpers'.DS.'route'.'.php');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'permissions'.'.php');
require_once (JPATH_COMPONENT.DS.'helpers'.DS.'utilities'.'.php');

K2HelperPermissions::setPermissions();
K2HelperPermissions::checkPermissions();

$controller = JRequest::getWord('view', 'itemlist');

jimport('joomla.filesystem.file');

if (JFile::exists(JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php')) {
	require_once (JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
	$classname = 'K2Controller'.$controller;
	$controller = new $classname();
	$controller->execute(JRequest::getWord('task'));
	$controller->redirect();
}

echo "\n<!-- JoomlaWorks \"K2\" (v2.4.1) | Learn more about K2 at http://getk2.org -->\n\n";
