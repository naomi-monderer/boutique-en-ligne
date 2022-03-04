-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 04 mars 2022 à 13:33
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_status` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailcommande`
--

CREATE TABLE `detailcommande` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `role`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `mise_en_avant` tinyint(1) NOT NULL,
  `promotion` decimal(10,0) DEFAULT NULL,
  `editeur` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_souscategorie` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `souscategories`
--

CREATE TABLE `souscategories` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `password`, `login`, `id_droits`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin1234', 'admin', 1),
(2, 'moderateur', 'moderateur', 'moderateur@moderateur.com', 'moderateur', 'moderateur', 2),
(6, 'nao', 'nao', 'naomi.monderer@gmail.com', '$2y$10$YUUUPZ5UhoLt9qvkXps7FeCjMeIsrCMur5gA5t7soA6UGcjwvUXke', 'maelys', 3),
(13, 'leo', 'leo', 'leo@gmail.com', '$2y$10$ewl87Vq/xXyjuM2pwdNMuOVetvgFViWUft2uS3xPRRUVbN69OsEly', 'leo', 3),
(14, 'leo', 'leo', 'leo@leo.com', '$2y$10$fbXgexTHx.jVumU7c/ESyu6lE2c/fZcj22cr38W5w23.Gmerc75TC', 'lea', 3),
(15, 'rose', 'rose', 'mcgowan@gmail.com', '$2y$10$e8NOlQ/vDrWrNrSgH5uA6OcSwxCh/sZ7WkrJLtfKOOf32kr6lsrKK', 'rosy', 3),
(17, 'labase', 'labase', 'labase@gmail.com', '$2y$10$yih1KgA1k0R6asxVVCgwm.Rqrvmzd.yUQtPcb8w.ys6jY6AQJekd6', 'labase', 3),
(18, 'tagrandmere', 'tagrandmere', 'tagrandmere@tagrandmere.com', '$2y$10$WgD1sV0j8WLsohoiSYIhtumYhJmSke9PKg5mbOcxj1wo9kXbAfp3W', 'tagrandmere', 3),
(19, 'emilia', 'emilia', 'emilia@emilia.com', '$2y$10$0gfIrHSVK0n2trjN2D85gOKoj/2i6k1GNEwtwuhu6oVOdHw55LuFa', 'emilia', 3),
(20, 'rayhan', 'rayhan', 'rayhan@gmail.com', '$2y$10$unNTTNPemdeERoyGmsLFL.y.tSZHgiuxYt/W3FotOlVj5b0gZJbZu', 'rayhan', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_produits` (`id_produits`),
  ADD KEY `id_status` (`id_status`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_produit`),
  ADD KEY `id_client` (`id_utilisateur`);

--
-- Index pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `detail_ibfk_1` (`id_produit`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_auteur` (`id_auteur`),
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `id_souscategorie` (`id_souscategorie`);

--
-- Index pour la table `souscategories`
--
ALTER TABLE `souscategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `souscategories`
--
ALTER TABLE `souscategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`id_produits`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commandes_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD CONSTRAINT `detailcommande_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `auteurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produits_ibfk_3` FOREIGN KEY (`id_souscategorie`) REFERENCES `souscategories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
