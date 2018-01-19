-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 19 jan. 2018 à 10:08
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

DROP TABLE IF EXISTS `contenu`;
CREATE TABLE IF NOT EXISTS `contenu` (
  `ID_CONTENU` int(11) NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(256) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `DATE_ENTREE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `COMMENTAIRE` varchar(4000) DEFAULT NULL,
  `CHEMIN_PHOTO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_CONTENU`),
  KEY `fk_contenu_id_user` (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenu`
--

INSERT INTO `contenu` (`ID_CONTENU`, `TITRE`, `ID_USER`, `DATE_ENTREE`, `COMMENTAIRE`, `CHEMIN_PHOTO`) VALUES
(1, 'Desert', 1, '2018-01-19 10:43:35', 'Ceci est un paysage du desert.', 'desert.jpg'),
(2, 'Desert2', 1, '2018-01-19 10:44:05', 'Ceci est aussi un paysage du desert.', 'desert.jpg'),
(3, 'Desert3', 2, '2018-01-19 11:02:17', 'L\'aventure !', 'desert.jpg'),
(4, 'DÃ©sert avec un \'Ã©\'', 3, '2018-01-19 11:06:22', 'L\'aventure dans le dÃ©sert !', 'desert.jpg'),
(5, 'Aventure', 1, '2018-01-19 11:07:29', 'Peut-Ãªtre une nouvelle aventure ? ', 'desert.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`) VALUES
(1, 'Alex'),
(2, 'Ben'),
(3, 'Nathan');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD CONSTRAINT `fk_contenu_id_user` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
