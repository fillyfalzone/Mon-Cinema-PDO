<?php ob_start(); ?>
Actors

<?php
    $content = ob_get_clean();
    $title = "Actors";
    require_once "template.php";
?>