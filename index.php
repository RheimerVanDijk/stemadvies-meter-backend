<?php
require_once("src/classes/questionsClass.php");
require_once("src/classes/politicialPartiesClass.php");
require_once("src/classes/answersClass.php");
require_once("src/classes/questionsClass.php");
require_once("src/classes/politicialPartiesClass.php");
$questionsClass = (new questions());
$partiesClass = (new parties());
$answersClass = (new answersClass());

$answers = '[{  "question_id": "1",  "answer": "true" }, { "question_id": "2", "answer": "false" }, { "question_id": "3", "answer": "true" }
, { "question_id": "4", "answer": "true" }, { "question_id": "5", "answer": "true" }, { "question_id": "6", "answer": "true" }, 
{ "question_id": "7", "answer": "true" }, { "question_id": "8", "answer": "false" }, { "question_id": "9", "answer": "true" }, 
{ "question_id": "10", "answer": "true" }, { "question_id": "11", "answer": "true" }, { "question_id": "12", "answer": "true" }, 
{ "question_id": "13", "answer": "false" }, { "question_id": "14", "answer": "false" }, { "question_id": "15", "answer": "true" }, 
{ "question_id": "16", "answer": "false" }, { "question_id": "17", "answer": "false" }]';

$answersJsonArr = $answers;

$calculatedAxis = $answersClass->calculateAnswers($answersJsonArr);

var_dump($calculatedAxis);

$resultParties = $partiesClass->partyResult(array("x_axis" => 4, "y_axis" => -1));

var_dump($resultParties);

$calculatedPercent = $answersClass->calcResultPercent($resultParties);

var_dump($calculatedPercent);

$result = $questionsClass->getQuestions();

$chosenParties = $partiesClass->chosenParties(1);

$getParties = $partiesClass->getParties();



$getParties = $partiesClass->getParties();

$partyResult = json_encode($getParties);
$partyResult = json_decode($partyResult, true);

$questionsResult = json_encode($result);
$questionsResult = json_decode($questionsResult, true);

// var_dump($chosenParties);
// echo json_encode($getParties);
// var_dump($resultParties);
// var_dump($result);

if (isset($_POST["addNewPartie"])) {
    $partiesClass->name = $_POST["namePartie"];
    $partiesClass->x_position = $_POST["x"];
    $partiesClass->y_position = $_POST["y"];
    $partiesClass->amount_chosen = $_POST["amount_chosen"];
    $partiesClass->createParties();
    header("Location: index.php");
}

if (isset($_POST["editPartie"])) {
    $partiesClass->party_id = $_POST["editPartieID"];
    $partiesClass->name = $_POST["namePartie"];
    $partiesClass->x_position = $_POST["x"];
    $partiesClass->y_position = $_POST["y"];
    $partiesClass->updateParties();
    header("Location: index.php");
}

if (isset($_POST["addNewQuestion"])) {
    $questionsClass->question = $_POST["question"];
    $questionsClass->axis = $_POST["axis"];
    $questionsClass->value = $_POST["valueAxis"];
    $questionsClass->createQuestions();
    header("Location: index.php");
}

if (isset($_POST["editQuestion"])) {
    $questionsClass->question_id = $_POST["editQuestionID"];
    $questionsClass->question = $_POST["question"];
    $questionsClass->axis = $_POST["axis"];
    $questionsClass->value = $_POST["valueAxis"];
    $questionsClass->updateQuestions();
    header("Location: index.php");
}

if (isset($_GET["party_id"])) {
    $partiesClass->party_id = $_GET["party_id"];
    $partiesClass->deleteParties();
    header("Location: index.php");
}

if (isset($_GET["question_id"])) {
    $questionsClass->question_id = $_GET["question_id"];
    $questionsClass->deleteQuestions();
    header("Location: index.php");
}

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
        <form method="post" action="">
            <input type="text" id="namePartie" name="namePartie" placeholder="Naam partij" required>
            <input type="number" min="-5" max="5" id="x" name="x" value="0" required>
            <input type="number" min="-5" max="5" id="y" name="y" value="0" required>
            <input type="hidden" value="0" name="amount_chosen">
            <button type="submit" class="btn btn-primary" name="addNewPartie">Partij Toevoegen</button><br>
            <h5>Partij aanpassen</h5>
            <label>Partij </label>
            <input type="number" min="0" max="999" id="editPartieID" name="editPartieID" value="0">
            <button type="submit" class="btn btn-primary" name="editPartie">Partij Aanpassen</button>
        </form>

        <?php $parties = array();
        for ($i = 0; $i < count($partyResult); $i++) {
            echo '<div id="party-' . $partyResult[$i]["party_id"] . '" x="' . $partyResult[$i]["x_position"] . '" Y="' . $partyResult[$i]["y_position"] . '">' . $partyResult[$i]["name"] . ' <a href="index.php?party_id=' . $partyResult[$i]["party_id"] . '"><i class="far fa-trash-alt"></i></a></div>';
        } ?>
    </div>

    <div class="questions">
        <h3>Vragen</h3>

        <h5>Vragen toevoegen</h5>
        <form method="post" action="">
            <input type="text" id="nameQuestion" name="question" placeholder="Vraag" required>
            <select name="axis" id="axis">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="x" id="linksRechts">Links of Rechts</option>
                <option value="y" id="progressiefConservatief">Progressief of Conservatief</option>
            </select>
            <select name="valueAxis" id="valueAxis" style="visibility: visible">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="-1" id="minus"></option>
                <option value="1" id="plus"></option>
            </select>
            <button type="submit" class="btn btn-primary" name="addNewQuestion">Vraag Toevoegen</button>
            <h5>Vraag aanpassen</h5>
            <label>Vraag </label>
            <input type="number" min="0" max="999" id="editQuestionID" name="editQuestionID" value="0" onchange="axisTest();">
            <button type="submit" class="btn btn-primary" name="editQuestion">Vraag Aanpassen</button>
        </form>

        <?php $questions = array();
        for ($i = 0; $i < count($questionsResult); $i++) {
            echo '<div id="question-' . $questionsResult[$i]["question_id"] . '" axis="' . $questionsResult[$i]["axis"] . '" value="' . $questionsResult[$i]["value"] . '">' . $questionsResult[$i]["question"] . ' <a href="index.php?question_id=' . $questionsResult[$i]["question_id"] . '"><i class="far fa-trash-alt"></i></a></div>';
        } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script>
    document.getElementById('axis').onchange = function() {
        document.getElementById("valueAxis").style.visibility = "visible";
        if (document.getElementById("axis").value == "x") {
            document.getElementById("minus").innerHTML = "Links";
            document.getElementById("plus").innerHTML = "Rechts";
        } else if (document.getElementById("axis").value == "y") {
            document.getElementById("minus").innerHTML = "Conservatief";
            document.getElementById("plus").innerHTML = "Progressief";
        }
    }

    // document.getElementById('axis').addEventListener("change", axis);

    function axisTest() {
        document.getElementById("valueAxis").style.visibility = "visible";
        if (document.getElementById("axis").value == "x") {
            document.getElementById("minus").innerHTML = "Links";
            document.getElementById("plus").innerHTML = "Rechts";
        } else if (document.getElementById("axis").value == "y") {
            document.getElementById("minus").innerHTML = "Conservatief";
            document.getElementById("plus").innerHTML = "Progressief";
        }
    }

    document.querySelector('#editPartieID').addEventListener("change", editParty);

    function editParty() {
        if (document.querySelector('#editPartieID').value == 0) {
            document.querySelector('#namePartie').value = document.querySelector('#party-0').innerText;
            document.querySelector('#x').value = document.querySelector('#party-0').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-0').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 1) {
            document.querySelector('#namePartie').value = document.querySelector('#party-1').innerText;
            document.querySelector('#x').value = document.querySelector('#party-1').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-1').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 2) {
            document.querySelector('#namePartie').value = document.querySelector('#party-2').innerText;
            document.querySelector('#x').value = document.querySelector('#party-2').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-2').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 3) {
            document.querySelector('#namePartie').value = document.querySelector('#party-3').innerText;
            document.querySelector('#x').value = document.querySelector('#party-3').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-3').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 4) {
            document.querySelector('#namePartie').value = document.querySelector('#party-4').innerText;
            document.querySelector('#x').value = document.querySelector('#party-4').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-4').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 5) {
            document.querySelector('#namePartie').value = document.querySelector('#party-5').innerText;
            document.querySelector('#x').value = document.querySelector('#party-5').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-5').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 6) {
            document.querySelector('#namePartie').value = document.querySelector('#party-6').innerText;
            document.querySelector('#x').value = document.querySelector('#party-6').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-6').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 7) {
            document.querySelector('#namePartie').value = document.querySelector('#party-7').innerText;
            document.querySelector('#x').value = document.querySelector('#party-7').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-7').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 8) {
            document.querySelector('#namePartie').value = document.querySelector('#party-8').innerText;
            document.querySelector('#x').value = document.querySelector('#party-8').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-8').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 9) {
            document.querySelector('#namePartie').value = document.querySelector('#party-9').innerText;
            document.querySelector('#x').value = document.querySelector('#party-9').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-9').attributes.y.value;
        }
        if (document.querySelector('#editPartieID').value == 10) {
            document.querySelector('#namePartie').value = document.querySelector('#party-10').innerText;
            document.querySelector('#x').value = document.querySelector('#party-10').attributes.x.value;
            document.querySelector('#y').value = document.querySelector('#party-10').attributes.y.value;
        }
    }

    document.querySelector('#editQuestionID').addEventListener("change", editQuestion);

    function editQuestion() {
        if (document.querySelector('#editQuestionID').value == 0) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-0').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-0').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-0').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 1) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-1').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-1').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-1').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 2) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-2').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-2').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-2').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 3) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-3').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-3').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-3').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 4) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-4').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-4').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-4').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 5) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-5').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-5').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-5').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 6) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-6').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-6').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-6').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 7) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-7').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-7').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-7').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 8) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-8').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-8').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-8').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 9) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-9').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-9').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-9').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 10) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-10').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-10').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-10').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 11) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-11').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-11').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-11').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 12) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-12').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-12').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-12').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 13) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-13').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-13').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-13').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 14) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-14').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-14').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-14').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 15) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-15').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-15').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-15').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 16) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-16').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-16').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-16').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 17) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-17').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-17').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-17').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 18) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-18').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-18').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-18').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 19) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-19').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-19').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-19').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 20) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-20').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-20').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-20').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 21) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-21').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-21').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-21').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 22) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-22').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-22').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-22').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 23) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-23').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-23').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-23').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 24) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-24').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-24').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-24').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 25) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-25').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-25').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-25').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 26) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-26').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-26').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-26').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 27) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-27').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-27').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-27').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 28) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-28').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-28').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-28').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 29) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-29').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-29').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-29').attributes.value.value;
        }
        if (document.querySelector('#editQuestionID').value == 30) {
            document.querySelector('#nameQuestion').value = document.querySelector('#question-30').innerText;
            document.querySelector('#axis').value = document.querySelector('#question-30').attributes.axis.value;
            document.querySelector('#valueAxis').value = document.querySelector('#question-30').attributes.value.value;
        }
    }
</script>

</html>