<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';

# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $description = Clean($_POST['description']);

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


    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        // DB CODE ..... 
        $disPath = './uploads/'.$FinalName;

        $sql = "INSERT INTO `author`( `name`, `description`) VALUES ('$name','$description')";
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
            <h1 class="mt-4">Add Author</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Author/Create</li>

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