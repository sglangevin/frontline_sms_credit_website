<?php
	if(!defined('xhanch_my_twitter'))
		exit;
	
	function xhanch_my_twitter_setting(){
		global $wpdb;
		global $xmt_accounts;
		global $xmt_default;
		
		$sel_account = urldecode(xhanch_my_twitter_form_get('profile'));
			
		$arr_header_style = array(
			'' => 'No Header',
			'avatar' => 'Your avatar + display name',
			'default' => 'Elegant Twitter bird + display name',
			'bird_with_text-2' => 'Twitter bird - side view + display name',
			'bird_with_text-3' => 'Twitter bird plays a notebook + display name',
			'bird_with_text-4' => 'Twitter bird with sharp nose + display name',
			'bird_with_text-5' => 'Twitter bird holds a \'Twitter\' board + display name',
			'bird_with_text-6' => 'Twitter bird holds a \'Follow Me\' banner + display name',
			'bird_with_text-7' => 'Twitter bird listens to music + display name',
			'bird_with_text-8' => 'Twitter bird - front view + display name',
			'bird_with_text-9' => 'Twitter bird - side view + display name',
			'bird_with_text-10' => 'Twitter bird with one wing down + display name',
			'bird_with_text-11' => 'Twitter bird stands next to \'Twitter\' board + display name',
			'logo_with_text-1' => 'Twitter logo 1 + display name',
			'logo_with_text-2' => 'Twitter logo 2 + display name',
		);
		
		$arr_dt_format = array(
			'd/m/Y' => 'dd/mm/yyyy',	
			'd.m.y' => 'dd.mm.yy',	
			'm/d/Y' => 'mm/dd/yyyy',
			'Y-m-d' => 'yyyy-mm-dd',
			'M d, Y' => 'mmm dd, yyyy',
			'd-F-Y' => 'dd-month-yyyy',
			'l, F d, Y' => 'dayname, month dd, yyyy',
		);
		
		$arr_tm_format = array(		
			'H:i' => 'hh:mm',
			'H:i:s' => 'hh:mm:ss',
			'h:i a' => 'hh:mm am/pm',
		);

		$arr_date_format = array();
		foreach($arr_dt_format as $dt_f=>$dt_v){
			$arr_date_format[$dt_f] = $dt_v;
			foreach($arr_tm_format as $tm_f=>$tm_v)
				$arr_date_format[$dt_f.' '.$tm_f] = $dt_v.' '.$tm_v;							
		}
		$arr_date_format['span'] = '? period ago';		

		$arr_tweet_order = array(
			'lto' => 'Latest to oldest',
			'otl' => 'Oldest to latest',
		);
				
		if(isset($_POST['cmd_xmt_create_profile'])){
			$acc_name = strtolower(xhanch_my_twitter_form_post('txt_xmt_account_name'));
			$valid_chars = str_split('abcdefghijklmnopqrstuvwxyz0123456789');
		
			if(empty($acc_name))
				echo '<div id="message" class="updated fade"><p>Profile name is empty</p></div>';			
			elseif(array_key_exists($acc_name, $xmt_accounts))
				echo '<div id="message" class="updated fade"><p>Profile already exists</p></div>';
			else{
				$chars = str_split($acc_name);
				$valid = true;
				foreach($chars as $key){
					if(!in_array($key, $valid_chars)){		
						$valid = false;		
						echo '<div id="message" class="updated fade"><p>Profile name must contain A to Z and 0 to 9</p></div>';
						break;
					}
				}
				if($valid){
					$xmt_accounts[$acc_name] = $xmt_default;
					update_option('xmt_accounts', $xmt_accounts);			
					echo '<div id="message" class="updated fade"><p>A new profile has been created</p></div>';			
				}
			}
		}elseif(isset($_POST['cmd_xmt_delete_profile'])){
			unset($xmt_accounts[$sel_account]);
			update_option('xmt_accounts', $xmt_accounts);	
			echo '<div id="message" class="updated fade"><p>Profile <b>'.htmlspecialchars($sel_account).'</b> has been deleted</p></div>';				
		}elseif($_POST['cmd_xmt_update_profile']){
			$xmt_config = array(
				'widget' => array(
					'title' => xhanch_my_twitter_form_post('txt_xmt_widget_title'),
					'name' => xhanch_my_twitter_form_post('txt_xmt_widget_name'),
					'link_title' => intval(xhanch_my_twitter_form_post('chk_xmt_widget_link_title')),
					'header_style' => xhanch_my_twitter_form_post('cbo_xmt_widget_header_style'),
					'custom_text' => array(
						'header' => xhanch_my_twitter_form_post('txa_xmt_widget_custom_text_header'),
						'footer' => xhanch_my_twitter_form_post('txa_xmt_widget_custom_text_footer')
					)
				),
				'tweet' => array(
					'username' => xhanch_my_twitter_form_post('txt_xmt_tweet_username'),
					'password' => xhanch_my_twitter_form_post('pwd_xmt_tweet_password'),
					'order' => xhanch_my_twitter_form_post('cbo_xmt_tweet_order'),	
					'count' => xhanch_my_twitter_form_post('int_xmt_tweet_count'),
					'include' => array(
						'public_replies' => xhanch_my_twitter_form_post('chk_xmt_tweet_include_public_replies'),
						'non_public_replies' => xhanch_my_twitter_form_post('chk_xmt_tweet_include_non_public_replies'),
						'direct_message' => xhanch_my_twitter_form_post('chk_xmt_tweet_include_direct_message')
					),
					'date_format' => xhanch_my_twitter_form_post('cbo_xmt_tweet_date_format'),
					'time_add' => xhanch_my_twitter_form_post('int_xmt_tweet_time_add'),
					'layout' => xhanch_my_twitter_form_post('txa_xmt_tweet_layout'),
					'show_hr' => xhanch_my_twitter_form_post('chk_xmt_tweet_show_hr'),
					'make_clickable' => array(
						'user_tag' => xhanch_my_twitter_form_post('chk_xmt_tweet_make_clickable_user_tag'),
						'hash_tag' => xhanch_my_twitter_form_post('chk_xmt_tweet_make_clickable_hash_tag'),
						'url' => xhanch_my_twitter_form_post('chk_xmt_tweet_make_clickable_url')
					),
					'avatar' => array(
						'show' => xhanch_my_twitter_form_post('chk_xmt_tweet_avatar_show'),
						'size' => array(
							'w' => xhanch_my_twitter_form_post('int_xmt_tweet_avatar_size_w'),
							'h' => xhanch_my_twitter_form_post('int_xmt_tweet_avatar_size_h')
						)
					),
					'cache' => array(
						'enable' => xhanch_my_twitter_form_post('chk_xmt_tweet_cache_enable'),
						'expiry' => xhanch_my_twitter_form_post('int_xmt_tweet_cache_expire'),
						'tweet_cache' => array(
							'date' => 0,
							'data' => array()
						),
						'profile_cache' => array(
							'date' => 0,
							'data' => array()
						)								
					)
				),
				'display_mode' => array(
					'default' => array(
						'enable' => (xhanch_my_twitter_form_post('cbo_xmt_display_mode') == 'default')?1:0
					),
					'scrolling' => array(
						'enable' => (xhanch_my_twitter_form_post('cbo_xmt_display_mode') == 'scrolling')?1:0,
						'height' => xhanch_my_twitter_form_post('int_xmt_display_mode_scrolling_height'),
						'animate' => array(
							'enable' => xhanch_my_twitter_form_post('chk_xmt_display_mode_scrolling_animate_enable'),
							'amount' => xhanch_my_twitter_form_post('int_xmt_display_mode_scrolling_animate_amount'),
							'delay' => xhanch_my_twitter_form_post('int_xmt_display_mode_scrolling_animate_delay')
						),
					)
				),
				'other' => array(
					'open_link_on_new_window' => xhanch_my_twitter_form_post('chk_xmt_other_open_link_on_new_window'),
					'show_credit' => xhanch_my_twitter_form_post('chk_xmt_other_show_credit')
				),
			);
			
			$xmt_accounts[$sel_account] = $xmt_config;
			update_option('xmt_accounts', $xmt_accounts);	
			echo '<div id="message" class="updated fade"><p>Configuration Updated</p></div>';
		}
				
		ksort($xmt_accounts);		
?>
		<style type="text/css">
			table, td{font-family:Arial;font-size:12px}
			tr{height:22px}
			ul li{line-height:2px}			
		</style>
		<script type="text/javascript">
			function show_spoiler(obj){
				var inner = obj.parentNode.getElementsByTagName("div")[0];
				if (inner.style.display == "none")
					inner.style.display = "";
				else
					inner.style.display = "none";
			}
    	</script>
		<div class="wrap">
			<h2>Xhanch - My Twitter - Configuration</h2>			
			<br/>
			<form action="" method="post">
				<?php if(count($xmt_accounts) == 0){ ?>
					You have not created any profile yet.<br/><br/>
				<?php } ?>
				
				<b><big>Add Profile</big></b><br/>
				<br/>	
				Fill the following form to create a new profile
				<br/><br/>
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td width="150px">Name</td>
						<td><input type="text" id="txt_xmt_account_name" name="txt_xmt_account_name" value="" style="width:200px"/></td>
					</tr>
				</table>
				<i><small>Note: Profile name must only contain alphanumeric characters (A to Z and 0 to 9)</small></i><br/>
				<i><small>Each profile will create a new widget to be placed to your sidebar/post/template code</small></i><br/>
				<p class="submit"><input type="submit" name="cmd_xmt_create_profile" value="Create Profile"/></p>
			</form>
			<br/>
			<?php if(count($xmt_accounts) > 0){ ?>	
				<b><big>Profile Configuration</big></b><br/>
				<br/>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="150px">Profile</td>
						<td>
							<select name="cbo_xmt_account_name" onchange="location.href='admin.php?page=xhanch-my-twitter&profile=' + this.value" style="width:200px">
								<option value="">- Choose a profile -</option>
								<?php foreach($xmt_accounts as $acc=>$val){ ?>
									<option value="<?php echo urlencode($acc); ?>" <?php echo ($acc==$sel_account)?'selected="selected"':''; ?>><?php echo ucwords(htmlspecialchars($acc)); ?></option>									
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>					
			<?php } ?>
					
			<?php if(array_key_exists($sel_account, $xmt_accounts)){ ?>		
				<form action="" method="post">
					<?php $set = $xmt_accounts[$sel_account]; ?>				
					<i><small>Note: <a href="#guide">Click here for a complete explaination about these configurations' fields</a></small></i><br/>
					<br/>				
					<b>Widget Setting</b><br/>
					<br/>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td width="150px">Title</td>
							<td width="200px"><input type="text" id="txt_xmt_widget_title" name="txt_xmt_widget_title" value="<?php echo htmlspecialchars($set['widget']['title']); ?>" style="width:100%"/></td>
							<td width="10px"></td>
							<td width="150px">Name</td>
							<td width="200px"><input type="text" id="txt_xmt_widget_name" name="txt_xmt_widget_name" value="<?php echo htmlspecialchars($set['widget']['name']); ?>" style="width:100%"/></td>
						</tr>
						<tr>
							<td>Header style</td>
							<td>
								<select id="cbo_xmt_widget_header_style" name="cbo_xmt_widget_header_style" style="width:100%">
									<?php foreach($arr_header_style as $key=>$row){ ?>
										<option value="<?php echo $key; ?>" <?php echo ($key==htmlspecialchars($set['widget']['header_style']))?'selected="selected"':''; ?>><?php echo $row; ?></option>
									<?php } ?>
								</select>
							</td>
							<td></td>
							<td>Turn title to link?</td>
							<td><input type="checkbox" id="chk_xmt_widget_link_title" name="chk_xmt_widget_link_title" value="1" <?php echo ($set['widget']['link_title']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td colspan="5">
								Header text
								<textarea id="txa_xmt_widget_custom_text_header" name="txa_xmt_widget_custom_text_header" style="width:100%;height:40px"><?php echo htmlspecialchars($set['widget']['custom_text']['header']); ?></textarea>
								<br/>
				
								Footer text
								<textarea id="txa_xmt_widget_custom_text_footer" name="txa_xmt_widget_custom_text_footer" style="width:100%;height:40px"><?php echo htmlspecialchars($set['widget']['custom_text']['footer']); ?></textarea>
								<br/>
				
								<small><i>Available variables for footer and header text</i></small>
								<ul>
									<li><small><b>@avatar</b>: display URL of your Twitter avatar</small></li>
									<li><small><b>@name</b>: display your full name on Twitter</small></li>
									<li><small><b>@screen_name</b>: display your screen name on Twitter</small></li>
									<li><small><b>@followers_count</b>: display a number of your followers</small></li>
									<li><small><b>@statuses_count</b>: display a number of your total statuses/tweets</small></li>
									<li><small><b>@favourites_count</b>: display a number of your favourites</small></li>
									<li><small><b>@friends_count</b>: display a number of your friends</small></li>
								</ul>
							</td>
						</tr>
					</table><br/>
					
					<b>Tweet Settings</b><br/>
					<br/>
					<small><i>Note: password is not required. Fill in your password will allow you to show non-public tweet replies and direct messages.</i></small>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td width="150px">Username</td>
							<td width="200px"><input type="text" id="txt_xmt_tweet_username" name="txt_xmt_tweet_username" value="<?php echo htmlspecialchars($set['tweet']['username']); ?>" style="width:100%"/></td>
							<td width="10px"></td>
							<td width="150px">Password</td>
							<td width="200px"><input type="password" id="pwd_xmt_tweet_password" name="pwd_xmt_tweet_password" value="<?php echo htmlspecialchars($set['tweet']['password']); ?>" style="width:100%"/></td>
						</tr>
						<tr>
							<td>Tweet order</td>
							<td>
								<select id="cbo_xmt_tweet_order" name="cbo_xmt_tweet_order" style="width:100%">
									<?php foreach($arr_tweet_order as $key=>$row){ ?>
										<option value="<?php echo $key; ?>" <?php echo ($key==htmlspecialchars($set['tweet']['order']))?'selected="selected"':''; ?>><?php echo $row; ?></option>
									<?php } ?>
								</select>
							</td>
							<td></td>
							<td># Latest tweets</td>
							<td><input type="text" id="int_xmt_tweet_count" name="int_xmt_tweet_count" value="<?php echo htmlspecialchars($set['tweet']['count']); ?>" size="5"  maxlength="3"/></td>
						</tr>
						<tr>
							<td>Inc. public replies?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_include_public_replies" name="chk_xmt_tweet_include_public_replies" value="1" <?php echo ($set['tweet']['include']['public_replies']?'checked="checked"':''); ?>/></td>
							<td></td>
							<td>Inc. replies?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_include_non_public_replies" name="chk_xmt_tweet_include_non_public_replies" value="1" <?php echo ($set['tweet']['include']['non_public_replies']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td>Inc. direct messages?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_include_direct_message" name="chk_xmt_tweet_include_direct_message" value="1" <?php echo ($set['tweet']['include']['direct_message']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td>Date format</td>
							<td>
								<select id="cbo_xmt_tweet_date_format" name="cbo_xmt_tweet_date_format" style="width:100%">
									<?php foreach($arr_date_format as $fmt_val=>$fmt_ex){ ?>
										<option value="<?php echo $fmt_val; ?>" <?php echo ($fmt_val==htmlspecialchars($set['tweet']['date_format']))?'selected="selected"':''; ?>><?php echo $fmt_ex; ?></option>
									<?php } ?>
								</select>
							</td>
							<td></td>
							<td>GMT add (in minutes)</td>
							<td><input type="text" id="int_xmt_tweet_time_add" name="int_xmt_tweet_time_add" value="<?php echo intval($set['tweet']['time_add']); ?>" size="5"  maxlength="4"/></td>
						</tr>
						<tr>
							<td>Tweet layout</td>
							<td colspan="4"><input type="text" id="txa_xmt_tweet_layout" name="txa_xmt_tweet_layout" style="width:100%" value="<?php echo htmlspecialchars($set['tweet']['layout']); ?>" />
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<small><i>Available variables for tweet layout</i></small>
								<ul>
									<li><small><b>@name</b>: display the username who posts the tweet (Link Mode)</small></li>
									<li><small><b>@name_plain</b>: display the username who posts the tweet</small></li>
									<li><small><b>@tweet</b>: content of the tweet</small></li>
									<li><small><b>@date</b>: formatted publish date time of a tweet</small></li>
									<li><small><b>@source</b>: display how/where the tweet is posted</small></li>
									<li><small><b>@reply_url</b>: URL to reply a status</small></li>
									<li><small><b>@reply_link</b>: Link to reply a status</small></li>
									<li><small><b>@retweet_url</b>: URL to retweet a status</small></li>
									<li><small><b>@retweet_link</b>: Link to retweet a status</small></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>Clickable URL?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_make_clickable_url" name="chk_xmt_tweet_make_clickable_url" value="1" <?php echo ($set['tweet']['make_clickable']['url']?'checked="checked"':''); ?>/></td>
							<td></td>
							<td>Show divider line?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_show_hr" name="chk_xmt_tweet_show_hr" value="1" <?php echo ($set['tweet']['show_hr']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td>Clickable user tag?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_make_clickable_user_tag" name="chk_xmt_tweet_make_clickable_user_tag" value="1" <?php echo ($set['tweet']['make_clickable']['user_tag']?'checked="checked"':''); ?>/></td>
							<td></td>
							<td>Clickable hash tag?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_make_clickable_hash_tag" name="chk_xmt_tweet_make_clickable_hash_tag" value="1" <?php echo ($set['tweet']['make_clickable']['hash_tag']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td>Show avatar?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_avatar_show" name="chk_xmt_tweet_avatar_show" value="1" <?php echo ($set['tweet']['avatar']['show']?'checked="checked"':''); ?>/></td>
							<td></td>
							<td>Avatar size</td>
							<td>
								W: <input type="text" id="int_xmt_tweet_avatar_size_w" name="int_xmt_tweet_avatar_size_w" value="<?php echo $set['tweet']['avatar']['size']['w']; ?>" size="5"  maxlength="3"/> px; 
								H:	<input type="text" id="int_xmt_tweet_avatar_size_h" name="int_xmt_tweet_avatar_size_h" value="<?php echo $set['tweet']['avatar']['size']['h']; ?>" size="5"  maxlength="3"/> px
							</td>
						</tr>			
						<tr>
							<td>Enable Cache?</td>
							<td><input type="checkbox" id="chk_xmt_tweet_cache_enable" name="chk_xmt_tweet_cache_enable" value="1" <?php echo ($set['tweet']['cache']['enable']?'checked="checked"':''); ?>/></td>
							<td></td>
							<td>Cache Expiry (in minutes)</td>
							<td><input type="text" id="int_xmt_tweet_cache_expire" name="int_xmt_tweet_cache_expire" value="<?php echo $set['tweet']['cache']['expiry']; ?>" size="5"  maxlength="3"/></td>
						</tr>			
					</table>
					<br/>
	
					<b>Display Mode</b><br/>					
					<br/>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td width="150px">Selected mode</td>
							<td width="200px">	
								<select id="cbo_xmt_display_mode" name="cbo_xmt_display_mode" style="width:100%">															
								<?php foreach($set['display_mode'] as $key=>$val){ ?>
									<option value="<?php echo $key; ?>" <?php echo ($val['enable'])?'selected="selected"':''; ?>><?php echo ucwords($key); ?></option>									
								<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="5"><br/><i>Scrolling option (only applied when selected mode is scrolling)</i><br/>&nbsp;</td>
						</tr>
						<tr>
							<td width="150px">Area Height</td>
							<td width="200px"><input type="text" id="int_xmt_display_mode_scrolling_height" name="int_xmt_display_mode_scrolling_height" value="<?php echo $set['display_mode']['scrolling']['height']; ?>" size="5"  maxlength="5"/> px</td>
							<td width="10px"></td>
							<td width="150px">Animate Scrolling?</td>
							<td width="200px"><input type="checkbox" id="chk_xmt_display_mode_scrolling_animate_enable" name="chk_xmt_display_mode_scrolling_animate_enable" value="1" <?php echo ($set['display_mode']['scrolling']['animate']['enable']?'checked="checked"':''); ?>/></td>
						</tr>
						<tr>
							<td>Scroll Amount</td>
							<td><input type="text" id="int_xmt_display_mode_scrolling_animate_amount" name="int_xmt_display_mode_scrolling_animate_amount" value="<?php echo $set['display_mode']['scrolling']['animate']['amount']; ?>" size="5"  maxlength="5"/> px</td>
							<td width="10px"></td>
							<td>Scroll Delay</td>
							<td><input type="text" id="int_xmt_display_mode_scrolling_animate_delay" name="int_xmt_display_mode_scrolling_animate_delay" value="<?php echo $set['display_mode']['scrolling']['animate']['delay']; ?>" size="5"  maxlength="5"/> ms</td>
						</tr>
					</table>
					<br/>
										
					<b>Other Settings</b><br/>
					<br/>
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td width="150px">Open link on new tab?</td>
							<td width="200px"><input type="checkbox" id="chk_xmt_other_open_link_on_new_window" name="chk_xmt_other_open_link_on_new_window" value="1" <?php echo ($set['other']['open_link_on_new_window']?'checked="checked"':''); ?>/></td>
							<td width="10px"></td>
							<td width="150px">Show credit?</td>
							<td width="200px"><input type="checkbox" id="chk_xmt_other_show_credit" name="chk_xmt_other_show_credit" value="1" <?php echo ($set['other']['show_credit']?'checked="checked"':''); ?>/></td>
						</tr>
					</table><br/>
					
					<p class="submit">
						<input type="submit" name="cmd_xmt_update_profile" value="Update Profile"/>
						<input type="submit" name="cmd_xmt_delete_profile" value="Delete Profile"/>
					</p>
				</form>
			<?php } ?>		
				
			<br/><br/>
			<a name="guide"></a>
			<b><big>Support This Plugin Development</big></b><br/>		
			<br/>	
			Do you like this plugin? Do you think this plugin very helpful?<br/>
			Why don't you support this plugin developement by donating any amount you are willing to give?<br/>
			<br/>
			If you wish to support the developer and make a donation, please click the following button. Thanks!<br/>
			<a href="http://xhanch.com/xhanch-my-twitter-donate" target="_blank"><img src="http://xhanch.com/image/paypal/btn_donate.gif" alt="Donate"></a></p>

			<br/><br/>
			<a name="guide"></a>
			<b><big>Complete Info and Share Room</big></b><br/>		
			<br/>	
			<div class="spoiler">
				<input type="button" onclick="show_spoiler(this);" value="Complete information regarding Xhanch - My Twitter (Share Room)"/>
				<div class="inner" style="display:none;">
					<br/>
					<iframe src="http://xhanch.com/wp-plugin-my-twitter/" style="width:700px;height:500px"></iframe>
				</div>
			</div>			
			<br/>			
			<br/>
		</div>
<?php
	}
?>