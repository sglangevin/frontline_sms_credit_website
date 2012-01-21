<?php
/**
 * @version		$Id: default.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script type="text/javascript">
	//<![CDATA[
	function submitbutton(pressbutton) {
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.name.value ) == "") {
			alert( '<?php echo JText::_('Tag cannot be empty', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
</script>

<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	<fieldset class="adminform">
	
		<legend><?php echo JText::_('Details');?></legend>
		<table class="admintable">
			<tr>
				<td class="key"><?php echo JText::_('Name'); ?></td>
				<td><input class="text_area" type="text" name="name" id="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="250" /></td>
			</tr>
			<tr>
				<td class="key"><?php	echo JText::_('Published');	?></td>
				<td><?php echo $this->lists['published']; ?></td>
			</tr>
		</table>
		
		<input type="hidden" name="id" value="<?php echo $this->row->id;?>" />
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="view" value="tag" />
		<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
		<?php echo JHTML::_('form.token'); ?>
	</fieldset>
</form>
