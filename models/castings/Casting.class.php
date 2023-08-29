<?php
    require_once "models/movies/Movie.class.php";
    require_once "models/actors/Actor.class.php";
    require_once "models/roles/role.class.php";

    class Casting {
        private $_idMovie;
        private $_idRole;
        private $_idActor;

        public function __construct($idMovie, $idRole, $idActor){
            $this->_idMovie = $idMovie;
            $this->_idRole = $idRole;
            $this->_idActor = $idActor;    
        }

        public function getIdMovie(){
            return $this->_idMovie;
        }
        public function getIdRole(){
            return $this->_idRole;
        }
        public function getIdActor(){
            return $this->_idActor;
        }

        public function setIdMovie($idMovie){
            $this->_idMovie = $idMovie;
        }

        public function setIdRole($idRole){
            $this->_idRole = $idRole;
        }
        public function setIdActor($idActor){
            $this->_idActor = $idActor;
        }

        public function getActorById($idActor){
            
        }

    }
?> 