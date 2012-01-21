<?php
/**
 * @package WordPress
 * @subpackage Wordousel Lite
 */
?>
	<div id="sidebar">

	<ul>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
			<?php endif; ?>
		</ul>

	</div>
