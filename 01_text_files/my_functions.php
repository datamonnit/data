<?php
/* 
Funktio tallentaa tuotteen ja määrän tekstitiedostoon
*/

function saveToFile($tuote, $maara){

    $my_row = PHP_EOL . "$tuote, $maara";

    $my_file = fopen("data/lista.txt", "a");
    fwrite($my_file, $my_row);
    fclose($my_file);

}
