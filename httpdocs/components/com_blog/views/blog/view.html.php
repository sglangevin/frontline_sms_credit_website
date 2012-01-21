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

class BlogViewBlog extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
		$db			=	& JFactory::getDBO();
		$user				= JFactory::getUser();
		// Push a model into the view
		$model			= &$this->getModel();
		$modelBlogList	= &$this->getModel( 'Blog' );
		
		$bloglists = $modelBlogList->fncGetBlogList();

		$pagination = $modelBlogList->getPagination();
		
		$this->assignRef('user'  , $user);
		$this->assignRef('pagination'  , $pagination);			
		$this->assignRef('BlogCommentCount'  , $BlogCommentCount);			
		$this->assignRef('modelBlogList'  , $modelBlogList);
		$this->assignRef('bloglists'  , $bloglists);
		parent::display($tpl);

	}
 }
?>