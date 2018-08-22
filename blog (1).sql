-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 22 août 2018 à 12:19
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `titre`, `contenu`, `date_creation`) VALUES
(1, 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41'),
(2, 'Le PHP à la conquête du monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_billet`, `auteur`, `commentaire`, `date_commentaire`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53'),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16'),
(3, 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52'),
(4, 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49'),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(250) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
(1, 3, 'fifi', 'super genial', '2018-07-11 00:20:00'),
(2, 4, 'vivi', 'genial', '2018-07-04 00:00:00'),
(3, 3, 'vivi', 'genial', '2018-07-27 00:00:00'),
(4, 4, 'sdwdwd', 'dfeffsdcscscscs', '2018-08-02 16:49:14'),
(5, 6, 'sss', 'ssssss', '2018-08-21 13:57:32'),
(6, 6, 'ee', 'eee', '2018-08-21 13:58:25'),
(7, 6, 'dsdd', 'ddssdds', '2018-08-21 14:09:07'),
(8, 5, 'qwe', 'asdsfdssdcsd', '2018-08-21 21:51:23'),
(9, 6, 'kat', 'salut', '2018-08-21 22:05:35'),
(10, 6, 'sddf', 'dsfsfdfdf', '2018-08-21 23:21:11'),
(11, 9, 'fdsffsd', 'fdgfgdfgdfgdfgdfgdfgdfgdfgdfgdfgdf', '2018-08-22 12:03:30'),
(12, 10, 'sdfsdfsdf', 'dfsdsdffd', '2018-08-22 12:25:40');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `pseudo`, `pass`, `email`, `registration_date`) VALUES
(1, 'sdsadda', '$2y$10$FMLuHMn5L8X2nJDHhI248espNUHSTIIM9j9vAc9vTcPQLQvS08pim', 'ffff@fssdf.con', '2018-08-07'),
(2, 'sdsadda', '$2y$10$Sn9Vz7UgB3OMLHQC4oJP7OaFnBo0aOGgRI4S.SKEL.0JpqjnwT.kW', 'ffff@fssdf.con', '2018-08-07'),
(3, 'wer', '$2y$10$eZy0uFa9JTZm6gS6i3/P.u1HIyV7O5YR9TRVkrrUSWeQnmcb5V7p6', 'kat@yahoo.com', '2018-08-08'),
(4, 'kat', '$2y$10$gFMreohS7qGw07C4LGLTKeah69C5jvwC0HDaQ3nDWVINsfk84dJBS', 'k123@ert.com', '2018-08-08'),
(5, 'gert', '$2y$10$W5oTgKTcMe06dBnpkf72buSHHlx4QEVyhzimOYtWIonosHzFi3w0K', 'gert@rty.com', '2018-08-08'),
(6, 'katou', '$2y$10$IlLJNqyMfzw2s1vaTS4wsO0HZfCw5v1Zhok8F4oc60jwlvsc52N4e', 'kat78@asd.com', '2018-08-08'),
(7, 'mat', '$2y$10$q1qn.rjLwApbvjslSjmQlu6U69X1f8I7FCOKr8QEgIbufTRQTYGf.', 'mat@ner.com', '2018-08-08'),
(8, 'sasa', '$2y$10$4fwaOiOElfFU7UJYt0bm4OHl.eAiQHDXerIrUqMM4h5w/EV4qohpy', 'sasa@dfgh.fr', '2018-08-08'),
(9, 'sarinette', '$2y$10$Z8HwOulc89QUHRxbMYhOSuj6ox3O/wEHldezPST4CBoXjSVPBL0DK', 'sasa@des.fr', '2018-08-08'),
(10, 'luc', '$2y$10$YfrGGdjz.eQnj93t88aQVe1i.BigImE414OVUi.Y0LFBJ/w0Z5S0G', 'luca@wewr.com', '2018-08-08'),
(11, 'tamere', '$2y$10$h4a/1BYGP0MGzNlXn4PI.uIAnL8AlT6RrvKseeN.85N3FUPXVt0Wm', 'ta@wer.fr', '2018-08-08'),
(12, 'mae', '$2y$10$q2tk76GIU14oLMJQnW8RGuHIqRPJgvsVOp4obDYiXE4AIlRppUUR6', 'mae@wer.com', '2018-08-08'),
(13, 'rer', '$2y$10$4BKoQfTNAE3rIsc0KmW0z.7iHYRN.ck.O0IrvNkUJwqXJppBpy/Tu', 'rer@ere.com', '2018-08-08'),
(14, 'katell', '$2y$10$Bqd/fi/uKEqLxGWbuLv/wuPUvHeglieWYTXBZXSwk8hKhkknz5COq', 'katell@wer.com', '2018-08-09'),
(15, 'matteo', '$2y$10$NS2gAsCIMAuQ0XvGsznmiOpqPhk56vc/ihbLhllZkBCr/hZojgzvu', 'mat@wqe.com', '2018-08-09'),
(16, '<script>alert(boum)</script>', '$2y$10$55RgPiDVe/8A67b/XUKKVuwtYlZwwynbWzw/qiMFz6LaXD2YzdEFe', 'dsdfad@sdsd.vf', '2018-08-09'),
(17, 'aurelien', '$2y$10$1phkc4ZB85cnObz3gXunY.4KSIysCXjfFOyOOgTvnzAtyvLibldcG', 'aur@123.com', '2018-08-09'),
(18, 'titi', '$2y$10$u3lxx2svAZwZpH4Dodstp.A7XHoii/Sh/01NgsKcB1byQ9Jz4gHvu', 'titi@rtyu.com', '2018-08-21'),
(19, 'tata', '$2y$10$cib0YtmdcmHxp/nmR8QATe4M.D6Bo4HTe2/7IpMxRMcRsP0Hu.U/2', 'tata@wert.com', '2018-08-21'),
(20, 'sfsdfs', '$2y$10$aw9UixyzloMyujMUQnzafuiAaTYPJu1JM3HB27J3nzuPR8EHs84QG', 'fdfdf@dfsf.com', '2018-08-22');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`) VALUES
(3, 'title 1', 'content 1', '2018-07-26 00:00:00'),
(4, 'title 2', 'content 2', '2018-07-26 00:02:00'),
(5, 'test1', 'test1', '2018-08-10 16:26:55'),
(6, 'test sans connexion', 'test ', '2018-08-10 16:34:30'),
(7, 'asdasdas', 'asdasdasdas', '2018-08-21 23:48:27'),
(8, 'asdasdasdq1123', '123123123', '2018-08-21 23:49:06'),
(9, 'tata', 'bonjour', '2018-08-22 10:04:55'),
(10, 'wert', 'dsgdgddgdg', '2018-08-22 12:14:37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
