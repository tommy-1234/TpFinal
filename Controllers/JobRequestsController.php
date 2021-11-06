<?php

namespace Controllers;

use Exception;
use DAO\JobRequestsDAO as JobRequestsDAO;
use Models\JobRequests as JobRequests;
use Models\Alert as Alert;

class JobRequestsController {

    private $JobRequestsDAO;

    function __construct()
    {
        $this->JobRequestsDAO = new JobRequestsDAO();
    }

    function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    function Add($jobOfferId){

        try{

            $alert = new Alert("", "");


            $alert->setType ('success');
            $alert->setMessage('You have successfully applied for a job.');

        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to applied to the job offer. Try again.');
        }finally{
            $_SESSION['alert'] = $alert;
        }
    }
}
?>