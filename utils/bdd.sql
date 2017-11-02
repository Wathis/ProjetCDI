-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 25 Septembre 2017 à 11:39
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projetCDI`
--


DROP TABLE IF EXISTS BILAN;
DROP TABLE IF EXISTS SONDAGE;
DROP TABLE IF EXISTS CDI_POIMESSAGE;
DROP TABLE IF EXISTS CDI_MESSAGE;
DROP TABLE IF EXISTS CDI_ARTICLE;
DROP TABLE IF EXISTS CDI_CLIENT;
DROP TABLE IF EXISTS CDI_COMMANDE;
DROP TABLE IF EXISTS CDI_FOURNISSEUR;
DROP TABLE IF EXISTS CDI_LIGCDE;
DROP TABLE IF EXISTS CDI_LIV_MESSAGE;
DROP TABLE IF EXISTS CDI_LIVRAISON;
DROP TABLE IF EXISTS CDI_MAGASIN;
DROP TABLE IF EXISTS CDI_LIGLIV;



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
-- Contenu de la table `CDI_ARTICLE`
--

INSERT INTO `CDI_ARTICLE` (`AR_NUMERO`, `FO_NUMERO`, `AR_NOM`, `AR_POIDS`, `AR_COULEUR`, `AR_STOCK`, `AR_PA`, `AR_PV`, `ar_poicode`) VALUES
('A01', 'F04', 'AGRAFEUSE', '150.000', 'ROUGE', 3, '7.00', '10.00', NULL),
('A02', 'F01', 'CALCULATRICE', '100.000', 'NOIR', NULL, '25.00', '40.00', NULL),
('A03', 'F04', 'CACHEUR-DATEUR', '100.000', 'BLANC', 3, '15.00', '25.00', NULL),
('A04', 'F05', 'LAMPE', '550.000', 'ROUGE', 48, '18.00', '28.00', NULL),
('A05', 'F05', 'LAMPE', '550.000', 'BLANC', 666, '18.00', '28.00', NULL),
('A06', 'F05', 'LAMPE', '550.000', 'BLEU', NULL, '18.00', '28.00', NULL),
('A07', 'F05', 'LAMPE', '550.000', 'VERT', 3, '18.00', '28.00', NULL),
('A08', 'F03', 'PESE-LETTRE 1-500', '1230.000', NULL, NULL, '28.00', '35.00', NULL),
('A09', 'F03', 'PESE-LETTRE 1-1000', NULL, NULL, 3, '30.00', '39.00', NULL),
('A10', 'F02', 'CRAYON', '20.000', 'ROUGE', NULL, '1.00', '2.00', NULL),
('A11', 'F02', 'CRAYON', '20.000', 'BLEU', NULL, '3.00', '4.00', NULL),
('A12', 'F02', 'CRAYON LUXE', '20.000', 'ROUGE', 8, '3.00', '4.00', NULL),
('A13', 'F02', 'CRAYON LUXE', '20.000', 'VERT', 7, '3.00', '4.00', NULL),
('A14', 'F02', 'CRAYON LUXE', '20.000', 'BLEU', NULL, '3.00', '4.00', NULL),
('A15', 'F02', 'CRAYON LUXE', '20.000', 'NOIR', NULL, '3.00', '5.00', NULL),
('A20', 'F01', 'COLLE', '60.000', 'BLANC', NULL, '1.00', '3.00', NULL),
('A21', 'F06', 'COLLE', '60.000', 'BLANC', 10, '1.00', '2.00', NULL),
('A22', 'F03', 'COLLE', '60.000', 'BLANC', 34, '1.00', '2.00', NULL),
('A25', 'F01', 'COLLE', NULL, 'BLANC', 10, '1.00', '2.00', NULL),
('A26', 'F02', 'COLLE', '60.000', 'BLANC', 15, '1.00', '2.00', NULL),
('A27', 'F05', 'COLLE', '60.000', 'BLANC', 1, '1.00', '2.00', NULL),
('A28', 'F03', 'Surligneur', '10.000', 'JAUNE', 0, '1.00', '2.00', NULL),
('A30', 'F01', 'Calculatrice', '80.000', 'Bleu', NULL, '6.00', '15.00', NULL),
('A31', 'F06', 'SOURIS', '35.000', 'Vert', 5, '2.00', '5.00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_CLIENT`
--

CREATE TABLE `CDI_CLIENT` (
  `CL_NUMERO` char(8) DEFAULT NULL,
  `CL_NOM` varchar(25) DEFAULT NULL,
  `CL_PRENOM` varchar(25) DEFAULT NULL,
  `CL_PAYS` varchar(2) DEFAULT NULL,
  `CL_LOCALITE` varchar(20) DEFAULT NULL,
  `CL_CA` int(11) DEFAULT NULL,
  `CL_TYPE` varchar(16) DEFAULT NULL,
  `EMP_ENUME` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CDI_CLIENT`
--

INSERT INTO `CDI_CLIENT` (`CL_NUMERO`, `CL_NOM`, `CL_PRENOM`, `CL_PAYS`, `CL_LOCALITE`, `CL_CA`, `CL_TYPE`, `EMP_ENUME`) VALUES
('C01', 'DEFRERE', 'Marc', 'F', 'PARIS', NULL, 'Particulier', 7934),
('C02', 'DECERF', 'Jean', 'F', 'PARIS', NULL, 'Particulier', 7934),
('C03', 'DEFAWE', 'Leon', 'B', 'LIEGE', NULL, 'Particulier', 7900),
('C04', 'NOSSENT', 'Serge', 'B', 'BRUXELLES', NULL, 'Particulier', 7654),
('C05', 'JACOB', 'Marthe', 'F', 'MARSEILLE', 31, 'Administration', 4),
('C06', 'JAMAR', 'Pierre', 'B', 'LIEGE', 21, 'Administration', 8),
('C07', 'DECKERS', 'Willian', 'F', 'LYON', 140, 'Grand compte', 7436),
('C08', 'DECLERCQ', 'Lucien', 'B', 'BRUXELLES', 349, 'Grand compte', 7436),
('C09', 'DEFYZ', 'Maurice', 'F', 'BORDEAUX', NULL, 'Particulier', 6),
('C10', 'DEFOOZ', 'Francis', 'F', 'LILLE', NULL, 'Particulier', 7844),
('C11', 'RAMJOIE', 'Victor', 'F', 'NANTES', NULL, 'Particulier', 7436),
('C12', 'RENARDY', 'Jean', 'F', 'MARSEILLE', 275, 'Grand compte', 7900),
('C13', 'MANTEAU', 'Yvan', 'F', 'CAEN', 105, 'Grand compte', 7902),
('C14', 'JONAS', 'Henri', 'F', 'PARIS', 190, 'PME', 7436),
('C15', 'DELVENNE', 'Christian', 'F', 'LYON', 590, 'Grand compte', 7436),
('C16', 'DEFEEZ', 'Andre', 'F', 'LYON', NULL, 'Particulier', 5814);

-- --------------------------------------------------------

--
-- Structure de la table `CDI_COMMANDE`
--

CREATE TABLE `CDI_COMMANDE` (
  `CO_NUMERO` char(8) DEFAULT NULL,
  `CO_DATE` datetime DEFAULT NULL,
  `CL_NUMERO` char(8) DEFAULT NULL,
  `MA_NUMERO` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CDI_COMMANDE`
--

INSERT INTO `CDI_COMMANDE` (`CO_NUMERO`, `CO_DATE`, `CL_NUMERO`, `MA_NUMERO`) VALUES
('C9713', NULL, 'C07', 'M10'),
('C9701', NULL, 'C07', 'M03'),
('C9702', NULL, 'C06', 'M12'),
('C9703', NULL, 'C13', 'M01'),
('C9704', NULL, 'C01', 'M02'),
('C9705', NULL, 'C08', 'M11'),
('C9706', NULL, 'C05', 'M04'),
('C9707', NULL, 'C04', 'M11'),
('C9708', NULL, 'C03', 'M12'),
('C9709', NULL, 'C10', 'M11'),
('C9710', NULL, 'C01', 'M11'),
('C9711', NULL, 'C12', 'M01'),
('C9712', NULL, 'C01', 'M11'),
('C9714', NULL, 'C06', 'M04');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_FOURNISSEUR`
--

CREATE TABLE `CDI_FOURNISSEUR` (
  `FO_NUMERO` char(8) NOT NULL DEFAULT '',
  `FO_NOM` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CDI_FOURNISSEUR`
--

INSERT INTO `CDI_FOURNISSEUR` (`FO_NUMERO`, `FO_NOM`) VALUES
('F01', 'CATI O ELECTRONIC'),
('F02', 'LES STYLOS REUNIS'),
('F03', 'MECANIQUE DE PRECISION'),
('F04', 'SARL ROULAND'),
('F05', 'ELECTROLAMP'),
('F06', 'RAMONAGE BDD');

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
-- Contenu de la table `CDI_LIGCDE`
--

INSERT INTO `CDI_LIGCDE` (`LIC_QTCMDEE`, `LIC_QTLIVREE`, `LIC_PU`, `CO_NUMERO`, `AR_NUMERO`, `DATE_LIV`) VALUES
('4', '1', 28, 'C9713', 'A04', NULL),
('1', '1', 25, 'C9713', 'A03', NULL),
('10', '4', 2, 'C9713', 'A10', NULL),
('1', '1', 28, 'C9701', 'A04', NULL),
('1', '1', 2, 'C9702', 'A10', NULL),
('2', '1', 3, 'C9702', 'A11', NULL),
('3', '3', 3, 'C9702', 'A14', NULL),
('1', '1', 40, 'C9703', 'A02', NULL),
('2', '2', 25, 'C9703', 'A03', NULL),
('5', '5', 5, 'C9703', 'A15', NULL),
('1', '1', 3, 'C9703', 'A14', NULL),
('1', '1', 3, 'C9703', 'A13', NULL),
('2', '0', 40, 'C9704', 'A02', NULL),
('1', '0', 3, 'C9704', 'A12', NULL),
('10', '0', 3, 'C9704', 'A13', NULL),
('8', '0', 5, 'C9704', 'A15', NULL),
('1', '0', 28, 'C9704', 'A05', NULL),
('1', '1', 28, 'C9705', 'A06', NULL),
('1', '1', 35, 'C9705', 'A08', NULL),
('1', '1', 2, 'C9706', 'A10', NULL),
('1', '0', 28, 'C9707', 'A07', NULL),
('1', '1', 10, 'C9708', 'A01', NULL),
('3', '3', 3, 'C9709', 'A12', NULL),
('3', '3', 3, 'C9709', 'A13', NULL),
('3', '3', 3, 'C9709', 'A14', NULL),
('3', '3', 5, 'C9709', 'A15', NULL),
('8', '8', 3, 'C9710', 'A12', NULL),
('9', '3', 3, 'C9710', 'A02', NULL),
('1', '0', 39, 'C9711', 'A09', NULL),
('5', '5', 5, 'C9712', 'A15', NULL),
('3', '1', 25, 'C9712', 'A03', NULL);

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
-- Contenu de la table `CDI_LIGLIV`
--

INSERT INTO `CDI_LIGLIV` (`LIL_QTLIVREE`, `LI_NUMERO`, `AR_NUMERO`) VALUES
(4, 'L9711', 'A10'),
(1, 'L9711', 'A03'),
(1, 'L9711', 'A04'),
(1, 'L9701', 'A04'),
(1, 'L9702', 'A10'),
(1, 'L9702', 'A11'),
(3, 'L9702', 'A14'),
(1, 'L9703', 'A02'),
(2, 'L9703', 'A03'),
(5, 'L9703', 'A15'),
(1, 'L9703', 'A14'),
(1, 'L9703', 'A13'),
(0, 'L9704', 'A02'),
(0, 'L9704', 'A12'),
(0, 'L9704', 'A13'),
(0, 'L9704', 'A15'),
(0, 'L9704', 'A05'),
(1, 'L9705', 'A06'),
(1, 'L9705', 'A08'),
(1, 'L9706', 'A10'),
(0, 'L9707', 'A07'),
(1, 'L9708', 'A01'),
(3, 'L9709', 'A12'),
(3, 'L9709', 'A13'),
(3, 'L9709', 'A15'),
(3, 'L9709', 'A14'),
(3, 'L9710', 'A02'),
(8, 'L9710', 'A12'),
(0, 'L9711', 'A09'),
(1, 'L9712', 'A03'),
(5, 'L9712', 'A05');

-- --------------------------------------------------------

--
-- Structure de la table `CDI_LIVRAISON`
--

CREATE TABLE `CDI_LIVRAISON` (
  `LI_NUMERO` char(8) DEFAULT NULL,
  `MA_NUMERO` char(8) DEFAULT NULL,
  `CO_NUMERO` char(8) DEFAULT NULL,
  `CL_NUMERO` char(8) DEFAULT NULL,
  `DATE_LIV` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CDI_LIVRAISON`
--

INSERT INTO `CDI_LIVRAISON` (`LI_NUMERO`, `MA_NUMERO`, `CO_NUMERO`, `CL_NUMERO`, `DATE_LIV`) VALUES
('L9701', 'M03', 'C9701', 'C07', NULL),
('L9702', 'M12', 'C9702', 'C06', NULL),
('L9703', 'M01', 'C9703', 'C13', NULL),
('L9704', 'M02', 'C9704', 'C01', NULL),
('L9705', 'M11', 'C9705', 'C08', NULL),
('L9706', 'M04', 'C9706', 'C05', NULL),
('L9707', 'M11', 'C9707', 'C04', NULL),
('L9708', 'M12', 'C9708', 'C03', NULL),
('L9709', 'M11', 'C9709', 'C10', NULL),
('L9710', 'M11', 'C9710', 'C01', NULL),
('L9711', 'M01', 'C9711', 'C12', NULL),
('L9712', 'M11', 'C9712', 'C01', NULL);

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
  `MA_NUMERO` char(8) DEFAULT NULL,
  `MA_LOCALITE` varchar(25) DEFAULT NULL,
  `MA_NOM_GERANT` varchar(25) DEFAULT NULL,
  `MA_PRENOM_GERANT` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `CDI_MAGASIN`
--

INSERT INTO `CDI_MAGASIN` (`MA_NUMERO`, `MA_LOCALITE`, `MA_NOM_GERANT`, `MA_PRENOM_GERANT`) VALUES
('M01', 'PARIS 5E', 'BERTON','Louis'),
('M02', 'PARIS 10E', 'JANNEAU','Luc'),
('M03', 'LYON', 'MOUILLARD','Marcel'),
('M04', 'MARSEILLE', 'CAMUS','Marius'),
('M05', 'MONTPELLIER', 'BAIJOT','Marc'),
('M06', 'BORDEAUX', 'DETIENNE','Nicole'),
('M07', 'NANTES', 'DUMONT','Henri'),
('M08', 'TOURS', 'DEMARTEAU','Renee'),
('M09', 'ROUEN', 'NOSSENT','Daniel'),
('M10', 'LILLE', 'NIZET','Jean Luc'),
('M11', 'BRUXELLES', 'VANDAELE','Annick'),
('M12', 'LIEGE', 'HANNEAU','Vincent');

--
-- Index pour la table `CDI_ARTICLE`
--
ALTER TABLE `CDI_ARTICLE`
  ADD PRIMARY KEY (`AR_NUMERO`);

--
-- Index pour la table `CDI_MAGASIN`
--
ALTER TABLE `CDI_MAGASIN`
  ADD PRIMARY KEY (`MA_NUMERO`);

  --
-- Index pour la table `CDI_COMMANDE`
--
ALTER TABLE `CDI_COMMANDE`
  ADD PRIMARY KEY (`CO_NUMERO`);


 --
-- Index pour la table `CDI_COMMANDE`
--
ALTER TABLE `CDI_LIVRAISON`
  ADD PRIMARY KEY (`LI_NUMERO`);

  --
-- Index pour la table `CDI_COMMANDE`
-- PERMET QUE LE COUPLE NOM - PRENOM - LOCALITE SOIT UNIQUE
ALTER TABLE `CDI_CLIENT`
  ADD PRIMARY KEY (`CL_NOM`,`CL_PRENOM`,`CL_LOCALITE`);


--
-- Index pour la table `CDI_FOURNISSEUR`
--
ALTER TABLE `CDI_FOURNISSEUR`
  ADD PRIMARY KEY (`FO_NUMERO`);

  CREATE TABLE CDI_PAYS 
(
  CODE_CIO varchar(3) 
, CODE_ISO varchar(3) 
, NOM varchar(50) 
, ANNEE_CREATION int
, ANNEE_DISPARITION int 
) ;

Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('ERI','ER ','ERYTHREE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('ETH','ET ','ETHIOPIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('ARG','AR ','ARGENTINE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('CRC','CR ','COSTA RICA',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('MOL','MD ','MOLDOVA',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('NZL','NZ ','NOUVELLE ZELANDE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('NOR','NO ','NORVEGE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('BRE','BR ','BRESIL',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('LUX','LU ','LUXEMBOURG',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('CRO','HR ','CROATIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('HON','HU ','HONGRIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('ESP','ES ','ESPAGNE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('POR','PT ','PORTUGAL',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('FRA','FR ','FRANCE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('AUS','AU ','AUSTRALIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('SUI','CH ','SUISSE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('ITA','IT ','ITALIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('BEL','BE ','BELGIQUE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('RUS','RU ','RUSSIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('USA','US ','ETATS-UNIS',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('UKR','UA ','UKRAINE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('UZB','UZ ','OUZBEKISTAN',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('KAZ','KZ ','KAZAKHSTAN',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('COL','CO ','COLOMBIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('POL','PL ','POLOGNE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('VEN','VE ','VENEZUELA',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('GBR','GB ','ROYAUME UNI',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('LIT','LT ','LITUANIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('JAP','JP ','JAPON',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('CZE','CZ ','REPUBLIQUE TCHEQUE','1993',null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('AUT','AT ','AUTRICHE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('LAT','LV ','LETTONIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('IRL','IE ','IRLANDE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('AND','AD ','ANDORRE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('SUE','SE ','SUEDE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('SM ','SM ','SAINT-MARIN',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('MC ','MC ','MONACO',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('FIN','FI ','FINLANDE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('EST','EE ','ESTONIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('MEX','MX ','MEXIQUE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('DEN','DK ','DANEMARK',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('RSA','ZA ','AFRIQUE DU SUD',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('SLV','SI ','SLOVENIE','1991',null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('KEN','KE ','KENYA',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('SLQ','SK ','SLOVAQUIE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('CAN','CA ','CANADA',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('BLR','BY ','BELARUS',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('CHN','CN ','CHINE',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('GER','DE ','ALLEMAGNE','1990',null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('NED','NL ','PAYS-BAS',null,null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('YUG','YU ','YOUGOSLAVIE','1929','2003');
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('TCH','CS ','TCHECOSLOVAQUIE','1918','1992');
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('UAE','AE ','EMIRATS ARABES UNIS','1971',null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('BRN','BH ','BAHREIN','2002',null);
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('URS','SU ','UNION DES REPUBLIQUES SOCIALISTES SOVIETIQUES','1922','1991');
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('GDR','DD ','REPUBLIQUE DEMOCRATIQUE ALLEMANDE','1949','1990');
Insert into CDI_PAYS (CODE_CIO,CODE_ISO,NOM,ANNEE_CREATION,ANNEE_DISPARITION) values ('FRG','DE ','REPUBLIQUE FEDRERALE D''ALLEMAGNE','1949','1990');