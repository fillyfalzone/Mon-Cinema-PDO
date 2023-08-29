
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
              
            for($i = 0; $i < count($directors); $i++) : 
        ?>
        <tr>
            <td class="align-middle"><?= $directors[$i]->getfirstName()." ".$directors[$i]->getLastName() ?> </td>
            <td class="align-middle"><?= $directors[$i]->getAge() ?></td>
            <td class="align-middle"><?= $directors[$i]->getGender() ?></td>
            <td class="align-middle"><a href="<?= URL ?>directors/director/<?= $directors[$i]->getIdDirector() ?>" class="text-info">More</a></td>
            <td class="align-middle"><a href="<?= URL ?>directors/edit/<?= $directors[$i]->getIdDirector() ?>" class="btn btn-warning">Modify</a></td>
            <td class="align-middle">
                <form method="POST" action="<?= URL ?>directors/del/<?= $directors[$i]->getIdDirector() ?>" onSubmit="return confirm('Confirm director deletion?');">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>  
        </tr>
        <?php endfor; ?>
    </table>
    <a href="<?= URL ?>directors/add/" class="btn btn-success d-block mb-5">Add director</a>
    
<?php
    $content = ob_get_clean();
    $title = "Directors List";
    require_once "./views/template.php";
?>
