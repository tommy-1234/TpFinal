<?php
namespace Controllers;

use DAO\CompanyDAO as CompanyDAO;
use DAO\UserCompanyDAO as userCompanyDAO;
use Exception;
use Models\Company as Company;
use Models\Alert as Alert;
use Models\UserCompany as UserCompany;

class CompanyController {

    private $companyDAO;
    private $userCompanyDAO;

    public function __construct(){
        $this->companyDAO = new CompanyDAO();
        $this->userCompanyDAO = new ;
    }

    public function Index(){
        require_once(VIEWS_PATH."home.php");
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

    function ShowRegisterView(){
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH."userCompany-add.php");
    }
    ///terminar esta funcion
    function CheckMail($email){    
        $alert = new Alert("", "");

        if($this->VerifyEmail($email)){

            try{
                $company = $this->companyDAO->SearchEmail($email);
                if($email == $company->getCompanyEmail()){
                  //registrar usuario en base de datos y anexar el ID
                }else{
                    $alert->setType ('danger');
                    $alert->setMessage('The company was not found. Talk with the admin.');
                }   
            }catch(Exception $ex){
                $alert->setType ('danger');
                $alert->setMessage('ERROR 405.'); 
            }finally{
                $_SESSION['alert'] = $alert;
                $this->Index();  
            }

            
        }else{
            /// El mail ya se encuentra registrado
        }
            
    }

    public function Add($companyName, $companyDescription, $companyEmail, $companyPhone, $companyLinkedin, $companyAddress, $companyLink){

        try{

            $alert = new Alert("", "");
            $checkName = $this->companyDAO->GetAll();
            foreach($checkName as $name){
                if(strcasecmp($name->getCompanyName(), $companyName) == 0){
                    throw new Exception();
                }
            }
            $company = new Company();
            $company->setCompanyName($companyName);
            $company->setCompanyDescription($companyDescription);
            $company->setCompanyEmail($companyEmail);
            $company->setCompanyPhone($companyPhone);
            $company->setCompanyLinkedin($companyLinkedin);
            $company->setCompanyAddress($companyAddress);
            $company->setCompanyLink($companyLink);

            $this->companyDAO->Add($company);

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

    public function Update($companyName=null, $companyDescription=null, $companyEmail=null, $companyPhone=null, $companyLinkedin=null, $companyAddress=null, $companyLink=null){
        
        $alert = new Alert("", "");

        try{
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
            if($companyLink!=null){
                $company->setCompanyLink($companyLink);
            }

            $this->companyDAO->Update($company->getIdCompany(), $company);
            $alert->setType ('success');
            $alert->setMessage('Company update successfully.');            
        
        } catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to update the company. Try again.'); 
        } finally{
            $_SESSION['alert'] = $alert;
            $this->ShowListView();  
        }   
    }

    public function Remove($idCompany){
        $alert = new Alert("", "");

        try{
            $this->companyDAO->Remove($idCompany);

            $alert->setType ('success');
            $alert->setMessage('Company remove successfully.'); 
        } catch (Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to remove the company. Try again.'); 
        } finally{
            $_SESSION['alert'] = $alert;
             $this->ShowListView();
        }
    }

    public function Filter($filterCompany){
        $companyList = $this->companyDAO->Filter($filterCompany);

        require_once(VIEWS_PATH."company-list.php");
    }

    //Verifica si el email de la compañia ya esta registrado
    function VerifyEmail($user){

        $userCompanyList = $this->userCompanyDAO->GetAll();
        $state = true;

        foreach($userCompanyList as $userCompany){
            if(strcmp($email, $userCompany->getEmail()) == 0){
                $state = false;
            }
        }
        return $state;
    }
}
?>