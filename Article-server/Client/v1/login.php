<?php
include(__DIR__ . "/../../Connection/connection.php");
include(__DIR__ . "/../../utils/utils.php");
include_once(__DIR__ . "/../../Models/User.php");

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    response(false, "Invalid request method");
    exit;
}

$data = getJsonRequestData();

if (!isset($data["email"])) {
    response(false, "Please enter your email");
    exit;
}

if (!isset($data["user_password"])) {
    response(false, "Please enter your password");
    exit;
}

$email = $data["email"];
$user_password = $data["user_password"];

$user= new User($mysqli);

$userObject = $user->getUserByEmail($email);

if (!$userObject)
{
    response(false, "User not found. Please check your email or register");
    exit;
}

$hashed_password = $userObject->getPassword();

if (hash('sha256', $user_password) === $hashed_password)
{
    response(true, "Login successful", ["full_name" => $userObject->getFullName(), "email" => $userObject->getEmail()]);
}
else
{
    response(false, "Invalid password. Please try again.");
}
?>