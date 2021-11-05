<?php

namespace DAO;

use DAO\Connection as Connection;
use DAO\IJobOfferDAO as IJobOfferDAO;
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

    function GetAll(){

        try{

            $JobOfferList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join companies on joboffer.companyId = companies.companyId inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId inner join career on jobposition.careerId = career.careerId;";
            
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





}






?>