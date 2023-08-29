
<?php

    session_start(); 

    // Constant URL that will allow access to all resources starting from the root of the site "absolute path"
    define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

    require_once "controllers/Movies.controller.php";
    require_once "controllers/Actors.controller.php";
    require_once "controllers/Directors.controller.php";
    require_once "controllers/Genres.controller.php";
    require_once "controllers/Castings.controller.php";

    $moviesController = new MoviesController;
    $actorsController = new ActorsController;
    $directorsController = new DirectorsController;
    $genresController = new GenresController;
    $castingsController = new CastingsController;

    try{
        // Setting up the router, send pages according to query string received by URL
        if (empty($_GET['page'])) {
            require "views/welcome.view.php";
        } else {
            $url = explode("/", filter_var($_GET['page'],FILTER_SANITIZE_URL)); // Decompose and filter the URL
            //differents view paths in relation to movies
            switch (($url[0])) {
                case "welcome":require "views/welcome.view.php";
                break;
                case "movies":
                    if(empty($url[1])){
                        $moviesController->showMovies();
                    } 
                    elseif($url[1] === "movie"){
                        $moviesController->showMovie($url[2]);
                        
                    } elseif($url[1] === "add"){
                        $moviesController->addMovie();
                    } 
                    elseif($url[1] === "edit"){
                        $moviesController->editMovie($url[2]);
                    } 
                    elseif($url[1] === "edit_validation"){
                        $moviesController->editMovieValidation();
                    }
                    elseif($url[1] === "del"){
                        $moviesController->delMovie($url[2]);
                    }
                    elseif($url[1] === "validate"){
                        $moviesController->validateMovie();
                    } 
                    else {
                        throw  new Exception("La page n'existe pas"); 
                    }
                break;
                     //differents view paths in relation to Actors
                case "actors": 
                    if(empty($url[1])){
                        $actorsController->showActors();
                    } 
                    elseif($url[1] === "actor"){
                        $actorsController->showActor($url[2]);
                    } elseif($url[1] === "add"){
                        $actorsController->addActor();
                    }
                    elseif($url[1] === "validate"){
                        $actorsController->validateActor();
                    } 
                    elseif($url[1] === "edit"){
                        $actorsController->editActor($url[2]);
                    } 
                    elseif($url[1] === "edit_validation"){
                        $actorsController->editActorValidation();
                    }
                    elseif($url[1] === "del"){
                        $actorsController->deleteActor($url[2]);
                    }
                    else {
                        throw  new Exception("La page n'existe pas"); 
                    }
                break;
                //differents view paths in relation to Directors
                case "directors": 
                    if(empty($url[1])){
                        $directorsController->showDirectors();
                    } 
                    elseif($url[1] === "director"){
                        $directorsController->showDirector($url[2]);
                    } 
                    elseif($url[1] === "add"){
                        $directorsController->addDirector();
                    }
                    elseif($url[1] === "validate"){
                        $directorsController->validateDirector();
                    }  
                    elseif($url[1] === "edit"){
                        $directorsController->editDirector($url[2]);
                    } 
                    elseif($url[1] === "edit_validation"){
                        $directorsController->editDirectorValidation();
                    }
                    elseif($url[1] === "del"){
                        $directorsController->deleteDirector($url[2]);
                    }
                    else {
                        throw  new Exception("La page n'existe pas"); 
                    }
                break;
                //differents view paths in relation to Genres //$GenresController->showGenre()
                case "genres": 
                    if(empty($url[1])){
                        $genresController->showGenres();
                    } elseif($url[1] === "add"){
                        echo "Add Genres";
                    } 
                    elseif($url[1] === "edit"){
                        echo "Edit Genres";
                    } 
                    elseif($url[1] === "edit_validation"){
                        echo "Genre edit validation";
                    }
                    elseif($url[1] === "del"){
                        echo "Deleting Genres";
                    }
                    elseif($url[1] === "validate"){
                        echo "Validating Genres";
                    } 
                    else {
                        throw  new Exception("La page n'existe pas"); 
                    }
                break;
                case "castings": 
                    if(empty($url[1])){
                        $castingsController->showCastings();
                    } elseif($url[1] === "add"){
                        echo "Castings added";
                    } 
                    elseif($url[1] === "edit"){
                        echo "Castings edited";
                    } 
                    elseif($url[1] === "edit_validation"){
                        echo "Casting validation failed";
                    }
                    elseif($url[1] === "del"){
                        echo "Castings deleted";
                    }
                    elseif($url[1] === "validate"){
                        echo "Castings validated";
                    } 
                    else {
                        throw  new Exception("La page n'existe pas"); 
                    }
                break;
                default : throw  new Exception("La page n'existe pas"); 
            }
        }
    }
    catch(Exception $e){
        $message = $e->getMessage();
        require "views/error.view.php";
    }
?>