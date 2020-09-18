<?php 
    require "_headers/functions.php";

    session_start() ;

    if( isset( $_SESSION['ID'] ) ){

        if (! isset( $_SESSION['BASICINFO'] ) )
            setBasicInfo($_SESSION['ID']);

    } else {

        cookieCheck();
        
    }

?>

<?php 
    require "_headers/connection.php";

    $select = "SELECT P.PRD_NAME, P.PRD_DETAILS, I.IMG_PATH FROM PRD_IMAGE I, PRODUCT P WHERE P.PRD_ID = I.PRD_ID; " ;

    $qselect = mysqli_query($con, $select);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amart</title>
    <meta content="Amart, amart sales, amart india" name="description">
    <meta content="Amart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
    <link href="assets/img/a.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="index.php">Amart<span>.</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li class="active"><a href="index.php">Home</a></li>
                    <li class="drop-down"><a>Shop by Category</a>
                        <ul>
                            <li><a href="electronics.html">Electronics</a></li>
                            <li><a href="hardware.html">Hardware</a></li>
                            <li><a href="kitchen.html">Kitchen Appliances</a></li>
                            <li><a href="living_room.html">Living Room</a></li>
                        </ul>
                    </li>
                    <li><a href="admin/admin_index.php">Admin</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>
                            <li class="drop-down"><a>Shop by Category</a>
                                <ul>
                                    <li><a href="electronics.html">Electronics</a></li>
                                    <li><a href="hardware.html">Hardware</a></li>
                                    <li><a href="kitchen.html">Kitchen Appliances</a></li>
                                    <li><a href="living_room.html">Living Room</a></li>
                                </ul>
                                <li><a href="admin/admin_index.php">Admin</a></li>
                        </ul>
                        </li>
                </ul>
            </nav>
        <?php
            if( isset( $_SESSION['BASICINFO'] ) && isset($_SESSION['ID'] ) ){
                echo "<a href=\"_headers/logout.php\" class=\"login-btn\">" . $_SESSION['BASICINFO']['USER_FNAME'] . "</a>";
            } else {
                echo "<a href=\"login.php\" class=\"login-btn\">Log In</a>";
            }
        ?>
            
        </div>
    </header>

    <section id="main_home" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div class="col-xl-6 col-lg-8">
                    <h1>Welcome to AMART<span>.</span></h1>
                    <h2>Choose from a wide range of products at unbelievable discounts</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="offers">
        <div class="container">
            <div class="owl-carousel offers-carousel">
                <img style="border-radius: 10%;" src="assets/img/refr2.jpg" alt="">
                <img style="border-radius: 10%;" src="assets/img/tv.jpg" alt="">
                <img style="border-radius: 10%;" src="assets/img/hardware.jpg" alt="">
                <img style="border-radius: 10%;" src="assets/img/kitchen.jpg" alt="">
                <img style="border-radius: 10%;" src="assets/img/living.jpg" alt="">
            </div>
        </div>
    </section>

    <section class="amart_features">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="image col-lg-6" style='background-image: url("assets/img/key.jpg"); border-radius: 10px;' data-aos="fade-left"></div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="50">
                    <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">
                        <i class="bx bxs-truck"></i>
                        <h4>Fast delivery</h4>
                        <p>Usually Dispatched within 2-3 working days</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="100">
                        <i class="bx bx-receipt"></i>
                        <h4>Hassle Free Booking</h4>
                        <p>Interactive User Interface to order any number of items at once</p>
                    </div>
                    <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="100">
                        <i class="bx bx-cube-alt"></i>
                        <h4>Easy Returns Policy</h4>
                        <p>Read Terms and Conditions for more information on Return Policies</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="products">
        <div class="container" data-aos="fade-down">
            <div class="section-title">
                <h2>Products</h2>
                <p>Choose products</p>
            </div>

            <div class="row">

            

           

        <?php while($rows = mysqli_fetch_assoc($qselect)) { ?>
          
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <!-- <div class="icon"  style='background-image: url("https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png");'>  </div>  -->
                        <!-- <div class="icon"  style='background-image: url("<?php  echo $rows['IMG_PATH']; ?>");'>  </div> -->
                        <div class="icon"  > <img src="<?php  echo $rows['IMG_PATH']; ?>" alt="" width= "250" height= "250">  </div>
                        <h4><a href=""><?php  echo $rows['PRD_NAME']; ?></a></h4>
                        <p><?php echo $rows['PRD_DETAILS']; ?></p>
                    </div>
                </div>

        <?php } ?>

            </div>

        </div>
    </section>

    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Services</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Return Policy</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Security</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Term of Use</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>About</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Company</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Team</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Contact Us</h4>
                        <ul>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Email: amart@example.com</a></li>
                            <li><i class="bx bx-wifi-1"></i> <a href="#">Phone Number: +91 9800102010</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
    <div id="preloader"></div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>

