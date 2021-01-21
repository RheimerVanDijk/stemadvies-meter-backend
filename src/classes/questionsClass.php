<?php

require_once("dbClass.php");
class questions
{
    public function getQuestions()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('SELECT * FROM questions');
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

    public function createQuestions()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('INSERT INTO `questions` SET question = :question, axis = :axis, value = :value');

            $this->question = htmlspecialchars(strip_tags($this->question));
            $this->axis = htmlspecialchars(strip_tags($this->axis));
            $this->value = htmlspecialchars(strip_tags($this->value));

            $stmt->bindParam(':question', $this->question);
            $stmt->bindParam(':axis', $this->axis);
            $stmt->bindParam(':value', $this->value);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Vraag is succesvol toegevoegd'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
