<?php
	require 'ligacaoSMTP.php';
	require 'generate_img.php';

	$form_data = ['success' => true];

	$fname	= $_POST['fname'];
	$email	= $_POST['email'];
	$curso	= $_POST['curso'];
	$ano	= $_POST['ano'];
	$linkedin	= $_POST['linkedin'];
	$h1	= $_POST['hobbie1'];
	$h2	= $_POST['hobbie2'];
	$h3	= $_POST['hobbie3'];

	generate_credential($fname, $email, $curso, $h1, $h2, $h3);

	if (isset($_FILES['cv'])) {
		$fileType = pathinfo(basename($_FILES["cv"]["name"]), PATHINFO_EXTENSION);
		$target_dir = '../cv/';
		$target_file = $target_dir . $email . '.' .$fileType;

		if ($fileType != "pdf" && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg")// && file_exists('../cv/'. $email . '.' .$fileType)) {
		{
			echo "Apenas são aceites ficheiros JPG, JPEG, PNG & PDF.";

			return;
		}

		 /*Check file size
		if ($_FILES["cv"]["size"] > 10000000) {
			echo "Sorry, your file is too large.";
			return;
		}*/

		if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
			echo "Sorry, there was an error uploading your file.";
			return;
		}
	}

  	$message = "Name: $fname \nEmail: $email \nCurso: $curso \nAno: $ano \nHobbie1: $h1 \nHobbie2: $h2 \nHobbie3: $h3 \nLinkedin: $linkedin";

	$mail->addAddress('adato@junifeup.pt');
  $mail->addAttachment( $target_file , 'cv.pdf' );
	$mail->addAttachment('../images/credentials/'.$email.'.jpeg', 'credential.jpeg');
	$mail->CharSet = 'UTF-8';
	$mail->Subject = 'Registo AD@TO';

	$mail->Body = $message;

	if($mail->send()) {
		$form_data['success'] = true;
		$replymsg = "Obrigado $fname pelo teu registo!\n\nEstamos a processar a tua inscrição.\nDaqui a nada entraremos em contacto contigo!\n\n\nAD@TO - sem bancas, sem gravata, sem complicações - a tua carreira,  o teu futuro\n\n\nJuniFEUP";
		$mail->clearAddresses();
		$mail->clearAttachments();
		$mail->addAddress($email);
		$mail->Subject = 'Registo AD@TO';
		$mail->Body = $replymsg;
		$mail->send();
	}

	header("Location: http://$_SERVER[HTTP_HOST]?success=".$form_data['success']."#registration");
	die();
