<?php
	function xhanch_my_twitter_header_style($profile){		
		global $xmt_accounts;
		
		$cfg = $xmt_accounts[$profile];
		
		xhanch_my_twitter_timed('Build header - Start');

		$header_style = $cfg['widget']['header_style'];
		$username = $cfg['tweet']['username'];
		$name = $cfg['widget']['name'];
		$new_tab_link = intval($cfg['other']['open_link_on_new_window']);

		$twitter_url = 'http://twitter.com/'.$username;
		$img_url = xhanch_my_twitter_get_dir('url').'/img/';

		$part = explode('-', $header_style); 		
		$sty_type = $part[0];
		if(count($part) >=2 )
			$sty_var = $part[1];

		switch($sty_type){
			case '':
				break;
			case 'bird_with_text':
				echo '<div class="header_48"><a href="'.$twitter_url.'" '.($new_tab_link?'target="_blank"':'').'><img src="'.$img_url.'twitter-bird-'.$sty_var.'.png" class="img_left" alt="'.$username.'"/></a><a '.($new_tab_link?'target="_blank"':'').' class="header_48 text_18" href="'.$twitter_url.'">'.$name.'</a></div>';
				break;
			case 'logo_with_text':
				echo '<div class="header_48"><a href="'.$twitter_url.'" '.($new_tab_link?'target="_blank"':'').'><img src="'.$img_url.'twitter-logo-'.$sty_var.'.png" class="img_left" alt="'.$username.'"/></a><a '.($new_tab_link?'target="_blank"':'').' class="header_48 text_18" href="'.$twitter_url.'">'.$name.'</a></div>';
				break;
			case 'avatar':
				$det = xhanch_my_twitter_get_detail($profile); 
				if(!$det['avatar']){
					echo '<div class="header_48"><a href="'.$twitter_url.'" '.($new_tab_link?'target="_blank"':'').'><img src="'.$img_url.'twitter-bird-1.png" class="img_left" alt="'.$username.'"/></a><a '.($new_tab_link?'target="_blank"':'').' class="header_48 text_18" href="'.$twitter_url.'">'.$name.'</a></div>';
				}else{
					echo '<div class="header_48"><a href="'.$twitter_url.'" '.($new_tab_link?'target="_blank"':'').'><img src="'.$det['avatar'].'" class="img_left" alt="'.$username.'"/></a><a '.($new_tab_link?'target="_blank"':'').' class="header_48 text_18" href="'.$twitter_url.'">'.$name.'</a></div>';
				}
				break;
			default:
				echo '<div class="header_48"><a href="'.$twitter_url.'" '.($new_tab_link?'target="_blank"':'').'><img src="'.$img_url.'twitter-bird-1.png" class="img_left" alt="'.$username.'"/></a><a '.($new_tab_link?'target="_blank"':'').' class="header_48 text_18" href="'.$twitter_url.'">'.$name.'</a></div>';
				break;
		}
		xhanch_my_twitter_timed('Build header - Finished');
	}
?>