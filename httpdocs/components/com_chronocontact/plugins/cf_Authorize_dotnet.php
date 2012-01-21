<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_Authorize_dotnet  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "Authorize .net";
	var $result_TOOLTIP = "Submit form data to Authorize.net payment gateway, plugin must be configured, you need a license to use this plugin for real transactions because the unlicensed version doesn't submit the real cost amounts to Authorize.net";
	var $plugin_name = "cf_Authorize_dotnet"; // must be the same as the class name
	var $event = "ONSUBMIT"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD
	// the next function must exist and will have the backend config code
	function show_conf($row, $id, $form_id, $option){
	global $mainframe;
	jimport('joomla.html.pane');
	$pane   =& JPane::getInstance('tabs');
	
	$paramsvalues = new JParameter($row->params);
	
	?>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	<?php
	//$tabs = new mosTabs(1);
	echo $pane->startPane("authorize2");
	echo $pane->startPanel( 'General', "general2" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_card_num" ); ?></td>
			<td><strong><?php echo "x_card_num Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_card_num]" value="<?php echo $paramsvalues->get('x_card_num'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_exp_date_m" ); ?></td>
			<td><strong><?php echo "x_exp_date_m Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_exp_date_m]" value="<?php echo $paramsvalues->get('x_exp_date_m'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_exp_date_y" ); ?></td>
			<td><strong><?php echo "x_exp_date_y Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_exp_date_y]" value="<?php echo $paramsvalues->get('x_exp_date_y'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_description" ); ?></td>
			<td><strong><?php echo "x_description Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_description]" value="<?php echo $paramsvalues->get('x_description'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_amount" ); ?></td>
			<td><strong><?php echo "x_amount Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_amount]" value="<?php echo $paramsvalues->get('x_amount'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_first_name" ); ?></td>
			<td><strong><?php echo "x_first_name Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_first_name]" value="<?php echo $paramsvalues->get('x_first_name'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_last_name" ); ?></td>
			<td><strong><?php echo "x_last_name Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_last_name]" value="<?php echo $paramsvalues->get('x_last_name'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_address" ); ?></td>
			<td><strong><?php echo "x_address Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_address]" value="<?php echo $paramsvalues->get('x_address'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_city" ); ?></td>
			<td><strong><?php echo "x_city Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_city]" value="<?php echo $paramsvalues->get('x_city'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_state" ); ?></td>
			<td><strong><?php echo "x_state Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_state]" value="<?php echo $paramsvalues->get('x_state'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_zip" ); ?></td>
			<td><strong><?php echo "x_zip Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_zip]" value="<?php echo $paramsvalues->get('x_zip'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_invoice_num" ); ?></td>
			<td><strong><?php echo "x_invoice_num Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_invoice_num]" value="<?php echo $paramsvalues->get('x_invoice_num'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_cust_id" ); ?></td>
			<td><strong><?php echo "x_cust_id Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_cust_id]" value="<?php echo $paramsvalues->get('x_cust_id'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_company" ); ?></td>
			<td><strong><?php echo "x_company Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_company]" value="<?php echo $paramsvalues->get('x_company'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_country" ); ?></td>
			<td><strong><?php echo "x_country Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_country]" value="<?php echo $paramsvalues->get('x_country'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_phone" ); ?></td>
			<td><strong><?php echo "x_phone Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_phone]" value="<?php echo $paramsvalues->get('x_phone'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_fax" ); ?></td>
			<td><strong><?php echo "x_fax Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_fax]" value="<?php echo $paramsvalues->get('x_fax'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "x_email" ); ?></td>
			<td><strong><?php echo "x_email Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[x_email]" value="<?php echo $paramsvalues->get('x_email'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Extra Fields, enter data with this format : x_ship_to_first_name=field_name , take care to add each entry to a new line" ); ?></td>
			<td><strong><?php echo "Extra fields Data"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra1" rows="10" cols="35"><?php echo $row->extra1; ?></textarea></td>
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
			echo $pane->startPanel( "Authorize.net", 'auth.net' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td colspan="4">Authorize.net specific parameters!</td></tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "API login id" ); ?></td>
			<td><strong><?php echo "API login id"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[loginid]" value="<?php echo $paramsvalues->get('loginid'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Transaction Key" ); ?></td>
			<td><strong><?php echo "Transaction Key"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[transkey]" value="<?php echo $paramsvalues->get('transkey'); ?>" /></td>
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
			<td><?php echo JHTML::_('tooltip', "Testing ON ?" ); ?></td>
			<td><strong><?php echo "Testing"; ?>:</strong> </td>
			<td></td>
			<td><select name="params[testing]" id="params[testing]">
				<option<?php if($paramsvalues->get('testing') == '0'){ echo ' selected';} ?> value="0">No</option>
				<option<?php if($paramsvalues->get('testing') == '1'){ echo ' selected';} ?> value="1">Yes</option>
			</select></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Number of Error Retires" ); ?></td>
			<td><strong><?php echo "Error Retires"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="2" maxlength="1" name="params[error_retires]" value="<?php echo $paramsvalues->get('error_retires'); ?>" /></td>
		</tr>
		
	</table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Useful Variables", 'globalvars' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td colspan="4">Those are global variables which will be available once the plugin code is executed and can be used to do many things like switching emails ON/OFF or data save too!</td></tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Response Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['response_code']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Response Subcode"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['response_subcode']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Response Reason Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['response_reason_code']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Response Reason Text"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['response_reason_text']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Approval Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['approval_code']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "AVS Result Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['avs_result_code']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Transaction ID"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_Authorize_dotnet['transaction_id']</td>
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
		
		$params 	= JRequest::getVar( 'params', '', 'post', 'array');
		if (is_array( $params )) {
			$txt = array();
			foreach ( $params as $k=>$v) {
				$txt[] = "$k=$v";
			}
			$row->params = implode( "\n", $txt );
		}
		if (!$row->store()) {
			JError::raiseWarning(100, $row->getError());
			$mainframe->redirect( "index2.php?option=$option" );
		}
		$mainframe->redirect( "index2.php?option=".$option, "Config Saved" );
	}
	
	function onsubmit( $option, $params, $row ) {
		global $mainframe;
		$MyForm =& CFChronoForm::getInstance();
		$MyPlugins =& CFPlugins::getInstance($MyForm->formrow->id);
		?>
				
		<?php
		/*********do the before onsubmit code**********/
		if ( !empty($row->extra4) ) {
			eval( "?>".$row->extra4 );
		}
		
		$DEBUGGING					= $params->get('debugging');				# Display additional information to track down problems
		$TESTING					= $params->get('testing');				# Set the testing flag so that transactions are not live
		$ERROR_RETRIES				= $params->get('error_retires');				# Number of transactions to post if soft errors occur
		
		$auth_net_login_id			= $params->get('loginid');
		$auth_net_tran_key			= $params->get('transkey');
		#  $auth_net_url				= "https://test.authorize.net/gateway/transact.dll";
		#  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
		#  $auth_net_url				= "https://secure.authorize.net/gateway/transact.dll";
		
		$authnet_values				= array
		(
			"x_login"				=> $auth_net_login_id,
			"x_version"				=> "3.1",
			"x_delim_char"			=> "|",
			"x_delim_data"			=> "TRUE",
			"x_url"					=> "FALSE",
			"x_type"				=> "AUTH_CAPTURE",
			"x_method"				=> "CC",
			"x_tran_key"			=> $auth_net_tran_key,
			"x_relay_response"		=> "FALSE",
			"x_card_num"			=> JRequest::getVar($params->get('x_card_num'), '', 'post', 'string', ''),
			"x_exp_date"			=> JRequest::getVar($params->get('x_exp_date_m'), '', 'post', 'string', '').JRequest::getVar($params->get('x_exp_date_y'), '', 'post', 'string', ''),
			"x_description"			=> JRequest::getVar($params->get('x_description'), '', 'post', 'string', ''),
			"x_first_name"			=> JRequest::getVar($params->get('x_first_name'), '', 'post', 'string', ''),
			"x_last_name"			=> JRequest::getVar($params->get('x_last_name'), '', 'post', 'string', ''),
			"x_amount"				=> JRequest::getVar($params->get('x_amount'), '', 'post', 'string', ''),
			"x_address"				=> JRequest::getVar($params->get('x_address'), '', 'post', 'string', ''),
			"x_city"				=> JRequest::getVar($params->get('x_city'), '', 'post', 'string', ''),
			"x_state"				=> JRequest::getVar($params->get('x_state'), '', 'post', 'string', ''),
			"x_zip"					=> JRequest::getVar($params->get('x_zip'), '', 'post', 'string', ''),
			"x_invoice_num"				=> JRequest::getVar($params->get('x_invoice_num'), '', 'post', 'string', ''),
			"x_cust_id"				=> JRequest::getVar($params->get('x_cust_id'), '', 'post', 'string', ''),
			"x_company"					=> JRequest::getVar($params->get('x_company'), '', 'post', 'string', ''),
			"x_country"				=> JRequest::getVar($params->get('x_country'), '', 'post', 'string', ''),
			"x_phone"				=> JRequest::getVar($params->get('x_phone'), '', 'post', 'string', ''),
			"x_fax"					=> JRequest::getVar($params->get('x_fax'), '', 'post', 'string', ''),
			"x_email"					=> JRequest::getVar($params->get('x_email'), '', 'post', 'string', ''),
		);
		$extras = explode("\n",$row->extra1);
		if(trim($row->extra1)){
			foreach($extras as $extra){
				$values = array();
				$values = explode("=",$extra);
				$authnet_values[$values[0]] = $values[0].": ".JRequest::getVar(trim($values[1]), '', 'post', 'string', '');
			}
		}
		eval(base64_decode("JGF1dGhuZXRfdmFsdWVzWyd4X2Ftb3VudCddID0gcmFuZCgxLDQpKkpSZXF1ZXN0OjpnZXRWYXIoJHBhcmFtcy0+Z2V0KCd4X2Ftb3VudCcpLCAnJywgJ3Bvc3QnLCAnaW50JywgJycpOw=="));
		if($params->get('testing')){
			$authnet_values['x_test_request'] = "TRUE";
		}
		$fields = "";
		foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
		
		if($params->get('testing')){
			$ch = curl_init("https://test.authorize.net/gateway/transact.dll"); 
		}else{
			$ch = curl_init("https://secure.authorize.net/gateway/transact.dll"); 
		}
		$ch = curl_init("https://secure.authorize.net/gateway/transact.dll"); // uncomment if your transkey was created with account set to live
		curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
		$resp = curl_exec($ch); //execute post and get results
		curl_close ($ch);
		$debugger = "";
		//global $cf_AUTHNET_response_code, $cf_AUTHNET_response_subcode, $cf_AUTHNET_response_reason_code, $cf_AUTHNET_response_reason_text, $cf_AUTHNET_approval_code, $cf_AUTHNET_avs_result_code, $cf_AUTHNET_transaction_id ;
		//if(($params->get('debugging)&&($params->get('testing)){
			$debugger .= "<table>";
			$text = $resp;
			$h = substr_count($text, "|");
			$h++;
			
			
			
			
			for($j=1; $j <= $h; $j++){
			
				$p = strpos($text, "|");
			
				if ($p === false) { // note: three equal signs
			
					$debugger .= "<tr>";
					$debugger .= "<td class=\"e\">";
			
						//  x_delim_char is obviously not found in the last go-around
			
						if($j>=69){
			
							$debugger .= "Merchant-defined (".$j."): ";
							$debugger .= ": ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $text;
							$debugger .= "<br>";
			
						} else {
			
							$debugger .= $j;
							$debugger .= ": ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $text;
							$debugger .= "<br>";
			
						}
			
			
					$debugger .= "</td>";
					$debugger .= "</tr>";
			
				}else{
			
					$p++;
			
					//  We found the x_delim_char and accounted for it . . . now do something with it
			
					//  get one portion of the response at a time
					$pstr = substr($text, 0, $p);
			
					//  this prepares the text and returns one value of the submitted
					//  and processed name/value pairs at a time
					//  for AIM-specific interpretations of the responses
					//  please consult the AIM Guide and look up
					//  the section called Gateway Response API
					$pstr_trimmed = substr($pstr, 0, -1); // removes "|" at the end
			
					if($pstr_trimmed==""){
						$pstr_trimmed="NO VALUE RETURNED";
					}
			
			
					$debugger .= "<tr>";
					$debugger .= "<td class=\"e\">";
			
					switch($j){
			
						case 1:
							$debugger .= "Response Code: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$fval="";
							if($pstr_trimmed=="1"){
								$MyPlugins->cf_Authorize_dotnet['response_code'] = $fval="Approved";
							}elseif($pstr_trimmed=="2"){
								$MyPlugins->cf_Authorize_dotnet['response_code'] = $fval="Declined";
							}elseif($pstr_trimmed=="3"){
								$MyPlugins->cf_Authorize_dotnet['response_code'] = $fval="Error";
							}
			
							$debugger .= $fval;
							$debugger .= "<br>";
							break;
			
						case 2:
							$debugger .= "Response Subcode: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['response_subcode'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 3:
							$debugger .= "Response Reason Code: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['response_reason_code'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 4:
							$debugger .= "Response Reason Text: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['response_reason_text'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 5:
							$debugger .= "Approval Code: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['approval_code'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 6:
							$debugger .= "AVS Result Code: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['avs_result_code'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 7:
							$debugger .= "Transaction ID: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
							$MyPlugins->cf_Authorize_dotnet['transaction_id'] = $pstr_trimmed;
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 8:
							$debugger .= "Invoice Number (x_invoice_num): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 9:
							$debugger .= "Description (x_description): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 10:
							$debugger .= "Amount (x_amount): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 11:
							$debugger .= "Method (x_method): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 12:
							$debugger .= "Transaction Type (x_type): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 13:
							$debugger .= "Customer ID (x_cust_id): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 14:
							$debugger .= "Cardholder First Name (x_first_name): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 15:
							$debugger .= "Cardholder Last Name (x_last_name): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 16:
							$debugger .= "Company (x_company): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 17:
							$debugger .= "Billing Address (x_address): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 18:
							$debugger .= "City (x_city): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 19:
							$debugger .= "State (x_state): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 20:
							$debugger .= "ZIP (x_zip): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 21:
							$debugger .= "Country (x_country): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 22:
							$debugger .= "Phone (x_phone): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 23:
							$debugger .= "Fax (x_fax): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 24:
							$debugger .= "E-Mail Address (x_email): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 25:
							$debugger .= "Ship to First Name (x_ship_to_first_name): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 26:
							$debugger .= "Ship to Last Name (x_ship_to_last_name): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 27:
							$debugger .= "Ship to Company (x_ship_to_company): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 28:
							$debugger .= "Ship to Address (x_ship_to_address): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 29:
							$debugger .= "Ship to City (x_ship_to_city): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 30:
							$debugger .= "Ship to State (x_ship_to_state): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 31:
							$debugger .= "Ship to ZIP (x_ship_to_zip): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 32:
							$debugger .= "Ship to Country (x_ship_to_country): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 33:
							$debugger .= "Tax Amount (x_tax): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 34:
							$debugger .= "Duty Amount (x_duty): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 35:
							$debugger .= "Freight Amount (x_freight): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 36:
							$debugger .= "Tax Exempt Flag (x_tax_exempt): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 37:
							$debugger .= "PO Number (x_po_num): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 38:
							$debugger .= "MD5 Hash: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						case 39:
							$debugger .= "Card Code Response: ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$fval="";
							if($pstr_trimmed=="M"){
								$fval="M = Match";
							}elseif($pstr_trimmed=="N"){
								$fval="N = No Match";
							}elseif($pstr_trimmed=="P"){
								$fval="P = Not Processed";
							}elseif($pstr_trimmed=="S"){
								$fval="S = Should have been present";
							}elseif($pstr_trimmed=="U"){
								$fval="U = Issuer unable to process request";
							}else{
								$fval="NO VALUE RETURNED";
							}
			
							$debugger .= $fval;
							$debugger .= "<br>";
							break;
			
						case 40:
						case 41:
						case 42:
						case 43:
						case 44:
						case 45:
						case 46:
						case 47:
						case 48:
						case 49:
						case 50:
						case 51:
						case 52:
						case 53:
						case 54:
						case 55:
						case 55:
						case 56:
						case 57:
						case 58:
						case 59:
						case 60:
						case 61:
						case 62:
						case 63:
						case 64:
						case 65:
						case 66:
						case 67:
						case 68:
							$debugger .= "Reserved (".$j."): ";
			
							$debugger .= "</td>";
							$debugger .= "<td class=\"v\">";
			
							$debugger .= $pstr_trimmed;
							$debugger .= "<br>";
							break;
			
						default:
			
							if($j>=69){
			
								$debugger .= "Merchant-defined (".$j."): ";
								$debugger .= ": ";
			
								$debugger .= "</td>";
								$debugger .= "<td class=\"v\">";
			
								$debugger .= $pstr_trimmed;
								$debugger .= "<br>";
			
							} else {
			
								$debugger .= $j;
								$debugger .= ": ";
			
								$debugger .= "</td>";
								$debugger .= "<td class=\"v\">";
			
								$debugger .= $pstr_trimmed;
								$debugger .= "<br>";
			
							}
			
							break;
			
					}
			
					$debugger .= "</td>";
					$debugger .= "</tr>";
			
					// remove the part that we identified and work with the rest of the string
					$text = substr($text, $p);
			
				}
			
			}
			$debugger .= "</table>";
		if(($params->get('debugging'))&&($params->get('testing'))){
			echo $debugger;
		}
		/*********do the after onsubmit code**********/
		if ( !empty($row->extra5) ) {
			eval( "?>".$row->extra5 );
		}
		?>
		<?php
		
	}

}
?>