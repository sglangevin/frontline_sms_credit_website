<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
class acajoom_mail {
	
	function embedImages(&$mail){
		$mimetypes = array('bmp'   =>  'image/bmp',
				      'gif'   =>  'image/gif',
				      'jpeg'  =>  'image/jpeg',
				      'jpg'   =>  'image/jpeg',
				      'jpe'   =>  'image/jpeg',
				      'png'   =>  'image/png',
				      'tiff'  =>  'image/tiff',
				      'tif'   =>  'image/tiff');
	    preg_match_all("/(src|background)=\"(.*)\"/Ui", $mail->Body, $images);
	   	$result = true;
	    if(isset($images[2])) {
			$imagespath = array();
			foreach($images[2] as $i => $url) {
		      	$path = str_replace(ACA_JPATH_LIVE,ACA_JPATH_ROOT_NO_ADMIN,$url);
		      	if(isset($imagespath[$path])) continue;
		      	$imagespath[$path] = 1;
		        $filename  = basename($url);
		        $md5 = md5($filename);
		        $cid       = 'cid:' . $md5;
		        $fileParts = split("\.", $filename);
		        $ext       = $fileParts[1];
		        //We don't embed php files... it can be the stat picture for example
		        if(!isset($mimetypes[$ext])) continue;
		        
		        $mimeType  = $mimetypes[$ext];
		        
		        //We only change the url if we were able to embed the image.
		        //Otherwise we return false and display a warning
		        if($mail->AddEmbeddedImage($path, $md5, $filename, 'base64', $mimeType)){
		       		$mail->Body = preg_replace("/".$images[1][$i]."=\"".preg_quote($url, '/')."\"/Ui", $images[1][$i]."=\"".$cid."\"", $mail->Body);
		        }else{
		        	$result = false;
		        }
	      }
	    }
	    return $result;
	}

	function replaceClass(&$content,&$textonly,$subscriber = null){

			if ( ACA_CMSTYPE ) {
				global $mainframe;
				$database =& JFactory::getDBO();
				static $paramsbot = null;
				if($paramsbot === null){
					JPluginHelper::importPlugin( 'acajoom' );
					$query = "SELECT `params` from #__plugins where `folder` = 'acajoom'";
					$database->setQuery($query);
					$allParams = $database->loadObjectList();
	
					$paramsbot = array();
					if(!empty($allParams)){
						foreach($allParams as $params){
							$parametersbot = @explode("\n",$params->params);
							if(!empty($parametersbot)){
								foreach($parametersbot as $oneparam){
									$finalparam = @explode("=",$oneparam);
									if(count($finalparam)!= 2) continue;
									$paramsbot[$finalparam[0]] = $finalparam[1];
								}
							}
						}
					}
				}

				if(!empty($subscriber)) $paramsbot['subscriber'] = $subscriber;

				$bot_results = $mainframe->triggerEvent('acajoombot_transformfinal', array(&$content, &$textonly,$paramsbot));
			} else {
				global  $_MAMBOTS;
				$_MAMBOTS->loadBotGroup('acajoom');

				$paramsbot = null;
				foreach($_MAMBOTS->_bots as $onebot){
					$parametersbot = @explode("\n",$onebot->params);
					if(!empty($parametersbot)){
						foreach($parametersbot as $oneparam){
							$finalparam = @explode("=",$oneparam);
							if(count($finalparam)!= 2) continue;
							$paramsbot[$finalparam[0]] = $finalparam[1];
						}
					}
				}
				$bot_results = $_MAMBOTS->trigger('acajoombot_transformfinal', array(&$content, &$textonly,$paramsbot));
			}
	}

	 function replaceTags($content, $subscriber, $list, $mailingId, $html, $tags=null) {

/*		$content = str_replace('href="mailto:' , '9aca7aca5', $content);  // mailto tag good ones
		$content = str_replace('@', '9aca4aca1', $content);  // mailto tag good ones */

		$Itemid = $GLOBALS[ACA.'itemidAca'];

		$listId = $list->id;


		$subscriptionslink = '.php?option=com_acajoom&Itemid='.$Itemid.'&act=change&subscriber=' . $subscriber->id . '&cle=' . md5($subscriber->email). '&listid=' . $listId;
		$unsubscribelink = '.php?option=com_acajoom&Itemid='.$Itemid.'&act=unsubscribe&subscriber=' . $subscriber->id . '&cle=' . md5($subscriber->email) . '&listid=' . $listId;
		compa::completeLink($subscriptionslink,false,$GLOBALS[ACA.'use_sef']);
		compa::completeLink($unsubscribelink,false,$GLOBALS[ACA.'use_sef']);

		if($html) {
			$subscriptionslink = '<a href="' . $subscriptionslink . '" target="_blank"><span class="subscriptionlink_nws">' . _ACA_CHANGE_EMAIL_SUBSCRIPTION . '</span></a>';
			$unsubscribelink = '<a href="' . $unsubscribelink . '" target="_blank"><span class="subscriptionlink_nws">' . _ACA_UNSUBSCRIBE . '</span></a>';
			$subscriptionstext = '<p>'. $subscriptionslink . '<br />' . $unsubscribelink . '</p>';
		} else {
			$subscriptionslink = _ACA_CHANGE_EMAIL_SUBSCRIPTION . ' ( ' . $subscriptionslink . ' )';
			$unsubscribelink = _ACA_UNSUBSCRIBE . ' ( ' . $unsubscribelink . ' )';
			$subscriptionstext = "\r\n" . $subscriptionslink . "\r\n" . $unsubscribelink;
		}


		if ($GLOBALS[ACA.'show_signature'] ==1 ) {
			if($html) {
				$signatureText ='<a href="http://www.ijoobi.com" target="_blank">';
				$signatureText .='<br /><center><span style="color:#666666; font-size: .8em; text-align: center; ">Powered by Joobi</span></center>';
				$signatureText .='</a>';
			} else {
				$signatureText ='Powered by Joobi ( http://www.ijoobi.com )';
			}
			$subscriptionstext .= "\r\n\r\n" . $signatureText;
		}

		$confirmlink = '.php?option=com_acajoom&act=confirm&listid=' . $listId . '&cle=' . md5($subscriber->email) . '&subscriber=' . $subscriber->id.'&Itemid='.$Itemid;
		compa::completeLink($confirmlink,false,$GLOBALS[ACA.'use_sef']);
		
        if ($html) $confirmlink = '<a href="' . $confirmlink . '" target="_blank">' . _ACA_CONFIRM_LINK . '</a>';
  	    else $confirmlink = _ACA_CONFIRM_LINK . "\n" . $confirmlink;

		$tname = explode(" ", $subscriber->name);
		$firstname = $tname[0];
		$username = empty($subscriber->username) ? $firstname : $subscriber->username;
		
		$archiveLink = '.php?option=com_acajoom&act=mailing&task=view&mailingid='.$mailingId.'&Itemid='.$Itemid;
		compa::completeLink($archiveLink,false,$GLOBALS[ACA.'use_sef']);
				
		$archiveAll = '<a href="'.$archiveLink.'">'._ACA_VIEWARCHIVE.'</a>';
		
		$replaceWhat = array('[CONFIRM]','[NAME]','[FIRSTNAME]','[EMAIL]','[DATE]','[USERNAME]','[LINK]','[ARCHIVE]');
 if ( ACA_CMSTYPE ) {
		$replaceBy = array($confirmlink,$subscriber->name,$firstname,$subscriber->email,JHTML::_('date',acajoom::getNow(), JText::_('DATE_FORMAT_LC1'), 0),$username,$archiveLink,$archiveAll);
 } else {
		$replaceBy = array($confirmlink,$subscriber->name,$firstname,$subscriber->email,mosFormatDate(acajoom::getNow(), '', 0),$username,$archiveLink,$archiveAll);
}
		$content = str_replace($replaceWhat,$replaceBy, $content );

		if ( class_exists('auto') ) {
			auto::tags( $content, $tags );
		}
		if ($list->footer == '0') {
			$content = str_replace('[SUBSCRIPTIONS]', '', $content  );
		} else {
			$content = str_replace('[SUBSCRIPTIONS]', $subscriptionstext, $content  );
		}

		if (class_exists('aca_tags') AND $tags) aca_tags::replace($content, $tags);

		if ( !empty($mailingId) AND $GLOBALS[ACA.'enable_statistics'] == 1 ) {
			if ($GLOBALS[ACA.'statistics_per_subscriber'] == 1) {

  				if($html) $content .= '<img src="' . ACA_JPATH_LIVE_NO_HTTPS . '/index.php?option=com_acajoom&Itemid='.$Itemid.'&act=log&listid=' . $listId . '&mailingid=' . $mailingId . '&subscriber=' . $subscriber->id . '" border="0" width="1" height="1" />';
			} else {

  				if ($html)	$content .=  '<img src="' . ACA_JPATH_LIVE_NO_HTTPS . '/index.php?option=com_acajoom&Itemid='.$Itemid.'&act=log&listid=' . $listId . '&mailingid=' . $mailingId . '" border="0" width="1" height="1" />';
			}
		}
		// replace for images
		//  put the good mailto tag back (replaced before the content mambot)
		$replaceTag = array('href="mailto:','@','href="#');
		$replaceBy = array('9aca7aca5','9aca4aca1','9aca12aca3');

		$content = str_replace($replaceTag,$replaceBy,$content);

		$content = preg_replace('#src[ ]*=[ ]*\"(?!https?://)(?:\.\./|\./|/)?#','src="'.ACA_JPATH_LIVE_NO_HTTPS.'/',$content);
		$content = preg_replace('#href[ ]*=[ ]*\"(?!https?://)(?:\.\./|\./|/)?#','href="'.ACA_JPATH_LIVE_NO_HTTPS.'/',$content);

		$content = str_replace($replaceBy,$replaceTag,$content);

		$content = preg_replace('#\.(jpg|gif|jpeg|png)(?:(?!").)?"#', '.\\1"', $content);

		if (!$html) $content = str_replace('&amp;', '&', $content);

		return $content;
	 }


	 function htmlToText($textonly) {
		$textonly = str_replace(array('<p>', '<P>'), "", $textonly);

		$textonly =preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $textonly);

		$returns = array('<br>', '<br/>', '<br />', '<br >','<BR >', '<BR>', '<BR/>', '<BR />', '</p>', '</P>', '<p />', '<p/>', '<P />', '<P/>', '</h3>', '</H3>', '</h4>', '</H4>', '</h5>', '</H5>', '</h6>', '</H6>', '</h1>', '</H1>', '</h2>', '</H2>');

		$textonly = str_replace($returns, "\n", $textonly);


	  	$textonly = preg_replace('/<a href="([^"]*)"[^>]*>([^<]*)<\/a>/i','${2} ( ${1} )', $textonly);

	  	$textonly = preg_replace('/<head>.*<\/head>/i', '', $textonly);

		$textonly = preg_replace('~&#x([0-9a-f]+);~ei', chr(hexdec("\\1")), $textonly);
		$textonly = preg_replace('~&#([0-9]+);~e', chr("\\1"), $textonly);

		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		$textonly = strtr($textonly, $trans_tbl);

		$textonly = strip_tags($textonly);

		return $textonly;
	 }

	 function getMailer($mailing, $html=0) {

	 	$fromname = $mailing->fromname;
	 	$fromemail = trim($mailing->fromemail);
	 	$frombounce = empty($mailing->frombounce) ? trim($GLOBALS[ACA.'confirm_return']) : trim($mailing->frombounce);
	 	$attachments = $mailing->attachments;
		$images = $mailing->images;


		if ( ACA_CMSTYPE ) {	// joomla 15
			$conf	=& JFactory::getConfig();
		 	$frombounceName = $fromname ? $fromname : $conf->getValue('config.fromname');
			if(empty($fromemail)) $fromemail = trim($conf->getValue('config.mailfrom'));
			if(empty($fromname)) $fromname = trim($conf->getValue('config.fromname'));
		} else {									//joomla 1x
		 	$frombounceName = $fromname ? $fromname : $GLOBALS['mosConfig_fromname'];
			if(empty($fromemail)) $fromemail = trim($GLOBALS['mosConfig_mailfrom']);
			if(empty($fromname)) $fromname = trim($GLOBALS['mosConfig_fromname']);
		}//endif


		if (ACA_CMSTYPE) {
			jimport('joomla.mail.mail');
			$phpmailerPath = JPATH_LIBRARIES.DS.'phpmailer'.DS;
			//require_once(  $phpmailerPath . 'phpmailer.php' );
			$mail = new JMail();
		} else {
			$phpmailerPath = ACA_JPATH_ROOT_NO_ADMIN . DS . 'includes' . DS . 'phpmailer' . DS;
			require_once(  $phpmailerPath . 'class.phpmailer.php' );
			$mail = new mosPHPMailer();
			$mail->CharSet = substr_replace(_ISO, '', 0, 8);
		}


		$mail->PluginDir =  $phpmailerPath ;

		$mail->SetLanguage('en', $phpmailerPath.'language'.DS);

		$mail->WordWrap = 150;

      //$mail->addCustomHeader("X-Mailer: ".$GLOBALS[ACA.'component'].$GLOBALS[ACA.'version']);
      $mail->addCustomHeader("X-Mailer: ".ACA_JPATH_LIVE);
      $mail->addCustomHeader("X-MessageID: $mailing->id");

		if ( $GLOBALS[ACA.'mail_format'] =='1' ) $mail->Encoding = 'base64';

		if($GLOBALS[ACA.'minisendmail']) $frombounceName = '';

		if(ACA_CMSTYPE){
			$mail->addReplyTo(array($frombounce, $frombounceName));
		}else{
			$mail->AddReplyTo($frombounce, $frombounceName);
		}

		$mail->From 	= trim($fromemail);
		if($GLOBALS[ACA.'minisendmail']){
			$mail->FromName = '';
		}else{
			$mail->FromName = $fromname;
		}

		$mail->Sender 	= trim($GLOBALS[ACA.'sendmail_from']);
		if(empty($mail->Sender)) $mail->Sender = '';

		switch ($GLOBALS[ACA.'emailmethod']){
			case 'mail' :
				$mail->IsMail();
				break;
			case 'sendmail':
				$mail->IsSendmail();
				if ( ACA_CMSTYPE ) {	// joomla 15
					$conf	=& JFactory::getConfig();
					$mail->Sendmail = $GLOBALS[ACA.'sendmail_path'] ? $GLOBALS[ACA.'sendmail_path'] : $conf->getValue('config.sendmail');
				} else {									//joomla 1x
					$mail->Sendmail = $GLOBALS[ACA.'sendmail_path'] ? $GLOBALS[ACA.'sendmail_path'] : $GLOBALS['mosConfig_sendmail'];
				}//endif
				break;
			case 'smtp':
				$mail->IsSMTP();
				if ( ACA_CMSTYPE ) {	// joomla 15
					$conf	=& JFactory::getConfig();
					$mail->Host = $GLOBALS[ACA.'smtp_host'] ? $GLOBALS[ACA.'smtp_host'] : $conf->getValue('config.smtphost');
				} else {									//joomla 1x
					$mail->Host = $GLOBALS[ACA.'smtp_host'] ? $GLOBALS[ACA.'smtp_host'] : $GLOBALS['mosConfig_smtphost'];
				}//endif

				if((boolean)$GLOBALS[ACA.'smtp_auth_required']) {
					$mail->SMTPAuth = $GLOBALS[ACA.'smtp_auth_required'];
					$mail->Password = $GLOBALS[ACA.'smtp_password'];
					$mail->Username = $GLOBALS[ACA.'smtp_username'];
				}
				break;
			default:
				if ( ACA_CMSTYPE ) {	// joomla 15
					$conf	=& JFactory::getConfig();
					$mail->Mailer 	= $conf->getValue('config.mailer'); // $GLOBALS['mosConfig_mailer'];
				} else {									//joomla 1x
					$mail->Mailer 	= $GLOBALS['mosConfig_mailer'];
				}//endif
				break;
		}

		if (!empty($attachments)) {
			foreach ($attachments AS $attachment) {
				if(basename($attachment) !== 'index.html'){
					$mail->AddAttachment(ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'upload_url'].DS.basename($attachment));
				}
			}
		}


		switch( substr( strtoupper( PHP_OS ), 0, 3 ) ) {
			case "WIN":
				$mail->LE = "\r\n";
				break;
			case "MAC":
			case "DAR":
				$mail->LE = "\r";
			default:
				break;
		}

		return $mail;

	 }


	function getContent($images, $layout, &$content, &$textonly, $send = false) {

		$replaceTag = array('href="mailto:','@','href="#');
		$replaceBy = array('9aca7aca5','9aca4aca1','9aca12aca3');

		$content = str_replace($replaceTag,$replaceBy,$content);

		$content = str_replace('{mospagebreak}', '<br style="clear: both;" /><br />', $content);

		if (strlen(trim($textonly)) < 2 && $send) {
			$textonly = acajoom_mail::htmlToText($content);
			$textonly = str_replace('{mosimage}', '', $textonly);
		}

		if (!empty($images)) {
			foreach ($images as $image) {
				 $image_string = '<img src="' . ACA_JPATH_LIVE . '/images/stories/' . $image. '" />';
				 $content = preg_replace('/{mosimage}/', $image_string, $content, 1);
			 }
		}

		if (ACA_CMSTYPE) {
			global $mainframe;
			JPluginHelper::importPlugin( 'acajoom' );
			$bot_results = $mainframe->triggerEvent('acajoombot_transformall', array(&$content, &$textonly));
		} else {
			global  $_MAMBOTS;
			$_MAMBOTS->loadBotGroup('acajoom');
			$bot_results = $_MAMBOTS->trigger('acajoombot_transformall', array(&$content, &$textonly));
		}

		$content = str_replace($replaceTag,$replaceBy,$content);

		$content = preg_replace('#src[ ]*=[ ]*\"(?!https?://)(?:\.\./|\./|/)?#','src="'.ACA_JPATH_LIVE_NO_HTTPS.'/',$content);
		$content = preg_replace('#href[ ]*=[ ]*\"(?!https?://)(?:\.\./|\./|/)?#','href="'.ACA_JPATH_LIVE_NO_HTTPS.'/',$content);

		$content = str_replace($replaceBy,$replaceTag,$content);

		return true;

	 }


	 function send( $showHTML, $mailing, $receivers, $list, &$message, $tags=null ) {

		$h = '';
		$xf = new xonfig();
		if (empty($mailing)) {
			$message = _ACA_NO_MAILING_ENTERED;
			return false;
		} elseif (  empty($receivers) ) {
			$message = _ACA_NO_ADDRESS_ENTERED;
			return false;
		}  elseif ( empty($list) ) {
			$message = _ACA_NO_LIST_ENTERED;
			return false;
		} else {
			$message = '';
		}

		$mailingId = $mailing->id;
    	$issue_nb = $mailing->issue_nb;
	 	$subject = $mailing->subject;
	 	$content = $mailing->htmlcontent;
	 	$textonly = $mailing->textonly;
	 	$fromname = $mailing->fromname;
	 	$fromemail = $mailing->fromemail;
		$images = $mailing->images;
	 	$listId = $list->id;
	 	$html = $list->html;
	  	$layout = $list->layout;

		$totalsofar = number_format(0, 4, ',', '');
		$nbPause = 0;

		$tags['issuenb'] = $issue_nb;

		if (!ini_get('safe_mode')) {
			@set_time_limit(60 * $GLOBALS[ACA.'script_timeout']);
			@ini_set('memory_limit','128M');
		}

		ignore_user_abort(true);

		### create the mail
		$mail = acajoom_mail::getMailer($mailing);
		### create content
		acajoom_mail::getContent($images, $layout, $content, $textonly, true);

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;


		$html_sent = 0;
		$text_sent = 0;
		$size = sizeof($receivers);
		$i = 0;


		?>
		<form action="index2.php" method="post" name="adminForm">
			<input type="hidden" name="option" value="com_acajoom" />
			<input type="hidden" name="act" value="mailing" />
			<input type="hidden" name="listype" value="<?php echo $mailing->list_type; 	?>" />
			<input type="hidden" name="task" value="" />
		</form>
		<?php

		if ( $showHTML ) {
			echo '<form action="#" name="counterForm">';
			echo _ACA_SENDING_EMAIL;
			echo ': &nbsp;<input type="text" size="6" name="teller" value="0" style="border: 0px solid white; font-family: Arial, Helvetica, sans-serif; font-size: 1.1em;" size="1" /> of ' . $size . '</form>';
		}


		$garde = 0;
		//If two errors occur, we stop to try
		while (ob_get_level() > 0 AND $garde < 2) {
		   if(!ob_end_flush()){
		   		$garde++;
		   }
		}


		if ( ACA_CMSTYPE ) {	// joomla 15
			$skip_subscribers = @$_SESSION['skip_subscribers'.$mailing->id];
		} else {									//joomla 1x
			$skip_subscribers = intval(mosGetParam($_SESSION, 'skip_subscribers'.$mailing->id, 0));
		}//endif

		$format = defined('_DATE_FORMAT_LC') ? _DATE_FORMAT_LC : JText::_('DATE_FORMAT_LC');
		$log_detailed = "\r\n" ."\r\n" .'*** '.strftime($format).' ***'."\r\n";

		if(empty($skip_subscribers)){
			if ( ACA_CMSTYPE ) {	// joomla 15
				$skip_subscribers = JRequest::getVar('skip_subscribers', '0' );
			} else {									//joomla 1x
				 $skip_subscribers = intval(mosGetParam($_REQUEST, 'skip_subscribers', 0));
			}//endif
		}

		$nbsubscribers = count($receivers);
		foreach ($receivers as $receiver) {
			$i++;

			if ($i <= $skip_subscribers) {
				continue;
			}

			$tags['user_id'] = $receiver->user_id;

			if ($html && (intval($receiver->receive_html) == 1)) {
				$mail->IsHTML(true);
				$ashtml = 1;
				$Altbody = acajoom_mail::replaceTags($textonly, $receiver, $list, $mailingId, 0, $tags);

				$mail->AltBody = acajoom_mail::safe_utf8_encode( $Altbody, $mail->CharSet );
				$html_sent++;
				$mail->Body = acajoom_mail::replaceTags($content, $receiver, $list, $mailingId, $ashtml, $tags);
				
				acajoom_mail::replaceClass($mail->Body,$mail->AltBody,$receiver);

			} else {
				$mail->IsHTML(false);
				$mail->AltBody = '';
				$ashtml = 0;
				$text_sent++;

				$mail->Body = acajoom_mail::replaceTags($textonly, $receiver, $list, $mailingId, $ashtml, $tags);
				$simpleText = '';
				acajoom_mail::replaceClass($mail->Body,$simpleText,$receiver);

				if( !empty($images) ) {
					foreach( $images as $image) {
						$img = explode('|', $image);
						$attrib = explode("/", $img[0]);
						$path = ACA_JPATH_ROOT. '/images/stories/';
						if (count($img)==1) {
							$imageName = $img[0];
						} else {
							$imageName = $attrib[count($attrib)-1];
							for ($index = 0; $index < (sizeof($attrib)-1); $index++) {
								$path .= $attrib[$index].'/';
							}
						}
						$mail->AddAttachment( $path.$imageName);
					}
				}
			}

			$tname = explode(" ", $receiver->name);
			$firstname = $tname[0];
			$toUser = $GLOBALS[ACA.'minisendmail'] ? '' : $receiver->name;
			$mail->AddAddress($receiver->email,$toUser);
			$username = empty($receiver->username) ? $firstname : $receiver->username;
			$date = ACA_CMSTYPE ? JHTML::_('date',acajoom::getNow(), JText::_('DATE_FORMAT_LC1'), 0) : mosFormatDate(acajoom::getNow(), '', 0);
			
			$replaceWhat = array('[NAME]','[FIRSTNAME]','[USERNAME]','[DATE]');
			$replaceBy = array($receiver->name,$firstname,$username,$date);
			$sujetReplaced = str_replace($replaceWhat, $replaceBy, $subject);

			if ( class_exists('auto') ) auto::tags( $sujetReplaced, $tags );
			$mail->Subject =  $sujetReplaced;

			if($GLOBALS[ACA.'embed_images']){
				acajoom_mail::embedImages($mail);
			}
			
			$mailssend = $mail->Send();

			if ($showHTML) echo '<br /><strong>'.$i . ': ';

			if (!$mailssend || $mail->error_count > 0) {
				$h .= $receiver->email . '</strong> -> ' . xmailing::M('red' , _ACA_MESSAGE_NOT.'! ' . _ACA_MAILER_ERROR . ': ' . $mail->ErrorInfo);
				$log_detailed .= '['.$mailingId.'] '.$subject.' : '.$receiver->email . ' -> ' . _ACA_MESSAGE_NOT . "\r\n" . _ACA_MAILER_ERROR . ': ' . $mail->ErrorInfo . "\r\n";
				if($html && (intval($receiver->receive_html) == 1)) {
					$html_sent--;
				} else{
					$text_sent--;
				}
			} else {
				$h .= $receiver->email . '</strong> -> ' . xmailing::M('green' , _ACA_MESSAGE_SENT_SUCCESSFULLY);
				$log_detailed .= '['.$mailingId.'] '.$subject.' : '.$receiver->email . ' -> ' . _ACA_MESSAGE_SENT_SUCCESSFULLY . "\r\n";

				if ($GLOBALS[ACA.'enable_statistics'] == 1 AND $GLOBALS[ACA.'statistics_per_subscriber'] == 1) {
							xmailing::insertStats( $mailingId, $receiver->id, $ashtml);
				}
			}


			$mail->ClearAddresses();

			if ($showHTML) echo '<script type="text/javascript" language="javascript">document.counterForm.teller.value=\'' . $i . '\';</script>';

			flush();

			if ((($i % $GLOBALS[ACA.'emails_between_pauses']) == 0) AND $i<$nbsubscribers) {

				if ($showHTML) echo $h;
				$h ='';
				flush();

				$mtime = microtime();
				$mtime = explode(" ",$mtime);
				$mtime = $mtime[1] + $mtime[0];
				$endtime = $mtime;
				if ($totalsofar>0) {
					$totaltime = $totalsofar;
					$totalstr = strval ($totaltime);
				} else {
					$totaltime = number_format($endtime - $starttime - $nbPause * $GLOBALS[ACA.'pause_time'], 4, ',', '');
					$totalstr = strval ($totaltime);
				}

				if($GLOBALS[ACA.'display_trace'] == 1 AND $showHTML ) {
					echo '<br/>Time to send: ' .$totalstr . ' ' ._ACA_SECONDS;
					echo '<br/>Number of subscribers: ' . ($text_sent + $html_sent) . "<br />" .
								  'HTML format: ' . $html_sent . "<br />" .
								  'Text format: ' . $text_sent . "<br />";
				} else {
					echo _ACA_QUEUE_PROCESSED;
				}

				if ($GLOBALS[ACA.'wait_for_user'] == 0) {

					$mtime = microtime();
					$mtime = explode(" ",$mtime);
					$mtime = $mtime[1] + $mtime[0];
					$endtime = $mtime;
					$totaltime = number_format($endtime - $starttime - $nbPause * $GLOBALS[ACA.'pause_time'], 4, ',', '');
					$totalstr = strval ($totaltime);

					//$h .= '<br /><b>--- Waiting ' . $GLOBALS[ACA.'pause_time']. ' seconds ---</b><br />';
					if(!class_exists('auto')){
						$h .=  '<b>--- Total time so far: ' . $totalstr. ' seconds ---</b><br />';
					}

					$log_detailed .= "\r\n" . '--- Waiting ' . $GLOBALS[ACA.'pause_time']. ' seconds ---' . "\r\n\r\n";
					$log_detailed .= "\r\n" . '<b>--- Total time so far: ' . $totalstr. ' seconds ---</b><br />' . "\r\n\r\n";

					$nbPause++;
					echo $h;
					flush();

//ADRIEN REFRESH PAGE
					if (class_exists('auto')){
						$_SESSION['skip_subscribers'.$mailing->id] = $i;
						//Ecriture des statistiques
						if($GLOBALS[ACA.'enable_statistics'] == 1 and ($html_sent>0 OR $text_sent>0)){
							xmailing::updateStatsGlobal( $mailingId, $html_sent, $text_sent, false);
						}

						$xf->plus('totalmailingsent'.$list->list_type, $html_sent+$text_sent);
						$xf->plus('totalmailingsent0', $html_sent+$text_sent);

						$log_simple = 'Time to send: ' . $totalstr . ' ' ._ACA_SECONDS . "\r\n" .
									  'Number of subscribers: ' . ($text_sent + $html_sent) . "\r\n" .
									  'HTML format: ' . $html_sent . "\r\n" .
									  'Text format: ' . $text_sent . "\r\n";
						$log_detailed = $log_simple . 'Details: ' . "\r\n" . $log_detailed . "\r\n";

						if (class_exists('lisType')) acajoom_mail::writeLogs($list, $log_simple, $log_detailed);
					}
					
				
					echo '<br/><b>--- Waiting '.$GLOBALS[ACA.'pause_time'].' seconds : </b>';
					for($a=0;$a<$GLOBALS[ACA.'pause_time']-1;$a++){
						sleep(1);
						echo $GLOBALS[ACA.'pause_time'] - $a - 1 .' ';
						flush();
					}
					
					if (class_exists('auto')){

						$link = 'index2.php?option=com_acajoom&act=mailing&task=sendNewsletter&listid='.$listId.'&listype='.$mailing->list_type.'&mailingid='.$mailing->id.'&skip_subscribers='.$i;

						compa::redirect($link);
						exit(0);
					}

				} else{

					$log_detailed .= "\r\n" . '--- Waiting for user input to continue sending ---' . "\r\n\r\n";


					$mtime = microtime();
					$mtime = explode(" ",$mtime);
					$mtime = $mtime[1] + $mtime[0];
					$endtime = $mtime;

					$totaltime = number_format($endtime - $starttime, 4, ',', '');
					if ( ACA_CMSTYPE ) {	// joomla 15
						$timeStr = JRequest::getVar('time', '');
					} else {									//joomla 1x
						$timeStr = mosGetParam($_REQUEST, 'time', '');
					}//endif

					$time = floatval($timeStr);
					$totalsofar = $endtime - $starttime + $time;
					$totalstr = strval ($totalsofar);

			?>
			<form action="index2.php" method="post">
				<input type="hidden" name="option" value="com_acajoom" />
				<input type="hidden" name="act" value="mailing" />
				<input type="hidden" name="task" value="sendNewsletter" />
				<input type="hidden" name="listid" value="<?php echo $listId; ?>" />
				<input type="hidden" name="listype" value="<?php echo $mailing->list_type; 	?>" />
				<input type="hidden" name="skip_subscribers" value="<?php echo $i; ?>" />
				<input type="hidden" name="mailingid" value="<?php echo $mailing->id; ?>" />
				<input type="hidden" name="time" value="<?php echo $totalstr; ?>" />
				<br />
				<input type="submit" name="submit" value="<?php echo _ACA_CONTINUE_SENDING; ?>" />
			</form>
			<?php
				}
			}else{
				if ($showHTML) echo $h;
				$h ='';
			}
		}


		if($GLOBALS[ACA.'enable_statistics'] == 1){
			xmailing::updateStatsGlobal( $mailingId, $html_sent, $text_sent, false);
		}

		unset($_SESSION['skip_subscribers'.$mailing->id]);

		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		if ($totalsofar>0) {
			$totaltime = $totalsofar;
			$totalstr = strval ($totaltime);
		} else {
			$totaltime = number_format($endtime - $starttime - $nbPause * $GLOBALS[ACA.'pause_time'], 4, ',', '');
			$totalstr = strval ($totaltime);
		}

		$xf->plus('totalmailingsent'.$list->list_type, $html_sent+$text_sent);
		$xf->plus('totalmailingsent0', $html_sent+$text_sent);

		$log_simple = 'Time to send: ' . $totalstr . ' ' ._ACA_SECONDS . "\r\n" .
					  'Number of subscribers: ' . ($text_sent + $html_sent) . "\r\n" .
					  'HTML format: ' . $html_sent . "\r\n" .
					  'Text format: ' . $text_sent . "\r\n";
		$log_detailed = $log_simple . 'Details: ' . "\r\n" . $log_detailed . "\r\n";


		if($GLOBALS[ACA.'display_trace'] == 1 AND $showHTML ) {
			echo '<br /><b>' . _ACA_SENDING_TOOK . ' ' . $totalstr . ' ' . _ACA_SECONDS . '</b><br />';
			echo 'Number of subscribers: ' . ($text_sent + $html_sent) . "<br />" .
						  'HTML format: ' . $html_sent . "<br />" .
						  'Text format: ' . $text_sent . "<br />";
		} else {
			echo _ACA_QUEUE_PROCESSED;
		}

		if (class_exists('lisType')) acajoom_mail::writeLogs($list, $log_simple, $log_detailed);
		ob_start();
		if ($html_sent+$text_sent>0 ) {
			return true;
		} else {
			$message = xmailing::M('no' , _ACA_NO_MAILING_SENT);
			return false;
		}
	}

	 function sendOne($mailing, $receivers, $list, &$message , $tags=null) {
		$mailingId = $mailing->id;
    	$issue_nb = $mailing->issue_nb;
	 	$subject = $mailing->subject;
	 	$content = $mailing->htmlcontent;
	 	$textonly = $mailing->textonly;
	 	$fromname = $mailing->fromname;
	 	$fromemail = $mailing->fromemail;

	 	$images = $mailing->images;
	 	$listId = $list->id;
	 	$html = $list->html;
	  	$layout = $list->layout;

	  	$tags['issuenb'] = $issue_nb;

		### create the mail
		$mail = acajoom_mail::getMailer($mailing);

		### create content
		acajoom_mail::getContent($images, $layout, $content, $textonly, true);

		if ( isset($receivers->user_id) ) $tags['user_id'] = $receivers->user_id;

		if(!empty($receivers)){

			if($html && (intval($receivers->receive_html) == 1)) {
				$mail->IsHTML(true);
				$ashtml = 1;
				$Altbody = acajoom_mail::replaceTags($textonly, $receivers, $list, $mailingId, 0, $tags);
				$mail->AltBody = acajoom_mail::safe_utf8_encode( $Altbody, $mail->CharSet );
				$mail->Body = acajoom_mail::replaceTags($content, $receivers, $list, $mailingId, $ashtml, $tags);
				acajoom_mail::replaceClass($mail->Body,$mail->AltBody,$receivers);

			} else{
				$mail->IsHTML(false);
				$mail->AltBody = '';
				$ashtml = 0;
				$mail->Body = acajoom_mail::replaceTags($textonly, $receivers, $list, $mailingId, $ashtml, $tags);
				$simpleText = '';
				acajoom_mail::replaceClass($mail->Body,$simpleText,$receivers);
				
					if( !empty($images) ) {
						foreach( $images as $image) {
							$img = explode('|', $image);
							$attrib = explode("/", $img[0]);
							$path = ACA_JPATH_ROOT. '/images/stories/';
							if (count($img)==1) {
								$imageName = $img[0];
							} else {
								$imageName = $attrib[count($attrib)-1];
								for ($index = 0; $index < (sizeof($attrib)-1); $index++) {
									$path .= $attrib[$index].'/';
								}
							}
							$mail->AddAttachment( $path.$imageName);
						}
					}
			}

			$tname = explode(" ", $receivers->name);
			$firstname = $tname[0];
			$toUser = $GLOBALS[ACA.'minisendmail'] ? '' : $receivers->name;
			$mail->AddAddress($receivers->email, $toUser);
			$username = empty($receivers->username) ? $firstname : $receivers->username;
			$date = ACA_CMSTYPE ? JHTML::_('date',acajoom::getNow(), JText::_('DATE_FORMAT_LC1'), 0) : mosFormatDate(acajoom::getNow(), '', 0);
			
			$replaceWhat = array('[NAME]','[FIRSTNAME]','[USERNAME]','[DATE]');
			$replaceBy = array($receivers->name,$firstname,$username,$date);
			$sujetReplaced = str_replace($replaceWhat, $replaceBy, $subject);
			$mail->Subject =  $sujetReplaced;


			if(empty($mail->Body) OR empty($mail->Subject)){
				echo xmailing::M('red' , 'There is not Body or Subject in your e-mail');
				return false;
			}
			
			if($GLOBALS[ACA.'embed_images']){
				acajoom_mail::embedImages($mail);
			}
			$mailssend = $mail->Send();


			if (!$mailssend || $mail->error_count > 0) {
				static $info =false;
				if(!$info AND acajoom::checkPermissions('admin')){
					echo '<br/>Mailer Error : ' . $mail->ErrorInfo;
					echo " : Newsletter '$sujetReplaced' to $receivers->email";
					$info = true;
				}

				$message .= xmailing::M('red' , _ACA_MESSAGE_NOT.'! ' . _ACA_MAILER_ERROR . ': ' . $mail->ErrorInfo);
				return false;
			} else {
				$message .= _ACA_MESSAGE_SENT_SUCCESSFULLY;
				return true;
			}

		} else {
			echo xmailing::M('red' , _ACA_NO_ADDRESS_ENTERED);
			return false;
		}

	}


	 function sendSchedule( $d, $showHTML, $receivers, $list, &$message, &$max, $tags=null ) {
		static $countEmails = 0;

		$mailing = $d['mailing'];
		$h = '';
		$xf = new xonfig();
		if (empty($mailing)) {
			$message = _ACA_NO_MAILING_ENTERED;
			return false;
		} elseif (  empty($receivers) ) {
			$message = _ACA_NO_ADDRESS_ENTERED;
			return false;
		}  elseif ( empty($list) ) {
			$message = _ACA_NO_LIST_ENTERED;
			return false;
		} else {
			$message = '';
		}

		$mailingId = $mailing->id;
    	$issue_nb = $mailing->issue_nb;
	 	$subject = $mailing->subject;
	 	$content = $mailing->htmlcontent;
	 	$textonly = $mailing->textonly;
	 	$fromname = $mailing->fromname;
	 	$fromemail = $mailing->fromemail;
		$images = $mailing->images;

	 	$listId = $list->id;
	 	$html = $list->html;
	  	$layout = $list->layout;

		$totalsofar = number_format(0, 4, ',', '');
		$nbPause = 0;
		$tags['issuenb'] = $issue_nb;

		//Just in case of...
		@ini_set('max_execution_time',0);
		@ini_set('memory_limit','128M');

		ignore_user_abort(true);

		### create the mail
		$mail = acajoom_mail::getMailer($mailing);
		### create content
		acajoom_mail::getContent($images, $layout, $content, $textonly, true);


		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$starttime = $mtime;


		$html_sent = 0;
		$text_sent = 0;
		$size = sizeof($receivers);

		$format = defined('_DATE_FORMAT_LC') ? _DATE_FORMAT_LC : JText::_('DATE_FORMAT_LC');
		$log_detailed = "\r\n" ."\r\n" .'*** '.strftime($format).' ***'."\r\n";


		foreach ($receivers as $receiver) {

			$tags['user_id'] = $receiver->user_id;

			if ($html && (intval($receiver->receive_html) == 1)) {
				$mail->IsHTML(true);
				$ashtml = 1;
				$Altbody = acajoom_mail::replaceTags($textonly, $receiver, $list, $mailingId, 0, $tags);
				$mail->AltBody = acajoom_mail::safe_utf8_encode( $Altbody, $mail->CharSet );
				$html_sent++;
				$mail->Body = acajoom_mail::replaceTags($content, $receiver, $list, $mailingId, $ashtml, $tags);
				acajoom_mail::replaceClass($mail->Body,$mail->AltBody,$receiver);

			} else {
				$mail->IsHTML(false);
				$mail->AltBody = '';
				$ashtml = 0;
				$text_sent++;
				$mail->Body = acajoom_mail::replaceTags($textonly, $receiver, $list, $mailingId, $ashtml, $tags);
				$simpleText = '';
				acajoom_mail::replaceClass($mail->Body,$simpleText,$receiver);
			}


			$tname = explode(" ", $receiver->name);
			$firstname = $tname[0];
			$toUser = $GLOBALS[ACA.'minisendmail'] ? '' : $receiver->name;
			$mail->AddAddress($receiver->email, $toUser);

			$username = empty($receiver->username) ? $firstname : $receiver->username;
			$date = ACA_CMSTYPE ? JHTML::_('date',acajoom::getNow(), JText::_('DATE_FORMAT_LC1'), 0) : mosFormatDate(acajoom::getNow(), '', 0);
			
			$replaceWhat = array('[NAME]','[FIRSTNAME]','[USERNAME]','[DATE]');
			$replaceBy = array($receiver->name,$firstname,$username,$date);
			
			$sujetReplaced = str_replace($replaceWhat, $replaceBy, $subject);

			if ( class_exists('auto') ) auto::tags( $sujetReplaced, $tags );
			$mail->Subject =  $sujetReplaced;

			
			if($GLOBALS[ACA.'embed_images']){
				acajoom_mail::embedImages($mail);
			}
			$mailssend = $mail->Send();
			$countEmails++;

			if ( $countEmails >= $GLOBALS[ACA.'cron_max_emails'] ) $max = true;


			if (!$mailssend || $mail->error_count > 0) {
				static $info =false;
				if(!$info AND acajoom::checkPermissions('admin')){
					echo '<br/>Mailer Error : ' . $mail->ErrorInfo;
					echo " : Newsletter '$sujetReplaced' to $receiver->email";
					$info = true;
				}

				$log_detailed .= '['.$mailingId.'] '.$subject.' : '.$receiver->email . ' -> ' . _ACA_MESSAGE_NOT . "\r\n" . _ACA_MAILER_ERROR . ': ' . $mail->ErrorInfo . "\r\n";

				if($html && (intval($receiver->receive_html) == 1))	$html_sent--;  else 	$text_sent--;
				
				if(!subscribers::validEmail($receiver->email,true)){
					$deleteQueue = array();
					$deleteQueue[0] = queue::whatQID( $mailingId, $receiver->id, $d['listype'] );
					queue::deleteQueues($deleteQueue);
				}

			} else {

				$log_detailed .= '['.$mailingId.'] '.$subject.' : '.$receiver->email . ' -> ' . _ACA_MESSAGE_SENT_SUCCESSFULLY . "\r\n";

				if ($GLOBALS[ACA.'enable_statistics'] == 1 AND $GLOBALS[ACA.'statistics_per_subscriber'] == 1)
					xmailing::insertStats( $mailingId, $receiver->id, $ashtml);

				$d['qids'] = array();
				$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

				if ( $d['listype']=='2' ) {

					$d['qids'][0] = queue::whatQID( $mailingId, $receiver->id, $d['listype'] );
					$erro->ck = auto::updateAutoresponderSent($d);
				 	$erro->Eck(__LINE__ ,  '8137' , $d);
				} elseif ( $d['listype']=='1' || $d['listype']=='7' ) {

					$d['qids'][0] = queue::whatQID( $mailingId, $receiver->id, $d['listype'] );
					$erro->ck = queue::deleteQueues($d['qids']);
				 	$erro->Eck(__LINE__ ,  '8127' , $d);
				}
			}

			$mail->ClearAddresses();
		}


		if($GLOBALS[ACA.'enable_statistics'] == 1){
			xmailing::updateStatsGlobal( $mailingId, $html_sent, $text_sent, false);
		}


		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$endtime = $mtime;
		if ($totalsofar>0) {
			$totaltime = $totalsofar;
			$totalstr = strval ($totaltime);
		} else {
			$totaltime = number_format($endtime - $starttime - $nbPause * $GLOBALS[ACA.'pause_time'], 4, ',', '');
			$totalstr = strval ($totaltime);
		}

		$xf->plus('totalmailingsent'.$list->list_type, $html_sent+$text_sent);
		$xf->plus('totalmailingsent0', $html_sent+$text_sent);

		$log_simple = 'Time to send: ' . $totalstr . ' ' ._ACA_SECONDS . "\r\n" .
					  'Number of subscribers: ' . ($text_sent + $html_sent) . "\r\n" .
					  'HTML format: ' . $html_sent . "\r\n" .
					  'Text format: ' . $text_sent . "\r\n";
		$log_detailed = $log_simple . 'Details: ' . "\r\n" . $log_detailed . "\r\n";


		if (class_exists('lisType')) acajoom_mail::writeLogs($list, $log_simple, $log_detailed);

		if ( $d['listype']=='2' ) {
			echo '<br/>'._ACA_QUEUE_AUTO_PROCESSED;
		} elseif ( $d['listype']=='1' ) {
			echo '<br/>'._ACA_QUEUE_NEWS_PROCESSED;
		}

		if ($html_sent+$text_sent>0 ) {
			return true;
		} else {
			$message = xmailing::M('no' , _ACA_NO_MAILING_SENT);
			return false;
		}

	}


	 function sendConfirmationEmail($subscriberId) {

		if ( ACA_CMSTYPE ) {	// joomla 15
			$queue->sub_list_id = JRequest::getVar('sub_list_id', '' );
		} else {									//joomla 1x
			$queue->sub_list_id = mosGetParam($_REQUEST, 'sub_list_id', '');
		}//endif

		if (!empty($queue->sub_list_id)) {
			if ( ACA_CMSTYPE ) {	// joomla 15
				$queue->subscribed = JRequest::getVar('subscribed', '' );
			} else {									//joomla 1x
				$queue->subscribed = mosGetParam($_REQUEST, 'subscribed', '');
			}//endif
			$listSub = array();
			$i = 0;
			$size = sizeof($queue->sub_list_id);
			for ($index = 1; $index <= $size; $index++) {
				if (isset($queue->subscribed[$index])) {
					if ($queue->subscribed[$index]==1) {
						$listSub[$i] = $queue->sub_list_id[$index];
						$i++;
					}
				}
			}
		} else {
			if ( ACA_CMSTYPE ) {	// joomla 15
				$listSub[0] = (int) JRequest::getVar('listid', '' );
			} else {									//joomla 1x
				$listSub[0] = (int) mosGetParam($_REQUEST, 'listid', '');
			}//endif
		}

		return acajoom_mail::processConfirmationEmail($subscriberId, $listSub);
	 }


	 function processConfirmationEmail($subscriberId, $listSub) {

		$status =  true;
		$qid[0] = $subscriberId;
		$receiver = subscribers::getSubscribersFromId($qid, false);

		$listIds = implode(",", $listSub );

		$lists = lists::getSpecifiedLists($listIds, false);
		$message = '';
		foreach ($lists as $list) {
			$Sub_TAG = '';
			if (substr_count($list->subscribemessage, '[CONFIRM]')<1) {
				$Sub_TAG = '[CONFIRM]';
			}
			$mailing = null;
			if ( empty($list->subscribemessage)) $list->subscribemessage= '    ';
		 	$mailing->subject = _ACA_SUBSCRIBE_SUBJECT_MESS;

		 	$mailing->htmlcontent = $list->subscribemessage.$Sub_TAG;
		 	$mailing->textonly = '';
		 	if(!$GLOBALS[ACA.'minisendmail']) $mailing->fromname = $list->sendername;

		 	$mailing->fromemail = $list->senderemail;
		 	$mailing->frombounce = $list->bounceadres;
		 	$mailing->id = 0;
		 	$mailing->issue_nb = 0;
		 	$mailing->images = '';
		 	$mailing->attachments = '';

			if (!acajoom_mail::sendOne($mailing, $receiver, $list, $message)) $status = false;

			$erro = 'Could not send the confirmation email, for list #:'.$list->id.' , please contact the webmaster!';
			break;
		}

		return $status;
	 }



	 function sendUnsubcribeEmail($subscriberId, $list) {

		$qid[0] = $subscriberId;
		$receiver = subscribers::getSubscribersFromId($qid, false);
		$message = '';

	 	$mailing->subject = _ACA_UNSUBSCRIBE_SUBJECT_MESS;
	 	$mailing->htmlcontent = $list->unsubscribemessage;
	 	$mailing->textonly = $list->unsubscribemessage;
	 	if(!$GLOBALS[ACA.'minisendmail']) $mailing->fromname = $list->sendername;

	 	$mailing->fromemail = $list->senderemail;
	 	$mailing->frombounce = $list->bounceadres;
	 	$mailing->id = 0;
	 	$mailing->issue_nb = 0;
	 	$mailing->images = '';
	 	$mailing->attachments = '';
		if(acajoom_mail::sendOne($mailing, $receiver, $list, $message)) {
			$erro = '';
		} else {
			$erro = 'Could not send the unsubscribe email, for list #:'.$list->id.' , please contact the webmaster!';
		}

		return $erro;
	 }


	 function writeLogs($list, $log_simple, $log_detailed) {

		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database;
		}//endif

		 if ($GLOBALS[ACA.'send_log_simple']) {
			 $send = $log_simple;
		 } else {
			 $send = $log_detailed;
		 }

		if (lisType::sendLogs($list->list_type)) {
			$database->setQuery( "SELECT * FROM `#__users` WHERE `gid` = 25 LIMIT 1" );
			if ( ACA_CMSTYPE ) {	// joomla 15
				$admin = $database->loadObject();
				$owner = subscribers::getSubscriberInfoFromUserId($list->owner);
				 if ($GLOBALS[ACA.'send_log'] == 1) {
					if (!empty($owner->email)) {
						JUTility::sendMail($admin->email, $admin->username, $owner->email, 'Acajoom mailing report', $send );
					} else {
						JUTility::sendMail($admin->email, $admin->username, $admin->email, 'Acajoom mailing report', $send );
					}
				 } else {

					if ($GLOBALS[ACA.'send_log_closed'] == 1 && connection_aborted()) {
						if (!empty($owner->email)) {
							JUTility::sendMail($admin->email, $admin->username, $owner->email, 'Acajoom mailing report', $send );
						} else {
							JUTility::sendMail($admin->email, $admin->username, $admin->email, 'Acajoom mailing report', $send );
						}
					}
				 }

			} else {									//joomla 1x
				$database->loadObject($admin);
				$owner = subscribers::getSubscriberInfoFromUserId($list->owner);
				 if ($GLOBALS[ACA.'send_log'] == 1) {
					if (!empty($owner->email)) {
						mosMail($admin->email, $admin->username, $owner->email, 'Acajoom mailing report', $send );
					} else {
						mosMail($admin->email, $admin->username, $admin->email, 'Acajoom mailing report', $send );
					}
				 } else {

					if ($GLOBALS[ACA.'send_log_closed'] == 1 && connection_aborted()) {
						if (!empty($owner->email)) {
							mosMail($admin->email, $admin->username, $owner->email, 'Acajoom mailing report', $send );
						} else {
							mosMail($admin->email, $admin->username, $admin->email, 'Acajoom mailing report', $send );
						}
					}
				 }
			}//endif


	 	}

		 if ($GLOBALS[ACA.'save_log']) {

			 if ($GLOBALS[ACA.'save_log_simple']) {
				 @file_put_contents(ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'save_log_file'], $log_simple, FILE_APPEND);
			 } else {
				 @file_put_contents(ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'save_log_file'], $log_detailed, FILE_APPEND);
			 }
		 }

	 }


 function logStatistics( $mailingId, $subscriberId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


	 if ($subscriberId != 0) {

			 $query = 'REPLACE INTO `#__acajoom_stats_details` ' .
			 		'( `mailing_id`, `subscriber_id`, `html`, `read`) ' .
			 		'VALUES ( \'' . $mailingId . '\', \'' . $subscriberId . '\', \'1\', \'1\')';
		 $database->setQuery($query);
		 $database->query();
	 }


	xmailing::updateStatsGlobal( $mailingId, 0, 0, true );


	 ob_end_clean();

	 $filename = ACA_JPATH_ROOT . '/images/blank.png';
	 $handle = fopen($filename, 'r');

	 $contents = fread($handle, filesize($filename));

	 fclose($handle);

	 header("Content-type: image/png");

	 echo $contents;

	 exit();
 }



	function safe_utf8_encode( $text, $charset ) {
		if( strtolower($charset) == 'utf-8') {
			if( !acajoom_mail::seems_utf8($text)) {
				$text = utf8_encode($text);
			}
		}


		$text = acajoom_mail::acaHtmlEntityDecode( $text, null, 'utf-8' );

		return $text;
	}

	function seems_utf8($Str) {
		for ($i=0; $i<strlen($Str); $i++) {
			if (ord($Str[$i]) < 0x80) continue; # 0bbbbbbb
			elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
			elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
			elseif ((ord($Str[$i]) & 0xF8) == 0xF0) $n=3; # 11110bbb
			elseif ((ord($Str[$i]) & 0xFC) == 0xF8) $n=4; # 111110bb
			elseif ((ord($Str[$i]) & 0xFE) == 0xFC) $n=5; # 1111110b
			else return false; # Does not match any model
			for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
				if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) {
					return false;
				}
			}
		}
		return true;
	}


function acaHtmlEntityDecode($string, $quote_style = ENT_COMPAT, $charset = null) {

	if( is_null( $charset )) {
		$charset = acajoom_mail::acaGetCharset();
	}
	if( function_exists( 'html_entity_decode' )) {
		return @html_entity_decode( $string, $quote_style, $charset );
	}

    if (!is_int($quote_style) && !is_null($quote_style)) {
        user_error(__FUNCTION__.'() expects parameter 2 to be long, ' .
            gettype($quote_style) . ' given', 'warning');
        return;
    }
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);

    $trans_tbl['&#039;'] = '\'';

    if ($quote_style & ENT_NOQUOTES) {
        unset($trans_tbl['&quot;']);
    }

    return strtr($string, $trans_tbl);
}


function acaGetCharset() {
	$iso = explode( '=', _ISO );
	if( !empty( $iso[1] )) {
		return $iso[1];
	}
	else {
		return 'UTF-8';
	}
}


 }

