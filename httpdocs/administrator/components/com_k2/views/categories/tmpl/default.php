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

$ordering = ( ($this->lists['order'] == 'c.ordering' || $this->lists['order'] == 'c.parent, c.ordering') && (!$this->filter_trash) );

?>

<!-- To move into k2.mootools.js -->
<script type="text/javascript">
	//<![CDATA[
	window.addEvent('domready', function(){

		// For the Joomla! checkbox toggle button
		$$('#jToggler').addEvent('click', function(){
			checkAll(<?php echo count( $this->rows ); ?>);
		});

	});

	function submitbutton(pressbutton) {
		if (pressbutton == 'trash') {
			var answer = confirm('<?php echo JText::_('WARNING: You are about to trash the selected categories, their children categories and all their included items!', true); ?>')
			if (answer){
				submitform( pressbutton );
			} else{
				return;
			}
		} else {
			submitform( pressbutton );
		}
	}
	//]]>
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

  <table class="k2AdminTableFilters">
    <tr>
      <td class="k2AdminTableFiltersSearch">
				<?php echo JText::_('Filter:'); ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" title="<?php echo JText::_('Filter by title'); ?>"/>
				<button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.submit();"><?php echo JText::_('Reset'); ?></button>
      </td>
      <td class="k2AdminTableFiltersSelects">
      	<?php echo $this->lists['trash']; ?>
      	<?php echo $this->lists['state']; ?>
      </td>
    </tr>
  </table>

  <table class="adminlist">
    <thead>
      <tr>
        <th>#</th>
        <th><input id="jToggler" type="checkbox" name="toggle" value="" /></th>
        <th><?php echo JHTML::_('grid.sort', 'Title', 'c.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Order', 'c.ordering', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> <?php echo $ordering ?JHTML::_('grid.order',  $this->rows ,'filesave.png' ):''; ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Associated extra field groups', 'extra_fields_group', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Access Level', 'c.access', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'Published', 'c.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
         <th><?php echo JText::_('Image'); ?></th>
         <th><?php echo JHTML::_('grid.sort', 'ID', 'c.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
      </tr>
    </thead>
    <tbody>
	  <?php
	  $k = 0; $i = 0;	$n = count( $this->rows );
		foreach ($this->rows as $row) :
			$row->checked_out=0;
			$checked 	= JHTML::_('grid.checkedout', $row, $i );
			$published = JHTML::_('grid.published', $row, $i );
			$access = JHTML::_('grid.access', $row, $i );
			$link = JRoute::_('index.php?option=com_k2&view=category&cid='.$row->id);
			?>
	    <tr class="<?php echo "row$k"; ?>">
        <td><?php echo $i+1; ?></td>
        <td class="k2Center">
        <?php
				if ($this->filter_trash){
					if ($row->trash==1){
						echo $checked;
					}
				}
				else {
					echo $checked;
				}
				?>
				</td>
	      <td>
	      <?php
				if ($this->filter_trash){
					if ($row->trash)
						echo '<strong>';
					echo $row->treename;
					if ($row->trash)
						echo '</strong>';
				} else {
				?>
	      <a href="<?php echo $link; ?>"><?php echo $row->treename;?><?php if($this->params->get('showItemsCounterAdmin')):?> (<?php echo $row->numOfItems;?>)<?php endif; ?></a>
	      <?php } ?>
        </td>
        <td class="k2Order"><span><?php echo $this->page->orderUpIcon( $i, $row->parent == 0 || $row->parent == @$this->rows[$i-1]->parent, 'orderup', 'Move Up', $ordering); ?></span> <span><?php echo $this->page->orderDownIcon( $i, $n, $row->parent == 0 || $row->parent == @$this->rows[$i+1]->parent, 'orderdown', 'Move Down', $ordering ); ?></span>
          <?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
          <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" <?php echo $disabled ?> class="text_area k2OrderBox" /></td>
        <td class="k2Center"><?php echo $row->extra_fields_group; ?></td>
        <td class="k2Center"><?php echo ($this->filter_trash)?strip_tags($access):$access;?></td>
        <td class="k2Center"><?php echo ($this->filter_trash)?strip_tags($published,'<img>'):$published;?></td>
        <td class="k2Center">
        <?php if($row->image):?>
        	<a href="<?php echo JURI::root().'media/k2/categories/'.$row->image;?>" class="modal"><img src="templates/khepri/images/menu/icon-16-media.png" alt="<?php echo JText::_('Preview image');?>" /></a>
        <?php endif; ?>
        </td>
        <td class="k2Center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="9"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
  </table>

  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  <?php echo JHTML::_( 'form.token' );?>
</form>
