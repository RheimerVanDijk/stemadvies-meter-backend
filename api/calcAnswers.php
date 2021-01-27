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
$calculatedPercentParties = $answersClass->calcResultPercent($top3Parties);

for ($i = 0; $i < count($calculatedPercentParties); $i++) {
  $calculatedPercentParties[$i]["image"] = "data:image/png;base64," . base64_encode(file_get_contents($calculatedPercentParties[$i]["image"]));
}

$returnData = [
  "location" => $location,
  "top3Parties" => $calculatedPercentParties
];

echo json_encode($returnData);
