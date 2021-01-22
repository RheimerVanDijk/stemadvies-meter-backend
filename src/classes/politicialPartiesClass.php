<?php

require_once("dbClass.php");
class parties
{
    public function getParties()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM `political_parties`');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function chosenParties($partyID)
    {
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
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function partyResult($axis)
    {
        try {
            $axisArray = json_decode($axis, true);
            $x = $axisArray['x_axis'];
            $y = $axisArray['y_axis'];
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM `political_parties`');
            $resultTotal = array();
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
            $distance = array_column($resultTotal, 'distance');
            $minDistanceMap = $resultTotal[array_search(min($distance), $distance)];
            return json_encode($minDistanceMap);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function createParties()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('INSERT INTO `political_parties` SET name = :name, x_position = :x_position, y_position = :y_position, ammount_chosen = :ammount_chosen');
            $this->name = htmlspecialchars(strip_tags($_POST["namePartie"]));
            $this->x_position = htmlspecialchars(strip_tags($_POST["x"]));
            $this->y_position = htmlspecialchars(strip_tags($_POST["y"]));
            $this->ammount_chosen = htmlspecialchars(strip_tags($_POST["ammount_chosen"]));
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':x_position', $this->x_position);
            $stmt->bindParam(':y_position', $this->y_position);
            $stmt->bindParam(':ammount_chosen', $this->ammount_chosen);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Partij is succesvol toegevoegd'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function updateParties()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('UPDATE `political_parties` SET name = :name, x_position = :x_position, y_position = :y_position, ammount_chosen = :ammount_chosen WHERE party_id = :party_id');
            $this->party_id = htmlspecialchars(strip_tags($this->party_id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->x_position = htmlspecialchars(strip_tags($this->x_position));
            $this->y_position = htmlspecialchars(strip_tags($this->y_position));
            $this->ammount_chosen = htmlspecialchars(strip_tags($this->ammount_chosen));
            $stmt->bindParam(':party_id', $this->party_id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':x_position', $this->x_position);
            $stmt->bindParam(':y_position', $this->y_position);
            $stmt->bindParam(':ammount_chosen', $this->ammount_chosen);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Partij is succesvol geupdatet'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function deleteParties()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('DELETE FROM `political_parties` WHERE party_id = :party_id');
            $this->party_id = htmlspecialchars(strip_tags($this->party_id));
            $stmt->bindParam(':party_id', $this->party_id);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Partij is succesvol gedeletet'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
