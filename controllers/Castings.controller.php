<?php
    require_once "./models/castings/CastingsManager.php";
    require_once "./models/movies/MoviesManager.php";
    require_once "./models/actors/ActorsManager.php";
    require_once "./models/roles/RolesManager.php";
    
    

    class CastingsController {
        private $_castingsManager;

        public function __construct(){
            $this->_castingsManager = new CastingsManager;
            $this->_castingsManager->loadCastings(); 
        }

        public function showCastings(){
            $castings = $this->_castingsManager->getCastings();

        
            $moviesManager = new MoviesManager;
            $moviesManager->loadMovies();
            $movies = $moviesManager->getMovies();
            // echo "<pre>";
            // print_r($movies); 
            // echo "<pre>";

            $actorsName = $this->_castingsManager->getActorsNamesByIdMovie($id=0); 
             
        

            $actorsManager = new ActorsManager;
            $actorsManager->loadActors(); 
            $actors = $actorsManager->getActors();

            $rolesManager = new RolesManager;
            $rolesManager->loadRoles();
            $roles = $rolesManager->getRoles();
           
            require "views/castings/castings.view.php";
            unset($_SESSION['alert']); // clear the alert session.
        }
        
    }
?>



