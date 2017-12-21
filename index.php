<?
session_start();
/// подключаем настройки
include "controller/config.php";
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
if(isset($_SESSION['login'])) $menu = '<li><a href="?user">Кабинет</a></li>';
if($_SESSION['resol']==1) $menu .= '<li><a href="?admin">Админ</a></li>';
// ---- выводим на экран информацию ---
// если есть вывод ajax покажем его
if(!empty($basketMess)){
	echo $basketMess;
}
// если нет GET параметров - главная
elseif(empty($_GET)||isset($_GET['out'])){
	$title="Главная";
	$products = getBasket();
	$content = "views/index.php";
	include "views/main.php";
}
// если GET детальная
elseif(!empty($_GET['detail'])){
	$title="Детально";
	include "models/detail.php";
	$content = "views/detail.php";
	include "views/main.php";
}
elseif(isset($_GET['basket'])){
	$title="Корзина";
	include "models/basket.php";
	$content =  "views/basket.php";
	include "views/main.php";
}
elseif(isset($_GET['user'])&&isset($_SESSION['login'])){
	// покажем кабинет только если есть логин
		$title="Кабинет";
		$content =  "views/user.php";
		include "views/main.php";
}
elseif(isset($_GET['admin'])&&$_SESSION['resol']==1){
	// покажем кабинет только если админ
		$title="Кабинет админа";
		$products = getBasket();
		$content =  "views/admin.php";
		include "views/main.php";
}
elseif(isset($_GET['crud'])&&$_SESSION['resol']==1){
	// покажем кабинет только если админ
		//$title="Кабинет админа";
		$mess = doFeedbackAction();;
		//$content =  "views/crud.php";
		include "views/crud.php";
}
else{
		// иначе перебросим на главную
		header("location: .");
	}

?>