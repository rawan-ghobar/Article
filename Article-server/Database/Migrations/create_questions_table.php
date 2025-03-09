<?php
include(__DIR__ . "/../../Connection/connection.php");
$sql= "CREATE TABLE questions(
                              id int AUTO_INCREMENT PRIMARY KEY,
                              question varchar(255) NOT NULL,
                              answer text NOT NULL
                              )";

if ($mysqli->query($sql) === TRUE)
{
    echo "Questions table created successfully";
    return;
}

    echo "Cannot create table questions" .$mysqli->error;
?>