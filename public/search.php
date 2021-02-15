<?php include_once "../src/include/header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Recherche | Mini-projet web</title>
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
                <h1>Recherche de films ou d'acteurs</h1>
                <p>Vous pouvez rechercher parmi tous les films produits durant la dernière décennie (de 2010 à 2020).</p>

                <form id="search" oninput="showHint(document.getElementById('q').value, document.getElementById('annee').value);">
                    <input type="text"
                           id="q"
                           name="q"
                           autofocus
                           autocomplete="off"
                           placeholder="Recherchez un film, un acteur, ...">

                    <select name="a" id="annee">
                        <option selected value="-">Année de sortie</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>

                    <!--<input type="submit" value="Rechercher">-->
                </form>

                <p>Suggestion de films et d'acteurs : </p>
                <div id="txtHint"></div>
            </div>
        </main>

        <?php include_once "../src/include/footer.php"; ?>
        <script src="../src/js/app.js"></script>
    </body>
</html>