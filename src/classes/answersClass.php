<?php
require_once("dbClass.php");

class answersClass
{
    public function calculateAnswers($answersJsonArr)
    {
        try {
            $answersArray = json_decode($answersJsonArr, true);

            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM questions');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $x = -1;
            $xAxisVal = 0;
            $yAxisVal = 0;
            foreach ($answersArray as $answer) {
                $x++;
                if ($answer['question_id'] == $result[$x][0]) {
                    $answerCal = $answer['answer'];
                    switch ($answerCal) {
                        case "true":
                            if ($axis = "x") {
                                $xAxisVal += $result[$x][3];
                            } else {
                                $yAxisVal += $result[$x][3];
                            }
                            break;
                        case "false":
                            break;
                        case "none":
                            break;
                    }
                }
            }
            return array("x_axis" => $xAxisVal, "y_axis" => $yAxisVal);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
