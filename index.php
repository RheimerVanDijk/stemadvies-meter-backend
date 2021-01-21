<?php
require_once ("src/classes/questionsClass.php");
require_once ("src/classes/politicialPartiesClass.php");
require_once ("src/classes/answersClass.php");
require_once("src/classes/questionsClass.php");
require_once("src/classes/politicialPartiesClass.php");
$questionsClass = (new questions());
$partiesClass = (new parties());
$answersClass = (new answersClass());

$answers = '[{  "question_id": "1",  "answer": "true" }, { "question_id": "2", "answer": "true" }]';

$answersJsonArr = $answers;

$calculatedAxis = $answersClass->calculateAnswers($answersJsonArr);

$resultParties = $partiesClass->partyResult($calculatedAxis);

$result = $questionsClass->getQuestions();

$chosenParties = $partiesClass->chosenParties(1);

$getParties = $partiesClass->getParties();


var_dump($resultParties);

$getParties = $partiesClass->getParties();
// $resultParties = $partiesClass->partyResult(1, 5);

$partyResult = json_encode($getParties);
$partyResult = json_decode($partyResult, true);

$questionsResult = json_encode($result);
$questionsResult = json_decode($questionsResult, true);
// var_dump($chosenParties);
// echo json_encode($getParties);
// var_dump($resultParties);
// var_dump($result);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <title>stemwijzer</title>
</head>

<body>
    <h1>stemwijzer</h1>
    <div class="parties">
        <h3>Partijen</h3>
        <button type="button" class="btn btn-primary">Partij toevoegen</button>
        <?php $parties = array();
        for ($i = 0; $i < count($partyResult); $i++) {
            echo '<div id="party-' . $i . '">' . $partyResult[$i]["name"] . ' <a href="index.php"><i class="far fa-edit"></i></a></div>';
        } ?>
    </div>
    <div class="questions">
        <h3>Vragen</h3>
        <button type="button" class="btn btn-primary">Vraag toevoegen</button>
        <?php $questions = array();
        for ($i = 0; $i < count($questionsResult); $i++) {
            echo '<div id="question-' . $i . '">' . $i . '. ' . $questionsResult[$i]["question"] . ' <a href="index.php"><i class="far fa-edit"></i></a></div>';
        } ?>

        <div></div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>