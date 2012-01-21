<?php
defined('_JEXEC') or die('Restricted access'); 
global $mainframe;
require_once( $mainframe->getPath( 'class', 'com_chronocontact' ) );
// the class name must be the same as the file name without the .php at the end
class cf_multi_language  {
	//the next 3 fields must be defined for every plugin
	var $result_TITLE = "Multi Language";
	var $result_TOOLTIP = "Define translations for any string at your form";
	var $plugin_name = "cf_multi_language"; // must be the same as the class name
	var $event = "ONLOAD"; // must be defined and in Uppercase, should be ONSUBMIT or ONLOAD
	var $plugin_keys ='';
	// the next function must exist and will have the backend config code
	function show_conf($row, $id, $form_id, $option){
	global $mainframe;
	$database =& JFactory::getDBO();
	
	$paramsvalues = new JParameter($row->params);
	$tables = $database->getTableList();
	jimport('joomla.html.pane');
	$pane   =& JPane::getInstance('tabs');
	?>
	 
	<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
    <?php
	echo $pane->startPane("multilanguage");
	echo $pane->startPanel( 'General', "general5" );
	?>
	<table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td valign="top"><?php echo JHTML::_('tooltip', "list of supported languages, in 2-2 letters form, example : en-GB,fr-FR,es-ES" ); ?></td>
			<td valign="top"><strong><?php echo "Languages Supported"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="100" name="params[languages]" value="<?php echo $paramsvalues->get('languages'); ?>" /><br /><font style="color:#FF0000">list of supported languages, in 2-2 letters form, example : en-GB,fr-FR,es-ES</font></td>
		</tr>
		<tr style="background-color:#c9c9c9 ">
			<td valign="top"><?php echo JHTML::_('tooltip', "Default language which will run when the current site language is not supported, example : en-GB" ); ?></td>
			<td valign="top"><strong><?php echo "Default Language"; ?>:</strong> </td>
			<td></td>
			<td><input type="text" class="inputbox" size="100" name="params[default_language]" value="<?php echo $paramsvalues->get('default_language'); ?>" /></td>
		</tr>
	</table>
    <?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Languages", 'Languages2' );
	?>
    <table border="0" cellpadding="3" cellspacing="0">
		<tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra1" cols="85" rows="10"><?php echo $row->extra1; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra2" cols="85" rows="10"><?php echo $row->extra2; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra3" cols="85" rows="10"><?php echo $row->extra3; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra4" cols="85" rows="10"><?php echo $row->extra4; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra5" cols="85" rows="10"><?php echo $row->extra5; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra6" cols="85" rows="10"><?php echo $row->extra6; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra7" cols="85" rows="10"><?php echo $row->extra7; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra8" cols="85" rows="10"><?php echo $row->extra8; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra9" cols="85" rows="10"><?php echo $row->extra9; ?></textarea></td>
		</tr>
        <tr style="background-color:#c9c9c9 ">
			<td><?php echo JHTML::_('tooltip', "Add your language translations here!" ); ?></td>
			<td><strong><?php echo "Language Strings"; ?>:</strong> </td>
			<td></td>
			<td><textarea name="extra10" cols="85" rows="10"><?php echo $row->extra10; ?></textarea></td>
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
	
	function onload( $option, $row, $params, $html_string ) {
		global $mainframe;
		$my 		= JFactory::getUser();
		$database =& JFactory::getDBO();
		
		$lang =& JFactory::getLanguage();
		$LangTag = $lang->getTag();
		
		$supportedLanguages = explode(",", trim($params->get('languages')));	
		$LangCount = 1;
		$LangArray = array();
		$Lang_Temp_Array = array();
		$cfLangDone = false;
		foreach($supportedLanguages as $supportedLanguage){
			if($LangTag == trim($supportedLanguage)){
				$LangData = $row->{"extra".$LangCount};
				$Lang_Temp_Array = explode("\n", $LangData);
				if(count($Lang_Temp_Array)){
					foreach($Lang_Temp_Array as $Lang_Temp_Element){
						$This_Lang_Element = explode("=", $Lang_Temp_Element);
						$LangArray[$This_Lang_Element[0]] = $This_Lang_Element[1];
					}
					foreach($LangArray as $original => $translation){
						$html_string = str_replace($original, $translation, $html_string);
					}
				}
				$cfLangDone = true;
			}			
			//create the default language array
			if(trim($params->get('default_language')) == trim($supportedLanguage)){
				$LangData = $row->{"extra".$LangCount};
				$Lang_Temp_Array = explode("\n", $LangData);
				if(count($Lang_Temp_Array)){
					foreach($Lang_Temp_Array as $Lang_Temp_Element){
						$This_Lang_Element = explode("=", $Lang_Temp_Element);
						$DefaultLangArray[$This_Lang_Element[0]] = $This_Lang_Element[1];
					}					
				}
			}
			$LangCount++;
		}
		//if no translations found, do default language
		if(!$cfLangDone && trim($params->get('default_language'))){
			foreach($DefaultLangArray as $original => $translation){
				$html_string = str_replace($original, $translation, $html_string);
			}
		}
		
		
		return $html_string ;
		
	}

}
?>