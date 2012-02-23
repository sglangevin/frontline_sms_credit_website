<?php
// attempt to download the file. If we are unsuccessful, we set an error message for the user
if(isset($_GET['key'])){
  $row = Download::db()->get_results(Download::db()->prepare("SELECT * FROM frontline_sms_downloads WHERE unique_link = %s", $_GET['key']));
  if(count($row) > 0){
    // expires two days from creation
    $expires = strtotime($row[0]->created_at) + (2 * 24 * 60 * 60);
    if($expires < time()){
      $file_download_error = "Your link has expired.  Please submit the form below to complete your download";
    }else{
      ob_clean();
      $file = dirname(__FILE__) . "/../../plugins/frontline_sms/frontline.txt";
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
    $file_download_error = "We were unable to find a unique link by that name.  Please submit the form below to complete your download.";
  }
}

// Some terrible violation of MVC here, but it should still work
if(sizeof($_POST) > 0){
  $download = new Download($_POST['download']);
  if($download->save()){
    header("Location: {$_SERVER['REQUEST_URI']}&success=1");
    exit(0);
  }
}else{
  $download = new Download();
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
  			                    <li><?php echo $file_download_error ?>;
  			                  <?php endif; ?>
  			                  <?php foreach($download->errors as $field => $errors) : ?>
  			                    <?php foreach($errors as $error) : ?>
  			                      <li><?php echo $error; ?></li>
  			                    <?php endforeach; ?>
  			                  <?php endforeach; ?>
  			                </ul>
  			              <?php endif; ?>
  			              
  			              <ul class="form">
  			                <?php 
  			                  $fields = array(
  			                    "name", "organization", "title", "email", "location", "category_of_work",
  			                    "payment_view_use", "focus_of_work"
  			                  );
  			                  foreach($fields as $field) : ?>
  			                  <li>
    			                  <?php echo FrontlineSMS::get_instance()->label($download, $field); ?>
    			                  <br/>
    			                  <?php echo FrontlineSMS::get_instance()->text_field($download, $field); ?>
    			                </li>
			                
  			                <?php endforeach;?>
  			                <li>
  			                  <?php echo recaptcha_get_html(FrontlineSMS::RECAPTHCA_PUBLIC_KEY); ?>
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