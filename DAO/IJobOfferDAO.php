<?php

namespace DAO;

use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        function Add(JobOffer $jobOffer);
        function GetAll();
        function GetById($jobOfferId);
        function Remove($jobOfferId);
        function Update($jobOfferId, $JobOffer);
    }


?>