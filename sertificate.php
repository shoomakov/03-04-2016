<?php

function create_img() {
		$regard = 0;
if(isset($_GET['username'])) {
	$username = htmlspecialchars($_GET['username']);
}
if(isset($_GET['userlastname'])) {
	$userlastname = htmlspecialchars($_GET['userlastname']);
}
if(isset($_GET['test'])) {
	$test = substr(htmlspecialchars($_GET['test']),0,-5);
}
if(isset($_GET['percent'])) {
	$percent = htmlspecialchars($_GET['percent']);
}
if ($percent>=80) {
	$regard = 5;
} elseif($percent>=65 && $percent<80) {
	$regard = 4;
} else {
	$regard = 3;
}		
		$im = @imagecreatetruecolor(800, 600) or die('Не могу загрузить картинку');
		$bc = imagecolorallocate($im, 102, 153, 255);
		$textWhite = imagecolorallocate($im, 255, 255, 255);
		$textBlack = imagecolorallocate($im, 0, 0, 0);
		$textGrey = imagecolorallocate($im, 102, 102, 102);
		$ellipseColor = imagecolorallocate($im, 205, 220, 250);	
		$textCongrats = 'Поздравляем Вас';
		$textName = $username." ".$userlastname."!";
		$textPercent = "Вы прошли тест";
		$textPercent2 = "на {$percent}%";
		$yourRegard = "Ваша оценка";
		$bigRegard = "{$regard}";		
		$fontFranklyn = realpath(__DIR__ . '/franklyn.ttf');
		$fontImpact = realpath(__DIR__ . '/impact.ttf');		
		$imgPath = realpath(__DIR__ . '/oscars.png');
		$oscar = imagecreatefrompng($imgPath);		
		imagecopy($im, $oscar, 50, 340, 0, 0, 148, 439);		
		imagefill($im, 10, 10, $bc);		
		imagefilledellipse($im, 720, 500, 600, 600, $ellipseColor);		
		imagettftext($im, 40, 0, 150, 102, $textBlack, $fontFranklyn, $textCongrats);
		imagettftext($im, 40, 0, 150, 100, $textWhite, $fontFranklyn, $textCongrats);		
		imagettftext($im, 40, 0, 150, 172, $textBlack, $fontFranklyn, $textName);
		imagettftext($im, 40, 0, 150, 170, $textWhite, $fontFranklyn, $textName);
		imagettftext($im, 22, 0, 190, 300, $textWhite, $fontFranklyn, $textPercent);		
		imagettftext($im, 55, 0, 190, 380, $textWhite, $fontFranklyn, $textPercent2);		
		imagettftext($im, 14, 0, 586, 327, $textGrey, $fontFranklyn, $yourRegard);		
		imagettftext($im, 189, 0, 586, 552, $textWhite, $fontImpact, $bigRegard);
		imagettftext($im, 189, 0, 586, 550, $textGrey, $fontImpact, $bigRegard);		
		imagepng($im);
		imagedestroy($im);
}

header('Content-Type: image/png');
create_img();
	
?>