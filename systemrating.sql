-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 06 juil. 2025 à 16:28
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `Libelee`, `name`, `description`, `created_at`, `updated_at`, `logo`) VALUES
(1, 'ENSET', 'Ecole Normale Supérieure pour l\'Enseignement Technique', 'Ecole pour vous former à devenir Enseignant et ingénieure', '2025-06-09 10:03:42', '2025-07-06 10:06:22', 'logos/3jYSZ6qdQUsdtzXBm9NXZQ9dVyEv5vM23rnvYvfJ.png'),
(2, 'ESP', 'Ecole Supérieure Polytechnique', 'Former des étudiants à devenir un ingénieur', '2025-06-09 10:09:47', '2025-06-20 11:34:29', 'logos/2OZC9NFrvC9jZBwp5qgoFfI9dIV2RPJw7RbUNbYy.png'),
(3, 'ESAED', 'Ecole Supérieure en Agronomie et en Environnement de Diego', 'former des étudiants dans le domaine environnemental etc', '2025-06-09 10:15:25', '2025-06-20 11:34:52', 'logos/JutAbuTsUD3f2f5tNvaKfR2F1oj26s55THgINkzp.jpg'),
(4, 'FLSH', 'Faculté des Lettres et Sciences Humaines', 'Former des étudiants à devenir expert en communication etc', '2025-06-09 10:19:00', '2025-06-20 11:35:26', 'logos/9ZEFDnsdU48hMMxFTIVdnqnoXaWQLiEts3vdEuLy.png'),
(5, 'ISAE', 'Institut Supérieur en Administration d\'Entreprises', 'Former des étudiants à devenir un administrateur', '2025-06-09 10:26:53', '2025-06-20 11:35:48', 'logos/v03fV247G3fXxwHThiI1rNYtD16vR5niAJPOmPrL.png'),
(6, 'IUSES', 'Institut Universitaire des Sciences de l\'Environnement et de la Société', 'Former des étudiants dans les domaines environnementales', '2025-06-09 10:29:00', '2025-06-20 11:36:41', 'logos/URz87NH4oRblbXKQ1MKlPfAfVI2vL1cuCgnhZ8zR.jpg'),
(7, 'FM', 'Faculté de Médecine', 'Former des étudiants à devenir un médecin', '2025-06-09 10:30:11', '2025-06-20 11:36:13', 'logos/b9Ntpc6n8ZL95lR94lkJ5JfjmQPT3J34aNen1KPv.png'),
(8, 'DEGSP', 'Faculté de Droit, Economie, Gestion et de Science Politique', 'Former des étudiants dans différent domaine', '2025-06-09 10:31:58', '2025-06-20 11:37:21', 'logos/T44YAhbw27r0fvbAYedzGOhP7u4P4b8whd7m26lL.jpg'),
(9, 'FS', 'Faculté des Sciences', 'former des étudiants dans le domaine environnemental etc', '2025-06-09 10:32:28', '2025-06-20 11:37:49', 'logos/occkGcFP5l8srXRt6rJ9z1s51DKGRwIAcUEW5GGs.png');

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
  PRIMARY KEY (`id`),
  KEY `kpi_classements_user_id_foreign` (`user_id`),
  KEY `kpi_classements_kpi_id_foreign` (`kpi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kpi_classements`
--

INSERT INTO `kpi_classements` (`id`, `user_id`, `kpi_id`, `rang`, `poids`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, '19.05', '2025-07-06 13:24:24', '2025-07-06 13:24:24'),
(2, 2, 2, 2, '23.81', '2025-07-06 13:24:24', '2025-07-06 13:24:24'),
(3, 2, 3, 1, '28.57', '2025-07-06 13:24:24', '2025-07-06 13:24:24'),
(4, 2, 4, 4, '14.29', '2025-07-06 13:24:24', '2025-07-06 13:24:24'),
(5, 2, 5, 6, '4.76', '2025-07-06 13:24:24', '2025-07-06 13:24:24'),
(6, 2, 6, 5, '9.52', '2025-07-06 13:24:24', '2025-07-06 13:24:24');

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
  PRIMARY KEY (`id`),
  KEY `mentions_etabli_id_foreign` (`Etabli_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mentions`
--

INSERT INTO `mentions` (`id`, `Libelee`, `name`, `description`, `Etabli_id`, `created_at`, `updated_at`) VALUES
(1, 'EADIMI', 'Education Apprentissage Diacritique et Ingénierie en Mathématique et Informatique', 'Former des étudiants à devenir prof de maths et prof de l\'informatique', 1, '2025-06-10 03:25:42', '2025-06-20 06:18:35'),
(3, 'SAEn', 'Sciences Agronomiques et Environnementales', 'Former des hommes de terrain ayant la capacité d\'écoute et de compréhensions du contexte entre le monde rural et citadin', 3, '2025-06-20 06:29:13', '2025-06-20 06:29:13'),
(4, 'AMET', 'Agronomie, Météorologie, Eaux et Territoire', 'Former des hommes de terrain ayant la capacité d\'analyser, de modéliser des agrosystèmes et de proposer des solutions adaptées au contexte local', 3, '2025-06-20 06:33:24', '2025-06-20 06:33:24'),
(5, 'EADI2E', 'Éducation – Apprentissage - Didactique et Ingénierie en Électrotechnique et Électronique', 'Former des étudiants dans le domaine électrotechnique et électronique', 1, '2025-06-20 06:35:20', '2025-06-20 06:35:20'),
(6, 'EADIM', 'Éducation – Apprentissage - Didactique et Ingénierie en Mécanique', 'Domaine mécanique', 1, '2025-06-20 06:36:47', '2025-06-20 06:36:47'),
(7, 'EADIMI', 'Éducation – apprentissage - Didactique et Ingénierie en Mathématique et Informatique', 'Domaine mathématique et informatique', 1, '2025-06-20 06:37:45', '2025-06-20 06:37:45'),
(8, 'EADIGC-SM', 'Éducation - Apprentissage-Didactique et Ingénierie en Génie Civile et Structure Métallique', 'Génie Civile et Structure Métallique', 1, '2025-06-20 06:38:52', '2025-06-20 06:38:52'),
(9, 'SS', 'Sciences sociales', 'Domaine Sciences sociales', 1, '2025-06-20 06:40:05', '2025-06-20 06:40:05'),
(10, 'GE', 'Génie Électrique', 'Domaine électricité', 2, '2025-06-20 06:41:51', '2025-06-20 06:41:51'),
(11, 'GC', 'Génie Civil', 'Domaine Génie Civil', 2, '2025-06-20 06:42:36', '2025-06-20 06:42:36'),
(12, 'STIC', 'Science et Technologie de l’Information et de la Communication', 'Domaine Science et Technologie de l’Information et de la Communication', 2, '2025-06-20 06:46:20', '2025-06-20 06:46:20'),
(13, 'HE', 'Hydraulique et Énergétique', 'Domaine Hydraulique et Énergétique', 2, '2025-06-20 06:47:34', '2025-06-20 06:47:34'),
(14, 'LLC', 'Lettres, langues et Communication', 'Lettres, langues et Communication', 4, '2025-06-20 06:50:32', '2025-06-20 06:50:32'),
(15, 'SH', 'Sciences Humaines', 'Sciences Humaines', 4, '2025-06-20 06:51:13', '2025-06-20 06:51:13'),
(16, 'MEF', 'Métier de l’Enseignement de Formation', 'Métier de l’Enseignement de Formation', 4, '2025-06-20 06:51:51', '2025-06-20 06:51:51'),
(17, 'LAP', 'Littérature, Anthropologie et Philosophie', 'Littérature, Anthropologie et Philosophie', 4, '2025-06-20 06:52:30', '2025-06-20 06:52:30'),
(18, 'CNM', 'Communication Numérique et Média', 'Communication Numérique et Média', 4, '2025-06-20 06:53:21', '2025-06-20 06:53:21'),
(19, 'Economie', 'Economie', 'Economie', 8, '2025-06-20 06:54:22', '2025-06-20 06:54:22'),
(20, 'SG', 'Sciences de Gestion', 'Sciences de Gestion', 8, '2025-06-20 06:55:28', '2025-06-20 06:55:28'),
(21, 'DSP', 'Droit -Sciences Politiques', 'Droit -Sciences Politiques', 8, '2025-06-20 06:56:03', '2025-06-20 06:56:03'),
(22, 'SC', 'Sciences Chimiques', 'Sciences Chimiques', 9, '2025-06-20 06:56:49', '2025-06-20 06:56:49'),
(23, 'Sciences', 'Sciences', 'Sciences', 9, '2025-06-20 06:57:21', '2025-06-20 06:57:21'),
(24, 'SP', 'Sciences Physiques', 'Sciences Physiques', 9, '2025-06-20 06:58:27', '2025-06-20 06:58:27'),
(25, 'SNE', 'Sciences de la Nature et de l’Environnement', 'Sciences de la Nature et de l’Environnement', 9, '2025-06-20 06:59:10', '2025-06-20 06:59:10'),
(26, 'SP', 'Sciences Paramédicales', 'Sciences Paramédicales', 7, '2025-06-20 06:59:51', '2025-06-20 06:59:51'),
(27, 'Maïeutique', 'Maïeutique', 'Maïeutique', 7, '2025-06-20 07:00:29', '2025-06-20 07:00:29'),
(28, 'SVT', 'Science du Vivant et de la Terre', 'Science du Vivant et de la Terre', 6, '2025-06-20 07:01:17', '2025-06-20 07:01:17'),
(29, 'SVT-COVABIO', 'Science du Vivant et de la Terre', 'Science du Vivant et de la Terre', 6, '2025-06-20 07:01:43', '2025-06-20 07:01:43'),
(30, 'AE', 'Administration d’Entreprise', 'Administration d’Entreprise', 5, '2025-06-20 07:02:25', '2025-06-20 07:02:25'),
(31, 'TNC', 'Technologie Numérique et Communication', 'Technologie Numérique et Communication', 2, '2025-06-20 07:05:01', '2025-06-20 07:05:01'),
(32, 'GET', 'Génie Électrique et Technologique', 'Génie Électrique et Technologique', 2, '2025-06-20 07:05:47', '2025-06-20 07:05:47');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, '2025_07_06_152732_create_kpi_classements_table', 7);

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
(1, 'App\\Models\\User', 2);

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
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenoms` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etablissement_id` bigint UNSIGNED NOT NULL,
  `mention_id` bigint UNSIGNED NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_etablissement_id_foreign` (`etablissement_id`),
  KEY `users_mention_id_foreign` (`mention_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenoms`, `profil`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `etablissement_id`, `mention_id`, `niveau`) VALUES
(1, 'Razafindrasolo', 'Angilio', NULL, 'johntroaikkyman@gmail.com', NULL, '$2y$10$L/gYPsp/z41ZF9Ycw8mtZ.cv3IBDkzYnHnwYcJDe2w2GisyMiFlEi', NULL, '2025-06-09 07:55:47', '2025-06-09 07:55:47', 0, 0, ''),
(2, 'RAHARIMANDIMBY', 'Jean Florien', NULL, 'raharimandimbyflorien@gmail.com', '2025-07-06 09:49:26', '$2y$10$77iQ4Ux3DWZbMR7KHeoypu./BOgk.Z3U7JLcz/QKUTlm2Uj/2peqC', NULL, '2025-07-06 09:47:51', '2025-07-06 09:49:26', 1, 5, ''),
(3, 'RALAITSIFERANA', 'Paul Claudio', NULL, 'ralaitsiferanapaulclaudio@gmail.com', '2025-07-06 10:34:42', '$2y$10$dGkGeJ/CTGApBYQWJRCHTeGpeD6QFqFsjKoUEjbPJSakgRSpxWRae', NULL, '2025-07-06 10:34:03', '2025-07-06 10:34:42', 1, 5, 'M2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
