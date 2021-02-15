
# Mini Projet Web

ENSIIE - 1A - Semestre 2

## Informations générales

Groupe 16
- Khalil BATTIKH
- Lucas RODRIGUEZ
- Avraham ROSENBERG

Pour nous contacter, veuillez nous envoyer un email à `prenom.nom@ensiie.fr`

---

## Arboresence du projet

```
├── README.md
├── data
│   ├── acteurs.csv
│   ├── fill.sql
│   ├── films.csv
│   └── roles.csv
├── public
│   ├── about.php
│   ├── db.php
│   ├── film.php
│   ├── gethint.php
│   ├── index.php
│   ├── people.php
│   └── search.php
└── src
    ├── css
    │   └── app.css
    ├── img
    │   └── avatar.png
    ├── include
    │   ├── footer.php
    │   └── header.php
    └── js
        └── app.js
```

---
 

## Données utilisées

Nous avons utilisé le dataset suivant : (lien Kaggle)
https://www.kaggle.com/stefanoleone992/imdb-extensive-dataset

Nous avons traité ce dataset pour réduire sa taille de 219 Mo à moins de 4 Mo.

---
## Protocle de configuration 

Afin de configurer votre environnement de manière optimale, veuillez suivre le protocole suivant :

0. De-zipper l'archive du projet dans le répertoire `/public_html`
1. Ouvrir le fichier `db.php` au sein du répertoire `/public`
2. Renseigner les constantes `DB_USERNAME`, `DB_PASSWORD`et `DB_NAME` avec vos informations
3. Enregistrer le fichier
4. Ouvrir une fennêtre de commande
5. Se placer dans le répertoire `/data`
6. Ouvrir une session PostgreSQL dans votre shell
7. Exécuter `\i fill.sql`
8. Fermer votre terminal
9. Ouvrir votre navigateur Internet
10. Aller sur `https://pgsql.pedago.ensiie.fr/~prenom.nom/`



Bonne recherche
