<?
$file = $_GET['img'];
$name = substr($file, 0,strlen($file)-4);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$name?></title>
	<style>
	* {
		margin: 0;
		padding: 0;
	}
	body {
	    overflow: hidden;
	}
	img {
		width: 100%;
		height: 100%;
	}
</style>
</head>
<body>
	<img src="images/big/<?=$file?>" alt="<?=$name?>">
</body>
</html>