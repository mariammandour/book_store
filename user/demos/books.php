<?php
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
$id = $_GET['id'];
###############################################################
# Fetch books Data .......
$sql = "select books.*,author.name as author from  
books inner join author on books.author_id = author.id and books.category_id= $id ";
$op = mysqli_query($con, $sql);
################################################################
$sql = "select * from category where id= $id ";
$cat = mysqli_query($con, $sql);
$name=mysqli_fetch_assoc($cat);
?>

<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="#"><span>Reading_Exchange</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <h1>Books </h1>
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
    <!-- start Books -->
    <section class="container" id="section_ser">
        <div>
            <h1>Our <?php echo $name['name']?></h1>
            <hr>
        </div>
        <div class="row">
            <?php
            # Fetch Data ...... 
            while ($data = mysqli_fetch_assoc($op)) {

            ?>
                <div class="box col-lg-3 col-md-6 col-12">
                    <img src="../../Admin/books/<?php echo $data['image']; ?>"class="mb-3" />
                    <h4><?php echo $data['name']; ?></h4>
                    <h4>Author:<?php echo $data['author']; ?></h4>
                    <p><?php echo $data['description']; ?></p>
                    <h5>price:<?php echo $data['price']; ?></h5>
                    <a class="btn btn-primary" href="create_order.php?id=<?php echo $data['id'];?>" role="button">Buy the book</a>


                </div>
            <?php
            }
            ?>
            <div class="d-flex justify-content-center text-center w-100">
                <a class="btn btn-primary " href="order.php" role="button">My Order</a>
            </div>
        </div>
    </section>
    <!-- end Books -->
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