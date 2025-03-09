<?php
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

$host="localhost";
$user="root";
$password="";
$dbname="article";

$mysqli = new mysqli($host,$user,$password,$dbname);

if ($mysqli->connect_error)
{
    echo "Connection failed: " . $mysqli->connect_error;
    return;
}
else
{
    echo "Connection successful";
}

?>