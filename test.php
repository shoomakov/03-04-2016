
<?php
	//require_once('index.php');
	$uploaddir = 'files/';
	$files1 = scandir($uploaddir);
	if(isset($_GET['username'])) {
		$username = htmlspecialchars($_GET['username']);
	}
	if(isset($_GET['userlastname'])) {
		$userlastname = htmlspecialchars($_GET['userlastname']);
	}

	$getTest = $_GET['test'];
	if(!in_array($getTest, $files1)){
  		header("Location:http://lp.miltrade.ru/shoomakov/404.php");
	}
	if(!empty($_GET['test'])){
		$filename = htmlspecialchars($_GET['test']);
	}
	$testOscar = 'OSCAR';
	$path = __DIR__ . '\files\1.json';
	$file = file_get_contents($path);
	$arr = json_decode($file, true);
	$success = 0;
	
?>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Тест <?php echo $testOscar ?></title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<div class="center">
		
		<h2>Итак, вы решили пройти тест №<?php echo substr($_GET['test'],0,-5); ?> «<?php echo $testOscar ?>»</h2>
		<hr/>
		<p><em>Пожалуйста, для начала, укажите своё имя и фамилию. Это нужно для выдачи именного сертификата</em></p>
	<form action="" method="GET">
		<input style="width: 49%;" type='text' name='username' required placeholder='Введите своё имя'>
		<input style="width: 49%;" type='text' name='userlastname' required placeholder='Введите свою фамилию'><br>
		<hr/>
		<br/>
	<?php
//		if(!isset($arr)) {
//		    $arr = json_decode($file, true);}
		if(is_array($arr) or $arr instanceof Traversable) {
		    foreach($arr as $obj) {
		
			//var_dump($obj);
						
			echo "<p><strong>".$obj[question]."</strong></p>"; 
		    
			foreach ($obj[options] as $value) {
				echo "<input type='radio' name='{$obj[name]}' value='{$value}'>{$value}<br>\n";
			}
			
			$answers[] = $obj[answer];
			echo "<br>"; 
		    }
		    
		}
		
		
		echo "<input type='hidden' name='test' value='{$filename}'>";
		echo "<input type='hidden' name='result' value='result'>";
	?>
	<input type="submit" value="Завершить тест и перейти к результатам"><br>
	</form>
	<?php 
	/*******************************************************************************/
	/*****Получаем массив из GET-параметров и выводим кол-во правильных ответов*****/
	/*******************************************************************************/
	foreach ($_GET as $key => $value) {
				$getParam[] = $value;
			}

	if(isset($_GET['result'])){
		for ($i=0; $i < count($answers); $i++) { 
				if ($answers[$i] == $getParam[$i+2]) {
					$success++;
				}
		}
		echo "<h2>Вы ответили правильно на ";
		echo $success." из ".$i." вопросов</h2>";
		echo "<a href='list.php'>Вернуться к выбору теста</a><br>";

		/*******************************************************************************/
		/*****Проверяем, надо ли давать сертификат*****/
		/*****Если больше 50% правильных ответов, то надо*****/

		/*******************************************************************************/		
		$percent = ($success / $i) * 100;

		
		if($percent >= 50){
			echo "Поздравляем! Вы ответили правильно на {$percent}% вопросов<br>";
			echo "<a href='sertificate.php?username=$username&userlastname=$userlastname&test=$filename&percent=$percent'>Получить сертификат</a><br>";
		} else {
			echo "Нам жаль, но Ваши результаты слишком низкие. Вы не получите сертификат<br>";
		}
	}
	?>
	</div>
</body>
</html>
