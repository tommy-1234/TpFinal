<?php
    namespace Models;

    use Models\Company as Company;
    use Models\JobPosition as JobPosition;

    class JobOffer{

        private $company;
        private $jobPosition;
        private $publicationDate;
        private $expirationDate;
        private $isRemote;
        private $projectDescription;
        private $hourlyLoad;
        private $active;



        public function getCompany(){ return $this->company; }
        public function setCompany(Company $company){ $this->company = $company; }

        public function getJobPosition(){ return $this->jobPosition; }
        public function setJobPosition(JobPosition $jobPosition){ $this->jobPosition = $jobPosition; }

        public function getPublicationDate(){ return $this->publicationDate; }
        public function setPublicationDate($publicationDate){ $this->publicationDate = $publicationDate; }

        public function getExpirationDate(){ return $this->expirationDate; }
        public function setExpirationDate($expirationDate){ $this->expirationDate = $expirationDate; }

        public function getIsRemote(){ return $this->isRemote; }
        public function setIsRemote($isRemote){ $this->isRemote = $isRemote; }

        public function getProjectDescription(){ return $this->projectDescription; }
        public function setProjectDescription($projectDescription){ $this->projectDescription = $projectDescription; }

        public function getHourlyLoad(){ return $this->hourlyLoad; }
        public function setHourlyLoad($hourlyLoad){ $this->hourlyLoad = $hourlyLoad; }

        public function getActive(){ return $this->active; }
        public function setActive($active){ $this->active = $active; }
    }
?>
