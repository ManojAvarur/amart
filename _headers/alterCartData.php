  <?php

    session_start();
    
    require "connection.php";
    require "functions.php";

    global $con;

    if( isset( $_POST['delete'] ) && isset( $_SESSION['ID'] ) && $_POST['delete'] != "" && !( isset( $_POST['updateQuantity'] ) ) && !( isset( $_POST['atc'] ) ) ){
        $lid = mysqli_escape_string( $con, $_SESSION['ID'] );
        $delete = mysqli_escape_string( $con, $_POST['delete'] );
        $sql = "DELETE FROM cart WHERE CRT_LOGIN_ID = '" . $lid . "' AND CRT_PRD_ID = '" . $delete . "'; ";

        // $myfile = fopen("newfile.txt", "w");
        // fwrite($myfile, $sql);
        // fclose($myfile);

        mysqli_query( $con, $sql );
        die();
    }

    if( isset( $_POST['token'] )  && isset( $_SESSION['ID'] ) && isset( $_POST['updateQuantity'] ) && $_POST['token'] != "" && $_POST['updateQuantity'] != "" && !( isset( $_POST['delete'] ) )  && !( isset( $_POST['atc'] ) ) ){

        if( $_POST['updateQuantity'] >= 1 && $_POST['updateQuantity'] < 5 ){
            $pid = mysqli_escape_string( $con, $_POST['token'] );
            $qunt = mysqli_escape_string( $con, (int)$_POST['updateQuantity']  );
            $lid = mysqli_escape_string( $con, $_SESSION['ID'] );

            $sql = "UPDATE cart ";
            $sql .= "SET CRT_QUANTITY = " . $qunt . " ";
            $sql .= "WHERE CRT_PRD_ID = '" . $pid . "' AND ";
            $sql .= "CRT_LOGIN_ID = '" . $lid . "'; ";
            mysqli_query( $con, $sql );
            echo "200";
        } else {
            echo "Quantity cannot be 0 and should be less than 5";
        }
    }

    if(  isset( $_POST['atc'] ) && isset( $_SESSION['ID'] ) && $_POST['atc'] != "" && !( isset( $_POST['updateQuantity'] ) ) && !( isset( $_POST['delete'] ) ) ){

        $pid = mysqli_escape_string( $con, $_POST['atc'] );
        $lid = mysqli_escape_string( $con, $_SESSION['ID'] );

        $sql = "SELECT * FROM cart WHERE CRT_LOGIN_ID = '" . $lid . "' AND CRT_PRD_ID = '" . $pid . "'; ";

        if( mysqli_num_rows( mysqli_query( $con, $sql ) ) > 0 ){
            echo "Product exists in your cart!";
        } else {
            $sql = "INSERT INTO cart VALUES ";
            $sql .= "( '" . $lid . "', ";
            $sql .= "'".$pid."', 1); ";

            mysqli_query( $con, $sql );

           echo "Added to cart!";
        }
    }

    ?>