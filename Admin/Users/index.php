<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
################################################################
# Fetch Admin Data .......
$sql = 'select users.*,admin_information.image , admin_information.gender ,user_type.title 
from  users inner join admin_information INNER JOIN user_type on users.id = admin_information.user_id and users.user_type_id = user_type.id and users.user_type_id != 3;';
$admin_op = mysqli_query($con, $sql);
################################################################
$sql = 'select users.*,user_type.title 
from users INNER JOIN user_type on users.user_type_id = user_type.id and users.user_type_id = 3 ;';
$user_op = mysqli_query($con, $sql);
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
            <h1 class="mt-4">Admins/librarian</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Admins/librarian/display</li>
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
                                    <th>Email</th>
                                    <th>password</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>user_type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>password</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Image</th>
                                    <th>user_type</th>
                                    <th>Action</th>
                            </tfoot>
                            <tbody>

                                <?php
                                # Fetch Data ...... 
                                while ($data = mysqli_fetch_assoc($admin_op)) {

                                ?>

                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['email']; ?></td>
                                        <td><?php echo substr($data['password'], 0, 10); ?></td>
                                        <td><?php echo $data['mobile']; ?></td>
                                        <td><?php echo $data['address']; ?></td>
                                        <td><?php echo $data['gender']; ?></td>
                                        <td> <img src="<?php echo $data['image']; ?>" height="40px" width="40px"> </td>
                                        <td><?php echo $data['title']; ?></td>

                                        <td>
                                            <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit_admin.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard/Users/display</li>
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
                                    <th>Email</th>
                                    <th>password</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                    <th>user_type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>password</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                    <th>user_type</th>
                                    <th>Action</th>
                            </tfoot>
                            <tbody>

                                <?php
                                # Fetch Data ...... 
                                while ($data = mysqli_fetch_assoc($user_op)) {

                                ?>

                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['email']; ?></td>
                                        <td><?php echo substr($data['password'], 0, 10); ?></td>
                                        <td><?php echo $data['mobile']; ?></td>
                                        <td><?php echo $data['address']; ?></td>
                                        <td><?php echo $data['title']; ?></td>

                                        <td>
                                            <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit_user.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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