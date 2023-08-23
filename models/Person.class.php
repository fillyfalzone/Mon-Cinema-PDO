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
        
        public function setIdPerson($idPerson){$this->_idPerson = $idPerson;}
        public function setLastName($lastName){$this->_lastName = $lastName;}
        public function setFirstName($firstName){$this->_firstName = $firstName;}
        public function setGender($gender){$this->_gender = $gender;}
        public function setBirthDate($birthDate){$this->_birthDate = $birthDate;}
        


    }
?>