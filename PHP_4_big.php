<?
$path = "images/big/";
$file = $_GET['img'];
$name = substr($file, 0,strlen($file)-4);
$dir = scandir($path);
// проверка на наличие параметра адреса и присутствие картики в каталоге
if(empty($_GET['img'])||!in_array($file,$dir)) $str = "<h1>Вы зашли не с той стороны<br>попробуйте зайти<br><a href=\"PHP_4.php\">сюда</a></h1>";
else $str = "<img src=\"$path/$file\" alt=\"$name\">";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$name?></title>
	<style>
	* {	margin: 0;padding: 0;text-align: center;}
	body {overflow: hidden;}
	img {width: 100%;height: 100%;}
</style>
</head>
<body>
<?=$str?>
</body>
</html>