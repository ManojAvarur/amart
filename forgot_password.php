<?php

require "_headers/connection.php" ;
 
require "_headers/functions.php" ;

global $con;

$spanCheck = 0;

session_start();

if( isset( $_SESSION['ID'] ) ){

    header('location:index.php');

}

cookieCheck();

if( isset( $_GET['ef0176f7b6e2c9a23e0238c07c4af0cc'] ) ){

    if( $_GET['ef0176f7b6e2c9a23e0238c07c4af0cc'] == "5798c9e47ce8b1f58a8d73f93c054d0d" )
        session_destroy();
        unset( $_POST['ver_submit'] );
        unset( $_POST['reinsert_password'] );
        unset( $_POST );

}

if( isset( $_POST['submit'] )  ){


    $email = mysqli_escape_string( $con, $_POST['emailid'] );

    $sql = "SELECT LOGIN_ID FROM login WHERE EMAIL_ID = '" . $email . "' ";

    $sql = mysqli_query( $con, $sql);

    if( mysqli_num_rows( $sql ) > 0 ){

        $verification = rand(1000000,9999999);
        $_SESSION['frgtPass']['verification'] = $verification;
        
        $_SESSION['LOGIN_ID'] = mysqli_fetch_row( $sql )[0];
        $_SESSION['frgtPass']['email'] = $email;
        mailing($email,$verification);
        unset($_POST['submit']);


    } else {

        echo "<script> 
                alert('Email ID : \'".$email."\' doesn\'t Exist! ');
                if( window.history.replaceState ){
                    window.history.replaceState( null, null, location.href='forgot_password.php' );
                }
            </script>";

    }

}

if( isset( $_POST['ver_submit'] ) && isset( $_SESSION['frgtPass'] ) ){

    if( $_POST['passcode'] == $_SESSION['frgtPass']['verification'] ){
        unset( $_SESSION['frgtPass'] );
        unset( $_POST['ver_submit'] );

    } else {
        $spanCheck = 1;
    }

}

if( isset( $_POST['reinsert_password'] ) && isset( $_SESSION['LOGIN_ID'] ) ){

    $password = mysqli_escape_string($con, hash( 'sha256' , $_POST['password'] ) );

    $sql  = "UPDATE login SET USER_PASSWORD = '" . $password . "' WHERE LOGIN_ID = '" . $_SESSION['LOGIN_ID'] . "';";
            
    if( !mysqli_query($con, $sql) ){

        echo "<script> 
                alert('Password updation failed. \\n Please try again!');
                if( window.history.replaceState )
                 window.history.replaceState( null, null, location.href='forgot_password.php' );
            </script>";
    } else {

        session_destroy();

        echo "<script> 
                    alert('Password updation successful!'); 
                    if( window.history.replaceState )
                    window.history.replaceState( null, null, location.href='login.php' );
                </script> ";


    }

    // echo "<script> 
    //         if( window.history.replaceState )
    //             window.history.replaceState( null, null, location.href='forgot_password.php' );
    //         </script> 
    //     ";
    
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
    <style>
        .disabled-link{
        cursor: default;
        pointer-events: none;        
        text-decoration: none;
        color: grey;
    }
    </style>
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
            <a href="login.php" class="login-btn">Log In</a>
        </div>
    </header>

    <div class="log_main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">


                        <?php
                            if ( isset( $_SESSION['LOGIN_ID'] ) && !isset( $_SESSION['frgtPass'] ) ){

                                echo "
                                
                                <h5 class='card-title text-center'>Enter New Password</h5>
                                <form class='form-signin' action='forgot_password.php' method='POST' onSubmit='return checkPassword(this)'>
                                    <div class='form-label-group'>
                                        <input type='password' id='inputPassword' class='form-control' placeholder='Password' name='password' required >
                                        <label for='inputPassword'>New Password</label>
                                    </div>
    
                                    <div class='form-label-group'>
                                        <input type='password' id='inputPassword1' class='form-control' placeholder='Password' name='conf_password' required >
                                        <label for='inputPassword1'>Confirm Password</label>
                                    </div>
    
                                    <button class='btn btn-lg btn-block text-uppercase' name='reinsert_password' style='background-color: #000; color: #fff;' type='submit'>Submit</button>
                                    <hr class='my-4'>
                                </form>
                                
                                ";

                            } else if( isset( $_SESSION['frgtPass'] ) ) {       

                                echo "
                                        <h5 class='card-title text-center'>Email Verification!</h5>
                                        <p style='margin-top: -8%;padding-bottom: 5%;text-align: center;'>Check your mail '" . $_SESSION['frgtPass']['email'] . "' for activation passcode</p>

                                    ";

                                if( $spanCheck )
                                    echo "<h6 class='text-center' style='color: red;'><strong>Incorrect passcode! Please try it again </strong> </h6>";
                        
    
                                echo "
                                        <form class='form-signin' action='forgot_password.php' method='post'>
                                            <div class='form-label-group'>
                                                <input type='text' name='passcode' id='inputEmail' class='form-control' placeholder='Email address' required autofocus>
                                                <label for='inputEmail'>Enter the Passcode</label>
                                            </div>

                                            <button class='btn btn-lg btn-block text-uppercase' style='background-color: #000; color: #fff;' name='ver_submit' type='submit'>Submit</button>
                                            <p style='padding-top: 3%; text-align: right; margin-right: 2%;'>Didn't receive a mail? 
                                                <span>
                                                    <a href='' id='linkRef'>Try Again</a>
                                                </span>
                                            </p>
                                            <p style='padding-top: 3%; text-align: right; margin-right: 2%;'>Incorrect Mail?
                                                <span>
                                                    <a href='_headers/destroyCode.php' id='mailReset'>Click Here</a>
                                                </span>
                                            </p>
                                            <hr class='my-4'>
                                        </form>
                            
                                    ";
                            

                            } else if(  !isset( $_SESSION['frgtPass'] ) && !isset( $_SESSION['LOGIN_ID'] ) ) {
                       
                                echo "

                                        <h5 class='card-title text-center'>Forgot Password?</h5>
                                        <p style='margin-top: -8%;padding-bottom: 5%;text-align: center;'>Enter your email to get the passcode</p>

                                        <form class='form-signin' method='post' action='forgot_password.php'>
                                            <div class='form-label-group'>
                                                <input type='email' id='inputEmail' name='emailid' class='form-control' placeholder='Email address' required autofocus>
                                                <label for='inputEmail'>Enter the Email</label>
                                            </div>

                                            <button class='btn btn-lg btn-block text-uppercase' name='submit' style='background-color: #000; color: #fff;' type='submit'>Submit</button>
                                            <!-- <p style='padding-top: 3%; text-align: right; margin-right: 2%;'>Didn't receive a mail? <span><a href='signup.html'>Try Again</a></span></p> -->
                                            <hr class='my-4'>
                                        </form>

                                    ";

                            }
                        ?>


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

    <script type = "text/javascript"> 

        var myvar = setInterval(myTimer, 1000);
        var timerSec = 30; 
        var counter = timerSec;
        var Link = document.getElementById("linkRef");
        Link.href = "javascript:void(0)";
        Link.classList.add("disabled-link");

        function myTimer() {
            Link.innerHTML = " Try After : "+counter+"sec";
            
            counter = counter - 1;

            if(counter<0){
                clearInterval(myvar);
                counter = timerSec;
                Link.href = "_headers/resendmail.php";   
                Link.innerHTML = " Try Again";
                Link.classList.remove("disabled-link");
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
</body>

</html>