<?php
   ob_start(); 
?>

<form method="POST" action="<?= URL ?>movies/validate" enctype="multipart/form-data" class="col-md-10 mx-auto">
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <input type="text" class="form-control" placeholder="Title" aria-label="Title" name="title">
        </div>
    </div>

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <input type="number" step="1" min="1" class="form-control" placeholder="Duration" aria-label="Duration" name="duration">
        </div>
    </div>

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <input type="number" step="1" min="1000" max="9999" class="form-control" placeholder="Release date" aria-label="Release date" name="release_date">
        </div>
    </div>  

    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <input type="number" step="1" min="0" max="5"class="form-control" placeholder="Notation" aria-label="Notation" name="notation">
        </div>
    </div>
    
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
        <label for="director">Directed by : </label>
        <select name="director" id="director">
            <option value="">Select</option>
            <option value="5" >Director</option> <!-- "id_director" loop for to insert all id_directors here-->
        </select> 
        </div>
    </div>
    <div class="row m-1">
        <div class="col-md-5 mx-auto">
            <label for="synopsy">Synopsy : </label>
           <textarea name="synopsy" id="synopsy" cols="40" rows="3"></textarea>
        </div>
    </div>

    <div class="row m-1">
        <div class="form-group col-md-5 mx-auto m-3">
            <label for="poster">Poster : </label>
            <input type="file" class="form-control-file" id="poster" name="poster">
        </div>
    </div>

    <div class="row m-1">
        <button type="submit" class="btn btn-primary col-md-2 mx-auto d-block ">Validate</button>
    </div>
</form>

<?php
    $content = ob_get_clean();
    $title = "Add movie";
    require_once "views/template.php";
?>