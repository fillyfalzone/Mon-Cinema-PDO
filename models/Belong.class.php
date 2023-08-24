<?php
    class Belong {
        private $_idGenre;
        private $_idMovie;

        public function __construct($idGenre, $idMovie) {
            $this->_idGenre = $idGenre;
            $this->_idMovie = $idMovie;
        }

        public function getIdGenre() {
            return $this->_idGenre;
        }
        public function setIdGenre($idGenre) {
            $this->_idGenre = $idGenre;
        }

        public function getIdMovie() {
            return $this->_idMovie;
        }
        public function setIdMovie($idMovie) {
            $this->_idMovie = $idMovie;
        }
    }
?>