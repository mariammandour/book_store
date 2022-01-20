<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
#########################################################################
# Fetch librarian .... 
$sql = "SELECT * FROM `users` WHERE user_type_id=2;";
$lib  = mysqli_query($con,$sql);

#########################################################################


# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $description = Clean($_POST['description']);
    $lib_id=Clean($_POST['librarian_id']);

    # Validate Title .... 
    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = "Required Field";
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = "Invalid String";
    }
    if (!Validate($description, 1)) {
        $errors['Description'] = "Required Field";
    }
    if (!Validate($lib_id,1)) {
        $errors['librarian'] = 'Field Required';
    }elseif(!Validate($lib_id,4)){
        $errors['librarian'] = "Invalid Id";
    }

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
        $disPath = './uploads/'.$FinalName;

        if(move_uploaded_file($ImgTempPath,$disPath)){
        $sql = "INSERT INTO `category`( `name`, `description`, `image`, `librarian_id`) VALUES ('$name','$description','$disPath',$lib_id)";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $Message = ["Message" => "Raw Inserted"];
        } else {
            $Message = ["Message" => "Error Try Again " . mysqli_error($con)];
        }
        }else{
            $Message = ['Message' => 'Error  in uploading Image  Try Again ' ];
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
            <h1 class="mt-4">Add category</h1>
            <ol class="breadcrumb mb-4">
                <!-- <li class="breadcrumb-item active">Dashboard/Roles/Create</li> -->

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
                            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby="" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword">librarian</label>
                        <select class="form-control" id="exampleInputPassword1" name="librarian_id">

                            <?php
                                while($data = mysqli_fetch_assoc($lib)){
                            ?>

                            <option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>

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