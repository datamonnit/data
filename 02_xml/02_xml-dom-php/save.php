<?php
include_once('my_functions.php');

saveToXMLDom($_POST['tuote'], $_POST['maara']);

header('Location: index.php');