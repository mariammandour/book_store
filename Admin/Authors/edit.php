<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
############################################################################# 
$id = $_GET['id'];

$sql = "select * from author where id = $id";
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

    $name = Clean($_POST['name']);
    $description = Clean($_POST['description']);

    $errors = [];

    if (!Validate($name, 1)) {
        $errors['Name'] = "Required Field";
    } elseif (!Validate($name, 6)) {
        $errors['Name'] = "Invalid String";
    }
    if (!Validate($description, 1)) {
        $errors['Description'] = "Required Field";
    }

    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE .....

        $sql = "update author set name='$name' , description='$description'  where id = $id";

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