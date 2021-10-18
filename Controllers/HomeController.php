<?php
    namespace Controllers;

    use DAO\CompanyDAO as CompanyDAO;
    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        private $userDAO;
        private $companyDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->companyDAO = new CompanyDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        
        public function Login($userEmail)
        {
            $user = $this->userDAO->GetUserByEmail($userEmail);

            if($userEmail == "admin@admin.com")
            {
                $user = new User();
                $user->setFirstName("Admin");
                $user->setEmail("admin@admin.com");
                $_SESSION["loggedUser"] = $user;
                $_SESSION['loggedAdmin'] = "Admin";
                $this->ShowListView();
            }
            else if($user != null){
                $_SESSION["loggedUser"] = $user;
                $this->ShowListView();
            }else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }

        public function ShowListView(){
            require_once(VIEWS_PATH."validate-session.php");
            $companyList = $this->companyDAO->GetAll();
            require_once(VIEWS_PATH."company-list.php"); 

        }
    }

?>