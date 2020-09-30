--
-- Author : SEGHAIER Oussama 
-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 19 mars 2020 à 19:13
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `LAMP_DB`
--

-- --------------------------------------------------------
DROP DATABASE IF EXISTS LAMP_DB;

CREATE DATABASE LAMP_DB;

USE LAMP_DB;
--
-- Structure de la table `Categories`
--

DROP TABLE IF EXISTS `Categories`;

CREATE TABLE `Categories` (
  `classID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `instantiated` BOOLEAN,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `imgURL` varchar(100) NOT NULL,
  `date_memory` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`instantiated`,`Name`, `Description`, `imgURL`, `date_memory`) VALUES
(1,'Culture','Musique, art, spiritualité', 'img/culture.jpg', '2000-01-01 00:00:00'),
(1,'Voyages', 'Un peu d exotisme pendant le confinement', 'img/travel.jpg', '2000-01-01 00:00:00'),
(1,'Cuisine', 'Tout le monde à table', 'img/gastronomy.jpg', '2000-01-01 00:00:00'),
(1,'Bricolage', 'Tout le nécessaire pour retaper sa baraque', 'img/bricolage.jpg', '2000-01-01 00:00:00'),
(1,'Jouets', 'De quoi occuper les marmots', 'img/jouets.jpg', '2000-01-01 00:00:00'),
(1,'Divers', 'Les inclassables', 'img/divers.jpg', '2000-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `Comments`
--

DROP TABLE IF EXISTS `Comments`;

CREATE TABLE `Comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `itemID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `grade` tinyint(3) DEFAULT NULL,
  `parentID` int(11) DEFAULT NULL,
  `isBanned` tinyint(1) DEFAULT '0',
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

INSERT INTO `Comments` (`itemID`, `userID`, `content`, `grade`, `parentID`, `isBanned`, `date`) VALUES
(1, 4, 'Un véritable délice', 5, NULL, 0, '2019-09-02 00:00:00'),
(1, 2, 'les enfants ont adore', 4, NULL, 0, '2019-09-03 00:00:00'),
(1, 3, 'le chien aussi', 4, NULL, 0, '2019-12-12 00:00:00'),
(1, 4, 'Finalement il n est pas si bon', 2, NULL, 0, '2020-04-02 00:00:00'),
(2, 4, 'Vraiment dégueu', 1, NULL, 0, '2019-11-20 00:00:00'),
(2, 4, 'En fait au bout de la deuxième on y prend goût', 3, 5, 0, '2019-11-21 00:00:00'),
(2, 3, 'truc de vieux', 2, NULL, 0, '2019-11-21 00:00:00'),
(3, 4, 'Un peu casse gueule quand même', 3, NULL, 0, '2019-05-23 00:00:00'),
(3, 4, 'jme suis cassé une jambe LOL', 3, NULL, 0, '2019-07-12 00:00:00'),
(4, 2, 'trop amusant', 4, NULL, 0, '2019-07-12 00:00:00'),
(5, 2, 'sympa mais c est mieux a la télé', 2, NULL, 0, '2019-07-12 00:00:00'),
(5, 1, 'trop fan comme mbappe', 5, NULL, 0, '2019-08-12 00:00:00'),
(6, 3, 'ça marche pas pour les clous', 1, NULL, 0, '2020-01-12 00:00:00'),
(6, 3, 'ah si en tapant très fort', 3, 13, 0, '2020-01-13 00:00:00'),
(6, 4, 'faut y aller quand même', 3, 13, 0, '2020-01-14 00:00:00'),
(7, 5, 'y a pas de manuel', 2, NULL, 0, '2020-01-14 00:00:00'),
(8, 5, 'ça marche bien mais j ai la rondelle en feu', 4, NULL, 0, '2020-02-14 00:00:00'),
(8, 5, 'maintenant j ai deux rondelles', 3, 17, 0, '2020-02-15 00:00:00'),
(9, 5, 'que de fraicheur', 5, NULL, 0, '2019-07-15 00:00:00'),
(10, 5, 'j ai eu toute une famille! 690€ en 2 min!', 5, NULL, 0, '2020-04-02 00:00:00'),
(11, 4, 'elle est morte de peur, encore plus efficace que le vrai', 5, NULL, 0, '2020-04-02 00:00:00'),
(11, 5, "ce produit m'a provoqué de l'urticaire", 1, NULL, 0, '2020-01-05 23:00:00'),
(12, 4, 'y a que des ploucs mais c est joli', 4, NULL, 0, '2020-04-02 00:00:00'),
(13, 3, 'mais quel enfer', 1, NULL, 0, '2020-04-02 00:00:00'),
(14, 2, 'j ai mange du pangolin', 3, NULL, 0, '2020-04-02 00:00:00'),
(15, 2, 'oula oula...', 1, NULL, 0, '2020-04-02 00:00:00'),
(16, 4, 'risque d accouphenes', 4, NULL, 0, '2020-04-02 00:00:00');

--
-- Structure de la table `contactus`
--

DROP TABLE IF EXISTS `contactus`;

CREATE TABLE `contactus` (
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contactus`
--

INSERT INTO `contactus` (`firstname`, `lastname`, `email`, `comments`) VALUES
('il', 'yas', 'in@hotmail.fr', 'salut'),
('il', 'yas', 'in@hotmail.fr', 'salut'),
('Ilyasse', 'Tariq', 'ilyasse.tariq@edhec.com', 'vjkvkk');

-- --------------------------------------------------------

--
-- Structure de la table `Items`
--

DROP TABLE IF EXISTS `Items`;

CREATE TABLE `Items` (
  `itemID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `classID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `imgURL` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `userID` int(11) NOT NULL,
  `note` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Items`
--

INSERT INTO `Items` (`classID`, `name`, `imgURL`, `category`, `Description`, `userID`, `note`) VALUES
(3, 'Poulet', 'img/poulet.jpg', 'Cuisine','poulet au romarin', 4, '4'),
(3, 'Langue de boeuf', 'img/langue.jpeg', 'Cuisine','recette de grand mere', 4, '4.5'),
(5, 'Skate', 'img/skate.jpg', 'Jouets','mini cruiser', 4, '3.8'),
(5, 'Kapla', 'img/kapla.jpg', 'Jouets','pour les zenfants', 1, '4.5'),
(2, 'Ballon', 'img/ballon.jpg', 'Voyages','vendu dégonflé', 1, '2.1'),
(4, 'Visseuse', 'img/visseuse.jpg', 'Bricolage','marche pas pour les clous', 4, '4'),
(4, 'Pelle', 'img/pelle.jpg', 'Bricolage','pour les EPHAD', 4, '4'),
(4, 'WC', 'img/wc.jpg', 'Bricolage','technologie désintégration par Uranium, sans chasse d eau!', 4, '4'),
(6, 'Orange', 'img/orange.jpg', 'Divers','quand il fait si chaud sous les cocos', 4, '4'),
(6, 'Kepi', 'img/kepi.jpg', 'Divers','pour se faire 138€ en bas de chez soi', 4, '4'),
(6, 'Coronavirus', 'img/coronavirus.jpg', 'Divers','corona en plastique, pour faire une blague à grand mere', 4, '4'),
(2, 'France', 'img/france.jpeg', 'Voyages','faites gaffe a l alsace!', 4, '4'),
(2, 'Etats-Unis', 'img/us.jpg', 'Voyages','Beauf-Party', 4, '4'),
(2, 'Chine', 'img/chine.png', 'Voyages','Une aventure passionante à la quête du patient 0', 4, '4'),
(1, 'Marilyn Manson', 'img/marilyn.jpg', 'Culture','Oula...', 4, '3.7'),
(1, 'Saxophone', 'img/saxo.jpg', 'Culture','sans rancune les voisins! ', 4, '4'),
(1, 'Graphiti', 'img/graph.jpg', 'Culture','c est de l art brut', 4, '4');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--
DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `banned` BOOLEAN,
  `status` INT NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password_hash` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`banned`, `status`, `first_name`, `last_name`, `email`, `password_hash`) VALUES
(0, 2, 'John', 'McQuenzie', 'john.mc@gmail.com', 'FJBEJZHFKBEZHBEFKJ76TRU3B87FUEJH'),
(0, 2, 'Marie', 'Ramniasse', 'maria.ra@laposte.net', 'R87T925BOUFEG87UBJR3JKRB872U'),
(0, 2, 'Jacques', 'Larmoneur', 'jacques.la@zimbra.fr', 'IUFHEOIZUF879Y247O5983UIBFJKE');