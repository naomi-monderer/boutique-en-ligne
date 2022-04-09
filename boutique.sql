-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 mars 2022 à 10:00
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

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

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`id`, `nom`, `prenom`) VALUES
(1, 'NOM', 'PRENOM');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`) VALUES
(1, 'Roman'),
(2, 'Manga');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `id_status` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `id_produits` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_produits` (`id_produits`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_article` (`id_produit`),
  KEY `id_client` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detailcommande`
--

DROP TABLE IF EXISTS `detailcommande`;
CREATE TABLE IF NOT EXISTS `detailcommande` (
  `id_produit` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  KEY `id_commande` (`id_commande`),
  KEY `detail_ibfk_1` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produit` (`id_produit`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `mise_en_avant` tinyint(1) NOT NULL,
  `promotion` decimal(10,0) DEFAULT NULL,
  `editeur` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_souscategorie` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_auteur` (`id_auteur`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_souscategorie` (`id_souscategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `titre`, `description`, `stock`, `prix`, `mise_en_avant`, `promotion`, `editeur`, `id_categorie`, `id_souscategorie`, `id_auteur`, `image`) VALUES
(2, 'TEST', 'TEST', 84, '12', 1, NULL, 'TEST', 1, 1, 1, 'asterix.jpg'),
(3, 'Aterix 2', 'une description de la bd', 12, '12', 1, NULL, 'Editeur', 1, 1, 1, 'asterix.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `souscategories`
--

DROP TABLE IF EXISTS `souscategories`;
CREATE TABLE IF NOT EXISTS `souscategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_souscategorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `souscategories`
--

INSERT INTO `souscategories` (`id`, `nom_souscategorie`) VALUES
(1, 'Aventure');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

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
(20, 'rayhan', 'rayhan', 'rayhan@gmail.com', '$2y$10$unNTTNPemdeERoyGmsLFL.y.tSZHgiuxYt/W3FotOlVj5b0gZJbZu', 'rayhan', 3),
(21, 'lacroix', 'jerome', 'jerome@io', '$2y$10$6YO835FyB4it6mjmmAy.D.ZRppWxcd1y7iTlcvF3vxYYQpV.ttMKK', 'test', 2);

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
