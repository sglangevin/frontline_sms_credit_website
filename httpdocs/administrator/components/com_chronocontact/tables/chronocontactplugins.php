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


class TableChronoContactPlugins extends JTable {
  // Declaration and initialisation of the instantiation variable
  // INT(11) AUTO_INCREMENT
  var $id=null;
  var $name=null;
  var $event=null;
  var $form_id=null;
  var $params=null;
  var $extra1=null;
  var $extra2=null;
  var $extra3=null;
  var $extra4=null;
  var $extra5=null;
  var $extra6=null;
  var $extra7=null;
  var $extra8=null;
  var $extra9=null;
  var $extra10=null;

  // The constructor is called by the instantiation
  function __construct( &$database ) {
    parent::__construct( '#__chrono_contact_plugins', 'id', $database );
  }
}
?>
