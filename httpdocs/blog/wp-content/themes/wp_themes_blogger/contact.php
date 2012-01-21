<?php
/*
Template Name: Contact Page
*/
?>
<?php get_header(); ?>
        <div id="content">
            <div id="postarea">
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="postcontent">
            <div class="postcontent_in">

                <div class="post">
			    <h2><?php the_title(); ?></h2>

                    <div class="post">
                        <?php the_content(__('Read more'));?>
                    </div>
                <div class="clear"></div>
                </div>
<?php
    $to         = get_option('tc_contact_mail');
    $cName      = $_POST['cName'];
    $cMail      = $_POST['cMail'];
    $cWeb       = $_POST['cWeb'];
    $cCheck     = $_POST['cCheck'];
    $cMessage   = $_POST['cMessage'];
    $pageurl    = $_POST['loc'];
function outputform() {
$pageurl = htmlentities($_GET['loc']);
?>
<div id="cForm">
<fieldset>
    <legend>Contact Form</legend>
<form method="post">
    <p>Please use the form below to send us a message. Fields marked with * are required.</p>

    <p><input type="text" name="cName" id="cName" size="22" value="<?php echo "$_POST[cName]"; ?>" />
    <label for="cName"><strong>Full Name *</strong></label></p>

    <p><input type="text" name="cMail" id="cMail" size="22" value="<?php echo "$_POST[cMail]"; ?>" />
    <label for="cMail"><strong>Email Address *</strong></label></p>

    <p><input type="text" name="cWeb" id="cWeb" size="22" value="<?php echo "$_POST[cWeb]"; ?>" />
    <label for="cWeb">Website URL</label></p>

    <p>
    <label for="cWeb"><strong>3 plus 8? *</strong></label>
    <input type="text" name="cCheck" id="cCheck" value="<?php echo "$_POST[cCheck]"; ?>" />
    <label for="cWeb">Spam prevention (are you human?)</label></p>

    <p><label for="cMessage">Your Message * :</label></p>
    <p><textarea name="cMessage" rows="7" id="cMessage"><?php echo "$_POST[cMessage]"; ?></textarea></p>

    <input type="hidden" id="loc" name="loc" value="<?php echo "$pageurl"; ?>" />
    <p><input type="submit" id="cSubmit" name="cSubmit" value="Submit My Message"></p>
</form>
</fieldset>
</div>

<?php
}
if ($_POST['cSubmit']) {
	if (($cName=="") || ($cMail=="") || ($cMessage==""))  {
print "<div class='error'><p>Error: Fill in all required fields.</p></div>";
outputform();
	}
	else {
	  if (!eregi("^[a-z0-9]+([-_\.]?[a-z0-9])+@[a-z0-9]+([-_\.]?[a-z0-9])+\.[a-z]{2,4}", $cMail)) {
      print("<div class='error'><p>Error: The Email address is not valid.</p></div>");
		  outputform();
		  exit;
    }
	  if (($cCheck!="11"))  {
      print "<div class='error'><p>Error: you failed the spam check.</p></div>";
		  outputform();
		  exit;
    }
	$cMessage = stripslashes($cMessage);
	mail("$to","New message sent by $cName","\n\n$cName Has sent you a message. \n\nEmail: $cMail \n\nURL: $cWeb \n\n The Message: \n------------------------------------ \n$cMessage \n------------------------------------\n\n");
  echo "<div class='success'><p>Thank you, we have received your message and will be in touch if required.</p></div>";
}
}
else {
?>
<?php
outputform();
}
?>
                </div>
            </div>

            <?php endwhile; else: ?>

        <div class="homepage_post">
            <div class="homepage_in">
                <h3 style="margin-bottom:800px;"><?php _e('Sorry, no posts matched your criteria.'); ?></h3>
            </div>
        </div>

            <?php endif; ?>

            </div>

                <?php get_sidebar(); ?>

            </div>
<?php get_footer(); ?>