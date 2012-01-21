<?php
/**
 * @version		$Id: form.php
 *
 * Helper file for forms
 *
 * @package		ghRecruit
 * @module      Admin
 * @author      Bob Janes aka GreyHead info@greyhead.net greyhead.net
 * @copyright	Copyright (C) 2008 Bob Janes. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Content Component Query Helper
 *
 * @static
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class ChronoContactHelperPlugin
{
    /**
     * Saves the plugin parameter array
     * NB packs array parameters as v1|v2|v3|. . .
     *
     * Redirects on completion
     */
    function save_conf( $option )
    {
        global $mainframe;
        $database =& JFactory::getDBO();
        $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );

        $row =& JTable::getInstance('chronocontactplugins', 'Table');
        if ( !$row->bind( $post ) ) {
            JError::raiseWarning(100, $row->getError());
            $mainframe->redirect( "index2.php?option=$option" );
        }

        $params = JRequest::getVar( 'params', '', 'post', 'array', array(0) );
        if ( is_array( $params ) ) {
            $txt = array();
            foreach ( $params as $k => $v ) {
                if ( is_array($v) ) {
                    $v = implode('|', $v);
                }
                $txt[] = "$k=$v";
            }
            $row->params = implode( "\n", $txt );
        }
        if ( !$row->store() ) {
            JError::raiseWarning(100, $row->getError());
            $mainframe->redirect( "index2.php?option=$option" );
        }
        $mainframe->redirect( "index2.php?option=".$option, "Config Saved" );
    }

    /**
     * Convert the PlugIn parameters to an object
     * and initialise and add any missing parameters
     *
     */
    function loadParams($row, $params_array)
    {
        $txt = array();
        foreach ( $params_array as $k => $v ) {
            $txt[] = "$k=$v";
        }
        $ini_string = implode( "\n", $txt );

        $params = new JParameter($ini_string);
        //echo '<div>$params->get("days"): '.print_r($params->get("days"), true).'</div>';
        $params->bind($row->params);
        //echo '<div>$params->get("days"): '.print_r($params->get("days"), true).'</div>';

        return $params;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & input field
     *
     * @param $title string title
     * @param $name string field name
     * @param $value string field value
     * @param $maxlength integer max input length
     * @param $attributes string additional input atributes
     * @param $tooltip string tooltip
     * @param $id string
     *
     */
    function createInputTD($title, $name, $value='', $maxlength='125',
        $attributes='', $tooltip='', $id=false)
    {
        // create an id from $name if not supplied
        $id = self::createId($name, $id);
        $return  = self::createTitleTD($title, $tooltip);
        $return .= "<td><input class='text_area' type='text' name='$name'
	    	id='$id' size='100' maxlength='$maxlength' $attributes
			value='".JText::_(htmlspecialchars($value, ENT_QUOTES))."' />
			</td>";
        return $return;
    }
    /**
     * Creates a title block of 4x<td> with tooltip and text
     *
     * @param $title string title
     * @param $tooltip string tooltip
     */
    function createTitleTD($title, $tooltip='')
    {
        $return = "";
        if ( $tooltip ) {
            $return .= "<td style='width:20px; padding-left:6px;'>".JHTML::_('tooltip', JText::_($tooltip) )."</td>";
        } else {
            $return .= "<td>&nbsp;</td>";
        }
        $return .= "<td width='100' align='right' class='key' style='font-weight:bold; white-space:nowrap;' >";
        $return .= JText::_("$title")."</td>";
        $return .= "<td>&nbsp;</td>";
        return $return;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & select drop-down
     *
     * @param $title string title
     * @param $name string field name
     * @param $selected string/array field value(s)
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     * @param $translate boolean apply JText?
     *
     */
    function createSelectTD($title, $name, $options, $selected='',
        $attributes='', $tooltip='', $id=false, $translate=false )
    {
        $id = self::createId($name, $id);
        if ( !is_array($selected) ) {
            $selected = explode(', ', $selected);
        }
        $return  =  self::createTitleTD($title, $tooltip);
        $return .= "<td>".JHTML::_('select.genericlist', $options,
            $name, $attributes, 'value', 'text',
            $selected, $id, $translate )."</td>";
        return $return;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & Yes?No radio buttons
     *
     * @param $title string title
     * @param $name string field name
     * @param $options - will be ignored
     * @param $selected string field value(s)
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     * @param $translate boolean apply JText?
     *
     */
    function createYesNoTD($title, $name, $options='', $selected='',
        $attributes='', $tooltip='', $id=false, $translate=false )
    {
        $id = self::createId($name, $id);
        $options = array('0' => 'No', '1' => 'Yes' );
        return self::createRadioTD($title, $name, $options,
            $selected, $attributes, $tooltip, $id, $translate);
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & radio button set
     *
     * @param $title string title
     * @param $name string field name
     * @param $options array buttons
     * @param $selected string field value(s)
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     * @param $translate boolean apply JText?
     *
     */
    function createRadioTD($title, $name, $options, $selected='',
        $attributes='', $tooltip='', $id=false, $translate=false )
    {
        $id = self::createId($name, $id);
        $return  = self::createTitleTD($title, $tooltip);
        $options_array = array();
        foreach ( $options as $k => $v ) {
            $options_array[] = JHTML::_('select.option', $k, $v);
        }
        $return .= "<td>".JHTML::_('select.radiolist', $options_array, $name,
            $attributes, 'value', 'text', $selected)."</td>";
        return $return;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & TextArea
     *
     * @param $title string title
     * @param $name string field name
     * @param $rows integer no of rows
     * @param $cols integer no of columns
     * @param $value string field value
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     *
     */
    function createTextareaTD($title, $name, $value='',
        $rows='8', $cols='61',
        $attributes='', $tooltip='', $id=false )
    {
        $id = self::createId($name, $id);
        $return  = self::createTitleTD($title, $tooltip);
        $return  ="<td>
			<textarea name='$name' id='$id' cols='$cols'
				rows='$rows' $attributes >$value</textarea></td>";
        return $return;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & Date picker
     *
     * @param $title string title
     * @param $name string field name
     * @param $selected string/array field value(s)
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     * @param $translate boolean apply JText?
     * @param $config string additional javascript options
     *
     */
    function createDateTD($title, $name, $selected='',
        $attributes='', $tooltip='', $id=false, $translate=false, $config=null )
    {
        $id = self::createId($name, $id);
        $return  = self::createTitleTD($title, $tooltip);
        $return .= "<td>".self::calendar($selected, $name,
        $name, '%d-%m-%Y %H:%M', 'style="width:120px;"', $config )."</td>";
        return $return;
    }

    /**
     * Create a 4x<td> row with tooltip, empty td, title & Time picker
     *
     * @param $title string title
     * @param $name string field name
     * @param $selected string field value as hh:mm
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     *
     */
    function createTimeTD($title, $name, $selected='',
        $attributes='', $tooltip='', $id='' )
    {
        $id = self::createId($name, $id);
        $return  = self::createTitleTD($title, $tooltip);
        $return .= "<td><input type='text' name='$name' id='$id' size='10'
                	value='' $attributes /></td>";
        $start = 0;
        if ( $selected ) {
            $time_array = explode(':', $selected);
            $start = $time_array[0] * 60 + $time_array[1];
        }
        $script = "
            window.addEvent('domready', function() {
                var spinner1 = new TimeSpinner($('$id'), {
                    increment: 5,
                    delay: 150
                },
                $start );
            });
            ";
        $doc =& JFactory::getDocument();
        $doc->addScriptDeclaration($script);
        return $return;
    }

    /**
     * Create a <td> row with tooltip, empty td, title & plain text
     *
     * @param $title string title
     * @param $text string value
     * @param $class string css class
     * @param $attributes string additional input attributes
     * @param $tooltip string tooltip
     * @param $id string
     * @param $translate boolean apply JText?
     *
     */
    function createTextTD($title, $text, $class='',
        $attributes='', $tooltip='', $id=false, $translate=false )
    {
		$return = '';
        $return = self::createTitleTD($title.":", $tooltip);
        if ( $class ) {
            $class = " class='$class'";
        }
        $return .= "<td $class >".JText::_($text)."</td>";
        return $return;
    }

    /**
     * Creates a series of hidden inputs
     * @param $hidden_array array name/value pairs
     *
     */
    function createHiddenArray($hidden_array){
        $return = array();
        foreach ($hidden_array as $name => $value ) {
            $return[] = self::createHidden($name, $value);
        }
        return implode('', $return);
    }

    /**
     * Creates a single hidden input
     *
     */
    function createHidden($name, $value )
    {
        return "<input type='hidden' name='$name' id='$name' value='$value' />";
    }
    /**
     * Creates an input id from a name & removes [ & ]
     *
     */
    function createId( $name, $id='' )
    {
        if ( !$id ) {
            $id = $name;
        }
        $id = str_replace('[', '', $id);
        $id = str_replace(']', '', $id);

        return $id;
    }
    /**
     * The function trims text to $length,
     * removes any punctuation in the stops array from the end
     * and appends $tail
     *
     * @param $text string
     * @param $length integer
     * @param $tail string
     */
    function trimText($text, $length='150', $tail=" . . .")
    {
        $text = trim($text);
        $txtl = strlen($text);
        if ( $txtl > $length ) {
            for ( $i = 1; $text[$length-$i] != " "; $i++ ) {
                if ( $i == $length ) {
                    return substr($text, 0, $length).$tail;
                }
            }
            $stops = array(',', '.', ' ', ';');
            for ( ; in_array($text[$length-$i], $stops); $i++ ) {;}
            $text = substr($text, 0, $length-$i+1 ) . $tail;
        }
        return $text;
    }
    /**
     * Displays a calendar control field
     * Modified version of Joomla calendar to allow config inputs
     *
     * @param    string    The date value
     * @param    string    The name of the text field
     * @param    string    The id of the text field
     * @param    string    The date format
     * @param    array    Additional html attributes
     */
    function calendar($value, $name, $id='',
        $format='%Y-%m-%d', $attributes=null, $config=null )
    {
        $id = self::createId($name, $id);
        $img_id = $id."_img";
        JHTML::_('behavior.calendar'); //load the calendar behavior
        if ( is_array($attributes) ) {
            $attributes = JArrayHelper::toString( $attributes );
        }
        $config_array = array(
        	'inputField' => "'$id'",
            'ifFormat' => "'$format'",
            'button' => "'$img_id'",
        	'align' => "'Tl'",
        	'singleClick' => "true",

        );
        if ( is_array($config) ) {
            $config_array = array_merge($config_array, $config);
        }
        $script = "
        	window.addEvent('domready', function() {Calendar.setup({";
        foreach ( $config_array as $k => $v ) {
            $script .= $k." : ".$v.", ";
        }
        $script .= "});});";
        $document =& JFactory::getDocument();
        $document->addScriptDeclaration($script);

        return "<input type='text' name='$name' id='$id'
        	value='".htmlspecialchars($value, ENT_COMPAT, 'UTF-8')."'
            $attributes.' />".
            "<img class='calendar'
           	src='".JURI::root(true)."/templates/system/images/calendar.png'
            alt='calendar' id='$img_id' />";
    }
}
?>