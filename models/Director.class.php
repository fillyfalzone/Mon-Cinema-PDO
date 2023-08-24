<?php
    require_once "Person.php";
    
    class Director extends Person {
        private $_idDirector;
        private $_idPerson;

        public function __construct($idPerson, $lastName, $firstName, $gender, $birthDate, $idDirector){
            parent::__construct($idPerson, $lastName, $firstName, $gender, $birthDate);
            $this->_idDirector = $idDirector;
            $this->_idPerson = parent::getIdPerson();
        }

        public function getIdDirector(){
            return $this->_idDirector;
        }

        public function getIdPerson()
        {
            return $this->_idPerson;
        }

        public function setIdDirector($idDirector)
        {
            $this->_idDirector = $idDirector;
        }

        public function setIdPerson($idPerson){
            $this->_idPerson = $idPerson;
        }

    
    }
    