<?php

// Si un id est passé en paramètre et est valide (non vide)
if (isset($_GET["id"]) AND !empty($_GET["id"])){
    $id_acteur = $_GET["id"];

    // On importe une instance de PDO pour avoir accès à la base de données
    require "db.php";

    // On prépare la requête SQL
    $req = $conn->prepare("SELECT * FROM acteurs WHERE id_acteur = ?");
    // On exécute la requête SQL
    $req->execute([$id_acteur]);
    // On récupère le nombre d'acteurs correspondant à l'id passé en paramètre
    $nb_resultats = $req->rowCount();
    if ($nb_resultats >= 1){
        $acteur = $req->fetch();

        // On recherche dans quels films il a joué : (préparation de la requête)
        $req = $conn->prepare("SELECT films.id_film, films.titre_original FROM acteurs NATURAL JOIN roles NATURAL JOIN films WHERE acteurs.id_acteur = ?");
        // On exécute la requête SQL
        $req->execute([$id_acteur]);
        // On récupère les résultats de la requête
        $films = $req->fetchAll();

    }else{
        // Si aucun acteur ne correspond, on redirige vers la page de recherche
        header("Location: search.php");
        die();
    }
}else{
    // Si aucun id n'est renseigné, on redirige vers la page de recherche
    header("Location: search.php");
    die();
}
?>
<?php include_once "../src/include/header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $acteur["identite"] ?> | Acteur | Mini-projet web</title>
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
                <h1><?= $acteur["identite"] ?></h1>
                <p>
                    ◀ <a href="search.php">Retourner vers la page de recherche</a>
                </p>

                <p><b>Identité à la naissance</b> : <?= $acteur['identite_naissance'] ?></p>



                <table class="stats">
                    <tr>
                        <td colspan="3">Informations générales</td>
                    </tr>
                    <tr>
                        <td>Date de naissance</td>
                        <td>Date de décès (si décédé)</td>
                        <td>Taille</td>
                    </tr>
                    <tr>
                        <td><?= $acteur["date_naissance"] ?> (<?= $acteur["lieu_naissance"] ?>)</td>
                        <td><?= $acteur["date_mort"] ?>  (<?= $acteur["lieu_mort"] ?>)</td>
                        <td><?= $acteur['taille'] ?> cm</td>
                    </tr>
                </table>



                <h2>Films dans lesquels il/elle a joué</h2>
                <div id="films">
                    <ul>
                        <?php
                        // On parcourt les films de l'acteur
                        foreach ($films as $film){
                            echo "<li><a href='film.php?id=".$film['id_film']."'> ".$film['titre_original']."</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </main>
        <?php include_once "../src/include/footer.php"; ?>
    </body>
</html>
