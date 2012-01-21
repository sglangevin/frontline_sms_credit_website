<?php
/**
 * @version		$Id: mod_k2_login.php 503 2010-06-24 21:11:53Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (dirname( __FILE__ ).DS.'helper.php');

$moduleclass_sfx = $params->get('moduleclass_sfx','');
$userGreetingText = $params->get('userGreetingText','');
$userAvatarWidthSelect = $params->get('userAvatarWidthSelect','custom');
$userAvatarWidth = $params->get('userAvatarWidth',50);

// Legacy params
$greeting = 0;

JHTML::_('behavior.mootools');
JHTML::_('behavior.modal');

$type 	= modK2LoginHelper::getType();
$return	= modK2LoginHelper::getReturnURL($params, $type);
$user		= &JFactory::getUser();

// User avatar
if($userAvatarWidthSelect=='inherit'){
	$componentParams = &JComponentHelper::getParams('com_k2');
	$avatarWidth = $componentParams->get('userImageWidth');
} else {
	$avatarWidth = $userAvatarWidth;
}

// Load the right template
if ($user->guest){
	// OpenID stuff (do not edit)
	if(JPluginHelper::isEnabled('authentication', 'openid')){
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = '
			var JLanguage = {};
			JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';
			JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';
			JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';
			var modlogin = 1;
		';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
	}
	
	// Get user stuff (do not edit)
	$usersConfig = &JComponentHelper::getParams( 'com_users' );

	require(JModuleHelper::getLayoutPath('mod_k2_login', 'login'));
} else {
	$user->profile = modK2LoginHelper::getProfile($params);
	$user->numOfComments = modK2LoginHelper::countUserComments($user->id);
	require(JModuleHelper::getLayoutPath('mod_k2_login', 'userblock'));
}
