<?php
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
require '/home/bivek/vendor/autoload.php'; //importing autoload.php

//to remove noise from inputs
function test_input($data)
{
$data=trim($data);
$data=stripslashes($data);
$data=htmlspecialchars($data);
return $data;
}

//Send email function
function send_email($email,$message)
{
$mail=new PHPMailer(true);  //true enables exception
try
{
    //Sever Settings
    $mail->isSMTP();
    //$mail->SMTPDebug = 2; //enable verbose debug output
    $mail->isSMTP();    //set mailer to use smtp
    $mail->Host       = 'smtp.gmail.com;';     //specifying server
    $mail->SMTPAuth   = true;      //enabling SMTP authentication
    $mail->Username   = "l3ivkarki@gmail.com";  //SMTP username
    $mail->Password   = '#ilov3N3p'; //SMTP password
    $mail->SMTPSecure = 'tls';      //tls encryption,can use 'ssl' also
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('noreply@info.com', 'Signup Page');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Account Verification';
    $mail->Body=$message;
    //$mail->Body    = 'HTML message body in <b>bold</b> ';
    //$mail->AltBody = 'Body in plain text for non-HTML mail clients';

    $mail->send();
    //echo "Mail has been sent successfully!";
}
catch (Exception $e)
{ echo "Message could not be sent.MAiler Error:".$mail->ErrorInfo; }
}
?>
