<?php ob_start(); ?>
    
    <?=  $message ?>

<?php
    $content = ob_get_clean();
    $title = "Error !!!";
    require_once "template.php";
?>