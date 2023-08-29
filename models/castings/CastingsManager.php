
<?php

    require_once "app/DAO.php";
    require_once "Casting.class.php";
     require_once "models/movies/MoviesManager.php";
     require_once "models/actors/ActorsManager.php";
     require_once "models/roles/RolesManager.php";
   




    class CastingsManager extends DAO {

        private $_castings;
        private $_castingsLoaded = false;

        //Definition of the addCasting() method which adds a casting to the list of castings, first checking if it is not already present.
         public function addCasting($casting) {
            if (!in_array($casting, $this->_castings)) {
                $this->_castings[] = $casting;
            }
        }

        public function getCastings(){
            return $this->_castings;
        }

        // load castings from bdd only if they are not already loaded
        public function loadCastings(){

            if (!$this->_castingsLoaded){
                // Preparation of the SQL query to select all data from the "casting" table. 
                $sql = $this->getBdd()->prepare("SELECT * FROM casting;");
                //Execution of the SQL query.
                $sql->execute();
                // Retrieval of all resulting rows from the query into an associative array.
                $myCastins = $sql->fetchAll(PDO::FETCH_ASSOC);

                //Closing the cursor of the SQL query. 
                $sql->closeCursor();
                //Resetting the existing castings array.
                $this->_castings = [];
                // Looping through each row of the retrieved castings array. 
                foreach ($myCastins as $casting){
                    //Creating a new instance of the Casting class with the data from each row
                    $this->_castings[] = new Casting($casting['id_movie'], $casting['id_actor'], $casting['id_role']);
                }
                //turn on true property (castings loaded)
                $this->_castingsLoaded = true;  
            }
        }

        public function getActorsNamesByIdMovie($id){
            $newId = filter_var($id, FILTER_VALIDATE_INT);
            $sql = "SELECT CONCAT(p.firstname,' ', p.lastname) AS ActorName 
            FROM casting c
            INNER JOIN actor a  ON a.id_actor = c.id_actor
            INNER JOIN person p ON p.id_person = a.id_person
            WHERE c.id_movie = :id; ";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(':id', $newId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            if ($result != null){
                return $result;
            }
        }

        public function getMoviesRoleByActorId($actorId){

            $newActorId = filter_var($actorId, FILTER_VALIDATE_INT);

            $sql = "SELECT m.title
            FROM casting c 
            INNER JOIN movie m ON m.id_movie = c.id_movie 
            INNER JOIN actor a ON a.id_actor = c.id_actor
            WHERE c.id_actor  = :id ;";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(':id', $newActorId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            if (!empty($result)) {
                $titles = array_column($result, 'title'); //// We generate a $titles array using the array_column() function to extract the 'title' column from the $result array.
                return $titles;
            }
        }

        
         
    } 


?>