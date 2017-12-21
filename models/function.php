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

function doFeedbackAction(){
	$id = strip_tags(trim($_POST['id']));
	$oper = strip_tags(trim($_POST['oper']));
	include "controller/config.php";
	$table = 'product';
	$imgSizeH = 250;
	$imgSizeW = 250;
	$name = strip_tags(trim($_POST['name']));
	$text = strip_tags(trim($_POST['text']));
	$image = strip_tags(trim($_POST['image']));
	$price = (int)$_POST['price'];
	$id = (int)trim($id);
	$file = strToUrl($_FILES['image']['name']);
	$tmp = $_FILES['image']['tmp_name'];
	$type = explode("/",$_FILES['image']['type'])[0];
	switch ($oper) {
		case 'create'://--------------- create --------
		if(empty($_POST['save']))
			$result = '<form id="edit-new" class="active" enctype="multipart/form-data" action="?crud" method="POST">
						<div class="input">Имя<input type="text" name="name">
						<input type="hidden" name="oper" value="create"><input type="hidden" name="save" value="yes"><br>
						Цена<input type="text" name="price"><br>
						Фото<input type="file" name="image"><br>
						<p onclick="crud(\'save\',\'new\')" name>Save</p></div>
						Описание<textarea name="text" cols="30" rows="10"></textarea>
					</form>';
		else
		{
			if(explode("/",$_FILES['image']['type'])[0] == "image"){
				$file = strToUrl($_FILES['image']['name']);
				$tmp = $_FILES['image']['tmp_name'];
				// без проверки на уникальность фото
				$sql = "INSERT INTO `$table` (`name`,`image`,`text`,`price`) VALUES ('$name','$file','$text','$price')";
				create_thumbnail($tmp, SMALL.$file, $imgSizeW, $imgSizeH);
				$isOkCopy = rename($tmp,BIG.$file);
				/// проверка наличия фото в базе по имени файла
			/*	$sql = "SELECT COUNT(*) as 'count' from $table WHERE `image` = '".$file."'";
				$res = mysqli_query($connect,$sql);
				$isFileDB = mysqli_fetch_array($res);
				if($isFileDB ["count"]>0) $message = 'Ошибка!<br>файл уже есть!';
				else {
					$sql = "INSERT INTO `$table` (`name`,`file`) VALUES ('$name','$file')";
					//$isOkDB = mysqli_query($connect,$sql);
					create_thumbnail($tmp, SMALL.$file, $imgSizeW, $imgSizeH);
					$isOkCopy = rename($tmp,BIG.$file);
					//if($isOkCopy&&$isOkDB) $message = $name.'<br>Скопировано!';
					//	else $message = 'Ошибка копирования!';
				}
				*/
			}
			elseif(!empty($_FILES)) $message =  'Ошибка!<br>Загружено не фото!';
			else {
				$message =  'Сохраняю, но<br>Фото не загружено!';
				$sql = "INSERT INTO `$table` (`name`,`text`,`price`) VALUES ('$name','$text','$price')";
			}
			//
		}
			break;////------------------- end create ----------
		case 'update':
			if($id<1) {$message='Ошибка, нет id элемента';break;}
			if(empty($_POST)){
				$sqls = "SELECT * FROM `$table` WHERE `id` = $id";
				$res = mysqli_query($connect,$sqls);
				$product = mysqli_fetch_array($res);
				$result = '<form enctype="multipart/form-data" action="" method="POST">
						Название<input type="text" name="name" value = "'.$product['name'].'"><br>
						Цена<input type="text" name="price" value = "'.$product['price'].'"><br>
						Описание<textarea name="text" cols="30" rows="10">'.$product['text'].'</textarea><br>
						Фото<img src="'.SMALL.$product['image'].'" alt="'.$product['name'].'"><br>
						Новое фото<input type="file" name="image"><br>
						<button type="submit">Отправить</button>
					</form>';
			}
			elseif(!empty($name)&&!empty($text)&&!empty($price)){

				// если есть фото - скопируем и уменьшим 
				if($type == "image"){
					create_thumbnail($tmp, SMALL.$file, $imgSizeW, $imgSizeH);
					$isOkCopy = rename($tmp,BIG.$file);
					$sql = "UPDATE `$table` SET `name`='$name',`image`='$file',`text`='$text',`price`=$price WHERE id=$id";
				}
				else{
					$sql = "UPDATE `$table` SET `name`='$name',`text`='$text',`price`=$price WHERE id=$id";
					$message = 'Фото не изменено';
				}
			}
			else $message = 'Не заполнены все поля!';
			break;
		case 'delite':
			if($id<1) {$message='Ошибка, нет id элемента';break;}
			if(empty($_POST)){
				$sqls = "SELECT * FROM `$table` WHERE `id` = $id";
				$res = mysqli_query($connect,$sqls);
				$product = mysqli_fetch_array($res);
				if($product!=NULL){
					$result = '<form action="" method="POST">
						<h3>Удалить элемент</h3><h2>'.$product['name'].'</h2>
						<img src="'.SMALL.$product['image'].'" alt="'.$product['name'].'">
						<input type="hidden" name="image" value = "'.$product['image'].'">
						<input type="hidden" name="name" value = "'.$product['name'].'">
						<button type="submit" name = "yes" value="yes">Да</button>
						<button type="submit" name = "no" value="no">Нет</button>
					</form>';
				}
				else $message = "Элемент не найден!";
			}
			else{
			//	if(!empty($_POST['yes'])){
					$sql = "DELETE FROM `$table` WHERE `id` = $id";
					if(!empty($image)){
						$isOkDelB = unlink(BIG.$image);
						$isOkDelS = unlink(SMALL.$image);
						if($isOkDelB&&$isOkDelS) $message = "Элемент [$name]<br>Удален успешно!";
							else $message = "Ошибка удаления элемента [$name]!";
						}
					// }
					// else $message = "Не буду удалять [$name].";
				}
			break;
		default:
			$message = 'Ошибка <br> Не найден параметр.';
			break;
	}// end swith
if(!empty($sql)){
	$isOkDB =mysqli_query($connect,$sql);
	if($isOkDB) $message .= 'Успех!';
	else $message .= 'Ошибка БД!';
}
if(!empty($message)) $result = "<span class='message'>$message</span>$result";
return $result;
}
// --- end doFeedbackAction

function userAuth(){
	include "controller/config.php";
	$auth = false;
	// выход из сессии
	if(isset($_GET['out'])) {
		SetCookie("login",'',time()-3600);
		SetCookie("string",'',time()-3600);
		SetCookie("name",'',time()-3600);
		$_COOKIE = [];// обнуляем массив до чтения кук в браузере для корректной дальнейшей работы скрипта
		$_SESSION = [];
		//header("location: ".$_SERVER["HTTP_REFERER"]);
	}
	/// проверка логина и пароля
	if(!empty($_POST['login'])&&!empty($_POST['password'])){
		// логин 111 пароль 111
		// логин 555 пароль 555 - admin
		$login = strip_tags($_POST['login']);
		$password = md5(strip_tags($_POST['password']).SALT);
		$rememberme = !empty($_POST['rememberme']); // нужно ли сохранить куки
		$sql = "SELECT * FROM `user` WHERE `user_login` = '$login' AND `user_pass` = '$password'";
		$res = mysqli_query($connect,$sql);
		$count = mysqli_num_rows($res);
		$user = mysqli_fetch_assoc($res);
		// найдена запись о пользователе и верным паролем
		if($count==1){
			// если есть параметр сохранения в куки - сохраним в куки
			if($rememberme) {
				SetCookie("login",$user['user_login'],time()+(3600*24*365));
				SetCookie("name",$user['user_name']);
				SetCookie("string",$user['user_pass']);
			}
			$_SESSION['login'] = $user['user_login'];
			$_SESSION['name'] = $user['user_name'];
			$_SESSION['resol'] = $user['user_resol'];
			// перемещаем в личный кабинет
			header("location: ?user");
		}
		else{
			//записи о пользователе и верном пароле не найдено
			$loginMessage = "<span class='err'>Введен не верный пароль</span>";
		}
	}
	// 1. Пользователь не авторизован – сессии и куки нет.
	if(empty($_SESSION['login'])&&empty($_COOKIE['login'])){
		$auth = false;
	}
	// 2. Пользователь авторизован, не ставил галочку «запомнить» - сессия есть, куки нет.
	elseif(!empty($_SESSION['login'])&&empty($_COOKIE['login'])){
		$auth = true;
	}
	// 3. Пользователь долго ничего не делал на сайте, сессия удалилась – сессии нет, куки есть.
	elseif(empty($_SESSION['login'])&&!empty($_COOKIE['login'])){
		/*return  ' Я помню Вас, '.strip_tags($_COOKIE['name']).'. Введите пароль '.$loginMessage.'<form method="POST">
				<input id="login" type="text" value="'.strip_tags($_COOKIE['login']).'" name="login">
				<input id="password" autofocus type="password" placeholder="password" name="password"><br>
				<label><input type="checkbox" checked name="rememberme">Запомнить меня</label>
				<button type="submit">Войти</button>
				</form>';*/
		$login = strip_tags($_COOKIE['login']);
		$password = strip_tags($_COOKIE['string']);
		$sql = "SELECT * FROM `user` WHERE `user_login` = '$login' AND `user_pass` = '$password'";
		$res = mysqli_query($connect,$sql);
		$count = mysqli_num_rows($res);
		$user = mysqli_fetch_assoc($res);
		// найдена запись о пользователе и верным паролем
		if($count==1){
			// если есть параметр сохранения в куки - сохраним в куки
			$_SESSION['login'] = $user['user_login'];
			$_SESSION['name'] = $user['user_name'];
			$_SESSION['resol'] = $user['user_resol'];
			// перемещаем в личный кабинет
			//header("location: ?user");
			$auth = true;
		}
	}
	// 4. Пользователь авторизован, поставил галочку «запомнить» - сессия есть, куки есть
	elseif(!empty($_SESSION['login'])&&!empty($_COOKIE['login'])){
		$auth = true;
	}
	///////////////////
	// вывод сообщения пользователю
	if($auth){
		$name = !empty($_SESSION['name'])?$_SESSION['name']:$_SESSION['login'];
		if($_SESSION['resol']==1) $admin = "Админ, ";
		$loginMessage .= "[$admin$name] <a href='?out'>Выйти</a>";
	}
	else{
		$loginMessage .=  '<form method="POST">
		<input id="login" type="text" placeholder="login" autofocus name="login">
		<input id="password" type="password" placeholder="password" name="password"><br>
		<label><input type="checkbox" name="rememberme">Запомнить меня</label>
		<button type="submit">Войти</button>
		</form>';
	}
	return $loginMessage;
}
//--- end userAuth()

function ajaxBasket(){
	$add = (int)$_POST['add'];
	$del = (int)$_POST['del'];
	$min = (int)$_POST['min'];

	// если есть номер товара - то обрабатывем добавление товара
	if($add>0){
		// если в куки нет товара - ставим количество - 1
		if(empty($_COOKIE['prod_'.$add]))SetCookie("prod_$add",1);
		else {
			// иначе увеличиваем количесво товара
			$count = $_COOKIE['prod_'.$add];
			SetCookie("prod_$add",$count+1);
		}
		$message =  "Товар с id $add добавлен!";
	}
	elseif($min>0){
		$count = $_COOKIE['prod_'.$min];
		if($count>1)SetCookie("prod_$min",$count-1);
		else SetCookie("prod_$min",1,time()-3600);
		$message =  "Товар с id $min убран!";
	}
	elseif($del>0){
		SetCookie("prod_$del",1,time()-3600);
		$message =  "Товар с id $del удален!";
	}
	return $message;
}
// -- end ajaxBasket
function getBasket(){
	include "controller/config.php";
	// проверяем корзину
	$basket=[];
	foreach ($_COOKIE as $key => $value) {
		$keyS = strip_tags($key);
		$prod = explode("_", $keyS);
		if($prod[0]=='prod') {
			$basket[]=$prod[1];
			$basket['prod'][$prod[1]]=$value;
		}
	}
	// получаем все товары
	$sql = "select * from `product`";
	$res = mysqli_query($connect,$sql);
	while($prod = mysqli_fetch_array($res)){
		if(in_array($prod['id'], $basket)) $prod['link']="Уже в корзине - ".$basket['prod'][$prod['id']];
		else $prod['link']="В корзину";
	   $product[]= $prod; 
	}
	return $product;
}

?>
