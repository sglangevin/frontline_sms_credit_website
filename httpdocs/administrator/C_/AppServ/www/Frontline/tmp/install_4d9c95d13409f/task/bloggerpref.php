<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'base.php' );

class MyblogBloggerprefTask extends MyblogBaseController
{

	function MyblogBloggerprefTask()
	{
		$this->toolbar	= MY_TOOLBAR_BLOGGER;
	}
	
	function display()
	{
		global $_MY_CONFIG;

		$my			=& JFactory::getUser();
		$mainframe	=& JFactory::getApplication();

		$user		=& JTable::getInstance( 'Blogger' , 'Myblog' );
		$user->load( $my->id );
		
		// Check if user submitted a profile change.
		if( JRequest::getMethod() == 'POST' )
		{
			$profile    	= JRequest::getVar('blog-subtitle','', 'POST');
			$feedburner		= JRequest::getVar('feedburnerURL','','POST');
			$title			= JRequest::getVar('blog-title', '', 'POST');
			$googlegears	= JRequest::getVar( 'googlegears' , 0 , 'POST' );
							
			$user->description	= strip_tags($profile);
			$user->feedburner	= $feedburner;
			$user->title		= strip_tags( $title );
			$user->googlegears	= $googlegears;
			if( $user->store() )
			{
				$mainframe->enqueueMessage( JText::_('BLOG ADMIN PROFILE UPDATED') ); 
			}
		}
		
// 		$titleColor	= JRequest::getVar('blog-title-color', '', 'POST');
// 		$descColor	= JRequest::getVar('blog-subtitle-color', '', 'POST');
		
// 		if(isset($titleColor) && !empty($titleColor) || isset($descColor) && !empty($descColor))
// 		{
// 			$style	= Array();
// 			
// 			if($titleColor)
// 				$style['blog-title-color']		= $titleColor;
// 				
// 			if($descColor)
// 				$style['blog-subtitle-color']	= $descColor;
// 			
// 			$style	= serialize($style);
// 			$user->style	= $style;
// 			$save   	= true;
// 		}

		$showFeedburner		= $_MY_CONFIG->get('userUseFeedBurner') ? true : false;
		$showGoogleGears	= $_MY_CONFIG->get('userUseGoGears' ) ? true : false;
		

		myAddEditorHeader();
		
		if(!class_exists('AzrulJXTemplate'))
		{
			include_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
		}
		$tpl = new AzrulJXTemplate();

		$tpl->set('showFeedburner', $showFeedburner);
		$tpl->set( 'showGoogleGears' , $showGoogleGears );
		$tpl->set( 'user' , array( $user ) );		
		$tpl->set('myitemid', myGetItemId());
		$tpl->set('postingRights', myGetUserCanPost());
		$tpl->set('description', stripslashes($user->description));
		$tpl->set('descColor', $user->getStyle('blog-subtitle-color'));
		$tpl->set('title', stripslashes($user->title));
		$tpl->set('titleColor', $user->getStyle('blog-title-color'));
		
		$html = $tpl->fetch(MY_TEMPLATE_PATH."/admin/blogger_profile.html");

		return $html;
	}
}
