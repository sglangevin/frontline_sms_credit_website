        <div id="header_right">
            <div id="top_search">
                <form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" value="Search This Blog..." name="s" id="topsearch" onfocus="if (this.value == 'Search This Blog...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search This Blog...';}" />
                <input type="submit" id="searchbut" value="GO" /></form>
            </div>
        </div>
            
            <div id="sidebar"><!-- Sidebar Start Here -->
            
<div id="nav_right">
        <?php $tc_feed_rss_check = get_option('tc_feed_rss_check'); if($tc_feed_rss_check): ?>
                <a href="http://feeds.feedburner.com/<?php $tc_feed_rss = get_option('tc_feed_rss'); echo $tc_feed_rss; ?>" target="_blank">RSS</a>
                <a href="http://feeds.feedburner.com/<?php $tc_feed_rss = get_option('tc_feed_rss'); echo $tc_feed_rss; ?>" target="_blank"><img style="vertical-align:middle" src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="Subscribe to <?php bloginfo('name'); ?>" /></a>
        <?php else: ?>
                <a href="<?php bloginfo('rss_url'); ?>" target="_blank">RSS</a>
                <a href="<?php bloginfo('rss_url'); ?>" target="_blank"><img style="vertical-align:middle" src="<?php bloginfo('template_url'); ?>/images/rss.png" alt="Subscribe to <?php bloginfo('name'); ?>" /></a>
        <?php endif; ?>
            </div>
                        
                <div id="sidebar_in">

             <?php $tc_ad_check = get_option('tc_ad_check'); if($tc_ad_check): ?>

                <div class="advertisment">
                    <a href="<?php $tc_ad1_link = get_option('tc_ad1_link'); echo stripslashes($tc_ad1_link); ?>" target="_blank"><img src="<?php $tc_ad1 = get_option('tc_ad1'); echo stripslashes($tc_ad1); ?>" alt="advertisment" /></a>
                    <a href="<?php $tc_ad2_link = get_option('tc_ad2_link'); echo stripslashes($tc_ad2_link); ?>" target="_blank"><img src="<?php $tc_ad2 = get_option('tc_ad2'); echo stripslashes($tc_ad2); ?>" alt="advertisment" /></a>
                    <a href="<?php $tc_ad3_link = get_option('tc_ad3_link'); echo stripslashes($tc_ad3_link); ?>" target="_blank"><img src="<?php $tc_ad3 = get_option('tc_ad3'); echo stripslashes($tc_ad3); ?>" alt="advertisment" /></a>
                    <a href="<?php $tc_ad4_link = get_option('tc_ad4_link'); echo stripslashes($tc_ad4_link); ?>" target="_blank"><img src="<?php $tc_ad4 = get_option('tc_ad4'); echo stripslashes($tc_ad4); ?>" alt="advertisment" /></a>
                </div>

             <?php endif; ?>

            <?php global $user_ID, $user_identity, $user_level ?>
            <?php if ( $user_level >= 1 ) : ?>
            <div class="widget">
            <!--
                <h2>Admin Panel</h2>
                    <ul>
                        <li><a href="<?php bloginfo('url') ?>/wp-admin/themes.php?page=functions.php">Theme Settings</a></li>
                        <li><a href="<?php bloginfo('url') ?>/wp-admin/">Go to dashboard</a></li>
                        <li><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php">Make new post</a></li>
                        <li><a href="<?php bloginfo('url') ?>/wp-admin/page-new.php">Make new page</a></li>
                        <li><a href="<?php bloginfo('url') ?>/wp-admin/profile.php">View profile</a></li>
                        <li><?php wp_loginout(); ?></li>
                    </ul> -->
            </div>
            <?php endif // $user_level >= 1 ?>

            <?php $tc_feed_check = get_option('tc_feed_check'); if($tc_feed_check): ?>

            <div class="widget">
	            <div class="newsletter">

		            <h3>Subscribe to NewsLetter</h3>
		            Get the latest updates via Email <br /> Service provided by FeedBurner
                        <form id="subscribe_news" action="http://www.feedburner.com/fb/a/emailverify" method="post" target="popupwindow" onsubmit="window.open('http://www.feedburner.com', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                        <p><input type="text" value="Enter your email address..." id="newsbox" onfocus="if (this.value == 'Enter your email address...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter your email address...';}" name="email"/>
                        <input type="hidden" value="http://feeds.feedburner.com/~e?ffid=<?php $tc_feed = get_option('tc_feed'); echo $tc_feed; ?>" name="url"/>
                        <input type="hidden" value="NewsLetter" name="title"/>
                        <input type="submit" value="GO" id="newsbut" /></p></form>
	            </div>
            </div>

            <?php endif; ?>

        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Article Sidebar') ) : else : ?>

                <div class="widget">
                    <h2>Recent Posts</h2>
                        <ul>
                            <?php get_archives('postbypost', 10); ?>
                        </ul>
                </div>

                <div class="widget">
                    <h2>Categories</h2>
                        <ul>
                            <?php wp_list_categories('sort_column=name&title_li='); ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2>Tag Cloud</h2>
                        <?php wp_tag_cloud('smallest=8&largest=24&'); ?>
                </div>

                <div class="widget">
                    <h2>Archives</h2>
                        <ul>
                            <?php wp_get_archives('type=monthly'); ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2>Links</h2>
                        <ul>
                            <?php get_links(-1, '<li>', '</li>', ' - '); ?>
                        </ul>
                </div>

                <div class="widget">
                    <h2>Meta</h2>
                        <ul>
				            <?php wp_register(); ?>
				            <li><?php wp_loginout(); ?></li>
				            <li><a href="http://www.wordpress.org/" target="_blank">WordPress</a></li>
				            <?php wp_meta(); ?>
				            <li><a href="http://validator.w3.org/check?uri=referer" target="_blank">XHTML</a></li>
                        </ul>
                </div>

            <?php endif; ?>
                </div>
            </div><!-- Sidebar End Here -->