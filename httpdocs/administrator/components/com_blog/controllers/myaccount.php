<?php
/**
 * @version		$Id: banner.php 10878 2008-08-30 17:29:13Z willebil $
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

jimport( 'joomla.application.component.controller' );

/**
 * @package		Joomla
 * @subpackage	Banners
 */
class BlogControllermyaccount extends JController
{
	/**
	 * Constructor
	 */
	function __construct( $config = array() )
	{
		parent::__construct( $config );
		// Register Extra tasks
		$this->registerTask( 'add',			'edit' );
		$this->registerTask( 'apply',		'save' );
		$this->registerTask( 'resethits',	'save' );
		$this->registerTask( 'unpublish',	'publish' );
	}
 
  	function edit()
	{
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();
		$user_id = JRequest::getVar( 'id', '', 'get', 'int' );
  		
		
		$query = 'SELECT id'
		. ' FROM #__blog_myaccount '
		. ' WHERE user_id = '.$user_id;
		$db->setQuery( $query );
		$user_id =  $db->loadResult();
 		if($user_id <= 0 || $user_id == ''){
			$this->setRedirect( 'index.php?option=com_blog' );
		}
		$option = JRequest::getCmd('option');

		$lists = array();
 		$row =& JTable::getInstance('myposts', 'Table');
		
 		$row->load( $user_id );
 		if ($user_id) {
			$row->checkout( $user->get('id') );
		} else {
			$row->published = 1;
		}
		
 		// Build Client select list
		$sql = 'SELECT *'
		. ' FROM #__blog_myaccount'
		. ' WHERE  id = '.$user_id;
		$db->setQuery($sql);
		if (!$db->query())
		{
			$this->setRedirect( 'index.php?option=com_blog');
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}

 
 		require_once(JPATH_COMPONENT.DS.'views'.DS.'myaccount.php');
		BlogViewmyaccount::edit( $row, $lists );
	}

	/**
	 * Save method
	 */
	function save()
	{
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$id	= JRequest::getVar('id', '', 'post', 'int');
		$user_id	= JRequest::getVar('user_id', '', 'post', 'int');
		
		$this->setRedirect( 'index.php?option=com_blog&c=myaccount&task=edit&id='.$user_id );
		
		// Initialize variables
		$db =& JFactory::getDBO();

		$post	= JRequest::get( 'post' );
		
 		$post['content'] = JRequest::getVar('content', '', 'post', 'string', 2);
 		$row =& JTable::getInstance('myposts', 'Table');

 		if (!$row->bind( $post )) {
			return JError::raiseWarning( 500, $row->getError() );
		}

		// Resets clicks when `Reset Clicks` button is used instead of `Save` button
		$task = JRequest::getCmd( 'task' );
 
		if (!$row->check()) {
			return JError::raiseWarning( 500, $row->getError() );
		}

 		if (!$row->store()) {
			return JError::raiseWarning( 500, $row->getError() );
		}
				
		$row->checkin();

		switch ($task)
		{
			case 'apply':
				$link = 'index.php?option=com_blog&c=myaccount&task=edit&id='.$user_id ;
				break;
			case 'save':
			default:
				$link = 'index.php?option=com_blog';
				break;
		}
		$this->setRedirect( $link, JText::_( 'Item Saved' ) );
	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$id	= JRequest::getVar('id', '', 'post', 'int');
 		$this->setRedirect( 'index.php?option=com_blog');
		// Initialize variables
		$db		=& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$row	=& JTable::getInstance('myposts', 'Table');
		$row->bind( $post );
		$row->checkin();
	}
  }
?>