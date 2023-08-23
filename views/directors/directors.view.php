<?php ob_start(); ?>
Directors

<?php
    $content = ob_get_clean();
    $title = "Directors list";
    require_once "template.php";
?>