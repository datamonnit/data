<?php
/**
 * save.php - New message is saved by provided json-data
 * 
 * json-data format : { "nimi": "name here", "viesti": "message here" }
 * 
 * @license     MIT
 * @author      Tuomas Puro
 * 
 */

/**
 * Setting header to JSON UTF-8
 */
header("Content-type: application/json; charset=utf-8");

/**
 * Check if integer param id exists
 */

if (!isset($_POST['nimi']) && !isset($_POST['viesti']) ) {
    $response = array(
        'status'    => 'error',
        'message'   => 'No correct data set!'
    );

    echo json_encode($response);
    die();

} 

/**
 * Continue modifyin XML-file
 */

define("XML_FILE", "data.xml");
$xml = simplexml_load_file(XML_FILE);

$nimi = $_POST['nimi'];
$viesti = $_POST['viesti'];

$uusi_viesti = $xml->viestit->addChild('viesti',$viesti);
$uusi_viesti->addAttribute('lähettäjä',$nimi);

// Muotoilu ja tallennus
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
if ($dom->save(XML_FILE)) {
    $response = array(
        'status'    => 'success',
        'message'   => 'XML-node saved'
    );

    echo json_encode($response);
}




