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
class BlogControllerBlog extends JController
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
	 * function for Get total Comments
	 **/
	function fncGetTotalComments( $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		
		// WHere conditions
		$wheres[] = 'comment.post_id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT COUNT(comment.id)
					FROM #__blog_comment AS comment LEFT JOIN #__users AS user ON comment.user_id = user.id
					WHERE '. implode( ' AND ', $wheres ).' ORDER BY comment.comment_date ASC';
 		$db->setQuery( $query );
		$count = $db->loadResult();
		return $count;
	}
	
	/**
	 * Display the list of banners
	 */
	function display()
	{
		global $mainframe;

		$db =& JFactory::getDBO();

		$context			= 'com_blog.blog.list.';
		$filter_order		= $mainframe->getUserStateFromRequest( $context.'filter_order',		'filter_order',		'b.post_title',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $context.'filter_order_Dir',	'filter_order_Dir',	'',			'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $context.'filter_catid',		'filter_catid',		'',			'int' );
		$filter_state		= $mainframe->getUserStateFromRequest( $context.'filter_state',		'filter_state',		'',			'word' );
		$search				= $mainframe->getUserStateFromRequest( $context.'search',			'search',			'',			'string' );

		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart = $mainframe->getUserStateFromRequest( $context.'limitstart', 'limitstart', 0, 'int' );

		$where = array();

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
			$where[] = 'LOWER(b.post_title) LIKE '.$db->Quote( '%'.$db->getEscaped( $search, true ).'%', false );
		}

		$where		= count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '';
		$orderby	= ' ORDER BY '. $filter_order .' '. $filter_order_Dir .', b.post_title';

		// get the total number of records
		$query = 'SELECT COUNT(*)'
		. ' FROM #__blog_postings AS b'
		. $where
		;
		$db->setQuery( $query );
		$total = $db->loadResult();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $total, $limitstart, $limit );

		$query = 'SELECT b.*, u.name AS editor, user.name AS postedname, my.user_id as my_user_id'
		. ' FROM #__blog_postings AS b' 
		. ' LEFT JOIN #__blog_myaccount AS my ON my.user_id = b.user_id '
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

		require_once(JPATH_COMPONENT.DS.'views'.DS.'blog.php');
		BlogViewBlog::Blog( $rows, $pageNav, $lists );
	}
	
	function edit()
	{
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();

		if ($this->_task == 'edit') {
			$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
			$cid	= array((int) $cid[0]);
		} else {
			$cid	= array( 0 );
		}

		$option = JRequest::getCmd('option');
		$lists = array();

		$row =& JTable::getInstance('addpost', 'Table');

		$row->load( $cid[0] );

		if ($cid[0]) {
			$row->checkout( $user->get('id') );
		} else {
			$row->published = 1;
		}
		
		
 		// Build Client select list
		$sql = 'SELECT * '
		. ' FROM #__blog_postings WHERE id = '.$cid[0];
		$db->setQuery($sql);
		if (!$db->query())
		{
			$this->setRedirect( 'index.php?option=com_blog' );
			return JError::raiseWarning( 500, $db->getErrorMsg() );
		}

		require_once(JPATH_COMPONENT.DS.'views'.DS.'blog.php');
		BlogViewBlog::editblogpost( $row, $lists );
	}

	/**
	 * Save method
	 */
	function save()
	{
		global $mainframe;

		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_blog' );

		// Initialize variables
		$db =& JFactory::getDBO();

		$post	= JRequest::get( 'post' );
  		$post['post_desc'] = JRequest::getVar('post_desc', '', 'post', 'string', 2);
		
 
		$row =& JTable::getInstance('addpost', 'Table');

 
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
				$link = 'index.php?option=com_blog&task=edit&cid[]='. $row->id ;
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

		$this->setRedirect( 'index.php?option=com_blog' );

		// Initialize variables
		$db		=& JFactory::getDBO();
		$post	= JRequest::get( 'post' );
		$row	=& JTable::getInstance('addpost', 'Table');
		$row->bind( $post );
		$row->checkin();
	}

	 
	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_blog' );

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

		$query = 'UPDATE #__blog_postings'
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
		
		$this->setRedirect( 'index.php?option=com_blog' );

		$base = "../components/com_blog/Images/";
		$working_folder =$base."blogimages/";
		// Initialize variables
		$db		=& JFactory::getDBO();
		$cid	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$n		= count( $cid );
		JArrayHelper::toInteger( $cid );

		if ($n)
		{
			for($i=0; $i < $n; $i++){ 
				$query = "SELECT post_image FROM #__blog_postings WHERE id = ".$cid[$i];
				$db->setQuery( $query );
				$rows = $db->loadObjectList();
				if (file_exists($working_folder."th".$rows[0]->post_image)) 
				{ 
					@unlink($working_folder."th".$rows[0]->post_image);
				}
 			}
			$query = 'DELETE FROM #__blog_postings'
			. ' WHERE id = ' . implode( ' OR id = ', $cid );
			$db->setQuery( $query );
			if (!$db->query()) {
				JError::raiseWarning( 500, $db->getError() );
			}else{
				$query = 'DELETE FROM #__blog_comment WHERE post_id = ' . implode( ' OR post_id = ', $cid );
				$db->setQuery( $query );
				$db->query();
			}
			
			
		}

		$this->setMessage( JText::sprintf( 'Items removed', $n ) );
	}
 }
?>