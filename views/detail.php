<?if(empty($item['id'])):?>
	<h1>Вы зашли не с той стороны<br>попробуйте зайти<br><a href=".">на главную</a></h1>
<?else:?>
	<div class="img">
		<a href="<?=BIG.$item['image']?>"><img src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></a>
		<a href="<?=BIG.$item['image']?>"><img src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></a>
		<a href="<?=BIG.$item['image']?>"><img src="<?=SMALL.$item['image']?>" alt="<?=$item['name']?>"></a>
	</div>
	<div class="detail">
		<a id="btn-<?=$item['id']?>" onclick="toBasket('add','<?=$item['id']?>')">В корзину</a>
		<h2><?=$item['name']?></h2>
		<h3><?=$item['price']?></h3>
		<p><?=$item['text']?></p>
	</div>
<?endif;?>