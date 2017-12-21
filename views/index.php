<div class="catalog">
	<?foreach ($products as $item):?>
		<div class="item" id="prod_item_<?=$item['id']?>">
			<img src="images/small/<?=$item['image']?>" alt="<?=$item['name']?>">
			<h2><a href="?detail=<?=$item['id']?>"><?=$item['name']?></a></h2>
			<h3><?=$item['price']?></h3>
			<p><?=$item['text']?></p>
			<a id="btn-<?=$item['id']?>" onclick="toBasket('add','<?=$item['id']?>')"><?=$item['link']?></a>
		</div>
	<?endforeach;?>
</div>