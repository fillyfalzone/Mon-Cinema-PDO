<?php
    require_once './models/persons/Person.class.php';
    
    class Director extends Person {
        private $_idDirector;

        public function __construct($idPerson, $lastName, $firstName, $gender, $birthDate, $idDirector){
            parent::__construct($idPerson, $lastName, $firstName, $gender, $birthDate);
            $this->_idDirector = $idDirector;
           
        }

        public function getIdDirector(){
            return $this->_idDirector;
        }

     

        public function setIdDirector($idDirector)
        {
            $this->_idDirector = $idDirector;
        }

      
        public function getDirectorName(){
            return  $this->getFirstName(). ' '. $this->getLastName();
        }
    }

?>