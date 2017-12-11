<?
// подключаем контроллер
require_once "controller/controller.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>PHP ДЗ 5 редактор товаров</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
<main>
	<?//print_r($_GET);
	?>
	
	<?echo doFeedbackAction($_GET['crud'],$_GET['crudid']);?>

</main>

</body>
</html>