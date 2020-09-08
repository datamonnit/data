<?php
require_once('db.php');

header("Content-Type: application/json; charset=UTF-8");

$obj = json_decode($_POST["x"], false);

$sql = "SELECT {$obj->fields[0]}, {$obj->fields[1]}, {$obj->fields[2]} FROM {$obj->table} ORDER BY pvm DESC;";
$result = $conn->query($sql);

$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);

// echo $sql;
// var_dump($outp);

echo json_encode($outp);