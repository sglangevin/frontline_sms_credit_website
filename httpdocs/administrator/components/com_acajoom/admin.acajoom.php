<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
if (!defined('DS'))  define( 'DS', DIRECTORY_SEPARATOR );

if ( defined('JPATH_ROOT') AND class_exists('JFactory')) {	// joomla 15
	global $mainframe;
	define( 'ACA_CMSTYPE', true );
	define ('ACA_JPATH_ROOT' , JPATH_ROOT . DS . 'administrator' );

	 $userid = JRequest::getInt('userid', 0, 'request');
	 $listId = JRequest::getInt('listid', 0, 'request');
	 $listType = JRequest::getInt('listype', 0, 'request');
	 $mailingId = JRequest::getInt('mailingid', 0, 'request');
	$action = JRequest::getString('act', '', 'request');
	$task = JRequest::getString('task', '', 'request');
	$message = JRequest::getString('message', '', 'request');
	$cid = JRequest::getVar('cid', array(), 'request');
	
	JHTML::_('behavior.tooltip');

	require_once( JPATH_ROOT . '/components/com_acajoom/defines.php');

} else {									//joomla 1x
	define( 'ACA_CMSTYPE', false );
	define( 'ACA_JPATH_ROOT', $GLOBALS['mosConfig_absolute_path'] . DS . 'administrator' );

	 $userid = intval(mosGetParam($_REQUEST, 'userid', 0));
	 $action = mosGetParam($_REQUEST, 'act', '');
	 $task = mosGetParam($_REQUEST, 'task', '');
	 $message = mosGetParam($_REQUEST, 'message', '');
	 $mailingId = mosGetParam($_REQUEST, 'mailingid', 0);
	 $listId = intval(mosGetParam($_REQUEST, 'listid', 0));
	 $listType = intval(mosGetParam($_REQUEST, 'listype', 0));
	 $cid = mosGetParam($_REQUEST, 'cid', array());

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/components/com_acajoom/defines.php');

}//endif

if( ACA_DEBUG ) {
	ini_set('display_errors',true);
	error_reporting(E_ALL);
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( WPATH_CLASS . 'class.acajoom.php');
require_once( WPATH_ADMIN . 'lists.acajoom.php');
require_once( WPATH_ADMIN . 'subscribers.acajoom.php');
require_once( WPATH_ADMIN . 'mailings.acajoom.php');
require_once( WPATH_ADMIN . 'update.acajoom.php');
require_once( WPATH_ADMIN . 'admin.acajoom.html.php' );
require_once( WPATH_ADMIN . 'lists.acajoom.html.php' );
require_once( WPATH_ADMIN . 'subscribers.acajoom.html.php' );
require_once( WPATH_ADMIN . 'mailings.acajoom.html.php' );
require_once( WPATH_ADMIN . 'config.acajoom.html.php' );


 if (!is_array( $cid )) {
	 $cid = array(0);
 }

if ( !ACA_CMSTYPE ) {	// joomla 15
	if ( !function_exists( 'sefRelToAbs' ) ) @include_once( ACA_JPATH_ROOT .'/includes/sef.php' );
}//endif

//echo '<br /> Action : ' . $action ;
//echo '<br /> Task : ' . $task ;

 switch ($action) {
	case ('list') :
		lists( $action, $task, $listId, $listType );
		break;
	case ('subscribers') :
		subscribers( $action, $task, $userid, $listId, $cid );
		break;
	case ('mailing') :
		mailing( $action, $task, $listId, $listType, $mailingId, $message );
		break;
	case ('statistics') :
		statistics( $listId, $listType, $mailingId, $message, $task, $action );
		break;
	case ('configuration') :
		if ($GLOBALS[ACA.'integration'] == '0'  OR $GLOBALS[ACA.'cb_integration'] =='0') {
			$xf = new xonfig();
			if (acajoom::checkCB())	$xf->loadConfig();
		}
		configuration( $action, $task );
		break;
	case ('update') :
		update( $action, $task );
		break;
	case ('about') :
		about($message, $task, $action);
		break;
	case ('cpanel') :
	case ('help') :
	case ('learn') :
		backHTML::controlPanel();
		break;
	case ('start') :
	    backHTML::_header( _ACA_MENU_CONF , 'acajoom_banner.png' , $message , $task, $action );
		backHTML::controlPanel();
		break;
	default :
		backHTML::controlPanel();
		break;
 }
backHTML::_footer();
return true;

 function configuration($action, $task ) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif

	$config = array();
	$redirect = true;
	$xf = new xonfig();
	if ( ACA_CMSTYPE ) {	// joomla 15
		$message = JRequest::getVar('message', '' );
	} else {									//joomla 1x
		$message = mosGetParam($_REQUEST, 'message', '');
	}//endif

	switch ($task) {
		 case ('sendQueue') :
				if (class_exists('auto'))
					echo acajoom::printYN( auto::processQueue( true, true ) , 'Queue processed' , _ACA_ERROR);
					auto::displayStatus();
	   			   backHTML::_header( _ACA_MENU_CONF , 'menu.png' , $message , $task, $action );
				 	configHTML::showConfigEdit($GLOBALS);
				break;
		 case ('reset') :
				$xf->update('next_autonews', '' );
				$xf->update('last_cron', '' );
				$xf->update('last_sub_update', '' );
				$query = "UPDATE #__acajoom_lists SET `next_date` = '0' WHERE list_type = 7";
				 $database->setQuery($query);
				 $database->query();
				echo acajoom::printYN( true , ' Smart-Newsletter counter reset successful! ' , _ACA_ERROR);
				backHTML::_header( _ACA_MENU_CONF , 'menu.png' , $message , $task, $action );
			 	configHTML::showConfigEdit($GLOBALS);
			 	break;
		 case ('syncUsers') :
				echo acajoom::printYN( subscribers::syncSubscribers() , _ACA_SYNC_USERS_SUCCESS , _ACA_ERROR);
				backHTML::_header( _ACA_MENU_CONF , 'menu.png' , $message , $task, $action );
				configHTML::showConfigEdit($GLOBALS);
			 	break;
		 case ('apply') :
				if ( ACA_CMSTYPE ) {	// joomla 15
					$clear_log = JRequest::getVar('clear_log', '0' );
				} else {									//joomla 1x
					$clear_log = mosGetParam($_REQUEST, 'clear_log', 0);
				}//endif
				if ($clear_log != 0) {
					unlink(ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'save_log_file']);
				}
				if (empty($config)) {
					$config = $_REQUEST['config'];
				}
				$message = strip_tags(acajoom::printYN($xf->saveConfig($config) , _ACA_CONFIG_UPDATED , _ACA_ERROR));
				$xf->updateActiveList();
			 	compa::redirect('index2.php?option=com_acajoom&act=configuration&message='.$message);
				break;
		 case ('save') :

			if ( ACA_CMSTYPE ) {	// joomla 15
				$clear_log = JRequest::getVar('clear_log', '0' );
			} else {									//joomla 1x
				$clear_log = mosGetParam($_REQUEST, 'clear_log', 0);
			}//endif
			if ($clear_log != 0) {
				@unlink(ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'save_log_file']);
			}
			if (empty($config)) {
				$config = $_REQUEST['config'];
			}
			$message = acajoom::printYN($xf->saveConfig($config) , _ACA_CONFIG_UPDATED , _ACA_ERROR);
			$xf->updateActiveList();
		 	backHTML::controlPanel();
		 	break;
		 case ('cancel') :
			compa::redirect('index2.php?option=com_acajoom');
			break;
       	case ('cpanel') :
	      backHTML::controlPanel();
     		break;
		 default :
		   backHTML::_header( _ACA_MENU_CONF , 'menu.png' , $message , $task, $action );
		 	configHTML::showConfigEdit($GLOBALS);
		 	break;
	 }
	 return true;
 }
 function statistics( $listId, $listType, $mailingId, $message, $task, $action ) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif

	$erro = new xerr( __FILE__ , __FUNCTION__ );

	switch ($task) {
		case ('edit') :
		case ('view') :
	$mailing = xmailing::getOneMailing(0, $mailingId, '', $new);
	$list = lists::getOneList($mailing->list_id);
	$listId = $list->id;
	$listType = $list->list_type;
			if ($mailingId != 0) {

				 $query = 'SELECT * FROM `#__acajoom_stats_global` WHERE `mailing_id` = \'' . $mailingId . '\'';
				 $database->setQuery($query);
					if ( ACA_CMSTYPE ) {	// joomla 15
						$globalStats = $database->loadObject();
					} else {									//joomla 1x
						$database->loadObject($globalStats);
					}//endif

				 $erro->err = $database->getErrorMsg();
				 if (empty($globalStats)) {
				 	$globalStats->html_sent = '';
				 	$globalStats->html_read = 0;
				 	$globalStats->text_sent = '';
				 }
				 $query = 'SELECT U.name, U.email, D.html, D.read FROM `#__acajoom_stats_details` as D ' .
				 		'LEFT JOIN `#__acajoom_subscribers` as U ON D.subscriber_id=U.id WHERE  D.mailing_id = \'' . $mailingId . '\'';
				 $database->setQuery($query);
				 $detailedStats = $database->loadObjectList();
				 $erro->err .= $database->getErrorMsg();
				$erro->show();
				 if (!$erro->E(__LINE__ ,  '8009')	) {
					 return false;
				 } else {

					 $html_read = array();
					 $html_unread = array();
					 $text = array();
					 foreach ($detailedStats AS $detailedStat) {
						 if($detailedStat->html == 1) {
							 if($detailedStat->read == 1){
								 $html_read[] = $detailedStat;
							 } else{
								 $html_unread[] = $detailedStat;
							 }
						 } else{
							 $text[] = $detailedStat;
						 }
					 }
        	 		backHTML::_header( _ACA_MENU_STATS , 'query.png' , $message , $task, $action );
					backHTML::showStatistics($list, $mailing, $globalStats, $html_read, $html_unread, $text, $listId);
				 }
			 } else {
				 echo '<p> Please select a mailings id.</p>';
				 return false;
			 }
		     break;
		 case ('cancel') :
			compa::redirect('index2.php?option=com_acajoom&act=statistics&listid=' . $listId);
			break;
     	case ('cpanel') :
	       backHTML::controlPanel();
    		break;
		default :
    	 	backHTML::_header( _ACA_MENU_STATS , 'query.png' , $message  , $task, $action );
			xmailing::showMailings($task, $action, $listId, $listType, '', false, _ACA_MENU_STATS_FOR);
	 }
 }
 function about( $message , $task, $action ) {
	 switch ($task) {
      	case ('cpanel') :
	     	backHTML::controlPanel();
        	break;
        default:
        	backHTML::_header( _ACA_MENU_ABOUT.' Acajoom' , 'credits.png' , $message , $task, $action );
			backHTML::about();
	 }
 }


