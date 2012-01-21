<?php

function counterize_options_page()
{ 
 
  # For the "amount-to-show"-administration
  if (isset($_POST['adm']))
  {
    	if (is_numeric($_POST['amount']))
    	{
        update_option('counterize_amount', (int) $_POST['amount']);
        counterize_updateText('Number-settings updated');
    	}
    	else
    		counterize_updateText($_POST['amount'] . __(" is not a valid number!","counterize"));
  }

  # For the "graph-bars"-administration
  if (isset($_POST['adm_bars']))
  {
      if (is_numeric($_POST['amount2']))
      {
        update_option('counterize_amount2', (int) $_POST['amount2']);
        counterize_updateText("Number-settings updated");
      }
      else
        counterize_updateText($_POST['amount2'] . __(" is not a valid number!","counterize"));
  }

  # For the log-bot enable/disable option
  if (isset($_POST['bot']))
  {
      $status = get_option('counterize_logbots');
    	if ($status == "enabled")
    	{
        update_option('counterize_logbots', "disabled");
        counterize_updateText('Bot logging disabled!');
    	}
    	else
    	{
    		update_option('counterize_logbots', "enabled");
        counterize_updateText('Bot logging enabled!');
    	}
  }

  # For the flush DB option
  if (isset($_POST['flush']))
  {
  		if ($_POST['check'] == "logcheck")
			{
			   counterize_flush();
  	     counterize_updateText(__("Database flushed!","counterize"). " ($num " . __("records deleted)","counterize"));
  		}
  }


  # For excluding IP's
  if (isset($_POST['adm2']))
  {
    	if (is_string($_POST['excludelist']))
    	{
        update_option('counterize_excluded', $_POST['excludelist']);
        counterize_updateText('Excludelist-Settings updated');
    	}
    	else
    		counterize_updateText($_POST['excludelist'] . __(" is not a valid string!","counterize"));
  }

  # For excluding Users
  if (isset($_POST['adm3']))
  {
    	if(!empty($_POST['excluded_users']))
        $excluded_users = join($_POST['excluded_users'],','); 
      
  	  update_option('counterize_excluded_users', $excluded_users);
  	  counterize_updateText(__('Excluded users saved. Current number of excluded users: ',"counterize") . count($_POST['excluded_users']));
  }
  
  # For the "max-width"-administration
  if (isset($_POST['adm_maxWidth']))
  {
      if (is_numeric($_POST['maxWidth']))
      {
        update_option('counterize_maxWidth', (int) $_POST['maxWidth']);
        counterize_updateText("Width-settings updated");
      }
      else
        counterize_updateText($_POST['maxWidth'] . __(" is not a valid number!","counterize"));
  }  
  

  # Get info from database
  $excludelist = get_option('counterize_excluded');
  $excluded_users = explode(",",get_option('counterize_excluded_users'));
  $amount = get_option('counterize_amount');
  $amount2 = get_option('counterize_amount2');
  $MajorVersion = get_option('counterize_MajorVersion');
  $MinorVersion = '0' . get_option('counterize_MinorVersion');
  $maxWidth = get_option('counterize_maxWidth');
  ?>
  
  <div class="wrap">
  	<h2><?php echo __('Counterize configuration - Version ',"counterize") . $MajorVersion . '.' . $MinorVersion; ?></h2>
    <table width="100%" cellpadding="3" cellspacing="3" class="editform">
  	  <tr class="alternate">
        <td>
  	      <?php _e("Amount of rows to show in history","counterize"); ?><br />
          <small><strong>0</strong> <?php _e("to view all","counterize");?></small>
        </td>
        <td >
          <form action="" method="post">
            <input type="text" value="<?php print $amount; ?>" name="amount" size="5" />
  		      <input type="submit" name="adm" value="<?php _e('Save settings',"counterize"); ?>"/>
  		    </form>
  		  </td>		
      </tr>
      <tr>
        <td>
  	      <?php _e("Rows to show in 'top xx' bars","counterize"); ?>
        </td>
        <td >
          <form action="" method="post">
            <input type="text" value="<?php print $amount2; ?>" name="amount2" size="5" />
  		      <input type="submit" name="adm_bars" value="<?php _e('Save settings',"counterize"); ?>"/>
  		    </form>
  		  </td>		
      </tr>
  	  <tr class="alternate">
  		  <td>
  		    <?php _e("Enable/disable logging of <a href=\"http://en.wikipedia.org/wiki/Internet_bot\">bots</a>","counterize"); ?>
        </td>
  		  <td >
  		    <form action="" method="post" >
  		    <?php
  		      if (get_option('counterize_logbots') == "enabled")
  			       echo "<input type=\"submit\" name=\"bot\" value=\"" . __("Disable bot-logging","counterize") . "\" />";
  		      else
  			       echo "<input type=\"submit\" name=\"bot\" value=\"" . __("Enable bot-logging","counterize") . "\" />";
  		    ?>
  		    </form>
  		  </td>
  	  </tr>
  	  <tr>
  		  <td>
  			  <?php 
            _e("Flush the Counterize Database","counterize");
            echo "<br><small>";
            _e("(This means deleting all records and all stats!)","counterize");
            echo"</small>";
            ?>
  		  </td>
  		  <td>
  		    <form action="" method="post">
  		      <input name="check" type=checkbox value="logcheck" />
  		      <input type="submit" name="flush" value="<?php _e("Empty database!","counterize"); ?>" />
  		    </form>
  		  </td>
  	  </tr>	  	 
  	  <tr class="alternate">
  		  <td>
  			  <?php _e("Maximum width for labels","counterize"); ?>
  		  </td>
  		  <td>
  		    <form action="" method="post">
  		      <input type="text" value="<?php print $maxWidth; ?>" name="maxWidth" size="5" />
  		      <input type="submit" name="adm_maxWidth" value="<?php _e("Save settings","counterize"); ?>" />
  		    </form>
  		  </td>
  	  </tr>	   	  
    </table>
  </div>
  
  <div class="wrap">
    <h2><?php _e('Counterize excludelist',"counterize");?></h2>
    <form action="" method="post">
      <table width="100%" cellpadding="3" cellspacing="3" class="editform">
        <tr>
          <td width="30%" scope="row">
  	        <?php _e("IP's to exclude","counterize"); ?>
  	        <br><small><br><?php _e("(Enter IP's seperated with space)","counterize");?></small>
  	      </td>
          <td width="50%">
  		      <textarea style="font-size: 1em;" cols="50" rows="3" name="excludelist"><?php print $excludelist; ?></textarea>
          </td>
          <td width="20%">
          	<input type="submit" name="adm2" value="<?php _e('Save settings',"counterize"); ?>"/>
  		    </td>		
        </tr>
      </table>
  	</form>
  
  	<form action="" method="post">
  	 <table width="100%" cellpadding="3" cellspacing="3" class="editform">
  	   <tr>
  	     <td width="30%" >
  		     <?php _e('Select users that may not be counted:',"counterize"); ?>
  		     <br><small><br><?php _e('(Use Ctrl-key for selecting multiple entries)',"counterize"); ?></small>
  	     </td>
  	     <td width="50%">
  		     <?php 
  		        $wpdb =& $GLOBALS['wpdb'];
  		        $sql = "SELECT * FROM $wpdb->users";
  		        $users = $wpdb->get_results($sql); 
  		     ?>
  	   	   <select name="excluded_users[]" multiple size="4">
  		     <?php 
              foreach ($users as $user)
              { 
           ?>
  		        <option value="<?php echo $user->ID; ?>" <?php if(in_array($user->ID,$excluded_users)){ echo "selected"; } ?>><?php echo $user->display_name."&nbsp;&nbsp;&nbsp;[".$user->user_login."]"; ?>
  		     <?php 
              } 
           ?>
  		     </select>
  	     </td>
  	     <td width="20%">
  		     <input type="submit" name="adm3" value="<?php _e('Save settings',"counterize"); ?>"/>
  	     </td>
  	   </tr>
  	 </table>
   </form>
  </div>
  <?php  
  counterize_pagefooter();
}

?>
