<?php
require_once ("src/classes/questionsClass.php");
require_once ("src/classes/politicialPartiesClass.php");
require_once ("src/classes/answersClass.php");
require_once("src/classes/questionsClass.php");
require_once("src/classes/politicialPartiesClass.php");
$questionsClass = (new questions());
$partiesClass = (new parties());
$answersClass = (new answersClass());

$answers = '[{  "question_id": "1",  "answer": "true" }, { "question_id": "2", "answer": "false" }, { "question_id": "3", "answer": "false" }
, { "question_id": "4", "answer": "true" }, { "question_id": "5", "answer": "true" }, { "question_id": "6", "answer": "true" }]';

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


if(isset($_POST["addNewPartie"])) {
    $partiesClass->createParties();
}

if(isset($_POST["addNewQuestion"])) {
    $questionsClass->createQuestions();
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
            <input type="text" name="namePartie" required>
            <input type="number" min="-5" max="5" name="x" required>
            <input type="number" min="-5" max="5" name="y" required>
            <input type="hidden" value="0" name="ammount_chosen">
            <button type="submit" class="btn btn-primary" name="addNewPartie">Partij toevoegen</button>
        </form>

        <?php $parties = array();
        for ($i = 0; $i < count($partyResult); $i++) {
            echo '<div id="party-' . $i . '">' . $partyResult[$i]["name"] . ' <a href="index.php"><i class="far fa-edit"></i></a></div>';
        } ?>
    </div>
    <h5>Partij aanpassen</h5>
    <form method="post" action="">
        <input type="text" name="Vraag" class="vraag" value="<?=$name ?>">
        <button type="submit" class="btn btn-primary" name="addNewQuestion">Partij veranderen</button>
    </form>
    <div class="questions">
        <h3>Vragen</h3>

        <h5>Vragen toevoegen</h5>
        <form method="post" action="">
            <input type="text" name="question">
            <select name="axis" id="axis">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="x" id="linksRechts">links of rechts</option>
                <option value="y" id="progressiefConservatief">progressief of conservatief</option>
            </select>
            <select name="valueAxis" id="valueAxis" style="visibility: hidden">
                <option disabled selected value> -- selecteer een optie -- </option>
                <option value="-1" id="minus"></option>
                <option value="1" id="plus"></option>
            </select>
            <button type="submit" class="btn btn-primary" name="addNewQuestion">Vraag toevoegen</button>
        </form>
        <form method="post">
            <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" >
            <div class="Naam-e">
                <div class="Post-e">
                    <h5>Vraag aanpassen</h5>
                <label>Vraag </label>
                <input type="text" name="Vraag" class="vraag" value="<?=$Vraag ?>">
            </div>
            <div class="Submit-e">
                <input type="submit" class="btn btn-primary" value="Vraag aanpassen" name="Submit">
            </div>
        </form>
        
        <?php $questions = array();
        for ($i = 0; $i < count($questionsResult); $i++) {
            echo '<div id="question-' . $i . '">' . $i . '. ' . $questionsResult[$i]["question"] . ' <a href="index.php"><i class="far fa-edit"></i></a></div>';
        }

//Edit systeem mee bezig by Dante.
//Vragen
        if(isset($_POST['Submit'])){
            $sql = "UPDATE `question` SET `question` = '" . mysqli_real_escape_string($conn, $_POST['vraag']) . "' , `question_id` =  '" . mysqli_real_escape_string($conn, $_POST['question_id']) . "' WHERE question_id = " . (int)$_POST['question_id'];
            $crud = null;
            $data = false;
            $result = $conn->query($sql);
            if(!$result) echo mysqli_error();
        }

        if (isset($_GET['id'])) {
            $sql = "SELECT `question_id`, `question` FROM `questions` WHERE question_id = " . (int)$_GET['question_id'];
            $crud = null;
            $data = false;
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $data = $row;
                    $Idvraag = $row["question_id"];
                    $Vraag = $row["question"];
                }
            }

        }
//Politieke partijen
        if(isset($_POST['Submit'])){
            $sql = "UPDATE `name` SET `name` = '" . mysqli_real_escape_string($conn, $_POST['name']) . "' , `party_id` =  '" . mysqli_real_escape_string($conn, $_POST['party_id']) . "' WHERE party_id = " . (int)$_POST['party_id'];
            $crud = null;
            $data = false;
            $result = $conn->query($sql);
            if(!$result) echo mysqli_error();
        }

        if (isset($_GET['id'])) {
            $sql = "SELECT `party_id`, `name` FROM `political_parties` WHERE party_id = " . (int)$_GET['party_id'];
            $crud = null;
            $data = false;
            if ($result = $conn->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $data = $row;
                    $party_id = $row["party_id"];
                    $name = $row["name"];
                }
            }

        }

        //
        ?>


        <button id="myButton" class="float-left submit-button" >Home</button>
            </div>
        <div></div>
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
</script>
</html>