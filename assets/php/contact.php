<?php
	require 'ligacaoSMTP.php';

	$form_data = [];

	$fname	= $_POST['fname'];
	$email	= $_POST['email'];
	$curso	= $_POST['curso'];
	$ano	= $_POST['ano'];
	$linkedin	= $_POST['linkedin'];
	$h1	= $_POST['hobbie1'];
	$h2	= $_POST['hobbie2'];
	$h3	= $_POST['hobbie3'];

  move_uploaded_file($_FILES["cv"]["my_cv"], $target_file);

  $message = "Name: $fname, \nEmail: $email, \nCurso: $curso, \nAno: $ano, \nHobbie1: $h1, \nHobbie2: $h2, \nHobbie3: $h3, \nLinkedin: $linkedin.";

	$mail->addAddress('adato@junifeup.pt');
  $email->AddAttachment( $target_file , 'cv.pdf' );
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
