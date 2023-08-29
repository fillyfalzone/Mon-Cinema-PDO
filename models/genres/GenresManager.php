<?php
    require_once "app/DAO.php";
    require_once "Genre.class.php";

    class GenresManager extends DAO {
        private $_genres; // array of Genres

        public function getGenres() {
            return $this->_genres;
        }

        public function AddGenre($genre){
            $this->_genres[] = $genre;
        }

        // load all grenres from database
        public function loadGenres(){

            $sql = $this->getBdd()->prepare("SELECT * 
            FROM genre;");
            
            $sql->execute();
            $myGenres = $sql->fetchAll(PDO::FETCH_ASSOC);
            $sql->closeCursor();

            // Clear the existing genres array before loading new genres
            $this->_genres = [];

             // generate all genres 
             foreach($myGenres as $genre){
                $g = new Genre($genre['id_genre'], $genre['label']);
                $this->AddGenre($g);
             }
        }
        
        // add a genre in database
        public function AddGenreInBd($label){
            // filter the input values
            $newLabel = filter_var($label, FILTER_SANITIZE_SPECIAL_CHARS);
            // prepare and execute the query
            $sql = $this->getBdd()->prepare("INSERT INTO genre (label) VALUES (:label);");
            $sql->bindValue(':label', $newLabel, PDO::PARAM_STR);
            $result = $sql->execute();
            $sql->closeCursor(); 
            // take last inserted id from database
            $idGenre = $this->getBdd()->lastInsertId();
            //reset genres list
            $this->_genres = [];
            // insert new genres into properties table
            if ($result > 0) {
                $this->_genres[] = new Genre($idGenre, $newLabel);
            }
        }
        // edit genres in database
        public function editGenreInBd($idGenre, $label){
            // filter the input values
            $newLabel = filter_var($label, FILTER_SANITIZE_SPECIAL_CHARS);
            $newIdGenre = filter_var($idGenre,FILTER_VALIDATE_INT);
            // prepare and execute the query
            $sql = $this->getBdd()->prepare("UPDATE genres SET id_genre = :id_genre, label = :label");
            $sql->bindValue(':id_genre',$newIdGenre, PDO::PARAM_INT);
            $sql->bindValue(':label',$newLabel, PDO::PARAM_STR);
            $result = $sql->execute();
            $sql->closeCursor();
            //reset genres list
            $this->_genres = [];
            // insert new genres into properties table
            if ($result > 0) {
                $this->_genres[] = new Genre($idGenre, $label);
            }   
        }
        // delete a genre in database
        public function delGenreInBd($idGenre){
             // filter the input values
            $newIdGenre = filter_var($idGenre, FILTER_VALIDATE_INT);
            // prepare and execute the query
            $sql = $this->getBdd()->prepare("DELETE FROM genres WHERE id_genre = :id_genre");
            $sql->bindValue(':id_genre',$newIdGenre, PDO::PARAM_INT);
            $result = $sql->execute();
            $sql->closeCursor();
            // unset the genres from properties list
            if ($result > 0){
                $genre = $this->getGenreById($newIdGenre);
                unset($genre);
            }
        }
        
        public function getGenreById(int $id){
            $count = count($this->_genres);
            for($i = 0; $i < $count; $i++){
                if($this->_genres[$i]->getIdGenre() === $id){
                    return $this->_genres[$i];
                }
            }
            throw new Exception("Genre not found.");
        }
    }
?>