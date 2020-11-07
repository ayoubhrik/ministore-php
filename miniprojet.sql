-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 07 nov. 2020 à 18:29
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `miniprojet`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_user` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_user`, `admin_password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `tracking_number` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`order_id`, `tracking_number`, `user_id`, `product_id`, `qty`, `order_status`) VALUES
(1, 'TR01DD377C896086B', 1, 1, 3, 'completed'),
(2, 'TR103E691760FD95A', 1, 1, 1, 'completed'),
(3, 'TRADA7E39B66685C2', 1, 1, 1, 'completed'),
(4, 'TRF67EAEE6B261DD9', 1, 1, 1, 'completed'),
(5, 'TREBAD7AB9444729B', 1, 1, 1, 'completed'),
(6, 'TR57851168447F81A', 1, 1, 5, 'completed'),
(7, 'TR0C2E152DE1358AA', 1, 5, 1, 'completed'),
(8, 'TR0C2E152DE1358AA', 1, 3, 1, 'completed'),
(9, 'TRA63D51DDFF117A9', 1, 13, 2, 'completed'),
(10, 'TRA63D51DDFF117A9', 1, 10, 1, 'completed');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `title` text NOT NULL,
  `imageurl` text NOT NULL,
  `cat` text NOT NULL,
  `marque` text NOT NULL,
  `taille` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `price`, `title`, `imageurl`, `cat`, `marque`, `taille`) VALUES
(1, 50, 'Veste', 'https://cdn.laredoute.com/products/302by302/0/4/c/04c97663a2878222ea91daf9b709bdfd.jpg', 'femme', 'MOSSI', 'L'),
(2, 30, 'Ts Nike Nsw Tee Brand Noir', 'https://contents.mediadecathlon.com/p1925877/k$fc36caabcd27189b56d8f2ec9df5a45d/ts-nike-nsw-tee-brand-noir.jpg?&f=250x250', 'homme', 'nike', 'L'),
(3, 70, 'Maillot Manches Longues ', 'https://contents.mediadecathlon.com/p1906226/k$81637449c7ebc732b7558154718144cf/maillot-manches-longues-enfant-d-athletisme-par-temps-froid-at-500-degrade-bleu.jpg?&f=250x250', 'homme', 'kal', 'L'),
(4, 80, 'Maillot Manches Longues Chaud', 'https://contents.mediadecathlon.com/p1875108/k$aa60be719fdcd8dab6143fede480159a/maillot-manches-longues-chaud-1-2-zip-enfant-d-athletisme-at-100-bleu-marine.jpg?&f=250x250', 'homme', 'kal', 'S'),
(5, 63, 'MOUFLES - SH100 POLAIRE - ENFANT', 'https://contents.mediadecathlon.com/p1869563/k$eee0712bd202236b955942c67dece32d/moufles-sh100-polaire-enfant.jpg?&f=250x250', 'bebe', 'QUECHUA', 'S'),
(6, 40, 'Justaucorps Danse Classique Blanc Bi-Matière Fille', 'https://contents.mediadecathlon.com/p1701061/k$cf635bc8eb7b5699f708f99d12b4186f/justaucorps-danse-classique-blanc-bi-matiere-fille.jpg?&f=250x250', 'bebe', 'DOMYOS', 'M'),
(9, 80, 'Kim Short Sleeve Cropped Onesie', 'https://cdn.shopify.com/s/files/1/0153/0845/products/11-04_Womens_Dana_missing_FINAL-103_360x.jpg?v=1510852485', 'femme', 'Kaarem', 'S'),
(10, 120, 'Zarba Jumpsuit in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/09-29_Womens_Baserange_FINAL-1_1_360x.jpg?v=1510853323', 'femme', 'Baserange', 'M'),
(11, 80, 'Kim Short Sleeve Cropped Onesie', 'https://cdn.shopify.com/s/files/1/0153/0845/products/11-04_Womens_Dana_missing_FINAL-103_360x.jpg?v=1510852485', 'femme', 'Kaarem', 'S'),
(12, 120, 'Zarba Jumpsuit in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/09-29_Womens_Baserange_FINAL-1_1_360x.jpg?v=1510853323', 'femme', 'Baserange', 'M'),
(13, 96, 'Ludlow Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/10-14_Womens_Alix_FINAL-372_360x.jpg?v=1510852780', 'femme', 'Alix', 'M'),
(14, 155, 'Horatio Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/10-14_Womens_Alix_FINAL-502_360x.jpg?v=1510852771', 'femme', 'Alix', 'S'),
(15, 96, 'Ludlow Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/10-14_Womens_Alix_FINAL-372_360x.jpg?v=1510852780', 'femme', 'Alix', 'M'),
(16, 155, 'Horatio Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/10-14_Womens_Alix_FINAL-502_360x.jpg?v=1510852771', 'femme', 'Alix', 'S'),
(17, 230, 'Buxton Jumpsuit in Multi', 'https://cdn.shopify.com/s/files/1/0153/0845/products/04-07_Womens_Jumpsuits-019_360x.jpg?v=1510848483', 'femme', 'Rachel Comey', 'L'),
(18, 120, 'Louise Leotard in Electric Iris', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170815_Womens_634_360x.jpg?v=1510846937', 'femme', 'Rodebjer', 'M'),
(19, 230, 'Buxton Jumpsuit in Multi', 'https://cdn.shopify.com/s/files/1/0153/0845/products/04-07_Womens_Jumpsuits-019_360x.jpg?v=1510848483', 'femme', 'Rachel Comey', 'L'),
(20, 120, 'Louise Leotard in Electric Iris', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170815_Womens_634_360x.jpg?v=1510846937', 'femme', 'Rodebjer', 'M'),
(21, 120, 'Louise Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170815_Womens_613_ba6bea35-b482-4766-97d6-b3b2e24657fa_360x.jpg?v=1510846935', 'femme', 'Rodebjer', 'M'),
(22, 0, 'Fit Flare Jumpsuit in Pale Quartz', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170919_Womens_FINAL0467_360x.jpg?v=1510846444', 'femme', 'Apiece Apart', 'L'),
(23, 120, 'Louise Leotard in Black', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170815_Womens_613_ba6bea35-b482-4766-97d6-b3b2e24657fa_360x.jpg?v=1510846935', 'femme', 'Rodebjer', 'M'),
(24, 160, 'Fit Flare Jumpsuit in Pale Quartz', 'https://cdn.shopify.com/s/files/1/0153/0845/products/20170919_Womens_FINAL0467_360x.jpg?v=1510846444', 'femme', 'Apiece Apart', 'L'),
(25, 175, 'Camp Shirt in Pink Linen Floral', 'https://cdn.shopify.com/s/files/1/0153/0845/products/02-15_Mens_WIP_243_360x.jpg?v=1510856009', 'homme', 'SMOCK Man', 'L'),
(26, 270, 'Onsen Cardigan in Indigo-Dyed Panama Cloth', 'https://cdn.shopify.com/s/files/1/0153/0845/products/02-15_Mens_WIP_368_360x.jpg?v=1510855988', 'homme', 'SMOCK Man', 'L'),
(27, 175, 'Camp Shirt in Pink Linen Floral', 'https://cdn.shopify.com/s/files/1/0153/0845/products/02-15_Mens_WIP_243_360x.jpg?v=1510856009', 'homme', 'SMOCK Man', 'L'),
(28, 270, 'Onsen Cardigan in Indigo-Dyed Panama Cloth', 'https://cdn.shopify.com/s/files/1/0153/0845/products/02-15_Mens_WIP_368_360x.jpg?v=1510855988', 'homme', 'SMOCK Man', 'L');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`) VALUES
(1, 'wafi', 'wafi', 'wafi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
