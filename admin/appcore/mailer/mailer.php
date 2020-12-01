<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function send_mail($email, $subject, $body)
{
	$mail = new PHPMailer();
															 
	$mail->isSMTP();                                  
	$mail->Host = "smtp.hostinger.in";
	$mail->SMTPAuth = true;                            
	$mail->Username = "info@davestrades.co";                 
	$mail->Password = "@Cyrus#123";                           
	$mail->SMTPSecure = "tls";                           
	$mail->Port = 587;                 

	$mail->From = "info@davestrades.co";
	$mail->FromName = "SpyWarrior";
	$mail->addAddress($email);
	$mail->addReplyTo("info@davestrades.co", "Reply");
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $body;

	if($mail->send()) 
	{
		return true;
	} 
	else 
	{
		return false;
	}
}
?>