<?php

/**
* JElementK2MultiCategories - additional element for module XML file
* @package News Show Pro GK4
* @Copyright (C) 2009-2010 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 4.0.0 $
**/
 
// access denied
defined('JPATH_BASE') or die();
 
class JElementK2Tags extends JElement
{
	// name of element
	var $_name = 'K2Tags';
	// Construct an array of the HTML OPTION statements.
	var $_options = array();
	// function to create an element
	function fetchElement($name, $value, &$node, $control_name)
	{
        // Base name of the HTML control.
        $ctrl  = $control_name .'['. $name .']';
        // creating database instance
        $db =& JFactory::getDBO();
        // generating query
		$db->setQuery("SELECT t.name AS name, t.id AS id FROM #__k2_tags AS t WHERE published = 1 ORDER BY t.name ASC");
 		// getting results
   		$results = $db->loadObjectList();
     	
		if(count($results)) {
			// iterating
			$temp_options = array();
			
			foreach ($results as $item) {
				array_push($temp_options, array($item->id, $item->name));	
			}
			
			foreach ($temp_options as $option) {
   	    	   $this->_options[] = JHTML::_('select.option', $option[0], JText::_($option[1]));
        	}		
			// Construct the various argument calls that are supported.
	        $attribs       = ' ';
	        if ($v = $node->attributes( 'size' )) $attribs .= 'size="'.$v.'"';
	        if ($v = $node->attributes( 'class' )) $attribs .= 'class="'.$v.'"';
	        else $attribs .= 'class="inputbox"';
	        // if multiselection enabled
			if ($m = $node->attributes( 'multiple' ))
	        {
	            $attribs .= ' multiple="multiple"';
	            $ctrl .= '[]';
	        }
	        // Render the HTML SELECT list.
	        return JHTML::_('select.genericlist', $this->_options, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );	
		} else {
			// Render the HTML SELECT list.
	        return '<strong>K2 is not installed or any K2 tags are available.</strong><input id="paramsk2_tags" type="hidden" name="'.$control_name.$name.'" value="-1" />';	
		}
	}
 	// bind function to save
    function bind( $array, $ignore = '' )
    {
        if (key_exists( 'field-name', $array ) && is_array( $array['field-name'] )) {
        	$array['field-name'] = implode( ',', $array['field-name'] );
        }
 
        return parent::bind( $array, $ignore );
    }
}