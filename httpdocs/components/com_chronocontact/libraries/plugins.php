<?php
defined('_JEXEC') or die('Restricted access'); 

class CFPlugins extends JObject{
	var $thisformid;
	function __construct($formid){		
		if (!isset($formid)) {
			JError::raiseWarning( '1001', 'LOADING FAILED::Plugins Class' );
			$retval = false;
			return $retval;
		}
		else
		{
			//initialise
			$this->thisformid = $formid;
		}
		//load all plugins into class variables
		$directory = JPATH_SITE.'/components/com_chronocontact/plugins/';
		$results = array();
		$handler = opendir($directory);
		while ($file = readdir($handler)) {
			if ( $file != '.' && $file != '..' && substr($file, -4) == '.php' && substr($file, 0, 3) == 'cf_')
				$results[] = str_replace(".php","", $file);
		}
		closedir($handler);
		
		foreach($results as $result){
			//add plugin keys
			require_once(JPATH_SITE."/components/com_chronocontact/plugins/".$result.".php");
			${$result} = new $result();
			if(!empty(${$result}->plugin_keys)){
				$pluginkeys = explode(",", ${$result}->plugin_keys);
				$keys = array();
				foreach($pluginkeys as $pluginkey){
					$keys[$pluginkey] = '';
				}
				$this->$result = $keys;
			}
		}
	}
	function &getInstance($formid){
		static $instances;
		if (!isset ($instances)) {
			$instances = array (  );
		}
		if (empty($instances[$formid])) {
			$instances[$formid] = new CFPlugins($formid);
		}
		return $instances[$formid];
	}
	function runPlugin( $emailevent, $events = array('ONSUBMIT', 'ONLOADONSUBMIT'), $pluginname = '' )
	{
		global $mainframe;
		$database =& JFactory::getDBO();
		$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		//form instance
		$formname = CFChronoForm::getFormName($this->thisformid);
		$MyForm =& CFChronoForm::getInstance($formname);
		$qouted_events = array();
		foreach($events as $event){
			$qouted_events[] = $database->Quote($event);
		}
		$pluginevent = implode(",", $qouted_events);
		//emails instance
		$ava_plugins = explode(",",$MyForm->formparams('plugins'));
		$ava_plugins_order = explode(",",$MyForm->formparams('mplugins_order'));
		
		array_multisort($ava_plugins_order, $ava_plugins);
		//if a plugin name is specified then execute it only
		if($pluginname){
			$ava_plugins = explode(",", $pluginname);
		}
		
		foreach($ava_plugins as $ava_plugin){
			$query     = "SELECT * FROM `#__chrono_contact_plugins` WHERE `form_id` = '".$MyForm->formrow->id."' AND event IN (".$pluginevent.") AND `name` = '".$ava_plugin."'";
			$database->setQuery( $query );
			$plugins = $database->loadObjectList();
			if(count($plugins)){
				require_once(JPATH_SITE."/components/com_chronocontact/plugins/".$ava_plugin.".php");
				${$ava_plugin} = new $ava_plugin();
				$params = new JParameter($plugins[0]->params);
				$methods = get_class_methods(${$ava_plugin});
				if(in_array('onsubmit', $methods) && in_array('ONSUBMIT', $events) && in_array('ONLOADONSUBMIT', $events) && $emailevent){
					if($params->get('onsubmit') == $emailevent){
						${$ava_plugin}->onsubmit( 'com_chronocontact', $params , $plugins[0] );
					}
				}
				if(in_array('onload', $methods) && in_array('ONLOAD', $events) && in_array('ONLOADONSUBMIT', $events) && (!$emailevent)){
					$MyForm->formrow->html = ${$ava_plugin}->onload( 'com_chronocontact', $plugins[0], $params, $MyForm->formrow->html );
				}
			}
		}
	}	
}