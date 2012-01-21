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

<form action="index.php" method="post" name="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th width="20">#</th>
        <th width="20">
        	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->rows ); ?>);" />
        </th>
        <th class="title"><?php echo JText::_('Group name'); ?></th>
        <th><?php echo JText::_('Assigned categories'); ?></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="4"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
    <?php
    $k = 0; $i = 0;
		foreach ($this->rows as $row) :
			$row->checked_out=0;
			$checked 	= JHTML::_('grid.checkedout', $row, $i );
			$published = JHTML::_('grid.id', $i, $i );
			$link = JRoute::_('index.php?option=com_k2&view=extraFieldsGroup&cid='.$row->id);
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td width="20" align="center"><?php echo $i+1; ?></td>
        <td width="20" align="center"><?php echo $checked; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $row->name;?></a></td>
        <td><?php echo $row->categories; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <?php echo JHTML::_( 'form.token' );?>
</form>
