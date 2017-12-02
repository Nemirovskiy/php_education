<?
function create_thumbnail($path, $save, $width, $height) {
$info = getimagesize($path); //получаем размеры картинки и ее тип
$size = array($info[0], $info[1]); //закидываем размеры в массив
//В зависимости от расширения картинки вызываем соответствующую функцию
if ($info['mime'] == 'image/png') {
$src = imagecreatefrompng($path); //создаём новое изображение из файла
} else if ($info['mime'] == 'image/jpeg') {
$src = imagecreatefromjpeg($path);
} else if ($info['mime'] == 'image/gif') {
$src = imagecreatefromgif($path);
} else {
return false;
}
$thumb = imagecreatetruecolor($width, $height); //возвращает идентификатор изображения, представляющий черное изображение заданного размера
$src_aspect = $size[0] / $size[1]; //отношение ширины к высоте исходника
$thumb_aspect = $width / $height; //отношение ширины к высоте аватарки
if($src_aspect < $thumb_aspect) { //узкий вариант (фиксированная ширина) $scale = $width / $size[0]; $new_size = array($width, $width / $src_aspect); $src_pos = array(0, ($size[1] * $scale - $height) / $scale / 2); //Ищем расстояние по высоте от края картинки до начала картины после обрезки } else if ($src_aspect > $thumb_aspect) {
//широкий вариант (фиксированная высота)
$scale = $height / $size[1];
$new_size = array($height * $src_aspect, $height);
$src_pos = array(($size[0] * $scale - $width) / $scale / 2, 0); //Ищем расстояние по ширине от края картинки до начала картины после обрезки
} else {
//другое
$new_size = array($width, $height);
$src_pos = array(0,0);
}
$new_size[0] = max($new_size[0], 1);
$new_size[1] = max($new_size[1], 1);
imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);
//Копирование и изменение размера изображения с ресемплированием
if($save === false) {
return imagepng($thumb); //Выводит JPEG/PNG/GIF изображение
} else {
return imagepng($thumb, $save);//Сохраняет JPEG/PNG/GIF изображение
}
}
//////////////////////////////////////////////////////////////////////////////////
		 $path_b = "images/big/";
		 $path_s = "images/small/";
		 $dir = scandir($path_s);
		if(!empty($_FILES['img']['name'])&& is_file($_FILES['img']['tmp_name'])){
			$name = $_FILES['img']['name'];
			$tmp = $_FILES['img']['tmp_name'];
			if(in_array($name, $dir)) 
				$str .= '<div id="info" onclick="info.remove(this)">Ошибка!<br>файл уже есть</div>';
			elseif($_FILES['img']['type'] == "image/jpeg"){

				 create_thumbnail($tmp, $path_s.$name, 250, 250);
				 $copy_b = rename($tmp,$path_b.$name);
				 if($copy_b) $str .= '<div id="info" onclick="info.remove(this)">Скопировано!</div>';
				 else $str .= '<div id="info" onclick="info.remove(this)">Ошибка!</div>';
			}
			if($_FILES['img']['type'] != "image/jpeg") {
				$str .=  '<div id="info" onclick="info.remove(this)">Ошибка!<br>Загружено не фото!</div>';}
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
	.container {
    width: 1000px;
    margin: 0 auto;
}
.images {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}
.images a {
    margin-bottom: 20px;
    border-radius: 30px;
    overflow: hidden;
}
img {
    border: 5px solid #ccc;
    border-radius: 30px;
}
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}
input[type="file"] {
    width: 400px;
}
#info {
    position: absolute;
    padding: 50px;
    background: rgb(204, 204, 204);
    border-radius: 20px;
}
#info:after {
    content: 'X';
    position: absolute;
    top: 10px;
    right: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    font-family: cursive;
    height: 20px;
    width: 20px;
    line-height: 20px;
    background: #FF5722;
    text-align: center;
    border-radius: 10px;
}
label, button {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 10px 20px;
    background: #fff;
    margin-top: 10px;
}
label:hover, button:hover {
    outline: none;
    border-color: rgb(180, 180, 180);
    background: rgb(250, 250, 250);
}
label:active, button:focus {
    outline: none;
    border-color: rgb(160, 160, 160);
    background: rgb(220, 220, 220);
}

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