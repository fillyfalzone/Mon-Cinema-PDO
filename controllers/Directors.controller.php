<?php
    require_once "./models/directors/DirectorsManager.php";
  
    

    class DirectorsController {
        private $_directorsManager;
     
        public function __construct(){
            $this->_directorsManager = new DirectorsManager; //instantiate the director manager
            $this->_directorsManager->loadDirectors(); //load directors of Bdd in controller property  
        }

        public function showDirectors(){
            $directors = $this->_directorsManager->getDirectors(); // assign the loaded directors to the $directors variable which will be used in the view
            require "views/directors/directors.view.php";
            unset($_SESSION['alert']); // clear the alert session.
        }

        public function showDirector(int $id){
            $director = $this->_directorsManager->getDirectorById($id);
            require "views/directors/showDirector.view.php"; 
        }
        // Add director in view
        public function addDirector(){
            require "views/directors/addDirector.view.php";
        }

        public function validateDirector(){

            if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['birth_date'])){

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $gender = $_POST['gender'];
                $birth_date = $_POST['birth_date'];
              

                $this->_directorsManager->addDirectorInBd($lastname, $firstname, $gender, $birth_date);

                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Zctor added successfully'
                ];
            }
            else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Add failed'
                ];
            }
            //redirection to directors list page 
            header('location: '. URL .'directors');
        }

        public function editDirector($idDirector){

            $director =  $this->_directorsManager->getDirectorById($idDirector);
 
             require "views/directors/editDirector.view.php";
             
         }

         public function editDirectorValidation(){

            try{
                $lastName = $_POST['lastname'];
                $firstName = $_POST['firstname'];
                $gender = $_POST['gender'];
                $birth_date = $_POST['birth_date'];
                $idPerson = $_POST['id_person'];
                $idDirector = $_POST['id_director'];

                $this->_directorsManager->editDirectorInBd($idPerson, $lastName, $firstName, $gender, $birth_date, $idDirector);
        
                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "Director edition successful"
                ];

                header('location: '. URL .'directors');
            } catch (Exception $e) {
            
                throw new Exception("Database error: " . $e->getMessage() .  " (edit failed in database)");
            }
        }

        public function deleteDirector($id){

            $this->_directorsManager->deleteDirectorInBd($id);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully deleted'
            ];

            header('location: '. URL .'directors');

        }

      
    }
?>