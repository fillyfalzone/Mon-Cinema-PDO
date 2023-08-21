<?php ob_start(); ?>


<?php
    $content = ob_get_clean();
    $title = "Genres";
    require_once "template.php";
    
?>