<?
// подключаем функции
require_once "PHP_4_functions.php";

$path_b = "images/big/";
$path_s = "images/small/";
$dir = scandir($path_s);
// если есть загруженный файл
if(!empty($_FILES['img']['name'])){
	$str = '<div id="info" onclick="info.remove(this)">'; // начало информационного блока
	$name = strToUrl($_FILES['img']['name']);
	$tmp = $_FILES['img']['tmp_name'];
	// проверить на присутствие в каталоге
	if(in_array($name, $dir)) 
		$str .= 'Ошибка!<br>файл уже есть';
	// если файла в каталоге нет и это фото - копируем
	elseif(explode("/",$_FILES['img']['type'])[0] == "image"){
		create_thumbnail($tmp, $path_s.$name, 250, 250);
		$isOkCopy = rename($tmp,$path_b.$name);
		if($isOkCopy) $str .= 'Скопировано!';
		else $str .= 'Ошибка копирования!';
	}
	else $str .=  'Ошибка!<br>Загружено не фото!';
	$str .= '</div>';// конец информационного блока
}
$dir = scandir($path_s);
foreach ($dir as $key => $value) {
	if($key >1) $str .= "<a href='PHP_4_big.php?img=$value'><img src='$path_s$value' alt='$value'></a>";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>PHP ДЗ 4</title>
	<style>
.container {width: 1000px;	margin: 0 auto;}
.images {display: flex;flex-wrap: wrap;justify-content: space-around;}
.images a {margin-bottom: 20px;border-radius: 30px;overflow: hidden;}
img {border: 5px solid #ccc;border-radius: 30px;}
form {display: flex;flex-direction: column;align-items: center;}
input[type="file"] {width: 400px;}
#info {position: absolute;padding: 50px;background: rgb(204, 204, 204);border-radius: 20px;}
#info:after {content: 'X';position: absolute;top: 10px;right: 10px;color: white;font-weight: bold;cursor: pointer;font-family: cursive;height: 20px;width: 20px;line-height: 20px;background: #FF5722;text-align: center;border-radius: 10px;}
label, button {border: 2px solid #ccc;border-radius: 10px;padding: 10px 20px;background: #fff;margin-top: 10px;}
label:hover, button:hover {outline: none;border-color: rgb(180, 180, 180);background: rgb(250, 250, 250);}
label:active, button:focus {outline: none;border-color: rgb(160, 160, 160);background: rgb(220, 220, 220);}
</style>
</head>
<body>
	<div class="container">
	<div class="images"><?=$str?></div>
		<form enctype="multipart/form-data" method="POST">
			<label for="infile">Выбрать файл</label>
			<input style="display: none" type="file" onchange="txt.innerHTML='Загрузить<br>'+this.files[0].name;txt.style.display = 'block'" id="infile" name="img">
			<button id="txt" style="display: none;" type="submit"></button>
		</form>
	</div>
</body>
</html>