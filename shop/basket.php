<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?=$item['name']?></title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<?include "nav.php";

	?>
	<main>
		<?=$message;
		//print_r($arr_basket);
		?>
		<table>
			<tr>
				<td>Фото</td>
				<td>Название</td>
				<td>Количество</td>
				<td>Цена</td>
				<td>Удалить</td>
			</tr>
			<?foreach ($arr_basket as $item):?>
			<tr>
				<td><img src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></td>
				<td><?=$item['name']?></td>
				<td><?=$item['count']?></td>
				<td><?=$item['price']?></td>
				<td>Удалить</td>
			</tr>
			<?endforeach;?>
		</table>
	</main>
</body>
</html>