<?php
require '../../Admin/helpers/dbConnection.php';
require '../../Admin/helpers/functions.php';
require '../layouts/header.php';
###############################################################
# Fetch Branch Data .......
$sql = 'select * from library_branch ';
$op = mysqli_query($con, $sql);
################################################################
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
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">Articles</a>
                        </li>
                        <li class="nav-item  active">
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
                    <h1>Contact Us</h1>
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
    <!-- start section_contact -->
    <section id="section_contact">
        <div class="container">
            <div id="first">
                <h1 class="text-center font-weight-medium">Contact Us Or Use This Form To Rent A Car</h1>
                <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo assumenda,
                    dolorum necessitatibus eius earum voluptates sed!</p>
            </div>
            <div class="row">
                <!-- <div class="col-lg-9 col-md-12" id="form">
                    <form action="" method="post">
                        <div class="form-group form-inline">
                            <input class="form-control text1" type="text" name="firstname"
                                placeholder="Firstname"></input>


                            <input class="form-control" type="text" name="lastname" placeholder="Lastname"></input>
                        </div>
            
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="write your message"
                                placeholder="Write your message."></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="submit" value="Sent Message">
                        </div>
                    </form>
                </div> -->
                <?php
                # Fetch Data ...... 
                while ($data = mysqli_fetch_assoc($op)) {

                ?>

                <div id="contact" class="col-lg-3 col-md-12">
                    <h1>Contact Info</h1>
                    <h2>Address:</h2>
                    <p><?php echo $data['address']; ?></p>
                    <h2>Phone:</h2>
                    <p>+<?php echo $data['phone']; ?></p>
                    <h2>Email:</h2>
                    <p><?php echo $data['email']; ?></p>
                </div>

                <?php
                }
                ?>
                
            </div>
        </div>
    </section>
    <!-- end section_contact -->
    <?php
    require '../layouts/footer.php';
    require '../layouts/end.php';
    ?>