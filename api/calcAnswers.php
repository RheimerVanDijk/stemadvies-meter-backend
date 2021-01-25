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
$answersResult = $answersClass->calculateAnswers($data);
$answersResult = $politicialPartyClass->partyResult($answersResult);
echo json_encode($answersResult, JSON_PRETTY_PRINT);
echo json_encode($politicialPartyClass, JSON_PRETTY_PRINT);
