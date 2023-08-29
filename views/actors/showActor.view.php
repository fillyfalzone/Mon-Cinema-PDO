<?php
   ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-4 border p-3">
        <table>
            <tr>
                <th class="p-3">Firstname :</th>
                <td><span class="text-info"><?= $actor->getFirstName() ?></span></td>
            </tr>
            <tr>
                <th class="p-3">Lastname :</th>
                <td><span class="text-info"><?= $actor->getLastName() ?></span></td>
            </tr>
            <tr>
                <th class="p-3">Age :</th>
                <td><span class="text-info"><?= $actor->getAge() ?></span></td>
            </tr>
            <tr>
                <th class="p-3">Gender :</th>
                <td><span class="text-info"><?= $actor->getGender() ?></span></td>
            </tr>
            <tr>
                <th class="p-3">Filmography :</th>
                <td>    <?php if(!empty($movies)) : ?>
                            <?php foreach($movies as $index => $movie) : ?>
                                <?= $movie ?>
                                <?php if ($index < count($movies) - 1) : ?> 
                                    <br>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                </td>
            </tr>
            
        </table>
        

        
       
    </div>
</div>
 

<?php
    $content = ob_get_clean();
    $title = $actor->getName();
    require_once "views/template.php";
?>