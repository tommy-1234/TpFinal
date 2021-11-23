<?php

namespace DAO;
use Models\UserCompany as UserCompany;
use DAO\Connection as Connection;
use Exception;
use Models\Company as Company;

    class UserCompanyDAO{

        private $tableName = "usercompanies";
        private $connection;

        function Add($UserCompany){  //Agrega un usuario de tipo company
  
            try{
                $query = "INSERT INTO ".$this->tableName."(userCompanyMail, userCompanyPassword, companyId) VALUES (:userCompanyMail,:userCompanyPassword, :companyId) ";
                
                $parameters["userCompanyMail"] = $UserCompany->getEmail();
                $parameters["userCompanyPassword"] = $UserCompany->getPassword();
                $parameters["companyId"] = $UserCompany->getCompany()->getIdCompany();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){

                throw $ex;

            }
        }

        function SearchEmail($UserCompanyMail){   //Busca y devuelve un usercompany mediante su email

            try{

                $query = "SELECT * FROM ".$this->tableName. " WHERE userCompanyMail = :userCompanyMail";
                $parameters["userCompanyMail"] = $UserCompanyMail;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                $UserCompany = null;


                if(isset ($resultSet[0])){

                    $UserCompany = new UserCompany();
                    $row = $resultSet[0];
                
                    $UserCompany->setEmail($row["userCompanyMail"]);
                    $UserCompany->setPassword($row["userCompanyPassword"]);

                    $company = new Company();
                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $UserCompany->setCompany($company);
                }
                return $UserCompany;          
                
            }catch(Exception $ex){
                throw $ex;
            }
        }

        function GetAll(){    //Devuelve una lista con todos los usuarios de tipo company
            try{

                $UserCompanyList = array();

                $query = "SELECT * FROM ".$this->tableName. " inner join companies on usercompanies.companyId = companies.companyId ";
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                
                foreach($resultSet as $row){
                    $UserCompany = new UserCompany();

                    $UserCompany->setEmail($row["userCompanyMail"]);
                    $UserCompany->setPassword($row["userCompanyPassword"]);

                    $company = new Company();
                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $UserCompany->setCompany($company);

                    array_push($UserCompanyList, $UserCompany);
                }
               
                return $UserCompanyList;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        } 
    }
?>