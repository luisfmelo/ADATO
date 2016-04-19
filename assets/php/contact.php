<?php
	require 'ligacaoSMTP.php';

	$form_data = [];

	$fname	= $_POST['fname'];
	$email	= $_POST['email'];
	$curso	= $_POST['curso'];
	$ano	= $_POST['ano'];

	$message = "Name: $fname, \nEmail: $email, \nCurso: $curso, \nAno: $ano.";

	$mail->addAddress('pcova@junifeup.pt');
	$mail->Subject = 'Test Sub';

	$mail->Body = $message;

	if($mail->send())
		$form_data['success'] = true;
	else {
		$form_data['success'] = false;
	}
	echo json_encode($form_data);
	return;