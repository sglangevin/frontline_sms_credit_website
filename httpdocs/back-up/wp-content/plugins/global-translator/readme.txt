=== Global Translator ===
Tags: translator, multilanguage, automatic translator, google translations, babelfish, promt, freetranslations, widget
Author: Davide Pozza
Contributors:
Donate link: http://www.nothing2hide.net/donate_global_translator.php
Requires at least: 2.3
Tested up to: 2.8
Stable Tag: 1.2.6

Automatically translates your blog in 34 different languages!

== Description ==

Global Translator automatically translates your blog in the following 41 different languages:
Italian, Korean, Chinese (Simplified), Portuguese, English, German, French, Spanish, Japanese, 
Arabic, Russian, Greek, Dutch, Bulgarian, Czech, Croatian, Danish, Finnish, Hindi, Polish, Romanian, 
Swedish, Norwegian, Catalan, Filipino, Hebrew, Indonesian, Latvian, Lithuanian, Serbian, Slovak, 
Slovenian, Ukrainian, Vietnamese,Albanian,Estonian,Galician,Maltese,Thai,Turkish,Hungarian.

The number of available translations will depend on your blog language and the translation engine you will chose to use.
Main features:

* **Four different translation engines**: Google Translation Engine, Babel Fish, Promt, FreeTranslations
* **Search Engine Optimized**: it uses the permalinks by adding the language code at the beginning of all your URI. 
	For example the english version on www.domain.com/mycategory/mypost will be automatically transformed in 
	www.domain.com/en/mycategory/mypost 
* **Fast Caching System**: new fast, smart, optimized, self-cleaning and built-in caching system. Drastically reduction of the risk of temporarily ban from translation engines. 
* **Fully configurable layout**: you can easily customize the appearance of the translation bar by choosing between a TABLE 
	or DIV layout for the flags bar and by selecting the number of translations to make available to your visitors 
* **No database modifications**: Global Translator is not intrusive. It doesn't create or alter any table on your database: this feature permits to obtain better performances.

**Global Translator is the first real (and free) traffic booster for your blog!**
It can help you to reach a lot of new users and consequently to strongly increase your popularity: if you derive some benefits and if you want to support the development, 
please consider to support me with a donation.

For the latest information and changelog visit the website

http://www.nothing2hide.net/wp-plugins/wordpress-global-translator-plugin/


**A Pro version with full support and additional features is also available!** 
Learn more by visiting this page: http://www.nothing2hide.net/global-translator-pro/


== Installation ==

1. 	Upload the folder "global-translator" to the "wp-content/plugins" directory.
2. 	Activate the plugin through the 'Plugins' menu in WordPress. 
3.	From the main menu choose "Options->Global Translator" and select 
		your blog language and your preferred configuration options then select "Update Options".

**How to upgrade**

If upgrading from 0.9 or higher, just overwrite the previous version (don't delete the "cache" directory!!), otherwise uninstall the previous 
version and follow the Installation instructions; don't use the automatic upgrade feature or your cache will be erased!

Starting from 1.0.8 the cache directory has been moved outside the plugin directory in order to support the Wordpress automatic pluging update feature:
the content of the previous existing cache (inside wp-content/plugins/global-translator/cache) will be automatically and progressively moved to the new 
cache location (wp-content/gt-cache) but, if you want, you can manually change the cache location by using your ftp client or a shell access.

== Configuration ==

If your theme is widged-enabled, just choose "Presentation->Widgets" from the administration main menu
and drag the "Global translator" widget on the preferred position on your sidebar.
If your theme is not widgetized, just add the following php code (usually to the sidebar.php file):  

<?php if(function_exists("gltr_build_flags_bar")) { gltr_build_flags_bar(); } ?>

After this simple operation, a bar containing the flags that represents all the available translations 
for your language will appear on your blog.

== Frequently Asked Questions ==

= The full translation process takes a lot of time. Why? =

In order to prevent from banning by the translation services, only a translation request every 5 minutes will be allowed. This will permit to fully translate
your blog whithout any interruption; this message will completely disappear when all the pages of your blog will be cached.
Remember that this message will also appear if you're currently being banned by the translation engine: this could happen if for example your blog shares the
same ip address with other blogs using older versions of Global Translator.

= "This page has not been translated yet. The translation process could take a while: please come back later." message when trying to access a translated page =

Upgrade to 1.0.8 or later. Starting from 1.0.8, a browser asking for a not yet translated page will be warned and redirected in 5 seconds to the translation service 
page in order to provide a temporary "backup translation service". Obviously, when the page is translated and saved on your cache directory, this redirection 
will disappear and the translated and cleaned page will be served by your blog.

= I have a Global Translator version prior than 1.0.5 and Google doesn't translate anymore! =

Starting from 27th of August 2008, Google has introduced a block in order to prevent not human translation requests: just upgrade to 1.0.5 or later.

= White page or Page Not Found (404) when clicking on a translation flag =

This could be due to a change of the permalinks structure of your blog, to a conflict with another plugin or to a custom 
.htaccess file which doesn't permit Global Translator to add its custom permalink rules. Try to refresh the Global Translator 
rewrite rules just pressing the "Update Options" button from the Global Translator admin page. If the problem persists, 
try also to deactivate all the other existing plugins and check your .htaccess file and comment out all the non-standard rewrite rules. 
If you discover a conflicting plugin please send me an email (davide at nothing2hide.net).

= "Sorry, the translation engine is temporarily not available. Please try again later" message when using Google Translations engine =

You're using an old version of the plugin. Please upgrade to 1.0 or later.

= The translated page has a bad/broken layout =

This is due to the translation engine action. I cannot do anything in order to prevent this problem :-)
I suggest you to try all the translation engines in order to choose the best one for your blog layout

= I've just changed my permalinks structure or just upgraded Wordpress to a newer version and Global Translator doesn't translate anymore =

Everytime the permalinks structure of your blog changes, the custom rules previously added by Global Translator are overriden.
To solve the problem you must just refresh the Global Translator Options ("Update Options" button) on the administrative area.

= I've removed one or more available translations but the search engines continue to try to index the corresponding urls =

When you remove one or more translations, the plugin will begin to return a 404 Not Found for all the corresponding translated pages.
In order to notify a search engine that one or more urls are not available anymore you should add a deny rule on your robots.txt file.
For example if you decide to remove the German translation you should modify your robots.txt as follows:
User-agent: *
[....]
Disallow: /de/*

= How can I discover if my blog is currently banned by the translation engine? =

Go to the Global Translator admin page. If your blog has been temporarily banned, a warning message will appear inside the "Translation engine connection" section.