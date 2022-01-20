<?php
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
###############################################################
$sql = 'SELECT articles.* ,users.name FROM articles JOIN users ON articles.user_id = users.id;';
$op = mysqli_query($con, $sql);
?>

<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><span>Reading_Exchange</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-navicon" style="color: #fff; font-size: 26px; margin: 0px"></i>
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
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Categories</a>
                        </li>

                        <li class="nav-item  active">
                            <a class="nav-link " href="blog.php">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item ">
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
                    <h1>Our Articles</h1>
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
    </div>
    <!-- end header -->
    <!-- start ourblog -->
    <section id="section_blog">
        <div class="container">
            <div class="row">

                <?php
                # Fetch Data ...... 
                while ($data = mysqli_fetch_assoc($op)) {
                ?>  
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="box">
                        <a href="comment.php?id=<?php echo $data['id']; ?>">
                            <img src="../../Admin/articles/<?php echo $data['image']; ?>" />
                        </a>
                            <h1><?php echo $data['title']; ?></h1>
                            <pre><h3><?php echo $data['date']; ?></h3> <h3 id="color"><?php echo $data['name']; ?></h3></pre>
                            <p>
                                <?php echo $data['content']; ?>
                            </p>
                        </div>
                    </div>
                    
                <?php
                }
                ?>
                <div class="d-flex justify-content-center text-center w-100">
                    <a class="btn btn-primary " href="add_articles.php" role="button">ADD Articles</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end ourblog -->
    <?php
    require '../layouts/footer.php';
    require '../layouts/end.php';
    ?>