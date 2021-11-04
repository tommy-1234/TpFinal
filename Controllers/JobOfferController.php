<?php
namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use DAO\CompanyDAO as CompanyDAO;
use Exception;
use Models\JobOffer as JobOffer;
use Models\Alert as Alert;

class JobOfferController {

    private $JobOfferDAO;

    public function __construct()
    {
        $this->JobOfferDAO = new JobOfferDAO();
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
    //  $JobPositionList = $this->JobPositionDAO->GetAll();
        require_once(VIEWS_PATH."joboffer-add.php");
    }

}

?>