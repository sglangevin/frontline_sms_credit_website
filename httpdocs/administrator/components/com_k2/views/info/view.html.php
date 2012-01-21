<?php
/**
 * @version		$Id: view.html.php 538 2010-08-04 13:08:29Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewInfo extends JView
{

	function display($tpl = null) {

		jimport ( 'joomla.filesystem.file' );
		$user = & JFactory::getUser();
		$db = & JFactory::getDBO();
		$db_version = $db->getVersion();
		$php_version = phpversion();
		$server = $this->get_server_software();
		$gd_check = extension_loaded('gd');
		$mb_check = extension_loaded('mbstring');

		$media_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2');
		$attachments_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments');
		$categories_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'categories');
		$galleries_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries');
		$items_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items');
		$users_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'users');
		$videos_folder_check = is_writable(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos');
		$cache_folder_check = is_writable(JPATH_ROOT.DS.'cache');

		$this->assignRef('server',$server);
		$this->assignRef('php_version',$php_version);
		$this->assignRef('db_version',$db_version);
		$this->assignRef('gd_check',$gd_check);
		$this->assignRef('mb_check',$mb_check);

		$this->assignRef('media_folder_check',$media_folder_check);
		$this->assignRef('attachments_folder_check',$attachments_folder_check);
		$this->assignRef('categories_folder_check',$categories_folder_check);
		$this->assignRef('galleries_folder_check',$galleries_folder_check);
		$this->assignRef('items_folder_check',$items_folder_check);
		$this->assignRef('users_folder_check',$users_folder_check);
		$this->assignRef('videos_folder_check',$videos_folder_check);
		$this->assignRef('cache_folder_check',$cache_folder_check);

		JToolBarHelper::title(JText::_('Information'), 'k2.png');
		JToolBarHelper::preferences('com_k2', '500', '600');

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories');
		JSubMenuHelper::addEntry(JText::_('Tags'), 'index.php?option=com_k2&view=tags');
		JSubMenuHelper::addEntry(JText::_('Comments'), 'index.php?option=com_k2&view=comments');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_k2&view=users');
		JSubMenuHelper::addEntry(JText::_('User Groups'), 'index.php?option=com_k2&view=userGroups');

		if ($user->gid > 23) {
			JSubMenuHelper::addEntry(JText::_('Extra Fields'), 'index.php?option=com_k2&view=extraFields');
			JSubMenuHelper::addEntry(JText::_('Extra Field Groups'), 'index.php?option=com_k2&view=extraFieldsGroups');
		}

		JSubMenuHelper::addEntry(JText::_('Information'), 'index.php?option=com_k2&view=info', true);

		parent::display($tpl);
	}

	function get_server_software()
	{
		if (isset($_SERVER['SERVER_SOFTWARE'])) {
			return $_SERVER['SERVER_SOFTWARE'];
		} else if (($sf = getenv('SERVER_SOFTWARE'))) {
			return $sf;
		} else {
			return JText::_( 'n/a' );
		}
	}

}
