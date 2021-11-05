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
        $JobOfferList = $this->JobOfferDAO->GetAll();
        require_once(VIEWS_PATH."joboffer-list.php");
    }

    public function ShowDetail($jobOfferId){
        require_once(VIEWS_PATH."validate-session.php");
    //  $JobOffer = $this->JobOfferDAO->GetById($jobOfferId);
        require_once(VIEWS_PATH."joboffer-detail.php");
    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."validate-session.php");
        $companyList = $this->companyDAO->GetAll();
        $JobPositionList = $this->JobPositionDAO->GetAll();
        require_once(VIEWS_PATH."joboffer-add.php");
    }

    public function Add($idCompany, $jobPositionId, $publicationDate, $expirationDate, $isRemote, $projectDescription, $hourlyLoad, $jobOfferActive){

        try{

            $alert = new Alert("", "");
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
            $alert->setMessage('Company added successfully.');

        } catch (Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to add the company. Try again.');
        }finally{
            $_SESSION['alert'] = $alert;
            $this->ShowAddView();   
        }

    }

}

?>