<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$image['name']?></title>
	<style>
	* {	margin: 0;padding: 0;text-align: center;}
	body {overflow: hidden;}
	img {width: 100%;height: 100%;}
	.close{display: block;height: 30px;width: 30px;position: absolute;right: 20px;top: 20px;background: red;color: #fff;text-decoration: none;border-radius: 30px;font-family: cursive;line-height: 30px;}
</style>
</head>
<body>
<?if(empty($image['name'])):?>
	<h1>Вы зашли не с той стороны<br>попробуйте зайти<br><a href=".">сюда</a></h1>
<?else:?>
	<img src="<?=BIG.$image['file']?>" alt="<?=$image['name']?>">
	<a class="close" href=".">X</a>
<?endif;?>
</body>
</html>