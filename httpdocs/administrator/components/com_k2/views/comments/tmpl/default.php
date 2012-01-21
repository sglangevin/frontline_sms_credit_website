<?php
/**
 * @version		$Id: default.php 558 2010-09-22 11:25:17Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<!-- To move into k2.mootools.js -->
<script type="text/javascript">
	//<![CDATA[
	window.addEvent('domready', function(){

		// For the Joomla! checkbox toggle button
		$$('#jToggler').addEvent('click', function(){
			checkAll(<?php echo count( $this->rows ); ?>);
		});

		// Toolbar controls
		$$('#toolbar-Link a').addEvent('click', function(e){
			new Event(e).stop();
			var answer = confirm('<?php echo JText::_('This will permanently delete all unpublished comments. Are you sure?', true); ?>')
			if (answer){
				submitbutton('deleteUnpublished');
			}
		});

		// Comment editing
		var flag = false;

		$$('.editComment').addEvent('click', function(e){
			if (flag){
				alert('<?php echo JText::_('You cannot edit two comments at the same time!', true);?>');
			}
			else {
				flag = true;
				new Event(e).stop();
				var commentID = this.getProperty('rel');
				var target = $E('#k2Comment'+commentID+' .commentText');
				var value = target.getText();
				$E('#k2Comment'+commentID+' input').setProperty('value',value);
				target.empty();
				var textarea = new Element('textarea',{'name':'comment','rows':'5', 'cols':'40'}).setHTML(value).injectInside(target);
				textarea.focus();
				$$('#k2Comment'+commentID+' .commentToolbar a').setStyle('display','inline');
				this.setStyle('display','none');
			}

		});

		$$('.closeComment').addEvent('click', function(e){

			flag = false;
			new Event(e).stop();
			var commentID = this.getProperty('rel');
			var target = $E('#k2Comment'+commentID+' .commentText');
			var value = $E('#k2Comment'+commentID+' input').getProperty('value');
			target.setHTML(value);
			$$('#k2Comment'+commentID+' .commentToolbar a').setStyle('display','none');
			$$('#k2Comment'+commentID+' .commentToolbar a.editComment').setStyle('display','inline');

		});

		$$('.saveComment').addEvent('click', function(e){

			flag = false;
			new Event(e).stop();
			var commentID = this.getProperty('rel');
			var target = $E('#k2Comment'+commentID+' .commentText');
			var value = $E('#k2Comment'+commentID+' .commentText textarea').getProperty('value');

			$('task').setProperty('value', 'save');
			$('commentID').setProperty('value', commentID);
			$('commentText').setProperty('value', value);

			var log = $E('#k2Comment'+commentID+' .k2CommentsLog');
			log.addClass('k2CommentsLoader');
			
			$('adminForm').send({
				onComplete: function(response) {
					var result = Json.evaluate(response);
					log.removeClass('k2CommentsLoader').setHTML(result.message);
					$E('#k2Comment'+commentID+' input').setProperty('value',result.comment);
					target.setHTML(result.comment);
					$('task').setProperty('value', '');
					(function(){log.empty();}).delay(3000);
				}
			});

			$$('#k2Comment'+commentID+' .commentToolbar a').setStyle('display','none');
			$$('#k2Comment'+commentID+' .commentToolbar a.editComment').setStyle('display','inline');

		});

	});
	//]]>
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">

  <table class="k2AdminTableFilters">
    <tr>
      <td class="k2AdminTableFiltersSearch">
				<?php echo JText::_('Filter:'); ?>
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" title="<?php echo JText::_('Filter by comment'); ?>"/>
				<button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_category').value='0';this.form.getElementById('filter_author').value='0';this.form.submit();"><?php echo JText::_('Reset'); ?></button>
      </td>
      <td class="k2AdminTableFiltersSelects">
      	<?php echo $this->lists['categories']; ?>
      	<?php echo $this->lists['authors']; ?>
      	<?php echo $this->lists['state']; ?>
      </td>
    </tr>
  </table>

  <table class="adminlist">

    <thead>
      <tr>
        <th>#</th>
        <th><input id="jToggler" type="checkbox" name="toggle" value="" /></th>
        <th><?php echo JHTML::_('grid.sort', 'Comment', 'c.commentText', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Published', 'c.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Name', 'c.userName', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Email', 'c.commentEmail', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'URL', 'c.commentURL', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Item', 'i.title', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Category', 'cat.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JText::_('Author'); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'Date', 'c.commentDate', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
				<th><?php echo JHTML::_('grid.sort', 'ID', 'c.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
      </tr>
    </thead>

    <tbody>
	  	<?php
		  $k = 0; $i = 0;
			foreach ($this->rows as $row) :
				$row->checked_out=0;
				$checked 	= JHTML::_('grid.checkedout', $row, $i );
				$published = JHTML::_('grid.published', $row, $i );

			?>
      <tr class="<?php echo "row$k"; ?>">
        <td><?php echo $i+1; ?></td>
        <td><?php echo $checked; ?></td>
        <td id="k2Comment<?php echo $row->id;?>">
					<div class="commentText"><?php echo $row->commentText;?></div>
					<div class="commentToolbar">
						<span class="k2CommentsLog"></span>
						<a href="#" class="editComment" rel="<?php echo $row->id;?>"><?php echo JText::_('Edit');?></a>
						<a href="#" class="saveComment" rel="<?php echo $row->id;?>"><?php echo JText::_('Save');?></a>
						<a href="#" class="closeComment" rel="<?php echo $row->id;?>"><?php echo JText::_('Cancel');?></a>
						<div class="clr"></div>
					</div>
					<input type="hidden" name="currentValue[]" value="<?php echo $row->commentText;?>" />
				</td>
        <td class="k2Center"><?php echo $published;?></td>
				<td><?php echo $row->userName;?></td>
        <td><?php echo $row->commentEmail;?></td>
        <td><a target="_blank" href="<?php echo JFilterOutput::cleanText($row->commentURL);?>"><?php echo $row->commentURL;?></a></td>
				<td>
					<a class="modal" rel="{handler: 'iframe', size: {x: 1000, y: 600}}" href="<?php echo JURI::root().K2HelperRoute::getItemRoute($row->itemID.':'.urlencode($row->itemAlias),$row->catid.':'.urlencode($row->catAlias));?>"><?php echo $row->title;?></a>
				</td>
        <td><?php echo $row->catName;?></td>
        <td><?php $user = &JFactory::getUser($row->created_by); echo $user->name;?></td>
        <td class="k2Date"><?php echo JHTML::_('date', $row->commentDate , JText::_('K2_DATE_FORMAT')); ?></td>
        <td><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="12"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>

  </table>

  <!-- standard Joomla! inputs? -->
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getCmd('view'); ?>" />
  <input type="hidden" id="task" name="task" value="" />

  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />

  <!-- custom inputs? -->
  <input type="hidden" id="commentID" name="commentID" value="" />
  <input type="hidden" id="commentText" name="commentText" value="" />

  <?php echo JHTML::_( 'form.token' );?>
</form>
