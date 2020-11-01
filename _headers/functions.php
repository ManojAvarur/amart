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

    } else {
        return 0;
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

    global $msg1;
    global $msg2;

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

    $mail->addAddress($email);    

    $msg = $msg1;
    $msg .= "
                    <div style='color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
                        <div style='line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;'>
                            <p style='font-size: 14px; line-height: 1.2; word-break: break-word; text-align: right; mso-line-height-alt: 17px; margin: 0;'><strong><span style='font-size: 15px;'>Email:</span></strong></p>
                        </div>
                    </div>

        <!--[if mso]></td></tr></table><![endif]-->
        <!--[if (!mso)&(!IE)]><!-->
                </div>
        <!--<![endif]-->
            </div>
        </div>

        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td><td align='center' width='332' style='background-color:#000000;width:332px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
                    <div class='col num6' style='display: table-cell; vertical-align: top; max-width: 320px; min-width: 330px; width: 332px;'>
                        <div style='width:100% !important;'>
                            <!--[if (!mso)&(!IE)]><!-->
                            <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
                                <!--<![endif]-->
                                <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px; font-family: Arial, sans-serif'><![endif]-->
                                <div style='color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
                                    <div style='line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;'>
                                        <p style='font-size: 15px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 18px; margin: 0;'><span style='font-size: 15px;'>" . $email . "</span></p>
                                    </div>
                                </div>
                                <!--[if mso]></td></tr></table><![endif]-->
                                <!--[if (!mso)&(!IE)]><!-->
                            </div>
                            <!--<![endif]-->
                        </div>
                    </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                </div>
            </div>
        </div>

        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid two-up no-stack' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='332' style='background-color:#000000;width:332px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
        <div class='col num6' style='display: table-cell; vertical-align: top; max-width: 320px; min-width: 330px; width: 332px;'>
            <div style='width:100% !important;'>
                <!--[if (!mso)&(!IE)]><!-->
                <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
                    <!--<![endif]-->
                    <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px; font-family: Arial, sans-serif'><![endif]-->
                    <div style='color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
                        <div style='line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;'>
                            <p style='font-size: 14px; line-height: 1.2; word-break: break-word; text-align: right; mso-line-height-alt: 17px; margin: 0;'><strong><span style='font-size: 15px;'>Code Number:</span></strong></p>
                        </div>
                    </div>
                    <!--[if mso]></td></tr></table><![endif]-->
                    <!--[if (!mso)&(!IE)]><!-->
                </div>
                <!--<![endif]-->
            </div>
        </div>

        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td><td align='center' width='332' style='background-color:#000000;width:332px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
        <div class='col num6' style='display: table-cell; vertical-align: top; max-width: 320px; min-width: 330px; width: 332px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px; font-family: Arial, sans-serif'><![endif]-->
        <div style='color:#ffffff;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;line-height:1.2;padding-top:5px;padding-right:10px;padding-bottom:5px;padding-left:10px;'>
            <div style='line-height: 1.2; font-size: 12px; color: #ffffff; font-family: Arial, Helvetica Neue, Helvetica, sans-serif; mso-line-height-alt: 14px;'>
                <p style='font-size: 15px; line-height: 1.2; color: #C69962; word-break: break-word; text-align: left; mso-line-height-alt: 18px; margin: 0;'><span style='font-size: 15px;'>" . $val . "</span></p>
            </div>
        </div>
    ";
    $msg .= $msg2;
    
    $mail->isHTML(true);                                  // Set email format to HTML
    // $message = "<strong> Hello! '".$email."'  =  $val </strong>";

    $mail->Subject = 'Verification Message';
    // $mail->Body    = $message;//'This is the HTML message body <b>in bold!</b>';
    $mail->Body    = $msg;//$message;//'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        // echo "<script> alert('Message could not be sent \n Error Info :  $mail->ErrorInfo ') </script>";
        die("<script> alert('Message could not be sent \n Error Info :  $mail->ErrorInfo ') </script>");
    }

}



function echoCategories($check = 0, $escape = 0){

    global $con;

    $sql = "SELECT CAT_ID, CAT_NAME FROM category";

    $sql = mysqli_query( $con, $sql );

    

        if($check){
            while ( $row = mysqli_fetch_assoc( $sql )) {
                if( $row['CAT_ID'] != $escape )
                    echo "<option value='" . $row['CAT_ID'] . "'> " . $row['CAT_NAME'] . " </option>";
            }
        } else {
            while ( $row = mysqli_fetch_assoc( $sql )) 
                echo "<option value='" . $row['CAT_ID'] . "'> " . $row['CAT_NAME'] . " </option>";
        }

}

function displayCategory() {

    global $con;

    $query = "SELECT CAT_ID, CAT_NAME FROM CATEGORY; ";

    $query = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc( $query )) { 

        $cid =  $row['CAT_ID'];
        $name = $row['CAT_NAME'];

        // echo '<a href="../category.php?cate=' . $cid . '>' . $row['CAT_NAME'] . '</a>';
        echo "<li> <a href = 'category.php?cate=". $cid ."'>" . $row['CAT_NAME'] . "</a></li>" ;
    }

}
// <li><a href="living_room.html">Living Room</a></li>

function dataDelete( $a1, $a2 ){

    global $con;

    $sql = "DELETE FROM PRODUCT WHERE PRD_ID = '". $a1[0] ."' ";    

   if( !mysqli_query( $con, $sql ) ){
    echo "<script> alert(' Deletion of product failed. Try Updating the product ') </script>";
   }

   for( $i = 1; $i < count($a1); $i++ ){

        $sql = "DELETE FROM PRD_IMAGE WHERE IMG_PATH = '". $a1[$i] ."' ";

        if( !mysqli_query( $con, $sql ) ){
            echo "<script> alert(' Deletion of Image failed. Try Updating the product ') </script>";
           }

   }

   for( $i = 0; $i < count($a2); $i++ ){

    unlink($a2[$i]);

   }


}



$msg1 = "
    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

    <html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
    <head>
    <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
    <meta content='width=device-width' name='viewport'/>
    <!--[if !mso]><!-->
    <meta content='IE=edge' http-equiv='X-UA-Compatible'/>
    <!--<![endif]-->
    <title></title>
    <!--[if !mso]><!-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <!--<![endif]-->
    <style type='text/css'>
            body {
                margin: 0;
                padding: 0;
            }

            table,
            td,
            tr {
                vertical-align: top;
                border-collapse: collapse;
            }

            * {
                line-height: inherit;
            }

            a[x-apple-data-detectors=true] {
                color: inherit !important;
                text-decoration: none !important;
            }
            .logo{
                font-size: 32px;
                color: white;
                margin: 0;
                padding: 0;
                line-height: 1;
                font-weight: 700;
                letter-spacing: 2px;
                text-transform: uppercase;
            }
            .he{
                font-size: 15px;
                color: #C69962;
            }
        </style>
    <style id='media-query' type='text/css'>
            @media (max-width: 685px) {

                .block-grid,
                .col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important;
                }

                .block-grid {
                    width: 100% !important;
                }

                .col {
                    width: 100% !important;
                }

                .col>div {
                    margin: 0 auto;
                }

                img.fullwidth,
                img.fullwidthOnMobile {
                    max-width: 100% !important;
                }

                .no-stack .col {
                    min-width: 0 !important;
                    display: table-cell !important;
                }

                .no-stack.two-up .col {
                    width: 50% !important;
                }

                .no-stack .col.num2 {
                    width: 16.6% !important;
                }

                .no-stack .col.num3 {
                    width: 25% !important;
                }

                .no-stack .col.num4 {
                    width: 33% !important;
                }

                .no-stack .col.num5 {
                    width: 41.6% !important;
                }

                .no-stack .col.num6 {
                    width: 50% !important;
                }

                .no-stack .col.num7 {
                    width: 58.3% !important;
                }

                .no-stack .col.num8 {
                    width: 66.6% !important;
                }

                .no-stack .col.num9 {
                    width: 75% !important;
                }

                .no-stack .col.num10 {
                    width: 83.3% !important;
                }

                .video-block {
                    max-width: none !important;
                }

                .mobile_hide {
                    min-height: 0px;
                    max-height: 0px;
                    max-width: 0px;
                    display: none;
                    overflow: hidden;
                    font-size: 0px;
                }

                .desktop_hide {
                    display: block !important;
                    max-height: none !important;
                }
            }
        </style>
    </head>

    <body class='clean-body' style='margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #000000;'>
        <!--[if IE]><div class='ie-browser'><![endif]-->
        <table bgcolor='#000000' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='table-layout: fixed; vertical-align: top; min-width: 320px; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #000000; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td style='word-break: break-word; vertical-align: top;' valign='top'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color:#000000'><![endif]-->
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <div></div>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <div></div>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <div align='center' class='img-container center autowidth' style='padding-right: 10px;padding-left: 10px;'>
        <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr style='line-height:0px'><td style='padding-right: 10px;padding-left: 10px;' align='center'><![endif]-->
        <div style='font-size:1px;line-height:10px'> </div>
        <h1 class='logo'>SMART<span class='he'>ELECTRONICS</span></h1>
        <div style='font-size:1px;line-height:15px'> </div>
        <!--[if mso]></td></tr></table><![endif]-->
        </div>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;' valign='top'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='40' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 40px; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td height='40' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 25px; padding-left: 25px; padding-top: 0px; padding-bottom: 0px; font-family: Arial, sans-serif'><![endif]-->
        <div style='color:#ffffff;font-family:'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;line-height:1.2;padding-top:0px;padding-right:25px;padding-bottom:0px;padding-left:25px;'>
        <div style='line-height: 1.2; font-size: 12px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #ffffff; mso-line-height-alt: 14px;'>
        <p style='font-size: 30px; line-height: 1.2; word-break: break-word; text-align: center; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; mso-line-height-alt: 36px; margin: 0;'><span style='font-size: 30px; color: white;'><strong>Hey! </strong><br>Your Activation Code is:</span></p>
        </div>
        </div>
        <!--[if mso]></td></tr></table><![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;' valign='top'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='20' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 20px; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td height='20' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #BBBBBB; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid two-up no-stack' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='332' style='background-color:#000000;width:332px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
        <div class='col num6' style='display: table-cell; vertical-align: top; max-width: 320px; min-width: 330px; width: 332px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <!--[if mso]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 10px; padding-left: 10px; padding-top: 5px; padding-bottom: 5px; font-family: Arial, sans-serif'><![endif]-->
        ";

    $msg2 = "
        <!--[if mso]></td></tr></table><![endif]-->
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;' valign='top'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 1px solid #BBBBBB; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <div style='background-color:transparent;overflow:hidden'>
        <div class='block-grid' style='min-width: 320px; max-width: 665px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; Margin: 0 auto; width: 100%; background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color:#000000;'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:transparent;'><tr><td align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:665px'><tr class='layout-full-width' style='background-color:#000000'><![endif]-->
        <!--[if (mso)|(IE)]><td align='center' width='665' style='background-color:#000000;width:665px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;' valign='top'><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;'><![endif]-->
        <div class='col num12' style='min-width: 320px; max-width: 665px; display: table-cell; vertical-align: top; width: 665px;'>
        <div style='width:100% !important;'>
        <!--[if (!mso)&(!IE)]><!-->
        <div style='border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;'>
        <!--<![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' class='divider' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td class='divider_inner' style='word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;' valign='top'>
        <table align='center' border='0' cellpadding='0' cellspacing='0' class='divider_content' height='20' role='presentation' style='table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid transparent; height: 20px; width: 100%;' valign='top' width='100%'>
        <tbody>
        <tr style='vertical-align: top;' valign='top'>
        <td height='20' style='word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;' valign='top'><span></span></td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (!mso)&(!IE)]><!-->
        </div>
        <!--<![endif]-->
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
        </div>
        </div>
        </div>
        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        </td>
        </tr>
        </tbody>
        </table>
        <!--[if (IE)]></div><![endif]-->
    </body>
    </html>
";