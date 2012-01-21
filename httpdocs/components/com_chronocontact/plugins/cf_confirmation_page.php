<?php
defined('_JEXEC') or die('Restricted access'); 
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_confirmation_page  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "Confirmation Page";
	var $result_TOOLTIP = "This plugin will help you to create a confirmation page to show the user the data he/she provided before its submitted";
	var $plugin_name = "cf_confirmation_page"; // must be the same as the class name
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
	echo $pane->startPane("confirmationpage");
	echo $pane->startPanel( 'Page View', "pageview" );
	?>
	
	<table border="0" cellpadding="3" cellspacing="0">
    	<tr style="background-color:#c9c9c9 ">
			<td valign="top"><?php echo JHTML::_('tooltip', "Do you want to disable the WYSIWYG Editor for creating the confirmation page ?" ); ?></td>
			<td valign="top"><strong><?php echo "Editor Disabled"; ?>:</strong> </td>
			<td></td>
			<td>
            	<select name="params[editor]" id="params[editor]">
                    <option<?php if($paramsvalues->get('editor') == 'No'){ echo ' selected';} ?> value="No">No</option>
                    <option<?php if($paramsvalues->get('editor') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
                </select>
            </td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td valign="top"><?php echo JHTML::_('tooltip', "Do you want to enable showing the submit/back buttons in the confirmation page ?" ); ?></td>
			<td valign="top"><strong><?php echo "Buttons Enabled"; ?>:</strong> </td>
			<td></td>
			<td>
            	<select name="params[buttons]" id="params[buttons]">
                	<option<?php if($paramsvalues->get('buttons') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
                    <option<?php if($paramsvalues->get('buttons') == 'No'){ echo ' selected';} ?> value="No">No</option>                    
                </select>
            </td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "This is the confirmation page code, use {fieldname} to show any fieldname value!" ); ?></td>
			<td><strong><?php echo "Confirmation Page Code"; ?>:</strong> </td>
			<td></td>
			<td>
			<?php
				if($paramsvalues->get('editor') == 'No'){
					$editor		=& JFactory::getEditor();
					echo $editor->display( 'extra1',  $row->extra1 , '100%', '350', '75', '20', false ) ;
				}else{
			?>			
           		<textarea name="extra1" cols="85" rows="20"><?php echo $row->extra1; ?></textarea>
            <?php } ?>
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
		$my = JFactory::getUser();
		$database =& JFactory::getDBO();
		
		$session =& JFactory::getSession();		
		//get chrono instances
		$formname = JRequest::getVar( 'chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);
		$MyFormEmails =& CFEMails::getInstance($MyForm->formrow->id);
		$MyCustomCode =& CFCustomCode::getInstance($MyForm->formrow->id);
		
		if(JRequest::getVar('task') != 'beforeshow'){
			$session->set("chrono_next_step", '', md5('chrono'));
		}
		$chrono_next_step = $session->get('chrono_next_step', '', md5('chrono'));
		
		if($chrono_next_step == 'confirm'){
			if(!JRequest::checkToken()){
				echo "You are not allowed to access this URL";
				return;
			}
			$html_string = '';
			$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
			
			if(JRequest::getVar('confirm') == 'Submit'){
				
				$debug = $MyForm->formparams('debug');
				$MyFormEmails->sendEmails($MyForm, $MyFormEmails->emails);
				
				//$MyCustomCode->runCode( 'onsubmitcode' );
				//$MyCustomCode->runCode( 'autogenerated', 'after_email' );
				
				if((!$MyForm->formparams('plugins_order'))&&(!$MyForm->formparams('onsubmitcode_order'))&&(!$MyForm->formparams('autogenerated_order'))){
					$MyForm->setFormParam('autogenerated_order', 3);
					$MyForm->setFormParam('onsubmitcode_order', 2);
					$MyForm->setFormParam('plugins_order', 1);
				}
		
				for($ixx = 1 ; $ixx <= 3; $ixx++){
					/*if($MyForm->formparams->plugins_order == $ixx){
						$MyPlugins->runPlugin('after_email');
					}*/
					/**
					 * Run the On-submit 'post e-mail' code if there is any
					 */
					if($MyForm->formparams('onsubmitcode_order') == $ixx){
						$MyCustomCode->runCode( 'onsubmitcode' );
					}
		
					/**
					 * Run the SQL query if there is one
					 */
					if($MyForm->formparams('autogenerated_order') == $ixx){
						$MyCustomCode->runCode( 'autogenerated', 'after_email' );
					}
				}
				
				/**
				 * Redirect the page if requested
				 */
				if ( !$debug ) {
					if ( !empty($MyForm->formrow->redirecturl) ) {
						$mainframe->redirect($MyForm->formrow->redirecturl);
					}
				}	
				$html_string = '';			
				
			}else{
				$session->set("chrono_next_step", '', md5('chrono'));
				$MyForm->showForm($MyForm->formrow->name, $posted);
				return;
				$html_string = '';	
			}
		}
		
		return $html_string ;
		
	}
	function onsubmit( $option, $params , $row ) {
		global $mainframe;
		$database =& JFactory::getDBO();
		$pluginrow = $row;
		$posted = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
		$session =& JFactory::getSession();
		$session->set("chrono_next_step", 'confirm', md5('chrono'));
		
		$formname = JRequest::getVar( 'chronoformname');
		$MyForm =& CFChronoForm::getInstance($formname);
		//show the form
		if(!empty($MyForm->formrow->submiturl)){ 
			$actionurl = $MyForm->formrow->submiturl;			
		} else {
			$actionurl = JURI::Base().'index.php?option=com_chronocontact&amp;task=beforeshow&amp;chronoformname='.$MyForm->formrow->name;
			if((int)JRequest::getVar('Itemid')){
				$actionurl = $actionurl.'&amp;Itemid='.JRequest::getVar('Itemid');
			}
		}		
		?>
        <form name="<?php echo "ChronoContact_".$MyForm->formrow->name; ?>" id="<?php echo "ChronoContact_".$MyForm->formrow->name; ?>" method="<?php echo $MyForm->formparams('formmethod'); ?>"<?php if($MyForm->formparams('uploads') == 'Yes'){ echo ' enctype="multipart/form-data"'; } ?> action="<?php echo $actionurl; ?>" <?php echo $MyForm->formrow->attformtag; ?>>
		<?php			
		//run the confirmation page code		
		if ( !empty($pluginrow->extra1) ) {
			ob_start();
			eval( "?>".$pluginrow->extra1 );
			$extra1 = ob_get_clean();
			foreach ( $posted as $name => $post) {
				if ( is_array($post)) {
					$post = implode(", ", $post);
				}
				$extra1 = str_replace("{".$name."}", $post, $extra1);
				echo '<input type="hidden" name="'.$name.'" value="'.$post.'" />
				';
			}
			echo $extra1;
		}
		if($params->get('buttons') == 'Yes'){
			?>
            <div class="form_element cf_button">
            	<input type="submit" name="confirm" value="Submit"/>
                <input type="submit" name="confirm" value="Back"/>
            </div>
            <?php
		}
		?>
        <?php echo JHTML::_( 'form.token' ); ?>		
		</form>
		<?php
		
		//exit the form routine
		$MyForm->stoprunning = true;
		return;
	}

}
?>