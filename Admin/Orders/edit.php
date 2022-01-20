<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
############################################################################# 
$id = $_GET['id'];

$sql = "select * from orders where id = $id";
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

    $status = $_POST['status'];


    $sql = "update orders set status='$status' where id = $id";

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
                <li class="breadcrumb-item active">Dashboard/Order/Edit</li>

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
                    <label for="exampleInputName">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="true"<?php echo ($data['status']=='true' ? 'checked' : '');?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                True
                            </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2"value="false" <?php echo ($data['status']=='false' ? 'checked' : '');?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                False
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
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