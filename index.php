
<?php

    session_start(); 

    // Constant URL that will allow access to all resources starting from the root of the site "absolute path"
    define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

    require_once "controllers/Movies.controller.php";

    $moviesController = new MoviesController;

    try{
        // Setting up the router, send pages according to query string received by URL
        if (empty($_GET['page'])) {
            require "views/welcome.view.php";
        } else {
            $url = explode("/", filter_var($_GET['page'],FILTER_SANITIZE_URL)); // Decompose and filter the URL
        
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
                default : throw  new Exception("La page n'existe pas"); 
            }
        }
    }
    catch(Exception $e){
        $message = $e->getMessage();
        require "views/error.view.php";
    }
?>