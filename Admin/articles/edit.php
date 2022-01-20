<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
############################################################################# 
$id = $_GET['id'];

$sql = "select * from articles where id = $id";
$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
    if(!($_SESSION['user']['user_type_id'] == 1 || ($_SESSION['user']['id'] == $data['user_id']))){
        header('Location: index.php');
        exit();

    }
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

    $title = Clean($_POST['title']);
    $content = Clean($_POST['content']);

    $errors = [];

    if (!Validate($title, 1)) {
        $errors['title'] = "Required Field";
    } elseif (!Validate($title, 6)) {
        $errors['title'] = "Invalid String";
    }

    if (!Validate($content, 1)) {
        $errors['content'] = "Required Field";
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

        $sql = "update articles set title='$title' , content='$content' , image ='$disPath', user_id=1  where id = $id";

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
                            <label for="exampleInputName">title</label>
                            <input type="text" class="form-control" id="exampleInputtitle" name="title" aria-describedby="" placeholder="Enter Title" value="<?php echo $data['title']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">content</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"><?php echo $data['content']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
                        </div>
                        <img src="<?php echo $data['image']; ?>" height="40px" width="40px">
                        <br>
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