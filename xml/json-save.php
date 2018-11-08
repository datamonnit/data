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

// Get json-data
$json_data = json_decode(file_get_contents('php://input'));


/**
 * Check if integer param id exists
 */


// if (!isset($_POST['nimi']) && !isset($_POST['viesti']) ) {
if (!isset($json_data->nimi) && !isset($json_data->viesti) ) {
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

$nimi = $json_data->nimi;
$viesti = $json_data->viesti;

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




