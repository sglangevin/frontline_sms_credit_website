<?php
(defined( '_VALID_MOS' ) or defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );


$mainframe	=& JFactory::getApplication();
$mainframe->registerEvent('onPrepareContent','mb_videobot');	

function mb_videobot($published, & $row, & $params, $page=0 ){
	
	if(func_num_args() <= 3){
		$row	=&$published;
	}

	// Use PREG_SET_ORDER so that we would be able to get the matches by
	// an array of [0] match 1 [1] match 2 and so on.
	preg_match_all('/\[video:(.*?)]/i', $row->text, $matches,PREG_SET_ORDER);
	
	#If no video is found, just exit this function, no further processing needed
	if(!is_array($matches) || empty($matches)){
	    return;
	}

	$db		=& JFactory::getDBO();
	
	// Get params
	$plugin	= '#__plugins';
	 
	$strSQL	= "SELECT `params` FROM {$plugin} "
			. "WHERE `element`='azvideobot' "
			. "AND `folder`='content'";

	$db->setQuery( $strSQL );
	$param	= $db->loadObjectList();
	
	$params	= new JParameter($param[0]->params);

	foreach($matches as $match)
	{
		#$match[0] = entire tag e.g [video:http://website.com/?param=param]
	    #$match[1] = real url e.g http://website.com/?param=param
	    $url    =   trim($match[1]);
		
		#Check if there is any width or height set by checking the url
		#if it contains a space
		if(eregi(' ', $url)){
		    #Get width and height from the $url by splitting widthxheight
			$data   = explode(' ',$url);

			if(eregi('x', $data[1])){
			    #Set $url so that the widthxheight will be removed
			    $url    = $data[0];
			    $data   = explode('x',$data[1]);

			    #Set the width from the exploded array
				$width  = $data[0];
				
				#Set the height from the exploded array
				$height = $data[1];
			}
			else{
			    # width:height Not properly inputted use default width:height
			    $width  = $params->get('width');
			    $height = $params->get('height');
			}
		}else{
			$width	= $params->get('width');
			$height	= $params->get('height');
		}
		
		#Get the video type
	    $type   = mb_videobot_type($url);

	    #Call the respective video functions to get the embedded data
	    
	    // Check if type exists, otherwise display invalid video type.
	    if(function_exists('mb_videobot_' . $type)){
	        $embed		= call_user_func_array('mb_videobot_' . $type, array($width, $height,$url));
			#Replace the tags with the correct returned embedded tags.
			$row->text	= str_replace($match[0], $embed, $row->text);
		}else{
		    $row->text  = str_replace($match[0], '[Invalid video specified]', $row->text);
		}
	}
	return true;
}

/**
 * Return the video type based on the url given.
 * Return video name
 */
function mb_videobot_type($url){

	if(eregi('youtube',$url)){
        return 'youtube';
	}else if(eregi('google',$url)){
	    return 'google';
	}else if(eregi('vimeo',$url)){
	    return 'vimeo';
	}else if(eregi('metacafe',$url)){
	    return 'metacafe';
	}else if(eregi('jumpcut',$url)){
	    return 'jumpcut';
	}else if(eregi('vidiac',$url)){
	    return 'vidiac';
	}else if(eregi('streetfire',$url)){
	    return 'streetfire';
	}else if(eregi('stickam',$url)){
	    return 'stickam';
	}else{
		// Return the video type specified
        return $url;
	}
	
}

function mb_videobot_youtube($width, $height,$url){
    #Need to split all unwanted query strings.
    $video  	= explode('&',$url);

	$video      = explode('=',$video[0]);
	$video      = $video[1];

	$replace = '<object class="embed" width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" data="http://www.youtube.com/v/'.$video.'"><param name="movie" value="http://www.youtube.com/v/'.$video.'" /><param name="wmode" value="transparent"><em>You need to a flashplayer enabled browser to view this video</em></object>';

	return $replace;
}

function mb_videobot_vimeo($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('vimeo.com/',$url);

	$video      = $video[1];

	$replace = '<object type="application/x-shockwave-flash" width="' . $width . '" height="' . $height . '" data="http://vimeo.com/moogaloop.swf?clip_id=' . $video . '&server=vimeo.com&fullscreen=1&show_title=1&show_byline=1&show_portrait=0&color=01AAEA"><param name="quality" value="best" /><param name="allowfullscreen" value="true" /><param name="scale" value="showAll" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=' . $video . '&server=vimeo.com&fullscreen=1&show_title=1&show_byline=1&show_portrait=0&color=01AAEA" /></object>';
	return $replace;
}

function mb_videobot_metacafe($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('metacafe.com/watch/',$url);

	#$video[1] is now id/filename/
	$video      = $video[1];
	
	#Need to check if the ending url contains trailing slash. If it contains
	#a trailing slash, will need to remove it.
	$video      = $video{strlen($video) - 1} == '/' ? substr($video,0,strlen($video) - 2) : $video;


	$replace = '<embed src="http://www.metacafe.com/fplayer/' . $video . '.swf" width="' . $width . '" height="' . $height . '" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
	return $replace;
}

/*
 * Function: mb_videobot_google
 * Returns: embedded html codes for google videos
 * Params: $width - width of video, $height - height of video, $url of video
 */
function mb_videobot_google($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('google.com/videoplay?docid=',$url);
	$video      = $video[1];

	$replace = '<embed style="width:' . $width . 'px; height:' . $height .'px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId=' . $video . '&hl=en" flashvars=""></embed>';
	return $replace;
}

/*
 * Function: mb_videobot_jumpcut
 * Returns: embedded html codes for jumpcut videos
 * Params: $width - width of video, $height - height of video, $url of video
 */
function mb_videobot_jumpcut($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('jumpcut.com/view?id=',$url);
	$video      = $video[1];

	$replace = '<embed src="http://www.jumpcut.com/media/flash/jump.swf?id=' . $video . '&asset_type=movie&asset_id=' . $video . '&eb=1" width="' . $width . '" height="' . $height . '" type="application/x-shockwave-flash"></embed>';
	return $replace;
}

/*
 * Function: mb_videobot_vidiac
 * Returns: embedded html codes for vidiac videos
 * Params: $width - width of video, $height - height of video, $url of video
 */
function mb_videobot_vidiac($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('vidiac.com/video/',$url);
    
    $video      = explode('.htm',$video[1]);

	$video      = $video[0];

	$replace = '<embed src="http://www.vidiac.com/vidiac.swf" FlashVars="video=' . $video . '" quality="high" bgcolor="#ffffff" width="' . $width . '" height="' . $height .'" name="ePlayer" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
	return $replace;
}

/*
 * Function: mb_videobot_streetfire
 * Returns: embedded html codes for streetfire videos
 * Params: $width - width of video, $height - height of video, $url of video
 */
function mb_videobot_streetfire($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('streetfire.net/video/',$url);

    $video      = explode('.htm',$video[1]);

	$video      = $video[0];

	$replace = '<embed src="http://videos.streetfire.net/vidiac.swf" FlashVars="video=' . $video . '" quality="high" bgcolor="#ffffff" width="'. $width .'" height="' . $height .'" name="ePlayer" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>';
	return $replace;
}

/*
 * Function: mb_videobot_stickam
 * Returns: embedded html codes for stickam videos
 * Params: $width - width of video, $height - height of video, $url of video
 */
function mb_videobot_stickam($width, $height ,$url){

    #Need to split all unwanted query strings.
    $video  	= explode('stickam.com/editMediaComment.do?method=load&mId=',$url);

	$video      = $video[1];

	$replace = '<embed src="http://player.stickam.com/flashVarMediaPlayer/' . $video . '" type="application/x-shockwave-flash" scale="noscale" allowFullScreen="true" width="'. $width .'" height="' . $height . '" allowScriptAccess="always"></embed>';
	return $replace;
}

?>
