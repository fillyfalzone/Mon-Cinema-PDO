<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>
<body class="">

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fuid">
            <!-- btn toogle navbar for small screen devices -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Welcome</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="movies.php">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="actors.php">Actors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="directors.php">Directors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="genders.php">Genres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="castings.php">Castings</a>
                    </li>
               
                    <li class="nav-item">
                        <a class="nav-link" href="details.php">Details</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
       <h1 class="rounded border border-dark p-2 m-2 text-center text-white bg-info"> <?= $title ?> </h1>
        <?= $content ?>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>