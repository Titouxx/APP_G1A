-- Création de table

-- table des fichiers audio
CREATE table audio(
    IdAudio INT PRIMARY KEY NOT NULL AUTO_INCREMENT;
    Nom VARCHAR(50) NOT NULL;
    DateAudio DATE NOT NULL;
    Duree INT NOT NULL;
);