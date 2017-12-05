<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>PHP ДЗ 4</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div class="container">
		<?if(!empty($message)):?>
			<span class="info">
				<p><?=$message?></p>
				<a class="btn" href=".">Вернуться</a>
			</span><br>
		<?elseif(!empty($images)):?>
		<div class="images">
			<?foreach($images as $item):?>
				<div class="item">
					<a href="photo.php?photo=<?=$item['id']?>">
						<img src="<?=SMALL.$item['file']?>" alt="<?=$item['name']?>" title="<?=$item['name']?>">
						<span class="detail"><?=$item['name']?><br>просмотров: <?=$item['count']?></span>
					</a>
					<span title="Удалить" onclick="del(<?=$item['id'].",'".$item['name']."'"?>)" class="delete">X</span>
				</div>
			<?endforeach;?>
		</div>	
		<?else:?>
			<h1>Вы ещё не загрузили фото</h1>
		<?endif;?>
		<form enctype="multipart/form-data" method="POST">
			<label for="infile">Выбрать файл</label>
			<input style="display: none" type="file" onchange="txt.innerHTML='Загрузить<br>'+this.files[0].name;txt.style.display = 'block'" id="infile" name="img">
			<button id="txt" style="display: none;" type="submit"></button>
		</form>
	</div>
	<script>
		function del(id,name){
			var res = confirm('Удалить фото '+name);
			if(res) window.location ="?del="+id;
		}
	</script>
</body>
</html>