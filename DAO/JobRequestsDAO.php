<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\IJobRequestsDAO as IJobRequests;
use Exception;
use Models\Company as Company;
use Models\JobOffer as JobOffer;
use Models\JobRequests as JobRequests;
use Models\JobPosition as JobPosition;
use Models\Career as Career;
use Models\User as User;

class JobRequestsDAO implements IJobRequests
{
    private $tableName = "jobrequests";
    private $connection;

    function Add($jobOffer)
    {
        try{

            $query = "INSERT INTO ".$this->tableName."(jobOfferId, studentId, postulationDate, jobrequestActive) VALUES (:jobOfferId, :studentId, :postulationDate, :jobrequestActive)";

            $parameters["jobOfferId"] = $jobOffer->getJobOffer()->getJobOfferId();
            $parameters["studentId"] = $jobOffer->getStudenId()->getStudentId();
            $parameters["postulationDate"] = $jobOffer->getPostulationDate();
            $parameters["jobrequestActive"] = $jobOffer->getJobRequestsActive();

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);

        }catch(Exception $ex){
            throw $ex;
        }
    }

    function GetAll()
    {
        try{

            $JobRequestsList = array();

            $query = "SELECT * FROM ".$this->tableName ." inner join joboffer on jobrequests.jobOfferId = joboffer.jobOfferId 
            inner join companies on joboffer.companyId = companies.companyId
            inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId
            inner join career on jobposition.careerId = career.careerId
            inner join students on jobrequests.studentId = students.studentId";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row){
                $JobRequests = new JobRequests();

                $JobRequests->setJobRequestsId($row["jobRequestId"]);

                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($row["jobOfferId"]);
               
                $company = new Company();
                $company->setIdCompany($row["companyId"]);
                $company->setCompanyName($row["companyName"]);
                $company->setCompanyDescription($row["companyDescription"]);
                $company->setCompanyEmail($row["companyEmail"]);
                $company->setCompanyPhone($row["companyPhone"]);
                $company->setCompanyLinkedin($row["companyLinkedin"]);
                $company->setCompanyAddress($row["companyAddres"]);
                $company->setCompanyLink($row["companyLink"]);
                $jobOffer->setCompany($company);

                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);

                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);
                $jobPosition->setCareer($career);

                $jobOffer->setJobPosition($jobPosition);
                $jobOffer->setPublicationDate($row["publicationDate"]);
                $jobOffer->setExpirationDate($row["expirationDate"]);
                $jobOffer->setIsRemote($row["isRemote"]);
                $jobOffer->setProjectDescription($row["projectDescription"]);
                $jobOffer->setHourlyLoad($row["hourlyLoad"]);
                $jobOffer->setActive($row["jobOfferActive"]);

                $JobRequests->setJobOffer($jobOffer);

                $student= new User();
                $student->setStudentId($row["studentId"]);
                $student->setCareerId($row["careerId"]);
                $student->setFirstName($row["firstName"]);
                $student->setLastName($row["lastName"]);
                $student->setDni($row["dni"]);
                $student->setFileNumber($row["fileNumber"]);
                $student->setGender($row["gender"]);
                $student->setBirthDate($row["birthDate"]);
                $student->setEmail($row["email"]);
                $student->setPhoneNumber($row["phoneNumber"]);
                $student->setActive($row["studentActive"]);
                $JobRequests->setStudenId($student);
                
                $JobRequests->setPostulationDate($row["postulationDate"]);
                $JobRequests->setJobRequestsActive($row["jobrequestActive"]);

                array_push($JobRequestsList, $JobRequests);

            }

            return $JobRequestsList;

        }catch(Exception $ex){
            throw $ex;
        }
    }

    function SearchByStudenId($studentId){
        try{
            
            $JobRequestsList = array();

            $query = "SELECT * FROM ".$this->tableName ." inner join joboffer on jobrequests.jobOfferId = joboffer.jobOfferId 
            inner join companies on joboffer.companyId = companies.companyId
            inner join jobposition on joboffer.jobPositionId = jobposition.jobPositionId
            inner join career on jobposition.careerId = career.careerId
            inner join students on jobrequests.studentId = students.studentId";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row){

                if($studentId == $row["studentId"]){
                    $JobRequests = new JobRequests();

                    $JobRequests->setJobRequestsId($row["jobRequestId"]);

                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($row["jobOfferId"]);
                
                    $company = new Company();
                    $company->setIdCompany($row["companyId"]);
                    $company->setCompanyName($row["companyName"]);
                    $company->setCompanyDescription($row["companyDescription"]);
                    $company->setCompanyEmail($row["companyEmail"]);
                    $company->setCompanyPhone($row["companyPhone"]);
                    $company->setCompanyLinkedin($row["companyLinkedin"]);
                    $company->setCompanyAddress($row["companyAddres"]);
                    $company->setCompanyLink($row["companyLink"]);
                    $jobOffer->setCompany($company);

                    $jobPosition = new JobPosition;
                    $jobPosition->setJobPositionId($row["jobPositionId"]);
                    $jobPosition->setDescription($row["jobPositionDescription"]);

                    $career = new Career;
                    $career->setCareerId($row["careerId"]);
                    $career->setDescription($row["careerDescription"]);
                    $career->setActive($row["careerActive"]);
                    $jobPosition->setCareer($career);

                    $jobOffer->setJobPosition($jobPosition);
                    $jobOffer->setPublicationDate($row["publicationDate"]);
                    $jobOffer->setExpirationDate($row["expirationDate"]);
                    $jobOffer->setIsRemote($row["isRemote"]);
                    $jobOffer->setProjectDescription($row["projectDescription"]);
                    $jobOffer->setHourlyLoad($row["hourlyLoad"]);
                    $jobOffer->setActive($row["jobOfferActive"]);

                    $JobRequests->setJobOffer($jobOffer);

                    $student= new User();
                    $student->setStudentId($row["studentId"]);
                    $student->setCareerId($row["careerId"]);
                    $student->setFirstName($row["firstName"]);
                    $student->setLastName($row["lastName"]);
                    $student->setDni($row["dni"]);
                    $student->setFileNumber($row["fileNumber"]);
                    $student->setGender($row["gender"]);
                    $student->setBirthDate($row["birthDate"]);
                    $student->setEmail($row["email"]);
                    $student->setPhoneNumber($row["phoneNumber"]);
                    $student->setActive($row["studentActive"]);
                    $JobRequests->setStudenId($student);

                    $JobRequests->setPostulationDate($row["postulationDate"]);
                    $JobRequests->setJobRequestsActive($row["jobrequestActive"]);

                    array_push($JobRequestsList, $JobRequests);
                }
                
            }
            return $JobRequestsList;
        }catch(Exception $ex){
            throw $ex;
        }
    }
}
?>