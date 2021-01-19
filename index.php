<?php
require_once ("src/classes/questionsClass.php");
$questionsClass = (new questions());
$result = $questionsClass->getQuestions();
var_dump($result);
