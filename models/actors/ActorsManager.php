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
            $sql = $this->getBdd()->prepare("SELECT p.id_person, p.firstname, p.lastname,p.birth_date,p.gender, a.id_actor
            FROM actor a
            INNER JOIN person p ON a.id_person = p.id_person");

            $sql->execute();
            $myActors = $sql->fetchAll(PDO::FETCH_ASSOC); // PDO::FECT_ASSOC remove duplicates from query
            echo "<pre>";
            print_r($myActors);
            echo "<pre>";
            $sql->closeCursor(); //end the request to allow further requests
            // generate all actors 

            // Clear the existing actors array before loading new actors
            $this->_actors = [];

            foreach($myActors as $actor){
                $m = new Actor($actor['id_actor'],$actor['title'],$actor['duration'],$actor['release_date'],$actor['synopsy'],$actor['notation'],$actor['poster'],$actor['id_director']);
                $this->addActor($m); 
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



    }
?>