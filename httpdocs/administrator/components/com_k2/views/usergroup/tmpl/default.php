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
function submitbutton(pressbutton) {
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}
	if (trim( document.adminForm.name.value ) == "") {
		alert( '<?php echo JText::_('Group name cannot be empty', true);?>' );
	} else {
		submitform( pressbutton );
	}
}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
  <fieldset class="adminform">
    <legend><?php echo JText::_('Details');?></legend>
    <table class="admintable">
      <tr>
        <td class="key"><?php echo JText::_('Group name'); ?></td>
        <td><input class="text_area" type="text" name="name" id="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="250" /></td>
      </tr>
    </table>
  </fieldset>
  <fieldset class="adminform">
    <legend><?php echo JText::_('Assign permissions for this group');?></legend>
    <?php echo $this->form->render('params');?>
  </fieldset>
  <fieldset class="adminform">
    <legend><?php echo JText::_( 'Assign group permissions to these categories' ); ?></legend>
    <script type="text/javascript">
			function allselections() {
				var e = document.getElementById('paramscategories');
					e.disabled = true;
				var i = 0;
				var n = e.options.length;
				for (i = 0; i < n; i++) {
					e.options[i].disabled = true;
					e.options[i].selected = true;
				}
			}
			function disableselections() {
				var e = document.getElementById('paramscategories');
					e.disabled = true;
				var i = 0;
				var n = e.options.length;
				for (i = 0; i < n; i++) {
					e.options[i].disabled = true;
					e.options[i].selected = false;
				}
			}
			function enableselections() {
				var e = document.getElementById('paramscategories');
					e.disabled = false;
				var i = 0;
				var n = e.options.length;
				for (i = 0; i < n; i++) {
					e.options[i].disabled = false;
				}
			}
		</script>
    <table class="admintable" cellspacing="1">
      <tr>
        <td valign="top" class="key"><?php echo JText::_( 'Filter' ); ?></td>
        <td><?php if ($this->categories == 'all') { ?>
          <label for="categories-all">
            <input id="categories-all" type="radio" name="categories" value="all" onclick="allselections();" checked="checked" />
            <?php echo JText::_( 'All' ); ?></label>
          <label for="categories-none">
            <input id="categories-none" type="radio" name="categories" value="none" onclick="disableselections();" />
            <?php echo JText::_( 'None' ); ?></label>
          <label for="categories-select">
            <input id="categories-select" type="radio" name="categories" value="select" onclick="enableselections();" />
            <?php echo JText::_( 'Select from list' ); ?></label>
          <?php } elseif ($this->categories == 'none') { ?>
          <label for="categories-all">
            <input id="categories-all" type="radio" name="categories" value="all" onclick="allselections();" />
            <?php echo JText::_( 'All' ); ?></label>
          <label for="categories-none">
            <input id="categories-none" type="radio" name="categories" value="none" onclick="disableselections();" checked="checked" />
            <?php echo JText::_( 'None' ); ?></label>
          <label for="categories-select">
            <input id="categories-select" type="radio" name="categories" value="select" onclick="enableselections();" />
            <?php echo JText::_( 'Select from list' ); ?></label>
          <?php } else { ?>
          <label for="categories-all">
            <input id="categories-all" type="radio" name="categories" value="all" onclick="allselections();" />
            <?php echo JText::_( 'All' ); ?></label>
          <label for="categories-none">
            <input id="categories-none" type="radio" name="categories" value="none" onclick="disableselections();" />
            <?php echo JText::_( 'None' ); ?></label>
          <label for="categories-select">
            <input id="categories-select" type="radio" name="categories" value="select" onclick="enableselections();" checked="checked" />
            <?php echo JText::_( 'Select from list' ); ?></label>
          <?php } ?></td>
      </tr>
      <tr>
        <td class="paramlist_key" width="40%"><span class="editlinktip">
          <label for="paramscategories" id="paramscategories-lbl"><?php echo JText::_('Categories');?></label>
          </span></td>
        <td><?php echo $this->lists['categories'];?></td>
      </tr>
      <tr>
        <td class="paramlist_key" width="40%"><span class="editlinktip">
          <label for="paramsinheritance" id="paramsinheritanceh-lbl"><?php echo JText::_('Automatically assign group permissions to the children of selected categories');?></label>
          </span></td>
        <td><?php echo $this->lists['inheritance'];?></td>
      </tr>
    </table>
    <?php if ($this->categories == 'all') { ?>
    <script type="text/javascript">allselections();</script>
    <?php } elseif ($this->categories == 'none') { ?>
    <script type="text/javascript">disableselections();</script>
    <?php } else { ?>
    <?php } ?>
    <input type="hidden" name="id" value="<?php echo $this->row->id;?>" />
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="view" value="userGroup" />
    <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
    <?php echo JHTML::_('form.token'); ?>
  </fieldset>
</form>
