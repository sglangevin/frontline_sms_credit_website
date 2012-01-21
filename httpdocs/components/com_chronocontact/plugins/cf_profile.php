<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_profile
{
    //the next four fields must be defined for every plugin
    var $result_TITLE = "Profile page";
    var $result_TOOLTIP = "Load data from any table to be shown on the form page using a very simple method! All you need to do is to put the field name between { and } , then it will be replaced by the same field value from the table";
    var $plugin_name = "cf_profile"; // must be the same as the class name
    var $event = "ONLOAD"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD

    // the next function must exist and will have the backend config code
    function show_conf($row, $id, $form_id, $option)
    {
        global $mainframe;
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $doc =& JFactory::getDocument();
        $database =& JFactory::getDBO();

        // identify and initialise the parameters used in this plugin
        $params_array = array(
        	'table_name' => '',
        	'field_name' => '',
        	'parameter' => '');
        $params = $helper->loadParams($row, $params_array);

        $tables = $database->getTableList();
        $script  = "";
        $script .= "
        function loadfields2()
        {
        	var table = $('table_name').value;
        	var test = $('field_name').getParent();
        	var url = 'index3.php?option=com_chronocontact&task=ajax&plugin=cf_profile&method=ajaxFields&format=raw';
        	myAjax = new Ajax(url, {
        		method: 'post',
        		postBody: 'table='+table,
        		onRequest: function() {
        			test.setHTML('<div id=\'field_name\'>Loading . . .</div>')
    			},
        		onSuccess: function(req) {
        			test = $('field_name').getParent();
        			test.setHTML('<div id=\'field_name\'></div>');
					test = $('field_name').getParent();
					test.setHTML(req);
    			}
    		}).request();
        }
        ";
        $style = "
        .cf_header {
        	text-align:left;
        	font-weight:bold;
        	color:blue;
        	border:1px solid silver;
        	padding:6px;
        	padding-left:30px;
    	}";
        jimport('joomla.html.pane');
        $pane   =& JPane::getInstance('tabs');
?>
<form action="index2.php" method="post" name="adminForm" id="adminForm"
    class="adminForm" >
<?php
    echo $pane->startPane("cf_profile");
    echo $pane->startPanel( 'Configure', 'Configure' );
?>
<table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
    <thead>
        <tr>
            <th colspan='4' class='cf_header' >Configure Profile Table plugin</th>
        </tr>
    </thead>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "Choose the table to get the data from.";
        foreach ( $tables as $k => $table ) {
            $tables_array[$table] = JHTML::_('select.option', JText::_($table));
        }
        echo $helper->createSelectTD('Table name',
            'params[table_name]', $tables_array,
            $params->get('table_name'), 'onChange="loadfields2()"', $tooltip, 'table_name' );
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "The table column name which to be matched by the parameter; for best results, this field must be UNIQUE";
        if ( $id == 0 ) {
            echo $helper->createTextTD('Target field name',
                '<div id="field_name">Select Table name first</div>', '', '', $tooltip);
        } else {
			echo "<td></td>";
            $fields_array = array();
            $table_fields = $database->getTableFields( $params->get('table_name') );
            foreach ( $table_fields[$params->get('table_name')] as $k => $v) {
                $fields_array[$k] = JHTML::_('select.option', JText::_($k));
            }
            echo $helper->createSelectTD('Target field name',
                'params[field_name]', $fields_array,
                $params->get('field_name'), '', $tooltip, 'field_name' );
        }
?>
    </tr>
    <tr style="background-color: #c9c9c9">
<?php
        $tooltip = "The name of the parameter provided in the page url e.g. userid=128.";
        echo $helper->createInputTD("'Request' parameter name",
            'params[parameter]',
            $params->get('parameter'), '', '', $tooltip);
?>
    </tr>
</table>

<?php
        $hidden_array = array (
            'id' => $id,
            'form_id' => $form_id,
            'name' => $this->plugin_name,
            'event' => $this->event,
            'option' => $option,
            'task' => 'save_conf');
        echo $helper->createHiddenArray( $hidden_array );

        echo $pane->endPanel();
        echo $pane->startPanel( 'Help', "help" );
?>
<table border="0" cellpadding="3" cellspacing="0" style='width:400px;'>
    <thead>
        <tr>
            <th colspan='4' class='cf_header' >Help for Profile Table plugin</th>
        </tr>
    </thead>
    <tr>
        <td colspan='4' style='border:1px solid silver; padding:6px;'>
        <div>The plugin allows you to read values from any table in the database
        and include them in your form.</div>
        <div>It was originally designed to allow access to the jos_users table to create member
        profiles but it is capable of much more.</div>
        <div>To use the plugin effectively you will need to call the form from a link on your site.
        This could be from - for example a list of users, or topics, or events where you have
        some related information in a database table.</div>
        <ul><li>Choose the table you want to use in the first drop-down
        e.g. jos_users to get a user's name and email.</li>
        <li>Select a field or column name from the table in the second drop down.
        This should be a field that will uniquely identify the record you want to use
        e.g. 'id' or 'username' for the jos_user table. NB This drop-down will not appear
        until you select a table in the first drop-down.</li>
        <li>In the Target field name box put the name of the field you will use to identify the
        record e.g. user_id. You will need to add this field to a url calling the form
        e.g. . . . &chronoformname=my_form&user_id=99 </li>
        <li>You can then use information from this record in your form by putting {column_name} where
        you want it to appear e.g. {name} for a users name from the jos_users table.</li>
        <li>Once this plugin is configured you must enable it in the Form 'Plugins'' tab.</li></ul>
        </td>
    </tr>
</table>

<?php
        echo $pane->endPanel();
        echo $pane->endPane();
?>
</form>
<?php
        $doc->addScriptDeclaration($script);
        $doc->addStyleDeclaration($style);
    }
    /**
     * The function executed when the form is loaded
     * Returns an amended $html_string
     *
     */
    function onload( $option, $row, $params, $html_string )
    {
        global $mainframe;
        $my =& JFactory::getUser();
        $database =& JFactory::getDBO();

        //$parid 	= JRequest::getVar($params->parameter, '', 'request', 'int', 0 );
		$parid 	= JRequest::getVar($params->parameter);
        if ( $parid ) {
            $record_id = $parid;
        } else {
            $record_id = $my->id;
            if ( $record_id == 0 ) {
                //$record_id = '##guest##';
            }
        }
        if ( !$record_id ) {
            $result = $database->getTableFields( '#__users' );
            $table_fields = array_keys($result['#__users']);
            foreach ( $table_fields as $table_field ) {
                $html_string = str_replace("{".$table_field."}", '', $html_string);
            }
        } elseif ( $record_id ) {
            $database->setQuery( "
				SELECT *
					FROM ".$params->get('table_name')."
					WHERE ".$params->get('field_name')." = '".$record_id."'" );
            $rows = $database->loadObjectList();
            $row = $rows[0];
            $tables = array( $params->get('table_name') );
            $result = $database->getTableFields( $tables );
            $table_fields = array_keys($result[$params->get('table_name')]);
            foreach ( $table_fields as $table_field ) {
                $html_string = str_replace("{".$table_field."}", $row->$table_field, $html_string);
            }
        }
        return $html_string ;
    }

    /**
     * Returns a select list of the fields in a table specified in a request param
     *
     *
     */
    function ajaxFields()
    {
      	$database =& JFactory::getDBO();
    	$tablename = JRequest::getVar('table');

        $fields_array = array();
        $table_fields = $database->getTableFields( $tablename );
        foreach ( $table_fields[$tablename] as $k => $v) {
            $fields_array[$k] = JHTML::_('select.option', JText::_($k));
        }
    	echo JHTML::_('select.genericlist', $fields_array,
                'params[field_name]', '', 'value', 'text',
                '', 'field_name' );
    }
    // this function must exist and may not be changed unless you need to customize something
    function save_conf( $option )
    {
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'plugin.php');
        $helper = new ChronoContactHelperPlugin();
        $helper->save_conf($option);
    }
}
?>