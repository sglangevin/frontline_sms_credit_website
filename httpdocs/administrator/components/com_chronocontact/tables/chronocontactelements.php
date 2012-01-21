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


class TableChronoContactElements extends JTable {
  // Declaration and initialisation of the instantiation variable
  // INT(11) AUTO_INCREMENT
  var $id=null;
  var $placeholder=null;
  var $desc=null;
  var $code=null;

  // The constructor is called by the instantiation
	function __construct( &$database ) {
    	parent::__construct( '#__chrono_contact_elements', 'id', $database );
	}
}
?>
