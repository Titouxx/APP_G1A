-- Création de table

-- table utilisateur
CREATE table audio(
    idAudio SERIAL NOT NULL;
    nom varchar(50) NOT NULL;
    dateAudio date NOT NULL;
    
    PRIMARY KEY(id_audio)
);