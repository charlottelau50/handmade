-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 avr. 2021 à 18:09
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `idabonnement` int(11) NOT NULL AUTO_INCREMENT,
  `prix` float NOT NULL,
  `nomabonnement` varchar(100) NOT NULL,
  PRIMARY KEY (`idabonnement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idcommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `dateCommentaire` date NOT NULL,
  `contenucom` text NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  PRIMARY KEY (`idcommentaire`),
  KEY `Commentaire_Utilisateur_FK` (`idutilisateur`),
  KEY `Commentaire_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `donner_acces`
--

DROP TABLE IF EXISTS `donner_acces`;
CREATE TABLE IF NOT EXISTS `donner_acces` (
  `idtuto` int(11) NOT NULL,
  `idabonnement` int(11) NOT NULL,
  PRIMARY KEY (`idtuto`,`idabonnement`),
  KEY `Donner_acces_Abonnement0_FK` (`idabonnement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `idetape` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `texte` text NOT NULL,
  `idtuto` int(11) NOT NULL,
  `idphoto` int(11) NOT NULL,
  PRIMARY KEY (`idetape`),
  KEY `etape_tuto_FK` (`idtuto`),
  KEY `etape_photo_FK` (`idphoto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idetape`, `titre`, `texte`, `idtuto`, `idphoto`) VALUES
(2, 'Etape1', 'Etape1_texte', 101, 1),
(3, 'Etape2', 'Etape2_texte', 101, 1);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `idmateriel` int(11) NOT NULL AUTO_INCREMENT,
  `nommateriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idmateriel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`idmateriel`, `nommateriel`) VALUES
(1, 'Vieilles bougies'),
(2, 'Mèche de bougie (pré-cirée, idéalement) avec socle');

-- --------------------------------------------------------

--
-- Structure de la table `necessite`
--

DROP TABLE IF EXISTS `necessite`;
CREATE TABLE IF NOT EXISTS `necessite` (
  `idmateriel` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  PRIMARY KEY (`idmateriel`,`idtuto`),
  KEY `necessite_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int(11) NOT NULL AUTO_INCREMENT,
  `datePhoto` date NOT NULL,
  `titrePhoto` text NOT NULL,
  `chemin` varchar(100) NOT NULL,
  `idcommentaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`idphoto`),
  KEY `Photo_Commentaire1_FK` (`idcommentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idphoto`, `datePhoto`, `titrePhoto`, `chemin`, `idcommentaire`) VALUES
(1, '2021-04-21', 'titrePhoto', 'URL image', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `souscrire`
--

DROP TABLE IF EXISTS `souscrire`;
CREATE TABLE IF NOT EXISTS `souscrire` (
  `idabonnement` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `typePaiement` varchar(50) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateresiliation` date NOT NULL,
  PRIMARY KEY (`idabonnement`,`idutilisateur`),
  KEY `Souscrire_Utilisateur0_FK` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suivre`
--

DROP TABLE IF EXISTS `suivre`;
CREATE TABLE IF NOT EXISTS `suivre` (
  `idtuto` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idtuto`,`idutilisateur`),
  KEY `Suivre_Utilisateur0_FK` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tuto`
--

DROP TABLE IF EXISTS `tuto`;
CREATE TABLE IF NOT EXISTS `tuto` (
  `idtuto` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` date NOT NULL,
  `theme` varchar(255) NOT NULL,
  `titreTuto` text NOT NULL,
  `textpresentation` text NOT NULL,
  PRIMARY KEY (`idtuto`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tuto`
--

INSERT INTO `tuto` (`idtuto`, `dateCreation`, `theme`, `titreTuto`, `textpresentation`) VALUES
(101, '2021-04-21', 'Décoration', 'Un titre de tuto', 'bblablabllablalbabcvvd\r\n vvcv\r\n vvvcv \r\n');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `themefavorie` varchar(100) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `prenom` varchar(80) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `themefavorie`, `nom`, `prenom`, `email`, `mdp`, `pseudo`, `dateNaissance`) VALUES
(2, '2', 'TESSIER', 'beatrice', 'fam.tessier@live.fr', '$6$rounds=5000$14ecoaj87enek720$cLq73S5FZ7brRShCw6eiFQ38Rp//McPZLELSGIQ7DKQ7YCIwMl.AZ4nxj58VdSMXwePL9aLpXu1LW/hFBkYr30', 'beatt', '1972-03-11'),
(5, 'couture', 'TESSIER', 'amelie', 'amelie.tessier02@gmail.com', '$6$rounds=5000$14ecoaj87enek720$rn7l6o7zlDuRmJMBogUK3FOld9ePSzG3n5pdzoxc55dnLvcF8woyaZN0KoPGGeU93Yz6G0o7SewK0yeIomRfd.', 'amel22', '2002-08-02'),
(6, 'decoration', 'Jallois', 'Romain', 'ro@gmail.com', '$6$rounds=5000$14ecoaj87enek720$uuBvh57xfJHVmRUdoRry1Omp0cKjlROAsariV5KdO7nxggaZujZ6ClaVEi8BZZBDbhRlvzPJxZwzhsm4U.1MO.', 'rojalls', '2021-04-23');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `Commentaire_Tuto0_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `Commentaire_Utilisateur_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `donner_acces`
--
ALTER TABLE `donner_acces`
  ADD CONSTRAINT `Donner_acces_Abonnement0_FK` FOREIGN KEY (`idabonnement`) REFERENCES `abonnement` (`idabonnement`),
  ADD CONSTRAINT `Donner_acces_Tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`);

--
-- Contraintes pour la table `etape`
--
ALTER TABLE `etape`
  ADD CONSTRAINT `etape_photo_FK` FOREIGN KEY (`idphoto`) REFERENCES `photo` (`idphoto`),
  ADD CONSTRAINT `etape_tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`);

--
-- Contraintes pour la table `necessite`
--
ALTER TABLE `necessite`
  ADD CONSTRAINT `necessite_Tuto0_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `necessite_materiel_FK` FOREIGN KEY (`idmateriel`) REFERENCES `materiel` (`idmateriel`);

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_Commentaire1_FK` FOREIGN KEY (`idcommentaire`) REFERENCES `commentaire` (`idcommentaire`);

--
-- Contraintes pour la table `souscrire`
--
ALTER TABLE `souscrire`
  ADD CONSTRAINT `Souscrire_Abonnement_FK` FOREIGN KEY (`idabonnement`) REFERENCES `abonnement` (`idabonnement`),
  ADD CONSTRAINT `Souscrire_Utilisateur0_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `suivre`
--
ALTER TABLE `suivre`
  ADD CONSTRAINT `Suivre_Tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`),
  ADD CONSTRAINT `Suivre_Utilisateur0_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
