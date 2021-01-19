<?php
require_once ("src/classes/questionsClass.php");
require_once ("src/classes/politicialPartiesClass.php");
$questionsClass = (new questions());
$partiesClass = (new parties());
$result = $questionsClass->getQuestions();
$chosenParties = $partiesClass->chosenParties(1);
$getParties = $partiesClass->getParties();
$resultParties = $partiesClass->partyResult(1, 5);
//var_dump($chosenParties);
//var_dump($getParties);
var_dump($resultParties);
//var_dump($result);
