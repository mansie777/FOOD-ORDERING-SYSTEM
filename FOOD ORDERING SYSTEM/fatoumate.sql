-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 09 jan. 2023 à 21:07
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fatoumate`
--

-- --------------------------------------------------------

--
-- Structure de la table `table_admin`
--

CREATE TABLE `table_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `table_admin`
--

INSERT INTO `table_admin` (`id`, `full_name`, `username`, `password`) VALUES
(8, 'DIALLO', 'Admin', '5ed56226946ae7e88f01798e6c3503d4');

-- --------------------------------------------------------

--
-- Structure de la table `table_category`
--

CREATE TABLE `table_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `table_category`
--

INSERT INTO `table_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(24, 'Attieke', 'Food_category782.jpg', 'No', 'No'),
(25, 'Pizza', 'Food_category440.jpg', 'Yes', 'Yes'),
(26, 'chapatie', 'Food_category911.jpg', 'Yes', 'Yes'),
(27, 'mohamed', 'Food_category331.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Structure de la table `table_food`
--

CREATE TABLE `table_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `table_food`
--

INSERT INTO `table_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(21, 'attieke', 'edsrhhjkjkkl', '3', 'Food-Name-8991.jpg', 24, 'Yes', 'Yes'),
(22, 'attieke', 'yop', '2', 'Food-Name-6239.jpg', 24, 'Yes', 'Yes'),
(23, 'lgftghiokl', 'ijhyftfg', '2', 'Food-Name-7964.jpg', 24, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Structure de la table `table_order`
--

CREATE TABLE `table_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `table_order`
--

INSERT INTO `table_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Attieke', '150', 2, '300', '2022-07-15 03:05:35', 'Delivered', 'Diallo ousmane', '7404325571', 'dialloousmane0682@gmail.com', 'Ambala mmu'),
(2, 'n bhjb', '150', 3, '450', '2022-07-15 03:08:35', 'On Delivery', 'Abdul', '7404325571', 'dialloousmane0682@gmail.com', 'mullana mmu'),
(3, 'n bhjb', '150', 4, '600', '2022-07-15 03:39:32', 'Ordered', 'Diallo ousmane', '7404325571', 'ousmane.diallo@uvci.edu.ci', 'mullana mmdu hostel 14'),
(4, 'Yopougon garba drome', '300', 1, '300', '2022-07-15 08:42:09', 'Cancalled', 'Adam', '7404325571', 'kverma734@gmail.com', 'New Delhi'),
(5, 'Attieke', '150', 1, '150', '2022-07-17 05:20:20', 'Ordered', 'ousmane', '7404325571', 'dialloousmane0682@gmail.com', 'cocody saint jean'),
(6, 'The best Garba of yopougon ', '150', 1, '150', '2022-07-18 12:58:13', 'Delivered', 'mansie', '0000000000', '123@gmail.com', '123'),
(7, 'Koumassi Garba', '150', 1, '150', '2022-07-29 12:03:08', 'Delivered', 'haithan', '7494936454', 'hatha340@gailon', 'haryana a'),
(9, 'Garba Abidjan', '150', 1, '150', '2022-08-18 06:56:26', 'Delivered', 'Fatty', '1223458568', 'fatty@gmail.com', 'hrfhfwehnfwej'),
(11, 'attieke', '2', 2, '4', '2022-08-28 12:49:30', 'Delivered', 'salum', '8813022454', 'salimelmarhouby@gmail.com', 'hostel 13'),
(12, 'attieke', '2', 2, '4', '2022-09-01 07:46:35', 'Delivered', 'kartik', '13267839', 'kartik@gmail.com', 'ghdshvefejfjf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `table_admin`
--
ALTER TABLE `table_admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `table_category`
--
ALTER TABLE `table_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `table_food`
--
ALTER TABLE `table_food`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `table_order`
--
ALTER TABLE `table_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `table_admin`
--
ALTER TABLE `table_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `table_category`
--
ALTER TABLE `table_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `table_food`
--
ALTER TABLE `table_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `table_order`
--
ALTER TABLE `table_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
