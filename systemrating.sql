-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 16 juil. 2025 à 15:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `systemrating`
--

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Libelee` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` double(8,2) DEFAULT NULL,
  `rang` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `Libelee`, `name`, `description`, `created_at`, `updated_at`, `logo`, `note`, `rang`) VALUES
(1, 'ENSET', 'Ecole Normale Supérieure pour l\'Enseignement Technique', 'Ecole pour vous former à devenir Enseignant et ingénieure', '2025-06-09 10:03:42', '2025-07-16 06:52:11', 'logos/3jYSZ6qdQUsdtzXBm9NXZQ9dVyEv5vM23rnvYvfJ.png', 14.38, 2),
(2, 'ESP', 'Ecole Supérieure Polytechnique', 'Former des étudiants à devenir un ingénieur', '2025-06-09 10:09:47', '2025-07-14 08:46:39', 'logos/2OZC9NFrvC9jZBwp5qgoFfI9dIV2RPJw7RbUNbYy.png', NULL, 3),
(3, 'ESAED', 'Ecole Supérieure en Agronomie et en Environnement de Diego', 'former des étudiants dans le domaine environnemental etc', '2025-06-09 10:15:25', '2025-07-14 08:46:39', 'logos/JutAbuTsUD3f2f5tNvaKfR2F1oj26s55THgINkzp.jpg', NULL, 4),
(4, 'FLSH', 'Faculté des Lettres et Sciences Humaines', 'Former des étudiants à devenir expert en communication etc', '2025-06-09 10:19:00', '2025-07-14 08:46:39', 'logos/9ZEFDnsdU48hMMxFTIVdnqnoXaWQLiEts3vdEuLy.png', NULL, 5),
(5, 'ISAE', 'Institut Supérieur en Administration d\'Entreprises', 'Former des étudiants à devenir un administrateur', '2025-06-09 10:26:53', '2025-07-14 08:46:39', 'logos/v03fV247G3fXxwHThiI1rNYtD16vR5niAJPOmPrL.png', NULL, 6),
(6, 'IUSES', 'Institut Universitaire des Sciences de l\'Environnement et de la Société', 'Former des étudiants dans les domaines environnementales', '2025-06-09 10:29:00', '2025-07-14 08:46:39', 'logos/URz87NH4oRblbXKQ1MKlPfAfVI2vL1cuCgnhZ8zR.jpg', NULL, 7),
(7, 'FM', 'Faculté de Médecine', 'Former des étudiants à devenir un médecin', '2025-06-09 10:30:11', '2025-07-14 08:46:39', 'logos/b9Ntpc6n8ZL95lR94lkJ5JfjmQPT3J34aNen1KPv.png', NULL, 8),
(8, 'DEGSP', 'Faculté de Droit, Economie, Gestion et de Science Politique', 'Former des étudiants dans différent domaine', '2025-06-09 10:31:58', '2025-07-14 08:46:39', 'logos/T44YAhbw27r0fvbAYedzGOhP7u4P4b8whd7m26lL.jpg', NULL, 9),
(9, 'FS', 'Faculté des Sciences', 'former des étudiants dans le domaine environnemental etc', '2025-06-09 10:32:28', '2025-07-14 08:46:39', 'logos/occkGcFP5l8srXRt6rJ9z1s51DKGRwIAcUEW5GGs.png', 15.29, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `option_id` bigint UNSIGNED DEFAULT NULL,
  `score` tinyint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee` year NOT NULL DEFAULT '2025',
  PRIMARY KEY (`id`),
  KEY `evaluations_user_id_foreign` (`user_id`),
  KEY `evaluations_question_id_foreign` (`question_id`),
  KEY `evaluations_option_id_foreign` (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evaluations`
--

INSERT INTO `evaluations` (`id`, `user_id`, `question_id`, `option_id`, `score`, `created_at`, `updated_at`, `annee`) VALUES
(67, 2, 20, NULL, 1, '2025-07-14 08:25:04', '2025-07-14 08:25:04', 2025),
(66, 2, 17, NULL, 1, '2025-07-14 08:25:04', '2025-07-14 08:25:04', 2025),
(65, 2, 11, NULL, 3, '2025-07-14 08:25:04', '2025-07-14 08:25:04', 2025),
(64, 2, 10, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(63, 2, 9, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(62, 2, 8, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(61, 2, 7, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(60, 2, 6, NULL, 1, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(59, 2, 16, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(58, 2, 5, NULL, 1, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(57, 2, 1, NULL, 2, '2025-07-14 08:25:03', '2025-07-14 08:25:03', 2025),
(56, 5, 20, NULL, 1, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(55, 5, 17, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(54, 5, 11, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(53, 5, 10, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(52, 5, 9, NULL, 0, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(51, 5, 8, NULL, 1, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(50, 5, 7, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(49, 5, 6, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(48, 5, 16, NULL, 1, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(47, 5, 5, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(46, 5, 1, NULL, 2, '2025-07-13 20:41:45', '2025-07-13 20:41:45', 2025),
(68, 3, 1, NULL, 3, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(69, 3, 5, NULL, 1, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(70, 3, 16, NULL, 0, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(71, 3, 6, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(72, 3, 7, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(73, 3, 8, NULL, 1, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(74, 3, 9, NULL, 1, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(75, 3, 10, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(76, 3, 11, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(77, 3, 17, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(78, 3, 20, NULL, 2, '2025-07-14 08:28:42', '2025-07-14 08:28:42', 2025),
(79, 6, 1, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(80, 6, 5, NULL, 1, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(81, 6, 16, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(82, 6, 6, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(83, 6, 7, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(84, 6, 8, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(85, 6, 9, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(86, 6, 10, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(87, 6, 11, NULL, 1, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(88, 6, 17, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(89, 6, 20, NULL, 2, '2025-07-14 08:46:39', '2025-07-14 08:46:39', 2025),
(90, 12, 1, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(91, 12, 5, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(92, 12, 16, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(93, 12, 6, NULL, 1, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(94, 12, 7, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(95, 12, 8, NULL, 1, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(96, 12, 9, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(97, 12, 10, NULL, 1, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(98, 12, 11, NULL, 3, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(99, 12, 17, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025),
(100, 12, 20, NULL, 2, '2025-07-16 06:52:11', '2025-07-16 06:52:11', 2025);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `kpis`
--

DROP TABLE IF EXISTS `kpis`;
CREATE TABLE IF NOT EXISTS `kpis` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kpis`
--

INSERT INTO `kpis` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Qualité des cours et des pédagogies', '2025-07-06 13:20:54', '2025-07-06 13:20:54'),
(2, 'Satisfaction des étudiants', '2025-07-06 13:21:24', '2025-07-06 13:21:24'),
(3, 'Taux de réussite', '2025-07-06 13:21:43', '2025-07-06 13:21:43'),
(4, 'Infrastructures et ressources disponible', '2025-07-06 13:22:07', '2025-07-06 13:22:07'),
(5, 'Pertinence des programmes', '2025-07-06 13:22:25', '2025-07-06 13:22:25'),
(6, 'Organisations', '2025-07-06 13:22:40', '2025-07-06 13:22:40');

-- --------------------------------------------------------

--
-- Structure de la table `kpi_classements`
--

DROP TABLE IF EXISTS `kpi_classements`;
CREATE TABLE IF NOT EXISTS `kpi_classements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `kpi_id` bigint UNSIGNED NOT NULL,
  `rang` tinyint UNSIGNED NOT NULL,
  `poids` decimal(5,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee` year NOT NULL DEFAULT '2025',
  PRIMARY KEY (`id`),
  KEY `kpi_classements_user_id_foreign` (`user_id`),
  KEY `kpi_classements_kpi_id_foreign` (`kpi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kpi_classements`
--

INSERT INTO `kpi_classements` (`id`, `user_id`, `kpi_id`, `rang`, `poids`, `created_at`, `updated_at`, `annee`) VALUES
(54, 6, 6, 5, '9.52', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(53, 6, 5, 4, '14.29', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(52, 6, 4, 3, '19.05', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(51, 6, 3, 6, '4.76', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(50, 6, 2, 2, '23.81', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(49, 6, 1, 1, '28.57', '2025-07-14 08:46:10', '2025-07-14 08:46:10', 2025),
(48, 3, 6, 2, '23.81', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(47, 3, 5, 1, '28.57', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(46, 3, 4, 5, '9.52', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(45, 3, 3, 6, '4.76', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(44, 3, 2, 4, '14.29', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(43, 3, 1, 3, '19.05', '2025-07-14 08:28:15', '2025-07-14 08:28:15', 2025),
(42, 2, 6, 6, '4.76', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(41, 2, 5, 2, '23.81', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(40, 2, 4, 4, '14.29', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(39, 2, 3, 5, '9.52', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(38, 2, 2, 3, '19.05', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(37, 2, 1, 1, '28.57', '2025-07-14 08:24:31', '2025-07-14 08:24:31', 2025),
(36, 5, 6, 1, '28.57', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(35, 5, 5, 3, '19.05', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(34, 5, 4, 6, '4.76', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(33, 5, 3, 5, '9.52', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(32, 5, 2, 2, '23.81', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(31, 5, 1, 4, '14.29', '2025-07-13 20:41:17', '2025-07-13 20:41:17', 2025),
(55, 12, 1, 2, '23.81', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025),
(56, 12, 2, 1, '28.57', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025),
(57, 12, 3, 5, '9.52', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025),
(58, 12, 4, 4, '14.29', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025),
(59, 12, 5, 3, '19.05', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025),
(60, 12, 6, 6, '4.76', '2025-07-16 06:51:22', '2025-07-16 06:51:22', 2025);

-- --------------------------------------------------------

--
-- Structure de la table `mentions`
--

DROP TABLE IF EXISTS `mentions`;
CREATE TABLE IF NOT EXISTS `mentions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Libelee` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Etabli_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` double(8,2) DEFAULT NULL,
  `rang` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mentions_etabli_id_foreign` (`Etabli_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mentions`
--

INSERT INTO `mentions` (`id`, `Libelee`, `name`, `description`, `Etabli_id`, `created_at`, `updated_at`, `note`, `rang`) VALUES
(3, 'SAEn', 'Sciences Agronomiques et Environnementales', 'Former des hommes de terrain ayant la capacité d\'écoute et de compréhensions du contexte entre le monde rural et citadin', 3, '2025-06-20 06:29:13', '2025-07-16 06:52:11', NULL, 4),
(4, 'AMET', 'Agronomie, Météorologie, Eaux et Territoire', 'Former des hommes de terrain ayant la capacité d\'analyser, de modéliser des agrosystèmes et de proposer des solutions adaptées au contexte local', 3, '2025-06-20 06:33:24', '2025-07-16 06:52:11', NULL, 5),
(5, 'EADI2E', 'Éducation – Apprentissage - Didactique et Ingénierie en Électrotechnique et Électronique', 'Former des étudiants dans le domaine électrotechnique et électronique', 1, '2025-06-20 06:35:20', '2025-07-16 06:52:11', 13.81, 3),
(6, 'EADIM', 'Éducation – Apprentissage - Didactique et Ingénierie en Mécanique', 'Domaine mécanique', 1, '2025-06-20 06:36:47', '2025-07-16 06:52:11', NULL, 6),
(7, 'EADIMI', 'Éducation – apprentissage - Didactique et Ingénierie en Mathématique et Informatique', 'Domaine mathématique et informatique', 1, '2025-06-20 06:37:45', '2025-07-16 06:52:11', 15.01, 2),
(8, 'EADIGC-SM', 'Éducation - Apprentissage-Didactique et Ingénierie en Génie Civile et Structure Métallique', 'Génie Civile et Structure Métallique', 1, '2025-06-20 06:38:52', '2025-07-14 08:46:39', NULL, 7),
(9, 'SS', 'Sciences sociales', 'Domaine Sciences sociales', 1, '2025-06-20 06:40:05', '2025-07-14 08:46:39', NULL, 8),
(10, 'GE', 'Génie Électrique', 'Domaine électricité', 2, '2025-06-20 06:41:51', '2025-07-14 08:46:39', NULL, 9),
(11, 'GC', 'Génie Civil', 'Domaine Génie Civil', 2, '2025-06-20 06:42:36', '2025-07-14 08:46:39', NULL, 10),
(12, 'STIC', 'Science et Technologie de l’Information et de la Communication', 'Domaine Science et Technologie de l’Information et de la Communication', 2, '2025-06-20 06:46:20', '2025-07-14 08:46:39', NULL, 11),
(13, 'HE', 'Hydraulique et Énergétique', 'Domaine Hydraulique et Énergétique', 2, '2025-06-20 06:47:34', '2025-07-14 08:46:39', NULL, 12),
(14, 'LLC', 'Lettres, langues et Communication', 'Lettres, langues et Communication', 4, '2025-06-20 06:50:32', '2025-07-14 08:46:39', NULL, 13),
(15, 'SH', 'Sciences Humaines', 'Sciences Humaines', 4, '2025-06-20 06:51:13', '2025-07-14 08:46:39', NULL, 14),
(16, 'MEF', 'Métier de l’Enseignement de Formation', 'Métier de l’Enseignement de Formation', 4, '2025-06-20 06:51:51', '2025-07-14 08:46:39', NULL, 15),
(17, 'LAP', 'Littérature, Anthropologie et Philosophie', 'Littérature, Anthropologie et Philosophie', 4, '2025-06-20 06:52:30', '2025-07-14 08:46:39', NULL, 16),
(18, 'CNM', 'Communication Numérique et Média', 'Communication Numérique et Média', 4, '2025-06-20 06:53:21', '2025-07-14 08:46:39', NULL, 17),
(19, 'Economie', 'Economie', 'Economie', 8, '2025-06-20 06:54:22', '2025-07-14 08:46:39', NULL, 18),
(20, 'SG', 'Sciences de Gestion', 'Sciences de Gestion', 8, '2025-06-20 06:55:28', '2025-07-14 08:46:39', NULL, 19),
(21, 'DSP', 'Droit -Sciences Politiques', 'Droit -Sciences Politiques', 8, '2025-06-20 06:56:03', '2025-07-14 08:46:39', NULL, 20),
(22, 'SC', 'Sciences Chimiques', 'Sciences Chimiques', 9, '2025-06-20 06:56:49', '2025-07-14 08:46:39', NULL, 21),
(23, 'Sciences', 'Sciences', 'Sciences', 9, '2025-06-20 06:57:21', '2025-07-14 08:46:39', NULL, 22),
(24, 'SP', 'Sciences Physiques', 'Sciences Physiques', 9, '2025-06-20 06:58:27', '2025-07-14 08:46:39', 15.29, 1),
(25, 'SNE', 'Sciences de la Nature et de l’Environnement', 'Sciences de la Nature et de l’Environnement', 9, '2025-06-20 06:59:10', '2025-07-13 19:47:00', NULL, 23),
(26, 'SP', 'Sciences Paramédicales', 'Sciences Paramédicales', 7, '2025-06-20 06:59:51', '2025-07-13 19:47:00', NULL, 24),
(27, 'Maïeutique', 'Maïeutique', 'Maïeutique', 7, '2025-06-20 07:00:29', '2025-07-13 19:47:00', NULL, 25),
(28, 'SVT', 'Science du Vivant et de la Terre', 'Science du Vivant et de la Terre', 6, '2025-06-20 07:01:17', '2025-07-13 19:47:00', NULL, 26),
(29, 'SVT-COVABIO', 'Science du Vivant et de la Terre', 'Science du Vivant et de la Terre', 6, '2025-06-20 07:01:43', '2025-07-13 19:47:00', NULL, 27),
(30, 'AE', 'Administration d’Entreprise', 'Administration d’Entreprise', 5, '2025-06-20 07:02:25', '2025-07-13 19:47:00', NULL, 28),
(31, 'TNC', 'Technologie Numérique et Communication', 'Technologie Numérique et Communication', 2, '2025-06-20 07:05:01', '2025-07-13 19:47:00', NULL, 29),
(32, 'GET', 'Génie Électrique et Technologique', 'Génie Électrique et Technologique', 2, '2025-06-20 07:05:47', '2025-07-13 19:47:00', NULL, 30),
(33, 'STI', 'Science Technique et Industrielle', 'C\'est une mention qui forme les étudiants à devenir des techniciens', 1, '2025-07-09 05:41:04', '2025-07-13 19:47:00', NULL, 31);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_06_09_073230_create_permission_tables', 1),
(7, '2025_06_09_123246_create_etablissements_table', 2),
(8, '2025_06_09_140137_create_mentions_table', 3),
(9, '2025_06_20_133341_add_logo_to_etablissements_table', 4),
(10, '2025_07_06_092226_add_etablissement_and_mention_to_users_table', 5),
(11, '2025_07_06_132004_add_niveau_to_users_table', 6),
(12, '2025_07_06_152717_create_kpis_table', 7),
(13, '2025_07_06_152732_create_kpi_classements_table', 7),
(14, '2025_07_09_074833_add_annee_to_kpi_classements_table', 8),
(15, '2025_07_11_125105_create_questions_table', 9),
(16, '2025_07_11_125532_create_options_table', 9),
(17, '2025_07_11_125716_create_evaluations_table', 9),
(18, '2025_07_12_010636_add_annee_to_evaluations_table', 10),
(19, '2025_07_13_102535_add_note_and_rang_to_users_mentions_etablissements', 11),
(20, '2025_07_15_224708_create_temoignages_table', 12),
(22, '2025_07_15_235349_add_is_admin_to_users_table', 13);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` bigint UNSIGNED NOT NULL,
  `texte` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_question_id_foreign` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `question_id`, `texte`, `score`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pas du tout satisfait', 0, '2025-07-11 10:35:42', '2025-07-11 10:35:42'),
(2, 1, 'Peu satisfait', 1, '2025-07-11 10:35:42', '2025-07-11 10:35:42'),
(3, 1, 'Satisfait', 2, '2025-07-11 10:35:42', '2025-07-11 10:35:42'),
(4, 1, 'Très satisfait', 3, '2025-07-11 10:35:42', '2025-07-11 10:35:42'),
(52, 17, 'Plus ou moins', 1, '2025-07-13 11:40:42', '2025-07-13 11:40:42'),
(53, 17, 'Oui', 2, '2025-07-13 11:40:42', '2025-07-13 11:40:42'),
(50, 16, 'Oui', 2, '2025-07-11 11:25:55', '2025-07-11 11:25:55'),
(51, 17, 'Non', 0, '2025-07-13 11:40:42', '2025-07-13 11:40:42'),
(49, 16, 'Plus ou moins', 1, '2025-07-11 11:25:55', '2025-07-11 11:25:55'),
(48, 16, 'Non', 0, '2025-07-11 11:25:55', '2025-07-11 11:25:55'),
(13, 5, 'Non', 0, '2025-07-11 10:53:37', '2025-07-11 10:53:37'),
(14, 5, 'Plus ou moins', 1, '2025-07-11 10:53:37', '2025-07-11 10:53:37'),
(15, 5, 'Oui', 2, '2025-07-11 10:53:37', '2025-07-11 10:53:37'),
(16, 6, 'Non', 0, '2025-07-11 10:55:25', '2025-07-11 10:55:25'),
(17, 6, 'Plus ou moins', 1, '2025-07-11 10:55:25', '2025-07-11 10:55:25'),
(18, 6, 'Oui', 2, '2025-07-11 10:55:25', '2025-07-11 10:55:25'),
(19, 7, 'Pas satisfait', 0, '2025-07-11 11:07:07', '2025-07-11 11:07:07'),
(20, 7, 'Peu satisfait', 1, '2025-07-11 11:07:07', '2025-07-11 11:07:07'),
(21, 7, 'Satisfait', 2, '2025-07-11 11:07:07', '2025-07-11 11:07:07'),
(22, 7, 'Très satisfait', 3, '2025-07-11 11:07:07', '2025-07-11 11:07:07'),
(23, 8, 'Non', 0, '2025-07-11 11:09:59', '2025-07-11 11:09:59'),
(24, 8, 'Plus ou moins', 1, '2025-07-11 11:09:59', '2025-07-11 11:09:59'),
(25, 8, 'Oui', 2, '2025-07-11 11:09:59', '2025-07-11 11:09:59'),
(26, 9, 'Non', 0, '2025-07-11 11:14:23', '2025-07-11 11:14:23'),
(27, 9, 'Plus ou moins', 1, '2025-07-11 11:14:23', '2025-07-11 11:14:23'),
(28, 9, 'Oui', 2, '2025-07-11 11:14:23', '2025-07-11 11:14:23'),
(29, 10, 'Non', 0, '2025-07-11 11:15:45', '2025-07-11 11:15:45'),
(30, 10, 'Plus ou moins', 1, '2025-07-11 11:15:45', '2025-07-11 11:15:45'),
(31, 10, 'Oui', 2, '2025-07-11 11:15:45', '2025-07-11 11:15:45'),
(32, 11, 'Pas du tout satisfait', 0, '2025-07-11 11:18:46', '2025-07-11 11:18:46'),
(33, 11, 'Peu satisfait', 1, '2025-07-11 11:18:46', '2025-07-11 11:18:46'),
(34, 11, 'Satisfait', 2, '2025-07-11 11:18:46', '2025-07-11 11:18:46'),
(35, 11, 'Très satisfait', 3, '2025-07-11 11:18:46', '2025-07-11 11:18:46'),
(69, 20, 'Non', 0, '2025-07-13 12:00:52', '2025-07-13 12:00:52'),
(70, 20, 'Plus ou moins', 1, '2025-07-13 12:00:52', '2025-07-13 12:00:52'),
(71, 20, 'Oui', 2, '2025-07-13 12:00:52', '2025-07-13 12:00:52');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint UNSIGNED NOT NULL,
  `intitule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('choix','texte') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_kpi_id_foreign` (`kpi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `kpi_id`, `intitule`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Êtes-vous satisfait(e) de la clarté des explications des enseignants ?', 'choix', '2025-07-11 10:35:42', '2025-07-11 10:35:42'),
(5, 1, 'Les méthodes d’enseignement (cours magistraux, TD, TP) vous aident-elles à\ncomprendre les matières ?', 'choix', '2025-07-11 10:53:37', '2025-07-11 10:53:37'),
(16, 1, 'Les supports pédagogiques sont-ils accessibles ?', 'choix', '2025-07-11 11:25:55', '2025-07-11 11:25:55'),
(6, 1, 'Les évaluations sont-elles cohérentes avec les contenus enseignés ?', 'choix', '2025-07-11 10:55:25', '2025-07-11 10:55:25'),
(7, 4, 'Êtes-vous satisfait(e) de l’état des salles de cours (propreté, éclairage, places assises) ?', 'choix', '2025-07-11 11:07:07', '2025-07-11 11:07:07'),
(8, 4, 'Les laboratoires ou équipements répondent-ils à vos besoins académiques ?', 'choix', '2025-07-11 11:09:59', '2025-07-11 11:09:59'),
(9, 5, 'Les contenus des cours sont-ils adaptés aux exigences professionnelles ou\nacadémiques futures ?', 'choix', '2025-07-11 11:14:23', '2025-07-11 11:14:23'),
(10, 5, 'Les opportunités de stages ou de projets pratiques sont-elles suffisantes ?', 'choix', '2025-07-11 11:15:45', '2025-07-11 11:15:45'),
(11, 6, 'Êtes-vous satisfait(e) de la gestion administrative ?', 'choix', '2025-07-11 11:18:46', '2025-07-11 11:18:46'),
(20, 2, 'Dans l\'ensemble, êtes-vous satisfait(e) de votre expérience dans votre mention et votre établissement?', 'choix', '2025-07-13 12:00:52', '2025-07-13 12:00:52'),
(17, 6, 'Les emplois du temps sont-ils bien organisés et respectés ?', 'choix', '2025-07-13 11:40:42', '2025-07-13 11:40:42');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-06-09 09:01:01', '2025-06-09 09:01:01'),
(2, 'Etudiant', 'web', '2025-06-09 09:01:44', '2025-06-09 09:01:44');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temoignages`
--

DROP TABLE IF EXISTS `temoignages`;
CREATE TABLE IF NOT EXISTS `temoignages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `temoignages_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `temoignages`
--

INSERT INTO `temoignages` (`id`, `user_id`, `titre`, `contenu`, `created_at`, `updated_at`) VALUES
(1, 2, 'Beauté de l\'ENSET', 'Je vous informe que ENSET est devenu le meilleure du tout maintenant.', '2025-07-15 20:02:23', '2025-07-15 20:02:23'),
(2, 12, 'Un exemple de témoignage', 'Des recommandation pour convaincre les nouveaux étudiants à suivre ESPA', '2025-07-16 12:30:52', '2025-07-16 12:30:52');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etablissement_id` bigint UNSIGNED NOT NULL,
  `mention_id` bigint UNSIGNED NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_etablissement_id_foreign` (`etablissement_id`),
  KEY `users_mention_id_foreign` (`mention_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenoms`, `profil`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `etablissement_id`, `mention_id`, `niveau`, `note`) VALUES
(2, 'RAHARIMANDIMBY', 'Jean Florien', NULL, 'raharimandimbyflorien@gmail.com', 1, '2025-07-06 09:49:26', '$2y$10$77iQ4Ux3DWZbMR7KHeoypu./BOgk.Z3U7JLcz/QKUTlm2Uj/2peqC', NULL, '2025-07-06 09:47:51', '2025-07-14 08:25:04', 1, 5, 'Sortant', 13.62),
(3, 'RALAITSIFERANA', 'Paul Claudio', NULL, 'ralaitsiferanapaulclaudio@gmail.com', 0, '2025-07-06 10:34:42', '$2y$10$dGkGeJ/CTGApBYQWJRCHTeGpeD6QFqFsjKoUEjbPJSakgRSpxWRae', NULL, '2025-07-06 10:34:03', '2025-07-14 08:28:42', 1, 5, 'M2', 13.52),
(6, 'RANDRIAMAHEFA', 'Anick Bienvenot', NULL, 'ranickbienvenot@gmail.com', 0, '2025-07-14 08:45:18', '$2y$10$Hc7xIJa1XsU3M4D/OAEfnOHrAFxI6YXMnsrk9evQqzZ.4shKMmUYK', NULL, '2025-07-14 08:42:45', '2025-07-14 08:46:39', 9, 24, 'M2', 15.29),
(12, 'Razafindrasolo', 'Angilio', 'images/profils/vWr0uFoiz3jSQHxael7dIYTgazHT8Wmc269WciYf.jpg', 'angiliorazafindrasolo@gmail.com', 0, '2025-07-16 06:28:07', '$2y$10$N77EtIgqePjYtKOLOZk5d.lxDehapQVmmvBkUo/K8k3lm6YLmwgDq', NULL, '2025-07-16 06:27:37', '2025-07-16 11:43:13', 1, 7, 'Sortant', 15.01);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
