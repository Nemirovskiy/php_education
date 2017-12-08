<?
include "function.php";
// если загруженный файл картинка - продолжим
if(explode("/",$_FILES['img']['type'])[0] == "image"){
	$file = strToUrl($_FILES['img']['name']);
	$name = substr($_FILES['img']['name'],0,strlen($_FILES['img']['name'])-4);
	$tmp = $_FILES['img']['tmp_name'];
	/// проверка наличия фото в базе по имени файла
	$sql = "SELECT COUNT(*) as 'count' from `galery` WHERE `file` = '".$file."'";
	$res = mysqli_query($connect,$sql);
	$isFileDB = mysqli_fetch_array($res);
	if($isFileDB ["count"]>0) $message = 'Ошибка!<br>файл уже есть!';
	else {
		$sql = "INSERT INTO `galery` (`name`,`file`) VALUES ('$name','$file')";
		$isOkDB = mysqli_query($connect,$sql);
		create_thumbnail($tmp, SMALL.$file, 250, 250);
		$isOkCopy = rename($tmp,BIG.$file);
		if($isOkCopy&&$isOkDB) $message = $name.'<br>Скопировано!';
			else $message = 'Ошибка копирования!';
	}
}
else $message =  'Ошибка!<br>Загружено не фото!';