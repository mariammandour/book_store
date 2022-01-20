<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
$sql = 'select * from user_type';
$op = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name     = $_POST['name'];
    $mobile   = $_POST['phone'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $address  = $_POST['address'];


    //name
    if (empty($name)) {
        echo "name required";
    }

    //mobile
    if (empty($mobile)) {
        echo "required";
    }

    //email
    if (empty($email)) {
        echo "required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "should be an email";
    }

    //password
    if (empty($password)) {
        echo "required";
    } elseif (strlen($password) < 6) {
        echo "password length should be >6";
    }

    //address
    if (empty($address)) {
        echo "required";
    }

    //check
    if (!empty($name && $mobile && $email && $password && $address) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        //code
        $password = md5($password);
        $sql = "insert into users (name,password,mobile,email,address,user_type_id) values ('$name','$password','$mobile','$email','$address',3)";
        $opl = mysqli_query($con, $sql);

        if ($opl) {
            echo "raw inserted";
        } else {
            echo "Error Try Again" . mysqli_error($con);
        }

        header('Location: ../../index.php');
    }
}

?>

<body>

    <!-- start signup -->
    <section class="row" id="signup">
        <div class="col-lg-5" id="first">
            <h1 class="font-weight-bolder mb-3">Buy it and <span>Read!</span></h1>
            <P>Book unforgettable cars from trusted hosts.</P>
            <form action="#" method="post">
                <div class="text d-flex ">
                    <label for="name" class="justify-content-center"><i class="fa fa-user" aria-hidden="true"></i></label>
                    <input type="name" id="name" name="name" placeholder="name">
                </div>

                <div class="text d-flex ">
                    <label for="phone" class="justify-content-center"><i class="fa fa-phone" aria-hidden="true"></i></label>
                    <input type="name" id="phone" name="phone" placeholder="phone">
                </div>
                <div class="text d-flex ">
                    <label for="address" class="justify-content-center"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                    <input type="name" id="address" name="address" placeholder="address">
                </div>

                <div class="text d-flex ">
                    <label for="email" class="justify-content-center"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                    <input type="email" id="email" name="email" placeholder="email">
                </div>
                <div class="text d-flex">
                    <label for="password" class="justify-content-center"><i class="fa fa-lock" aria-hidden="true"></i></label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>

                <P class="plast">By creating account you’ll accept our <a href="#"><span>Privacy policies</span></P></a>
                <div class="d-flex submit">
                    <input type="submit" value="Create account">
                </div>
            </form>
            <P class="pt-1">Have an account? <a href="login.php"><span>login.</span></a></P>
        </div>
        <div class="col-lg-7 d-none d-lg-block" id="second">
            <img src="../image/29.jpg">
        </div>
    </section>
    <!-- end signup -->
    <?php
    require '../layouts/end.php';
    ?>