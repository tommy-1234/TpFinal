<?php

namespace DAO;

use Models\User as User;

    interface IUserDAO
    {
        function GetUserByEmail($userEmail);
        function Add(User $user);
    }


?>