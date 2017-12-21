<?
/// подключаем настройки
include "config.php";
// подключаем функции
include "models/function.php";

/// первым делом проверяем есть ли пост,
//  если есть обработаем его 
if(!empty($_POST)){
	// обработка поста функциями
	// обработка корзины
	$basketMess = ajaxBasket();
	// Обработка авторизации пользователя
	$loginMess = userAuth();
}
// подключаем авторизацию пользователя
if(empty($loginMess)) $loginMess = userAuth();

// ---- выводим на экран информацию ---
// если есть вывод ajax покажем его
if(!empty($basketMess)){
	echo $basketMess;
}
// если нет GET параметров - главная
elseif(empty($_GET)){
	$title="Главная";
	$content = "models/catalog.php";
	include "views/main.php";
}
// если GET детальная
elseif(!empty($_GET['detail'])){
	$title="Детально";
	$content = "models/detail.php";
	include "views/detail.php";
}
elseif(isset($_GET['basket'])){
	$title="Корзина";
	$content = "models/basket.php";
	include "views/basket.php";
}
elseif(isset($_GET['user'])){
	$title="Кабинет";
	$content = "models/basket.php";
	include "views/user.php";
}