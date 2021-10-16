<?php
    namespace Models;

    class Company{
        private $idCompany;
        private $companyName;
        private $companyDescription;
        private $companyEmail;
        private $companyPhone;
        private $companyLinkedin;
        private $companyAddress;
            

        public function getIdCompany(){ return $this->idCompany; }
        public function setIdCompany($idCompany) { $this->idCompany = $idCompany; }

        public function getCompanyName(){ return $this->companyName; }
        public function setCompanyName($companyName) { $this->companyName = $companyName; }

        public function getCompanyDescription(){ return $this->companyDescription; }
        public function setCompanyDescription($companyDescription) { $this->companyDescription = $companyDescription; }

        public function getCompanyEmail(){ return $this->companyEmail; }
        public function setCompanyEmail($companyEmail) { $this->companyEmail = $companyEmail; }

        public function getCompanyPhone(){ return $this->companyPhone; }
        public function setCompanyPhone($companyPhone) { $this->companyPhone = $companyPhone; }

        public function getCompanyLinkedin(){ return $this->companyLinkedin; }
        public function setCompanyLinkedin($companyLinkedin) { $this->companyLinkedin = $companyLinkedin; }

        public function getCompanyAddress(){ return $this->companyAddress; }
        public function setCompanyAddress($companyAddress) { $this->companyAddress = $companyAddress; }


    }

?>