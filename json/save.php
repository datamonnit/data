<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json; charset=utf-8');
$json = file_get_contents('php://input');

$json_array = json_decode($json, true, 512, JSON_UNESCAPED_UNICODE);

if ($json_file = file_get_contents('data.json')) {

  $array_data = json_decode($json_file, true);
  $array_data[] = $json_array;
  $final_data = json_encode($array_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

  if (file_put_contents('data.json',$final_data)){
    echo 'tallennettu';
  } else {
    echo 'error';
  }
}
