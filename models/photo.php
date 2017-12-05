<?
$id = $_GET['photo'];
$sql = "SELECT `name`,`file` from `galery` WHERE `id` = '".$id."'";
$res = mysqli_query($connect,$sql);
$image = mysqli_fetch_array($res);

///увеличиваем счетчик при просмотре
$sql = "UPDATE `galery` SET `count`= `count`+1 WHERE `id` = '".$id."'";
$rw = mysqli_query($connect,$sql);