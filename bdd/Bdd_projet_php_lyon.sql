-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 08 déc. 2022 à 17:11
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_php_2022`
--

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `ID_FORMATEUR` char(25) NOT NULL,
  `NOM_FORMATEUR` char(25) NOT NULL,
  `PRENOM_FORMATEUR` char(25) DEFAULT NULL,
  `ID_SALLE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`ID_FORMATEUR`, `NOM_FORMATEUR`, `PRENOM_FORMATEUR`, `ID_SALLE`) VALUES
('638e17eec7d79', 'Pan', 'Peter', 121),
('638e17eec980d', 'Chirac', 'Jacque', 148),
('638e17eeca610', 'Daniel', 'Antoine', 158),
('638e17eecc5ab', 'Cluzel', 'Benjamin', 184);

-- --------------------------------------------------------

--
-- Structure de la table `nationalite`
--

CREATE TABLE `nationalite` (
  `ID_NATIONALITE` int(11) NOT NULL,
  `LIBELLE_NATIONALITE` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nationalite`
--

INSERT INTO `nationalite` (`ID_NATIONALITE`, `LIBELLE_NATIONALITE`) VALUES
(1, 'Français'),
(2, 'Suedois'),
(3, 'Egyptien'),
(4, 'Camrounais'),
(5, 'Bhoutan');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `ID_SALLE` int(11) NOT NULL,
  `LIBELLE_SALLE` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`ID_SALLE`, `LIBELLE_SALLE`) VALUES
(121, 'Salle_2'),
(148, 'Salle_1'),
(158, 'Salle_3'),
(184, 'Salle_4');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `ID_STAGIAIRE` char(25) NOT NULL,
  `NOM_STAGIAIRE` char(25) DEFAULT NULL,
  `PRENOM_STAGIAIRE` char(25) DEFAULT NULL,
  `ID_NATIONALITE` int(11) DEFAULT NULL,
  `ID_TYPE_FORMATION` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire_formateur`
--

CREATE TABLE `stagiaire_formateur` (
  `ID_STAGIAIRE` char(25) NOT NULL,
  `ID_FORMATEUR` char(25) NOT NULL,
  `DATE_DEBUT` date DEFAULT NULL,
  `DATE_FIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_formation`
--

CREATE TABLE `type_formation` (
  `ID_TYPE_FORMATION` char(25) NOT NULL,
  `LIBELLE_FORMATION` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_formation`
--

INSERT INTO `type_formation` (`ID_TYPE_FORMATION`, `LIBELLE_FORMATION`) VALUES
('638e0d095b193', 'Web designer'),
('638e0d0fb1227', 'Developpeur');

-- --------------------------------------------------------

--
-- Structure de la table `type_formation_formateur`
--

CREATE TABLE `type_formation_formateur` (
  `ID_TYPE_FORMATEUR` char(25) NOT NULL,
  `FOR_ID_FORMATEUR` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_formation_formateur`
--

INSERT INTO `type_formation_formateur` (`ID_TYPE_FORMATEUR`, `FOR_ID_FORMATEUR`) VALUES
('638e0d095b193', '638e17eec7d79'),
('638e0d095b193', '638e17eecc5ab'),
('638e0d0fb1227', '638e17eec7d79'),
('638e0d0fb1227', '638e17eec980d'),
('638e0d0fb1227', '638e17eeca610');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`ID_FORMATEUR`),
  ADD KEY `ID_SALLE` (`ID_SALLE`);

--
-- Index pour la table `nationalite`
--
ALTER TABLE `nationalite`
  ADD PRIMARY KEY (`ID_NATIONALITE`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`ID_SALLE`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`ID_STAGIAIRE`),
  ADD KEY `ID_TYPE_FORMATION` (`ID_TYPE_FORMATION`),
  ADD KEY `ID_NATIONALITE` (`ID_NATIONALITE`);

--
-- Index pour la table `stagiaire_formateur`
--
ALTER TABLE `stagiaire_formateur`
  ADD KEY `ID_STAGIAIRE` (`ID_STAGIAIRE`),
  ADD KEY `ID_FORMATEUR` (`ID_FORMATEUR`);

--
-- Index pour la table `type_formation`
--
ALTER TABLE `type_formation`
  ADD PRIMARY KEY (`ID_TYPE_FORMATION`);

--
-- Index pour la table `type_formation_formateur`
--
ALTER TABLE `type_formation_formateur`
  ADD KEY `ID_TYPE_FORMATEUR` (`ID_TYPE_FORMATEUR`,`FOR_ID_FORMATEUR`),
  ADD KEY `FOR_ID_FORMATEUR` (`FOR_ID_FORMATEUR`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `nationalite`
--
ALTER TABLE `nationalite`
  MODIFY `ID_NATIONALITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `formateur_ibfk_1` FOREIGN KEY (`ID_SALLE`) REFERENCES `salle` (`ID_SALLE`);

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`ID_NATIONALITE`) REFERENCES `nationalite` (`ID_NATIONALITE`),
  ADD CONSTRAINT `stagiaire_ibfk_2` FOREIGN KEY (`ID_TYPE_FORMATION`) REFERENCES `type_formation` (`ID_TYPE_FORMATION`);

--
-- Contraintes pour la table `stagiaire_formateur`
--
ALTER TABLE `stagiaire_formateur`
  ADD CONSTRAINT `stagiaire_formateur_ibfk_1` FOREIGN KEY (`ID_STAGIAIRE`) REFERENCES `stagiaire` (`ID_STAGIAIRE`),
  ADD CONSTRAINT `stagiaire_formateur_ibfk_2` FOREIGN KEY (`ID_FORMATEUR`) REFERENCES `formateur` (`ID_FORMATEUR`);

--
-- Contraintes pour la table `type_formation_formateur`
--
ALTER TABLE `type_formation_formateur`
  ADD CONSTRAINT `type_formation_formateur_ibfk_1` FOREIGN KEY (`ID_TYPE_FORMATEUR`) REFERENCES `type_formation` (`ID_TYPE_FORMATION`),
  ADD CONSTRAINT `type_formation_formateur_ibfk_2` FOREIGN KEY (`FOR_ID_FORMATEUR`) REFERENCES `formateur` (`ID_FORMATEUR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
