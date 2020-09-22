<?php

    require "../_headers/connection.php";

    session_start();

    if( isset( $_SESSION['prd'] ) && isset( $_SESSION['ADID'] ) ){

        global $con;

        $sql = "DELETE FROM prd_image WHERE IMG_PRD_ID = '" . $_SESSION['prd'][0][1] . "' ";
       

    //    die($_SESSION['prd'][0][5]."");
    // die($sql."");

       if( mysqli_query( $con, $sql ) ){
 
        $sql = "DELETE FROM product WHERE PRD_ID = '" . $_SESSION['prd'][0][1] . "' ";
            
            if( mysqli_query( $con, $sql ) ){

                if( file_exists( "../".$_SESSION['prd'][0][6] ) ){
                    unlink( "../".$_SESSION['prd'][0][6] );
                }

                unset(  $_SESSION['prd'] );

                echo "<script> 
                        alert('Product has been successfully deleted!');
                        window.location.href = 'admin_index.php';    
                    </script>";
                
            }

       } else {

        die( "<script>
                    alert('An error ocurred while deleting the product \\n Try again');
                    window.history.go(-1);
            </script>");
       }

    }