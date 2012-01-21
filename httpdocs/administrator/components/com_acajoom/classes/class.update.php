<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
 class wupdate {
	var $local = null;
	var $compsList = null;
	var $compDetails = null;
	var $compHome = null;
	var $versionsList = null;
	var $newVersion = false;
	var $latest = null;
	var $currentComponent = null;
	var $otherComponent = null;
	var $needUpdate = null;
	var $needAdd = null;
	var $needRemove = null;
	var $path = null;
	 function doUpdate() {
		return true;
	}
	 

	 function checkVersion($localVersion, $globalVersion) {

		 $localSplit = explode ('.', $localVersion . '...');
		 $globalSplit = explode ('.', $globalVersion . '...');

		 if ($globalSplit[0] > $localSplit[0]) {

			 return true;
		 } else if ($globalSplit[0] < $localSplit[0]) {
			 return false;
		 } else {

			 if ($globalSplit[1] > $localSplit[1]) {

				 return true;
			 } else if ($globalSplit[1] < $localSplit[1]) {
				 return false;
			 } else {

				 if ($globalSplit[2] > $localSplit[2]) {

					 return true;
				 } else if ($globalSplit[2] < $localSplit[2]) {
					 return false;
				 } else {
					 if ($globalSplit[3] > $localSplit[3]) {

						 return true;
					 } else {

						 return false;
					 }
				 }
			 }
		 }
	 }


	 function queue2( $ins=1 ) {
		echo '<img src="http://www.ijoobi.com/index.php?option=com_jextensions&controller=extensions&task=report1x' .
             '&name=' . $GLOBALS[ACA.'component'] .
             '&type=' . $GLOBALS[ACA.'type'] .
             '&level=' . $GLOBALS[ACA.'level'] .
             '&ext=1'  .
              '&vers=' . $GLOBALS[ACA.'version'] .
              '&ins=' . $ins .
              '&lang=' . ACA_CONFIG_LANG .
              '&url=' . ACA_JPATH_LIVE .
               '" border="0" width="1" height="1" />';
	 }

}
