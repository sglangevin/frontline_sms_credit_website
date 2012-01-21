<?php
/**
 * @version		$Id: move.php 478 2010-06-16 16:11:42Z joomlaworks $
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
		if (trim( document.adminForm.category.value ) == "") {
			alert( '<?php echo JText::_('You must select a parent category', true);?>' );
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
</script>

<form action="index.php" method="post" name="adminForm">
	<fieldset>
		<legend><?php echo JText::_('Parent category');?></legend>
		<?php echo $this->lists['categories'];?>
	</fieldset>
	<fieldset>
		<legend><?php echo JText::_('Categories being moved');?></legend>
		<ol>
			<?php foreach ($this->rows as $row):?>
			<li><?php echo $row->name;?><input type="hidden" name="cid[]" value="<?php echo $row->id;?>" /></li>
			<?php endforeach;?>
		</ol>
	</fieldset>
	<input type="hidden" name="option" value="<?php echo $option;?>" />
	<input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
	<input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
</form>
