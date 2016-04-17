<?php

	$form_data = [];

	$fname        	= $_POST['fname'];
	$email        	= $_POST['email'];
	$type          	= $_POST['type'];
	$curso		    	= $_POST['curso'];
	$ano	        	= $_POST['ano'];
	$JuniName      	= $_POST['JuniName'];

	$message     	= "Name: $fname, \nEmail: $email, \nTipo de Inscricao: $type, \nCurso: $curso, \nAno: $ano, \nNome da Junior Empresa: $JuniName.";

	if(mail('luismelo7@gmail.com', "Test Sub", $message))
		$form_data['success'] = true;
	else
		$form_data['success'] = false;

	echo json_encode($form_data);
	return;
?>
