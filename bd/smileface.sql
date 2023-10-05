-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 04 Octobre 2023 à 02:01
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

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
(13, 2, 30),
(14, 3, 30),
(15, 2, 30),
(16, 1, 30),
(17, 2, 30),
(18, 3, 30),
(19, 3, 30),
(20, 2, 30),
(21, 1, 30),
(22, 2, 30),
(23, 3, 30),
(24, 2, 50),
(25, 3, 50),
(26, 2, 50),
(27, 1, 50),
(28, 1, 50),
(29, 2, 50),
(30, 3, 50),
(31, 3, 50),
(32, 3, 50),
(33, 3, 50),
(34, 2, 50),
(35, 2, 50),
(36, 1, 50),
(37, 1, 50),
(38, 2, 50),
(39, 3, 50),
(40, 3, 50),
(41, 3, 50),
(42, 3, 50),
(43, 2, 50),
(44, 1, 50);

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
  `employeurEv` varchar(255) NOT NULL,
  `descriptionEv` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `event`
--

INSERT INTO `event` (`idEv`, `nameEv`, `dateEv`, `timeEv`, `locationEv`, `employeurEv`, `descriptionEv`, `idUser`) VALUES
(30, 'Danse', '2023-10-19', '12:30 ', 'SA2090', 'GOX', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 2),
(46, 'fsd', '2023-10-05', '19:35', 'fsd', 'fsd', 'fds', 2),
(47, 'fdg', '2023-10-13', '17:50', 'gdf', 'gdf', 'gdf', 2),
(48, 'fsd', '2023-10-12', '12:50', 'fsd', 'fds', 'fsd', 2),
(49, 'fsd', '2023-10-05', '17:50', 'SA2090', 'fds', 'high quality products', 2),
(50, 'fsd', '2023-10-20', '17:50', 'SA2090', 'fds', 'das', 2);

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
(31, 46, 2),
(32, 46, 1),
(33, 47, 1),
(34, 48, 1),
(35, 49, 1),
(36, 50, 2);

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
(7, 1, 30),
(8, 1, 30),
(9, 1, 30),
(10, 1, 30),
(11, 1, 30),
(12, 1, 30),
(13, 1, 30),
(14, 1, 30),
(15, 1, 30),
(16, 2, 30),
(17, 1, 30),
(18, 3, 30),
(19, 3, 30),
(20, 3, 30),
(21, 1, 30),
(22, 1, 30),
(23, 2, 30),
(24, 2, 30),
(25, 3, 30),
(26, 2, 30),
(27, 1, 30),
(28, 1, 30),
(29, 2, 30),
(30, 3, 30),
(31, 2, 30),
(32, 3, 30),
(33, 1, 30),
(34, 2, 30),
(35, 2, 30),
(36, 3, 30),
(37, 2, 30),
(38, 1, 30),
(39, 1, 30),
(40, 2, 30),
(41, 3, 30),
(42, 2, 30),
(43, 1, 30),
(44, 1, 30),
(45, 1, 30),
(46, 2, 30),
(47, 3, 30),
(48, 3, 30),
(49, 2, 30),
(50, 3, 30),
(51, 1, 30),
(52, 2, 30),
(53, 1, 30),
(54, 3, 30),
(55, 2, 30),
(56, 1, 30);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `poste` varchar(255) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `image`, `lastname`, `firstname`, `poste`, `email`, `password`, `pin`) VALUES
(2, 'https://pnganime.com/web/images/l/luffy-gear-5-colored.png', 'LUFFY', 'fds', 'fds', 'fsd@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 1234),
(4, 'https://assets.stickpng.com/images/584e837f6a5ae41a83ddee3b.png', 'fewf', 'weew', 'rwe', 'fds@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234),
(6, 'https://pnganime.com/web/images/l/luffy-gear-5-colored.png', 'aaaaaaaaaaaaaa', 'fds', 'fds', 'fsd@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234);

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
  MODIFY `idEm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `liason`
--
ALTER TABLE `liason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  MODIFY `idEt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `employeesatisfaction`
--
ALTER TABLE `employeesatisfaction`
  ADD CONSTRAINT `fk_employeesatisfaction_event` FOREIGN KEY (`idEv`) REFERENCES `event` (`idEv`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `fk_studentsatisfaction_event` FOREIGN KEY (`idEv`) REFERENCES `event` (`idEv`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
