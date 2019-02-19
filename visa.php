<<?php
$list = array_slice($argv, 1);
if ($list[0] == "") {
  echo "Ошибка! Аргументы не заданы. Укажите страну";
}
else {
$flag = false;
	$file = "https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8"; // Ссылка на файл

	if(@fopen($file, "r")) {

    $lines = file('https://data.gov.ru/opendata/7704206201-country/data-20180609T0649-structure-20180609T0649.csv?encoding=UTF-8');
    foreach ($lines as $line_num => $line) {
      $pieces = explode(",", $line);
      $pieces[1] = str_replace('"', '',$pieces[1]);
       if ($pieces[1] == $list[0]) {
        echo $pieces[1].': '.$pieces[4];
        $flag = true;
       }
    }
    if (!$flag) {
      echo "совпадений нет!";
    }

	} else {

		echo "Файл отсутствует!";

	}
}

?>
