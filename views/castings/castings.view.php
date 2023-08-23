<?php ob_start(); ?>
 

<?php
    $content = ob_get_clean();
    $title = "Casting of Movie";
    require_once "template.php";
?>