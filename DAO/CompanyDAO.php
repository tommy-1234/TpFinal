<?php

namespace DAO;

use DAO\Connection as Connection;
use DAO\ICompanyDAO as ICompanyDAO;
use Exception;
use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO{
        private $companyList = array();
        private $tableName = "companies";
        private $connection;

        function Add($company){  //Agrega una empresa
  
            try{

                $query = "INSERT INTO ".$this->tableName."(companyName, companyDescription, companyEmail, companyPhone, companyLinkedin, companyAddres, companyLink) VALUES (:companyName, :companyDescription, :companyEmail, :companyPhone, :companyLinkedin, :companyAddres, :companyLink)";
                
                $parameters["companyName"] = $company->getCompanyName();
                $parameters["companyDescription"] = $company->getCompanyDescription();
                $parameters["companyEmail"] = $company->getCompanyEmail();
                $parameters["companyPhone"] = $company->getCompanyPhone();
                $parameters["companyLinkedin"] = $company->getCompanyLinkedin();
                $parameters["companyAddres"] = $company->getCompanyAddress();
                $parameters["companyLink"] = $company->getCompanyLink();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){

                throw $ex;

            }
        }

        function Remove($idCompany){  //Elimina un empresa mediante si ID

            try{

                $query = "DELETE FROM ".$this->tableName." WHERE (companyId = :companyId)";

                $parameters["companyId"] =  $idCompany;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }catch(Exception $ex){

                throw $ex;

            }
        }
        
        function Update($idCompany, $newCompany){ 
            
            try{
                    
                $query = "UPDATE ".$this->tableName." SET companyName = :companyName, companyDescription = :companyDescription,  companyEmail = :companyEmail, companyPhone = :companyPhone, companyLinkedin = :companyLinkedin, companyAddres = :companyAddres, companyLink= :companyLink
                where companyId = ".$idCompany;

                $parameters["companyName"] = $newCompany->getCompanyName();
                $parameters["companyDescription"] = $newCompany->getCompanyDescription();
                $parameters["companyEmail"] = $newCompany->getCompanyEmail();
                $parameters["companyPhone"] = $newCompany->getCompanyPhone();
                $parameters["companyLinkedin"] = $newCompany->getCompanyLinkedin();
                $parameters["companyAddres"] = $newCompany->getCompanyAddress();
                $parameters["companyLink"] = $newCompany->getCompanyLink();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            }catch(Exception $ex){

                throw $ex;

            }
        }

        function SearchEmail($CompanyEmail){   //Busca y devuelve una empresa mediante su email

            try{

                $query = "SELECT * FROM ".$this->tableName. " WHERE companyEmail = :companyEmail";
                $parameters["companyEmail"] = $CompanyEmail;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);


                $company = new Company();

                if(isset ($resultSet[0])){

                    $row = $resultSet[0];
                    
                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]); 
                }
                return $company;          
                
            }catch(Exception $ex){

                throw $ex;

            }
        }

        function GetOne($idCompany){   //Busca y devuelve una empresa mediante su ID


            try{

                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName. " WHERE companyId = :companyId";
                $parameters["companyId"] = $idCompany;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                $row = $resultSet[0];

                $company = new Company();

                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);
                $company->setCompanyDescription($row["companyDescription"]);
                $company->setCompanyEmail($row["companyEmail"]);
                $company->setCompanyPhone($row["companyPhone"]);
                $company->setCompanyLinkedin($row["companyLinkedin"]);
                $company->setCompanyAddress($row["companyAddres"]);
                $company->setCompanyLink($row["companyLink"]);

                return $company;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        }
        
        function Filter($companyName){
            try{

                $parameters = array();
                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName. ' WHERE companyName LIKE "%'.$companyName.'%"';     //SI USO PARAMETROS ME DA ERROR


                //$parameters["companyName"] = $companyName;                //SI USO PARAMETROS ME DA ERROR
                
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);            //SI USO PARAMETROS ME DA ERROR
                
                
                foreach($resultSet as $row){
                    $company = new Company();

                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]);

                    array_push($companyList, $company);
                }
               
                return $companyList;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        }

        function GetAll(){    //Devuelve una lista con todas las empresas
            try{

                $companyList = array();

                $query = "SELECT * FROM ".$this->tableName;
                
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                
                
                foreach($resultSet as $row){
                    $company = new Company();

                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]);

                    array_push($companyList, $company);
                }
               
                return $companyList;           
                
            }catch(Exception $ex){

                throw $ex;

            }
        }
    }
?>