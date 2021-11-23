<?php

namespace DAO;
use Models\UserStudent as UserStudent;
use DAO\Connection as Connection;
use Exception;
use Models\User as User;

    class UserStudentDAO{

        private $tableName = "userstudents";
        private $connection;

        function Add($UserStudent){  //Agrega un usuario de tipo user
  
            try{
                $query = "INSERT INTO ".$this->tableName."(userStudentMail, userStudentPassword, studentId) VALUES (:userStudentMail,:userStudentPassword, :studentId) ";
                
                $parameters["userStudentMail"] = $UserStudent->getEmail();
                $parameters["userStudentPassword"] = $UserStudent->getPassword();
                $parameters["studentId"] = $UserStudent->getUser()->getStudentId();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){

                throw $ex;

            }
        }

        function SearchEmail($UserStudentMail){   //Busca y devuelve un userstudent mediante su email

            try{

                $query = "SELECT * FROM ".$this->tableName. " WHERE userStudentMail = :userStudentMail";
                $parameters["userStudentMail"] = $UserStudentMail;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                $UserStudent = null;


                if(isset ($resultSet[0])){

                    $UserStudent = new UserStudent();
                    $row = $resultSet[0];
                
                    $UserStudent->setEmail($row["userStudentMail"]);
                    $UserStudent->setPassword($row["userStudentPassword"]);

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
                    $UserStudent->setUser($user);
                }
                return $UserStudent;          
                
            }catch(Exception $ex){
                throw $ex;
            }
        }

        function GetAll(){    //Devuelve una lista con todos los usuarios de tipo user
            try{

                $UserStudentList = array();

                $query = "SELECT * FROM ".$this->tableName. " inner join students on userstudents.studentId = students.studentId ";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                
                foreach($resultSet as $row){
                    $UserStudent = new UserStudent();

                    $UserStudent->setEmail($row["userStudentMail"]);
                    $UserStudent->setPassword($row["userStudentPassword"]);

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
                    $UserStudent->setUser($user);

                    array_push($UserStudentList, $UserStudent);
                }
               
                return $UserStudentList;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        } 

    }
?>