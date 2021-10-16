<?php

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();
        private $fileName = ROOT."Data/Companies.json";
        private $contId = 0; //Contador de ID, posible borrar con BASE DE DATOS

        function Add($company){  //Agrega una empresa

            $this->RetrieveData();
            $company->setIdCompany($this->contId+1);
            array_push($this->companyList, $company);
            $this->SaveData();
        }

        function Remove($idCompany){  //Elimina un empresa mediante si ID

            $this->RetrieveData();
            $newArray = array();

            foreach($this->companyList as $company){

                if($idCompany != $company->getIdCompany()){

                    array_push($newArray, $company);
                }
            }

            $this->companyList = $newArray;
            $this->SaveData();
        }
        function Update($idCompany, $newCompany){   //la idea es pasarle el id de la empresa original y el objeto "actualizado" para que lo reemplace en el json con un remove mas un add

            $this->Remove($idCompany);
            $this->Add($newCompany);
        }  

        function GetOne($idCompany){   //Busca y devuelve una empresa mediante su ID

            $this->RetrieveData();
            $searchCompany = null;

            foreach($this->companyList as $company){

                if($idCompany == $company->getIdCompany()){
                    
                    $searchCompany = $company;
                    break;
                }
            }

            return $searchCompany;
        }
        
        function GetAll(){    //Devuelve una lista con todas las empresas

            $this->RetrieveData();
            return $this->companyList;
        }

        private function SaveData(){  //guarda en un archivo todas las empresas enlistadas
            
            $arrayToEncode = array();

            foreach($this->companyList as $company){

                $valuesArray['idCompany'] = $company->getIdCompany();
                $valuesArray['companyName'] = $company->getCompanyName();
                $valuesArray['CompanyDescription'] = $company->getCompanyDescription();
                $valuesArray['companyEmail'] = $company->getCompanyEmail();
                $valuesArray['companyPhone'] = $company->getCompanyPhone();
                $valuesArray['companyLinkedin'] = $company->getCompanyLinkedin();
                $valuesArray['companyAddres'] = $company->getCompanyAddress();
                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData(){   //Lee el archivo y guarda en una lista todas las empresas

            if(file_exists($this->fileName)){

                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray){
                    $company = new Company();
                    $company->setIdCompany($valuesArray['idCompany']);
                    $this->contId = $valuesArray['idCompany'];
                    $company->setCompanyName($valuesArray['companyName']);
                    $company->setCompanyDescription($valuesArray['CompanyDescription']);
                    $company->setCompanyEmail($valuesArray['companyEmail']);
                    $company->setCompanyPhone($valuesArray['companyPhone']);
                    $company->setCompanyLinkedin($valuesArray['companyLinkedin']);
                    $company->setCompanyAddress($valuesArray['companyAddres']);
                    array_push($this->companyList, $company);
                }
            }
        }
    }
?>