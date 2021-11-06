<?php
namespace DAO;

use Models\JobRequests as JobRequests;

interface IJobRequestsDAO
{
    function Add(JobRequests $jobRequests);
    function GetAll();
}
?>