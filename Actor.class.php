<?php
require_once "Person.class.php";

    class Actors extends Person {
        private $_idActor; 

        public function __construct($idPerson, $idActor){
            parent::__construct($idPerson, $lastName, $firstName, $gender, $birthDate);
            $this->_idActor = $idActor; 

        }
    }
?>