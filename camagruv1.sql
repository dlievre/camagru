-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 13 Février 2017 à 16:27
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
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_camagru`
--

CREATE TABLE `tbl_camagru` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Confirm` int(11) NOT NULL DEFAULT '0',
  `Keyuser` varchar(50) NOT NULL,
  `Cpt_reinit` int(11) NOT NULL DEFAULT '5',
  `Questionsecrete` int(11) NOT NULL,
  `Reponsesecrete` varchar(100) NOT NULL,
  `Info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_camagru`
--

INSERT INTO `tbl_camagru` (`Id`, `Nom`, `Prenom`, `email`, `Password`, `Confirm`, `Keyuser`, `Cpt_reinit`, `Questionsecrete`, `Reponsesecrete`, `Info`) VALUES
(1, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '5899cbccc2a0f', 5, 4, 'vélo', 'sans'),
(2, 'PASQUALINI', 'thierry', 'te42pe@gmail.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '58a1d8682cb12', 5, 4, 'cheval', 'info'),
(3, 'dupond', 'louis', 'dupond@lievre.net', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, '', 5, 4, 'vélo', 'free'),
(4, 'DURAND', 'robert', 'durand@lievre.net', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, '', 5, 4, '', 'free'),
(5, 'PINGUET', 'Dominique', 'dominique@photeam.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '5898ab5e6c3d1', 5, 4, 'vélo', 'info'),
(6, 'PASQUALI', 'thierry', 'tpasqual@student.42.fr', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 1, '58a1d8682cb12', 5, 4, 'cheval', 'info'),
(7, 'lievre', 'Dominique', 'portable@photeam.com', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, 'sdfgsdhf', 5, 4, '', 'info'),
(8, 'lievre', '', 'test', 'b913d5bbb8e461c2c5961cbe0edcdadfd29f068225ceb37da6defcf89849368f8c6c2eb6a4c4ac75775d032a0ecfdfe8550573062b653fe92fc7b8fb3b7be8d6', 0, 'sdfgsdhf', 5, 4, '', 'info');

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
