<?php

    class Movie {
        private int $_idMovie;
        private string $_title;
        private int $_duration;
        private int $_releaseDate;
        private string $_synopsy;
        private int $_notation;
        private string $_poster;
        private int $_idDirector;

        
   

        public function __construct(int $idMovie, string $title, int $duration, int $releaseDate, string $synopsy, int $notation, string $poster, int $idDirector){
            $this->_idMovie = $idMovie;
            $this->_title = $title;
            $this->_duration = $duration;
            $this->_releaseDate = $releaseDate;
            $this->_synopsy = $synopsy;
            $this->_notation = $notation;
            $this->_poster = $poster;
            $this->_idDirector = $idDirector;
         
            
        }

        public function getIdMovie(){return $this->_idMovie;}
        public function getTitle(){return $this->_title;}
        public function getDuration(){return $this->_duration;}
        public function getReleaseDate(){return $this->_releaseDate;}
        public function getSynopsy(){return $this->_synopsy;}
        public function getNotation(){return $this->_notation;}
        public function getPoster(){return $this->_poster;}
        public function getIdDirector(){return $this->_idDirector;}


        public function setTitle( $title){ $this->_title = $title ;}
        public function setDuration($duration){ $this->_duration = $duration ;}
        public function setReleaseDate($releaseDate){ $this->_releaseDate = $releaseDate ;}
        public function setSynopsy($synopsy){ $this->_synopsy = $synopsy ;}
        public function setNotation($notation){ $this->_notation = $notation ;}
        public function setPoster($poster){ $this->_poster = $poster ;}
        public function setIdDirector($idDirector){ $this->_idDirector = $idDirector;}

    }
?>