-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2024 at 03:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_guider`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `first_name`, `last_name`, `email`, `city`, `state`, `zip_code`, `country`, `gender`, `dob`, `phone_number`, `created_at`, `updated_at`, `active_status`) VALUES
(4, 5, 'Malshan', 'Hansaka', 'malshanprof@gmail.com', 'Mirigama', 'Gampha', 11200, 'LK', 'Male', '1996-12-31', 786334111, '2024-06-24 03:10:38', '2024-06-24 03:10:38', 1),
(5, 6, 'Malshan', 'Hansaka', 'mhansaka095@gmail.com', 'Colombo', 'Colombo', 112225, 'LK', 'Male', '1999-11-11', 74111414, '2024-07-07 01:34:39', '2024-07-07 01:39:54', 1),
(6, 7, 'Kasun', 'Sanka', 'strangervide@gmail.com', 'Mirigama', 'Gampha', 11200, 'LK', 'Male', '1999-02-10', 711144525, '2024-07-25 22:12:49', '2024-07-25 22:12:49', 1),
(7, 8, 'Kusal', 'Perera', 'cmcsl2023@gmail.com', 'Gampaha', 'Gampaha', 115455, 'LK', 'Male', '1999-10-20', 714411414, '2024-07-28 01:40:11', '2024-07-28 01:44:27', 1),
(8, 10, 'Test', 'Test user', 'wajofod797@obisims.com', 'Mirigama', 'Gampha', 11200, 'LK', 'Male', '1999-12-10', 741114123, '2024-09-07 06:07:09', '2024-09-07 07:33:33', 1),
(9, 11, 'Admin', 'User', 'rajatex339@konetas.com', 'Gampaha', 'Gampaha', 11200, 'LK', 'Male', '1994-01-15', 771442545, '2024-09-07 07:58:12', '2024-09-07 07:58:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `Is_Read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `message`, `Is_Read`, `created_at`, `updated_at`) VALUES
(1, 'sathsara perera', 'malshanonline11@gmail.com', 'Website loading error', 'Errrorrrrrrrrrrrrrrrrrrr', 1, '2024-06-24 05:20:07', '2024-06-28 22:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_url` varchar(255) DEFAULT NULL,
  `waiting_time` time NOT NULL DEFAULT '00:40:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `icon`, `picture`, `latitude`, `longitude`, `created_at`, `updated_at`, `view_url`, `waiting_time`) VALUES
(2, 'Turtle Beach - Hikkaduwa', 'location_icons/HaUePhitW3vTYVO7YPDLnVyzB7sZYErm7DikfRoC.png', '360_view_pictures/7WWAGsmOWJ0sr8FjrCWrEYwScbiYnoHHpcEyYPq5.jpg', 6.1315089, 80.0996017, '2024-06-24 03:07:40', '2024-06-24 03:07:40', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.131631199999999,80.0997043&heading=0&pitch=0&fov=75', '00:40:00'),
(4, 'Colombo Lotus Tower', 'location_icons/XK8cWQBFNxlIIR72CHVgbeutBuF7nlhhyaWrL1i9.png', '360_view_pictures/Ve5oxB8fkvjVSQCVXWTBI6GpX7Hm8u8Q9KBoCRge.jpg', 6.9273215, 79.8584175, '2024-06-24 03:08:32', '2024-06-24 03:08:32', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.9272949,79.8584587&heading=0&pitch=0&fov=75', '00:40:00'),
(5, 'Arugam Bay Beach', 'location_icons/0yzwp3oXmvIFUhcvpeFsH4szecAPFkpQfAzoDQQD.png', '360_view_pictures/5ySGjxwCIqatSFD0t24noJHcqW0k8TNze4e9CCKB.jpg', 6.8405331, 81.8368149, '2024-06-24 05:24:35', '2024-06-24 05:24:35', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.840492599999999,81.83689249999999&heading=0&pitch=0&fov=75', '00:40:00'),
(6, 'Ruwanweli Maha Seya', 'location_icons/IING1KOr0VMne8mudRR6wyHcXidaNtiDhJLzBriK.png', '360_view_pictures/yGynWn1dPO01VEC7lEWBsWLubdqtdM2c2cltN5K4.jpg', 8.3501056, 80.3962326, '2024-06-24 05:26:38', '2024-06-24 05:26:38', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=8.3500445,80.3963586&heading=0&pitch=0&fov=75', '00:40:00'),
(7, 'Sri Dalada Maligawa', 'location_icons/1i1vX9u019ouR4dSdmTuCD44tDlSqBnNFa6RanX3.png', '360_view_pictures/egO0IxZ2fmp6pGXX4mkRkZRmscwhGWASmkNEL92q.jpg', 7.2936396, 80.6413221, '2024-06-24 05:27:29', '2024-06-24 05:27:29', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=7.293648978184465,80.64131403162719&heading=0&pitch=0&fov=75', '00:40:00'),
(8, 'Jaffna Public Library', 'location_icons/V11B5FoHDt45pPxbuvygN7c61zp2Ng8AYpbTSfwf.png', '360_view_pictures/K6fv5zRP9K8tgSTadK0gPEjTE6jbkt4rvto9eAZ0.jpg', 9.6620577, 80.0118828, '2024-06-24 06:14:55', '2024-06-24 06:14:55', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=9.6620891,80.0119019&heading=0&pitch=0&fov=75', '00:40:00'),
(9, 'Horton Plains', 'location_icons/DtPNRPkDgWY6smvZAnYjr5SrsHLPoRHhr1Pb8q9o.png', '360_view_pictures/d3wjb9n1PewVpWAIQ4r4Rw39nnSKiyoZJx2zjYCP.jpg', 6.8031202, 80.8089924, '2024-06-24 06:15:54', '2024-06-24 06:15:54', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.801885973542636,80.80862883079193&heading=0&pitch=0&fov=75', '00:40:00'),
(10, 'Horton Plains', 'location_icons/EBMgDRXvoNY1WMVlaOwrXeCHCrD8I4JipakDdmbR.png', '360_view_pictures/fe4RUenbg6Z3iQP43CFuqQlYY7W9XWnJzziwsb0i.jpg', 6.8031202, 80.8089924, '2024-06-24 06:15:56', '2024-06-24 06:15:56', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.801885973542636,80.80862883079193&heading=0&pitch=0&fov=75', '00:40:00'),
(11, 'Mullaitivu Beach', 'location_icons/PGvG02DrtRWGuqW4KGw39dRSYMDF8iRLjovTl16f.png', '360_view_pictures/mDcd26nYn3jG3Yf3rmSxRitXA7bWPhonuHg5X5u1.jpg', 9.2716409, 80.8194637, '2024-07-25 22:21:30', '2024-07-25 22:21:30', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=9.271618,80.8194644&heading=0&pitch=0&fov=75', '00:40:00'),
(12, 'Kudawa Beach Kalpitiya', 'location_icons/wwVIgckDsrg5P3cNAUEue9EuHFUQuEcUTPWh52LD.png', '360_view_pictures/49ZROsImnz5hCDufvwM65QnT9RKQBj25884YjZDz.jpg', 8.2274607, 79.7281265, '2024-07-28 01:53:42', '2024-07-28 01:53:42', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=8.227305399999999,79.7281564&heading=0&pitch=0&fov=75', '00:40:00'),
(13, 'Colombo Galle face', 'location_icons/2d2V6oibl99NF1todOWwt99g99lO2PvN1lGeWOhu.png', '360_view_pictures/q2mfYgTr6yrgGMJcohSAoRn8Sh36Apii1sipoCoC.jpg', 6.9148389, 79.8479462, '2024-07-28 01:58:50', '2024-07-28 01:58:50', 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=6.9148022000000005,79.84787089999999&heading=0&pitch=0&fov=75', '00:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_03_17_041835_create_locations_table', 1),
(7, '2024_05_19_061140_create_customers_table', 1),
(8, '2024_05_25_081453_create_trips_table', 1),
(9, '2024_05_25_082330_create_user_locations_table', 1),
(10, '2024_05_27_051757_make_view_url_nullable_in_locations_table', 1),
(11, '2024_06_16_105955_create_notifications_table', 1),
(12, '2024_06_17_043135_add_is_active_to_users_table', 1),
(13, '2024_06_17_082756_add_is_admin_to_notification_table', 1),
(14, '2024_06_17_103439_create_feedback_table', 1),
(15, '2024_06_24_081612_add_active_status_to_cutomer', 2),
(16, '2024_06_24_082006_add_user__level_to_users', 3),
(17, '2024_06_24_083014_add_profile_pic_to_users', 4),
(18, '2024_06_24_084529_add_waiting_time_to_locations', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Detail` varchar(255) NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_For_Admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `Detail`, `IsActive`, `user_id`, `created_at`, `updated_at`, `is_For_Admin`) VALUES
(3, 'New customer registered. Customer ID: 3', 0, 3, '2024-06-24 02:56:49', '2024-06-24 02:56:49', 1),
(4, 'New customer registered. Customer ID: 4', 1, 5, '2024-06-24 03:10:38', '2024-06-28 06:13:28', 1),
(5, 'Your trip to My First trip has been created successfully.', 1, 5, '2024-06-24 03:14:25', '2024-06-28 06:13:28', 0),
(6, 'Your trip to My First trip has been created successfully.', 1, 5, '2024-06-24 03:19:20', '2024-06-28 06:13:28', 0),
(7, 'Your trip to Test trip has been created successfully.', 1, 5, '2024-06-24 06:05:21', '2024-06-28 06:13:28', 0),
(8, 'Your trip to testing has been created successfully.', 1, 5, '2024-06-24 06:18:59', '2024-06-28 06:13:28', 0),
(9, 'Your trip to My trip has been created successfully.', 0, 5, '2024-06-28 07:50:26', '2024-06-28 07:50:26', 0),
(10, 'New customer registered. Customer ID: 5', 0, 6, '2024-07-07 01:34:39', '2024-07-07 01:34:39', 1),
(11, 'New customer registered. Customer ID: 6', 0, 7, '2024-07-25 22:12:49', '2024-07-25 22:12:49', 1),
(12, 'Your trip to My Weekend has been created successfully.', 0, 7, '2024-07-25 22:16:31', '2024-07-25 22:16:31', 0),
(13, 'New customer registered. Customer ID: 7', 0, 8, '2024-07-28 01:40:11', '2024-07-28 01:40:11', 1),
(14, 'Your trip to First Trip has been created successfully.', 0, 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31', 0),
(15, 'Your trip to Testing has been created successfully.', 0, 8, '2024-07-28 01:49:59', '2024-07-28 01:49:59', 0),
(16, 'New customer registered. Customer ID: 8', 0, 10, '2024-09-07 06:07:09', '2024-09-07 06:07:09', 1),
(17, 'New customer registered. Customer ID: 9', 0, 11, '2024-09-07 07:58:12', '2024-09-07 07:58:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('malshanhd11@gmail.com', '$2y$12$A97U3IMKvL4J1i8VoZtJsuuupEq5jO141yrr2E/l0yamVBmyr2zyS', '2024-09-07 07:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `travelling_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `trip_name`, `travelling_date`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'My First trip', '2024-06-29', 5, '2024-06-24 03:19:20', '2024-06-24 03:19:20'),
(3, 'Test trip', '2024-06-26', 5, '2024-06-24 06:05:21', '2024-06-24 06:05:21'),
(4, 'testing', '2024-06-26', 5, '2024-06-24 06:18:59', '2024-06-24 06:18:59'),
(5, 'My trip', '2024-06-30', 5, '2024-06-28 07:50:26', '2024-06-28 07:50:26'),
(6, 'My Weekend', '2024-07-27', 7, '2024-07-25 22:16:31', '2024-07-25 22:16:31'),
(7, 'First Trip', '2024-07-30', 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31'),
(8, 'Testing', '2024-07-30', 8, '2024-07-28 01:49:59', '2024-07-28 01:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_Level` tinyint(1) NOT NULL DEFAULT 0,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_active`, `user_Level`, `profile_pic`) VALUES
(3, 'Malshan', 'malshanhd11@gmail.com', '2024-06-24 02:58:02', '$2y$12$ZUyUH/Skr2ge0/nX.30lxOGc0Wt8Njm1dd9WULBYkoi9tA/wZp3Fm', NULL, '2024-06-24 02:56:49', '2024-06-24 03:01:37', 1, 1, 'profile_pictures/MQLtyHJbvqlTeTN20VKJ6wUBF4UZpZpb86smqYcn.png'),
(4, 'Admin', 'mytravel1107@gmail.com', '2024-06-24 03:09:22', '$2y$12$2rlrN1MJkIJAkHt1qH/XbeWpXpMaPP1sboOwiWxdU9ZYWjDVOWiwe', NULL, '2024-06-24 03:09:23', '2024-06-24 03:09:23', 1, 3, 'profile.jpg'),
(5, 'Malshan', 'malshanprof@gmail.com', '2024-06-24 03:11:43', '$2y$12$MLJr12vk1Gv82Zyx6hpg3O19gt6K1yWaWEZik8IW5Qo1qvEaLrMhC', NULL, '2024-06-24 03:10:38', '2024-06-24 03:11:43', 1, 2, 'profile.jpg'),
(6, 'Malshan', 'mhansaka095@gmail.com', '2024-07-07 01:35:14', '$2y$12$9A7RKReIdHXG3KD87/B1.OC8A7zeJ4v6WQuBVyjPk5UIi7bMxM/WO', NULL, '2024-07-07 01:34:39', '2024-07-07 01:40:46', 1, 2, 'profile_pictures/yf0qn3nToulovPRAUrWjn4GiNYX2Jvj8OfLEC4ms.png'),
(7, 'Kasun', 'strangervide@gmail.com', '2024-07-25 22:13:48', '$2y$12$97EgXeQhF1U37rqetXmsteTGg8BGlMKOg4cvukXVILF90pPLdEglC', NULL, '2024-07-25 22:12:49', '2024-07-25 22:13:48', 1, 2, 'profile.jpg'),
(8, 'Kusal', 'cmcsl2023@gmail.com', '2024-07-28 01:41:01', '$2y$12$moWjj/Zh.9gvM5sDONdOYuCGWdJwkNZjZGme/39d0nQAjHyIFxcYa', NULL, '2024-07-28 01:40:11', '2024-07-28 01:45:05', 1, 2, 'profile_pictures/55Jt3xgQrbyva8YEUnQmBelli8MYFqhY1XvwY4Lh.png'),
(9, 'Malshan Hansaka', 'luveemosys@gmail.com', '2024-07-28 01:55:46', '$2y$12$Sy6zPeYqtRDBqQfVlRHQn.WJ0.H0S6BNbL2bMxNKPuC3IdcRYkxc.', NULL, '2024-07-28 01:55:48', '2024-07-28 01:55:48', 1, 3, 'profile.jpg'),
(10, 'Test', 'wajofod797@obisims.com', '2024-09-07 06:07:43', '$2y$12$wLTM4l/xdfl27iohB9vtYOQq6PZt0jRxA2WdJYT3zyFJijUWYCKaC', NULL, '2024-09-07 06:07:09', '2024-09-07 06:07:43', 1, 2, 'profile.jpg'),
(11, 'Admin', 'admin@travelguider.com', '2024-09-07 07:58:33', '$2y$12$2cSe8PNJcykCnaJuEW/fdOmVzAx0.eNmf/TK6sF7Mh3KyKSDg.D7u', NULL, '2024-09-07 07:58:12', '2024-09-07 07:58:33', 1, 1, 'profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `trip_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `location_id`, `trip_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 2, 2, 5, '2024-06-24 03:19:20', '2024-06-24 03:19:20'),
(6, 4, 2, 5, '2024-06-24 03:19:20', '2024-06-24 03:19:20'),
(7, 4, 3, 5, '2024-06-24 06:05:21', '2024-06-24 06:05:21'),
(8, 2, 3, 5, '2024-06-24 06:05:21', '2024-06-24 06:05:21'),
(10, 6, 3, 5, '2024-06-24 06:05:21', '2024-06-24 06:05:21'),
(11, 7, 3, 5, '2024-06-24 06:05:21', '2024-06-24 06:05:21'),
(12, 10, 4, 5, '2024-06-24 06:18:59', '2024-06-24 06:18:59'),
(13, 7, 4, 5, '2024-06-24 06:18:59', '2024-06-24 06:18:59'),
(14, 5, 4, 5, '2024-06-24 06:18:59', '2024-06-24 06:18:59'),
(15, 6, 4, 5, '2024-06-24 06:18:59', '2024-06-24 06:18:59'),
(16, 10, 5, 5, '2024-06-28 07:50:26', '2024-06-28 07:50:26'),
(17, 7, 5, 5, '2024-06-28 07:50:26', '2024-06-28 07:50:26'),
(18, 5, 5, 5, '2024-06-28 07:50:26', '2024-06-28 07:50:26'),
(19, 7, 6, 7, '2024-07-25 22:16:31', '2024-07-25 22:16:31'),
(20, 10, 6, 7, '2024-07-25 22:16:31', '2024-07-25 22:16:31'),
(21, 2, 6, 7, '2024-07-25 22:16:31', '2024-07-25 22:16:31'),
(22, 7, 7, 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31'),
(23, 6, 7, 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31'),
(24, 11, 7, 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31'),
(25, 8, 7, 8, '2024-07-28 01:48:31', '2024-07-28 01:48:31'),
(26, 5, 8, 8, '2024-07-28 01:49:59', '2024-07-28 01:49:59'),
(27, 7, 8, 8, '2024-07-28 01:49:59', '2024-07-28 01:49:59'),
(28, 10, 8, 8, '2024-07-28 01:49:59', '2024-07-28 01:49:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trips_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_locations_user_id_foreign` (`user_id`),
  ADD KEY `user_locations_trip_id_foreign` (`trip_id`),
  ADD KEY `user_locations_location_id_foreign` (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD CONSTRAINT `user_locations_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_locations_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
