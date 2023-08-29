<?php
     require_once "MyFunctionsPerso.class.php";
     $intToHour = new FunctionPerso;
    
   ob_start(); 
?>

<div class="row">
    <div class="col-6 text-center"> 
        <img src="<?= URL ?>/public/imgs/<?= $movie->getPoster()?>" alt="Poster de <?= $movie->getTitle() ?>" class="img-fluid" style="width: 200px;">
    </div>

    <div class="col-6">
        <p>Title : <?= $movie->getTitle() ?> </p>
        <p>Duration : <?= $intToHour->intToHour($movie->getDuration()) ?> </p>
        <p>Release date : <?= $movie->getReleaseDate() ?> </p>
        <p>Notation : <?= $movie->getNotation() ?> </p>
        <p>Realized by : <?= $directorName ?> </p>
        <p>Synopsy : <?= $movie->getSynopsy() ?>  </p>
    </div>
</div> 

<?php
    $content = ob_get_clean();
    $title = $movie->getTitle();
    require_once "views/template.php";
?>