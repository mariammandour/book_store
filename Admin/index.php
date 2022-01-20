<?php
require 'helpers/dbConnection.php';
require 'helpers/functions.php';
require 'helpers/checkLogin.php';

require 'layouts/header.php';
require 'layouts/nav.php';
require 'layouts/sidNav.php';
$sql = "SELECT COUNT(*) as count FROM `users` WHERE user_type_id=1";
$admin_op = mysqli_query($con, $sql);
$admin = mysqli_fetch_assoc($admin_op);

$sql = "SELECT COUNT(*) as count FROM `users` WHERE user_type_id=2";
$lib_op = mysqli_query($con, $sql);
$librarian = mysqli_fetch_assoc($lib_op);

$sql = "SELECT COUNT(*) as count FROM `users` WHERE user_type_id=3";
$user_op = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($user_op);

$sql = "SELECT COUNT(*) as count FROM `books`";
$book_op = mysqli_query($con, $sql);
$book = mysqli_fetch_assoc($book_op);

$sql = "SELECT COUNT(*) as count FROM `author`";
$author_op = mysqli_query($con, $sql);
$author = mysqli_fetch_assoc($author_op);

$sql = "SELECT COUNT(*) as count FROM `category`";
$category_op = mysqli_query($con, $sql);
$category = mysqli_fetch_assoc($category_op);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: 163px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Statics</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <h2>Users</h5>
                <div class="row">

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-user" aria-hidden="true"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Admins</span>
                                <span class="info-box-number"><?php echo $admin['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fa fa-user" aria-hidden="true"></i></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">librarians</span>
                                <span class="info-box-number"><?php echo $librarian['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-user" aria-hidden="true"></i></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">users</span>
                                <span class="info-box-number"><?php echo $user['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <h2>Books</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-book" aria-hidden="true"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">books</span>
                                <span class="info-box-number"><?php echo $book['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-user" aria-hidden="true"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Authors</span>
                                <span class="info-box-number"><?php echo $author['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-clipboard" aria-hidden="true"></i></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">categories</span>
                                <span class="info-box-number"><?php echo $category['count']; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<?php
require 'layouts/footer.php';
?>