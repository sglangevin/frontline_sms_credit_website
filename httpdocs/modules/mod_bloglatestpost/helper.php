<?php
/**
* @version		$Id: helper.php 11299 2009-02-05
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class mod_bloglatestpostHelper
{
	/**
	 * function for Get Company ID form COmpany Page name in the URL
	 **/
	function getLatestBlogPostList($limit)
	{	
 		$db 		=& JFactory::getDBO();
		$query = "SELECT * FROM #__blog_postings WHERE published  = 1 ORDER BY post_date DESC LIMIT  ".$limit;
 		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}
	
	/**
	 *function for get the Total comments of a post
	 **/
 	/**
	 * function for Get total Comments
	 **/
	function fncGetTotalComments($id)
	{
		$db 		=& JFactory::getDBO();
 		// WHere conditions
		$wheres[] = 'comment.post_id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT COUNT(comment.id)
					FROM #__blog_comment AS comment LEFT JOIN #__users AS user ON comment.user_id = user.id
					WHERE comment.published = "1" AND '. implode( ' AND ', $wheres ).' ORDER BY comment.comment_date ASC';
 		$db->setQuery( $query );
		$count = $db->loadResult();
		return $count;
	}
}
?>