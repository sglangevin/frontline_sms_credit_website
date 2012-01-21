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
class BlogControllerComments extends JController
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
 	
	/**
	 * Display the list of banners
	 */
	function display()
	{
		global $mainframe;

		$db =& JFactory::getDBO();

		$context			= 'com_blog.blogcomments.list.';
		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		'b.comment_desc',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $context.'filter_catid',		'filter_catid',		'',			'int' );
		$filter_state		= $mainframe->getUserStateFromRequest( $context.'filter_state',		'filter_state',		'',			'word' );
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );

		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );

		$where = array();
		
		$pid = JRequest::getVar( 'pid', '', 'get', 'int' );
		
		$pid = ($pid) ? $pid : JRequest::getVar( 'pid', '', 'post', 'int' );
		
		if ( $pid ){
			if ( $pid > 0 ) {
				$where[] = 'b.post_id ='.$pid;
			}		
		}
		
		if ( $filter_state )
		{
			if ( $filter_state == 'P' ) {
				$where[] = 'b.published = 1';
			}
			else if ($filter_state == 'U' ) {
				$where[] = 'b.published = 0';
			}
		}

		if ($search) {
			$where[] = 'LOWER(b.comment_title) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}

		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', b.comment_desc';

		// get the total number of records
		$query = 'SELECT COUNT(*)'
		. ' FROM #__blog_comment AS b'
		. $where
		;
		$db->setQuery( $query );
		$total = $db->loadResult();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT b.*, u.name AS editor, user.name AS postedname'
		. ' FROM #__blog_comment AS b'
		. ' LEFT JOIN #__users AS u ON u.id = b.checked_out'
		. ' JOIN #__users AS user ON user.id = b.user_id'
 		. $where
		. $orderby
		;
		$db->setQuery( $query, $pageNav->limitstart, $pageNav->limit );
		$rows = $db->loadObjectList();

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir']	= $filter_order_Dir;
		$lists['order']		= $filter_order;

		// search filter
		$lists['search']= $search;

		require_once(JPATH_COMPONENT.DS.'views'.DS.'comments.php');
		BlogViewComments::BlogComments( $rows, $pageNav, $lists );
	}
	
	function edit()
	{
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();
		
		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', '', 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}

		$option = JRequest::getCmd('option');

		$lists = array();

		$row =& JTable::getInstance('comments', 'Table');

		$row->load( $cid[0] );
 		if ($cid[0]) {
			$row->checkout( $user->get('id') );
		} else {
			$row->published = 1;
		}
 		// Build Client select list
		$sql = 'SELECT * '
		. ' FROM #__blog_comment WHERE id = '.$cid[0];
		$db->setQuery($sql);
		if (!$db->query())
		{
			$this->setRedirect( 'index.php?option=com_blog&c=comments' );
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}

		require_once(JPATH_COMPONENT.DS.'views'.DS.'comments.php');
		BlogViewComments::editblogcomment( $row, $lists );
	}

	/**
	 * Save method
	 */
	function save()
	{
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_blog&c=comments' );
		
		$pid	= JRequest::getVar('pid', '', 'post', 'int');
	
		// Initialize variables
		$db =& JFactory::getDBO();

		$post	= JRequest::get( 'post' );
   		$post['comment_desc'] = JRequest::getVar('comment_desc', '', 'post', 'string', 2);
		
		$row =& JTable::getInstance('comments', 'Table');

 
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
				$link = 'index.php?option=com_blog&c=comments&pid='.$pid.'&task=edit&cid[]='. $row->id ;
				break;

			case 'save':
			default:
				$link = 'index.php?option=com_blog&c=comments&pid='.$pid;
				break;
		}

		$this->setRedirect( $link, JText::_( 'Item Saved' ) );
	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$pid	= JRequest::getVar('pid', '', 'post', 'int');
		$this->setRedirect( 'index.php?option=com_blog&c=comments&pid='.$pid );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$row	=& JTable::getInstance('comments', 'Table');
		$row->bind( $post );
		$row->checkin();
	}

	 
	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$pid	= JRequest::getVar('pid', '', 'post', 'int');
		$this->setRedirect( 'index.php?option=com_blog&c=comments&pid='.$pid );

		// Initialize variables
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$cid		= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$task		= JRequest::getCmd( 'task' );
		$publish	= ($task == 'publish');
		$n			= count( $cid );

		if (empty( $cid )) {
			return JError::raiseWarning( 500, JText::_( 'No items selected' ) );
		}

		JArrayHelper::toInteger( $cid );
		$cids = implode( ',', $cid );

		$query = 'UPDATE #__blog_comment'
		. ' SET published = ' . (int) $publish
		. ' WHERE id IN ( '. $cids.'  )'
		. ' AND ( checked_out = 0 OR ( checked_out = ' .(int) $user->get('id'). ' ) )'
		;
		$db->setQuery( $query );
		if (!$db->query()) {
			return JError::raiseWarning( 500, $db->getError() );
		}
		$this->setMessage( JText::sprintf( $publish ? 'Items published' : 'Items unpublished', $n ) );
	}

	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$pid	= JRequest::getVar('pid', '', 'post', 'int');
		$this->setRedirect( 'index.php?option=com_blog&c=comments&pid='.$pid );

 		// Initialize variables
		$db		=& JFactory::getDBO();
		$pid	= JRequest::getVar('pid', '', 'post', 'int');

		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );

		if ($n)
		{
 			$query = 'DELETE FROM #__blog_comment'
			. ' WHERE id = ' . implode( ' OR id = ', $cid );
			$db->setQuery( $query );
			if (!$db->query()) {
				JError::raiseWarning( 500, $db->getError() );
			} 
			
		}

		$this->setMessage( JText::sprintf( 'Items removed', $n ) );
	}
 }
?>