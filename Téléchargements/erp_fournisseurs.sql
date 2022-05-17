-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 13 Avril 2022 à 07:51
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `erp`
--

-- --------------------------------------------------------

--
-- Structure de la table `erp_fournisseurs`
--

CREATE TABLE IF NOT EXISTS `erp_fournisseurs` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_fournisseurs`
--

INSERT INTO `erp_fournisseurs` (`id`, `raisonsocial`, `adresse`, `pays`, `telephone`, `mail`, `personne`, `gsm`, `archive`) VALUES
(3, 'Fournisseur 1', 'Rue de nice\r\nParis', 'France', '25011203', 'mail_frn@mail.fr', 'Ben foulen foulen', '99251425', 0),
(4, 'Fournisseur ABC', '', '', '', 'mail@mail.fr', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
