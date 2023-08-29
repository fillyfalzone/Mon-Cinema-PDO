<?php 
    ob_start();
    //This code checks if the 'alert' session variable is not empty. If so, it displays an alert message in a div
    if(!empty($_SESSION['alert'])){ ?>
        <div class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
            <?= $_SESSION['alert']['message'] ?>
        </div>
<?php } ?>

<table class="table text-center">
        <tr class="table-dark">
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>filmography</th>
            <th colspan="2">Actions</th>
        </tr> 
        <?php 
              
            for($i = 0; $i < count($actors); $i++) : 
        ?>
        <tr>
            <td class="align-middle"><?= $actors[$i]->getName() ?> </td>

            <td class="align-middle"><?= $actors[$i]->getAge() ?></td>

            <td class="align-middle"><?= $actors[$i]->getGender() ?></td>

            <td class="align-middle"><a href="<?= URL ?>actors/actor/<?= $actors[$i]->getIdActor() ?>" class="text-info">More</a></td>

            <td class="align-middle"><a href="<?= URL ?>actors/edit/<?= $actors[$i]->getIdActor() ?>" class="btn btn-warning">Modify</a></td>
            
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>actors/del/<?= $actors[$i]->getIdActor() ?>" onSubmit="return confirm('Confirm actor deletion?');">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>  
        </tr>
        <?php endfor; ?>
    </table>
    <a href="<?= URL ?>actors/add/" class="btn btn-success d-block mb-5">Add actor</a>
    
<?php
    $content = ob_get_clean();
    $title = "Actors List";
    require_once "./views/template.php";
?>