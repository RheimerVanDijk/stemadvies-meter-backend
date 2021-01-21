<?php
require_once ("src/classes/questionsClass.php");
require_once ("src/classes/politicialPartiesClass.php");
require_once ("src/classes/answersClass.php");
$questionsClass = (new questions());
$partiesClass = (new parties());
$answersClass = (new answersClass());

$questions = [1, 2, 3, 4];
$anwsers = ['true', 'false', 'none', 'false'];

$answersJson = array("question_id" => $questions, "anwser" => $anwsers);

$calculatedAxis = $answersClass->calculateAnwsers(json_encode($answersJson));

$result = $questionsClass->getQuestions();

$chosenParties = $partiesClass->chosenParties(1);

$getParties = $partiesClass->getParties();

$resultParties = $partiesClass->partyResult(1, 5);

var_dump($resultParties);
