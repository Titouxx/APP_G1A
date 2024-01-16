-- Création de table

-- table des fichiers audio
CREATE table audio(
    IdAudio INT PRIMARY KEY NOT NULL AUTO_INCREMENT;
    DateAudio DATE NOT NULL;
    Duree INT NOT NULL;
);