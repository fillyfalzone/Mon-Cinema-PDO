<?php

    require_once "models/actors/ActorsManager.php";
    require_once "models/movies/MoviesManager.php";
  
    

    class ActorsController {
        private $_actorsManager;
     
        public function __construct(){
            $this->_actorsManager = new ActorsManager; //instantiate the actor manager
            $this->_actorsManager->loadActors(); //load actors of Bdd in controller property  
        }

        public function showActors(){
            $actors = $this->_actorsManager->getActors(); // assign the loaded actors to the $actors variable which will be used in the view
            require "views/actors/actors.view.php";
            unset($_SESSION['alert']); // clear the alert session.
        }

        public function showActor(int $id){
            $actor = $this->_actorsManager->getActorById($id);
            $CastingsManager = new CastingsManager;
            $CastingsManager->loadCastings();
            $movies = $CastingsManager->getMoviesRoleByActorId($id);
            require "views/actors/showActor.view.php"; 
        }
        // Add actor in view
        public function addActor(){
            require "views/actors/addActor.view.php";
        }

        public function validateActor(){

            if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['birth_date'])){

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $gender = $_POST['gender'];
                $birth_date = $_POST['birth_date'];
              

                $this->_actorsManager->addActorInBd($lastname, $firstname, $gender, $birth_date);

                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Actor added successfully'
                ];
            }
            else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'Add failed'
                ];
            }
            //redirection to actors list page 
            header('location: '. URL .'actors');
        }

        public function editActor($idActor){

           $actor =  $this->_actorsManager->getActorById($idActor);

            require "views/actors/editActor.view.php";
            
        }

        public function editActorValidation(){

            try{
                $lastName = $_POST['lastname'];
                $firstName = $_POST['firstname'];
                $gender = $_POST['gender'];
                $birth_date = $_POST['birth_date'];
                $idPerson = $_POST['id_person'];
                $idActor = $_POST['id_actor'];

                $this->_actorsManager->editActorInBd($idPerson, $lastName, $firstName, $gender, $birth_date, $idActor);
        
                $_SESSION['alert'] = [
                    "type" => "success",
                    "message" => "Actor edition successful"
                ];

                header('location: '. URL .'actors');
            } catch (Exception $e) {
            
                throw new Exception("Database error: " . $e->getMessage() .  " (edit failed in database)");
            }
        }

        public function deleteActor($id){

            $this->_actorsManager->deleteActorInBd($id);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully deleted'
            ];

            header('location: '. URL .'actors');

        }
      
    }
?>