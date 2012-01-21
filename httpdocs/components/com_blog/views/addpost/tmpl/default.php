<?php defined('_JEXEC') or die('Restricted access');
$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
$Edoptions['theme']	= 'simple';
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
<form action="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost', false); ?>" method="post" id="josForm" name="josForm"  class="form-validate" enctype="multipart/form-data">
<div>
<div>
	<div class="clsLinkedBlog"><div class="clsLinkedBlog_title"><?php echo JText::_( 'Smart Blog' ); ?></div></div>
	<div id="clsTopMenuBg">
		<?php if($this->user->get('id') > 0){ ?>
		<div class="clsFloatRight">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/mypost.png"  border="0" width="16px" align="bottom" alt="My Posts" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Posts');?></a>
			<?php #echo JText::_('Display Posts : ');  echo $this->pagination->getLimitBox(true); ?>
 		</div>
		<div class="clsFloatLeft">
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/myaccount.png"  border="0" width="16px" align="bottom" alt="My Account" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Account');?></a>
 		</div>
		<?php }?>
		<div class="clsFloatRight"><img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_post.png"  border="0" width="16px" align="bottom" alt="Add New Post" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('Add New Post');?></a>
		</div>
		<div class="clsClearBoth"></div>
	</div>
</div>
	<div id="clsTableTdPadd">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td height="25" valign="top" colspan="2"><label id="post_titlemsg" for="post_title"><?php echo JText::_( 'Title' ); ?>:</label>
			<div id="clsTableTdPadd"><input type="text" maxlength="500" size="80%"  class="inputbox required" name="post_title" id="post_title" value="<?php echo $this->BlogDetails->post_title;?>" /> *</div></td>
		</tr>
		<tr>
			<td colspan="2" height="25" valign="top"><label id="post_descmsg" for="post_desc"><?php echo JText::_( 'Content' ); ?>:</label>
			<div id="clsTableTdPadd">
			<?php
				echo $this->editor->display('post_desc', $this->BlogDetails->post_desc, '95%', '350', '50', '6', false, $Edoptions);
 			?>
			</div>
			</td>
		</tr>
		<tr>
			<td height="25" valign="top"><?php echo JText::_( 'Upload Image' ); ?></td>
			<td valign="top">
			<div id="clsTableTdPadd">
				<input type="file" name="image" id="file-upload" /> (.jpeg, .gif, .png only)
				<input type="hidden" name="image_old" id="image_old" value="<?php echo $this->BlogDetails->post_image;?>" />
				<?php if($this->BlogDetails->post_image){?>
				<div align="left">
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/blogimages/<?php echo "th".$this->BlogDetails->post_image;?>"  border="0" alt="Blog Image"  class="clsImgPad" />
				</div>
				<? } ?>
			</div>
			</td>
		</tr>
		<tr>
			<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="product_specialmsg" for="product_special"><?php echo JText::_( 'Do you want to publish?' ); ?>:</label>
			<? print $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"  size="1"', ( isset($this->BlogDetails->published)) ? $this->BlogDetails->published : 1); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" height="25" align="right" class="clsTDBorderTop">
				<?php echo JText::_( '* Required' ); ?>
			</td>
		</tr>
		<tr>
			<td height="25"></td>
			<td>
				<button class="button validate" type="button"  onClick="javascript:window.location='<?php echo JRoute::_('index.php?option=com_blog&view=blog' ); ?>'"><?php echo JText::_(' Cancel '); ?></button>
				<button class="button validate" type="submit"><?php echo JText::_('Save Post'); ?></button>	</td>
		</tr>
	</table>
	</div>
</div>
<input type="hidden" name="option" value="com_blog" />
<input type="hidden" name="view" value="addpost" />
<input type="hidden" name="user_id" value="<?php echo $this->user->get('id');?>" />
<input type="hidden" name="id" value="<?php echo $this->BlogDetails->id;?>" />
<input type="hidden" name="controller" value="blog" />
<input type="hidden" name="task" value="save_blogpost" />
</form>