<?php 
$id=$_SESSION['user']['id'];
$sql = "select users.*,admin_information.image
from  users inner join admin_information on users.id = admin_information.user_id and
users.id = $id";
$opp = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($opp);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?Php echo 'http://'.$_SERVER['HTTP_HOST'].'/book_store/index.php';?>" class="brand-link">
        <span class="brand-text font-weight-light ml-5">Book_store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="http://localhost/book_store/Admin/Users/<?php echo $user['image']?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $user['name']?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <?php 
                    

                    if($_SESSION['user']['user_type_id'] == 1){
                        $modules = ['category','articles','books','Authors','Library Branch','orders','Users'];
                    }else{
                        $modules = ['articles','books','Authors','orders'];
                    }

                    foreach($modules as $key => $module){
                    
                ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            <?php echo $module;?>
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <?php if($module != 'orders'){?>
                        <li class="nav-item">
                            <a href="<?php  echo Url($module.'/create.php');?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <?php }?>
                        <li class="nav-item">
                            <a href="<?php  echo Url($module.'/');?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Control</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php 
                    } 
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>