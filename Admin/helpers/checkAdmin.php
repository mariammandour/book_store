<?php 

  if($_SESSION['user']['user_type_id'] != 1){
    header("Location: ".'http://'.$_SERVER['HTTP_HOST'].'/book_store/user/demos/login.php');
  }

?>