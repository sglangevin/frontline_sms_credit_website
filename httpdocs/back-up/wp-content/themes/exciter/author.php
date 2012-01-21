<?php get_header(); ?>

<?php
if(isset($_GET['author_name'])) :
$curauth = get_userdatabylogin($author_name);
else :
$curauth = get_userdata(intval($author));
endif;
?>

<h2>Posts by <?php echo $curauth->nickname; ?>:</h2>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php 
     $time = get_the_time('M d Y');
     list($mo, $da, $ye) = explode(" ", $time);
	?>
  <div class="date" title="<?php the_time('d-m-Y'); ?>">
    <p>
         <span class="month"><?php echo($mo); ?></span>
         <span class="day"><?php echo($da); ?></span>
         <span class="year"><?php echo($ye); ?></span>
    </p>
  </div>
	<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
  <div class="meta"><p><span class="category"><?php _e("category:"); ?> <?php the_category(',') ?></span> <span class="user">author: <?php the_author_posts_link(); ?> </span> <?php edit_post_link(__('Edit This')); ?></p></div>

  <div class="storycontent">
  	<?php the_excerpt("Continue reading " . the_title('"', '"', false) . " &raquo;"); ?>
  </div>

  <p class="feedback"><?php comments_popup_link(__('0 comments'), __('1 comment'), __('% comments')); ?></p>
	<?php if (function_exists('the_tags')): ?>
  	<?php if (has_tag()): ?>
    	<p class="tags"><?php the_tags('tag: ',', '); ?></p>
  	<?php endif;?>
	<?php endif;?>

</div>
<hr />
<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<p class="navigation"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>

<?php get_footer(); ?>