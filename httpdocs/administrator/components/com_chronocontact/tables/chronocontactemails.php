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

jimport( 'joomla.application.component.controller' );


class TableChronoContactEmails extends JTable {
	var $emailid=null;
	var $formid=null;
	var $to=null;
	var $dto=null;
	var $subject=null;
	var $dsubject=null;
	var $cc=null;
	var $dcc=null;
	var $bcc=null;
	var $dbcc=null;
	var $fromname=null;
	var $dfromname=null;
	var $fromemail=null;
	var $dfromemail=null;
	var $replytoname=null;
	var $dreplytoname=null;
	var $replytoemail=null;
	var $dreplytoemail=null;
	var $enabled=null;
	var $params=null;
	var $template=null;

  // The constructor is called by the instantiation
  function __construct( &$database ) {
    parent::__construct( '#__chrono_contact_emails', 'emailid', $database );
  }
}
?>
