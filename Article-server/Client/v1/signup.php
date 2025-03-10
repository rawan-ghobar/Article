<?php

include_once(__DIR__ . "/../../Connection/connection.php");
include_once(__DIR__ . "/../../Utils/utils.php");
include_once(__DIR__ . "/../../Models/User.php");
include_once(__DIR__ . "/../../Models/UserSkeleton.php");

header("Content-Type: application/json");


if($_SERVER["REQUEST_METHOD"] !== "POST") 
{
    response(false, "Invalid request method");
    exit;
}

$data = getJsonRequestData() ;

if(!isset($data["full_name"]))
{
    response(false,"Please enter your First Name");
    return;
}
else if (!isset($data["email"]))
{
    response(false,"Please enter your email");
    return;
}
else if (!isset($data["user_password"]))
{
    response(false,"Please enter your password");
    return;
}
else if (!isset($data["confirm_password"]))
{
    response(false,"Please confirm password");
    return;
}


$full_name= $data["full_name"];
$email = $data["email"];
$user_password = $data["user_password"];
$confirmpassword = $data["confirm_password"];

if ($user_password !== $confirmpassword)
{
    response(false, "Passwords do not match");
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    response(false, "Invalid email format");
    return;
}  
$userSkeleton = new UserSkeleton(null,$full_name, $user_password, $email);

$user = new User($mysqli);

$result = $user->createUser($userSkeleton);

json_encode($result);
?>