<?php
date_default_timezone_set('Asia/Calcutta');
require 'PHPMailerAutoload.php';
$to= "shambhavi110@gmail.com";
$subject= "test";
$message= "test";
//Create a new PHPMailer instance
$mail = new PHPMailer();

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = '23.229.184.165';

//Set the SMTP port number - 465 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "gdgriviera@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "gdgriviera1";

//Set who the message is to be sent from
$mail->setFrom('gdgriviera@gmail.com', 'GDG');

//Set an alternative reply-to address
$mail->addReplyTo('gdgriviera@gmail.com', 'GDG');

//Set who the message is to be sent to
$mail->addAddress($to, 'Shambhavi');

//Set the subject line
$mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->Body = $message;

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>