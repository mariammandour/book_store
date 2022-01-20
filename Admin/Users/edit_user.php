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

$sql = "select users.*,user_type.title 
from users INNER JOIN user_type on users.user_type_id = user_type.id and users.user_type_id = 3 and users.id = $id ";

$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
} else {
    $_SESSION['Message'] = ["Message" => "Invalid Id"];
    header("Location: index.php");
    exit();
}
################################################################
# Fetch Admin Data .......
$sql = "SELECT * FROM `user_type`";
$user_type  = mysqli_query($con, $sql);

################################################################
# Code ..... 
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $phone = Clean($_POST['phone']);
    $address = Clean($_POST['address']);
    $type = Clean($_POST['user_type']);

    # Validate Name .... 
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = "Required Field";
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = "Invalid String";
    }

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

    # Validate phone .... 
    if (!Validate($phone, 1)) {
        $errors['Phone'] = 'Field Required';
    } elseif (!Validate($phone, 5)) {
        $errors['phone'] = 'InValid Number';
    }

    if (!Validate($type, 1)) {
        $errors['user_type'] = "Required Field";
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE ..... 


        $sql = "update users set name='$name' , email='$email' , password ='$password', mobile='$phone' , address ='$address', user_type_id=$type where id = $id";

        $op = mysqli_query($con, $sql);


        if ($op_one) {
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
                <li class="breadcrumb-item active">Dashboard/Users/Edit</li>

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

                    <form action="edit_user.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby="" placeholder="Enter name" value="<?php echo $data['name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" class="form-control" id="exampleInputName" name="email" aria-describedby="" placeholder="Enter Email" value="<?php echo $data['email']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Phone</label>
                            <input type="text" class="form-control" id="exampleInputName" name="phone" aria-describedby="" placeholder="Enter phone" value="<?php echo $data['mobile']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">Address</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address" value="<?php echo $data['address']; ?>">
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputPassword">User Type</label>
                            <select class="form-control" id="exampleInputPassword1" name="user_type">

                                <?php
                                while ($type = mysqli_fetch_assoc($user_type)) {
                                ?>

                                    <option value="<?php echo $type ['id']; ?>" 
                                    <?php if ($type ['id'] == $data['user_type_id']) {
                                        echo 'selected';
                                    } ?>><?php echo $type['title']; ?></option>

                                <?php }
                                ?>

                            </select>
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