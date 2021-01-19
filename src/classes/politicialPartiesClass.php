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
}