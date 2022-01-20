<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
################################################################
# Fetch category Data .......
$sql = 'select category.*,users.name as librarian from  category inner join users on category.librarian_id = users.id';
$op = mysqli_query($con, $sql);
################################################################

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 163px;">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <h1 class="mt-4">Categories</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard/Categories/display</li>
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>librarian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>librarian</th>
                                        <th>Action</th>
                                </tfoot>
                                <tbody>

                                    <?php
                                    # Fetch Data ...... 
                                    while ($data = mysqli_fetch_assoc($op)) {

                                    ?>

                                        <tr>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo substr($data['description'],0,40); ?></td>
                                            <td> <img src="<?php echo $data['image']; ?>" height="40px" width="40px">  </td>
                                            <td><?php echo $data['librarian']; ?></td>

                                            <td>
                                                <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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
require '../layouts/footer.php';
?>