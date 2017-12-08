<?
/// подключаем настройки
require_once "config.php";

//print_r(substr(pathinfo($_SERVER['SCRIPT_NAME'])['basename'],0,-4));
//// если есть загруженный файл подключить file

if(!empty($_FILES['img']['name'])){
	include "models/file.php";

}

elseif(!empty($_GET['id']))
{
	include "models/detail.php";
}
elseif(substr(pathinfo($_SERVER['SCRIPT_NAME'])['basename'],0,-4) =='basket')
{
	include "models/basket.php";
}

/// если есть параметр в адресной строке photo

elseif(!empty($_GET['crud'])&&$_GET['crud']=='create'){
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
	include "models/catalog.php";
}
