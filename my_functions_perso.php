<?php
  // To convert int to hours format ex: "2h30min"
  function intToHour($min) {
      $hours = floor($min / 60);
      $remindMin = $min % 60;
      if( $remindMin === 0){
        return $hours . "h ";
      } else{
        return $hours . "h " . $remindMin . "min";
      }
      
  }
?>

<!DOCTYPE html>
<html>
<head>
<style>
    .fenetre-flottante {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>
</head>
<body>

<a href="#" onmouseover="ouvrirFenetreFlottante()" onmouseout="fermerFenetreFlottante()">Survolez ce lien</a>

<div id="fenetreFlottante" class="fenetre-flottante">
    Contenu de la fenêtre flottante
</div>

<script>
    function ouvrirFenetreFlottante() {
        document.getElementById("fenetreFlottante").style.display = "block";
    }

    function fermerFenetreFlottante() {
        document.getElementById("fenetreFlottante").style.display = "none";
    }
</script>

</body>
</html>