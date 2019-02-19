<?php
$list = array_slice($argv, 1);

if ($list[0] == "") {
  echo "Ошибка! ";
}
else {  $kniga = implode(' ', $list);

$json = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.urlencode($kniga));
$array = json_decode($json, true);

if (!function_exists('json_last_error_msg')) {
        function json_last_error_msg() {
            static $ERRORS = array(
                JSON_ERROR_NONE => 'No error',
                JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
                JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
                JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
                JSON_ERROR_SYNTAX => 'Syntax error',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
            );

            $error = json_last_error();
            return isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';
        }
    }
$file = __DIR__.'/books.csv';
$items = $array["items"];
//var_dump($items);
$i = 0;
foreach ($items as $value) {
  $i++;
  //echo $i;
  //echo "<br>";
  foreach ($value as $key => $mass) {
    //var_dump($mass);
  if (is_array($mass)) {
    if ($mass["title"]) {

  if ($mass["authors"]<>null) {
   if(!file_exists($file)) {
     $id=0;
   } else {
     $file_arr = file($file);
     $id = count($file_arr);
   }
    $string = implode(" ", $mass["authors"]);
    $id++;
    file_put_contents($file, PHP_EOL.$id.', '.$mass["title"].', '.$string, FILE_APPEND | LOCK_EX);
       }
    }
  }


  }

}
//var_dump($items);
}
 ?>
