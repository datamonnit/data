<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id']) || !is_int(intval($_GET['id'])) ) {
  die('Yritit jotain laitonta ilman vaadittuja parametreja!');
}

$errors = [];
if ($json_file = file_get_contents('data.json')) {
    $id = intval($_GET['id']);
    echo 'id = ' . $id;
    $array_data = json_decode($json_file, true);
    unset($array_data[$id]);
    $final_data = json_encode(array_values($array_data), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if (file_put_contents('data.json',$final_data)){
      echo 'tallennettu';
    } else {
      echo 'error';
    }
  }
  echo 'ok';
