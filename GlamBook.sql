-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2025 at 12:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GlamBook`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `booking_time` time NOT NULL,
  `description` text DEFAULT NULL,
  `booking_date` date DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `phone`, `email`, `category`, `location`, `booking_time`, `description`, `booking_date`, `created_at`, `user_id`) VALUES
(9, 'mounia touil', '1234567890', 'demo.client@example.com', 'Hair', 'salon hair', '11:09:00', 'hair appointement', '2025-07-22', '2025-07-22 00:06:35', 26);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category`, `description`, `email`, `location`, `price`, `duration`, `created_at`) VALUES
(81, 'Luxe Locks Salon	', 'Hair', 'Precision women’s haircut with blow-dry and scalp massage.', 'luxelocks@glamga.com', '123 Peachtree St NE, Atlanta, GA 30303	', 50.00, 30, '2025-07-20 13:44:28'),
(84, 'Braids &amp; Beauty Bar', 'Hair', 'Knotless box braids (mid-back), hair included, protective styling.', 'braidsbar@glamga.com', '2500 Wesley Chapel Rd, Decatur, GA 30035', 140.00, 120, '2025-07-20 13:55:22'),
(85, 'The Fade District', 'Hair', 'Crisp fade with razor detailing and hot towel finish for men.', 'fadedistrict@glamga.com', '800 Glenwood Ave SE, Atlanta, GA 30316', 40.00, 50, '2025-07-20 13:57:03'),
(86, 'Sunlight Highlights', 'Hair', 'Full balayage with toner and moisture gloss for shiny, warm tones.', 'highlights@glamga.com', '3000 Windy Hill Rd SE, Marietta, GA 30067', 180.00, 180, '2025-07-20 13:59:54'),
(87, 'BlowBar Express', 'Hair', 'Quick blowout and volume lift with Argan oil treatment.', 'blowbar@glamga.com', '150 Montgomery St, Savannah, GA 31401', 55.00, 45, '2025-07-20 14:01:28'),
(88, 'Curls &amp; Coils Lounge', 'Hair', 'Curl definition + hydration for Type 3 &amp; 4 curls with steam treatment.', 'curlscoils@glamga.com', '1155 Mitchell Bridge Rd, Athens, GA 30606', 70.00, 60, '2025-07-20 14:02:59'),
(89, 'Glamboss Beauty Studio', 'Makeup', 'Full glam with lashes, contour, shimmer finish for events.', 'glamboss@glamga.com', '675 Ponce De Leon Ave NE, Atlanta, GA 30308', 90.00, 120, '2025-07-20 14:07:53'),
(90, 'Southern Bride Artistry', 'Makeup', 'Bridal package with waterproof HD finish + touch-up kit.', 'brideartistry@glamga.com', '1220 Augusta West Pkwy, Augusta, GA 30909', 220.00, 160, '2025-07-20 14:08:46'),
(91, 'Bare Beauty Makeup', 'Makeup', 'Light natural makeup for daytime or work portraits.', 'barebeauty@glamga.com', '1850 Epps Bridge Pkwy, Athens, GA 30606', 60.00, 30, '2025-07-20 14:09:39'),
(92, 'Smokey &amp; Sultry Looks', 'Makeup', 'Smokey eyes, bold lips, matte finish, includes mink lashes.', 'smokeyglam@glamga.com', '5975 Roswell Rd, Sandy Springs, GA 30328', 80.00, 60, '2025-07-20 14:10:23'),
(93, 'Teen Glam Packages', 'Makeup', 'Teen-friendly glowy makeup with sparkles &amp; gloss.', 'teenglam@glamga.com', '2700 North Point Pkwy, Alpharetta, GA 30005', 60.00, 45, '2025-07-20 14:11:07'),
(94, 'Artistic Editorial MUA', 'Makeup', 'High-concept makeup for modeling, color blending, &amp; glitter.', 'editorialmua@glamga.com', '1170 Howell Mill Rd NW, Atlanta, GA 30318', 130.00, 75, '2025-07-20 14:11:55'),
(95, 'Pure Zen Spa Lounge', 'Spa', 'Deep cleansing facial with massage, extractions, and botanicals.', 'purezen@glamga.com', '1075 Peachtree St NE, Atlanta, GA 30309', 75.00, 60, '2025-07-20 14:24:34'),
(96, 'Touch of Bliss Massage', 'Spa', 'Full-body massage with hot stones and lavender oils.', 'blissmassage@glamga.com', '202 Robert C Daniel Jr Pkwy, Augusta, GA 30909', 115.00, 90, '2025-07-20 14:25:38'),
(97, 'Glow Body &amp; Skin Bar', 'Spa', 'Detox body wrap with full exfoliation and shea butter finish.', 'glowbar@glamga.com', '214 W Broughton St, Savannah, GA 31401', 140.00, 120, '2025-07-20 14:27:59'),
(98, 'Men’s Recharge Spa', 'Spa', 'Spa for men – back massage, face steam, and beard oil relax.', 'menspa@glamga.com', '7200 North Lake Dr, Columbus, GA 31909', 85.00, 60, '2025-07-20 14:29:16'),
(99, 'Peaceful Foot Retreat', 'Spa', 'Reflexology session with peppermint soak and acupressure.', 'footretreat@glamga.com', '5080 Riverside Dr, Macon, GA 31210', 55.00, 45, '2025-07-20 14:35:07'),
(100, 'Harmony Wellness Spot', 'Spa', 'Guided meditation with neck wrap and shoulder massage.', 'harmonyspa@glamga.com', '196 Alps Rd, Athens, GA 30606', 95.00, 45, '2025-07-20 14:37:16'),
(102, 'Mounia Touil', 'Makeup', 'blow dry', 'demo.user@example.com', '200 Sample Rd, atlanta 30060', 50.00, 30, '2025-07-22 00:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `dob`, `username`, `created_at`) VALUES
(29, 'mounia touil', 'demo.user@example.com', '$2y$10$o/A8RPGZ4f/dYchZ3rhHqu8jTK63aRSO3LVjT6CCxTEEJSUsaputm', '5550100001', '2000-01-01', 'mtouil12', '2025-07-22 00:38:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
