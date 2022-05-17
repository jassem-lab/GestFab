-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 28 Avril 2022 à 14:08
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
