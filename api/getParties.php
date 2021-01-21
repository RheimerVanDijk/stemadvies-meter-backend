<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include_once '../src/classes/dbClass.php';
include_once '../src/classes/politicialPartiesClass.php';

$partiesClass = (new parties());
$getParties = $partiesClass->getParties();
echo json_encode($getParties, JSON_PRETTY_PRINT);
