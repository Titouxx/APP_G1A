CREATE TABLE liste_faq (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Prenom nvarchar(255),
    NomDeFamille nvarchar(255),
    email nvarchar(320),
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(ID)
    );
    