-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 10 juin 2024 à 19:16
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `DRIP1`
--

-- --------------------------------------------------------

--
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `ID_article` int(11) NOT NULL,
  `Nom_article` varchar(255) DEFAULT NULL,
  `Description` text,
  `Catégorie` varchar(50) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Tailles_disponibles` varchar(255) DEFAULT NULL,
  `Couleurs_disponibles` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Stock` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Articles`
--

INSERT INTO `Articles` (`ID_article`, `Nom_article`, `Description`, `Catégorie`, `Prix`, `Tailles_disponibles`, `Couleurs_disponibles`, `Image`, `Stock`) VALUES
(1, 'Brakata', 'adbzb ', 'Chaussure', '22.00', 'M,L', 'BLEU', 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSoWQxwYG2aKlimwa0akHKpn1aZ_O1myS7oXd6xTS9KIFJjpOSdBhzlwORD93VB9E3dtQuQZSQZ3cZVPWmwx6y4qxrcZNNe1JbdYcrCLdg&usqp=CAc', 16),
(2, 'cjcdkdj ', 'zgfhvj n c', 'hommes', '22.00', 'M,L', 'rouge', 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcR-f7_y_7jyD9L5gN_BPQezPqpJeH36pzjwzPsYNqFdxST8jaPfi6FeoV9O8I06MwdITgu03XL6&usqp=CAc', 23),
(6, 'Robe de soirée', 'Robe longue pour des occasions spéciales', 'Femmes', '59.99', 'S, M, L', 'Noir, Rouge, Bleu marine', 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQinLtd3W8CNCzwG3qb32mMrjeChQPv0bzu4Cn0TwyZlbsZCT53omxgoh3Y6zfnAM-JpCc0484CwQ&usqp=CAc', 25),
(7, 'Pantalon chino', 'Pantalon en coton confortable et élégant', 'Hommes', '39.99', '30, 32, 34, 36', 'Beige, Kaki, Bleu', 'pantalon_chino.jpg', 20),
(9, 'Pull en laine', 'Pull chaud pour l\'hiver', 'Hommes', '49.99', 'S, M, L, XL', 'Gris, Bleu, Noir', 'pull_laine.jpg', 20),
(10, 'Blouse à pois', 'Blouse légère avec des pois', 'Femmes', '24.99', 'S, M, L', 'Blanc, Noir, Rouge', 'blouse_pois.jpg', 20),
(11, 'Veste en cuir', 'Veste classique en cuir véritable', 'Hommes', '99.99', 'M, L, XL', 'Noir, Marron', 'veste_cuir.jpg', 20),
(12, 'T-shirt imprimé', 'T-shirt avec un motif imprimé original', 'Femmes', '19.99', 'S, M, L', 'Blanc, Gris, Rose', 'tshirt_imprime.jpg', 20),
(13, 'Short cargo', 'Short pratique avec plusieurs poches', 'Hommes', '29.99', 'S, M, L, XL', 'Kaki, Noir, Vert', 'short_cargo.jpg', 20),
(16, 'Top à col roulé', 'Top confortable avec un col roulé', 'Femmes', '14.99', 'S, M, L', 'Noir, Blanc, Gris', 'top_col_roule.jpg', 20),
(17, 'Polo classique', 'Polo intemporel pour un style élégant', 'Hommes', '29.99', 'S, M, L, XL', 'Blanc, Noir, Bleu', 'polo_classique.jpg', 20),
(18, 'Combinaison', 'Combinaison élégante pour diverses occasions', 'Femmes', '49.99', 'XS, S, M, L', 'Noir, Bleu marine, Vert', 'combinaison.jpg', 20),
(20, 'Blazer rayé', 'Blazer élégant avec des rayures fines', 'Femmes', '64.99', 'S, M, L', 'Bleu marine, Blanc, Rouge', 'blazer_raye.jpg', 20),
(21, 'Pull à capuche', 'Pull chaud avec une capuche ajustable', 'Hommes', '39.99', 'S, M, L, XL', 'Gris, Noir, Bleu', 'pull_capuche.jpg', 20),
(22, 'Robe à volants', 'Robe légère avec des volants romantiques', 'Femmes', '44.99', 'XS, S, M', 'Rose, Blanc, Bleu', 'robe_volants.jpg', 20),
(23, 'Chaussures en cuir', 'Chaussures habillées en cuir véritable', 'Hommes', '79.99', '39, 40, 41, 42', 'Noir, Marron', 'chaussures_cuir.jpg', 20),
(24, 'Sandales à talons', 'Sandales élégantes avec des talons hauts', 'Femmes', '54.99', '35, 36, 37, 38', 'Noir, Beige, Rouge', 'sandales_talons.jpg', 20),
(26, 'Jupe crayon', 'Jupe ajustée et élégante', 'Femmes', '34.99', 'XS, S, M, L', 'Noir, Gris, Marron', 'jupe_crayon.jpg', 20),
(27, 'Pantalon cargo', 'Pantalon polyvalent avec des poches fonctionnelles', 'Hommes', '49.99', '30, 32, 34, 36', 'Vert, Gris, Noir', 'pantalon_cargo.jpg', 20),
(28, 'Blouse en soie', 'Blouse légère et luxueuse en soie', 'Femmes', '59.99', 'S, M, L', 'Blanc, Rose, Bleu marine', 'blouse_soie.jpg', 20),
(29, 'Veste matelassée', 'Veste chaude et matelassée pour lhiver', 'Hommes', '79.99', 'M, L, XL', 'Noir, Bleu marine, Vert', 'veste_matelassee.jpg', 20),
(30, 'Robe patineuse', 'Robe féminine avec une jupe évasée', 'Femmes', '49.99', 'XS, S, M, L', 'Rouge, Noir, Blanc', 'robe_patineuse.jpg', 20),
(31, 'Pull à col V', 'Pull classique avec un décolleté en V', 'Hommes', '29.99', 'S, M, L, XL', 'Gris, Bleu, Bordeaux', 'pull_col_v.jpg', 20),
(32, 'Chemisier en dentelle', 'Chemisier élégant avec des détails en dentelle', 'Femmes', '39.99', 'S, M, L', 'Blanc, Noir, Rose', 'chemisier_dentelle.jpg', 20),
(33, 'Short en jean', 'Short décontracté et confortable', 'Hommes', '24.99', 'S, M, L, XL', 'Bleu clair, Bleu foncé', 'short_jean.jpg', 20),
(34, 'Robe longue', 'Robe longue et fluide pour un look bohème', 'Femmes', '69.99', 'S, M, L', 'Bleu, Vert, Jaune', 'robe_longue.jpg', 20),
(35, 'Costume slim fit', 'Costume cintré pour une silhouette élégante', 'Hommes', '129.99', '48, 50, 52, 54', 'Noir, Bleu marine, Gris', 'costume_slim_fit.jpg', 20),
(36, 'Chemisier à volants', 'Chemisier féminin avec des volants délicats', 'Femmes', '34.99', 'XS, S, M, L', 'Blanc, Rose, Vert', 'chemisier_volants.jpg', 20),
(37, 'Polo rayé', 'Polo sportif avec des rayures contrastées', 'Hommes', '34.99', 'S, M, L, XL', 'Bleu, Rouge, Blanc', 'polo_raye.jpg', 20),
(38, 'Robe de cocktail', 'Robe élégante pour des occasions spéciales', 'Femmes', '79.99', 'XS, S, M, L', 'Noir, Rouge, Bleu marine', 'robe_cocktail.jpg', 20),
(39, 'Blazer en tweed', 'Blazer classique en tweed pour un look sophistiqué', 'Hommes', '89.99', 'M, L, XL', 'Gris, Marron, Bleu', 'blazer_tweed.jpg', 20),
(40, 'Jupe en cuir', 'Jupe en cuir véritable pour une touche de style', 'Femmes', '59.99', 'XS, S, M', 'Noir, Marron, Bordeaux', 'jupe_cuir.jpg', 20),
(87, 'brakata', 'zouka', 'CHAUSSUU', '21.00', 'M', 'Rouge', 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSoWQxwYG2aKlimwa0akHKpn1aZ_O1myS7oXd6xTS9KIFJjpOSdBhzlwORD93VB9E3dtQuQZSQZ3cZVPWmwx6y4qxrcZNNe1JbdYcrCLdg&usqp=CAc', 20),
(99, 'Brakata', 'adbzb ', 'Chaussure', '22.00', 'M,L', 'BLEU', 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcSoWQxwYG2aKlimwa0akHKpn1aZ_O1myS7oXd6xTS9KIFJjpOSdBhzlwORD93VB9E3dtQuQZSQZ3cZVPWmwx6y4qxrcZNNe1JbdYcrCLdg&usqp=CAc', 20);

-- --------------------------------------------------------

--
-- Structure de la table `Commandes`
--

CREATE TABLE `Commandes` (
  `ID_commande` int(11) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `Date_commande` date DEFAULT NULL,
  `Adresse_livraison` varchar(255) DEFAULT NULL,
  `Statut_commande` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `détails_commande`
--

CREATE TABLE `détails_commande` (
  `ID_commande` int(11) NOT NULL,
  `ID_article` int(11) NOT NULL,
  `Quantité` int(11) DEFAULT NULL,
  `Prix_unitaire` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `ID_panier` int(11) NOT NULL,
  `ID_utilisateur` int(11) DEFAULT NULL,
  `ID_article` int(11) DEFAULT NULL,
  `Quantité` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `ID_utilisateur` int(11) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prénom` varchar(255) DEFAULT NULL,
  `Adresse_email` varchar(255) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `Adresse_livraison` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`ID_utilisateur`, `Nom`, `Prénom`, `Adresse_email`, `Mot_de_passe`, `Adresse_livraison`, `type`) VALUES
(1, 'Kouider', 'Acheraf', 'acheraf@gmail.com', 'achk', '44 avenue du templier', 'gerant'),
(2, 'Housmane', 'Dembele', 'Hous@gmail.com', 'hous', '44 avenue du templier', 'client');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`ID_article`);

--
-- Index pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD PRIMARY KEY (`ID_commande`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `détails_commande`
--
ALTER TABLE `détails_commande`
  ADD PRIMARY KEY (`ID_commande`,`ID_article`),
  ADD KEY `ID_article` (`ID_article`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`ID_panier`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`),
  ADD KEY `ID_article` (`ID_article`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`ID_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Commandes`
--
ALTER TABLE `Commandes`
  MODIFY `ID_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `ID_panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commandes`
--
ALTER TABLE `Commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `Utilisateurs` (`ID_utilisateur`);

--
-- Contraintes pour la table `détails_commande`
--
ALTER TABLE `détails_commande`
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`ID_article`) REFERENCES `Articles` (`ID_article`) ON DELETE CASCADE,
  ADD CONSTRAINT `détails_commande_ibfk_1` FOREIGN KEY (`ID_commande`) REFERENCES `Commandes` (`ID_commande`),
  ADD CONSTRAINT `détails_commande_ibfk_2` FOREIGN KEY (`ID_article`) REFERENCES `Articles` (`ID_article`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `Utilisateurs` (`ID_utilisateur`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`ID_article`) REFERENCES `Articles` (`ID_article`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
