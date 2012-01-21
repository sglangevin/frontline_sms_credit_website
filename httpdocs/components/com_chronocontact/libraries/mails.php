<?php
defined('_JEXEC') or die('Restricted access'); 

class CFEMails extends JObject{
	var $emails = array();
	function __construct($formid = 0){
		if (!empty($formid)) {
			$this->getEmails($formid);
		}
		else
		{
			//initialise
			$this->emails        = array();
		}
	}
	function &getInstance($formid = 0){
		static $instances;
		if (!isset ($instances)) {
			$instances = array (  );
		}
		if (empty($instances[$formid])) {
			$instances[$formid] = new CFEMails($formid);
		}
		return $instances[$formid];
	}
	function getEmails( $formid )
	{
		global $mainframe;
		$database =& JFactory::getDBO();
		$query = "SELECT * FROM `#__chrono_contact_emails` WHERE `formid` = '".$formid."' ORDER BY emailid";
		$database->setQuery( $query );
		$emails = $database->loadObjectList();
		$this->emails = $emails;
		if(count($emails)){
			return true;
		}else{
			return false;
		}
	}
	function getEmailData( $EmailKey, $DataKey )
	{
		global $mainframe;
		$database =& JFactory::getDBO();
		$emails = $this->emails;
		if(count($emails) >= $EmailKey){
			//we are good
			return $emails[$EmailKey - 1]->$DataKey;
		}else{
			//wrong
			return false;
		}
	}
	function setEmailData( $EmailKey, $DataKey, $value )
	{
		global $mainframe;
		$database =& JFactory::getDBO();
		$emails = $this->emails;
		if(count($emails) >= $EmailKey){
			//we are good
			$emails[$EmailKey - 1]->$DataKey = $value;
			$this->emails = $emails;
			return true;
		}else{
			//wrong
			return false;
		}
	}
	function sendEmails( $MyForm, $emails, $posted = array() )
	{
		global $mainframe;
		$database =& JFactory::getDBO();
		if(!count($posted)){
			$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		}
		
		/**
		 * Associate field values with names and implode arrays
		 */
		$fields = array();
		
		$fields = $MyForm->handleArrays($MyForm->formrow->name);
		//loop emails
		foreach($emails as $email){
			$registry_email = new JRegistry();
			$registry_email->loadINI( $email->params );
			$email_params = $registry_email->toObject( );
			if ( $email->enabled == "1" ) {
				$email_body = $email->template;
				ob_start();
				eval( "?>".$email_body );
				$email_body = ob_get_clean();
				//build email template from defined fields and posted fields
				foreach ( $posted as $name => $post) {
					if (!is_array($post)) {
						$post = nl2br((string)$post);
						$email_body = str_replace("{".$name."}", $post, $email_body);
					} else {
						$email_body = str_replace("{".$name."}", implode(", ", $post), $email_body);
					}
				}
				foreach ( $fields as $name => $post) {
					$email_body = str_replace("{".$name."}", $post, $email_body);
				}
	
				/**
				 * Add IP address if required
				 */
				if ( $email_params->recordip == "1" ) {
					if ( $email_params->emailtype == "html" ) {
						$email_body .= "<br /><br />";
					}
					$email_body .= "Submitted by ".$_SERVER['REMOTE_ADDR'];
				}
				/**
				 * Wrap page code around the html message body
				 */
				if ( $email_params->emailtype == "html" ) {
					$email_body = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
					  <html>
						 <head>
							<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
							<base href=\"".JURI::base()."/\" />
							<title>Email</title>
						 </head>
						 
						 <body>$email_body</body>
					  </html>";
				}
				$fromname = (trim($email->fromname)) ? trim($email->fromname) : JRequest::getVar( trim($email->dfromname), NULL, 'post', 'string' );
				$from = (trim($email->fromemail)) ? trim($email->fromemail) : JRequest::getVar( trim($email->dfromemail), NULL, 'post', 'string' );
				$subject = (trim($email->subject)) ? trim($email->subject) : JRequest::getVar( trim($email->dsubject), NULL, 'post', 'string' );
				// Recepients
				$recipients = array();
				if(trim($email->to)){
					$recipients = explode(",", trim($email->to));
				}
				if(trim($email->dto)){
					$dynamic_recipients = explode(",", trim($email->dto));
					foreach($dynamic_recipients as $dynamic_recipient){
						if(JRequest::getVar( trim($dynamic_recipient), NULL, 'post', 'string' ))
						$recipients[] = JRequest::getVar( trim($dynamic_recipient), NULL, 'post', 'string' );
					}
				}
				// CCs
				$ccemails = array();
				if(trim($email->cc)){
					$ccemails = explode(",", trim($email->cc));
				}
				if(trim($email->dcc)){
					$dynamic_ccemails = explode(",", trim($email->dcc));
					foreach($dynamic_ccemails as $dynamic_ccemail){
						if(JRequest::getVar( trim($dynamic_ccemail), NULL, 'post', 'string' ))
						$ccemails[] = JRequest::getVar( trim($dynamic_ccemail), NULL, 'post', 'string' );
					}
				}
				// BCCs
				$bccemails = array();
				if(trim($email->bcc)){
					$bccemails = explode(",", trim($email->bcc));
				}
				if(trim($email->dbcc)){
					$dynamic_bccemails = explode(",", trim($email->dbcc));
					foreach($dynamic_bccemails as $dynamic_bccemail){
						if(JRequest::getVar( trim($dynamic_bccemail), NULL, 'post', 'string' ))
						$bccemails[] = JRequest::getVar( trim($dynamic_bccemail), NULL, 'post', 'string' );
					}
				}
				// ReplyTo Names
				$replytonames = array();
				if(trim($email->replytoname)){
					$replytonames = explode(",", trim($email->replytoname));
				}
				if(trim($email->dreplytoname)){
					$dynamic_replytonames = explode(",", trim($email->dreplytoname));
					foreach($dynamic_replytonames as $dynamic_replytoname){
						if(JRequest::getVar( trim($dynamic_replytoname), NULL, 'post', 'string' ))
						$replytonames[] = JRequest::getVar( trim($dynamic_replytoname), NULL, 'post', 'string' );
					}
				}
				// ReplyTo Emails
				$replytoemails = array();
				if(trim($email->replytoemail)){
					$replytoemails = explode(",", trim($email->replytoemail));
				}
				if(trim($email->dreplytoemail)){
					$dynamic_replytoemails = explode(",", trim($email->dreplytoemail));
					foreach($dynamic_replytoemails as $dynamic_replytoemail){
						if(JRequest::getVar( trim($dynamic_replytoemail), NULL, 'post', 'string' ))
						$replytoemails[] = JRequest::getVar( trim($dynamic_replytoemail), NULL, 'post', 'string' );
					}
				}
				// Replies
				$replyto_email = $replytoemails;
				$replyto_name  = $replytonames;
	
				$mode = ($email_params->emailtype == 'html') ? true : false;
	
				if(!$mode){
					$email_body = JFilterInput::clean($email_body, 'STRING');
				}
	
				$this_attachments = array();
				if ( $email_params->enable_attachments == "1" ) {
					$MyUploads =& CFUploads::getInstance($MyForm->formrow->id);
					$this_attachments = $MyUploads->attachments;
				}else{
					$this_attachments = array();
				}
	
				/**
				 * Send the email(s)
				 */
				$email_sent = JUtility::sendMail($from, $fromname, $recipients, $subject, $email_body, $mode, $ccemails, $bccemails, $this_attachments, $replyto_email, $replyto_name );
				
				if ($email_sent)$MyForm->addDebugMsg('An email has been SENT successfully from ('.$fromname.')'.$from.' to '.implode(',', $recipients));
				if (!$email_sent)$MyForm->addDebugMsg('An email has failed to be sent from ('.$fromname.')'.$from.' to '.implode(',', $recipients));
				
				// :: HACK :: insert debug
				if ( $MyForm->formparams('debug') ) {
					echo "<h4>E-mail message</h4>
					<div style='border:1px solid black; padding:6px;margin:6px;'>
					<p>From: $fromname [$from]<br />
					To:  ".implode(', ', $recipients)."<br />
					CC:  ".implode(', ', $ccemails)."<br />
					BCC: ".implode(', ', $bccemails)."<br />
					Subject: $subject</p>
					$email_body<br /><br />
					Files: ".implode(', ', $this_attachments)."<br /></div>";
				}
			}
		}
		return $emails;
	}
}