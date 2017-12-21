<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title><?=$title?></title>
	<link rel="stylesheet" href="style/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<header>
		<footer>
			<nav>
				<ul>
					<li><a href=".">Главная</a></li>
					<li><a href="?basket">Корзина</a></li>
					<?=$menu?>
				</ul>
			</nav>
			<div id="user">
				<?=$loginMess?>
			</div>
		</footer>
	</header>
	<span id="mess"></span>
	<main>
		<? include $content;?>
	</main>
</body>
</html>