<?php get_header(); ?>
        <div id="content">
            <div id="postarea">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="postcontent">
            <div class="postcontent_in">

        <h2><?php the_title(); ?></h2>

<?php the_date(); ?> by: <?php the_author() ?>  <?php edit_post_link(__('Edit This')); ?>

<div class="post">

	<div class="storycontent">
		<?php the_content(__('(more...)')); ?>
    <div class="clear"></div>
	</div>

    <div class="meta">
        <?php _e("Filed under:"); ?> <?php the_category(',') ?><br />
        <?php the_tags(__('Tags: '), ', '); ?>
    </div>

	<div class="feedback">
		<?php wp_link_pages(); ?>
		<?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div>

</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
        <div class="homepage_post">
            <div class="homepage_in">
                <h3 style="margin-bottom:800px;"><?php _e('Sorry, no posts matched your criteria.'); ?></h3>
            </div>
        </div>
<?php endif; ?>

            </div>
        </div>
            </div>

                <?php get_sidebar(); ?>

            </div>
<?php get_footer(); ?>