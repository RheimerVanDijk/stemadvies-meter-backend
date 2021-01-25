<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../src/classes/politicialPartiesClass.php';

$data = json_decode(file_get_contents("php://input"));

$partiesClass = (new parties());

$partiesClass->name = $data->name;
$partiesClass->x_position = $data->x_position;
$partiesClass->y_position = $data->y_position;
$partiesClass->ammount_chosen = $data->ammount_chosen;

$createParties = $partiesClass->createParties();

echo $createParties;
