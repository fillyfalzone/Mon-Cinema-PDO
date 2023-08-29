<?php
    ob_start(); ?>

<form method="POST" action="<?= URL ?>movies/edit_validation" enctype="multipart/form-data" class="col-md-10 mx-auto mb-3">
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
        <label for="title">Title : </label>
            <input type="text" id="title" class="form-control" placeholder="Title" aria-label="Title" name="title" value="<?= $movie->getTitle() ?>">
        </div>
    </div>

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
             <label for="duration">Duration in : Minutes </label>
            <input type="number" id="duration" step="1" min="1" class="form-control" placeholder="Duration" aria-label="Duration" name="duration" value="<?= $movie->getDuration()?>">
        </div>
    </div>

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
             <label for="release_date">Release Year: </label>
            <input type="number" id="release_date" step="1" min="1000" max="9999" class="form-control" placeholder="Release date" aria-label="Release date" name="release_date" value="<?= $movie->getReleaseDate() ?>">
        </div>
    </div>  

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
        <label for="notation">Notation : between 1 and 5 </label>
            <input type="number" id="notation" step="1" min="1" max="5"class="form-control" placeholder="Notation" aria-label="Notation" name="notation" value="<?= $movie->getNotation() ?>">
        </div>
    </div>
    
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
        <label for="director">Directed by : </label>
        <select name="id_director" id="director">
            <option value="">Select</option>
            <?php for($i =  0; $i < count($directors); $i++) :?>
            <option value="<?= $directors[$i]->getIdDirector(); ?>" >
            <?= $directors[$i]->getDirectorName(); ?>
            </option>
            <?php endfor?>
        </select> 
        </div>
    </div>
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <label for="synopsy">Synopsy : </label>
           <textarea name="synopsy" id="synopsy" cols="40" rows="3"><?= $movie->getSynopsy() ?></textarea>
        </div>
    </div>

    <div class="row m-1">
        <div class="form-group col-md-5 mx-auto m-3">
            <h3>Poster :</h3>
            <img src="<?= URL ?>public/imgs/<?= $movie->getPoster() ?>" alt="Poster de <?= $movie->getTitle() ?>" class="d-block m-2 img-fluid"  style="max-width: 40%;">
            <label for="poster">Change poster : </label>
            <input type="file" class="form-control-file" id="poster" name="poster">
        </div>
    </div>

    <div class="row m-1">
        <input type="hidden" name="id_movie" value="<?= $movie->getIdMovie() ?>"> <!-- I'm using this input to send idMovie by post method -->
        <button type="submit" class="btn btn-primary col-md-2 mx-auto d-block ">Validate</button>
    </div>
</form>

<?php
    $content = ob_get_clean();
    $title = "movie edit : ".$movie->getTitle();
    require_once "views/template.php";
?>