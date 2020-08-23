<?php

// error_reporting(0);

require "connection.php";
require 'PHPMailer/PHPMailerAutoload.php';


function randomStringForCookie($email, $loginID){

    $str = "3T10ZozMiOPOUKsEy8xLA0A5SumftkHNycXGDgCoOdtugJdAHP6HwZ4u7rhvbygJ91xh3w5QvtpnYR1ZhipjQvQzr7FeZ7gNP5tmMoN4MWjYF0sj8rNB3Vp5lRhLsk1yMMkk1O2B7bQ5HVMCG9Peaf77fKmLMvQSygwR3msId599jg5Um3eGneJFPKOdZX5xGtXadGbVxQeuQUZlqQ5NaJkYTAxSBeHDH9QB8nmjCEAQKPv6";
    $md5 = md5($email.$loginID);
    $pos = 0;

    preg_match_all('!\d!', $str, $matches);
    $pos = (int)$matches[0][4].$matches[0][count($matches[0])-4];

    return substr_replace( $str, $md5, $pos, 0 );

}


function cookieCheck($location='index.php'){

    if( isset( $_COOKIE['AMRMLO'] ) && ( $_COOKIE['AMRMLO'] != "" ) ){

        global $con;

        $execution = "SELECT CK_LOGIN_ID FROM cookie WHERE CK_VALUE  = ";
        $execution .="'" . mysqli_escape_String($con, $_COOKIE['AMRMLO']) . "'; ";

        $qexecution = mysqli_query($con, $execution);

        if( mysqli_num_rows( $qexecution ) > 0 ){

            $result = mysqli_fetch_assoc($qexecution);

            $_SESSION['ID'] = $result['CK_LOGIN_ID'];

            header('location:'.$location);

        } 
       

    }

}


function setBasicInfo($ID, $check = true){

    global $con;


    if($check) {

        $querry = " SELECT EMAIL_ID, USER_FNAME, USER_PHNO FROM login ";
        $querry .= "WHERE LOGIN_ID = '$ID'";

        $_SESSION['BASICINFO'] = mysqli_fetch_assoc( mysqli_query( $con, $querry ) );
    }

    else {

        $querry = " SELECT AD_EMAIL_ID, AD_FIRSTNAME, AD_PHNO FROM admin ";
        $querry .= "WHERE AD_ID = '$ID'";

        $_SESSION['ADBASICINFO'] = mysqli_fetch_assoc( mysqli_query( $con, $querry ) );
    }

    
}



function mailing($email, $val){

    $mail = new PHPMailer;
    // $mail->SMTPDebug = 1;
    $mail->isSMTP();                                       
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'madevil.406@gmail.com';                 
    $mail->Password = 'NS@200#LOVE';                           
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                 

    $mail->setFrom('no-replay@gmail.com', 'Amart');

    $mail->addAddress($email);    


    $mail->isHTML(true);                                  // Set email format to HTML
    $message = "<strong> Hello! '".$email."'  =  $val </strong>";

    $mail->Subject = 'Verification Message';
    $mail->Body    = $message;//'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo "<script> alert('Message could not be sent \n Error Info :  $mail->ErrorInfo ') </script>";
        die();
    }

}



function echoCategories(){

    global $con;

    $sql = "SELECT CAT_ID, CAT_NAME FROM category";

    $sql = mysqli_query( $con, $sql );

    while ( $row = mysqli_fetch_assoc( $sql )) {

        echo "<option value='" . $row['CAT_ID'] . "'> " . $row['CAT_NAME'] . " </option>";
       
    }

}