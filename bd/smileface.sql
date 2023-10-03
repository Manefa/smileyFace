-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 29 Septembre 2023 à 15:29
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smileface`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`id`, `code`, `Name`) VALUES
(1, '420.BO', 'Techniques de l informatique'),
(2, '241.A0', 'Techniques de genie mecanique');

-- --------------------------------------------------------

--
-- Structure de la table `employeesatisfaction`
--

CREATE TABLE `employeesatisfaction` (
  `idEm` int(11) NOT NULL,
  `satisfactionlevelEm` int(11) NOT NULL,
  `idEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `idEv` int(11) NOT NULL,
  `nameEv` varchar(255) NOT NULL,
  `dateEv` date NOT NULL,
  `locationEv` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEv`, `nameEv`, `dateEv`, `locationEv`, `idUser`) VALUES
(1, 'Danse', '2023-09-26', 'SA2090', 2),
(2, 'Music', '2023-09-29', 'SA3090', 2),
(19, 'fdsf', '2023-10-02', 'fsd', 2),
(20, 'fsd', '2023-10-06', 'fsd', 2),
(21, 'fsd', '2023-10-06', 'fsd', 2),
(22, 'fsd', '2023-10-06', 'fsd', 2),
(23, 'fsd', '2023-10-06', 'fsd', 2),
(24, 'test', '1969-12-31', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `liason`
--

CREATE TABLE `liason` (
  `id` int(11) NOT NULL,
  `idEv` int(11) NOT NULL,
  `idDpt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `liason`
--

INSERT INTO `liason` (`id`, `idEv`, `idDpt`) VALUES
(1, 2, 2),
(2, 2, 1),
(3, 2, 1),
(4, 19, 2),
(5, 20, 1),
(6, 20, 2),
(7, 21, 2),
(8, 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `studentsatisfaction`
--

CREATE TABLE `studentsatisfaction` (
  `idEt` int(11) NOT NULL,
  `satisfactionlevelEt` int(11) NOT NULL,
  `idEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `lastname`, `firstname`, `email`, `password`) VALUES
(2, 'manefa', 'yousouf', 'manefae8@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employeesatisfaction`
--
ALTER TABLE `employeesatisfaction`
  ADD PRIMARY KEY (`idEm`),
  ADD KEY `idEv` (`idEv`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idEv`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `liason`
--
ALTER TABLE `liason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEvent` (`idEv`),
  ADD KEY `idDept` (`idDpt`);

--
-- Index pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  ADD PRIMARY KEY (`idEt`),
  ADD KEY `idEv` (`idEv`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `employeesatisfaction`
--
ALTER TABLE `employeesatisfaction`
  MODIFY `idEm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `liason`
--
ALTER TABLE `liason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  MODIFY `idEt` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `employeesatisfaction`
--
ALTER TABLE `employeesatisfaction`
  ADD CONSTRAINT `fk_employeesatisfaction_event` FOREIGN KEY (`idEv`) REFERENCES `event` (`idEv`);

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `liason`
--
ALTER TABLE `liason`
  ADD CONSTRAINT `fk_liason_departement` FOREIGN KEY (`idDpt`) REFERENCES `departement` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_liason_event` FOREIGN KEY (`idEv`) REFERENCES `event` (`idEv`) ON DELETE CASCADE;

--
-- Contraintes pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  ADD CONSTRAINT `fk_studentsatisfaction_event` FOREIGN KEY (`idEv`) REFERENCES `event` (`idEv`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
