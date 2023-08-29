<?php
    require_once "app/DAO.php";
    require_once "Director.class.php";


    class DirectorsManager extends DAO {

        private $_directors; // array Directors

        public function addDirector($director) {
            $this->_directors[] = $director;
        }
        public function getDirectors(){
            return $this->_directors;
        }

         // load directors from bdd
         public function loadDirectors(){
            $sql = $this->getBdd()->prepare("SELECT p.id_person, p.firstname, p.lastname, p.gender, p.birth_date, d.id_director
            FROM director d
            INNER JOIN person p ON d.id_person = p.id_person");

            $sql->execute();
            $myDirectors = $sql->fetchAll(PDO::FETCH_ASSOC); // PDO::FECT_ASSOC remove duplicates from query
            $sql->closeCursor(); //end the request to allow further requests
            
        
             // Clear the existing directors array before loading new directors
             $this->_directors = [];

             // generate all directors
            foreach($myDirectors as $director){
                $this->_directors[] = new Director($director['id_person'],$director['lastname'], $director['firstname'], $director['gender'],$director['birth_date'],$director['id_director']);
            }
            
        }
        //Retrieves a director by its identifier.
        public function getDirectorById(int $id){

            for($i = 0; $i < count($this->_directors); $i++){
                if($this->_directors[$i]->getIdDirector() === $id){
                    return $this->_directors[$i];
                }
            }
            throw new Exception("Director not found.");
        }

       // add director in bd
       public function addDirectorInBd($lastName, $firstName, $gender, $birthDate){
        //iterate through the array and extract the director with the corresponding id
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
            $sql2 = "INSERT INTO director (id_person) VALUES (:id_person)";
            $stmt2 = $this->getBdd()->prepare($sql2);
            $stmt2->bindValue(":id_person", $idPersonInserted, PDO::PARAM_INT);
            $result2 = $stmt2->execute();
            $idDirector = $this->getBdd()->lastInsertId();
            $stmt2->closeCursor();

             // Clear the existing directors array before loading new directors
             $this->_directors = [];
    
            if ($result2 > 0){
                $this->_directors = new Director($idPersonInserted, $lastName, $firstName, $gender, $birthDate, $idDirector);
            }
        }
    }
    
        
            //delete director in Bdd
        public function delDirectorInBd(int $id){
            $sql = "DELETE FROM director WHERE id_director = :id_director";
            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":id_director", $id, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
        
            // if query is executed, delete director
            if($result > 0 ){
                $director = $this->getDirectorById($id);
                unset($director);
            }
        }
    
        // edit director in Bdd
        public function editDirectorInBd($idPerson, $lastName, $firstName, $gender, $birthDate, $idDirector){
            try{
                $newIdPerson = filter_var($idPerson, FILTER_VALIDATE_INT);
                $newLastName = filter_var($lastName, FILTER_SANITIZE_SPECIAL_CHARS);
                $newFirstName = filter_var($firstName, FILTER_SANITIZE_SPECIAL_CHARS);
                $newGender = filter_var($gender, FILTER_SANITIZE_SPECIAL_CHARS);
                $newBirthDate =  DateTime::createFromFormat('Y-m-d', $birthDate ); // Create a new instance of the DateTime class from the given date of birth in 'Y-m-d' format.
                $formatNewBirthDate = $newBirthDate->format('Y-m-d'); //This code is converting a birthdate object into a string format of year-month-day.  
                $newIdDirector = filter_var($idDirector, FILTER_VALIDATE_INT);
            
                if ($newIdPerson === false || $newLastName === false || $newFirstName === false || $newGender === false || $newBirthDate === false || $newIdDirector === false){
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
                    $director = $this->getDirectorById($newIdDirector);
                    $director->setIdPerson($newIdPerson);
                    $director->setLastName($newLastName);
                    $director->setFirstName($newFirstName);
                    $director->setGender($newGender);
                    $director->setBirthDate($newBirthDate);
                }
            
            } catch (PDOException $e) {
                throw new Exception("Database error: " . $e->getMessage() .  " (edit failed in database)");
            }   
        }

        public function deleteDirectorInBd(int $id){

            $newId = filter_var($id, FILTER_VALIDATE_INT);

            $sql = "DELETE d, p
            FROM director d
            INNER JOIN person p ON p.id_person = d.id_person
            WHERE d.id_director = :id_director;";

            $stmt = $this->getBdd()->prepare($sql);
            $stmt->bindValue(":id_director", $newId, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if($result > 0 ){
                $director = $this->getDirectorById($newId);
                unset($director);
            }
        }

          
    }
        



    
?>