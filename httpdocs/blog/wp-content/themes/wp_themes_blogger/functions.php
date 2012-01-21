<?php

add_filter('comments_template', 'legacy_comments');

function legacy_comments($file) {

	if(!function_exists('wp_list_comments')) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/legacy.comments.php';
	endif;

	return $file;
}

?>
<?php
 if ( function_exists('register_sidebar') )
register_sidebar(array('name'=>'Article Sidebar','before_widget' => '<div class="widget">','after_widget' => '</div>','before_title' => '<h2>','after_title' => '</h2>',));

$themename = "Wp Themes Blogger";
$shortname = "tc";
$options = array (
	array(	"name" => "General Options",
			"type" => "heading"),
    array(	"name" => "Contact Form Email",
			"desc" => "To use the contact form write a static page and select the 'Contact Page' tamplate.<br /><br />",
			"id" => $shortname."_contact_mail",
			"std" => "",
            "type" => "text"),
    array(	"name" => "Show Trackback list?",
			"desc" => "Check this box if you want to show trackback list in posts.<br /><br />",
			"id" => $shortname."_trackback",
			"std" => "false",
            "type" => "checkbox"),
    array(	"name" => "Show Featured Content?",
			"desc" => "Check this box if you want to show featured content on homepage.<br /><br />",
			"id" => $shortname."_feat_check",
			"std" => "false",
            "type" => "checkbox"),
    array(	"name" => "Featured Content IMG",
			"desc" => "Insert here the featured image path. Link to direct location (width: 600px).<br /><br />",
			"id" => $shortname."_feat_content",
			"std" => "",
            "type" => "text"),
    array(	"name" => "Featured Content Link",
			"desc" => "Insert the link for the image from featured content.<br /><br />",
			"id" => $shortname."_feat_link",
			"std" => "",
            "type" => "text"),
	array(	"name" => "FeedBurner Settings",
			"type" => "heading"),
    array(	"name" => "Show FeedBurner RSS?",
			"desc" => "Check this box if you want to use FeedBurner RSS instead of WordPress RSS.<br /><br />",
			"id" => $shortname."_feed_rss_check",
			"std" => "false",
            "type" => "checkbox"),
    array(	"name" => "Feedburner RSS feed",
			"desc" => "Insert your FeedBurner RSS feed without http://feeds.feedburner.com/.<br /><br />",
			"id" => $shortname."_feed_rss",
			"std" => "Enter Feedburner RSS Feed Here",
            "type" => "text"),
    array(	"name" => "Show NewsLetter?",
			"desc" => "Check this box if you want to show FeedBurner NewsLetter in the sidebar.<br /><br />",
			"id" => $shortname."_feed_check",
			"std" => "false",
            "type" => "checkbox"),
    array(	"name" => "Feedburner ID",
			"desc" => "Go to <a href='http://www.feedburner.com'>FeedBurner</a> to get a NewsLetter ID.<br /><br />",
			"id" => $shortname."_feed",
			"std" => "Enter Feedburner Email Subscribe ID Here",
            "type" => "text"),
	array(	"name" => "Advertisment",
			"type" => "heading"),
    array(	"name" => "Show Ad box?",
			"desc" => "Check this box if you want to show Ad box in the sidebar.<br /><br />",
			"id" => $shortname."_ad_check",
			"std" => "false",
            "type" => "checkbox"),
	array(	"name" => "Ad 1 Image",
			"id" => $shortname."_ad1",
			"std" => "http://www.wp-them.es/img/125ad.png",
            "desc" => "Insert here the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 1 Link",
			"id" => $shortname."_ad1_link",
			"std" => "http://www.wp-them.es/",
            "desc" => "Insert here the link for the banner",
			"type" => "text"),
	array(	"name" => "Ad 2 Image",
			"id" => $shortname."_ad2",
			"std" => "http://www.wp-them.es/img/125ad.png",
            "desc" => "Insert here the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 2 Link",
			"id" => $shortname."_ad2_link",
			"std" => "http://www.wp-them.es/",
            "desc" => "Insert here the link for the banner",
			"type" => "text"),
	array(	"name" => "Ad 3 Image",
			"id" => $shortname."_ad3",
			"std" => "http://www.wp-them.es/img/125ad.png",
            "desc" => "Insert here the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 3 Link",
			"id" => $shortname."_ad3_link",
			"std" => "http://www.wp-them.es/",
            "desc" => "Insert here the link for the banner",
			"type" => "text"),
	array(	"name" => "Ad 4 Image",
			"id" => $shortname."_ad4",
			"std" => "http://www.wp-them.es/img/125ad.png",
            "desc" => "Insert here the image path for the banner (125x125 pixels)",
			"type" => "text"),
	array(	"name" => "Ad 4 Link",
			"id" => $shortname."_ad4_link",
			"std" => "http://www.wp-them.es/",
            "desc" => "Insert here the link for the banner",
			"type" => "text"),
);
function mytheme_add_admin() {
	global $themename, $shortname, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
				foreach ($options as $value) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
				foreach ($options as $value) {
					if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				header("Location: themes.php?page=functions.php&saved=true");
				die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				delete_option( $value['id'] ); }
			header("Location: themes.php?page=functions.php&reset=true");
			die;
		}
	}
    add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
	global $themename, $shortname, $options;
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>
<form method="post">
<table class="optiontable">
<?php foreach ($options as $value) {
if ($value['type'] == "text") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?>:</th>
	<td>
		<input style="width:500px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
        <br /><?php echo $value['desc']; ?>
    </td>
</tr>
<?php } elseif ($value['type'] == "textarea") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?>:</th>
	<td>
				<textarea style="width:500px;height:100px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" ><?php
				if( get_settings($value['id']) != "") {
						echo stripslashes(get_settings($value['id']));
					}else{
						echo $value['std'];
				}?></textarea>
        <br /><?php echo $value['desc']; ?>
	</td>
</tr>
<?php } elseif ($value['type'] == "checkbox") {  ?>
<tr valign="top">
	<th scope="row"><?php echo $value['name']; ?></th>
	<td>
	    <?php if(get_settings($value['id'])){
		    $checked = "checked=\"checked\"";
			    }else{
			$checked = "";
				}
		?>
		    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
        <?php echo $value['desc']; ?>
	</td>
</tr>
<?php } elseif ($value['type'] == "heading") {  ?>
<tr valign="top">
	<th scope="row"></th>
	<td>
        <h3><?php echo $value['name']; ?></h3>
	</td>
</tr>
<?php
}
}
?>
</table>
<p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>
<?php
function content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo "<a href='";
        the_permalink();
        echo "'>"."..."."</a>";
        echo "<br><br>";
   }
   else {
      echo $content;
   }
}

?>