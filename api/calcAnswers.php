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
$awnserLocation = $answersClass->calculateAnswers($data);
$top3parties = $politicialPartyClass->partyResult($answersResult);

$returnData = [
  "location" => $answersResult,
  "top3Parties" => $top3parties
];

echo json_encode($returnData);
