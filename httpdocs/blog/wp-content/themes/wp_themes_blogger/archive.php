<?php get_header(); ?>
        <div id="content">
            <div id="postarea">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php include(TEMPLATEPATH."/excrept.php"); ?>

    <?php endwhile; else: ?>

        <div class="homepage_post">
            <div class="homepage_in">
                <h3 style="margin-bottom:800px;"><?php _e('Sorry, no posts matched your criteria.'); ?></h3>
            </div>
        </div>

    <?php endif; ?>

    <div class="pagenavigation">
		<div class="navleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="navright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    <div class="clear"></div>
    </div>

            </div>

                <?php get_sidebar(); ?>

            </div>
<?php get_footer(); ?>