<?php
/**
 * Hello Model for Hello World Component
 * 
 * @package    Joomla
 * @subpackage Components
 * @license    GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla
 * @subpackage Components
 */
class BlogModelcomments extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		
 	}
	/**
	 * Gets the Company Profile
	 * @return string The greeting to be displayed to the user
	 */
	function fncGetBlogPost(  $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		
		// WHere conditions
		$wheres[] = 'post.id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT post.*, user.name AS postedby
					FROM #__blog_postings AS post LEFT JOIN #__users AS user ON post.user_id = user.id
					WHERE post.published = "1" AND '. implode( ' AND ', $wheres );
 		$bloglist = $this->_getList( $query );
		return @$bloglist[0];
	}
	
	/**
	 * Gets the Company Profile
	 * @return string The greeting to be displayed to the user
	 */
	function fncGetBlogComment(  $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		
		// WHere conditions
		$wheres[] = 'comment.post_id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT comment.*, user.name AS commentedby
					FROM #__blog_comment AS comment LEFT JOIN #__users AS user ON comment.user_id = user.id
					WHERE comment.published = "1" AND '. implode( ' AND ', $wheres ).' ORDER BY comment.comment_date ASC';
 		$commentlist = $this->_getList( $query );
		return @$commentlist;
	}
	
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
		$row =& $this->getTable();
		$data = JRequest::get( 'post' );
		$data['comment_desc'] = JRequest::getVar('comment_desc', '', 'post', 'string', 2);
		// Bind the form fields to the Add form
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the Add Blog record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the post details table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}
		return true;
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
					WHERE comment.published = "1" AND '. implode( ' AND ', $wheres ).' ORDER BY comment.comment_date ASC';
 		$db->setQuery( $query );
		$count = $db->loadResult();
		return $count;
	}
	
	/**
	 * function for Get total Comments
	 **/
	function fncGetTotalHitsofPosts( $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		
		// WHere conditions
		$wheres[] = 'post.id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT post.post_hits
					FROM #__blog_postings AS post
					WHERE post.published = "1" AND '. implode( ' AND ', $wheres );
		$blogpostHit = $this->_getList( $query );
		return @$blogpostHit[0];
	}
	
		/**
	 * function for Get total Comments
	 **/
	function fncUpdatePostHits( $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		
		// WHere conditions
		$wheres[] = 'id = ' . (int) $id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'UPDATE #__blog_postings SET post_hits = post_hits+1
					WHERE published = "1" AND '. implode( ' AND ', $wheres );
		$db->setQuery( $query );
		if (!$db->query()) {
			//JError::raiseError(500, $db->getErrorMsg() );
		}
	}


 }
?>