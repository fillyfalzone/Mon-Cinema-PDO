<?php 
    require_once "my_functions_perso.php";
    require_once "MoviesManager.class.php";


    ob_start(); // function is used to turn on, output buffering.
?>

    <table class="table text-center">
        <tr class="table-dark">
            <th>Poster</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Details</th>
            <th colspan="2">Actions</th>
        </tr> 
        <?php 
            $moviesManager = new MoviesManager;
            $moviesManager->loadMovies();
            $movies = $moviesManager->getMovie();
          
            for($i = 0; $i < count($movies); $i++) : 
        ?>
        <tr>
            <td class="align-middle"><img src="public/imgs/<?= $movies[$i]->getPoster() ?>" alt="poster <?= $movies[$i]->getTitle() ?>" class="poster"></td>
            <td class="align-middle"><?= $movies[$i]->getTitle() ?></td>
            <td class="align-middle"><?= intToHour($movies[$i]->getDuration())  ?></td>
            <td class="align-middle"><a href="" class="text-info">More</a></td>
            <td class="align-middle"><a href="#" class="btn btn-warning">Modifier</a></td>
            <td class="align-middle"><a href="#" class="btn btn-danger">Supprimer</a></td>
        </tr>
        <?php endfor; ?>
    </table>
    <a href="" class="btn btn-success d-block mb-5">Ajouter</a>

<?php
    $content = ob_get_clean(); // put buffer in $content variable 
    $title = "Movies list";
    require_once "template.php";
?>