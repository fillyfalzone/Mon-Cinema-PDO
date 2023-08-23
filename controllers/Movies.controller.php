<?php
    require_once "models/movies/MoviesManager.class.php";
    require_once "MyFunctionsPerso.class.php";
    

    class MoviesController {
        private $_moviesManager;
        private $_addPoster; 

        public function __construct(){
            $this->_moviesManager = new MoviesManager; //instantiate the movie manager
            $this->_moviesManager->loadMovies(); //load movies of Bdd in controller property  
        }

        public function showMovies(){
            $movies = $this->_moviesManager->getMovies(); // assign the loaded movies to the $movies variable which will be used in the view
            require "views/movies/movies.view.php";
            unset($_SESSION['alert']); // clear the alert session.
        }

        public function showMovie(int $id){
            $movie = $this->_moviesManager->getMovieById($id);
            require "views/movies/showMovie.view.php"; 
        }
        // Add movie in view
        public function addMovie(){
            require "views/movies/addMovie.view.php";
        }
        // validete Add movie in Bdd
        public function validateMovie(){
            $duration = (int)$_POST['duration']; // convert to int
            $release_date = (int)$_POST['release_date']; // convert to int
            $id_director = (int)$_POST['id_director'];// convert to int

            $this->_addPoster = new FunctionPerso; // this Class come from my function perso to 

            $file = $_FILES['poster'];
            $directory = "public/imgs/";
            $namePosterAdd = $this->_addPoster->addPoster($file, $directory ); //add poster in directory
            // call addMovieInBd method with right datas
            $this->_moviesManager->addMovieInBd($_POST['title'], $duration, $release_date, $_POST['notation'], $_POST['synopsy'], $_POST['poster'], $id_director);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Added successfully'
            ];

            //redirection to movies list page 
            header('location: '. URL .'movies');
        }

        //Delete movie in Bdd
        public function delMovie(int $id){
            //delete poster in directory
            $namePoster = $this->_moviesManager->getMovieById($id)->getPoster();
            unlink("public/imgs/".$namePoster);

            //delete movie in Bd
            $this->_moviesManager->delMovieInBd($id);
             //redirection to movies list page 

             $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully deleted'
            ];

             header('location: '. URL .'movies');

        }
        // Edit movie
        public function editMovie(int $id){
            $movie = $this->_moviesManager->getMovieById($id);
            require "views/movies/editMovie.view.php";

        }
        //Validate edit movie
        public function editMovieValidation(){

            $id_movie = (int)$_POST['id_movie']; // convert to int
            $duration = (int)$_POST['duration']; // convert to int
            $release_date = (int)$_POST['release_date']; // convert to int
            $id_director = (int)$_POST['id_director'];// convert to int

             $this->_addPoster = new FunctionPerso;

            // Call current poste and effect to variable
            $currentPoster = $this->_moviesManager->getMovieById($id_movie)->getPoster();
            //we will check if a new image has been submitted in the form
            $file = $_FILES['poster']; 

            if($file['size'] !== null){
                //delete current poster 
                unlink("public/imgs/".$currentPoster);
                //add new poster
                $directory = "public/imgs/";
                $newPosterAdd = $this->_addPoster->addPoster($file, $directory );

            } else {
                $newPosterAdd = $currentPoster;
            }

            //Call model class movies manager 
            $this->_moviesManager->editMovieInBd( $id_movie, $_POST['title'], $duration, $release_date, $_POST['notation'], $_POST['synopsy'], $_POST['poster'], $id_director);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully edited'
            ];

            header('location: '. URL .'movies');
        }
        
    }
?>