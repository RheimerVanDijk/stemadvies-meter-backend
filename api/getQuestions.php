<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// include_once '../src/classes/dbClass.php';
include_once '../src/classes/questionsClass.php';

$questionsClass = (new questions());
$getQuestions = $questionsClass->getQuestions();
echo json_encode($getQuestions, JSON_PRETTY_PRINT);
