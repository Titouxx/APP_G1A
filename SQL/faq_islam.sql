CREATE TABLE liste_faq (
    ID INT PRIMARY KEY IDENTITY(1,1),
    Prenom NVARCHAR(255),
    NomDeFamille NVARCHAR(255),
    email NVARCHAR(320),
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(ID)
);

USE faq_islam;

DECLARE @EmailUtilisateur NVARCHAR(320);
DECLARE @Sujet NVARCHAR(255) = 'Sujet de l''email';
DECLARE @CorpsMessage NVARCHAR(MAX) = 'Contenu de votre message ici.';

-- Récupérer l'email de l'utilisateur en fonction de l'ID (par exemple, ID = 1)
SELECT @EmailUtilisateur = email
FROM Utilisateurs
WHERE ID = 1; -- Remplacer 1 par l'ID de l'admin qui doit recevoir le mail afin de pouvoir y répondre

-- Vérifier si l'email de l'utilisateur existe
IF @EmailUtilisateur IS NOT NULL
BEGIN
    -- Envoi de l'email
    EXEC msdb.dbo.sp_send_dbmail
        @profile_name = 'NomProfilEmail', -- Remplacez 'NomProfilEmail' par le nom de votre profil Email - Admin
        @recipients = @EmailUtilisateur,
        @subject = @Sujet,
        @body = @CorpsMessage;
        
    PRINT 'Email envoyé avec succès à l''utilisateur.';
END
ELSE
BEGIN
    PRINT 'L''email de l''utilisateur n''a pas été trouvé.';
END

-- Execution de l'envoi du mail
EXEC EnvoiEmailUtilisateur @utilisateur_id = 1; -- Remplacer 1 par l'ID de l'admin qui doit recevoir le mail afin de pouvoir y répondre