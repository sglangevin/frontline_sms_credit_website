<?php
 defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
function update( $action, $task ) {
	$update = new wupdate();
	$showListing = true;
	$showComplete = false;

	if ( ACA_CMSTYPE ) {	// joomla 15
		 $message = JRequest::getVar('message', '');
	} else {									//joomla 1x
		 $message = mosGetParam($_REQUEST, 'message', '');
	}//endif

	 if (ini_get('safe_mode')) {

	 } else {
	 	 @set_time_limit(60 * $GLOBALS[ACA.'script_timeout']);
	 }

	 /*if ((ini_get('allow_url_fopen') == false && !in_array('curl', get_loaded_extensions())) || ini_get('safe_mode') == true) {
		 echo _ACA_WARNING_1011;
		 return;
	 }*/

	 switch ($task) {
		 case ('doUpdate') :
			backHTML::_header( _ACA_MENU_UPDATE , 'update' , $message  , $task, $action );
			$update->doUpdate();
	     	$showListing = false;
	     	$showComplete = false;
	     	break;
		 case ('version') :
			$update->getVersion();
			break;
		 case ('complete') :
			$showComplete = true;
	     	$showListing = false;
			break;
		 case ('cancel') :
		 	compa::redirect('index2.php?option=com_acajoom&act=update');
	     	$showListing = false;
			break;
      	case ('cpanel'):
		 	compa::redirect('index2.php?option=com_acajoom');
	     	$showListing = false;
        	break;
      	case ('new1'):
	 		backHTML::_header( _ACA_MENU_UPDATE , 'backup.png' , $message , $task, $action  );
      		$message = acajoom::printYN( acajoom::upgrade_News1() ,  '<br />' ._ACA_IMPORT_SUCCESS.' Anjel data' , _ACA_ERROR );
	   		acajoom::resetUpgrade(1);
	   		echo '<br />'.$message;
        	break;
      	case ('new2'):
	 		backHTML::_header( _ACA_MENU_UPDATE , 'backup.png' , $message , $task, $action  );
      		$message = acajoom::printYN( acajoom::upgrade_News2() ,  '<br />' ._ACA_IMPORT_SUCCESS.' Letterman data' , _ACA_ERROR );
	     	acajoom::resetUpgrade(2);
	   		echo '<br />'.$message;
        	break;
      	case ('new3'):
	 		backHTML::_header( _ACA_MENU_UPDATE , 'backup.png' , $message , $task, $action  );
      		$message = acajoom::printYN( acajoom::upgrade_News3() ,  '<br />' ._ACA_IMPORT_SUCCESS.' YaNC data' , _ACA_ERROR );
	     	acajoom::resetUpgrade(3);
	   		echo '<br />'.$message;
        	break;
	 }

	 if ($showListing) {
		backHTML::_header( _ACA_MENU_UPDATE , 'backup.png' , $message , $task, $action  );
 		backHTML::_upgrade();
 		$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n" ;
		echo $forms['main'];
		backHTML::formStart('' , ''  ,'' );
		backHTML::showCompsList($update);
		$go[] = acajoom::makeObj('act', $action);
		backHTML::formEnd($go);
	 } elseif ($showComplete) {
		backHTML::_header( _ACA_MENU_UPDATE , 'backup.png' , $message , $task, $action  );
 		$forms['main'] = " <form action='index2.php' method='post' name='adminForm'> \n" ;
		echo $forms['main'];
		backHTML::formStart('' , ''  ,'' );
		backHTML::showUpdateOptions($update);
		$go[] = acajoom::makeObj('act', $action);
		backHTML::formEnd($go);
	 }
 }

