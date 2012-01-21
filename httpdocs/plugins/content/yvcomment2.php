<?php

/**
 * yvComment plugin, part of yvComment - the first native Joomla! 1.5 Commenting Solution
 * @version		$Id: yvcomment2.php $
 * @package yvCommentPlugin
 * @(c) 2007-2010 yvolk (Yuri Volkov), http://yurivolkov.com. All rights reserved.
 * @license GPL
 **/

// no direct access
defined('_JEXEC') or die('Restricted access');

if (!class_exists('yvCommentHelper')) {
	$path = JPATH_SITE . DS . 'components' . DS . 'com_yvcomment' . DS . 'helpers.php';
	if (file_exists($path)) {
		require_once ($path);
	}
}
if (!class_exists('yvCommentHelper')) {
	// No yvComment Component
	$mainframe->enqueueMessage(
	$_ExtensionName . ' is installed, but "<b>yvComment Component</b>" is <b>not</b> installed. Please install it to use <a href="http://yurivolkov.com/Joomla/yvComment/index_en.html" target="_blank">yvComment solution</a>.<br/>' . '(yvComment Plugin version="' . yvCommentPluginVersion . '")',
  	'error');
	
	$str1 = "class yvCommentPlugin {" 
	. " public function __construct($subject, $config = array()){ }" 
	. "	}";
	eval($str1);	
}

/**
 * For additional Comment Type (e.g. N ) you should change in this code:
 * 1. Class name: plgContentyvcomment change to plgContentyvcommentN
 * 2. $CommentTypeIdStatic value: set to N instead of 1
 */
class plgContentyvcomment2 extends yvCommentPlugin {
	public static $CommentTypeIdStatic = 2;
	// Main Release Level. Extensions for the same Release are compatible
	private static $_Release = '1.25';
	private static $_ExtensionName = 'yvCommentPlugin';
	
	public static function initializeMe() {
		$Ok = false;
		if (strtoupper( $_SERVER['REQUEST_METHOD'] ) == 'HEAD') {
			// hide, cause something works wrong in this case
		} else {
			global $mainframe;
			$Ok = yvCommentHelper::VersionChecks(self::$_ExtensionName, self::$_Release);
		}
		if ($Ok) {
			yvCommentHelper::$ContentPluginsImported = true;
			// Import library dependencies
			jimport('joomla.event.plugin');
			self::$hide = false;
		}
	}
	
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for
	 * plugins because func_get_args ( void ) returns a copy of all passed arguments
	 * NOT references.  This causes problems with cross-referencing necessary for the
	 * observer design pattern.
	 */
	public function plgContentyvcomment2(& $subject, $config = array()) {
		$config['comment_type_id'] = self::$CommentTypeIdStatic;
		parent :: __construct($subject, $config);
		//echo 'plgContentyvcomment2 type=' . $this->CommentTypeId . '; position="' . $this->_PluginPlace . '"<br/>';
	}
}

if (class_exists('yvCommentHelper')) {
	plgContentyvcomment2::initializeMe();
}

?>