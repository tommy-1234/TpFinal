<?php
namespace Controllers;

use DAO\JobOfferDAO as JobOfferDAO;
use Exception;
use Models\JobOffer as JobOffer;
use Models\Alert as Alert;

class JobOfferController {

    private $JobOfferDAO;

    public function __construct()
    {
        $this->JobOfferDAO = new JobOfferDAO();
    }

    public function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    public function ShowListView(){
        require_once(VIEWS_PATH."validate-session.php");
        $JobOfferList = $this->JobOfferDAO->GetAll();
        require_once(VIEWS_PATH."joboffer-list.php");
    }



}

?>