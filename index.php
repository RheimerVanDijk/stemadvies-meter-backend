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
            <input type="number" min="0" max="999" id="editPartieID" name="editPartieID" value="0"><Br>
            <button type="submit" class="btn btn-primary" name="editPartie">Partij Veranderen</button>
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
            <input type="text" name="question">
            <select name="axis" id="axis">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="x" id="linksRechts">Links of Rechts</option>
                <option value="y" id="progressiefConservatief">Progressief of Conservatief</option>
            </select>
            <select name="valueAxis" id="valueAxis" style="visibility: hidden">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="-1" id="minus"></option>
                <option value="1" id="plus"></option>
            </select>
            <button type="submit" class="btn btn-primary" name="addNewQuestion">Vraag Toevoegen</button>
        </form>
        <form method="post">
            <input type="hidden" value="" name="id">
            <div class="Class">
                <div class="Vraag">
                    <h5>Vraag aanpassen</h5>
                    <label>Vraag </label>
                    <input type="text" name="Vraag" class="vraag" value="">
                </div>
                <div class="Submit-e">
                    <input type="submit" class="btn btn-primary" value="Vraag aanpassen" name="Submit">
                </div>
        </form>

        <?php $questions = array();
        for ($i = 0; $i < count($questionsResult); $i++) {
            echo '<div id="question-' . $i . '">' . $questionsResult[$i]["question_id"] . '. ' . $questionsResult[$i]["question"] . ' <a href="index.php?question_id=' . $questionsResult[$i]["question_id"] . '"><i class="far fa-trash-alt"></i></a></div>';
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
</script>

</html>