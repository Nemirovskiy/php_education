<?
/// подключаем настройки
require_once "config.php";

//// если есть загруженный файл подключить file

if(!empty($_FILES['img']['name'])){
	include "models/file.php";

}

/// если есть параметр в адресной строке photo

elseif(!empty($_GET['photo'])){
	if(!empty($_POST['name'])&&!empty($_POST['text']))
		include "models/feedback.php";
	include "models/photo.php";
	
}

/// если есть параметр в адресной строке del

elseif(!empty($_GET['del'])){
	include "models/del.php";
}

/// если нет загруженного файла и нет параметра в адресной строке подключить galery

else{
	include "models/galery.php";
}
