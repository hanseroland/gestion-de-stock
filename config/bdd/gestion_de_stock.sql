-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 07 sep. 2021 à 00:41
-- Version du serveur :  8.0.26-0ubuntu0.20.04.2
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_de_stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int NOT NULL,
  `ref_article` varchar(20) NOT NULL,
  `nom_article` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `prix_d_achat` double NOT NULL,
  `prix_de_vente` double NOT NULL,
  `quantite` int NOT NULL DEFAULT '0',
  `date_ajout` varchar(11) NOT NULL,
  `jours` varchar(15) NOT NULL,
  `mois` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `ref_article`, `nom_article`, `categorie`, `prix_d_achat`, `prix_de_vente`, `quantite`, `date_ajout`, `jours`, `mois`) VALUES
(1, 'cim_25', 'ciment 25 kg', 'batiment', 3835, 4500, 55, '2021-07-24', 'samedi', 'juillet'),
(3, 'barre_fr_6', 'barre de fer 6', 'batiment', 485, 500, 50, '2021-07-29', 'jeudi', 'juillet'),
(4, 'brique_c15', 'brique de 15 creuse', 'brique', 200, 250, 40, '2021-07-29', 'jeudi', 'juillet');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom`) VALUES
(1, 'batiment'),
(2, 'brique'),
(3, 'plomberie'),
(5, 'ampoule'),
(6, 'Fer'),
(7, 'Pointes'),
(8, 'interrupteurs');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `ref_client` int NOT NULL,
  `nom_client` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`ref_client`, `nom_client`) VALUES
(1, 'cephora');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_commande` int NOT NULL,
  `ref_client` int DEFAULT NULL,
  `total_commande` double NOT NULL,
  `vendeur` varchar(20) NOT NULL,
  `date` varchar(12) NOT NULL,
  `jours` varchar(15) NOT NULL,
  `mois` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `ref_client`, `total_commande`, `vendeur`, `date`, `jours`, `mois`) VALUES
(1, 1, 4500, 'user', '2021-07-25', 'dimanche', 'juillet'),
(2, 1, 9000, 'user', '2021-07-25', 'dimanche', 'juillet'),
(3, 1, 13500, 'user', '2021-07-25', 'dimanche', 'juillet'),
(4, 1, 18000, 'user', '2021-07-25', 'dimanche', 'juillet'),
(5, 1, 22500, 'user', '2021-07-25', 'dimanche', 'juillet'),
(6, 1, 4500, 'user', '2021-07-25', 'dimanche', 'juillet');

-- --------------------------------------------------------

--
-- Structure de la table `mouvements`
--

CREATE TABLE `mouvements` (
  `id_mouvement` int NOT NULL,
  `id_article` int NOT NULL,
  `ref_article` varchar(20) NOT NULL,
  `nom_article` varchar(20) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `quantite` int NOT NULL,
  `montant` double NOT NULL,
  `type` varchar(10) NOT NULL,
  `mouvement_date` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jours` varchar(15) NOT NULL,
  `mois` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `mouvements`
--

INSERT INTO `mouvements` (`id_mouvement`, `id_article`, `ref_article`, `nom_article`, `categorie`, `quantite`, `montant`, `type`, `mouvement_date`, `jours`, `mois`) VALUES
(1, 1, 'cim_25', 'ciment 25 kg', 'batiment', 5, 19175, 'entree', '2021-07-25', 'dimanche', 'juillet'),
(2, 1, 'cim_25', 'ciment 25 kg', 'batiment', 30, 115050, 'entree', '2021-07-25', 'dimanche', 'juillet'),
(3, 1, 'cim_25', 'ciment 25 kg', 'batiment', 1, 4500, 'sortie', '2021-07-25', 'dimanche', 'juillet'),
(4, 4, 'brique_c15', 'brique de 15 creuse', 'brique', 30, 6000, 'entree', '2021-07-29', 'jeudi', 'juillet'),
(5, 3, 'barre_fr_6', 'barre de fer 6', 'batiment', 50, 24250, 'entree', '2021-07-29', 'jeudi', 'juillet'),
(6, 1, 'cim_25', 'ciment 25 kg', 'batiment', 6, 23010, 'entree', '2021-07-29', 'jeudi', 'juillet'),
(7, 1, 'cim_25', 'ciment 25 kg', 'batiment', 10, 38350, 'entree', '2021-07-29', 'jeudi', 'juillet'),
(8, 1, 'cim_25', 'ciment 25 kg', 'batiment', 5, 19175, 'entree', '2021-07-29', 'jeudi', 'juillet'),
(9, 4, 'brique_c15', 'brique de 15 creuse', 'brique', 10, 2000, 'entree', '2021-07-29', 'jeudi', 'juillet');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `roles` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `email`, `roles`, `mot_de_passe`) VALUES
(1, 'Hanse', 'admin@gmail.com', 'admin', '$2y$12$D04/il65GdDnOatOBHIbDe51d49yZriTraVk40pVGbXMgw9p5zDTm'),
(3, 'toto', 'toto@gmail.com', 'vendeur', '$2y$12$bhm7C2hH/rOxuRn1bU.zcumjCpGIrRV3qzfrxgrKAnCxvLhbHczh.');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id_vente` int NOT NULL,
  `id_commande` int NOT NULL,
  `ref_article` varchar(20) NOT NULL,
  `nom_article` varchar(20) NOT NULL,
  `quantite_vendue` int NOT NULL,
  `prix_de_vente` double NOT NULL,
  `total_vente` double NOT NULL,
  `date` varchar(11) NOT NULL,
  `jours` varchar(15) NOT NULL,
  `mois` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id_vente`, `id_commande`, `ref_article`, `nom_article`, `quantite_vendue`, `prix_de_vente`, `total_vente`, `date`, `jours`, `mois`) VALUES
(1, 1, 'cim_25', 'ciment 25 kg', 1, 4500, 4500, '2021-07-25', 'dimanche', 'juillet'),
(2, 2, 'cim_25', 'ciment 25 kg', 2, 4500, 9000, '2021-07-25', 'dimanche', 'juillet'),
(3, 3, 'cim_25', 'ciment 25 kg', 3, 4500, 13500, '2021-07-25', 'dimanche', 'juillet'),
(4, 4, 'cim_25', 'ciment 25 kg', 4, 4500, 18000, '2021-07-25', 'dimanche', 'juillet'),
(5, 5, 'cim_25', 'ciment 25 kg', 5, 4500, 22500, '2021-07-25', 'dimanche', 'juillet'),
(6, 6, 'cim_25', 'ciment 25 kg', 1, 4500, 4500, '2021-07-25', 'dimanche', 'juillet');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ref_client`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `mouvements`
--
ALTER TABLE `mouvements`
  ADD PRIMARY KEY (`id_mouvement`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id_vente`),
  ADD KEY `id_commande` (`id_commande`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `ref_client` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_commande` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `id_mouvement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id_vente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
