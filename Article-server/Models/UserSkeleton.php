<?php
include_once("UserSkeleton.php");
include(__DIR__ . "/../../Connection/connection.php");

class User {
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function createUser(UserSkeleton $user)
    {
        $sql = "INSERT INTO users (full_name, user_password, email) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sss", $full_name, $hashed_password, $email);

        $full_name = $user->getFullName();
        $hashed_password = $user->getHashedPassword();
        $email = $user->getEmail();

        if ($stmt->execute())
        {
            return "User created successfully!";
        }
        else
        {
            return "Error: " . $this->mysqli->error;
        }
    }
    
    public function getUserByEmail($email) {
        $sql = "SELECT full_name, user_password, email FROM users WHERE email = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($full_name, $hashed_password, $email);
    
        if ($stmt->fetch()) {
            return new UserSkeleton($full_name, $hashed_password, $email);
        }
        return null;
    }
    

    public function getUserById($id)
    {
        $sql = "SELECT full_name, user_password, email FROM users WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($full_name, $hashed_password, $email);

        if ($stmt->fetch())
        {
            return new UserSkeleton($full_name, $hashed_password, $email);
        }
        return null;
    }

    public function updateUser($id, $new_name)
    {
        $sql = "UPDATE users SET full_name = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $new_name, $id);

        if ($stmt->execute())
        {
            return "User updated successfully!";
        }
        else
        {
            return "Error: " . $this->mysqli->error;
        }
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "User deleted successfully!";
        } else {
            return "Error: " . $this->mysqli->error;
        }
    }
}
?>
