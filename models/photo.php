<?
$id = (int)$_GET['photo'];
$sql = "SELECT `name`,`file`,`count` from `galery` WHERE `id` = '".$id."'";
$res = mysqli_query($connect,$sql);
$image = mysqli_fetch_array($res);
$image['count']++;
///увеличиваем счетчик при просмотре
$sql = "UPDATE `galery` SET `count`= ".$image['count']." WHERE `id` = '".$id."'";
$rw = mysqli_query($connect,$sql);
//читаем отзывы
$sql = "SELECT `text`,`author` from `feedback` WHERE `id_image` = '$id'";
$res = mysqli_query($connect,$sql);
while ($text = mysqli_fetch_array($res)) {
	$feedback[] = $text;
}