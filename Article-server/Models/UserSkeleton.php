<?php

class UserSkeleton
{
    private $full_name;
    private $user_password;
    private $email;

    public function __construct($full_name,$user_password,$email)
    {
        $this->full_name= $full_name;
        $this->user_password= hash('sha256',$user_password);
        $this->email= $email;
    }
    public function getFullName()
    {
        return $this->full_name;
    }

    public function getHashedPassword() {
        return $this->user_password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setFullName($full_name)
    {
        $this->full_name= $full_name;
    }

    public function setPassword($user_password)
    {
        $this->user_password= hash('sha256',$user_password);
    }

    public function setEmail($email)
    {
        $this->email= $email;
    }
}
?>