<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function send_mail($email, $subject, $body)
{
	$mail = new PHPMailer();
															 
	$mail->isSMTP();                                  
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;                            
	$mail->Username = "spyrdxboy@gmail.com";                 
	$mail->Password = "A12345spy";                           
	$mail->SMTPSecure = "tls";                           
	$mail->Port = 587;                 

	$mail->From = "spyrdxboy@gmail.com";
	$mail->FromName = "SpyWarrior";
	$mail->addAddress($email);
	$mail->addReplyTo("spyrdxboy@gmail.com", "Reply");
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