<?php

require_once "class.smtp.php";

function SendMail($to,$Cc,$subject,$message){
	$mail = new EMail;
	
	$mail->Username = SmtpUser;
	$mail->Password = SmtpPass;
	$mail->SetFrom = From;  
	$mail->AddTo($to); 
	$mail->AddTo($to);
	$mail->Subject = $subject;
	$mail->Message = $message;
	//Optional stuff
	$mail->AddCc($Cc);  // Set a CC if needed
	$mail->ContentType = "text/html";          // Defaults to "text/plain; charset=iso-8859-1"
	$mail->Headers['X-SomeHeader'] = 'abcde';  // Set some extra headers if required
	$mail->ConnectTimeout = 30;  // Socket connect timeout (sec)
	$mail->ResponseTimeout = 8;  // CMD response timeout (sec)
	
	$success = $mail->Send();
	
}

?>