<?php
    class Genre {
        private $_idGenre;
        private $_label;

        public function __construct($idGenre, $label){
            $this->_idGenre = $idGenre;
            $this->_label = $label;
        }

        public function getIdGenre() {
            return $this->_idGenre;
        }
        public function getLabel() {
            return $this->_label;
        }

        public function setIdgenre($idGenre) {
            $this->_idGenre = $idGenre ;
        }

        public function setLabel($label) {
            $this->_label = $label;
        }

    }
?>