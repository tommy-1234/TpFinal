<?php

    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Exception;
    use Models\User as User;
    use Models\Alert as Alert;
    use DAO\UserStudentDAO as UserStudentDAO;
    use Models\UserStudent as UserStudent;

class UserController
    {
        private $userDAO;
        private $userStudentDAO;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
            $this->userStudentDAO = new UserStudentDAO();
        }

        function Index($message = ""){
            require_once(VIEWS_PATH."home.php");
        }

        function ShowDetailView(){
            require_once(VIEWS_PATH."validate-session.php");
            $user=new User();
            $user = $_SESSION['loggedUser']; 
            require_once(VIEWS_PATH."user-detail.php");
        }

        function ShowListView(){
            require_once(VIEWS_PATH."validate-session.php");
            try{
                $alert = new Alert("", "");
                $studentList = $this->userDAO->GetAll();
            }catch(Exception $ex){
                $alert->setType ('danger');
                $alert->setMessage('Failed to load. Try later.');
            }finally{
                $_SESSION['alert'] = $alert;
                require_once(VIEWS_PATH."user-list.php");
            }   
        }

        function ShowRegisterView()
        {
            require_once(VIEWS_PATH."userStudent-add.php");
        }

        function ShowAddStudentView()
        {
            require_once(VIEWS_PATH."user-add.php");
        }
        
        //Create and Add a student
        function Add($carrer, $studentFirstName, $studentLastName, $studentDni, $studentFileNumber, $studentPhone, $studentGender, $studentBirthDate, $studentEmail)  
        {
            try{
                $checkDni = $this->userDAO->GetAll();
                //Verify if the dni is already in use
                foreach($checkDni as $dni){    
                    if($dni->getDni() == $studentDni){
                        throw new Exception();
                    }
                }

                $student = new User();
                $student->setStudentId(rand());
                $student->setCareerId($carrer);
                $student->setFirstName($studentFirstName);
                $student->setLastName($studentLastName);
                $student->setDni($studentDni);
                $student->setFileNumber($studentFileNumber);
                $student->setGender($studentGender);
                $student->setBirthDate($studentBirthDate);
                $student->setEmail($studentEmail);
                $student->setPhoneNumber($studentPhone);
                $student->setActive(1);

                $this->userDAO->Add($student);

            }catch (Exception $ex){
                ?><script>alert("Error. There is already a student with that ID")</script><?php
            }finally{
                $this->ShowListView(); 
            }
        }

        function CheckMail($email, $password){    

            if($this->VerifyEmail($email)){
                $user = $this->userDAO->GetUserByEmail($email);
                if($email == $user->getEmail()){
                    $userStudent = new UserStudent();
                    $userStudent->setEmail($email);
                    $userStudent->setPassword($password);
                    $userStudent->setUser($user);
                    $this->userStudentDAO->Add($userStudent);
                    $this->Index('Student User added successfully.'); 
                }else{
                    $this->Index('The student was not found. Talk with the admin.'); 
                } 
            }else{
                $this->Index('The student was already charged.');         
            }   
        }
        
        //Verifica si el email de la compañia ya esta registrado
        function VerifyEmail($email)
        { 
           $userStudentList = $this->userStudentDAO->GetAll();
           $state = true;
        
           foreach($userStudentList as $userStudent){
               if(strcmp($email, $userStudent->getEmail()) == 0){
                   $state = false;
               }
           }
           return $state;
        }
    }
?>