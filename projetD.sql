-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 déc. 2024 à 08:47
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS ProjetD;
CREATE DATABASE ProjetD;
USE ProjetD;

-- Table utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` ENUM('pilote', 'spectateur', 'admin') NOT NULL DEFAULT 'spectateur',
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 AUTO_INCREMENT=1;

-- Table course
CREATE TABLE IF NOT EXISTS `course` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_course` varchar(150) NOT NULL,
  `date_course` datetime NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `distance` float NOT NULL,
  `description` text,
  `etat` enum('à venir','en cours','terminée') NOT NULL DEFAULT 'à venir',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Table vehicule
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `marque` varchar(100) NOT NULL,
  `modele` varchar(100) NOT NULL,
  `annee` int(4) NOT NULL,
  `puissance` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Table inscription
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_course` int NOT NULL,
  `id_vehicule` int NOT NULL,
  `temps_final` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_course` (`id_course`),
  KEY `id_vehicule` (`id_vehicule`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Table message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_envoyeur` int NOT NULL,
  `id_destinataire` int NOT NULL,
  `contenu_message` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `etat_message` enum('lu','non lu') NOT NULL DEFAULT 'non lu',
  PRIMARY KEY (`id`),
  KEY `id_envoyeur` (`id_envoyeur`),
  KEY `id_destinataire` (`id_destinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Table resultat
CREATE TABLE IF NOT EXISTS `resultat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_course` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `position` int NOT NULL,
  `temps_course` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_course` (`id_course`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Table statistique
CREATE TABLE IF NOT EXISTS `statistique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_course` int NOT NULL,
  `vitesse_max` float DEFAULT NULL,
  `vitesse_moyenne` float DEFAULT NULL,
  `nombre_participants` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Table commentaire
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_course` int NOT NULL,
  `texte_commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_course` (`id_course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Contraintes pour les tables
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`) ON DELETE CASCADE;

ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inscription_ibfk_3` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id`) ON DELETE CASCADE;

ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_envoyeur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

ALTER TABLE `resultat`
  ADD CONSTRAINT `resultat_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultat_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

ALTER TABLE `statistique`
  ADD CONSTRAINT `statistique_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`) ON DELETE CASCADE;

ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE;

-- Insertion des données
INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `login`, `password`, `role`, `photo`) VALUES
(1, 'Malhomme', 'Killian', 'killianmm43@gmail.com', 'admin', 'f71dbe52628a3f83a77ab494817525c6', 'admin', 'user.png'),
(2, 'Lac', 'Nathan', 'lacnathan926@gmail.com', 'pilote', 'f8dcd07ba85c3d3ecf0d1bd56fa86a48', 'pilote', 'user.png'),
(3, 'Dupuis', 'Sophie', 'sophie.dupuis@example.com', 'pilote', '4754e6f8d28df0bdb46e97e070ecc680', 'pilote', 'user.png'),
(4, 'Marie', 'Martin', 'marie.martin@example.com', 'spec', 'b979c2934ac0b4ba3f08dabfdd1b2299', 'spectateur', 'user.png'),
(5, 'Lefebvre', 'Marc', 'marc.lefebvre@example.com', 'pilote', '7fdc7313b082cad7c86bc722daffa6b7', 'pilote', 'user.png'),
(6, 'Takumi', 'Fujiwara', 'takumi.fujiwara@example.com', 'takumi86', 'e10adc3949ba59abbe56e057f20f883e', 'pilote', 'user.png'),
(7, 'Haruto', 'Shimizu', 'haruto.shimizu@example.com', 'haruto_jdm', 'e99a18c428cb38d5f260853678922e03', 'pilote', 'user.png'),
(8, 'Lena', 'Müller', 'lena.muller@example.com', 'lena_speed', 'a4c47caa76bd0dfe8e8d37590100ad80', 'pilote', 'user.png'),
(9, 'Sebastian', 'Schmidt', 'sebastian.schmidt@example.com', 'seb_sport', 'c33367701511b4f6020ec61ded352059', 'spectateur', 'user.png'),
(10, 'Marie', 'Dubois', 'marie.dubois@example.com', 'marie_2024', '7815696ecbf1c96e6894b779456d330e', 'spectateur', 'user.png'),
(11, 'Ryousuke', 'Takahashi', 'ryousuke.takahashi@example.com', 'ryousuke', '5d41402abc4b2a76b9719d911017c592', 'pilote', 'user.png'),
(12, 'Koji', 'Minami', 'koji.minami@example.com', 'koji_drift', '7d793037a0760186574b0282f2f435e7', 'pilote', 'user.png'),
(13, 'Alice', 'Martin', 'alice.martin@example.com', 'alice_f1', '098f6bcd4621d373cade4e832627b4f6', 'spectateur', 'user.png'),
(14, 'Carlos', 'Santana', 'carlos.santana@example.com', 'carlos_speed', '4a8a08f09d37b73795649038408b5f33', 'spectateur', 'user.png'),
(15, 'Julia', 'Fischer', 'julia.fischer@example.com', 'julia_driving', '8277e0910d750195b448797616e091ad', 'pilote', 'user.png');

INSERT INTO `vehicule` (`id`, `id_utilisateur`, `marque`, `modele`, `annee`, `puissance`, `type`) VALUES
(1, 3, 'Ferrari', '488 GTB', 2018, 670, 'Sport'),
(2, 5, 'Porsche', '911 Carrera', 2020, 385, 'Sport'),
(3, 2, 'Toyota', 'Celica GT4', 2019, 132, 'Sport'),
(4, 6, 'Toyota', 'AE86 Trueno', 1986, 130, 'Sport'),
(5, 7, 'Nissan', 'Skyline GT-R R34', 1999, 280, 'Sport'),
(6, 7, 'Subaru', 'Impreza WRX STI', 2005, 300, 'Sport'),
(7, 8, 'BMW', 'M3 E46', 2003, 343, 'Sport'),
(8, 8, 'Mercedes', 'AMG GT', 2018, 510, 'Sport'),
(9, 9, 'Renault', 'Clio RS Trophy', 2021, 220, 'Sport'),
(10, 9, 'Peugeot', '308 GTI', 2017, 270, 'Sport'),
(11, 11, 'Mazda', 'RX-7 FD3S', 1993, 280, 'Sport'),
(12, 12, 'Honda', 'NSX', 1995, 276, 'Sport'),
(13, 12, 'Mitsubishi', 'Lancer Evolution IX', 2006, 290, 'Sport'),
(14, 14, 'Audi', 'RS4 Avant', 2015, 450, 'Sport'),
(15, 14, 'Porsche', '911 GT3', 2022, 510, 'Sport'),
(16, 15, 'Alpine', 'A110', 2018, 252, 'Sport'),
(17, 15, 'Toyota', 'Supra MK4', 1998, 330, 'Sport');

INSERT INTO `course` (`id`, `nom_course`, `date_course`, `lieu`, `distance`, `description`, `etat`) VALUES
(1, 'Grand Prix de Paris', '2024-11-22 10:00:00', 'Paris, France', 300.5, 'Course annuelle de Paris', 'à venir'),
(2, 'Rallye des Alpes', '2024-11-23 09:00:00', 'Grenoble, France', 250, 'Rallye dans les Alpes', 'à venir'),
(3, 'Circuit du Nürburgring', '2024-12-15 08:00:00', 'Allemagne', 20.8, 'Course mythique sur le célèbre circuit', 'à venir'),
(4, 'Rallye Monte-Carlo', '2025-01-20 09:00:00', 'Monaco', 300, 'Événement incontournable du championnat', 'à venir'),
(5, 'Circuit de Spa-Francorchamps', '2025-02-10 10:00:00', 'Belgique', 7.0, 'Course d’endurance sur circuit historique', 'à venir'),
(6, 'Rallye des Cévennes', '2025-03-05 09:30:00', 'France', 250, 'Spécial rallye sur route sinueuse', 'à venir');

INSERT INTO `statistique` (`id`, `id_course`, `vitesse_max`, `vitesse_moyenne`, `nombre_participants`) VALUES
(1, 1, 250, 150, 10),
(2, 2, 220, 140, 8),
(3, 3, 320, 150, 12),
(4, 4, 290, 140, 10),
(5, 5, 310, 160, 8),
(6, 6, 280, 130, 9);

INSERT INTO `commentaire` (`id`, `id_utilisateur`, `id_course`, `texte_commentaire`, `date_commentaire`) VALUES
(1, 5, 1, 'Super course, très bien organisée!', '2024-11-22 12:00:00'),
(2, 2, 1, 'Belle expérience, merci aux organisateurs!', '2024-11-22 12:10:00');

INSERT INTO `resultat` (`id`, `id_course`, `id_utilisateur`, `position`, `temps_course`) VALUES
(1, 1, 2, 1, '01:30:00'),
(2, 2, 5, 1, '01:35:00'),
(3, 1, 3, 2, '01:40:00'),
(4, 3, 6, 1, '00:07:30'),
(5, 4, 7, 1, '02:45:00'),
(6, 5, 11, 2, '00:03:45'),
(7, 6, 12, 3, '01:45:00');

INSERT INTO `inscription` (`id`, `id_utilisateur`, `id_course`, `id_vehicule`, `temps_final`) VALUES
(1, 2, 1, 3, NULL),
(2, 5, 2, 1, NULL),
(3, 3, 1, 2, NULL),
(4, 6, 3, 4, NULL),
(5, 7, 4, 5, NULL),
(6, 8, 3, 7, NULL),
(7, 9, 4, 9, NULL),
(8, 11, 5, 11, NULL),
(9, 12, 6, 12, NULL),
(10, 15, 6, 16, NULL);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
