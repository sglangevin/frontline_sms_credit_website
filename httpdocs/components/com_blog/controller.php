<?php
/**
 * @package    Joomla.Blog
 * @subpackage Components
 * @license    GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * Blog Component Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class BlogController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access    public
	 */
	function display()
	{
  		parent::display();
	}
	
	/**
	 * function for save_blogpost
	 **/
	function save_blogpost()
	{
		$db = & JFactory::getDBO();
		$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
		$user_id = JRequest::getVar( 'user_id', '', 'post', 'int' );
		$id = JRequest::getVar( 'id', 0, 'post', 'int' );
		$published = JRequest::getVar( 'published', 0, 'post', 'int' );
		$post_title = JRequest::getVar( 'post_title', '', 'post', 'string' );
		$user				= JFactory::getUser();
		
		if(trim($user->id) == '' || $user->id <= 0){
			$msg = JText::_( '&nbsp; Please login to add blog post' );
			$link = JRoute::_('index.php?option=com_blog&view=blog', false);
			$this->setRedirect( $link, $msg );  return;
		}
		if(trim($post_title) == ''){
			$msg = JText::_( '&nbsp; Please enter a Blog title.' );
			$link = JRoute::_('index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false);
			$this->setRedirect( $link, $msg );  return;
		}
		
		
		// Chekc valid file format for Upload
		if($_FILES["image"]["size"] > 0 ){
			$path = strtolower(strrchr($_FILES["image"]["name"], '.'));
			if(($path!='.jpeg') && ($path!='.jpg') && ($path!='.gif') && ($path!='.png')){
				$msg = JText::_( '&nbsp; Please attach Image in correct format(.jpg, .gif, .png only).' );
				$link = JRoute::_('index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false);
				$this->setRedirect( $link, $msg );return; exit(0);
			}
		}
			
		$model = $this->getModel('addpost');
		
		if($id <= 0){	
			$post_date =& JFactory::getDate();
			$_POST["post_date"] =  $post_date->toMySQL();
		}
		
		$post_update =& JFactory::getDate();
		$_POST["post_update"] =  $post_update->toMySQL();
		
		if ($model->store($post)) {
			if(!$id || $id <= 0){
				$id = $db->insertId();
			}
			
			// Upload Logo -Start Here
			$upload = $model->uploadlogo($id);
			if($upload == 'invalidformat'){
				$msg = JText::_( '&nbsp; Please attach Image in correct format.' );
				$link = JRoute::_('index.php?option=com_blog&view=addpost&Itemid='.$Itemid.'&id='.$id, false);
				$this->setRedirect( $link, $msg );return; exit(0);
			}
			// Upload Logo -End Here
			 
 			$msg = JText::_( 'Blog Post saved successfully.' );
			if($published == 0){
				$link = JRoute::_('index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false);
			}else{
				$link = JRoute::_('index.php?option=com_blog&view=comments&pid='.$id.'&Itemid='.$Itemid, false);
			}
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Saving Blog Post.' );
			$link = JRoute::_('index.php?option=com_blog&view=blog&Itemid='.$Itemid, false);
			$this->setRedirect($link, $msg);
		}
	}
	
	/**
	 * function for Save Comments
	 **/
	function save_BlogComment()
	{
		$db = & JFactory::getDBO();
		$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
		$id = JRequest::getVar( 'id', 0, 'post', 'int' );
		$comment_title = JRequest::getVar( 'comment_title', '', 'post', 'string' );
		$pid = JRequest::getVar( 'post_id', 0, 'post', 'int' );
		$user				= JFactory::getUser();
		
		if(trim($user->id) == '' || $user->id <= 0){
			$msg = JText::_( '&nbsp; Please login to write comment' );
			$link = JRoute::_('index.php?option=com_blog&view=comments&pid='.$pid.'&Itemid='.$Itemid, false);
			$this->setRedirect( $link, $msg );  return;
		}
		if(trim($comment_title) == ''){
			$msg = JText::_( '&nbsp; Please enter a Comment title.' );
			$link = JRoute::_('index.php?option=com_blog&view=comments&pid='.$pid.'&Itemid='.$Itemid, false);
			$this->setRedirect( $link, $msg );  return;
		}
		$model = $this->getModel('Comments');
		
		if($id <= 0){	
			$comment_date =& JFactory::getDate();
			$_POST["comment_date"] =  $comment_date->toMySQL();
		}
		
		$comment_update =& JFactory::getDate();
		$_POST["comment_update"] =  $comment_update->toMySQL();
		
		if ($model->store($post)) {
			if(!$id || $id <= 0){
				$id = $db->insertId();
			}
  			$msg = JText::_( 'Comment saved successfully.' );
			$link = JRoute::_('index.php?option=com_blog&view=comments&pid='.$pid.'&Itemid='.$Itemid, false);
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Saving comment. Please try after some time.' );
			$link = JRoute::_('index.php?option=com_blog&view=comments&pid='.$pid.'&Itemid='.$Itemid, false);
			$this->setRedirect($link, $msg);
		}
	}
	
	/**
	 * function for Show My Posts details
	 **/
	function myposts()
	{
		global $option, $mainframe;
		$db			=	& JFactory::getDBO();
		JRequest::setVar('layout', 'myposts');
		parent::display($tpl);
	}
	
	/**
	 * function for Show My Posts details
	 **/
	function myaccount()
	{
		global $option, $mainframe;
		$db			=	& JFactory::getDBO();
		JRequest::setVar('layout', 'myaccount');
		parent::display($tpl);
	}
	
	/**
	 * function for delet my poats and all comments under the post
	 **/
	function delete_mypost()
	{
		global $mainframe;
		$user				= JFactory::getUser();
		if(trim($user->id) == '' || $user->id <= 0){
			$msg = JText::_( '&nbsp; Please login to manage blog post' );
			$link = JRoute::_('index.php?option=com_blog&view=blog', false);
			$this->setRedirect( $link, $msg );  return;
		}
		$base = "./components/com_blog/Images/";
		$working_folder =$base."blogimages/";
		$id = JRequest::getVar( 'pid', '', 'get', 'int' );
		$Itemid = JRequest::getVar( 'Itemid', '', 'get', 'int' );
		$db =& JFactory::getDBO();
		$query = "SELECT id, user_id, post_image FROM #__blog_postings WHERE id = $id AND user_id = ".$user->id;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if($rows[0]->id){
			if (file_exists($working_folder."th".$rows[0]->post_image)) 
			{ 
				@unlink ($working_folder."th".$rows[0]->post_image);
			}
			$query = "DELETE FROM #__blog_postings WHERE id = ".$rows[0]->id." AND user_id = ".$user->id;
			$db->setQuery( $query );
			if (!$db->query())
			{
 				$link = JRoute::_('index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false);
				$this->setRedirect($link, $db->getErrorMsg());
			}else{
				$query = "DELETE FROM #__blog_comment WHERE post_id = ".$rows[0]->id." AND user_id = ".$user->id;
				$db->setQuery( $query );
				$db->query();
			}
			
			$link = JRoute::_('index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false);
			$msg = JText::_( 'Post Deleted Successfully!' );
 			$this->setRedirect($link, $msg);
		}
	}
	
	/**
	 * function for publishmypost
	 **/
	function publishmypost()
	{
		global $mainframe;
		$db =& JFactory::getDBO();
		$st = JRequest::getVar( 'st', '', 'get', 'int' );
		$post_id = JRequest::getVar( 'pid', '', 'get', 'int' );
		$Itemid = JRequest::getVar( 'Itemid', '', 'get', 'int' );
		$user				= JFactory::getUser();
 
 		$query = "UPDATE #__blog_postings SET published = '".$st."' WHERE id = '".$post_id."' AND user_id = '".$user->id."'";
		$db->setQuery( $query );
		if (!$db->query())
		{
			$link = JRoute::_('index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false);
			$this->setRedirect($link, $db->getErrorMsg());
		}else{
			$link = JRoute::_('index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false);
			$msg = ($st== 1)? JText::_( 'Post Published Successfully!' ) : JText::_( 'Post Unublished Successfully!' );
			$this->setRedirect($link, $msg);
		}
	}
		
	/**
	 *function for sabe Bloggers details
	 **/
	function savebloggerdetails(){
		$db = & JFactory::getDBO();
		$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
		$user_id = JRequest::getVar( 'user_id', '', 'post', 'int' );
		$id = JRequest::getVar( 'id', 0, 'post', 'int' );

		$title = JRequest::getVar( 'title', '', 'post', 'string' );
		$user				= JFactory::getUser();
		
		if(trim($user->id) == '' || $user->id <= 0){
			$msg = JText::_( '&nbsp; Please login to add blog post' );
			$link = JRoute::_('index.php?option=com_blog&view=blog', false);
			$this->setRedirect( $link, $msg );  return;
		}
		if(trim($title) == ''){
			$msg = JText::_( '&nbsp; Please enter a Blog title.' );
			$link = JRoute::_('index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false);
			$this->setRedirect( $link, $msg );  return;
		}
		
		
		// Chekc valid file format for Upload
		if($_FILES["image"]["size"] > 0 ){
			$path = strtolower(strrchr($_FILES["image"]["name"], '.'));
			if(($path!='.jpeg') && ($path!='.jpg') && ($path!='.gif') && ($path!='.png')){
				$msg = JText::_( '&nbsp; Please attach Image in correct format(.jpg, .gif, .png only).' );
				$link = JRoute::_('index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false);
				$this->setRedirect( $link, $msg );return; exit(0);
			}
		}
			
		$model = $this->getModel('myposts');
		
		if($id <= 0){	
			$post_date =& JFactory::getDate();
			$_POST["dateadded"] =  $post_date->toMySQL();
		}
		
		$post_update =& JFactory::getDate();
		$_POST["dateupdated"] =  $post_update->toMySQL();
		
		if ($model->store($post)) {
			if(!$id || $id <= 0){
				$id = $db->insertId();
			}
			
			// Upload Logo -Start Here
			$upload = $model->uploadlogo($id);
			if($upload == 'invalidformat'){
				$msg = JText::_( '&nbsp; Please attach Image in correct format.' );
				$link = JRoute::_('index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false);
				$this->setRedirect( $link, $msg );return; exit(0);
			}
			// Upload Logo -End Here
			 
 			$msg = JText::_( 'My Acoount saved successfully.' );
			if($published == 0){
				$link = JRoute::_('index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false);
			}else{
				$link = JRoute::_('index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false);
			}
			$this->setRedirect($link, $msg);
		} else {
			$msg = JText::_( 'Error Saving My Acoount.' );
			$link = JRoute::_('index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false);
			$this->setRedirect($link, $msg);
		}
	}
  }
?>