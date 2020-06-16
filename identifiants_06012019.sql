-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 06 jan. 2019 à 12:11
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `identifiants`
--

-- --------------------------------------------------------

--
-- Structure de la table `api_key`
--

DROP TABLE IF EXISTS `api_key`;
CREATE TABLE IF NOT EXISTS `api_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `api_key`
--

INSERT INTO `api_key` (`id`, `auth_key`) VALUES
(1, '7ab2827287eb8aee9f4d69d25c56f543');

-- --------------------------------------------------------

--
-- Structure de la table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id_app` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_app` int(11) NOT NULL,
  `nom_app` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  `cle_authen` varchar(50) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `version_app` varchar(10) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_app`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `application`
--

INSERT INTO `application` (`id_app`, `id_type_app`, `nom_app`, `login`, `mdp`, `cle_authen`, `commentaire`, `version_app`, `id_type`) VALUES
(1, 1, 'Kobo desktop', 'diabatejs@yahoo.fr', 'Fn@c2018', '', '', '', 7),
(2, 2, '4', '1', '2', '', '3', '5', 36);

-- --------------------------------------------------------

--
-- Structure de la table `carte_bancaire`
--

DROP TABLE IF EXISTS `carte_bancaire`;
CREATE TABLE IF NOT EXISTS `carte_bancaire` (
  `id_carte` int(11) NOT NULL AUTO_INCREMENT,
  `banque` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `date_exp` varchar(8) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_carte`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carte_bancaire`
--

INSERT INTO `carte_bancaire` (`id_carte`, `banque`, `numero`, `date_exp`, `commentaire`, `id_type`) VALUES
(1, 'Societe Generale', 'xxxxx - xxxxx - xxxxx - xxxxx', '05/20_4', '3', 8),
(2, 'Credit Lyonnais', 'xyxyx - xyxyx - xyxyx - yxyxy', '05/25', '', 38);

-- --------------------------------------------------------

--
-- Structure de la table `compte_messagerie`
--

DROP TABLE IF EXISTS `compte_messagerie`;
CREATE TABLE IF NOT EXISTS `compte_messagerie` (
  `id_compte` int(11) NOT NULL AUTO_INCREMENT,
  `nom_messagerie` varchar(50) NOT NULL,
  `lien_conn` varchar(150) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_compte`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte_messagerie`
--

INSERT INTO `compte_messagerie` (`id_compte`, `nom_messagerie`, `lien_conn`, `login`, `mdp`, `commentaire`, `id_type`) VALUES
(1, 'Gmail', 'mail.google.com', 'djstechnologies@gmail.com', '', '', 2),
(2, 'Yahoo', 'mail.yahoo.fr', 'diabatejs@yahoo.fr', 'verssace', 'Mail yahoo', 35);

-- --------------------------------------------------------

--
-- Structure de la table `serveur`
--

DROP TABLE IF EXISTS `serveur`;
CREATE TABLE IF NOT EXISTS `serveur` (
  `id_serveur` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_serveur` int(11) NOT NULL,
  `lien_serveur` varchar(150) NOT NULL,
  `adresse_ip` varchar(15) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `nom_os` varchar(50) NOT NULL,
  `version_os` varchar(15) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_serveur`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serveur`
--

INSERT INTO `serveur` (`id_serveur`, `id_type_serveur`, `lien_serveur`, `adresse_ip`, `login`, `mdp`, `commentaire`, `nom_os`, `version_os`, `id_type`) VALUES
(1, 4, '', '', '', '', '', '', '', 39),
(2, 3, 'https://a.b.com', '192.168.0.1', 'azerty', 'lg_azerty', 'serveur de test', 'Linux', 'Debian 12', 40);

-- --------------------------------------------------------

--
-- Structure de la table `site_web`
--

DROP TABLE IF EXISTS `site_web`;
CREATE TABLE IF NOT EXISTS `site_web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_site_web` int(11) NOT NULL,
  `lien_conn` varchar(150) NOT NULL,
  `login` varchar(50) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  `commentaire` varchar(100) NOT NULL,
  `id_type_identifiant` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `site_web`
--

INSERT INTO `site_web` (`id`, `id_type_site_web`, `lien_conn`, `login`, `mdp`, `commentaire`, `id_type_identifiant`) VALUES
(1, 1, 'https://www.facebook.com/', 'diabatejs@yahoo.fr', '', '', 1),
(2, 2, 'http://djstechnologies.fr/', 'LWS-342607', '', 'Hebergeur :panel.lws.fr', 3),
(3, 3, 'www.airfrance.fr', 'diabatejs@yahoo.fr', '', '', 4),
(4, 4, 'dictee.orthodidacte.com', 'diabatejs2018', 'dictes2018', 'Dictee en ligne.', 5),
(5, 4, 'brilliant.org', 'diabatejs@yahoo.fr', 'qu@nt2018', 'Entrainement analyse quantitative.', 6),
(7, 3, 'versace_225.fr', 'versace', 'abc225', 'Identifiant 225', 21),
(8, 4, 'www.test225.com', 'test225', 't225', 'Test pour les applications 225', 22),
(9, 2, 'www.djstechno-app2019.com', 'app_2019', '@2019', 'Application web 2019', 23),
(10, 4, 'https://web-design-2019.com', 'wDesign', 'wd2019', 'Web Design for 2019', 24),
(11, 3, 'vers-versace.org', 'ver-versus', '2019', 'versace_versus2019', 25),
(12, 4, 'versace.com', 'jean.diabate', 'j', 'Jean Sekou', 28);

-- --------------------------------------------------------

--
-- Structure de la table `type_application`
--

DROP TABLE IF EXISTS `type_application`;
CREATE TABLE IF NOT EXISTS `type_application` (
  `id_type_app` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_app` varchar(50) NOT NULL,
  `icon_type_app` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_app`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_application`
--

INSERT INTO `type_application` (`id_type_app`, `libelle_type_app`, `icon_type_app`) VALUES
(1, 'client_lourd', ''),
(2, 'client_leger', ''),
(3, 'web', ''),
(4, 'mobile', ''),
(5, 'api', '');

-- --------------------------------------------------------

--
-- Structure de la table `type_identifiant`
--

DROP TABLE IF EXISTS `type_identifiant`;
CREATE TABLE IF NOT EXISTS `type_identifiant` (
  `id_ident` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_ident` varchar(50) NOT NULL,
  `icon_type_ident` varchar(100) NOT NULL,
  PRIMARY KEY (`id_ident`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_identifiant`
--

INSERT INTO `type_identifiant` (`id_ident`, `libelle_ident`, `icon_type_ident`) VALUES
(1, 'Facebook', ''),
(2, 'Gmail', ''),
(3, 'djstechnologies.fr', ''),
(4, 'Air France', ''),
(5, 'Dictee', ''),
(6, 'brilliant.org', ''),
(7, 'Application epud kobo', ''),
(8, 'cb ecommerce', ''),
(28, 'Test_jean_02012019_21h53', ''),
(27, 'Test_jean_02012019_21h53', ''),
(26, 'test_web_jean_02012019_21h52', ''),
(25, 'versace-versus-2019', ''),
(24, 'webDesign2019', ''),
(23, 'working_app_2019', ''),
(22, 'test_225', ''),
(21, 'versace_225', ''),
(34, 'Gmail', ''),
(35, 'Yahoo', ''),
(36, 'Application test 02012019 23h15', ''),
(38, 'CB West Point', ''),
(39, 'Test Serveur 03012019', ''),
(40, 'Test Serveur 03012019 00h39', '');

-- --------------------------------------------------------

--
-- Structure de la table `type_serveur`
--

DROP TABLE IF EXISTS `type_serveur`;
CREATE TABLE IF NOT EXISTS `type_serveur` (
  `id_type_serveur` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type_serveur` varchar(100) NOT NULL,
  `icon_type_serveur` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_serveur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_serveur`
--

INSERT INTO `type_serveur` (`id_type_serveur`, `libelle_type_serveur`, `icon_type_serveur`) VALUES
(1, 'serveur_bd', ''),
(2, 'serveur_fichier', ''),
(3, 'serveur_messagerie', ''),
(4, 'serveur_app', '');

-- --------------------------------------------------------

--
-- Structure de la table `type_site_web`
--

DROP TABLE IF EXISTS `type_site_web`;
CREATE TABLE IF NOT EXISTS `type_site_web` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_type` varchar(50) NOT NULL,
  `icon_type_site_web` varchar(100) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_site_web`
--

INSERT INTO `type_site_web` (`id_type`, `libelle_type`, `icon_type_site_web`) VALUES
(1, 'Facebook', ''),
(2, 'Hebergement web', ''),
(3, 'e-commerce', ''),
(4, 'standard', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
