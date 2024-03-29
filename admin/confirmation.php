<?php 
session_start(); 

if (isset( $_SESSION['ADID']) && isset( $_GET['location'] ) && in_array( $_GET['location'], array('delete', 'update')) && isset( $_SESSION['prd'] ) )  {

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
            <h1 class="logo"><a href="../index.php">Amart<span style="font-size: medium;">ADMIN</span></a></h1>
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

    <section id="ad_home1" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="150">
                <div>
                    <h1>Is this the product you want to <span> <?php echo $_GET['location'] ?></span> ?</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="counts" class="counts">
        <div class="container" data-aos="fade-down">
            <div class="row no-gutters">
                <img src="../<?php echo $_SESSION['prd'][0][6] ?>" style="border-radius: 10%;" class="col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos-delay="100"></img>
                <div class="col-xl-7 pl-0 pl-lg-5 pr-lg-1 d-flex align-items-stretch" data-aos-delay="100">
                    <div class="content d-flex flex-column justify-content-center">
                        <h3>Product Details</h3>
                        <div class="row">
                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-file-text"></i>
                                    <span><?php echo $_SESSION['prd'][0][2] ?></span>
                                    <p><strong>Product Name</strong></p>
                                </div>
                            </div>

                            <div class="col-md-6 d-md-flex align-items-md-stretch">
                                <div class="count-box">
                                    <i class="icofont-document-folder"></i>
                                    <span><?php echo $_SESSION['prd'][0][1] ?></span>
                                    <p><strong>Product ID</strong></p>
                                </div>
                            </div>
                            
                            <span id="spnote" style="color: red; flex-basis: 100%; height: 0;"></span>

                            <div style="margin-top: 8%; margin-left: 5%;">
                                <button type="button" class="btn btn-success" onclick="goForword()">Yes</button>
                                <button type="button" class="btn btn-dark" onclick="goBack()">No</button></div>
                        </div>
                    </div>
                </div>
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
<li><i class="bx bx-wifi-1"></i> <a href="#">Email: no.replay.amart@gmail.com</a></li>
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
    <script>
        $val = "<?php echo $_GET['location'] ?>";
        
        function goForword(){       
            if( $val === "update" ){
                window.location.href='admin_update.php';
            } else if( $val === "delete" ) {
                
                window.location.href='admin_delete.php';
            }    
        }  

        $(function () {
            if( $val === "delete" ) {
                document.getElementById("spnote").innerHTML = "*<b>Note:</b> This product will be permanently deleted!";
            }
        } );


    </script>
</body>


</html>

<?php
} else {

    header("location:admin_login.php");

}

?>