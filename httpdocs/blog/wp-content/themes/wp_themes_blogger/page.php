<?php get_header(); ?>
        <div id="content">
            <div id="postarea">
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="postcontent">
            <div class="postcontent_in">

                <div class="post">
			    <h2><?php the_title(); ?></h2>

                    <div class="post">
                        <?php the_content(__('Read more'));?>
                    </div>

                <div class="clear"></div>
                </div>
                </div>
            </div>

            <?php endwhile; else: ?>

        <div class="homepage_post">
            <div class="homepage_in">
                <h3 style="margin-bottom:800px;"><?php _e('Sorry, no posts matched your criteria.'); ?></h3>
            </div>
        </div>

            <?php endif; ?>

            </div>

                <?php get_sidebar(); ?>

            </div>
<?php get_footer(); ?>