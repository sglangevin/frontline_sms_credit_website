<?php
/**
 * @version		$Id: default.php 503 2010-06-24 21:11:53Z joomlaworks $
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
		if(pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
</script>

<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">

  <fieldset class="adminform">
    <legend><?php echo JText::_('Details'); ?></legend>
    <table class="admintable">
      <tr>
        <td class="key"><?php	echo JText::_('Name'); ?></td>
        <td><?php echo $this->row->name; ?></td>
      </tr>
      <tr>
        <td class="key"><?php	echo JText::_('Gender'); ?></td>
        <td><?php echo $this->lists['gender']; ?></td>
      </tr>
      <tr>
        <td class="key"><?php	echo JText::_('K2 user group'); ?></td>
        <td><?php echo $this->lists['userGroup']; ?></td>
      </tr>
      <tr>
        <td class="key"><?php echo JText::_('Description'); ?></td>
        <td>
    			<div class="k2ItemFormEditor">
						<?php echo $this->editor; ?>
						<div class="dummyHeight"></div>
						<div class="clr"></div>
					</div>
				</td>
      </tr>
      <tr>
        <td class="key"><?php	echo JText::_('User image (avatar)'); ?></td>
        <td>
        	<input type="file" name="image" />
          <?php if($this->row->image):?>
          <img class="k2AdminImage" src="<?php echo JURI::root().'media/k2/users/'.$this->row->image; ?>" alt="<?php echo $this->row->name; ?>" />
          <input type="checkbox" name="del_image" id="del_image" />
          <label for="del_image"><?php echo JText::_('Check this box to delete current image or just upload a new image to replace the existing one'); ?></label>
          <?php endif; ?></td>
      </tr>
      <tr>
        <td class="key"><?php	echo JText::_('URL'); ?></td>
        <td><input type="text" size="50" value="<?php echo $this->row->url; ?>" name="url" /></td>
      </tr>
    </table>
	</fieldset>

	<?php if(count(array_filter($this->K2Plugins))):?>
	<?php foreach ($this->K2Plugins as $K2Plugin) : ?>
	<?php if(!is_null($K2Plugin)):?>
	<fieldset class="adminform">
		<legend><?php echo $K2Plugin->name; ?></legend>
		<?php echo $K2Plugin->fields; ?>
	</fieldset>
	<?php endif; ?>
	<?php endforeach; ?>
	<?php endif; ?>

  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="view" value="user" />
  <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
  <input type="hidden" name="userID" value="<?php echo $this->row->userID; ?>" />
  <?php echo JHTML::_('form.token'); ?>

</form>
