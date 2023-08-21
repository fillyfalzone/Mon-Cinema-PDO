<?php

    class Person {
        protected $_idPerson;
        protected $_lastName;
        protected $_firstName;
        protected $_gender;
        protected $_birthDate;

        public function __construct($idPerson, $lastName, $firstName, $gender, $birthDate){
            $this->_idPerson = $idPerson;
            $this->_lastName = $lastName;
            $this->_firstName = $firstName;
            $this->_gender = $gender;
            $this->_birthDate = $birthDate;
        }

        public function getIdPerson(){return $this->_idPerson;}
        public function getLastName(){return $this->_lastName;}
        public function getFirstName(){return $this->_firstName;}
        public function getGender(){return $this->_gender;}
        public function getBirthDate(){return $this->_birthDate;}
        
        public function setIdPerson(){$this->_idPerson = $idPerson;}
        public function setLastName(){$this->_lastName = $lastName;}
        public function setFirstName(){$this->_firstName = $firstName;}
        public function setGender(){$this->_gender = $gender;}
        public function setBirthDate(){$this->_birthDate = $birthDate;}
        


    }
?>