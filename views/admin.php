<div class="crud">
	<div id="mss"></div>
	<?foreach ($products as $item):?>
		<div class="item" id="prod_item_<?=$item['id']?>">
			<div class="img" ><img src="images/small/<?=$item['image']?>" alt="<?=$item['name']?>"></div>
			<h2 data="name" class="name"><?=$item['name']?></h2>
			<h3 data="price" class="price"><?=$item['price']?></h3>
			<p data="text" class="text"><?=$item['text']?></p>
			
			<div class="edit" data="edit" class="crud">
				<a onclick="crud('create','<?=$item['id']?>')">create</a>
				<a onclick="crud('edit','<?=$item['id']?>')">update</a>
				<a onclick="crud('delite','<?=$item['id']?>')">delite</a>
			</div>
		</div>
	<?endforeach;?>

</div>