<?php
include_once('my_functions.php');

saveToFile($_POST['tuote'], $_POST['maara']);

header('Location: index.php');