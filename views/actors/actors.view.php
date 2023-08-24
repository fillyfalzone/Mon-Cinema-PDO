<?php ob_start(); ?>

<table class="table text-center">
        <tr class="table-dark">
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Age</th>
            <th>Gender</th>
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
    <a href="<?= URL ?>movies/add" class="btn btn-success d-block mb-5">Add movie</a>
    
<?php
    $content = ob_get_clean();
    $title = "Actors List";
    require_once "template.php";
?>