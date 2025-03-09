<?php
include_once("UserSkeleton.php");
include_once(__DIR__ . "/../Connection/connection.php");
include_once(__DIR__ . "/../utils/utils.php");

class User {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function createUser(UserSkeleton $user)
    {
        $email = $user->getEmail();
        $user_password = $user->getPassword();
        $full_name = $user->getFullName();

        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0)
        {
            return "User already exists, please login.";
        }

        $hashed_password = hash('sha256', $user_password);

        $sql = "INSERT INTO users (full_name, user_password, email) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sss", $full_name , $hashed_password , $email );

        if ($stmt->execute())
        {
            return "User created successfully!";
        }
        else
        {
            return "Error: " . $this->mysqli->error;
        }
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT id, full_name, user_password, email FROM users WHERE email = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $full_name, $hashed_password, $email);
        if ($stmt->fetch())
        {
            return new UserSkeleton($id, $full_name, $hashed_password, $email);
        }
        return null;
    }
}
?>
