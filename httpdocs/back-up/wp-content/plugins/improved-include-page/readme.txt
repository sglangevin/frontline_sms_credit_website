=== Improved Include Page ===
Contributors: vtardia
Tags: content, pages
Requires at least: 1.5.3
Tested up to: 2.7
Stable tag: 0.4.7

Improved Include Page plugin allows to include the content of a static page in a template file with several options. 

Since version 0.4.4 IIP uses WordPress Shortcode API allowing to include the content of any static page inside any page or post using the syntax:

    [include-page id="123"]

Since version 0.4.5 page ID can ba a valid page path (on WP 2.1 or higher):

    [include-page id="/about/resume"]

== Description ==

Improved Include Page is an expanded version of the original Include Page developed by Brent Loertscher and it was developed to add some features I needed.

### Key Features

 - page title display with optional HTML code,
 - content display with different styles (full, teaser, custom ‘more’ link),
 - Wordpress filters applied to both the content and the title,
 - supports Wordpress 2.5.x Shortcode API

### Version Notes 0.4.7

 - On WP 2.5 or greater allows custom inclusion by post type and status using 
   parameters 'allowType' and 'allowStatus'.
 - Bug fix: in shortcode fixed a bug that could crash PHP when including 
   recursive page/posts

### Version Notes (0.4.6)

 - Bug fixed: since this version you can include only static pages with
   status of 'published'.

### Version Notes (0.4.5)

 - Page ID can be a valid page path (WP 2.1 or higher required) with 
   contribution by Guy Leech.

### Version notes (0.4.4)

 - Added parameter $return (default = false) to iinclude_page() function
 - Added support for WP 2.5.x shortcode API

### Version notes (0.4.3)

The code of this version it's been cleaned and optimized using WordPress API.

### Version notes (0.4.2)

This version fixes a bug that triggers an error when used with some content filter: the `$page` global variable is backed up and then restored before returning.

### Version notes (0.4.1)

This version contains a bug fix by [Jesse Plank](http://www.funroe.net/): resolves a compatibility problem with the plugin [EventCalendar](http://blog.firetree.net/2005/07/18/eventcalendar-30/).

== Installation ==

 1. Download Improved Include Page
 2. Extract the zipped archive
 3. Upload the file `iinclude_page.php` to the `wp-content/plugins` directory 
    of your Wordpress installation
 4. Activate the plugin from your WordPress admin 'Plugins' page.
 5. Include pages in your templates ising `iinclude_page` function or in your 
    pages/posts using the shortcode syntax.

### How to use it

After installing it, the plugin adds the function ´iinclude_page´:

void **iinclude_page**(int post_id [,string params, boolean return = false])

The function takes three parameters: the id of the page to include (`post_id`) and an optional string (`params`) which contains the display options and an optional boolean (`return`) tells wether to return the content or display it on screen.

#### Example 1: basic usage

If you wish to include the content of page number `4` insert the following code into your template file (eg. sidebar.php):

    <?php iinclude_page(4); ?>

or

    <?php echo iinclude_page(4, null, true); ?>


In order to avoid PHP errors you should use the function with the following syntax:

     <?php if(function_exists('iinclude_page')) iinclude_page(4); ?>

#### Example 2: using optional parameter

You can also display the page title using the following code:

    <?php iinclude_page(4,'displayTitle=true&titleBefore=<h2 class="sidebar-header">'); ?>
	
#### Example 3: using Shortcode API

You can include a page's content in a page/post using the syntax:

    [include-page id="123"]

or

    [include-page id="3" displayTitle="true" displayStyle="DT_TEASER_MORE" titleBefore="<h3>" titleAfter="</h3>"  more="continue&raquo;"]

#### Parameters

The current version supports the following parameters:

<dl>
<dt>displayTitle (<em>boolean</em>)</dt>
<dd>toggle title display</dd>

<dt>titleBefore/after (<em>string</em>)</dt>

<dd>string to display before and after the title</dd>

<dt>displayStyle (<em>integer constant</em>)</dt>
<dd>one of the following:
<ul>
<li><code>DT_TEASER_MORE</code> - Teaser with &#8216;more&#8217; link (default)</li>
<li><code>DT_TEASER_ONLY</code> -Teaser only, without &#8216;more&#8217; link</li>
<li><code>DT_FULL_CONTENT</code> - Full content including teaser</li>
<li><code>DT_FULL_CONTENT_NOTEASER</code> - Full content without teaser</li>
</ul>
</dd>

<dt>more (string)</dt>
<dd>text to display for the &#8216;more&#8217; link</dd>
</dl>
