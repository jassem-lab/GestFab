-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 05 Mai 2022 à 20:14
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
-- Structure de la table `erp_bc_bc`
--

CREATE TABLE IF NOT EXISTS `erp_bc_factsf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `client` int(11) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `mois` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `erp_bc_bc`
--

INSERT INTO `erp_bc_bc` (`id`, `reference`, `idbc_original`, `client`, `trimestre`, `annee`, `date`, `dateheure`, `idutilisateur`, `montant`, `etat`, `remarque`, `type`) VALUES
(1, 'BC_2022_001', 0, 1, 1, '2022', '2022-04-26', '2022-04-26 09:48:15', 1, '428', 0, '', 0),
(2, 'BC_2022_002', 0, 1, 2, '2022', '2022-04-26', '2022-04-26 10:14:35', 1, '274', 0, '', 0),
(3, 'BC_2022_006', 1, 1, 1, '2022', '2022-04-27', '2022-04-27 08:42:05', 1, '119.5', 0, '1 ére commande complémentaire', 1),
(4, 'BC_2022_007', 1, 1, 1, '2022', '2022-04-27', '2022-04-27 09:07:07', 1, '74', 0, '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_bl`
--

CREATE TABLE IF NOT EXISTS `erp_bc_bl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `idbc_original` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `semaine` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_br`
--

CREATE TABLE IF NOT EXISTS `erp_bc_br` (
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `erp_bc_br`
--

INSERT INTO `erp_bc_br` (`id`, `reference`, `idbc_original`, `client`, `date`, `dateheure`, `idutilisateur`, `montant`, `etat`, `remarque`, `type`) VALUES
(1, 'BR_2022_010', 1, 1, '2022-04-28', '2022-04-28 13:39:58', 1, '70', 0, '', 0),
(2, 'BR_2022_010', 1, 1, '2022-04-28', '2022-04-28 13:40:35', 1, '25', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_clients`
--

CREATE TABLE IF NOT EXISTS `erp_bc_clients` (
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
-- Contenu de la table `erp_bc_clients`
--

INSERT INTO `erp_bc_clients` (`id`, `raisonsocial`, `adresse`, `pays`, `telephone`, `mail`, `personne`, `gsm`, `archive`) VALUES
(1, 'SO GARDEN', '', '', '', 'so_garden@mail.com', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_bc`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `erp_bc_compteur_bc`
--

INSERT INTO `erp_bc_compteur_bc` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1),
(2, '2022', '002', 2),
(4, '2022', '003', 3),
(5, '2022', '004', 4),
(6, '2022', '005', 5),
(7, '2022', '006', 3),
(8, '2022', '007', 4);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_bl`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_bl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_br`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_br` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_factstock`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_factstock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_compteur_factstock`
--

INSERT INTO `erp_bc_compteur_factstock` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_prix`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_prix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_compteur_prix`
--

INSERT INTO `erp_bc_compteur_prix` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1),
(2, '2022', '002', 2);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_compteur_tableau`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_tableau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_contenumail`
--

CREATE TABLE IF NOT EXISTS `erp_bc_contenumail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typemail` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_contenumail`
--

INSERT INTO `erp_bc_contenumail` (`id`, `typemail`, `contenu`, `active`) VALUES
(1, 'Génération BL', 'Bonjour,\r\nC''est un mail de test', 1),
(2, 'Genération facture semi finis', 'Bonjour,\r\nC''est un mail de test  - Génération facture semi finis', 1);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_couleur`
--

CREATE TABLE IF NOT EXISTS `erp_bc_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couleur` varchar(255) NOT NULL,
  `famille` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `erp_bc_couleur`
--

INSERT INTO `erp_bc_couleur` (`id`, `couleur`, `famille`) VALUES
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
-- Structure de la table `erp_bc_det_bc`
--

CREATE TABLE IF NOT EXISTS `erp_bc_det_bc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idbc` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` varchar(255) NOT NULL,
  `prix_total` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `qte_livree` int(11) NOT NULL,
  `qte_stratifies` int(11) NOT NULL,
  `qte_finis` int(11) NOT NULL,
  `qte_semifinis` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `erp_bc_det_bc`
--

INSERT INTO `erp_bc_det_bc` (`id`, `idbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`, `qte_livree`, `qte_stratifies`, `qte_finis`, `qte_semifinis`) VALUES
(1, 1, 21, 5, '35', '175', '50', '80', 0, 0, 0, 0),
(6, 1, 26, 6, '27.5', '165', '30', '50', 0, 0, 0, 0),
(8, 1, 24, 4, '22', '88', '', '', 0, 0, 0, 0),
(9, 2, 27, 5, '33.8', '169', '', '', 0, 0, 0, 0),
(10, 2, 21, 3, '35', '105', '50', '80', 0, 0, 0, 0),
(11, 2, 24, 1, '22', '0', '', '', 0, 0, 0, 0),
(16, 3, 21, 2, '35', '70', '50', '80', 0, 0, 0, 0),
(17, 3, 26, 1, '27.5', '27.5', '30', '50', 0, 0, 0, 0),
(18, 3, 24, 1, '22', '22', '', '', 0, 0, 0, 0),
(19, 4, 21, 2, '37', '74', '50', '80', 0, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_det_br`
--

CREATE TABLE IF NOT EXISTS `erp_bc_det_br` (
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
-- Structure de la table `erp_bc_det_prix`
--

CREATE TABLE IF NOT EXISTS `erp_bc_det_prix` (
  `idprix` int(11) NOT NULL,
  `famillecouleur` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `erp_bc_det_prix`
--

INSERT INTO `erp_bc_det_prix` (`idprix`, `famillecouleur`, `produit`, `prix`) VALUES
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
-- Structure de la table `erp_bc_facturestock`
--

CREATE TABLE IF NOT EXISTS `erp_bc_facturestock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_facturestock`
--

INSERT INTO `erp_bc_facturestock` (`id`, `reference`, `date`, `dateheure`, `idutilisateur`, `stock`, `montant`) VALUES
(1, 'FC_STK_2022_001', '2022-05-04', '2022-05-04 08:28:43', 1, 500, '300');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_famillesprd`
--

CREATE TABLE IF NOT EXISTS `erp_bc_famillesprd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_famillesprd`
--

INSERT INTO `erp_bc_famillesprd` (`id`, `famille`, `archive`) VALUES
(1, 'bacs', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_famille_couleur`
--

CREATE TABLE IF NOT EXISTS `erp_bc_famille_couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `famille` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_bc_famille_couleur`
--

INSERT INTO `erp_bc_famille_couleur` (`id`, `famille`) VALUES
(1, 'Standard mat (STD Mat)'),
(2, 'Spécial mat (SP Mat)'),
(3, 'Standard brillant'),
(4, 'spécial brillant');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_famproduits_phases`
--

CREATE TABLE IF NOT EXISTS `erp_bc_famproduits_phases` (
  `ifamilledproduit` int(11) NOT NULL,
  `idphase` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `nomenclature_fabrication` int(11) NOT NULL,
  `date_maj` varchar(255) NOT NULL,
  `utilisateur_maj` int(11) NOT NULL,
  `sans_nm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `erp_bc_famproduits_phases`
--

INSERT INTO `erp_bc_famproduits_phases` (`ifamilledproduit`, `idphase`, `ordre`, `nomenclature_fabrication`, `date_maj`, `utilisateur_maj`, `sans_nm`) VALUES
(1, 12, 12, 0, '04/05/2022 08:48:29', 1, 0),
(1, 15, 10, 0, '04/05/2022 08:48:29', 1, 0),
(1, 1, 1, 0, '04/05/2022 08:48:30', 1, 0),
(1, 6, 5, 0, '04/05/2022 08:48:30', 1, 0),
(1, 14, 14, 0, '04/05/2022 08:48:30', 1, 0),
(1, 9, 8, 0, '04/05/2022 08:48:30', 1, 0),
(1, 2, 2, 0, '04/05/2022 08:48:30', 1, 0),
(1, 3, 3, 0, '04/05/2022 08:48:30', 1, 0),
(1, 7, 6, 0, '04/05/2022 08:48:30', 1, 0),
(1, 11, 11, 0, '04/05/2022 08:48:30', 1, 0),
(1, 10, 9, 0, '04/05/2022 08:48:30', 1, 0),
(1, 8, 7, 0, '04/05/2022 08:48:30', 1, 0),
(1, 4, 4, 0, '04/05/2022 08:48:30', 1, 0),
(1, 13, 13, 0, '04/05/2022 08:48:30', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_intervalles`
--

CREATE TABLE IF NOT EXISTS `erp_bc_intervalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compteur_deb` int(11) NOT NULL,
  `compteur_fin` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `erp_bc_intervalles`
--

INSERT INTO `erp_bc_intervalles` (`id`, `compteur_deb`, `compteur_fin`, `prix`, `idutilisateur`, `dateheure`, `archive`) VALUES
(8, 0, 1000, 300, 0, '2022-04-27 10:04:28', 0),
(9, 1001, 1500, 450, 0, '2022-04-27 10:04:42', 0),
(10, 1501, 2000, 700, 0, '2022-04-27 10:04:54', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_log`
--

CREATE TABLE IF NOT EXISTS `erp_bc_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `document` varchar(255) NOT NULL,
  `action` varchar(1024) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `erp_bc_log`
--

INSERT INTO `erp_bc_log` (`id`, `dateheure`, `idutilisateur`, `document`, `action`, `iddoc`) VALUES
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
(78, '2022-04-28 07:56:07', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1200*500*600', 0),
(79, '2022-05-01 22:08:36', 1, 'Table de base - Famille PF ', 'Création d''une famille PF :bacs', 0),
(80, '2022-05-02 10:51:41', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :', 0),
(81, '2022-05-02 10:53:26', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(82, '2022-05-02 20:27:56', 1, 'Table de base - FP', 'Modification d''un Produit finis :1000*500*500', 0),
(83, '2022-05-02 20:53:57', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :1000*500*500', 0),
(84, '2022-05-04 08:28:43', 1, 'Facture stockage', 'Création d''une facture de stock :FC_STK_2022_001', 0),
(85, '2022-05-04 08:29:09', 1, 'Facture stockage', 'Modification d''une facture de stock :FC_STK_2022_001', 0),
(86, '2022-05-04 08:48:30', 1, 'Phase Produit finis', 'Afféctation des phase pour le produit  :', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_mode`
--

CREATE TABLE IF NOT EXISTS `erp_bc_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_bc_mode`
--

INSERT INTO `erp_bc_mode` (`id`, `mode`) VALUES
(1, 'Espèce'),
(2, 'Chèque'),
(3, 'Virement bancaire'),
(4, '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_phases`
--

CREATE TABLE IF NOT EXISTS `erp_bc_phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `erp_bc_phases`
--

INSERT INTO `erp_bc_phases` (`id`, `phase`, `type`) VALUES
(1, 'BRUT', 1),
(2, 'FONT', 2),
(3, 'GRAT', 2),
(4, 'PONC', 2),
(6, 'CREPE', 2),
(7, 'MC', 2),
(8, 'PMC', 2),
(9, 'FIBRE', 2),
(10, 'PF', 3),
(11, 'PA', 3),
(12, 'APPR', 3),
(13, 'REV', 3),
(14, 'Valider pour livrée', 4),
(15, 'AUT', 3),
(16, 'PEINT', 5);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_prix_peinture`
--

CREATE TABLE IF NOT EXISTS `erp_bc_prix_peinture` (
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
-- Contenu de la table `erp_bc_prix_peinture`
--

INSERT INTO `erp_bc_prix_peinture` (`id`, `reference`, `trimestre`, `annee`, `date`, `idutilisateur`, `dateheure`) VALUES
(1, 'PX_2022_001', 1, '2022', '2022-04-26', 1, '2022-04-26 12:34:07'),
(2, 'PX_2022_002', 2, '2022', '2022-04-26', 1, '2022-04-26 12:47:23');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_produits`
--

CREATE TABLE IF NOT EXISTS `erp_bc_produits` (
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
-- Contenu de la table `erp_bc_produits`
--

INSERT INTO `erp_bc_produits` (`id`, `code`, `code_barre`, `designation`, `unite`, `surface`, `famille`, `archive`, `stock`, `prix`, `semi_finis`, `poids`, `volume`) VALUES
(21, '1000*500*500', '', 'DE0017 1000*500*500', 0, '', 1, 0, 0, '35', 0, '50', '80'),
(22, '2000*500*600', '', 'DE0012 2000*500*600', 0, '', 1, 0, 0, '55', 0, '', ''),
(23, '1500*500*600', '', 'DE0013 1500*500*600', 0, '', 1, 0, 0, '38', 0, '', ''),
(24, '1200*500*600', '', 'DE0014 1200*500*600', 0, '', 1, 0, 0, '22', 0, '', ''),
(25, '900*500*600', '', 'DE0015 900*500*600', 0, '', 1, 0, 0, '32', 0, '', ''),
(26, '1200*500*400', '', 'DE0016 1200*500*400', 0, '', 1, 0, 0, '27.5', 0, '30', '50'),
(27, '1500*400*400', '', 'DE0018 1500*400*400', 0, '', 1, 0, 0, '33.8', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_produits_phases`
--

CREATE TABLE IF NOT EXISTS `erp_bc_produits_phases` (
  `idproduit` int(11) NOT NULL,
  `idphase` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `nomenclature_fabrication` int(11) NOT NULL,
  `date_maj` varchar(255) NOT NULL,
  `utilisateur_maj` int(11) NOT NULL,
  `sans_nm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `erp_bc_produits_phases`
--

INSERT INTO `erp_bc_produits_phases` (`idproduit`, `idphase`, `ordre`, `nomenclature_fabrication`, `date_maj`, `utilisateur_maj`, `sans_nm`) VALUES
(26, 12, 12, 0, '02/05/2022 10:53:25', 1, 0),
(26, 15, 10, 0, '02/05/2022 10:53:26', 1, 0),
(26, 1, 1, 0, '02/05/2022 10:53:26', 1, 0),
(26, 6, 5, 0, '02/05/2022 10:53:26', 1, 0),
(26, 9, 8, 0, '02/05/2022 10:53:26', 1, 0),
(26, 2, 2, 0, '02/05/2022 10:53:26', 1, 0),
(26, 3, 3, 0, '02/05/2022 10:53:26', 1, 0),
(26, 7, 6, 0, '02/05/2022 10:53:26', 1, 0),
(26, 11, 11, 0, '02/05/2022 10:53:26', 1, 0),
(26, 14, 14, 0, '02/05/2022 10:53:26', 1, 0),
(26, 10, 9, 0, '02/05/2022 10:53:26', 1, 0),
(26, 8, 7, 0, '02/05/2022 10:53:26', 1, 0),
(26, 4, 4, 0, '02/05/2022 10:53:26', 1, 0),
(26, 13, 13, 0, '02/05/2022 10:53:26', 1, 0),
(24, 12, 12, 0, '02/05/2022 10:53:25', 1, 0),
(24, 15, 10, 0, '02/05/2022 10:53:24', 1, 0),
(24, 1, 1, 0, '02/05/2022 10:53:24', 1, 0),
(24, 6, 5, 0, '02/05/2022 10:53:24', 1, 0),
(24, 9, 8, 0, '02/05/2022 10:53:24', 1, 0),
(24, 2, 2, 0, '02/05/2022 10:53:24', 1, 0),
(24, 3, 3, 0, '02/05/2022 10:53:24', 1, 0),
(24, 7, 6, 0, '02/05/2022 10:53:24', 1, 0),
(24, 11, 11, 0, '02/05/2022 10:53:24', 1, 0),
(24, 14, 14, 0, '02/05/2022 10:53:24', 1, 0),
(24, 10, 9, 0, '02/05/2022 10:53:24', 1, 0),
(24, 8, 7, 0, '02/05/2022 10:53:24', 1, 0),
(24, 4, 4, 0, '02/05/2022 10:53:24', 1, 0),
(24, 13, 13, 0, '02/05/2022 10:53:24', 1, 0),
(27, 12, 12, 0, '02/05/2022 10:53:25', 1, 0),
(27, 15, 10, 0, '02/05/2022 10:53:27', 1, 0),
(27, 1, 1, 0, '02/05/2022 10:53:27', 1, 0),
(27, 6, 5, 0, '02/05/2022 10:53:27', 1, 0),
(27, 9, 8, 0, '02/05/2022 10:53:27', 1, 0),
(27, 2, 2, 0, '02/05/2022 10:53:27', 1, 0),
(27, 3, 3, 0, '02/05/2022 10:53:27', 1, 0),
(27, 7, 6, 0, '02/05/2022 10:53:27', 1, 0),
(27, 11, 11, 0, '02/05/2022 10:53:27', 1, 0),
(27, 14, 14, 0, '02/05/2022 10:53:27', 1, 0),
(27, 10, 9, 0, '02/05/2022 10:53:27', 1, 0),
(27, 8, 7, 0, '02/05/2022 10:53:27', 1, 0),
(27, 4, 4, 0, '02/05/2022 10:53:27', 1, 0),
(27, 13, 13, 0, '02/05/2022 10:53:27', 1, 0),
(23, 12, 12, 0, '02/05/2022 10:53:25', 1, 0),
(23, 15, 10, 0, '02/05/2022 10:53:23', 1, 0),
(23, 1, 1, 0, '02/05/2022 10:53:23', 1, 0),
(23, 6, 5, 0, '02/05/2022 10:53:23', 1, 0),
(23, 9, 8, 0, '02/05/2022 10:53:23', 1, 0),
(23, 2, 2, 0, '02/05/2022 10:53:23', 1, 0),
(23, 3, 3, 0, '02/05/2022 10:53:23', 1, 0),
(23, 7, 6, 0, '02/05/2022 10:53:23', 1, 0),
(23, 11, 11, 0, '02/05/2022 10:53:23', 1, 0),
(23, 14, 14, 0, '02/05/2022 10:53:23', 1, 0),
(23, 10, 9, 0, '02/05/2022 10:53:23', 1, 0),
(23, 8, 7, 0, '02/05/2022 10:53:23', 1, 0),
(23, 4, 4, 0, '02/05/2022 10:53:23', 1, 0),
(23, 13, 13, 0, '02/05/2022 10:53:23', 1, 0),
(22, 12, 12, 0, '02/05/2022 10:53:25', 1, 0),
(22, 15, 10, 0, '02/05/2022 10:53:22', 1, 0),
(22, 1, 1, 0, '02/05/2022 10:53:22', 1, 0),
(22, 6, 5, 0, '02/05/2022 10:53:22', 1, 0),
(22, 9, 8, 0, '02/05/2022 10:53:22', 1, 0),
(22, 2, 2, 0, '02/05/2022 10:53:22', 1, 0),
(22, 3, 3, 0, '02/05/2022 10:53:22', 1, 0),
(22, 7, 6, 0, '02/05/2022 10:53:22', 1, 0),
(22, 11, 11, 0, '02/05/2022 10:53:22', 1, 0),
(22, 14, 14, 0, '02/05/2022 10:53:22', 1, 0),
(22, 10, 9, 0, '02/05/2022 10:53:22', 1, 0),
(22, 8, 7, 0, '02/05/2022 10:53:22', 1, 0),
(22, 4, 4, 0, '02/05/2022 10:53:22', 1, 0),
(22, 13, 13, 0, '02/05/2022 10:53:22', 1, 0),
(25, 12, 12, 0, '02/05/2025 10:53:25', 1, 0),
(25, 15, 10, 0, '02/05/2025 10:53:25', 1, 0),
(25, 1, 1, 0, '02/05/2025 10:53:25', 1, 0),
(25, 6, 5, 0, '02/05/2025 10:53:25', 1, 0),
(25, 9, 8, 0, '02/05/2025 10:53:25', 1, 0),
(25, 2, 2, 0, '02/05/2025 10:53:25', 1, 0),
(25, 3, 3, 0, '02/05/2025 10:53:25', 1, 0),
(25, 7, 6, 0, '02/05/2025 10:53:25', 1, 0),
(25, 11, 11, 0, '02/05/2025 10:53:25', 1, 0),
(25, 14, 14, 0, '02/05/2025 10:53:25', 1, 0),
(25, 10, 9, 0, '02/05/2025 10:53:25', 1, 0),
(25, 8, 7, 0, '02/05/2025 10:53:25', 1, 0),
(25, 4, 4, 0, '02/05/2025 10:53:25', 1, 0),
(25, 13, 13, 0, '02/05/2025 10:53:25', 1, 0),
(21, 12, 12, 0, '02/05/2022 20:53:56', 1, 0),
(21, 15, 10, 0, '02/05/2022 20:53:56', 1, 0),
(21, 1, 1, 0, '02/05/2022 20:53:56', 1, 0),
(21, 6, 5, 0, '02/05/2022 20:53:56', 1, 0),
(21, 9, 8, 0, '02/05/2022 20:53:56', 1, 0),
(21, 2, 2, 0, '02/05/2022 20:53:57', 1, 0),
(21, 7, 6, 0, '02/05/2022 20:53:57', 1, 0),
(21, 11, 11, 0, '02/05/2022 20:53:57', 1, 0),
(21, 14, 14, 0, '02/05/2022 20:53:57', 1, 0),
(21, 10, 9, 0, '02/05/2022 20:53:57', 1, 0),
(21, 8, 7, 0, '02/05/2022 20:53:57', 1, 0),
(21, 4, 4, 0, '02/05/2022 20:53:57', 1, 0),
(21, 13, 13, 0, '02/05/2022 20:53:57', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_profil`
--

CREATE TABLE IF NOT EXISTS `erp_bc_profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profil` varchar(255) NOT NULL,
  `archive` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `erp_bc_profil`
--

INSERT INTO `erp_bc_profil` (`id`, `profil`, `archive`) VALUES
(1, 'Super-Administrateur', 0),
(2, 'Utilisateur', 0),
(3, 'Chef Atelier', 0),
(4, 'Client', 0);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_suivi`
--

CREATE TABLE IF NOT EXISTS `erp_bc_suivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduit` int(11) NOT NULL,
  `idphase` int(11) NOT NULL,
  `typephase` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `idtableau` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=869 ;

--
-- Contenu de la table `erp_bc_suivi`
--

INSERT INTO `erp_bc_suivi` (`id`, `idproduit`, `idphase`, `typephase`, `quantite`, `idtableau`) VALUES
(1, 21, 1, 1, 5, 1),
(2, 21, 2, 2, 3, 1),
(3, 21, 3, 2, 0, 1),
(4, 21, 4, 2, 2, 1),
(5, 21, 6, 2, 1, 1),
(6, 21, 7, 2, 0, 1),
(7, 21, 8, 2, 0, 1),
(8, 21, 9, 2, 0, 1),
(9, 21, 10, 3, 0, 1),
(10, 21, 15, 3, 0, 1),
(11, 21, 11, 3, 0, 1),
(12, 21, 12, 3, 0, 1),
(13, 21, 13, 3, 0, 1),
(14, 24, 1, 1, 0, 1),
(15, 24, 2, 2, 0, 1),
(16, 24, 3, 2, 0, 1),
(17, 24, 4, 2, 0, 1),
(18, 24, 6, 2, 0, 1),
(19, 24, 7, 2, 0, 1),
(20, 24, 8, 2, 0, 1),
(21, 24, 9, 2, 0, 1),
(22, 24, 10, 3, 0, 1),
(23, 24, 15, 3, 0, 1),
(24, 24, 11, 3, 0, 1),
(25, 24, 12, 3, 0, 1),
(26, 24, 13, 3, 0, 1),
(27, 26, 1, 1, 0, 1),
(28, 26, 2, 2, 0, 1),
(29, 26, 3, 2, 0, 1),
(30, 26, 4, 2, 0, 1),
(31, 26, 6, 2, 0, 1),
(32, 26, 7, 2, 0, 1),
(33, 26, 8, 2, 0, 1),
(34, 26, 9, 2, 0, 1),
(35, 26, 10, 3, 0, 1),
(36, 26, 15, 3, 0, 1),
(37, 26, 11, 3, 0, 1),
(38, 26, 12, 3, 0, 1),
(39, 26, 13, 3, 0, 1),
(40, 27, 1, 1, 0, 1),
(41, 27, 2, 2, 0, 1),
(42, 27, 3, 2, 0, 1),
(43, 27, 4, 2, 0, 1),
(44, 27, 6, 2, 0, 1),
(45, 27, 7, 2, 0, 1),
(46, 27, 8, 2, 0, 1),
(47, 27, 9, 2, 0, 1),
(48, 27, 10, 3, 0, 1),
(49, 27, 15, 3, 0, 1),
(50, 27, 11, 3, 0, 1),
(51, 27, 12, 3, 0, 1),
(52, 27, 13, 3, 0, 1),
(53, 21, 1, 1, 3, 2),
(54, 21, 2, 2, 5, 2),
(55, 21, 3, 2, 0, 2),
(56, 21, 4, 2, 3, 2),
(57, 21, 6, 2, 1, 2),
(58, 21, 7, 2, 0, 2),
(59, 21, 8, 2, 0, 2),
(60, 21, 9, 2, 0, 2),
(61, 21, 10, 3, 0, 2),
(62, 21, 15, 3, 0, 2),
(63, 21, 11, 3, 0, 2),
(64, 21, 12, 3, 0, 2),
(65, 21, 13, 3, 0, 2),
(66, 24, 1, 1, 0, 2),
(67, 24, 2, 2, 0, 2),
(68, 24, 3, 2, 0, 2),
(69, 24, 4, 2, 0, 2),
(70, 24, 6, 2, 0, 2),
(71, 24, 7, 2, 0, 2),
(72, 24, 8, 2, 0, 2),
(73, 24, 9, 2, 0, 2),
(74, 24, 10, 3, 0, 2),
(75, 24, 15, 3, 0, 2),
(76, 24, 11, 3, 0, 2),
(77, 24, 12, 3, 0, 2),
(78, 24, 13, 3, 0, 2),
(79, 26, 1, 1, 0, 2),
(80, 26, 2, 2, 0, 2),
(81, 26, 3, 2, 0, 2),
(82, 26, 4, 2, 0, 2),
(83, 26, 6, 2, 0, 2),
(84, 26, 7, 2, 0, 2),
(85, 26, 8, 2, 0, 2),
(86, 26, 9, 2, 0, 2),
(87, 26, 10, 3, 0, 2),
(88, 26, 15, 3, 0, 2),
(89, 26, 11, 3, 0, 2),
(90, 26, 12, 3, 0, 2),
(91, 26, 13, 3, 0, 2),
(92, 27, 1, 1, 0, 2),
(93, 27, 2, 2, 0, 2),
(94, 27, 3, 2, 0, 2),
(95, 27, 4, 2, 0, 2),
(96, 27, 6, 2, 0, 2),
(97, 27, 7, 2, 0, 2),
(98, 27, 8, 2, 0, 2),
(99, 27, 9, 2, 0, 2),
(100, 27, 10, 3, 0, 2),
(101, 27, 15, 3, 0, 2),
(102, 27, 11, 3, 0, 2),
(103, 27, 12, 3, 0, 2),
(104, 27, 13, 3, 0, 2),
(105, 21, 1, 1, 0, 3),
(106, 21, 2, 2, 5, 3),
(107, 21, 3, 2, 0, 3),
(108, 21, 4, 2, 0, 3),
(109, 21, 6, 2, 3, 3),
(110, 21, 7, 2, 0, 3),
(111, 21, 8, 2, 0, 3),
(112, 21, 9, 2, 0, 3),
(113, 21, 10, 3, 4, 3),
(114, 21, 15, 3, 0, 3),
(115, 21, 11, 3, 0, 3),
(116, 21, 12, 3, 0, 3),
(117, 21, 13, 3, 0, 3),
(118, 24, 1, 1, 0, 3),
(119, 24, 2, 2, 0, 3),
(120, 24, 3, 2, 0, 3),
(121, 24, 4, 2, 0, 3),
(122, 24, 6, 2, 0, 3),
(123, 24, 7, 2, 0, 3),
(124, 24, 8, 2, 0, 3),
(125, 24, 9, 2, 0, 3),
(126, 24, 10, 3, 0, 3),
(127, 24, 15, 3, 0, 3),
(128, 24, 11, 3, 0, 3),
(129, 24, 12, 3, 0, 3),
(130, 24, 13, 3, 0, 3),
(131, 26, 1, 1, 0, 3),
(132, 26, 2, 2, 0, 3),
(133, 26, 3, 2, 0, 3),
(134, 26, 4, 2, 0, 3),
(135, 26, 6, 2, 0, 3),
(136, 26, 7, 2, 0, 3),
(137, 26, 8, 2, 0, 3),
(138, 26, 9, 2, 0, 3),
(139, 26, 10, 3, 0, 3),
(140, 26, 15, 3, 0, 3),
(141, 26, 11, 3, 0, 3),
(142, 26, 12, 3, 0, 3),
(143, 26, 13, 3, 0, 3),
(144, 27, 1, 1, 0, 3),
(145, 27, 2, 2, 0, 3),
(146, 27, 3, 2, 0, 3),
(147, 27, 4, 2, 0, 3),
(148, 27, 6, 2, 0, 3),
(149, 27, 7, 2, 0, 3),
(150, 27, 8, 2, 0, 3),
(151, 27, 9, 2, 0, 3),
(152, 27, 10, 3, 0, 3),
(153, 27, 15, 3, 0, 3),
(154, 27, 11, 3, 0, 3),
(155, 27, 12, 3, 0, 3),
(156, 27, 13, 3, 0, 3),
(533, 21, 1, 1, 0, 4),
(534, 21, 2, 2, 1, 4),
(535, 21, 3, 2, 0, 4),
(536, 21, 4, 2, 1, 4),
(537, 21, 6, 2, 0, 4),
(538, 21, 7, 2, 0, 4),
(539, 21, 8, 2, 0, 4),
(540, 21, 9, 2, 3, 4),
(541, 21, 10, 3, 2, 4),
(542, 21, 15, 3, 0, 4),
(543, 21, 11, 3, 0, 4),
(544, 21, 12, 3, 0, 4),
(545, 21, 13, 3, 2, 4),
(546, 21, 14, 4, 2, 4),
(547, 24, 1, 1, 0, 4),
(548, 24, 2, 2, 0, 4),
(549, 24, 3, 2, 0, 4),
(550, 24, 4, 2, 0, 4),
(551, 24, 6, 2, 0, 4),
(552, 24, 7, 2, 0, 4),
(553, 24, 8, 2, 0, 4),
(554, 24, 9, 2, 0, 4),
(555, 24, 10, 3, 0, 4),
(556, 24, 15, 3, 0, 4),
(557, 24, 11, 3, 0, 4),
(558, 24, 12, 3, 0, 4),
(559, 24, 13, 3, 0, 4),
(560, 24, 14, 4, 0, 4),
(561, 26, 1, 1, 0, 4),
(562, 26, 2, 2, 0, 4),
(563, 26, 3, 2, 0, 4),
(564, 26, 4, 2, 0, 4),
(565, 26, 6, 2, 0, 4),
(566, 26, 7, 2, 0, 4),
(567, 26, 8, 2, 0, 4),
(568, 26, 9, 2, 0, 4),
(569, 26, 10, 3, 0, 4),
(570, 26, 15, 3, 0, 4),
(571, 26, 11, 3, 0, 4),
(572, 26, 12, 3, 0, 4),
(573, 26, 13, 3, 0, 4),
(574, 26, 14, 4, 0, 4),
(575, 27, 1, 1, 0, 4),
(576, 27, 2, 2, 0, 4),
(577, 27, 3, 2, 0, 4),
(578, 27, 4, 2, 0, 4),
(579, 27, 6, 2, 0, 4),
(580, 27, 7, 2, 0, 4),
(581, 27, 8, 2, 0, 4),
(582, 27, 9, 2, 0, 4),
(583, 27, 10, 3, 0, 4),
(584, 27, 15, 3, 0, 4),
(585, 27, 11, 3, 0, 4),
(586, 27, 12, 3, 0, 4),
(587, 27, 13, 3, 0, 4),
(588, 27, 14, 4, 0, 4),
(645, 21, 1, 1, 0, 5),
(646, 21, 2, 2, 0, 5),
(647, 21, 3, 2, 0, 5),
(648, 21, 4, 2, 0, 5),
(649, 21, 6, 2, 0, 5),
(650, 21, 7, 2, 0, 5),
(651, 21, 8, 2, 2, 5),
(652, 21, 9, 2, 3, 5),
(653, 21, 10, 3, 2, 5),
(654, 21, 15, 3, 0, 5),
(655, 21, 11, 3, 0, 5),
(656, 21, 12, 3, 0, 5),
(657, 21, 13, 3, 2, 5),
(658, 21, 14, 4, 1, 5),
(659, 24, 1, 1, 0, 5),
(660, 24, 2, 2, 0, 5),
(661, 24, 3, 2, 0, 5),
(662, 24, 4, 2, 0, 5),
(663, 24, 6, 2, 0, 5),
(664, 24, 7, 2, 0, 5),
(665, 24, 8, 2, 0, 5),
(666, 24, 9, 2, 0, 5),
(667, 24, 10, 3, 0, 5),
(668, 24, 15, 3, 0, 5),
(669, 24, 11, 3, 0, 5),
(670, 24, 12, 3, 0, 5),
(671, 24, 13, 3, 0, 5),
(672, 24, 14, 4, 0, 5),
(673, 26, 1, 1, 0, 5),
(674, 26, 2, 2, 0, 5),
(675, 26, 3, 2, 0, 5),
(676, 26, 4, 2, 0, 5),
(677, 26, 6, 2, 0, 5),
(678, 26, 7, 2, 0, 5),
(679, 26, 8, 2, 0, 5),
(680, 26, 9, 2, 0, 5),
(681, 26, 10, 3, 0, 5),
(682, 26, 15, 3, 0, 5),
(683, 26, 11, 3, 0, 5),
(684, 26, 12, 3, 0, 5),
(685, 26, 13, 3, 0, 5),
(686, 26, 14, 4, 0, 5),
(687, 27, 1, 1, 0, 5),
(688, 27, 2, 2, 0, 5),
(689, 27, 3, 2, 0, 5),
(690, 27, 4, 2, 0, 5),
(691, 27, 6, 2, 0, 5),
(692, 27, 7, 2, 0, 5),
(693, 27, 8, 2, 0, 5),
(694, 27, 9, 2, 0, 5),
(695, 27, 10, 3, 0, 5),
(696, 27, 15, 3, 0, 5),
(697, 27, 11, 3, 0, 5),
(698, 27, 12, 3, 0, 5),
(699, 27, 13, 3, 0, 5),
(700, 27, 14, 4, 0, 5),
(701, 21, 1, 1, 0, 6),
(702, 21, 2, 2, 0, 6),
(703, 21, 3, 2, 0, 6),
(704, 21, 4, 2, 0, 6),
(705, 21, 6, 2, 0, 6),
(706, 21, 7, 2, 0, 6),
(707, 21, 8, 2, 1, 6),
(708, 21, 9, 2, 2, 6),
(709, 21, 10, 3, 2, 6),
(710, 21, 15, 3, 0, 6),
(711, 21, 11, 3, 0, 6),
(712, 21, 12, 3, 0, 6),
(713, 21, 13, 3, 2, 6),
(714, 21, 14, 4, 2, 6),
(715, 24, 1, 1, 0, 6),
(716, 24, 2, 2, 0, 6),
(717, 24, 3, 2, 0, 6),
(718, 24, 4, 2, 0, 6),
(719, 24, 6, 2, 0, 6),
(720, 24, 7, 2, 0, 6),
(721, 24, 8, 2, 0, 6),
(722, 24, 9, 2, 0, 6),
(723, 24, 10, 3, 0, 6),
(724, 24, 15, 3, 0, 6),
(725, 24, 11, 3, 0, 6),
(726, 24, 12, 3, 0, 6),
(727, 24, 13, 3, 0, 6),
(728, 24, 14, 4, 0, 6),
(729, 26, 1, 1, 0, 6),
(730, 26, 2, 2, 0, 6),
(731, 26, 3, 2, 0, 6),
(732, 26, 4, 2, 0, 6),
(733, 26, 6, 2, 0, 6),
(734, 26, 7, 2, 0, 6),
(735, 26, 8, 2, 0, 6),
(736, 26, 9, 2, 0, 6),
(737, 26, 10, 3, 0, 6),
(738, 26, 15, 3, 0, 6),
(739, 26, 11, 3, 0, 6),
(740, 26, 12, 3, 0, 6),
(741, 26, 13, 3, 0, 6),
(742, 26, 14, 4, 0, 6),
(743, 27, 1, 1, 0, 6),
(744, 27, 2, 2, 0, 6),
(745, 27, 3, 2, 0, 6),
(746, 27, 4, 2, 0, 6),
(747, 27, 6, 2, 0, 6),
(748, 27, 7, 2, 0, 6),
(749, 27, 8, 2, 0, 6),
(750, 27, 9, 2, 0, 6),
(751, 27, 10, 3, 0, 6),
(752, 27, 15, 3, 0, 6),
(753, 27, 11, 3, 0, 6),
(754, 27, 12, 3, 0, 6),
(755, 27, 13, 3, 0, 6),
(756, 27, 14, 4, 0, 6),
(757, 21, 1, 1, 0, 7),
(758, 21, 2, 2, 0, 7),
(759, 21, 3, 2, 0, 7),
(760, 21, 4, 2, 0, 7),
(761, 21, 6, 2, 0, 7),
(762, 21, 7, 2, 0, 7),
(763, 21, 8, 2, 0, 7),
(764, 21, 9, 2, 1, 7),
(765, 21, 10, 3, 0, 7),
(766, 21, 15, 3, 2, 7),
(767, 21, 11, 3, 0, 7),
(768, 21, 12, 3, 0, 7),
(769, 21, 13, 3, 1, 7),
(770, 21, 14, 4, 1, 7),
(771, 24, 1, 1, 0, 7),
(772, 24, 2, 2, 0, 7),
(773, 24, 3, 2, 0, 7),
(774, 24, 4, 2, 0, 7),
(775, 24, 6, 2, 0, 7),
(776, 24, 7, 2, 0, 7),
(777, 24, 8, 2, 0, 7),
(778, 24, 9, 2, 0, 7),
(779, 24, 10, 3, 0, 7),
(780, 24, 15, 3, 0, 7),
(781, 24, 11, 3, 0, 7),
(782, 24, 12, 3, 0, 7),
(783, 24, 13, 3, 0, 7),
(784, 24, 14, 4, 0, 7),
(785, 26, 1, 1, 0, 7),
(786, 26, 2, 2, 0, 7),
(787, 26, 3, 2, 0, 7),
(788, 26, 4, 2, 0, 7),
(789, 26, 6, 2, 0, 7),
(790, 26, 7, 2, 0, 7),
(791, 26, 8, 2, 0, 7),
(792, 26, 9, 2, 0, 7),
(793, 26, 10, 3, 0, 7),
(794, 26, 15, 3, 0, 7),
(795, 26, 11, 3, 0, 7),
(796, 26, 12, 3, 0, 7),
(797, 26, 13, 3, 0, 7),
(798, 26, 14, 4, 0, 7),
(799, 27, 1, 1, 0, 7),
(800, 27, 2, 2, 0, 7),
(801, 27, 3, 2, 0, 7),
(802, 27, 4, 2, 0, 7),
(803, 27, 6, 2, 0, 7),
(804, 27, 7, 2, 0, 7),
(805, 27, 8, 2, 0, 7),
(806, 27, 9, 2, 0, 7),
(807, 27, 10, 3, 0, 7),
(808, 27, 15, 3, 0, 7),
(809, 27, 11, 3, 0, 7),
(810, 27, 12, 3, 0, 7),
(811, 27, 13, 3, 0, 7),
(812, 27, 14, 4, 0, 7),
(813, 21, 1, 1, 0, 8),
(814, 21, 2, 2, 0, 8),
(815, 21, 3, 2, 0, 8),
(816, 21, 4, 2, 0, 8),
(817, 21, 6, 2, 0, 8),
(818, 21, 7, 2, 0, 8),
(819, 21, 8, 2, 0, 8),
(820, 21, 9, 2, 1, 8),
(821, 21, 10, 3, 0, 8),
(822, 21, 15, 3, 2, 8),
(823, 21, 11, 3, 0, 8),
(824, 21, 12, 3, 0, 8),
(825, 21, 13, 3, 1, 8),
(826, 21, 14, 4, 1, 8),
(827, 24, 1, 1, 0, 8),
(828, 24, 2, 2, 0, 8),
(829, 24, 3, 2, 0, 8),
(830, 24, 4, 2, 0, 8),
(831, 24, 6, 2, 0, 8),
(832, 24, 7, 2, 0, 8),
(833, 24, 8, 2, 0, 8),
(834, 24, 9, 2, 0, 8),
(835, 24, 10, 3, 0, 8),
(836, 24, 15, 3, 0, 8),
(837, 24, 11, 3, 0, 8),
(838, 24, 12, 3, 0, 8),
(839, 24, 13, 3, 0, 8),
(840, 24, 14, 4, 0, 8),
(841, 26, 1, 1, 0, 8),
(842, 26, 2, 2, 0, 8),
(843, 26, 3, 2, 0, 8),
(844, 26, 4, 2, 0, 8),
(845, 26, 6, 2, 0, 8),
(846, 26, 7, 2, 0, 8),
(847, 26, 8, 2, 0, 8),
(848, 26, 9, 2, 0, 8),
(849, 26, 10, 3, 0, 8),
(850, 26, 15, 3, 0, 8),
(851, 26, 11, 3, 0, 8),
(852, 26, 12, 3, 0, 8),
(853, 26, 13, 3, 0, 8),
(854, 26, 14, 4, 0, 8),
(855, 27, 1, 1, 0, 8),
(856, 27, 2, 2, 0, 8),
(857, 27, 3, 2, 0, 8),
(858, 27, 4, 2, 0, 8),
(859, 27, 6, 2, 0, 8),
(860, 27, 7, 2, 0, 8),
(861, 27, 8, 2, 0, 8),
(862, 27, 9, 2, 0, 8),
(863, 27, 10, 3, 0, 8),
(864, 27, 15, 3, 0, 8),
(865, 27, 11, 3, 0, 8),
(866, 27, 12, 3, 0, 8),
(867, 27, 13, 3, 0, 8),
(868, 27, 14, 4, 0, 8);

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_tableau`
--

CREATE TABLE IF NOT EXISTS `erp_bc_tableau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idfamille` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `erp_bc_tableau`
--

INSERT INTO `erp_bc_tableau` (`id`, `idfamille`, `idutilisateur`, `dateheure`) VALUES
(1, 1, 1, '2022-05-03 18:52:40'),
(2, 1, 1, '2022-05-03 18:53:47'),
(3, 1, 1, '2022-05-03 18:59:36'),
(4, 1, 1, '2022-05-04 09:23:41'),
(5, 1, 1, '2022-05-04 09:36:59'),
(6, 1, 1, '2022-05-05 10:26:52'),
(7, 1, 1, '2022-05-05 15:24:48'),
(8, 1, 1, '2022-05-05 15:25:03');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_trimestre`
--

CREATE TABLE IF NOT EXISTS `erp_bc_trimestre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trimestre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `erp_bc_trimestre`
--

INSERT INTO `erp_bc_trimestre` (`id`, `trimestre`) VALUES
(1, 'T1'),
(2, 'T2'),
(3, 'T3'),
(4, 'T4');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_typephases`
--

CREATE TABLE IF NOT EXISTS `erp_bc_typephases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `erp_bc_typephases`
--

INSERT INTO `erp_bc_typephases` (`id`, `type`) VALUES
(1, 'BACS STRATIFIES'),
(2, 'BACS EN PHASE DE FINITION'),
(3, 'BACS SEMI-FINIS'),
(4, 'BACS EN ATTENTE '),
(5, 'BACS EN PHASE PEINTURE');

-- --------------------------------------------------------

--
-- Structure de la table `erp_bc_utilisateurs`
--

CREATE TABLE IF NOT EXISTS `erp_bc_utilisateurs` (
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
-- Contenu de la table `erp_bc_utilisateurs`
--

INSERT INTO `erp_bc_utilisateurs` (`id`, `nom`, `prenom`, `mail`, `motdepasse`, `idprofil`, `archive`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '123', 1, 0),
(2, 'magasin', 'magasin', 'magasin@magasin.com', '123', 3, 0),
(3, 'user1', 'user1', 'user@user', '123', 5, 0),
(4, 'client', 'client', 'client@client.fr', '123456', 4, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
