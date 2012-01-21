<?php
// Version: 2.0 RC1; BoardIndex

function template_main()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	// Show some statistics if stat info is off.
	if (!$settings['show_stats_index'])
		echo '
	<p id="stats">
		', $txt['members'], ': ', $context['common_stats']['total_members'], ' &nbsp;&#8226;&nbsp; ', $txt['posts_made'], ': ', $context['common_stats']['total_posts'], ' &nbsp;&#8226;&nbsp; ', $txt['topics'], ': ', $context['common_stats']['total_topics'], '
		', ($settings['show_latest_member'] ? '<br />' . $txt['welcome_member'] . ' <b>' . $context['common_stats']['latest_member']['link'] . '</b>' . $txt['newest_member'] : '') , '
	</p>';

	// Show the news fader?  (assuming there are things to show...)
	if ($settings['show_newsfader'] && !empty($context['fader_news_lines']))
	{
	echo '
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		// Create the main header object.
		var smfNewsFadeToggle = new smfToggle("smfNewsFadeScroller", ', empty($options['collapse_news_fader']) ? 'false' : 'true', ');
		smfNewsFadeToggle.useCookie(', $context['user']['is_guest'] ? 1 : 0, ');
		smfNewsFadeToggle.setOptions("collapse_news_fader", "', $context['session_id'], '");
		smfNewsFadeToggle.addToggleImage("newsupshrink", "/collapse.gif", "/expand.gif");
		smfNewsFadeToggle.addTogglePanel("smfNewsFader");
	// ]]></script>
	<div class="tborder marginbottom">
		<h3 id="newsfader" class="catbg headerpadding">
			<a href="#" onclick="smfNewsFadeToggle.toggle(); return false;">
				<img id="newsupshrink" src="', $settings['images_url'], '/', empty($options['collapse_news_fader']) ? 'collapse.gif' : 'expand.gif', '" alt="*" title="', $txt['upshrink_description'], '" align="bottom" />
			</a>&nbsp;', $txt['news'], '
		</h3>
		<div id="smfNewsFader"', empty($options['collapse_news_fader']) ? '' : ' style="display: none;"', '>
			<div id="smfFadeScroller"><span>', $context['news_lines'][0], '</span></div>
		</div>
	</div>
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		// The fading delay (in ms.)
		var smfFadeDelay = ', empty($settings['newsfader_time']) ? 5000 : $settings['newsfader_time'], ';
		// Fade from... what text color? To which background color?
		var smfFadeFrom = {"r": 0, "g": 0, "b": 0}, smfFadeTo = {"r": 255, "g": 255, "b": 255};
		// Surround each item with... anything special?
		var smfFadeBefore = "<b>", smfFadeAfter = "</b>";

		var foreColor, foreEl, backEl, backColor;

		if (typeof(document.getElementById(\'smfFadeScroller\').currentStyle) != "undefined")
		{
			foreColor = document.getElementById(\'smfFadeScroller\').currentStyle.color.match(/#([\da-f][\da-f])([\da-f][\da-f])([\da-f][\da-f])/);
			smfFadeFrom = {"r": parseInt(foreColor[1]), "g": parseInt(foreColor[2]), "b": parseInt(foreColor[3])};

			backEl = document.getElementById(\'smfFadeScroller\');
			while (backEl.currentStyle.backgroundColor == "transparent" && typeof(backEl.parentNode) != "undefined")
				backEl = backEl.parentNode;

			backColor = backEl.currentStyle.backgroundColor.match(/#([\da-f][\da-f])([\da-f][\da-f])([\da-f][\da-f])/);
			smfFadeTo = {"r": eval("0x" + backColor[1]), "g": eval("0x" + backColor[2]), "b": eval("0x" + backColor[3])};
		}
		else if (typeof(window.opera) == "undefined" && typeof(document.defaultView) != "undefined")
		{

			foreEl = document.getElementById(\'smfFadeScroller\');

			while (document.defaultView.getComputedStyle(foreEl, null).getPropertyCSSValue("color") == null && typeof(foreEl.parentNode) != "undefined" && typeof(foreEl.parentNode.tagName) != "undefined")
				foreEl = foreEl.parentNode;

			foreColor = document.defaultView.getComputedStyle(foreEl, null).getPropertyValue("color").match(/rgb\((\d+), (\d+), (\d+)\)/);
			smfFadeFrom = {"r": parseInt(foreColor[1]), "g": parseInt(foreColor[2]), "b": parseInt(foreColor[3])};

			backEl = document.getElementById(\'smfFadeScroller\');

			while (document.defaultView.getComputedStyle(backEl, null).getPropertyCSSValue("background-color") == null && typeof(backEl.parentNode) != "undefined" && typeof(backEl.parentNode.tagName) != "undefined")
				backEl = backEl.parentNode;

			backColor = document.defaultView.getComputedStyle(backEl, null).getPropertyValue("background-color");//.match(/rgb\((\d+), (\d+), (\d+)\)/);
			smfFadeTo = {"r": parseInt(backColor[1]), "g": parseInt(backColor[2]), "b": parseInt(backColor[3])};
		}

		// List all the lines of the news for display.
		var smfFadeContent = new Array(
			"', implode('",
			"', $context['fader_news_lines']), '"
		);
	// ]]></script>
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/scripts/fader.js"></script>';
	}

	/* Each category in categories is made up of:
	id, href, link, name, is_collapsed (is it collapsed?), can_collapse (is it okay if it is?),
	new (is it new?), collapse_href (href to collapse/expand), collapse_image (up/down image),
	and boards. (see below.) */
	foreach ($context['categories'] as $category)
	{
		echo '
	<div class="categoryframe tborder">
		<h3 class="catbg', $category['new'] ? '2' : '', ' headerpadding">';

		if (!$context['user']['is_guest'])
			echo '
			<a class="floatright" href="', $scripturl, '?action=unread;c=', $category['id'], '">', $txt['view_unread_category'], '</a>';

		// If this category even can collapse, show a link to collapse it.
		if ($category['can_collapse'])
			echo '
			<a href="', $category['collapse_href'], '">', $category['collapse_image'], '</a>&nbsp;';

		echo $category['link'];

		echo '
		</h3>';

		// Assuming the category hasn't been collapsed...
		if (!$category['is_collapsed'])
		{
			echo '
		<table cellspacing="1" class="bordercolor boardsframe">';

			/* Each board in each category's boards has:
			new (is it new?), id, name, description, moderators (see below), link_moderators (just a list.),
			children (see below.), link_children (easier to use.), children_new (are they new?),
			topics (# of), posts (# of), link, href, and last_post. (see below.) */
			foreach ($category['boards'] as $board)
			{
				echo '
			<tr>
				<td', !empty($board['children']) ? ' rowspan="2"' : '', ' class="windowbg icon">
					<a href="', ($board['is_redirect'] || $context['user']['is_guest'] ? $board['href'] : $scripturl . '?action=unread;board=' . $board['id'] . '.0;children'), '">';

				// If the board or children is new, show an indicator.
				if ($board['new'] || $board['children_new'])
					echo '
						<img src="', $settings['images_url'], '/on', $board['new'] ? '' : '2', '.png" alt="', $txt['new_posts'], '" title="', $txt['new_posts'], '" border="0" />';
				// Is it a redirection board?
				elseif ($board['is_redirect'])
					echo '
						<img src="', $settings['images_url'], '/redirect.gif" alt="*" title="*" border="0" />';
				// No new posts at all! The agony!!
				else
					echo '
						<img src="', $settings['images_url'], '/off.png" alt="', $txt['old_posts'], '" title="', $txt['old_posts'], '" />';

				echo '
					</a>
				</td>
				<td class="windowbg2 info">
					<h4><a href="', $board['href'], '" name="b', $board['id'], '">', $board['name'], '</a>';

				// Has it outstanding posts for approval?
				if ($board['can_approve_posts'] && ($board['unapproved_posts'] || $board['unapproved_topics']))
					echo '
						<a href="', $scripturl, '?action=moderate;area=postmod;sa=', ($board['unapproved_topics'] > $board['unapproved_posts'] ? 'topics' : 'posts'), ';brd=', $board['id'], ';', $context['session_var'], '=', $context['session_id'], '" title="', sprintf($txt['unapproved_posts'], $board['unapproved_topics'], $board['unapproved_posts']), '" class="moderation_link">(!)</a>';

				echo '
					</h4>
					<p>', $board['description'] , '</p>';

				// Show the "Moderators: ". Each has name, href, link, and id. (but we're gonna use link_moderators.)
				if (!empty($board['moderators']))
					echo '
					<p class="moderators">', count($board['moderators']) == 1 ? $txt['moderator'] : $txt['moderators'], ': ', implode(', ', $board['link_moderators']), '</p>';

				// Show some basic information about the number of posts, etc.
					echo '
				</td>
				<td', !empty($board['children']) ? ' rowspan="2"' : '', ' class="windowbg stats smalltext">
					', $board['posts'], ' ', $board['is_redirect'] ? $txt['redirects'] : $txt['posts'], ' <br />
					', $board['is_redirect'] ? '' : $board['topics'] . ' ' . $txt['board_topics'], '
				</td>
				<td', !empty($board['children']) ? ' rowspan="2"' : '', ' class="windowbg2 smalltext lastpost">';

				/* The board's and children's 'last_post's have:
				time, timestamp (a number that represents the time.), id (of the post), topic (topic id.),
				link, href, subject, start (where they should go for the first unread post.),
				and member. (which has id, name, link, href, username in it.) */
				if (!empty($board['last_post']['id']))
					echo '
					<strong>', $txt['last_post'], '</strong>  ', $txt['by'], ' ', $board['last_post']['member']['link'] , '<br />
					', $txt['in'], ' ', $board['last_post']['link'], '<br />
					', $txt['on'], ' ', $board['last_post']['time'];
				echo '
				</td>
			</tr>';

				// Show the "Child Boards: ". (there's a link_children but we're going to bold the new ones...)
				if (!empty($board['children']))
				{
					// Sort the links into an array with new boards bold so it can be imploded.
					$children = array();
					/* Each child in each board's children has:
							id, name, description, new (is it new?), topics (#), posts (#), href, link, and last_post. */
					foreach ($board['children'] as $child)
					{
						if (!$child['is_redirect'])
							$child['link'] = '<a href="' . $child['href'] . '" title="' . ($child['new'] ? $txt['new_posts'] : $txt['old_posts']) . ' (' . $txt['board_topics'] . ': ' . $child['topics'] . ', ' . $txt['posts'] . ': ' . $child['posts'] . ')">' . $child['name'] . '</a>';
						else
							$child['link'] = '<a href="' . $child['href'] . '" title="' . $child['posts'] . ' ' . $txt['redirects'] . '">' . $child['name'] . '</a>';

						// Has it posts awaiting approval?
						if ($child['can_approve_posts'] && ($child['unapproved_posts'] | $child['unapproved_topics']))
							$child['link'] .= ' <a href="' . $scripturl . '?action=moderate;area=postmod;sa=' . ($child['unapproved_topics'] > $child['unapproved_posts'] ? 'topics' : 'posts') . ';brd=' . $child['id'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" title="' . sprintf($txt['unapproved_posts'], $child['unapproved_topics'], $child['unapproved_posts']) . '" class="moderation_link">(!)</a>';

						$children[] = $child['new'] ? '<strong>' . $child['link'] . '</strong>' : $child['link'];
					}
					echo '
			<tr>
				<td class="windowbg3 smalltext largepadding"><strong>', $txt['parent_boards'], '</strong>: ', implode(', ', $children), '</td>
			</tr>';
				}
			}
			echo '
		</table>';
		}
		echo '
	</div>';
	}

	if ($context['user']['is_logged'])
	{
		echo '
	<div id="posticons" class="clearfix marginbottom">
		<div class="smalltext floatleft headerpadding">
			<img src="' . $settings['images_url'] . '/on.png" width="20" height="18" alt="" align="middle" /> ', $txt['new_posts'], '
			<img src="' . $settings['images_url'] . '/off.png" width="20" height="18" alt="" align="middle" style="margin-left: 4ex;" /> ', $txt['old_posts'], '
		</div>';

		// Mark read button.
		$mark_read_button = array(
			'markread' => array('text' => 'mark_as_read', 'image' => 'markread.gif', 'lang' => true, 'url' => $scripturl . '?action=markasread;sa=all;' . $context['session_var'] . '=' . $context['session_id']),
		);


		// Show the mark all as read button?
		if ($settings['show_mark_read'] && !empty($context['categories']))
			template_button_strip($mark_read_button, 'top');

		echo '
	</div>';
	}

	template_info_center();
}

function template_info_center()
{
	global $context, $settings, $options, $txt, $scripturl, $modSettings;

	// Info center collapse object.
	echo '
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		// And create the info center object.
		var infoHeader = new smfToggle("upshrinkIC", ', empty($options['collapse_header_ic']) ? 'false' : 'true', ');
		infoHeader.useCookie(', $context['user']['is_guest'] ? 1 : 0, ');
		infoHeader.setOptions("collapse_header_ic", "', $context['session_id'], '");
		infoHeader.addToggleImage("upshrink_ic", "/collapse.gif", "/expand.gif");
		infoHeader.addTogglePanel("upshrinkHeaderIC");
	// ]]></script>';

	// Here's where the "Info Center" starts...
	echo '
	<div class="tborder clearfix" id="infocenterframe">
		<h3 class="catbg headerpadding">
			<a href="#" onclick="infoHeader.toggle(); return false;"><img id="upshrink_ic" src="', $settings['images_url'], '/', empty($options['collapse_header_ic']) ? 'collapse.gif' : 'expand.gif', '" alt="*" title="', $txt['upshrink_description'], '" style="margin-right: 2ex;" align="right" /></a>
			', sprintf($txt['info_center_title'], $context['forum_name_html_safe']), '
		</h3>
		<div id="upshrinkHeaderIC"', empty($options['collapse_header_ic']) ? '' : ' style="display: none;"', '>';

	// This is the "Recent Posts" bar.
	if (!empty($settings['number_recent_posts']))
	{
		echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $txt['recent_posts'], '</h4>
				<div class="windowbg">
					<p class="section">
						<a href="', $scripturl, '?action=recent"><img src="', $settings['images_url'], '/post/xx.gif" alt="', $txt['recent_posts'], '" /></a>
					</p>
					<div class="windowbg2 sectionbody hslice clearfix" id="recent_posts_content"><div class="entry-title" style="display: none;">', $context['forum_name_html_safe'], ' - ', $txt['recent_posts'], '</div><div class="entry-content" style="display: none;"><a rel="feedurl" href="', $scripturl, '?action=.xml;type=webslice">', $txt['subscribe_webslice'], '</a></div>';

		// Only show one post.
		if ($settings['number_recent_posts'] == 1)
		{
			// latest_post has link, href, time, subject, short_subject (shortened with...), and topic. (its id.)
			echo '
						<strong><a href="', $scripturl, '?action=recent">', $txt['recent_posts'], '</a></strong>
						<p id="infocenter_onepost" class="smalltext">
								', $txt['recent_view'], ' &quot;', $context['latest_post']['link'], '&quot; ', $txt['recent_updated'], ' (', $context['latest_post']['time'], ')<br />
						</p>';
		}
		// Show lots of posts.
		elseif (!empty($context['latest_posts']))
		{
			echo '
						<dl id="infocenter_recentposts" class="middletext">';

			/* Each post in latest_posts has:
					board (with an id, name, and link.), topic (the topic's id.), poster (with id, name, and link.),
					subject, short_subject (shortened with...), time, link, and href. */
			foreach ($context['latest_posts'] as $post)
				echo '
							<dt><strong>', $post['link'], '</strong> ', $txt['by'], ' ', $post['poster']['link'], ' (', $post['board']['link'], ')</dt>
							<dd>', $post['time'], '</dd>';
			echo '
						</dl>';
		}
		echo '
					</div>
				</div>
			</div>';
	}

	// Show information about events, birthdays, and holidays on the calendar.
	if ($context['show_calendar'])
	{
		echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '</h4>
				<div class="windowbg">
					<p class="section">
						<a href="', $scripturl, '?action=calendar' . '"><img src="', $settings['images_url'], '/icons/calendar.gif', '" alt="', $context['calendar_only_today'] ? $txt['calendar_today'] : $txt['calendar_upcoming'], '" /></a>
					</p>
					<div class="sectionbody windowbg2 middletext">';

		// Holidays like "Christmas", "Chanukah", and "We Love [Unknown] Day" :P.
		if (!empty($context['calendar_holidays']))
				echo '
							<span class="holiday">', $txt['calendar_prompt'], ' ', implode(', ', $context['calendar_holidays']), '</span><br />';

		// People's birthdays. Like mine. And yours, I guess. Kidding.
		if (!empty($context['calendar_birthdays']))
		{
				echo '
							<span class="birthday">', $context['calendar_only_today'] ? $txt['birthdays'] : $txt['birthdays_upcoming'], '</span> ';
		/* Each member in calendar_birthdays has:
				id, name (person), age (if they have one set?), is_last. (last in list?), and is_today (birthday is today?) */
		foreach ($context['calendar_birthdays'] as $member)
				echo '
							<a href="', $scripturl, '?action=profile;u=', $member['id'], '">', $member['is_today'] ? '<b>' : '', $member['name'], $member['is_today'] ? '</b>' : '', isset($member['age']) ? ' (' . $member['age'] . ')' : '', '</a>', $member['is_last'] ? '<br />' : ', ';
		}
		// Events like community get-togethers.
		if (!empty($context['calendar_events']))
		{
			echo '
							<span class="event">', $context['calendar_only_today'] ? $txt['events'] : $txt['events_upcoming'], '</span> ';
			/* Each event in calendar_events should have:
					title, href, is_last, can_edit (are they allowed?), modify_href, and is_today. */
			foreach ($context['calendar_events'] as $event)
				echo '
							', $event['can_edit'] ? '<a href="' . $event['modify_href'] . '" style="color: #FF0000;">*</a> ' : '', $event['href'] == '' ? '' : '<a href="' . $event['href'] . '">', $event['is_today'] ? '<b>' . $event['title'] . '</b>' : $event['title'], $event['href'] == '' ? '' : '</a>', $event['is_last'] ? '<br />' : ', ';

			// Show a little help text to help them along ;).
			if ($context['calendar_can_edit'])
				echo '
							(<a href="', $scripturl, '?action=helpadmin;help=calendar_how_edit" onclick="return reqWin(this.href);">', $txt['calendar_how_edit'], '</a>)';
		}
		echo '
					</div>
				</div>
			</div>';
	}


	// Show statistical style information...
	if ($settings['show_stats_index'])
	{
		echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $txt['forum_stats'], '</h4>
				<div class="windowbg">
					<p class="section">
						<a href="', $scripturl, '?action=stats"><img src="', $settings['images_url'], '/icons/info.gif" alt="', $txt['forum_stats'], '" /></a>
					</p>
					<div class="windowbg2 sectionbody middletext">
						', $context['common_stats']['total_posts'], ' ', $txt['posts_made'], ' ', $txt['in'], ' ', $context['common_stats']['total_topics'], ' ', $txt['topics'], ' ', $txt['by'], ' ', $context['common_stats']['total_members'], ' ', $txt['members'], '. ', !empty($settings['show_latest_member']) ? $txt['latest_member'] . ': <b> ' . $context['common_stats']['latest_member']['link'] . '</b>' : '', '<br />
						', (!empty($context['latest_post']) ? $txt['latest_post'] . ': <b>&quot;' . $context['latest_post']['link'] . '&quot;</b>  ( ' . $context['latest_post']['time'] . ' )<br />' : ''), '
						<a href="', $scripturl, '?action=recent">', $txt['recent_view'], '</a>', $context['show_stats'] ? '<br />
						<a href="' . $scripturl . '?action=stats">' . $txt['more_stats'] . '</a>' : '', '
					</div>
				</div>
			</div>';
	}

	// "Users online" - in order of activity.
	echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $txt['online_users'], '</h4>
				<div class="windowbg">
					<p class="section">
						', $context['show_who'] ? '<a href="' . $scripturl . '?action=who' . '">' : '', '<img src="', $settings['images_url'], '/icons/online.gif', '" alt="', $txt['online_users'], '" />', $context['show_who'] ? '</a>' : '', '
					</p>
					<div class="windowbg2 sectionbody">
						', $context['show_who'] ? '<a href="' . $scripturl . '?action=who">' : '', $context['num_guests'], ' ', $context['num_guests'] == 1 ? $txt['guest'] : $txt['guests'], ', ' . $context['num_users_online'], ' ', $context['num_users_online'] == 1 ? $txt['user'] : $txt['users'];

	// Handle hidden users and buddies.
	$bracketList = array();
	if ($context['show_buddies'])
		$bracketList[] = $context['num_buddies'] . ' ' . ($context['num_buddies'] == 1 ? $txt['buddy'] : $txt['buddies']);
	if (!empty($context['num_spiders']))
		$bracketList[] = $context['num_spiders'] . ' ' . ($context['num_spiders'] == 1 ? $txt['spider'] : $txt['spiders']);
	if (!empty($context['num_users_hidden']))
		$bracketList[] = $context['num_users_hidden'] . ' ' . $txt['hidden'];

	if (!empty($bracketList))
		echo ' (' . implode(', ', $bracketList) . ')';

	echo $context['show_who'] ? '</a>' : '', '
						<div class="smalltext">';

	// Assuming there ARE users online... each user in users_online has an id, username, name, group, href, and link.
	if (!empty($context['users_online']))
	{
		echo '
							', sprintf($txt['users_active'], $modSettings['lastActive']), ':<br />', implode(', ', $context['list_users_online']);

		// Showing membergroups?
		if (!empty($settings['show_group_key']) && !empty($context['membergroups']))
			echo '
							<br />[' . implode(']&nbsp;&nbsp;[', $context['membergroups']) . ']';
	}

	echo '
						</div>
						<hr class="hrcolor" />
						<div class="smalltext">
							', $txt['most_online_today'], ': <b>', $modSettings['mostOnlineToday'], '</b>.
							', $txt['most_online_ever'], ': ', $modSettings['mostOnline'], ' (' , timeformat($modSettings['mostDate']), ')
						</div>
					</div>
				</div>
			</div>';

	// If they are logged in, but statistical information is off... show a personal message bar.
	if ($context['user']['is_logged'] && !$settings['show_stats_index'])
	{
		echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $txt['personal_message'], '</h4>
				<div class="windowbg">
					<p class="section">
						', $context['allow_pm'] ? '<a href="' . $scripturl . '?action=pm">' : '', '<img src="', $settings['images_url'], '/message_sm.gif" alt="', $txt['personal_message'], '" />', $context['allow_pm'] ? '</a>' : '', '
					</p>
					<div class="windowbg2 sectionbody">
						<strong><a href="', $scripturl, '?action=pm">', $txt['personal_message'], '</a></strong>
						<div class="smalltext">
							', $txt['you_have'], ' ', $context['user']['messages'], ' ', $context['user']['messages'] == 1 ? $txt['message_lowercase'] : $txt['msg_alert_messages'], '.... ', $txt['click'], ' <a href="', $scripturl, '?action=pm">', $txt['here'], '</a> ', $txt['to_view'], '
						</div>
					</div>
				</div>
			</div>';
	}

	// Show the login bar. (it's only true if they are logged out anyway.)
	if ($context['show_login_bar'])
	{
		echo '
			<div class="infocenter_section">
				<h4 class="headerpadding titlebg">', $txt['login'], ' <a href="', $scripturl, '?action=reminder" class="smalltext">', $txt['forgot_your_password'], '</a></h4>
				<div class="windowbg">
					<p class="section">
						<a href="', $scripturl,  '?action=login"><img src="', $settings['images_url'], '/icons/login.gif', '" alt="', $txt['login'], '" /></a>
					</p>
					<div class="windowbg2 sectionbody">
						<form id="infocenter_login" action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '">
							<ul class="horizlist clearfix">
								<li>
									<label for="user">', $txt['username'], ':<br />
									<input type="text" name="user" id="user" size="15" /></label>
								</li>
								<li>
									<label for="passwrd">', $txt['password'], ':<br />
									<input type="password" name="passwrd" id="passwrd" size="15" /></label>
								</li>
								<li>
									<label for="cookielength">', $txt['mins_logged_in'], ':<br />
									<input type="text" name="cookielength" id="cookielength" size="4" maxlength="4" value="', $modSettings['cookieTime'], '" /></label>
								</li>
								<li>
									<label for="cookieneverexp">', $txt['always_logged_in'], ':<br />
									<input type="checkbox" name="cookieneverexp" id="cookieneverexp" checked="checked" class="check" /></label>
								</li>
								<li>
									<input type="submit" value="', $txt['login'], '" />
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>';
	}
	echo '
		</div>
	</div>';
}
?>