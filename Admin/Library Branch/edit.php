<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

############################################################################# 
$id = $_GET['id'];

$sql = "select * from library_branch where id = $id";
$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
} else {
    $_SESSION['Message'] = ["Message" => "Invalid Id"];
    header("Location: index.php");
    exit();
}

#########################################################################
# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $address = Clean($_POST['address']);
    $phone = $_POST['phone'];
    $email = Clean($_POST['email']);
    $facebook = Clean($_POST['facebook']);
    $twitter = Clean($_POST['twitter']);
    $linkedin = Clean($_POST['linkedin']);
    $instegram = Clean($_POST['instegram']);

    $errors = [];

    if (!Validate($address, 1)) {
        $errors['address'] = "Required Field";
    } elseif (!Validate($address, 6)) {
        $errors['address'] = "Invalid String";
    }

    if (!Validate($phone, 1)) {
        $errors['phone'] = "Required Field";
    } elseif (!Validate($phone, 9)) {
        $errors['phone'] = "Invalid phone";
    }

    if (!Validate($email, 1)) {
        $errors['email'] = "Required Field";
    } elseif (!Validate($email, 2)) {
        $errors['email'] = "Invalid Email";
    }

    if (!Validate($facebook, 1)) {
        $errors['facebook'] = "Required Field";
    } elseif (!Validate($facebook, 10)) {
        $errors['facebook'] = "Invalid facebook";
    }

    if (!Validate($linkedin, 1)) {
        $errors['linkedin'] = "Required Field";
    } elseif (!Validate($linkedin, 11)) {
        $errors['linkedin'] = "Invalid linkedin";
    }
    if (!Validate($twitter, 1)) {
        $errors['twitter'] = "Required Field";
    } elseif (!Validate($twitter, 12)) {
        $errors['twitter'] = "Invalid twitter";
    }
    if (!Validate($instegram, 1)) {
        $errors['instegram'] = "Required Field";
    } elseif (!Validate($instegram, 13)) {
        $errors['instegram'] = "Invalid instegram";
    }    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE .....

        $sql="UPDATE `library_branch` SET `address`='$address',`phone`='$phone',`email`='$email',
        `facebook`='$facebook',`linkedin`='$linkedin',`twitter`='$twitter',`instegram`='$instegram' WHERE id =$id";
        $op = mysqli_query($con, $sql);

        if ($op) {
            $Message = ['Message' => 'Raw Updated'];
        } else {
            $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
        }

        # Set Session ......
        $_SESSION['Message'] = $Message;
        header('Location: index.php');
        exit();
    }
    $_SESSION['Message'] = $Message;
}

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>



<div class="content-wrapper" style="min-height: 163px;">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Library_branch/Edit</li>

                <?php
                echo '<br>';
                if (isset($_SESSION['Message'])) {
                    Messages($_SESSION['Message']);

                    # Unset Session ... 
                    unset($_SESSION['Message']);
                }

                ?>

            </ol>


            <div class="card mb-4">

                <div class="card-body">

                    <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputName">Address</label>
                            <input type="text" class="form-control" id="exampleInputName" name="address" aria-describedby="" placeholder="Enter Address" value="<?php echo $data['address']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Phone</label>
                            <input type="text" class="form-control" id="exampleInputName" name="phone" aria-describedby="" placeholder="Enter Phone" value="<?php echo $data['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" class="form-control" id="exampleInputName" name="email" aria-describedby="" placeholder="Enter Email" value="<?php echo $data['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Facebook</label>
                            <input type="text" class="form-control" id="exampleInputName" name="facebook" aria-describedby="" placeholder="Enter Facebook" value="<?php echo $data['facebook']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Twitter</label>
                            <input type="text" class="form-control" id="exampleInputName" name="twitter" aria-describedby="" placeholder="Enter Twitter" value="<?php echo $data['twitter']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Linkedin</label>
                            <input type="text" class="form-control" id="exampleInputName" name="linkedin" aria-describedby="" placeholder="Enter Linkedin" value="<?php echo $data['linkedin']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Instegram</label>
                            <input type="text" class="form-control" id="exampleInputName" name="instegram" aria-describedby="" placeholder="Enter Instegram" value="<?php echo $data['instegram']; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->


<?php
require '../layouts/footer.php';
?>