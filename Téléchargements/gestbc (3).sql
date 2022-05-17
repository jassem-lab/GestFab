-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 29 Avril 2022 à 14:17
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gestbc`
--
CREATE DATABASE IF NOT EXISTS `gestbc` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gestbc`;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc`
--

CREATE TABLE IF NOT EXISTS `erp_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `idbc_original` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `erp_bc`
--

INSERT INTO `erp_bc` (`id`, `reference`, `idbc_original`, `client`, `trimestre`, `annee`, `date`, `dateheure`, `idutilisateur`, `montant`, `etat`, `remarque`, `type`) VALUES
(1, 'BC_2022_001', 0, 1, 1, '2022', '2022-04-26', '2022-04-26 09:48:15', 1, '428', 0, '', 0),
(2, 'BC_2022_002', 0, 1, 2, '2022', '2022-04-26', '2022-04-26 10:14:35', 1, '274', 0, '', 0),
(3, 'BC_2022_006', 1, 1, 1, '2022', '2022-04-27', '2022-04-27 08:42:05', 1, '119.5', 0, '1 ére commande complémentaire', 1),
(4, 'BC_2022_007', 1, 1, 1, '2022', '2022-04-27', '2022-04-27 09:07:07', 1, '74', 0, '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `erp_br`
--

CREATE TABLE IF NOT EXISTS `erp_br` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `idbc_original` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  `retour` text NOT NULL,
  `satisfaction` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_clients`
--

CREATE TABLE IF NOT EXISTS `erp_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raisonsocial` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `personne` varchar(255) NOT NULL,
  `gsm` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_clients`
--

INSERT INTO `erp_clients` (`id`, `raisonsocial`, `adresse`, `pays`, `telephone`, `mail`, `personne`, `gsm`, `archive`) VALUES
(1, 'SO GARDEN', '', '', '', 'so_garden@mail.com', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_compteur_bc`
--

CREATE TABLE IF NOT EXISTS `erp_compteur_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `erp_compteur_bc`
--

INSERT INTO `erp_compteur_bc` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1),
(2, '2022', '002', 2),
(4, '2022', '003', 3),
(5, '2022', '004', 4),
(6, '2022', '005', 5),
(7, '2022', '006', 3),
(8, '2022', '007', 4);

-- --------------------------------------------------------

--
-- Structure de la table `erp_compteur_br`
--

CREATE TABLE IF NOT EXISTS `erp_compteur_br` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_compteur_prix`
--

CREATE TABLE IF NOT EXISTS `erp_compteur_prix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_compteur_prix`
--

INSERT INTO `erp_compteur_prix` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1),
(2, '2022', '002', 2);

-- --------------------------------------------------------

--
-- Structure de la table `erp_compteur_tableau`
--

CREATE TABLE IF NOT EXISTS `erp_compteur_tableau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_couleur`
--

CREATE TABLE IF NOT EXISTS `erp_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(255) NOT NULL,
  `famille` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `erp_couleur`
--

INSERT INTO `erp_couleur` (`id`, `couleur`, `famille`) VALUES
(1, 'GRIS CLAIR 7035', 1),
(2, 'BLANC 9010', 1),
(3, 'NOIR FONCE 9005', 1),
(4, 'GRIS BEIGE 7006', 1),
(5, 'ROUGE SIGNALISATION 3020', 2),
(6, 'GRIS ANTHRACITE 7016', 2),
(7, 'ORANGE 2004', 1),
(8, 'VERT SAPIN 6009', 1),
(9, 'JAUNE 1028', 2),
(10, 'VIOLET 4004', 2),
(11, 'BLEU VIOLET 5000', 1),
(12, 'BRUN CUIVRET 8004', 1);

-- --------------------------------------------------------

--
-- Structure de la table `erp_det_bc`
--

CREATE TABLE IF NOT EXISTS `erp_det_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbc` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` varchar(255) NOT NULL,
  `prix_total` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `qte_stratifies` int(11) NOT NULL,
  `qte_finis` int(11) NOT NULL,
  `qte_semifinis` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `erp_det_bc`
--

INSERT INTO `erp_det_bc` (`id`, `idbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`, `qte_stratifies`, `qte_finis`, `qte_semifinis`) VALUES
(1, 1, 21, 5, '35', '175', '50', '80', 0, 0, 0),
(6, 1, 26, 6, '27.5', '165', '30', '50', 0, 0, 0),
(8, 1, 24, 4, '22', '88', '', '', 0, 0, 0),
(9, 2, 27, 5, '33.8', '169', '', '', 0, 0, 0),
(10, 2, 21, 3, '35', '105', '50', '80', 0, 0, 0),
(11, 2, 24, 1, '22', '0', '', '', 0, 0, 0),
(16, 3, 21, 2, '35', '70', '50', '80', 0, 0, 0),
(17, 3, 26, 1, '27.5', '27.5', '30', '50', 0, 0, 0),
(18, 3, 24, 1, '22', '22', '', '', 0, 0, 0),
(19, 4, 21, 2, '37', '74', '50', '80', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_det_br`
--

CREATE TABLE IF NOT EXISTS `erp_det_br` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbr` int(11) NOT NULL,
  `produit` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantite` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_det_prix`
--

CREATE TABLE IF NOT EXISTS `erp_det_prix` (
  `idprix` int(11) NOT NULL,
  `famillecouleur` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `erp_det_prix`
--

INSERT INTO `erp_det_prix` (`idprix`, `famillecouleur`, `produit`, `prix`) VALUES
(1, 1, 21, '11'),
(1, 2, 21, '12'),
(1, 3, 21, '13'),
(1, 4, 21, '14'),
(1, 1, 22, '15'),
(1, 2, 22, '16'),
(1, 3, 22, '17'),
(1, 4, 22, '18'),
(1, 1, 23, '19'),
(1, 2, 23, '20'),
(1, 3, 23, '21'),
(1, 4, 23, '23'),
(1, 1, 24, ''),
(1, 2, 24, ''),
(1, 3, 24, ''),
(1, 4, 24, ''),
(1, 1, 25, ''),
(1, 2, 25, ''),
(1, 3, 25, ''),
(1, 4, 25, ''),
(1, 1, 26, ''),
(1, 2, 26, ''),
(1, 3, 26, ''),
(1, 4, 26, ''),
(1, 1, 27, ''),
(1, 2, 27, ''),
(1, 3, 27, ''),
(1, 4, 27, ''),
(2, 1, 21, '30'),
(2, 2, 21, '31'),
(2, 3, 21, '32'),
(2, 4, 21, '33'),
(2, 1, 22, '34'),
(2, 2, 22, '35'),
(2, 3, 22, '36'),
(2, 4, 22, '37'),
(2, 1, 23, '38'),
(2, 2, 23, '39'),
(2, 3, 23, '40'),
(2, 4, 23, '41'),
(2, 1, 24, ''),
(2, 2, 24, ''),
(2, 3, 24, ''),
(2, 4, 24, ''),
(2, 1, 25, ''),
(2, 2, 25, ''),
(2, 3, 25, ''),
(2, 4, 25, ''),
(2, 1, 26, ''),
(2, 2, 26, ''),
(2, 3, 26, ''),
(2, 4, 26, ''),
(2, 1, 27, ''),
(2, 2, 27, ''),
(2, 3, 27, ''),
(2, 4, 27, '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_famille_couleur`
--

CREATE TABLE IF NOT EXISTS `erp_famille_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_famille_couleur`
--

INSERT INTO `erp_famille_couleur` (`id`, `famille`) VALUES
(1, 'Standard mat (STD Mat)'),
(2, 'Spécial mat (SP Mat)'),
(3, 'Standard brillant'),
(4, 'spécial brillant');

-- --------------------------------------------------------

--
-- Structure de la table `erp_log`
--

CREATE TABLE IF NOT EXISTS `erp_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `action` varchar(1024) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Contenu de la table `erp_log`
--

INSERT INTO `erp_log` (`id`, `dateheure`, `idutilisateur`, `document`, `action`, `iddoc`) VALUES
(1, '2022-04-23 08:30:10', 1, 'Table de base - FP', 'Création d''un Produit finis :2000*500*600', 0),
(2, '2022-04-23 08:31:09', 1, 'Table de base - FP', 'Création d''un Produit finis :1500*500*600', 0),
(3, '2022-04-23 08:31:52', 1, 'Table de base - FP', 'Création d''un Produit finis :1200*500*600', 0),
(4, '2022-04-23 08:32:14', 1, 'Table de base - FP', 'Création d''un Produit finis :1200*500*600', 0),
(5, '2022-04-23 08:32:28', 1, 'Table de base - FP', 'Création d''un Produit finis :900*500*600', 0),
(6, '2022-04-23 08:32:40', 1, 'Table de base - FP', 'Modification d''un Produit finis :900*500*600', 0),
(7, '2022-04-23 08:32:59', 1, 'Table de base - FP', 'Création d''un Produit finis :1000*500*500', 0),
(8, '2022-04-23 08:33:34', 1, 'Table de base - FP', 'Création d''un Produit finis :1500*400*400', 0),
(9, '2022-04-23 09:42:56', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(10, '2022-04-23 09:44:40', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(11, '2022-04-23 09:45:28', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(12, '2022-04-23 09:47:11', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(13, '2022-04-23 09:48:00', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(14, '2022-04-23 09:48:31', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(15, '2022-04-23 09:48:43', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(16, '2022-04-23 09:49:04', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(17, '2022-04-23 09:49:43', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(18, '2022-04-23 09:49:57', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(19, '2022-04-23 09:50:59', 1, 'Table de base - FP', 'Modification d''un Produit finis :2000*500*600', 0),
(20, '2022-04-23 09:51:42', 1, 'Table de base - FP', 'Modification d''un Produit finis :1500*500*600', 0),
(21, '2022-04-23 09:52:25', 1, 'Table de base - FP', 'Modification d''un Produit finis :1200*500*600', 0),
(22, '2022-04-23 09:52:44', 1, 'Table de base - FP', 'Modification d''un Produit finis :900*500*600', 0),
(23, '2022-04-23 09:53:04', 1, 'Table de base - FP', 'Modification d''un Produit finis :1000*500*500', 0),
(24, '2022-04-23 09:53:35', 1, 'Table de base - FP', 'Modification d''un Produit finis :1500*400*400', 0),
(25, '2022-04-23 09:58:02', 1, 'Table de base - Famille Couleur ', 'Création d''une famille Couleur :Standard (STD)', 0),
(26, '2022-04-23 09:58:11', 1, 'Table de base - Famille Couleur ', 'Création d''une famille Couleur :Spécial (SP)', 0),
(27, '2022-04-23 10:05:22', 1, 'Table de base - Couleur ', 'Création d''un Couleur :', 0),
(28, '2022-04-23 10:07:23', 1, 'Table de base - Couleur ', 'Modification d''un Couleur :GRIS CLAIR 7035', 0),
(29, '2022-04-23 10:07:31', 1, 'Table de base - Couleur ', 'Création d''un Couleur :BLANC 9010', 0),
(30, '2022-04-23 10:07:42', 1, 'Table de base - Couleur ', 'Création d''un Couleur :NOIR FONCE 9005', 0),
(31, '2022-04-23 10:07:54', 1, 'Table de base - Couleur ', 'Création d''un Couleur :GRIS BEIGE 7006', 0),
(32, '2022-04-23 10:07:59', 1, 'Table de base - Couleur ', 'Création d''un Couleur :ROUGE SIGNALISATION 3020', 0),
(33, '2022-04-23 10:08:10', 1, 'Table de base - Couleur ', 'Création d''un Couleur :GRIS ANTHRACITE 7016', 0),
(34, '2022-04-23 10:08:15', 1, 'Table de base - Couleur ', 'Création d''un Couleur :ORANGE 2004', 0),
(35, '2022-04-23 10:08:26', 1, 'Table de base - Couleur ', 'Création d''un Couleur :VERT SAPIN 6009', 0),
(36, '2022-04-23 10:08:35', 1, 'Table de base - Couleur ', 'Création d''un Couleur :JAUNE 1028', 0),
(37, '2022-04-23 10:08:46', 1, 'Table de base - Couleur ', 'Création d''un Couleur :VIOLET 4004', 0),
(38, '2022-04-23 10:08:49', 1, 'Table de base - Couleur ', 'Création d''un Couleur :BLEU VIOLET 5000', 0),
(39, '2022-04-23 10:08:56', 1, 'Table de base - Couleur ', 'Création d''un Couleur :BRUN CUIVRET 8004', 0),
(40, '2022-04-26 08:56:43', 1, 'Table de base - Famille Couleur ', 'Modification d''une famille Couleur :Spécial mat (SP Mat)', 0),
(41, '2022-04-26 08:56:58', 1, 'Table de base - Famille Couleur ', 'Modification d''une famille Couleur :Standard mat (STD Mat)', 0),
(42, '2022-04-26 08:57:10', 1, 'Table de base - Famille Couleur ', 'Création d''une famille Couleur :Standard brillant', 0),
(43, '2022-04-26 08:57:13', 1, 'Table de base - Famille Couleur ', 'Création d''une famille Couleur :spécial brillant', 0),
(44, '2022-04-26 09:35:57', 1, 'Table de base - FP', 'Modification d''un Produit finis :1200*500*400', 0),
(45, '2022-04-26 09:36:11', 1, 'Table de base - FP', 'Modification d''un Produit finis :1000*500*500', 0),
(46, '2022-04-26 09:36:24', 1, 'Table de base - FP', 'Modification d''un Produit finis :1200*500*400', 0),
(47, '2022-04-26 09:48:15', 1, 'Commande client', 'Création d''un commande client :BC_2022_001', 0),
(48, '2022-04-26 09:48:28', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(49, '2022-04-26 09:48:35', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(50, '2022-04-26 09:48:40', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(51, '2022-04-26 09:48:44', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(52, '2022-04-26 09:49:17', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(53, '2022-04-26 09:49:25', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(54, '2022-04-26 09:49:37', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(55, '2022-04-26 09:56:47', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(56, '2022-04-26 10:02:46', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(57, '2022-04-26 10:07:32', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(58, '2022-04-26 10:14:36', 1, 'Commande client', 'Création d''un commande client :BC_2022_002', 0),
(59, '2022-04-26 10:14:42', 1, 'Commande client', 'Modification d''une commande client :BC_2022_002', 0),
(60, '2022-04-26 10:15:37', 1, 'Commande client', 'Modification d''une commande client :BC_2022_002', 0),
(61, '2022-04-26 10:17:07', 1, 'Commande client', 'Modification d''une commande client :BC_2022_001', 0),
(63, '2022-04-26 12:34:07', 1, 'Liste des prix peinture', 'Création d''une liste de prix :PX_2022_001', 0),
(64, '2022-04-26 12:37:01', 1, 'Liste des prix peinture', 'Création d''une liste de prix :PX_2022_001', 0),
(65, '2022-04-26 12:39:03', 1, 'Liste des prix peinture', 'Modification d''une liste de prix :PX_2022_001', 0),
(66, '2022-04-26 12:47:23', 1, 'Liste des prix peinture', 'Création d''une liste de prix :PX_2022_002', 0),
(67, '2022-04-27 08:28:50', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_003', 0),
(68, '2022-04-27 08:34:01', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_003', 0),
(69, '2022-04-27 08:35:38', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_003', 0),
(70, '2022-04-27 08:36:11', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_003', 0),
(71, '2022-04-27 08:42:05', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_006', 0),
(72, '2022-04-27 08:53:12', 1, 'Commande client', 'Modification d''une commande complémentaire :BC_2022_006', 0),
(73, '2022-04-27 09:01:39', 1, 'Commande client', 'Modification d''une commande complémentaire :BC_2022_006', 0),
(74, '2022-04-27 09:02:30', 1, 'Commande client', 'Modification d''une commande complémentaire :BC_2022_006', 0),
(75, '2022-04-27 09:02:39', 1, 'Commande client', 'Modification d''une commande complémentaire :BC_2022_006', 0),
(76, '2022-04-27 09:03:38', 1, 'Commande client', 'Modification d''une commande complémentaire :BC_2022_006', 0),
(77, '2022-04-27 09:07:07', 1, 'Commande client', 'Création d''une commande complémentaire :BC_2022_007', 0),
(78, '2022-04-28 07:56:07', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1200*500*600', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_mode`
--

CREATE TABLE IF NOT EXISTS `erp_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_mode`
--

INSERT INTO `erp_mode` (`id`, `mode`) VALUES
(1, 'Espèce'),
(2, 'Chèque'),
(3, 'Virement bancaire'),
(4, '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_phases`
--

CREATE TABLE IF NOT EXISTS `erp_phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `erp_phases`
--

INSERT INTO `erp_phases` (`id`, `phase`, `type`) VALUES
(1, 'BRUT', 1),
(2, 'FONT', 2),
(3, 'GRAT', 2),
(4, 'PONC', 2),
(6, 'CREPE', 2),
(7, 'MC', 2),
(8, 'PMC', 2),
(9, 'FIBRE', 2),
(10, 'PF', 2),
(11, 'PA', 2),
(12, 'APPR', 2),
(13, 'REV', 3),
(14, 'PEINT', 4),
(15, 'AUT', 2);

-- --------------------------------------------------------

--
-- Structure de la table `erp_prix_peinture`
--

CREATE TABLE IF NOT EXISTS `erp_prix_peinture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_prix_peinture`
--

INSERT INTO `erp_prix_peinture` (`id`, `reference`, `trimestre`, `annee`, `date`, `idutilisateur`, `dateheure`) VALUES
(1, 'PX_2022_001', 1, '2022', '2022-04-26', 1, '2022-04-26 12:34:07'),
(2, 'PX_2022_002', 2, '2022', '2022-04-26', 1, '2022-04-26 12:47:23');

-- --------------------------------------------------------

--
-- Structure de la table `erp_produits`
--

CREATE TABLE IF NOT EXISTS `erp_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `code_barre` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `unite` int(11) NOT NULL,
  `surface` varchar(255) NOT NULL,
  `famille` int(11) NOT NULL,
  `archive` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `semi_finis` int(11) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `erp_produits`
--

INSERT INTO `erp_produits` (`id`, `code`, `code_barre`, `designation`, `unite`, `surface`, `famille`, `archive`, `stock`, `prix`, `semi_finis`, `poids`, `volume`) VALUES
(21, '1000*500*500', '', 'DE0017 1000*500*500', 0, '', 0, 0, 0, '35', 0, '50', '80'),
(22, '2000*500*600', '', 'DE0012 2000*500*600', 0, '', 0, 0, 0, '55', 0, '', ''),
(23, '1500*500*600', '', 'DE0013 1500*500*600', 0, '', 0, 0, 0, '38', 0, '', ''),
(24, '1200*500*600', '', 'DE0014 1200*500*600', 0, '', 0, 0, 0, '22', 0, '', ''),
(25, '900*500*600', '', 'DE0015 900*500*600', 0, '', 0, 0, 0, '32', 0, '', ''),
(26, '1200*500*400', '', 'DE0016 1200*500*400', 0, '', 0, 0, 0, '27.5', 0, '30', '50'),
(27, '1500*400*400', '', 'DE0018 1500*400*400', 0, '', 0, 0, 0, '33.8', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_produits_phases`
--

CREATE TABLE IF NOT EXISTS `erp_produits_phases` (
  `idproduit` int(11) NOT NULL,
  `idphase` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `nomenclature_fabrication` int(11) NOT NULL,
  `date_maj` varchar(255) NOT NULL,
  `utilisateur_maj` int(11) NOT NULL,
  `sans_nm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `erp_produits_phases`
--

INSERT INTO `erp_produits_phases` (`idproduit`, `idphase`, `ordre`, `nomenclature_fabrication`, `date_maj`, `utilisateur_maj`, `sans_nm`) VALUES
(21, 12, 12, 0, '23/04/2022 09:49:56', 1, 0),
(21, 15, 10, 0, '23/04/2022 09:49:56', 1, 0),
(21, 1, 1, 0, '23/04/2022 09:49:56', 1, 0),
(21, 6, 5, 0, '23/04/2022 09:49:56', 1, 0),
(21, 9, 8, 0, '23/04/2022 09:49:56', 1, 0),
(21, 2, 2, 0, '23/04/2022 09:49:57', 1, 0),
(21, 3, 3, 0, '23/04/2022 09:49:57', 1, 0),
(21, 7, 6, 0, '23/04/2022 09:49:57', 1, 0),
(21, 11, 11, 0, '23/04/2022 09:49:57', 1, 0),
(21, 14, 14, 0, '23/04/2022 09:49:57', 1, 0),
(21, 10, 9, 0, '23/04/2022 09:49:57', 1, 0),
(21, 8, 7, 0, '23/04/2022 09:49:57', 1, 0),
(21, 4, 4, 0, '23/04/2022 09:49:57', 1, 0),
(21, 13, 13, 0, '23/04/2022 09:49:57', 1, 0),
(22, 12, 12, 0, '23/04/2022 09:50:38', 1, 0),
(22, 15, 10, 0, '23/04/2022 09:50:38', 1, 0),
(22, 1, 1, 0, '23/04/2022 09:50:38', 1, 0),
(22, 6, 5, 0, '23/04/2022 09:50:38', 1, 0),
(22, 9, 8, 0, '23/04/2022 09:50:38', 1, 0),
(22, 2, 2, 0, '23/04/2022 09:50:38', 1, 0),
(22, 3, 3, 0, '23/04/2022 09:50:38', 1, 0),
(22, 7, 6, 0, '23/04/2022 09:50:38', 1, 0),
(22, 11, 11, 0, '23/04/2022 09:50:38', 1, 0),
(22, 14, 14, 0, '23/04/2022 09:50:38', 1, 0),
(22, 10, 9, 0, '23/04/2022 09:50:38', 1, 0),
(22, 8, 7, 0, '23/04/2022 09:50:38', 1, 0),
(22, 4, 4, 0, '23/04/2022 09:50:38', 1, 0),
(22, 13, 13, 0, '23/04/2022 09:50:38', 1, 0),
(23, 12, 12, 0, '23/04/2022 09:51:03', 1, 0),
(23, 15, 10, 0, '23/04/2022 09:51:03', 1, 0),
(23, 1, 1, 0, '23/04/2022 09:51:03', 1, 0),
(23, 6, 5, 0, '23/04/2022 09:51:03', 1, 0),
(23, 9, 8, 0, '23/04/2022 09:51:03', 1, 0),
(23, 2, 2, 0, '23/04/2022 09:51:03', 1, 0),
(23, 3, 3, 0, '23/04/2022 09:51:03', 1, 0),
(23, 7, 6, 0, '23/04/2022 09:51:03', 1, 0),
(23, 11, 11, 0, '23/04/2022 09:51:03', 1, 0),
(23, 14, 14, 0, '23/04/2022 09:51:03', 1, 0),
(23, 10, 9, 0, '23/04/2022 09:51:03', 1, 0),
(23, 8, 7, 0, '23/04/2022 09:51:03', 1, 0),
(23, 4, 4, 0, '23/04/2022 09:51:03', 1, 0),
(23, 13, 13, 0, '23/04/2022 09:51:03', 1, 0),
(25, 12, 12, 0, '23/04/2022 09:52:14', 1, 0),
(25, 15, 10, 0, '23/04/2022 09:52:14', 1, 0),
(25, 1, 1, 0, '23/04/2022 09:52:14', 1, 0),
(25, 6, 5, 0, '23/04/2022 09:52:14', 1, 0),
(25, 9, 8, 0, '23/04/2022 09:52:14', 1, 0),
(25, 2, 2, 0, '23/04/2022 09:52:14', 1, 0),
(25, 3, 3, 0, '23/04/2022 09:52:14', 1, 0),
(25, 7, 6, 0, '23/04/2022 09:52:14', 1, 0),
(25, 11, 11, 0, '23/04/2022 09:52:14', 1, 0),
(25, 14, 14, 0, '23/04/2022 09:52:14', 1, 0),
(25, 10, 9, 0, '23/04/2022 09:52:14', 1, 0),
(25, 8, 7, 0, '23/04/2022 09:52:14', 1, 0),
(25, 4, 4, 0, '23/04/2022 09:52:14', 1, 0),
(25, 13, 13, 0, '23/04/2022 09:52:14', 1, 0),
(26, 12, 12, 0, '23/04/2022 09:52:47', 1, 0),
(26, 15, 10, 0, '23/04/2022 09:52:47', 1, 0),
(26, 1, 1, 0, '23/04/2022 09:52:47', 1, 0),
(26, 6, 5, 0, '23/04/2022 09:52:47', 1, 0),
(26, 9, 8, 0, '23/04/2022 09:52:47', 1, 0),
(26, 2, 2, 0, '23/04/2022 09:52:47', 1, 0),
(26, 3, 3, 0, '23/04/2022 09:52:47', 1, 0),
(26, 7, 6, 0, '23/04/2022 09:52:47', 1, 0),
(26, 11, 11, 0, '23/04/2022 09:52:47', 1, 0),
(26, 14, 14, 0, '23/04/2022 09:52:47', 1, 0),
(26, 10, 9, 0, '23/04/2022 09:52:47', 1, 0),
(26, 8, 7, 0, '23/04/2022 09:52:47', 1, 0),
(26, 4, 4, 0, '23/04/2022 09:52:47', 1, 0),
(26, 13, 13, 0, '23/04/2022 09:52:47', 1, 0),
(27, 12, 12, 0, '23/04/2022 09:53:20', 1, 0),
(27, 15, 10, 0, '23/04/2022 09:53:20', 1, 0),
(27, 1, 1, 0, '23/04/2022 09:53:20', 1, 0),
(27, 6, 5, 0, '23/04/2022 09:53:20', 1, 0),
(27, 9, 8, 0, '23/04/2022 09:53:20', 1, 0),
(27, 2, 2, 0, '23/04/2022 09:53:20', 1, 0),
(27, 3, 3, 0, '23/04/2022 09:53:20', 1, 0),
(27, 7, 6, 0, '23/04/2022 09:53:20', 1, 0),
(27, 11, 11, 0, '23/04/2022 09:53:20', 1, 0),
(27, 14, 14, 0, '23/04/2022 09:53:20', 1, 0),
(27, 10, 9, 0, '23/04/2022 09:53:20', 1, 0),
(27, 8, 7, 0, '23/04/2022 09:53:20', 1, 0),
(27, 4, 4, 0, '23/04/2022 09:53:20', 1, 0),
(27, 13, 13, 0, '23/04/2022 09:53:20', 1, 0),
(24, 15, 10, 0, '28/04/2022 07:56:06', 1, 0),
(24, 1, 1, 0, '28/04/2022 07:56:06', 1, 0),
(24, 6, 5, 0, '28/04/2022 07:56:06', 1, 0),
(24, 9, 8, 0, '28/04/2022 07:56:06', 1, 0),
(24, 2, 2, 0, '28/04/2022 07:56:06', 1, 0),
(24, 3, 3, 0, '28/04/2022 07:56:06', 1, 0),
(24, 7, 6, 0, '28/04/2022 07:56:06', 1, 0),
(24, 11, 11, 0, '28/04/2022 07:56:06', 1, 0),
(24, 14, 13, 0, '28/04/2022 07:56:07', 1, 0),
(24, 10, 9, 0, '28/04/2022 07:56:07', 1, 0),
(24, 8, 7, 0, '28/04/2022 07:56:07', 1, 0),
(24, 4, 4, 0, '28/04/2022 07:56:07', 1, 0),
(24, 13, 12, 0, '28/04/2022 07:56:07', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_profil`
--

CREATE TABLE IF NOT EXISTS `erp_profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `erp_profil`
--

INSERT INTO `erp_profil` (`id`, `profil`, `archive`) VALUES
(1, 'Super-Administrateur', 0),
(2, 'Utilisateur', 0),
(3, 'Chef Atelier', 0),
(4, 'Client', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_suivi`
--

CREATE TABLE IF NOT EXISTS `erp_suivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduit` int(11) NOT NULL,
  `idtableau` int(11) NOT NULL,
  `idphase` int(11) NOT NULL,
  `typephase` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=235 ;

--
-- Contenu de la table `erp_suivi`
--

INSERT INTO `erp_suivi` (`id`, `idproduit`, `idtableau`, `idphase`, `typephase`, `quantite`) VALUES
(183, 21, 1, 1, 1, 3),
(184, 21, 1, 2, 2, 2),
(185, 21, 1, 3, 2, 0),
(186, 21, 1, 4, 2, 5),
(187, 21, 1, 6, 2, 0),
(188, 21, 1, 7, 2, 0),
(189, 21, 1, 8, 2, 0),
(190, 21, 1, 9, 2, 0),
(191, 21, 1, 10, 2, 0),
(192, 21, 1, 15, 2, 0),
(193, 21, 1, 11, 2, 0),
(194, 21, 1, 12, 2, 0),
(195, 21, 1, 13, 3, 0),
(196, 21, 2, 1, 1, 1),
(197, 21, 2, 2, 2, 0),
(198, 21, 2, 3, 2, 0),
(199, 21, 2, 4, 2, 0),
(200, 21, 2, 6, 2, 0),
(201, 21, 2, 7, 2, 0),
(202, 21, 2, 8, 2, 0),
(203, 21, 2, 9, 2, 0),
(204, 21, 2, 10, 2, 0),
(205, 21, 2, 15, 2, 0),
(206, 21, 2, 11, 2, 0),
(207, 21, 2, 12, 2, 0),
(208, 21, 2, 13, 3, 0),
(209, 21, 3, 1, 1, 1),
(210, 21, 3, 2, 2, 0),
(211, 21, 3, 3, 2, 0),
(212, 21, 3, 4, 2, 0),
(213, 21, 3, 6, 2, 0),
(214, 21, 3, 7, 2, 0),
(215, 21, 3, 8, 2, 0),
(216, 21, 3, 9, 2, 0),
(217, 21, 3, 10, 2, 0),
(218, 21, 3, 15, 2, 0),
(219, 21, 3, 11, 2, 0),
(220, 21, 3, 12, 2, 0),
(221, 21, 3, 13, 3, 0),
(222, 21, 4, 1, 1, 0),
(223, 21, 4, 2, 2, 2),
(224, 21, 4, 3, 2, 2),
(225, 21, 4, 4, 2, 0),
(226, 21, 4, 6, 2, 0),
(227, 21, 4, 7, 2, 0),
(228, 21, 4, 8, 2, 0),
(229, 21, 4, 9, 2, 0),
(230, 21, 4, 10, 2, 0),
(231, 21, 4, 15, 2, 0),
(232, 21, 4, 11, 2, 0),
(233, 21, 4, 12, 2, 0),
(234, 21, 4, 13, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_tableau`
--

CREATE TABLE IF NOT EXISTS `erp_tableau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idutilisateur` int(11) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_tableau`
--

INSERT INTO `erp_tableau` (`id`, `idutilisateur`, `dateheure`) VALUES
(1, 1, '2022-04-29 11:06:42'),
(2, 1, '2022-04-29 11:08:13'),
(3, 1, '2022-04-29 11:09:57'),
(4, 1, '2022-04-29 11:14:48');

-- --------------------------------------------------------

--
-- Structure de la table `erp_trimestre`
--

CREATE TABLE IF NOT EXISTS `erp_trimestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trimestre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `erp_trimestre`
--

INSERT INTO `erp_trimestre` (`id`, `trimestre`) VALUES
(1, 'T1'),
(2, 'T2'),
(3, 'T3'),
(4, 'T4');

-- --------------------------------------------------------

--
-- Structure de la table `erp_typephases`
--

CREATE TABLE IF NOT EXISTS `erp_typephases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_typephases`
--

INSERT INTO `erp_typephases` (`id`, `type`) VALUES
(1, 'BACS STRATIFIES'),
(2, 'BACS EN PHASE DE FINITION'),
(3, 'BACS SEMI-FINIS'),
(4, 'BACS EN PHASE PEINTURE');

-- --------------------------------------------------------

--
-- Structure de la table `erp_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `erp_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `idprofil` int(11) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_utilisateurs`
--

INSERT INTO `erp_utilisateurs` (`id`, `nom`, `prenom`, `mail`, `motdepasse`, `idprofil`, `archive`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '123', 1, 0),
(2, 'magasin', 'magasin', 'magasin@magasin.com', '123', 3, 0),
(3, 'user1', 'user1', 'user@user', '123', 5, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
