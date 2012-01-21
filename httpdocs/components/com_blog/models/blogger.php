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
class BlogModelBlogger extends JModel
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
	
	function getAboutUsDetails(  $options=array() )
	{
		$db 		=& JFactory::getDBO();
		$menu_id 	= @$options['menu_id'];
		$company_id = @$options['company_id'];
		$user_id 	= @$options['user_id'];
		
		// WHere conditions
		$wheres[] = 'menu_id  = ' . (int) $menu_id ;
		$wheres[] = 'company_id = ' . (int) $company_id;
		$wheres[] = 'user_id  = ' . (int) $user_id;
		
		$query = 'SELECT * FROM #__company_menu_aboutus WHERE ' . implode( ' AND ', $wheres );
		$aboutus = $this->_getList( $query );
		return @$aboutus[0];
	}
	
	
	/**
	 * Gets the Company Profile
	 * @return string The greeting to be displayed to the user
	 */
	function fncGetBlogList(  $options=array() )
	{
		global $mainframe, $option;
		
		$user_id = @$options['user_id'];
		$wheres[] = 'user_id  = '.(int) $user_id;
		
		$config = JFactory::getConfig();
		// Get the pagination request variables
 		
		$this->setState('limit', $mainframe->getUserStateFromRequest('com_blog.limit', 'limit', $config->getValue('config.list_limit'), 'int'));
		$this->setState('limitstart', JRequest::getVar('limitstart', 0, '', 'int'));
 
		// In case limit has been changed, adjust limitstart accordingly
		$this->setState('limitstart', ($this->getState('limit') != 0 ? (floor($this->getState('limitstart') / $this->getState('limit')) * $this->getState('limit')) : 0));

		$db		=& JFactory::getDBO();				
		$query	= "SELECT post.*, user.name AS postedby
				FROM #__blog_postings AS post LEFT JOIN #__users AS user ON post.user_id = user.id
				WHERE published = '1' AND ". implode( " AND ", $wheres )." ORDER BY post_date DESC";
		$bloglist = $this->_getList( $query, $this->getState('limitstart'), $this->getState('limit'));
		return @$bloglist;
	}
	
	// function for getTotal
	function getTotal( $options=array() )
	{
		$user_id = @$options['user_id'];
		$wheres[] = 'user_id  = '.(int) $user_id;
		$db		=& JFactory::getDBO();				
		$query = "SELECT * FROM #__blog_postings WHERE published = '1' AND ". implode( " AND ", $wheres )."  ORDER BY post_date DESC";
		$bloglist = $this->_getList( $query);
		$this->_total = count($bloglist);
		return $this->_total;
	}
	
	// Get pagination
	function getPagination($options)
    {
      // Lets load the content if it doesn't already exist
      if (empty($this->_pagination))
      {
         jimport('joomla.html.pagination');
         $this->_pagination = new JPagination( $this->getTotal($options), $this->getState('limitstart'), $this->getState('limit') );
    }
      return $this->_pagination;
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
	 * function for Get Post Details
	 **/
	function fncGetMyAccountDetails($options=array())
	{
		$db 		=& JFactory::getDBO();
 		$user_id	= @$options['user_id'];
		
		// WHere conditions
 		$wheres[] = 'account.user_id = ' . (int) $user_id;
		$wheres[] = 'account.status= 1';
		$wheres[] = 'account.published = 1';
		$wheres[] = 'account.user_id = myuser.id';
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT account.*, myuser.registerDate, myuser.lastvisitDate
					FROM #__blog_myaccount AS account, #__users AS myuser
					WHERE '. implode( ' AND ', $wheres );
 		$bloglist = $this->_getList( $query );
		return @$bloglist[0];		
	}
}
?>