<?php 
require "_headers/connection.php"; 
require "_headers/functions.php";

session_start();

if( isset( $_SESSION['ID'] ) ){

    header('location:index.php');

} else {

cookieCheck();

global $con;

if(isset($_POST['submit'])) {

    $email = mysqli_escape_string($con, $_POST['email']);

    $emailCheck = "SELECT * FROM LOGIN WHERE EMAIL_ID = '$email'; ";

    $qemailCheck = mysqli_query($con, $emailCheck);

    if(mysqli_num_rows($qemailCheck) > 0) {

        echo "<script> alert('"  . $email . " Mail already exists! '); </script>";

        echo "<script> if( window.history.replaceState ){
            window.history.replaceState( null, null, location.href='signup.php' );
           }
            </script>";     

        

    } else {

        $_SESSION['postdata'] = $_POST;   

        $verification = rand(1000000,9999999);
        
        $_SESSION['postdata']['verification'] = $verification;

        mailing($email,$verification);

        echo "<script> if( window.history.replaceState ){
                         window.history.replaceState( null, null, location.href='registration_confirmation.php' );
                        }
             </script>";

    }
}   
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Smart Electronics</title>
    <meta content="smart, smart sales, smart electronics india" name="description">
    <meta content="Smart, India, Sales, Refrigerator Sales, TV Sales, Hardware Sales" name="keywords">
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
            <h1 class="logo"><a href="index.php">Smart<span class="he">Electronics</span></a></h1>
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
            <a href="login.php" class="login-btn">Log In</a>
        </div>
    </header>

    <div class="sign_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign Up</h5>
                            <form class="form-signin" name="signupform" method="POST" action="signup.php" onSubmit="return checkPassword(this)">
                                <div class="form-label-group">
                                    <input type="text" name="fname" id="inputName" class="form-control" placeholder="Full Name" required autofocus onKeyup="checkform()">
                                    <label for="inputName">Full Name</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus onKeyup="checkform()">
                                    <label for="inputEmail">Email address</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="tel" name="phone" id="inputNumber" class="form-control" placeholder="Contact Number" required autofocus onKeyup="checkform()" pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9">
                                    <label for="inputNumber">Contact Number</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required onKeyup="checkform()" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="UpperCase, LowerCase, Number/SpecialChar and min 8 Chars">
                                    <label for="inputPassword">Password</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="inputPassword1" class="form-control" placeholder="Password" name="conf_password" required onKeyup="checkform()">
                                    <label for="inputPassword1">Confirm Password</label>
                                </div>
                                <input id="submitbutton" class="btn btn-lg btn-block text-uppercase" name="submit"  type="submit" style="background-color: #000; color: #fff;" disabled="disabled" value="Submit" />
                                <p style="padding-top: 3%; text-align: right; margin-right: 2%;">Existing User? <span><a href="login.php">Log In</a></span></p>
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


<script type="text/javascript" language="javascript">
    function checkform() {
        var f = document.forms["signupform"].elements;
        var c = true;
        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0)
                c = false;
        }
        if (c) {
            document.getElementById('submitbutton').disabled = !c;
        }
    }

    function checkPassword(form) {
        var password = form.password.value;
        var conf_password = form.conf_password.value;
        if (password != conf_password) {
            alert("PASSWORDS DO NOT MATCH: \nPlease try again...");
            document.getElementById('inputPassword1').value = ""; 
            return false;
        }    
    }
</script>

</html>

<?php
}
?>