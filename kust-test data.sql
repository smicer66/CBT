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
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

-- Dumping data for table kust-cbt.audit_trail: ~0 rows (approximately)
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;

-- Dumping data for table kust-cbt.courses: ~0 rows (approximately)
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` (`id`, `title`, `code`, `department_offering`, `created_at`, `updated_at`) VALUES
	(3, 'Crazy Stuff todday', 'CRZ201', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;

-- Dumping data for table kust-cbt.departments: ~0 rows (approximately)
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `name`, `faculty_id`) VALUES
	(1, 'Crazy', 2);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping data for table kust-cbt.examination_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `examination_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `examination_users` ENABLE KEYS */;

-- Dumping data for table kust-cbt.faculties: ~2 rows (approximately)
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` (`id`, `name`, `code`) VALUES
	(1, 'Engineering', 'ENG'),
	(2, 'Social Sciences', 'SOC');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;



-- Dumping data for table kust-cbt.lock_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `lock_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lock_permissions` ENABLE KEYS */;



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

-- Dumping data for table kust-cbt.questions: ~74 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;


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

-- Dumping data for table kust-cbt.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `identity_no`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(5, 'Michael', 'Obi', '11110000', '$2y$10$//cE6mfM//BYgY/Q3MLfdextADvgtLgEY7nLetNyn2gacVWLL820G', 'hGBoW0XBPk5VZdXx6fInwdrweiF2Z7ldjW3G34vQRwe5ZMQrWzsORAnNf9vS', '2015-05-21 09:20:28', '2015-05-21 15:49:21'),
	(6, 'John', 'Doe', '00001111', '$2y$10$4OeSehW.GoExvNGyCOB3reJI5C7V8T5WJugZgJVI24GPduMMRhp2W', 'v90yjuh4YvJSQpSYHMX8WUqZehmlioYRmUOI43wWyNIyo0a1rFl8fgfSXIfi', '2015-05-21 09:20:28', '2015-05-21 09:27:34'),
	(7, 'Richard', 'Roe', '11111111', '$2y$10$u1XuYmeb4/G47fhPOWwB6.fKQ1Pkzdsn35IBpphpBVPyCSjIYG8lK', NULL, '2015-05-21 09:20:28', '2015-05-21 09:20:28'),
	(8, 'Jane', 'Doe', '22222222', '$2y$10$pD3Zz1XCJEMg7lUgug3gsOzKQeLHlgDRqVgwak48BC./Bh7WfJusq', 'aXEpt9cFHebmSwQqMvokkzrx7yV1PSiDBW3Jlm7IPwzJeq6083t83yOIHd0z', '2015-05-21 09:20:28', '2015-05-21 15:44:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
