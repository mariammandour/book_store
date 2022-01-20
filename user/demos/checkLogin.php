<?php 

  if(!isset($_SESSION['user'])){
      header("Location: ".'http://'.$_SERVER['HTTP_HOST'].'/book_store/user/demos/login.php');
  }
  
?>