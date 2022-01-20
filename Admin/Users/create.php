<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
#########################################################################
# Fetch librarian .... 
$sql = "SELECT * FROM `user_type`;";
$user_type  = mysqli_query($con, $sql);

#########################################################################


# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $phone = Clean($_POST['phone']);
    $address = Clean($_POST['address']);
    $gender = Clean($_POST['gender']);
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

    if (!Validate($address, 1)) {
        $errors['Address'] = "Required Field";
    } elseif (!Validate($address, 6)) {
        $errors['Address'] = "Invalid String";
    }


    if (!Validate($type, 1)) {
        $errors['user_type'] = "Required Field";
    }
    if (!Validate($address, 1)) {
        $errors['Address'] = "Required Field";
    }

    # Validate Image
    if (!Validate($_FILES['image']['name'], 1)) {
        $errors['Image'] = 'Field Required';
    } else {

        $ImgTempPath = $_FILES['image']['tmp_name'];
        $ImgName     = $_FILES['image']['name'];

        $extArray = explode('.', $ImgName);
        $ImageExtension = strtolower(end($extArray));

        if (!Validate($ImageExtension, 7)) {
            $errors['Image'] = 'Invalid Extension';
        } else {
            $FinalName = time() . rand() . '.' . $ImageExtension;
        }
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE ..... 
        $disPath = './uploads/' . $FinalName;

        if (move_uploaded_file($ImgTempPath, $disPath)) {

            $password = md5($password);

            # store data ......
            $sql = "insert into users (name,email,password,mobile,address,user_type_id) values ('$name','$email','$password','$phone','$address',$type)";

            $op = mysqli_query($con, $sql);

            if ($op) {

                # insert admin Data .... 
                $Adduser_id = mysqli_insert_id($con);
                $sql = "insert into admin_information (image,gender,user_id) values ('$disPath','$gender',$Adduser_id)";

                $op = mysqli_query($con, $sql);

                if ($op) {
                    $Message = ['Message' =>'Raw Inserted'];
                } else {
                    $Message = ['Message' =>'Error try Again : ' . mysqli_error($con)];
                }
            } else {
                $Message = ['Message' =>'Error try Again : ' . mysqli_error($con)];
            }
        } else {
            $Message = ['Message' => 'Error  in uploading Image  Try Again '];
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
            <h1 class="mt-4">Add User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Users/Create</li>

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
                            <label for="exampleInputName">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby="" placeholder="Enter name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Email</label>
                            <input type="text" class="form-control" id="exampleInputName" name="email" aria-describedby="" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Phone</label>
                            <input type="text" class="form-control" id="exampleInputName" name="phone" aria-describedby="" placeholder="Enter phone">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">Address</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="address" placeholder="Address">
                        </div>


                        <label for="exampleInputName">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Male">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Female">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>

                        <div class="form-group pt-3">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form-group ">
                            <label for="exampleInputPassword">User Type</label>
                            <select class="form-control" id="exampleInputPassword1" name="user_type">

                                <?php
                                while ($data = mysqli_fetch_assoc($user_type)) {
                                ?>

                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['title']; ?></option>

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