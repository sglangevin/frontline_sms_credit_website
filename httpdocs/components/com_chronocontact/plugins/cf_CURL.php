<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_CURL  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "CURL";
	var $result_TOOLTIP = "Submit form data to another URL using the CURL method, example usage may be submitting data to Acajoom or salesforce or any other script/web service which accept receiving data through some specific URL";
	var $plugin_name = "cf_CURL"; // must be the same as the class name
	var $event = "ONSUBMIT"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD
	// the next function must exist and will have the backend config code
	function show_conf($row, $id, $form_id, $option){
	global $mainframe;
	$database =& JFactory::getDBO();
	jimport('joomla.html.pane');
	$pane   =& JPane::getInstance('tabs');
	
	$query     = "SELECT * FROM #__chrono_contact WHERE id='$form_id'";
    $database->setQuery( $query );
    $forms = $database->loadObjectList();
	
	$htmlstring = $forms[0]->html;
	preg_match_all('/name=("|\').*?("|\')/i', $htmlstring, $matches);
	$names = array();
	foreach ( $matches[0] as $name ) {
		$name = preg_replace('/name=("|\')/i', '', $name);
		$name = preg_replace('/("|\')/', '', $name);
		$name = preg_replace('/name=("|\')/', '', $name);
		if ( strpos($name, '[]') ) {
			$name = str_replace('[]', '', $name);
		}
		$names[] = trim($name);
	}
	$names = array_unique($names);	
	$paramsvalues = new JParameter($row->params);	
	$extras2 = new JParameter($row->extra2);
	?>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<?php
	//$tabs = new mosTabs(1);
	echo $pane->startPane("authorize2");
	echo $pane->startPanel( 'General', "general2" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<?php foreach($names as $name){ ?>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', $name ); ?></td>
			<td><strong><?php echo $name." Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="extras2[<?php echo $name; ?>]" value="<?php echo $extras2->get($name); ?>" /></td>
		</tr>
		<?php } ?>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Extra Fields, enter data with this format : x_ship_to_first_name=field_name , take care to add each entry to a new line" ); ?></td>
			<td><strong><?php echo "Extra fields Data"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra1" rows="10" cols="35"><?php echo $row->extra1; ?></textarea></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Debugging ON?" ); ?></td>
			<td><strong><?php echo "Debugging"; ?>:</strong> </td>
			<td></td>
			<td><select name="params[debugging]" id="params[debugging]">
				<option<?php if($paramsvalues->get('debugging') == '0'){ echo ' selected';} ?> value="0">No</option>
				<option<?php if($paramsvalues->get('debugging') == '1'){ echo ' selected';} ?> value="1">Yes</option>
			</select></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Runt he plugin before or after the email, running it before the email may be necessary to include some data intot he email or even dont get it emailed" ); ?></td>
			<td><strong><?php echo "Run Before/After the Email ?"; ?>:</strong> </td>
			<td></td>
			<td>
			<select name="params[onsubmit]" id="params[onsubmit]">
				<option<?php if($paramsvalues->get('onsubmit') == 'after_email'){ echo ' selected';} ?> value="after_email">After Email</option>
				<option<?php if($paramsvalues->get('onsubmit') == 'before_email'){ echo ' selected';} ?> value="before_email">Before Email</option>
			</select>
		</td>
		</tr>
		
	</table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Extra code", 'extracode' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td colspan="4">Extra code</td></tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Execute some code just before the plugin code is executed" ); ?></td>
			<td><strong><?php echo "Extra before onsubmit code"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra4" rows="10" cols="75"><?php echo $row->extra4; ?></textarea></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Execute some code just after the plugin code is executed" ); ?></td>
			<td><strong><?php echo "Extra after onsubmit code"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra5" rows="10" cols="75"><?php echo $row->extra5; ?></textarea></td>
		</tr>
	</table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "CURL params", 'curl_params' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The target URL to post parameters to" ); ?></td>
			<td><strong><?php echo "Target URL"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[target_url]" value="<?php echo $paramsvalues->get('target_url'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Include Header response from the gateway? default is No" ); ?></td>
			<td><strong><?php echo "Header in Response"; ?>:</strong> </td>
			<td></td>
			<td><select name="params[header_in_response]" id="params[header_in_response]">
				<option<?php if($paramsvalues->get('header_in_response') == '0'){ echo ' selected';} ?> value="0">No</option>
				<option<?php if($paramsvalues->get('header_in_response') == '1'){ echo ' selected';} ?> value="1">Yes</option>
			</select></td>
		</tr>
		
	</table>
	
	<?php
		echo $pane->endPanel();
		echo $pane->endPane();
	?>
	<br>
	
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="form_id" value="<?php echo $form_id; ?>" />
	<input type="hidden" name="name" value="<?php echo $this->plugin_name; ?>" />
	<input type="hidden" name="event" value="<?php echo $this->event; ?>" />
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="save_conf" />
	
	</form>
	<?php
	}
	// this function must exist and may not be changed unless you need to customize something
	function save_conf( $option ) {
		global $mainframe;
		$database =& JFactory::getDBO();		
		
		$row =& JTable::getInstance('chronocontactplugins', 'Table'); 
		if (!$row->bind( $_POST )) {
			JError::raiseWarning(100, $row->getError());
			$mainframe->redirect( "index2.php?option=$option" );
		}
		
		$params 	= JRequest::getVar( 'params', '', 'post', 'array' );
		if (is_array( $params )) {
			$txt = array();
			foreach ( $params as $k=>$v) {
				$txt[] = "$k=$v";
			}
			$row->params = implode( "\n", $txt );
		}
		$extras2 	= JRequest::getVar( 'extras2', '', 'post', 'array' );
		if (is_array( $extras2 )) {
			$txt2 = array();
			foreach ( $extras2 as $k=>$v) {
				$txt2[] = "$k=$v";
			}
			$row->extra2 = implode( "\n", $txt2 );
		}
		if (!$row->store()) {
			JError::raiseWarning(100, $row->getError());
			$mainframe->redirect( "index2.php?option=$option" );
		}
		$mainframe->redirect( "index2.php?option=".$option, "Config Saved" );
	}
	
	function onsubmit( $option, $params, $row ) {
		global $mainframe;
	
		?>
				
		<?php
		/*********do the before onsubmit code**********/
		if ( !empty($row->extra4) ) {
			eval( "?>".$row->extra4 );
		}
		
		
		$curl_values				= array();
		/// add main fields
		
		if(trim($row->extra2)){
		$extras2 = explode("\n",$row->extra2);
			foreach($extras2 as $extra2){
				$values = array();
				$values = explode("=",$extra2);
				if($values[1]){
					$curl_values[trim($values[1])] = JRequest::getVar(trim($values[0]), '', 'post', 'string', '');
				}
			}
		}
		
		
		
		
		if(trim($row->extra1)){
		$extras = explode("\n",$row->extra1);
			foreach($extras as $extra){
				$values = array();
				$values = explode("=",$extra);
				$curl_values[$values[0]] = trim($values[1]);
			}
		}
		
		
		$fields = "";
		foreach( $curl_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
		
		if($params->debugging)
		echo $fields;
		
		$ch = curl_init($params->target_url); 
		curl_setopt($ch, CURLOPT_HEADER, $params->header_in_response); // set to 0 to eliminate header info from response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no response. ###
		$resp = curl_exec($ch); //execute post and get results
		curl_close ($ch);
		
		echo $resp;
		
		/*********do the after onsubmit code**********/
		if ( !empty($row->extra5) ) {
			eval( "?>".$row->extra5 );
		}
		?>
		<?php
		
	}

}
?>