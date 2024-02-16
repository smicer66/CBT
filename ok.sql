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

-- Dumping data for table kust-cbt.examinations: ~8 rows (approximately)
/*!40000 ALTER TABLE `examinations` DISABLE KEYS */;
INSERT INTO `examinations` (`id`, `title`, `no_of_questions`, `course_id`, `question_score_weight`, `exam_date`, `duration`, `status`, `deleted_at`, `created_at`, `updated_at`, `instructions`, `question_delivery`) VALUES
	(1, '', 21, 3, 1, '0000-00-00 00:00:00', 0, 'active', NULL, '2015-05-21 09:55:15', '2015-05-21 09:55:15', '', 'random'),
	(2, 'asdffa', 233, 3, NULL, '2015-05-21 00:00:00', 232, 'active', NULL, '2015-05-21 10:00:43', '2015-05-22 15:37:25', '', 'random'),
	(3, 'asdffa', 233, 3, NULL, '2015-05-21 00:00:00', 232, 'active', NULL, '2015-05-21 10:02:03', '2015-05-21 10:02:03', '', 'random'),
	(4, 'asdffa', 233, 3, NULL, '2015-05-21 00:00:00', 232, 'inactive', NULL, '2015-05-21 10:02:46', '2015-05-21 10:02:46', '', 'random'),
	(5, 'asdffa', 233, 3, NULL, '2015-05-21 00:00:00', 232, 'inactive', NULL, '2015-05-21 10:07:45', '2015-05-21 10:07:45', '', 'random'),
	(6, 'asdffa', 233, 3, NULL, '2015-05-21 00:00:00', 232, 'inactive', NULL, '2015-05-21 10:08:02', '2015-05-21 10:08:02', '', 'random'),
	(7, 'asdffa', 20, 3, 2, '2015-05-21 00:00:00', 232, 'inactive', NULL, '2015-05-21 10:09:53', '2015-05-21 10:09:53', '', 'random'),
	(8, 'Exam 1', 20, 3, 32, '2015-05-30 00:00:00', 2147483647, 'inactive', NULL, '2015-05-21 15:47:30', '2015-05-21 15:47:30', '', 'random');
/*!40000 ALTER TABLE `examinations` ENABLE KEYS */;

-- Dumping data for table kust-cbt.examination_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `examination_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `examination_users` ENABLE KEYS */;

-- Dumping data for table kust-cbt.faculties: ~2 rows (approximately)
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` (`id`, `name`, `code`) VALUES
	(1, 'Engineering', 'ENG'),
	(2, 'Social Sciences', 'SOC');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;

-- Dumping data for table kust-cbt.fileuploads: ~90 rows (approximately)
/*!40000 ALTER TABLE `fileuploads` DISABLE KEYS */;
INSERT INTO `fileuploads` (`id`, `filename`, `mime`, `original_filename`, `user_id`, `examination_id`, `created_at`, `updated_at`) VALUES
	(114, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:31:27', '2015-05-22 05:31:27'),
	(115, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:33:40', '2015-05-22 05:33:40'),
	(116, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:41:53', '2015-05-22 05:41:53'),
	(117, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:42:22', '2015-05-22 05:42:22'),
	(118, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:42:53', '2015-05-22 05:42:53'),
	(119, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:52:09', '2015-05-22 05:52:09'),
	(120, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:52:48', '2015-05-22 05:52:48'),
	(121, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:53:18', '2015-05-22 05:53:18'),
	(122, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:53:42', '2015-05-22 05:53:42'),
	(123, '7 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 7, '2015-05-22 05:55:05', '2015-05-22 05:55:05'),
	(124, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:10:32', '2015-05-22 07:10:32'),
	(125, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:11:20', '2015-05-22 07:11:20'),
	(126, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:11:56', '2015-05-22 07:11:56'),
	(127, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:12:19', '2015-05-22 07:12:19'),
	(128, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:13:08', '2015-05-22 07:13:08'),
	(129, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:13:43', '2015-05-22 07:13:43'),
	(130, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:18:11', '2015-05-22 07:18:11'),
	(131, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:19:18', '2015-05-22 07:19:18'),
	(132, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:21:00', '2015-05-22 07:21:00'),
	(133, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:25:07', '2015-05-22 07:25:07'),
	(134, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:27:21', '2015-05-22 07:27:21'),
	(135, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:28:08', '2015-05-22 07:28:08'),
	(136, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:29:05', '2015-05-22 07:29:05'),
	(137, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:29:52', '2015-05-22 07:29:52'),
	(138, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:30:58', '2015-05-22 07:30:58'),
	(139, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:31:23', '2015-05-22 07:31:23'),
	(140, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:40:41', '2015-05-22 07:40:41'),
	(141, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:40:58', '2015-05-22 07:40:58'),
	(142, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:43:15', '2015-05-22 07:43:15'),
	(143, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:43:50', '2015-05-22 07:43:50'),
	(144, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:44:17', '2015-05-22 07:44:17'),
	(145, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:44:55', '2015-05-22 07:44:55'),
	(146, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 07:46:24', '2015-05-22 07:46:24'),
	(147, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:35:52', '2015-05-22 08:35:52'),
	(148, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:36:30', '2015-05-22 08:36:30'),
	(149, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:36:50', '2015-05-22 08:36:50'),
	(150, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:37:23', '2015-05-22 08:37:23'),
	(151, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:39:22', '2015-05-22 08:39:22'),
	(152, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:39:50', '2015-05-22 08:39:50'),
	(153, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:40:29', '2015-05-22 08:40:29'),
	(154, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:41:13', '2015-05-22 08:41:13'),
	(155, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:42:05', '2015-05-22 08:42:05'),
	(156, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:42:22', '2015-05-22 08:42:22'),
	(157, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:43:15', '2015-05-22 08:43:15'),
	(158, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:45:45', '2015-05-22 08:45:45'),
	(159, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:45:56', '2015-05-22 08:45:56'),
	(160, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:46:51', '2015-05-22 08:46:51'),
	(161, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:47:23', '2015-05-22 08:47:23'),
	(162, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:47:42', '2015-05-22 08:47:42'),
	(163, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:48:11', '2015-05-22 08:48:11'),
	(164, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:48:43', '2015-05-22 08:48:43'),
	(165, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:48:57', '2015-05-22 08:48:57'),
	(166, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:49:12', '2015-05-22 08:49:12'),
	(167, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:50:33', '2015-05-22 08:50:33'),
	(168, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:50:55', '2015-05-22 08:50:55'),
	(169, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:54:17', '2015-05-22 08:54:17'),
	(170, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:57:42', '2015-05-22 08:57:42'),
	(171, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:58:25', '2015-05-22 08:58:25'),
	(172, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:59:05', '2015-05-22 08:59:05'),
	(173, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:59:28', '2015-05-22 08:59:28'),
	(174, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 08:59:49', '2015-05-22 08:59:49'),
	(175, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:00:16', '2015-05-22 09:00:16'),
	(176, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:02:48', '2015-05-22 09:02:48'),
	(177, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:03:00', '2015-05-22 09:03:00'),
	(178, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:04:02', '2015-05-22 09:04:02'),
	(179, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:04:49', '2015-05-22 09:04:49'),
	(180, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:07:09', '2015-05-22 09:07:09'),
	(181, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:07:51', '2015-05-22 09:07:51'),
	(182, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:08:15', '2015-05-22 09:08:15'),
	(183, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:09:17', '2015-05-22 09:09:17'),
	(184, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:10:00', '2015-05-22 09:10:00'),
	(185, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:10:53', '2015-05-22 09:10:53'),
	(186, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:11:28', '2015-05-22 09:11:28'),
	(187, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:12:55', '2015-05-22 09:12:55'),
	(188, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:13:19', '2015-05-22 09:13:19'),
	(189, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:13:44', '2015-05-22 09:13:44'),
	(190, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:14:16', '2015-05-22 09:14:16'),
	(191, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:14:39', '2015-05-22 09:14:39'),
	(192, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:14:57', '2015-05-22 09:14:57'),
	(193, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:16:09', '2015-05-22 09:16:09'),
	(194, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:16:36', '2015-05-22 09:16:36'),
	(195, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:17:27', '2015-05-22 09:17:27'),
	(196, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:18:42', '2015-05-22 09:18:42'),
	(197, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:18:56', '2015-05-22 09:18:56'),
	(198, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:19:54', '2015-05-22 09:19:54'),
	(199, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:20:57', '2015-05-22 09:20:57'),
	(200, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:23:50', '2015-05-22 09:23:50'),
	(201, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:24:31', '2015-05-22 09:24:31'),
	(202, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:26:02', '2015-05-22 09:26:02'),
	(203, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 09:26:47', '2015-05-22 09:26:47'),
	(204, '8 asdffa template (1).xls', 'application/vnd.ms-excel', 'asdffa template (1).xls', 5, 8, '2015-05-22 13:03:32', '2015-05-22 13:03:32'),
	(205, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 13:03:46', '2015-05-22 13:03:46'),
	(206, '8 Exam 1 template (1).xls', 'application/vnd.ms-excel', 'Exam 1 template (1).xls', 5, 8, '2015-05-22 13:06:01', '2015-05-22 13:06:01'),
	(207, '8 Exam 1 template (18).xls', 'application/vnd.ms-excel', 'Exam 1 template (18).xls', 5, 8, '2015-05-22 14:55:07', '2015-05-22 14:55:07');
/*!40000 ALTER TABLE `fileuploads` ENABLE KEYS */;

-- Dumping data for table kust-cbt.lock_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `lock_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `lock_permissions` ENABLE KEYS */;

-- Dumping data for table kust-cbt.migrations: ~14 rows (approximately)
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
	('2015_05_21_094845_add_fields_to_examinations_table', 2),
	('2015_05_21_132029_create_fileuploads_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping data for table kust-cbt.options: ~48 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `title`, `question_id`, `correct_answer`) VALUES
	(145, 'today', 108, 0),
	(146, 'tommoro', 108, 0),
	(147, 'next', 108, 0),
	(148, 'never', 108, 1),
	(149, '1892', 109, 0),
	(150, '1904', 109, 0),
	(151, '1960', 109, 1),
	(152, '1959', 109, 0),
	(153, 'today', 110, 0),
	(154, 'tommoro', 110, 0),
	(155, 'next', 110, 0),
	(156, 'never', 110, 1),
	(157, '1892', 111, 0),
	(158, '1904', 111, 0),
	(159, '1960', 111, 1),
	(160, '1959', 111, 0),
	(161, 'today', 112, 0),
	(162, 'tommoro', 112, 0),
	(163, 'next', 112, 0),
	(164, 'never', 112, 1),
	(165, '1892', 113, 0),
	(166, '1904', 113, 0),
	(167, '1960', 113, 1),
	(168, '1959', 113, 0),
	(169, 'today', 114, 0),
	(170, 'tommoro', 114, 0),
	(171, 'next', 114, 0),
	(172, 'never', 114, 1),
	(173, '1892', 115, 0),
	(174, '1904', 115, 0),
	(175, '1960', 115, 1),
	(176, '1959', 115, 0),
	(177, 'today', 116, 0),
	(178, 'tommoro', 116, 0),
	(179, 'next', 116, 0),
	(180, 'never', 116, 1),
	(181, '1892', 117, 0),
	(182, '1904', 117, 0),
	(183, '1960', 117, 1),
	(184, '1959', 117, 0),
	(185, 'today', 118, 0),
	(186, 'tommoro', 118, 0),
	(187, 'next', 118, 0),
	(188, 'never', 118, 1),
	(189, '1892', 119, 0),
	(190, '1904', 119, 0),
	(191, '1960', 119, 1),
	(192, '1959', 119, 0);
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

-- Dumping data for table kust-cbt.questions: ~74 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `type`, `title`, `examination_id`, `score_weight`) VALUES
	(46, 'single-choice', 'Hello', 8, 32),
	(47, 'single-choice', 'Hello', 8, 32),
	(48, 'single-choice', 'Hello', 8, 32),
	(49, 'single-choice', 'Hello', 8, 32),
	(50, 'single-choice', 'Hello', 8, 32),
	(51, 'single-choice', 'Hello', 8, 32),
	(52, 'single-choice', 'Hello', 8, 32),
	(53, 'single-choice', 'Hello', 8, 32),
	(54, 'single-choice', 'Hello', 8, 32),
	(55, 'single-choice', 'Hello', 8, 32),
	(56, 'single-choice', 'Hello', 8, 32),
	(57, 'single-choice', 'Hello', 7, 32),
	(58, 'single-choice', 'Hello', 7, 32),
	(59, 'single-choice', 'Hello', 7, 32),
	(60, 'single-choice', 'Hello', 7, 32),
	(61, 'single-choice', 'Hello', 7, 32),
	(62, 'single-choice', 'Hello', 7, 32),
	(63, 'single-choice', 'Hello', 7, 32),
	(64, 'single-choice', 'Hello', 7, 32),
	(65, 'single-choice', 'Hello', 7, 32),
	(66, 'single-choice', 'Hello', 7, 32),
	(67, 'single-choice', 'Hello', 7, 32),
	(68, 'single-choice', 'Hello', 8, 32),
	(69, 'single-choice', 'Hello', 8, 32),
	(70, 'single-choice', 'Hello', 8, 32),
	(71, 'single-choice', 'Hello', 8, 32),
	(72, 'single-choice', 'Hello', 8, 32),
	(73, 'single-choice', 'Hello', 8, 32),
	(74, 'single-choice', 'Hello', 8, 32),
	(75, 'single-choice', 'Hello', 8, 32),
	(76, 'single-choice', 'Hello', 8, 32),
	(77, 'single-choice', 'Hello', 8, 32),
	(78, 'single-choice', 'Hello', 8, 32),
	(79, 'single-choice', 'Hello', 8, 32),
	(80, 'single-choice', 'Hello', 8, 32),
	(81, 'single-choice', 'Hello', 8, 32),
	(82, 'single-choice', 'Hello', 8, 32),
	(83, 'single-choice', 'Hello', 8, 32),
	(84, 'single-choice', 'Hello', 8, 32),
	(85, 'single-choice', 'Hello', 8, 32),
	(86, 'single-choice', 'Hello', 8, 32),
	(87, 'single-choice', 'Hello', 8, 32),
	(88, 'single-choice', 'Hello', 8, 32),
	(89, 'single-choice', 'Hello', 8, 32),
	(90, 'single-choice', 'Hello', 8, 32),
	(91, 'single-choice', 'Hello', 8, 32),
	(92, 'single-choice', 'Hello', 8, 32),
	(93, 'single-choice', 'Hello', 8, 32),
	(94, 'single-choice', 'Hello', 8, 32),
	(95, 'single-choice', 'Hello', 8, 32),
	(96, 'single-choice', 'Hello', 8, 32),
	(97, 'single-choice', 'Hello', 8, 32),
	(98, 'single-choice', 'Hello', 8, 32),
	(99, 'single-choice', 'Hello', 8, 32),
	(100, 'single-choice', 'Hello', 8, 32),
	(101, 'single-choice', 'Nigerian Independence', 8, 12),
	(102, 'single-choice', 'Hello', 8, 32),
	(103, 'single-choice', 'Nigerian Independence', 8, 65),
	(104, 'single-choice', 'Hello', 8, 32),
	(105, 'single-choice', 'Nigerian Independence', 8, 12),
	(106, 'single-choice', 'Hello', 8, 32),
	(107, 'single-choice', 'Nigerian Independence', 8, 65),
	(108, 'single-choice', 'Hello', 8, 32),
	(109, 'single-choice', 'Nigerian Independence', 8, 12),
	(110, 'single-choice', 'Hello', 8, 32),
	(111, 'single-choice', 'Nigerian Independence', 8, 65),
	(112, 'single-choice', 'Hello', 8, 32),
	(113, 'single-choice', 'Nigerian Independence', 8, 12),
	(114, 'single-choice', 'Hello', 8, 32),
	(115, 'single-choice', 'Nigerian Independence', 8, 65),
	(116, 'single-choice', 'Hello', 8, 32),
	(117, 'single-choice', 'Nigerian Independence', 8, 12),
	(118, 'single-choice', 'Hello', 8, 32),
	(119, 'single-choice', 'Nigerian Independence', 8, 65);
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
