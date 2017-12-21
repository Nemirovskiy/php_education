<?
$i=0;
foreach ($_COOKIE as $key => $value) {
	$keyS = strip_tags($key);
	$prod = explode("_", $keyS);
	if($prod[0]=='prod') {
		$id = $prod[1];
		if($i>0) $str_prod .= ',';
		$str_prod .= $id;
		$arrProd[$id]=(int)$value;
		$i++;
	}
}
$sql = "SELECT * from `product` WHERE id IN ($str_prod)";
$res = mysqli_query($connect,$sql);
if($res != false){
	while ($item = mysqli_fetch_array($res)) {
		$arr_basket[$item['id']]['name'] = $item['name'];
		$arr_basket[$item['id']]['image'] = $item['image'];
		$arr_basket[$item['id']]['price'] = $item['price'];
		$arr_basket[$item['id']]['count'] = $arrProd[$item['id']];
	}
}