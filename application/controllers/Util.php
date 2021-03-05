<?php

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Util extends CI_Controller {

	public static function send_email($to, $subject, $body) {
		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'danaos.mailsender@gmail.com';
			$mail->Password   = 'HaloDunia123';
			$mail->SMTPSecure = "ssl";
			$mail->Port       = 465;
			$mail->setFrom('danaos.mailsender@gmail.com', 'Fortune Teller');
			$mail->addAddress($to);
			$mail->addReplyTo('danaos.mailsender@gmail.com', 'Reply to this email');
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body    = $body;
			$mail->send();
			//echo 'Message has been sent';
		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	
	public static function generateRandomNumber($length) {
	    $result = '';
	    for($i = 0; $i < $length; $i++) {
	        $result .= mt_rand(0, 9);
	    }
	    return $result;
	}
	
	public static function generateUUIDv4() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
	        mt_rand( 0, 0xffff ),
	        mt_rand( 0, 0x0fff ) | 0x4000,
	        mt_rand( 0, 0x3fff ) | 0x8000,
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	    );
	}
}
