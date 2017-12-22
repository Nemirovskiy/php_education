<?
// создаем заказ из отправленного поста и показываем номер и состав заказа. куки чистим
//нужно создать несколько строк каждая с id товара и кол-вом и с одним id заказа
// как сформировать строку с созданием нескольких строк таблицы
//INSERT INTO `basket` (`id_basket`, `id_user`, `id_product`, `count`, `id_order`, `basket_time`)
// VALUES (NULL, '1', '3', '1', NULL, CURRENT_TIMESTAMP), 
// (NULL, '1', '8', '1', NULL, CURRENT_TIMESTAMP);
//
// сначала делаем запсиь в таблице о всех товарах - получаем стоимость каждого товара
// потом берем номера всех товаром и стоимости - создаем заказ
// прописываем номер заказа в строки товаров

$i=0;
foreach($_POST['count'] as $key=>$val){
	$key = (int)$key;
	$val = (int)$val;
	$ord[$key]=$val;
	if($i>0) $str .=",";
	$str .= $key;
	$i++;
}


echo "$str<pre>";
print_r($_POST);
print_r($ord);
echo "</pre>";