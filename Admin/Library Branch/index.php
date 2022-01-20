<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

################################################################
# Fetch Roes Data .......
$sql = 'select * from library_branch';
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
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard/library_branch/display</li>
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
                                        <th>Address</th>
                                        <th>phone</th>
                                        <th>email</th>
                                        <th>facebook</th>
                                        <th>linkedin</th>
                                        <th>twitter</th>
                                        <th>instegram</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Address</th>
                                        <th>phone</th>
                                        <th>email</th>
                                        <th>facebook</th>
                                        <th>linkedin</th>
                                        <th>twitter</th>
                                        <th>instegram</th>
                                        <th>Action</th>
                                </tfoot>
                                <tbody>

                                    <?php
                                    # Fetch Data ...... 
                                    while ($data = mysqli_fetch_assoc($op)) {

                                    ?>

                                        <tr>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['address']; ?></td>
                                            <td><?php echo $data['phone']; ?></td>
                                            <td><?php echo $data['email']; ?></td>
                                            <td><a href="<?php echo $data['facebook']; ?>">facebook</a></td>
                                            <td><a href="<?php echo $data['linkedin']; ?>">linkedin</a></td>
                                            <td><a href="<?php echo $data['twitter']; ?>">twitter</a></td>
                                            <td><a href="<?php echo $data['instegram']; ?>">instegram</a></td>
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