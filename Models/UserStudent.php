<?php
namespace Models;
use Models\User as User;

class UserStudent
{
    private $email;
    private $password;
    private $user;

    public function getEmail(){ return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getUser(){ return $this->user; }
    public function setUser(User $user): self { $this->user = $user; return $this; }
}
?>