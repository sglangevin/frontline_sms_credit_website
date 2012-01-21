<?php 
/**
 * @version		$Id: mod_k2_tools.php 491 2010-06-17 13:48:01Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (dirname(__FILE__).DS.'helper.php');

// Params
$moduleclass_sfx = $params->get('moduleclass_sfx','');
$module_usage = $params->get('module_usage',0);

$authorAvatarWidthSelect = $params->get('authorAvatarWidthSelect','custom');
$authorAvatarWidth = $params->get('authorAvatarWidth',50);

$button = $params->get('button','');
$imagebutton = $params->get('imagebutton','');
$button_pos = $params->get('button_pos','left');
$button_text = $params->get('button_text',JText::_('Search'));
$width = intval($params->get('width',20));
$maxlength = $width > 20 ? $width : 20;
$text = $params->get('text',JText::_('search...'));

JHTML::_('behavior.mootools');
$document = &JFactory::getDocument();

// Output
switch ($module_usage) {

  case '0':
    $months = modK2ToolsHelper::getArchive($params);
    if (count($months)) {
      require (JModuleHelper::getLayoutPath('mod_k2_tools', 'archive'));
    }
    break;
    
  case '1':
		// User avatar
		if($authorAvatarWidthSelect=='inherit'){
			$componentParams = &JComponentHelper::getParams('com_k2');
			$avatarWidth = $componentParams->get('userImageWidth');
		} else {
			$avatarWidth = $authorAvatarWidth;
		}
    $authors = modK2ToolsHelper::getAuthors($params);
    require (JModuleHelper::getLayoutPath('mod_k2_tools', 'authors'));
    break;
    
  case '2':
    $calendar = modK2ToolsHelper::calendar($params);
    require (JModuleHelper::getLayoutPath('mod_k2_tools', 'calendar'));
    break;
    
  case '3':
    //if (JRequest::getVar('option') == 'com_k2' && (JRequest::getCmd('task') == 'category' || JRequest::getInt('id'))) {
    $breadcrumbs = modK2ToolsHelper::breadcrumbs($params);
    $path = $breadcrumbs[0];
    $title = $breadcrumbs[1];
    require (JModuleHelper::getLayoutPath('mod_k2_tools', 'breadcrumbs'));
    //}
    break;
    
  case '4':
  
    $output = modK2ToolsHelper::treerecurse($params, 0, 0, true);
    require (JModuleHelper::getLayoutPath('mod_k2_tools', 'categories'));
    break;
    
  case '5':
    echo modK2ToolsHelper::treeselectbox($params);
    break;
    
  case '6':
    if ($imagebutton) {
      $img = modK2ToolsHelper::getSearchImage($button_text);
    }
    require (JModuleHelper::getLayoutPath('mod_k2_tools', 'search'));
    break;
    
  case '7':
    $tags = modK2ToolsHelper::tagCloud($params);
    if (count($tags)) {
      require (JModuleHelper::getLayoutPath('mod_k2_tools', 'tags'));
    }
    break;
    
}
