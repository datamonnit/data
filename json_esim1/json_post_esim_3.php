<?php
require_once('db.php');
header("Content-Type: application/json; charset=UTF-8");

# Get JSON as a string
$json_str = file_get_contents('php://input');

# Get as an object
$obj = json_decode($json_str);

// $obj = json_decode($_POST["x"], false);

$sql = "INSERT INTO viestit (nimi, viesti) VALUES ('$obj->nimi', '$obj->viesti');";
$result = $conn->query($sql);

if (!$result) {
    $data = array(
        'status' => 'error',
        'sql' => $sql
    );
} else {
    $data = array(
        'status' => 'ok',
        'sql' => $sql
    );
}

echo json_encode($data);