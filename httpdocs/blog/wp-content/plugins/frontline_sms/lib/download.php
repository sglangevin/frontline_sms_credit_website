<?php

class Download {
  static $table_name = "frontline_sms_downloads";
  static $column_names = array();
  
  protected $id = null;
  public $errors = array();
  protected $attributes = array();
  
  public function __construct($data = null){
    if(is_array($data)){
      $this->set_attributes($data);
    }else if(is_int($data)){
      $this->id = $data;
    }
  }
  public static function db(){
    global $wpdb;
    return $wpdb;
  }
  public function __toString(){
    $att = $this->attributes;
    $att['id'] = $this->id;
    return var_export($att, true);
  }
  public function before_save(){
    if($this->new_record()){
      $this->unique_link = md5((rand() * 1000000) . $this->email);
    }
    return true;
  }
  public function new_record(){
    return !isset($this->id) || $this->id <= 0;
  }
  public function save(){
    if($this->valid()){
      $this->set_timestamps();
      $this->before_save();
      if($this->new_record()){
        self::db()->insert(self::$table_name, $this->attributes);
        $this->id = self::db()->insert_id;
        return !$this->new_record();
      }else{
        return self::db()->update(
          self::$table_name, 
          $this->attributes, 
          array("id" => $this->id)
        );
      }
    }
  }
  public function send_email(){
    $path = preg_match("/\?/",$_SERVER['REQUEST_URI']) ?
      $_SERVER['REQUEST_URI'] . "&key={$this->unique_link}" : 
      $_SERVER['REQUEST_URI'] . "?key={$this->unique_link}";
    
    $body = <<<EOD
    <p>Dear {$this->name},</p>

    <p>Congratulations on becoming one of the first users of PaymentView! 
      Thank you for providing your organization's contact information. We hope 
      to learn from our beta user community, so stay tuned for updates from   
      the FrontlineSMS:Credit team.</p>
      
    <p><a href="http://{$_SERVER['SERVER_NAME']}{$path}">
      CLICK HERE TO DOWNLOAD PAYMENTVIEW</a></p>

    <p>Once FrontlineSMS + PaymentView has finished downloading, double-click 
      on the file to run the installer. See the User Guide for more 
      information on how to get started with PaymentView. If you have any 
      questions or problems, please visit our user forum to request support. 
      We'd also love to hear your feedback! Email us at   
      info@credit.frontlinesms.com with comments or suggestions.</p>

    <p>-The FrontlineSMS:Credit Team</p>
EOD;
    mail($this->email, "Your FrontlineSMS:Credit Download", $body);
  }
  public function valid(){
    $this->errors = array();
    # required fields
    foreach(array("name", "email", "organization", "title") as $field){
      if(empty($this->attributes[$field])){
        $title = ucwords($field);
        $this->add_error($field, "{$title} is required");
      }
    }
    # recaptcha
    $resp = recaptcha_check_answer (
      FrontlineSMS::RECAPTCHA_PRIVATE_KEY,
      $_SERVER["REMOTE_ADDR"],
      $_POST["recaptcha_challenge_field"],
      $_POST["recaptcha_response_field"]
    );
    if(!$resp->is_valid){
      $this->add_error(
        "recaptcha", 
        "You did not correctly enter the RECAPTCHA."
      );
    }
    return count($this->errors) == 0;
  }
  protected function add_error($field, $error){
    if(!isset($this->errors[$field])){
      $this->errors[$field] = array();
    }
    array_push($this->errors[$field], $error);
  }
  public function after_save(){
    return true;
  }
  public function set_attributes($data){
    foreach($data as $key => $val){
      $this->{$key} = $val;
    }
    return $data;
  }
  public static function column_names(){
    if(count(self::$column_names) == 0){
      $table = self::$table_name;
      foreach(self::db()->get_results("DESCRIBE {$table}") as $row){
        array_push(self::$column_names, $row->Field);
      }
    }
    return self::$column_names;
  }
  public function __set($key, $val){
    if(in_array($key, self::column_names())){
      return $this->attributes[$key] = $val;
    }
    throw new Exception(
      "{$key} is not a valid attribute, valid attributes are " . 
        join(self::column_names(), ", ")
    );
  }
  public function __get($key){
    if(in_array($key, self::column_names())){
      if(!isset($this->attributes[$key])){
        $this->attributes[$key] = null;
      }
      return $this->attributes[$key];
    }
    throw new Exception(
      "{$key} is not a valid attribute" . join(self::column_names(), ", ")
    );
  }
  
  protected function set_timestamps(){
    if($this->new_record()){
      if(in_array("created_at", self::column_names())){
        $this->created_at = gmstrftime("%Y-%m-%d %H:%M:%S");
      }
    }
    if(in_array("updated_at", self::column_names())){
      $this->updated_at = gmstrftime("%Y-%m-%d %H:%M:%S");
    }
    return true;
  }
}


?>