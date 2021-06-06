<?php

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Util {
	
	public static function send_email($to, $subject, $body) {
		$mail = new PHPMailer(true);
		try {
    		$mail->SMTPDebug = 0;
    		$mail->isSMTP();
    		$mail->Host = 'mail.idjobfinder.xyz';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'admin@idjobfinder.xyz';
    		$mail->Password = '%J%}C+{2tE!B';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port = 465;
    		$mail->setFrom('admin@idjobfinder.xyz', 'IDJobFinder Admin');
    		$mail->addAddress($to, 'IDJobFinder User');
    		$mail->addReplyTo('admin@idjobfinder.xyz', 'IDJobFinder Admin');
    		$mail->isHTML(true);
    		$mail->Subject = $subject;
    		$mail->Body = $body;
    		$mail->send();
		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
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
