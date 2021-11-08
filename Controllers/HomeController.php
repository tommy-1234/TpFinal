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
                $_SESSION["loggedUser"] = $user;

                header("location:".FRONT_ROOT."JobOffer/ShowListView");
            }else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }
        
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
}

?>