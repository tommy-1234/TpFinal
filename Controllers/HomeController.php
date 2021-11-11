<?php
    namespace Controllers;

use DAO\CompanyDAO;
use DAO\UserCompanyDAO as UserCompanyDAO;
use DAO\UserDAO as UserDAO;
use Models\JobOffer;
use Models\User as User;

    class HomeController
    {
        private $userDAO;
        private $userCompanyDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->userCompanyDAO = new UserCompanyDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        
        public function Login($userEmail)
        {
            $user = $this->userDAO->GetUserByEmail($userEmail);
            $userCompany = $this->userCompanyDAO->SearchEmail($userEmail);


            if($userEmail == "admin@admin.com")
            {
                $user = new User();
                $user->setFirstName("Admin");
                $user->setEmail("admin@admin.com");
                $_SESSION["loggedUser"] = $user;
                $_SESSION['loggedAdmin'] = "Admin";
                header("location:".FRONT_ROOT."JobOffer/ShowListView");
            }
            else if($user != null){
                // verifico si el usuario esta activo
                if($user->getActive()){
                    $_SESSION["loggedUser"] = $user;
                    header("location:".FRONT_ROOT."JobOffer/ShowListView");
                }else{
                    $this->Index('Inactive user, please contact with the UTN.');
                }
            }else if($userCompany != null){
                $_SESSION["loggedUser"] = $userCompany;
                header("location:".FRONT_ROOT."JobOffer/ShowListView");
            }else
                $this->Index("Incorrect username");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
}

?>