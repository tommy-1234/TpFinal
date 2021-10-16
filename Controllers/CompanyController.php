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
        require_once(VIEWS_PATH."company-add.php");
    }

    public function ShowListView(){
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

        $this->ShowListView();
    }

    public function Remove($idCompany){

        $this->companyDAO->Remove($idCompany);

        $this->ShowListView();
    }
}
?>