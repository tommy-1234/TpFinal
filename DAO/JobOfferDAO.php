<?php

namespace DAO;

use DAO\Connection as Connection;
use DAO\IJobOfferDAO as IJobOfferDAO;
use Exception;
use Models\JobOffer as JobOffer;
use Models\JobPosition as JobPosition;
use Models\Company as Company;
use Models\Career as Career;

class JobOfferDAO implements IJobOfferDAO{

    private $tableName = "joboffer";
    private $connection;


    function Add($jobOffer){ 
  
        try{

            $query = "INSERT INTO ".$this->tableName."(companyId, jobPositionId, publicationDate, expirationDate, isRemote, projectDescription, hourlyLoad, jobOfferActive) VALUES (:companyId, :jobPositionId, :publicationDate, :expirationDate, :isRemote, :projectDescription, :hourlyLoad, :jobOfferActive) ";
            
            $parameters["companyId"] = $jobOffer->getCompany()->getIdCompany();
            $parameters["jobPositionId"] = $jobOffer->getJobPosition()->getJobPositionId();
            $parameters["publicationDate"] = $jobOffer->getPublicationDate();
            $parameters["expirationDate"] = $jobOffer->getExpirationDate();
            $parameters["isRemote"] = $jobOffer->getIsRemote();
            $parameters["projectDescription"] = $jobOffer->getProjectDescription();
            $parameters["hourlyLoad"] = $jobOffer->getHourlyLoad();
            $parameters["jobOfferActive"] = $jobOffer->getActive();
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){

            throw $ex;

        }
    }

    function GetAll($isAdmin){

        try{

            $JobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId";

            // para los usuarios comunes no se muestran los Job Offer inactivas o fuera de fecha
            if(!$isAdmin){
                $query = $query." where jobOfferActive=1 and curdate() BETWEEN publicationDate AND expirationDate and careerActive=1;";
            }
            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            
            
            foreach($resultSet as $row){

                $company = new Company;
                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);

                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);

                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);
                $jobPosition->setCareer($career);           



                $JobOffer = new JobOffer();

                $JobOffer->setJobOfferId($row["jobOfferId"]);
                $JobOffer->setCompany($company);
                $JobOffer->setJobPosition($jobPosition);
                $JobOffer->setPublicationDate($row["publicationDate"]);
                $JobOffer->setExpirationDate($row["expirationDate"]);
                $JobOffer->setIsRemote($row["isRemote"]);
                $JobOffer->setProjectDescription($row["projectDescription"]);
                $JobOffer->setHourlyLoad($row["hourlyLoad"]);
                $JobOffer->setActive($row["jobOfferActive"]);


                array_push($JobOfferList, $JobOffer);
            }
           
            return $JobOfferList;           
            
        }catch(Exception $ex){

            throw $ex;

        }
    }


    function GetById($jobOfferId){

        try{

            $JobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId where jobOfferId = :jobOfferId;";
            
            $parameters["jobOfferId"] =  $jobOfferId;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            
            $row = $resultSet[0];           /// PORQUE DEVUELVE UNO SOLO
            
        
            $company = new Company;
            $company->setIdCompany($row["companyId"]);
            $company->setCompanyName($row["companyName"]);

            $career = new Career;
            $career->setCareerId($row["careerId"]);
            $career->setDescription($row["careerDescription"]);
            $career->setActive($row["careerActive"]);

            $jobPosition = new JobPosition;
            $jobPosition->setJobPositionId($row["jobPositionId"]);
            $jobPosition->setDescription($row["jobPositionDescription"]);
            $jobPosition->setCareer($career);           


            $JobOffer = new JobOffer();

            $JobOffer->setJobOfferId($row["jobOfferId"]);
            $JobOffer->setCompany($company);
            $JobOffer->setJobPosition($jobPosition);
            $JobOffer->setPublicationDate($row["publicationDate"]);
            $JobOffer->setExpirationDate($row["expirationDate"]);
            $JobOffer->setIsRemote($row["isRemote"]);
            $JobOffer->setProjectDescription($row["projectDescription"]);
            $JobOffer->setHourlyLoad($row["hourlyLoad"]);
            $JobOffer->setActive($row["jobOfferActive"]);
           
            return $JobOffer;           
            
        }catch(Exception $ex){

            throw $ex;

        }
    }

    function GetAllByCompany($companyId){

        try{

            $JobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId where joboffer.companyId = :companyId;";
            
            $parameters["companyId"] =  $companyId;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query, $parameters);
            
            foreach($resultSet as $row){

                $company = new Company;
                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);

                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);

                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);
                $jobPosition->setCareer($career);           



                $JobOffer = new JobOffer();

                $JobOffer->setJobOfferId($row["jobOfferId"]);
                $JobOffer->setCompany($company);
                $JobOffer->setJobPosition($jobPosition);
                $JobOffer->setPublicationDate($row["publicationDate"]);
                $JobOffer->setExpirationDate($row["expirationDate"]);
                $JobOffer->setIsRemote($row["isRemote"]);
                $JobOffer->setProjectDescription($row["projectDescription"]);
                $JobOffer->setHourlyLoad($row["hourlyLoad"]);
                $JobOffer->setActive($row["jobOfferActive"]);


                array_push($JobOfferList, $JobOffer);
            }
           
            return $JobOfferList;           
            
        }catch(Exception $ex){

            throw $ex;

        }
    }

    function Remove($jobOfferId){  

        try{

            $query = "DELETE FROM ".$this->tableName." WHERE (jobOfferId = :jobOfferId)";

            $parameters["jobOfferId"] =  $jobOfferId;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        
        }catch(Exception $ex){

            throw $ex;

        }
    }

    function Update($jobOfferId, $jobOffer){ 
            
        try{
            
            $query = "UPDATE ".$this->tableName." SET companyId = :companyId, jobPositionId = :jobPositionId,  publicationDate = :publicationDate, expirationDate = :expirationDate, isRemote = :isRemote, projectDescription = :projectDescription, hourlyLoad= :hourlyLoad, jobOfferActive = :jobOfferActive where jobOfferId = ".$jobOfferId;

            $parameters["companyId"] = $jobOffer->getCompany()->getIdCompany();
            $parameters["jobPositionId"] = $jobOffer->getJobPosition()->getJobPositionId();
            $parameters["publicationDate"] = $jobOffer->getPublicationDate();
            $parameters["expirationDate"] = $jobOffer->getExpirationDate();
            $parameters["isRemote"] = $jobOffer->getIsRemote();
            $parameters["projectDescription"] = $jobOffer->getProjectDescription();
            $parameters["hourlyLoad"] = $jobOffer->getHourlyLoad();
            $parameters["jobOfferActive"] = $jobOffer->getActive();
            
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){

            throw $ex;

        }
    }


    function FilterOne($filter, $isAdmin){
        
        try{

            $jobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName. '  inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId  WHERE career.careerDescription LIKE "%'.$filter.'%"'; 

            // para los usuarios comunes no se muestran los Job Offer inactivas o fuera de fecha
            if(!$isAdmin){
                $query = $query." and jobOfferActive=1 and curdate() BETWEEN publicationDate AND expirationDate and careerActive=1;";
            }

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 

            foreach($resultSet as $row){
                $company = new Company;
                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);
    
                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);
    
                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);
                $jobPosition->setCareer($career);           
    
    
                $JobOffer = new JobOffer();
    
                $JobOffer->setJobOfferId($row["jobOfferId"]);
                $JobOffer->setCompany($company);
                $JobOffer->setJobPosition($jobPosition);
                $JobOffer->setPublicationDate($row["publicationDate"]);
                $JobOffer->setExpirationDate($row["expirationDate"]);
                $JobOffer->setIsRemote($row["isRemote"]);
                $JobOffer->setProjectDescription($row["projectDescription"]);
                $JobOffer->setHourlyLoad($row["hourlyLoad"]);
                $JobOffer->setActive($row["jobOfferActive"]);

                array_push($jobOfferList, $JobOffer);
            }

            return $jobOfferList;
    
        }catch(Exception $ex){
            throw $ex;
        }
    }

    function FilterTwo($filterCareer, $filterJobPosition, $isAdmin){
        try{

            $jobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName. '  inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId  WHERE career.careerDescription LIKE "%'.$filterCareer.'%" AND jobposition.jobPositionDescription LIKE "%'.$filterJobPosition.'%"'; 

            // para los usuarios comunes no se muestran los Job Offer inactivas o fuera de fecha
            if(!$isAdmin){
                $query = $query." and jobOfferActive=1 and curdate() BETWEEN publicationDate AND expirationDate and careerActive=1;";
            }

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query); 

            foreach($resultSet as $row){
                $company = new Company;
                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);
    
                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);
    
                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);
                $jobPosition->setCareer($career);           
    
    
                $JobOffer = new JobOffer();
    
                $JobOffer->setJobOfferId($row["jobOfferId"]);
                $JobOffer->setCompany($company);
                $JobOffer->setJobPosition($jobPosition);
                $JobOffer->setPublicationDate($row["publicationDate"]);
                $JobOffer->setExpirationDate($row["expirationDate"]);
                $JobOffer->setIsRemote($row["isRemote"]);
                $JobOffer->setProjectDescription($row["projectDescription"]);
                $JobOffer->setHourlyLoad($row["hourlyLoad"]);
                $JobOffer->setActive($row["jobOfferActive"]);

                array_push($jobOfferList, $JobOffer);
            }

            return $jobOfferList;

        }catch(Exception $ex){
            throw $ex;
        }
    }

}






?>