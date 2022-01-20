<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
require 'checkLogin.php';
################################################################
# Fetch category Data .......
$id = $_GET['id'];
$sql = "SELECT articles.* ,users.name FROM articles JOIN users ON articles.user_id = users.id and articles.id = $id ";
$op = mysqli_query($con, $sql);
$cat = mysqli_fetch_assoc($op);

################################################################
# Fetch category Data .......
$id = $_GET['id'];
$sql = "SELECT review.* ,users.name FROM review JOIN users ON review.user_id = users.id and review.article_id = $id ";
$opp = mysqli_query($con, $sql);


################################################################

# Code ..... 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $comment = Clean($_POST['comment']);

    # Validate comment .... 
    $errors = [];

    if (!Validate($comment, 1)) {
        $errors['comment'] = "Required Field";
    }
    $Message=[];
    if (count($errors) > 0) {
        $Message = $errors;
    } else {
        $user=$_SESSION['user']['id'];
        $sql = "INSERT INTO `review`( `comment`,`article_id`,user_id) VALUES ('$comment',$id,$user)";
        $op  = mysqli_query($con, $sql);
        // if ($op) {
        //     $Message = ['Message' => 'Raw Updated'];
        // } else {
        //     $Message = ['Message' => 'Error Try Again ' . mysqli_error($con)];
        // }
    }
    # Set Session ...... 
    $_SESSION['Message'] = $Message;
}
?>
<div class="content-wrapper" style="min-height: 163px;">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- <h1 class="mt-4">Add Comment</h1>
            <ol class="breadcrumb mb-4"> -->
            
            <?php
            
            echo '<br>';
            if (isset($_SESSION['Message'])) {
                Messages($_SESSION['Message']);

                # Unset Session ... 
                unset($_SESSION['Message']);
            }

            ?>

            </ol>

            <section id="why" class="container">

                <div class="first">
                    <h2><?php echo $cat['title'] ?></h2>
                    <p><?php echo $cat['content'] ?> </p>
                    <h3>BY:<?php echo $cat['name']; ?></h3>
                    <img src="../../Admin/articles/<?php echo $cat['image']; ?>"; 
                </div>

                <div class="card mb-4 mt-5">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php
                                    # Fetch Data ...... 
                                    $i=1;
                                    while ($comment = mysqli_fetch_assoc($opp)) {

                                    ?>

                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $comment['name']; ?></td>
                                            <td><?php echo $comment['comment']; ?></td>
                                            
                                            <!-- <td>
                                                <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                            </td> -->

                                        </tr>
                                        
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            

            <div class="card mb-4 mt-5">

                <div class="card-body ">

                    <form action="comment.php?id=<?php echo $cat['id']; ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group ">
                            <label for="exampleInputName">Comment</label>
                            <input type="text" class="form-control" id="exampleInputName" name="comment" aria-describedby="" placeholder="Enter Title">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>


                </div>
            </div>
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php
require '../layouts/end.php';
?>