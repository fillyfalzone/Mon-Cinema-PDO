<?php
   ob_start(); 
?>

    Page d'accueil. 

<?php
    $content = ob_get_clean();
    $title = "Welcome to Elan Cinema";
    require_once "template.php";
?>