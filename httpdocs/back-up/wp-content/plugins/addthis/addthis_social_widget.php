<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
/* 
* +--------------------------------------------------------------------------+
* | Copyright (c) 2008 Add This, LLC                                         |
* +--------------------------------------------------------------------------+
* | This program is free software; you can redistribute it and/or modify     |
* | it under the terms of the GNU General Public License as published by     |
* | the Free Software Foundation; either version 2 of the License, or        |
* | (at your option) any later version.                                      |
* |                                                                          |
* | This program is distributed in the hope that it will be useful,          |
* | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
* | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
* | GNU General Public License for more details.                             |
* |                                                                          |
* | You should have received a copy of the GNU General Public License        |
* | along with this program; if not, write to the Free Software              |
* | Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA |
* +--------------------------------------------------------------------------+
*/

if (!defined('ADDTHIS_INIT')) define('ADDTHIS_INIT', 1);
else return;

/**
* Plugin Name: AddThis Social Bookmarking Widget
* Plugin URI: http://www.addthis.com
* Description: Help your visitor promote your site! The AddThis Social Bookmarking Widget allows any visitor to bookmark your site easily with many popular services. Sign up for an AddThis.com account to see how your visitors are sharing your content--which services they're using for sharing, which content is shared the most, and more. It's all free--even the pretty charts and graphs.
* Version: 1.5.4
*
* Author: The AddThis Team
* Author URI: http://www.addthis.com
*/
$addthis_settings = array(array('isdropdown', 'true'),
                          array('customization', ''), 
                          array('language', 'en'), 
                          array('username', ''), 
                          array('style', 'share'));

$addthis_languages = array('zh'=>'Chinese', 'da'=>'Danish', 'nl'=>'Dutch', 'en'=>'English', 'fi'=>'Finnish', 'fr'=>'French', 'de'=>'German', 'he'=>'Hebrew', 'it'=>'Italian', 'ja'=>'Japanese', 'ko'=>'Korean', 'no'=>'Norwegian', 'pl'=>'Polish', 'pt'=>'Portugese', 'ru'=>'Russian', 'es'=>'Spanish', 'sv'=>'Swedish');

$addthis_styles = array(
                      'share' => array('img'=>'lg-share-%lang%.gif', 'w'=>125, 'h'=>16),
                      'bookmark' => array('img'=>'lg-bookmark-en.gif', 'w'=>125, 'h'=>16),
                      'addthis' => array('img'=>'lg-addthis-en.gif', 'w'=>125, 'h'=>16),
                      'share-small' => array('img'=>'sm-share-%lang%.gif', 'w'=>83, 'h'=>16),
                      'bookmark-small' => array('img'=>'sm-bookmark-en.gif', 'w'=>83, 'h'=>16),
                      'plus' => array('img'=>'sm-plus.gif', 'w'=>16, 'h'=>16)
                      /* Add your own style here, like this:
                        , 'custom' => array('img'=>'http://example.com/button.gif', 'w'=>16, 'h'=>16) */
                    );


/**
* Adds WP filter so we can append the AddThis button to post content.
*/
function addthis_init($username=null, $style=null)
{
    global $addthis_settings;

    add_filter('the_content', 'addthis_social_widget');
    add_filter('admin_menu', 'addthis_admin_menu');

    add_option('addthis_username');
    add_option('addthis_options', 'email, favorites, digg, delicious, myspace, google, facebook, reddit, live, more');
    add_option('addthis_isdropdown', 'true');
    add_option('addthis_showonhome', 'true');
    add_option('addthis_showonpages', 'false');
    add_option('addthis_showoncats', 'false');
    add_option('addthis_showonarchives', 'false');
    add_option('addthis_style');
    add_option('addthis_header_background');
    add_option('addthis_header_color');
    add_option('addthis_sidebar_only', 'false');
    add_option('addthis_brand');
    add_option('addthis_language', 'en');

    $addthis_settings['sidebar_only'] = get_option('addthis_sidebar_only') === 'true';
    $addthis_settings['isdropdown'] = get_option('addthis_isdropdown') === 'true';
    $addthis_settings['showonhome'] = !(get_option('addthis_showonhome') !== 'true');
    $addthis_settings['showonpages'] = get_option('addthis_showonpages') === 'true';
    $addthis_settings['showonarchives'] = get_option('addthis_showonarchives') === 'true';
    $addthis_settings['showoncats'] = get_option('addthis_showoncats') === 'true';
    
    if (!isset($style)) $style = get_option('addthis_style');
    if (strlen($style) == 0) $style = 'share';
    $addthis_settings['style'] = $style;

    if (!isset($username)) $username = get_option('addthis_username');
    $addthis_settings['username'] = $username;

    $language = get_option('addthis_language');
    $addthis_settings['language'] = $language;

    $advopts = array('brand', 'language', 'header_background', 'header_color', 'options');
    $addthis_settings['customization'] = '';
    for ($i = 0; $i < count($advopts); $i++)
    {
        $opt = $advopts[$i];
        $val = get_option("addthis_$opt");
        if (isset($val) && strlen($val)) $addthis_settings['customization'] .= "var addthis_$opt = '$val';";
    }

    add_action('widgets_init', 'addthis_widget_init');
}

function addthis_widget_init()
{
    if ( function_exists('register_sidebar_widget') )
        register_sidebar_widget('AddThis Widget', 'addthis_sidebar_widget');
}

function addthis_sidebar_widget($args) 
{
    extract($args);
    echo $before_widget; 
    echo $before_title . $after_title . addthis_social_widget('', true);
    echo $after_widget;
}

/**
* Appends AddThis button to post content.
*/
function addthis_social_widget($content, $sidebar = false)
{
    global $addthis_settings;

    // add nothing to RSS feed or search results; control adding to static/archive/category pages
    if (!$sidebar) 
    {
        if ($addthis_settings['sidebar_only'] == 'true') return $content;
        else if (is_feed()) return $content;
        else if (is_search()) return $content;
        else if (is_home() && !$addthis_settings['showonhome']) return $content;
        else if (is_page() && !$addthis_settings['showonpages']) return $content;
        else if (is_archive() && !$addthis_settings['showonarchives']) return $content;
        else if (is_category() && !$addthis_settings['showoncats']) return $content;
    }

    $pub = $addthis_settings['username'];
    $link  = $sidebar ? '[URL]' : urlencode(get_permalink());
    $title = $sidebar ? '[TITLE]' : urlencode(get_the_title($id));

    $content .= "\n<!-- AddThis Button BEGIN -->\n";
    if ($addthis_settings['isdropdown'])
    {
        if (isset($pub) || strlen($addthis_settings['customization'])) 
        {
            $content .= '<script type="text/javascript">' . (isset($pub) ? "\nvar addthis_pub = '$pub';\n" : "\n") . ($addthis_settings['customization']) . "\n</script>\n";
        }
        $content .= <<<EOF
<div class="addthis_container"><a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, '', '$link', '$title')" onmouseout="addthis_close()" onclick="return addthis_sendto()">
EOF;
        $content .= addthis_get_button_img() . '</a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script></div>';
    }
    else
    {
        $content .= <<<EOF
<div class="addthis_container"><a href="http://www.addthis.com/bookmark.php?v=20" onclick="window.open('http://www.addthis.com/bookmark.php?v=20&pub=$pub&amp;url=$link&amp;title=$title', 'addthis', 'scrollbars=yes,menubar=no,width=620,height=520,resizable=yes,toolbar=no,location=no,status=no'); return false;" title="Bookmark using any bookmark manager!" target="_blank">
EOF;
        $content .= addthis_get_button_img() . '</a></div>';
    }
    $content .= "\n<!-- AddThis Button END -->";
    return $content;
}

/**
* Generates img tag for share/bookmark button.
*/
function addthis_get_button_img()
{
    global $addthis_settings;
    global $addthis_styles;

    $btnStyle = $addthis_settings['style'];
    if ($addthis_settings['language'] != 'en')
    {
        // We use a translation of the word 'share' for all verbal buttons
        switch ($btnStyle)
        {   
            case 'bookmark':
            case 'addthis':
            case 'bookmark-sm':
                $btnStyle = 'share';
        }
    }

    if (!isset($addthis_styles[$btnStyle])) $btnStyle = 'share';
    $btnRecord = $addthis_styles[$btnStyle];
    $btnUrl = (strpos(trim($btnRecord['img']), 'http://') !== 0 ? "http://s7.addthis.com/static/btn/" : "") . $btnRecord['img'];
         
    if (strpos($btnUrl, '%lang%') !== false)
    {
        $btnUrl = str_replace('%lang%',$addthis_settings['language'], $btnUrl);
    }
    $btnWidth = $btnRecord['w'];
    $btnHeight = $btnRecord['h'];
    return <<<EOF
<img src="$btnUrl" width="$btnWidth" height="$btnHeight" border="0" alt="Bookmark and Share"/>
EOF;
}

function addthis_admin_menu()
{
    add_options_page('AddThis Plugin Options', 'AddThis', 8, __FILE__, 'addthis_plugin_options_php4');
}

function addthis_plugin_options_php4() {
    global $addthis_styles;
    global $addthis_languages;
    global $addthis_settings;

?>
    <div class="wrap">
    <h2>AddThis</h2>

    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options'); ?>

    <h3>Required</h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row"><?php _e("AddThis username:", 'addthis_trans_domain' ); ?></th>
            <td><input type="text" name="addthis_username" value="<?php echo get_option('addthis_username'); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Button style:", 'addthis_trans_domain' ); ?></th>
            <td>
                <select name="addthis_style">
                <?php
                    $curstyle = get_option('addthis_style');
                    foreach ($addthis_styles as $style => $info)
                    {
                        echo "<option value=\"$style\"". ($style == $curstyle ? " selected":""). ">$style</option>";
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Use dropdown menu:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_isdropdown" value="true" <?php echo (get_option('addthis_isdropdown') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Show in sidebar only:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_sidebar_only" value="true" <?php echo (get_option('addthis_sidebar_only') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
    </table>
    
    <br />
    <br />
    <br />

    <h3>Advanced</h3>
    <table class="form-table">
        <tr valign="top">
            <td colspan="2">See <a href="http://addthis.com/customization">our customization docs</a>.</td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Show on <a href=\"http://codex.wordpress.org/Pages\" target=\"blank\">pages</a>:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_showonpages" value="true" <?php echo (get_option('addthis_showonpages') !== '' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Show on homepage:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_showonhome" value="true" <?php echo (get_option('addthis_showonhome') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Show in archives:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_showonarchives" value="true" <?php echo (get_option('addthis_showonarchives') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr>
            <th scope="row"><?php _e("Show in categories:", 'addthis_trans_domain' ); ?></th>
            <td><input type="checkbox" name="addthis_showoncats" value="true" <?php echo (get_option('addthis_showoncats') == 'true' ? 'checked' : ''); ?>/></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Brand:", 'addthis_trans_domain' ); ?></th>
            <td><input type="text" name="addthis_brand" value="<?php echo get_option('addthis_brand'); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Drop-down options (comma-separated):", 'addthis_trans_domain' ); ?></th>
            <td><input type="text" name="addthis_options" value="<?php echo get_option('addthis_options'); ?>" size="100"/></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Language:", 'addthis_trans_domain' ); ?></th>
            <td>
                <select name="addthis_language">
                <?php
                    $curlng = get_option('addthis_language');
                    foreach ($addthis_languages as $lng=>$name)
                    {
                        echo "<option value=\"$lng\"". ($lng == $curlng ? " selected":""). ">$name</option>";
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Header background:", 'addthis_trans_domain' ); ?></th>
            <td><input type="text" name="addthis_header_background" value="<?php echo get_option('addthis_header_background'); ?>" /></td>
        </tr>
        <tr valign="top">
            <th scope="row"><?php _e("Header color:", 'addthis_trans_domain' ); ?></th>
            <td><input type="text" name="addthis_header_color" value="<?php echo get_option('addthis_header_color'); ?>" /></td>
        </tr>
    </table>

    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="addthis_username,addthis_style,addthis_sidebar_only,addthis_isdropdown,addthis_showonpages,addthis_showoncats,addthis_showonhome,addthis_showonarchives,addthis_language,addthis_brand,addthis_options,addthis_header_background,addthis_header_color"/>

    <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
    </p>

    </form>
    </div>
<?php
}

addthis_init();
?>
