<?
session_start();
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
	<script src="jquery.js"></script>
	<script>
		function basket(act,id){
			var str = act+"="+id;
			$.ajax({
				type: "POST",
				url: "",
				data: str 
			}).done(function( msg ) {
				$("#mess").html(msg);
				$("#btn-"+id).html('В корзине');
			});
		}
	</script>
</head>
<body>
	<header>
		<?include "nav.php";?>
	</header>
	<span id="mess"></span>
<main>
	<?
	echo $message;
	foreach ($product as $item):?>
	<div class="item">
		<img src="images/small/<?=$item['image']?>" alt="<?=$item['name']?>">
		<h2><a href="detail.php?id=<?=$item['id']?>"><?=$item['name']?></a></h2>
		<h3><?=$item['price']?></h3>
		<p><?=$item['text']?></p>
	
	
		<div class="crud">
			<a href="crud.php?crud=create">create</a>
			<a href="crud.php?crud=update&crudid=<?=$item['id']?>">update</a>
			<a href="crud.php?crud=delite&crudid=<?=$item['id']?>">delite</a>
		</div>
		<a id="btn-<?=$item['id']?>" onclick="basket('add','<?=$item['id']?>')"><?=$item['link']?></a>
	</div>
	<?endforeach;?>
</main>
</body>
</html>