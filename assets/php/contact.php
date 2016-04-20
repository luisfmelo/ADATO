<?php
	require 'ligacaoSMTP.php';

	$form_data = [];

	$fname	= $_POST['fname'];
	$email	= $_POST['email'];
	$curso	= $_POST['curso'];
	$ano	= $_POST['ano'];

	$message = "Name: $fname, \nEmail: $email, \nCurso: $curso, \nAno: $ano.";

	$mail->addAddress('adato@junifeup.pt');
	$mail->Subject = 'Registo AD@TO';

	$mail->Body = $message;

	if($mail->send()) {
		$form_data['success'] = true;
		$replymsg = "Obrigado $fname. O teu registo foi efetuado com sucesso\n\nCumprimentos\nJuniFEUP";
		$mail->clearAddresses();
		$mail->addAddress($email);
		$mail->Subject = 'Registo AD@TO';
		$mail->Body = $replymsg;
		$mail->send();
	}
	else {
		$form_data['success'] = false;
	}
	echo json_encode($form_data);
	return;
