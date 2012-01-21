<!-- begin footer -->
</div><!-- end content -->

<hr />

</div><!-- end container -->
<div id="footer">
  <p id="top"><a href="#top-menu" title="Jump to the top of the page">top</a></p>
  
  <div id="inner-footer">
    <h2 class="skip">Footer Navigation</h2>
    
    <div class="footerbar">
      <ul>
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>
		    <li class="widget">
          <h3>Last Posts</h3>
  		    <ul>
  		      <?php wp_get_archives('type=postbypost&limit=6'); ?>
  		    </ul>
		    </li>
  		<?php endif; ?>
      </ul>    
    </div>
    
    <div class="footerbar second">
      <ul>
		  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>
		    <li class="widget">
          <h3>Monthly Archives</h3>
  		    <ul>
  		      <?php wp_get_archives('type=monthly&limit=6'); ?>
  		    </ul>
		    </li>
  		<?php endif; ?>
      </ul>    
    </div>

    <div class="credits">
      <p>Design by <a href="http://www.tomstardust.com" title="Web Design Blog - TomStardust.com">Tommaso Baldovino</a></p>  
      <p><a href="http://wordpress.org/" title="Wordpress.org"><?php _e('Powered by WordPress')?></a> and <a href="http://www.tomstardust.com/wordpress-themes/exciter/" title="Exciter Wordpress Theme">Exciter</a></p>
    </div>
    
    <?php wp_footer(); ?>
  </div>
</div>
</body>
</html>