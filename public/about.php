<?php include_once "../src/include/header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>A propos | Mini-projet web</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="../src/css/app.css">
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <a id="title">Mini-projet web</a>
                    <a href="index.php">Accueil</a>
                    <a href="search.php">Rechercher</a>
                    <div class="nav_right">
                        <a href="about.php">A propos</a>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <div class="container">
                <h1>A propos du projet</h1>
                <p>Nous avons utilisé un dataset externe sur <a href="https://www.kaggle.com/stefanoleone992/imdb-extensive-dataset">Kaggle</a>.</p>
            </div>
        </main>
        <?php include_once "../src/include/footer.php"; ?>
    </body>
</html>