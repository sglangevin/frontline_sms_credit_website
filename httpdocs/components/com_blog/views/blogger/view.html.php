<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_2
 * @license    GNU/GPL
	*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 * @package    HelloWorld
 */

class BlogViewBlogger extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
		$db			=	& JFactory::getDBO();
		$user				= JFactory::getUser();
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'Blogger' );
		
		$bn = JRequest::getVar( 'bn', '', 'get', 'string' );
		$user_id = $this->getIDFromName($bn); ;
		/*
		if ( $user_id == '' || $user_id <= 0 ) {
			$return	= JRoute::_('index.php?option=com_blog&view=blog', false);
			// Redirect to a login form
			$mainframe->redirect( $return );
		}	*/	
		$options['user_id']	= $user_id;
 		$bloglists = $modelBlogList->fncGetBlogList($options);
		$BloggerDetails = $modelBlogList->fncGetMyAccountDetails($options);

		$pagination = $modelBlogList->getPagination($options);
		
		$this->assignRef('user'  , $user);
		$this->assignRef('pagination'  , $pagination);			
		$this->assignRef('BlogCommentCount'  , $BlogCommentCount);		
		$this->assignRef('BloggerDetails'  , $BloggerDetails);		
		$this->assignRef('modelBlogList'  , $modelBlogList);
		$this->assignRef('bloglists'  , $bloglists);
		parent::display($tpl);

	}
	
	/**
	 * function for Get Company ID form COmpany Page name in the URL
	 **/
	function getIDFromName($name)
	{	
		$db 		=& JFactory::getDBO();
		$query = "SELECT id FROM #__users WHERE name = '".$name."'";
 		$db->setQuery( $query );
		$id =  $db->loadResult();
		return ($id);
	}
	
 }
?>