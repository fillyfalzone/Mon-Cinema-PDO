<?php

    class Movie {
        private int $_idMovie;
        private string $_title;
        private int $_duration;
        private string $_releaseDate;
        private string $_synopsy;
        private int $_notation;
        private string $_poster;
        private int $_idDirector;

        
   

        public function __construct(int $idMovie, string $title, int $duration, string $releaseDate, string $synopsy, int $notation, string $poster, int $idDirector){
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

        public static function getMovies(){return self::$movies;}

        public function setIdMovie($idMovie){ $this->_idMovie = $idMovie ;}
        public function setTitle( $title){ $this->_title = $title ;}
        public function setDuration(){ $this->_duration = $duration ;}
        public function setReleaseDate(){ $this->_releaseDate = $releaseDate ;}
        public function setSynopsy(){ $this->_synopsy = $synopsy ;}
        public function setNotation(){ $this->_notation = $notation ;}
        public function setPoster(){ $this->_poster = $poster ;}
        public function setIdDirector(){ $this->_idDirector = $idDirector;}


        

    }
?>