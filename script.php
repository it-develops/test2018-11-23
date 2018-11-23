<?php

//Проверка на заполнение формы
function validate_form() {
	if (strlen(trim($_POST['mytext'])) > 0) {
		return true;		
	} else {
		return false;
	}
}

//Преобразование строковых данных
function convert() {
	$text = explode(PHP_EOL, htmlspecialchars(trim($_POST['mytext'])));
	
	for($line = 0; $line < count($text); ++$line) {
		$str = explode(' ', $text[$line]);
				
		for($elem = 0; $elem < count($str); ++$elem) {
			$element = str_split($str[$elem]);
			
			//Сортируем массив, используя алгоритм "natural order"
			//http://php.net/manual/ru/function.natsort.php
			natsort($element);
						
			$str[$elem] = implode("", $element);			
		}	
		
		$text[$line] = implode(' ', $str);				
	}
	
	return implode(PHP_EOL, $text);
}

function process_form() {	
	echo "Результат преобразования:";
	echo "<pre>";	
	print_r(convert());
	echo "</pre>";	
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//Проверка заполнения формы
	if (validate_form()) {
		//В форме есть более 1 символа, делаем преобразование
		process_form();
	} else {
		print "Нет данных!";
	}
}
