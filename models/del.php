<?
$id=(int)$_GET['del'];
$sql = "SELECT `name`,`file` from `galery` WHERE `id` = '$id'";
$res =mysqli_query($connect,$sql);
$file = mysqli_fetch_array($res);
if(!empty($file)){
$sql = "DELETE FROM `galery` WHERE `id` = '$id'";
$isOkDelDB =mysqli_query($connect,$sql);
$isOkDelB = unlink(BIG.$file['file']);
$isOkDelS = unlink(SMALL.$file['file']);
if($isOkDelB&&$isOkDelS&&$isOkDelDB) $message = $file['name']."<br>Удалено успешно!";
	else $message = 'Ошибка удаления!';
}
else $message = 'Файл не найден!';