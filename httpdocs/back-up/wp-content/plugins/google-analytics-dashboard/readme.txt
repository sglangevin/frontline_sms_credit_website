=== Google Analytics Dashboard ===
Contributors: Carson McDonald
Tags: google, analytics, google analytics, dashboard, widget
Requires at least: 2.5
Tested up to: 2.8
Stable tag: 1.0.4

This plugin will give you access to your Google Analytics data directly inside your WordPress blog.

== Description ==

Google Analytics Dashboard gives you the ability to view your Google Analytics data in your Wordpress dashboard. You can also alow other users to see the same dashboard information when they are logged in or embed parts of the data into posts or as part of your theme.

This plugin does not provide the tracking code for Google Analytics. For that you will need to use a plugin like [Google Analytics for Wordpress](http://wordpress.org/extend/plugins/google-analytics-for-wordpress/ "Google Analytics for Wordpress").

There is a [Google Group](http://groups.google.com/group/gad-wordpress-plugin "Google Group for Google Analytics Dashboard plugin") for this plugin that can be used for questions and feature requests.

== Installation ==

= Install =

1. Unzip the zip file.
2. Upload the the entire unziped folder to the wp-contents/plugins folder.

= Activate =

1. In your WordPress administration, go to the Plugins page.
2. Activate the plugin. You will now have a new Google Analytics Dashboard option under Settings.
3. Go to the new Google Analytics Dashboard page and log in using your Google Analytics credentials.
4. After authenticating with your Google Analytics account you will need to select one of your analytics profiles to display.

Please note that [SimpleXML](http://us3.php.net/manual/en/book.simplexml.php "SimpleXML") is needed for this plugin. It is enabled by default in PHP version 5 but some hosting environments may have it turned off. The plugin will alert you if SimpleXML is not available.

If you do not choose a level for access to the dashboard view it will only be
visible to the admin user.

== Screenshots ==

1. This is an example of the main dashboard widget.
2. This is an example of sparklines and data for each post.
3. This is the screen that you see before you have logged into your Google Analytics account.
4. This is the screen you will see after you have logged into your Google Analytics account.
5. This is an example of embedding a sparkline into a post.
6. This is the Google Analytics Dashboard widget configuration.

== Frequently Asked Questions ==

= I'm getting the error "Cannot instantiate non-existent class: simplexmlelement..." =

The plugin needs SimpleXML support for PHP compiled in. This is compiled in by
default with PHP 5. There is a backport for PHP 4 found here:
http://sourceforge.net/projects/ister4framework/

== Usage ==

= Embedding =

To embed Google Analytics data into a post use the following syntax: [stattype: option, option, ...]. 

The currently available stat types are:

* pageviews - options: sparkline

Examples:

The following will be replaced by the number of pageviews for the current page or post over the past 30 days when embedded in that page or post:

[pageviews] 

The following will be replaced by a sparkline that represents the number of pageviews for the current page or post over the past 30 days when embedded in that page or post:

[pageviews: sparkline] 

There is also a widget that can embed analytics on every page, just check out the widgets section. Widgets are only supported with Wordpress 2.8 and above.

If you want to embed the analytics directly in a theme you can also call them
directly. Here is an example of what you would would use:

&lt;?php
$data = new GADWidgetData();
echo $data->gad_pageviews_sparkline(substr($_SERVER["REQUEST_URI"], -20));
?>

