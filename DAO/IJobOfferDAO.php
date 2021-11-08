<?php

namespace DAO;

use Models\JobOffer as JobOffer;

    interface IJobOfferDAO
    {
        function Add(JobOffer $jobOffer);
        function GetAll($isAdmin);
        function GetById($jobOfferId);
        function Remove($jobOfferId);
        function Update($jobOfferId, $JobOffer);
        function FilterOne($filter, $isAdmin);
        function FilterTwo($filterCareer, $filterJobPosition, $isAdmin);
    }


?>