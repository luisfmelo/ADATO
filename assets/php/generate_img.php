<?php
function generate_credential($user_name, $user_email, $user_degree, $hobbie1, $hobbie2, $hobbie3)
{
	$pathToFile = '../images/';
	$pathToSave = '../images/credentials/';
	$base_file = 'base_img.jpeg';
	$export_file = $user_email.'.jpeg';

	$rImg = imagecreatefromjpeg($pathToFile . $base_file);
	$cor = imagecolorallocate($rImg, 255, 255, 255);
	$font = '../fonts/images/Arimo-Regular.ttf';
	$font_size_name = 90;
	$font_size_degree = 45;
	$font_size_hobbies = 35;

	$name_points = imagettfbbox($font_size_name, 0, $font, $user_name);
	$degree_points = imagettfbbox($font_size_degree, 0, $font, $user_degree);
	$hobbies_points1 = imagettfbbox($font_size_hobbies, 0, $font, $hobbie1);
	$hobbies_points2 = imagettfbbox($font_size_hobbies, 0, $font, $hobbie2);
	$hobbies_points3 = imagettfbbox($font_size_hobbies, 0, $font, $hobbie3);

	$img_x = intval(imagesx($rImg) / 2);
	$img_x_hobbies = intval(imagesx($rImg) / 4);
	$img_y_name = intval(imagesy($rImg) / 6.2);
	$img_y_degree = intval(imagesy($rImg) / 4.4);
	$img_y_hobbies = imagesy($rImg) - intval(imagesy($rImg) / 4.5);
	$img_sx_name = $name_points[2] - $name_points[0];
	$img_sy_name = $name_points[7] - $name_points[1];
	$img_sx_degree = $degree_points[2] - $degree_points[0];
	$img_sy_degree = $degree_points[7] - $degree_points[1];
	$img_sx_hobbies1 = $hobbies_points1[2] - $hobbies_points1[0];
	$img_sy_hobbies1 = $hobbies_points1[7] - $hobbies_points1[1];
	$img_sx_hobbies2 = $hobbies_points2[2] - $hobbies_points2[0];
	$img_sy_hobbies2 = $hobbies_points2[7] - $hobbies_points2[1];
	$img_sx_hobbies3 = $hobbies_points3[2] - $hobbies_points3[0];
	$img_sy_hobbies3 = $hobbies_points3[7] - $hobbies_points3[1];

	imagettftext($rImg, $font_size_name, 0, $img_x - ($img_sx_name / 2), $img_y_name + ($img_sy_name / 2), $cor, $font, $user_name);
	imagettftext($rImg, $font_size_degree, 0, $img_x - ($img_sx_degree / 2), $img_y_degree + ($img_sy_degree / 2), $cor, $font, $user_degree);
	imagettftext($rImg, $font_size_hobbies, 0, $img_x_hobbies - ($img_sx_hobbies1 / 2), $img_y_hobbies + ($img_sy_hobbies1 / 2), $cor, $font, $hobbie1);
	imagettftext($rImg, $font_size_hobbies, 0, $img_x_hobbies * 2 - ($img_sx_hobbies2 / 2), $img_y_hobbies + ($img_sy_hobbies2 / 2), $cor, $font, $hobbie2);
	imagettftext($rImg, $font_size_hobbies, 0, $img_x_hobbies * 3 - ($img_sx_hobbies3 / 2), $img_y_hobbies + ($img_sy_hobbies3 / 2), $cor, $font, $hobbie3);

	header('Content-type: image/jpeg');
	imagejpeg($rImg, $pathToSave . $export_file);
	return;
}