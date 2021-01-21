<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../src/classes/politicialPartiesClass.php';

$data = json_decode(file_get_contents("php://input"));

$partiesClass = (new parties());

$partiesClass->party_id = $data->party_id;

$deleteParties = $partiesClass->deleteParties();

echo $deleteParties;
