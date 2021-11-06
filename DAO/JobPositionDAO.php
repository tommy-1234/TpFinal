<?php

namespace DAO;

use DAO\Connection as Connection;
use DAO\IJobPositionDAO as IJobPositionDAO;
use Exception;
use Models\JobPosition as JobPosition;
use Models\Career as Career;

class JobPositionDAO implements IJobPositionDAO{

    private $tableName = "jobposition";
    private $connection;


    function GetAll(){

        try{

            $JobPositionList = array();

            $query = "SELECT * FROM ".$this->tableName." inner join career on jobposition.careerId = career.careerId;";
            
            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);
            
            
            foreach($resultSet as $row){

                $career = new Career;
                $career->setCareerId($row["careerId"]);
                $career->setDescription($row["careerDescription"]);
                $career->setActive($row["careerActive"]);

                $jobPosition = new JobPosition;
                $jobPosition->setJobPositionId($row["jobPositionId"]);
                $jobPosition->setDescription($row["jobPositionDescription"]);
                $jobPosition->setCareer($career);

                array_push($JobPositionList, $jobPosition);
            }
           
            return $JobPositionList;           
            
        }catch(Exception $ex){

            throw $ex;

        }
    }





}






?>