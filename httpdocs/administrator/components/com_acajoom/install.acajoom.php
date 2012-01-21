<?php
 defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');

### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54

 function com_install() {
 
 	 	@ini_set('max_execution_time',0);
	 	@ini_set('memory_limit','128M');

	if ( defined('JPATH_ROOT') AND class_exists('JFactory')) {	// joomla 15
		define ('ACA_JPATH_ROOT' , JPATH_ROOT );
	} else {
		define( 'ACA_JPATH_ROOT', $GLOBALS['mosConfig_absolute_path']);
	}//endif

	require_once( ACA_JPATH_ROOT . '/components/com_acajoom/defines.php');
	require_once( WPATH_ADMIN . 'config.acajoom.php');
	require_once( WPATH_ADMIN . 'admin.acajoom.html.php' );
 	require_once( WPATH_CLASS . 'class.acajoom.php');
	$update = new wupdate();
	$xf = new xonfig();
	$return = '';
	
	if ( ACA_CMSTYPE ) {
		$database =& JFactory::getDBO();
	} else {
		global $database ;
	}//endif

	if (!is_writable(ACA_JPATH_ROOT_NO_ADMIN . $acajoomConfigFile['upload_url'])){
		@chmod(ACA_JPATH_ROOT_NO_ADMIN . $acajoomConfigFile['upload_url'], 0777);
	}

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../administrator/components/com_acajoom/images/acajoom_icon.png'
	  WHERE admin_menu_link='option=com_acajoom'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/edit.png',
	  name='"._ACA_MENU_LIST."',
	  admin_menu_alt='"._ACA_MENU_LIST."'
	  WHERE admin_menu_link='option=com_acajoom&act=list'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/users_add.png' ,
	  name='"._ACA_MENU_SUBSCRIBERS."',
	  admin_menu_alt='"._ACA_MENU_SUBSCRIBERS."'
	  WHERE admin_menu_link='option=com_acajoom&act=subscribers'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/messaging_inbox.png' ,
	  name='"._ACA_MENU_NEWSLETTERS."',
	  admin_menu_alt='"._ACA_MENU_NEWSLETTERS."'
	  WHERE admin_menu_link='option=com_acajoom&act=mailing&listype=1'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/messaging_config.png' ,
	  name='"._ACA_MENU_AUTOS."',
	  admin_menu_alt='"._ACA_MENU_AUTOS."'
	  WHERE admin_menu_link='option=com_acajoom&act=mailing&listype=2'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/query.png' ,
	   name='"._ACA_MENU_STATS."',
	   admin_menu_alt='"._ACA_MENU_STATS."'
	  WHERE admin_menu_link='option=com_acajoom&act=statistics'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/menus.png' ,
	   name='"._ACA_MENU_CONF."',
	   admin_menu_alt='"._ACA_MENU_CONF."'
	  WHERE admin_menu_link='option=com_acajoom&act=configuration'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/restore.png' ,
	  name='"._ACA_MENU_UPDATE."',
	  admin_menu_alt='"._ACA_MENU_UPDATE."'
	  WHERE admin_menu_link='option=com_acajoom&act=update'";

	  $query[] = "UPDATE #__components
	  SET admin_menu_img='../includes/js/ThemeOffice/credits.png' ,
	  name='"._ACA_MENU_ABOUT."',
	  admin_menu_alt='"._ACA_MENU_ABOUT."'
	  WHERE admin_menu_link='option=com_acajoom&act=about'";
	$q = " SELECT `text` FROM `#__acajoom_xonfig` WHERE `akey` = 'version' ";
	$database->setQuery($q);
	$vers = $database->loadResult();
	$err = $database->getErrorMsg();
	if (!empty($err)) {
		$q = " SELECT `text` FROM `#__acajoom_xonfig` WHERE `key` = 'version' ";
		$database->setQuery($q);
		$vers = $database->loadResult();
		if (!empty($vers) AND $update->checkVersion($vers, '1.0.6')) {
			### UPDATE database if before 1.0.7

					$query[] = "ALTER TABLE `#__acajoom_mailings` CHANGE `images` `images` TEXT NOT NULL ";

					$query[] = "ALTER TABLE `#__acajoom_lists` ADD `footer` TINYINT( 1 ) NOT NULL DEFAULT '1' ";

					$query[] = "ALTER TABLE `#__acajoom_lists` ADD `notify_id` INT( 10 ) NOT NULL DEFAULT '0' ";

					$query[] = "ALTER TABLE `#__acajoom_xonfig` DROP INDEX `key` ";

					$query[] = "ALTER TABLE `#__acajoom_xonfig` CHANGE `key` `akey` VARCHAR( 32 ) NOT NULL ";

					$query[] = "ALTER TABLE `#__acajoom_xonfig` CHANGE `value` `value` INT( 11 ) NOT NULL ";

					$query[] = "ALTER TABLE `#__acajoom_stats_global` DROP `listid`  ";

					$query[] = "ALTER TABLE `#__acajoom_stats_global` DROP INDEX `listid` ";

					$query[] = "ALTER TABLE `#__acajoom_stats_global` ADD PRIMARY KEY ( `mailing_id` ) ";

					$query[] = "ALTER TABLE `#__acajoom_stats_details` DROP `listid` ";

					$query[] = "ALTER TABLE `#__acajoom_stats_details` DROP INDEX `listid` ";

					$query[] = "ALTER TABLE `#__acajoom_stats_details` ADD PRIMARY KEY ( `mailing_id` , `subscriber_id` ) ";
		### 1.0.9

					$query[] = " ALTER TABLE `#__acajoom_mailings` CHANGE `fromname` `fromname` VARCHAR( 64 ) NOT NULL  ";

					$query[] = " ALTER TABLE `#__acajoom_lists` CHANGE `sendername` `sendername` VARCHAR( 64 ) NOT NULL  ";
		}
	}

	if (empty($err) AND !empty($vers) AND $update->checkVersion($vers, '1.0.8')) {

			$query[] = " ALTER TABLE `#__acajoom_mailings` CHANGE `fromname` `fromname` VARCHAR( 64 ) NOT NULL  ";

			$query[] = " ALTER TABLE `#__acajoom_lists` CHANGE `sendername` `sendername` VARCHAR( 64 ) NOT NULL  ";
	### upgrade path for new versions

			$xf->insert('wait_for_user' , '0', 0);
			$xf->insert('report_site' , 'http://www.ijoobi.com', 0);
		 	$xf->insert('use_sef', '0', 0);
		 	$xf->insert('send_error', '1', 0);
		 	$xf->insert('report_error', '1', 0);
		 	$xf->insert('wait_for_user', '0', 0);
		 	$xf->insert('show_archive', '1', 0);
			$xf->insert('update_notification' ,'1', 0);
			$xf->update('send_log_address' , '@ijoobi.com');
			$xf->update('update_url' , 'http://www.ijoobi.com/update/');
	}
	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.1.0')) {

		$query[] = "ALTER TABLE `#__acajoom_lists` ADD `notification` INT( 10 ) NOT NULL DEFAULT '0' ";

		$xf->update('listname1' , '_ACA_NEWSLETTER' );
		$xf->update('listnames1' , '_ACA_MENU_NEWSLETTERS' );
	}
	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.1.4')) {
		$xf->insert('last_sub_update' ,'', 0);
		$xf->insert('level' ,'1', 0);
	}

	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.3.0')) {
		$xf->insert('show_author' ,'0', 0);
	}

	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.5.5')) {
		$xf->insert('addEmailRedLink' ,'0', 0);
	}

	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.5.5')) {
		$query[] = " ALTER TABLE `#__acajoom_subscribers` ADD INDEX `subscribe_date` ( `subscribe_date` )   ";
		$query[] = " ALTER TABLE `#__acajoom_queue` CHANGE `subscriber_id` `subscriber_id` INT( 11 ) DEFAULT '0' NOT NULL  ";
	}

	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '1.6.4')) {
		$xf->insert('show_jcalpro' ,'0', 0);
		$xf->insert('redirectconfirm','',0);
		$xf->insert('itemidAca' ,'99', 0);
	}

 	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '3.2.0')) {
		$xf->insert('fullcheck' ,'0', 0);
	}
	
	$query2 = "SHOW COLUMNS FROM `#__acajoom_lists` ";
	$database->setQuery($query2);
	$columns = $database->loadResultArray();
	if ( !in_array( 'cat_id', $columns ) ) $query[] = "ALTER TABLE `#__acajoom_lists` CHANGE `choose_time` `cat_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'";
	if ( !in_array( 'next_date', $columns ) ) $query[] = "ALTER TABLE `#__acajoom_lists` ADD `next_date` INT( 11 ) NOT NULL AFTER `notify_id` ";
	if ( !in_array( 'start_date', $columns ) ) $query[] = "ALTER TABLE `#__acajoom_lists` ADD `start_date` DATE NOT NULL AFTER `next_date`";

	$query[] = 'UPDATE `#__acajoom_lists` SET `acc_level` = 24 WHERE `acc_level` = 0';

	foreach( $acajoomConfigFile as $key=>$val ) {
		if ( !isset($GLOBALS[ACA.$key]) ) $xf->insert( $key ,$val, 0);
	}
	if (!empty($vers) AND $update->checkVersion($vers, '1.2.2') ) {
		$query[] = "UPDATE `#__acajoom_lists` SET `acc_id` = '29' WHERE `acc_id` = '25' " ;
	}
	
 	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '3.0.0')) {
		$xf->insert('disabletooltip' ,'0', 0);
		$xf->insert('minisendmail','0',0);
	}

	$query[] = "ALTER TABLE `#__acajoom_lists` CHANGE `cat_id` `cat_id` VARCHAR( 250 ) NOT NULL DEFAULT ''";
	
  	if (empty($err) AND !empty($vers)
	AND $update->checkVersion($vers, '3.2.3')) {
		$xf->insert('embed_images' ,'0', 0);
		$xf->insert('clean_stats' ,'90', 0);
		$xf->insert('word_wrap' ,'0', 0);
		$query[] = "UPDATE `#__acajoom_lists` SET `cat_id`  = CONCAT(`cat_id`,':',`notify_id`), `notify_id`= 0 WHERE `list_type` = 7 AND `notify_id` > 0";
	}
	
	//Query to quickly synchronise all your subscribers during the install!
	$query[] = "INSERT IGNORE INTO `#__acajoom_subscribers` ( `user_id` , `name` , `email` , `receive_html` , `confirmed` , `blacklist` , `subscribe_date` )" .
			"SELECT U.id, U.name, U.email, '1', '1', U.block , U.registerDate from `#__users` as U;";

	if ( !defined('WADMIN') ) define('WADMIN', 'administrator' .DS . 'components' . DS . 'com_acajoom' . DS );
	if ( !defined('WFRONT') ) define('WFRONT', 'components' . DS . 'com_acajoom' . DS );
	$file[] = 'templates';
	$file[] = 'templates/default';
	$file[] = 'templates/index.html';
	$file[] = 'templates/default/default.html';
	$file[] = 'templates/default/tpl0_abovefooter.jpg';
	$file[] = 'templates/default/tpl0_powered_by.gif';
	$file[] = 'templates/default/tpl0_spacer.gif';
	$file[] = 'templates/default/tpl0_top_header.jpg';
	$file[] = 'templates/default/tpl0_underban.jpg';
	$file[] = 'templates/default/index.html';
	foreach( $file as $key5 => $ins ) {
		if ( !file_exists( ACA_JPATH_ROOT .DS.WFRONT.$ins) && file_exists( ACA_JPATH_ROOT .DS.WADMIN.$ins) )
		 @rename( ACA_JPATH_ROOT.DS.WADMIN.$ins, ACA_JPATH_ROOT.DS.WFRONT.$ins );
	}
	$size = sizeof($query);
	for ($index = 0; $index < $size; $index++) {
		$database->setQuery($query[$index]);
		$database->query();
	}

	if (empty($vers)) {
		$xf->filetoDatabase($acajoomConfigFile);
	}

	$return .= setupMaiOptions($acajoomConfigFile);
	$return .= installBots();
	$return .= installModule();

	if (acajoom::checkCB()) $return .= installPlugin();
	subscribers::updateSubscribers( true, true );
	require_once( WPATH_ADMIN . 'version.php' );
	$xf->update('component',$localVersion['component'] );
	$xf->update('type',$localVersion['type'] );
	$xf->update('version',$localVersion['version'] );
	$xf->update('level',$localVersion['level'] );

	$message = acajoom::printM('noimage' , _ACA_THANKYOU);
	 backHTML::_header( _ACA_MENU_INSTALL , 'install.png' , $message , '', '' );
	if ( $acajoomConfigFile['type'] =='PRO' ) {
		 backHTML::about();
	} elseif ( $acajoomConfigFile['type'] =='Plus' ) {
		 backHTML::installPRO();
	} else {
		 backHTML::installPlus();
	}
	$link = 'index2.php?option=com_acajoom&act=start';
	echo '<table style="width: 100%; text-align: left; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0"><tbody><tr>' .
			'<td style=" width: 140px;">&nbsp;</td><td style="text-align: center; vertical-align: middle; width: 140px;"><div id="cpanel">';
	 backHTML::quickiconButton( $link, 'inbox.png', _ACA_GET_STARTED, false, 'admin' );
	echo '</div><td></td></td></tr></tbody></table>'.'<div style="clear:both;"></div>';
	echo '<br/><br/><br/><br/>';
	echo '<a href="http://www.ijoobi.com/index.php?option=com_content&view=article&id=7871:installation-errors&catid=29:acajoom&Itemid=72" target="_blank">If you have any error during the install process, please refer to our documentation at http://www.ijoobi.com/index.php?option=com_content&view=article&id=7871:installation-errors&catid=29:acajoom&Itemid=72</a>';
	echo '<br/><br/>';
	echo $return;
	return $return;
 }
 function setupMaiOptions($acajoomConfigFile) {

		$xf = new xonfig();
		$return =  '<br />' ._ACA_INSTALL_CONFIG .' : ';
		$config = array();
		$exist = acajoom::checkExisting();
		if ($exist['news1']==0) $config['news1'] = '0';
		if ($exist['news2']==0) $config['news2'] = '0';
		if ($exist['news3']==0) $config['news3'] = '0';


		if ( ACA_CMSTYPE ) {	// joomla 15
			$conf	=& JFactory::getConfig();
			$config['emailmethod'] = $conf->getValue('config.mailer');
			$config['sendmail_path'] = $conf->getValue('config.sendmail');
			$config['sendmail_from'] = $conf->getValue('config.mailfrom');
			$config['sendmail_name'] = $conf->getValue('config.fromname');
			$config['smtp_host'] = $conf->getValue('config.smtphost');
			$config['smtp_auth_required'] = $conf->getValue('config.smtpauth');
			$config['smtp_username'] = $conf->getValue('config.smtpuser');
			$config['smtp_password'] = $conf->getValue('config.smtppass');
			$config['confirm_fromname'] = $conf->getValue('config.fromname');
			$config['confirm_fromemail'] = $conf->getValue('config.mailfrom');
			$config['confirm_return'] = $conf->getValue('config.mailfrom');
		} else {									//joomla 1x
			$config['emailmethod'] = $GLOBALS['mosConfig_mailer'];
			$config['sendmail_path'] = $GLOBALS['mosConfig_sendmail'];
			$config['sendmail_from'] = $GLOBALS['mosConfig_mailfrom'];
			$config['sendmail_name'] = $GLOBALS['mosConfig_fromname'];
			$config['smtp_host'] = $GLOBALS['mosConfig_smtphost'];
			$config['smtp_auth_required'] = $GLOBALS['mosConfig_smtpauth'];
			$config['smtp_username'] = $GLOBALS['mosConfig_smtpuser'];
			$config['smtp_password'] = $GLOBALS['mosConfig_smtppass'];
			$config['confirm_fromname'] = $GLOBALS['mosConfig_fromname'];
			$config['confirm_fromemail'] = $GLOBALS['mosConfig_mailfrom'];
			$config['confirm_return'] = $GLOBALS['mosConfig_mailfrom'];
		}//endif


		$config['date_update'] = acajoom::getNow();

		for ($index = 0; $index < $acajoomConfigFile['nblist'] ; $index++) {
			$xf->insert('listname'.$index , '', 0);
			$xf->insert('listnames'.$index , '', 0);
			$xf->insert('listype'.$index , '', 0);
			$xf->insert('listshow'.$index , '', 0);
			$xf->insert('classes'.$index , '', 0);
			$xf->insert('listlogo'.$index , '', 0);
			$xf->insert('totallist'.$index , '', 0);
			$xf->insert('act_totallist'.$index , '', 0);
			$xf->insert('totalmailing'.$index , '', 0);
			$xf->insert('totalmailingsent'.$index , '', 0);
			$xf->insert('act_totalmailing'.$index , '', 0);
			$xf->insert('totalsubcribers'.$index , '', 0);
			$xf->insert('act_totalsubcribers'.$index , '', 0);
		}

		$activeList = '1';
		$config['classes1'] ='newsletter';
		$config['classes2'] ='autoresponder';
		$config['classes7'] ='autonews';

		$xf->insert('activelist' ,$activeList, 0, true);
		$xf->insert('option' ,'com_sdonkey', 0, true);

		$config['listype0'] = '1';
		$config['listname0'] = '';
		$config['listnames0'] = _ACA_MAILING_ALL;
		$config['listshow0'] = '1';
		$config['listlogo0'] = 'addedit.png';
		$config['classes0'] ='';

		$config['listype1'] = '1';
		$config['listname1'] = '_ACA_NEWSLETTER';
		$config['listnames1'] = '_ACA_MENU_NEWSLETTERS';
		$config['listshow1'] = '1';
		$config['listlogo1'] = 'inbox.png';

		$nb = explode(',', $activeList);
		$size = sizeof($nb);
		for($k = 0; $k < $size; $k ++) {
			$index = $nb[$k];
			if (class_exists($config['classes'.$index])) {
				$classConfig = new $config['classes'.$index];
				$config = array_merge($config, $classConfig->getActive());
			}
		}
		wupdate::queue2();
		if ($xf->saveConfig($config)) $return .= acajoom::printM('green' , _ACA_INSTALL_SUCCESS).'<br />'; else $return .='Configuration file not updated.<br />';
	 return $return;
 }
 function installBots() {
		return 	(ACA_CMSTYPE) ? installBots15() : installBots_11x();
 }

 function installBots_11x() {
	 global  $database;
	$error = '';
	 $return = '<b>'._ACA_INSTALL_BOT.'</b> : ';

	 if(!is_dir(ACA_JPATH_ROOT . '/mambots/acajoom')){
		 if(!@mkdir(ACA_JPATH_ROOT . '/mambots/acajoom', 0755)) {
			 $return .= '<br /> Error adding bot directory.';
		 }else{
		 	 @chmod(ACA_JPATH_ROOT . '/mambots/acajoom', 0755);
		 }
	 }

	 $bot_files = array('acajoombot.php', 'acajoombot.xml', 'index.html');
	 foreach ($bot_files as $bot_file) {

		 if (is_file(ACA_JPATH_ROOT . '/mambots/acajoom/' . $bot_file)) {

			 @unlink( WPATH_ADMIN . 'bots/' . $bot_file);
		 } else if (!@rename( WPATH_ADMIN . 'bots/' . $bot_file, ACA_JPATH_ROOT . '/mambots/acajoom/' . $bot_file)) {

			 $error .= '<br />Error copying bot file ' . $bot_file . ' to bot directory.';
		 }
	 }
	 @chmod(ACA_JPATH_ROOT . '/mambots/acajoom', 0755);
	 if (!@rmdir( WPATH_ADMIN . 'bots/')) {
		 $error .= '<br /> Error deleting the temporary bot directory.';
	 }
	 ### Acajoom bot

	 $bot_infos = array('Acajoom Content Bot', 'acajoombot');
	 foreach ($bot_infos as $bot_info) {
		 $query = "SELECT `id` FROM `#__mambots` WHERE `element` = 'acajoombot'" ;
		 $database->setQuery($query);
		 $database->query();
		 $error .= $database->getErrorMsg();
		 if (!empty($error)) {
			 $error .= '<br /> Error getting bot information from bot table for "' . $bot_info[0] . '". Database error: <br />' . $error . '<br />';
		 } else {
			 $id = $database->loadResult();
			 if (!$id) {
				 $row = new mosMambot($database);
				 $row->name = $bot_infos[0];
				 $row->ordering = 0;
				 $row->folder = 'acajoom';
				 $row->iscore = 0;
				 $row->access = 0;
				 $row->client_id = 0;
				 $row->element = $bot_infos[1];
				 $row->published = 1;
				 if (!$row->store()) {
					$error .= '<br />Error adding bot information to bot table for "' . $bot_info[0] . '".';
				 }
			 }
		 }
	 }
	 if (empty($error)) $return .= acajoom::printM('green' , _ACA_INSTALL_SUCCESS) .'<br />';
	 else $return .= $error.acajoom::printM('red' , _ACA_INSTALL_ERROR) .'<br />';
	 return $return;
 }


 function installModule() {

	$error = '';
	if ( ACA_CMSTYPE ) {
		$database =& JFactory::getDBO();
		$folder =  'modules'.DS.'mod_acajoom'.DS;
	//create the module Folder...
			if(!is_dir(ACA_JPATH_ROOT.DS. $folder)){
				if(!@mkdir (ACA_JPATH_ROOT.DS. $folder,0755)){
					$error .= 'Error creating folder : '.ACA_JPATH_ROOT.DS . $folder;
				}else{
					@chmod(ACA_JPATH_ROOT.DS. $folder, 0755);
				}
			}

	} else {
		global $database ;
		$folder = 'modules'.DS;
	}//endif

	 $return = '<b>'._ACA_INSTALL_MODULE.'</b> : ';

	 $module_files = array('mod_acajoom.php', 'mod_acajoom.xml');
	 foreach ($module_files as $module_file) {

		 if (is_file(ACA_JPATH_ROOT . DS . $folder . $module_file)) {
			 @unlink( WPATH_ADMIN .'modules'.DS . $module_file);
		 } else if (!@rename( WPATH_ADMIN .'modules'.DS . $module_file, ACA_JPATH_ROOT .DS. $folder . $module_file)) {

			 $error .= '<br /> Error copying module file ' . $module_file . ' to module directory .';
			 $error .= '<br/>From '.WPATH_ADMIN . 'modules'.DS . $module_file.' To '. ACA_JPATH_ROOT . DS.$folder . $module_file;
		 }
	 }
	 
	 if (!@unlink( WPATH_ADMIN . 'modules'.DS.'index.html')) {
	 	$error.= '<br /> Error deleting : '.WPATH_ADMIN . 'modules'.DS.'index.html';
	 }
	 elseif (!@rmdir( WPATH_ADMIN .'modules'.DS)) {
		 $error .= '<br /> Error deleting the temporary modules directory : '.WPATH_ADMIN .'modules'.DS;
	 }

	 $module_infos = array( array('Acajoom Subscriber Module', 'mod_acajoom', 'left'));
	 foreach ($module_infos as $module_info) {
		 $query = 'SELECT id FROM `#__modules` WHERE module = \'' . $module_info[1] . '\'';
		 $database->setQuery($query);
		 $database->query();
		 $sqlerror = $database->getErrorMsg();
		 if (!empty($sqlerror)) {
			 $error .= '<br />Error getting module information from module table for "' . $module_info[0] . '". Database error: <br />' . $sqlerror;
		 } else {
			 $id = $database->loadResult();
			 if (!$id) {

				if ( ACA_CMSTYPE ) {
					JLoader::register('JTableModule'   , JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'module.php');
					 $row = new JTableModule($database);
				} else {
					 $row = new mosModule($database);
				}//endif

				 $row->title = $module_info[0];
				 $row->ordering = 99;
				 $row->iscore = 0;
				 $row->client_id = 0;
				 $row->showtitle = 1;
				 $row->position = $module_info[2];
				 $row->access = 0;
				 $row->module = $module_info[1];
				 $row->published = 0;
				 if (!$row->store()) {
					$error .= '<br />Error adding module information to module table for "' . $module_info[0] . '".';
				 }
			 }
		 }
	 }
	 if (empty($error)) $return .= acajoom::printM('green' , _ACA_INSTALL_SUCCESS) .'<br />';
	 else $return .= $error.acajoom::printM('red' , _ACA_INSTALL_ERROR) .'<br />';

	 return $return;
 }
 function installPlugin() {

		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif

	 $return = '<b>'._ACA_INSTALL_PLUGIN.'</b> : ';

	$error = '';

	 $files = array('acajoom_cb.php', 'acajoom_cb.xml' , 'index.html');
	 if (!is_file(ACA_JPATH_ROOT . '/components/com_comprofiler/plugin/user/plug_acajoomcbplugin/acajoom_cb.php')) {
	 	@mkdir(ACA_JPATH_ROOT .'/components/com_comprofiler/plugin/user/plug_acajoomcbplugin', 0755);
	 	@chmod(ACA_JPATH_ROOT .'/components/com_comprofiler/plugin/user/plug_acajoomcbplugin', 0755);
	 }
	 foreach ($files as $file) {

		 if (is_file(ACA_JPATH_ROOT . '/components/com_comprofiler/plugin/user/plug_acajoomcbplugin/' . $file)) {

			 @unlink( WPATH_ADMIN . 'cbplugin/' . $file);
		 } else if (!@rename( WPATH_ADMIN . 'cbplugin/' . $file, ACA_JPATH_ROOT .'/components/com_comprofiler/plugin/user/plug_acajoomcbplugin/' . $file)) {

			 $error .= '<br /> Error copying plugin file ' . $file . ' to CB plugin directory.';
		 }
	 }
	 if (is_file(ACA_JPATH_ROOT . '/components/com_comprofiler/plugin/user/plug_acajoomcbplugin/acajoom_cb.php')) {
	 	@chmod(ACA_JPATH_ROOT .'/components/com_comprofiler/plugin/user/plug_acajoomcbplugin', 0755);
	 }
	 if (!@rmdir( WPATH_ADMIN . 'cbplugin/')) {
		 $error .= '<br /> Error deleting the temporary cbplugin directory.';
	 }

	 $query = "SELECT `id` FROM `#__comprofiler_plugin` WHERE `folder` = 'plug_acajoomcbplugin' " ;
	 $database->setQuery($query);
	 $database->query();
	 $id = $database->loadResult();
	 $mysqlerror = $database->getErrorMsg();
	 if (!empty($mysqlerror)) {
		 $error .= '<br />Error getting plugin information from cb plugin table. Database error: <br />' . $mysqlerror . '';
	 } else {
		 if ($id<1) {
			 $row->name = 'Acajoom CB Plugin';
			 $row->element = 'acajoom_cb';
			 $row->type = 'user';
			 $row->folder = 'plug_acajoomcbplugin';
			 $row->ordering = '99';
			$query = "INSERT INTO `#__comprofiler_plugin` (`name` , `element`, `type`, `ordering`, `folder`) VALUES ( ".
				"'$row->name', ".
				"'$row->element', ".
				"'$row->type', ".
				"'$row->ordering', ".
				" '$row->folder' ) ";
			$database->setQuery($query);
			$database->query();
			$error .= $database->getErrorMsg();
			 if (!empty($error)) {
				$error .= '<br />Error adding plug information to CB plug table.';
			 }
			 $query = "SELECT `id` FROM `#__comprofiler_plugin` WHERE `folder` = 'plug_acajoomcbplugin' " ;
			 $database->setQuery($query);
			 $database->query();
			 $id = $database->loadResult();
			 $error .= $database->getErrorMsg();
			 $row = '';
			 $row->title = 'Mailing Lists';
			 $row->description = 'Listing of all the mailing lists for Acajoom';
			 $row->ordering = '99';
			 $row->width = '.5';
			 $row->enabled = '0';
			 $row->pluginclass = 'getAcajoomTab';
			 $row->pluginid = $id;
			 $row->sys = '0';
			 $row->params = 'NULL';
			 $row->displaytype = 'tab';
			 $row->position = 'cb_tabmain';
			$query = "INSERT INTO `#__comprofiler_tabs` (`title` , `description`, `ordering`, `width`, `enabled`, " .
					" `pluginclass` , `pluginid`, `sys`, `displaytype`, `params` , `position` ) VALUES ( ".
				"'$row->title', ".
				"'$row->description', ".
				"'$row->ordering', ".
				"'$row->width', ".
				"'$row->enabled', ".
				"'$row->pluginclass', ".
				"'$row->pluginid', ".
				"'$row->sys', ".
				"'$row->displaytype', ".
				"'$row->params', ".
				"'$row->position' ) ";
			$database->setQuery($query);
			$database->query();
			 $error .= $database->getErrorMsg();
			 if (!empty($error)) {
				$error .= '<br />Error adding plug information to CB tab table.';
			 }
		 }
	 }
	 if (empty($error)) {
		$xf = new xonfig();
	 	$xf->update('cb_pluginInstalled', '1');
	 	$return .= acajoom::printM('green' , _ACA_INSTALL_SUCCESS) .'<br />';
	 } else {
	 	$return .= $error.acajoom::printM('red' , _ACA_INSTALL_ERROR) .'<br />';
	 }
	 return $return;
 }
 function installBots15() {

	$database =& JFactory::getDBO();

	$error = '';
	 $return = '<b>'._ACA_INSTALL_BOT.'</b> : ';

	 if(!is_dir(ACA_JPATH_ROOT . '/plugins/acajoom')){
		 if(!@mkdir(ACA_JPATH_ROOT . '/plugins/acajoom', 0755)) {
			 $return .= '<br /> Error adding bot directory.';
		 }else{
		 	@chmod(ACA_JPATH_ROOT . '/plugins/acajoom', 0755);
		 }
	 }

	 $bot_files = array('acajoombot.php', 'acajoombot.xml', 'index.html');
	 foreach ($bot_files as $bot_file) {

		 if (is_file(ACA_JPATH_ROOT . '/plugins/acajoom/' . $bot_file)) {

			 @unlink( WPATH_ADMIN . 'bots15/' . $bot_file);
		 } else if (!@rename( WPATH_ADMIN . 'bots15/' . $bot_file, ACA_JPATH_ROOT . '/plugins/acajoom/' . $bot_file)) {

			 $error .= '<br />Error copying bot file ' . $bot_file . ' to bot directory.';
		 }
	 }
	 @chmod(ACA_JPATH_ROOT . '/plugins/acajoom', 0755);
	 if (!@rmdir( WPATH_ADMIN . 'bots15/')) {
		 $error .= '<br /> Error deleting the temporary bot directory.';
	 }
	 ### Acajoom bot

	 $bot_infos = array('Acajoom Content Bot', 'acajoombot');
	 foreach ($bot_infos as $bot_info) {
		 $query = "SELECT `id` FROM `#__plugins` WHERE `element` = 'acajoombot'" ;
		 $database->setQuery($query);
		 $database->query();
		 $error .= $database->getErrorMsg();
		 if (!empty($error)) {
			 $error .= '<br /> Error getting bot information from bot table for "' . $bot_info[0] . '". Database error: <br />' . $error . '<br />';
		 } else {
			 $id = $database->loadResult();
			 if (!$id) {

				JLoader::register('JTablePlugin'   , JPATH_LIBRARIES.DS.'joomla'.DS.'database'.DS.'table'.DS.'plugin.php');

				 $row = new JTablePlugin($database);
				 $row->name = $bot_infos[0];
				 $row->ordering = 0;
				 $row->folder = 'acajoom';
				 $row->iscore = 0;
				 $row->access = 0;
				 $row->client_id = 0;
				 $row->element = $bot_infos[1];
				 $row->published = 1;
				 if (!$row->store()) {
					$error .= '<br />Error adding bot information to bot table for "' . $bot_info[0] . '".';
				 }
			 }
		 }
	 }
	 if (empty($error)) $return .= acajoom::printM('green' , _ACA_INSTALL_SUCCESS) .'<br />';
	 else $return .= $error.acajoom::printM('red' , _ACA_INSTALL_ERROR) .'<br />';
	 return $return;
 }

