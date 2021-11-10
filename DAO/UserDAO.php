<?php

namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;

    class UserDAO implements IUserDAO
    {
        private $userList = array();
        private $apiUrl = "https://utn-students-api.herokuapp.com/api/Student";
        private $apiKey = "4f3bceed-50ba-4461-a910-518598664c08";
        private $tableName = "students";
        private $connection;

        public function GetUserByEmail($userEmail)
        {
            $user = null;

            $this->userList = $this->GetAll();

            $users = array_filter($this->userList, function($user) use($userEmail){
                return $user->getEmail() == $userEmail;
            });

            $user = array_shift($users);

            if($user == null){
                $this->RetrieveData();

                $users = array_filter($this->userList, function($user) use($userEmail){
                    return $user->getEmail() == $userEmail;
                });
               
                $user = array_shift($users);
               
                if($user != null){  
                    $this->Add($user);
                }
            }

            return $user;
        }


        public function Add(User $user)
        {
            try{

                $query = "INSERT INTO ".$this->tableName."(studentId, careerId, firstName, lastName, dni, fileNumber, gender, birthDate, email, phoneNumber, studentActive) VALUES (:studentId, :careerId, :firstName, :lastName, :dni, :fileNumber, :gender, :birthDate, :email, :phoneNumber, :studentActive)";

                $parameters["studentId"] = $user->getStudentId();
                $parameters["careerId"] = $user->getCareerId();
                $parameters["firstName"] = $user->getFirstName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["dni"] = $user->getDni();
                $parameters["fileNumber"] = $user->getFileNumber();
                $parameters["gender"] = $user->getGender();
                $parameters["birthDate"] = $user->getBirthDate();
                $parameters["email"] = $user->getEmail();
                $parameters["phoneNumber"] = $user->getPhoneNumber();
                $parameters["studentActive"] = $user->getActive();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){

            try{

                $userList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach($resultSet as $row){
                    $user = new User();

                    $user->setStudentId($row["studentId"]);
                    $user->setCareerId($row["careerId"]);
                    $user->setFirstName($row["firstName"]);
                    $user->setLastName($row["lastName"]);
                    $user->setDni($row["dni"]);
                    $user->setFileNumber($row["fileNumber"]);
                    $user->setGender($row["gender"]);
                    $user->setBirthDate($row["birthDate"]);
                    $user->setEmail($row["email"]);
                    $user->setPhoneNumber($row["phoneNumber"]);
                    $user->setActive($row["studentActive"]);
                    
                    array_push($userList, $user);
                }

                return $userList;

            }catch(Exception $ex){
                throw $ex;
            }
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