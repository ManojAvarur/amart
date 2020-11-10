<?php
    require "connection.php";
    require 'PHPMailer/PHPMailerAutoload.php';

    session_start();
    global $con;

    if( isset( $_SESSION['ID'] ) ){
        $message = "";
        $heading = "";  
        $table1 = "
            <br>
            <br>
            <table style='width:50%; border: 1px solid black;'>

                <tr>
                    <th style='border: 1px solid black;'>Product Name</th>
                    <th style='border: 1px solid black;'>Product Offers</th>
                    <th style='border: 1px solid black;'>Product Quantity</th>
                    <th style='border: 1px solid black;'>Product Total Price</th>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
        ";

        $table2="";
        $sum = 0.0;
        $lid = mysqli_escape_string( $con, $_SESSION['ID'] );
        $sql = "SELECT EMAIL_ID, USER_FNAME FROM login WHERE LOGIN_ID = '" . $lid . "';" ; 
        // die($sql);
        $sql = mysqli_query( $con, $sql );

        if( mysqli_num_rows( $sql ) > 0 ){

            $exe =  mysqli_fetch_assoc( $sql );
            $user_mail = $exe['EMAIL_ID'];
            $user_name = $exe['USER_FNAME'];
            // print_r($exe);
            // die();
            $message = " Hello " . $user_name .", your orders are : \n\n";
            $heading = " <h3> Hello " . $user_name . ", your orders are : </h3> " ;  
    
            $sql = "SELECT CRT_PRD_ID, CRT_QUANTITY FROM cart WHERE CRT_LOGIN_ID = '" . $lid . "';" ;
            $sql = mysqli_query( $con, $sql );

            if( mysqli_num_rows( $sql ) > 0 ){

                while( $res = mysqli_fetch_assoc( $sql ) ){

                    $query = "SELECT PRD_NAME, PRD_OFFERS, PRD_PRICE FROM product WHERE PRD_ID = '" . $res['CRT_PRD_ID'] . "';" ;
                    // die($query)
                    $query = mysqli_query( $con, $query );

                    if(  mysqli_num_rows( $query ) > 0 ){
                        $prdRes = mysqli_fetch_assoc( $query );
                        $message .= "Product Name : ". $prdRes['PRD_NAME']. " => ";

                        $amt = (float)$prdRes['PRD_PRICE'] * (int)$res['CRT_QUANTITY'];
                        $sum = $sum + $amt;
                        $message .= $prdRes['PRD_PRICE'] . " x " . $res['CRT_QUANTITY'] . " = " . $amt . "\n<br>";

                        $table2 .= "<td style='text-align:center;'>" . $prdRes['PRD_NAME'] . "</td>";
                        $table2 .= "<td style='text-align:center;'>" . $prdRes['PRD_OFFERS'] . "</td>";
                        $table2 .= "<td style='text-align:center;'>" . $res['CRT_QUANTITY'] . "</td>";
                        $table2 .= "<td style='text-align:center;'>" . $amt . "</td>";
                        $table2 .= "</tr> <tr> </tr> " ;
                    }
                }

                $table2 .= "<tr><td></td><td></td><td></td><td></td></tr><tr style='border-top: 1px solid black;'><th style='//border: 1px solid black;'></th> <th style='//border: 1px solid black;'> <h3> Total Amount </h3></th>
                <th  style='//border: 1px solid black;'>  </th><th  style='//border: 1px solid black;'> <h3>" . $sum . "</h3></th></tr></table>";

                // echo $message;
                // echo $table1 . $table2;
                
            }
        }
        

        $mail = new PHPMailer;
        // $mail->SMTPDebug = 1;   
        $mail->isSMTP();                                       
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                               
        $mail->Username = 'no.replay.amart@gmail.com';                 
        $mail->Password = 'amart@486';                           
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;                                 
    
        $mail->setFrom('no.replay.amart@gmail.com', 'Amart');
        $mail->isHTML(true); 
        
        $mail->Subject = 'Order Details';
        // $mail->Body    = $message;//'This is the HTML message body <b>in bold!</b>';
        $mail->Body    = $heading . $table1 . $table2 . "<br><hr><h1> Admin will contact you shortly. </h1>";//$message;//'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = $message . "Admin will contact you shortly. ";

        $mail->addAddress($user_mail);
        $mail->addAddress('no.replay.amart@gmail.com');

        if($mail->send()) {
            echo "Mail has been sent to your registerd email address!";
        } else {
            echo "Failed to place your order. \\n Please try again!";
        }

    }

?>