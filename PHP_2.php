<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>PHP ДЗ 2</title>
	<style>
	div {
		width: 1000px;
		margin: auto;
		font-size: 25px;
	}
</style>
</head>
<body>
	<div>
		<p>
			1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:

			если $a и $b положительные, вывести их разность;
			если $а и $b отрицательные, вывести их произведение;
			если $а и $b разных знаков, вывести их сумму;
			ноль можно считать положительным числом.
		</p>
		<?
		$a = rand(-15,15);
		$b = rand(-15,15);
		echo "a=$a b=$b<br>";
		if($a>=0 && $b >=0)
			echo "a и b положительные a-b=".($a-$b);
		if($a<0 && $b<0)
			echo "a и b отрицательные a*b=".($a*$b);
		if(($a<=0 && $b>=0)||($a>=0 && $b<0))
			echo "a и b разных знаков a+b=".($a+$b);
		?><hr>
		<p>
		2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.</p>
		<?
		echo "a = ";
		$a = abs($a);
		switch ($a) {
			case 0:
				echo $a++." ";
			case 1:
				echo $a++." ";
			case 2:
				echo $a++." ";
			case 3:
				echo $a++." ";
			case 4:
				echo $a++." ";
			case 5:
				echo $a++." ";
			case 6:
				echo $a++." ";
			case 7:
				echo $a++." ";
			case 8:
				echo $a++." ";
			case 9:
				echo $a++." ";
			case 10:
				echo $a++." ";
			case 11:
				echo $a++." ";
			case 12:
				echo $a++." ";
			case 13:
				echo $a++." ";
			case 14:
				echo $a++." ";
			case 15:
				echo $a;
				break;
			default:
				echo 'не число от 0 до 15';
		}
		?>
		<hr>
		<p>
		3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.</p>
		<?
		function getSum($a,$b){
			return $a+$b;
		}
		function getRaz($a,$b){
			return $a-$b;
		}
		function getUmn($a,$b){
			return $a*$b;
		}
		function getDel($a,$b){
			if($b!=0)
				return round($a/$b,2);
			else return 0;
		}

		echo "a=$a,b=$b<br> сложение:".getSum($a,$b);
		echo "<br> вычитание:".getRaz($a,$b);
		echo "<br> умножение:".getUmn($a,$b);
		echo "<br> Деление:".getDel($a,$b);
		?>
		<hr>
		<p>
		4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).</p>
		<?
		function mathOperation($arg1,$arg2,$oper){
			switch ($oper) {
				case '+':
				return getSum($arg1,$arg2);
				case '-':
				return getRaz($arg1,$arg2);
				case '*':
				return getUmn($arg1,$arg2);
				case '/':
				return getDel($arg1,$arg2);		
				default:
				return 0;
			}
		}
		echo "a=$a,b=$b<br> сложение:".mathOperation($a,$b,'+');
		echo "<br> вычитание:".mathOperation($a,$b,'-');
		echo "<br> умножение:".mathOperation($a,$b,'*');
		echo "<br> Деление:".mathOperation($a,$b,'/');
		?>
		<hr>
		<p>
			5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML шаблон, вывести текущий год в подвале при помощи встроенных функций PHP.
			<br><a href="minimalistica/">minimalistica</a>
		</p>
		<hr>
		<p>
			6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
			<br>
			<?
			function power($val,$pov=1){
				if($pov <= 1)
					return $val;
				else
					return $val * power($val,$pov-1);
			}
			$p = 5;
			echo " $a в степени $p = ".power($a,$p);
			?>
		</p>
		<hr>
		<p>
			7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например: <br>

			22 часа 15 минут<br>
			21 час 43 минуты<br><br>
			<?
			function getTime(){
				$min = date(i);
				$hour = date(G);
				if(substr($min,-1) == 1)
					$min_text = 'минута';
				elseif(substr($min,-1) == 2 || substr($min,-1) == 3 || substr($min,-1) == 4)
					$min_text = 'минуты';
				else $min_text = 'минут';
				if(substr($hour,-1) == 1)
					$hour_text = 'час';
				elseif(substr($hour,-1) == 2 || substr($hour,-1) == 3 || substr($hour,-1) == 4)
					$hour_text = 'часа';
				else $hour_text = 'часов';

				return $hour." ".$hour_text." ".$min." ".$min_text;
			}
			echo getTime();
			?>
		</p>
	</div>
</body>
</html>