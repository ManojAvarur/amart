<?php

    require '../_headers/connection.php';

    global $con;

    if( isset( $_GET['category'] ) && !empty( $_GET['category']  ) ){

        $sql = "INSERT INTO category (CAT_NAME) VALUES ('" . mysqli_escape_string( $con, $_GET['category'] ) . "'); ";

        if( mysqli_query( $con,  $sql ) ){
            echo "<script> 
                        alert('Category has been inserted successfully!');
                        if( window.history.replaceState ){
                            window.history.replaceState( null, null, location.href='admin_category.php' );
                        }
                </script>";
        } else {
            echo "<script>
                        alert('Action failed, please re-try!');
                    </script>
            ";
        }

    }