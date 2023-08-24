<?php
    // require_once "persons/Person.class.php";
    require_once './models/persons/Person.class.php';
    
    class Actor extends Person {
        private $_idActor;
        protected $_idPerson;

        public function __construct($idPerson, $lastName, $firstName, $gender, $birthDate, $idActor){
            parent::__construct($idPerson, $lastName, $firstName, $gender, $birthDate);
            $this->_idActor = $idActor;
            $this->_idPerson = parent::getIdPerson();
        }

        public function getIdActor(){
            return $this->_idActor;
        }

        public function getIdPerson()
        {
            return $this->_idPerson;
        }

        public function setIdActor($idActor)
        {
            $this->_idActor = $idActor;
        }

        public function setIdPerson($idPerson){
            $this->_idPerson = $idPerson;
        }

    
    }
    