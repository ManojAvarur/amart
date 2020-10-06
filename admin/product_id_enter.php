<?php 
session_start(); 

if (isset( $_SESSION['ADID']) && isset( $_GET['location'] ) && in_array( $_GET['location'], array('delete', 'update'))  )  {

    if(!isset($_SESSION['ADBASICINFO'])) {

        setBasicInfo($_SESSION['ADID'], false);

    }

    $spanCheck = 0;

    if( isset( $_GET['submit'] ) ){ 

    
        require "../_headers/connection.php";
        // require "../_headers/functions.php";
    
        global $con;
    
        $pid = mysqli_escape_string($con, $_GET['pid']);

        $prd = "SELECT p.*, pi.IMG_PATH, c.CAT_NAME FROM product p, prd_image pi, category c ";
        $prd .= "WHERE p.PRD_ID = '" . $pid . "' AND p.PRD_ID = pi.IMG_PRD_ID AND c.CAT_ID = p.PRD_CAT_ID ";
        $prd .= "GROUP BY p.PRD_ID; ";

        // die($prd);
    
        $prd = mysqli_query($con, $prd);

        // die($prd);
        
        if( mysqli_num_rows( $prd ) > 0 ){
    
            $_SESSION['prd'] = mysqli_fetch_all( $prd ) ;
            
            header("location:confirmation.php?location=" . $_GET['location'] . "&&product=65d8c7b96b92a45209f71b245f9bf4809aba885272541b588ae8a94f7d32918b34536530&&token=fcfe053532b996235c34567282d8dd17dd6&&value=abcedba55195c3216c82a");
    
        } else {

            $spanCheck = 1;

        }
     }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Amart</title>
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
            <h1 class="logo"><a href="../index.php">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>

            <?php displayCategory() ?>

                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>

                <?php displayCategory() ?>

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

    <div class="admin_log_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">

                        <h5 class="card-title text-center">Enter Product ID</h5>

                            <form class="form-signin" action="product_id_enter.php" method="GET">
                            <?php
                                    if($spanCheck) { 
                            ?>
                                        <h6 class="text-center" style="color:red"><b>No such product found!</b></h6><br>
                            <?php 
                                    } 
                            ?>
                                <div class="form-label-group">
                                    <input type="text" id="inputPassword" class="form-control" placeholder="Product ID" name="pid" required>
                                    <label for="inputPassword">Product ID</label>
                                </div>

                                <input type="hidden" name=location value="<?php echo $_GET['location']?>">

                                <button class="btn btn-lg btn-block text-uppercase" value="sub" name="submit" style="background-color: #000; color: #fff;" type="submit">Submit</button>
                                <hr class="my-4">
                                
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" style="width: 100%;">
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

    header("location:admin_login.php");

}

?>