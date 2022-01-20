<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

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
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE ..... 
        $disPath = './uploads/'.$FinalName;

        $sql = "INSERT INTO `library_branch`( `address`, `phone`,`email`, `facebook`,`twitter`, `linkedin`,`instegram`) VALUES ('$address','$phone','$email','$facebook','$twitter','$linkedin','$instegram')";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $Message = ["Message" => "Raw Inserted"];
        } else {
            $Message = ["Message" => "Error Try Again " . mysqli_error($con)];
        }
    }
    # Set Session ...... 
    $_SESSION['Message'] = $Message;
}
require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 163px;">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Add Branch</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Branch/Create</li>

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

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputName">Address</label>
                            <input type="text" class="form-control" id="exampleInputName" name="address" aria-describedby="" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Phone</label>
                            <input type="text" class="form-control" id="exampleInputName" name="phone" aria-describedby="" placeholder="Enter Phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" class="form-control" id="exampleInputName" name="email" aria-describedby="" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Facebook</label>
                            <input type="text" class="form-control" id="exampleInputName" name="facebook" aria-describedby="" placeholder="Enter Facebook">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Twitter</label>
                            <input type="text" class="form-control" id="exampleInputName" name="twitter" aria-describedby="" placeholder="Enter Twitter">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Linkedin</label>
                            <input type="text" class="form-control" id="exampleInputName" name="linkedin" aria-describedby="" placeholder="Enter Linkedin">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName">Instegram</label>
                            <input type="text" class="form-control" id="exampleInputName" name="instegram" aria-describedby="" placeholder="Enter Instegram">
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