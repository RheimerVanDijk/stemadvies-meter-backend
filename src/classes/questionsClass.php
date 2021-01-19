<?php
/**
 * Created by PhpStorm.
 * User: yoran
 * Date: 19-1-2021
 * Time: 09:58
 */
require_once ("dbClass.php");
class questions
{
    public function getQuestions() {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM questions');
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
}