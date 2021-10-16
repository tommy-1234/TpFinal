<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class HomeController
    {
        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }  
        
        public function Login($userEmail)
        {
            $user = $this->userDAO->GetUserByEmail($userEmail);

            if($user != null)
            {
                $_SESSION["loggedUser"] = $user;
                $this->ShowListView();
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }

        public function ShowListView(){

            require_once(VIEWS_PATH."company-list.php");

        }
    }

?>