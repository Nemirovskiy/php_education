<?
$id = (int)$_GET['photo'];
$name = strip_tags(trim($_POST['name']));
$text = strip_tags(trim($_POST['text']));

//id_image	text	author

$sql = "INSERT INTO `feedback` (`id_image`,`text`,`author`) VALUES ('$id','$text','$name')";
$isOkDB = mysqli_query($connect,$sql);
if($isOkDB) $message = $name.'<br>Ваш отзыв добавлен!';
	else $message = 'Ошибка добавления отзыва!';
	