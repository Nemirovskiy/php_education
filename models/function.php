<?
///// ----------- функции 
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

function strToUrl($str){
    $str = str_replace(" ", "_", $str);
    $arr = [
"а"=>"a", "б"=>"b", "в"=>"v", "г"=>"g", "д"=>"d",
"е"=>"e", "ё"=>"yo", "ж"=>"zh", "з"=>"z", "и"=>"i",
"й"=>"j", "к"=>"k", "л"=>"l", "м"=>"m", "н"=>"n",
"о"=>"o", "п"=>"p", "р"=>"r", "с"=>"s", "т"=>"t",
"у"=>"u", "ф"=>"f", "х"=>"kh", "ц"=>"cz", "ч"=>"ch",
"ш"=>"sh", "щ"=>"sh", "ъ"=>"", "ы"=>"y", "ь"=>"`", "э"=>"e", "ю"=>"yu", "я"=>"ya",
"А"=>"A", "Б"=>"B", "В"=>"V", "Г"=>"G", "Д"=>"D",
"Е"=>"E", "Ё"=>"YO", "Ж"=>"ZH", "З"=>"Z", "И"=>"I",
"Й"=>"J", "К"=>"K", "Л"=>"L", "М"=>"M", "Н"=>"N",
"О"=>"O", "П"=>"P", "Р"=>"R", "С"=>"S", "Т"=>"T",
"У"=>"U", "Ф"=>"F", "Х"=>"KH", "Ц"=>"CZ", "Ч"=>"CH",
"Ш"=>"SH", "Щ"=>"SH", "Ъ"=>"", "Ы"=>"Y", "Ь"=>"`", "Э"=>"E", "Ю"=>"YU", "Я"=>"YA"];
    return strtr($str, $arr);
}
