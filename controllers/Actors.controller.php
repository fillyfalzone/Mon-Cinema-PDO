<?php
    require_once "models/actors/ActorsManager.php";
  
    

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
            require "views/actors/showActor.view.php"; 
        }
        // Add actor in view
        public function addActor(){
            require "views/actors/addActor.view.php";
        }
      
    }
?>