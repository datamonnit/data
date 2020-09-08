<?php
/**
 * del.php - Removes node from data.xml -file. Node is specified bt GET-param
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
if (!isset($_GET['id']) || !is_int(intval($_GET['id'])) ) {
    
    $response = array(
        'status'    => 'error',
        'message'   => 'No correct parameters set!'
    );

    echo json_encode($response);
    die();

} 

/**
 * Continue modifyin XML-file
 */

$id = intval($_GET['id']);

define("XML_FILE", "data.xml");

$xml = simplexml_load_file(XML_FILE);
$i = intval($id);
unset($xml->viestit->viesti[$i]);

// Muotoilu ja tallennus
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xml->asXML());
if ($dom->save(XML_FILE)) {
    $response = array(
        'status'    => 'success',
        'message'   => 'XML-node removed'
    );

    echo json_encode($response);
}




