<?php
/*
/**
* CHRONOFORMS version 3.0 stable
* Copyright (c) 2006 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
* See readme.html.
* Visit http://www.ChronoEngine.com for regular update and information.
**/

/* ensure that this file is called from another file */
defined('_JEXEC') or die('Restricted access'); 
require_once( JApplicationHelper::getPath( 'toolbar_html' ) );
switch($task) {
	case "add":
	case "edit":
	case "applychanges":
		menuChronoContact::MENU_Edit();
		break;
	case "viewdata":
	case "editdata":
		menuChronoContact::MENU_Show();
		break;
	case "createtable":
	case "restore1":
	case "adminview":
	case "submitadminform":
	case "form_wizard":
	case "wizardedit":
	case "transform":
		menuChronoContact::MENU_Cancel();
		break;
	case "show":
	case "deleterecord":
	case "cancelview":
		menuChronoContact::MENU_Show2();
		break;
	case 'config':
		MENUChronoContact::CONFIG_MENU();
		break;
	case 'menu_creator':
	case 'menu_save':
		MENUChronoContact::CREATE_MENU();
		break;
	case 'menu_remover':
	case 'menu_delete':
		MENUChronoContact::DELETE_MENU();
		break;
	case 'wizard_elements':
	case 'deleteelement':
	case 'cancelelement':
	case 'saveelement':
		MENUChronoContact::MENU_WizardElements();
		break;
	case 'newelement':
	case 'editelement':
	case 'applyelement':
		MENUChronoContact::MENU_EditElements();
		break;
	default:
		if(strpos("x".$task,"plugin_")){
			menuChronoContact::MENU_Plugins_2();
		}else{
			menuChronoContact::MENU_Default();
		}
		break;
}
?>