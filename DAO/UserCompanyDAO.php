<?php

namespace DAO;
use Models\UserCompany as UserCompany;
use DAO\Connection as Connection;
use Exception;
use Models\Company as Company;

    class UserCompanyDAO{
        private $UserCompanyList = array();
        private $tableName = "companies";
        private $connection;

        function Add($UserCompany){  //Agrega un usuario de tipo company
  
            try{
                $query = "INSERT INTO ".$this->tableName."(companyUserEmail, companyUserPassword) VALUES (:companyUserEmail,:companyUserPassword)";
                
                $parameters["companyUserEmail"] = $UserCompany->getEmail();
                $parameters["companyUserPassword"] = $UserCompany->getPassword();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){

                throw $ex;

            }
        }

        function GetAll(){    //Devuelve una lista con todos los usuarios de tipo company
            try{

                $UserCompanyList = array();

                $query = "SELECT * FROM ".$this->tableName;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                
                foreach($resultSet as $row){
                    $UserCompany = new UserCompany();

                    $UserCompany->setEmail($row["companyUserEmail"]);
                    $UserCompany->setPassword($row["companyUserPassword"]);

                    array_push($UserCompanyList, $UserCompany);
                }
               
                return $UserCompanyList;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        }

        

    }
?>