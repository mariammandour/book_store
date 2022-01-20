<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);

    $errors = [];


    # Validate Email
    if (!Validate($email, 1)) {
        $errors['Email'] = 'Field Required';
    } elseif (!Validate($email, 2)) {
        $errors['Email'] = 'Invalid Email';
    }

    # Validate Password
    if (!Validate($password, 1)) {
        $errors['Password'] = 'Field Required';
    } elseif (!Validate($password, 3)) {
        $errors['Password'] = 'Length must be >= 6 chars';
    }

    if (count($errors) > 0) {
        # Print Errors
        print_r($errors);
    } else {
        # Logic ....... 

        $password = md5($password);

        $sql = "select * from users where email = '$email' and password = '$password'";
        $op  = mysqli_query($con, $sql);

        if (mysqli_num_rows($op) == 1) {
            // code .... 
            $data = mysqli_fetch_assoc($op);

            $_SESSION['user'] = $data;

            if($data['user_type_id']==3){
                header("Location: ../../index.php");
            }else{
                header("Location: ../../Admin/index.php");
            }
        } else {
            echo '* Error in Email || Password Try Again !!!!';
        }
    }
}

?>



<body>
    <!-- start login -->
    <section class="row" id="login">
        <div class="col-lg-5" id="first">
            <h1 class="font-weight-bolder mb-3">Buy it and <span>Read!</span></h1>
            <P>Book unforgettable cars from trusted hosts.</P>
            <form  action = "<?php   echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <div class="text d-flex ">
                    <label for="email" class="justify-content-center"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                    <input type="email" id="email" name="email" placeholder="email">
                </div>
                <div class="text d-flex ">
                    <label for="password" class="justify-content-center"><i class="fa fa-lock" aria-hidden="true"></i></label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div>
                <div class="submit d-flex justify-content-center">
                    <input type="submit" value="login">
                </div>
            </form>
            <P class="pt-1">New to book store? <a href="signup.php"><span>Sign Up</span></P></a>
            <P class="pt-1"><a href="logout.php"><span>Logout</span></P></a>
        </div>
        <div class="col-lg-7 d-none d-lg-block" id="second">
            <img src="../image/10.jpg">
        </div>
    </section>
    <!-- end login -->
    <?php 
    require '../layouts/end.php';
    ?>