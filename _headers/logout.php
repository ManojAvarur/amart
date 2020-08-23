<?php

    session_start();

    if ( isset( $_COOKIE['AMRMLO'] ) ){
 
        setcookie("AMRMLO", "", time() - 3600, "/");   

    }

    session_destroy();
    
    if(!isset($_GET['LD']))
        header('location:../index.php');
    else
        header('location:../admin/admin_login.php');
        
?>
    