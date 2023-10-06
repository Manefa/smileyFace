-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 06 Octobre 2023 à 12:03
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
(2, '241.A0', 'Techniques de genie mecanique'),
(3, '570.EO', 'Techniques de design d\'intérieur'),
(4, '393.BO', 'Techniques de la documentation'),
(5, '111.AO', 'Techniques d\'hygiène dentaire'),
(6, '120.AO', 'Techniques de diététique'),
(7, '180.AO', 'Techniques de soins infirmiers'),
(8, '180.BO', 'Techniques de soins infirmiers destiné aux infirmières auxiliaires'),
(9, '388.AO', 'Techniques de travail social'),
(10, '322.AI', 'Techniques d\'éducation à l\'enfance'),
(11, '310.AO', 'Techniques policières'),
(12, '241.AO', 'Techniques de génie mécanique'),
(13, '221.AO', 'Technologie de l\'architecture'),
(14, '221.CO', 'Technologie de la mécanique du bâtiment (Génie du bâtiment)'),
(15, '241.DO', 'Technologie de la mécanique industrielle (maintenance)'),
(16, '221.BO', 'Technologie du génie civil'),
(17, '243.DO', 'Technologie du génie électrique - Automatisation et contrôle'),
(18, '243.GO', 'Technologie du génie électrique : Électronique programmable'),
(19, '235.BO', 'Technologie du génie industriel'),
(20, '270.AO', 'Technologie du génie métallurgique'),
(21, '410.AV', 'DEC-Bac en logistique'),
(22, '410.DU', 'DEC-Bac en marketing'),
(23, '410.BU', 'DEC-Bac en sciences comptables'),
(24, '410.DO', 'Gestion de commerces'),
(25, '410.AI', 'Gestion des opérations et de la chaine logistique'),
(26, '410.BO', 'Techniques de comptabilité et de gestion'),
(27, '510.AO', 'Arts visuels'),
(28, '500.AK', 'Arts, lettres et communication - Théâtre et créations médias'),
(29, '501.AO', 'Musique'),
(30, '500.AI', 'Arts, lettres et communication - Langues'),
(31, '500.AH', 'Arts, lettres et communication - Littérature, arts et cinéma'),
(32, '700.BO', 'Histoire et civilisation'),
(33, '200.BI', 'Sciences de la nature'),
(34, '300.MO', 'Sciences humaines'),
(35, '200.CI', 'Sciences informatiques et mathématiques'),
(36, '700.AO', 'Sciences, lettres et arts'),
(37, '300.MI', 'Sciences humaines avec préalables en mathématiques');

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
(44, 1, 50),
(45, 2, 50),
(46, 3, 50),
(47, 2, 50),
(48, 1, 50),
(49, 2, 50),
(50, 3, 50),
(51, 2, 54),
(52, 2, 54),
(53, 3, 54),
(54, 3, 54),
(55, 1, 54),
(56, 1, 54),
(57, 2, 57),
(58, 3, 57),
(59, 3, 57),
(60, 3, 57),
(61, 2, 57),
(62, 3, 57),
(63, 1, 57),
(64, 1, 57),
(65, 2, 57),
(66, 2, 57),
(67, 1, 58),
(68, 1, 58),
(69, 2, 58),
(70, 2, 58),
(71, 3, 58),
(72, 3, 58),
(73, 2, 54),
(74, 2, 54);

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
(50, 'Danse', '2023-10-20', '17:50 ', 'SA2090', 'fds', 'das', 2),
(54, 'fds', '2023-10-13', '13:45', 'fsd', 'fds', 'fsd', 2),
(55, 'fsd', '2023-10-06', '13:40', 'fsd', 'fsd', 'fsd', 2),
(56, 'wwwww', '2023-10-14', '18:00', 'wwwww', 'w', 'w', 2),
(57, 'soiree integration de la technique informatique', '2023-10-13', '12:00', 'trois-riviere', 'age', 'blah blah', 6),
(58, 'test', '2023-10-07', '20:30 ', 'fdsf', 'fds', 'fds', 2);

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
(36, 50, 2),
(41, 54, 1),
(42, 54, 2),
(43, 55, 1),
(44, 56, 2),
(45, 57, 2),
(46, 58, 33),
(47, 58, 4),
(48, 58, 12);

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
(57, 1, 50),
(58, 2, 50),
(59, 3, 50),
(60, 2, 50),
(61, 2, 50),
(62, 2, 50),
(63, 2, 50),
(64, 2, 50),
(65, 2, 50),
(66, 2, 50),
(67, 3, 50),
(68, 1, 50),
(69, 3, 50),
(70, 1, 50),
(71, 2, 50),
(72, 2, 50),
(73, 2, 50),
(74, 2, 50),
(75, 2, 50),
(76, 1, 50),
(77, 1, 50),
(78, 2, 50),
(79, 2, 50),
(80, 2, 50),
(81, 2, 50),
(82, 1, 50),
(83, 1, 50),
(84, 1, 50),
(85, 1, 50),
(86, 2, 50),
(87, 2, 50),
(88, 3, 50),
(89, 3, 50),
(90, 1, 50),
(91, 1, 50),
(92, 2, 50),
(93, 2, 50),
(108, 1, 54),
(109, 1, 54),
(110, 2, 54),
(111, 2, 54),
(112, 3, 54),
(113, 3, 54),
(114, 1, 55),
(115, 1, 55),
(116, 2, 55),
(117, 2, 55),
(118, 3, 55),
(119, 3, 55),
(132, 2, 55),
(133, 2, 55),
(134, 3, 55),
(135, 3, 55),
(136, 1, 55),
(137, 1, 55),
(138, 1, 55),
(139, 1, 55),
(140, 1, 55),
(141, 1, 55),
(142, 1, 55),
(143, 3, 55),
(144, 1, 55),
(145, 1, 55),
(146, 1, 50),
(147, 1, 50),
(148, 3, 50),
(149, 1, 58),
(150, 1, 58),
(151, 2, 58),
(152, 2, 58),
(153, 3, 58),
(154, 3, 58),
(155, 3, 57),
(156, 2, 57),
(157, 1, 57),
(158, 3, 57),
(159, 2, 57),
(160, 1, 57);

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
(2, 'https://pnganime.com/web/images/l/luffy-gear-5-colored.png', 'LUFFY', 'fds', 'fds', 'fsd@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 123466),
(6, 'https://pnganime.com/web/images/l/luffy-gear-5-colored.png', 'aaaaaaaaaaaaaa', 'fds', 'fds', 'fsd@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 123466),
(8, 'https://png.pngtree.com/png-clipart/20220113/ourmid/pngtree-luffy-big-head-image-element-png-image_4168875.png', ' Manefa', 'Yousouf', 'Coordonateur', 'manefae8@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 123456);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `employeesatisfaction`
--
ALTER TABLE `employeesatisfaction`
  MODIFY `idEm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `idEv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT pour la table `liason`
--
ALTER TABLE `liason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `studentsatisfaction`
--
ALTER TABLE `studentsatisfaction`
  MODIFY `idEt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  ADD CONSTRAINT `fk_event_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE;

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
