-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 07 Février 2017 à 14:14
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_camagru`
--

CREATE TABLE `tbl_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_camagru`
--

INSERT INTO `tbl_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Info`) VALUES
(1, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'test', 1, '5899cbccc2a0f', 5, 'sans'),
(2, 'PASQUALINI', 'thierry', 'te42pe@gmail.com', 'test', 0, '589887291bb9d', 5, 'info'),
(3, 'dupond', 'louis', 'dupond@lievre.net', 'test', 0, '', 5, 'free'),
(4, 'DURAND', 'robert', 'durand@lievre.net', 'test', 0, '', 5, 'free'),
(5, 'PINGUET', 'Dominique', 'dominique@photeam.com', 'test', 0, '5898ab5e6c3d1', 5, 'info'),
(6, 'PASQUALI', 'thierry', 'tpasqual@student.42.fr', 'test', 1, 'sdfgsdhf', 5, 'info'),
(7, 'lievre', 'Dominique', 'portable@photeam.com', 'test', 0, 'sdfgsdhf', 5, 'info'),
(8, 'lievre', '', 'test', 'ssa', 0, 'sdfgsdhf', 5, 'info'),
(9, '', '', '', '', 0, '5899a0a61fcb4', 5, 'info'),
(10, '', '', 'test@lievre.net', '', 0, 'sdfgsdhf', 5, 'info');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_camagru`
--
ALTER TABLE `tbl_camagru`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbl_camagru`
--
ALTER TABLE `tbl_camagru`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
