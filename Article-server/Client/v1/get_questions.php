<?php

include_once(__DIR__ . "/../../Connection/connection.php");
include_once(__DIR__ . "/../../Utils/utils.php");
include_once(__DIR__ . "/../../Models/Question.php");
include_once(__DIR__ . "/../../Models/QuestSkeleton.php");

header("Content-Type: application/json");


if($_SERVER["REQUEST_METHOD"] !== "GET") 
{
    response(false, "Invalid request method");
    exit;
}

$question = new Question($mysqli);

$questions = $question->getAllQuestions();

if (is_array($questions))
{
    echo json_encode([
        "success" => true,
        "questions" => $questions
    ]);
}
else
{
    response(false, $questions);
}

?>