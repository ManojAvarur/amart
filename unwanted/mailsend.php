<?php




require '../_headers/PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->SMTPDebug = 1;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  //'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('no-replay@gmail.com', 'Big Baazar');

$mail->addAddress('keerthanaravikumarnaidu@gmail.com');     // Add a recipient



$message = '<html><body>';
$message .= '<h1>Hello, World!</h1>';
$message .= '</body></html>';
$message = '<html><body>';
$message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "<tr><td><strong>Email:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "<tr><td><strong>Urgency:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";




// $mail->addAddress('ellen@example.com');               // Name is optional

// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$message = "<strong> Hello! </strong>";

$mail->Subject = 'Notice from Smart Electronics';
$mail->Body    = $message;//'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}































// $to = 'keerthanaravikumarnaidu@example.com';

// $subject = 'How/'s the Css';

// $headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
// $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
// $headers .= "CC: susan@example.com\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



// $to = "keerthanaravikumarnaidu@example.com";
// $subject = "How's the Css";

// // $message = "<b>This is HTML message.</b>";
// // $message .= "<h1>This is headline.</h1>";

// $header = "From:abc@somedomain.com \r\n";
// $header .= "Cc:afgh@somedomain.com \r\n";
// $header .= "MIME-Version: 1.0\r\n";
// $header .= "Content-type: text/html\r\n";

// $retval = mail ($to,$subject,$message,$header);

// if( $retval == true ) {
//    echo "Message sent successfully...";
// }else {
//    echo "Message could not be sent...";
// }

// error_reporting(-1);

// $to_email = "keerthanaravikumarnaidu@gmail.com";
// $subject = "Simple Email Test via PHP";
// $body = "Hi,nn This is test email send by PHP Script";
// $headers = "From: sender\'s email";

// if(mail($to_email, $subject, $body, $headers)) 
// {
//     echo "Done";
// //     echo "Email successfully sent to ";
// } else {
// //     echo "Email sending failed...";
// echo "Not Done";
// print_r(error_get_last());
// ini_set('log_errors',TRUE);
// ini_set('error_log','/path/to/logfile/error.log');

// }


// $message = '<html><body>';
// $message .= '<h1>Hello, World!</h1>';
// $message .= '</body></html>';
// $message = '<html><body>';
// $message .= '<img src="//css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Website Change Request" />';
// $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
// $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// $message .= "<tr><td><strong>Email:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// $message .= "<tr><td><strong>Type of Change:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// $message .= "<tr><td><strong>Urgency:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// $message .= "<tr><td><strong>URL To Change (main):</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// // $addURLS = $_POST['addURLS'];
// // if (($addURLS) != '') {
// //     $message .= "<tr><td><strong>URL To Change (additional):</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// // }
// // $curText = htmlentities($_POST['curText']);  
// // if (($curText) != '') {
// //     $message .= "<tr><td><strong>CURRENT Content:</strong> </td><td>" . $curText . "</td></tr>";
// // }
// $message .= "<tr><td><strong>NEW Content:</strong> </td><td>" . "<strong> Trying out the HTML and CSS in emails </strong>" . "</td></tr>";
// $message .= "</table>";
// $message .= "</body></html>";


// $to = 'keerthanaravikumarnaidu@example.com';

// $subject = 'How\'s the Css';

// $headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
// $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
// $headers .= "CC: susan@example.com\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



// $to = "keerthanaravikumarnaidu@example.com";
// $subject = "How's the Css";

// // $message = "<b>This is HTML message.</b>";
// // $message .= "<h1>This is headline.</h1>";

// $header = "From:abc@somedomain.com \r\n";
// $header .= "Cc:afgh@somedomain.com \r\n";
// $header .= "MIME-Version: 1.0\r\n";
// $header .= "Content-type: text/html\r\n";

// $retval = mail ($to,$subject,$message,$header);

// if( $retval == true ) {
//    echo "Message sent successfully...";
// }else {
//    echo "Message could not be sent...";
// }

// error_reporting(-1);

// $to_email = "keerthanaravikumarnaidu@gmail.com";
// $subject = "Simple Email Test via PHP";
// $body = "Hi,nn This is test email send by PHP Script";
// $headers = "From: sender\'s email";

// if(mail($to_email, $subject, $body, $headers)) 
// {
//     echo "Done";
// //     echo "Email successfully sent to ";
// } else {
// //     echo "Email sending failed...";
// echo "Not Done";
// print_r(error_get_last());
// ini_set('log_errors',TRUE);
// ini_set('error_log','/path/to/logfile/error.log');

// }