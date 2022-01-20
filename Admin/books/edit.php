<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
#########################################################################
# Fetch category .... 
$sql = "SELECT * FROM `category`";
$category  = mysqli_query($con,$sql);

#########################################################################
# Fetch librarian .... 
$sql = "SELECT * FROM `author`";
$author  = mysqli_query($con,$sql);

#########################################################################
$id = $_GET['id'];

$sql = "select * from books where id = $id";
$op = mysqli_query($con, $sql);

if (mysqli_num_rows($op) == 1) {
    // code ..... 
    $data = mysqli_fetch_assoc($op);
} else {
    $_SESSION['Message'] = ["Message" => "Invalid Id"];
    header("Location: index.php");
    exit();
}
# Code ..... 
# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = Clean($_POST['name']);
    $description = Clean($_POST['description']);
    $price =$_POST['price'];
    $cat_id=$_POST['category_id'];
    $author_id=$_POST['author_id'];

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

    if (!Validate($price, 1)) {
        $errors['price'] = "Required Field";
    } elseif (!Validate($price, 8)) {
        $errors['price'] = "Invalid String";
    }

    if (!Validate($cat_id,1)) {
        $errors['category'] = 'Field Required';
    }elseif(!Validate($cat_id,4)){
        $errors['category'] = "Invalid Id";
    }

    if (!Validate($author_id,1)) {
        $errors['author'] = 'Field Required';
    }elseif(!Validate($author_id,4)){
        $errors['author'] = "Invalid Id";
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

        $sql = "update books set name='$name' , description='$description' , image ='$disPath',price='$price' ,author_id=$author_id , category_id =$cat_id where id = $id";

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
                            <label for="exampleInputName">Price</label>
                            <input type="text" class="form-control" id="exampleInputName" name="price" aria-describedby="" placeholder="Enter Title" value="<?php echo $data['price']; ?>">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword">Author</label>
                        <select class="form-control" id="exampleInputPassword1" name="author_id">

                            <?php
                                while($aut_data = mysqli_fetch_assoc($author)){
                            ?>

                            <option value="<?php echo $aut_data['id'];?>"
                            <?php if ( $aut_data['id'] == $data['author_id']) {
                                            echo 'selected';
                                        } ?>><?php echo $aut_data['name'];?></option>

                            <?php }
                            ?>

                        </select>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword">category</label>
                        <select class="form-control" id="exampleInputPassword1" name="category_id">

                            <?php
                                while($cat_data = mysqli_fetch_assoc($category)){
                            ?>

                            <option value="<?php echo $cat_data['id'];?>"
                            <?php if ( $cat_data['id'] == $data['category_id']) {
                                            echo 'selected';
                                        } ?>><?php echo $cat_data['name'];?></option>

                            <?php }
                            ?>

                        </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">Image</label>
                            <input type="file" name="image">
                        </div>
                        <img src="<?php echo $data['image']; ?>" height="40px" width="40px"><br>

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