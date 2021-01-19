<?php
/**
 * Created by PhpStorm.
 * User: yoran
 * Date: 19-1-2021
 * Time: 09:56
 */
require_once ("dbClass.php");
class parties
{
    public function getParties() {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM `political_parties`');
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
        catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function chosenParties($partyID) {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('UPDATE `political_parties` SET ammount_chosen = ammount_chosen + 1 WHERE party_id = :party_id');
            $stmt->execute([
                "party_id" => $partyID,
            ]);
            return json_encode([
                'type' => 'success',
                'msg' => 'De kolom van de gekozen partijs is successvol verhoogd'
            ]);
        }
        catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function partyResult($x, $y) {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM `political_parties`');
//            $result = array();
            $resultTotal = array();
//            $resultParty = array();
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $xAs = $row['x_position'];
                    $yAs = $row['y_position'];
                    $politicalPartyID = $row['party_id'];
                    $politicalPartyName = $row['name'];
                    $distanceXpoint = pow($x - $xAs, 2);
                    $distanceYpoint = pow($y - $yAs, 2);
                    $distantXYpoint = sqrt($distanceXpoint + $distanceYpoint);
                    $result = array(
                        "id" => $politicalPartyID,
                        "politicParty" => $politicalPartyName,
                        "distance" => $distantXYpoint
                    );
                    array_push($resultTotal, $result);
                }
            }
//            $closest = 0;
//            for ($i = 0; $i < count($resultTotal); $i++) {
//                if ($closest === 0) {
//                    $closest = $resultTotal[$i]['distance'];
//                } else if ($resultTotal[$i]['distance'] > 0 && $resultTotal[$i]['distance'] <= abs($closest)) {
//                    $closest = $resultTotal[$i]['distance'];
//                } else if ($resultTotal[$i]['distance'] < 0 && -$resultTotal[$i]['distance'] > abs($closest)) {
//                    $closest = $resultTotal[$i]['distance'];
//                }
//            }
            return $resultTotal;
        }
        catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}