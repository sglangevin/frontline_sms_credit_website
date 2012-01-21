<?php
defined('_JEXEC') or die('Restricted access'); 
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_email_verification  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "Email Verification";
	var $result_TOOLTIP = "Let the user verify his email address before the form data go through the emails or the database table!";
	var $plugin_name = "cf_email_verification"; // must be the same as the class name
	var $event = "ONLOADONSUBMIT"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD or ONLOADONSUBMIT, the last one is for v3.1 RC3 and up only
	var $plugin_keys ='';
	// the next function must exist and will have the backend config code
	function show_conf($row, $id, $form_id, $option){
	global $mainframe;
	$database =& JFactory::getDBO();
	jimport('joomla.html.pane');
	$pane   =& JPane::getInstance('tabs');
	$paramsvalues = new JParameter($row->params);
	$tables = $database->getTableList();
	?>
	 
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
    <?php
	echo $pane->startPane("emailverification");
	echo $pane->startPanel( 'Email Settings', "email3" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact email address to send the verification email to, you may not need to use this" ); ?></td>
			<td><strong><?php echo "To"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[to]" value="<?php echo $paramsvalues->get('to'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact subject for the verification email" ); ?></td>
			<td><strong><?php echo "Email's Subject"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[subject]" value="<?php echo $paramsvalues->get('subject'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact email address to be used as the from email address in the verification email" ); ?></td>
			<td><strong><?php echo "From Email"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[fromemail]" value="<?php echo $paramsvalues->get('fromemail'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact name to be used as the from name in the verification email" ); ?></td>
			<td><strong><?php echo "From Name"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[fromname]" value="<?php echo $paramsvalues->get('fromname'); ?>" /></td>
		</tr>
         <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact field name which will hold the email address to send the verification email to" ); ?></td>
			<td><strong><?php echo "Dynamic To"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[dto]" value="<?php echo $paramsvalues->get('dto'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact field name which will hold the subject to be the subject for the verification email" ); ?></td>
			<td><strong><?php echo "Dynamic Subject"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[dsubject]" value="<?php echo $paramsvalues->get('dsubject'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact field name which will hold the email to be used as the from email address in the verification email" ); ?></td>
			<td><strong><?php echo "Dynamic From Email"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[dfromemail]" value="<?php echo $paramsvalues->get('dfromemail'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "The exact field name which will hold the name to be used as the from name in the verification email" ); ?></td>
			<td><strong><?php echo "Dynamic From Name"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[dfromname]" value="<?php echo $paramsvalues->get('dfromname'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This will be the verification message body, you can use any field name between 2 curly brackets {field_name}, you can also use {vlink} which will be the verification link!" ); ?></td>
			<td><strong><?php echo "Email Message"; ?>:</strong> </td>
			<td></td>
			<td>
			<?php
            $editor		=& JFactory::getEditor();
			echo $editor->display( 'extra1',  $row->extra1 , '100%', '350', '75', '20', false ) ;
			?>
			
            </td>
		</tr>
        </table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "OnSubmit Code", 'onsubmitcode' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This code will run after the form is submitted and before the verfication email is sent, may contain PHP code with tags!" ); ?></td>
			<td><strong><?php echo "OnSubmit Before Verification"; ?>:</strong> </td>
			<td></td>
			<td>
			<textarea name="extra2" cols="85" rows="10"><?php echo $row->extra2; ?></textarea>
			
            </td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This code will run after the verification link is opened and succeeded , may contain PHP code with tags!" ); ?></td>
			<td><strong><?php echo "OnSubmit After Verification - Success"; ?>:</strong> </td>
			<td></td>
			<td>
			<textarea name="extra3" cols="85" rows="10"><?php echo $row->extra3; ?></textarea>
			
            </td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This code will run after the verification link is opened and failed , may contain PHP code with tags!" ); ?></td>
			<td><strong><?php echo "OnSubmit After Verification - Failed"; ?>:</strong> </td>
			<td></td>
			<td>
			<textarea name="extra4" cols="85" rows="10"><?php echo $row->extra4; ?></textarea>
			
            </td>
		</tr>
         <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This code will run after the verification link is opened and failed because the record has already been verified" ); ?></td>
			<td><strong><?php echo "OnSubmit After Verification - Already verified"; ?>:</strong> </td>
			<td></td>
			<td>
			<textarea name="extra5" cols="85" rows="10"><?php echo $row->extra5; ?></textarea>
			
            </td>
		</tr>
        </table>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "DB Config", 'dbconfig' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This is a field name in the DB table which will be of type TINYINT(1) and will hold 1 or 0 based on if the user verfied his address or not!" ); ?></td>
			<td><strong><?php echo "Verification flag field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[vflagfield]" value="<?php echo $paramsvalues->get('vflagfield'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This is the table name used to save the form data, this table must have a field for the verification flag field above!" ); ?></td>
			<td><strong><?php echo "Verification flag field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[vtablename]" value="<?php echo $paramsvalues->get('vtablename'); ?>" /></td>
		</tr>
	</table>
    <?php
		echo $pane->endPanel();
		echo $pane->endPane();
	?>
    <input type="hidden" name="params[onsubmit]" value="before_email" />
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
		$post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		
		$row =& JTable::getInstance('chronocontactplugins', 'Table'); 
		if (!$row->bind( $post )) {
			JError::raiseWarning(100, $row->getError());
			$mainframe->redirect( "index2.php?option=$option" );
		}
		
		///$params = mosGetParam( $_POST, 'params', '' );
		$params 	= JRequest::getVar( 'params', '', 'post', 'array', array(0) );
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
	
	function onload( $option, $row, $params, $html_string ) {
		global $mainframe;
		$my 		= JFactory::getUser();
		$database =& JFactory::getDBO();
		$formname = JRequest::getVar( 'chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);
		$MyFormEmails =& CFEMails::getInstance($MyForm->formrow->id);
		$MyCustomCode =& CFCustomCode::getInstance($MyForm->formrow->id);
		
		if(JRequest::getVar('task') == 'beforeshow'){
			$query     = "SELECT * FROM ".trim($params->get('vtablename'))." WHERE uid='".JRequest::getVar('uid')."' AND ".trim($params->get('vflagfield'))." = 0";
			$database->setQuery( $query );
			$result = $database->loadObject();
			
			
			
			if($result){
				$database->setQuery( "UPDATE ".trim($params->get('vtablename'))." SET ".trim($params->get('vflagfield'))." = 1 WHERE uid='".JRequest::getVar('uid')."'");
				if (!$database->query()) {
					JError::raiseWarning(100, $database->getErrorMsg());
					//$mainframe->redirect( "index.php?option=$option" );
				}
				if ( !empty($row->extra3) ) {
					ob_start();
					eval( "?>".$row->extra3 );
					$extra3 = ob_get_clean();
				}
				//get table column names
				$tables = array();
				$tables[] = trim($params->get('vtablename'));
				$fieldsdata = $database->getTableFields( $tables );
				$table_fields = array_keys($fieldsdata[trim($params->get('vtablename'))]);
				
				$postdata = array();
				
				foreach ( $table_fields as $table_field) {
					$extra3 = str_replace("{".$table_field."}", $result->$table_field, $extra3);
					$postdata[$table_field] = $result->$table_field;
				}				
				//send emails
				$MyFormEmails->sendEmails($MyForm, $MyFormEmails->emails, $postdata);
				//do other onsubmit routines
				$MyCustomCode->runCode( 'onsubmitcode' );
				/**
				 * Redirect the page if requested
				 */
				if ( !$MyForm->formparams('debug') ) {
					if ( !empty($MyForm->formrow->redirecturl) ) {
						$mainframe->redirect($MyForm->formrow->redirecturl);
					}
				}	
				
				$html_string = $extra3;
			}else{
				//check if the record is already verified
				$query     = "SELECT * FROM ".trim($params->get('vtablename'))." WHERE uid='".JRequest::getVar('uid')."' AND ".trim($params->get('vflagfield'))." = 1";
				$database->setQuery( $query );
				$verified = $database->loadObject();
				if($verified){
					if ( !empty($row->extra5) ) {
						ob_start();
						eval( "?>".$row->extra5 );
						$extra5 = ob_get_clean();
						$html_string = $extra5;
					}
				}else{
					if ( !empty($row->extra4) ) {
						ob_start();
						eval( "?>".$row->extra4 );
						$extra4 = ob_get_clean();
						$html_string = $extra4;
					}
				}				
			}
		}
		
		return $html_string ;
		
	}
	function onsubmit( $option, $params , $row ) {
		global $mainframe;
		$database =& JFactory::getDBO();
		$pluginrow = $row;
		$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		$formname = JRequest::getVar( 'chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);
		$MyFormEmails =& CFEMails::getInstance($MyForm->formrow->id);
		$MyCustomCode =& CFCustomCode::getInstance($MyForm->formrow->id);
		//save the data
		$posted[$params->get('vflagfield')] = 0;
		if ( !empty($MyForm->formrow->autogenerated) ) {
			eval( "?>".$MyForm->formrow->autogenerated );
		}	
		//run the onsubmit before verification code
		if ( !empty($pluginrow->extra2) ) {
			eval( "?>".$pluginrow->extra2 );
		}	
		//send the verification email
		if($params->get('subject')){
			$subject = $params->get('subject');
		}else{
			$subject = $posted[$params->get('dsubject')];
		}
		
		if($params->get('to')){
			$recipients = $params->get('to');
		}else{
			$recipients = $posted[$params->get('dto')];
		}
		
		if($params->get('fromname')){
			$fromname = $params->get('fromname');
		}else{
			$fromname = $posted[$params->get('dfromname')];
		}
		
		if($params->get('fromemail')){
			$fromemail = $params->get('fromemail');
		}else{
			$fromemail = $posted[$params->get('dfromemail')];
		}
		
		$email_body = $pluginrow->extra1;		
		foreach($posted as $key => $value){
			$email_body = str_replace("{".$key."}", $value, $email_body);
		}
		
		//global ${'row_'.$params->get('vtablename')};
		
		$vlink = JURI::Base().'index.php?option=com_chronocontact&amp;chronoformname='.$formname.'&amp;task=beforeshow&amp;uid='.$MyForm->tablerow[$params->get('vtablename')]->uid;
		$vlink = '<a target="_blank" href="'.$vlink.'">'.$vlink.'</a>';
		$email_body = str_replace("{vlink}", $vlink, $email_body);
		
		//echo $email_body;
		JUtility::sendMail($fromemail, $fromname, $recipients, $subject, $email_body, true);
		//exit the form routine
		$MyForm->stoprunning = true;
		return;
	}

}
?>