<?php
namespace Models;
use Models\Company as Company;

class UserCompany
{
    private $email;
    private $password;
    private $company;

    public function getEmail(){ return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getCompany(){ return $this->company; }
    public function setCompany(Company $company): self { $this->company = $company; return $this; }
}
?>