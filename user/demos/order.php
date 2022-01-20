<?php
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
require 'checkLogin.php';

################################################################
# Fetch Roes Data .......
$id=$_SESSION['user']['id'];
$sql = "SELECT orders.* ,books.name as book_name ,books.price ,users.name as user_name FROM orders INNER JOIN books INNER JOIN users ON orders.book_id = books.id AND orders.user_id = users.id and users.id=$id";
$op = mysqli_query($con, $sql);
################################################################
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 163px;">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <h1 class="mt-4">My Orders</h1>
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
                                        <th>#</th>
                                        <th>book_name</th>
                                        <!-- <th>user_name</th> -->
                                        <th>price</th>
                                        <th>Date</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>book_name</th>
                                        <!-- <th>user_name</th> -->
                                        <th>price</th>
                                        <th>Date</th>
                                        <th>status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php
                                    # Fetch Data ...... 
                                    while ($data = mysqli_fetch_assoc($op)) {

                                    ?>

                                        <tr>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['book_name']; ?></td>
                                            <!-- <td><?php echo $data['user_name']; ?></td> -->
                                            <td><?php echo $data['price']; ?></td>
                                            <td><?php echo $data['date']; ?></td>
                                            <td><?php echo $data['status']; ?></td>

                                            <td>
                                                <a href='delete_order.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            </td>

                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php
    // require '../layouts/footer.php';
    require '../layouts/end.php';
?>