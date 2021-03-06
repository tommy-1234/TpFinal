<?php
namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\CompanyDAO as CompanyDAO;
use Exception;
use Models\JobOffer as JobOffer;
use Models\JobPosition as JobPosition;
use Models\Company as Company;
use Models\Alert as Alert;


class JobOfferController {

    private $JobOfferDAO;
    private $JobPositionDAO;
    private $companyDAO;

    public function __construct()
    {
        $this->JobOfferDAO = new JobOfferDAO();
        $this->JobPositionDAO = new JobPositionDAO();
        $this->companyDAO = new CompanyDAO();
    }

    public function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    public function ShowListView(){
        require_once(VIEWS_PATH."validate-session.php");
        $JobOfferList = $this->JobOfferDAO->GetAll( isset($_SESSION['loggedAdmin']) );
        require_once(VIEWS_PATH."joboffer-list.php");
    }

    function ShowMyOfferList(){
        require_once(VIEWS_PATH."validate-session.php");
        $userCompany = $_SESSION["loggedUser"];
        $JobOfferList = $this->JobOfferDAO->GetAllByCompany($userCompany->getCompany()->getIdCompany());
        require_once(VIEWS_PATH."joboffer-list.php");
    }

    public function ShowDetail($jobOfferId){
        require_once(VIEWS_PATH."validate-session.php");
        $JobOffer = $this->JobOfferDAO->GetById($jobOfferId);
        require_once(VIEWS_PATH."joboffer-detail.php");
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."validate-session.php");
        $companyList = $this->companyDAO->GetAll();
        $JobPositionList = $this->JobPositionDAO->GetAll();
        require_once(VIEWS_PATH."joboffer-add.php");
    }

    public function ShowUpdate($jobOfferId){
        require_once(VIEWS_PATH."validate-session.php");
        $companyList = $this->companyDAO->GetAll();
        $JobPositionList = $this->JobPositionDAO->GetAll();
        $JobOffer = $this->JobOfferDAO->GetById($jobOfferId);
        $_SESSION['jobOfferId'] = $JobOffer->getJobOfferId();       // Lo guardo porque el formulario de joboffer-update no me lo devuelve
        require_once(VIEWS_PATH."joboffer-update.php");
    }

    public function Add($idCompany, $jobPositionId, $publicationDate, $expirationDate, $isRemote, $projectDescription, $hourlyLoad, $jobOfferActive){
        
        $alert = new Alert("", "");
        
            
        if($publicationDate >= $expirationDate){
            $alert->setType ('danger');
            $alert->setMessage('The expiration date must be greater than the publication date. Try again.');

            $_SESSION['alert'] = $alert;
            $this->ShowAddView();  
            
        }elseif($hourlyLoad > 24){
            $alert->setType ('danger');
            $alert->setMessage('The hourly load cannot be more than 24 hours. Try again.');

            $_SESSION['alert'] = $alert;
            $this->ShowAddView(); 
            
        }else{

            try{

                $jobOffer = new JobOffer();
                $company = new Company();
                $jobPosition = new JobPosition();

                $jobPosition->setJobPositionId($jobPositionId);

                $company->setIdCompany($idCompany);

                $jobOffer->setCompany($company);
                $jobOffer->setJobPosition($jobPosition);            
                $jobOffer->setPublicationDate($publicationDate);
                $jobOffer->setExpirationDate($expirationDate);
                $jobOffer->setIsRemote($isRemote);
                $jobOffer->setProjectDescription($projectDescription);
                $jobOffer->setHourlyLoad($hourlyLoad);
                $jobOffer->setActive($jobOfferActive);

                $this->JobOfferDAO->Add($jobOffer);

                $alert->setType ('success');
                $alert->setMessage('Job Offer added successfully.');

            } catch (Exception $ex){
                $alert->setType ('danger');
                $alert->setMessage('Failed to add the job offer. Try again.');
            }finally{
                $_SESSION['alert'] = $alert;
                $this->ShowAddView();   
            }
        }

    }

    public function Remove($jobOfferId){

        $alert = new Alert("", "");

        try{
            $this->JobOfferDAO->Remove($jobOfferId);

            $alert->setType ('success');
            $alert->setMessage('Job Offer removed successfully.'); 
        } catch (Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to removed the Job Offer. Try again.'); 
        } finally{
            $_SESSION['alert'] = $alert;
             $this->ShowListView();
        }
    }

    public function Update($idCompany, $jobPositionId, $publicationDate, $expirationDate, $isRemote, $projectDescription, $hourlyLoad, $jobOfferActive){

        try{

            $alert = new Alert("", "");

            $jobOfferId =  $_SESSION['jobOfferId'];     //Lo recupero porque el formulario de joboffer-update no me lo devuelve

            $jobOffer = new JobOffer();
            $company = new Company();
            $jobPosition = new JobPosition();

            $jobPosition->setJobPositionId($jobPositionId);

            $company->setIdCompany($idCompany);

            $jobOffer->setCompany($company);
            $jobOffer->setJobPosition($jobPosition);            
            $jobOffer->setPublicationDate($publicationDate);
            $jobOffer->setExpirationDate($expirationDate);
            $jobOffer->setIsRemote($isRemote);
            $jobOffer->setProjectDescription($projectDescription);
            $jobOffer->setHourlyLoad($hourlyLoad);
            $jobOffer->setActive($jobOfferActive);

            $this->JobOfferDAO->Update($jobOfferId, $jobOffer);

            $alert->setType ('success');
            $alert->setMessage('Job offer updated successfully.');

        } catch (Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to update the job offer. Try again.');
        }finally{
            $_SESSION['alert'] = $alert;
            $this->ShowListView();   
        }

    }

    function Filter($filterCareer=null, $filterJobPosition=null){

        if($filterCareer != "null" && $filterJobPosition != "null"){
            $JobOfferList = $this->JobOfferDAO->FilterTwo($filterCareer, $filterJobPosition, isset($_SESSION['loggedAdmin']));
        }else if($filterCareer != "null"){
            $JobOfferList = $this->JobOfferDAO->FilterOne($filterCareer, isset($_SESSION['loggedAdmin']));
        }else {
            $JobOfferList = $this->JobOfferDAO->FilterOne($filterJobPosition, isset($_SESSION['loggedAdmin']));
        }

        require_once(VIEWS_PATH."joboffer-list.php");
    }
}

?>