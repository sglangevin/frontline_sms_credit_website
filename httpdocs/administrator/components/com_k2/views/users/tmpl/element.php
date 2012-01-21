<?php
/**
 * @version		$Id: element.php 549 2010-08-30 15:39:45Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<form action="index.php" method="post" name="adminForm">

	<h1><?php echo JText::_('Select users'); ?></h1>

  <table class="k2AdminTableFilters">
    <tr>
      <td class="k2AdminTableFiltersSearch" style="white-space:nowrap;">
				<?php echo JText::_('Filter:'); ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" title="<?php echo JText::_('Filter by name'); ?>"/>
				<button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_group').value='0';this.form.getElementById('filter_group_k2').value='0';this.form.submit();"><?php echo JText::_('Reset'); ?></button>
      </td>
      <td class="k2AdminTableFiltersSelects">
      	<?php echo $this->lists['filter_group_k2']; ?>
      	<?php echo $this->lists['filter_group']; ?>
      	<?php echo $this->lists['status']; ?>
      </td>
    </tr>
  </table>

  <table class="adminlist">
		<thead>
			<tr>
				<th><?php echo JText::_( 'Num' ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Name', 'juser.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'User Name', 'juser.username', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Enabled', 'juser.block', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Group', 'juser.usertype', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'K2 Group', 'groupname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'ID', 'juser.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
			</tr>
		</thead>
    <tbody>
      <?php
      $k = 0; $i = 0;	$n = count( $this->rows );
			foreach($this->rows as $row):
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td><?php echo $i+1; ?></td>
        <td><a class="k2ListItemDisabled" title="<?php echo JText::_('Click to add this item'); ?>" onclick="window.parent.jSelectUser('<?php echo $row->id; ?>', '<?php echo str_replace(array("'", "\""), array("\\'", ""),$row->name); ?>', 'id');"><?php echo $row->name; ?></a></td>
        <td class="k2Center"><?php echo $row->username; ?></td>
        <td><?php echo $row->block ? '<img src="images/publish_x.png" width="16" height="16" border="0" alt="" />': '<img src="images/tick.png" width="16" height="16" border="0" alt="" />'; ?></td>
        <td><?php echo $row->usertype; ?></td>
        <td><?php echo $row->groupname; ?></td>
        <td><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="7"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
  </table>
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="view" value="users" />
  <input type="hidden" name="task" value="element" />
  <input type="hidden" name="tmpl" value="component" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
