<?php
include_once('my_functions.php');

saveToXML($_POST['tuote'], $_POST['maara']);

header('Location: index.php');