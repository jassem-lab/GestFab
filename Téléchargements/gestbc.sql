-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 25 Avril 2022 à 13:36
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
-- Structure de la table `erp_famille_couleur`
--

CREATE TABLE IF NOT EXISTS `erp_famille_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_famille_couleur`
--

INSERT INTO `erp_famille_couleur` (`id`, `famille`) VALUES
(1, 'Standard (STD)'),
(2, 'Spécial (SP)');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

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
(39, '2022-04-23 10:08:56', 1, 'Table de base - Couleur ', 'Création d''un Couleur :BRUN CUIVRET 8004', 0);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `erp_produits`
--

INSERT INTO `erp_produits` (`id`, `code`, `code_barre`, `designation`, `unite`, `surface`, `famille`, `archive`, `stock`, `prix`, `semi_finis`) VALUES
(21, '1000*500*500', '', 'DE0017 1000*500*500', 0, '', 0, 0, 0, '35', 0),
(22, '2000*500*600', '', 'DE0012 2000*500*600', 0, '', 0, 0, 0, '55', 0),
(23, '1500*500*600', '', 'DE0013 1500*500*600', 0, '', 0, 0, 0, '38', 0),
(24, '1200*500*600', '', 'DE0014 1200*500*600', 0, '', 0, 0, 0, '22', 0),
(25, '900*500*600', '', 'DE0015 900*500*600', 0, '', 0, 0, 0, '32', 0),
(26, '1000*500*500', '', 'DE0016 1000*500*500', 0, '', 0, 0, 0, '27.5', 0),
(27, '1500*400*400', '', 'DE0018 1500*400*400', 0, '', 0, 0, 0, '33.8', 0);

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
(24, 12, 12, 0, '23/04/2022 09:52:13', 1, 0),
(24, 15, 10, 0, '23/04/2022 09:52:13', 1, 0),
(24, 1, 1, 0, '23/04/2022 09:52:13', 1, 0),
(24, 6, 5, 0, '23/04/2022 09:52:13', 1, 0),
(24, 9, 8, 0, '23/04/2022 09:52:13', 1, 0),
(24, 2, 2, 0, '23/04/2022 09:52:13', 1, 0),
(24, 3, 3, 0, '23/04/2022 09:52:13', 1, 0),
(24, 7, 6, 0, '23/04/2022 09:52:13', 1, 0),
(24, 11, 11, 0, '23/04/2022 09:52:13', 1, 0),
(24, 14, 14, 0, '23/04/2022 09:52:13', 1, 0),
(24, 10, 9, 0, '23/04/2022 09:52:13', 1, 0),
(24, 8, 7, 0, '23/04/2022 09:52:13', 1, 0),
(24, 4, 4, 0, '23/04/2022 09:52:13', 1, 0),
(24, 13, 13, 0, '23/04/2022 09:52:13', 1, 0),
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
(27, 13, 13, 0, '23/04/2022 09:53:20', 1, 0);

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
