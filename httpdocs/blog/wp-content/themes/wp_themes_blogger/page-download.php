<?php
// attempt to download the file. If we are unsuccessful, we set an error message for the user
if(isset($_GET['key'])){
  $row = Download::db()->get_results(Download::db()->prepare("SELECT * FROM frontline_sms_downloads WHERE unique_link = %s", $_GET['key']));
  if(count($row) > 0){
    // expires two days from creation
    $expires = strtotime($row[0]->created_at) + (2 * 24 * 60 * 60);
    if($expires < time()){
      $file_download_error = "Your link has expired.  Please submit the " .
        "form below to complete your download";
    }else{
      ob_clean();
      $file = dirname(__FILE__) . 
        "/../../plugins/frontline_sms/frontline.txt";
        
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      ob_clean();
      flush();
      readfile($file);
      exit;
    }
  }else{
    $file_download_error = "We were unable to find a unique link by that ".
      "name.  Please submit the form below to complete your download.";
  }
}

// Some terrible violation of MVC here, but it should still work
if(sizeof($_POST) > 0){
  $download = new Download($_POST['download']);
  if($download->save()){
    $download->send_email();
    header("Location: {$_SERVER['REQUEST_URI']}&success=1");
    exit(0);
  }
}else{
  $download = new Download(array('newsletter' => 1, 'user_map' => 1, 'feedback' => 1));
}

?>

<?php get_header(); ?>
        <div id="content">
            <div id="postarea">
		    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="postcontent">
            <div class="postcontent_in">

                <div class="post">
                  <?php if(isset($_GET['success'])) : ?>
                    <p>
                      Thank you for submitting your information.  Your download link has been sent to the e-mail address
                      that you provided.
                    </p>
                  <?php else :?>                    
                    <h1>Download FrontlineSMS</h1>
                    <form method="POST">
                      <?php if(count($download->errors) > 0 || isset($file_download_error)) : ?>
                        <ul class="errors">
                          <?php if(isset($file_download_error)) : ?>
                            <li><?php echo $file_download_error ?>
                          <?php endif; ?>
                          <?php foreach($download->errors as $field => $errors) : ?>
                            <?php foreach($errors as $error) : ?>
                              <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                          <?php endforeach; ?>
                        </ul>
                      <?php endif; ?>
              
                      <ul class="form">
<!--                        $fields = array(
                          "name", "organization", "title", "email", 
                          "location", "category_of_work",
                          "payment_view_use", "focus_of_work"
                        ); -->						
                        <li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "name", "Name *"); ?>
                          <br/>
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "name"); ?>
                        </li>
                        <li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "organization", "Organization *"); ?>
                          <br/>
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "organization"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "title", "Title"); ?>
                          <br/>
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "title"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "email", "Email *"); ?>
                          <br/>
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "email"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "location", "Location *"); ?>
                          <br/>
                          <span class="small">City, Country</span>
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "location"); ?>
                        </li>
                        <li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "category_of_work", "Category of Work *"); ?>
                          <br/>
                          <span class="small">Please choose from the following list of sectors to describe the kind of work that your organization does.</span>
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "category_of_work"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "payment_view_use", "PaymentView Use *"); ?>
                          <br/>
                          <span class="small">How do you plan to use FrontlineSMS and PaymentView? We appreciate it if you can share as much detail as possible.</span>
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "payment_view_use"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "hear_about_us", "How did you hear about us?"); ?>                          
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "hear_about_us"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "user_map", "Map *"); ?>
                          <br/>
                          <span class="small">Can we add you to the Who Uses it map?</span>
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "user_map"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "feedback", "Feedback *"); ?>
                          <br/>
                          <span class="small">Can we count on you for bug reports and feedback?</span>
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->text_field($download, "feedback"); ?>
                        </li>
						<li>
                          <?php echo FrontlineSMS::get_instance()->label($download, "newsletter", "Would you like to sign up for our newsletter?"); ?>                          
						  <br/>						  
                          <?php echo FrontlineSMS::get_instance()->radio_button($download, "newsletter", 1); ?>
						  Yes
						  <?php echo FrontlineSMS::get_instance()->radio_button($download, "newsletter", 0); ?>
						  No
                        </li>
						<li>
                          <?php echo recaptcha_get_html(FrontlineSMS::RECAPTCHA_PUBLIC_KEY); ?>
                        <li>
                          <button id="submit">Submit</button>
                        </li>
                      </div>
                    </form>
                  <?php endif; ?>
                  <div class="clear"></div>
                </div>
                </div>
            </div>

            <?php endwhile; endif; ?>

            </div>

            <?php get_sidebar(); ?>

            </div>
<?php get_footer(); ?>