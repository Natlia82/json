<?php

$list = array_slice($argv, 1);

if ($list[0] == "") {
  echo "Ошибка! Аргументы не заданы. Укажите флаг
  --today или запустите скрипт с аргументами
    {цена} и {описание покупки}";
}
elseif ($list[0]=='--today') {
$summa = 0;
$handle = fopen(__DIR__.'/file.csv', "r");

  if ($handle) {
          while (($buffer = fgets($handle)) !== false) {
                       $str = rtrim($buffer);
						            $mass = explode(', ', $str);
                       if ($mass[0] == date('d.m.Y')) {
                          $summa = $summa+$mass[1];
                        }
                    }
                }
    $dat = date('d.m.Y');
    echo "$dat расход за день: $summa";
  fclose($handle);
}
else {
  $file = __DIR__.'/file.csv';

  $string = implode(", ", $list);
  file_put_contents($file, PHP_EOL.date('d.m.Y').', '.$string, FILE_APPEND | LOCK_EX);
}

 ?>
