<?php

namespace Controllers;

use Exception;
use DAO\JobRequestsDAO as JobRequestsDAO;
use Models\JobRequests as JobRequests;
use Models\Alert as Alert;
use Models\JobOffer;

class JobRequestController {

    private $JobRequestsDAO;
    

    function __construct()
    {
        $this->JobRequestsDAO = new JobRequestsDAO();
        ini_set("SMTP", "smtp.gmail.com");
        ini_set("smtp_port", 587);
    }

    function Index(){
        require_once(VIEWS_PATH."home.php");
    }

    function ShowListView(){
        require_once(VIEWS_PATH."validate-session.php");
        try{
            $alert = new Alert("", "");
            $jobRequestList = $this->JobRequestsDAO->GetAll();
        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to load. Try later.');
        }finally{
            $_SESSION['alert'] = $alert;
            require_once(VIEWS_PATH."jobRequest-list.php");
        }
    }

    function Add($jobOfferId){

        try{

            $alert = new Alert("", "");

            if($this->JobRequestsDAO->getPostulatedCount($jobOfferId) < 5){
                
                if($this->Verify($_SESSION["loggedUser"])){

                    $jobRequests = new JobRequests();

                    $jobOffer = new JobOffer();
                    $jobOffer->setJobOfferId($jobOfferId);

                    $jobRequests->setJobOffer($jobOffer);
                    $jobRequests->setStudenId($_SESSION["loggedUser"]);

                    $jobRequests->setPostulationDate(date("Y-m-d"));
                    $jobRequests->setJobRequestsActive("1");
                    
                    $this->JobRequestsDAO->Add($jobRequests);

                    $alert->setType ('success');
                    $alert->setMessage('You have successfully applied for a job.');
                    
                }else{
                    $alert->setType ('danger');
                    $alert->setMessage('You are already applied for a job.');
                }
            }else{
                $alert->setType ('danger');
                $alert->setMessage('The number of applications for this offer is already full.');
            }

        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to applied to the job offer. Try again.');
        }finally{
            $_SESSION['alert'] = $alert;
            header("location:".FRONT_ROOT."JobOffer/ShowListView");
        }
    }

    function Verify($user){

        $jobRequestsList = $this->JobRequestsDAO->GetAll();
        $state = true;

        foreach($jobRequestsList as $jobRequests){
            if($jobRequests->getStudenId()->getStudentId() == $user->getStudentId()){
                $state = false;
            }
        }
        return $state;
    }

    function Proposals(){
        require_once(VIEWS_PATH."validate-session.php");
        try{
            $alert = new Alert("", "");
            $student = $_SESSION["loggedUser"];
            $jobRequestList = $this->JobRequestsDAO->SearchByStudenId($student->getStudentId());
        }catch(Exception $ex){
            $alert->setType ('danger');
            $alert->setMessage('Failed to load. Try later.');
        }finally{
            $_SESSION['alert'] = $alert;
            require_once(VIEWS_PATH."proposals-list.php");
        }
    }

    function CheckJobOfferExpiration() //check the current date and the expiration date of the job offer, in case of expiration call JobOfferRequestExpired function and remove from the database
    {      
        $today = date("Y-m-d");
        $jobRequestList = $this->JobRequestsDAO->GetAll();
        foreach($jobRequestList as $jobRequest){
            if($jobRequest->getJobOffer()->getExpirationDate() < $today){
                $this->JobOfferRequestExpired($jobRequest->getStudenId(), $jobRequest->getJobOffer());
                $this->JobRequestsDAO->Remove($jobRequest->getJobRequestsId());
            }
        }
    }

    function JobOfferRequestExpired($student, $jobOffer) //Write the mail for the job offer expired and call the function SentEmail
    {
        $to = $student->getEmail();
        $subject = "Oferta laboral de " . $jobOffer->getCompany()->getCompanyName();
        $message = "Gracias por haberse postulado al puesto " . $jobOffer->getJobPosition() . ". Lamentablemente ah finalizado la publicacion de la oferta.";
        $name = $student->getFirstName() . " " . $student->getLastName();
        $this->SentEmail($to, $subject, $message, $name);
    }

    function RejectedJobOffer($jobRequestId) //Write the mail for the job offer denied and remove from the database
    {
        $jobRequests = $this->JobRequestsDAO->SearchByJobRequestId($jobRequestId);
        $student = $jobRequests->getStudenId();
        $to = $student->getEmail();
        $subject = "Estado de la postulacion laboral ";
        $message = "Lamentamos informarle pero su postulacion labroal ah sido declinada. Usted puede intentar con otra oferta labrol si asi lo desea.";
        $name = $student->getFirstName() . " " . $student->getLastName();
        $this->SentEmail($to, $subject, $message, $name);
        $this->JobRequestsDAO->Remove($jobRequestId);
    }

    function SentEmail($to, $subject, $message, $name) //Sent the email.
    { 
        $headers = "MIME-Version 1.0" . "\r\n" . "Content-type:text/htmlcharset=iso-8859-1" . "\r\n" . "From: Test <prueba@example.com>" . "\r\n";
        $mail ="
        <html>
            <head><title>Oferta de trabajo</title></head>
            <body>
                <h1>Saludos <?php echo $name?></h1>
                <p><?php echo $message?> </p>
            </body>
        </html>
        ";
        mail($to, $subject, $mail, $headers);
    }
}
?>