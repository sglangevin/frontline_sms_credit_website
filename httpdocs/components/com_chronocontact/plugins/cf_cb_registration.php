<?php
defined('_JEXEC') or die('Restricted access'); 
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_cb_registration  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "CB Registration";
	var $result_TOOLTIP = "Synchronize the submitted data with this form with the default CB users table, please fill in the plugin config and assure the enabled field is marked then mark the checkbox here to get the plugin working!";
	var $plugin_name = "cf_cb_registration"; // must be the same as the class name
	var $event = "ONSUBMIT"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD
	var $plugin_keys ='errors,user,complete';//you can use these keys later here to hold some values in the MyPlugins->plugin_name variable array!
	// the next function must exist and will have the backend config code
	function show_conf($row, $id, $form_id, $option){
	global $mainframe;
	$database =& JFactory::getDBO();
	$database->setQuery( "SELECT * FROM #__comprofiler_fields WHERE `table`='#__comprofiler' AND name <>'NA' AND registration = '1'" );
	$fields = $database->loadObjectList();
	$paramsvalues = new JParameter($row->params);
	jimport('joomla.html.pane');
	$pane   =& JPane::getInstance('tabs');
	?>
	
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
    <?php
	echo $pane->startPane("cbregistration");
	echo $pane->startPanel( 'General', "general7" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Name Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[name]" value="<?php echo $paramsvalues->get('name'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "UserName Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[username]" value="<?php echo $paramsvalues->get('username'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Email Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[email]" value="<?php echo $paramsvalues->get('email'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Password Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[pass]" value="<?php echo $paramsvalues->get('pass'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "useless till now" ); ?></td>
			<td><strong><?php echo "Verify Password Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[vpass]" value="<?php echo $paramsvalues->get('vpass'); ?>" /></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Email user ?"; ?>:</strong> </td>
			<td></td>
			<td>
			<select name="params[emailuser]" id="params[emailuser]">
				<option<?php if($paramsvalues->get('emailuser') == 'No'){ echo ' selected';} ?> value="No">No</option>
				<option<?php if($paramsvalues->get('emailuser') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
			</select>
		</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "" ); ?></td>
			<td><strong><?php echo "Email admins ?"; ?>:</strong> </td>
			<td></td>
			<td>
			<select name="params[emailadmins]" id="params[emailadmins]">
				<option<?php if($paramsvalues->get('emailadmins') == 'No'){ echo ' selected';} ?> value="No">No</option>
				<option<?php if($paramsvalues->get('emailadmins') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
			</select>
		</td>
		</tr>
		<?php foreach($fields as $field){ $fieldname = $field->name; ?>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', $field->name." field" ); ?></td>
			<td><strong><?php echo $field->name." Field"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[<?php echo $field->name; ?>]" value="<?php echo $paramsvalues->get('$fieldname'); ?>" /></td>
		</tr>
		<?php } ?>
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
			echo $pane->startPanel( "OnSubmit", 'onSubmit7' );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
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
			echo $pane->startPanel( "Plugin Keys", 'Legend4' );
	?>
    <table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "this object will have all the inserted user data" ); ?></td>
			<td><strong><?php echo "user object"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_cb_registration['user']</td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "a string which will hold any error (if any) returned by joomla before the new user regsitration fails!" ); ?></td>
			<td><strong><?php echo "New user error(s)"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_cb_registration['errors']</td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "true or false based on the success of the registration process" ); ?></td>
			<td><strong><?php echo "Registration result"; ?>:</strong> </td>
			<td></td>
			<td>$MyPlugins->cf_cb_registration['complete']</td>
		</tr>
	</table>
    <?php
		echo $pane->endPanel();
		echo $pane->endPane();
	?>
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
	
	function onsubmit( $option, $params, $row ) {
		global $mainframe;
		$database =& JFactory::getDBO();
		// Check for request forgeries
		//JRequest::checkToken() or die( 'Invalid Token' );

		// Get required system objects
		$user 		= clone(JFactory::getUser());
		$pathway 	=& $mainframe->getPathway();
		$config		=& JFactory::getConfig();
		$authorize	=& JFactory::getACL();
		$document   =& JFactory::getDocument();
		$language =& JFactory::getLanguage(); 
		$language->load('com_user');
		$MyForm =& CFChronoForm::getInstance();
		$MyPlugins =& CFPlugins::getInstance($MyForm->formrow->id);
		
		// If user registration is not allowed, show 403 not authorized.
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		if ($usersConfig->get('allowUserRegistration') == '0') {
			JError::raiseError( 403, JText::_( 'Access Forbidden' ));
			return;
		}

		// Initialize new usertype setting
		$newUsertype = $usersConfig->get( 'new_usertype' );
		if (!$newUsertype) {
			$newUsertype = 'Registered';
		}

		// Bind the post array to the user object
		$post = JRequest::get( 'post' );
		$post['username']	= JRequest::getVar($params->get('username'), '', 'post', 'username');
		$post['name']	= JRequest::getVar($params->get('name'), '', 'post', 'name');
		$post['email']	= JRequest::getVar($params->get('email'), '', 'post', 'email');
		$post['password']	= JRequest::getVar($params->get('pass'), '', 'post', 'string', JREQUEST_ALLOWRAW);
		$post['password2']	= JRequest::getVar($params->get('vpass'), '', 'post', 'string', JREQUEST_ALLOWRAW);
		
		if (!$user->bind( $post, 'usertype' )) {
			JError::raiseError( 500, $user->getError());
		}

		// Set some initial user values
		$user->set('id', 0);
		$user->set('usertype', '');
		$user->set('gid', $authorize->get_group_id( '', $newUsertype, 'ARO' ));

		// TODO: Should this be JDate?
		$user->set('registerDate', date('Y-m-d H:i:s'));

		// If user activation is turned on, we need to set the activation information
		$useractivation = $usersConfig->get( 'useractivation' );
		if ($useractivation == '1')
		{
			jimport('joomla.user.helper');
			$user->set('activation', md5( JUserHelper::genRandomPassword()) );
			$user->set('block', '1');
		}

		// If there was an error with registration, set the message and display form
		if ( !$user->save() )
		{
			//JError::raiseWarning('', JText::_( $user->getError()));
			$MyPlugins->cf_cb_registration['errors'] = JText::_( $user->getError());
			return false;
		}
		$MyPlugins->cf_cb_registration['user'] = $user;
		JRequest::setVar('cf_user_id', $user->id);
		/********************CB part*************************/
		$database->setQuery( "SELECT * FROM #__comprofiler_fields WHERE `table`='#__comprofiler' AND name <>'NA' AND registration = '1'" );
		$fields = $database->loadObjectList();
		$fields2 = array('id', 'user_id');
		$fields3 = array();
		foreach($fields as $field){
			$fields2[] = $field->name;
			$fieldname = $field->name;
			$fields3[] = JRequest::getVar($params->get($fieldname), '', 'post', 'string');//mosGetParam($_POST, $params->get('$fieldname'), '');
		}
		$database->setQuery( "INSERT INTO #__comprofiler (".implode(",",$fields2).") VALUES  ('".$user->get('id')."','".$user->get('id')."','".implode("','",$fields3)."');" );
		if (!$database->query()) {
			JError::raiseWarning(100, $database->getErrorMsg());
		}
		/**********************************************/
		// Send registration confirmation mail
		$password = JRequest::getString($params->get('pass'), '', 'post', JREQUEST_ALLOWRAW);
		$password = preg_replace('/[\x00-\x1F\x7F]/', '', $password); //Disallow control chars in the email
		$this->_sendMail($user, $password, $params->get('emailuser'), $params->get('emailadmins'));

		// Everything went fine, set relevant message depending upon user activation state and display message
		$MyPlugins->cf_cb_registration['complete'] = true;
		if ( $useractivation == 1 ) {
			$message  = JText::_( 'REG_COMPLETE_ACTIVATE' );
		} else {
			$message = JText::_( 'REG_COMPLETE' );
		}
		
		
		
	}
	
	
	function _sendMail(&$user, $password, $emailuser, $emailadmins)
	{
		global $mainframe;

		$db		=& JFactory::getDBO();
		$language =& JFactory::getLanguage(); 
		$language->load('com_user');
		
		$name 		= $user->get('name');
		$email 		= $user->get('email');
		$username 	= $user->get('username');

		$usersConfig 	= &JComponentHelper::getParams( 'com_users' );
		$sitename 		= $mainframe->getCfg( 'sitename' );
		$useractivation = $usersConfig->get( 'useractivation' );
		$mailfrom 		= $mainframe->getCfg( 'mailfrom' );
		$fromname 		= $mainframe->getCfg( 'fromname' );
		$siteURL		= JURI::base();

		$subject 	= sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		$subject 	= html_entity_decode($subject, ENT_QUOTES);

		if ( $useractivation == 1 ){
			$message = sprintf ( JText::_( 'SEND_MSG_ACTIVATE' ), $name, $sitename, $siteURL."index.php?option=com_user&task=activate&activation=".$user->get('activation'), $siteURL, $username, $password);
		} else {
			$message = sprintf ( JText::_( 'SEND_MSG' ), $name, $sitename, $siteURL);
		}

		$message = html_entity_decode($message, ENT_QUOTES);

		//get all super administrator
		$query = 'SELECT name, email, sendEmail' .
				' FROM #__users' .
				' WHERE LOWER( usertype ) = "super administrator"';
		$db->setQuery( $query );
		$rows = $db->loadObjectList();

		// Send email to user
		if ( ! $mailfrom  || ! $fromname ) {
			$fromname = $rows[0]->name;
			$mailfrom = $rows[0]->email;
		}

		if($emailuser == "Yes")
		JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);

		// Send notification to all administrators
		$subject2 = sprintf ( JText::_( 'Account details for' ), $name, $sitename);
		$subject2 = html_entity_decode($subject2, ENT_QUOTES);

		// get superadministrators id
		foreach ( $rows as $row )
		{
			if (($row->sendEmail)&&($emailadmins == "Yes"))
			{
				$message2 = sprintf ( JText::_( 'SEND_MSG_ADMIN' ), $row->name, $sitename, $name, $email, $username);
				$message2 = html_entity_decode($message2, ENT_QUOTES);
				JUtility::sendMail($mailfrom, $fromname, $row->email, $subject2, $message2);
			}
		}
	}

}
?>