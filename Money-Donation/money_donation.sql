-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 26 mai 2024 à 00:49
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `money_donation`
--

-- --------------------------------------------------------

--
-- Structure de la table `donation`
--

CREATE TABLE `donation` (
  `id_donation` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_projects` int(11) NOT NULL,
  `donation_type` enum('penctuel Donnation','Mensuel Donnation') NOT NULL,
  `amount` int(255) NOT NULL,
  `card_type` enum('Dahabiya Card','Societe Generale Card','Cpa Card','BNA Card') NOT NULL,
  `card_number` varchar(100) NOT NULL,
  `expiration_date` varchar(100) NOT NULL,
  `ccv` varchar(100) NOT NULL,
  `date_donation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `donation`
--

INSERT INTO `donation` (`id_donation`, `id_user`, `id_projects`, `donation_type`, `amount`, `card_type`, `card_number`, `expiration_date`, `ccv`, `date_donation`) VALUES
(52, 15, 30, 'penctuel Donnation', 6000, 'Dahabiya Card', '369258147258', '02/26', '365', '2024-05-23 20:28:14'),
(53, 16, 28, 'penctuel Donnation', 80000, 'BNA Card', '147258369369', '01/27', '236', '2024-05-23 20:30:57'),
(54, 15, 28, 'Mensuel Donnation', 7000, 'Societe Generale Card', '123456789258', '04/25', '325', '2024-05-23 20:31:35'),
(55, 16, 30, 'penctuel Donnation', 5000, 'Cpa Card', '369258147456', '04/26', '147', '2024-05-23 20:32:06');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id_projects` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `project_photo` varchar(255) NOT NULL,
  `Objectif` int(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id_projects`, `id_user`, `project_name`, `Description`, `project_photo`, `Objectif`, `date`) VALUES
(28, 7, 'Yassir', 'dddddddd', '664b8b96817963.01127807_pppp.jpg', 200000000, '2024-05-20 19:42:46'),
(30, 14, 'Ali Express', 'hello!', '664f897d62c617.20619164_664a4342e88450.46281005_donate.png', 2000000, '2024-05-23 20:22:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('donnator','beneficiary','admin') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `email`, `phone`, `password`, `role`, `date`) VALUES
(7, 'Marwani', 'aymen', 'aymen@gmail.com', '0696566905', '111111111', 'beneficiary', '2024-05-18 21:45:35'),
(14, 'Chergui', 'Tahar', 'tahar@gmail.com', '0789532145', '111111111', 'beneficiary', '2024-05-23 20:22:19'),
(15, 'Ferfache', 'jalal', 'jalal@gmail.com', '0147258369', '000000000', 'donnator', '2024-05-23 20:26:23'),
(16, 'Arafa', 'amine', 'amine@gmail.com', '0123654789', '000000000', 'donnator', '2024-05-23 20:29:54'),
(17, 'admin', 'admin', 'admin@gmail.com', '0693695412', 'admin', 'admin', '2024-05-23 20:35:51');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id_donation`),
  ADD KEY `fk_user_donation` (`id_user`),
  ADD KEY `fk_projects_donation` (`id_projects`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id_projects`),
  ADD KEY `fk_users_projects` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `donation`
--
ALTER TABLE `donation`
  MODIFY `id_donation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id_projects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `fk_projects_donation` FOREIGN KEY (`id_projects`) REFERENCES `projects` (`id_projects`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_donation` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_users_projects` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
