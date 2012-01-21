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

class BlogViewComments extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
 		$db			=	& JFactory::getDBO();
		$Itemid = JRequest::getVar( 'Itemid', '', 'get', 'int' );
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'Comments' );
		
		$user				= JFactory::getUser();
		
		// Set Bread Crumb
		$pathway =& $mainframe->getPathWay();
		$pathway->addItem('View Post', '');

		// Get blog Post details
		$options['id']	= JRequest::getVar( 'pid', '', 'get', 'int' );
		$BlogPostList	= $modelBlogList->fncGetBlogPost( $options );

		// Update Hists of this Post
		$modelBlogList->fncUpdatePostHits( $options );

		// Get commets lsit againt the post ID
		$BlogCommentList	= $modelBlogList->fncGetBlogComment( $options );
		$BlogCommentCount	= $modelBlogList->fncGetTotalComments( $options );
		if ( count($BlogPostList) <= 0 ) {
			$return	= JRoute::_( 'index.php?option=com_blog&view=blog&Itemid='.$Itemid,false);
			// Redirect to a login form
			$mainframe->redirect( $return );
		}
		
		// Get Post Hits
		$BlogPostHits	= $modelBlogList->fncGetTotalHitsofPosts( $options );
		$editor =& JFactory::getEditor();
		
		$this->assignRef('BlogPostList', $BlogPostList);
		$this->assignRef('BlogCommentList', $BlogCommentList);
		$this->assignRef('BlogCommentCount', $BlogCommentCount);
		$this->assignRef('BlogPostHits', $BlogPostHits);
		
		$this->assignRef('user'  , $user);
		$this->assignRef('editor',	$editor);
		JHTML::_('behavior.formvalidation');
		
 		parent::display($tpl);
	}
	
	
}
?>