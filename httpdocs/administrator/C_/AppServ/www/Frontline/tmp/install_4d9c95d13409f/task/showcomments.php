<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.html.pagination' );
class MyblogShowcommentsTask extends MyblogBaseController
{
	function MyblogShowcommentsTask()
	{
		$this->toolbar	= MY_TOOLBAR_BLOGGER;
	}
	
	function display()
	{
		global $_MY_CONFIG;
		
		// get List of content id by this blogger
		$secid = $_MY_CONFIG->get('postSection');
		
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();
		$db->setQuery( "SELECT `id` FROM #__content WHERE `created_by`='{$user->id}' AND sectionid='{$secid}' " );
		$contents = $db->loadObjectList();
		$sections = array();
		
		foreach($contents as $row)
		{
			$sections[] = $row->id;
		}
			
		// Make sure that there are indeed some article written by the author
		if(!empty($sections))
		{
			$limitstart	= JRequest::getVar( 'limitstart' , '' , 'GET' );
			$limit		= $limitstart ? "LIMIT $limitstart, ".MY_DEFAULT_LIMIT : 'LIMIT '.MY_DEFAULT_LIMIT;
			$db->setQuery("SELECT * FROM #__jomcomment WHERE (`option`='com_content' OR `option`='com_myblog') AND `contentid` IN (". implode(',', $sections).") ORDER BY `date` DESC $limit");
			$comments = $db->loadObjectList();
			
			// Add pagination
			$db->setQuery( "SELECT count(*) FROM #__jomcomment WHERE (`option`='com_content' OR `option`='com_myblog') AND `contentid` IN (". implode(',', $sections).")" );
			$total		= $db->loadResult();
			$pagination	= new JPagination( $total , $limitstart , $limit );
			$pagination	= $pagination->getPagesLinks();
		}
		else
		{
			$pagination = '';
			$comments = array();
		}
		
		for($i = 0; $i < count($comments); $i ++)
		{
			if($comments[$i]->referer == '')
			{
				$comments[$i]->referer	= myGetPermalinkURL($comments[$i]->contentid) . '#comment-' . $comments[$i]->id;
			}
		}
		myAddEditorHeader();
		
		$tpl = new AzrulJXTemplate();
		$tpl->set('myitemid', myGetItemId());
		$tpl->set('pagination', $pagination);
		$tpl->set('comments', $comments);
		$tpl->set('postingRights', myGetUserCanPost());
		$html = $tpl->fetch(MY_TEMPLATE_PATH."/admin/comments.html");
		
		return $html;
	}
}