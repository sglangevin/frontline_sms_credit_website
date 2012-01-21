<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'base.php' );
require_once( MY_LIBRARY_PATH . DS . 'avatar.php' );

class MyblogShowBase extends MyblogBaseController
{

	// Build the content params object
	function _buildParams()
	{
		$mainframe	=& JFactory::getApplication();

		$params = new JParameter('');
		$params->def('link_titles', $mainframe->getCfg('link_titles'));
		$params->def('author', !$mainframe->getCfg('hideAuthor'));
		$params->def('createdate', !$mainframe->getCfg('hideCreateDate'));
		$params->def('modifydate', !$mainframe->getCfg('hideModifyDate'));
		$params->def('print', !$mainframe->getCfg('hidePrint'));
		$params->def('pdf', !$mainframe->getCfg('hidePdf'));
		$params->def('email', !$mainframe->getCfg('hideEmail'));
		$params->def('rating', $mainframe->getCfg('vote'));
		$params->def('icons', $mainframe->getCfg('icons'));
		$params->def('readmore', $mainframe->getCfg('readmore'));
		$params->def('popup', $mainframe->getCfg('popup'));
		$params->def('image', 1);
		$params->def('section', 0);
		$params->def('section_link', 0);
		$params->def('category', 0);
		$params->def('category_link', 0);
		$params->def('introtext', 1);
		$params->def('pageclass_sfx', '');
		$params->def('item_title', 1);
		$params->def('url', 1);
		$params->set('intro_only', 0);

		return $params;
	}
}