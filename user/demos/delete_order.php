<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require 'checkLogin.php';
# Fetch Id .... 
$id = $_GET['id'];

$sql = "select * from orders where id = $id";
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);
# Check If Count == 1 
if (mysqli_num_rows($op) == 1) {

    // delete code ..... 
    $sql = "delete from orders where id = $id";
    $op  = mysqli_query($con, $sql);

    if ($op) {
        unlink($data['image']);
        $Message = ["Message" => "Raw Removed"];
    } else {
        $Message = ["Message" => "Error try Again"];
    }
} else {
    $Message = ["Message" => "Invalid Id "];
}

#   Set Session 
$_SESSION['Message'] = $Message;

header("location: order.php");
?>