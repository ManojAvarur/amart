<?php 

require "../_headers/functions.php";

    session_start();

    if (isset($_SESSION['ADID'])) {

        if(!isset($_SESSION['ADBASICINFO'])) {

            setBasicInfo($_SESSION['ADID'], false);

        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amart Admin</title>
    <meta content="Amart, amart sales, amart india" name="description">
    <meta content="Amart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
    <link href="../assets/img/a.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="index.html">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li><a href="admin_add.php">Add Product</a></li>
                    <li><a href="product_id_enter.php?location=delete">Delete Product</a></li>
                    <li><a href="product_id_enter.php?location=update">Update Product</a></li>
                    <li><a href="admin_all.html">Check Products</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li><a href="admin_add.php">Add Product</a></li>
                            <li><a href="admin_delete.html">Delete Product</a></li>
                            <li><a href="admin_update.html">Update Product</a></li>
                            <li><a href="admin_all.html">Check Products</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="dropdown login-btn">
                <p style="margin-bottom: 0px;"> <?php echo $_SESSION['ADBASICINFO']['AD_FIRSTNAME'] ?> </p>
                <div class="dropdown-content">
                    <a href="admin_index.php">Home</a>
                    <a href="admin_details.php">My Account</a>
                    <a href="../_headers/logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </header>

    <section id="admin_home" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div class="col-xl-6 col-lg-8">
                    <script type="text/javascript">
                        document.write("<h1>");
                        var day = new Date();
                        var hr = day.getHours();
                        if (hr >= 0 && hr < 12) {
                            document.write("Good Morning<span>!</span>");
                        } else if (hr >= 12 && hr <= 17) {
                            document.write("Good Afternoon<span>!</span>");
                        } else {
                            document.write("Good Evening<span>!</span>");
                        }
                        document.write("</h1>");
                    </script>
                </div>
            </div>
        </div>
    </section>

<!-- 
    <section class="products">
        <div class="container" data-aos="fade-down">
            <div class="section-title">
                <h2>Products</h2>
                <p>Available products</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Nemo Enim</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Dele cardo</a></h4>
                        <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                    <div class="icon-box">
                        <div class="icon"></div>
                        <h4><a href="">Divera don</a></h4>
                        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                    </div>
                </div>

            </div>

        </div>
    </section> 
-->

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
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/venobox/venobox.min.js"></script>
    <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/vendor/counterup/counterup.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/js/main.js"></script>
</body>


</html>

<?php

} else {

    header('location:admin_login.php');

}

?>