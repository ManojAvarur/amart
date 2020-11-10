<?php
    require "../_headers/connection.php" ;
    require "../_headers/functions.php" ;
    session_start();
    global $con;

    if(isset($_SESSION['ADID'])) {


        if(!isset($_SESSION['ADBASICINFO'])) {

            setBasicInfo($_SESSION['ADID'], false);
    
        }

        $result = mysqli_query( $con, "SELECT * FROM category" );

        if ( mysqli_num_rows( $result ) > 0 ) {

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
        <script>
            function checkAndUpdate(){

                <?php
                    $temp = "var categoryArray = new Array(";
                    while( $row = mysqli_fetch_row( $result ) ){
                        $temp .= "\"".$row[1]."\",";
                    }    
                    $temp .= ");";
                    echo $temp;
                ?>

                var category = document.getElementById( "inputCategory" ).value;

                for( var i = 0; i < category.length; i++ ){
                    if( categoryArray[i].toUpperCase() === category.toUpperCase() ){
                        alert("Category already exists!");
                        return false;
                    }
                }
                return true;
            }
        </script>
    </head>

    <body>
        <header id="header" class="fixed-top "> 
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo"><a href="../index.php">Smart<span style="font-size: medium;">ADMIN</span></a></h1>
                <nav class="nav-bar d-none d-lg-block">
                    <ul>
                        <li><a href="admin_add.php">Add Product</a></li>
                        <li><a href="admin_product_id_enter.php?location=delete">Delete Product</a></li>
                        <li><a href="admin_product_id_enter.php?location=update">Update Product</a></li>
                        <li><a href="admin_category.php">Add Category</a></li>
                        <li><a href="admin_check.php">Check Products</a></li>
                    </ul>
                </nav>
                <nav class="nav-bar d-lg-none d-sm-block">
                    <ul>
                        <li class="drop-down">
                            <a></a>
                            <ul>
                                <li><a href="admin_add.php">Add Product</a></li>
                                <li><a href="admin_delete.php">Delete Product</a></li>
                                <li><a href="admin_update.php">Update Product</a></li>
                                <li><a href="admin_category.php">Add Category</a></li>
                                <li><a href="admin_check.php">Check Products</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="dropdown login-btn">
                    <p style="margin-bottom: 0px;"> <?php echo $_SESSION['ADBASICINFO']['AD_FIRSTNAME'] ?> </p>
                    <!-- <p style="margin-bottom: 0px;"> asdfghjkoiuytrewaseddcftgbhj </p> -->
                    <div class="dropdown-content">
                        <a href="admin_index.php">Home</a>
                        <a href="admin_details.php">My Account</a>
                        <a href="../_headers/logout.php">Log Out</a>
                    </div>
                </div>
            </div>
        </header>


        <div class="log_main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">New Category Name</h5>
                                <!-- <p style="margin-top: -8%;padding-bottom: 5%;text-align: center;">Check your mail for activation passcode</p> -->
                                <form class="form-signin" onsubmit="return checkAndUpdate()" method="GET" action="admin_categoryAdd.php">
                                    <div class="form-label-group">
                                        <input type="text" name="category" id="inputCategory" class="form-control" placeholder="Category Name" required autofocus>
                                        <label for="inputCategory">Enter the Category</label>
                                    </div>

                                    <button class="btn btn-lg btn-block text-uppercase" style="background-color: #000; color: #fff;" type="submit">Submit</button>
                                    <!-- <p style="padding-top: 3%; text-align: right; margin-right: 2%;">Didn't receive a mail? <span><a href="signup.html">Try Again</a></span></p> -->
                                    
                                    <!-- <p style="color: #2196f3; margin-top: 5%; font-size: 12px;">*<b>Note:</b> Only to be accessed by the Admin</p> -->
                                    <!-- <hr class="my-4"> -->
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
            echo "<script> 
                        alert('Error occured while loading category.php. \\n Please try again later! ');
                        window.location.href='admin_login.php';
                </script>";
        }
    } else {
        header('location:admin_login.php');
    }