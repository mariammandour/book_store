<?php 
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';

################################################################
# Fetch category Data .......
$sql = 'select category.*,users.name as librarian from  category inner join users on category.librarian_id = users.id';
$op = mysqli_query($con, $sql);
################################################################
?>


<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="#"><span>Reading_Exchange</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon ">
                        <i class="fa fa-navicon" style="color:#fff; font-size:26px;margin:0px;"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="../../index.php">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navbar -->
        <!-- start header -->
        <header>
            <div class="container">
                <div>
                    <h1>categories </h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta veritatis in <br>tenetur
                        doloremque, maiores doloribus officia iste. Dolores.
                        .</h4>
                    <a href="#">
                        <div id="button">Learn More</div>
                    </a>
                </div>
            </div>
        </header>
    </div>
    <!-- end header -->
    <!-- start section2 -->
    <section class="container text-center pt-5 mt-4" id="section2">
        <div>
            <h1>Books Category</h1>
            <hr />
        </div>
        <div class="row">
        <?php
        # Fetch Data ...... 
        $str="../../Admin/category";
        while ($data = mysqli_fetch_assoc($op)) {

        ?>
            <div class="box col-lg-3 col-md-6 col-11">
                <a href='books.php?id=<?php echo $data['id'];?>'>
                    <img src="../../Admin/category/<?php echo $data['image']?>">
                    <h4 class="font-weight-bolder"><?php echo $data['name']; ?></h4>
                    <p>
                        <?php echo $data['description']; ?>
                    </p>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </section>
    <!-- end section2 -->
    <!-- start section3 -->
    <section id="section3">
        <div class="container text-center">
            <h1>Get free books</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            </p>
            <a href="contact.php">
                <div id="button">
                    Contact us
                </div>
            </a>
        </div>
    </section>
    <!-- end section3 -->
<?php 
require '../layouts/footer.php';
require '../layouts/end.php';
?>