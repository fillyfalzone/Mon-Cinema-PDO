<?php
    require_once "app/DAO.php";
    require_once "Actor.class.php";

    class ActorsManager extends DAO {

        private $_actors; // array Actors

        public function addActor($actor) {
            $this->_actors[] = $actor;
        }
        public function getActors(){
            return $this->_actors;
        }

         // load actors from bdd
         public function loadActors(){
            $sql = $this->getBdd()->prepare("SELECT p.id_person, p.firstname, p.lastname, p.gender, p.birth_date, a.id_actor
            FROM actor a
            INNER JOIN person p ON a.id_person = p.id_person");

            $sql->execute();
            $myActors = $sql->fetchAll(PDO::FETCH_ASSOC); // PDO::FECT_ASSOC remove duplicates from query
            $sql->closeCursor(); //end the request to allow further requests
            
        
            // Clear the existing actors array before loading new actors
            $this->_actors = [];

             // generate all actors
            foreach($myActors as $actor){
                $a = new Actor($actor['id_person'],$actor['lastname'], $actor['firstname'], $actor['gender'],$actor['birth_date'],$actor['id_actor']);
                $this->addActor($a); 
            }
            
        }

        public function getActorById(int $id){

            for($i = 0; $i < count($this->_actors); $i++){
                if($this->_actors[$i]->getIdActor() === $id){
                    return $this->_actors[$i];
                }
            }
            throw new Exception("Actor not found.");
        }

       
        // add actor in bd
        public function addActorInBd($lastName, $firstName, $gender, $birthDate){
            //iterate through the array and extract the actor with the corresponding id
            $lastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS);
            $firstName = filter_var($firstName, FILTER_SANITIZE_SPECIAL_CHARS);
            $gender = filter_var($gender, FILTER_SANITIZE_SPECIAL_CHARS);
            $birthDate = filter_var($birthDate, FILTER_SANITIZE_SPECIAL_CHARS);
            
        
            if ($lastName === false || $firstName === false || $gender === false || $birthDate === false ){
                throw new Exception("Invalid input data.");
            }
        
            $sql1 = "INSERT INTO person (lastname, firstname, gender, birth_date) VALUES (:lastname, :firstname, :gender, :birth_date)";
            $stmt1 = $this->getBdd()->prepare($sql1);
            $stmt1->bindValue(":lastname", $lastName, PDO::PARAM_STR);
            $stmt1->bindValue(":firstname", $firstName, PDO::PARAM_STR);
            $stmt1->bindValue(":gender", $gender, PDO::PARAM_STR);
            $stmt1->bindValue(":birth_date", $birthDate, PDO::PARAM_STR);
            $result1 = $stmt1->execute();
            $idPersonInserted = $this->getBdd()->lastInsertId();
            $stmt1->closeCursor();
        
            if ($result1 > 0){
                $sql2 = "INSERT INTO actor (id_person) VALUES (:id_person)";
                $stmt2 = $this->getBdd()->prepare($sql2);
                $stmt2->bindValue(":id_person", $idPersonInserted, PDO::PARAM_INT);
                $result2 = $stmt2->execute();
                $idActor = $this->getBdd()->lastInsertId();
                $stmt2->closeCursor();

                 // Clear the existing actors array before loading new actors
                 $this->_actors = [];
        
                if ($result2 > 0){
                    $this->_actors = new Actor($idPersonInserted, $lastName, $firstName, $gender, $birthDate, $idActor);
                }
            }
        }
        
            //delete actor in Bdd
            public function deleteActorInBd(int $id){

                $newId = filter_var($id, FILTER_VALIDATE_INT);
    
                $sql = "DELETE a, p
                FROM actor a
                INNER JOIN person p ON p.id_person = a.id_person
                WHERE a.id_actor = :id_actor;";
                
                $stmt = $this->getBdd()->prepare($sql);
                $stmt->bindValue(":id_actor", $newId, PDO::PARAM_INT);
                $result = $stmt->execute();
                $stmt->closeCursor();
                if($result > 0 ){
                    $actor = $this->getActorById($newId);
                    unset($actor);
                }
            }
    
    
        // edit actor in Bdd
        public function editActorInBd($idPerson, $lastName, $firstName, $gender, $birthDate, $idActor){
            try{
                $newIdPerson = filter_var($idPerson, FILTER_VALIDATE_INT);
                $newLastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS);
                $newFirstName = filter_var($firstName, FILTER_SANITIZE_SPECIAL_CHARS);
                $newGender = filter_var($gender, FILTER_SANITIZE_SPECIAL_CHARS);
                $newBirthDate =  DateTime::createFromFormat('Y-m-d', $birthDate ); // Create a new instance of the DateTime class from the given date of birth in 'Y-m-d' format.
                $formatNewBirthDate = $newBirthDate->format('Y-m-d'); //This code is converting a birthdate object into a string format of year-month-day.  
                $newIdActor = filter_var($idActor, FILTER_VALIDATE_INT);
            
                if ($newIdPerson === false || $newLastName === false || $newFirstName === false || $newGender === false || $newBirthDate === false || $newIdActor === false){
                    throw new Exception("Invalid input data.");
                }
                
                $sql1 = "UPDATE person SET lastname = :lastname, firstname = :firstname, gender = :gender, birth_date = :birth_date WHERE id_person = :id_person";


                $stmt1 = $this->getBdd()->prepare($sql1);
                $stmt1->bindValue(":lastname", $newLastName, PDO::PARAM_STR);
                $stmt1->bindValue(":firstname", $newFirstName, PDO::PARAM_STR);
                $stmt1->bindValue(":gender", $newGender, PDO::PARAM_STR);
                $stmt1->bindValue(":birth_date", $formatNewBirthDate, PDO::PARAM_STR);
                $stmt1->bindValue(":id_person", $newIdPerson, PDO::PARAM_INT);
                $result1 = $stmt1->execute();
                $stmt1->closeCursor();

                // if query is execute set paramaters
                if($result1 > 0){
                    $actor = $this->getActorById($newIdActor);
                    $actor->setIdPerson($newIdPerson);
                    $actor->setLastName($newLastName);
                    $actor->setFirstName($newFirstName);
                    $actor->setGender($newGender);
                    $actor->setBirthDate($newBirthDate);
                }
            
            } catch (PDOException $e) {
                throw new Exception("Database error: " . $e->getMessage() .  " (edit failed in database)");
            }   
        }
    }
?>


    
