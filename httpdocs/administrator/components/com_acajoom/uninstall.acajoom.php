<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
function com_uninstall() {

	if ( defined('JPATH_ROOT') ) {	// joomla 15
		define ('ACA_JPATH_ROOT' , JPATH_ROOT );
	} else {
		define( 'ACA_JPATH_ROOT', $GLOBALS['mosConfig_absolute_path']);
	}//endif

	require_once( ACA_JPATH_ROOT . '/components/com_acajoom/defines.php');

	 $return = removeBots();
	 $return = removeModule() AND $return ;
	 return $return;
 }
 function removeBots() {

		if(ACA_CMSTYPE) {
			$database =& JFactory::getDBO();
			$pathBots = ACA_JPATH_ROOT . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.'acajoom'.DIRECTORY_SEPARATOR;
		}
		else{
			$pathBots = ACA_JPATH_ROOT . DIRECTORY_SEPARATOR.'mambots'.DIRECTORY_SEPARATOR.'acajoom'.DIRECTORY_SEPARATOR;
			global $database;
		}

	 $bot_files = array('acajoombot.php', 'acajoombot.xml', 'index.html');
	 foreach ($bot_files as $bot_file) {
		 if (!unlink($pathBots . $bot_file)) {
			 echo '<p><b>Error (uninstall.acajoom.php-> line ' . __LINE__ . '):</b> Error deleting bot file ' . $bot_file . ' from bot directory.</p>';
		 }
	 }
	 if(file_exists(trim($pathBots,DIRECTORY_SEPARATOR))){
		 if (!rmdir(trim($pathBots,DIRECTORY_SEPARATOR))) {
			 echo '<br /> Error deleting the mambot acajoom directory.';
		 }
	 }

	$erro->err = "";
	 $bot_infos = array('acajoombot');
	 foreach ($bot_infos as $bot_info) {
	 	if(ACA_CMSTYPE){
			$query = 'DELETE FROM `#__plugins` WHERE element = \'' . $bot_info . '\'';
	 	}else{
	 		$query = 'DELETE FROM `#__mambots` WHERE element = \'' . $bot_info . '\'';
	 	}
		 $database->setQuery($query);
		 $database->query();
		 $erro->err .= $database->getErrorMsg();
	 }
	 
	 return true;
 }
 function removeModule() {

	if ( ACA_CMSTYPE ) {
		$database =& JFactory::getDBO();
	} else {
		global $database;
	}//endif

//	if(ACA_CMSTYPE){
//		if(!removeFolder(ACA_JPATH_ROOT .DS. 'modules'.DS .'mod_acajoom')){
//			echo '<br/>Error deleting Module at :'. ACA_JPATH_ROOT .DS. 'modules'.DS .'com_acajoom';
//		}
//	}
//	else{
//		 $module_files = array('mod_acajoom.php', 'mod_acajoom.xml');
//		 foreach ($module_files as $module_file) {
//			 if (!unlink(ACA_JPATH_ROOT . '/modules/' . $module_file)) {
//				 echo '<p><b>Error (uninstall.acajoom.php-> line ' . __LINE__ . '):</b> Error deleting module file ' . $module_file . ' from module directory.</p>';
//				 return false;
//			 }
//		 }
//	}

	// $query = "DELETE FROM `#__modules` WHERE `module` = 'mod_acajoom' " ;
	$query = "UPDATE `#__modules` SET `published`= 0 WHERE `module` LIKE '%acajoom%' " ;
	 $database->setQuery($query);
	 $database->query();
 }

 function removeFolder($fichier) {
	if (file_exists($fichier)){
		chmod($fichier,0777);
		if (is_dir($fichier)){
			$id_dossier = opendir($fichier);
			while($element = readdir($id_dossier)){
				if ($element != "." && $element != "..")
					unlink($fichier.DIRECTORY_SEPARATOR.$element);
			}
			closedir($id_dossier);
			return rmdir($fichier);
		}
	}
	return false;
}
