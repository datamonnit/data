<?php
/* 
    Tallennetaan annetut arvot XML-tiedostoon
    käyttämällä DOMDocument-luokkaa
    https://www.php.net/manual/en/class.domdocument.php
*/
function saveToXMLDom($tuote, $maara){
    
    // Luodaan uusi DOM Document -objekti
    $doc = new DOMDocument();

    // Asetetaan muotoiluun liittyvät asetukset
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;

    // Ladataan XML-tiedosto 
    $doc->load('data/list.xml');

    $tuotteet = $doc->firstChild;

    // Luodaan uusi tuote-tagi...
    $uusi_tuote = $doc->createElement('tuote');
    
    // ... nimi-tagi sisältöinen ...
    $nimi = $doc->createElement('nimi', $tuote);
    
    // ... määrä-tagi sisälötinen ...
    $maara = $doc->createElement('määrä', $maara);

    // Liitetään uudet nimi- ja määrä- tagit 
    // uuteen tuote-tagiin
    $uusi_tuote->appendChild($nimi);
    $uusi_tuote->appendChild($maara);
    
    // Liitetään uusi tuote-tagi DOMiin
    $tuotteet->appendChild($uusi_tuote);

    // Ja lopuksi tallennetaan koko DOM entisen päälle
    $doc->save('data/list.xml');






}
