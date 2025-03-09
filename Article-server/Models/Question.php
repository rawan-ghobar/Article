<?php

include_once("QuestSkeleton.php");
include_once(__DIR__ . "/../Connection/connection.php");
include_once(__DIR__ . "/../utils/utils.php");

class Question {
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function createQuestion(QuestionSkeleton $questionSkeleton)
    {
        $question = $questionSkeleton->getQuestion();
        $answer = $questionSkeleton->getAnswer();

        $sql = "INSERT INTO questions (question, answer) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt)
        {
            return "Error preparing statement: " . $this->mysqli->error;
        }

        $stmt->bind_param("ss", $question,$answer);
        if ($stmt->execute())
        {
            $stmt->close();
            return "Question added successfully!";
        }
        else
        {
            $stmt->close();
            return "Error: " . $this->mysqli->error;
        }
    }

    public function getAllQuestions()
    {
        $sql = "SELECT question, answer FROM questions";
        $result = $this->mysqli->query($sql);
        $questions = [];

        if ($result)
        {
            while ($row = $result->fetch_assoc())
            {
                $questions[] = new QuestionSkeleton($row['question'], $row['answer']);
            }
            return $questions;
        }
        else
        {
            return "Error: " . $this->mysqli->error;
        }
    }

    public function updateQuestion($id, QuestionSkeleton $questionSkeleton)
    {
        $question = $questionSkeleton->getQuestion();
        $answer = $questionSkeleton->getAnswer();

        $sql = "UPDATE questions SET question = ?, answer = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);

        if (!$stmt)
        {
            return "Error preparing statement: " . $this->mysqli->error;
        }

        $stmt->bind_param("ssi", $question, $answer, $id);
        if ($stmt->execute())
        {
            $stmt->close();
            return "Question updated successfully!";
        }
        else
        {
            $stmt->close();
            return "Error: " . $this->mysqli->error;
        }
    }

    public function deleteQuestion($id)
    {
        $sql = "DELETE FROM questions WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        if (!$stmt)
        {
            return "Error preparing statement: " . $this->mysqli->error;
        }

        $stmt->bind_param("i", $id);
        if ($stmt->execute())
        {
            $stmt->close();
            return "Question deleted successfully!";
        }
        else
        {
            $stmt->close();
            return "Error: " . $this->mysqli->error;
        }
    }
}
?>