<?php
namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use Models\Company as Company;

class CompanyController {

    private $companyDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
    }

    public function Index(){

    }

    public function ShowAddView(){
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."company-add.php");
    }

    public function ShowListView(){
        require_once(VIEWS_PATH."validate-session.php");
        $companyList = $this->companyDAO->GetAll();
        require_once(VIEWS_PATH."company-list.php");
    }

    public function Add($companyName, $companyDescription, $companyEmail, $companyPhone, $companyLinkedin, $companyAddress){

        $company = new Company();
        $company->setCompanyName($companyName);
        $company->setCompanyDescription($companyDescription);
        $company->setCompanyEmail($companyEmail);
        $company->setCompanyPhone($companyPhone);
        $company->setCompanyLinkedin($companyLinkedin);
        $company->setCompanyAddress($companyAddress);

        $this->companyDAO->Add($company);

        $this->ShowAddView();
    }

    public function Detaile($idCompany){
        require_once(VIEWS_PATH."validate-session.php");
        $company = $this->companyDAO->GetOne($idCompany);
        require_once(VIEWS_PATH."company-detail.php");
    }

    public function ShowUpdate($idCompany){
        require_once(VIEWS_PATH."validate-session.php");
        $company = $this->companyDAO->GetOne($idCompany);
        $_SESSION['company'] = $company;
        require_once(VIEWS_PATH."company-update.php");
    }

    public function Update($companyName=null, $companyDescription=null, $companyEmail=null, $companyPhone=null, $companyLinkedin=null, $companyAddress=null){
        
        $company = new Company();
        $company =  $_SESSION['company'];
        
        if($companyName!=null){
            $company->setCompanyName($companyName);
        }
        if($companyDescription!=null){
            $company->setCompanyDescription($companyDescription);
        }
        if($companyEmail!=null){
            $company->setCompanyEmail($companyEmail);
        }
        if($companyPhone!=null){
            $company->setCompanyPhone($companyPhone);
        }
        if($companyLinkedin!=null){
            $company->setCompanyLinkedin($companyLinkedin);
        }
        if($companyAddress != null){
           $company->setCompanyAddress($companyAddress); 
        } 

        $this->companyDAO->Update($company->getIdCompany(), $company);

        $this->ShowListView();
    }

    public function Remove($idCompany){

        $this->companyDAO->Remove($idCompany);
        $this->ShowListView();
    }
}
?>