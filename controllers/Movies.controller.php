<?php
    require_once "models/movies/MoviesManager.php";
    require_once "models/directors/DirectorsManager.php";
    require_once "Directors.controller.php";
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

            $directorName = $this->_moviesManager->getNameDirectorByIdMovie($id);
            require "views/movies/showMovie.view.php"; 
        }
        // Add movie in view
        public function addMovie(){
            $directorsManager = new DirectorsManager;
            $directorsManager->loadDirectors();
            $directors = $directorsManager->getDirectors();
            require "views/movies/addMovie.view.php";
        }
        // validete Add movie in Bdd
        public function validateMovie(){
            if(isset($_POST['title']) && isset($_POST['duration']) && isset($_POST['release_date']) && isset($_POST['synopsy']) && isset($_POST['notation']) && isset($_FILES['poster']) && isset($_POST['id_director'])){

                $duration = (int)$_POST['duration']; // convert to int
                $release_date = (int)$_POST['release_date']; // convert to int
                $id_director = (int)$_POST['id_director'];// convert to int

                $this->_addPoster = new FunctionPerso; // this Class come from my function perso to 

                $file = $_FILES['poster'];
                $directory = "public/imgs/";
                $namePosterAdd = $this->_addPoster->addPoster($file, $directory ); //add poster in directory
                // call addMovieInBd method with right datas
                $this->_moviesManager->addMovieInBd($_POST['title'], $duration, $release_date, $_POST['notation'], $_POST['synopsy'], $namePosterAdd, $id_director);


                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Added successfully'
                ];
            }
            else {
                $_SESSION['alert'] = [
                    'type' => 'danger',
                    'message' => 'add failed'
                ];
            }
            

            //redirection to movies list page 
            header('location: '. URL .'movies');
        }

        //Delete movie in Bdd
        public function delMovie(int $id){
            //delete poster in directory
            $namePoster = $this->_moviesManager->getMovieById($id)->getPoster();
            echo $namePoster;
            unlink("public/imgs/".$namePoster);

            //delete movie in Bd
            $this->_moviesManager->delMovieInBd($id);
             
            //alert session 
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully deleted'
            ];
            //redirection to movies list page 
            header('location: '. URL .'movies');

        }
        // Edit movie
        public function editMovie(int $id){
            $movie = $this->_moviesManager->getMovieById($id);

            $directorsManager = new DirectorsManager;
            $directorsManager->loadDirectors();
            $directors = $directorsManager->getDirectors();
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
            echo $currentPoster; 
            //we will check if a new image has been submitted in the form
            $file = $_FILES["poster"]; 

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
            $this->_moviesManager->editMovieInBd( $id_movie, $_POST['title'], $duration, $release_date, $_POST['notation'], $_POST['synopsy'], $newPosterAdd, $id_director);

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'successfully edited'
            ];

            header('location: '. URL .'movies');
        }
        
    }
?>