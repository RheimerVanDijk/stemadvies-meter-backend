<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../src/classes/politicialPartiesClass.php';

$partiesClass = (new parties());
$getParties = $partiesClass->getParties();

$partyResult = json_encode($getParties);
$partyResult = json_decode($partyResult, true);

for ($i = 0; $i < count($partyResult); $i++) {
    $partyResult[$i]["image"] = "data:image/png;base64," . base64_encode(file_get_contents($partyResult[$i]["image"]));
}

echo stripslashes(json_encode($partyResult, JSON_PRETTY_PRINT));
