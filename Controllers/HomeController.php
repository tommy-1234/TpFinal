<?php
    namespace Controllers;

use DAO\CompanyDAO;
use DAO\UserCompanyDAO as UserCompanyDAO;
use DAO\UserDAO as UserDAO;
use DAO\UserStudentDAO as UserStudentDAO;
use Models\JobOffer;
use Models\User as User;

    class HomeController
    {
        private $userDAO;
        private $userCompanyDAO;
        private $userStudentDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->userCompanyDAO = new UserCompanyDAO();
            $this->userStudentDAO = new UserStudentDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        
        public function Login($userEmail, $password)
        {
            $user = $this->userDAO->GetUserByEmail($userEmail);
            $userCompany = $this->userCompanyDAO->SearchEmail($userEmail);

            if($userEmail == "admin@admin.com" && $password == "admin")
            {
                $user = new User();
                $user->setFirstName("Admin");
                $user->setEmail("admin@admin.com");
                $_SESSION["loggedUser"] = $user;
                $_SESSION['loggedAdmin'] = "Admin";
                header("location:".FRONT_ROOT."JobOffer/ShowListView");
            }
            else if($user != null){
                $userStudent = $this->userStudentDAO->SearchEmail($userEmail); 

                if($userStudent != null && $userStudent->getPassword() == $password){
                    // verifico si el usuario esta activo
                    if($user->getActive()){
                        $_SESSION["loggedUser"] = $user;
                        $_SESSION["loggedStudent"] = "student";
                        header("location:".FRONT_ROOT."JobOffer/ShowListView");
                    }else
                        $this->Index("Inactive user, please contact with the UTN.");
                }else{
                    $this->Index('Email or password are incorrect, please try again.');
                }
            }else if($userCompany != null && $userCompany->getPassword() == $password){
                $_SESSION["loggedUser"] = $userCompany;
                $_SESSION['loggedCompany'] = "UserCompany";
                header("location:".FRONT_ROOT."JobOffer/ShowMyOfferList");
            }else
                $this->Index("Incorrect username or password");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
}

?>