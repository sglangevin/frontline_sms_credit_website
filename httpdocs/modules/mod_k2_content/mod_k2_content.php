<?php
/**
 * @version		$Id: mod_k2_content.php 501 2010-06-24 19:25:30Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(dirname(__FILE__).DS.'helper.php');

// Params
$moduleclass_sfx = $params->get('moduleclass_sfx','');
$getTemplate = $params->get('getTemplate','Default');
$itemAuthorAvatarWidthSelect = $params->get('itemAuthorAvatarWidthSelect','custom');
$itemAuthorAvatarWidth = $params->get('itemAuthorAvatarWidth',50);
$itemCustomLinkTitle = $params->get('itemCustomLinkTitle');

// Get component params
$componentParams = & JComponentHelper::getParams('com_k2');

// User avatar
if($itemAuthorAvatarWidthSelect=='inherit'){
	$avatarWidth = $componentParams->get('userImageWidth');
} else {
	$avatarWidth = $itemAuthorAvatarWidth;
}

$items = modK2ContentHelper::getItems($params);

if(count($items)){
	require(JModuleHelper::getLayoutPath('mod_k2_content', $getTemplate.DS.'default'));
}
