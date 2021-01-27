<?php
require_once("dbClass.php");
require_once("politicialPartiesClass.php");
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

    public function getsMaxAxis() {
        try {
            $yAxisPlusMax = 0;
            $yAxisMinusMax = 0;
            $xAxisPlusMax = 0;
            $xAxisMinusMax = 0;
            $connection = (new db)->connect();
            $stmtX = $connection->prepare('SELECT * FROM `questions` WHERE axis = ?');
            $stmtY = $connection->prepare('SELECT * FROM `questions` WHERE axis = ?');
            $arrayMaxAxis = array();
            if ($stmtY->execute(["y"])) {
                while ($row = $stmtY->fetch(PDO::FETCH_ASSOC)) {
                    $yAs= $row['value'];
                    if ($yAs < 0) {
                        $yAxisMinusMax++;
                    } else {
                        $yAxisPlusMax++;
                    }
                }
            }
            if ( $stmtX->execute(["x"])) {
                while ($row = $stmtX->fetch(PDO::FETCH_ASSOC)) {
                    $xAs= $row['value'];
                    if ($xAs < 0) {
                        $xAxisMinusMax++;
                    } else {
                        $xAxisPlusMax++;
                    }
                }
            }
            array_push($arrayMaxAxis, $xAxisMinusMax);
            array_push($arrayMaxAxis, $xAxisPlusMax);
            array_push($arrayMaxAxis, $yAxisMinusMax);
            array_push($arrayMaxAxis, $yAxisPlusMax);
            return max($arrayMaxAxis);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function calcResultPercent($topThree) {
        try {
            $maxAxis = $this->getsMaxAxis();
            $distanceXpoint = pow(-$maxAxis - $maxAxis, 2);
            $distanceYpoint = pow(-$maxAxis - $maxAxis, 2);
            $distanceXYpoint = sqrt($distanceXpoint + $distanceYpoint);
            $calculatedPercent = array();
            foreach ($topThree as $party) {
                $distanceTo = $distanceXYpoint - $party['distance'];
                $percent = 100 / $distanceXYpoint * $distanceTo;
                $partyArray = array(
                    "id" => $party['id'],
                    "politicParty" => $party['politicParty'],
                    "distance" => $party['distance'],
                    "distancePercent" => $percent,
                    "image" => $party['image']
                );
                array_push($calculatedPercent, $partyArray);
            }
            return $calculatedPercent;
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
