<?php
namespace DAO;

use DAO\Connection as Connection;
use DAO\IJobRequestsDAO as IJobRequests;
use Exception;
use Models\JobOffer;
use Models\JobRequests as JobRequests;

class JobRequestsDAO implements IJobRequests
{
    private $tableName = "jobrequests";
    private $connection;

    function Add($jobOffer)
    {
        try{

            $query = "INSERT INTO ".$this->tableName."(jobOfferId, studentId, postulationDate, jobrequestActive) VALUES (:jobOfferId, :studentId, :postulationDate, :jobrequestActive)";

            $parameters["jobOfferId"] = $jobOffer->getJobOffer();
            $parameters["studentId"] = $jobOffer->getStudenId();
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

            $query = "SELECT * FROM ".$this->tableName;

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row){
                $JobRequests = new JobRequests();

                $JobRequests->setJobRequestsId($row["jobRequestId"]);
                $JobRequests->setJobOffer($row["jobOfferId"]);
                $JobRequests->setStudenId($row["studentId"]);
                $JobRequests->setPostulationDate($row["postulationDate"]);
                $JobRequests->setJobRequestsActive($row["jobrequestActive"]);

            }

        }catch(Exception $ex){
            throw $ex;
        }
    }
}
?>