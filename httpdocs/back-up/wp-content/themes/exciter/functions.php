<?php
if ( function_exists('register_sidebars') )  {
register_sidebars(2, array(
        'name'=>'Footerbar %d',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
       ));
}

function stardust_comment($comment, $args, $depth) {
 $GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment" id="div-comment-<?php comment_ID() ?>">
		<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '48'); } ?>
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> says:
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>
			<br />
			<div class="comment-body">
				<?php comment_text() ?>
        <div class="reply">
           <?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>				
      </div>
    </div>
<?php
        }
?>