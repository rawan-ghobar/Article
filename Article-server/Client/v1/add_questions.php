<?php

include_once(__DIR__ . "/../../Connection/connection.php");
include_once(__DIR__ . "/../../Utils/utils.php");
include_once(__DIR__ . "/../../Models/Question.php");
include_once(__DIR__ . "/../../Models/QuestSkeleton.php");

header("Content-Type: application/json");


if($_SERVER["REQUEST_METHOD"] !== "POST") 
{
    response(false, "Invalid request method");
    exit;
}

$data = getJsonRequestData() ;

if(!isset($data["question"]))
{
    response(false,"Please enter a question");
    return;
}
else if (!isset($data["answer"]))
{
    response(false,"Please enter an answer to your question");
    return;
}

$question= $data["question"];
$answer = $data["answer"];

$quesSkeleton = new QuestionSkeleton($question,$answer);

$user = new Question($mysqli);

$result = $user->createQuestion($quesSkeleton);

echo json_encode([
    "success" => $result === "FAQ added successfully!",
    "message" => $result
]);

?>