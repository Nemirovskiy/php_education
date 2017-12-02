<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>PHP ДЗ 3</title>
	<style>
	ul {
		width: 1000px;
		margin: auto;
		font-size: 25px;
	}
	li {
    list-style: none;
    margin-top: 5px;
}
</style>
</head>
<body>
	<ul>
		<?
		$dir = scandir('.');
		foreach ($dir as $value) {
			if(stristr($value, ".php") && $value!="index.php"){
				$file = substr($value, 0,strlen($value)-4);
				$str .= "<li><a href='$value'>$file</a></li>";
			}
		}
		echo $str;
		?>
		</ul>
	</body>
	</html>