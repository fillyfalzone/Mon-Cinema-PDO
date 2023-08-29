<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link css et script Bootswatch-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    
  

    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fuid">
            <!-- btn toogle navbar for small screen devices -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>welcome">Welcome</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>movies">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>actors">Actors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>directors">Directors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>genres">Genres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>castings">Castings</a>
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



 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    
    <footer class="rounded border border-dark py-3 mt-3 text-center text-white bg-dark">
        <small>2023 &copy; Cinema - Cinema by </small>
    </footer>
</body>
</html>