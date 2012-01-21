<?php
	/*
		Plugin Name: Xhanch - My Twitter
		Plugin URI: http://xhanch.com/wp-plugin-my-twitter/
		Description: Twitter plugin for wordpress
		Author: Susanto BSc (Xhanch Studio)
		Author URI: http://xhanch.com
		Version: 1.9.2
	*/
	
	define('xhanch_my_twitter', true);
	global $xhanch_my_twitter_timed;
	global $xmt_accounts;
	global $xmt_default;
		
	$xmt_default = array(
		'widget' => array(
			'title' => 'Latest Tweets',
			'name' => '',
			'link_title' => 0,
			'header_style' => 'default',
			'custom_text' => array(
				'header' => '',
				'footer' => ''
			)
		),
		'tweet' => array(
			'username' => '',
			'password' => '',
			'order' => 'lto',	
			'count' => '5',
			'time_add' => '0',
			'date_format' => 'd/m/Y H:i:s',
			'layout' => '@tweet - posted on @date',
			'show_hr' => 0,
			'make_clickable' => array(
				'user_tag' => 1,
				'hash_tag' => 1,
				'url' => 1
			),
			'avatar' => array(
				'show' => 1,
				'size' => array(
					'w' => 0,
					'h' => 0
				)
			),
			'include' => array(
				'public_replies' => 1,
				'non_public_replies' => 0,
				'direct_message' => 0
			),
			'cache' => array(
				'enable' => 1,
				'expiry' => 60,
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
				'enable' => 1
			),
			'scrolling' => array(
				'enable' => 0,
				'height' => 200,
				'animate' => array(
					'enable' => 0,
					'amount' => 1,
					'delay' => 50
				),
			)
		),
		'other' => array(
			'open_link_on_new_window' => 1,
			'show_credit' => 1
		),
	);
		
	$xmt_accounts = get_option('xmt_accounts');
	if($xmt_accounts === false){
		$xmt_accounts = array();
	}
	
	foreach($xmt_accounts as $acc=>$acc_set){
		$php_wid_function = '
			function widget_xhanch_my_twitter_'.$acc.'($args){
				widget_xhanch_my_twitter($args, \''.$acc.'\');
			}
			function widget_xhanch_my_twitter_control_'.$acc.'(){
				widget_xhanch_my_twitter_control(\''.$acc.'\');
			}
		';
		eval($php_wid_function);
	}

	function xhanch_my_twitter_install () {
		require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__,'xhanch_my_twitter_install');

	require_once(dirname(__FILE__).'/xhanch_my_twitter.function.php');	
	require_once(dirname(__FILE__).'/xhanch_my_twitter_header_style.php');	
	
	function xhanch_my_twitter_css_cst($profile){
		global $xmt_accounts;
		$cfg = $xmt_accounts[$profile];
						
		$avatar_width = intval($cfg['tweet']['avatar']['size']['w']);
		$avatar_height = intval($cfg['tweet']['avatar']['size']['h']);
		$show_avatar = intval($cfg['tweet']['avatar']['show']);
				
		if($avatar_width && $avatar_height){
			$css .= '#xmt_'.$profile.'_wid.xmt .tweet_avatar{width:'.$avatar_width.'px;height:'.$avatar_height.'px} ';
			if($show_avatar)
				$css .= '#xmt_'.$profile.'_wid.xmt ul li.tweet_list{min-height:'.($avatar_height+7).'px} ';
		}else{
			if($show_avatar)
				$css .= '#xmt_'.$profile.'_wid.xmt ul li.tweet_list{min-height:57px} ';
		}
		
		if($css)
			echo '<style type="text/css">/*<![CDATA[*/ '.$css.' /*]]>*/</style>';	
	}
	
	function xhanch_my_twitter_css(){	
		global $xmt_accounts;
		
		$profiles = array_keys($xmt_accounts);
		echo '<link rel="stylesheet" href="'.xhanch_my_twitter_get_dir('url').'/css.php?profile='.implode(',', $profiles).'" type="text/css" media="screen" />';
		
		foreach($xmt_accounts as $acc=>$acc_set)
			xhanch_my_twitter_css_cst($acc);		
	}
	add_action('wp_print_styles', 'xhanch_my_twitter_css');

	function xhanch_my_twitter($args = array(), $profile){	
		widget_xhanch_my_twitter($args, $profile);
	}

	function xhanch_my_twitter_short_code($atts) {
		extract(shortcode_atts(array(
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
			'profile' => '',
		), $atts));

		$args = array(
			'before_widget' => $before_widget,
			'after_widget' => $after_widget,
			'before_title' => $before_title,
			'after_title' => $after_title,
		);

		xhanch_my_twitter($args, $profile);
	}
	
	if(function_exists('add_shortcode'))
		add_shortcode('xhanch_my_twitter', 'xhanch_my_twitter_short_code');
	
	function widget_xhanch_my_twitter($args, $profile){		
		global $xhanch_my_twitter_timed;
		global $xmt_accounts;
				
		$xhanch_my_twitter_timed = time();
		
		xhanch_my_twitter_log('Starting to generate output');		

		if(!array_key_exists($profile, $xmt_accounts))
			return;
		$cfg = $xmt_accounts[$profile];
		
		extract($args);
				
		$res = xhanch_my_twitter_get_tweets($profile);
		
		$tweet_string = $cfg['tweet']['layout'];
		$show_avatar = intval($cfg['tweet']['avatar']['show']);
		
		$link_on_title = intval($cfg['widget']['link_title']);
		$show_hr = intval($cfg['tweet']['show_hr']);	
		
		$scroll_cfg = $cfg['display_mode']['scrolling'];
		$scroll_mode = intval($scroll_cfg['enable']);
		$scroll_h = intval($scroll_cfg['height']);
        $scroll_ani = intval($scroll_cfg['animate']['enable']);
		$scroll_ani_amount = intval($scroll_cfg['animate']['amount']);
		$scroll_ani_delay = intval($scroll_cfg['animate']['delay']);
		
		$username = $cfg['tweet']['username'];
				
		xhanch_my_twitter_timed('Build Body - Start');
		if(count($res) == 0) 
			return;		
		echo $before_widget;
		if ($cfg['widget']['title'] != ''){
			echo $before_title;
			
			if($link_on_title)
				echo '<a href="http://twitter.com/'.$username.'" target="_blank">';
			echo $cfg['widget']['title'];

			if($link_on_title)
				echo '</a>';
			
			echo $after_title;		
		}

		echo '<div id="xmt_'.$profile.'_wid" class="xmt xmt_'.$profile.'">';
		xhanch_my_twitter_header_style($profile);

		echo xhanch_my_twitter_replace_vars($cfg['widget']['custom_text']['header'], $profile);

		if($scroll_mode){
			if($scroll_ani){
				echo '<div onmouseover="xmt_'.$profile.'_scroll_stop()" onmouseout="xmt_'.$profile.'_scroll()"  style="'.(xhanch_my_twitter_is_ie6()?'':'max-').'height:'.$scroll_h.'px;overflow:hidden"><div id="xmt_'.$profile.'_tweet_area" style="margin-bottom:'.$scroll_h.'px">';
			}else{
				echo '<div style="max-height:'.$scroll_h.'px;overflow:auto">';		
			}
		} 
		echo '<ul class="tweet_area">';
		$tweet_string = convert_smilies(html_entity_decode($tweet_string));
		foreach($res as $sts_id=>$row){			
			echo '<li class="tweet_list">';
				if($show_hr) 
					echo '<hr />';
				
				if($show_avatar){					
					echo '<a href="'.$row['author_url'].'"><img '.$avatar_style.' class="tweet_avatar" src="'.$row['author_img'].'" alt="'.$row['author_name'].'"/></a>';				
				}
				
				$retweet_link = 'http://twitter.com/home?status='.urlencode('RT @'.$row['author'].' '.strip_tags($row['tweet']));
				$reply_link = 'http://twitter.com/home?status='.urlencode('@'.$row['author']).'&in_reply_to_status_id='.$sts_id.'&in_reply_to='.urlencode($row['author']);
				
				$tmp_str = str_replace('@name_plain', $row['author_name'], $tweet_string);
				$tmp_str = str_replace('@name', '<a href="'.$row['author_url'].'">'.$row['author_name'].'</a>', $tmp_str);
				$tmp_str = str_replace('@date', $row['timestamp'], $tmp_str);
				$tmp_str = str_replace('@source', $row['source'], $tmp_str);
				$tmp_str = str_replace('@tweet', $row['tweet'], $tmp_str);
				$tmp_str = str_replace('@reply_url', $reply_link, $tmp_str);
				$tmp_str = str_replace('@reply_link', '<a href="'.$reply_link.'" target="_blank" rel="external nofollow">reply</a>', $tmp_str);
				$tmp_str = str_replace('@retweet_url', $retweet_link, $tmp_str);
				$tmp_str = str_replace('@retweet_link', '<a href="'.$retweet_link.'" target="_blank" rel="external nofollow">retweet</a>', $tmp_str);
				
				echo $tmp_str;
			echo '</li>';
		}
		echo '</ul>';
		if($show_hr) 
			echo '<hr />';
		if($scroll_mode){
			if($scroll_ani){
				echo '</div></div>';							
				echo '
					<script language="javascript" type="text/javascript">
						//<![CDATA[
							var xmt_'.$profile.'_pos = '.$scroll_h.';
							var xmt_'.$profile.'_ti;
							var xmt_'.$profile.'_ta = document.getElementById("xmt_'.$profile.'_tweet_area");
							var xmt_'.$profile.'_ta_limit = xmt_'.$profile.'_ta.offsetHeight * -1;

							function xmt_'.$profile.'_scroll(){
								xmt_'.$profile.'_scroll_stop();
								xmt_'.$profile.'_pos = xmt_'.$profile.'_pos - '.$scroll_ani_amount.';
								if(xmt_'.$profile.'_pos < xmt_'.$profile.'_ta_limit)
									xmt_'.$profile.'_pos = '.$scroll_h.';
								xmt_'.$profile.'_ta.style.marginTop = xmt_'.$profile.'_pos.toString() + "px";
								xmt_'.$profile.'_ti = setTimeout("xmt_'.$profile.'_scroll()", '.$scroll_ani_delay.');
							}
							function xmt_'.$profile.'_scroll_stop(){
								if(xmt_'.$profile.'_ti)
									clearTimeout(xmt_'.$profile.'_ti);
							}
							xmt_'.$profile.'_ta.style.marginTop = xmt_'.$profile.'_pos.toString() + "px";
							xmt_'.$profile.'_scroll();
						//]]>
					</script>
				';
			}else
				echo '</div>';			
		} 
					
		echo xhanch_my_twitter_replace_vars($cfg['widget']['custom_text']['footer'], $profile); 

		if ($cfg['other']['show_credit']){
			echo '<div class="credit"><a href="http://xhanch.com/wp-plugin-my-twitter/" rel="section" title="Xhanch My Twitter - A free WordPress plugin to display your latest tweets from Twitter">My Twitter</a>, <a href="http://xhanch.com/" rel="section" title="Developed by Xhanch Studio">by Xhanch</a></div>';
		}
		echo '</div>';
		echo $after_widget;
		xhanch_my_twitter_timed('Build Body - Finished');
		xhanch_my_twitter_timed('Finished');
	}

	function widget_xhanch_my_twitter_control($id){	
?>
		<a href="admin.php?page=xhanch-my-twitter&profile=<?php echo $id; ?>">Click here to configure this plugin</a>
<?php		
	}

	function widget_xhanch_my_twitter_init(){
		global $xmt_accounts;
		foreach($xmt_accounts as $acc=>$acc_set){
			wp_register_sidebar_widget('xmt_'.$acc, 'Xhanch - My Twitter : '.$acc, 'widget_xhanch_my_twitter_'.$acc);
			register_widget_control('xmt_'.$acc, 'widget_xhanch_my_twitter_control_'.$acc, 300, 200 );
		}
	}
	add_action("plugins_loaded", "widget_xhanch_my_twitter_init");

	if(is_admin()){
		function xhanch_my_twitter_admin_menu() {	
			if(!defined('xhanch_root')){
				add_menu_page(
					'Xhanch', 
					'Xhanch', 
					8, 
					'xhanch', 
					'xhanch_intro',
					'http://xhanch.com/icon-16x16.jpg'
				);
				define('xhanch_root', true);
			}
			add_submenu_page(
				'xhanch', 
				'My Twitter',
				'My Twitter', 
				8, 
				'xhanch-my-twitter', 
				'xhanch_my_twitter_setting'
			);
		}
		require_once(dirname(__FILE__).'/admin/xhanch.php');
		require_once(dirname(__FILE__).'/admin/setting.php');
		add_action('admin_menu', 'xhanch_my_twitter_admin_menu');
	}
?>