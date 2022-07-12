-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 10, 2022 at 06:37 PM
-- Server version: 8.0.27
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stark_backup`
--

-- --------------------------------------------------------

--
-- Table structure for table `appsname`
--

CREATE TABLE `appsname` (
  `id` int NOT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `points` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `appurl` varchar(255) DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '<p>Install and use</p>',
  `status` int NOT NULL DEFAULT '0',
  `task_limit` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Admin',
  `userid` varchar(255) DEFAULT NULL,
  `p_usertag` varchar(255) DEFAULT NULL,
  `inserted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE `app_setting` (
  `spinlimit` varchar(255) NOT NULL,
  `task_mode` varchar(255) NOT NULL DEFAULT 'onetime',
  `game` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `referral_points` varchar(255) NOT NULL,
  `scrath_limit` int NOT NULL,
  `bonus` text,
  `id` int NOT NULL,
  `quiz` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `max_promote` varchar(255) DEFAULT NULL,
  `app_promotecoin` varchar(255) DEFAULT NULL,
  `video_promotecoin` varchar(255) DEFAULT NULL,
  `promote_time` varchar(255) DEFAULT NULL,
  `promo_appcoin` varchar(255) DEFAULT NULL,
  `promo_videocoin` varchar(255) DEFAULT NULL,
  `promo_webcoin` varchar(255) DEFAULT NULL,
  `onedevice` varchar(255) DEFAULT 'false',
  `oneip_device` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '3',
  `block_vpn` varchar(255) NOT NULL DEFAULT 'false',
  `vpn_monitor` varchar(255) NOT NULL DEFAULT 'false',
  `auto_banvpn_user` varchar(255) NOT NULL DEFAULT 'false',
  `auto_ban_multiac` varchar(255) NOT NULL DEFAULT 'false',
  `auto_banadblock` varchar(255) NOT NULL DEFAULT 'false',
  `monitor_adblock` varchar(255) NOT NULL DEFAULT 'false',
  `auto_bancountry_change` varchar(255) NOT NULL DEFAULT 'false',
  `block_root_device` varchar(255) NOT NULL DEFAULT 'false',
  `auto_banroot` varchar(255) NOT NULL DEFAULT 'false',
  `google_login` varchar(255) NOT NULL,
  `promote_content` varchar(255) NOT NULL,
  `email_verification` varchar(255) NOT NULL,
  `day1` varchar(255) NOT NULL,
  `day2` varchar(255) NOT NULL,
  `day3` varchar(255) NOT NULL,
  `day4` varchar(255) NOT NULL,
  `day5` varchar(255) NOT NULL,
  `day6` varchar(255) NOT NULL,
  `day7` varchar(255) NOT NULL,
  `refer_mode` varchar(255) NOT NULL,
  `limit_video` varchar(255) NOT NULL DEFAULT '10',
  `limit_quiz` varchar(255) NOT NULL DEFAULT '10',
  `limit_web` varchar(255) NOT NULL DEFAULT '10',
  `limit_app` varchar(255) NOT NULL DEFAULT '10',
  `max_redeem_day` varchar(255) NOT NULL DEFAULT '2',
  `scratch` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `pay_info` text,
  `paid_spin` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`spinlimit`, `task_mode`, `game`, `referral_points`, `scrath_limit`, `bonus`, `id`, `quiz`, `max_promote`, `app_promotecoin`, `video_promotecoin`, `promote_time`, `promo_appcoin`, `promo_videocoin`, `promo_webcoin`, `onedevice`, `oneip_device`, `block_vpn`, `vpn_monitor`, `auto_banvpn_user`, `auto_ban_multiac`, `auto_banadblock`, `monitor_adblock`, `auto_bancountry_change`, `block_root_device`, `auto_banroot`, `google_login`, `promote_content`, `email_verification`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `refer_mode`, `limit_video`, `limit_quiz`, `limit_web`, `limit_app`, `max_redeem_day`, `scratch`, `pay_info`, `paid_spin`) VALUES
('15', 'daily', '[{\"game_minute\":\"1\",\"game_coin\":\"5\",\"game_message\":\"Play Game for 5 minute and get Bonus\"}]', '150', 10, '100', 1, '[{\"quiz_time\":\"30\",\"quiz_half\":\"5\",\"quiz_skip\":\"2\"}]', '100', '200', '100', '120', '10', '10', '10', 'true', '3', 'true', 'true', 'false', 'false', 'false', 'false', 'false', 'false', 'false', 'true', 'true', 'true', '5', '10', '10', '12', '15', '18', '20', 'direct', '10', '10', '10', '10', '2', '10,30', '[{\"paypal\":\"true\",\"razorpay\":\"true\",\"upi\":\"true\",\"paypal_key\":\"AZuDeoGoUOJBcqQQUAPcAMADuEXIdCa8OZnijjZsk9cysPezxrgVMlKwCEbpzUI84ovElhCn6mO59HBm\",\"razorpay_key\":\"rzp_test_qxNm0CyNAJ7IdZ\",\"upi_key\":\"sumeerp1@oksbi\",\"store_name\":\"Coin Purchase\",\"payee_name\":\"Reward Point\"}]', '5');

-- --------------------------------------------------------

--
-- Table structure for table `coinstore`
--

CREATE TABLE `coinstore` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `coin` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_bin DEFAULT 'ALL',
  `currency` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'USD',
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `coinstore`
--

INSERT INTO `coinstore` (`id`, `title`, `amount`, `coin`, `country`, `currency`, `status`, `created_at`, `update_at`) VALUES
(1, 'Starter', '100', '1500', 'ALL', 'INR', '0', '2021-12-20 03:58:09', NULL),
(2, 'Medium', '50', '1500', 'IN,BN,US', 'USD', '0', '2021-12-20 03:59:01', NULL),
(3, 'Gold', '15', '2500', 'US', 'USD', '0', '2021-12-20 08:15:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int NOT NULL,
  `person_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `refferal_id` varchar(255) DEFAULT NULL,
  `from_refferal_id` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `balance` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `refer` varchar(255) NOT NULL DEFAULT 'false',
  `p_token` text,
  `token` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'email',
  `banned_time` varchar(255) DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `licence` varchar(255) DEFAULT NULL,
  `package` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `status`, `licence`, `package`) VALUES
(2, 'sumer', 'admin@gmail.com', '$2y$10$UqRXT6DRTfE1xdCJLVbcLeHQCLBjG7v.AnvxvW9OMwA3NevabKsYm', '2021-03-18 04:03:03', '2021-10-03 07:00:36', NULL, 'NzM3Mzk3ODQ=', 'Y29tLmFwcC5yZXdhcmRhcHBtbG0=');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Racing game', 'Screenshot3_1620141501.png', 'https://hexgl.bkcore.com/play/', 0, '2021-05-04 15:18:21', '2021-05-07 03:59:51'),
(2, 'Box Punch', 'Screenshot4_1620142355.png', 'https://www.skillclash.com/g/S1Wrpf1v5ym?id=rJ49y5XJx', 0, '2021-05-04 15:32:35', '2021-05-07 03:59:51'),
(3, 'Fruit Ninja', 'Screenshot5_1620142497.png', 'https://www.skillclash.com/g/rkWfy2pXq0r?id=rJ49y5XJx', 0, '2021-05-04 15:34:57', '2021-05-07 03:59:51'),
(4, 'Chess', 'Screenshot6_1620142580.png', 'https://www.skillclash.com/g/rkAXTzkD5kX?id=rJ49y5XJx', 0, '2021-05-04 15:36:20', '2021-05-07 03:59:51'),
(5, 'Tower Twist', 'Screenshot7_1620142638.png', 'https://www.skillclash.com/g/HJT46GkPcy7?id=rJ49y5XJx', 0, '2021-05-04 15:37:18', '2021-05-07 03:59:51'),
(6, 'Carom King', 'Screenshot8_1620142687.png', 'https://www.skillclash.com/g/H1Hgyn6XqAS?id=rJ49y5XJx', 0, '2021-05-04 15:38:07', '2021-05-07 03:59:51'),
(7, 'Ludo', 'Screenshot9_1620142720.png', 'https://www.skillclash.com/g/SkhljT2fdgb?id=rJ49y5XJx', 0, '2021-05-04 15:38:40', '2021-05-07 03:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `id` int NOT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `bannertype` varchar(255) DEFAULT NULL,
  `onclick` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monitor_report`
--

CREATE TABLE `monitor_report` (
  `id` int NOT NULL,
  `userid` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitor_report`
--

INSERT INTO `monitor_report` (`id`, `userid`, `type`, `created_at`) VALUES
(1, '377', 'vpn', '2021-09-12 21:23:11'),
(2, '377', 'vpn', '2021-09-12 21:25:18'),
(3, '461', 'vpn', '2021-09-17 16:03:31'),
(4, '461', 'vpn', '2021-09-17 16:05:06'),
(5, '461', 'vpn', '2021-09-17 16:18:33'),
(6, '438', 'vpn', '2021-09-22 13:34:09'),
(7, '464', 'vpn', '2021-09-22 19:17:30'),
(8, '464', 'vpn', '2021-09-22 19:18:06'),
(9, '464', 'vpn', '2021-09-22 19:20:11'),
(10, '464', 'vpn', '2021-09-22 19:27:23'),
(11, '464', 'vpn', '2021-09-22 19:30:09'),
(12, '494', 'vpn', '2021-09-30 13:36:38'),
(13, '503', 'vpn', '2021-10-03 02:45:24'),
(14, '503', 'vpn', '2021-10-03 02:47:58'),
(15, '512', 'vpn', '2021-10-06 10:52:26'),
(16, '479', 'vpn', '2021-10-11 23:26:36'),
(17, '479', 'vpn', '2021-10-11 23:26:51'),
(18, '540', 'vpn', '2021-10-15 02:58:07'),
(19, '569', 'vpn', '2021-10-15 19:04:08'),
(20, '569', 'vpn', '2021-10-15 19:04:32'),
(21, '569', 'vpn', '2021-10-15 19:04:49'),
(22, '569', 'vpn', '2021-10-15 19:05:48'),
(23, '594', 'vpn', '2021-10-18 10:50:42'),
(24, '612', 'vpn', '2021-10-18 17:00:56'),
(25, '612', 'vpn', '2021-10-18 17:01:04'),
(26, '594', 'vpn', '2021-10-18 18:38:07'),
(27, '621', 'vpn', '2021-10-19 15:19:34'),
(28, '621', 'vpn', '2021-10-19 15:22:26'),
(29, '594', 'vpn', '2021-10-19 15:45:36'),
(30, '628', 'vpn', '2021-10-20 12:39:14'),
(31, '612', 'vpn', '2021-10-21 23:41:57'),
(32, '524', 'vpn', '2021-10-27 22:16:11'),
(33, '674', 'vpn', '2021-10-29 12:42:29'),
(34, '674', 'vpn', '2021-10-29 12:42:52'),
(35, '591', 'vpn', '2021-11-01 19:18:35'),
(36, '594', 'vpn', '2021-11-07 13:49:14'),
(37, '722', 'vpn', '2021-11-07 20:14:18'),
(38, '722', 'vpn', '2021-11-07 20:14:26'),
(39, '722', 'vpn', '2021-11-07 20:32:36'),
(40, '722', 'vpn', '2021-11-07 20:36:25'),
(41, '722', 'vpn', '2021-11-08 22:10:42'),
(42, '722', 'vpn', '2021-11-10 07:52:39'),
(43, '722', 'vpn', '2021-11-10 22:08:27'),
(44, '720', 'vpn', '2021-11-10 22:31:20'),
(45, '720', 'vpn', '2021-11-11 10:18:33'),
(46, '720', 'vpn', '2021-11-11 11:00:17'),
(47, '720', 'vpn', '2021-11-11 11:01:02'),
(48, '720', 'vpn', '2021-11-12 11:34:58'),
(49, '720', 'vpn', '2021-11-13 10:06:25'),
(50, '722', 'vpn', '2021-11-15 15:56:41'),
(51, '795', 'vpn', '2021-11-25 04:02:45'),
(52, '712', 'vpn', '2021-11-27 18:46:15'),
(53, '712', 'vpn', '2021-11-28 07:53:08'),
(54, '722', 'vpn', '2021-12-01 14:50:42'),
(55, '758', 'vpn', '2021-12-12 12:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `offerwall`
--

CREATE TABLE `offerwall` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerwall`
--

INSERT INTO `offerwall` (`id`, `title`, `description`, `thumb`, `type`, `data`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Tapjoy', 'Complete offer & get bonus', '61d1a3893b710_1641128841.webp', 'sdk', '[{\"offername\":\"Tapjoy\",\"placement\":\"AppLaunch\",\"appid\":\"f7uFKdsBRjSvRhH90mHyagECUlXm4hnEE9AyDQF6G6YmeJAXZWdaars2nyM1\",\"token\":\"v95vXtm2Daa1OdY9n7Mv\"}]', '0', '2022-01-02 07:37:21', '2022-01-05 13:00:04'),
(3, 'IronSource', 'Complete offer & get bonus', '61d1ba19b0a7d_1641134617.jpg', 'sdk', '[{\"offername\":\"IronSource\",\"placement\":\"DefaultOfferWall\",\"appid\":\"cdb29f75\",\"token\":null}]', '0', '2022-01-02 09:13:37', '2022-01-05 13:00:25'),
(4, 'AdGem', 'Complete offer & get Bonus', '61d1c831a0b75_1641138225.png', 'sdk', '[{\"offername\":\"adgem\",\"placement\":null,\"appid\":\"17949\",\"token\":null}]', '0', '2022-01-02 10:13:45', '2022-01-05 13:00:34'),
(5, 'OfferToro', 'complete offer get bonus', '61d1ca9049974_1641138832.png', 'sdk', '[{\"offername\":\"offerToro\",\"placement\":null,\"appid\":\"8060\",\"token\":\"ca3a51c0f2424f8c52e735444ac83b72\"}]', '0', '2022-01-02 10:23:52', '2022-01-05 13:00:45'),
(7, 'AdgateMedia', 'high payout offers', '61d28ae8ed997_1641188072.png', 'sdk', '[{\"offername\":\"AdgateMedia\",\"placement\":null,\"appid\":\"05a0e1ebfab8d5df1801daddddf326e5\",\"token\":null}]', '0', '2022-01-03 00:04:33', '2022-01-05 13:00:58'),
(8, 'CpaLead', 'Best Offers', '61d5982b3070b_1641388075.png', 'api', '[{\"offername\":\"cpalead\",\"offer_api_url\":\"https:\\/\\/cpalead.com\\/dashboard\\/reports\\/campaign_json.php?id=1406515&offer_type=mobile&device=android&show=20&subid3={app_uid}&gaid={app_gaid}\",\"header\":null,\"json_array\":\"offers\",\"key_campid\":\"campid\",\"key_title\":\"title\",\"key_description\":\"description\",\"key_amount\":\"amount\",\"key_icon_url\":\"creatives,0,url\",\"key_offer_link\":\"link\",\"key_extra_suffix\":null,\"userid\":\"subid={subid}\"}]', '0', '2022-01-05 07:37:55', '2022-01-07 16:11:00'),
(9, 'Cpalead', 'Cpalead web offerwall', '61dba23a39a36_1641783866.png', 'web', '[{\"offername\":\"cpalead\",\"offerwall_url\":\"https:\\/\\/fastrsrvr.com\\/list\\/452511?subid={subid}\",\"header\":null,\"userid\":\"subid={subid}\"}]', '0', '2022-01-09 21:34:26', '2022-01-10 03:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `id` int NOT NULL,
  `userid` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `trans_id` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `coin` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pacinfo` text COLLATE utf8mb4_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postback`
--

CREATE TABLE `postback` (
  `id` int NOT NULL,
  `offerwall_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `offerwall_name` varchar(255) DEFAULT NULL,
  `p_userid` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p_payout` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p_campaing_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p_ip` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `p_offername` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `postback_url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postback`
--

INSERT INTO `postback` (`id`, `offerwall_id`, `offerwall_name`, `p_userid`, `p_payout`, `p_campaing_id`, `p_ip`, `p_offername`, `postback_url`, `created_at`, `updated_at`) VALUES
(1, '2', 'Tapjoy', 'snuid={snuid}', 'currency={currency}', '', '', '', 'api/v1/offer_cr/2?signs=ZrKcDhGb1oOCJ4&snuid={snuid}&currency={currency}', '2022-01-05 11:31:11', NULL),
(2, '3', 'IronSource', 'appUserId=[USER_ID]', 'rewards=[REWARDS]', 'eventId=[EVENT_ID]', '', '', 'api/v1/offer_cr/3?signs=ZrKcDhGb1oOCJ4&appUserId=[USER_ID]&rewards=[REWARDS]&eventId=[EVENT_ID]', '2022-01-05 11:31:11', NULL),
(3, '4', 'adgem', 'userid=[user_id]', 'amount={amount}', '', '', '', 'api/v1/offer_cr/4?signs=ZrKcDhGb1oOCJ4&userid=[user_id]&amount={amount}', '2022-01-05 11:31:11', NULL),
(4, '5', 'offerToro', 'click_id={click_id}', 'payout={amount}', '', '', '', 'api/v1/offer_cr/5?signs=ZrKcDhGb1oOCJ4&click_id={click_id}&payout={amount}', '2022-01-05 11:31:11', NULL),
(5, '7', 'AdgateMedia', 'user_id={s1}', 'point_value={points}', 'tx_id={transaction_id}', '', '', 'api/v1/offer_cr/7?signs=ZrKcDhGb1oOCJ4&user_id={s1}&point_value={points}&tx_id={transaction_id}', '2022-01-05 11:31:11', NULL),
(6, '8', 'cpalead', 'subid={subid}', 'payout={payout}', 'offer_id={campaing_id}', 'ip={ip_address}', NULL, 'api/v1/offer_cr/8?signs=ZrKcDhGb1oOCJ4&subid={subid}&payout={payout}&ip={ip_address}&offer_id={campaing_id}', '2022-01-05 13:07:55', NULL),
(7, '9', 'cpalead', 'subid={subid}', 'payout={payout}', 'offer_id={campaing_id}', 'ip={ip_address}', NULL, 'api/v1/offer_cr/9?signs=ZrKcDhGb1oOCJ4&subid={subid}&payout={payout}&ip={ip_address}&offer_id={campaing_id}', '2022-01-10 03:04:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int NOT NULL,
  `a` varchar(255) DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `b` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `c` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `d` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `coin` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `hint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `timer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_cat`
--

CREATE TABLE `quiz_cat` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `recharge_request`
--

CREATE TABLE `recharge_request` (
  `request_id` int NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `orginal_amount` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pointvalue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `placeholder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `input_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem_cat`
--

CREATE TABLE `redeem_cat` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int NOT NULL,
  `up_version` int DEFAULT NULL,
  `up_mode` varchar(255) DEFAULT NULL,
  `up_msg` text,
  `up_link` varchar(255) DEFAULT NULL,
  `up_btn` varchar(255) DEFAULT NULL,
  `up_status` varchar(255) DEFAULT NULL,
  `privacy_policy` text,
  `app_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `app_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `app_icon` varchar(255) DEFAULT NULL,
  `fb` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `startappid` varchar(255) DEFAULT NULL,
  `unity_gameid` varchar(255) DEFAULT NULL,
  `adcolony_appID` varchar(255) DEFAULT NULL,
  `adcolony_zoneid` varchar(255) DEFAULT NULL,
  `banner_type` varchar(255) DEFAULT NULL,
  `bannerid` varchar(255) DEFAULT NULL,
  `unity_reward` varchar(255) DEFAULT NULL,
  `unity_rewardid` varchar(255) DEFAULT NULL,
  `applovin_reward` varchar(255) DEFAULT NULL,
  `applovin_rewardID` varchar(255) DEFAULT NULL,
  `adcolony_reward` varchar(255) DEFAULT NULL,
  `statartapp_reward` varchar(255) DEFAULT NULL,
  `interstital` varchar(255) DEFAULT 'false',
  `interstital_count` varchar(255) DEFAULT NULL,
  `interstital_type` varchar(255) DEFAULT NULL,
  `interstital_ID` varchar(255) DEFAULT NULL,
  `refer_msg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `refer_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `up_version`, `up_mode`, `up_msg`, `up_link`, `up_btn`, `up_status`, `privacy_policy`, `app_name`, `app_version`, `app_author`, `app_contact`, `app_email`, `app_website`, `app_description`, `app_icon`, `fb`, `telegram`, `youtube`, `startappid`, `unity_gameid`, `adcolony_appID`, `adcolony_zoneid`, `banner_type`, `bannerid`, `unity_reward`, `unity_rewardid`, `applovin_reward`, `applovin_rewardID`, `adcolony_reward`, `statartapp_reward`, `interstital`, `interstital_count`, `interstital_type`, `interstital_ID`, `refer_msg`, `refer_text`) VALUES
(1, 1, 'maintenance', 'we are doing some functionality on server so for some hours app will be offline', 'https://play.google.com/store/apps/details?id=com.exmaple.app', 'true', 'false', 'https://www.google.com/', 'Reward App', '1.0', 'Reward App', '00000000', 'contactus@gmail.com', 'https://www.google.com/', '<p>Welcome to&nbsp;Reward App</p>', NULL, 'https://www.google.com/', 'https://www.google.com/', 'https://www.google.com/', '208493363', '3774315', 'app3773491d52884cda81', 'vz8d73248fc9a448d7af', 'applovin', '9fe049bb7f928198', 'true', 'Android_Rewarded', 'true', 'b74ed746a468ce24', 'false', 'true', 'true', '1', 'startapp', 'video', '<pre>\r\n💰💰💰💰 \r\n✅ Earn Paypal Rewards, Pubg UC, Freefire Diamonds\r\n✅ Invite your friend Earn\r\n✅ Download Now&nbsp;</pre>', '<p><img alt=\"\" src=\"https://www.rewardco.com.au/wp-content/uploads/2021/09/referral-programs-0.png\" /></p>\r\n\r\n<p><span style=\"color:#2ecc71\"><strong><big>Invite Your Friend and Get Bonus</big></strong></span></p>\r\n\r\n<p><strong><span style=\"background-color:#f1c40f\">How Can i Earn by Invite</span></strong></p>\r\n\r\n<ul>\r\n	<li><span style=\"color:#ffffff\">When your friend submit first Redeem you got 150 coin.</span></li>\r\n	<li><span style=\"color:#ffffff\">you can earn unlimited by invite friend</span></li>\r\n</ul>');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int NOT NULL,
  `tran_type` varchar(50) NOT NULL DEFAULT 'credit',
  `type` varchar(50) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `api_type` varchar(50) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `taskId` int DEFAULT NULL,
  `webId` int DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `spinhit` int DEFAULT NULL,
  `quiz` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT '0',
  `scrath` int DEFAULT NULL,
  `game` varchar(255) DEFAULT NULL,
  `eventId` varchar(255) DEFAULT NULL,
  `offerwall_type` varchar(255) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `remained_balance` float(10,2) DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `admin_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `weblink`
--

CREATE TABLE `weblink` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `timer` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '0',
  `type` varchar(255) DEFAULT 'Admin',
  `userid` varchar(255) DEFAULT NULL,
  `task_limit` varchar(255) DEFAULT NULL,
  `insert_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wheel_points`
--

CREATE TABLE `wheel_points` (
  `id` int NOT NULL,
  `position_1` varchar(255) NOT NULL,
  `position_2` varchar(255) NOT NULL,
  `position_3` varchar(255) NOT NULL,
  `position_4` varchar(255) NOT NULL,
  `position_5` varchar(255) NOT NULL,
  `position_6` varchar(255) NOT NULL,
  `position_7` varchar(255) NOT NULL,
  `position_8` varchar(255) NOT NULL,
  `pc_1` varchar(255) NOT NULL,
  `pc_2` varchar(255) NOT NULL,
  `pc_3` varchar(255) NOT NULL,
  `pc_4` varchar(255) NOT NULL,
  `pc_5` varchar(255) NOT NULL,
  `pc_6` varchar(255) NOT NULL,
  `pc_7` varchar(255) NOT NULL,
  `pc_8` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wheel_points`
--

INSERT INTO `wheel_points` (`id`, `position_1`, `position_2`, `position_3`, `position_4`, `position_5`, `position_6`, `position_7`, `position_8`, `pc_1`, `pc_2`, `pc_3`, `pc_4`, `pc_5`, `pc_6`, `pc_7`, `pc_8`) VALUES
(1, '50', '10', '15', '0', '8', '40', '10', '80', '#8193ca', '#c25151', '#4eb75f', '#bd61b5', '#c2bf56', '#55c1c3', '#5f5645', '#000000');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_video`
--

CREATE TABLE `youtube_video` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `video_id` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `timer` varchar(255) DEFAULT NULL,
  `point` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `task_limit` varchar(255) DEFAULT NULL,
  `insert_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL DEFAULT 'Admin',
  `userid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appsname`
--
ALTER TABLE `appsname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coinstore`
--
ALTER TABLE `coinstore`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitor_report`
--
ALTER TABLE `monitor_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerwall`
--
ALTER TABLE `offerwall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `postback`
--
ALTER TABLE `postback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_cat`
--
ALTER TABLE `quiz_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharge_request`
--
ALTER TABLE `recharge_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `redeem_cat`
--
ALTER TABLE `redeem_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weblink`
--
ALTER TABLE `weblink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wheel_points`
--
ALTER TABLE `wheel_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_video`
--
ALTER TABLE `youtube_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appsname`
--
ALTER TABLE `appsname`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coinstore`
--
ALTER TABLE `coinstore`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `monitor_report`
--
ALTER TABLE `monitor_report`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `offerwall`
--
ALTER TABLE `offerwall`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postback`
--
ALTER TABLE `postback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_cat`
--
ALTER TABLE `quiz_cat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recharge_request`
--
ALTER TABLE `recharge_request`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeem_cat`
--
ALTER TABLE `redeem_cat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weblink`
--
ALTER TABLE `weblink`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wheel_points`
--
ALTER TABLE `wheel_points`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `youtube_video`
--
ALTER TABLE `youtube_video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
