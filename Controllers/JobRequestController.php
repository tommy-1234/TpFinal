<?php

namespace Controllers;

use Exception;
use DAO\JobRequestsDAO as JobRequestsDAO;
use Models\JobRequests as JobRequests;
use Models\Alert as Alert;
use Models\JobOffer;

class JobRequestController {

    private $JobRequestsDAO;
    

    function __construct()
    {
        $this->JobRequestsDAO = new JobRequestsDAO();
    }

    function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    function ShowListView(){
        require_once(VIEWS_PATH."validate-session.php");
        try{
            $alert = new Alert("", "");
            $jobRequestList = $this->JobRequestsDAO->GetAll();
        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to load. Try later.');
        }finally{
            $_SESSION['alert'] = $alert;
            require_once(VIEWS_PATH."jobRequest-list.php");
        }
    }

    function Add($jobOfferId){

        try{

            $flag =0;
            $alert = new Alert("", "");

            if($this->Verify($_SESSION["loggedUser"])){

                $jobRequests = new JobRequests();

                $jobOffer = new JobOffer();
                $jobOffer->setJobOfferId($jobOfferId);

                $jobRequests->setJobOffer($jobOffer);
                $jobRequests->setStudenId($_SESSION["loggedUser"]);

                $jobRequests->setPostulationDate(date("Y-m-d"));
                $jobRequests->setJobRequestsActive("1");
                
                $this->JobRequestsDAO->Add($jobRequests);

                $alert->setType ('success');
                $alert->setMessage('You have successfully applied for a job.');
                
            }else{
                $alert->setType ('danger');
                $alert->setMessage('You are already applied for a job');
            }
        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to applied to the job offer. Try again.');
        }finally{
            $_SESSION['alert'] = $alert;
            header("location:".FRONT_ROOT."JobOffer/ShowListView");
        }
    }

    function Verify($user){

        $jobRequestsList = $this->JobRequestsDAO->GetAll();
        $state = true;

        foreach($jobRequestsList as $jobRequests){
            if($jobRequests->getStudenId()->getStudentId() == $user->getStudentId()){
                $state = false;
            }
        }
        return $state;
    }

    function Proposals(){
        require_once(VIEWS_PATH."validate-session.php");
        try{
            $alert = new Alert("", "");
            $student = $_SESSION["loggedUser"];
            $jobRequestList = $this->JobRequestsDAO->SearchByStudenId($student->getStudentId());
        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to load. Try later.');
        }finally{
            $_SESSION['alert'] = $alert;
            require_once(VIEWS_PATH."proposals-list.php");
        }
    }
}
?>