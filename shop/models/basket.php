<?
$id = (int)$_GET['tobasket'];
$del = (int)$_GET['del'];
$min = (int)$_GET['min'];


$id_user = 1;

// если есть номер товара - то обрабатывем добавление товара
if($id>0){
	//получаем все товары пользователя c номером товара
	$sql = "SELECT * from `basket` WHERE `id_user` = $id_user AND `id_product` = $id";
	$res = mysqli_query($connect,$sql);
	$count = mysqli_num_rows($res);
	// получаем кол-во записей с номером товара, если больше 0 то запишем новую строку иначе увеличим счетчик
	if($count>0) $sql = "UPDATE `basket` SET `count`= count+1 WHERE `id_user` = $id_user AND `id_product` = $id";
	else $sql = "INSERT INTO `basket` (`id_user`,`id_product`) VALUES ('$id_user','$id')";
	$isOkDB = mysqli_query($connect,$sql);
	if($isOkDB) $message = 'Товар добавлен!';
		else $message = 'Ошибка добавления товара!';
}
elseif($min>0){
	$sql = "SELECT `count` from `basket` WHERE `id_user` = $id_user AND `id_product` = $min";
	$res = mysqli_query($connect,$sql);
	$count = mysqli_fetch_array($res);
	if($count['count']>1) $sql = "UPDATE `basket` SET `count`= count-1 WHERE `id_user` = $id_user AND `id_product` = $min";
	else $sql = "DELETE FROM `basket` WHERE `id_user` = $id_user AND `id_product` = $min";
	$isOkDB = mysqli_query($connect,$sql);
	if($isOkDB) $message = 'Товар добавлен!';
		else $message = 'Ошибка добавления товара!';
}
elseif($del>0){
	$sql = "DELETE FROM `basket` WHERE `id_basket` = $del";
	$isOkDB = mysqli_query($connect,$sql);
	if($isOkDB) $message = 'Товар удален!';
		else $message = 'Ошибка удаления товара!';
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

$sql = "SELECT * from `product` WHERE id IN ($str_prod)";
$res = mysqli_query($connect,$sql);
if($res != false){
	while ($item = mysqli_fetch_array($res)) {
		$arr_basket[$item['id']]['name'] = $item['name'];
		$arr_basket[$item['id']]['image'] = $item['image'];
		$arr_basket[$item['id']]['price'] = $item['price'];
	}
}
//print_r($arr_prod);

