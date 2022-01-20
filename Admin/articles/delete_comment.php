<?php

require '../helpers/dbConnection.php';
require '../helpers/checkLogin.php';

# Fetch Id .... 
$id = $_GET['id'];

$sql = "select * from review where id = $id";
$op  = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($op);
# Check If Count == 1 
if (mysqli_num_rows($op) == 1) {

    // delete code ..... 
    $sql = "delete from review where id = $id";
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

header("location: index.php");
?>