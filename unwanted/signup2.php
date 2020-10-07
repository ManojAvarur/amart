<?php include "_headers/connection.php" ?>

<?php

global $con;

//------------------------------------------------ Values initialisation ----------------------------------------------------------- 

if(isset($_POST['submit'])) {

    $fname = mysqli_escape_string($con, $_POST['fname']);

    $email = mysqli_escape_string($con, $_POST['email']);

    $phone = mysqli_escape_string($con, $_POST['phone']);

    $password = mysqli_escape_string($con, $_POST['password']);


// ----------------------------------------------- Email ID already exists!? ---------------------------------------------------------

    // $emailCheck = "SELECT EMAIL_ID FROM LOGIN WHERE EMAIL_ID = $email; ";

    // $qemailCheck = mysqli_query($con, $emailCheck);

    // echo mysqli_num_rows($qemailCheck);
    // if(mysqli_num_rows($qemailCheck)) {
    //     die(" Email already exists! Try to login! ! ");
    // }

    // else {

// ---------------------------------------------- Phone number already exists!? -------------------------------------------------------
        
        // $phoneCheck = "SELECT USER_PHNO FROM LOGIN WHERE USER_PHNO = $phone; ";

        // $qphoneCheck = mysqli_query($con, $phoneCheck);

        // if(mysqli_num_rows($qphoneCheck)){
        //     die(" Phone number already exists! Try to login!! ");
        // }

        // else{

// -------------------------------------------------- ID generated!? ---------------------------------------------------------

            $ID = md5( $email. dechex( time() ) );
            
// ----------------------------------------------- Password confirmation mismatched!? --------------------------------------------------

            if ($password == $_POST['c_password']) {

                $password = hash('sha256',$password);

                $insert  = "INSERT INTO LOGIN VALUES ('$ID', '$email', '$password', '$fname', $phone); ";
            
                $qinsert = mysqli_query($con, $insert);

                if (!$qinsert) {

                    if(  mysqli_error($con)  == "Duplicate entry '" . $email . "' for key 'EMAIL_ID'"){

                        echo "<script> alert('" . $email . " Mail already exists! '); </script>";
                    
                    } else {

                        die ("Query execution failed! " . mysqli_error($con));  // HAD TO BE CHANGED

                    }
                    
                } 
            }

            else {

                die(" Password did'nt match! ");

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

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<body>
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="index.html">Amart<span>.</span></a></h1>
            <nav class="nav-bar d-none d-lg-block">
                <ul>
                    <li class="active"><a href="index.html">Home</a></li>
                    <li class="drop-down"><a>Shop by Category</a>
                        <ul>
                            <li><a href="electronics.html">Electronics</a></li>
                            <li><a href="hardware.html">Hardware</a></li>
                            <li><a href="kitchen.html">Kitchen Appliances</a></li>
                            <li><a href="living_room.html">Living Room</a></li>
                        </ul>
                    </li>
                    <li><a href="admin_home.html">Admin</a></li>
                </ul>
            </nav>
            <nav class="nav-bar d-lg-none d-sm-block">
                <ul>
                    <li class="drop-down">
                        <a></a>
                        <ul>
                            <li class="active"><a href="index.html">Home</a></li>
                            <li class="drop-down"><a>Shop by Category</a>
                                <ul>
                                    <li><a href="electronics.html">Electronics</a></li>
                                    <li><a href="hardware.html">Hardware</a></li>
                                    <li><a href="kitchen.html">Kitchen Appliances</a></li>
                                    <li><a href="living_room.html">Living Room</a></li>
                                </ul>
                                <li><a href="admin_home.html">Admin</a></li>
                        </ul>
                        </li>
                </ul>
            </nav>
            <a href="login.html" class="login-btn">Log In</a>
        </div>
    </header>

    <div class="sign_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign Up</h5>




                            <form class="form-signin" method="post" action="signup.php">

                                <div class="form-label-group">
                                    <input type="text" id="inputName" class="form-control" name = "fname" placeholder="Full Name" required autofocus>
                                    <label for="inputName">Full Name</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="email" id="inputEmail" class="form-control" name = "email" placeholder="Email address"  required autofocus>
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="tel" id="inputNumber" class="form-control" name="phone" placeholder="Contact Number"  pattern="[0-9]{10}" required autofocus>
                                    <label for="inputNumber">Contact Number</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword" class="form-control" name = "password" placeholder="Password" required>
                                    <label for="inputPassword">Password</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword1" class="form-control" name = "c_password" placeholder="Password" required>
                                    <label for="inputPassword1">Confirm Password</label>
                                </div>

                                <button class="btn btn-lg btn-block text-uppercase" style="background-color: #000; color: #fff;" type="submit" name = "submit" >Create Account</button>
                                <p style="padding-top: 3%; text-align: right; margin-right: 2%;">Existing User? <span><a href="login.html">Log In</a></span></p>
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

