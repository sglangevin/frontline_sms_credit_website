<?php
/*
Plugin Name: Improved Include Page
Version: 0.4.7
Plugin URI: http://www.vtardia.com/improved-include-page/
Author: Vito Tardia
Author URI: http://www.vtardia.com
Description: This plugin is an improved version on the Include Page plugin by Brent Loertscher (http://beetle.cbtlsl.com/categories/include_page). It adds an iinclude_page() function that allows you to include the contents of a static page in a template with several options. It also adds a shortcode allowing you to include the same page into a post or static page.

Version Notes 0.4.7
 - On WP 2.5 or greater allows custom inclusion by post type and status using parameters 'allowType' and 'allowStatus'.
 - Bug fix: in shortcode fixed a bug that could crash PHP when including recursive page/posts

Version Notes 0.4.6
 - Bug fix: includes only published static pages (not posts)

Version Notes 0.4.5
 - Page ID can be a valid page path (WP 2.1 or higher required)

Version Notes 0.4.4
 - Added parameter $return (default = false) to iinclude_page()
 - Added support for WP 2.5.x shortcode API

Version Notes 0.4.3
 - Code partially rewritten and optimized

Version Notes 0.4.2
 - Fixed a bug that trigger an error when used with some content filter: the $page global variable
   is backed up and then restored before returning.

Version Notes 0.4.1
 - This version contains a bug fix by Jesse Plank (http://www.funroe.net/): 
   resolves a compatibility problem with the plugin EventCalendar.

Installation:

1.  Download the file 
2.  Rename the file to iinclude_page.php and put it in your wp-content/plugins/
    directory.
3.  Activate the plugin from your WordPress admin 'Plugins' page.
4.  Make use of the function in your template.

function iinclude_page ( int $post_id, [string params]) - include page with corresponding post_id

Parameters:

  displayTitle (boolean) - toggle title display
  titleBefore/after (string) - string to display before and after the title
  displayStyle (integer constant) - one of the following:
    DT_TEASER_MORE - Teaser with 'more' link (default)
    DT_TEASER_ONLY - Teaser only, without 'more' link
    DT_FULL_CONTENT - Full content including teaser
    DT_FULL_CONTENT_NOTEASER - Full content without teaser
  allowStatus (string) - comma separated list of allowed statuses (default = publish)
  allowType   (string) - comma separated list of allowed post types (default = page)
  more (string) - text to display for the 'more' link

Note:

  In order to avoid parse errors you should call the function in the followind way:
  
    if(function_exists('iinclude_page')) iinclude_page($post_id, [params]);
    
  NOTE: This plugin was modified by Jess Planck ( http://www.funroe.net/ ) to use the "post_name" and to clear and reassign the $post array when used on pages that have a "Loop"
  
*/

/*
Copyright (c) 2005, Vito Tardia
Released under the GPL license
All rights reserved.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT
NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL
THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

define("DT_TEASER_MORE",0);             //Teaser with more link (default)
define("DT_TEASER_ONLY",1);             //Teaser only without more link
define("DT_FULL_CONTENT",2);            //Full content with teaser
define("DT_FULL_CONTENT_NOTEASER",3);   //Full content without teaser

/**
 * Displays or return the content of a static page
 * 
 * @param  int $post_id      The page ID to include
 * @param  int $params       An array of additional paramenters
 * @param  boolean $return   Tells wether return or display the content
 */
function iinclude_page ($post_id, $params = null, $return = false) {
	global $wpdb, $post, $page;
   
	$tempPost = $post;
	$tempPage = $page;
	$post = array();
	
	$out = '';

	//Parsing custom parameters string
	if (isset($params)) parse_str($params);

	//Loading default parameters
	if (!isset($displayTitle)) $displayTitle = false;
	if (!isset($titleBefore)) $titleBefore = '<h2>';
	if (!isset($titleAfter)) $titleAfter = '</h2>';

	if (!isset($displayStyle)) {
		$displayStyle = DT_TEASER_MORE;
	} else {
		$displayStyle = constant($displayStyle);
	} // end if
	
	if (!isset($allowStatus)) {
		$status = array('publish');
	} else {
		$status = explode(',',$allowStatus);
		if (!is_array($status)) $status = array('publish');
	} // end if

	if (!isset($allowType)) {
		$type = array('page');
	} else {
		$type = explode(',',$allowType);
		if (!is_array($type)) $type = array('page');
	} // end if

	if (!isset($more)) $more = 'Read on &raquo;';
	
	if ($page = IIP::get_page($post_id, $type, $status)) {
		//echo "<pre>"; print_r($page); echo "</pre>";

		if ($displayTitle) {
			$title = $page->post_title;

			//Apply filters for Polyglot
			$title = apply_filters('the_title', $title);

			$out .= stripslashes($titleBefore) . $title . stripslashes($titleAfter) . "\n";
		} // end if

		//Get the content an process it before display
		$content = $page->post_content;
		$content = IIP::get_the_content($page,__($more),0,'',$displayStyle);

		// Uncomment the following line if you are using EventCalendar plugin
		//remove_filter('the_content',  'ec3_filter_the_content', 20);

		//Apply filters for Polyglot
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$out .= $content;

		// Uncomment the following line below if you are using EventCalendar plugin
		// add_filter('the_content',  'ec3_filter_the_content', 20);

	} // end if
	
	$post = $tempPost;  
	$page = $tempPage;
	
	if ($return === true) {
		return $out;
	} //end if
	
	echo $out;

} // end function

/**
 * Support util class for IIP
 */
class IIP {
	
	/**
	 * Fetch a page object from an ID or a page path
	 * 
	 * The path function is available since WP 2.1.
	 * The type switch in available since WP 2.5
	 */
	function get_page($post_id, $type, $status) {
		
		if (is_numeric($post_id)) {
			$_page = get_page($post_id);
		} // end if

		if( is_string($post_id) && function_exists('get_page_by_path')) {
				$_page = get_page_by_path($post_id);
		} // end if

		if (isset($_page->post_type)) {

			// addressing  WP 2.5 or better
			if (in_array($_page->post_status , $status) && in_array($_page->post_type , $type)) {
				return $_page;
			} // end if
		} else {
			
			// dealing with previous version
			$status = array_merge($status, array('static'));

			if (in_array($_page->post_status , $status)) {
				return $_page;
			} // end if
		} // end if

		return false;
	} // end function
	
	/**
	 * Formats content of a page
	 */
	function get_the_content(&$post, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '', $displayStyle = DT_TEASER_MORE) {
		
	    $output = '';

	    //Manage password protected post
	    if (!empty($post->post_password)) { // if there's a password
	        if (stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) != $post->post_password) {  // and it doesn't match the cookie
	            $output = __('This post is password protected.');
	            return $output;
	        } // end if
	    } // end if

	    //$content = $post->post_content;

	    $content = explode('<!--more-->', $post->post_content, 2);

	    if ((preg_match('/<!--noteaser-->/', $post->post_content)) || $displayStyle == DT_FULL_CONTENT_NOTEASER ) {
	        $stripteaser = 1;
		} // end if

	    $teaser = $content[0];

	    if ($displayStyle == DT_FULL_CONTENT_NOTEASER) $teaser = '';

	    $output .= $teaser;

	    if (count($content) > 1) {
	        if ($displayStyle == DT_FULL_CONTENT_NOTEASER || $displayStyle == DT_FULL_CONTENT) {
	            $output .= '<span id="more-'.$id.'"></span>'.$content[1];
	        } elseif ($displayStyle == DT_TEASER_MORE) {
	            $output .= ' <a class="more" href="'. get_permalink($post->ID) . "\">$more_link_text</a>";
	        } // end if
	    } // end if

	    return $output;

	} // end function
	
	/**
	 * Manage WP Shortcode API
	 */
	function shortcode_handler($atts, $content=null) {
		global $post;

		if (!function_exists('add_shortcode')) return false;
			
		$out = '';
		$params = array();
		
		// Parsing parameters other than ID
		foreach ($atts as $name => $value) {

			// WP transforms all attributes in lowercase
			// re-setting normal case
			switch ($name) {
				case 'displaystyle':
					$name = 'displayStyle';
					break;
				case 'displaytitle':

					$name = 'displayTitle';
					break;

				case 'titlebefore':
					$name = 'titleBefore';
					break;

				case 'titleafter':
					$name = 'titleAfter';
				break;

				case 'allowstatus':
					$name = 'allowStatus';
				break;

				case 'allowtype':
					$name = 'allowType';
				break;

				default:
				continue;
			} // end switch

			if ($name != 'id') {
				$params[] .= $name . '=' . html_entity_decode($value);
			} // end if

			$out .= "$name = $value ";

		} // end foreach
		
		// Call IIP only with a valid ID
		if (!empty($atts['id']) && $post->ID != $atts['id']) {
			$out = iinclude_page($atts['id'], implode('&', $params), true);
		} else {$out = '';} // end if

		return $out;

	} // end function

} // end class IIP

/// MAIN----------------------------------------------------------------------

if (function_exists('add_shortcode')) {
	add_shortcode('include-page', array('IIP','shortcode_handler'));
} // end if
?>
