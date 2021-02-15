<?php include_once "../src/include/header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Accueil | Mini-projet web</title>
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
                <h1>Bienvenue sur notre annuaire de films</h1>

                <p>
                    Ce site s'inscrit dans le cadre de la réalisation d'un mini-projet de développement web.
                </p>

                <p>
                    Le principe de ce projet est simple : nous avons souhaité recréer un annuaire regroupant les données de plusieurs films et acteurs.
                </p>
                <p>
                    L'utilisateur peut donc, en cliquant sur le bouton ci-dessous, accèder à un moteur de recherche qui lui suggérera des résultats parmi ceux de notre base de données.
                </p>
                <p>
                    Il peut, en plus de visualiser les informations, attribuer une note aux films qu'il souhaite évaluer.
                </p>
                <div id="center">
                    <a id="start" href="search.php">Rechercher un film, un acteur, ...</a>
                </div>

                <p>Bonne recherche !</p>

                <p><i>Remarque</i> : Si vous souhaitez avoir plus d'informations sur le développement de notre projet, veuillez consulter la page <b>A propos</b></p>

            </div>
        </main>
        <?php include_once "../src/include/footer.php"; ?>
    </body>
</html>