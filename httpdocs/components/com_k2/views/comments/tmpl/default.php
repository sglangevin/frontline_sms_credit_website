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

		// Disable accidental window closing
		parent.$('sbox-overlay').removeEvents('click');

		// Comment editing
		var flag = false;

		$$('.editComment').addEvent('click', function(e){
			if (flag){
				alert('<?php echo JText::_('You cannot edit two comments at the same time!', true); ?>');
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

<!-- Embed CSS using JS (required) -->
<script type="text/javascript">
	//<![CDATA[
	/* Style resets. Watch for the backslash on every line within the document.write element */
	document.write('\
		<style type="text/css">\
			body { margin:10px; padding:0; background:#fff; padding-bottom:1px; font-size:11px; }\
			body,td,th { font-family:Arial, Helvetica, sans-serif; }\
			html,body { height:95%; }\
			#minwidth { min-width:960px; }\
			.clr { clear:both; overflow:hidden; height:0; }\
			a,img { padding:0; margin:0; }\
			img { border:0 none; }\
			form { margin:0; padding:0; }\
			h1 { margin:0; padding-bottom:8px; color:#0B55C4; font-size:20px; font-weight:bold; }\
			h3 { font-size:13px; }\
			a:link { color:#0B55C4; text-decoration:none; }\
			a:visited { color:#0B55C4; text-decoration:none; }\
			a:hover { text-decoration:underline; }\
			fieldset { margin-bottom:10px; border:1px #ccc solid; padding:5px; text-align:left; }\
			fieldset p { margin:10px 0; }\
			legend { color:#0B55C4; font-size:12px; font-weight:bold; }\
			input,select { font-size:10px; border:1px solid silver; }\
			textarea { font-size:11px; border:1px solid silver; }\
			button { font-size:10px; }\
			input.disabled { background-color:#F0F0F0; }\
			input.button { cursor:pointer; }\
			input:focus,select:focus,textarea:focus { background-color:#ffd; }\
			label {color:#222;}\
		</style>\
	');
	//]]>
</script>

<form action="index.php" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">

  <div class="k2Frontend">

		<table class="toolbar" cellpadding="2" cellspacing="4">
			<tr>
				<td id="toolbar-publish" class="button">
					<a class="toolbar" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('Please make a selection from the list to publish!',true); ?>'); return false;}else{  submitbutton('publish'); return false;}" href="#"><span title="Publish" class="icon-32-publish"></span><?php echo JText::_('Publish'); ?></a>
				</td>
				<td id="toolbar-unpublish" class="button">
					<a class="toolbar" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('Please make a selection from the list to unpublish!',true); ?>'); return false;}else{  submitbutton('unpublish'); return false;}" href="#"><span title="Unpublish" class="icon-32-unpublish"></span><?php echo JText::_('Unpublish'); ?></a>
				</td>
				<td id="toolbar-Are you sure you want to delete selected comments?" class="button">
					<a class="toolbar" onclick="javascript:if(document.adminForm.boxchecked.value==0){alert('<?php echo JText::_('Please make a selection from the list to delete!',true); ?>'); return false;}else{if(confirm('Are you sure you want to delete selected comments?')){submitbutton('remove');}; return false;}" href="#"><span title="Delete" class="icon-32-delete"></span><?php echo JText::_('Delete'); ?></a>
				</td>
				<td id="toolbar-Link" class="button">
					<a href="#"><span title="<?php echo JText::_('Delete all unpublished'); ?>" class="icon-32-delete"></span><?php echo JText::_('Delete all unpublished'); ?></a>
				</td>
			</tr>
		</table>

		<div id="k2FrontendEditToolbar">
	  	<h2 class="header icon-48-k2"><?php echo JText::_('Moderate comments to my items'); ?></h2>
	  </div>

  	<div class="clr"></div>

  	<hr class="sep" />

	  <table class="k2AdminTableFilters">
	    <tr>
	      <td class="k2AdminTableFiltersSearch">
					<?php echo JText::_('Filter:'); ?>
					<input type="text" name="search" id="k2Search" value="<?php echo $this->lists['search'] ?>" class="text_area" onchange="document.adminForm.submit();" title="<?php echo JText::_('Filter by comment'); ?>"/>
					<button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
					<button onclick="document.getElementById('k2Search').value='';this.form.getElementById('filter_state').value='-1';this.form.getElementById('filter_category').value='0';this.form.submit();"><?php echo JText::_('Reset'); ?></button>
	      </td>
	      <td class="k2AdminTableFiltersSelects">
	      			<?php echo $this->lists['categories']; ?>
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
					<th><?php echo JHTML::_('grid.sort', 'Date', 'c.commentDate', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
					<th><?php echo JHTML::_('grid.sort', 'ID', 'c.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
	      </tr>
	    </thead>

	    <tbody>
		  	<?php
		  	if(count($this->rows)):
				  $k = 0; $i = 0;
					foreach ($this->rows as $row) :
						$row->checked_out=0;
						$checked 	= JHTML::_('grid.checkedout', $row, $i );
	          $published = JHTML::_('grid.published', $row, $i, 'apply_f2.png', 'cancel_f2.png');
				?>
	      <tr class="<?php echo "row$k"; ?>">
	        <td><?php echo $i+1; ?></td>
	        <td><?php echo $checked; ?></td>
	        <td id="k2Comment<?php echo $row->id; ?>">
						<div class="commentText"><?php echo $row->commentText; ?></div>
						<div class="commentToolbar">
							<span class="k2CommentsLog"></span>
							<a href="#" class="editComment" rel="<?php echo $row->id; ?>"><?php echo JText::_('Edit'); ?></a>
							<a href="#" class="saveComment" rel="<?php echo $row->id; ?>"><?php echo JText::_('Save'); ?></a>
							<a href="#" class="closeComment" rel="<?php echo $row->id; ?>"><?php echo JText::_('Cancel'); ?></a>
							<div class="clr"></div>
						</div>
						<input type="hidden" name="currentValue[]" value="<?php echo $row->commentText; ?>" />
					</td>
	        <td class="k2Center k2FrontendPublishIcons"><?php echo $published; ?></td>
					<td><?php echo $row->userName; ?></td>
	        <td><?php echo $row->commentEmail; ?></td>
	        <td><a target="_blank" href="<?php echo JFilterOutput::cleanText($row->commentURL); ?>"><?php echo $row->commentURL; ?></a></td>
					<td>
						<a class="modal" rel="{handler: 'iframe', size: {x: 1000, y: 600}}" href="<?php echo JURI::root().K2HelperRoute::getItemRoute($row->itemID.':'.urlencode($row->itemAlias),$row->catid.':'.urlencode($row->catAlias)); ?>"><?php echo $row->title; ?></a>
					</td>
	        <td class="k2Date"><?php echo JHTML::_('date', $row->commentDate , JText::_('K2_DATE_FORMAT')); ?></td>
	        <td><?php echo $row->id; ?></td>
	      </tr>
	      <?php
		      $k = 1 - $k;
		      $i++;
		      endforeach;
	      else:
	     	?>
	     	<td colspan="10"><?php echo JText::_('No one has commented on your published items so far.'); ?></td>
	     	<?php endif; ?>
	    </tbody>

	    <tfoot>
	      <tr>
	        <td colspan="10"><?php echo $this->pagination->getListFooter(); ?></td>
	      </tr>
	    </tfoot>

	  </table>

	</div>

  <!-- standard Joomla! inputs? -->
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getCmd('view'); ?>" />
  <input type="hidden" id="task" name="task" value="" />

  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />

  <input type="hidden" name="tmpl" value="component" />

  <!-- custom inputs? -->
  <input type="hidden" id="commentID" name="commentID" value="" />
  <input type="hidden" id="commentText" name="commentText" value="" />

  <?php echo JHTML::_( 'form.token' ); ?>
</form>