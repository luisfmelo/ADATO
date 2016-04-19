<?php
	require 'PHPMailer-master/PHPMailerAutoload.php';
	require 'credentials.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 1;                               	// Enable verbose debug output

	$mail->isSMTP();                                      	// Set mailer to use SMTP

	$mail->Host = $_CREDENTIALS['host'];					// Specify main and backup SMTP servers
	$mail->SMTPAuth = $_CREDENTIALS['auth'];				// Enable SMTP authentication
	$mail->Username = $_CREDENTIALS['username'];            // SMTP username
	$mail->Password = $_CREDENTIALS['password'];			// SMTP password
	$mail->SMTPSecure = $_CREDENTIALS['SMTPSecure'];		// Enable TLS encryption, `ssl` also accepted
	$mail->Port = $_CREDENTIALS['port'];					// TCP port to connect to
	$mail->setFrom($_CREDENTIALS['username'], 'JuniFEUP');

	$mail->SMTPOptions = array (
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true)); // prevent to occur an error with TLS security