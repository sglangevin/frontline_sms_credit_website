<?php
/**
 * @version		$Id: form.php 552 2010-09-06 12:06:35Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$db = &JFactory::getDBO();
$nullDate = $db->getNullDate();
JHTML::_('behavior.tooltip');

?>

<script type="text/javascript">
	//<![CDATA[
	function submitbutton(pressbutton) {

		syncExtraFieldsEditor();

		if (trim( document.adminForm.title.value ) == "") {
			alert( '<?php echo JText::_('Item must have a title', true); ?>' );
		} else if (trim( document.adminForm.catid.value ) == "0") {
			alert( '<?php echo JText::_('Please select a category', true); ?>' );
		} else {
			<?php if(!$this->params->get('taggingSystem')): ?>
			var tags = document.getElementById("selectedTags");
			for(i=0; i<tags.options.length; i++)
			tags.options[i].selected = true;
			<?php endif; ?>
			submitform( pressbutton );
		}
	}

	function addAttachment(){
		var div = new Element('div',{'style':'border-top: 1px dotted rgb(51, 51, 51); margin: 3px; padding: 10px;'}).injectInside($('itemAttachments'));
		var input = new Element('input',{'name':'attachment_file[]','type':'file'}).injectInside(div);
		var input = new Element('input',{'value':'<?php echo JText::_('Remove',true); ?>','type':'button',events:{ click: function(){this.getParent().remove();} } }).injectInside(div);
		var br = new Element('br').injectInside(div);
		var label = new Element('label').setHTML('<?php echo JText::_('Link title (optional)', true); ?>').injectInside(div);
		var input = new Element('input',{'name':'attachment_title[]','type':'text', 'class':'linkTitle'}).injectInside(div);
		var label = new Element('label').setHTML('<?php echo JText::_('Link title attribute (optional)', true); ?>').injectInside(div);
		var br = new Element('br').injectInside(div);
		var textarea = new Element('textarea',{'name':'attachment_title_attribute[]','cols':'30', 'rows':'3'}).injectInside(div);
	}

	window.addEvent('domready', function(){

		initExtraFieldsEditor();

		<?php if($this->params->get('showAttachmentsTab')): ?>
		$$('.deleteAttachmentButton').addEvent('click', function(e){
			e = new Event(e).stop();
			if (confirm('<?php echo JText::_('Are you sure?', true); ?>')) {
				var element = this.getParent().getParent();
				var deleteAnimation = new Fx.Style(element, 'opacity', {duration:500});
				var url = this.getProperty('href');
				new Ajax(url, {
					method: 'get',
				 	onComplete: function(){
						deleteAnimation.start(100, 0).chain(function(){element.remove();});;
				 	}
				}).request();
			}
		});
		<?php endif; ?>

		<?php if(!$this->params->get('taggingSystem')): ?>

		<?php if( !$this->params->get('lockTags') || $this->user->gid>23): ?>
		$('newTagButton').addEvent('click', function(){
			var log = $('tagsLog');
			log.empty().addClass('tagsLoading');
			var tag=$('tag').getProperty('value');
			var url = 'index.php?option=com_k2&view=item&task=tag&tag='+tag;
			new Ajax(url, {
				method: 'get',
				onComplete: function(res){
					var jsonResponse=Json.evaluate(res);
					if (jsonResponse.status=="success"){
						var option = new Element('option',{'value':jsonResponse.id}).setHTML(jsonResponse.name).injectInside($('tags'));
					}
					(function(){
						log.setHTML(jsonResponse.msg);
						log.removeClass('tagsLoading');
					}).delay(1000);
				}
			}).request();
		});
		<?php endif; ?>

		$('addTagButton').addEvent('click', function(){
			$$('#tags option').each(function(el) {
				if (el.selected){
					el.injectInside($('selectedTags'));
				}
			});
		});

		$('removeTagButton').addEvent('click', function(){
			$$('#selectedTags option').each(function(el) {
				if (el.selected){
					el.injectInside($('tags'));
				}
			});
		});
		<?php endif; ?>

		$('catid').addEvent('change', function(){

			if (window.ie) {
				if (this.options[this.selectedIndex].disabled){
					alert('<?php echo JText::_('You are not allowed to post to this category',true); ?>');
					this.selectedIndex=0;
					return false;
				}
			}

			<?php if ($this->params->get('showExtraFieldsTab')): ?>
			var selectedValue = this.value;
			if (selectedValue>0){

			var url = 'index.php?option=com_k2&view=item&task=extraFields&id='+selectedValue;
			<?php if ($this->row->id): ?>
			url+='&cid=<?php echo $this->row->id?>';
			<?php endif; ?>
			new Fx.Style($('extraFieldsContainer'), 'opacity', {
				duration: 700
			}).start(0).chain(function(){
				new Ajax(url, {
					method: 'get',
					update: $('extraFieldsContainer'),
				 	onComplete: function(){
						initExtraFieldsEditor();
						new Fx.Style($('extraFieldsContainer'), 'opacity', {
			            	duration: 700
						}).start(1);
					}
				}).request();
			})

			}
			<?php endif; ?>

		});

		if(window.ie){
			var disabledOptions=$$('#catid option[disabled]');
			$each(disabledOptions, function(option){
					option.setStyle('color', '#808080');
			});
		}

		parent.$('sbox-overlay').removeEvents('click');

		<?php if ($this->row->id): ?>
		var XHRCheckin = new Ajax('index.php?option=com_k2&view=item&task=checkin&cid=<?php echo $this->row->id; ?>', {
			method: 'get'
		});
		parent.$('sbox-btn-close').addEvent('click', function(){
			dummy = $time() + $random(0, 100);
			XHRCheckin.request("t"+dummy);
		});
		<?php endif; ?>

		$$('#toolbar-cancel a').addEvent('click', function(e){
			new Event(e).stop();
			<?php if ($this->row->id): ?>
			dummy = $time() + $random(0, 100);
			XHRCheckin.request("t"+dummy);
			<?php endif; ?>
			parent.$('sbox-window').close();
		});

		<?php if ($this->params->get('showImageTab')): ?>
		$('browseSrv').addEvent('click', function(e){
			e = new Event(e).stop();
			SqueezeBox.initialize();
			SqueezeBox.fromElement(this, {
				handler: 'iframe',
				url: '<?php echo JURI::base()?>index.php?option=com_k2&view=item&task=filebrowser&type=image&tmpl=component',
				size: {x: 590, y: 400}
			});
		});
		<?php endif; ?>

		$$('ul.tags').addEvent('click', function(){
			$('search-field').focus();
		});
		var completer = new Autocompleter.Ajax.Json($('search-field'), '<?php echo JURI::root()?>index.php?option=com_k2&view=item&task=tags',
			{
		    'postVar': 'q',
		    'postData': {tags:($$('ul.tags input[type=hidden]').getProperty('value')).join(",")},
		    'onRequest': function(el) {
		        $('search-field').addClass('loading');
		    },
		    'onComplete': function(el) {
		    	$('search-field').removeClass('loading');
		    }
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
					<td id="toolbar-save" class="button">
						<a class="toolbar" href="#" onclick="javascript: submitbutton('save'); return false;">
							<span title="<?php echo JText::_('Save'); ?>" class="icon-32-save"></span>
							<?php echo JText::_('Save'); ?>
						</a>
					</td>
					<td id="toolbar-cancel" class="button">
						<a class="toolbar" href="#">
							<span title="<?php echo JText::_('Cancel'); ?>" class="icon-32-cancel"></span>
							<?php echo JText::_('Cancel'); ?>
						</a>
					</td>
				</tr>
			</table>

		  <div id="k2FrontendEditToolbar">
		  	<h2 class="header icon-48-k2"><?php echo (JRequest::getInt('cid')) ? JText::_('Edit Item') : JText::_('Add Item'); ?></h2>
		  </div>

	  	<div class="clr"></div>

	  	<hr class="sep" />

			<div id="k2ToggleSidebarContainer">
				<a href="#" id="k2ToggleSidebar"><?php echo JText::_('Toggle sidebar'); ?></a>
			</div>

			<table cellspacing="0" cellpadding="0" border="0" class="adminFormK2Container">
			  <tbody>
			    <tr>
			      <td valign="top">

							<table class="adminform adminFormK2">
								<tr>
									<td><label for="title"><?php echo JText::_('Title'); ?></label></td>
									<td><input class="text_area" type="text" size="40" name="title" id="title" maxlength="250" value="<?php echo $this->row->title; ?>" /></td>
									<td><label><?php echo JText::_('Published'); ?></label></td>
									<td><?php echo $this->lists['published']; ?></td>
								</tr>
								<tr>
									<td><label for="alias"><?php echo JText::_('Title alias'); ?></label></td>
									<td><input class="text_area" type="text" size="40" name="alias" id="alias" maxlength="250" value="<?php echo $this->row->alias; ?>" /></td>
									<td><label for="featured"><?php echo JText::_('Is it featured?'); ?></label></td>
									<td><input type="checkbox" name="featured" id="featured" <?php echo $this->row->featured?'checked="checked"':''; ?> value="1" /></td>
								</tr>
								<tr>
									<td><label><?php echo JText::_('Tags'); ?></label></td>
									<td>
							      <?php if($this->params->get('taggingSystem')): ?>
							      <!-- Free tagging -->
										<ul class="tags">
											<?php if(isset($this->row->tags) && count($this->row->tags)): ?>
											<?php foreach($this->row->tags as $tag): ?>
											<li class="addedTag">
												<?php echo $tag->name; ?>
												<span class="tagRemove" onclick="this.getParent().remove();">x</span>
												<input type="hidden" name="tags[]" value="<?php echo $tag->name; ?>" />
											</li>
											<?php endforeach; ?>
											<?php endif; ?>
											<li class="tagAdd"><input type="text" id="search-field" /></li>
											<li class="clr"></li>
										</ul>
										<span class="k2Note"><?php echo JText::_('Write a tag and press "return" or "comma" to add it.'); ?></span>
										<?php else: ?>
										<!-- Selection based tagging -->
										<?php if(!$this->params->get('lockTags') || $this->user->gid>23): ?>
										<div style="float:left;">
											<input type="text" name="tag" id="tag" />
											<input type="button" id="newTagButton" value="<?php echo JText::_('Add'); ?>" />
										</div>
										<div id="tagsLog"></div>
										<div class="clr"></div>

										<span class="k2Note">
											<?php echo JText::_('Write a tag and press "Add" to insert it to the available tags list.<br />New tags are appended at the bottom of the available tags list (left).'); ?>
										</span>
										<?php endif; ?>
										<table cellspacing="0" cellpadding="0" border="0" id="tagLists">
											<tr>
												<td id="tagListsLeft">
													<span><?php echo JText::_('Available tags'); ?></span>
													<?php echo $this->lists['tags'];	?>
												</td>
												<td id="tagListsButtons">
													<input type="button" id="addTagButton" value="<?php echo JText::_('Add'); ?> &raquo;" />
													<br /><br />
													<input type="button" id="removeTagButton" value="&laquo; <?php echo JText::_('Remove'); ?>" />
												</td>
												<td id="tagListsRight">
													<span><?php echo JText::_('Selected tags'); ?></span>
													<?php echo $this->lists['selectedTags']; ?>
												</td>
											</tr>
										</table>
										<?php endif; ?>
									</td>
									<td><label><?php echo JText::_('Category'); ?></label></td>
									<td><?php echo $this->lists['categories']; ?></td>
								</tr>
							</table>

			      	<div class="simpleTabs">
			          <ul class="simpleTabsNavigation">
			            <li id="tabContent"><a href="#"><?php echo JText::_('Content'); ?></a></li>
			            <?php if ($this->params->get('showImageTab')): ?>
			            <li id="tabImage"><a href="#"><?php echo JText::_('Image'); ?></a></li>
			            <?php endif; ?>
			            <?php if ($this->params->get('showImageGalleryTab')): ?>
			            <li id="tabImageGallery"><a href="#"><?php echo JText::_('Image Gallery'); ?></a></li>
			            <?php endif; ?>
			            <?php if ($this->params->get('showVideoTab')): ?>
			            <li id="tabVideo"><a href="#" rel="4"><?php echo JText::_('Video'); ?></a></li>
			            <?php endif; ?>
			            <?php if ($this->params->get('showExtraFieldsTab')): ?>
			            <li id="tabExtraFields"><a href="#"><?php echo JText::_('Extra Fields'); ?></a></li>
			            <?php endif; ?>
			            <?php if ($this->params->get('showAttachmentsTab')): ?>
			            <li id="tabAttachments"><a href="#"><?php echo JText::_('Attachments'); ?></a></li>
			            <?php endif; ?>
			            <?php if(count(array_filter($this->K2PluginsItemOther)) && $this->params->get('showK2Plugins')): ?>
			            <li id="tabPlugins"><a href="#"><?php echo JText::_('Plugins'); ?></a></li>
			            <?php endif; ?>
			          </ul>

			          <div class="simpleTabsContent">

									<?php if($this->params->get('mergeEditors')): ?>
									<div class="k2ItemFormEditor">
										<?php echo $this->text; ?>
										<div class="dummyHeight"></div>
										<div class="clr"></div>
									</div>
									<?php else: ?>
									<div class="k2ItemFormEditor">
										<span class="k2ItemFormEditorTitle">
											<?php echo JText::_('Introtext (teaser content/excerpt)'); ?>
										</span>
										<?php echo $this->introtext; ?>
										<div class="dummyHeight"></div>
										<div class="clr"></div>
									</div>
									<div class="k2ItemFormEditor">
										<span class="k2ItemFormEditorTitle">
											<?php echo JText::_('Fulltext (main content)'); ?>
										</span>
										<?php echo $this->fulltext; ?>
										<div class="dummyHeight"></div>
										<div class="clr"></div>
									</div>
									<?php endif; ?>

			            <?php if (count($this->K2PluginsItemContent) && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemContent as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			            <div class="clr"></div>

			          </div>

			          <?php if ($this->params->get('showImageTab')): ?>
			          <div class="simpleTabsContent">
			            <table class="admintable">
			              <tr>
			                <td align="right" class="key"><?php echo JText::_('Item image'); ?></td>
			                <td>
			                	<input type="file" name="image" class="text_area" />
			                	<br /><br />
			                	<input type="text" name="existingImage" id="existingImageValue" class="text_area" readonly="readonly"> <input type="button" value="<?php echo JText::_('Browse server...'); ?>" id="browseSrv"  />
			                </td>
			              </tr>
			              <tr>
			                <td align="right" class="key"><?php echo JText::_('Item image caption'); ?></td>
			                <td><input type="text" name="image_caption" size="30" class="text_area" value="<?php echo $this->row->image_caption; ?>" /></td>
			              </tr>
			              <tr>
			                <td align="right" class="key"><?php echo JText::_('Item image credits'); ?></td>
			                <td><input type="text" name="image_credits" size="30" class="text_area" value="<?php echo $this->row->image_credits; ?>" /></td>
			              </tr>
									  <?php if (!empty($this->row->image)): ?>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Item image preview'); ?></td>
									    <td>
									      <a class="modal" href="<?php echo $this->row->image; ?>" title="<?php echo JText::_('Click on image to preview in original size'); ?>">
									      	<img alt="<?php echo $this->row->title; ?>" src="<?php echo $this->row->thumb; ?>" class="k2AdminImage"/>
									      </a>
									      <input type="checkbox" name="del_image" id="del_image" />
									      <label for="del_image"><?php echo JText::_('Check this box to delete current image or just upload a new image to replace the existing one'); ?></label>
									    </td>
									  </tr>
									  <?php endif; ?>
			            </table>
			            <?php if (count($this->K2PluginsItemImage)  && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemImage as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			          </div>
			          <?php endif; ?>
			          <?php if ($this->params->get('showImageGalleryTab')): ?>
			          <div class="simpleTabsContent">
			            <?php if ($this->lists['checkSIG']): ?>
			            <table class="admintable" id="item_gallery_content">
			              <tr>
			                <td align="right" valign="top" class="key"><?php echo JText::_('Gallery images'); ?></td>
			                <td valign="top"><input type="file" name="gallery" class="text_area" />
			                  <?php if (!empty($this->row->gallery)): ?>
			                  <div id="itemGallery"> <?php echo $this->row->gallery; ?>
			                    <input type="checkbox" name="del_gallery" id="del_gallery"/>
			                    <label for="del_gallery"><?php echo JText::_('Upload new gallery to replace the existing or check this box to delete current gallery'); ?></label>
			                  </div>
			                  <?php endif; ?>
			                </td>
			              </tr>
			            </table>
			            <?php else: ?>
			            <dl id="system-message">
			              <dt class="notice"><?php echo JText::_('Notice'); ?></dt>
			              <dd class="notice message fade">
			                <ul>
			                  <li><?php echo JText::_('Notice: Please install the Simple Image Gallery Pro plugin if you want to use the image gallery features of K2!'); ?></li>
			                </ul>
			              </dd>
			            </dl>
			            <?php endif; ?>
			            <?php if (count($this->K2PluginsItemGallery)  && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemGallery as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			          </div>
			          <?php endif; ?>
			          <?php if ($this->params->get('showVideoTab')): ?>
			          <div class="simpleTabsContent">
									<?php if ($this->lists['checkAllVideos']): ?>
									<table class="admintable" id="item_video_content">
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video source'); ?></td>
									    <td>
									    	<?php $pane = & JPane::getInstance('Tabs',$this->options); echo $pane->startPane('myPane'); ?>
									      <?php echo $pane->startPanel(JText::_('Upload'), 'vidtab1'); ?>
									      <div class="panel" id="Upload_video">
									        <input type="file" name="video" class="fileUpload" />
									      </div>
									      <?php echo $pane->endPanel(); ?>
									      <?php echo $pane->startPanel(JText::_('Browse server/use remote video'), 'vidtab2');	?>
									      <div class="panel" id="Remote_video">
									      	<a class="modal" rel="{handler: 'iframe', size: {x: 590, y: 400}}" href="index.php?option=com_k2&view=item&task=filebrowser&type=video&tmpl=component"><?php echo JText::_('Browse videos on server')?></a> <?php echo JText::_('or'); ?> <?php echo JText::_('paste remote video URL'); ?> <input type="text" size="30" name="remoteVideo" value="<?php echo $this->lists['remoteVideo'] ?>" />
									      </div>
									      <?php echo $pane->endPanel(); ?>
									      <?php echo $pane->startPanel(JText::_('Video provider'), 'vidtab3'); ?>
									      <div class="panel" id="Video_from_provider">
									      	<?php echo JText::_('Select video provider'); ?> <?php echo $this->lists['providers']; ?> <?php echo JText::_('and enter video ID'); ?> <input type="text" name="videoID" value="<?php echo $this->lists['providerVideo'] ?>" />
									      	<br /><br />
									      	<a class="modal" rel="{handler: 'iframe', size: {x: 990, y: 600}}" href="http://www.joomlaworks.gr/allvideos-documentation"><?php echo JText::_('Read the AllVideos documentation for more...'); ?></a>
									      </div>
									      <?php echo $pane->endPanel(); ?>
									      <?php echo $pane->startPanel(JText::_('Embed'), 'vidtab4'); ?>
									      <div class="panel" id="embedVideo">
									      	<?php echo JText::_('Paste video HTML embed code below'); ?>:
									      	<br />
									      	<textarea name="embedVideo" rows="5" cols="50" class="textarea"><?php echo $this->lists['embedVideo']; ?></textarea>
									      </div>
									      <?php echo $pane->endPanel(); ?>
									      <?php echo $pane->endPane(); ?>
									  	</td>
									  </tr>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video caption'); ?></td>
									    <td><input type="text" name="video_caption" size="50" class="text_area" value="<?php echo $this->row->video_caption; ?>" /></td>
									  </tr>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video credits'); ?></td>
									    <td><input type="text" name="video_credits" size="50" class="text_area" value="<?php echo $this->row->video_credits; ?>" /></td>
									  </tr>
									  <?php if($this->row->video): ?>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video preview'); ?></td>
									    <td>
									      <?php echo $this->row->video; ?>
									      <br />
									      <input type="checkbox" name="del_video" id="del_video" />
									      <label for="del_video"><?php echo JText::_('Check this box to delete current video or use the form above to replace the existing one'); ?></label>
									    </td>
									  </tr>
									  <?php endif; ?>
									</table>
									<?php else: ?>
									<dl id="system-message">
									  <dt class="notice"><?php echo JText::_('Notice'); ?></dt>
									  <dd class="notice message fade">
									    <ul>
									      <li><?php echo JText::_('Notice: Please install JoomlaWorks AllVideos plugin if you want to use the video features of K2!'); ?></li>
									    </ul>
									  </dd>
									</dl>
									<table class="admintable" id="item_video_content">
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video source'); ?></td>
									    <td>
									    	<?php $pane = & JPane::getInstance('Tabs'); echo $pane->startPane('myPane'); ?>
									      <?php echo $pane->startPanel(JText::_('Use video embed code'), 'vidtab4'); ?>
									      <div class="panel" id="embedVideo">
									      	<?php echo JText::_('Paste video embed code here'); ?>
									      	<br />
									      	<textarea name="embedVideo" rows="5" cols="50" class="textarea"><?php echo $this->lists['embedVideo']; ?></textarea>
									      </div>
									      <?php echo $pane->endPanel(); ?>
									      <?php echo $pane->endPane(); ?>
									  	</td>
									  </tr>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video caption'); ?></td>
									    <td><input type="text" name="video_caption" size="50" class="text_area" value="<?php echo $this->row->video_caption; ?>" /></td>
									  </tr>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video credits'); ?></td>
									    <td><input type="text" name="video_credits" size="50" class="text_area" value="<?php echo $this->row->video_credits; ?>" /></td>
									  </tr>
									  <?php if($this->row->video): ?>
									  <tr>
									    <td align="right" class="key"><?php echo JText::_('Video preview'); ?></td>
									    <td>
									      <?php echo $this->row->video; ?>
									      <br />
									      <input type="checkbox" name="del_video" id="del_video" />
									      <label for="del_video"><?php echo JText::_('Use the form above to replace the existing video or check this box to delete current video'); ?></label>
									    </td>
									  </tr>
									  <?php endif; ?>
									</table>
									<?php endif; ?>
			            <?php if (count($this->K2PluginsItemVideo) && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemVideo as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			          </div>
			          <?php endif; ?>
			          <?php if ($this->params->get('showExtraFieldsTab')): ?>
			          <div class="simpleTabsContent">
			            <div id="extraFieldsContainer">
			              <?php if (count($this->extraFields)): ?>
			              <table class="admintable" id="extraFields">
			                <?php foreach ($this->extraFields as $extraField): ?>
			                <tr>
			                  <td align="right" class="key"><?php echo $extraField->name; ?></td>
			                  <td><?php echo $extraField->element; ?></td>
			                </tr>
			                <?php endforeach; ?>
			              </table>
			              <?php else: ?>
			              <dl id="system-message">
			                <dt class="notice"><?php echo JText::_('Notice'); ?></dt>
			                <dd class="notice message fade">
			                  <ul>
			                    <li><?php echo JText::_('Please select a category first to retrieve its related "Extra Fields"...'); ?></li>
			                  </ul>
			                </dd>
			              </dl>
			              <?php endif; ?>
			            </div>
			            <?php if (count($this->K2PluginsItemExtraFields)  && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemExtraFields as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			          </div>
			          <?php endif; ?>
			          <?php if ($this->params->get('showAttachmentsTab')): ?>
			          <div class="simpleTabsContent">
			            <div class="itemAttachments">
			              <?php if (count($this->row->attachments)): ?>
			              <table class="adminlist">
			                <tr>
			                  <th><?php echo JText::_('Filename'); ?></th>
			                  <th><?php echo JText::_('Title'); ?></th>
			                  <th><?php echo JText::_('Title attribute'); ?></th>
			                  <th><?php echo JText::_('Downloads'); ?></th>
			                  <th><?php echo JText::_('Operations'); ?></th>
			                </tr>
			                <?php foreach ($this->row->attachments as $attachment) : ?>
			                <tr>
			                  <td class="attachment_entry"><?php echo $attachment->filename; ?></td>
			                  <td><?php echo $attachment->title; ?></td>
			                  <td><?php echo $attachment->titleAttribute; ?></td>
			                  <td><?php echo $attachment->hits; ?></td>
			                  <td><a href="index.php?option=com_k2&amp;view=item&amp;task=download&amp;id=<?php echo $attachment->id ?>"><?php echo JText::_('Download'); ?></a> <a class="deleteAttachmentButton" href="<?php echo JURI::root(); ?>index.php?option=com_k2&amp;view=item&amp;task=deleteAttachment&amp;id=<?php echo $attachment->id?>&amp;cid=<?php echo $this->row->id; ?>"><?php echo JText::_('Delete'); ?></a></td>
			                </tr>
			                <?php endforeach; ?>
			              </table>
			              <?php endif; ?>
			            </div>
			            <div style="padding:0 16px;">
			              <input type="button" value="<?php echo JText::_('Add attachment field'); ?>" onclick="addAttachment();" />
			            </div>
			            <div id="itemAttachments"></div>
			            <?php if (count($this->K2PluginsItemAttachments)  && $this->params->get('showK2Plugins')): ?>
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemAttachments as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			            <?php endif; ?>
			          </div>
			          <?php endif; ?>
			          <?php if(count(array_filter($this->K2PluginsItemOther)) && $this->params->get('showK2Plugins')): ?>
			          <div class="simpleTabsContent">
			            <div class="itemPlugins">
			              <?php foreach ($this->K2PluginsItemOther as $K2Plugin) : ?>
			              <?php if(!is_null($K2Plugin)): ?>
			              <fieldset>
			                <legend><?php echo $K2Plugin->name; ?></legend>
			                <?php echo $K2Plugin->fields; ?>
			              </fieldset>
			              <?php endif; ?>
			              <?php endforeach; ?>
			            </div>
			          </div>
			          <?php endif; ?>
			        </div>
			        <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
			        <input type="hidden" name="option" value="<?php echo $option; ?>" />
			        <input type="hidden" name="view" value="item" />
			        <input type="hidden" name="task" value="save" />
			        <?php echo JHTML::_('form.token'); ?>

			      </td>

			      <td id="adminFormK2Sidebar"<?php if(!$this->params->get('sideBarDisplayFrontend',0)): ?> style="display:none;"<?php endif; ?>>

		        	<table class="sidebarDetails">
		            <?php if($this->row->id): ?>
		            <tr>
		              <td><strong><?php echo JText::_('Item ID'); ?></strong></td>
		              <td><?php echo $this->row->id; ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('State'); ?></strong></td>
		              <td><?php echo ($this->row->published > 0) ? JText::_('Published') : JText::_('Unpublished'); ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Featured state'); ?></strong></td>
		              <td><?php echo ($this->row->featured > 0) ? JText::_('Featured'):	JText::_('Not featured'); ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Created date'); ?></strong></td>
		              <td><?php if ($this->row->created == $nullDate) echo JText::_('New document'); else echo JHTML::_('date', $this->row->created, JText::_('DATE_FORMAT_LC2')); ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Created by'); ?></strong></td>
		              <td><?php echo $this->row->author; ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Modified date'); ?></strong></td>
		              <td><?php if ( $this->row->modified == $nullDate ) {	echo JText::_('Never');}
					else { echo JHTML::_('date', $this->row->modified, JText::_('DATE_FORMAT_LC2'));} ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Modified by'); ?></strong></td>
		              <td><?php echo $this->row->moderator; ?></td>
		            </tr>
		            <tr>
		              <td><strong><?php echo JText::_('Hits'); ?></strong></td>
		              <td>
		              	<?php echo $this->row->hits; ?>
		              	<?php if($this->row->hits): ?>
		              	<input type="button" onclick="submitbutton('resetHits');" value="<?php echo JText::_('Reset'); ?>" class="button" name="resetHits" />
		              	<?php endif; ?>
		              </td>
		            </tr>
		            <?php endif; ?>
		            <?php if($this->row->id): ?>
		            <tr>
		            	<td><strong><?php echo JText::_('Rating'); ?></strong></td>
			          	<td>
			          		<?php echo $this->row->ratingCount; ?> <?php echo JText::_('votes'); ?>
			            	<?php if($this->row->ratingCount): ?>
			            	<br />
			            	(<?php echo JText::_('average rating'); ?>: <?php echo number_format(($this->row->ratingSum/$this->row->ratingCount),2); ?>/5.00)
			            	<?php endif; ?>
			            	<input type="button" onclick="submitbutton('resetRating');" value="<?php echo JText::_('Reset'); ?>" class="button" name="resetRating" />
			         		</td>
		            </tr>
		            <?php endif; ?>
		            <tr>
		              <td><strong><?php echo JText::_('Max upload size'); ?></strong></td>
		              <td><?php echo ini_get('upload_max_filesize'); ?></td>
		            </tr>
		          </table>

			        <?php jimport('joomla.html.pane'); $pane = & JPane::getInstance('sliders', array('allowAllClose' => true)); echo $pane->startPane('myPane2'); ?>
			        <?php echo $pane->startPanel(JText::_('Details'), 'details'); ?>
			        <table class="admintable">
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Author'); ?></td>
			            <td><?php echo $this->row->editor; ?></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Author alias'); ?></td>
			            <td><input class="text_area" type="text" name="created_by_alias" maxlength="250" value="<?php echo $this->row->created_by_alias; ?>" /></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Access level'); ?></td>
			            <td><?php echo $this->lists['access']; ?></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Creation date'); ?></td>
			            <td class="k2ItemFormDateField"><?php echo JHTML::_( 'calendar',$this->row->created, 'created', 'created', '%Y-%m-%d %H:%M:%S'); ?></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Start publishing'); ?></td>
			            <td class="k2ItemFormDateField"><?php echo JHTML::_( 'calendar',$this->row->publish_up, 'publish_up', 'publish_up', '%Y-%m-%d %H:%M:%S'); ?></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Finish publishing'); ?></td>
			            <td class="k2ItemFormDateField"><?php echo JHTML::_( 'calendar',$this->row->publish_down, 'publish_down', 'publish_down', '%Y-%m-%d %H:%M:%S'); ?></td>
			          </tr>
			        </table>
			        <?php	echo $pane->endPanel(); ?>

							<!--
				  		<?php echo $pane->startPanel(JText::_('Metadata information'), "metadata-page"); ?>
			        <table class="admintable">
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Description'); ?></td>
			            <td><textarea rows="5" name="metadesc" cols="30"><?php echo $this->row->metadesc; ?></textarea></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Keywords'); ?></td>
			            <td><textarea rows="5" name="metakey" cols="30"><?php echo $this->row->metakey; ?></textarea></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Robots'); ?></td>
			            <td><input type="text" name="meta[robots]" size="30" value="<?php echo $this->lists['metadata']->get('robots'); ?>" /></td>
			          </tr>
			          <tr>
			            <td align="right" class="key"><?php echo JText::_('Author'); ?></td>
			            <td><input type="text" name="meta[author]" size="30" value="<?php echo $this->lists['metadata']->get('author'); ?>" /></td>
			          </tr>
			        </table>
							<?php echo $pane->endPanel(); ?>
							<?php echo $pane->startPanel(JText::_('Item view options in category listings'), "item-view-options-listings"); ?>
							<?php echo $this->form->render('params','item-view-options-listings'); ?>
							<?php echo $pane->endPanel(); ?>
							<?php echo $pane->startPanel(JText::_('Item view options'), "item-view-options"); ?>
							<?php echo $this->form->render('params','item-view-options'); ?>
							<?php echo $pane->endPanel(); ?>
							-->

			        <?php echo $pane->endPane(); ?>
			    	</td>
			    </tr>
			  </tbody>
			</table>

	  	<div class="clr"></div>
  </div>
</form>
