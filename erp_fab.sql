-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2022 at 10:32 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erp_fab`
--
CREATE DATABASE IF NOT EXISTS `erp_fab` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `erp_fab`;

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_classe`
--

CREATE TABLE IF NOT EXISTS `erp_fab_classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `erp_fab_classe`
--

INSERT INTO `erp_fab_classe` (`id`, `classe`) VALUES
(1, 'TN'),
(2, 'MT');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_cliches`
--

CREATE TABLE IF NOT EXISTS `erp_fab_cliches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliche` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `erp_fab_cliches`
--

INSERT INTO `erp_fab_cliches` (`id`, `cliche`, `designation`) VALUES
(1, 'M41450', 'DES M41450'),
(2, 'M41449', 'DES M41449'),
(7, 'M41448', 'M41448'),
(8, 'M41447', 'M41447'),
(9, 'M41446', 'M41446'),
(10, 'M41451', 'DES M41451'),
(11, 'M41452', 'DES M41452');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_clients`
--

CREATE TABLE IF NOT EXISTS `erp_fab_clients` (
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
-- Dumping data for table `erp_fab_clients`
--

INSERT INTO `erp_fab_clients` (`id`, `raisonsocial`, `adresse`, `pays`, `telephone`, `mail`, `personne`, `gsm`, `archive`) VALUES
(1, 'Client', 'Malta', 'Malta', '99 55 22 11 44', 'client@client.fr', 'client', '99 55 22 11 44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_couleurs`
--

CREATE TABLE IF NOT EXISTS `erp_fab_couleurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `erp_fab_couleurs`
--

INSERT INTO `erp_fab_couleurs` (`id`, `couleur`, `designation`) VALUES
(2, 'F73421000', 'CAMFRCTBRN'),
(3, 'F75021000', 'CEMGRY'),
(5, 'F75021000', 'ZEMGRY');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_jig`
--

CREATE TABLE IF NOT EXISTS `erp_fab_jig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jig` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `erp_fab_jig`
--

INSERT INTO `erp_fab_jig` (`id`, `jig`, `designation`) VALUES
(1, '3197920', 'DES 3197920'),
(2, '3197921', 'DES 3197921'),
(3, '3197922', 'DES 3197922'),
(5, '3197923', 'DES 3197923');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_log`
--

CREATE TABLE IF NOT EXISTS `erp_fab_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `action` varchar(1024) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `erp_fab_log`
--

INSERT INTO `erp_fab_log` (`id`, `dateheure`, `idutilisateur`, `document`, `action`, `iddoc`) VALUES
(1, '2022-05-20 14:15:59', 1, 'Table de base - Classe ', 'Création d''une Classe:TN', 0),
(2, '2022-05-20 14:16:02', 1, 'Table de base - Classe ', 'Création d''une Classe:MT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_moules`
--

CREATE TABLE IF NOT EXISTS `erp_fab_moules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moule` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `erp_fab_moules`
--

INSERT INTO `erp_fab_moules` (`id`, `moule`, `designation`) VALUES
(1, '3222080', 'DES 3222080'),
(2, '3280701', 'DES 3280701'),
(3, '3300370', 'DES 3300370'),
(4, '3222081', 'DES 3222081');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_produits`
--

CREATE TABLE IF NOT EXISTS `erp_fab_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `code_barre` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `semi` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `erp_fab_produits`
--

INSERT INTO `erp_fab_produits` (`id`, `code`, `code_barre`, `designation`, `prix`, `semi`, `type`, `archive`) VALUES
(1, '30063184', '', 'SEAT:QUAD', '100', 0, 0, 0),
(2, '30063164', '30063164', 'CHASSIS:QUAD II,', '0', 0, 0, 0),
(3, '30063154', '', 'BONNET:QUAD 16', '0', 0, 0, 0),
(4, '30063174', '', 'BODY:QUAD III', '0', 0, 0, 0),
(5, '30253480', '', 'SEAT QUAD', '0', 0, 0, 0),
(6, '30076484', '', 'BINOCULARS', '0', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_produits_service`
--

CREATE TABLE IF NOT EXISTS `erp_fab_produits_service` (
  `idproduit` int(11) NOT NULL,
  `idservice` int(11) NOT NULL,
  `temps_execution` int(11) NOT NULL,
  `couleur` int(11) NOT NULL,
  `cliche` int(11) NOT NULL,
  `jig` int(11) NOT NULL,
  `moule` int(11) NOT NULL,
  `box_qty` int(11) NOT NULL,
  `poids_net` varchar(255) NOT NULL,
  `poids_brute` varchar(255) NOT NULL,
  `cavity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_profil`
--

CREATE TABLE IF NOT EXISTS `erp_fab_profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `erp_fab_profil`
--

INSERT INTO `erp_fab_profil` (`id`, `profil`, `archive`) VALUES
(1, 'Super-Administrateur', 0),
(2, 'Utilisateur', 0),
(4, 'Client', 0);

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_service`
--

CREATE TABLE IF NOT EXISTS `erp_fab_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `erp_fab_service`
--

INSERT INTO `erp_fab_service` (`id`, `service`) VALUES
(1, 'Injection (Injected)'),
(2, 'Peinture (Printed)'),
(3, 'Pulvérisée (sprayed)');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fab_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `erp_fab_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `idprofil` int(11) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `erp_fab_utilisateurs`
--

INSERT INTO `erp_fab_utilisateurs` (`id`, `nom`, `prenom`, `mail`, `motdepasse`, `idprofil`, `archive`) VALUES
(1, 'super', 'administrateur', 'admin@admin.com', '123', 1, 0),
(5, 'user', 'user', 'use@user.fr', '123456', 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
