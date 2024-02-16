-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for kust-cbt
CREATE DATABASE IF NOT EXISTS `kust-cbt` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kust-cbt`;


-- Dumping structure for table kust-cbt.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned NOT NULL,
  `examination_user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `answers_question_id_option_id_examination_user_id_unique` (`question_id`,`option_id`,`examination_user_id`),
  KEY `answers_examination_user_id_foreign` (`examination_user_id`),
  KEY `answers_option_id_foreign` (`option_id`),
  CONSTRAINT `answers_examination_user_id_foreign` FOREIGN KEY (`examination_user_id`) REFERENCES `examination_users` (`id`),
  CONSTRAINT `answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.answers: ~1 rows (approximately)
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `question_id`, `option_id`, `examination_user_id`, `created_at`, `updated_at`) VALUES
	(11, 347, 1006, 1, '2015-06-01 18:13:10', '2015-06-01 18:13:10'),
	(24, 388, 1169, 50, '2015-06-03 18:54:16', '2015-06-03 18:54:16'),
	(25, 389, 1174, 50, '2015-06-03 18:54:16', '2015-06-03 18:54:16'),
	(26, 390, 1177, 50, '2015-06-03 18:54:16', '2015-06-03 18:54:16');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.audit_trail
CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `entity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_instance` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.audit_trail: ~0 rows (approximately)
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `department_offering` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_department_offering_foreign` (`department_offering`),
  CONSTRAINT `courses_department_offering_foreign` FOREIGN KEY (`department_offering`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.courses: ~0 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `title`, `code`, `department_offering`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Crazy Stuff todday', 'CRZ201', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
	(4, 'Programming in Java', 'CMP302', 3, '2015-06-01 12:53:40', '2015-06-01 12:54:09', NULL),
	(5, 'NUMERICAL ANALYSIS', 'MTH221', 4, '2015-06-03 17:16:04', '2015-06-03 17:16:04', NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `faculty_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.departments: ~0 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `name`, `faculty_id`, `deleted_at`) VALUES
	(1, 'Sociology', 2, NULL),
	(2, 'Business Admin', 1, NULL),
	(3, 'Computer Science', 1, NULL),
	(4, 'MATHEMATICS', 4, NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.examinations
CREATE TABLE IF NOT EXISTS `examinations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_of_questions` int(11) NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `question_score_weight` double DEFAULT NULL,
  `exam_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` int(11) NOT NULL,
  `status` enum('active','inactive','archived') COLLATE utf8_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8_unicode_ci NOT NULL,
  `question_delivery` enum('random','linear') COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `str_verify` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maximum_score` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `examinations_course_id_foreign` (`course_id`),
  CONSTRAINT `examinations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.examinations: ~0 rows (approximately)
/*!40000 ALTER TABLE `examinations` DISABLE KEYS */;
INSERT INTO `examinations` (`id`, `title`, `no_of_questions`, `course_id`, `question_score_weight`, `exam_date`, `duration`, `status`, `instructions`, `question_delivery`, `deleted_at`, `created_at`, `updated_at`, `str_verify`, `maximum_score`) VALUES
	(1, 'aarasdfdfasdfsdf', 232, 3, 12, '2015-05-26 00:00:00', 30000, 'archived', '', 'random', NULL, '2015-05-28 16:48:42', '2015-05-31 17:08:24', 'K5A6z9cbdL', 100),
	(2, 'Java data structures', 10, 4, 10, '2015-06-16 00:00:00', 180000, 'active', '', 'random', NULL, '2015-06-01 12:55:21', '2015-06-01 16:06:33', 'uZ7Ju5uiS5', 100),
	(7, 'CBT', 50, 3, NULL, '2014-03-06 00:00:00', 3600000, 'active', '', 'random', NULL, '2015-06-03 15:48:50', '2015-06-03 16:04:20', 'YRRpEX8wOU', 0),
	(8, 'Mr.', 2, 4, NULL, '2015-03-06 00:00:00', 1800000, 'inactive', '', 'random', NULL, '2015-06-03 16:10:34', '2015-06-03 16:10:34', 'L0fJmhMaC0', 0),
	(9, 'INTERPOLATION', 20, 5, NULL, '2015-06-03 00:00:00', 1800000, 'active', '', 'random', NULL, '2015-06-03 18:05:29', '2015-06-03 18:41:36', 'FF6ngdC7gh', 0);
/*!40000 ALTER TABLE `examinations` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.examination_users
CREATE TABLE IF NOT EXISTS `examination_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `examination_id` int(10) unsigned NOT NULL,
  `result` double DEFAULT NULL,
  `level` int(10) unsigned NOT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `stopped_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unique_exam_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `examination_users_user_id_foreign` (`user_id`),
  KEY `examination_users_examination_id_foreign` (`examination_id`),
  CONSTRAINT `examination_users_examination_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`),
  CONSTRAINT `examination_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.examination_users: ~15 rows (approximately)
/*!40000 ALTER TABLE `examination_users` DISABLE KEYS */;
INSERT INTO `examination_users` (`id`, `user_id`, `examination_id`, `result`, `level`, `started_at`, `stopped_at`, `unique_exam_code`, `status`, `created_at`, `updated_at`) VALUES
	(1, 8, 2, 23, 0, '2015-06-01 18:29:29', '0000-00-00 00:00:00', 'testcode', 'inactive', '0000-00-00 00:00:00', '2015-06-01 18:31:22'),
	(34, 17, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:11', '2015-06-03 10:43:11'),
	(35, 19, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:11', '2015-06-03 10:43:11'),
	(36, 22, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:11', '2015-06-03 10:43:11'),
	(37, 13, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:11', '2015-06-03 10:43:11'),
	(38, 23, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:12', '2015-06-03 10:43:12'),
	(39, 16, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:12', '2015-06-03 10:43:12'),
	(40, 14, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:12', '2015-06-03 14:51:31'),
	(41, 8, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:12', '2015-06-03 10:43:12'),
	(42, 6, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:13', '2015-06-03 10:43:13'),
	(43, 25, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:13', '2015-06-03 10:43:13'),
	(44, 18, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:13', '2015-06-03 10:43:13'),
	(45, 24, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:13', '2015-06-03 10:43:13'),
	(46, 21, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:13', '2015-06-03 10:43:13'),
	(47, 12, 2, NULL, 200, NULL, '0000-00-00 00:00:00', 'testcode', 'inactive', '2015-06-03 10:43:14', '2015-06-03 10:43:14'),
	(48, 40, 7, NULL, 100, NULL, '0000-00-00 00:00:00', '120', 'inactive', '2015-06-03 16:02:58', '2015-06-03 16:02:58'),
	(49, 41, 7, NULL, 200, NULL, '0000-00-00 00:00:00', '120', 'inactive', '2015-06-03 16:02:58', '2015-06-03 16:02:58'),
	(50, 42, 9, 10, 100, '2015-06-03 18:48:38', '0000-00-00 00:00:00', 'e', 'inactive', '2015-06-03 18:35:53', '2015-06-03 18:54:16'),
	(51, 43, 9, NULL, 100, NULL, '0000-00-00 00:00:00', 'r', 'inactive', '2015-06-03 18:35:54', '2015-06-03 18:35:54'),
	(52, 44, 9, NULL, 100, NULL, '0000-00-00 00:00:00', 'y', 'inactive', '2015-06-03 18:35:54', '2015-06-03 18:35:54'),
	(53, 45, 9, NULL, 100, NULL, '0000-00-00 00:00:00', 't', 'inactive', '2015-06-03 18:35:55', '2015-06-03 18:35:55'),
	(54, 46, 9, NULL, 200, NULL, '0000-00-00 00:00:00', 'i', 'inactive', '2015-06-03 18:35:55', '2015-06-03 18:35:55');
/*!40000 ALTER TABLE `examination_users` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.faculties
CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.faculties: ~2 rows (approximately)
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` (`id`, `name`, `code`, `deleted_at`) VALUES
	(1, 'Physical Sciences', 'PHY', NULL),
	(2, 'Social Sciences', 'SOC', NULL),
	(3, 'Engineering', 'ENGR', NULL),
	(4, 'FACULTY OF SCIENCES', '2', NULL);
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.fileuploads
CREATE TABLE IF NOT EXISTS `fileuploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `examination_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fileuploads_user_id_foreign` (`user_id`),
  KEY `fileuploads_examination_id_foreign` (`examination_id`),
  CONSTRAINT `fileuploads_examination_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fileuploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.fileuploads: ~47 rows (approximately)
/*!40000 ALTER TABLE `fileuploads` DISABLE KEYS */;
INSERT INTO `fileuploads` (`id`, `filename`, `mime`, `original_filename`, `user_id`, `examination_id`, `created_at`, `updated_at`) VALUES
	(1, '1 aarasdfdfasdfsdf_K5A6z9cbdL_template.xls', 'application/vnd.ms-excel', 'aarasdfdfasdfsdf_K5A6z9cbdL_template.xls', 5, 1, '2015-05-28 16:58:22', '2015-05-28 16:58:22'),
	(2, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 14:57:37', '2015-06-01 14:57:37'),
	(3, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:01:38', '2015-06-01 15:01:38'),
	(4, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:03:18', '2015-06-01 15:03:18'),
	(5, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:08:02', '2015-06-01 15:08:02'),
	(6, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:11:15', '2015-06-01 15:11:15'),
	(7, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:13:34', '2015-06-01 15:13:34'),
	(8, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:15:28', '2015-06-01 15:15:28'),
	(9, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:16:11', '2015-06-01 15:16:11'),
	(10, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:17:32', '2015-06-01 15:17:32'),
	(11, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:27:30', '2015-06-01 15:27:30'),
	(12, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:30:22', '2015-06-01 15:30:22'),
	(13, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:32:19', '2015-06-01 15:32:19'),
	(14, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:51:45', '2015-06-01 15:51:45'),
	(15, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 15:55:28', '2015-06-01 15:55:28'),
	(16, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:02:52', '2015-06-01 16:02:52'),
	(17, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:13:54', '2015-06-01 16:13:54'),
	(18, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:15:01', '2015-06-01 16:15:01'),
	(19, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:18:02', '2015-06-01 16:18:02'),
	(20, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:25:58', '2015-06-01 16:25:58'),
	(21, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:29:06', '2015-06-01 16:29:06'),
	(22, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:30:02', '2015-06-01 16:30:02'),
	(23, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:33:08', '2015-06-01 16:33:08'),
	(24, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:38:15', '2015-06-01 16:38:15'),
	(25, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 16:45:32', '2015-06-01 16:45:32'),
	(26, '2 Java data structures_uZ7Ju5uiS5_template_new.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new.xls', 5, 2, '2015-06-01 16:46:43', '2015-06-01 16:46:43'),
	(27, '2 Java data structures_uZ7Ju5uiS5_template_new.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new.xls', 5, 2, '2015-06-01 17:07:15', '2015-06-01 17:07:15'),
	(28, '2 Java data structures_uZ7Ju5uiS5_template_new.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new.xls', 5, 2, '2015-06-01 17:35:49', '2015-06-01 17:35:49'),
	(29, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-01 17:43:17', '2015-06-01 17:43:17'),
	(30, '2 Java data structures_uZ7Ju5uiS5_template_new.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new.xls', 5, 2, '2015-06-02 07:52:48', '2015-06-02 07:52:48'),
	(31, '2 Java data structures_uZ7Ju5uiS5_template_new-bool.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new-bool.xls', 5, 2, '2015-06-02 07:58:27', '2015-06-02 07:58:27'),
	(32, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 16:58:38', '2015-06-02 16:58:38'),
	(33, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 16:58:59', '2015-06-02 16:58:59'),
	(34, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:00:56', '2015-06-02 17:00:56'),
	(35, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:04:42', '2015-06-02 17:04:42'),
	(36, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:05:12', '2015-06-02 17:05:12'),
	(37, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:07:39', '2015-06-02 17:07:39'),
	(38, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:10:46', '2015-06-02 17:10:46'),
	(39, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:14:32', '2015-06-02 17:14:32'),
	(40, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:15:55', '2015-06-02 17:15:55'),
	(41, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:17:38', '2015-06-02 17:17:38'),
	(42, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:19:57', '2015-06-02 17:19:57'),
	(43, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:32:45', '2015-06-02 17:32:45'),
	(44, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:36:56', '2015-06-02 17:36:56'),
	(45, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:39:11', '2015-06-02 17:39:11'),
	(46, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 17:40:43', '2015-06-02 17:40:43'),
	(47, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-02 18:02:37', '2015-06-02 18:02:37'),
	(48, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-03 10:03:04', '2015-06-03 10:03:04'),
	(49, '2 Java data structures_uZ7Ju5uiS5_template_new.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template_new.xls', 5, 2, '2015-06-03 10:04:58', '2015-06-03 10:04:58'),
	(50, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-03 10:06:49', '2015-06-03 10:06:49'),
	(51, '2 Java data structures_uZ7Ju5uiS5_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_template.xls', 5, 2, '2015-06-03 10:07:36', '2015-06-03 10:07:36'),
	(52, '2 Java data structures_uZ7Ju5uiS5_class_template.xls', 'application/vnd.ms-excel', 'Java data structures_uZ7Ju5uiS5_class_template.xls', 5, 2, '2015-06-03 10:43:08', '2015-06-03 10:43:08'),
	(53, '7 CBT_YRRpEX8wOU_template.xls', 'application/vnd.ms-excel', 'CBT_YRRpEX8wOU_template.xls', 5, 7, '2015-06-03 15:57:31', '2015-06-03 15:57:31'),
	(54, '7 CBT_YRRpEX8wOU_class_template.xls', 'application/vnd.ms-excel', 'CBT_YRRpEX8wOU_class_template.xls', 5, 7, '2015-06-03 16:02:56', '2015-06-03 16:02:56'),
	(55, '9 INTERPOLATION_FF6ngdC7gh_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_template.xls', 5, 9, '2015-06-03 18:17:06', '2015-06-03 18:17:06'),
	(56, '9 INTERPOLATION_FF6ngdC7gh_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_template.xls', 5, 9, '2015-06-03 18:19:22', '2015-06-03 18:19:22'),
	(57, '9 INTERPOLATION_FF6ngdC7gh_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_template.xls', 5, 9, '2015-06-03 18:20:47', '2015-06-03 18:20:47'),
	(58, '9 INTERPOLATION_FF6ngdC7gh_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_template.xls', 5, 9, '2015-06-03 18:24:27', '2015-06-03 18:24:27'),
	(59, '9 INTERPOLATION_FF6ngdC7gh_class_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_class_template.xls', 5, 9, '2015-06-03 18:29:03', '2015-06-03 18:29:03'),
	(60, '9 INTERPOLATION_FF6ngdC7gh_class_template.xls', 'application/vnd.ms-excel', 'INTERPOLATION_FF6ngdC7gh_class_template.xls', 5, 9, '2015-06-03 18:35:52', '2015-06-03 18:35:52');
/*!40000 ALTER TABLE `fileuploads` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.lock_permissions
CREATE TABLE IF NOT EXISTS `lock_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `caller_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caller_id` int(11) DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `resource_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.lock_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `lock_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lock_permissions` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.migrations: ~42 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2014_12_08_120000_lock_create_permissions_table', 1),
	('2015_05_18_210550_create_faculties_table', 1),
	('2015_05_18_210606_create_departments_table', 1),
	('2015_05_18_210625_create_courses_table', 1),
	('2015_05_18_210649_create_examinations_table', 1),
	('2015_05_18_211818_create_examination_users_table', 1),
	('2015_05_18_211904_create_questions_table', 1),
	('2015_05_18_211916_create_options_table', 1),
	('2015_05_19_063048_create_audit_trail_table', 1),
	('2015_05_20_033310_entrust_setup_tables', 1),
	('2015_05_21_090911_create_answers_table', 1),
	('2015_05_21_132029_create_fileuploads_table', 1),
	('2015_05_22_192139_create_session_table', 1),
	('2015_05_23_103718_add_verification_string_column_to_examinations_table', 1),
	('2015_05_25_091853_add_session_count_field_to_users_table', 1),
	('2015_05_27_065410_create_settings_table', 1),
	('2015_05_27_084138_add_unique_key_to_answers_table', 1),
	('2015_05_27_084616_drop_type_column_from_questions_table', 1),
	('2015_05_29_160956_add_maximum_score_field_to_examinations_table', 1),
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2014_12_08_120000_lock_create_permissions_table', 1),
	('2015_05_18_210550_create_faculties_table', 1),
	('2015_05_18_210606_create_departments_table', 1),
	('2015_05_18_210625_create_courses_table', 1),
	('2015_05_18_210649_create_examinations_table', 1),
	('2015_05_18_211818_create_examination_users_table', 1),
	('2015_05_18_211904_create_questions_table', 1),
	('2015_05_18_211916_create_options_table', 1),
	('2015_05_19_063048_create_audit_trail_table', 1),
	('2015_05_20_033310_entrust_setup_tables', 1),
	('2015_05_21_090911_create_answers_table', 1),
	('2015_05_21_132029_create_fileuploads_table', 1),
	('2015_05_22_192139_create_session_table', 1),
	('2015_05_23_103718_add_verification_string_column_to_examinations_table', 1),
	('2015_05_25_091853_add_session_count_field_to_users_table', 1),
	('2015_05_27_065410_create_settings_table', 1),
	('2015_05_27_084138_add_unique_key_to_answers_table', 1),
	('2015_05_27_084616_drop_type_column_from_questions_table', 1),
	('2015_05_29_160956_add_maximum_score_field_to_examinations_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `correct_answer` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `options_question_id_foreign` (`question_id`),
  CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1180 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.options: ~47 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `title`, `question_id`, `correct_answer`) VALUES
	(1006, 'asfsdfasdfasdfasfsadfsdfasdfsdfsdfds', 347, 1),
	(1092, 'Integer', 366, 1),
	(1093, 'Float', 366, 0),
	(1094, 'String', 366, 1),
	(1095, 'Char', 366, 0),
	(1096, 'Yes', 367, 1),
	(1097, 'No', 367, 0),
	(1098, 'Yes', 368, 0),
	(1099, 'No', 368, 1),
	(1100, 'null', 369, 0),
	(1101, 'Depends on the data type', 369, 1),
	(1102, 'Zero', 369, 0),
	(1103, '8 bit', 370, 0),
	(1104, '16 bit', 370, 1),
	(1105, '32 bit', 370, 0),
	(1106, '64 bit', 370, 0),
	(1107, 'null', 371, 0),
	(1108, 'undefined', 371, 0),
	(1109, '0', 371, 1),
	(1110, 'Variables, methods and constructors which are declared protected can be accessed by any class.', 372, 0),
	(1111, ' Variables, methods and constructors which are declared protected can be accessed by any class lying in same package.', 372, 0),
	(1112, ' Variables, methods and constructors which are declared protected in the superclass can be accessed only by its child class.', 372, 1),
	(1113, 'None of the above.', 372, 0),
	(1114, 'JRE is a java based GUI application.', 373, 0),
	(1115, ' JRE is an application development framework.', 373, 0),
	(1116, ' JRE is an implementation of the Java Virtual Machine which executes Java programs.', 373, 1),
	(1117, 'True', 374, 1),
	(1118, 'static', 375, 1),
	(1119, 'Boolean', 375, 0),
	(1120, 'void', 375, 0),
	(1121, 'private', 375, 1),
	(1122, '8 bit', 376, 0),
	(1123, '16 bit', 376, 1),
	(1124, '32 bit', 376, 0),
	(1125, 'not precisely defined', 376, 0),
	(1126, 'class variables are static variables within a class but outside any method.', 377, 1),
	(1127, 'class variables are variables defined inside methods, constructors or blocks.', 377, 0),
	(1128, 'class variables are variables within a class but outside any method.', 377, 0),
	(1129, 'None of the above.', 377, 0),
	(1130, 'Yes', 378, 0),
	(1131, 'No', 378, 1),
	(1132, 'String is mutable.', 379, 0),
	(1133, 'String is a data type.', 379, 1),
	(1134, 'String is immutable.', 379, 1),
	(1135, 'Variables defined inside methods, constructors or blocks are called local variables.', 380, 1),
	(1136, 'Static variables defined outside methods, constructors or blocks are called local variables.', 380, 0),
	(1137, 'Variables defined outside methods, constructors or blocks are called local variables.', 380, 0),
	(1138, 'Troublemaker', 381, 0),
	(1139, 'Noisemaker', 381, 1),
	(1140, 'Because of Kachi', 382, 1),
	(1141, 'Because of Abiola', 382, 0),
	(1166, '2', 388, 1),
	(1167, '3', 388, 0),
	(1168, '4', 388, 0),
	(1169, '5', 388, 0),
	(1170, '1', 388, 0),
	(1171, '7', 389, 0),
	(1172, '6', 389, 0),
	(1173, '8', 389, 0),
	(1174, '9', 389, 1),
	(1175, '0', 389, 0),
	(1176, '6', 390, 0),
	(1177, '4', 390, 1),
	(1178, '7', 390, 0),
	(1179, '0', 390, 0);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'create_exams', 'Can create examinations', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.permission_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `examination_id` int(10) unsigned NOT NULL,
  `score_weight` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_examination_id_foreign` (`examination_id`),
  CONSTRAINT `questions_examination_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.questions: ~16 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `title`, `examination_id`, `score_weight`) VALUES
	(347, 'SDFSFADF', 1, 1),
	(366, 'Which of these is not a primitive data types?', 2, 10),
	(367, 'Can we have multiple classes in same java file?', 2, 10),
	(368, 'you can pop data out of the top or bottom of a stack.', 2, 10),
	(369, ' What of the following is the default value of an instance variable?', 2, 10),
	(370, 'What is the size of char variable?', 2, 10),
	(371, 'What is the default value of int variable?', 2, 10),
	(372, 'Which of the following is true about protected access modifier?', 2, 10),
	(373, 'What is JRE?', 2, 10),
	(374, 'Deletion is faster in LinkedList than ArrayList.', 2, 10),
	(375, 'Which of the following are keyword in java?', 2, 10),
	(376, 'What is the size of boolean variable?', 2, 10),
	(377, 'What is class variable?', 2, 10),
	(378, 'Can we compare int variable with a boolean variable?', 2, 10),
	(379, 'In Java, Which of the following are not true about String?', 2, 10),
	(380, 'What is local variable?', 2, 10),
	(381, 'What is a Kachi?', 7, 1),
	(382, 'Why is Ifeanyi Making Noise?', 7, 1),
	(388, '1+1', 9, 5),
	(389, '3X3', 9, 5),
	(390, '5-1', 9, 5);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'Administrator', 'Oversees other roles', '2015-05-21 09:15:40', '2015-05-21 09:15:40'),
	(2, 'examiner', 'Examiner', 'Controls Examinations', '2015-05-21 09:15:40', '2015-05-21 09:15:40'),
	(3, 'student', 'Student', 'Takes examination', '2015-05-21 09:15:40', '2015-05-21 09:15:40');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.role_user: ~17 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(11, 1),
	(5, 2),
	(7, 3),
	(8, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(19, 3),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3),
	(25, 3),
	(40, 3),
	(41, 3),
	(42, 3),
	(43, 3),
	(44, 3),
	(45, 3),
	(46, 3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
	('9adcf4b10f2326004c6a08c99345dc95d4523e70', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiTzEwYVJLQndaeTc1WWI3TDF6cDJ4bE5oQ1dpV2dPcGNXN2NNQWM2ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9jYnQuZGV2L2FkbWluL2V4YW1zLzkiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiYXV0aF9jb2RlIjtzOjE6ImUiO3M6MTg6ImZsYXNoX25vdGlmaWNhdGlvbiI7YTowOnt9czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6NTtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQzMzM1Nzc2NTtzOjE6ImMiO2k6MTQzMzM0MjM4NTtzOjE6ImwiO3M6MToiMCI7fX0=', 1433357766),
	('dbecf0b357ba90e16e7adc656c24f8fa33c51de7', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiY0k2bzVGZjJhbWtLMTBtVU81WUgwak90dFB2WjhWWmNRODZNMHpMZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9jYnQuZGV2L2FkbWluL2V4YW1zLzgvY2xhc3MvdXBsb2FkIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6NTtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQzMzM0OTU2NDtzOjE6ImMiO2k6MTQzMzM0OTUwNTtzOjE6ImwiO3M6MToiMCI7fX0=', 1433349565);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `examination_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_examination_id_unique` (`key`,`examination_id`),
  KEY `settings_examination_id_foreign` (`examination_id`),
  CONSTRAINT `settings_examination_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`, `examination_id`) VALUES
	(1, 'DISPLAY_RESULTS', 'YES', 1),
	(2, 'DISPLAY_RESULTS', 'YES', 2),
	(3, 'DISPLAY_RESULTS', 'YES', 7),
	(4, 'DISPLAY_RESULTS', 'YES', 8),
	(5, 'DISPLAY_RESULTS', 'YES', 9);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table kust-cbt.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identity_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `session_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_identity_no_unique` (`identity_no`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table kust-cbt.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `identity_no`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `session_id`) VALUES
	(5, 'Michael', 'Obi', '11110000', '$2y$10$//cE6mfM//BYgY/Q3MLfdextADvgtLgEY7nLetNyn2gacVWLL820G', 'bdsdDNladSfKa6Wv9fJGUoHwhRPS6wDAAp3uvCCrkRhrJaLyzF3A12gG3XCA', '2015-05-21 09:20:28', '2015-06-03 18:46:26', NULL, NULL),
	(6, 'John', 'Doe', '00001111', '$2y$10$4OeSehW.GoExvNGyCOB3reJI5C7V8T5WJugZgJVI24GPduMMRhp2W', NULL, '2015-05-21 09:20:28', '2015-05-31 16:22:20', '2015-05-31 16:22:20', NULL),
	(7, 'Richard', 'Roe', '2015/10014', '$2y$10$u1XuYmeb4/G47fhPOWwB6.fKQ1Pkzdsn35IBpphpBVPyCSjIYG8lK', NULL, '2015-05-21 09:20:28', '2015-05-31 16:22:26', NULL, NULL),
	(8, 'Jane', 'Doe', '2015/10013', '$2y$10$pD3Zz1XCJEMg7lUgug3gsOzKQeLHlgDRqVgwak48BC./Bh7WfJusq', 'Tydgrb6LTpoI4Myr9a0NsC9QoAHct1LDcvGY80mEeOPFE9MgsBMGoZXMcedg', '2015-05-21 09:20:28', '2015-06-01 18:26:58', NULL, 52),
	(9, 'Michael', 'Obi', '22221111', '', NULL, '2015-05-31 09:02:07', '2015-05-31 09:03:03', '2015-05-31 09:03:03', NULL),
	(10, 'Jephthah', 'Yusuf', '12121212', '$2y$10$Ftfl5hzgHGCWhpng45OtE.WbjQrlNwe7eMn4irip8d5Oo/MtS7qoi', NULL, '2015-05-31 09:03:31', '2015-05-31 09:04:23', '2015-05-31 09:04:23', NULL),
	(11, 'Jephthah', 'Yusuf', '12121221', '$2y$10$.mcNGXx2tgP.jNVUDauF3ugJ3v4zt/kqScK4iVcwIioEUUzsaBDy6', NULL, '2015-05-31 09:04:57', '2015-05-31 09:04:57', NULL, NULL),
	(12, 'Yetunde', 'Abdullahi', '2015/1015', '', NULL, '2015-06-02 17:33:19', '2015-06-02 17:33:19', NULL, NULL),
	(13, 'Azeez', 'Yetunde', '2015/1000', '', NULL, '2015-06-02 17:40:46', '2015-06-02 17:40:46', NULL, NULL),
	(14, 'Hauwa', 'Abdul', '2015/1001', '', 'NPSpKt4U565TpieQ1WNBjF8BCXyCC64EcMHA9QqTyDhkV1anrw0dqIPmzDMO', '2015-06-02 17:40:46', '2015-06-03 15:27:56', NULL, NULL),
	(15, 'Saratu', 'Remi', '2015/1002', '', NULL, '2015-06-02 17:40:46', '2015-06-02 17:40:46', NULL, NULL),
	(16, 'Danladi', 'Isiaku', '2015/1003', '', NULL, '2015-06-02 17:40:46', '2015-06-02 17:40:46', NULL, NULL),
	(17, 'Abubakar', 'Yerima', '2015/1004', '', NULL, '2015-06-02 17:40:46', '2015-06-02 17:40:46', NULL, NULL),
	(18, 'Kemi', 'Ola', '2015/1005', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(19, 'Ahmed', 'Saraki', '2015/1006', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(20, 'Shehu', 'Mohammed', '2015/1007', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(21, 'Yar\'Adua', 'Musa', '2015/1008', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(22, 'Ali', 'Musa', '2015/1009', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(23, 'Bayo', 'Balewa', '2015/1010', '', NULL, '2015-06-02 17:40:47', '2015-06-02 17:40:47', NULL, NULL),
	(24, 'Peter', 'Osondu', '2015/1011', '', NULL, '2015-06-02 17:40:48', '2015-06-02 17:40:48', NULL, NULL),
	(25, 'Joseph', 'Phillips', '2015/1012', '', NULL, '2015-06-02 17:40:48', '2015-06-02 17:40:48', NULL, NULL),
	(26, 'Hello', 'Name', '90909090', '', NULL, '2015-06-03 10:43:10', '2015-06-03 10:43:10', NULL, NULL),
	(27, 'Hello', 'Name', '1', '', NULL, '2015-06-03 10:43:11', '2015-06-03 10:43:11', NULL, NULL),
	(28, 'Hello', 'Name', '2', '', NULL, '2015-06-03 10:43:11', '2015-06-03 10:43:11', NULL, NULL),
	(29, 'Hello', 'Name', '3', '', NULL, '2015-06-03 10:43:11', '2015-06-03 10:43:11', NULL, NULL),
	(30, 'Hello', 'Name', '4', '', NULL, '2015-06-03 10:43:12', '2015-06-03 10:43:12', NULL, NULL),
	(31, 'Hello', 'Name', '55', '', NULL, '2015-06-03 10:43:12', '2015-06-03 10:43:12', NULL, NULL),
	(32, 'Hello', 'Name', '777', '', NULL, '2015-06-03 10:43:12', '2015-06-03 10:43:12', NULL, NULL),
	(33, 'Hello', 'Name', '66', '', NULL, '2015-06-03 10:43:12', '2015-06-03 10:43:12', NULL, NULL),
	(34, 'Hello', 'Name', '67', '', NULL, '2015-06-03 10:43:12', '2015-06-03 10:43:12', NULL, NULL),
	(35, 'Hello', 'Name', '8686', '', NULL, '2015-06-03 10:43:13', '2015-06-03 10:43:13', NULL, NULL),
	(36, 'Hello', 'Name', '97878', '', NULL, '2015-06-03 10:43:13', '2015-06-03 10:43:13', NULL, NULL),
	(37, 'Hello', 'Name', '6675', '', NULL, '2015-06-03 10:43:13', '2015-06-03 10:43:13', NULL, NULL),
	(38, 'Hello', 'Name', '453', '', NULL, '2015-06-03 10:43:13', '2015-06-03 10:43:13', NULL, NULL),
	(39, 'Hello', 'Name', '3452', '', NULL, '2015-06-03 10:43:13', '2015-06-03 10:43:13', NULL, NULL),
	(40, 'Michael', 'Obi', '1100', '', '6P9CGe2vNC2aP7jY46bs8HTAwHDRw2DEvNzAMJNA4GGSKbWiDyMqG1n26aqk', '2015-06-03 16:02:57', '2015-06-03 17:10:31', NULL, NULL),
	(41, 'Ifeanyi', 'Ojo', '2200', '', NULL, '2015-06-03 16:02:58', '2015-06-03 16:02:58', NULL, NULL),
	(42, 'A', 'H', 'U99EE1071', '', 'LgYB81Hv6Jue7q6KJWOJpVv6aZ5xFxixkRDyvEoW66np2pmCz4reJGibYfm0', '2015-06-03 18:35:53', '2015-06-03 18:55:26', NULL, NULL),
	(43, 'S', 'T', 'U99EE1087', '', NULL, '2015-06-03 18:35:54', '2015-06-03 18:35:54', NULL, NULL),
	(44, 'D', 'G', 'U70BC2009', '', NULL, '2015-06-03 18:35:54', '2015-06-03 18:35:54', NULL, NULL),
	(45, 'E', 'H', 'U67CH3434', '', NULL, '2015-06-03 18:35:54', '2015-06-03 18:35:54', NULL, NULL),
	(46, 'R', 'R', 'U67BC3434', '', NULL, '2015-06-03 18:35:55', '2015-06-03 18:35:55', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
