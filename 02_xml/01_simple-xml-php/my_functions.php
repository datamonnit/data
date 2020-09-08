<?php
/* 
Funktio tallentaa tuotteen ja määrän tekstitiedostoon
*/
function saveToXML($tuote, $maara){
    $xml = simplexml_load_file('data/list.xml');
    
    $uusi_tuote = $xml->addChild('tuote');
    $uusi_tuote->addChild('nimi', $tuote);
    $uusi_tuote->addChild('määrä', $maara);

    // Muotoilu ja tallennus
    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $dom->save('data/list.xml');

}