<?php
/**
 * OpenSEF support My Blog component.
 */

if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

// We should only load this class if we're using Open-SEF
class sef_myblog{
	/**
	 * Convert the given standard url to sef enabled url
	 */	 	
	function create($string) {
		$sefstring = "";
  		$string = str_replace( '&amp;', '&', $string );
  		
		// Category cloud view
		$pattern    = "'&task=categories's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'tags/';
		}

		// Userblogs view
		$pattern = "'task=blogs'";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'bloggers/';
		}

		// Search view
		$pattern    = "'&task=search's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'search/';
		}

		// Blogger view
		$pattern    = "'blogger=(.*?)&'s";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring .= $matches[1] . '/';
		}

		// Default article view
		$pattern    = "'show=((.*)html)'s";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring .= $matches[1];
		}

		// Feed view
		$pattern    = "'task=rss's";
		preg_match($pattern, $string, $matches);
		if($matches){
            if($sefstring)
				$sefstring .= 'feed/';
			else
				$sefstring = 'feed/';
		}
		
		// ajaxupload
		$pattern    = "'&task=ajaxupload's";
		preg_match($pattern, $string, $matches);
		if($matches){
                        if($sefstring)
				$sefstring .= 'ajaxupload/';
                        else
				$sefstring = 'ajaxupload/';
		}

		// Category view
		$pattern    = "'category=(.*?)&'s";
		preg_match($pattern, $string, $matches);
		if($matches){
			$matches[1] = str_replace('+', '-', $matches[1]);
			$sefstring = 'tags/' .$matches[1];
		}
		
		// Delete
		$pattern    = "'task=delete's";
		preg_match($pattern, $string, $matches);
		if($matches){
			// Find the id
			$pattern    = "'[^m]id=(\d+)'";
			preg_match($pattern, $string, $matches);
			
			if($matches){
				$sefstring .= "delete/{$matches[1]}/";
			}
		}
		
		/* url from front-admin */
		
		// Dashboard view
		$pattern    = "'task=adminhome's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'adminhome/';
		}
		
		// Bloggerpref
		$pattern    = "'task=bloggerpref's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'bloggerpref/';
		}
		
		// Bloggerstats
		$pattern    = "'task=bloggerstats's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'bloggerstats/';
		}
		
		// Show comments
		$pattern    = "'task=showcomments's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'showcomments/';
		}
		
		/* Some url from modules */
		
		// Archive view
		$pattern    = "'index.php\?option=com_myblog&archive=(.*)&Itemid's";
		preg_match($pattern, $string, $matches);
		if($matches){
			$sefstring = 'archive/'. $matches[1] . '/';
		}
		
		/* Some pagination code */
		
		// Default one
		$pattern    = "'limit=(\d+)'";
		preg_match($pattern, $string, $matches);
		
		$pattern    = "'limitstart=(\d+)'";
		preg_match($pattern, $string, $matches2);
		
		if($matches && $matches2){
			$sefstring .= "limit/{$matches[1]}-{$matches2[1]}/";
		}
		
		// cmslib based
		$pattern    = "'cpage=(\d+)'";
		preg_match($pattern, $string, $matches);
		
		if($matches){
			$sefstring .= "cpage/{$matches[1]}/";
		}

		if(!empty($sefstring))
        	return $sefstring;
        else
        	return '';
    }
    
    /**
     * Given a sef'ed URL, set up the appropriate $_GET etc.. and return the non
     * sef'ed ulr     
     */	     
    function revert($url_array,$pos){

    	$nonsefstring = '';
    	$urlsize = count($url_array);

    	if($urlsize > 2){
    		
    		// Extract limit
			if(in_array('limit', $url_array)){
				$limitIndex = 0;
				foreach ($url_array as $key=>$value){ 
					if ($value == 'limit'){
						$limitIndex = $key+1;  
					} 
				}
				
				$limitdata = $url_array[$limitIndex];
				$limitdata = split('-', $limitdata);
				list($limit, $limitstart) = $limitdata;
				$_GET['limit'] = intval($limit);
				$_GET['limitstart'] = intval($limitstart);
				
				$_REQUEST['limit'] = intval($limit);
				$_REQUEST['limitstart'] = intval($limitstart);
				
				//$nonsefstring .= "&amp;limit=$limit&amp;limitstart=$limitstart";
				$nonsefstring .= "&amp;dummy=1";
				
				// Need to remove this so that the pagination is transparent to 
				// everyone else
				array_splice($url_array, $limitIndex-1);

				$url_array[] = '/'; // still need this padding
			}
			
			// Extract limit based on cmslib cpage
			if(in_array('cpage', $url_array)){
				$limitIndex = 0;
				foreach ($url_array as $key=>$value){ 
					if ($value == 'cpage'){
						$limitIndex = $key+1;  
					} 
				}
				
				$limitdata = $url_array[$limitIndex];
				$_GET['cpage'] = intval($limitdata);
				$_REQUEST['cpage'] = intval($limitdata);
				
				//$nonsefstring .= "&amp;limit=$limit&amp;limitstart=$limitstart";
				$nonsefstring .= "&amp;cpage=$limitdata";
				
				// Need to remove this so that the pagination is transparent to 
				// everyone else
				array_splice($url_array, $limitIndex-1);
				$url_array[] = '/'; // still need this padding
			}
			

			// Show userblogs
			if($url_array[2] == 'bloggers'){
				$_GET['task'] = 'blogs';
				$nonsefstring .= '&amp;task=blogs';
			}
		else if(!empty($url_array[2]) && $url_array[2] !='feed' && in_array('feed', $url_array)){
			// blogger rss feed
			$_GET['task'] = 'rss';
			$_REQUEST['task'] = 'rss';
			$_GET['blogger'] = $url_array[2];
			$_REQUEST['blogger'] = $url_array[2];
			$nonsefstring .= '&amp;task=rss&blogger=' . $url_array[2];
		}
    		// Show the feed page
    		else if($url_array[2] == 'feed'){
    			$_GET['task'] = 'rss';
    			$nonsefstring .= '&amp;task=rss';
			}
			// Show the search
    		else if($url_array[2] == 'search'){
    			$_GET['task'] = 'search';
    			$nonsefstring .= '&amp;task=search';
			} 
			
			// Show the ajaxupload
    		else if($url_array[2] == 'ajaxupload'){
    			$_GET['task'] = 'ajaxupload';
    			$nonsefstring .= '&amp;task=ajaxupload';
			} 
			
			// Show the category cloud
    		else if($url_array[2] == 'tags' && empty($url_array[3])){
    			$_GET['task'] = 'categories';
    			$nonsefstring .= '&amp;task=categories';
			} 
			// Show the specific tag content
    		else if($url_array[2] == 'tags' 
				&& (isset($url_array[3]) && !empty($url_array[3]))
 				){
 				
 				$url_array[3] = str_replace('-', '+', $url_array[3]);
    			$_GET['category'] = $url_array[3];
    			$_REQUEST['category'] = $url_array[3];
    			// need to set the $_REQUST as well
    			$nonsefstring .= '&amp;category='. $url_array[3];
			}
			// Show the archive list
    		else if($url_array[2] == 'archive' 
				&& (isset($url_array[3]) && !empty($url_array[3]))
 				){
 				
    			$_GET['archive'] = $url_array[3];
    			$_REQUEST['archive'] = $url_array[3];
    			// need to set the $_REQUST as well
    			$nonsefstring .= '&amp;archive='. $url_array[3];
			} 
			// Dashboard
    		else if($url_array[2] == 'adminhome' ){
    			$_GET['task'] = 'adminhome';
    			$_REQUEST['task'] = 'adminhome';
    			$nonsefstring .= '&amp;task=adminhome';
    			
			}			
			// Pref
			else if($url_array[2] == 'bloggerpref' ){
    			$_GET['task'] = 'bloggerpref';
    			$nonsefstring .= '&amp;task=bloggerpref';
			} 			
			// stats
			else if($url_array[2] == 'bloggerstats' ){
    			$_GET['task'] = 'bloggerstats';
    			$nonsefstring .= '&amp;task=bloggerstats';
			}
			// show comments
			else if($url_array[2] == 'showcomments' ){
    			$_GET['task'] = 'showcomments';
    			$nonsefstring .= '&amp;task=showcomments';
			}
			
			// Delete an entry
    		else if($url_array[2] == 'delete' && !empty($url_array[3])){
    			$_GET['task'] = 'delete';
    			$_GET['id'] = $url_array[3];
    			
    			$_REQUEST['task'] = 'delete';
    			$_REQUEST['id'] = $url_array[3];
    			
    			$nonsefstring .= '&amp;task=delete&amp;id='. $url_array[3];
			}
			// Blogger view with entries
			else if(!empty($url_array[2]) && !empty( $url_array[3])){
				$_GET['blogger']	= $url_array[2];
				$_REQUEST['blogger']	= $url_array[2];
	
				$_GET['show']		= $url_array[3];
				$_REQUEST['show']	= $url_array[3];
				$nonsefstring .= '&amp;blogger=' . $url_array[2] . '&amp;show=' . $url_array[3];
	
			}
			// Blogger view
			// Only after all else fails, we can assume that the 2nd part of
			// the url is the blogger's name
    		else if(!empty($url_array[2] ) && count($url_array) == 4){
    			$_GET['blogger'] = $url_array[2];
    			$_REQUEST['blogger'] = $url_array[2];
    			$nonsefstring .= '&amp;blogger='. $url_array[2];
			}
			
			
			
			// Article view
    		if(strlen($url_array[2]) > 5 && substr($url_array[2], -5) == '.html'){
    			$_GET['show'] = $url_array[2];
    			$nonsefstring .= '&amp;show=' . $url_array[2];
			}

    	}
    	//print_r($url_array);
	//var_dump($url_array[2]);
    	//echo $nonsefstring; exit;
    	 
    	return $nonsefstring;
    }
    
    
}
