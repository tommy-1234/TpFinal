<?php

namespace DAO;

use DAO\ICompanyDAO as ICompanyDAO;
use Models\Company as Company;

    class CompanyDAO implements ICompanyDAO
    {
        private $companyList = array();
        private $fileName = ROOT."Data/Companies.json";

        function Add($company){



        }
        function Remove($idCompany){



        }
        function Update($idCompany, $newCompany){   //la idea es pasarle el id de la empresa original y el objeto "actualizado" para que lo reemplace en el json con un remove mas un add


            
        }   
        function GetOne($idCompany){



        }
        function GetAll(){



        }
    }


?>