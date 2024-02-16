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
-- Dumping data for table kust-cbt.answers: ~0 rows (approximately)
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `question_id`, `option_id`, `examination_user_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2015-05-29 17:47:51', '2015-05-29 17:47:51');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping data for table kust-cbt.audit_trail: ~0 rows (approximately)
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;

-- Dumping data for table kust-cbt.courses: ~0 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `title`, `code`, `department_offering`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Crazy Stuff todday', 'CRZ201', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping data for table kust-cbt.departments: ~0 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `name`, `faculty_id`, `deleted_at`) VALUES
	(1, 'Crazy', 2, NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping data for table kust-cbt.examinations: ~1 rows (approximately)
/*!40000 ALTER TABLE `examinations` DISABLE KEYS */;
INSERT INTO `examinations` (`id`, `title`, `no_of_questions`, `course_id`, `question_score_weight`, `exam_date`, `duration`, `status`, `instructions`, `question_delivery`, `deleted_at`, `created_at`, `updated_at`, `str_verify`, `maximum_score`) VALUES
	(1, 'aarasdfdfasdfsdf', 232, 3, 12, '2015-05-26 00:00:00', 330000, 'active', '', 'random', NULL, '2015-05-28 16:48:42', '2015-05-28 18:04:44', 'K5A6z9cbdL', 100);
/*!40000 ALTER TABLE `examinations` ENABLE KEYS */;

-- Dumping data for table kust-cbt.examination_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `examination_users` DISABLE KEYS */;
INSERT INTO `examination_users` (`id`, `user_id`, `examination_id`, `result`, `level`, `started_at`, `stopped_at`, `unique_exam_code`, `status`, `created_at`, `updated_at`) VALUES
	(1, 8, 1, 12, 0, '2015-05-29 17:47:45', '0000-00-00 00:00:00', 'hello', 'active', '0000-00-00 00:00:00', '2015-05-29 17:47:51');
/*!40000 ALTER TABLE `examination_users` ENABLE KEYS */;

-- Dumping data for table kust-cbt.faculties: ~2 rows (approximately)
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` (`id`, `name`, `code`, `deleted_at`) VALUES
	(1, 'Engineering', 'ENG', NULL),
	(2, 'Social Sciences', 'SOC', NULL);
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;

-- Dumping data for table kust-cbt.fileuploads: ~1 rows (approximately)
/*!40000 ALTER TABLE `fileuploads` DISABLE KEYS */;
INSERT INTO `fileuploads` (`id`, `filename`, `mime`, `original_filename`, `user_id`, `examination_id`, `created_at`, `updated_at`) VALUES
	(1, '1 aarasdfdfasdfsdf_K5A6z9cbdL_template.xls', 'application/vnd.ms-excel', 'aarasdfdfasdfsdf_K5A6z9cbdL_template.xls', 5, 1, '2015-05-28 16:58:22', '2015-05-28 16:58:22');
/*!40000 ALTER TABLE `fileuploads` ENABLE KEYS */;

-- Dumping data for table kust-cbt.lock_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `lock_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lock_permissions` ENABLE KEYS */;

-- Dumping data for table kust-cbt.migrations: ~20 rows (approximately)
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
	('2015_05_29_160956_add_maximum_score_field_to_examinations_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table kust-cbt.options: ~2 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `title`, `question_id`, `correct_answer`) VALUES
	(1, 'Muhamadu Buhari', 1, 1),
	(2, 'Goodluck Jonathann', 7, 1),
	(3, 'glhglh', 2, 1);
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping data for table kust-cbt.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping data for table kust-cbt.permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'create_exams', 'Can create examinations', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping data for table kust-cbt.permission_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping data for table kust-cbt.questions: ~1 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `title`, `examination_id`, `score_weight`) VALUES
	(1, 'Who is the Nigerian President', 1, 12),
	(2, 'Who is the Nigerian President', 1, 12),
	(7, 'wdqdq', 1, 12);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- Dumping data for table kust-cbt.roles: ~3 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'Administrator', 'Oversees other roles', '2015-05-21 09:15:40', '2015-05-21 09:15:40'),
	(2, 'examiner', 'Examiner', 'Controls Examinations', '2015-05-21 09:15:40', '2015-05-21 09:15:40'),
	(3, 'student', 'Student', 'Takes examination', '2015-05-21 09:15:40', '2015-05-21 09:15:40');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping data for table kust-cbt.role_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
	(5, 2),
	(8, 3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Dumping data for table kust-cbt.sessions: ~1 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `payload`, `last_activity`) VALUES
	('1e4543e4b851bca19abbb376153b78a76a50f8df', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieUQ5NGJGaVFMYTB3UFdHZE1zRmVHYXNkSXNKakRYbzZ6Q1FKWWZ1MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9jYnQuZGV2L2NsaWVudC9leGFtaW5hdGlvbnMiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTg6ImZsYXNoX25vdGlmaWNhdGlvbiI7YTowOnt9czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO2k6ODtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQzMjkyMTY3MjtzOjE6ImMiO2k6MTQzMjkwMTkyMDtzOjE6ImwiO3M6MToiMCI7fX0=', 1432921672);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;

-- Dumping data for table kust-cbt.settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `value`, `examination_id`) VALUES
	(1, 'DISPLAY_RESULTS', 'YES', 1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping data for table kust-cbt.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `identity_no`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `session_id`) VALUES
	(5, 'Michael', 'Obi', '11110000', '$2y$10$//cE6mfM//BYgY/Q3MLfdextADvgtLgEY7nLetNyn2gacVWLL820G', 'hGBoW0XBPk5VZdXx6fInwdrweiF2Z7ldjW3G34vQRwe5ZMQrWzsORAnNf9vS', '2015-05-21 09:20:28', '2015-05-21 15:49:21', NULL, NULL),
	(6, 'John', 'Doe', '00001111', '$2y$10$4OeSehW.GoExvNGyCOB3reJI5C7V8T5WJugZgJVI24GPduMMRhp2W', 'v90yjuh4YvJSQpSYHMX8WUqZehmlioYRmUOI43wWyNIyo0a1rFl8fgfSXIfi', '2015-05-21 09:20:28', '2015-05-21 09:27:34', NULL, NULL),
	(7, 'Richard', 'Roe', '11111111', '$2y$10$u1XuYmeb4/G47fhPOWwB6.fKQ1Pkzdsn35IBpphpBVPyCSjIYG8lK', NULL, '2015-05-21 09:20:28', '2015-05-21 09:20:28', NULL, NULL),
	(8, 'Jane', 'Doe', '22222222', '$2y$10$pD3Zz1XCJEMg7lUgug3gsOzKQeLHlgDRqVgwak48BC./Bh7WfJusq', 'aXEpt9cFHebmSwQqMvokkzrx7yV1PSiDBW3Jlm7IPwzJeq6083t83yOIHd0z', '2015-05-21 09:20:28', '2015-05-29 12:21:26', NULL, 32767);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
