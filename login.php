<?php 

require "_headers/connection.php" ;
 
require "_headers/functions.php" ;

session_start();

if( isset( $_SESSION['ID'] ) ){

    header('location:index.php');


} else {

    cookieCheck();

    global $con; 

    $spanCheck = false;
 
    if(isset($_POST['submit'])) { 

        // Checking For Username and Password

        $username = mysqli_escape_string($con, $_POST['email']);                        

        $password = mysqli_escape_string($con, hash('sha256', $_POST['password'] ) );

        $execution = "SELECT LOGIN_ID FROM login WHERE EMAIL_ID = '$username' AND USER_PASSWORD = '$password'; ";

        $qexecution = mysqli_query($con, $execution);

        

        if(mysqli_num_rows($qexecution) > 0) { // Checking for successful execution of query

            $result = mysqli_fetch_assoc($qexecution);

            $_SESSION['ID'] = $result['LOGIN_ID'];


            if( isset( $_POST['rememberMe'] ) ){ // Checking for Remember Me Checkbox

                $cookieVal = randomStringForCookie( $username, $result['LOGIN_ID']);

                $expire = time()+91*24*60*60;

                setcookie("AMRMLO", $cookieVal, $expire, "/"); //Setting Cookie

                // die($cookieVal);

                $execution = "SELECT CK_LOGIN_ID FROM cookie WHERE CK_LOGIN_ID = '" . $result['LOGIN_ID'] . "'; ";

                $qexecution = mysqli_query($con, $execution);

                if(  mysqli_num_rows( $qexecution ) <= 0  ){

                    $execution = "INSERT INTO cookie (CK_LOGIN_ID, CK_VALUE) VALUES ";
                    $execution .= "( '" . $result['LOGIN_ID'] . "', '$cookieVal' ); ";

                    $qexecution = mysqli_query($con, $execution);

                    if( !$qexecution ){
                        echo "<script> alert('You can\'t be remembered'); </script>";
                    }

                }

            }

            echo "<script> if( window.history.replaceState ){
                window.history.replaceState( null, null, location.href='index.php' );
               }
                </script>";
                
        } else {
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

                <?php displayCategory() ?>

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

                        <?php displayCategory() ?>

                                </ul>
                                <li><a href="admin/admin_index.php">Admin</a></li>
                        </ul>
                        </li>
                </ul>
            </nav>
            <a href="signup.php" class="login-btn">Sign Up</a>
        </div>
    </header>

    <div class="log_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign In</h5>
                    <?php
                        if( $spanCheck  ){
                    ?>
                            <h6 class="text-center" style="color: red;"><strong>Incorrect Username (or) Password</strong></h6>
                            <br>
                    <?php
                        }
                    ?>
                            
                            <form class="form-signin" action="login.php" method="post">
                                <div class="form-label-group">
                                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <input type="checkbox" id="rememberMe" style="margin-left: 3%;" value="true" name="rememberMe"><label for="rememberMe" style="padding-left: 2%; padding-bottom: 3%;">Remember me</label>
                                <a href="forgot_password.php?140bedbf9c3f6d2ba70887=01&&e4fdcd380b2c0090=22541stringo&&ef0176f7b6e2c9a23e0238c07c4af0cc=5798c9e47ce8b1f58a8d73f93c054d0d&&ff52d77ce7f2a218ea3=3dad68202cf0ca46ca13b9d13b3cf338" class="forgot_pass">Forgot Password?</a>
                                <button class="btn btn-lg btn-block text-uppercase" name="submit" style="background-color: #000; color: #fff;" type="submit">Log in</button>
                                <p style="padding-top: 3%; text-align: right; margin-right: 2%;">New User? <span><a href="signup.php">Sign Up</a></span></p>
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

<?php
    }
?>