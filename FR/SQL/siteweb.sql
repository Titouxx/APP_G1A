-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 jan. 2024 à 16:03
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

-- Base de données : siteweb
-- --------------------------------------------------------

-- Structure de la table user
CREATE TABLE user (
  id_User int(11) NOT NULL AUTO_INCREMENT,
  prenom varchar(255) NOT NULL,
  nom varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id_User)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Données de la table user
INSERT INTO user (id_User, prenom, nom, email, password) VALUES
(1, 'kelyan', 'taverny', 'kelyan@gmail.com', 'kelyantaverny'),
(2, '', '', 'marie@gmail.com', 'mariemarie'),
(3, '', '', 'pierre@gmail.com', 'pierre'),
(5, 'Islam', 'AIT-SLIMANE', 'islam61886@gmail.com', '$2y$10$9fREBhPAKzHgBHNhXYbdl.aR5cOK1msmJPQP/cJUMHCMw0i3spNpW');

-- --------------------------------------------------------

-- Structure de la table partenaires
CREATE TABLE partenaires (
  id INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  adresse VARCHAR(255) NOT NULL,
  description TEXT,
  latitude DOUBLE NOT NULL,
  longitude DOUBLE NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Données de la table partenaires
INSERT INTO partenaires (nom, adresse, description, latitude, longitude) VALUES
('Marché Bio Paris', '12 Rue de Rivoli, 75001 Paris', 'Produits bio & locaux', 48.8606, 2.3376),
('Épicerie Verte', '8 Boulevard Voltaire, 75011 Paris', 'Produits zéro déchet', 48.8500, 2.3600),
('Fruits&Co', '25 Rue Saint-Honoré, 75008 Paris', 'Fruits frais toute l''année', 48.8700, 2.3000);

CREATE TABLE reservations (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  partenaire_id INT NOT NULL,
  qr_code VARCHAR(255) NOT NULL,
  date_reservation DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id_User),
  FOREIGN KEY (partenaire_id) REFERENCES partenaires(id)
);

-- Table paniers
CREATE TABLE paniers (
  id INT NOT NULL AUTO_INCREMENT,
  partenaire_id INT NOT NULL,
  nom VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (partenaire_id) REFERENCES partenaires(id)
);

-- Table articles
CREATE TABLE articles (
  id INT NOT NULL AUTO_INCREMENT,
  panier_id INT NOT NULL,
  nom VARCHAR(255) NOT NULL,
  quantite VARCHAR(50) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (panier_id) REFERENCES paniers(id)
);

-- Modifiez la table reservations pour ajouter panier_id
ALTER TABLE reservations ADD COLUMN panier_id INT NOT NULL AFTER partenaire_id;
ALTER TABLE reservations ADD FOREIGN KEY (panier_id) REFERENCES paniers(id);

INSERT INTO paniers (partenaire_id, nom, description) VALUES
(1, 'Panier repas', 'Comporte tous les aliments nécessaires à une semaine de repas pour une personne.'),
(2, 'Panier repas', 'Comporte tous les aliments nécessaires à une semaine de repas pour une personne.'),
(3, 'Panier repas', 'Comporte tous les aliments nécessaires à une semaine de repas pour une personne.');

INSERT INTO articles (panier_id, nom, quantite) VALUES
(1, 'Légumes de saison', '3 kg'),
(1, 'Fruits frais', '2 kg'),
(1, 'Pâtes complètes', '1 kg'),
(1, 'Riz bio', '1 kg'),
(1, 'Légumineuses', '1 kg'),
(1, 'Huile d\'olive', '1 L'),
(2, 'Légumes de saison', '3 kg'),
(2, 'Fruits frais', '2 kg'),
(2, 'Pâtes complètes', '1 kg'),
(3, 'Légumes de saison', '3 kg'),
(3, 'Fruits frais', '2 kg');

-- Ajoutez cette commande à votre fichier siteweb.sql
CREATE TABLE reservations_archive (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  partenaire_id INT NOT NULL,
  panier_id INT NOT NULL,
  qr_code VARCHAR(255) NOT NULL,
  date_reservation DATETIME NOT NULL,
  date_archivage DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id_User),
  FOREIGN KEY (partenaire_id) REFERENCES partenaires(id),
  FOREIGN KEY (panier_id) REFERENCES paniers(id)
);

ALTER TABLE user ADD COLUMN statut VARCHAR(50) NOT NULL DEFAULT 'etudiant';

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
 /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
 /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
