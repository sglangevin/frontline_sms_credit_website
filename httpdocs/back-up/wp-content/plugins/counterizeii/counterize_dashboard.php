<?php

# Small info on DashBoard-page
function counterize_dashboard()
{
  $admin = dirname($_SERVER['SCRIPT_FILENAME']);
  $admin = substr($admin, strrpos($admin, '/')+1);
	$count = counterize_getamount();
	$unique = counterize_getuniqueamount();
	$todaycount = counterize_gethitstoday();
	$online = counterize_get_online_users();
	$todayunique = counterize_getuniquehitstoday();
	
	?>
		  <div class='dashboard-widget' style='width: 300px; height: 150px;'>
  			<h3 class='dashboard-widget-title'><?php _e('Counterize II Status'); ?> <a href='edit.php?page=counterizeii/counterize.php'>&raquo;</a></h3>
  			<div class='dashboard-widget-content' >
  		  	<p><?php _e('Total: ','counterize'); ?> <strong><?php echo $count; ?></strong> <?php _e('hits and ','counterize')?> <strong><?php echo $unique; ?></strong> <?php _e(' unique.'); ?><br />
	        <?php _e('Today: ','counterize'); ?><strong><?php echo $todaycount; ?></strong> <?php _e('hits and ','counterize'); ?><strong><?php echo $todayunique; ?></strong><?php _e(' unique.'); ?><br />
	        <?php _e('Currently: ','counterize'); ?><strong><?php echo $online; ?></strong><?php _e(' users online.','counterize'); ?></p>
       </div>
     </div>
  <?php
}

?>
