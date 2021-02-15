<?php

// Si un id est passé en paramètre via la méthode GET (et id valide)
if (isset($_GET["id"]) AND !empty($_GET["id"])){
    $id_film = $_GET["id"];

    // On importe une instance de PDO pour se connecter à la base de données
    require "db.php";

    // On prépare la requête SQL
    $req = $conn->prepare("SELECT * FROM films WHERE id_film = ?");

    // On exécute la requête SQL
    $req->execute([$id_film]);

    // On récupère le nombre de tuples de la requête SQL
    $nb_resultats = $req->rowCount();
    if ($nb_resultats >= 1){ // Si un film ayant cet ID est présent
        $film = $req->fetch(); // On récupère les données

        // Recherche des personnes (acteurs et actrices) liés à ce film
        $req = $conn->prepare("SELECT id_acteur, identite, category  FROM films NATURAL JOIN roles NATURAL JOIN acteurs WHERE films.id_film = ? AND category IN ('actress', 'actor')");
        $req->execute([$id_film]);
        $personnes = $req->fetchAll(); // On récupère les acteurs et actrices
        $nb_acteurs = $req->rowCount(); // On récupère le nombre d'acteurs et d'actrices

        // Recherche des votes liés à ce film
        $req = $conn->prepare("SELECT firstname, lastname, vote FROM votes WHERE id_film = ?");
        $req->execute([$id_film]);
        $votes = $req->fetchAll(); // On récupère les votes liés à ce film


    }else{
        // Si l'ID passé en paramètre ne correspond à aucun film présent dans la base de données
        // On redirige vers la page de recherche
        header("Location: search.php");
        die(); // On ignore la suite du script
    }

    /*
     * La suite du script concerne le traitement de l'insertion de nouveaux votes
     */
    // Si des données sont envoyées via la méthode POST
    if ($_POST){
        // Si le formulaire est rempli correctement
        if (isset($_POST['firstname'], $_POST['lastname'], $_POST['vote']) AND !empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['vote'])){
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $vote = $_POST['vote'];

            // On prépare la requête d'insertion dans la table Votes
            $req = $conn->prepare("INSERT INTO votes (id_film,firstname,lastname,vote) VALUES (?, ?, ?, ?)");

            // On exécute la requête d'insertion en indiquant les valeurs constituants le tuple
            $req->execute([$id_film, $firstname, $lastname, $vote]);
            $msg = "Vote envoyé avec succès !";

            // Recherche des votes liés à ce film :

            $req = $conn->prepare("SELECT firstname, lastname, vote FROM votes WHERE id_film = ?");
            $req->execute([$id_film]);
            $votes = $req->fetchAll(); // On récupère tous les votes concernant ce film
        }
    }
}else{
    // Si aucun id n'est renseigné, on redirige vers la page de recherche
    header("Location: search.php");
    die(); // On ignore la suite du script
}
/*
 * Calcul des statistiques pour la partie sur les votes
 */
$avg_vote = "-"; // Moyenne des votes pour le film
$nb_votes = $req->rowCount(); // Nombre de votes pour le film
$somme = 0;
foreach ($votes as $vote){
    $somme += intval($vote['vote']);
}
$avg_vote = number_format($somme/$nb_votes, 1, '.', ''); // Moyenne des votes pour le film
?>
<?php include_once "../src/include/header.php"; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $film["titre_original"] ?> | Film | Mini-projet web</title>
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
                <h1><?= $film["titre_original"] ?></h1>
                <p>
                    ◀ <a href="search.php">Retourner vers la page de recherche</a>
                </p>
                <div>
                    <table class="stats">
                        <tr>
                            <td colspan="5">Informations générales</td>
                        </tr>
                        <tr>
                            <td>Date de sortie</td>
                            <td>Durée</td>
                            <td>Genre</td>
                            <td>Pays</td>
                            <td>Langue</td>
                        </tr>
                        <tr>
                            <td><?= $film['annee_sortie'] ?> (<?= $film['date_sortie'] ?>)</td>
                            <td><?= $film['duree'] ?> minutes</td>
                            <td><?= $film['genre'] ?></td>
                            <td><?= $film["pays"] ?></td>
                            <td><?= $film['langue'] ?></td>
                        </tr>
                    </table>
                </div>


                <table class="stats">
                    <tr>
                        <td colspan="3">
                            Equipe de production
                        </td>
                    </tr>
                    <tr>
                        <td>Réalisateur</td>
                        <td>Scénariste</td>
                        <td>Société(s) de production/distribution</td>
                    </tr>
                    <tr>
                        <td><?= $film['realisateur'] ?></td>
                        <td><?= $film['scenariste'] ?></td>
                        <td><?= $film['societe_prod'] ?></td>
                    </tr>
                </table>

                <table class="stats">
                    <tr>
                        <td colspan="3">
                            Statistiques
                        </td>
                    </tr>
                    <tr>
                        <td>Budget de production</td>
                        <td>Recettes (pays d'origine)</td>
                        <td>Recettes (monde)</td>
                    </tr>
                    <tr>
                        <td><?= $film['budget'] ?></td>
                        <td><?= $film['boxoffice'] ?></td>
                        <td><?= $film['boxoffice2'] ?></td>
                    </tr>
                </table>

                <table class="stats">
                    <tr>
                        <td>Résumé du film</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><?= $film['description'] ?></td>
                    </tr>
                </table>


                <table class="stats">
                    <tr>
                        <td colspan="<?= $nb_acteurs ?>">Acteurs/Actrices</td>
                    </tr>
                    <tr>
                        <?php
                        // On parcours les acteurs
                        foreach ($personnes as $individu){
                            echo "<td><img src='../src/img/avatar.png' width='100px' alt='".$individu['identite']."' title='".$individu['identite']."'></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        // On parcours les acteurs
                        foreach ($personnes as $individu){
                            echo "<td><a href='people.php?id=".$individu['id_acteur']."'> ".$individu['identite']."</a><br>(".$individu['category'].")</td>";
                        }
                        ?>
                    </tr>
                </table>


                <h2>Votes</h2>


                <div id="center">
                    Nombre de votes : <span id="vote_nb"><?= $nb_votes ?></span> | Moyenne des votes : <span id="vote_avg"><?= $avg_vote ?></span>/10

                    <div id="progress-bar">
                        <div id="progress-level" style="width: <?= $avg_vote*10 ?>%;"></div>
                    </div>
                </div>
                <ul>
                    <?php /* Affichage des votes
                    foreach ($votes as $vote){
                        echo "<li>".$vote['firstname']." ".$vote['lastname']." (".$vote['vote'].")</li>";
                    }*/
                    ?>
                </ul>

                <p>Pour voter pour ce film, vous pouvez remplir ce formulaire : </p>
                <form method="POST" id="vote_form" onsubmit="return checkInputs();">
                    <p id="vote_form_msg"><?= $msg ?></p>
                    <div id="center">
                        <input type="text" id="vote_firstname" name="firstname" placeholder="Prénom">
                        <input type="text" id="vote_lastname" name="lastname" placeholder="Nom">
                        <br>
                        <input type="range" id="vote" name="vote" min="1" max="10" step="0.5" oninput="showVal(this.value)" onchange="showVal(this.value)" onload="showVal(this.value)">
                        <br>
                        <p>Note attribuée : <span id="vote_value">-</span> / 10</p>
                        <br>
                        <input type="submit" value="Voter !">
                    </div>
                </form>
            </div>
        </main>
        <?php include_once "../src/include/footer.php"; ?>
        <script src="../src/js/app.js"></script>
    </body>
</html>