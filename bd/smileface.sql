-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 02 Octobre 2023 à 01:44
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

--
-- Contenu de la table `employeesatisfaction`
--

INSERT INTO `employeesatisfaction` (`idEm`, `satisfactionlevelEm`, `idEv`) VALUES
(1, 2, 31),
(2, 1, 31),
(3, 1, 31),
(4, 2, 31),
(5, 3, 31),
(6, 3, 31),
(7, 1, 31),
(8, 1, 31),
(9, 2, 31),
(10, 3, 31),
(11, 3, 31),
(12, 1, 31);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `idEv` int(11) NOT NULL,
  `nameEv` varchar(255) NOT NULL,
  `dateEv` date NOT NULL,
  `timeEv` varchar(255) NOT NULL,
  `locationEv` varchar(255) CHARACTER SET ucs2 NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEv`, `nameEv`, `dateEv`, `timeEv`, `locationEv`, `idUser`) VALUES
(30, 'Danse', '2023-08-17', '12:30 AM', 'SA2090', 2),
(31, 'test2', '2023-10-04', '12:05 AM', 'fdsfds', 2),
(32, 'test', '2023-11-11', '12:45 AM', 'dsad', 2),
(33, 'dsads', '2023-11-11', '1:05 AM', 'dsad', 2),
(34, 'fdsf', '2023-09-14', '4:50 AM', 'dsfds', 2),
(35, 'fdsf', '2023-09-14', '1:05 AM', 'dsfds', 2);

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
(19, 30, 2),
(20, 30, 1),
(21, 30, 1),
(26, 31, 2),
(27, 31, 1),
(28, 32, 1),
(29, 32, 2),
(30, 33, 1);

-- --------------------------------------------------------

--
-- Structure de la table `studentsatisfaction`
--

CREATE TABLE `studentsatisfaction` (
  `idEt` int(11) NOT NULL,
  `satisfactionlevelEt` int(11) NOT NULL,
  `idEv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `studentsatisfaction`
--

INSERT INTO `studentsatisfaction` (`idEt`, `satisfactionlevelEt`, `idEv`) VALUES
(1, 2, 31),
(2, 2, 31),
(3, 3, 31),
(4, 1, 31),
(5, 1, 31),
(6, 1, 31);

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
  MODIFY `idEm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `liason`
--
ALTER TABLE `liason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  MODIFY `idEt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
