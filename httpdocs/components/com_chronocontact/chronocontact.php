<?php
/**
 * CHRONOFORMS version 3.1
 * Copyright (c) 2006 Chrono_Man, ChronoEngine.com. All rights reserved.
 * Author: Chrono_Man (ChronoEngine.com)
 * See readme.html.
 * Visit http://www.ChronoEngine.com for regular update and information.
 **/

/* ensure that this file is called by another file */
defined('_JEXEC') or die('Restricted access');

/**
 * Load the HTML class
 */
require_once( JApplicationHelper::getPath( 'front_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );

require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
//load chronoforms classes
require_once( JPATH_COMPONENT.DS.'libraries'.DS.'chronoform.php');
require_once( JPATH_COMPONENT.DS.'libraries'.DS.'mails.php');
require_once( JPATH_COMPONENT.DS.'libraries'.DS.'customcode.php');
require_once( JPATH_COMPONENT.DS.'libraries'.DS.'chronoformuploads.php');
require_once( JPATH_COMPONENT.DS.'libraries'.DS.'plugins.php');




jimport( 'joomla.application.component.controller' );
global $mainframe;
$CFDBO =& JFactory::getDBO();
$formname = JRequest::getVar( 'chronoformname');
if ( !$formname ) {
	$params =& $mainframe->getPageParameters('com_chronocontact');
	$formname = $params->get('formname');
}

$MyForm =& CFChronoForm::getInstance($formname);

if($MyForm->formparams('dbconnection') == "Yes"){
	eval ("?>".$MyForm->formrow->dbclasses);
}

$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
/**
 * Main switch statement
 */
switch( $task ) {
	case 'send':
		uploadandmail();
		break;
	case 'extra':
		doextratask();
		break;
	default:
		showform($posted);
		break;
}
/**
 * End of main page
 *
 */

/**
 * Display the form for entry
 *
 */
function showform($posted)
{
    global $mainframe;
	$database =& JFactory::getDBO();

    $formname = JRequest::getVar( 'chronoformname');
	if ( !$formname ) {
		$params =& $mainframe->getPageParameters('com_chronocontact');
		$formname = $params->get('formname');
	}
    $MyForm =& CFChronoForm::getInstance($formname);
	$MyForm->showForm($formname, $posted);
    //HTML_ChronoContact::showform( $MyForm->formrow, $posted);
}

/**
 * Respond to a submitted form
 *
 */
function uploadandmail()
{
    global $mainframe;
	$database =& JFactory::getDBO();
	$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
	
	// Block SPAM through the submit URL
	if(!JRequest::checkToken()){
		echo "You are not allowed to access this URL";
		return;
	}
	if ( empty($posted) ) {
		echo "You are not allowed to access this URL directly, POST array is empty";
		return;
	}

	//Load Chronoforms Classes
	$formname = JRequest::getVar( 'chronoformname');
	if ( !$formname ) {
		$params =& $mainframe->getPageParameters('com_chronocontact');
		$formname = $params->get('formname');
	}
    $MyForm =& CFChronoForm::getInstance($formname);
	$MyFormData = $MyForm->getForm(JRequest::getVar( 'chronoformname'));
	if($MyFormData){
		//fine
	}else{
		$mainframe->enqueueMessage('Error processing this form, form was not loaded!');
		return;
	}
	
	if(JRequest::getVar('action') == 'extra'){
		$extraid = JRequest::getVar( 'extraid');
		$MyForm->doExtra($MyForm->formrow->name, $extraid, $posted);
	}
	
	$MyForm->submitForm($MyForm->formrow->name);
}

function doextratask(){
	global $mainframe;
	$database =& JFactory::getDBO();
	$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
	$formname = JRequest::getVar( 'chronoformname');
	if ( !$formname ) {
		$params =& $mainframe->getPageParameters('com_chronocontact');
		$formname = $params->get('formname');
	}
    $MyForm =& CFChronoForm::getInstance($formname);
	$extraid = JRequest::getVar( 'extraid');
	$MyForm->doExtra($formname, $extraid, $posted);
}
?>