-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 11:56 AM
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
-- Database: `real_estate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_sections`
--

CREATE TABLE `content_sections` (
  `id` int(11) NOT NULL,
  `identifier` varchar(50) NOT NULL,
  `type` enum('text','image','video','mixed') DEFAULT 'text',
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `code` char(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `is_default`, `is_active`) VALUES
(1, 'tr', 'Türkçe', 1, 1),
(2, 'ru', 'Русский', 0, 1),
(3, 'en', 'English', 0, 0),
(4, 'ar', 'العربية', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `success` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order_index` int(11) DEFAULT 0,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `order_index`, `icon`, `is_active`, `created_at`) VALUES
(1, NULL, 1, 'fa-home', 1, '2025-09-12 09:45:18'),
(2, NULL, 2, 'fa-building', 1, '2025-09-12 09:45:18'),
(3, NULL, 3, 'fa-landmark', 1, '2025-09-12 09:45:18'),
(4, NULL, 4, 'fa-info', 1, '2025-09-12 09:45:18'),
(5, NULL, 5, 'fa-phone', 1, '2025-09-12 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `menu_translations`
--

CREATE TABLE `menu_translations` (
  `id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_translations`
--

INSERT INTO `menu_translations` (`id`, `menu_item_id`, `language_code`, `title`, `url`) VALUES
(1, 1, 'tr', 'Ana Sayfa', 'index.php'),
(2, 2, 'tr', 'Mülkler', 'properties.php'),
(3, 3, 'tr', 'Araziler', 'lands.php'),
(4, 4, 'tr', 'Hakkımızda', 'about.php'),
(5, 5, 'tr', 'İletişim', 'contact.php'),
(6, 1, 'ru', 'Главная', 'index.php'),
(7, 2, 'ru', 'Недвижимость', 'properties.php'),
(8, 3, 'ru', 'Земельные участки', 'lands.php'),
(9, 4, 'ru', 'О нас', 'about.php'),
(10, 5, 'ru', 'Контакт', 'contact.php');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `type` enum('apartment','villa','land') NOT NULL,
  `purpose` enum('sale','rent') NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `area` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `agent_id` int(11) DEFAULT NULL,
  `is_hot` tinyint(1) DEFAULT 0,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `type`, `purpose`, `price`, `area`, `location`, `region`, `rooms`, `bathrooms`, `features`, `agent_id`, `is_hot`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'apartment', 'sale', 250000.00, 120.00, 'Istanbul, Beylikdüzü', 'Istanbul', 3, 2, '[\"Balcony\", \"Parking\", \"Air Conditioning\"]', NULL, 1, NULL, NULL, '2025-09-12 09:45:19', '2025-09-12 09:45:19'),
(2, 'villa', 'sale', 750000.00, 350.00, 'Istanbul, Sariyer', 'Istanbul', 5, 4, '[\"Garden\", \"Pool\", \"Garage\"]', NULL, 1, NULL, NULL, '2025-09-12 09:45:19', '2025-09-12 09:45:19'),
(3, 'apartment', 'rent', 1500.00, 85.00, 'Ankara, Çankaya', 'Ankara', 2, 1, '[\"Furnished\", \"Balcony\"]', NULL, 0, NULL, NULL, '2025-09-12 09:45:19', '2025-09-12 09:45:19'),
(4, 'land', 'sale', 100000.00, 500.00, 'Antalya, Konyaaltı', 'Antalya', NULL, NULL, '[\"Sea View\", \"Electricity\", \"Water\"]', NULL, 0, NULL, NULL, '2025-09-12 09:45:19', '2025-09-12 09:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_translations`
--

CREATE TABLE `property_translations` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `advantages` text DEFAULT NULL,
  `facilities` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_translations`
--

INSERT INTO `property_translations` (`id`, `property_id`, `language_code`, `title`, `description`, `advantages`, `facilities`) VALUES
(1, 1, 'tr', 'Lüks Beylikdüzü Dairesi', 'Geniş ve modern daire, mükemmel konumda', 'Deniz manzarası, merkezi konum', 'Yüzme havuzu, spor salonu, güvenlik'),
(2, 2, 'tr', 'Sarıyerde Lüks Villa', 'Muhteşem manzaralı lüks villa', 'Geniş bahçe, özel yüzme havuzu', 'Jakuzi, şömine, kapalı otopark'),
(3, 3, 'tr', 'Çankayada Kiralık Daire', 'Merkezi konumda ferah daire', 'Ulaşım kolaylığı, alışveriş merkezine yakın', 'Asansör, güvenlik, otopark'),
(4, 4, 'tr', 'Konyaaltında Arazi', 'Deniz manzaralı imarlı arazi', 'Şehir merkezine yakın, yatırım için ideal', 'Altyapı mevcut, elektrik ve su bağlantılı'),
(5, 1, 'ru', 'Роскошная квартира в Бейликдюзю', 'Просторная и современная квартира в отличном месте', 'Вид на море, центральное расположение', 'Бассейн, тренажерный зал, охрана'),
(6, 2, 'ru', 'Роскошная вилла в Сарыере', 'Роскошная вилла с потрясающим видом', 'Большой сад, частный бассейн', 'Джакузи, камин, закрытая парковка'),
(7, 3, 'ru', 'Аренда квартиры в Чанкае', 'Светлая квартира в центральном районе', 'Удобная транспортная развязка, близость к торговым центрам', 'Лифт, охрана, парковка'),
(8, 4, 'ru', 'Земельный участок в Коньяалты', 'Земельный участок с видом на море с планом застройки', 'Близко к центру города, идеально для инвестиций', 'Инфраструктура доступна, подключены электричество и вода');

-- --------------------------------------------------------

--
-- Table structure for table `section_styles`
--

CREATE TABLE `section_styles` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `font_family` varchar(100) DEFAULT NULL,
  `font_size` varchar(20) DEFAULT NULL,
  `font_color` varchar(7) DEFAULT NULL,
  `background_color` varchar(7) DEFAULT NULL,
  `custom_css` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_translations`
--

CREATE TABLE `section_translations` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','agent') DEFAULT 'agent',
  `full_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `qualifications` text DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `full_name`, `phone`, `qualifications`, `social_links`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Z9jD2GidK6cg6EpTjQYBhe1O140fUEpfc/rtDeCKdZlqjvwlfvsBW', 'admin@example.com', 'admin', 'Administrator', NULL, NULL, NULL, NULL, '2025-09-11 07:44:38', '2025-09-11 08:04:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_sections`
--
ALTER TABLE `content_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_menu_language` (`menu_item_id`,`language_code`),
  ADD KEY `language_code` (`language_code`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `property_translations`
--
ALTER TABLE `property_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_property_language` (`property_id`,`language_code`),
  ADD KEY `language_code` (`language_code`);

--
-- Indexes for table `section_styles`
--
ALTER TABLE `section_styles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `section_translations`
--
ALTER TABLE `section_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_section_language` (`section_id`,`language_code`),
  ADD KEY `language_code` (`language_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_sections`
--
ALTER TABLE `content_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu_translations`
--
ALTER TABLE `menu_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_translations`
--
ALTER TABLE `property_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `section_styles`
--
ALTER TABLE `section_styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_translations`
--
ALTER TABLE `section_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_translations`
--
ALTER TABLE `menu_translations`
  ADD CONSTRAINT `menu_translations_ibfk_1` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_translations_ibfk_2` FOREIGN KEY (`language_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_translations`
--
ALTER TABLE `property_translations`
  ADD CONSTRAINT `property_translations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_translations_ibfk_2` FOREIGN KEY (`language_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE;

--
-- Constraints for table `section_styles`
--
ALTER TABLE `section_styles`
  ADD CONSTRAINT `section_styles_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section_translations`
--
ALTER TABLE `section_translations`
  ADD CONSTRAINT `section_translations_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `content_sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_translations_ibfk_2` FOREIGN KEY (`language_code`) REFERENCES `languages` (`code`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
