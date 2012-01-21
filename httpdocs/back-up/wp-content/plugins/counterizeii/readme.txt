=== Counterize II ===
Contributors: Steffen Forkmann
Tags: statistics, admin, stats
Requires at least: 2.0.2
Tested up to: 2.5.
Stable tag: 2.14.1

Simple counter-plugin with no external libs - saves timestamp, visited URl, referring URl and browserinformation in database, and can display total hits, unique hits and other statistics in WordPress webpages. Admin-interface available with detailed information.
<b>Counterize II 2.13 doesn't store any IP information, because this is illegal in some countries (e.g. Germany).  
Counterize stores only a small hash to distingiush between different users and to get information about the user count.</b> 

External stats page to display in blog posts - visit the <a href="http://www.navision-blog.de/counterize/blog-statistik/">sample</a>.

Version 2.14.0 supports new dashboard for Wordpress 2.5. 

== Installation ==

1. Unzip the package and upload the folder **counterizeii** to **/wp-content/plugins/**.
1. Activate the plugin through the **Plugins** menu in WordPress.
1. Go to **Counterize II** on **Options** page, configurate your settings. *Save the settings*

== Update ==

1. Deactive **Counterize II** on the **Plugins** menu in WordPress
1. Unzip the package and upload the folder **counterizeii** to **/wp-content/plugins/**.
1. Activate the plugin through the **Plugins** menu in WordPress.
1. Go to **Counterize II** on **Options** page, configurate your settings. *Save the settings*

== Functions ==

After you have installed the Counterize II-Plugin, you can see a lot of diagrams on the Counterize II stats page (Dashboard/Counterize II).

Most likely you'd like to have a counter somewhere on your pages, showing XX hits or something like that. Here's an overview of the functions which can be used in your Wordpress sidebar.

New: &lt;!-- counterize_stats --&gt; - Shows a complete stats page in one of your blog posts.

echo counterize_getuniqueurl() – Returns amount of unique URl's that have been shown

echo counterize_getamount() – Returns total hits seen by Counterize.

echo counterize_gethitstoday() – Returns total hits registered today.

echo counterize_getuniquebrowsers() – Returns amount of unique browser-strings that have visited.

echo counterize_getuniquereferers() – Returns amount of unique referers that's registered.

echo counterize_getlatest7days() – Returns total amount of hits from the last 7 days.

echo counterize_getuniqueamount() – Returns total unique IP's that's been seen.

echo counterize_getfromcurrentip() – Returns total hits from the IP that's visiting.

echo counterize_getuniquehitstoday() – Returns the number of different IP's registered today.

echo counterize_gethitstodayfromcurrentip() – Returns daily hits from the IP that's visiting.

echo counterize_return_first_hit() – Returns the date of the first registrated entry in the database.

counterize_most_visited_pages() – Create graph of most visited pages.

counterize_most_visited_ips() – Create graph of most active IPs.

counterize_most_used_browsers() – Create graph of most seen useragents.
