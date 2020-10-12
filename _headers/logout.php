<?php

    session_start();

    if ( isset( $_COOKIE['AMRMLO'] ) ){
 
        setcookie("AMRMLO", "", time() - 3600, "/");   

    }
    
    if( !isset( $_SESSION['ADID'] ) )
        $loc = 'location:../index.php';
    else
        $loc = 'location:../admin/admin_login.php';

        session_destroy();

    if( isset( $loc ) )
        header($loc);
    else
        header('location:../index.php');
        
?>
    