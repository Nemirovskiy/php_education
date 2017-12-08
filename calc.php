
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">
	<title>PHP ДЗ 5 Калькулятор</title>
</head>
<body>
	<pre>
	<?

if(!empty($_POST['a'])&&!empty($_POST['b'])&&!empty($_POST['oper'])){
	print_r($_POST);
	$a=(int)$_POST['a'];
	$b=(int)$_POST['b'];
	$oper = strip_tags($_POST['oper']);
	switch ($oper) {
		case '+':
			$res = $a+$b;
			break;
		case '-':
			$res = $a-$b;
			break;
		case '*':
			$res = $a*$b;
			break;
		case '/':
			if($b==0) $res = "делние на 0";
			else $res = $a/$b;
			break;
		default:
			$res = "нет оператора";
			break;
	}
}
?>
</pre>
		<form method="POST">
			<input type="number" id="infile" name="a">
			<select name="oper">
				<option value="+">+</option>
				<option value="-">-</option>
				<option value="*">*</option>
				<option value="/">/</option>
			</select>
			<input type="number" id="infile" name="b">
			<button type="submit">Вычислить</button>
		</form>
		<p>Результат: <?=$res?></p>
	</div>
	<script>
		function del(id,name){
			var res = confirm('Удалить фото '+name);
			if(res) window.location ="?del="+id;
		}
	</script>
</body>
</html>