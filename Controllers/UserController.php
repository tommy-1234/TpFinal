<?php
    namespace Controllers;

    use Models\User as User;

    class UserController
    {
        function ShowDetailView(){
            require_once(VIEWS_PATH."validate-session.php");
            $user=new User();
            $user = $_SESSION['loggedUser']; 
            require_once(VIEWS_PATH."user-detail.php");
        }
    }




?>