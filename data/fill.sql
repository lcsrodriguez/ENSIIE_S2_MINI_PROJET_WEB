-- Création de la table Films
CREATE TABLE IF NOT EXISTS films(
                                    id_film VARCHAR PRIMARY KEY,
                                    titre VARCHAR,
                                    titre_original VARCHAR,
                                    annee_sortie VARCHAR,
                                    date_sortie VARCHAR,
                                    genre VARCHAR,
                                    duree VARCHAR,
                                    pays VARCHAR,
                                    langue VARCHAR,
                                    realisateur VARCHAR,
                                    scenariste VARCHAR,
                                    societe_prod VARCHAR,
                                    acteurs VARCHAR,
                                    description VARCHAR,
                                    budget VARCHAR,
                                    boxoffice VARCHAR,
                                    boxoffice2 VARCHAR

);

-- Création de la table Acteurs
CREATE TABLE IF NOT EXISTS acteurs(
                                      id_acteur VARCHAR PRIMARY KEY,
                                      identite VARCHAR,
                                      identite_naissance VARCHAR,
                                      taille VARCHAR,
                                      naissance_details VARCHAR,
                                      date_naissance VARCHAR,
                                      lieu_naissance VARCHAR,
                                      date_mort VARCHAR,
                                      lieu_mort VARCHAR
);

-- Création de la table Roles
CREATE TABLE IF NOT EXISTS roles(
                                    id_film VARCHAR,
                                    id VARCHAR,
                                    id_acteur VARCHAR,
                                    category VARCHAR,
                                    CONSTRAINT roles_contrainte PRIMARY KEY (id_film, id, id_acteur)
);

-- Création de la table Votes
CREATE TABLE IF NOT EXISTS votes(
                                    id_vote SERIAL PRIMARY KEY ,
                                    id_film VARCHAR,
                                    firstname VARCHAR,
                                    lastname VARCHAR,
                                    vote VARCHAR
);

-- Remplissage des 3 premières tables
\copy films FROM 'films.csv' WITH (FORMAT CSV);
\copy acteurs FROM 'acteurs.csv' WITH (FORMAT CSV);
\copy roles FROM 'roles.csv' WITH (FORMAT CSV);

-- On supprime une colonne qui n'est pas essentielle dans la table Films
ALTER TABLE films DROP COLUMN titre;