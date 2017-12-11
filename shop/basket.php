<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Корзина</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<?include "nav.php";?>
	<main><span><?=$message?></span>
		<?if(!empty($arr_basket)):?>
		<form action="" method="POST">
			<table>
				<tr>
					<td>Фото</td>
					<td>Название</td>
					<td>Количество</td>
					<td>Цена</td>
					<td>Стоимость</td>
					<td>Удалить</td>
				</tr>
				<?
				foreach ($arr_basket as $item): //print_r($item);?>
					<tr>
						<td><img width="70px" src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></td>
						<td>
							<input type="hidden" name="basket[]" value="<?=$item['id_basket']?>">
							<a href="detail.php?id=<?=$item['id_product']?>"><?=$item['name']?></a>
						</td>
						<td><?=$item['count']?><br>
							<a href="?tobasket=<?=$item['id_product']?>">+</a>
							<a href="?min=<?=$item['id_product']?>">-</a>
						</td>
						<td><?=$item['price']?></td>
						<td><?=$item['price']*$item['count']?></td>
						<td><a href="?del=<?=$item['id_basket']?>">Удалить</a></td>
					</tr>
					<?
					$summ +=  $item['price']*$item['count'];
					endforeach;?>
					<tr>
						<td colspan="4"></td>
						<td>Итого</td>
						<td><?=$summ;?></td>
					</tr>
					<tr>
						<td colspan="5"></td>
						<td><button type="submit">Заказать</button></td>
					</tr>
				</table>
			</form>
			<?else:?>
				<h2>Корзина пуста</h2>
			<?endif;?>
		</main>
	</body>
	</html>