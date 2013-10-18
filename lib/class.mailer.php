<?php
/*
 *  Mailer class with use PHPMailer
 */
class mailer{
	/*
	 * Use Like => mailer :: sendMail('tets' , 'student@example.com , 'body for mail' , 'no attach');
	 */

	static function sendMail($Subject , $body , $To , $Attach = array() , $Cc = '', $Bcc ='' ){
		require_once './PHPMailer_5.2.4/class.phpmailer.php';
		$mail = new PHPMailer;
		
		$mail->IsSMTP();                                                 // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';             // Specify main and backup server
		$mail->SMTPAuth = true;                                          // Enable SMTP authentication
		$mail->Username = 'hghprogramer@gmail.com';                                        // SMTP username
		$mail->Password = '125125125';                                        // SMTP password
		$mail->SMTPSecure = 'tls';                                       // Enable encryption, 'ssl' also accepted
		
		$mail->From = 'hghprogramer@gmail.com';
		$mail->FromName = 'Mailer';
		$mail->AddAddress($To , 'OnlineEducation');                      // Add a recipient Name is optional
		$mail->AddReplyTo('padidar003@yahoo.com', 'Information');            // E-Mail for reply
		$mail->AddCC($Cc);
		$mail->AddBCC($Bcc);
		
		$mail->WordWrap = 50;                                            // Set word wrap to 50 characters
		foreach($Attach as $a){
			$mail->AddAttachment($a);                        // Add attachments Optional name
		}
		$mail->IsHTML(true);                                             // Set email format to HTML
		
		$mail->Subject = $Subject;
		$mail->Body    = $body;
		$mail->AltBody = '';                                             //This is the body in plain text for non-HTML mail clients
		
		if(!$mail->Send()) {
		   debugger::trigger('Message could not be sent.Mailer Error: ' . $mail->ErrorInfo, false);
		   return false;
		}
		
		return true;
	}
}
?>