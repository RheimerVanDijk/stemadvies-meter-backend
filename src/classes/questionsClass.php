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
            $this->question = htmlspecialchars(strip_tags($_POST["question"]));
            $this->axis = htmlspecialchars(strip_tags($_POST["axis"]));
            $this->value = htmlspecialchars(strip_tags($_POST["valueAxis"]));
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

    public function updateQuestions()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('UPDATE `questions` SET question = :question, axis = :axis, value = :value WHERE question_id = :question_id');
            $this->question_id = htmlspecialchars(strip_tags($this->question_id));
            $this->question = htmlspecialchars(strip_tags($this->question));
            $this->axis = htmlspecialchars(strip_tags($this->axis));
            $this->value = htmlspecialchars(strip_tags($this->value));
            $stmt->bindParam(':question_id', $this->question_id);
            $stmt->bindParam(':question', $this->question);
            $stmt->bindParam(':axis', $this->axis);
            $stmt->bindParam(':value', $this->value);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Vraag is succesvol geupdatet'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function deleteQuestions()
    {
        try {
            $connection = (new db)->connect();
            $stmt = $connection->prepare('DELETE FROM `questions` WHERE question_id = :question_id');
            $this->question_id = htmlspecialchars(strip_tags($this->question_id));
            $stmt->bindParam(':question_id', $this->question_id);
            $stmt->execute();
            return json_encode([
                'type' => 'success',
                'msg' => 'Vraag is succesvol gedeletet'
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'type' => 'error',
                'msg' => $e->getMessage()
            ]);
        }
    }
}
