-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Време на генериране:  8 март 2024 в 08:18
-- Версия на сървъра: 10.4.28-MariaDB
-- Версия на PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `carprojectdb`
--

-- --------------------------------------------------------

--
-- Структура на таблица `consumes`
--

CREATE TABLE `consumes` (
  `id_cons` int(11) NOT NULL,
  `consume_type` varchar(120) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `kilometers` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `car` char(8) NOT NULL,
  `repair_shop` int(3) NOT NULL,
  `price` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `repair_shop`
--

CREATE TABLE `repair_shop` (
  `id` int(3) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone_number` char(10) DEFAULT NULL,
  `customers` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `static_data`
--

CREATE TABLE `static_data` (
  `license` char(8) NOT NULL,
  `car_owner` int(5) NOT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `coupe` varchar(45) DEFAULT NULL,
  `type_engine` varchar(20) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `wheels` varchar(45) DEFAULT NULL,
  `tyres` varchar(45) DEFAULT NULL,
  `oil_type` varchar(20) DEFAULT NULL,
  `production_year` year(4) DEFAULT NULL,
  `gearbox` varchar(20) DEFAULT NULL,
  `cubic` decimal(10,0) DEFAULT NULL,
  `kilometers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Схема на данните от таблица `static_data`
--

INSERT INTO `static_data` (`license`, `car_owner`, `brand`, `model`, `coupe`, `type_engine`, `hp`, `wheels`, `tyres`, `oil_type`, `production_year`, `gearbox`, `cubic`, `kilometers`) VALUES
('CA1111AA', 1, 'Citroen', 'C3', 'hatchback', 'Бензин', 75, '16', '250/50/123', 'f4w10', '2003', 'Ръчна', 2, 150000),
('CA1111AB', 1, 'Toyota', 'Yaris', 'hatchback', 'Бензин', 75, '16', '250/50/123', 'f4w10', '2013', 'Ръчна', 2, 150000),
('CA7672AB', 1, 'Renault', 'Clio', 'hatchback', 'Бензин', 75, '16', '250/50/123', 'f4w10', '2013', 'Ръчна', 2, 150000),
('CA7672AА', 1, 'Renault', 'Clio', 'hatchback', 'Бензин', 75, '16', '250/50/123', 'f4w10', '2013', 'Ръчна', 2, 150000),
('CB7064XA', 1, 'Renault', '330', 'coupe', 'Бензин', 75, '18', '250/50/123', 'f4w10', '2003', 'Ръчна', 2, 150000),
('CB7064XM', 1, 'Renault', 'Clio', 'hatchback', 'Бензин с газ', 75, '16', '250/50/123', 'f4w10', '2013', 'Ръчна', 2, 150000),
('CB8888MA', 1, 'BMW', '330', 'coupe', 'Бензин', 175, '18', '250/50/123', 'f4w10', '2003', 'Ръчна', 3, 150000),
('CB8888MM', 1, 'BMW', '330', 'coupe', 'Бензин', 175, '18', '250/50/123', 'f4w10', '2003', 'Ръчна', 3, 150000),
('CB8888MN', 1, 'BMW', '330', 'coupe', 'Бензин', 175, '18', '250/50/123', 'f4w10', '2003', 'Ръчна', 3, 150000);

-- --------------------------------------------------------

--
-- Структура на таблица `unplaned_repairs`
--

CREATE TABLE `unplaned_repairs` (
  `id_repair` int(11) NOT NULL,
  `unplanned_type` varchar(120) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `kilometers` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `car` char(8) NOT NULL,
  `repair_shop` int(3) NOT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `password`, `email`, `username`) VALUES
(1, '123', 'v.test@gamil.com', 'VD');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `consumes`
--
ALTER TABLE `consumes`
  ADD PRIMARY KEY (`id_cons`),
  ADD KEY `fk_Comsumes_Static_Data1_idx` (`car`),
  ADD KEY `fk_Comsumes_Repair_Shop1_idx` (`repair_shop`);

--
-- Индекси за таблица `repair_shop`
--
ALTER TABLE `repair_shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_repair_shop_users` (`customers`);

--
-- Индекси за таблица `static_data`
--
ALTER TABLE `static_data`
  ADD PRIMARY KEY (`license`),
  ADD KEY `fk_Static_Data_Users_idx` (`car_owner`);

--
-- Индекси за таблица `unplaned_repairs`
--
ALTER TABLE `unplaned_repairs`
  ADD PRIMARY KEY (`id_repair`),
  ADD KEY `fk_Unplaned_Repairs_Static_Data1_idx` (`car`),
  ADD KEY `fk_Unplaned_Repairs_Repair_Shop1_idx` (`repair_shop`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consumes`
--
ALTER TABLE `consumes`
  MODIFY `id_cons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `repair_shop`
--
ALTER TABLE `repair_shop`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unplaned_repairs`
--
ALTER TABLE `unplaned_repairs`
  MODIFY `id_repair` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `consumes`
--
ALTER TABLE `consumes`
  ADD CONSTRAINT `fk_Comsumes_Repair_Shop1` FOREIGN KEY (`repair_shop`) REFERENCES `repair_shop` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Comsumes_Static_Data1` FOREIGN KEY (`car`) REFERENCES `static_data` (`license`) ON DELETE CASCADE;

--
-- Ограничения за таблица `repair_shop`
--
ALTER TABLE `repair_shop`
  ADD CONSTRAINT `fk_repair_shop_users` FOREIGN KEY (`customers`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `static_data`
--
ALTER TABLE `static_data`
  ADD CONSTRAINT `fk_Static_Data_Users` FOREIGN KEY (`car_owner`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения за таблица `unplaned_repairs`
--
ALTER TABLE `unplaned_repairs`
  ADD CONSTRAINT `fk_Unplaned_Repairs_Repair_Shop1` FOREIGN KEY (`repair_shop`) REFERENCES `repair_shop` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Unplaned_Repairs_Static_Data1` FOREIGN KEY (`car`) REFERENCES `static_data` (`license`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
