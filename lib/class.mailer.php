<?php

class mailer{
	function __construct(){
		require './PHPMailer_5.2.4/class.phpmailer.php';
	}

	function mailer($Subject,$To,$Cc,$Bcc,$body,$Attach){
		$mail = new PHPMailer;
		
		$mail->IsSMTP();                                                 // Set mailer to use SMTP
		$mail->Host = 'smtp1.example.com;smtp2.example.com';             // Specify main and backup server
		$mail->SMTPAuth = true;                                          // Enable SMTP authentication
		$mail->Username = 'user';                                        // SMTP username
		$mail->Password = 'pass';                                        // SMTP password
		$mail->SMTPSecure = 'tls';                                       // Enable encryption, 'ssl' also accepted
		
		$mail->From = 'from@example.com';
		$mail->FromName = 'Mailer';
		$mail->AddAddress($To , 'OnlineEducation');                      // Add a recipient Name is optional
		$mail->AddReplyTo('info@example.com', 'Information');            // E-Mail for reply
		$mail->AddCC($Cc);
		$mail->AddBCC($Bcc);
		
		$mail->WordWrap = 50;                                            // Set word wrap to 50 characters
		$mail->AddAttachment($Attach, 'new.jpg');                        // Add attachments Optional name
		$mail->IsHTML(true);                                             // Set email format to HTML
		
		$mail->Subject = $Subject;
		$mail->Body    = $body;
		$mail->AltBody = '';                                             //This is the body in plain text for non-HTML mail clients
		
		if(!$mail->Send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}
		
		echo 'Message has been sent';
	}
}	
?>