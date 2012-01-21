<?php
/**
 * @version		$Id: admin.banners.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla
 * @subpackage	Banners
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Make sure the user is authorized to view this page
$user = & JFactory::getUser();
if (!$user->authorize( 'com_blog', 'manage' )) {
	#$mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
}

// Set the table directory
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_blog'.DS.'tables');

$controllerName = JRequest::getCmd( 'c', 'blog' );

if($controllerName == 'comments') {
	JSubMenuHelper::addEntry(JText::_('Blog Posts'), 'index.php?option=com_blog');
	JSubMenuHelper::addEntry(JText::_('Comments'), '', true );
 }if($controllerName == 'myaccount') {
 	JSubMenuHelper::addEntry(JText::_('Blogger Details'), '', true );
 } else if($controllerName == 'blog') {
	JSubMenuHelper::addEntry(JText::_('Blog Posts'), 'index.php?option=com_blog', true );
 }

switch ($controllerName)
{
	default:
		$controllerName = 'blog';
		// allow fall through

	case 'blog' :
	case 'comments':
	case 'myaccount':
		// Temporary interceptor
		$task = JRequest::getCmd('task');
		if ($task == 'listcomments') {
			$controllerName = 'comments';
		}
		if ($task == 'listmyaccount') {
			$controllerName = 'myaccount';
		}
		require_once( JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php' );
		$controllerName = 'BlogController'.$controllerName;

		// Create the controller
		$controller = new $controllerName();

		// Perform the Request task
		$controller->execute( JRequest::getCmd('task') );

		// Redirect if set by the controller
		$controller->redirect();
		break;
}
?>