-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2019 at 05:41 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `swaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `attachment_id` int(11) NOT NULL,
  `attachment_type` int(11) DEFAULT '0' COMMENT '1. images 2. videos',
  `attachment_url` text,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_groups`
--

CREATE TABLE `chat_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL DEFAULT '',
  `group_description` text,
  `created_by_user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_groups`
--

INSERT INTO `chat_groups` (`id`, `group_name`, `group_description`, `created_by_user_id`, `created_at`, `updated_at`, `group_profile_image`) VALUES
(7, 'okay group', 'group', 3, '2019-10-15 05:07:45', '2019-10-15 05:07:45', NULL),
(8, 'Nothing', 'Nothing', 3, '2019-10-15 05:10:01', '2019-10-15 05:10:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `f_id` int(10) UNSIGNED NOT NULL,
  `followed_user_id` int(11) NOT NULL,
  `follower_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`f_id`, `followed_user_id`, `follower_user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 3, NULL, NULL),
(2, 5, 3, NULL, NULL),
(3, 3, 88, NULL, NULL),
(14, 3, 8, '2018-12-20 13:15:47', '2018-12-20 13:15:47'),
(16, 8, 3, '2019-01-13 02:42:19', '2019-01-13 02:42:19'),
(18, 6, 3, '2019-01-13 11:56:00', '2019-01-13 11:56:00'),
(19, 8, 9, '2019-01-15 12:29:55', '2019-01-15 12:29:55'),
(20, 6, 9, '2019-01-15 12:29:59', '2019-01-15 12:29:59'),
(21, 3, 9, '2019-01-15 12:30:02', '2019-01-15 12:30:02'),
(22, 5, 9, '2019-01-15 12:30:05', '2019-01-15 12:30:05'),
(23, 4, 9, '2019-01-15 12:30:07', '2019-01-15 12:30:07'),
(50, 3, 10, '2019-01-16 02:28:25', '2019-01-16 02:28:25'),
(51, 4, 10, '2019-01-16 02:28:27', '2019-01-16 02:28:27'),
(52, 6, 10, '2019-01-16 02:28:29', '2019-01-16 02:28:29'),
(53, 5, 10, '2019-01-16 02:28:31', '2019-01-16 02:28:31'),
(54, 8, 10, '2019-01-16 02:28:33', '2019-01-16 02:28:33'),
(55, 3, 13, '2019-01-17 02:08:56', '2019-01-17 02:08:56'),
(56, 4, 13, '2019-01-17 02:08:58', '2019-01-17 02:08:58'),
(57, 5, 13, '2019-01-17 02:09:02', '2019-01-17 02:09:02'),
(58, 8, 13, '2019-01-17 02:09:04', '2019-01-17 02:09:04'),
(59, 11, 13, '2019-01-17 02:09:06', '2019-01-17 02:09:06'),
(60, 10, 13, '2019-01-17 02:09:08', '2019-01-17 02:09:08'),
(61, 6, 13, '2019-01-17 02:09:15', '2019-01-17 02:09:15'),
(62, 3, 11, '2019-01-17 02:14:04', '2019-01-17 02:14:04'),
(63, 5, 11, '2019-01-17 02:14:05', '2019-01-17 02:14:05'),
(64, 8, 11, '2019-01-17 02:14:06', '2019-01-17 02:14:06'),
(65, 10, 11, '2019-01-17 02:14:07', '2019-01-17 02:14:07'),
(66, 9, 11, '2019-01-17 02:14:09', '2019-01-17 02:14:09'),
(67, 4, 11, '2019-01-17 02:14:10', '2019-01-17 02:14:10'),
(68, 3, 12, '2019-01-17 02:38:11', '2019-01-17 02:38:11'),
(69, 5, 12, '2019-01-17 02:38:12', '2019-01-17 02:38:12'),
(70, 8, 12, '2019-01-17 02:38:14', '2019-01-17 02:38:14'),
(71, 4, 12, '2019-01-17 02:38:15', '2019-01-17 02:38:15'),
(72, 9, 12, '2019-01-17 02:38:16', '2019-01-17 02:38:16'),
(73, 3, 14, '2019-01-17 06:41:28', '2019-01-17 06:41:28'),
(74, 5, 14, '2019-01-17 06:41:29', '2019-01-17 06:41:29'),
(75, 4, 14, '2019-01-17 06:41:30', '2019-01-17 06:41:30'),
(76, 8, 14, '2019-01-17 06:41:32', '2019-01-17 06:41:32'),
(77, 9, 14, '2019-01-17 06:41:38', '2019-01-17 06:41:38'),
(78, 6, 14, '2019-01-17 06:41:41', '2019-01-17 06:41:41'),
(79, 12, 14, '2019-01-17 06:44:04', '2019-01-17 06:44:04'),
(80, 11, 14, '2019-01-17 06:44:06', '2019-01-17 06:44:06'),
(81, 10, 14, '2019-01-17 06:44:07', '2019-01-17 06:44:07'),
(82, 13, 14, '2019-01-17 06:44:11', '2019-01-17 06:44:11'),
(83, 3, 15, '2019-01-17 06:45:05', '2019-01-17 06:45:05'),
(84, 5, 15, '2019-01-17 06:45:06', '2019-01-17 06:45:06'),
(85, 8, 15, '2019-01-17 06:45:07', '2019-01-17 06:45:07'),
(86, 6, 15, '2019-01-17 06:45:08', '2019-01-17 06:45:08'),
(87, 4, 15, '2019-01-17 06:45:09', '2019-01-17 06:45:09'),
(88, 3, 16, '2019-01-17 06:51:02', '2019-01-17 06:51:02'),
(89, 5, 16, '2019-01-17 06:51:04', '2019-01-17 06:51:04'),
(90, 8, 16, '2019-01-17 06:51:05', '2019-01-17 06:51:05'),
(91, 10, 16, '2019-01-17 06:51:07', '2019-01-17 06:51:07'),
(92, 6, 16, '2019-01-17 06:51:09', '2019-01-17 06:51:09'),
(93, 4, 17, '2019-01-17 06:55:20', '2019-01-17 06:55:20'),
(94, 6, 17, '2019-01-17 06:55:21', '2019-01-17 06:55:21'),
(95, 8, 17, '2019-01-17 06:55:21', '2019-01-17 06:55:21'),
(96, 9, 17, '2019-01-17 06:55:23', '2019-01-17 06:55:23'),
(97, 10, 17, '2019-01-17 06:55:25', '2019-01-17 06:55:25'),
(98, 3, 18, '2019-01-17 06:59:01', '2019-01-17 06:59:01'),
(99, 5, 18, '2019-01-17 06:59:02', '2019-01-17 06:59:02'),
(100, 4, 18, '2019-01-17 06:59:03', '2019-01-17 06:59:03'),
(101, 9, 18, '2019-01-17 06:59:04', '2019-01-17 06:59:04'),
(102, 8, 18, '2019-01-17 06:59:05', '2019-01-17 06:59:05'),
(103, 3, 19, '2019-01-17 07:08:29', '2019-01-17 07:08:29'),
(104, 4, 19, '2019-01-17 07:08:39', '2019-01-17 07:08:39'),
(105, 5, 19, '2019-01-17 07:08:44', '2019-01-17 07:08:44'),
(106, 9, 19, '2019-01-17 07:08:46', '2019-01-17 07:08:46'),
(109, 8, 19, '2019-01-17 07:11:43', '2019-01-17 07:11:43'),
(110, 3, 27, '2019-04-10 04:48:51', '2019-04-10 04:48:51'),
(111, 5, 27, '2019-04-10 04:48:53', '2019-04-10 04:48:53'),
(112, 8, 27, '2019-04-10 04:48:55', '2019-04-10 04:48:55'),
(113, 10, 27, '2019-04-10 04:48:57', '2019-04-10 04:48:57'),
(114, 12, 27, '2019-04-10 04:48:59', '2019-04-10 04:48:59'),
(115, 9, 3, '2019-06-06 03:24:32', '2019-06-06 03:24:32'),
(116, 11, 3, '2019-06-06 03:24:33', '2019-06-06 03:24:33'),
(117, 18, 3, '2019-06-06 03:24:37', '2019-06-06 03:24:37'),
(118, 19, 3, '2019-06-06 03:24:39', '2019-06-06 03:24:39'),
(119, 17, 3, '2019-06-06 03:24:41', '2019-06-06 03:24:41'),
(120, 9, 28, '2019-10-03 00:19:22', '2019-10-03 00:19:22'),
(121, 8, 28, '2019-10-03 00:19:28', '2019-10-03 00:19:28'),
(122, 14, 28, '2019-10-03 00:19:32', '2019-10-03 00:19:32'),
(123, 19, 28, '2019-10-03 00:19:35', '2019-10-03 00:19:35'),
(124, 4, 28, '2019-10-03 00:19:44', '2019-10-03 00:19:44'),
(125, 3, 29, '2019-10-03 00:49:09', '2019-10-03 00:49:09'),
(126, 28, 29, '2019-10-03 00:49:41', '2019-10-03 00:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `group_messages`
--

CREATE TABLE `group_messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_messages`
--

INSERT INTO `group_messages` (`id`, `message`, `sender_id`, `created_at`, `updated_at`, `group_id`) VALUES
(1, 'https://www.google.com Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.\nThe passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts \nof Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 3, NULL, NULL, 1),
(2, 'https://www.google.com Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 8, NULL, NULL, 1),
(3, 'Hi', 6, NULL, NULL, 1),
(4, 'Hi', 4, NULL, NULL, 1),
(5, 'Hi', 29, NULL, NULL, 1),
(6, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero\'s De Finibus Bonorum et Malorum for use in a type specimen book.', 5, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_participants`
--

CREATE TABLE `group_participants` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `participant_user_id` int(11) NOT NULL DEFAULT '0',
  `invited_by_user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_participants`
--

INSERT INTO `group_participants` (`id`, `group_id`, `participant_user_id`, `invited_by_user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 0, NULL, NULL),
(2, 1, 29, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL DEFAULT '0',
  `reciever_id` int(11) NOT NULL DEFAULT '0',
  `chat_id` int(11) DEFAULT '0',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'The message is empty.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `is_forwarded` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_id`, `sender_id`, `reciever_id`, `chat_id`, `message`, `created_at`, `updated_at`, `is_read`, `is_forwarded`) VALUES
(43, 3, 0, 2, 'desciption of the group', '2019-10-15 05:27:49', '2019-10-15 05:27:49', 0, 0),
(44, 3, 0, 2, 'desciption of the group', '2019-10-15 05:28:13', '2019-10-15 05:28:13', 0, 0),
(45, 3, 0, 11, 'desciption of the group', '2019-10-15 05:33:40', '2019-10-15 05:33:40', 0, 0),
(46, 3, 0, 11, 'added in real time.', '2019-10-15 05:44:16', '2019-10-15 05:44:16', 0, 0),
(47, 3, 0, 11, 'again added in real time.', '2019-10-15 05:47:59', '2019-10-15 05:47:59', 0, 0),
(48, 3, 0, 11, 'wow, it is working..', '2019-10-15 05:48:16', '2019-10-15 05:48:16', 0, 0),
(49, 3, 0, 11, 'well done.', '2019-10-15 05:50:16', '2019-10-15 05:50:16', 0, 0),
(50, 8, 0, 11, 'well done.', '2019-10-15 05:50:16', '2019-10-15 05:50:16', 0, 0),
(51, 3, 0, 11, 'hello', '2019-10-15 05:53:31', '2019-10-15 05:53:31', 0, 0),
(52, 0, 0, 0, 'The message is empty.', NULL, NULL, 0, 0),
(53, 3, 5, 2, 'hi', '2019-10-17 01:36:08', '2019-10-17 01:36:08', 0, 0),
(54, 3, 8, 1, 'well done.', '2019-10-17 06:16:39', '2019-10-17 06:16:39', 0, 1),
(55, 3, 8, 13, 'well done.', '2019-10-17 06:17:23', '2019-10-17 06:17:23', 0, 1),
(56, 3, 4, 14, 'well done.', '2019-10-17 06:41:36', '2019-10-17 06:41:36', 0, 1),
(57, 3, 4, 14, 'well done.', '2019-10-17 06:42:31', '2019-10-17 06:42:31', 0, 1),
(58, 3, 5, 2, 'well done.', '2019-10-17 06:42:34', '2019-10-17 06:42:34', 0, 1),
(59, 3, 8, 13, 'well done.', '2019-10-17 06:42:36', '2019-10-17 06:42:36', 0, 1),
(60, 3, 19, 15, 'well done.', '2019-10-17 06:42:39', '2019-10-17 06:42:39', 0, 1),
(61, 19, 3, 15, 'Iam well as well.', '2019-10-17 06:42:39', '2019-10-17 06:42:39', 0, 1),
(62, 19, 3, 15, 'What about you?', '2019-10-17 06:42:39', '2019-10-17 06:42:39', 0, 0),
(63, 0, 0, 0, 'The message is empty.', NULL, NULL, 0, 0),
(64, 3, 4, 14, 'What about you?', '2019-10-18 02:31:46', '2019-10-18 02:31:46', 0, 1),
(65, 3, 5, 2, 'What about you?', '2019-10-18 02:31:48', '2019-10-18 02:31:48', 0, 1),
(66, 3, 8, 13, 'What about you?', '2019-10-18 02:31:50', '2019-10-18 02:31:50', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_12_04_135211_create_statuses_table', 1),
(2, '2018_12_04_135849_create_swaps_table', 1),
(3, '2018_12_04_162721_create_rattings_table', 1),
(4, '2018_12_04_162834_create_followers_table', 1),
(5, '2018_12_04_163007_create_participants_table', 1),
(6, '2018_12_04_163109_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `isStatus` tinyint(1) DEFAULT '0',
  `isFollow` tinyint(1) DEFAULT '0',
  `isFollowed` tinyint(1) DEFAULT '0',
  `isSwap` tinyint(1) DEFAULT '0',
  `isDeclined` tinyint(1) DEFAULT '0',
  `status_id` int(11) DEFAULT '0',
  `followed_id` int(11) DEFAULT '0',
  `follower_id` int(11) DEFAULT '0',
  `isAccepted` tinyint(1) DEFAULT '0',
  `swaper_id` int(11) DEFAULT '0',
  `swaped_with_id` int(11) DEFAULT '0',
  `isViewed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `swap_id` int(11) DEFAULT NULL,
  `is_accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `isStatus`, `isFollow`, `isFollowed`, `isSwap`, `isDeclined`, `status_id`, `followed_id`, `follower_id`, `isAccepted`, `swaper_id`, `swaped_with_id`, `isViewed`, `created_at`, `updated_at`, `swap_id`, `is_accepted`) VALUES
(1, 1, 0, 0, 0, 0, 7, 0, 0, 0, 3, 4, 0, '2018-12-15 04:56:39', '2018-12-15 04:56:39', NULL, NULL),
(5, 1, 0, 0, 0, 0, 12, 0, 0, 1, 8, 3, 0, '2018-12-16 11:15:22', '2018-12-16 06:15:22', 6, 0),
(7, 1, 0, 0, 0, 0, 7, 0, 0, 1, 3, 8, 0, '2018-12-17 11:19:58', '2018-12-17 06:19:58', 7, 0),
(8, 1, 0, 0, 0, 0, 10, 0, 0, 1, 8, 3, 0, '2019-07-06 07:17:26', '2019-07-06 02:17:26', 8, 0),
(9, 1, 0, 0, 0, 0, 13, 0, 0, 1, 3, 8, 0, '2018-12-17 11:22:27', '2018-12-17 06:22:27', 9, 0),
(10, 1, 0, 0, 0, 0, 15, 0, 0, 1, 8, 3, 0, '2018-12-21 04:44:24', '2018-12-20 23:44:24', 10, 0),
(11, 1, 0, 0, 0, 0, 22, 0, 0, 0, 3, 8, 0, '2019-06-16 00:26:42', '2019-06-16 00:26:42', 11, 0),
(12, 1, 0, 0, 0, 0, 10, 0, 0, 0, 3, 8, 0, '2019-10-01 23:12:07', '2019-10-01 23:12:07', 13, 0),
(13, 1, 0, 0, 0, 0, 15, 0, 0, 0, 28, 8, 0, '2019-10-03 00:22:41', '2019-10-03 00:22:41', 14, 0),
(14, 1, 0, 0, 0, 0, 44, 0, 0, 1, 29, 28, 0, '2019-10-03 05:50:56', '2019-10-03 00:50:56', 15, 0),
(15, 1, 0, 0, 0, 0, 43, 0, 0, 0, 29, 3, 0, '2019-10-03 00:58:25', '2019-10-03 00:58:25', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `chat_id` int(10) UNSIGNED NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_group` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `invited_by_user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`chat_id`, `user_one`, `user_two`, `created_at`, `updated_at`, `is_group`, `group_id`, `invited_by_user_id`) VALUES
(2, 5, 3, NULL, NULL, 0, NULL, 0),
(4, 29, 28, '2019-10-12 05:00:47', '2019-10-12 05:00:47', 0, 0, 0),
(10, 3, 3, '2019-10-15 05:07:45', '2019-10-15 05:07:45', 1, 7, 0),
(11, 3, 3, '2019-10-15 05:10:01', '2019-10-15 05:10:01', 1, 8, 0),
(12, 8, 8, '2019-10-15 05:10:01', '2019-10-15 05:10:01', 1, 8, 0),
(13, 3, 8, '2019-10-17 06:17:23', '2019-10-17 06:17:23', 0, 0, 0),
(14, 3, 4, '2019-10-17 06:41:36', '2019-10-17 06:41:36', 0, 0, 0),
(15, 3, 19, '2019-10-17 06:42:39', '2019-10-17 06:42:39', 0, 0, 0),
(16, 29, 29, '2019-10-21 00:26:40', '2019-10-21 00:26:40', 1, 8, 0),
(17, 9, 9, '2019-10-21 00:37:51', '2019-10-21 00:37:51', 1, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rattings`
--

CREATE TABLE `rattings` (
  `ratting_id` int(10) UNSIGNED NOT NULL,
  `ratted_by_user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `ratting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rattings`
--

INSERT INTO `rattings` (`ratting_id`, `ratted_by_user_id`, `status_id`, `ratting`, `created_at`, `updated_at`) VALUES
(5, 3, 2, 3, NULL, NULL),
(10, 3, 4, 3, NULL, NULL),
(11, 3, 4, 5, NULL, NULL),
(12, 3, 4, 3, NULL, NULL),
(13, 3, 7, 4, '2018-12-11 03:05:17', '2018-12-13 03:10:00'),
(17, 3, 6, 3, '2018-12-12 07:05:09', '2018-12-13 03:09:33'),
(18, 3, 5, 4, '2018-12-12 07:06:35', '2018-12-12 07:06:42'),
(19, 8, 7, 5, '2018-12-15 12:45:24', '2018-12-15 12:45:56'),
(20, 8, 6, 5, '2018-12-15 12:52:33', '2018-12-15 12:52:33'),
(23, 8, 12, 5, '2018-12-15 15:11:17', '2018-12-15 15:13:20'),
(24, 3, 12, 3, '2018-12-16 02:51:58', '2018-12-16 03:03:02'),
(25, 8, 10, 4, '2018-12-16 08:12:06', '2018-12-16 08:12:06'),
(26, 8, 13, 5, '2018-12-17 06:23:06', '2018-12-18 06:36:01'),
(27, 3, 13, 3, '2018-12-18 10:25:09', '2019-06-16 00:26:27'),
(28, 3, 15, 2, '2018-12-20 23:44:30', '2018-12-20 23:44:44'),
(31, 27, 21, 4, '2019-04-10 05:04:52', '2019-04-10 05:04:52'),
(32, 3, 24, 4, '2019-06-21 05:46:02', '2019-06-21 05:46:02'),
(33, 3, 25, 3, '2019-06-21 05:49:20', '2019-06-21 05:56:57'),
(34, 3, 26, 4, '2019-06-25 05:08:05', '2019-06-25 05:08:05'),
(35, 3, 28, 2, '2019-07-06 02:12:23', '2019-07-06 04:54:57'),
(36, 28, 15, 3, '2019-10-03 00:21:00', '2019-10-03 00:21:00'),
(37, 29, 44, 3, '2019-10-03 00:53:04', '2019-10-03 00:53:04'),
(38, 29, 45, 4, '2019-10-12 05:04:52', '2019-10-12 05:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `posting_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_attachment` int(11) NOT NULL DEFAULT '0',
  `attachments` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `user_id`, `status`, `created_at`, `updated_at`, `posting_time`, `has_attachment`, `attachments`) VALUES
(2, 3, 'hello', '2018-12-06 12:59:41', '2018-12-06 12:59:41', NULL, 0, ''),
(4, 3, 'sjsj', '2018-12-07 05:25:15', '2018-12-07 05:25:15', NULL, 0, ''),
(5, 3, 'sjsj', '2018-12-07 05:25:23', '2018-12-07 05:25:23', NULL, 0, ''),
(6, 3, 'hooo', '2018-12-07 05:42:53', '2018-12-07 05:42:53', NULL, 0, ''),
(7, 3, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31547377272.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31547377282.png\",\"attachment_type\":1}]'),
(8, 4, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 0, ''),
(10, 8, 'this my post  from hfm account.', '2018-12-15 17:33:43', '2018-12-15 17:33:43', '1544895223', 0, ''),
(12, 8, 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', '2018-12-15 19:38:46', '2018-12-15 19:38:46', '1544902726', 0, ''),
(13, 3, 'newest post.', '2018-12-17 11:21:06', '2018-12-17 11:21:06', '1545045666', 0, ''),
(14, 8, 'greate to see you here.', '2018-12-20 17:47:32', '2018-12-20 17:47:32', '1545328052', 0, ''),
(15, 8, 'here is the status. do you like it?', '2018-12-21 04:42:59', '2018-12-21 04:42:59', '1545367379', 0, ''),
(16, 3, 'something is posted. from the new logic of activity.', '2018-12-25 08:52:54', '2018-12-25 08:52:54', '1545727974', 0, ''),
(17, 3, 'hello', '2018-12-26 14:36:45', '2018-12-26 14:36:45', '1545835005', 0, ''),
(18, 3, 'hello', '2018-12-26 14:37:05', '2018-12-26 14:37:05', '1545835025', 0, ''),
(19, 3, 'hello', '2019-01-13 10:59:50', '2019-01-13 10:59:50', '1547377190', 0, NULL),
(20, 3, 'hello', '2019-01-13 11:00:14', '2019-01-13 11:00:14', '1547377214', 0, NULL),
(21, 3, 'this is post with image.', '2019-01-13 11:01:11', '2019-01-13 06:01:22', '1547377271', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31547377272.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31547377282.png\",\"attachment_type\":1}]'),
(23, 27, 'this is my new status from facebook social account.', '2019-04-10 10:03:32', '2019-04-10 10:03:32', '1554890612', 0, NULL),
(24, 3, 'hello image.', '2019-06-18 04:24:06', '2019-06-17 23:24:08', '1560831846', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31560831848.png\",\"attachment_type\":1}]'),
(25, 3, 'hello....', '2019-06-21 10:48:55', '2019-06-21 10:48:55', '1561114135', 0, NULL),
(26, 3, 'Hello this is status with 3 images.', '2019-06-23 05:25:13', '2019-06-23 00:25:34', '1561267513', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31561267514.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31561267524.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31561267534.png\",\"attachment_type\":1}]'),
(27, 3, 'how are you?', '2019-07-06 07:10:49', '2019-07-06 07:10:49', '1562397049', 0, NULL),
(28, 3, 'testing from real device.', '2019-07-06 07:11:58', '2019-07-06 02:12:08', '1562397118', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31562397118.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31562397128.png\",\"attachment_type\":1}]'),
(30, 3, 'this is camera taken + uploaded image.', '2019-07-06 09:00:21', '2019-07-06 04:00:32', '1562403621', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31562403621.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31562403632.png\",\"attachment_type\":1}]'),
(31, 3, 'hello', '2019-07-06 09:08:21', '2019-07-06 09:08:21', '1562404101', 0, NULL),
(32, 3, 'hello.', '2019-07-12 17:03:07', '2019-07-12 12:03:07', '1562950987', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/videos\\/irfi31562950987.mp4\",\"attachment_type\":2}]'),
(37, 3, 'checking video....', '2019-07-16 09:56:36', '2019-07-16 09:56:36', '1563270996', 0, NULL),
(38, 3, 'again', '2019-07-16 10:17:33', '2019-07-16 10:17:33', '1563272253', 0, NULL),
(39, 3, 'bya ye wagora', '2019-07-16 10:20:18', '2019-07-16 10:20:18', '1563272418', 0, NULL),
(40, 3, 'ok', '2019-07-16 10:31:00', '2019-07-16 10:31:00', '1563273060', 0, NULL),
(41, 3, 'welcome', '2019-07-16 10:56:33', '2019-07-16 05:56:43', '1563274593', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/videos\\/irfi31563274603.mp4\",\"attachment_type\":2}]'),
(42, 3, 'going good.', '2019-07-16 11:02:30', '2019-07-16 06:02:31', '1563274950', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31563274951.png\",\"attachment_type\":1}]'),
(43, 3, 'it is post with picture and video.', '2019-07-23 09:13:15', '2019-07-23 04:13:45', '1563873195', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/statuses\\/images\\/irfi31563873196.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.4\\/swap\\/public\\/videos\\/irfi31563873225.mp4\",\"attachment_type\":2}]'),
(44, 28, 'This is my first testing status.', '2019-10-03 05:25:05', '2019-10-03 05:25:05', '1570080305', 0, NULL),
(45, 29, 'It is my first post.', '2019-10-03 05:59:40', '2019-10-03 00:59:51', '1570082380', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/pakaffairs 291570082380.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/pakaffairs 291570082391.png\",\"attachment_type\":1}]'),
(46, 3, 'Hello, this is post with tagged users.', '2019-10-24 05:39:14', '2019-10-24 05:39:14', '1571895554', 0, NULL),
(47, 3, 'Hello, this is post without users tagged.', '2019-10-24 05:39:51', '2019-10-24 05:39:51', '1571895591', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statuslikes`
--

CREATE TABLE `statuslikes` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuslikes`
--

INSERT INTO `statuslikes` (`id`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 19, 3, '2019-04-07 00:38:45', '2019-04-07 00:38:45'),
(6, 20, 3, '2019-04-07 00:59:40', '2019-04-07 00:59:40'),
(8, 18, 3, '2019-04-07 01:02:34', '2019-04-07 01:02:34'),
(10, 22, 3, '2019-04-07 01:33:29', '2019-04-07 01:33:29'),
(13, 15, 3, '2019-04-08 00:15:04', '2019-04-08 00:15:04'),
(14, 22, 27, '2019-04-10 04:49:56', '2019-04-10 04:49:56'),
(16, 21, 27, '2019-04-10 05:04:15', '2019-04-10 05:04:15'),
(17, 20, 27, '2019-04-10 05:04:20', '2019-04-10 05:04:20'),
(18, 23, 27, '2019-04-10 05:06:19', '2019-04-10 05:06:19'),
(19, 21, 3, '2019-06-16 01:12:03', '2019-06-16 01:12:03'),
(21, 24, 3, '2019-06-21 05:48:07', '2019-06-21 05:48:07'),
(22, 26, 3, '2019-06-25 05:08:42', '2019-06-25 05:08:42'),
(23, 28, 3, '2019-07-06 02:12:31', '2019-07-06 02:12:31'),
(24, 36, 3, '2019-07-16 04:49:25', '2019-07-16 04:49:25'),
(25, 10, 3, '2019-10-01 23:10:51', '2019-10-01 23:10:51'),
(26, 9, 3, '2019-10-01 23:11:24', '2019-10-01 23:11:24'),
(27, 44, 29, '2019-10-03 00:53:09', '2019-10-03 00:53:09'),
(28, 45, 29, '2019-10-12 05:04:37', '2019-10-12 05:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `status_comments`
--

CREATE TABLE `status_comments` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_comments`
--

INSERT INTO `status_comments` (`id`, `status_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 20, 3, 'this is the first comment', '2019-04-09 02:07:07', '2019-04-09 02:07:07'),
(2, 21, 3, 'this is the first comment.', '2019-04-09 02:07:18', '2019-04-09 02:07:18'),
(3, 22, 3, 'this is my comment. Just checking whether it is working or not.', '2019-04-10 00:55:53', '2019-04-10 00:55:53'),
(4, 22, 27, 'hello this comment from social account.', '2019-04-10 04:50:13', '2019-04-10 04:50:13'),
(5, 21, 27, 'good one', '2019-04-10 04:51:19', '2019-04-10 04:51:19'),
(6, 21, 27, 'another comment.', '2019-04-10 05:05:25', '2019-04-10 05:05:25'),
(7, 21, 3, 'hello', '2019-06-15 05:31:17', '2019-06-15 05:31:17'),
(8, 24, 3, 'my comment', '2019-06-21 05:47:01', '2019-06-21 05:47:01'),
(9, 28, 3, 'nice one bro.', '2019-07-06 02:12:51', '2019-07-06 02:12:51'),
(10, 36, 3, 'I am not supposed to tell you this.', '2019-07-16 04:49:57', '2019-07-16 04:49:57'),
(11, 43, 3, '43', '2019-09-28 04:20:07', '2019-09-28 04:20:07'),
(12, 43, 3, '45', '2019-09-28 04:21:20', '2019-09-28 04:21:20'),
(13, 43, 3, 'This is testing comment on the test post, after changing the functionality to realtime comment. Once the comment is posted, through interface a response is recieved back to the activity and another request is made to fetch back comments again.', '2019-09-28 04:58:17', '2019-09-28 04:58:17'),
(14, 9, 3, 'Checking..', '2019-10-01 23:11:38', '2019-10-01 23:11:38'),
(15, 15, 28, 'It is great.', '2019-10-03 00:20:24', '2019-10-03 00:20:24'),
(16, 44, 29, 'it is not. Right.', '2019-10-03 00:54:55', '2019-10-03 00:54:55'),
(17, 15, 3, 'It is real time comment demo', '2019-10-03 07:26:27', '2019-10-03 07:26:27'),
(18, 15, 3, 'it is comment.', '2019-10-03 07:33:45', '2019-10-03 07:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `status_shares`
--

CREATE TABLE `status_shares` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_shares`
--

INSERT INTO `status_shares` (`id`, `status_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 21, 3, NULL, '2019-04-06 13:52:20', '2019-04-06 13:52:20'),
(2, 20, 3, NULL, '2019-04-07 00:38:40', '2019-04-07 00:38:40'),
(3, 15, 3, NULL, '2019-04-07 01:20:34', '2019-04-07 01:20:34'),
(4, 20, 27, NULL, '2019-04-10 05:04:25', '2019-04-10 05:04:25'),
(5, 22, 3, NULL, '2019-07-04 04:57:28', '2019-07-04 04:57:28'),
(6, 45, 29, NULL, '2019-10-12 05:05:08', '2019-10-12 05:05:08'),
(7, 43, 29, NULL, '2019-10-12 05:44:21', '2019-10-12 05:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `status_tags`
--

CREATE TABLE `status_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `tagged_user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_tags`
--

INSERT INTO `status_tags` (`id`, `status_id`, `tagged_user_id`, `created_at`, `updated_at`) VALUES
(1, 46, 4, '2019-10-24 05:39:14', '2019-10-24 05:39:14'),
(2, 46, 5, '2019-10-24 05:39:14', '2019-10-24 05:39:14'),
(3, 46, 8, '2019-10-24 05:39:14', '2019-10-24 05:39:14'),
(4, 46, 6, '2019-10-24 05:39:14', '2019-10-24 05:39:14'),
(5, 46, 9, '2019-10-24 05:39:14', '2019-10-24 05:39:14');

-- --------------------------------------------------------

--
-- Table structure for table `swaps`
--

CREATE TABLE `swaps` (
  `swap_id` int(10) UNSIGNED NOT NULL,
  `poster_user_id` int(11) NOT NULL,
  `swaped_with_user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `is_accepted` int(11) DEFAULT '0',
  `is_rejected` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `swaps`
--

INSERT INTO `swaps` (`swap_id`, `poster_user_id`, `swaped_with_user_id`, `created_at`, `updated_at`, `status_id`, `is_accepted`, `is_rejected`) VALUES
(1, 3, 4, '2018-12-12 11:16:56', '2018-12-12 11:16:56', 6, 0, 1),
(3, 3, 4, '2018-12-15 04:56:38', '2018-12-15 04:56:38', 7, 1, 0),
(4, 3, 4, '2018-12-15 04:56:38', '2018-12-15 04:56:38', 6, 1, 0),
(6, 8, 3, '2018-12-15 15:06:30', '2018-12-16 06:15:22', 12, 1, 0),
(7, 3, 8, '2018-12-17 06:08:20', '2018-12-17 06:19:58', 7, 1, 0),
(8, 8, 3, '2018-12-17 06:18:13', '2018-12-17 06:18:13', 10, 0, 0),
(9, 3, 8, '2018-12-17 06:21:30', '2018-12-17 06:22:27', 13, 1, 0),
(10, 8, 3, '2018-12-20 23:43:34', '2018-12-20 23:44:24', 15, 1, 0),
(12, 3, 4, '2019-07-06 02:17:26', '2019-07-06 02:17:26', 7, 1, 0),
(13, 3, 8, '2019-10-01 23:12:07', '2019-10-01 23:12:07', 10, 0, 0),
(14, 28, 8, '2019-10-03 00:22:41', '2019-10-03 00:22:41', 15, 0, 0),
(15, 29, 28, '2019-10-03 00:49:56', '2019-10-03 00:49:56', 44, 0, 0),
(16, 3, 4, '2019-10-03 00:50:56', '2019-10-03 00:50:56', 7, 1, 0),
(17, 29, 3, '2019-10-03 00:58:25', '2019-10-03 00:58:25', 43, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_description` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_invited` int(11) NOT NULL DEFAULT '0',
  `invites` int(11) NOT NULL DEFAULT '0',
  `is_followed` int(11) DEFAULT '0',
  `followed` int(11) DEFAULT '0',
  `is_soc` int(11) DEFAULT '0',
  `is_slogin` int(11) DEFAULT '0',
  `slogin_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slogin_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `profile_description`, `email`, `email_verified_at`, `password`, `token`, `profile_image`, `remember_token`, `created_at`, `updated_at`, `is_invited`, `invites`, `is_followed`, `followed`, `is_soc`, `is_slogin`, `slogin_title`, `slogin_id`) VALUES
(3, 'Irfan Ullah', 'irfi', 'updated. Hi, My name is Irfan Ullah. I am a professional Web, Mobile and Desktop Applications developer with more than 3 years of development exprience.', 'theirfi@gmail.com', NULL, '$2y$10$BkKAr/DM8f6xKkZrvORtF.gLquyb0Mc.bSNfJ.WQw4TkhOYUTcq4y', 'JDJ5JDEwJDFsakZhdThWSVBwTXRGMTRlSC9CMXVFSEhrVk5JeUZvRUw1Z1YxbS5FdHA1aWdhaHVTQU95', 'http://192.168.10.4/swap/public/profile/708006Irfan Ullah1563270684', NULL, '2018-12-05 11:46:27', '2019-10-19 03:42:51', 1, 7, 1, 5, 0, 0, NULL, NULL),
(4, 'Shahid', 'shahid', NULL, 'shahid@gmail.com', NULL, '$2y$10$Ro2ZWRB0JD8MeSnvVVVMkOVuLbt3v0OxSsJ5uhy6LkeSQjv/lQSTm', '$2y$10$mR80fo54ji3clnjKr8x1K.K9JkHKYQ4OOHO8tfSbu9ZD2e8hP3Q0y', NULL, NULL, '2018-12-05 12:00:20', '2018-12-05 12:00:20', 0, 0, 0, 0, 0, 0, NULL, NULL),
(5, 'Shoaib', 'shoaib', NULL, 'fsdfsdfsdfsdf', NULL, '$2y$10$fea7Ki/3Lr48R.w3v/g8oOMWck1gW/jHn1WOkvYzxZFOsm0Qp0/PO', NULL, NULL, NULL, '2018-12-05 12:13:18', '2018-12-05 12:13:18', 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 'fsfsdfd', 'fsdfsdf', NULL, 'fsdfsdfd@mail.com', NULL, '$2y$10$Hq.vX9IEoRyxySU24oQdVu7y6TnSM1qJYD1.k6jZOvopuiuEF4O9e', NULL, NULL, NULL, '2018-12-06 04:41:06', '2018-12-06 04:41:06', 0, 0, 0, 0, 0, 0, NULL, NULL),
(8, 'HFM Irfan', 'hfmkhan', 'this is profile description.', 'hfm@gmail.com', NULL, '$2y$10$kH5FyznOgB3qTA0xME6gqu4/bMZ.JXX/VuhOaf8HUp6opw0MRVTXK', '$2y$10$Q.juN/sGZ1bXgcOWym2HyOKEVIwit5S3RgZcylt6p5NQd9OqU6XjG', 'https://canadianpizzaunlimited.ca/images/slider/PickUpSpecial2.jpg', NULL, '2018-12-15 12:32:21', '2019-01-13 06:06:44', 0, 0, 0, 0, 0, 0, NULL, NULL),
(9, 'Prof Hina Khan', 'prof', NULL, 'prfo@gmail.com', NULL, '$2y$10$UBNDNOETFIACIlY2qIn/uOBkDkbY4a1/Ys8zkzHH/0q/fW1r2mbQ2', '$2y$10$s3tp9fQXUXUf7CZ.um0z9uI4M.ecbA7ZZpVyT6tn7oTvCxC27zfne', NULL, NULL, '2019-01-15 12:15:44', '2019-01-15 12:31:20', 0, 0, 1, 5, 0, 0, NULL, NULL),
(10, 'Prof Hina Khan', 'proff', NULL, 'prfoh@gmail.com', NULL, '$2y$10$xw4fhZ/9nQCOrnHEtGJmlOzWbS0gKn6t5Zfq2CsjYM792vbpXddKG', '$2y$10$byTK/2mnWe3zhj3SZJIsguBPLzRS/xnRx5OxlakXqvD7SR8vkf9BW', NULL, NULL, '2019-01-15 12:22:28', '2019-01-17 01:24:09', 1, 6, 1, 5, 0, 0, NULL, NULL),
(11, 'good khan', 'good', NULL, 'g@g.com', NULL, '$2y$10$ImtKpD8k/8/2NY4QofR/redjGVgtWBvszngM439qg8H7cmyMuvmiK', '$2y$10$jj06Ubs6DPfTEeoHBVOW3up9w054CApKuFXhn/U/Pwq3Br27StPUS', NULL, NULL, '2019-01-17 01:58:36', '2019-01-17 05:35:27', 1, 4, 1, 6, 0, 0, NULL, NULL),
(12, 'gg', 'ggggg', NULL, 'gg@gg.com', NULL, '$2y$10$n62rCP1UtfZYqELkYdYnR.uqe6V35XyolOQ.NtAE3D5KbwVAxCk2O', '$2y$10$TMaM0BZeStlCIiEW62dhCedgu8LZGfSTZNSpLpBAiTsKaFktTMBzS', NULL, NULL, '2019-01-17 02:06:24', '2019-01-17 05:08:03', 0, 0, 1, 5, 0, 0, NULL, NULL),
(13, 'ggd', 'gggggd', NULL, 'ggd@gg.com', NULL, '$2y$10$NwD/Mc3EWtcVsXqmzRVwme9tH0eXOw9WJQJK6I.zdMN06lZ1q1HQ6', '$2y$10$g7KEc6JZw7X/e.fPLcp2l.2JZ64NWZaj2dHw9gYfs1V9YGzS.T7Uu', NULL, NULL, '2019-01-17 02:08:35', '2019-01-17 02:09:15', 0, 0, 1, 7, 0, 0, NULL, NULL),
(14, 'Irfan Khan', 'iiiiii', NULL, 'ir@ir.com', NULL, '$2y$10$6iLol0XnplNTBjfC.oAdAeeWcSITAEFdhTyYNfrmNpKUKnKpWKTqW', '$2y$10$o7wmthPSkKfGb9wYbkvyyOCcgTbukQsWI9KdKDLLaG4R8d.II4qpK', NULL, NULL, '2019-01-17 06:41:25', '2019-01-17 06:44:11', 1, 1, 1, 10, 0, 0, NULL, NULL),
(15, 'irfan', 'flsjsl', NULL, 'jfklsdj@fjslfjs.com', NULL, '$2y$10$grWKgq3FIk8S538aD7DLPOt.osZ5B4tVoZNcifbtXXm0Xj.jseEjW', '$2y$10$YK0G6RR3TM3.2GRRyjY2/erjlkY3ltCf6YhCFwsBa5pwjnLUR69l6', NULL, NULL, '2019-01-17 06:45:00', '2019-01-17 06:45:09', 0, 0, 1, 5, 0, 0, NULL, NULL),
(16, 'hjhjl khan', 'flkjsdfjl', NULL, 'hjhjh@hjhjh.com', NULL, '$2y$10$6p65l9OKb5w.HleoQapBdutnEZYbxlIG2yqzaNGYhMWjKyC8i5CQK', '$2y$10$LAY4d3r4JvdmT0/9KzGRS.gA5vlSvQ33c877pvNStbPS8olPXcZ42', NULL, NULL, '2019-01-17 06:50:53', '2019-01-17 06:51:09', 0, 0, 1, 5, 0, 0, NULL, NULL),
(17, 'uyuyu khan', 'hfjsd', NULL, 'yuy@yuy.com', NULL, '$2y$10$SwBcSkVKKImVfd556Dmkd.m3Fdn4dsWwqQEv31ePe/.cnW9YMKkoq', '$2y$10$p83hztfjvMbqZ7yI8dlhBe0G.LRZw6mmq32JuEfJBItui881epViO', NULL, NULL, '2019-01-17 06:55:17', '2019-01-17 06:55:25', 0, 0, 1, 5, 0, 0, NULL, NULL),
(18, 'gulu khan', 'gulu but', NULL, 'gulu@gulu.com', NULL, '$2y$10$Fq9wKEqR5KMiX5U6dxg5keFsqIIRiCJcjY6XMnHlFjDgvnK3l8WZu', '$2y$10$iS1wiEYLUKDT27jXPaMX2.p71RWrvDG.YSQQI4USA8PZR1Sy0qDHu', NULL, NULL, '2019-01-17 06:58:58', '2019-01-17 07:01:17', 1, 2, 1, 5, 0, 0, NULL, NULL),
(19, 'Micael Jeffry', 'michael', NULL, 'jefry@gmai.com', NULL, '$2y$10$yqIENsvRbjPgmPG6GWRrI.pHGMoHD3PW60iXLw93/TMmUwx7.NIwK', '$2y$10$zbUMjYveGL4Dr8e6FDulR.mx7c4/5p0w6PMh63Q5Q1hIrlFYAFZ/S', NULL, NULL, '2019-01-17 07:08:10', '2019-01-17 07:12:54', 1, 2, 1, 7, 0, 0, NULL, NULL),
(27, 'Irfan Irfi', 'Irfan Irfi', NULL, '1414465635362213', NULL, '$2y$10$2EOwKwoJgmN1ZG80dQ1AKeJkv7G6gZTINU.1Os2zkdwgWMUJOGTe2', '$2y$10$WC5MEj/1u7otxVFqTiGLo.Ynhv/hPIGussxzmrOF9bs1Y6EnNiR0q', 'https://graph.facebook.com/1414465635362213/picture?type=large', NULL, '2019-04-10 04:47:37', '2019-04-10 04:48:59', 0, 0, 1, 5, 0, 1, 'fb', '1414465635362213'),
(28, 'GSA User', 'thegsa', NULL, 'gsa@gsa.com', NULL, '$2y$10$Zkuz7c/tdl.kmxVhN3/wVeUmqzMecUrvLc6YWOSHXETnkST0whvD2', 'JDJ5JDEwJFN2M3lmUjdJdXJHRDVlZmNoOTdHQ091bWpVSk40Z1NiTkpIQjVPTWR2ZGhHbzZzaVBxdmIu', 'http://192.168.10.3/swap/public/profile/234302GSA User1570080037', NULL, '2019-10-03 00:19:08', '2019-10-03 00:20:41', 0, 0, 1, 5, 0, 0, NULL, NULL),
(29, 'Pak Affairs', 'pakaffairs ', NULL, 'pak@pak.com', NULL, '$2y$10$xV5lNi4vJaN9gowj5/Zcs.ayksjDLqMf5G3kqytRrSYciSqUyfPF6', 'JDJ5JDEwJGNqdnVJeC9YSnJUMkJsWkREeE5hTXVIcFAwam9lSTNTcmg3bXFtQ0xkY1ZDV0t3aEtiLjNx', 'http://192.168.10.3/swap/public/profile/431078Pak Affairs1570082046', NULL, '2019-10-03 00:48:59', '2019-10-03 00:54:13', 0, 0, 1, 2, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `chat_groups`
--
ALTER TABLE `chat_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `group_messages`
--
ALTER TABLE `group_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_participants`
--
ALTER TABLE `group_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `rattings`
--
ALTER TABLE `rattings`
  ADD PRIMARY KEY (`ratting_id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `statuslikes`
--
ALTER TABLE `statuslikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_comments`
--
ALTER TABLE `status_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_shares`
--
ALTER TABLE `status_shares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_tags`
--
ALTER TABLE `status_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `swaps`
--
ALTER TABLE `swaps`
  ADD PRIMARY KEY (`swap_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_groups`
--
ALTER TABLE `chat_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `group_messages`
--
ALTER TABLE `group_messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `group_participants`
--
ALTER TABLE `group_participants`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `chat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rattings`
--
ALTER TABLE `rattings`
  MODIFY `ratting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `statuslikes`
--
ALTER TABLE `statuslikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `status_comments`
--
ALTER TABLE `status_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `status_shares`
--
ALTER TABLE `status_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_tags`
--
ALTER TABLE `status_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `swaps`
--
ALTER TABLE `swaps`
  MODIFY `swap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
