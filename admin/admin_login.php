<?php 

require "../_headers/connection.php" ;
require "../_headers/functions.php" ;


    global $con;

    $spanCheck = false;

    session_start();

    if(isset($_SESSION['ADID'])) {

        header('location:admin_index.php');

    }

    else {

    if(isset($_POST['submit'])) {

        //Check username and password

        $username = mysqli_escape_string($con, $_POST['email']);

        $password = mysqli_escape_string($con, hash('sha256', $_POST['password']));

        $sql = "SELECT AD_ID FROM ADMIN WHERE AD_EMAIL_ID = '$username' AND AD_PASSWORD = '$password'; ";
        
        $sqlResult = mysqli_query($con, $sql);

        if ( mysqli_num_rows( $sqlResult ) > 0 ) {

            $res = mysqli_fetch_assoc( $sqlResult );

            $_SESSION['ADID'] = $res['AD_ID'];

            header('location:admin_index.php');

        }

        else {

            $spanCheck = true;
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
            <h1 class="logo"><a href="../index.php">Amart<span>.</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li class="active"><a href="../index.php">Home</a></li>
                    <li class="drop-down"><a>Shop by Category</a>
                        <ul>

                    <?php displayCategory() ?>

                        </ul>
                    </li>
                    <li><a href="admin_index.php">Admin</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li class="active"><a href="../index.php">Home</a></li>
                            <li class="drop-down"><a>Shop by Category</a>
                                <ul>

                            <?php displayCategory() ?>

                                </ul>
                                <li><a href="admin_index.php">Admin</a></li>
                        </ul>
                        </li>
                </ul>
            </nav>
            <a href="../login.php" class="login-btn">Log In</a>
        </div>
    </header>

    <div class="admin_log_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color: #5d6a79;">Sign In*</h5>

                    <?php
                            if($spanCheck) { 
                    ?>
                                <h6 class="text-center" style="color:red"><b>Incorrect username (OR) password</b></h6><br>
                    <?php 
                            } 
                    ?>
                            <form class="form-signin" method="POST">
                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" name = "email" class="form-control" placeholder="Email address" required autofocus>
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" name = "password" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>
                                <button class="btn btn-lg btn-block text-uppercase" style="background-color: #000; color: #fff;" name = "submit" type="submit">Log in as admin</button>
                                <hr class="my-4">
                                <p style="color: #2196f3; margin-top: -5%; font-size: 12px;">*<b>Note:</b> Only to be accessed by the Admin</p>
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
</body>

</html>

<?php
    
}

?>