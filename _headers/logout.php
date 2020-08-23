<?php
    require "connection.php";

    global $con;

    session_start();

    if ( isset( $_COOKIE['AMRMLO'] ) ){

        // $querry = "DELETE FROM cookie where CK_VALUE = '" . $_COOKIE['AMRMLO'] . "'; ";

        // mysqli_query($con, $querry);
    
        setcookie("AMRMLO", "", time() - 3600, "/");   

    }

    session_destroy();
    
    if(!isset($_GET['LD']))
        header('location:../index.php');
    else
        header('location:../admin/admin_login.php');
?>
    