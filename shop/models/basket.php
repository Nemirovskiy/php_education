<?
$id = (int)$_GET['tobasket'];
$id_user = 1;
//$isOkDB = false;
echo $id;

// если есть номер товара - то обрабатывем добавление товара
if($id>0){
	//получаем все товары пользователя c номером товара
	$sql = "SELECT * from `basket` WHERE `id_user` = $id_user AND `id_product` = $id";
	$res = mysqli_query($connect,$sql);
	$count = mysqli_num_rows($res);
	// получаем кол-во записей с номером товара, если больше 0 то запишем новую строку иначе увеличим счетчик
	if($count>0) $sql = "UPDATE `basket` SET `count`= count+1 WHERE `id_product` = $id";
	else $sql = "INSERT INTO `basket` (`id_user`,`id_product`) VALUES ('$id_user','$id')";
	$isOkDB = mysqli_query($connect,$sql);
	if($isOkDB) $message = $name.'<br>Товар добавлен!';
		else $message = 'Ошибка добавления товара!';
}

// получаем список выбранных товаров
$sql = "SELECT * from `basket` WHERE `id_user` = $id_user";
$res = mysqli_query($connect,$sql);
while ($item = mysqli_fetch_array($res)) {
	$arr_basket[$item['id_product']] = $item;
	if($i>0) $str_prod .= ',';
	$str_prod .= $item['id_product'];
	$i++;
}
echo " == $str_prod ==";
$sql = "SELECT * from `product` WHERE id IN ($str_prod)";
$res = mysqli_query($connect,$sql);
while ($item = mysqli_fetch_array($res)) {
	$arr_basket[$item['id']]['name'] = $item['name'];
	$arr_basket[$item['id']]['image'] = $item['image'];
	$arr_basket[$item['id']]['price'] = $item['price'];
}
print_r($arr_prod);
foreach ($arr_basket as $value) {
	# code...
}

