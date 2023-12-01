-- Création de table

-- table utilisateur
CREATE table user(
    id_user SERIAL NOT NULL;
    nom varchar(20) NOT NULL;
    prénom varchar(20) NOT NULL;
    adresse_mail varchar(30) NOT NULL;
    mdp varchar(32) NOT NULL;
    PRIMARY KEY(id_user)
);

-- Table artiste
CREATE table artiste(
    id_nom_artiste SERIAL NOT NULL;
    voix varchar(10);
    PRIMARY KEY(id_nom_artiste)
);


-- Table Salle
CREATE Table salle(
    id_salle SERIAL NOT NULL;
    nom varchar(20) NOT NULL;
    adresse varchar NOT NULL;
    DIMENSION varchar(20);
    PRIMARY KEY(id_salle)

);

-- Table Enregistrement
CREATE Table ENREGISTREMENT(
    id_audio SERIAL NOT NULL;
    titre varchar NOT NULL;
    ---taille --prof
    duree time NOT NULL;
    Diagnostic VARCHAR (50);
    PRIMARY KEY(id_audio);
    FOREIGN KEY(id_nom_artiste)
);

-- Table acceder
CREATE table acceder(
    id_user SERIAL NOT NULL;
    id_salle SERIAL NOT NULL
);

-- Table capteurs
CREATE table capteur(
    id_capteur SERIAL NOT NULL;
    id_salle SERIAL NOT NULL;
    PRIMARY KEY(id_capteur)
);

-- Table enregistrer
CREATE table enregistrer(
    id_capteur SERIAL NOT NULL;
    id_audio SERIAL NOT NULL
);