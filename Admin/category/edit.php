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

$sql = "select * from category where id = $id";
$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
} else {
    $_SESSION['Message'] = ["Message" => "Invalid Id"];
    header("Location: index.php");
    exit();
}
############################################################################# 
# Fetch librarian ....
$sql = 'select * from users where user_type_id = 2';
$libop = mysqli_query($con, $sql);

#########################################################################
# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $description = Clean($_POST['description']);
    $lib_id = $_POST['librarian_id'];

    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = "Required Field";
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = "Invalid String";
    }
    if (!Validate($description, 1)) {
        $errors['Description'] = "Required Field";
    }
    if (!Validate($lib_id, 1)) {
        $errors['librarian'] = 'Field Required';
    } elseif (!Validate($lib_id, 4)) {
        $errors['librarian'] = "Invalid Id";
    }
    # Validate Image
    if (Validate($_FILES['image']['name'], 1)) {
        $ImgTempPath = $_FILES['image']['tmp_name'];
        $ImgName = $_FILES['image']['name'];

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

        if (Validate($_FILES['image']['name'], 1)) {
            $disPath = './uploads/' . $FinalName;

            if (!move_uploaded_file($ImgTempPath, $disPath)) {
                $Message = ['Message' => 'Error  in uploading Image  Try Again '];
            } else {
                unlink($data['image']);
            }
        } else {
            $disPath = $data['image'];
        }

        $sql = "update category set name='$name' , description='$description' , image ='$disPath', librarian_id='$lib_id'  where id = $id";

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
                <li class="breadcrumb-item active">Dashboard/Roles/Edit</li>

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
                            <label for="exampleInputName">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby="" placeholder="Enter Title" value="<?php echo $data['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"><?php echo $data['description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
                        </div>
                        <img src="<?php echo $data['image']; ?>" height="40px" width="40px">

                        <div class="form-group">
                            <label for="exampleInputPassword">librarian</label>
                            <select class="form-control" id="exampleInputPassword1" name="librarian_id">
                                <?php
                                
                                while ($lib_data = mysqli_fetch_assoc($libop)) {
                                ?>

                                    <option value="<?php echo $lib_data['id']; ?>"
                                        <?php if ( $lib_data['id'] == $data['librarian_id']) {
                                            echo 'selected';
                                        } ?>>
                                        <?php echo $lib_data['name']; ?></option>
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