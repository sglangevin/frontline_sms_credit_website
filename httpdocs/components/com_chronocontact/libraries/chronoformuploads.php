<?php
defined('_JEXEC') or die('Restricted access'); 

class CFUploads extends JObject{
	var $thisformid;
	var $attachments;
	function __construct($formid){		
		if (!isset($formid)) {
			JError::raiseWarning( '1001', 'LOADING FAILED::Uploads Class' );
			$retval = false;
			return $retval;
		}
		else
		{
			//initialise
			$this->thisformid = $formid;
			$this->attachments = array();
		}
	}
	function &getInstance($formid){
		static $instances;
		if (!isset ($instances)) {
			$instances = array (  );
		}
		if (empty($instances[$formid])) {
			$instances[$formid] = new CFUploads($formid);
		}
		return $instances[$formid];
	}
	function deleteUploads()
	{
		global $mainframe;
		jimport('joomla.utilities.error');
		jimport('joomla.filesystem.file');
		$uploads = $this->attachments;
		foreach($uploads as $upload){
			JFile::delete($upload);
		}
	}
	function handleUploads($posted = array()){
		global $mainframe;
		$database =& JFactory::getDBO();
		if(empty($posted)){
			$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		}
		//form instance
		//$MyForm =& CFChronoForm::getInstance();
		$formname = CFChronoForm::getFormName($this->thisformid);
		$MyForm =& CFChronoForm::getInstance($formname);
		
		$attachments = array();
		if ( is_array($MyForm->formparams('uploadfields')) ) {
			$MyForm->setFormParam('uploadfields', implode('|', $MyForm->formparams('uploadfields')));
		} else {
			$MyForm->setFormParam('uploadfields', $MyForm->formparams('uploadfields'));
		}
		if ( trim($MyForm->formparams('uploads') == 'Yes' ) && trim($MyForm->formparams('uploadfields')) ) {
			jimport('joomla.utilities.error');
			jimport('joomla.filesystem.file');
			if(!JFile::exists(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'uploads'.DS.$MyForm->formrow->name.DS.'index.html')){
				if(!JFolder::create(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'uploads'.DS.$MyForm->formrow->name)){
					JError::raiseWarning(100, 'Couldn\'t create upload directroy 1');
				}
				if(!JFile::write(JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'uploads'.DS.$MyForm->formrow->name.DS.'index.html', 'NULL')){
					JError::raiseWarning(100, 'Couldn\'t create upload directroy 2');
				}
			}
			$allowed_s1 = explode(",", trim($MyForm->formparams('uploadfields')));
	
			foreach ( $allowed_s1 as $allowed_1 ) {
				$allowed_s2      = explode(":", trim($allowed_1));
				$allowed_s3      = explode("|", trim($allowed_s2[1]));
				$allowed_s4      = explode("{", trim($allowed_s3[count($allowed_s3) - 1]));
				$allowed_s3[count($allowed_s3) - 1]	= $allowed_s4[0];
				$allowed_s5      = explode("-", str_replace('}', '', trim($allowed_s4[1])));
				$chronofile 	= JRequest::getVar( $allowed_s2[0], array("error" => 4), 'files', 'array' );
				if($chronofile["error"] == 0){
					if($chronofile['error']){
						$MyForm->addDebugMsg('PHP returned this error for file upload by : '.$allowed_s2[0].', PHP error is: '.$chronofile['error']);
					}else{
						$MyForm->addDebugMsg('Upload routine started for file upload by : '.$allowed_s2[0]);
					}
					$chronofile['name']	= JFile::makeSafe($chronofile['name']);
					$original_name   = $chronofile['tmp_name'];
					$filename        = date('YmdHis').'_'.preg_replace('`[^a-z0-9-_.]`i','',$chronofile['name']);
					$fileok          = true;
					$posted[$allowed_s2[0]] = ' NOFILE ';
					JRequest::setVar($allowed_s2[0], ' NOFILE ');
					if($chronofile['error']  == 1){
						$fileok = false;
						$MyForm->addErrorMsg('Sorry, Your uploaded file size exceeds the allowed limit.', md5('chrono'));
					}
					if ( $original_name ) {
						if ( ($chronofile["size"] / 1024) > trim($allowed_s5[0]) ) {
							$fileok = false;
							$MyForm->addErrorMsg('Sorry, Your uploaded file size exceeds the allowed limit.', md5('chrono'));
						}
						if ( ($chronofile["size"] / 1024) < trim($allowed_s5[1]) ) {
							$fileok = false;
							$MyForm->addErrorMsg('Sorry, Your uploaded file size is less than the allowed limit', md5('chrono'));
						}
						$fn     = $chronofile['name'];
						$fext   = substr($fn, strrpos($fn, '.') + 1);
						if ( !in_array(strtolower($fext), $allowed_s3) ) {
							$fileok = false;
							$MyForm->addErrorMsg('Sorry, Your uploaded file type is not allowed', md5('chrono'));
						}
						if ( $fileok ) {
							$uploadpath = $MyForm->formparams('uploadpath') ? $MyForm->formparams('uploadpath') : JPATH_SITE.DS.'components'.DS.'com_chronocontact'.DS.'uploads'.DS.$MyForm->formrow->name.DS;
							$uploadedfile = JFile::upload($original_name, $uploadpath.$filename);
							$posted[$allowed_s2[0]] = $filename;
							JRequest::setVar($allowed_s2[0], $filename);
							if ( $uploadedfile ) {
								$attachments[$allowed_s2[0]] = $uploadpath.$filename;
								$MyForm->addDebugMsg($uploadpath.$filename.' has been uploaded OK');
							}else{
								$MyForm->addDebugMsg($uploadpath.$filename.' has NOT been uploaded!!');
							}
						}
					}
				}
			}
			$this->attachments = $attachments;
		}
		return $posted;
	}
}