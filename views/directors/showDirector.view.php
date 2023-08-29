<?php
   ob_start(); 
?>

<div class="row justify-content-center">
    <div class="col-4 border p-3">
        <p>Firstname : <span class="text-info"><?= $director->getFirstName() ?></span></p>
        <p>Lastname :  <span class="text-info"><?= $director->getLastName() ?></span></p>
        <p>Age :  <span class="text-info"><?= $director->getAge() ?></span></p>
        <p>Gender :  <span class="text-info"><?= $director->getGender() ?></span></p>
        <p>Played movies :</p>
        <p>Filmography :</p>
    </div>
</div>
 

<?php
    $content = ob_get_clean();
    $title = $director->getName();
    require_once "views/template.php";
?>