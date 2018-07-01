-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 04 Juin 2016 à 03:34
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `trans_proj`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE IF NOT EXISTS `agence` (
  `id_agence` int(11) NOT NULL AUTO_INCREMENT,
  `ville` varchar(25) NOT NULL,
  `tel` varchar(25) NOT NULL,
  PRIMARY KEY (`id_agence`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `ville`, `tel`) VALUES
(1, 'NKTT', '45250550'),
(2, 'NDB', '45250551'),
(3, 'Alag', '45250552'),
(4, 'Rosso', '45250553');

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE IF NOT EXISTS `billets` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `montant` decimal(15,3) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_billet` datetime NOT NULL,
  PRIMARY KEY (`code`),
  KEY `FK_Billets_id_voyage` (`id_voyage`),
  KEY `FK_Billets_id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `billets`
--

INSERT INTO `billets` (`code`, `montant`, `numero`, `id_voyage`, `id_client`, `date_billet`) VALUES
(1, '6000.000', 9, 47, 1, '2016-05-29 13:43:52'),
(2, '6000.000', 1, 47, 1, '2016-05-29 13:47:14'),
(3, '6000.000', 3, 48, 2, '2016-05-29 15:20:18'),
(4, '6000.000', 7, 48, 1, '2016-05-29 15:23:08'),
(5, '6000.000', 15, 48, 2, '2016-05-29 15:26:25'),
(6, '6000.000', 9, 48, 1, '2016-05-29 15:55:17'),
(7, '4000.000', 8, 50, 3, '2016-05-29 15:56:20'),
(8, '6000.000', 12, 49, 3, '2016-05-29 15:57:00'),
(9, '4000.000', 11, 50, 3, '2016-05-29 15:57:18'),
(10, '6000.000', 10, 48, 1, '2016-05-30 14:36:34'),
(11, '6000.000', 8, 52, 3, '2016-06-03 15:48:42'),
(12, '6000.000', 6, 52, 1, '2016-06-03 16:01:03'),
(13, '6000.000', 12, 52, 1, '2016-06-03 16:26:54'),
(14, '4000.000', 15, 53, 2, '2016-06-03 16:31:19');

-- --------------------------------------------------------

--
-- Structure de la table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `matricule` varchar(25) NOT NULL,
  `nombre_places` int(11) NOT NULL,
  `model` varchar(25) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bus`
--

INSERT INTO `bus` (`matricule`, `nombre_places`, `model`) VALUES
('0022AM00', 15, 'TOYOTA'),
('0304AA02', 15, 'TOYOTA'),
('1234AV00', 15, 'TOYOTA'),
('2345AA11', 15, 'TOYOTA'),
('3456AM00', 15, 'TOYOTA'),
('3498AM00', 15, 'TOYOTA'),
('3540AM00', 15, 'TOYOTA'),
('4455AN00', 15, 'TOYOTA'),
('6463AA08', 15, 'TOYOTA'),
('7468AN00', 15, 'TOYOTA'),
('7878AR00', 15, 'TOYOTA'),
('9867AM00', 15, 'TOYOTA');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `tel` int(8) NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `Tel` (`tel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id_client`, `Nom`, `tel`) VALUES
(1, 'brahim baheida', 36200304),
(2, 'mouin siddat', 43787818),
(3, 'mohamed', 33728751),
(5, 'nahah', 26135536);

-- --------------------------------------------------------

--
-- Structure de la table `courrier`
--

CREATE TABLE IF NOT EXISTS `courrier` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(50) NOT NULL,
  `nom_recepteur` varchar(50) NOT NULL,
  `tel` int(8) NOT NULL,
  `date_courrier` datetime NOT NULL,
  `id_voyage` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_agence` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `id_client` (`id_client`),
  KEY `id_agence` (`id_agence`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `courrier`
--

INSERT INTO `courrier` (`code`, `destination`, `nom_recepteur`, `tel`, `date_courrier`, `id_voyage`, `id_client`, `id_agence`) VALUES
(1, 'Alag', 'Mouin', 43787818, '2016-05-11 16:51:53', 21, 1, 1),
(2, 'Alag', 'Mouin', 43787818, '2016-05-20 22:38:07', 22, 1, 1),
(3, 'Alag', 'Mouin', 43787818, '2016-05-20 22:41:16', 22, 1, 1),
(4, 'Alag', 'mohamed', 43787818, '2016-05-20 22:48:12', 22, 1, 1),
(5, 'Alag', 'mohamed', 43787818, '2016-05-20 22:48:17', 22, 1, 1),
(6, 'Alag', 'mohamed', 43787818, '2016-05-20 22:50:21', 22, 1, 1),
(7, 'Alag', 'brahim baheida', 36200304, '2016-05-20 22:52:43', 22, 2, 1),
(8, 'NKTT', 'brahim baheida', 36200304, '2016-05-20 23:49:52', 28, 2, 2),
(9, 'NKTT', 'Mouin', 43787818, '2016-05-21 12:19:11', 30, 5, 3),
(10, 'NDB', 'Mouin', 43787818, '2016-05-21 12:54:35', 33, 1, 1),
(11, 'Alag', 'Mouin', 43787818, '2016-05-21 12:54:44', 36, 1, 1),
(12, 'Alag', 'Mouin', 43787818, '2016-05-22 14:20:33', 37, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `transferts`
--

CREATE TABLE IF NOT EXISTS `transferts` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `montant` decimal(15,3) NOT NULL,
  `tel` int(8) NOT NULL,
  `nom_recepteur` varchar(25) NOT NULL,
  `date_transfert` datetime NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_agence` int(11) NOT NULL,
  `agence` varchar(50) NOT NULL,
  PRIMARY KEY (`code`),
  KEY `FK_Transferts_id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `transferts`
--

INSERT INTO `transferts` (`code`, `montant`, `tel`, `nom_recepteur`, `date_transfert`, `id_client`, `id_agence`, `agence`) VALUES
(15, '100000.000', 43787818, 'Mouin', '2016-05-19 20:42:41', 1, 2, 'NKTT'),
(16, '20000.000', 36200304, 'brahim baheida', '2016-05-19 20:51:03', 2, 3, 'NKTT'),
(17, '100000.000', 33998899, 'mohamed', '2016-05-19 21:10:34', 1, 2, 'NKTT'),
(18, '100000.000', 36200304, 'brahim baheida', '2016-05-19 21:22:13', 2, 1, 'NDB'),
(19, '100000.000', 33998899, 'mohamed', '2016-05-19 23:22:12', 1, 2, 'NKTT'),
(20, '100000.000', 36200304, 'brahim baheida', '2016-05-19 23:24:20', 3, 4, 'NKTT'),
(21, '5000.000', 43787818, 'Mouin', '2016-05-20 16:37:21', 1, 1, 'NDB'),
(22, '50000.000', 43787818, 'Mouin', '2016-05-20 17:42:38', 1, 3, 'NDB'),
(23, '1000000.000', 36200304, 'brahim baheida', '2016-05-20 17:44:52', 3, 4, 'NDB'),
(24, '100000.000', 43787818, 'Mouin', '2016-05-20 18:23:24', 1, 3, 'NKTT'),
(25, '10000.000', 33998899, 'mohamed', '2016-05-21 12:18:03', 5, 2, 'Alag'),
(26, '100000.000', 36200304, 'brahim baheida', '2016-05-21 12:21:34', 2, 2, 'NKTT'),
(27, '20000.000', 43787818, 'Mouin', '2016-05-21 13:04:29', 1, 2, 'NKTT'),
(28, '100000.000', 36200304, 'brahim baheida', '2016-05-21 15:27:30', 5, 2, 'NKTT'),
(29, '100000.000', 43787818, 'Mouin', '2016-05-22 14:15:57', 1, 3, 'NKTT'),
(30, '10000.000', 20508268, 'mokhtar', '2016-05-23 11:53:53', 1, 2, 'NKTT');

-- --------------------------------------------------------

--
-- Structure de la table `voyages`
--

CREATE TABLE IF NOT EXISTS `voyages` (
  `id_voyage` int(11) NOT NULL AUTO_INCREMENT,
  `destination` varchar(25) NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  `id_agence` int(11) NOT NULL,
  `bus` varchar(25) NOT NULL,
  PRIMARY KEY (`id_voyage`),
  KEY `FK_Voyages_id_agence` (`id_agence`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Contenu de la table `voyages`
--

INSERT INTO `voyages` (`id_voyage`, `destination`, `date_depart`, `heure_depart`, `id_agence`, `bus`) VALUES
(10, 'NKTT', '2016-05-08', '07:00:00', 2, '3456AM00'),
(11, 'Rosso', '2016-05-08', '07:00:00', 2, '0022AM00'),
(12, 'Alag', '2016-05-08', '07:00:00', 2, '0022AM00'),
(13, 'Rosso', '2016-05-08', '15:00:00', 2, '0022AM00'),
(14, 'NDB', '2016-05-09', '08:00:00', 1, '0022AM00'),
(15, 'NDB', '2016-05-09', '07:00:00', 1, '0022AM00'),
(16, 'NDB', '2016-05-09', '15:00:00', 1, '0022AM00'),
(17, 'Alag', '2016-05-09', '08:00:00', 1, '3540AM00'),
(18, 'NDB', '2016-05-09', '07:00:00', 1, '4455AN00'),
(19, 'NDB', '2016-05-09', '07:00:00', 1, '2345AA11'),
(20, 'Rosso', '2016-05-10', '07:00:00', 1, '0022AM00'),
(21, 'Alag', '2016-05-11', '07:00:00', 1, '3540AM00'),
(22, 'Alag', '2016-05-20', '07:00:00', 1, '0022AM00'),
(23, 'NDB', '2016-05-20', '07:00:00', 1, '0304AA02'),
(24, 'Rosso', '2016-05-20', '07:00:00', 1, '1234AV00'),
(25, 'NDB', '2016-05-20', '08:00:00', 1, '2345AA11'),
(26, 'NDB', '2016-05-20', '15:00:00', 1, '3498AM00'),
(27, 'Alag', '2016-05-20', '07:00:00', 1, '4455AN00'),
(28, 'NKTT', '2016-05-20', '07:00:00', 2, '3540AM00'),
(29, 'NKTT', '2016-05-20', '08:00:00', 2, '7468AN00'),
(30, 'NKTT', '2016-05-21', '07:00:00', 3, '0022AM00'),
(31, 'NKTT', '2016-05-21', '08:00:00', 3, '0304AA02'),
(32, 'NKTT', '2016-05-21', '15:00:00', 3, '2345AA11'),
(33, 'NDB', '2016-05-21', '07:00:00', 1, '3540AM00'),
(34, 'NDB', '2016-05-21', '15:00:00', 1, '3456AM00'),
(35, 'NDB', '2016-05-21', '08:00:00', 1, '7878AR00'),
(36, 'Alag', '2016-05-21', '15:00:00', 1, '4455AN00'),
(37, 'Alag', '2016-05-22', '15:00:00', 1, '3498AM00'),
(38, 'NKTT', '2016-05-23', '15:00:00', 2, '3456AM00'),
(39, 'NKTT', '2016-05-23', '08:00:00', 2, '0304AA02'),
(40, 'NDB', '2016-05-26', '07:00:00', 1, '0022AM00'),
(42, 'NDB', '2016-05-27', '07:00:00', 1, '0022AM00'),
(43, 'NDB', '2016-05-28', '07:00:00', 1, '0022AM00'),
(44, 'NDB', '2016-05-28', '08:00:00', 1, '0304AA02'),
(45, 'NDB', '2016-05-28', '15:00:00', 1, '9867AM00'),
(46, 'Alag', '2016-05-28', '07:00:00', 1, '3456AM00'),
(47, 'NDB', '2016-05-29', '07:00:00', 1, '0022AM00'),
(48, 'NDB', '2016-05-30', '07:00:00', 1, '0022AM00'),
(49, 'NDB', '2016-05-30', '08:00:00', 1, '1234AV00'),
(50, 'Alag', '2016-05-30', '07:00:00', 1, '3540AM00'),
(51, 'NDB', '2016-06-03', '07:00:00', 1, '0022AM00'),
(52, 'NDB', '2016-06-04', '07:00:00', 1, '3456AM00'),
(53, 'Alag', '2016-06-04', '15:00:00', 1, '7468AN00'),
(54, 'Alag', '2016-06-04', '08:00:00', 1, '3540AM00'),
(55, 'Alag', '2016-06-04', '07:00:00', 1, '7878AR00'),
(56, 'Rosso', '2016-06-04', '07:00:00', 1, '3498AM00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `courrier`
--
ALTER TABLE `courrier`
  ADD CONSTRAINT `courrier_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`),
  ADD CONSTRAINT `courrier_ibfk_2` FOREIGN KEY (`id_agence`) REFERENCES `agence` (`id_agence`);

--
-- Contraintes pour la table `transferts`
--
ALTER TABLE `transferts`
  ADD CONSTRAINT `FK_Transferts_id_client` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Contraintes pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `FK_Voyages_id_agence` FOREIGN KEY (`id_agence`) REFERENCES `agence` (`id_agence`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
