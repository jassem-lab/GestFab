-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 07 Mai 2022 à 09:32
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

CREATE TABLE IF NOT EXISTS `erp_bc_bc` (
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
  `client` int(11) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `semaine` int(11) NOT NULL,
  `mois` varchar(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_bl`
--

INSERT INTO `erp_bc_bl` (`id`, `reference`, `client`, `trimestre`, `annee`, `semaine`, `mois`, `date`, `dateheure`, `idutilisateur`, `montant`, `etat`, `remarque`, `type`) VALUES
(2, 'BL_2022_001', 1, 2, '2022', 18, '05', '2022-05-07', '2022-05-07 07:59:05', 1, '44', 0, '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_compteur_bl`
--

INSERT INTO `erp_bc_compteur_bl` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 0);

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
-- Structure de la table `erp_bc_compteur_factsf`
--

CREATE TABLE IF NOT EXISTS `erp_bc_compteur_factsf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `compteur` varchar(255) NOT NULL,
  `iddoc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_compteur_factsf`
--

INSERT INTO `erp_bc_compteur_factsf` (`id`, `date`, `compteur`, `iddoc`) VALUES
(1, '2022', '001', 1);

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
(1, 1, 21, 5, '35', '175', '50', '80', 5, 0, 0, 0),
(6, 1, 26, 6, '27.5', '165', '30', '50', 4, 0, 0, 0),
(8, 1, 24, 4, '22', '88', '', '', 4, 0, 0, 0),
(9, 2, 27, 5, '33.8', '169', '', '', 0, 0, 0, 0),
(10, 2, 21, 3, '35', '105', '50', '80', 3, 0, 0, 0),
(11, 2, 24, 1, '22', '0', '', '', 1, 0, 0, 0),
(16, 3, 21, 2, '35', '70', '50', '80', 2, 0, 0, 0),
(17, 3, 26, 1, '27.5', '27.5', '30', '50', 0, 0, 0, 0),
(18, 3, 24, 1, '22', '22', '', '', 1, 0, 0, 0),
(19, 4, 21, 2, '37', '74', '50', '80', 2, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_det_bl`
--

INSERT INTO `erp_bc_det_bl` (`id`, `idbl`, `iddetbc`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES
(1, 2, 18, 24, 1, '22', '22', '', ''),
(2, 2, 11, 24, 1, '22', '22', '', '');

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
-- Structure de la table `erp_bc_det_factsf`
--

CREATE TABLE IF NOT EXISTS `erp_bc_det_factsf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idfact` int(11) NOT NULL,
  `iddetbl` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` varchar(255) NOT NULL,
  `prix_total` varchar(255) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_det_factsf`
--

INSERT INTO `erp_bc_det_factsf` (`id`, `idfact`, `iddetbl`, `produit`, `quantite`, `prix_unitaire`, `prix_total`, `poids`, `volume`) VALUES
(1, 1, 1, 24, 1, '30', '30', '', ''),
(2, 1, 2, 24, 1, '22', '22', '', '');

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
-- Structure de la table `erp_bc_factsf`
--

CREATE TABLE IF NOT EXISTS `erp_bc_factsf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(255) NOT NULL,
  `client` int(11) NOT NULL,
  `trimestre` int(11) NOT NULL,
  `annee` varchar(255) NOT NULL,
  `mois` varchar(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `dateheure` varchar(255) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL,
  `remarque` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `erp_bc_factsf`
--

INSERT INTO `erp_bc_factsf` (`id`, `reference`, `client`, `trimestre`, `annee`, `mois`, `date`, `dateheure`, `idutilisateur`, `montant`, `etat`, `remarque`, `type`) VALUES
(1, 'FC_2022_001', 1, 2, '2022', '05', '2022-05-07', '2022-05-07 07:59:08', 1, '', 0, '', 0);

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
  `stock_sf` int(11) NOT NULL,
  `stock_reservee` int(11) NOT NULL,
  `stock_peinture` int(11) NOT NULL,
  `prix` varchar(255) NOT NULL,
  `semi_finis` int(11) NOT NULL,
  `poids` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `erp_bc_produits`
--

INSERT INTO `erp_bc_produits` (`id`, `code`, `code_barre`, `designation`, `unite`, `surface`, `famille`, `archive`, `stock_sf`, `stock_reservee`, `stock_peinture`, `prix`, `semi_finis`, `poids`, `volume`) VALUES
(21, '1000*500*500', '', 'DE0017 1000*500*500', 0, '', 1, 0, 7, 0, 0, '35', 0, '50', '80'),
(22, '2000*500*600', '', 'DE0012 2000*500*600', 0, '', 1, 0, 0, 0, 0, '55', 0, '', ''),
(23, '1500*500*600', '', 'DE0013 1500*500*600', 0, '', 1, 0, 0, 0, 0, '38', 0, '', ''),
(24, '1200*500*600', '', 'DE0014 1200*500*600', 0, '', 1, 0, 2, 0, 0, '22', 0, '', ''),
(25, '900*500*600', '', 'DE0015 900*500*600', 0, '', 1, 0, 0, 0, 0, '32', 0, '', ''),
(26, '1200*500*400', '', 'DE0016 1200*500*400', 0, '', 1, 0, 0, 0, 0, '27.5', 0, '30', '50'),
(27, '1500*400*400', '', 'DE0018 1500*400*400', 0, '', 1, 0, 0, 0, 0, '33.8', 0, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Contenu de la table `erp_bc_suivi`
--

INSERT INTO `erp_bc_suivi` (`id`, `idproduit`, `idphase`, `typephase`, `quantite`, `idtableau`) VALUES
(1, 21, 1, 1, 2, 1),
(2, 21, 2, 2, 0, 1),
(3, 21, 3, 2, 0, 1),
(4, 21, 4, 2, 3, 1),
(5, 21, 6, 2, 0, 1),
(6, 21, 7, 2, 0, 1),
(7, 21, 8, 2, 0, 1),
(8, 21, 9, 2, 0, 1),
(9, 21, 10, 3, 2, 1),
(10, 21, 15, 3, 0, 1),
(11, 21, 11, 3, 0, 1),
(12, 21, 12, 3, 0, 1),
(13, 21, 13, 3, 0, 1),
(14, 21, 14, 4, 0, 1),
(15, 24, 1, 1, 3, 1),
(16, 24, 2, 2, 3, 1),
(17, 24, 3, 2, 0, 1),
(18, 24, 4, 2, 0, 1),
(19, 24, 6, 2, 0, 1),
(20, 24, 7, 2, 0, 1),
(21, 24, 8, 2, 0, 1),
(22, 24, 9, 2, 0, 1),
(23, 24, 10, 3, 0, 1),
(24, 24, 15, 3, 0, 1),
(25, 24, 11, 3, 0, 1),
(26, 24, 12, 3, 0, 1),
(27, 24, 13, 3, 0, 1),
(28, 24, 14, 4, 0, 1),
(29, 26, 1, 1, 4, 1),
(30, 26, 2, 2, 2, 1),
(31, 26, 3, 2, 1, 1),
(32, 26, 4, 2, 0, 1),
(33, 26, 6, 2, 0, 1),
(34, 26, 7, 2, 0, 1),
(35, 26, 8, 2, 0, 1),
(36, 26, 9, 2, 0, 1),
(37, 26, 10, 3, 0, 1),
(38, 26, 15, 3, 0, 1),
(39, 26, 11, 3, 0, 1),
(40, 26, 12, 3, 0, 1),
(41, 26, 13, 3, 0, 1),
(42, 26, 14, 4, 0, 1),
(43, 27, 1, 1, 1, 1),
(44, 27, 2, 2, 3, 1),
(45, 27, 3, 2, 1, 1),
(46, 27, 4, 2, 0, 1),
(47, 27, 6, 2, 0, 1),
(48, 27, 7, 2, 0, 1),
(49, 27, 8, 2, 0, 1),
(50, 27, 9, 2, 0, 1),
(51, 27, 10, 3, 0, 1),
(52, 27, 15, 3, 0, 1),
(53, 27, 11, 3, 0, 1),
(54, 27, 12, 3, 0, 1),
(55, 27, 13, 3, 0, 1),
(56, 27, 14, 4, 0, 1),
(57, 21, 1, 1, 0, 2),
(58, 21, 2, 2, 0, 2),
(59, 21, 3, 2, 0, 2),
(60, 21, 4, 2, 0, 2),
(61, 21, 6, 2, 0, 2),
(62, 21, 7, 2, 0, 2),
(63, 21, 8, 2, 0, 2),
(64, 21, 9, 2, 3, 2),
(65, 21, 10, 3, 0, 2),
(66, 21, 15, 3, 0, 2),
(67, 21, 11, 3, 2, 2),
(68, 21, 12, 3, 0, 2),
(69, 21, 13, 3, 0, 2),
(70, 21, 14, 4, 7, 2),
(71, 24, 1, 1, 0, 2),
(72, 24, 2, 2, 0, 2),
(73, 24, 3, 2, 1, 2),
(74, 24, 4, 2, 0, 2),
(75, 24, 6, 2, 0, 2),
(76, 24, 7, 2, 0, 2),
(77, 24, 8, 2, 0, 2),
(78, 24, 9, 2, 0, 2),
(79, 24, 10, 3, 2, 2),
(80, 24, 15, 3, 1, 2),
(81, 24, 11, 3, 0, 2),
(82, 24, 12, 3, 0, 2),
(83, 24, 13, 3, 0, 2),
(84, 24, 14, 4, 2, 2),
(85, 26, 1, 1, 4, 2),
(86, 26, 2, 2, 2, 2),
(87, 26, 3, 2, 1, 2),
(88, 26, 4, 2, 0, 2),
(89, 26, 6, 2, 0, 2),
(90, 26, 7, 2, 0, 2),
(91, 26, 8, 2, 0, 2),
(92, 26, 9, 2, 0, 2),
(93, 26, 10, 3, 0, 2),
(94, 26, 15, 3, 0, 2),
(95, 26, 11, 3, 0, 2),
(96, 26, 12, 3, 0, 2),
(97, 26, 13, 3, 0, 2),
(98, 26, 14, 4, 0, 2),
(99, 27, 1, 1, 1, 2),
(100, 27, 2, 2, 3, 2),
(101, 27, 3, 2, 1, 2),
(102, 27, 4, 2, 0, 2),
(103, 27, 6, 2, 0, 2),
(104, 27, 7, 2, 0, 2),
(105, 27, 8, 2, 0, 2),
(106, 27, 9, 2, 0, 2),
(107, 27, 10, 3, 0, 2),
(108, 27, 15, 3, 0, 2),
(109, 27, 11, 3, 0, 2),
(110, 27, 12, 3, 0, 2),
(111, 27, 13, 3, 0, 2),
(112, 27, 14, 4, 0, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `erp_bc_tableau`
--

INSERT INTO `erp_bc_tableau` (`id`, `idfamille`, `idutilisateur`, `dateheure`) VALUES
(1, 1, 1, '2022-05-07 07:59:05'),
(2, 1, 1, '2022-05-07 07:59:54');

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
