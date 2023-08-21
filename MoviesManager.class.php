<?php
    require_once "app/Model.php";
    require_once "Movie.class.php";

    class MoviesManager extends Model {
        private $_movies;

        public function addMovie($movie){
            $this->_movies[] = $movie;
        }

        public function getMovie(){
            return $this->_movies;
        }

        public function loadMovies(){
            $sql = $this->getBdd()->prepare("SELECT * FROM movies;");
            $sql->execute();
            $myMovies = $sql->fetchAll(PDO::FETCH_ASSOC); // PDO::FECT_ASSOC remove duplicates from query
            $sql->closeCursor(); //end the request to allow further requests
            // generate all movies 
            foreach($myMovies as $movie){
                $m = new Movie($movie['id_movie'],$movie['title'],$movie['duration'],$movie['release_date'],$movie['synopsy'],$movie['notation'],$movie['poster'],$movie['id_director']);
                $this->addMovie($m); 
            }
        }

    }
?>