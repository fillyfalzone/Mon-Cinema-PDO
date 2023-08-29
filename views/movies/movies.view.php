<?php 
    require_once "MyFunctionsPerso.class.php";
    $intToHour = new FunctionPerso;
    ob_start(); // function is used to turn on, output buffering.
    //This code checks if the 'alert' session variable is not empty. If so, it displays an alert message in a div
    if(!empty($_SESSION['alert'])){ ?>
        <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
            <?= $_SESSION['alert']['message'] ?>
        </div>
<?php } ?>


    <table class="table text-center">
        <tr class="table-dark">
            <th>Poster</th>
            <th>Title</th>
            <th>Duration</th>
            <th>Details</th>
            <th colspan="2">Actions</th>
        </tr> 
        <?php 
              
            for($i = 0; $i < count($movies); $i++) : 
        ?>
        <tr>
            <td class="align-middle"><img src="public/imgs/<?= $movies[$i]->getPoster() ?>" alt="poster <?= $movies[$i]->getTitle() ?>" class="poster"></td>
            <td class="align-middle"><?= $movies[$i]->getTitle() ?></td>
            <td class="align-middle"><?= $intToHour->intToHour($movies[$i]->getDuration())  ?></td>
            <td class="align-middle"><a href="<?= URL ?>movies/movie/<?= $movies[$i]->getIdMovie() ?>" class="text-info">More</a></td>
            <td class="align-middle"><a href="<?= URL ?>movies/edit/<?= $movies[$i]->getIdMovie() ?>" class="btn btn-warning">Modify</a></td>
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>movies/del/<?= $movies[$i]->getIdMovie() ?>" onSubmit="return confirm('Confirm movie deletion?');">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            
        </tr>
        <?php endfor; ?>
    </table>
    <a href="<?= URL ?>movies/add/" class="btn btn-success d-block mb-5">Add movie</a>

<?php
    $content = ob_get_clean(); // put buffer in $content variable 
    $title = "Movies list";
    require_once "views/template.php";
?>