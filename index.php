
<?php 
require 'Admin/helpers/dbConnection.php';
require 'Admin/helpers/functions.php';

################################################################
# Fetch category Data .......
$sql = 'select category.*,users.name as librarian from  category inner join users on category.librarian_id = users.id LIMIT 4';
$op = mysqli_query($con, $sql);
################################################################
# Fetch Branch Data .......
$sql = 'select * from library_branch LIMIT 1';
$branch_op = mysqli_query($con, $sql);
################################################################
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="website that help people benefit their old books" />
    <meta name="keywords" content="book ,reading ,exchangebook" />
    <meta name="author" content="Mariam Essam" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="user/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="user/css/all.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />

    <title>Exchange_books</title>
</head>

<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><span>Reading_Exchange</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-navicon" style="color: #fff; font-size: 26px; margin: 0px"></i>
                    </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/demos/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/demos/categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/demos/blog.php">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/demos/contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user/demos/login.php">Login</a>
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
                    <h1>Exchange Benefits :</h1>
                    <h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta
                        veritatis in <br />tenetur doloremque, maiores doloribus officia
                        iste. Dolores. .
                    </h4>
                    <a href="#">
                        <div id="button">Learn More</div>
                    </a>
                </div>
            </div>
        </header>
        <!-- end header -->
    </div>
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
                <a href='user/demos/books.php?id=<?php echo $data['id'];?>'>
                    <img src="Admin/category/<?php echo $data['image']?>">
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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <a href="demos/contact.php">
                <div id="button">Contact us</div>
            </a>
        </div>
    </section>
    <!-- end section3 -->
    <!-- start section4 -->
    <section id="section4">
        <div class="container">
            <h1>Exchange Features</h1>
            <hr />
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="border_box">
                        <i class="fas fa-book-open"></i>
                        <h3>Read</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta, neque, et!
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="border_box">
                        <i class="fas fa-money-bill-wave"></i>
                        <h3>Price</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta, neque, et!
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="border_box">
                        <i class="fas fa-walking"></i>
                        <h3>Place</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta, neque, et!
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="border_box">
                        <i class="far fa-clock"></i>
                        <h3>Time</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Soluta, neque, et!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start section5 -->
    <section id="section5">
        <div class="text-center">
            <h1>Testimonials</h1>
            <hr />
        </div>
        <div>
            <div class="regular slider">
                <div><img src="user/image/54.jpg" /></div>
                <div><img src="user/image/50.jpg" /></div>
                <div><img src="user/image/51.jpg" /></div>
                <div><img src="user/image/52.jpg" /></div>
                <div><img src="user/image/53.jpg" /></div>
                <div><img src="user/image/50.jpg" /></div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a class="prev text-center">
                <div id="button">Prev</div>
            </a>
            <a class="next text-center">
                <div id="button">Next</div>
            </a>
        </div>
    </section>
    <!-- end section5 -->
    <!-- start section6  -->
    <section id="section6">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <h1 class="font-weight-bolder">
                        <span>“</span>Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Sint, illo .<span>”</span>
                    </h1>
                    <p>— Jean Doe, Spa Customer</p>
                </div>
                <div id="img" class="col-lg-6 col-md-5">
                    <img id="img1" src="user/image/2.jpg" />
                    <img id="img2" src="user/image/25.jpg" />
                </div>
            </div>
        </div>
    </section>
    <!-- end section6 -->
    <!-- start footer -->
    <footer>
        <div class="container text-center">
            <div id="first">
                <h1>Reading_Exchange</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="user/demos/about.php">About</a></li>
                    <li><a href="user/demos/categories.php">categories</a></li>
                    <li><a href="user/demos/contact.php">Contact</a></li>
                </ul>
            </nav>
            <ul id="ulicon2">
            <?php
            # Fetch Data ...... 
            while ($data = mysqli_fetch_assoc($branch_op)) {

            ?>
                <li>
                    <a href="<?php echo $data['facebook']; ?>"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                    <a href="<?php echo $data['instegram']; ?>"><i class="fab fa-instagram"></i></a>
                </li>
                <li>
                    <a href="<?php echo $data['linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a>
                </li>
                <li>
                    <a href="<?php echo $data['twitter']; ?>"><i class="fab fa-twitter"></i></a>
                </li>
            <?php
            }
            ?>
            </ul>
            <hr />
        </div>
    </footer>
    <!-- start siction loading   -->
    <section class="loading-overlay">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </section>
    <!-- end section loading -->
    <!-- end footer -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="user/js/project.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="user/js/slick.js"></script>
</body>

</html>