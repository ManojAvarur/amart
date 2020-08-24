<?php
    require "functions.php";
    session_start();
    // error_reporting(0);

    if( isset( $_SESSION['postdata']['email'] ) && isset( $_SESSION['postdata']['verification'] ) ){

        mailing( $_SESSION['postdata']['email'], $_SESSION['postdata']['verification'] );
        // echo "<script> window.location.href='../registration_confirmation.php' </script>";   
        // header('location:../registration_confirmation.php');    

    }

    if( isset( $_SESSION['frgtPass']['verification'] ) && isset( $_SESSION['frgtPass']['email'] ) ){
        
        mailing( $_SESSION['frgtPass']['email'], $_SESSION['frgtPass']['verification'] );
        // header('location:../forgot_password_email.php');

    }

    header('location:'.$_SERVER['HTTP_REFERER'])

?>
