<?
/// подключаем настройки
require_once "config.php";

//// если есть загруженный файл подключить file

if(!empty($_FILES['img']['name'])){
	include "models/file.php";
}

/// если есть параметр в адресной строке photo

elseif(!empty($_GET['photo'])){
	include "models/photo.php";
}

/// если нет загруженного файла и нет параметра в адресной строке подключить galery

else{
	include "models/galery.php";
}