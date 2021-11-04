<?php

namespace DAO;

use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        //function Add(JobOffer $jobOffer);
        //function Remove($idJobOffer);
        //function Update($idJobOffer, JobOffer $newJobOffer);   //la idea es pasarle el id de la empresa original y el objeto "actualizado" para que lo reemplace en el json con un remove mas un add
        //function GetOne($idJobOffer);
        function GetAll();
    }


?>