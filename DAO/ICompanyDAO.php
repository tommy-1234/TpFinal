<?php

namespace DAO;

use Models\Company as Company;

    interface ICompanyDAO
    {
        function Add(Company $company);
        function Remove($idCompany);
        function Update($idCompany, Company $newCompany);   //la idea es pasarle el id de la empresa original y el objeto "actualizado" para que lo reemplace en el json con un remove mas un add
        function GetOne($idCompany);
        function GetAll();
    }


?>