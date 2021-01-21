<?php
/**
 * Created by PhpStorm.
 * User: yoran
 * Date: 21-1-2021
 * Time: 13:31
 */
require_once("dbClass.php");

class answersClass
{
    public function calculateAnwsers($answersJson) {
        try {
            $answersArray = json_decode($answersJson);
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM questions');
            $stmt->execute();
            $result = $stmt->fetchAll();
            $i = 0;
            var_dump($answersArray);
            foreach ($answersArray as $question) {
                $i++;
                echo $question[$i];
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