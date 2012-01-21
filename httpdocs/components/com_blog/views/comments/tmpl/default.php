<?php defined('_JEXEC') or die('Restricted access');
$Edoptions['theme']	= 'simple';
$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
<div>
	<div class="clsLinkedBlog"><div class="clsLinkedBlog_title"><?php echo JText::_( 'Smart Blog' ); ?></div></div>
	<div id="clsTopMenuBg">
		<?php if($this->user->get('id') > 0){ ?>
		<div class="clsFloatRight">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/mypost.png"  border="0" width="16px" align="bottom" alt="My Posts" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Posts');?></a>
			<?php #echo JText::_('Display Posts : ');  echo $this->pagination->getLimitBox(true); ?>
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
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="left">
		<div class="clsPostTitle"><?php print($this->BlogPostList->post_title);?></div>
		<div class="clsTDBorderTop"></div>
 		</td>
	  </tr>
	  <tr>
		<td align="left" valign="top">
		<?php 
		if($this->BlogPostList->post_image){?>
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/blogimages/<?php echo "th".$this->BlogPostList->post_image;?>"  border="0" alt="Blog Image" align="left" class="clsImgPad" />
 		<? } ?>
		<?php print($this->BlogPostList->post_desc);?>
		</td>
	  </tr>
	  <tr>
		<td align="left">
			<div id="divBlogDetails">
				<?php echo JText::_('By:');?>
				<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=blogger&bn='.$this->BlogPostList->postedby.'&Itemid='.$Itemid, false);?>"><?php echo JText::_($this->BlogPostList->postedby);?></a>
				<?php echo JText::_('On ').JHTML::_('date',  $this->BlogPostList->post_date, JText::_('DATE_FORMAT_LC1')); ?>
				
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/comments.gif"  border="0" alt="Comment" />
				<a  href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$this->BlogPostList->id.'&Itemid='.$Itemid.'#comment', false); ?>">
					<?php echo JText::_('Comments( '.$this->BlogCommentCount.' )');?></a>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/hits.gif"  border="0" alt="Hits" />
				<?php echo JText::_('Views('.$this->BlogPostHits->post_hits.')');?>
				
				<?php if($this->BlogPostList->user_id == $this->user->get('id')){?>
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/favorite.gif"  border="0" alt="Edit" />
					<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&pid='.$this->BlogPostList->id.'&Itemid='.$Itemid, false); ?>"><?php echo JText::_('Edit');?></a>
					
					<?php $delLink = JRoute::_( 'index.php?option=com_blog&view=comments&task=delete_mypost&pid='.$this->BlogPostList->id.'&Itemid='.$Itemid, false);?>
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/delete.gif"  border="0" alt="Delete" />
					<a href="javascript:void(0);"  onClick="javascript:__fncDeletePosts('<?php echo $delLink;?>');return false;"><?php echo JText::_('Delete');?></a>
				<?php }?>
			</div>
		</td>
	  </tr>
	</table>
	<div>
	<a name="comment"></a>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	  	<td align="left" valign="top">
			<div class="clsBGCommentTop"><?php echo JText::_(' Comments('.$this->BlogCommentCount.')');?></div>
		</td>
	  </tr>
	  <?php 
	  $count=1;
	  foreach( $this->BlogCommentList as $BlogComment):
		$class = ($count%2 != 0) ? 'table_row_first' : 'table_row_second'; 
	  ?>
	  <tr class="<?php echo $class;?>">
		<td align="left" valign="top" style="padding:3px;">
			<div class="clsCommentTitle">
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/comments.jpg"  border="0" alt="Comments" />
				<?php echo JText::_($BlogComment->comment_title);?>
			</div>
			<div style="padding-left:20px;"><?php echo JText::_($BlogComment->comment_desc);?></div>
			
			<div id="divBlogDetails">
				<div align="right">
					<?php echo JText::_('By: ');?>
					<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=blogger&bn='.$BlogComment->commentedby.'&Itemid='.$Itemid, false);?>"><?php echo JText::_($BlogComment->commentedby);?></a>
					<?php echo JText::_(', On');?> 
 					
					<?php echo JHTML::_('date',  $BlogComment->comment_date, JText::_('DATE_FORMAT_LC1')); ?>
					
					<?php if($this->user->get('id')){?>
					
					
						
						
						<?php 
						if($this->user->get('id') == $BlogComment->user_id  || $this->BlogPostList->user_id == $this->user->get('id') ){
 							$delLink = JRoute::_( 'index.php?option=com_blog&view=comments&task=delete_comment&pid='.$this->BlogPostList->id.'&Itemid='.$Itemid, false);?>
 						
							<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/delete.gif"  border="0" alt="Delete" />
							<a href="javascript:void(0);"  onClick="javascript:__fncDeleteComment('<?php echo $delLink;?>');return false;"><?php echo JText::_('Delete');?></a>
							<?php
						}
					 }?>
				
				</div>
 			</div>
		</td>
	  </tr>
	  <tr><td><div class="clsTDBorderTop"></div></td></tr>
	  <?php
		$count++;
	  endforeach;?>
	  <tr>
		<td>&nbsp;</td>
	  </tr>
	</table>
	</div>
	<?php if( $this->user->get('id') <= 0 || trim($this->user->get('id')) == '' ){?>
			<div>
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_comment.gif"  border="0" alt="Add Comment" align="top" width="16" /> 
				<a href="<?php echo JRoute::_('index.php?option=com_user&view=login&return='.base64_encode(JRoute::_('index.php?option=com_blog&view=comments&pid='.$this->BlogPostList->id,false)), false);?>"><?php echo JText::_(' Please login to write comment');?> </a>
			</div>
	<?php }else{?>
	<form action="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments' ); ?>" method="post" id="josForm" name="josForm"  class="form-validate">
	<div>
		<div class="componentheading"><img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_comment.gif"  border="0" alt="Add Comment" align="top" /> <?php echo JText::_( ' Write comment' ); ?></div>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
 			<tr>
				<td height="25" colspan="2" valign="top"><label id="comment_titlemsg" for="comment_title"><?php echo JText::_( 'Title' ); ?>:</label>
				<div id="clsTableTdPadd"><input type="text" maxlength="150" size="80%"  class="inputbox required" name="comment_title" id="comment_title" value="" /> *</div></td>
			</tr>
 			<tr>
				<td colspan="2" height="25" valign="top"><label id="comment_descmsg" for="comment_desc"><?php echo JText::_( 'Comment' ); ?>:</label>
				<div id="clsTableTdPadd">
				<?php echo $this->editor->display('comment_desc', '', '95%', '200', '50', '6', false, $Edoptions); ?>
 				</div>
				</td>
			</tr>
 			<tr>
				<td height="25" class="clsTDBorderTop"></td>
				<td class="clsTDBorderTop">
					<div id="clsDivMarginTop10">
						<div class="clsFloatLeft">
							<button class="button validate" type="button"  onClick="javascript:window.location='<?php echo JRoute::_('index.php?option=com_blog&view=blog' ); ?>'"><?php echo JText::_(' Back '); ?></button>
							<button class="button validate" type="submit"><?php echo JText::_('Add Comment'); ?></button>
						</div>
						<div class="clsFloatRight"><?php echo JText::_( '* Required' ); ?></div>
						<div class="clsClearBoth"></div>
					</div>
					</td>
			</tr>
		</table>
	</div>
	<input type="hidden" name="option" value="com_blog" />
	<input type="hidden" name="view" value="blog" />
	<input type="hidden" name="post_id" value="<?php echo $this->BlogPostList->id;?>" />
	<input type="hidden" name="user_id" value="<?php echo $this->user->get('id');?>" />
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="controller" value="blog" />
	<input type="hidden" name="task" value="save_BlogComment" />
	</form>
	<script language="javascript" type="text/javascript">
 		function  __fncDeletePosts( strLink ){
			if( !confirm("Do you want to delete this post?")){
				return false;
			}
			window.location = strLink;
		}
		function  __fncDeleteComment( strLink ){
			if( !confirm("Do you want to delete this comment?")){
				return false;
			}
			window.location = strLink;
		}
		
	</script>
	<?php }?>
</div>