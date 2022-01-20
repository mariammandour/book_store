<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';

################################################################
# Fetch category Data .......
$id = $_GET['id'];
$sql = "SELECT review.* ,users.name FROM review JOIN users ON review.user_id = users.id and review.article_id = $id ";
$opp = mysqli_query($con, $sql);


################################################################
?>
<div class="content-wrapper" style="min-height: 163px;">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Comments</h1>
            <ol class="breadcrumb mb-4">

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
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php
                                # Fetch Data ...... 
                                $i = 1;
                                while ($comment = mysqli_fetch_assoc($opp)) {

                                ?>

                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $comment['name']; ?></td>
                                        <td><?php echo $comment['comment']; ?></td>

                                        <td>
                                            <a href='delete_comment.php?id=<?php echo $comment['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                        </td>

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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>
    <!-- ./wrapper -->
    <?php
    require '../layouts/footer.php';
    ?>