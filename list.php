<html lang="ru">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="main.css">
</head>
<body>
<div class="center">
<?php
$uploaddir = 'files/';
$i = 0;
	//$testOscar = 'OSCAR';
	$path = __DIR__ . '\files\1.json';
	$file = file_get_contents($path);
	$arr = json_decode($file, true);

echo "<h1>Выберите тест, который хотите пройти</h1>\n";
echo "<form action='test.php' method='GET'>";

if ($handle = opendir($uploaddir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        	$i++;
            echo "<input type='radio' name='test' value='$entry'>".substr($entry,0,-5)."<br>";
        }
    }
    closedir($handle);
}

echo "<input type='submit' value='Пройти этот тест'><br/>";
echo "</form>";
?>
</div>
</body>
</html>