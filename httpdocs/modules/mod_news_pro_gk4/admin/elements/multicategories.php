<?php

/**
* JElementMultiSection - additional element for module XML file
* @package Joomla!
* @Copyright (C) 2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.0 $
**/
 
// access denied
defined('JPATH_BASE') or die();
 
class JElementMultiCategories extends JElement
{
	// name of element
	var $_name = 'MultiCategories';
	// function to create an element
	function fetchElement($name, $value, &$node, $control_name)
	{
        // Base name of the HTML control.
        $ctrl  = $control_name .'['. $name .']';
        // Construct an array of the HTML OPTION statements.
        $options = array ();
        // creating database instance
        $db =& JFactory::getDBO();
        // generating query
		$db->setQuery("SELECT c.title AS name, c.id AS id FROM #__categories AS c WHERE c.published = 1 AND c.section NOT LIKE 'com_%'");
 		// getting results
   		$results = $db->loadObjectList();
     	// iterating
        foreach ($results as $option)
        {
            $val   = $option->id;
            $text  = $option->name;
            $options[] = JHTML::_('select.option', $val, JText::_($text));
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
        return JHTML::_('select.genericlist', $options, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );
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