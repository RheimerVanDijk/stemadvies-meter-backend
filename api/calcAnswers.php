<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include_once '../src/classes/dbClass.php';
include_once '../src/classes/answersClass.php';
include_once '../src/classes/politicialPartiesClass.php';

$data = $_POST['answersJsonArr'];

$answersClass = (new answersClass());
$politicialPartyClass= (new parties());
$location = $answersClass->calculateAnswers($data);
$top3Parties = $politicialPartyClass->partyResult($location);

$returnData = [
  "location" => $location,
  "top3Parties" => $top3Parties
];

echo json_encode($returnData);
