<?php

    namespace Controllers;

    use DAO\UserDAO as UserDAO;
use Exception;
use Models\User as User;
    use Models\Alert as Alert;

    class UserController
    {

        private $userDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        function ShowDetailView(){
            require_once(VIEWS_PATH."validate-session.php");
            $user=new User();
            $user = $_SESSION['loggedUser']; 
            require_once(VIEWS_PATH."user-detail.php");
        }

        function ShowListView(){
            require_once(VIEWS_PATH."validate-session.php");
            try{
                $alert = new Alert("", "");
                $studentList = $this->userDAO->GetAll();
            }catch(Exception $ex){
                $alert->setType ('danger');
                $alert->setMessage('Failed to load. Try later.');
            }finally{
                $_SESSION['alert'] = $alert;
                require_once(VIEWS_PATH."user-list.php");
            }   
        }
    }

?>