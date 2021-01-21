<?php
require_once("dbClass.php");

class answersClass
{
    public function calculateAnwsers($answersJson)
    {
        try {
            $answersArray = json_decode($answersJson);
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM questions');
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($answersArray as $x => $question) {
                echo $x;
            }
            return $result;
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
