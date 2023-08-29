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
           
            // Clear the existing movies array before loading new movies
            $this->_movies = [];
             // generate all movies 
            foreach($myMovies as $movie){
                
                $this->_movies []= new Movie($movie['id_movie'],$movie['title'],$movie['duration'],$movie['release_date'],$movie['synopsy'],$movie['notation'],$movie['poster'],$movie['id_director']);
                
            }   
          
        }

        public function getMovieById(int $id){
            $count = count($this->_movies);
            for($i = 0; $i < $count; $i++){
                if($this->_movies[$i]->getIdMovie() === $id){
                    return $this->_movies[$i];
                }
            
            }
          
            throw new Exception("Movie not found.");
        }
        //add movie in bdd
         public function addMovieInBd($title, int $duration , int $release_date, int $notation , $synopsy, $poster, int $id_director){

            $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS );
            $duration = filter_var($duration, FILTER_VALIDATE_INT);
            $release_date = filter_var($release_date, FILTER_VALIDATE_INT);
            $notation = filter_var($notation, FILTER_VALIDATE_INT);
            $synopsy = filter_var($synopsy, FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($poster, FILTER_SANITIZE_SPECIAL_CHARS);
            $id_director = filter_var($id_director, FILTER_VALIDATE_INT);
            
            if( $title === false || $duration === false || $release_date === false || $notation === false || $synopsy === false || $poster === false || $id_director === false){
                        
                throw new Exception("Invalid input data.");
            }

            $sql = "INSERT INTO movie (title, duration, release_date, notation, synopsy, poster, id_director)
                    VALUES (:title, :duration, :release_date, :notation, :synopsy, :poster, :id_director)";
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

            $id_movie = filter_var($id_movie, FILTER_VALIDATE_INT);
            $title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS );
            $duration = filter_var($duration, FILTER_VALIDATE_INT);
            $release_date = filter_var($release_date, FILTER_VALIDATE_INT);
            $notation = filter_var($notation, FILTER_VALIDATE_INT);
            $synopsy = filter_var($synopsy, FILTER_SANITIZE_SPECIAL_CHARS);
            $poster = filter_var($poster, FILTER_SANITIZE_SPECIAL_CHARS);
            $id_director = filter_var($id_director, FILTER_VALIDATE_INT);


            if($id_movie === false || $title === false || $duration === false || $release_date === false || $notation === false || $synopsy === false || $poster === false || $id_director === false){
                
                throw new Exception("Invalid input data.");
            }
        
            $sql = "UPDATE movie SET  title = :title, duration = :duration, release_date = :release_date, notation =  :notation, synopsy = :synopsy, poster = :poster, id_director = :id_director WHERE id_movie = :id_movie";
        
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
                $movie = $this->getMovieById($id_movie);
                $movie->setTitle($title);
                $movie->setDuration($duration);
                $movie->setReleaseDate($release_date);
                $movie->setNotation($notation);
                $movie->setSynopsy($synopsy);
                $movie->setPoster($poster);
                $movie->setIdDirector($id_director);
            }
            
        }

        public function getMoviesTitleById($id){

            $newId = filter_var($id, FILTER_VALIDATE_INT);
        
            $sql = ("SELECT m.title 
            FROM casting c
            INNER JOIN movie m ON c.id_movie = m.id_movie
            WHERE m.id_movie = :id;");
        
            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(':id', $newId);
            $stmt->execute();
        
            $titles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the titles as an associative array
        
            $stmt->closeCursor();
        
            if (!empty($titles)) {
                // Create an array to store titles
                $titleArray = [];
                
                // Loop through titles and extract 'title' value
                foreach ($titles as $titleData) {
                    $titleArray[] = $titleData['title'];
                }
        
                // Convert the array to a string using implode()
                $titlesString = implode(', ', $titleArray);
        
                return $titlesString;  // Return the titles as a comma-separated string
            }
            
            return 'Unknown Title'; // Return a default value if no title is found
        
        }

        public function getNameDirectorByIdMovie($id){
            $newId = filter_var($id, FILTER_VALIDATE_INT);

            if($newId === false){
            
                throw new Exception("Invalid input data.");
            }

            $sql = "SELECT CONCAT(p.firstname, ' ', p.lastname) AS directorName
            FROM movie m 
            INNER JOIN director d ON d.id_director = m.id_director 
            INNER JOIN person p ON p.id_person = d.id_person
            WHERE m.id_movie = :id ;";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":id", $newId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                $directorName = $result['directorName']; // Accéder à la valeur de la colonne 'directorName'
                return $directorName;
            }
        }

        
        

       public function getGenreLabel(){

            $sql = "SELECT g.label
            FROM movie m
            INNER JOIN belongs b ON b.id_movie = m.id_movie
            INNER JOIN genre g ON g.id_genre = b.id_genre
            WHERE m.id_movie = :id ;";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(':id', $this->_movies->getIdMovie(), PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor(); 

            if($result !== null){

            }
            
       }

    }
?>