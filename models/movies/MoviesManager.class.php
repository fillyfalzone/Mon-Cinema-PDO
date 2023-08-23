<?php
    require_once "app/DAO.php";
    require_once "Movie.class.php";

    class MoviesManager extends DAO {
        private $_movies; // movies array

        public function addMovie($movie){
            $this->_movies[] = $movie;
        }

        public function getMovies(){
            return $this->_movies;
        }
        // load movies from bdd
        public function loadMovies(){
            $sql = $this->getBdd()->prepare("SELECT * FROM movie;");
            $sql->execute();
            $myMovies = $sql->fetchAll(PDO::FETCH_ASSOC); // PDO::FECT_ASSOC remove duplicates from query
            $sql->closeCursor(); //end the request to allow further requests
            // generate all movies 

            // Clear the existing movies array before loading new movies
            $this->_movies = [];

            foreach($myMovies as $movie){
                $m = new Movie($movie['id_movie'],$movie['title'],$movie['duration'],$movie['release_date'],$movie['synopsy'],$movie['notation'],$movie['poster'],$movie['id_director']);
                $this->addMovie($m); 
            }
            
        }

        public function getMovieById(int $id){
            for($i = 0; $i < count($this->_movies); $i++){
                if($this->_movies[$i]->getIdMovie() === $id){
                    return $this->_movies[$i];
                }
            }
            throw new Exception("Movie not found.");
        }
        //add movie in bdd
        public function addMovieInBd($title, int $duration , int $release_date, int $notation , $synopsy, $poster, int $id_director){
            $sql = " INSERT INTO movie (title, duration, release_date, notation, synopsy, poster, id_director)
            values (:title, :duration, :release_date, :notation, :synopsy, :poster, :id_director)";
            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":title",$title,PDO::PARAM_STR);
            $stmt->bindValue(":duration",$duration,PDO::PARAM_INT);
            $stmt->bindValue(":release_date",$release_date,PDO::PARAM_INT);
            $stmt->bindValue(":notation",$notation,PDO::PARAM_INT);
            $stmt->bindValue(":synopsy",$synopsy,PDO::PARAM_STR);
            $stmt->bindValue(":poster",$poster,PDO::PARAM_STR);
            $stmt->bindValue(":id_director",$id_director,PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();

            // add movie in array movies property 
            if($result > 0){
                $id_movie = $this->getBdd()->lastInsertId();
                $movie = new Movie($id_movie, $title, $duration, $release_date, $synopsy, $notation, $poster,$id_director);
                $this->addMovie($movie);

            }
        }
        //delete movie in Bdd
        public function delMovieInBd(int $id){
            $sql = "DELETE FROM movie WHERE id_movie = :id_movie";
            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":id_movie", $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor(); 

            // if query is execute delete movie
            if($result > 0 ){
                $movie = $this->getMovieById($id);
                unset($movie);
            }
        }  
        
        // edit movie in Bdd
        public function editMovieInBd($id_movie, $title, int $duration , int $release_date, int $notation , $synopsy, $poster, int $id_director){

            $sql = "UPDATE movie SET  titre = :title, duration = :duration, release_date = :release_date, notation =  :notation, synopsy = :synopsy, poster = :poster, id_director = :id_director WHERE id_movie = :id_movie";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":id_movie",$id_movie,PDO::PARAM_INT);
            $stmt->bindValue(":title",$title,PDO::PARAM_STR);
            $stmt->bindValue(":duration",$duration,PDO::PARAM_INT);
            $stmt->bindValue(":release_date",$release_date,PDO::PARAM_INT);
            $stmt->bindValue(":notation",$notation,PDO::PARAM_INT);
            $stmt->bindValue(":synopsy",$synopsy,PDO::PARAM_STR);
            $stmt->bindValue(":poster",$poster,PDO::PARAM_STR);
            $stmt->bindValue(":id_director",$id_director,PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();

             // if query is execute set paramaters
            if($result !== null){
                $this->getMovieById($id_movie)->setTitre($title);
                $this->getMovieById($id_movie)->Duration($duration);
                $this->getMovieById($id_movie)->setReleaseDate($release_date);
                $this->getMovieById($id_movie)->setNotation($notation);
                $this->getMovieById($id_movie)->setSynopsy($synopsy);
                $this->getMovieById($id_movie)->setPoster($poster);
                $this->getMovieById($id_movie)->setIdDirector($id_director);
                
            }
            
        }
    }
?>