<?php

// On inclut le fichier pour avoir accès à la base de données.
require_once "db.php";


// Si le paramètre q (élément de recherche), passé en méthode GET est défini et valide (non nul)
if (isset($_GET['q']) AND !empty($_GET['q'])){
    // Si le paramètre a (année de sortie recherchée), passé en méthode GET est défini et valide (non nul)
    if (isset($_GET['a']) AND !empty($_GET['a'])){
        $annee = $_GET['a'];

        // Préparation de la requête SQL
        $result = $conn->prepare("SELECT id_film, titre_original, annee_sortie, genre, duree FROM films WHERE LOWER(titre_original) LIKE '%".strtolower($_GET['q'])."%' AND annee_sortie = ? order by titre_original LIMIT 50");

        // Exécution de la requête SQL
        $result->execute([$annee]);
    }else{
        // Si aucune année de sortie n'est donné, on recherche juste les titres de films qui correspondent au paramètre q
        $result = $conn->query("SELECT id_film, titre_original, annee_sortie, genre, duree FROM films WHERE LOWER(titre_original) LIKE '%".strtolower($_GET['q'])."%' order by titre_original LIMIT 50");
    }
    // On recherche également les noms des acteurs qui correspondent au paramètre q
    $result2 = $conn->query("SELECT id_acteur, identite FROM acteurs WHERE LOWER(identite) LIKE '%".strtolower($_GET['q'])."%' order by identite LIMIT 50");

    /*
     * On affiche de manière stylisé (sous forme de tableaux) les résultats
     */

    // On affiche le header du tableau
    echo "<div class='row'>
    <div class='column'>
        <table class='suggest'>
            <tr>
                <td>Titre</td>
                <td>Année</td>
                <td>Genre</td>
                <td>Durée</td>
            </tr>";
    // On parcourt le résultat de la requête sur la table Film et on affiche un résultat par ligne
    while($r = $result->fetch()) {
        echo "<tr>
<td><a class='list_li' href='film.php?id=".$r['id_film']."'>".$r['titre_original']."</a></td>
<td>".$r['annee_sortie']."</td>
<td>".$r['genre']."</td>
<td>".$r['duree']."</td>
</tr>";

    }
    // On affiche la fin du tableau
    echo "</table>
    </div>";


    /*
     * On affiche de manière stylisé (sous forme de tableaux) les résultats
     */
    // On affiche le header du tableau
    echo "    <div class='column'>
        <table class='suggest'>
            <tr>
                <td>Identité de l'acteur</td>
            </tr>";

    // On parcourt le résultat de la requête sur la table Acteurs et on affiche un résultat par ligne
    while($r2 = $result2->fetch()) {
        echo "<tr>
<td><a class='list_li' href='people.php?id=" .$r2['id_acteur']."'>".$r2['identite']."</a></td>
</tr>";
    }
    // On affiche la fin du tableau
    echo "</table>
    </div>
</div>";

    // Si aucun paramètre n'est donné, on ne fait rien
}else{
    echo "ERREUR : paramètre 'q' non valide. (pas de suggestion)";
}
?>