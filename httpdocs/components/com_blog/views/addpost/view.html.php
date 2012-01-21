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

class BlogViewaddpost extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
		$db			=	& JFactory::getDBO();
		$user				= JFactory::getUser();
		$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
		$id = JRequest::getVar( 'pid', 0, 'get', 'int' );
		
		if(trim($user->id) == '' || $user->id <= 0){
			$msg = JText::_( '&nbsp; Please login to add blog post' );
			$link = JRoute::_('index.php?option=com_user&view=login&return='.base64_encode(JRoute::_('index.php?option=com_blog&view=blog',false)), false);
			//$return	= 'index.php?option=com_user&view=login';
			$mainframe->redirect( $link, $msg );
		}
		
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'AddPost' );
		
		// Set Bread Crumb
		$pathway =& $mainframe->getPathWay();
		$pathway->addItem('Add Post', '');
		
		$options['id']	=  $id;
		$options['user_id']	=  $user->id;
		$BlogDetails = $modelBlogList->fncGetMyPostDetails($options);
		
 		if( (int)$id != '' && $BlogDetails->user_id != $user->id ){
			$msg 	= JText::_( '&nbsp; Invalid Request!' );
			$link	= JRoute::_('index.php?option=com_blog&view=blog',false);
			$mainframe->redirect( $link, $msg );
		}		
 
 		// Load the JEditor object
		$editor =& JFactory::getEditor();
		$user				= JFactory::getUser();
		
		$this->assignRef('user'  , $user);
		$this->assignRef('BlogDetails'  , $BlogDetails);
		$this->assignRef('editor',	$editor);
		JHTML::_('behavior.formvalidation');
		
		parent::display($tpl);

	}
}
?>