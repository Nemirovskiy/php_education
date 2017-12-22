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
	foreach ($arr_basket as $key=>$item):?>
		<tr id="prod_item_<?=$key?>">
			<td><img width="70px" src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></td>
			<td>
				<a href="?detail=<?=$key?>"><?=$item['name']?></a>
			</td>
			<td><input type="number" name="count[<?=$key?>]" id='prod_count_<?=$key?>' value="<?=$item['count']?>"><br>
				<a onclick="basket('add','<?=$key?>')"> + </a>
				<a onclick="basket('min','<?=$key?>')"> - </a>
			</td>
			<td><?=$item['price']?></td>
			<td><?=$item['price']*$item['count']?></td>
			<td><a onclick="basket('del','<?=$key?>')">Удалить</a></td>
		</tr>
		<?$summ +=  $item['price']*$item['count'];
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
