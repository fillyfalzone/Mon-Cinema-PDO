<?php

    require_once "GenreBelongsMovie.class.php";
    
    class GenreBelongsMovieManager extends DAO {
        private $_genresBelongsMovie;

        public function AddGenreBelongsMovie($genresBelongsMovie){
           
            if (!in_array($genresBelongsMovie, $this->_genresBelongsMovie)) {
                $this->_genresBelongsMovie = $genresBelongsMovie;
            }
        }

    }
?>