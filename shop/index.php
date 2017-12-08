<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>PHP ДЗ 5 каталог товаров</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
<main>
	<?//print_r($product);
	foreach ($product as $item):?>
	<div class="item">
		<img src="images/small/<?=$item['image']?>" alt="<?=$item['name']?>">
		<h2><a href="detail.php?id=<?=$item['id']?>"><?=$item['name']?></a></h2>
		<h3><?=$item['price']?></h3>
		<p><?=$item['text']?></p>
	
	
		<!--div class="crud">
			<a href="#">create</a>
			<a href="#">edit</a>
			<a href="#">update</a>
			<a href="#">delite</a>
		</div-->
		<a href="basket.php?tobasket=<?=$item['id']?>">В корзину</a>
	</div>
	<?endforeach;?>
</main>

</body>
</html>