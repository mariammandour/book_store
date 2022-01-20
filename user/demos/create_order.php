<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require 'checkLogin.php';

$id=$_GET['id'];
$sql = "select * from books where id = $id";
$op = mysqli_query($con, $sql);
$user=$_SESSION['user']['id'];
if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
    $sql = "INSERT INTO `orders`(`book_id`, `user_id`) VALUES ('$id','$user')";
    $op = mysqli_query($con, $sql);
    if($op){
        header("Location: order.php");
    }
} else {
    $_SESSION['Message'] = ["Message" => "Invalid Id"];
    header("Location: ../../index.php");
    exit();
}
    require '../layouts/end.php';
?>
