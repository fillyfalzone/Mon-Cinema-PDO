<?php
    require_once "./models/genres/GenresManager.php";

    class GenresController {
        private $_GenresManager;

        public function __construct()
        {
            $this->_GenresManager = new GenresManager; //instantiate the genres manager
            $this->_GenresManager->loadGenres(); //load genres of Bdd in controller property 
        }
            
        public function showGenres(){
            $genres = $this->_GenresManager->getGenres(); // assign the loaded movies to the $genres array variable which will be used in the view 
            require "views/genres/genres.view.php";
        }
    }
?>