<?php
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
###############################################################
# Fetch Branch Data .......
$sql = 'select * from library_branch LIMIT 1';
$op = mysqli_query($con, $sql);
################################################################
#fetch admin data
$sql = 'select users.*,admin_information.image , admin_information.gender ,user_type.title 
from  users inner join admin_information INNER JOIN user_type on users.id = admin_information.user_id and users.user_type_id = user_type.id and users.user_type_id != 3;';
$admin_op = mysqli_query($con, $sql);
################################################################

?>

<body>
    <div class="bg">
        <nav class="navbar navbar-expand-lg navbar-dark">
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
                        <li class="nav-item active">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
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
                    <h1>About</h1>
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
    <!-- start section1 -->
    <section id="section1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <h1 class="font-weight-bolder">Exchange book website:</h1>
                    <h2 class="font-weight-bolder">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.<br />
                        Harum, consequuntur?
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea
                        <br />nesciunt, amet officia soluta, dolores dolor?
                    </p>
                    <ul id="ulicon1">
                        <?php
                        # Fetch Data ...... 
                        while ($data = mysqli_fetch_assoc($op)) {

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
                </div>
                <div id="img" class="col-lg-6 col-md-5">
                    <img id="img1" src="../image/2.jpg" />
                    <img id="img2" src="../image/25.jpg" />
                </div>
            </div>
        </div>
    </section>
    <!-- end section1 -->
    <!-- start ourteam -->
    <section id="section_ourteam">
        <div class="container">
            <h1>Our Team</h1>
            <hr />
            <div class="row">
                <?php
                # Fetch Data ...... 
                while ($data = mysqli_fetch_assoc($admin_op)) {

                ?>
                    <div class="our_team col-lg-4 col-md-6 col-12">
                        <div class="profit">
                            <img src="../../Admin/Users/<?php echo $data['image']; ?>" />
                            <h3><?php echo $data['title']; ?></h3>
                            <h2><?php echo $data['name']; ?></h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa,
                                sapiente.
                            </p>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- end ourteam -->
    <!-- start whyus -->
    <section id="section_whyus" class="container">
        <div class="row">
            <div class="img col-lg-6">
                <img src="../image/52.jpg" />
            </div>
            <div class="text col-lg-6 text-center">
                <h1>Why Us</h1>
                <hr />
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure
                    nesciunt nemo vel earum maxime neque!
                </p>
                <a href="#">
                    <div id="button">Learn More</div>
                </a>
            </div>
        </div>
    </section>
    <!-- end whyus -->

    <?php
    require '../layouts/footer.php';
    require '../layouts/end.php';
    ?>