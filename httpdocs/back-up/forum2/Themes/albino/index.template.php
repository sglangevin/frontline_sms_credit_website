<?php
// Version: 2.0 RC1; index

/*	This template is, perhaps, the most important template in the theme. It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below. It also contains the
	menu sub template, which appropriately displays the menu; the init sub
	template, which is there to set the theme up; (init can be missing.) and
	the linktree sub template, which sorts out the link tree.

	The init sub template should load any data and set any hardcoded options.

	The main_above sub template is what is shown above the main content, and
	should contain anything that should be shown up there.

	The main_below sub template, conversely, is shown after the main content.
	It should probably contain the copyright statement and some other things.

	The linktree sub template should display the link tree, using the data
	in the $context['linktree'] variable.

	The menu sub template should display all the relevant buttons the user
	wants and or needs.

	For more information on the templating system, please see the site at:
	http://www.simplemachines.org/
*/

// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '2.0 RC1';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as oppossed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status separate from topic icons? */
	$settings['separate_sticky_lock'] = true;

	// load custom language strings
	loadLanguage('ThemeStrings');

	/* Does this theme use the strict doctype? */
	$settings['strict_doctype'] = false;

	/* Does this theme use post previews on the message index? */
	$settings['message_index_preview'] = false;
	
	/* Set the following variable to true if this theme requires the optional theme strings file to be loaded. */
	$settings['require_theme_strings'] = false;
}

// The main sub template above the content.
function template_html_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title_html_safe'], '" />
	<meta name="keywords" content="', $context['meta_keywords'], '" />
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js?rc1"></script>
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/theme.js?rc1"></script>
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		if (confirm("' . $txt['show_personal_messages'] . '"))
			window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>
	<title>', $context['page_title_html_safe'], '</title>';

	// Please don't index these Mr Robot.
	if (!empty($context['robot_no_index']))
		echo '
	<meta name="robots" content="noindex" />';

	// The ?rc1 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style', $context['theme_variant'], '.css?rc1" />';

	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/print.css?rc1" media="print" />';

	// IE7 needs some fixes for styles.
	if ($context['browser']['is_ie7'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/ie7.css" />';
	// ..and IE6!
	elseif ($context['browser']['is_ie6'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/ie6.css" />';
	// Firefox - all versions - too!
	elseif ($context['browser']['is_firefox'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/ff.css" />';

	// RTL languages require an additional stylesheet.
	if ($context['right_to_left'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/css/rtl.css" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name_html_safe'], ' - RSS" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="', $scripturl, '?board=', $context['current_board'], '.0" />';

	// We'll have to use the cookie to remember the header...
	if ($context['user']['is_guest'])
	{
		$options['collapse_header'] = !empty($_COOKIE['upshrink']);
		$options['collapse_header_ic'] = !empty($_COOKIE['upshrinkIC']);
	}

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'], '
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		// Create the main header object.
		var mainHeader = new smfToggle("upshrink", ', empty($options['collapse_header']) ? 'false' : 'true', ');
		mainHeader.useCookie(', $context['user']['is_guest'] ? 1 : 0, ');
		mainHeader.setOptions("collapse_header", "', $context['session_id'], '");
		mainHeader.addToggleImage("upshrink", "/upshrink.gif", "/upshrink2.gif");
		mainHeader.addTogglePanel("user_section");
		mainHeader.addTogglePanel("news_section");
	// ]]></script>';

	echo '
</head>
<body>';
}

function template_body_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

echo '
		<div id="wrapper"/>
			 <div id="header">
				  <div id="head-l">
					  <div id="head-r">
						  <div id="userarea">';
				if($context['user']['is_logged']){
					echo $txt['wel_co'] , ' <strong>' , $context['user']['name'] , '</strong><br />';

				// Only tell them about their messages if they can read their messages!
				if ($context['allow_pm'])
				 echo '  [ <a href="', $scripturl, '?action=pm">', $context['user']['messages'], '/<strong>', $context['user']['unread_messages'] , '</strong></a> ', $txt['p_m'], ']  ';

				// Is the forum in maintenance mode?
				if ($context['in_maintenance'] && $context['user']['is_admin'])
					echo '[ <strong>', $txt['ma_tan'], '</strong> ]';

				// Are there any members waiting for approval?
				if (!empty($context['unapproved_members']))
					echo ' [<a href="', $scripturl, '?action=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] , ' ', $txt['ap_po'], '</a> ]';
					echo '<a href="', $scripturl, '?action=unread"><u>', $txt['un_red'], '</u></a> /
							<a href="', $scripturl, '?action=unreadreplies">', $txt['re_ply'], '</a><br /><br /><strong><span class="smalltext">', $txt['t_date'], '</strong>  ', $context['current_time'], '</span>';}
				
	// If the user is a guest, show [login] or [register].
	if ($context['user']['is_guest']){
		echo '', $txt['hel_lo'], ' <strong>', $txt['ge_st'], '</strong> <br />
	 ', $txt['pl_se'],  ' <a href="' . $scripturl . '?action=login">', $txt['lo_go'], '</a> or <a href="' . $scripturl . '?action=register">', $txt['reg_y'], '</a>.';}
				echo '
		  </div> 
		<a href="'.$scripturl.'" title=""><span id="logo"> </span></a>';

  // Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '<div id="news">
		  <br /><b>', $txt['n_w'], '</b> ', $context['random_news_line'], '
			</div>
		</div>	 
	</div>
</div>
		',template_menu(),'
	  <div id="bodyarea">';

	// Show the navigation tree.
		theme_linktree2();

}

function template_body_below()
{
	global $context, $settings, $options, $scripturl, $txt;

			echo '
				</div>';

				// Show the "Powered by" and "Valid" logos, as well as the copyright. Remember, the copyright must be somewhere!
			echo '
				<div id="footer">
					<div id="foot-l">
						<div id="foot-r">
							<div id="footerarea">
				<span class="smalltext">', theme_copyright(), '<br />' , $txt['c_copy'] , '<br /></span>';

				// Show the load time?
				if ($context['show_load_time'])
					echo '<span class="smalltext">'. $txt['page_created'], $context['load_time'], $txt['seconds_with'], $context['load_queries'], $txt['queries'], '</span>';

			echo '
							</div>
						</div>
					</div>
				</div>';
}

function template_html_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree2()
{
	global $context, $settings, $options;

	echo '<div id="linktree">';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '">' . $tree['name'] . '</a>' : $tree['name'];

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo ' » ';
	}

	echo '
	</div>';
}

function theme_linktree()
{
	return;
}

// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
		<div id="tabs">
			<ul>';

			foreach ($context['menu_buttons'] as $act => $button)
				echo '<li><a ', $button['active_button'] ? ' class="current"' : '' , ' href="', $button['href'], '">', $button['title'], '</a></li>';

	echo '
			</ul>
		</div>';

}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $context, $txt, $scripturl;

	// Create the buttons...
	$buttons = array();
	foreach ($button_strip as $key => $value)
	{
		if (!isset($value['test']) || !empty($context[$value['test']]))
			$buttons[] = '<a href="' . $value['url'] . '" ' . (isset($value['custom']) ? $value['custom'] : '') . '><span>' . $txt[$value['text']] . '</span></a>';
	}

	if (empty($buttons))
		return '';

	// Make the last one, as easy as possible.
	$buttons[count($buttons) - 1] = str_replace('<span>', '<span class="last">', $buttons[count($buttons) - 1]);

	echo '
		<div class="buttonlist', $direction != 'top' ? '_bottom' : '', '">
			<ul class="clearfix">
				<li>', implode('</li><li>', $buttons), '</li>
			</ul>
		</div>';

}

?>