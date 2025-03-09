<?php
include( __DIR__. "/../../Connection/connection.php");
$hashedpassword= hash('sha256', "rawan123");
$sql = " INSERT INTO users(full_name,user_password,email) VALUES ('Rawan Ghobar','$hashedpassword','rawanghobar@gmail.com')";

if ($mysqli->query($sql) === TRUE)
{
    echo "User created successfully";
    return;
}

    echo "Failed to create the user, reason: " .$mysqli->error;
?>