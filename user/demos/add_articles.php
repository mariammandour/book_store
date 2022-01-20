<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
require 'checkLogin.php';

# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);
    $user_id = $_SESSION['user']['id'];

    $errors = [];

    if (!Validate($title, 1)) {
        $errors['title'] = "Required Field";
    } elseif (!Validate($title, 6)) {
        $errors['title'] = "Invalid String";
    }

    if (!Validate($content, 1)) {
        $errors['content'] = "Required Field";
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
        $disPath = '../../Admin/articles/uploads/' . $FinalName;

        if (move_uploaded_file($ImgTempPath, $disPath)) {
            $sql = "INSERT INTO `articles`( `title`, `content`, `image`,`user_id`) VALUES ('$title','$content','$disPath',$user_id)";
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $Message = ["Message" => "Raw Inserted"];
                header("Location: blog.php");
            } else {
                $Message = ["Message" => "Error Try Again " . mysqli_error($con)];
            }
        } else {
            $Message = ['Message' => 'Error  in uploading Image  Try Again '];
        }
    }
    # Set Session ...... 
    $_SESSION['Message'] = $Message;
}
// require '../layouts/header.php';
// require '../layouts/nav.php';
// require '../layouts/sidNav.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 163px;">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Add Articles</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Articles/Create</li>

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
                            <label for="exampleInputName">title</label>
                            <input type="text" class="form-control" id="exampleInputtitle" name="title" aria-describedby="" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
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
require '../layouts/end.php';
?>