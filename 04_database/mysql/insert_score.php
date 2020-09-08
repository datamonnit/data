<?php 
require_once('db.php');

$sql = "INSERT INTO highscore (date, points, name) VALUES (CURDATE(), 1000, 'Keijo');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}