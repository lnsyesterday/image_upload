<?php 
require_once('models/images.php');

class ImageController{
  public $per_page = 9;
  public function __construct(){
    $this->_image = new Images();
  }
  public function init(){
    if (isset($_POST["upload"])) {
      $this->upload();
    }
  }
  public function upload(){
    try {
      $name = $_FILES['image']['name'];
      $temp_name = $_FILES["image"]["tmp_name"];
      if($temp_name == ""){
        return;
      }
      $content = base64_encode(file_get_contents( $_FILES["image"]["tmp_name"] ));
      $image_text = $_POST['image_text'];
      $_POST = array();
      $_FILES = array();
      unset($_POST);
      unset($_FILES);
      
      $allowed =  array('gif','png' ,'jpg','jpeg');
      $ext = pathinfo($name, PATHINFO_EXTENSION);
      if(!in_array($ext,$allowed) ) {
          return;
      }

      $this->_image->create($image_text,$content);

       header('Location: index.php?page='.$this->get_current_page());

    } catch (Exception $e) {
      var_dump($e->getMessage());
    }
  }
  public function get_all(){
    $page = $this->get_current_page();
    $skip = $this->per_page * ($page-1);
    $count = $this->count();
    if($count == 0 || $skip>$count){
      return array();
    }
    $results =  $this->_image->select($this->per_page,$skip);
    if($results==null){
      $results = array();
    }
    return $results;
  }
  public function count(){
    return $this->_image->count()[0]["count"];
  }
  public function pages(){
     return $this->count()/$this->per_page + 1;
  }
  public function get_single($id){
    if($id==null || $id == ''){
      header('Location: index.php');
    }

    $image =  $this->_image->select_one($id)[0];
    return $image;
  }
  public function get_current_page(){
    $page = 1;
    if(isset($_GET["page"])){
      $page = $_GET["page"];
    }
    return $page;
  }
}
?>