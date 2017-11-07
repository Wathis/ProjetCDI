-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 07 nov. 2017 à 13:02
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projetCDI`
--

-- --------------------------------------------------------

--
-- Structure de la table `CDI_ARTICLE`
--

CREATE TABLE `CDI_ARTICLE` (
  `AR_NUMERO` char(8) NOT NULL DEFAULT '',
  `FO_NUMERO` char(8) DEFAULT NULL,
  `AR_NOM` varchar(25) DEFAULT NULL,
  `AR_POIDS` decimal(10,3) DEFAULT NULL,
  `AR_COULEUR` varchar(20) DEFAULT NULL,
  `AR_STOCK` smallint(6) DEFAULT NULL,
  `AR_PA` decimal(5,2) DEFAULT NULL,
  `AR_PV` decimal(5,2) DEFAULT NULL,
  `ar_poicode` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_ARTICLE`
--

INSERT INTO `CDI_ARTICLE` (`AR_NUMERO`, `FO_NUMERO`, `AR_NOM`, `AR_POIDS`, `AR_COULEUR`, `AR_STOCK`, `AR_PA`, `AR_PV`, `ar_poicode`) VALUES
('A01', 'F07', 'IPHONE X', '254.000', 'ROUGE', 1153, '999.99', '999.99', NULL),
('A02', 'F07', 'IPHONE 8', '254.000', 'NOIR ', 1113, '600.00', '800.00', NULL),
('A03', 'F07', 'SAMSUNG GALAXY S8', '256.000', 'VERT', 652, '600.00', '800.00', NULL),
('A04', 'F09', 'LG 32J500V', '3000.000', 'NOIR', 544, '999.99', '999.99', NULL),
('A05', 'F05', 'MONTRE CONNECTéE', '120.000', 'ORANGE', NULL, '100.00', '120.00', NULL),
('A06', 'F02', 'BUREAU 2ZD15', '2000.000', 'MARRON', 4, '100.00', '119.00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_CLIENT`
--

CREATE TABLE `CDI_CLIENT` (
  `CL_NUMERO` char(8) DEFAULT NULL,
  `CL_NOM` varchar(25) NOT NULL DEFAULT '',
  `CL_PRENOM` varchar(25) NOT NULL DEFAULT '',
  `CL_PAYS` varchar(2) DEFAULT NULL,
  `CL_LOCALITE` varchar(20) NOT NULL DEFAULT '',
  `CL_CA` int(11) DEFAULT NULL,
  `CL_TYPE` varchar(16) DEFAULT NULL,
  `EMP_ENUME` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_CLIENT`
--

INSERT INTO `CDI_CLIENT` (`CL_NUMERO`, `CL_NOM`, `CL_PRENOM`, `CL_PAYS`, `CL_LOCALITE`, `CL_CA`, `CL_TYPE`, `EMP_ENUME`) VALUES
('C01', 'ALFRED', 'Jules', 'FR', 'PARIS', NULL, 'Particulier', NULL),
('C02', 'GALATEE', 'Gadbois', 'FR', 'CENON', NULL, 'Particulier', NULL),
('C03', 'JOBS', 'Steeve', 'US', 'NEW YORK', 99999955, 'Grand Compte', NULL),
('C04', 'LAUX', 'Emilie', 'FR', 'PARIS', NULL, 'Particulier', NULL),
('C05', 'MAILHOT', 'Aubin', 'AT', 'MULHOUSE', NULL, 'Particulier', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_COMMANDE`
--

CREATE TABLE `CDI_COMMANDE` (
  `CO_NUMERO` char(8) NOT NULL DEFAULT '',
  `CO_DATE` datetime DEFAULT NULL,
  `CL_NUMERO` char(8) DEFAULT NULL,
  `MA_NUMERO` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_COMMANDE`
--

INSERT INTO `CDI_COMMANDE` (`CO_NUMERO`, `CO_DATE`, `CL_NUMERO`, `MA_NUMERO`) VALUES
('C01', '2017-11-07 09:11:35', 'C01', 'M03'),
('C02', '2017-11-07 09:13:08', 'C03', 'M01'),
('C03', '2017-11-07 12:57:19', 'C04', 'M04');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_FOURNISSEUR`
--

CREATE TABLE `CDI_FOURNISSEUR` (
  `FO_NUMERO` char(8) NOT NULL DEFAULT '',
  `FO_NOM` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_FOURNISSEUR`
--

INSERT INTO `CDI_FOURNISSEUR` (`FO_NUMERO`, `FO_NOM`) VALUES
('F01', 'CATI O ELECTRONIC'),
('F02', 'LES STYLOS REUNIS'),
('F03', 'MECANIQUE DE PRECISION'),
('F04', 'SARL ROULAND'),
('F05', 'ELECTROLAMP'),
('F06', 'RAMONAGE BDD'),
('F07', 'APPLE'),
('F08', 'SAMSUNG'),
('F09', 'LG');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_LIGCDE`
--

CREATE TABLE `CDI_LIGCDE` (
  `LIC_QTCMDEE` decimal(38,0) DEFAULT NULL,
  `LIC_QTLIVREE` decimal(38,0) DEFAULT NULL,
  `LIC_PU` double DEFAULT NULL,
  `CO_NUMERO` char(8) DEFAULT NULL,
  `AR_NUMERO` char(8) DEFAULT NULL,
  `DATE_LIV` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_LIGCDE`
--

INSERT INTO `CDI_LIGCDE` (`LIC_QTCMDEE`, `LIC_QTLIVREE`, `LIC_PU`, `CO_NUMERO`, `AR_NUMERO`, `DATE_LIV`) VALUES
('1', '1', 999.99, 'C01', 'A01', '2017-11-07 12:51:29'),
('12', '6', 400, 'C02', 'A02', '2017-11-07 09:14:46'),
('4', '0', 720, 'C03', 'A03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_LIGLIV`
--

CREATE TABLE `CDI_LIGLIV` (
  `LIL_QTLIVREE` smallint(6) DEFAULT NULL,
  `LI_NUMERO` char(8) DEFAULT NULL,
  `AR_NUMERO` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_LIGLIV`
--

INSERT INTO `CDI_LIGLIV` (`LIL_QTLIVREE`, `LI_NUMERO`, `AR_NUMERO`) VALUES
(1, 'L01', 'A01'),
(6, 'L02', 'A02'),
(1, 'L03', 'A03'),
(3, 'L04', 'A03');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_LIVRAISON`
--

CREATE TABLE `CDI_LIVRAISON` (
  `LI_NUMERO` char(8) NOT NULL DEFAULT '',
  `MA_NUMERO` char(8) DEFAULT NULL,
  `CO_NUMERO` char(8) DEFAULT NULL,
  `CL_NUMERO` char(8) DEFAULT NULL,
  `DATE_LIV_PREVUE` datetime DEFAULT NULL,
  `DATE_LIV_REELE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_LIVRAISON`
--

INSERT INTO `CDI_LIVRAISON` (`LI_NUMERO`, `MA_NUMERO`, `CO_NUMERO`, `CL_NUMERO`, `DATE_LIV_PREVUE`, `DATE_LIV_REELE`) VALUES
('L01', 'M03', 'C01', 'C01', '2017-11-30 00:00:00', '2017-11-07 12:51:29'),
('L02', 'M01', 'C02', 'C03', '2017-11-29 00:00:00', '2017-11-07 09:14:46'),
('L03', 'M04', 'C03', 'C04', '2017-11-06 00:00:00', NULL),
('L04', 'M04', 'C03', 'C04', '2017-11-24 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_LIV_MESSAGE`
--

CREATE TABLE `CDI_LIV_MESSAGE` (
  `LIV_NUMERO` char(8) DEFAULT NULL,
  `MESSAGE` varchar(5) DEFAULT NULL,
  `LDATE` datetime DEFAULT NULL,
  `COM_NUMERO` char(8) DEFAULT NULL,
  `MAG_NUMERO` char(8) DEFAULT NULL,
  `CLI_NUMERO` char(8) DEFAULT NULL,
  `ART_NUMERO` char(8) DEFAULT NULL,
  `LOGIN` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `CDI_MAGASIN`
--

CREATE TABLE `CDI_MAGASIN` (
  `MA_NUMERO` char(8) NOT NULL DEFAULT '',
  `MA_LOCALITE` varchar(25) DEFAULT NULL,
  `MA_NOM_GERANT` varchar(25) DEFAULT NULL,
  `MA_PRENOM_GERANT` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_MAGASIN`
--

INSERT INTO `CDI_MAGASIN` (`MA_NUMERO`, `MA_LOCALITE`, `MA_NOM_GERANT`, `MA_PRENOM_GERANT`) VALUES
('M01', 'PARIS 5E', 'BERTON', 'Louis'),
('M02', 'PARIS 10E', 'JANNEAU', 'Luc'),
('M03', 'LYON', 'MOUILLARD', 'Marcel'),
('M04', 'MARSEILLE', 'CAMUS', 'Marius'),
('M05', 'MONTPELLIER', 'BAIJOT', 'Marc'),
('M06', 'BORDEAUX', 'DETIENNE', 'Nicole'),
('M07', 'NANTES', 'DUMONT', 'Henri'),
('M08', 'TOURS', 'DEMARTEAU', 'Renee'),
('M09', 'ROUEN', 'NOSSENT', 'Daniel'),
('M10', 'LILLE', 'NIZET', 'Jean Luc'),
('M11', 'BRUXELLES', 'VANDAELE', 'Annick'),
('M12', 'LIEGE', 'HANNEAU', 'Vincent');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_PAYS`
--

CREATE TABLE `CDI_PAYS` (
  `CODE_CIO` varchar(3) DEFAULT NULL,
  `CODE_ISO` varchar(3) DEFAULT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `ANNEE_CREATION` int(11) DEFAULT NULL,
  `ANNEE_DISPARITION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CDI_PAYS`
--

INSERT INTO `CDI_PAYS` (`CODE_CIO`, `CODE_ISO`, `NOM`, `ANNEE_CREATION`, `ANNEE_DISPARITION`) VALUES
('ERI', 'ER ', 'ERYTHREE', NULL, NULL),
('ETH', 'ET ', 'ETHIOPIE', NULL, NULL),
('ARG', 'AR ', 'ARGENTINE', NULL, NULL),
('CRC', 'CR ', 'COSTA RICA', NULL, NULL),
('MOL', 'MD ', 'MOLDOVA', NULL, NULL),
('NZL', 'NZ ', 'NOUVELLE ZELANDE', NULL, NULL),
('NOR', 'NO ', 'NORVEGE', NULL, NULL),
('BRE', 'BR ', 'BRESIL', NULL, NULL),
('LUX', 'LU ', 'LUXEMBOURG', NULL, NULL),
('CRO', 'HR ', 'CROATIE', NULL, NULL),
('HON', 'HU ', 'HONGRIE', NULL, NULL),
('ESP', 'ES ', 'ESPAGNE', NULL, NULL),
('POR', 'PT ', 'PORTUGAL', NULL, NULL),
('FRA', 'FR ', 'FRANCE', NULL, NULL),
('AUS', 'AU ', 'AUSTRALIE', NULL, NULL),
('SUI', 'CH ', 'SUISSE', NULL, NULL),
('ITA', 'IT ', 'ITALIE', NULL, NULL),
('BEL', 'BE ', 'BELGIQUE', NULL, NULL),
('RUS', 'RU ', 'RUSSIE', NULL, NULL),
('USA', 'US ', 'ETATS-UNIS', NULL, NULL),
('UKR', 'UA ', 'UKRAINE', NULL, NULL),
('UZB', 'UZ ', 'OUZBEKISTAN', NULL, NULL),
('KAZ', 'KZ ', 'KAZAKHSTAN', NULL, NULL),
('COL', 'CO ', 'COLOMBIE', NULL, NULL),
('POL', 'PL ', 'POLOGNE', NULL, NULL),
('VEN', 'VE ', 'VENEZUELA', NULL, NULL),
('GBR', 'GB ', 'ROYAUME UNI', NULL, NULL),
('LIT', 'LT ', 'LITUANIE', NULL, NULL),
('JAP', 'JP ', 'JAPON', NULL, NULL),
('CZE', 'CZ ', 'REPUBLIQUE TCHEQUE', 1993, NULL),
('AUT', 'AT ', 'AUTRICHE', NULL, NULL),
('LAT', 'LV ', 'LETTONIE', NULL, NULL),
('IRL', 'IE ', 'IRLANDE', NULL, NULL),
('AND', 'AD ', 'ANDORRE', NULL, NULL),
('SUE', 'SE ', 'SUEDE', NULL, NULL),
('SM ', 'SM ', 'SAINT-MARIN', NULL, NULL),
('MC ', 'MC ', 'MONACO', NULL, NULL),
('FIN', 'FI ', 'FINLANDE', NULL, NULL),
('EST', 'EE ', 'ESTONIE', NULL, NULL),
('MEX', 'MX ', 'MEXIQUE', NULL, NULL),
('DEN', 'DK ', 'DANEMARK', NULL, NULL),
('RSA', 'ZA ', 'AFRIQUE DU SUD', NULL, NULL),
('SLV', 'SI ', 'SLOVENIE', 1991, NULL),
('KEN', 'KE ', 'KENYA', NULL, NULL),
('SLQ', 'SK ', 'SLOVAQUIE', NULL, NULL),
('CAN', 'CA ', 'CANADA', NULL, NULL),
('BLR', 'BY ', 'BELARUS', NULL, NULL),
('CHN', 'CN ', 'CHINE', NULL, NULL),
('GER', 'DE ', 'ALLEMAGNE', 1990, NULL),
('NED', 'NL ', 'PAYS-BAS', NULL, NULL),
('YUG', 'YU ', 'YOUGOSLAVIE', 1929, 2003),
('TCH', 'CS ', 'TCHECOSLOVAQUIE', 1918, 1992),
('UAE', 'AE ', 'EMIRATS ARABES UNIS', 1971, NULL),
('BRN', 'BH ', 'BAHREIN', 2002, NULL),
('URS', 'SU ', 'UNION DES REPUBLIQUES SOCIALISTES SOVIETIQUES', 1922, 1991),
('GDR', 'DD ', 'REPUBLIQUE DEMOCRATIQUE ALLEMANDE', 1949, 1990),
('FRG', 'DE ', 'REPUBLIQUE FEDRERALE D\'ALLEMAGNE', 1949, 1990);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CDI_ARTICLE`
--
ALTER TABLE `CDI_ARTICLE`
  ADD PRIMARY KEY (`AR_NUMERO`);

--
-- Index pour la table `CDI_CLIENT`
--
ALTER TABLE `CDI_CLIENT`
  ADD PRIMARY KEY (`CL_NOM`,`CL_PRENOM`,`CL_LOCALITE`);

--
-- Index pour la table `CDI_COMMANDE`
--
ALTER TABLE `CDI_COMMANDE`
  ADD PRIMARY KEY (`CO_NUMERO`);

--
-- Index pour la table `CDI_FOURNISSEUR`
--
ALTER TABLE `CDI_FOURNISSEUR`
  ADD PRIMARY KEY (`FO_NUMERO`);

--
-- Index pour la table `CDI_LIVRAISON`
--
ALTER TABLE `CDI_LIVRAISON`
  ADD PRIMARY KEY (`LI_NUMERO`);

--
-- Index pour la table `CDI_MAGASIN`
--
ALTER TABLE `CDI_MAGASIN`
  ADD PRIMARY KEY (`MA_NUMERO`);