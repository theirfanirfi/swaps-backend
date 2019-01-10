-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2019 at 08:15 AM
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

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attachment_id`, `attachment_type`, `attachment_url`, `status_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909822', 40, 3, '2018-12-27 06:23:42', '2018-12-27 06:23:42'),
(2, 2, 'http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909832', 40, 3, '2018-12-27 06:23:52', '2018-12-27 06:23:52'),
(3, 2, 'http://192.168.10.5/swap/public/statuses/videos/Irfan Ullah31545909842', 40, 3, '2018-12-27 06:24:02', '2018-12-27 06:24:02'),
(4, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910076', 41, 3, '2018-12-27 06:27:56', '2018-12-27 06:27:56'),
(5, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910086', 41, 3, '2018-12-27 06:28:06', '2018-12-27 06:28:06'),
(6, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910096', 41, 3, '2018-12-27 06:28:16', '2018-12-27 06:28:16'),
(7, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910134', 42, 3, '2018-12-27 06:28:54', '2018-12-27 06:28:54'),
(8, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910144', 42, 3, '2018-12-27 06:29:04', '2018-12-27 06:29:04'),
(9, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545910154', 42, 3, '2018-12-27 06:29:14', '2018-12-27 06:29:14'),
(10, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545909230', 43, 3, '2018-12-27 06:13:50', '2018-12-27 06:13:50'),
(11, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545909240', 43, 3, '2018-12-27 06:14:00', '2018-12-27 06:14:00'),
(12, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545909250', 43, 3, '2018-12-27 06:14:10', '2018-12-27 06:14:10'),
(13, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911064', 44, 3, '2018-12-27 06:44:24', '2018-12-27 06:44:24'),
(14, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911074', 44, 3, '2018-12-27 06:44:34', '2018-12-27 06:44:34'),
(15, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911084', 44, 3, '2018-12-27 06:44:44', '2018-12-27 06:44:44'),
(16, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911622', 45, 3, '2018-12-27 06:53:42', '2018-12-27 06:53:42'),
(17, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911632', 45, 3, '2018-12-27 06:53:52', '2018-12-27 06:53:52'),
(18, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911642', 45, 3, '2018-12-27 06:54:02', '2018-12-27 06:54:02'),
(19, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911906', 46, 3, '2018-12-27 06:58:26', '2018-12-27 06:58:26'),
(20, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545911916', 46, 3, '2018-12-27 06:58:36', '2018-12-27 06:58:36'),
(21, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912021', 47, 3, '2018-12-27 07:00:21', '2018-12-27 07:00:21'),
(22, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912032', 47, 3, '2018-12-27 07:00:32', '2018-12-27 07:00:32'),
(23, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912420', 48, 3, '2018-12-27 07:07:00', '2018-12-27 07:07:00'),
(24, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912430', 48, 3, '2018-12-27 07:07:10', '2018-12-27 07:07:10'),
(25, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912440', 48, 3, '2018-12-27 07:07:20', '2018-12-27 07:07:20'),
(26, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912554', 49, 3, '2018-12-27 07:09:14', '2018-12-27 07:09:14'),
(27, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912564', 49, 3, '2018-12-27 07:09:24', '2018-12-27 07:09:24'),
(28, 1, 'http://192.168.10.5/swap/public/statuses/images/Irfan Ullah31545912574', 49, 3, '2018-12-27 07:09:34', '2018-12-27 07:09:34');

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
(15, 8, 3, '2018-12-20 23:51:33', '2018-12-20 23:51:33');

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
(27, 8, 3, 1, 'okay. I got it?', '2018-12-21 04:47:16', '2018-12-21 04:47:16'),
(28, 3, 8, 1, 'hello', '2018-12-28 00:06:46', '2018-12-28 00:06:46'),
(29, 3, 9, 3, 'KENA MARA', '2019-01-09 12:05:59', '2019-01-09 12:05:59');

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
(10, 1, 0, 0, 0, 0, 15, 0, 0, 1, 8, 3, 0, '2018-12-21 04:44:24', '2018-12-20 23:44:24', 10, 0),
(11, 1, 0, 0, 0, 0, 67, 0, 0, 0, 3, 8, 0, '2018-12-31 01:28:52', '2018-12-31 01:28:52', 11, 0),
(12, 1, 0, 0, 0, 0, 71, 0, 0, 0, 3, 8, 0, '2018-12-31 06:08:13', '2018-12-31 06:08:13', 12, 0);

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
(2, 5, 3, NULL, NULL),
(3, 3, 9, '2019-01-09 12:05:59', '2019-01-09 12:05:59');

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
(29, 3, 25, 3, '2018-12-27 19:05:25', '2018-12-27 19:05:25'),
(30, 3, 64, 3, '2018-12-29 11:15:22', '2018-12-29 11:15:22'),
(31, 3, 65, 4, '2018-12-29 23:49:19', '2018-12-29 23:49:19'),
(32, 3, 67, 2, '2018-12-30 13:26:56', '2018-12-30 13:26:56'),
(33, 3, 71, 4, '2018-12-31 06:10:07', '2018-12-31 06:10:07');

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
  `has_attachment` int(11) DEFAULT '0' COMMENT '1. has 0. has not',
  `attachments` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `user_id`, `status`, `created_at`, `updated_at`, `posting_time`, `has_attachment`, `attachments`) VALUES
(2, 3, 'hello', '2018-12-06 12:59:41', '2018-12-06 12:59:41', NULL, 0, NULL),
(4, 3, 'sjsj', '2018-12-07 05:25:15', '2018-12-07 05:25:15', NULL, 0, NULL),
(5, 3, 'sjsj', '2018-12-07 05:25:23', '2018-12-07 05:25:23', NULL, 0, NULL),
(6, 3, 'hooo', '2018-12-07 05:42:53', '2018-12-07 05:42:53', NULL, 0, NULL),
(7, 3, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 0, NULL),
(8, 4, 'this is my new post', '2018-12-12 16:17:48', '2018-12-12 16:17:48', '1544631468', 0, NULL),
(9, 4, 'hello, this is my HFM Post.', '2018-12-15 17:26:52', '2018-12-15 17:26:52', '1544894812', 0, NULL),
(10, 8, 'this my post  from hfm account.', '2018-12-15 17:33:43', '2018-12-15 17:33:43', '1544895223', 0, NULL),
(12, 8, 'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm', '2018-12-15 19:38:46', '2018-12-15 19:38:46', '1544902726', 0, NULL),
(13, 3, 'newest post.', '2018-12-17 11:21:06', '2018-12-17 11:21:06', '1545045666', 0, NULL),
(14, 8, 'greate to see you here.', '2018-12-20 17:47:32', '2018-12-20 17:47:32', '1545328052', 0, NULL),
(15, 8, 'here is the status. do you like it?', '2018-12-21 04:42:59', '2018-12-21 04:42:59', '1545367379', 0, NULL),
(16, 3, 'something is posted. from the new logic of activity.', '2018-12-25 08:52:54', '2018-12-25 08:52:54', '1545727974', 0, NULL),
(17, 3, 'hello', '2018-12-26 14:36:45', '2018-12-26 14:36:45', '1545835005', 0, NULL),
(18, 3, 'hello', '2018-12-26 14:37:05', '2018-12-26 14:37:05', '1545835025', 0, NULL),
(19, 3, 'hello.', '2018-12-26 16:26:24', '2018-12-26 16:26:24', '1545841584', 0, NULL),
(20, 3, 'hello', '2018-12-26 16:29:39', '2018-12-26 16:29:39', '1545841779', 0, NULL),
(21, 3, 'another post.', '2018-12-26 16:40:26', '2018-12-26 16:40:26', '1545842426', 0, NULL),
(22, 3, 'hello again.', '2018-12-26 16:44:52', '2018-12-26 16:44:52', '1545842692', 0, NULL),
(23, 3, 'hello', '2018-12-26 16:50:33', '2018-12-26 16:50:33', '1545843033', 0, NULL),
(24, 3, 'hello', '2018-12-26 16:58:32', '2018-12-26 16:58:32', '1545843512', 0, NULL),
(25, 3, 'hello.', '2018-12-26 17:01:04', '2018-12-26 17:01:04', '1545843664', 0, NULL),
(26, 3, 'hello.', '2018-12-26 17:04:05', '2018-12-26 17:04:05', '1545843845', 0, NULL),
(27, 3, 'hello', '2018-12-27 08:16:23', '2018-12-27 08:16:23', '1545898583', 0, NULL),
(28, 3, 'this is from genymotion', '2018-12-27 08:17:56', '2018-12-27 08:17:56', '1545898676', 0, NULL),
(29, 3, 'hello this is g', '2018-12-27 08:20:10', '2018-12-27 08:20:10', '1545898810', 0, NULL),
(30, 3, 'hello this is aan', '2018-12-27 08:23:24', '2018-12-27 08:23:24', '1545899004', 0, NULL),
(31, 3, 'hello', '2018-12-27 09:27:39', '2018-12-27 09:27:39', '1545902859', 0, NULL),
(32, 3, 'bb', '2018-12-27 09:41:01', '2018-12-27 09:41:01', '1545903661', 0, NULL),
(33, 3, 'bb', '2018-12-27 09:42:43', '2018-12-27 09:42:43', '1545903763', 0, NULL),
(34, 3, 'bb', '2018-12-27 09:43:24', '2018-12-27 09:43:24', '1545903804', 0, NULL),
(35, 3, 'bb', '2018-12-27 09:47:58', '2018-12-27 09:47:58', '1545904078', 0, NULL),
(36, 3, 'mmm', '2018-12-27 09:51:51', '2018-12-27 09:51:51', '1545904311', 0, NULL),
(37, 3, 'k k', '2018-12-27 09:54:38', '2018-12-27 09:54:38', '1545904478', 0, NULL),
(38, 3, 'k k', '2018-12-27 09:54:38', '2018-12-27 09:54:38', '1545904478', 0, NULL),
(39, 3, 'jnlj', '2018-12-27 11:09:19', '2018-12-27 11:09:19', '1545908959', 0, NULL),
(40, 3, 'hello', '2018-12-27 11:23:41', '2018-12-27 11:23:41', '1545909821', 0, NULL),
(41, 3, 'khjk', '2018-12-27 11:27:56', '2018-12-27 11:27:56', '1545910076', 0, NULL),
(42, 3, 'khjk', '2018-12-27 11:28:53', '2018-12-27 11:28:53', '1545910133', 0, NULL),
(43, 3, 'hello', '2018-12-27 11:13:49', '2018-12-27 11:13:49', '1545909229', 0, NULL),
(44, 3, 'hello', '2018-12-27 11:44:22', '2018-12-27 11:44:22', '1545911062', 0, NULL),
(45, 3, 'this is testing.', '2018-12-27 11:53:42', '2018-12-27 11:53:42', '1545911622', 0, NULL),
(46, 3, 'final testing.', '2018-12-27 11:58:23', '2018-12-27 11:58:23', '1545911903', 0, NULL),
(47, 3, 'hellog again.', '2018-12-27 12:00:19', '2018-12-27 12:00:19', '1545912019', 0, NULL),
(48, 3, 'haha...', '2018-12-27 12:07:00', '2018-12-27 12:07:00', '1545912420', 0, NULL),
(49, 3, 'kena mara', '2018-12-27 12:09:13', '2018-12-27 12:09:13', '1545912553', 0, NULL),
(50, 3, 'hello from ginger', '2018-12-28 13:18:48', '2018-12-28 13:18:48', '1546003128', 0, NULL),
(51, 3, 'attachment testing..', '2018-12-28 13:19:40', '2018-12-28 13:19:40', '1546003180', 0, NULL),
(52, 3, 'hello', '2018-12-28 13:21:58', '2018-12-28 13:21:58', '1546003318', 0, NULL),
(57, 3, 'hello again.', '2018-12-28 13:59:39', '2018-12-28 08:59:39', '1546005579', 1, '{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546005579.png\",\"attachment_type\":1}'),
(58, 3, 'hello. who is there?', '2018-12-28 14:03:32', '2018-12-28 09:03:52', '1546005812', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546005812\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546005822\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546005832\",\"attachment_type\":1}]'),
(59, 3, 'hello', '2018-12-28 14:07:31', '2018-12-28 09:07:42', '1546006051', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546006052\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546006062\",\"attachment_type\":1}]'),
(61, 3, 'simple status.', '2018-12-28 14:11:09', '2018-12-28 14:11:09', '1546006269', 0, NULL),
(62, 3, 'hello this is top', '2018-12-28 14:53:35', '2018-12-28 09:53:35', '1546008815', 1, '{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546005579.png\",\"attachment_type\":1}'),
(63, 3, 'another post with png', '2018-12-28 14:55:10', '2018-12-28 09:55:20', '1546008910', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546008910.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546008920.png\",\"attachment_type\":1}]'),
(64, 3, 'hello testing with username', '2018-12-28 14:57:04', '2018-12-28 09:57:15', '1546009024', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/Irfan Ullah31546008910.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546009025.jpg\",\"attachment_type\":1}]'),
(65, 3, 'hello with 6 images.hello with 6 images.hello with 6 images.hello with 6 images.hello with 6 images.hello with 6 images.hello with 6 images.hello with 6 images. hello with 6 images.hello with 6 images.', '2018-12-29 17:22:02', '2018-12-29 12:22:54', '1546104122', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104123.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104133.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104143.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104153.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104163.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546104174.png\",\"attachment_type\":1}]'),
(66, 3, 'check again . check.', '2018-12-30 05:11:42', '2018-12-30 00:11:42', '1546146702', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546146702.png\",\"attachment_type\":1}]'),
(67, 3, 'HELLO TESTING AGAIN.', '2018-12-30 18:26:18', '2018-12-30 13:26:29', '1546194378', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546194379.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546194389.png\",\"attachment_type\":1}]'),
(68, 9, 'hello, this is my first post.', '2018-12-30 18:28:39', '2018-12-30 13:28:40', '1546194519', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/i@i.com91546194520.png\",\"attachment_type\":1}]'),
(69, 3, 'hello testing.', '2018-12-31 05:55:45', '2018-12-31 00:55:56', '1546235745', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546235746.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546235756.png\",\"attachment_type\":1}]'),
(71, 3, 'this is a status with image.', '2018-12-31 11:04:47', '2018-12-31 06:04:58', '1546254287', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546254287.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546254298.png\",\"attachment_type\":1}]'),
(72, 3, 'this is a video post.', '2018-12-31 11:06:18', '2018-12-31 06:06:19', '1546254378', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/videos\\/Irfan Ullah31546254379\",\"attachment_type\":2}]'),
(73, 3, 'this is single status.', '2019-01-04 13:09:52', '2019-01-04 08:09:54', '1546607392', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31546607394.png\",\"attachment_type\":1}]'),
(74, 3, 'hello, this is video.', '2019-01-09 07:40:43', '2019-01-09 02:40:43', '1547019643', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/videos\\/irfi.mp4\",\"attachment_type\":2}]'),
(75, 3, 'hello, this is status with the video and image.', '2019-01-09 07:50:19', '2019-01-09 02:50:39', '1547020219', 1, '[{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31547020219.png\",\"attachment_type\":1},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/videos\\/irfi31547020229.mp4\",\"attachment_type\":2},{\"attachment_url\":\"http:\\/\\/192.168.10.3\\/swap\\/public\\/statuses\\/images\\/irfi31547020239.png\",\"attachment_type\":1}]');

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
(11, 3, 8, '2018-12-31 01:28:52', '2018-12-31 01:28:52', 67, 0, 0),
(12, 3, 8, '2018-12-31 06:08:13', '2018-12-31 06:08:13', 71, 0, 0);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `profile_description`, `email`, `email_verified_at`, `password`, `token`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Irfan Ullah', 'irfi', 'Hi, My name is Irfan Ullah. I am a professional Web, Mobile and Desktop Applications developer with more than 3 years of development exprience.', 'theirfi@gmail.com', NULL, '$2y$10$BkKAr/DM8f6xKkZrvORtF.gLquyb0Mc.bSNfJ.WQw4TkhOYUTcq4y', '$2y$10$/hgjDwOXl/kkV.HTJ2OMEuRXVbdIt6C99uh.H3awNfzjJOdgLwLFu', 'http://192.168.10.3/swap/public/profile/83029Irfan Ullah1546253912', NULL, '2018-12-05 11:46:27', '2019-01-09 06:30:21'),
(4, 'Shahid', 'shahid', NULL, 'shahid@gmail.com', NULL, '$2y$10$Ro2ZWRB0JD8MeSnvVVVMkOVuLbt3v0OxSsJ5uhy6LkeSQjv/lQSTm', '$2y$10$mR80fo54ji3clnjKr8x1K.K9JkHKYQ4OOHO8tfSbu9ZD2e8hP3Q0y', NULL, NULL, '2018-12-05 12:00:20', '2018-12-05 12:00:20'),
(5, 'Shoaib', 'shoaib', NULL, 'fsdfsdfsdfsdf', NULL, '$2y$10$fea7Ki/3Lr48R.w3v/g8oOMWck1gW/jHn1WOkvYzxZFOsm0Qp0/PO', NULL, NULL, NULL, '2018-12-05 12:13:18', '2018-12-05 12:13:18'),
(6, 'fsfsdfd', 'fsdfsdf', NULL, 'fsdfsdfd@mail.com', NULL, '$2y$10$Hq.vX9IEoRyxySU24oQdVu7y6TnSM1qJYD1.k6jZOvopuiuEF4O9e', NULL, NULL, NULL, '2018-12-06 04:41:06', '2018-12-06 04:41:06'),
(8, 'HFM Irfan', 'hfmkhan', 'this is profile description.', 'hfm@gmail.com', NULL, '$2y$10$kH5FyznOgB3qTA0xME6gqu4/bMZ.JXX/VuhOaf8HUp6opw0MRVTXK', '$2y$10$wrfzz/YU0SUYeCtE9gHAnuvPzb4IFUhNS.67JYKWpFDLaYSxb5yJ6', 'https://canadianpizzaunlimited.ca/images/slider/PickUpSpecial2.jpg', NULL, '2018-12-15 12:32:21', '2018-12-18 05:35:45'),
(9, 'ikan', 'i@i.com', NULL, 'i@i.com', NULL, '$2y$10$J72xf3MEw3hmNPZJ9lgzFOGGoIyg.cPqnYxtvnS6y3ggCz3g0XzrK', '$2y$10$61AMfNF5xvV34yxNjUxbxevY2zp9kc3PxFYO4Rj/kJFeVOl5yiyEO', NULL, NULL, '2018-12-30 13:27:44', '2018-12-30 13:27:44');

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
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `chat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rattings`
--
ALTER TABLE `rattings`
  MODIFY `ratting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `swaps`
--
ALTER TABLE `swaps`
  MODIFY `swap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
