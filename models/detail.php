<?
$id = (int)$_GET['detail'];
$sql = "SELECT * from `product` WHERE `id` = '".$id."'";
$res = mysqli_query($connect,$sql);
$item = mysqli_fetch_array($res);
$title = empty($item['name']) ? "Товар":$item['name'];
