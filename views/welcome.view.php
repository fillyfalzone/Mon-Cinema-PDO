<?php
   ob_start(); 
?>
    <h2 class=" rounded border border-dark p-2 m-2 text-center textblack bg-warning col-8 mx-auto" >Our TOP 5</h2>
    <div id="carouselExampleRide" class="carousel slide w-50 mx-auto" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/imgs/mi2.jpg" class="d-block w-100" alt="Mission Impossible 2">
            </div>
            <div class="carousel-item">
                <img src="public/imgs/titanic.jpg" class="d-block w-100" alt="Titanic">
            </div>
            <div class="carousel-item">
                <img src="public/imgs/atlantis.jpg" class="d-block w-100" alt="The Secrets of Atlantis">
            </div>
            <div class="carousel-item">
                <img src="public/imgs/fury.jpg" class="d-block w-100" alt="Fury">
            </div>
            <div class="carousel-item">
                <img src="public/imgs/voyage.jpg" class="d-block w-100" alt="The Last Voyage">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?php
    $content = ob_get_clean();
    $title = "Welcome to Elan Cinema";
    require_once "template.php";
?>