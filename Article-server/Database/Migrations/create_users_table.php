<?php

include(__DIR__ . "/../../Connection/connection.php");

$sql=" CREATE TABLE users(
                          id int AUTO_INCREMENT PRIMARY KEY,
                          full_name varchar(255) NOT NULL,
                          user_password varchar(255) NOT NULL,
                          email varchar(255) UNIQUE NOT NULL
                          )";

if ($mysqli->query($sql) === TRUE)
{
    echo "Users table created successfully";
    return;
}
    echo "Users table Creation failed. Reason:" .$mysqli->error;
?>