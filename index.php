<html>
<head>
  <meta charset="utf-8">
  <title>Результат загрузки теста</title>
</head>
<body>
<?php
	$path = __DIR__ . '\files\1.json';
   if (isset($_FILES['userfile'])) {
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $path)) {
			echo 'Ваш тест успешно загружен';
			echo '<br/>';
			echo '<a href="list.php">Вывести список тестов</a>';
		} else {
			echo 'Ошибка загрузки теста';
			var_dump($_FILES['userfile']['error']);
			}
   }
?>
</body>
</html>
