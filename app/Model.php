
<?php
    //create the abstract class model which cannot be instantiated, but only child classes will be instantiated
    abstract class Model{
        private static $pdo; // we define it in static so that it is accessible by all child classes

        //connection to database 
        private static function setBdd(){
            self::$pdo = new PDO("mysql:host=localhost;dbname=cinema-pdo-01;charset=utf8", "root", "" );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); //parameter element to manage errors
        }

        //coonection to database will be accesible  only from child classes
        protected function getBdd(){
            //test if we have not already a connection parametes. to have a single connection to the database
            if(self::$pdo === NULL){
                self::setBdd();
            }
            return self::$pdo;
        } 
    }
?>