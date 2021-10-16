<?php

namespace DAO;

    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $apiUrl = "https://utn-students-api.herokuapp.com/api/Student";
        private $apiKey = "4f3bceed-50ba-4461-a910-518598664c08";

        public function GetUserByEmail($userEmail)
        {
            $user = null;

            $this->RetrieveData();

            $users = array_filter($this->userList, function($user) use($userEmail){
                return $user->getEmail() == $userEmail;
            });

            $users = array_values($users); //Reordering array indexes

            return (count($users) > 0) ? $users[0] : null;
        }

        private function RetrieveData()
        {
            $this->userList = array();
			 
			// --- uso la API para cargar el userList ---
			$options = array(
                'http' => array(
                    'method' => "GET",
                    'header' => "x-api-key: ".$this->apiKey
                )
			);
            $context  = stream_context_create($options);
            $response = file_get_contents($this->apiUrl, false, $context);
			 
            $contentArray = json_decode($response, true);
                 
            foreach($contentArray as $content)
            {
                $user = new User();
                                
                $user->setStudentId($content["studentId"]);
                $user->setCareerId($content["careerId"]);
                $user->setFirstName($content["firstName"]);
                $user->setLastName($content["lastName"]);
                $user->setDni($content["dni"]);
                $user->setFileNumber($content["fileNumber"]);
                $user->setGender($content["gender"]);
                $user->setBirthDate($content["birthDate"]);
                $user->setEmail($content["email"]);
                $user->setPhoneNumber($content["phoneNumber"]);
                $user->setActive($content["active"]);

                array_push($this->userList, $user);
            }
        }  
    }
?>