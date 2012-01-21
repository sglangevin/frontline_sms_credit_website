<?php
defined('_JEXEC') or die('Restricted access'); 
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_multi_page  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "Multi Page";
	var $result_TOOLTIP = "Create Multi page forms easily, use this plugin with a mother form which will control all other child forms which will run in a chain";
	var $plugin_name = "cf_multi_page"; // must be the same as the class name
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
	echo $pane->startPane("multipage");
	echo $pane->startPanel( 'Multi Page settings', "settings" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Please enter an integer here, please don't count the last thank your page or confimation page or the onsubmit routine as a step" ); ?></td>
			<td><strong><?php echo "Number of Steps"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="50" maxlength="50" name="params[stepscount]" value="<?php echo $paramsvalues->get('stepscount'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Enter steps forms names separated by a comma, no spaces, this must meet the same number of the count above" ); ?></td>
			<td><strong><?php echo "Steps forms"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="100" maxlength="50" name="params[formsnames]" value="<?php echo $paramsvalues->get('formsnames'); ?>" /></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Enable navigating between step using the &cfformstep=n" ); ?></td>
			<td><strong><?php echo "Steps Navigation"; ?>:</strong> </td>
			<td></td>
			<td>
            <select name="params[stepsnavigation]" id="stepsnavigation">
            <option <?php if((int)$paramsvalues->get('stepsnavigation') == 0)echo "selected"; ?> value="0">No</option>
            <option <?php if((int)$paramsvalues->get('stepsnavigation') == 1)echo "selected"; ?> value="1">Yes</option>
            </select>
            </td>
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
		$session =& JFactory::getSession();
		$formname = JRequest::getVar('chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);
		$pages = explode(",", $params->get('formsnames'));
		$posted = array();
		if($session->get('chrono_form_data', array(), md5('chrono'))){
			$posted = $session->get('chrono_form_data', array(), md5('chrono'));
		}
		//$CF_PATH = ($mainframe->isSite()) ? JURI::Base() : $mainframe->getSiteURL();
		if((int)$params->get('stepsnavigation') == 1){
			$current_step = (int)JRequest::getVar('cfformstep');
		}else{
			$current_step = 1;
		}
		if($current_step && ($current_step <= (int)$params->get('stepscount'))){
			$newForm =& CFChronoForm::getInstance(trim($pages[$current_step - 1]));
			$newForm->formrow->submiturl = $newForm->getAction($MyForm->formrow->name);
			$session->set('chrono_step_'.$formname, (int)$current_step, md5('chrono'));
			$newForm->showForm($newForm->formrow->name, $posted);
		}else{
			$newForm =& CFChronoForm::getInstance(trim($pages[0]));
			$newForm->formrow->submiturl = $newForm->getAction($MyForm->formrow->name);
			$session->set('chrono_step_'.$formname, 1, md5('chrono'));
			$newForm->showForm($newForm->formrow->name, $posted);
		}
		$html_string = '';
		$MyForm->stoploading = true;
		
		return $html_string ;
		
	}
	function onsubmit( $option, $params , $row ) {
		global $mainframe;
		$database =& JFactory::getDBO();
		$session =& JFactory::getSession();
		$pluginrow = $row;
		$newposted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		$oldposted = array();
		if($session->get('chrono_form_data', array(), md5('chrono'))){
			$oldposted = $session->get('chrono_form_data', array(), md5('chrono'));
		}
		$posted = array_merge($oldposted, $newposted);
		$session->set("chrono_form_data", $posted, md5('chrono'));
		$formname = JRequest::getVar('chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);

		$pages = explode(",", $params->get('formsnames'));
		$current_step = $session->get('chrono_step_'.$formname, '', md5('chrono'));
		if($current_step != 'end'){
			if($current_step){
				$newForm =& CFChronoForm::getInstance(trim($pages[$current_step - 1]));
				$newForm->submitForm($newForm->formrow->name, $posted);
				if($current_step == (int)$params->get('stepscount')){
					$session->set('chrono_step_'.$formname, 'end', md5('chrono'));
					//$MyForm->submitForm($MyForm->formrow->name);
					return;
				}
				$nextForm =& CFChronoForm::getInstance(trim($pages[$current_step]));
				$nextForm->formrow->submiturl = $nextForm->getAction($MyForm->formrow->name);
				$nextForm->formrow->html = $nextForm->formrow->html.'<input type="hidden" name="cfformstep" value="'.$current_step.'" />';
				$session->set('chrono_step_'.$formname, $current_step + 1, md5('chrono'));
				$nextForm->showForm($nextForm->formrow->name, $posted);
			}else{
				$newForm =& CFChronoForm::getInstance(trim($pages[0]));
				$newForm->formrow->submiturl = $newForm->getAction($MyForm->formrow->name);
				$session->set('chrono_step_'.$formname, 1, md5('chrono'));
				$newForm->showForm($newForm->formrow->name, $posted);
			}
		}
		//exit the form routine
		$MyForm->stoprunning = true;
		return;
	}

}
?>