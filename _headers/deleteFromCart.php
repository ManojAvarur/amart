<?php

    session_start();
    
    require "connection.php";
    require "functions.php";

    global $con;

    if( isset( $_GET['delete'] ) && isset( $_SESSION['ID'] ) && $_GET['delete'] != "" ){
        $sql = "DELETE FROM cart WHERE CRT_LOGIN_ID = '" . $_SESSION['ID'] . "' AND CRT_PRD_ID = '" . $_GET['delete'] . "'; ";
        mysqli_query( $con, $sql );
    }