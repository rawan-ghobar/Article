<?php
include( __DIR__. "/../../Connection/connection.php");

$sql = " INSERT INTO questions(question,answer) VALUES ('What is Reference Architecture?', 'It is the designing and building of a complex system')";

if ($mysqli->query($sql) === TRUE)
{
    echo "FAQ created successfully";
    return;
}

    echo "Failed to create the FAQ, reason: " .$mysqli->error;
?>