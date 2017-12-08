<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$image['name']?></title>
		<link rel="stylesheet" href="style/photo.css">
</head>
<body>
<?if(empty($image['name'])):?>
	<h1>Вы зашли не с той стороны<br>попробуйте зайти<br><a href=".">сюда</a></h1>
<?else:?>
	<div class="main">
		<img src="<?=BIG.$image['file']?>" alt="<?=$image['name']?>">
	<a class="close" href=".">X</a>
	<div class="info">
		<span class="detail">
		Название: <?=$image['name']?><br>
		Просмотров: <?=$image['count']?>
	</span>
	<div class="feedback">
		<?if(!empty($message)):?>
			<span class="message"><?=$message?></span>
		<?endif;?>
		<?if(!empty($feedback)):
			foreach ($feedback as $value):?>
			<h3 class="author"><?=$value['author']?></h3>
			<p class="text"><?=$value['text']?></p>
		<? endforeach; 
		endif;?>
	</div>
	<form action="" method="POST">
		<input type="text" name="name" placeholder="Введите имя"><br>
		<textarea name="text" id="" cols="30" rows="10"></textarea><br>
		<button type="submit">Добавить</button>
	</form>
	</div>
	
</div>
<?endif;?>
</body>
</html>