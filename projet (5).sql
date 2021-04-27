-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 27 avr. 2021 à 20:09
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`idabonnement`, `prix`, `nomabonnement`) VALUES
(1, 0, 'standard'),
(3, 1.99, 'premium');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `idcommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `note_com` int(11) NOT NULL,
  `dateCommentaire` date NOT NULL,
  `contenucom` text NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  PRIMARY KEY (`idcommentaire`),
  KEY `Commentaire_Utilisateur_FK` (`idutilisateur`),
  KEY `Commentaire_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`idcommentaire`, `note_com`, `dateCommentaire`, `contenucom`, `idutilisateur`, `idtuto`) VALUES
(1, 4, '2021-04-27', 'bonjour jadore ce tuto ', 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

DROP TABLE IF EXISTS `etape`;
CREATE TABLE IF NOT EXISTS `etape` (
  `idetape` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `idtuto` int(11) NOT NULL,
  `idphoto` int(11) NOT NULL,
  PRIMARY KEY (`idetape`),
  KEY `etape_tuto_FK` (`idtuto`),
  KEY `etape_photo_FK` (`idphoto`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`idetape`, `texte`, `idtuto`, `idphoto`) VALUES
(19, 'Plier le tissu en deux, endroit contre endroit. Coudre au point droit, sur toute la longueur, le côté opposé à la pliure.', 6, 25),
(20, 'Retourner le tissu à l\'aide d\'une épingle à nourrice. On se retrouve avec un tube.', 6, 26),
(21, 'Faire passer l\'élastique à l\'intérieur du tube.', 6, 27),
(22, 'Nouer les deux extremités de l\'élastique ensemble.', 6, 28),
(23, 'Ramener les extremités du tissu ensemble et rentrer l\'une dans l\'autre. Prendre une aiguille et fermer le \"trou\" en cousant à la main. Vous pouvez aussi le faire a la machine mais le résultat est moins beau.', 6, 29);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `idmateriel` int(11) NOT NULL AUTO_INCREMENT,
  `nommateriel` varchar(50) NOT NULL,
  PRIMARY KEY (`idmateriel`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`idmateriel`, `nommateriel`) VALUES
(56, 'elastique'),
(57, 'tissu'),
(58, 'machine à coudre'),
(59, 'fil'),
(60, 'épingles à nourrice'),
(61, 'épingles');

-- --------------------------------------------------------

--
-- Structure de la table `necessite`
--

DROP TABLE IF EXISTS `necessite`;
CREATE TABLE IF NOT EXISTS `necessite` (
  `idmateriel` int(11) NOT NULL,
  `idtuto` int(11) NOT NULL,
  `quantité` varchar(255) NOT NULL,
  PRIMARY KEY (`idmateriel`,`idtuto`),
  KEY `necessite_Tuto0_FK` (`idtuto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `necessite`
--

INSERT INTO `necessite` (`idmateriel`, `idtuto`, `quantité`) VALUES
(56, 6, '15cm'),
(57, 6, 'rectangle de 50x10cm'),
(58, 6, '1'),
(59, 6, '1'),
(60, 6, '1'),
(61, 6, '10');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int(11) NOT NULL AUTO_INCREMENT,
  `datePhoto` date NOT NULL,
  `chemin` varchar(100) NOT NULL,
  `idtuto` int(11) DEFAULT NULL,
  `idcommentaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`idphoto`),
  KEY `Photo_Tuto_FK` (`idtuto`),
  KEY `Photo_Commentaire1_FK` (`idcommentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idphoto`, `datePhoto`, `chemin`, `idtuto`, `idcommentaire`) VALUES
(24, '2021-04-26', '20210214_204212.jpg', 6, NULL),
(25, '2021-04-26', '20210125_162021.jpg', NULL, NULL),
(26, '2021-04-26', '20210125_162354.jpg', NULL, NULL),
(27, '2021-04-26', '20210125_162545.jpg', NULL, NULL),
(28, '2021-04-26', '20210125_162750.jpg', NULL, NULL),
(29, '2021-04-26', '20210125_162810.jpg', NULL, NULL),
(30, '2021-04-26', '20210125_162927.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `souscrire`
--

DROP TABLE IF EXISTS `souscrire`;
CREATE TABLE IF NOT EXISTS `souscrire` (
  `idabonnement` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `typePaiement` varchar(255) DEFAULT NULL,
  `dateDebut` date NOT NULL,
  `dateresiliation` date DEFAULT NULL,
  PRIMARY KEY (`idabonnement`,`idutilisateur`),
  KEY `Souscrire_Utilisateur0_FK` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `souscrire`
--

INSERT INTO `souscrire` (`idabonnement`, `idutilisateur`, `typePaiement`, `dateDebut`, `dateresiliation`) VALUES
(3, 21, 'paypal', '2021-04-27', NULL);

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
  `titreTuto` varchar(255) NOT NULL,
  `textpresentation` text NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idtuto`),
  KEY `tuto_utilisateur_FK` (`idutilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tuto`
--

INSERT INTO `tuto` (`idtuto`, `dateCreation`, `theme`, `titreTuto`, `textpresentation`, `idutilisateur`) VALUES
(6, '2021-04-26', 'couture', 'Scrunchies:', 'Besoin d\'un chouchou pour attacher vos cheveux ? Ce tuto est fait pour vous!', 6),
(8, '2021-04-26', 'deco', 'bonjout', 'ejnkdcejncdk,feck,fk', 8),
(9, '2021-04-26', 'couture', 'chouhcou', 'edzjnkd,eznzdiskzeALIOQ', 21);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `themefavorie`, `nom`, `prenom`, `email`, `mdp`, `pseudo`, `dateNaissance`) VALUES
(6, 'couture', 'TESSIER', 'amelie', 'amelie.tessier02@gmail.com', '$6$rounds=5000$14ecoaj87enek720$rn7l6o7zlDuRmJMBogUK3FOld9ePSzG3n5pdzoxc55dnLvcF8woyaZN0KoPGGeU93Yz6G0o7SewK0yeIomRfd.', 'amel22', '2002-08-02'),
(7, 'decoration', 'TESSIER', 'beatrice', 'fam.tessier@live.fr', '$6$rounds=5000$14ecoaj87enek720$RNeyF6WD8FEmsJPdjuHrtUnf0nN1.9aZ9MkIvVwYdMVvWxhnFiaImCv8FNyF18T69MGYf2FwKfKrBSBuNelTg0', 'beatt', '1972-03-11'),
(8, 'couture', 'TESSIER', 'cloe', 'guillaume.zdlm@gmail.com', 'cloe', 'clocacao', '2002-08-09'),
(9, 'couture', 'Béatrice', 'TESSIER', 'guillaume.zdlm@gmail.com', 'bea', 'bbbbbbb', '2002-08-02'),
(21, 'couture', 'louis', 'hiiuou', 'louis.hiiou@hotmail.fr', 'Louis.1', 'loulous', '2021-04-09');

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
  ADD CONSTRAINT `Photo_Commentaire1_FK` FOREIGN KEY (`idcommentaire`) REFERENCES `commentaire` (`idcommentaire`),
  ADD CONSTRAINT `Photo_Tuto_FK` FOREIGN KEY (`idtuto`) REFERENCES `tuto` (`idtuto`);

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

--
-- Contraintes pour la table `tuto`
--
ALTER TABLE `tuto`
  ADD CONSTRAINT `tuto_utilisateur_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
