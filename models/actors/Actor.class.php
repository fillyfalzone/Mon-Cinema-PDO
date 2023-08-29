<?php
    require_once './models/persons/Person.class.php';
    
    class Actor extends Person {
        private $_idActor;

        public function __construct($idPerson, $lastName, $firstName, $gender, $birthDate, $idActor){
            parent::__construct($idPerson, $lastName, $firstName, $gender, $birthDate);
            $this->_idActor = $idActor;
        }

        public function getIdActor(){
            return $this->_idActor;
        }

   

        public function setIdActor($idActor)
        {
            $this->_idActor = $idActor;
        }

       

    
    }
    