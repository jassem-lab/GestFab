-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Mai 2022 à 07:24
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
-- Structure de la table `erp_bc_det_bl`
--

CREATE TABLE IF NOT EXISTS `erp_bc_det_bl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbl` int(11) NOT NULL,
  `iddetbc` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` varchar(255) NOT NULL,
  `prix_total` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `erp_bc_det_bl`
--

INSERT INTO `erp_bc_det_bl` (`id`, `idbl`, `iddetbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES
(1, 1, 1, 21, 3, '35', '105', '50', '80'),
(2, 1, 1, 21, 2, '35', '175', '50', '80'),
(3, 1, 16, 21, 1, '35', '35', '50', '80'),
(4, 1, 16, 21, 1, '35', '70', '50', '80'),
(5, 1, 19, 21, 2, '37', '74', '50', '80'),
(6, 1, 8, 24, 1, '22', '22', '', ''),
(7, 1, 6, 26, 1, '27.5', '27.5', '30', '50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
