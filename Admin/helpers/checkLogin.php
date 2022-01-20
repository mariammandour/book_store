<?php 

  if(!isset($_SESSION['user'])){
      header("Location: ".'http://'.$_SERVER['HTTP_HOST'].'/book_store/user/demos/login.php');
  }
  if($_SESSION['user']['user_type_id'] == 3){
    header("Location: ".'http://'.$_SERVER['HTTP_HOST'].'/book_store/user/demos/login.php');
}

?>