<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54

if ( ACA_CMSTYPE ) {
	require_once( JApplicationHelper::getPath( 'toolbar_html' ) );
	$doc =& JFactory::getDocument();
	$css  = ".icon-32-tool 	{ background-image: url( 'templates/khepri/images/menu/icon-16-cpanel.png' ); }";
	$css  .= ".icon-32-upload 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-export.png' ); }";
	$css  .= ".icon-32-forward 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-send.png' ); }";
	$css  .= ".icon-32-addusers 	{ background-image: url( 'templates/khepri/images/toolbar/icon-32-adduser.png' ); }";
	$doc->addStyleDeclaration($css);
} else {
	require_once( $mainframe->getPath( 'toolbar_html' ) );
	require_once( $mainframe->getPath( 'toolbar_default' ) );
}

if ( ACA_CMSTYPE ) {	// joomla 15
	 $listId = JRequest::getInt('listid', 0, 'request');
	 $listType = JRequest::getInt('listype', 0, 'request');
	$action = JRequest::getString('act', '', 'request');
	$task = JRequest::getString('task', '', 'request');

	if ( !isset($GLOBALS[ACA . 'titlteHeader']) ) $GLOBALS[ACA . 'titlteHeader'] = '';
	if ( !isset($GLOBALS[ACA . 'titlteImg']) ) $GLOBALS[ACA . 'titlteImg'] = '';
	JToolBarHelper::title( $GLOBALS[ACA . 'titlteHeader'] , $GLOBALS[ACA . 'titlteImg'] );

} else {									//joomla 1x
	$action = mosGetParam($_REQUEST, 'act', '');
	 $task = mosGetParam($_REQUEST, 'task', '');
	 $listId = intval(mosGetParam($_REQUEST, 'listid', 0));
	 $listType = intval(mosGetParam($_REQUEST, 'listype', 0));
}//endif


 switch ($action) {
	 case ('subscribers') :

	 	switch ($task) {
			case ('import') :
				menuAcajoom::IMPORT();
				break;
			case ('export') :
				menuAcajoom::EXPORT();
				break;
			case ('new') :
			case ('add') :
				menuAcajoom::NEWSUBSCRIBER();
				break;
			case ('show') :
				menuAcajoom::SHOWSUBSCRIBER();
				break;
			case ('doExport') :
			case ('cpanel') :

				break;
			default :
				menuAcajoom::REGISTERED();
				break;
	 	}
	 	break;
	 case ('list') :

	 	switch ($task) {
			case ('new') :
			case ('add') :
				menuAcajoom::NEW_LIST('');
				break;
			case ('edit') :
				menuAcajoom::EDIT_LIST('');
				break;
			case ('cpanel') :

				break;
			default:
				menuAcajoom::SHOW_LIST();
				break;
	 	}
	 	break;
	 case ('mailing') :

	 	switch ($task) {
			case ('edit') :
				menuAcajoom::NEWMAILING();
				break;
			case ('preview') :
				menuAcajoom::PREVIEWMAILING('show');
				break;
			case ('savePreview') :
				menuAcajoom::PREVIEWMAILING('show');
				break;
			case ('view') :
				menuAcajoom::CANCEL_ONLY('show');
				break;
			case ('publish') :
				menuAcajoom::CANCEL_ONLY('');
				break;
			case ('cpanel') :

				break;
			case ('show') :
			default :
				menuAcajoom::SHOW_MAILINGS();
				break;
	 	}
	 	break;
	 case ('configuration') :

	 	switch ($task) {
			case ('save') :
			case ('cpanel') :

				break;
			default :
				menuAcajoom::CONFIGURATION();
				break;
	 	}
	 	break;
	 case ('statistics') :

	 	switch ($task) {
			case ('edit') :
				menuAcajoom::CANCEL_ONLY('cancel');
				break;
			case ('cpanel') :

				break;
			default :

				menuAcajoom::STATISTICS();
				break;
	 	}
	 	break;
	 case ('update') :

	 	switch ($task) {
			case ('doUpdate'):
			case ('version'):
			case ('new1'):
			case ('new2'):
			case ('new3'):
				menuAcajoom::CANCEL_ONLY('show');
				break;
			case ('cpanel') :

				break;
			case ('complete') :
				menuAcajoom::DOUPDATE();
				break;
			case ('show') :
			default :
				menuAcajoom::UPDATE();
				break;
	 	}
	 	break;
	 case ('about') :

	 	switch ($task) {
			case ('cpanel') :

				break;
			default :
				menuAcajoom::ABOUT();
				break;
	 	}
	 	break;
	 default :
	 	break;
 }