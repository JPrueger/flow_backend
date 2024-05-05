-- -------------------------------------------------------------
-- TablePlus 5.9.0(538)
--
-- https://tableplus.com/
--
-- Database: flow
-- Generation Time: 2024-05-02 22:41:25.8640
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `characterlevels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `points_upgrade` int NOT NULL,
  `video_state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_upgrade` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `characters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_storypoints` int DEFAULT NULL,
  `charactertype_id` bigint unsigned NOT NULL,
  `characterlevel_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `characters_charactertype_id_foreign` (`charactertype_id`),
  KEY `characters_characterlevel_id_foreign` (`characterlevel_id`),
  CONSTRAINT `characters_characterlevel_id_foreign` FOREIGN KEY (`characterlevel_id`) REFERENCES `characterlevels` (`id`),
  CONSTRAINT `characters_charactertype_id_foreign` FOREIGN KEY (`charactertype_id`) REFERENCES `charactertypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `charactertypes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projects_users_mm` (
  `user_id` bigint unsigned NOT NULL,
  `project_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigne_id` bigint unsigned DEFAULT NULL,
  `storypoints` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_index` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_assigne_id_foreign` (`assigne_id`),
  CONSTRAINT `tasks_assigne_id_foreign` FOREIGN KEY (`assigne_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `character_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level_one_played` tinyint(1) DEFAULT '0',
  `level_two_played` tinyint(1) DEFAULT '0',
  `level_three_played` tinyint(1) DEFAULT '0',
  `character_id` bigint unsigned DEFAULT NULL,
  `storypoints` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_character_id_foreign` (`character_id`),
  CONSTRAINT `users_character_id_foreign` FOREIGN KEY (`character_id`) REFERENCES `characters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `characterlevels` (`id`, `created_at`, `updated_at`, `points_upgrade`, `video_state`, `video_upgrade`) VALUES
(1, NULL, NULL, 5, 'sdf', 'sdf');

INSERT INTO `characters` (`id`, `created_at`, `updated_at`, `name`, `current_storypoints`, `charactertype_id`, `characterlevel_id`) VALUES
(2, NULL, NULL, 'test', 3, 1, 1),
(3, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Abigale Price', 53, 1, 1),
(4, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ms. Aliyah Ullrich I', 61, 1, 1),
(5, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ms. Ressie Hickle Sr.', 66, 1, 1),
(6, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Liliana Dibbert', 4, 1, 1),
(7, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ashleigh Ward', 18, 1, 1),
(8, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Merlin Watsica', 81, 1, 1),
(9, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Trevor Lueilwitz', 0, 1, 1),
(10, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Miss Ilene Kautzer', 31, 1, 1),
(11, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Jaylin Friesen', 79, 1, 1),
(12, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Edwina Schiller DDS', 27, 1, 1),
(13, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Isidro Doyle', 52, 1, 1),
(14, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Sigurd Mante', 61, 1, 1),
(15, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Prof. Brennon Williamson', 62, 1, 1),
(16, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Karson King II', 41, 1, 1),
(17, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ms. Alyce Moen', 33, 1, 1),
(18, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Elroy Waters', 43, 1, 1),
(19, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Andrew Feil', 61, 1, 1),
(20, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Trinity Kuhn', 4, 1, 1),
(21, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Kelton Schowalter', 48, 1, 1),
(22, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Emie Walter', 7, 1, 1);

INSERT INTO `charactertypes` (`id`, `created_at`, `updated_at`, `name`, `video_start`) VALUES
(1, NULL, NULL, 'ghost', 'test.mp4');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2012_11_07_142316_create_charactertypes_table', 1),
(2, '2012_11_07_142346_create_characterlevels_table', 1),
(3, '2013_11_07_142121_create_characters_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2014_11_07_142150_create_tasks_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_11_02_170123_create_projects_table', 1);

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'auth', '08cb75743951f570f2c120bf55002f9d05aeee7116e8a4994f0a5d530ac44682', '[\"*\"]', '2024-04-30 07:59:41', '2024-04-30 07:33:04', '2024-04-30 07:59:41');

INSERT INTO `projects` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Veritatis', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(2, 'Non est nemo fuga', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(3, 'Velit quis aut', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(4, 'Dolor qui aut', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(5, 'Accusamus', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(6, 'Qui omnis pariatur', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(7, 'Soluta id rerum', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(8, 'Iusto quos', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(9, 'Quia dolor culpa ab', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(10, 'Quasi temporibus', '2024-04-30 07:33:38', '2024-04-30 07:33:38'),
(12, 'test', '2024-04-30 07:34:05', '2024-04-30 07:34:05'),
(13, 'hee', '2024-04-30 07:34:10', '2024-04-30 07:34:10'),
(14, 'dsfsdf', '2024-04-30 07:35:44', '2024-04-30 07:35:44');

INSERT INTO `projects_users_mm` (`user_id`, `project_id`) VALUES
(3, 11),
(3, 11),
(3, 12),
(3, 12),
(4, 13),
(3, 13),
(3, 14);

INSERT INTO `tasks` (`id`, `created_at`, `updated_at`, `project_id`, `title`, `description`, `assigne_id`, `storypoints`, `status`, `sort_index`) VALUES
(1, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Ad eos', 'Rerum accusamus laudantium consequatur unde corporis dolorum quas veniam. Magnam est sapiente quod natus. Aut facilis et expedita.', 14, 63, 'progress', 6),
(2, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Ratione', 'Voluptatibus voluptates dolorem quibusdam corporis et id et qui. Maxime deleniti nihil corrupti ipsa sint. Itaque accusamus eaque et cum voluptatum est.', 15, 93, 'done', 0),
(3, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'A in', 'Rerum harum qui modi sed. Aspernatur et nihil eveniet hic nemo vel. Placeat dicta est et nesciunt.', 16, 67, 'progress', 5),
(4, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Voluptas', 'Quam reprehenderit fugit perferendis eum rerum. Qui et ipsa similique qui consequatur necessitatibus. Aliquid hic ad hic.', 17, 30, 'done', 10),
(5, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Soluta', 'Nihil amet aut est repudiandae ipsum. Rerum provident doloremque veritatis nulla ut porro. Et nostrum ab ut iure omnis. Quasi sed a animi numquam.', 18, 78, 'done', 2),
(6, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Autem', 'Et pariatur ut quam. Autem maiores sit illum nulla. Inventore eius numquam alias consequatur.', 19, 46, 'progress', 1),
(7, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Et ab', 'Totam eius accusantium praesentium. Eos molestiae asperiores asperiores in corrupti et similique.', 20, 40, 'done', 8),
(8, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'At nam', 'Placeat sint quis pariatur rerum sint. Neque aspernatur blanditiis error esse ullam sed minus aliquam. Deserunt est illum aspernatur consequuntur beatae sunt placeat deleniti.', 21, 47, 'done', 3),
(9, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Quo', 'Iste quis excepturi laboriosam et. Quos aspernatur possimus nihil odio. Nemo nihil molestiae velit inventore. Quod veritatis soluta neque officiis voluptas. Sunt praesentium aut qui rerum sit.', 22, 38, 'open', 9),
(10, '2024-04-30 07:33:38', '2024-04-30 07:33:38', NULL, 'Dolorem', 'Et repudiandae earum natus id nobis sed ut quia. Molestiae ullam voluptates dolore tempore dolor aliquid reprehenderit. Qui itaque odit tempora qui distinctio in repellat ducimus.', 23, 18, 'open', 6),
(11, '2024-04-30 07:34:25', '2024-04-30 07:34:27', 13, 'asdfadsf', 'asdfadsf', 3, 13, 'done', 0),
(12, '2024-04-30 07:36:11', '2024-04-30 07:36:14', 13, 'fsdfd', 'sdfsdf', 3, 8, 'done', 1);

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `name`, `character_name`, `email`, `password`, `tag_color`, `level_one_played`, `level_two_played`, `level_three_played`, `character_id`, `storypoints`) VALUES
(3, '2024-04-30 07:32:51', '2024-04-30 07:36:57', 'kersi', 'casper', 'kersi@test.at', '$2y$10$sVowinIUjLe/Nwq1nXDjreswPSPn8xOIwytKnZpbQWGzNKjOj22vi', '#99154E', 1, NULL, NULL, 2, 21),
(4, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Carlee', 'Lela', 'russel.wyatt@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 3, 39),
(5, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Sarina', 'Georgette', 'anika.schaefer@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#49A6AA', 0, 0, 0, 4, 85),
(6, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Denis', 'Elise', 'reynolds.terrance@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 5, 25),
(7, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Christiana', 'Lauryn', 'haley.dicki@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 6, 75),
(8, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Octavia', 'Enola', 'murray.karl@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 7, 84),
(9, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Lily', 'Marlee', 'ktorphy@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#49A6AA', 0, 0, 0, 8, 97),
(10, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Billy', 'Daphne', 'augustus06@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#49A6AA', 0, 0, 0, 9, 72),
(11, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Eleanore', 'Ethan', 'zboncak.cale@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#FFB319', 0, 0, 0, 10, 67),
(12, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Kaley', 'Esperanza', 'lindsay58@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 11, 24),
(13, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Virginia', 'Al', 'molly.waelchi@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#49A6AA', 0, 0, 0, 12, 63),
(14, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ian', 'Christophe', 'layne.gulgowski@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 13, 91),
(15, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'William', 'Tomasa', 'willard66@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 14, 56),
(16, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Angeline', 'Geoffrey', 'jacobi.gladys@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 15, 56),
(17, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Ines', 'Marshall', 'dickinson.jonas@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 16, 72),
(18, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Samara', 'Jacques', 'obecker@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 17, 68),
(19, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Jordon', 'Maritza', 'okeefe.ari@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 18, 2),
(20, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Yolanda', 'Ellie', 'gjast@example.net', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#FFB319', 0, 0, 0, 19, 0),
(21, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Deja', 'Jerod', 'ldickinson@example.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#49A6AA', 0, 0, 0, 20, 44),
(22, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Abelardo', 'Eric', 'catherine.batz@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#0A474A', 0, 0, 0, 21, 77),
(23, '2024-04-30 07:33:38', '2024-04-30 07:33:38', 'Keara', 'Krista', 'kyle.mayer@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '#99154E', 0, 0, 0, 22, 7);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;