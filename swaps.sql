-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2019 at 07:30 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(109, 8, 19, '2019-01-17 07:11:43', '2019-01-17 07:11:43');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_id`, `sender_id`, `reciever_id`, `chat_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 3, 8, 1, 'how are you 3 is the sender', NULL, NULL),
(2, 8, 3, 1, 'I am fine 8 is the sender and 3 reciever', NULL, NULL),
(3, 3, 8, 1, 'The message is empty.', '2018-12-20 08:15:49', '2018-12-20 08:15:49'),
(4, 3, 8, 1, 'this message is from the browser where reciever id is 8 and sender id is 3', '2018-12-20 08:16:36', '2018-12-20 08:16:36'),
(5, 8, 3, 1, 'hello', '2018-12-20 10:37:41', '2018-12-20 10:37:41'),
(6, 8, 3, 1, 'hello', '2018-12-20 10:38:00', '2018-12-20 10:38:00'),
(7, 8, 3, 1, 'how are you.', '2018-12-20 10:38:47', '2018-12-20 10:38:47'),
(8, 8, 3, 1, 'is it refereshing?', '2018-12-20 10:44:41', '2018-12-20 10:44:41'),
(9, 3, 8, 1, 'is it working', NULL, NULL),
(10, 8, 3, 1, 'Iam fine what about you?', '2018-12-20 11:23:44', '2018-12-20 11:23:44'),
(11, 3, 8, 1, 'I am fine as well.', NULL, NULL),
(12, 8, 3, 1, 'good luck', '2018-12-20 11:27:13', '2018-12-20 11:27:13'),
(13, 3, 8, 1, 'Thanks.', NULL, NULL),
(14, 8, 3, 1, 'THIS IS MESSAGE POSITIN CHECKING. IF IT WORKED. IT WOULD BE GREAE AND I WILL PROCEED TO THE NEXT TASKT. THANKS', '2018-12-20 11:32:37', '2018-12-20 11:32:37'),
(15, 8, 3, 1, 'working', '2018-12-20 12:05:07', '2018-12-20 12:05:07'),
(16, 3, 8, 0, 'not working', NULL, NULL),
(17, 3, 8, 0, 'wallay yar.', NULL, NULL),
(18, 8, 3, 1, 'haha', '2018-12-20 12:15:24', '2018-12-20 12:15:24'),
(19, 3, 8, 0, 'THIS IS MESSAGE POSITIN CHECKING. IF IT WORKED. IT WOULD BE GREAE AND I WILL PROCEED TO THE NEXT TASKT. THANKS', NULL, NULL),
(20, 8, 3, 1, 'nothing to worry.', '2018-12-20 12:27:40', '2018-12-20 12:27:40'),
(21, 8, 3, 1, 'time testing.', '2018-12-20 17:49:56', '2018-12-20 17:49:56'),
(22, 8, 3, 1, 'how are you?', '2018-12-21 04:35:11', '2018-12-21 04:35:11'),
(23, 3, 8, 1, 'I am fine, what about you?', '2018-12-21 04:35:40', '2018-12-21 04:35:40'),
(24, 8, 3, 1, 'hello tesitng?', '2018-12-21 04:38:37', '2018-12-21 04:38:37'),
(25, 3, 8, 1, 'yes, it is working', '2018-12-21 04:38:49', '2018-12-21 04:38:49'),
(26, 3, 8, 1, 'hello, it is the demo video.', '2018-12-21 04:46:49', '2018-12-21 04:46:49'),
(27, 8, 3, 1, 'okay. I got it?', '2018-12-21 04:47:16', '2018-12-21 04:47:16');

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
(8, 1, 0, 0, 0, 0, 10, 0, 0, 0, 8, 3, 0, '2018-12-17 06:18:13', '2018-12-17 06:18:13', 8, 0),
(9, 1, 0, 0, 0, 0, 13, 0, 0, 1, 3, 8, 0, '2018-12-17 11:22:27', '2018-12-17 06:22:27', 9, 0),
(10, 1, 0, 0, 0, 0, 15, 0, 0, 1, 8, 3, 0, '2018-12-21 04:44:24', '2018-12-20 23:44:24', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `chat_id` int(10) UNSIGNED NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`chat_id`, `user_one`, `user_two`, `created_at`, `updated_at`) VALUES
(1, 3, 8, NULL, NULL),
(2, 5, 3, NULL, NULL);

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
(27, 3, 13, 3, '2018-12-18 10:25:09', '2018-12-20 23:45:15'),
(28, 3, 15, 2, '2018-12-20 23:44:30', '2018-12-20 23:44:44'),
(29, 8, 22, 3, '2019-01-13 06:07:58', '2019-01-13 06:07:58');

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
(7, 3, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 0, ''),
(8, 4, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 0, ''),
(9, 4, 'hello, this is my HFM Post.', '2018-12-15 17:26:52', '2018-12-15 17:26:52', '1544894812', 0, ''),
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
(21, 3, 'this is post with image.', '2019-01-13 11:01:11', '2019-01-13 06:01:22', '1547377271', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.13\\/swap\\/public\\/statuses\\/images\\/irfi31547377272.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.13\\/swap\\/public\\/statuses\\/images\\/irfi31547377282.png\",\"attachment_type\":1}]'),
(22, 8, 'hello check this as well.', '2019-01-13 11:07:34', '2019-01-13 06:07:35', '1547377654', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.13\\/swap\\/public\\/statuses\\/images\\/hfmkhan81547377655.png\",\"attachment_type\":1}]');

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
(10, 8, 3, '2018-12-20 23:43:34', '2018-12-20 23:44:24', 15, 1, 0);

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
  `is_soc` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `profile_description`, `email`, `email_verified_at`, `password`, `token`, `profile_image`, `remember_token`, `created_at`, `updated_at`, `is_invited`, `invites`, `is_followed`, `followed`, `is_soc`) VALUES
(3, 'Irfan Ullah', 'irfi', 'updated. Hi, My name is Irfan Ullah. I am a professional Web, Mobile and Desktop Applications developer with more than 3 years of development exprience.', 'theirfi@gmail.com', NULL, '$2y$10$BkKAr/DM8f6xKkZrvORtF.gLquyb0Mc.bSNfJ.WQw4TkhOYUTcq4y', '$2y$10$d6UhYSg9TxB9wKAFgAOfXei9VfAwoBTHk4rgGuacMP1lZ7bD2wDfW', 'http://192.168.10.3/swap/public/profile/575568Irfan Ullah1545551869', NULL, '2018-12-05 11:46:27', '2019-01-14 04:20:31', 1, 7, 0, 0, 0),
(4, 'Shahid', 'shahid', NULL, 'shahid@gmail.com', NULL, '$2y$10$Ro2ZWRB0JD8MeSnvVVVMkOVuLbt3v0OxSsJ5uhy6LkeSQjv/lQSTm', '$2y$10$mR80fo54ji3clnjKr8x1K.K9JkHKYQ4OOHO8tfSbu9ZD2e8hP3Q0y', NULL, NULL, '2018-12-05 12:00:20', '2018-12-05 12:00:20', 0, 0, 0, 0, 0),
(5, 'Shoaib', 'shoaib', NULL, 'fsdfsdfsdfsdf', NULL, '$2y$10$fea7Ki/3Lr48R.w3v/g8oOMWck1gW/jHn1WOkvYzxZFOsm0Qp0/PO', NULL, NULL, NULL, '2018-12-05 12:13:18', '2018-12-05 12:13:18', 0, 0, 0, 0, 0),
(6, 'fsfsdfd', 'fsdfsdf', NULL, 'fsdfsdfd@mail.com', NULL, '$2y$10$Hq.vX9IEoRyxySU24oQdVu7y6TnSM1qJYD1.k6jZOvopuiuEF4O9e', NULL, NULL, NULL, '2018-12-06 04:41:06', '2018-12-06 04:41:06', 0, 0, 0, 0, 0),
(8, 'HFM Irfan', 'hfmkhan', 'this is profile description.', 'hfm@gmail.com', NULL, '$2y$10$kH5FyznOgB3qTA0xME6gqu4/bMZ.JXX/VuhOaf8HUp6opw0MRVTXK', '$2y$10$Q.juN/sGZ1bXgcOWym2HyOKEVIwit5S3RgZcylt6p5NQd9OqU6XjG', 'https://canadianpizzaunlimited.ca/images/slider/PickUpSpecial2.jpg', NULL, '2018-12-15 12:32:21', '2019-01-13 06:06:44', 0, 0, 0, 0, 0),
(9, 'Prof Hina Khan', 'prof', NULL, 'prfo@gmail.com', NULL, '$2y$10$UBNDNOETFIACIlY2qIn/uOBkDkbY4a1/Ys8zkzHH/0q/fW1r2mbQ2', '$2y$10$s3tp9fQXUXUf7CZ.um0z9uI4M.ecbA7ZZpVyT6tn7oTvCxC27zfne', NULL, NULL, '2019-01-15 12:15:44', '2019-01-15 12:31:20', 0, 0, 1, 5, 0),
(10, 'Prof Hina Khan', 'proff', NULL, 'prfoh@gmail.com', NULL, '$2y$10$xw4fhZ/9nQCOrnHEtGJmlOzWbS0gKn6t5Zfq2CsjYM792vbpXddKG', '$2y$10$byTK/2mnWe3zhj3SZJIsguBPLzRS/xnRx5OxlakXqvD7SR8vkf9BW', NULL, NULL, '2019-01-15 12:22:28', '2019-01-17 01:24:09', 1, 6, 1, 5, 0),
(11, 'good khan', 'good', NULL, 'g@g.com', NULL, '$2y$10$ImtKpD8k/8/2NY4QofR/redjGVgtWBvszngM439qg8H7cmyMuvmiK', '$2y$10$jj06Ubs6DPfTEeoHBVOW3up9w054CApKuFXhn/U/Pwq3Br27StPUS', NULL, NULL, '2019-01-17 01:58:36', '2019-01-17 05:35:27', 1, 4, 1, 6, 0),
(12, 'gg', 'ggggg', NULL, 'gg@gg.com', NULL, '$2y$10$n62rCP1UtfZYqELkYdYnR.uqe6V35XyolOQ.NtAE3D5KbwVAxCk2O', '$2y$10$TMaM0BZeStlCIiEW62dhCedgu8LZGfSTZNSpLpBAiTsKaFktTMBzS', NULL, NULL, '2019-01-17 02:06:24', '2019-01-17 05:08:03', 0, 0, 1, 5, 0),
(13, 'ggd', 'gggggd', NULL, 'ggd@gg.com', NULL, '$2y$10$NwD/Mc3EWtcVsXqmzRVwme9tH0eXOw9WJQJK6I.zdMN06lZ1q1HQ6', '$2y$10$g7KEc6JZw7X/e.fPLcp2l.2JZ64NWZaj2dHw9gYfs1V9YGzS.T7Uu', NULL, NULL, '2019-01-17 02:08:35', '2019-01-17 02:09:15', 0, 0, 1, 7, 0),
(14, 'Irfan Khan', 'iiiiii', NULL, 'ir@ir.com', NULL, '$2y$10$6iLol0XnplNTBjfC.oAdAeeWcSITAEFdhTyYNfrmNpKUKnKpWKTqW', '$2y$10$o7wmthPSkKfGb9wYbkvyyOCcgTbukQsWI9KdKDLLaG4R8d.II4qpK', NULL, NULL, '2019-01-17 06:41:25', '2019-01-17 06:44:11', 1, 1, 1, 10, 0),
(15, 'irfan', 'flsjsl', NULL, 'jfklsdj@fjslfjs.com', NULL, '$2y$10$grWKgq3FIk8S538aD7DLPOt.osZ5B4tVoZNcifbtXXm0Xj.jseEjW', '$2y$10$YK0G6RR3TM3.2GRRyjY2/erjlkY3ltCf6YhCFwsBa5pwjnLUR69l6', NULL, NULL, '2019-01-17 06:45:00', '2019-01-17 06:45:09', 0, 0, 1, 5, 0),
(16, 'hjhjl khan', 'flkjsdfjl', NULL, 'hjhjh@hjhjh.com', NULL, '$2y$10$6p65l9OKb5w.HleoQapBdutnEZYbxlIG2yqzaNGYhMWjKyC8i5CQK', '$2y$10$LAY4d3r4JvdmT0/9KzGRS.gA5vlSvQ33c877pvNStbPS8olPXcZ42', NULL, NULL, '2019-01-17 06:50:53', '2019-01-17 06:51:09', 0, 0, 1, 5, 0),
(17, 'uyuyu khan', 'hfjsd', NULL, 'yuy@yuy.com', NULL, '$2y$10$SwBcSkVKKImVfd556Dmkd.m3Fdn4dsWwqQEv31ePe/.cnW9YMKkoq', '$2y$10$p83hztfjvMbqZ7yI8dlhBe0G.LRZw6mmq32JuEfJBItui881epViO', NULL, NULL, '2019-01-17 06:55:17', '2019-01-17 06:55:25', 0, 0, 1, 5, 0),
(18, 'gulu khan', 'gulu but', NULL, 'gulu@gulu.com', NULL, '$2y$10$Fq9wKEqR5KMiX5U6dxg5keFsqIIRiCJcjY6XMnHlFjDgvnK3l8WZu', '$2y$10$iS1wiEYLUKDT27jXPaMX2.p71RWrvDG.YSQQI4USA8PZR1Sy0qDHu', NULL, NULL, '2019-01-17 06:58:58', '2019-01-17 07:01:17', 1, 2, 1, 5, 0),
(19, 'Micael Jeffry', 'michael', NULL, 'jefry@gmai.com', NULL, '$2y$10$yqIENsvRbjPgmPG6GWRrI.pHGMoHD3PW60iXLw93/TMmUwx7.NIwK', '$2y$10$zbUMjYveGL4Dr8e6FDulR.mx7c4/5p0w6PMh63Q5Q1hIrlFYAFZ/S', NULL, NULL, '2019-01-17 07:08:10', '2019-01-17 07:12:54', 1, 2, 1, 7, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`f_id`);

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
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `chat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rattings`
--
ALTER TABLE `rattings`
  MODIFY `ratting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `swaps`
--
ALTER TABLE `swaps`
  MODIFY `swap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
