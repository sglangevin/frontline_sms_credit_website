<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

define('MY_COM_PATH', 			JPATH_ROOT . DS . 'components' . DS . 'com_myblog' );
define('MY_COM_LIVE', 			rtrim( JURI::root() , '/' ) .'/components/com_myblog' );
define('MY_ADMIN_COM_PATH', 	JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_myblog' );
define('MY_LIBRARY_PATH', 		MY_COM_PATH . '/libraries');
define('MY_TASK_PATH', 			MY_COM_PATH . '/task');
define('MY_FRONTVIEW_PATH', 	MY_COM_PATH . '/frontview');
define('MY_FRONTADMIN_PATH', 	MY_COM_PATH . '/frontadmin');
define('MY_TEMPLATE_PATH', 		MY_COM_PATH . "/templates");
define('MY_MODEL_PATH',			MY_COM_PATH . '/model');
define('MY_CACHE_PATH',			JPATH_ROOT . DS . 'components' . DS . 'libraries' . DS . 'cmslib' . DS . 'cache' );

define('MY_DEFAULT_LIMIT', 30);

define('MY_TOOLBAR_HOME', 	 	'home');
define('MY_TOOLBAR_BLOGGER', 	'blogger');
define('MY_TOOLBAR_ACCOUNT', 	'account');
define('MY_TOOLBAR_TAGS',		'category');
define('MY_TOOLBAR_SEARCH',		'search');
define('MY_TOOLBAR_FEED',		'feed');
