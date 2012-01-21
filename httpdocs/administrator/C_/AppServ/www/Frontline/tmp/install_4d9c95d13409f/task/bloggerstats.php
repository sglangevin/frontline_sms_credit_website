<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class MyblogBloggerstatsTask extends MyblogBaseController
{
	function MyblogBloggerstatsTask()
	{
		$this->toolbar	= MY_TOOLBAR_BLOGGER;
	}
	
	function display()
	{
		$user	=& JFactory::getUser();
		$db		=& JFactory::getDBO();
		
		$db->setQuery("SELECT `description` FROM #__myblog_user WHERE `user_id` = '{$user->id}'");
		$desc	= $db->loadResult();
		
		if(!class_exists('AzrulJXTemplate'))
		{
			require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
		}
		
        myAddEditorHeader();
        
		$tpl	= new AzrulJXTemplate();

		$tpl->set('num_entries', myCountUserEntry($user->id));
				
		// Need to check if integrations with jomcomment is enabled.
		if(myGetJomComment())
		{
		    $tpl->set('jomcomment',true);
		    $tpl->set('num_comments', myCountUserComment($user->id));
		}
		
		$tpl->set('num_hits', myCountUserHits($user->id));
		$tpl->set('tags', myGetUsedTags($user->id));
		$tpl->set('myitemid', myGetItemId());
		$tpl->set('description', $desc);
		$tpl->set('postingRights', myGetUserCanPost());
		$html = $tpl->fetch(MY_TEMPLATE_PATH."/admin/blogger_stats.html");
		return $html;
	}
}