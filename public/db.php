<?php
/*
 * DEFINITION DES CONSTANTES POUR LA CONNEXION À LA BASE DE DONNEES
 */
define("DB_NAME", "");       // A remplacer par le nom de votre base de donnée
define("DB_HOST", "pgsql");
define("DB_PORT", "5432");
define("DB_USERNAME", "");   // A remplacer par votre username
define("DB_PASSWORD", "");          // A remplacer par votre password

/*
 *              AVERTISSEMENT
 *
 *  Il faut impérativement remplir les 5 premières constantes.
 *  Si la configuration n'est pas correcte, un message sera renvoyé et
 *  la suite du script sera ignoré.
 *
 */

/*
 *              AVERTISSEMENT
 *
 *  Il est également important d'exécuter le fichier fill.sql afin d'avoir
 *  une structure de base de données valide
 *
 */


if (DB_NAME === "" or DB_HOST === "" or DB_PORT === "" or DB_USERNAME === "" or DB_PASSWORD === ""){
    // Si une information est manquante pour tenter une connexion

    // Affichage d'un message d'erreur
    echo "<b>ERREUR : La connexion à la base de donnée n'est pas correctement configuré.</b>";

    // On ignore la suite du script
    die();
}else{
    // Tentative de connexion
    $conn = new PDO("pgsql:dbname=".DB_NAME.";host=".DB_HOST.";port=".DB_PORT, DB_USERNAME, DB_PASSWORD);
}
