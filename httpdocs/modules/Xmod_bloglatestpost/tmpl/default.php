<?php // no direct access class="mainlevel"
defined('_JEXEC') or die('Restricted access'); 
?>
 <div class="module<?php echo $params->def('moduleclass_sfx');?>">
       <div>
 		  <ul id="mainlevel">
    		<?php 
 			if( count($blogLatestPostLists) > 0)  {
				foreach($blogLatestPostLists as $post){
					print('<li>
					<img src="./components/com_blog/Images/icons/doublearrowsnav.gif"  border="0" alt="Latest Posts" />
					<a href="'.JRoute::_('index.php?option=com_blog&view=comments&pid='.$post->id, false).'">'. substr($post->post_title, 0, $params->def('titlelength')).'...('.mod_bloglatestpostHelper::fncGetTotalComments($post->id).')</a></li>');
				}
			}
			?>
        </ul>
   </div>
</div>
