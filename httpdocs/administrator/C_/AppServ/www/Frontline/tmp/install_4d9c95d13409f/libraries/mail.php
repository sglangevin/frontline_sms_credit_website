<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.mail.mail');

class MYMailer
{
	var $mail		= null;	
	var $subject	= '';
	var $body		= '';
	
	function MYMailer()
	{
		$mainframe		=& JFactory::getDBO();
		
		$this->mail	=& JFactory::getMailer();
	}
	
	function send($from, $recipient, $subject, $body, $html = false, $cc = NULL, $bcc = NULL, $attachment = NULL, $replyto = NULL, $replytoname = NULL)
	{
		$this->mail->setSubject($subject);
		$this->mail->setBody(stripslashes($body));

		// activate HTML formatted emails
		if($html)
			$this->mail->IsHTML(true);
	
		// Check if mail address is valid.
		$regexp	= "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$";
		
		if (is_array($recipient))
		{
			foreach ($recipient as $to)
			{
				if(!empty($to) && eregi($regexp, $to))
				{
					$this->mail->AddAddress($to);
				}
			}
		}
		else 
		{
			if(!empty($recipient) && eregi($regexp, $recipient))
			{
				$this->mail->AddAddress($recipient);
			}
		}
		
		if (isset ($cc)) 
		{
			if (is_array($cc))
			{
				foreach ($cc as $to)
				{
					$this->mail->AddCC($to);
				}
			}
			else
			{
				$this->mail->AddCC($cc);
			}
		}
		
		if (isset ($bcc))
		{
			if (is_array($bcc))
			{
				foreach ($bcc as $to)
				{
					$this->mail->AddBCC($to);
				}
			}
			else
			{
				$this->mail->AddBCC($bcc);
			}
		}
		
		if ($attachment)
		{
			if (is_array($attachment))
			{
				foreach ($attachment as $fname)
				{
					$this->mail->AddAttachment($fname);
				}
			}
			else
			{
				$this->mail->AddAttachment($attachment);
			}
		}
		

		if($replyto)
		{
			$this->mail->addReplyTo(array($replyto, $replytoname));
		}

		$status = $this->mail->Send();
		return $status;
	}
}