<?php ob_start(); ?>
    

<?php
    $content = ob_get_clean();
    $title = "Details";
    require_once "template.php";
?>