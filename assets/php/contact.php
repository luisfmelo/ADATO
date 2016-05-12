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

	if (isset($_FILES['cv'])) {
		$fileType = pathinfo(basename($_FILES["cv"]["name"]), PATHINFO_EXTENSION);
		$target_dir = '../cv/';
		$target_file = $target_dir . $fname . '.' .$fileType;

		if ($fileType != "pdf" && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
			echo "Apenas são aceites ficheiros JPG, JPEG, PNG & PDF.";

			return;
		}

		// Check file size
		if ($_FILES["cv"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			return;
		}

		if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
			echo "Sorry, there was an error uploading your file.";
			return;
		}
	}

  	$message = "Name: $fname, \nEmail: $email, \nCurso: $curso, \nAno: $ano, \nHobbie1: $h1, \nHobbie2: $h2, \nHobbie3: $h3, \nLinkedin: $linkedin.";

	$mail->addAddress('pedrocova96@gmail.com');
  	$mail->addAttachment( $target_file , 'cv.pdf' );
	$mail->Subject = 'Registo AD@TO';

	$mail->Body = $message;

	if($mail->send()) {
		$form_data['success'] = true;
		$replymsg = "Obrigado $fname. O teu registo foi efetuado com sucesso\n\nCumprimentos\nJuniFEUP";
		$mail->clearAddresses();
		$mail->clearAttachments();
		$mail->addAddress($email);
		$mail->Subject = 'Registo AD@TO';
		$mail->Body = $replymsg;
		$mail->send();
	}
	else {
		$form_data['success'] = false;
	}

	if($form_data['success'])
		header("Location: http://$_SERVER[HTTP_HOST]?msg=Registo efetuado com sucesso&color=green#registration");
	else
		header("Location: http://$_SERVER[HTTP_HOST]?msg=Registo não foi efetuado com sucesso, pedimos desculpa!&color=red#registration");
	die();