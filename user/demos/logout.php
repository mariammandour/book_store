<?php 

session_start();
require '../../Admin/helpers/functions.php';

 //require 'checkLogin.php';

session_destroy();

header("location: ".'http://'.$_SERVER['HTTP_HOST'].'/book_store/index.php');


?>