<?php
/**
 * @version		$Id: default.php 549 2010-08-30 15:39:45Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<?php $ordering = ($this->lists['order'] == 'ordering'); ?>

<form action="index.php" method="post" name="adminForm">
  <table width="100%">
    <tr>
      <td align="left" width="50%"><?php echo JText::_('Filter:'); ?>
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" title="<?php echo JText::_('Filter by name'); ?>"/>
        <button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_type').value='0'; this.form.getElementById('filter_group').value='0';this.form.submit();"><?php echo JText::_('Reset'); ?></button></td>
      <td align="right" width="50%"><?php echo $this->lists['type']; ?> <?php echo $this->lists['group']; ?> <?php echo $this->lists['state']; ?></td>
    </tr>
  </table>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20">#</th>
        <th width="20">
        	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" />
        </th>
        <th class="title"><?php echo JHTML::_('grid.sort', 'Name', 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Group', 'groupname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th width="100">
	        <?php echo JHTML::_('grid.sort', 'Order', 'ordering', @$this->lists['order_Dir'], @$this->lists['order']); ?> <?php if ($ordering) echo JHTML::_('grid.order',  $this->rows ); ?>
        </th>
        <th><?php echo JHTML::_('grid.sort', 'Type', 'type', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Published', 'published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'ID', 'exf.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="8"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
      <?php $k = 0; $i = 0; $n = count( $this->rows );

		foreach ($this->rows as $row) :
			$row->checked_out=0;
			$checked 	= JHTML::_('grid.checkedout', $row, $i );
			$published = JHTML::_('grid.published', $row, $i );
			$link = JRoute::_('index.php?option=com_k2&view=extraField&cid='.$row->id);
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td width="20" align="center"><?php echo $i+1; ?></td>
        <td width="20" align="center"><?php echo $checked; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $row->name;?></a></td>
        <td align="center"><?php echo $row->groupname;?></td>
        <td class="order"><span><?php echo $this->page->orderUpIcon($i, ($row->group == @$this->rows[$i-1]->group), 'orderup', 'Move Up', $ordering); ?></span> <span><?php echo $this->page->orderDownIcon($i, $n, ($row->group == @$this->rows[$i+1]->group), 'orderdown', 'Move Down', $ordering); ?></span>
          <?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
          <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?>	class="text_area" style="text-align: center" /></td>
        <td align="center"><?php echo JText::_($row->type);?></td>
        <td align="center"><?php echo $published;?></td>
        <td align="center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <?php echo JHTML::_( 'form.token' );?>
</form>
