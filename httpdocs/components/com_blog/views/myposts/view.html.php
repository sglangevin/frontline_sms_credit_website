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

class BlogViewMyPosts extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		$db			=	& JFactory::getDBO();
		// check for login --- Start here
		$user	 =& JFactory::getUser();
		if ( $user->id == '' || $user->id <= 0 ) {
			$return	= 'index.php?option=com_user&view=login';
			// Redirect to a login form
			$mainframe->redirect( $return );
		}
		// check for login --- End here
		$layout	= $this->getLayout();
		if( $layout == 'myaccount') {
			$this->_displaymyaccount($tpl);
			return;
		}
		
		// Set Bread Crumb
		$pathway =& $mainframe->getPathWay();
		$pathway->addItem('My Posts', '');
		
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'MyPosts' );
		
		$options['user_id']	=  $user->id;
		$bloglists = $modelBlogList->fncGetMyBlogList($options);

		$pagination = $modelBlogList->getMyPagination($options);
		
		$this->assignRef('user'  , $user);
		$this->assignRef('pagination'  , $pagination);			
		$this->assignRef('BlogCommentCount'  , $BlogCommentCount);			
		$this->assignRef('modelBlogList'  , $modelBlogList);
		$this->assignRef('bloglists'  , $bloglists);
		parent::display($tpl);
	}
	
	function _displaymyaccount(){
		global $mainframe, $option;
		$db			=	& JFactory::getDBO();
		// check for login --- Start here
		$user	 =& JFactory::getUser();
		if ( $user->id == '' || $user->id <= 0 ) {
			$return	= 'index.php?option=com_user&view=login';
			// Redirect to a login form
			$mainframe->redirect( $return );
		}
		// check for login --- End here
 
 		// Set Bread Crumb
		$pathway =& $mainframe->getPathWay();
		$pathway->addItem('My Account', '');
		
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'MyPosts' );
		
 		$options['user_id']	=  $user->id;
		$BlogDetails = $modelBlogList->fncGetMyAccountDetails($options);
  		
		$this->assignRef('user'  , $user);
 		$this->assignRef('BlogDetails'  , $BlogDetails);
		JHTML::_('behavior.formvalidation');
		parent::display($tpl);
	}
}
?>