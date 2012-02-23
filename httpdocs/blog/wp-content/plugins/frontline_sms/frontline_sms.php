<?php
/**
 * @package FrontlineSMS
 */
/*
Plugin Name: FrontlineSMS
Plugin URI: http://localhost.com/
Description: Custom Wordpress functionality for Frontline SMS
Version: 0.0.1
Author: Dan Langevin
Author URI: http://github.com/dlangevin
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once dirname(__FILE__) . '/vendor/recaptchalib.php';
require_once dirname(__FILE__) . '/lib/download.php';

class FrontlineSMS {
  
  const RECAPTHCA_PUBLIC_KEY = "6LfTjM0SAAAAAKlixrrcwjkAgsuz6ttqIj9nxCB9";
  const RECAPTHCA_PRIVATE_KEY = "6LfTjM0SAAAAADXi9HLyehqGKE1yN5ptiwH7ZiYf";
  
  
  private static $instance;
  
  public static function get_instance(){
    if(!self::$instance){
      self::$instance = new self();
    }
    return self::$instance;
  }
  
  
  private function __construct(){}
  
  public function activation(){
    $this->create_tables();
    $this->create_page();
  }
  public function deactivation(){
    $this->remove_page();
  }
  // form helper
  public function label($model, $field_name, $text = null){
    $model_name = strtolower(get_class($model));
    if(is_null($text)){
      $text = ucwords(str_replace('_',' ', $field_name)) . ":";
    }
    return "<label for='{$model_name}_{$field_name}'>{$text}</label>";
  }
  // form helper
  public function text_field($model, $field_name){
    $model_name = strtolower(get_class($model));
    $error_class = isset($model) && isset($model->errors[$field_name]) ? " error" : "";
    return "<input type='text' id='{$model_name}_{$field_name}' name='{$model_name}[{$field_name}]' value='{$model->{$field_name}}' class='inputfield{$error_class}' size=30/>";
  }
  
  /*
   * Accessor for DB
   */
  protected function render($template){
    ob_start();
    include "templates/{$template}.html.php";
    return ob_end_flush();
  }
  protected function db(){
    global $wpdb;
    return $wpdb;
  }
  protected function create_page(){
    // guid
    $title = "download";
    
    $the_page = get_page_by_title($title);

    if ($the_page) {
      // the plugin may have been previously active and the page may just be trashed...
      $the_page_id = $the_page->ID;

      //make sure the page is not trashed...
      $the_page->post_status = 'publish';
      $the_page_id = wp_update_post( $the_page );
    }
    else {
      // Create post object
      $p = array();
      $p['post_title'] = $title;
      $p['post_name'] = $title;
      $p['post_content'] = "This text may be overridden by the plugin. You shouldn't edit it.";
      $p['post_status'] = 'publish';
      $p['post_type'] = 'page';
      $p['comment_status'] = 'closed';
      $p['ping_status'] = 'closed';
      $p['post_category'] = array(1); // the default 'Uncatrgorised'

      // Insert the post into the database
      $the_page_id = wp_insert_post($p);
    }
    delete_option('download_page_id');
    add_option('download_page_id', $the_page_id );
  }
  protected function remove_page(){
    $the_page_id = get_option( 'download_page_id' );
    if($the_page_id) {
      wp_delete_post($the_page_id); // this will trash, not delete
    }
    delete_option('download_page_id');
  }
  /* Create database tables */
  protected function create_tables(){
    $sql = "
    CREATE TABLE IF NOT EXISTS frontline_sms_downloads (
      id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
      email varchar(255),
      created_at datetime,
      unique_link varchar(255),
      organization varchar(255),
      title varchar(255),
      location varchar(255),
      category_of_work varchar(255),
      focus_of_work mediumtext,
      payment_view_use mediumtext,
      name varchar(255),
      feedback mediumtext,
      use_map tinyint(1),
      how_heard_about_us mediumtext
    )";
    $this->db()->query($sql);
  }
}


$refl = new ReflectionClass("FrontlineSMS");
foreach($refl->getMethods(ReflectionMethod::IS_PUBLIC) as $m){
  // Dynamic method creation
  // E.g.
  // function frontline_sms_x(){
  //   $args = func_get_args();
  //   return call_user_func_array(array(FrontlineSMS::getInstance(), "x"), $args); 
  // }
  if(!$m->isStatic()){
    $code = <<<EOF
      function frontline_sms_{$m->name}(){
        \$args = func_get_args(); 
        return call_user_func_array(array(FrontlineSMS::get_instance(),"{$m->name}"), \$args);
      }
EOF;
    eval($code);
  }
}

register_activation_hook(__FILE__, 'frontline_sms_activation');
register_deactivation_hook(__FILE__, 'frontline_sms_deactivation');

?>

