-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 12 juin 2022 à 12:19
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e-comics`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_comics`
--

CREATE TABLE `categorie_comics` (
  `id` int(11) NOT NULL,
  `Categorie_Comics` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie_comics`
--

INSERT INTO `categorie_comics` (`id`, `Categorie_Comics`) VALUES
(1, 'Marvel'),
(2, 'Dc'),
(3, 'Image');

-- --------------------------------------------------------

--
-- Structure de la table `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `Nom_Comics` varchar(255) NOT NULL,
  `resumer` text NOT NULL,
  `id_Categorie` varchar(11) NOT NULL,
  `Url_Comics` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comics`
--

INSERT INTO `comics` (`id`, `Nom_Comics`, `resumer`, `id_Categorie`, `Url_Comics`, `id_user`) VALUES
(1, 'batman', 'ghjhikjhjikjhjk', '2', 'youtube.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `Nom_Comics` varchar(255) NOT NULL,
  `id_Categorie` int(11) NOT NULL,
  `Url_Comics` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `upload`
--

INSERT INTO `upload` (`id`, `Nom_Comics`, `id_Categorie`, `Url_Comics`, `id_user`) VALUES
(1, 'ghh', 3, 'ghjgh', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `Pseudo` varchar(255) NOT NULL,
  `Mail` text NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `points` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `Pseudo`, `Mail`, `MDP`, `admin`, `points`) VALUES
(1, 'adam', 'adamchpro545@gmail.com', 'fe0384549ac31c2b4d224930bf499556dfe7a51d', 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_comics`
--
ALTER TABLE `categorie_comics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_comics`
--
ALTER TABLE `categorie_comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
