<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
require 'checkLogin.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $comment = Clean($_POST['comment']);

    # Validate comment .... 
    $errors = [];

    if (!Validate($comment, 1)) {
        $errors['comment'] = "Required Field";
    }
    $Message=[];
    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        $user=$_SESSION['user']['id'];
        $sql = "INSERT INTO `review`( `comment`,`article_id`,user_id) VALUES ('$comment',$id,$user)";
        $op  = mysqli_query($con, $sql);
        if ($op) {
            // $Message = ['Message' => 'Raw Updated'];
            header("location: comment.php?id=$id");
        } else {
            // $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
        }
    }
    # Set Session ...... 
    // $_SESSION['Message'] = $Message;
}
?>