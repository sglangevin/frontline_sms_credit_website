<div class="excrept_post">
    <div class="excrept_in">
    <?php include(TEMPLATEPATH."/thumbnail.php"); ?>
        <div class="the_excrept">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <?php content_limit(400); ?>
        </div>
        <div class="clear"></div>
        <div class="excrept_data">
            <div class="excrept_left">
                <?php the_time('F jS, Y') ?> by <?php the_author() ?>&nbsp;<?php edit_post_link('Edit','',''); ?>
            </div>
            <div class="excrept_right">
                <div class="excrept_but">
                    <?php comments_popup_link('Add Comment', '1 Comment', '% Comments'); ?>
                </div>
                <div class="excrept_but">
                    <a href="<?php the_permalink() ?>">Read More...</a>
                </div>
            </div>
        <div class="clear"></div>
        </div>
    </div>
</div>