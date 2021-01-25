<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

include_once '../src/classes/questionsClass.php';

$data = json_decode(file_get_contents("php://input"));

$questionsClass = (new questions());

$questionsClass->question = $data->question;
$questionsClass->axis = $data->axis;
$questionsClass->value = $data->value;

$createQuestions = $questionsClass->createQuestions();

echo $createQuestions;
