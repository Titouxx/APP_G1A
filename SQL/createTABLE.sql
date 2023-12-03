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
