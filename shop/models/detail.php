<?
$id = (int)$_GET['id'];
$sql = "SELECT * from `product` WHERE `id` = '".$id."'";
$res = mysqli_query($connect,$sql);
$item = mysqli_fetch_array($res);

