<?php
    namespace Models;

    use Models\User as User;
    use Models\JobOffer as JobOffer;

    class JobRequests{

        private $jobRequestsId;
        private $jobOffer;
        private $studenId;
        private $postulationDate;
        private $jobRequestsActive;

        public function __construct()
        {
            
        }

        public function getJobRequestsId(){ return $this->jobRequestsId; }
        public function setJobRequestsId($jobRequestsId): self { $this->jobRequestsId = $jobRequestsId; return $this; }

        public function getJobOffer(){ return $this->jobOffer; }
        public function setJobOffer(JobOffer $jobOffer): self { $this->jobOffer = $jobOffer; return $this; }

        public function getStudenId(){ return $this->studenId; }
        public function setStudenId(User $studenId): self { $this->studenId = $studenId; return $this; }

        public function getPostulationDate(){ return $this->postulationDate; }
        public function setPostulationDate($postulationDate): self { $this->postulationDate = $postulationDate; return $this; }

        public function getJobRequestsActive(){ return $this->jobRequestsActive; }
        public function setJobRequestsActive($jobRequestsActive): self { $this->jobRequestsActive = $jobRequestsActive; return $this; }
    }
?>