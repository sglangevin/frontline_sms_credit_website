<?php
defined('_JEXEC') OR defined('_VALID_MOS') or die('...Direct Access to this location is not allowed...');

### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
if(!defined('ACA_JPATH_ROOT')){
	if ( defined('JPATH_ROOT') AND class_exists('JFactory')) {	// joomla 15
		global $mainframe;
		define ('ACA_JPATH_ROOT' , JPATH_ROOT );
	} else {
		define( 'ACA_JPATH_ROOT', $GLOBALS['mosConfig_absolute_path']);
	}//endif
}

require_once( ACA_JPATH_ROOT . '/components/com_acajoom/defines.php');

if (file_exists(ACA_JPATH_ROOT . '/administrator/components/com_acajoom/classes/class.acajoom.php')) {
	require_once(ACA_JPATH_ROOT . '/administrator/components/com_acajoom/classes/class.acajoom.php');
} else {
	die ("Acajoom Module\n<br />This module needs the Acajoom component.");
}

$acaModule = new aca_module();
echo $acaModule->normal($params);
