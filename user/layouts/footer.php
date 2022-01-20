<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// require '../../Admin/helpers/dbConnection.php';
// require '../../Admin/helpers/functions.php';

################################################################
# Fetch Branch Data .......
$sql = 'select * from library_branch LIMIT 1';
$op = mysqli_query($con, $sql);
################################################################

?>

<!-- start footer -->
<footer>
    <div class="container text-center">
        <div id="first">
            <h1>Reading_Exchange</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="categories.php">categories</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <ul id="ulicon2">
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
        <hr />
    </div>
</footer>
<!-- end footer -->
<!-- start siction loading   -->
<section class="loading-overlay">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</section>