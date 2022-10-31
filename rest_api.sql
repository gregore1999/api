-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 31 Οκτ 2022 στις 16:24:57
-- Έκδοση διακομιστή: 10.4.25-MariaDB
-- Έκδοση PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `rest_api`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `air_pollution`
--

CREATE TABLE `air_pollution` (
  `co` float NOT NULL,
  `no` float NOT NULL,
  `no2` float NOT NULL,
  `o3` float NOT NULL,
  `so2` float NOT NULL,
  `pm2_5` float NOT NULL,
  `pm10` float NOT NULL,
  `nh3` float NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `quality` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `loca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `air_pollution`
--

INSERT INTO `air_pollution` (`co`, `no`, `no2`, `o3`, `so2`, `pm2_5`, `pm10`, `nh3`, `Date`, `quality`, `id`, `loca_id`) VALUES
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 1, 1),
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 2, 1),
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 3, 1),
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 4, 1),
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 5, 1),
(211.95, 0, 5.18, 26.82, 0, 23.02, 25.93, 3.07, '2022-10-31', 3, 6, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 7, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 8, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 9, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 10, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 11, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 12, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 13, 1),
(211.95, 0, 5.18, 26.82, 0.55, 23.02, 25.93, 3.07, '2022-10-31', 3, 14, 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `location`
--

CREATE TABLE `location` (
  `Loc_id` int(11) NOT NULL,
  `City` varchar(40) NOT NULL,
  `lat` float NOT NULL,
  `longit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `location`
--

INSERT INTO `location` (`Loc_id`, `City`, `lat`, `longit`) VALUES
(1, 'thessaloniki', 40.6403, 22.9439),
(2, 'athens', 37.9795, 23.7162),
(3, 'larissa', 39.6372, 22.4203),
(4, 'kozani', 40.3011, 21.7864),
(5, 'naoussa', 40.6307, 22.0698),
(14, 'veroia', 40.5233, 22.2036);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `mean`
--

CREATE TABLE `mean` (
  `mean_id` int(11) NOT NULL,
  `temp` float NOT NULL,
  `temp_max` float NOT NULL,
  `temp_min` float NOT NULL,
  `humidity` float NOT NULL,
  `feels_like` float NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `loca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `mean`
--

INSERT INTO `mean` (`mean_id`, `temp`, `temp_max`, `temp_min`, `humidity`, `feels_like`, `Date`, `loca_id`) VALUES
(1, 292.115, 293.72, 290.283, 54.7, 291.496, '2022-10-29', 1),
(2, 291.571, 293.104, 289.741, 55.8, 290.927, '2022-10-29', 1),
(5, 290.895, 291.833, 289.76, 58, 290.24, '2022-10-30', 1),
(6, 290.809, 291.831, 289.638, 58.3, 290.153, '2022-10-30', 1),
(7, 290.765, 291.877, 289.534, 58.6, 290.112, '2022-10-30', 1),
(8, 290.67, 291.888, 289.29, 58.7, 290.01, '2022-10-30', 1),
(9, 290.575, 291.899, 289.046, 58.8, 289.908, '2022-10-30', 1),
(10, 290.499, 291.91, 288.87, 58.8, 289.824, '2022-10-30', 1),
(11, 291.12, 292.607, 289.454, 57.5, 290.473, '2022-10-31', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `mean_air`
--

CREATE TABLE `mean_air` (
  `co` float NOT NULL,
  `id` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `loca_id` int(11) NOT NULL,
  `nh3` float NOT NULL,
  `no` float NOT NULL,
  `no2` float NOT NULL,
  `o3` float NOT NULL,
  `pm2_5` float NOT NULL,
  `pm10` float NOT NULL,
  `so2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `mean_air`
--

INSERT INTO `mean_air` (`co`, `id`, `Date`, `loca_id`, `nh3`, `no`, `no2`, `o3`, `pm2_5`, `pm10`, `so2`) VALUES
(211.95, 1, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0),
(211.95, 2, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0),
(211.95, 3, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0),
(211.95, 4, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0.44);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `median`
--

CREATE TABLE `median` (
  `median_id` int(11) NOT NULL,
  `temp` float NOT NULL,
  `temp_max` float NOT NULL,
  `temp_min` float NOT NULL,
  `humidity` float NOT NULL,
  `feels_like` float NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `loca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `median`
--

INSERT INTO `median` (`median_id`, `temp`, `temp_max`, `temp_min`, `humidity`, `feels_like`, `Date`, `loca_id`) VALUES
(1, 290.22, 291.27, 288.96, 57, 289.47, '2022-10-29', 1),
(2, 290.08, 291.27, 288.375, 58, 289.345, '2022-10-29', 1),
(5, 290.85, 291.82, 289.74, 58, 290.19, '2022-10-30', 1),
(6, 290.85, 291.82, 289.74, 58, 290.19, '2022-10-30', 1),
(7, 290.85, 291.82, 289.74, 58, 290.19, '2022-10-30', 1),
(8, 290.85, 291.82, 289.74, 58, 290.19, '2022-10-30', 1),
(9, 290.85, 291.82, 289.74, 58, 290.19, '2022-10-30', 1),
(10, 290.495, 291.875, 289.155, 59.5, 289.84, '2022-10-30', 1),
(11, 290.325, 292.105, 288.66, 61, 289.69, '2022-10-31', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `median_air`
--

CREATE TABLE `median_air` (
  `co` float NOT NULL,
  `id` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `loca_id` int(11) NOT NULL,
  `nh3` float NOT NULL,
  `no` float NOT NULL,
  `no2` float NOT NULL,
  `o3` float NOT NULL,
  `pm2_5` float NOT NULL,
  `pm10` float NOT NULL,
  `so2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `median_air`
--

INSERT INTO `median_air` (`co`, `id`, `Date`, `loca_id`, `nh3`, `no`, `no2`, `o3`, `pm2_5`, `pm10`, `so2`) VALUES
(211.95, 0, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0),
(211.95, 0, '2022-10-31', 1, 3.07, 0, 5.18, 26.82, 23.02, 25.93, 0.55);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `weather`
--

CREATE TABLE `weather` (
  `w_id` int(11) NOT NULL,
  `temp` float NOT NULL,
  `temp_max` float NOT NULL,
  `temp_min` float NOT NULL,
  `humidity` int(11) NOT NULL,
  `feels_like` float NOT NULL,
  `sunrise` int(40) NOT NULL,
  `sunset` int(40) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `conditions` varchar(40) NOT NULL,
  `loca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `weather`
--

INSERT INTO `weather` (`w_id`, `temp`, `temp_max`, `temp_min`, `humidity`, `feels_like`, `sunrise`, `sunset`, `Date`, `conditions`, `loca_id`) VALUES
(1, 295.23, 297.43, 293.21, 49, 294.77, 58631, 10314, '2022-10-29', 'Clouds', 1),
(2, 295.23, 297.43, 293.21, 49, 294.77, 58631, 10314, '2022-10-29', 'Clouds', 1),
(3, 295.23, 297.43, 293.21, 49, 294.77, 58631, 10314, '2022-10-29', 'Clouds', 1),
(4, 295.71, 297.29, 294.12, 47, 295.25, 58631, 10314, '2022-10-29', 'Clouds', 1),
(5, 290.22, 291.27, 288.96, 57, 289.47, 58631, 10314, '2022-10-29', 'Clouds', 1),
(6, 290.22, 291.27, 288.96, 57, 289.47, 58631, 10314, '2022-10-29', 'Clouds', 1),
(7, 289.94, 291.27, 287.79, 59, 289.22, 58631, 10314, '2022-10-29', 'Clear', 1),
(8, 289.79, 291.27, 287.79, 60, 289.08, 58631, 10314, '2022-10-29', 'Clear', 1),
(9, 289.79, 291.27, 287.79, 60, 289.08, 58631, 10314, '2022-10-29', 'Clear', 1),
(10, 289.79, 291.27, 287.79, 60, 289.08, 58631, 10314, '2022-10-29', 'Clear', 1),
(11, 289.79, 291.27, 287.79, 60, 289.08, 58631, 10314, '2022-10-29', 'Clear', 1),
(12, 291.09, 291.62, 288.75, 56, 290.4, 58197, 10377, '2022-10-29', 'Clear', 2),
(13, 291.09, 291.62, 288.75, 56, 290.4, 58197, 10377, '2022-10-29', 'Clear', 2),
(14, 290.92, 291.62, 288.44, 56, 290.21, 58197, 10377, '2022-10-29', 'Clear', 2),
(15, 286.09, 286.09, 286.09, 71, 285.29, 58661, 10535, '2022-10-29', 'Rain', 3),
(16, 283.54, 285.46, 283.53, 50, 281.94, 58876, 10624, '2022-10-29', 'Clouds', 4),
(17, 287.85, 287.85, 285.92, 54, 286.79, 58840, 10524, '2022-10-29', 'Clear', 5),
(18, 287.85, 287.85, 285.92, 54, 286.79, 58840, 10524, '2022-10-29', 'Clear', 5),
(25, 286.26, 286.3, 284.15, 67, 285.38, 58867, 10427, '2022-10-30', 'Clear', 1),
(28, 286.77, 286.86, 284.15, 67, 285.94, 58867, 10427, '2022-10-30', 'Clear', 14),
(29, 291.58, 292.93, 289.79, 56, 290.94, 58701, 10238, '2022-10-30', 'Clear', 1),
(30, 291.58, 292.93, 289.79, 56, 290.94, 58701, 10238, '2022-10-30', 'Clear', 1),
(31, 291.58, 292.93, 289.79, 56, 290.94, 58701, 10238, '2022-10-30', 'Clear', 1),
(32, 291.58, 292.93, 289.79, 56, 290.94, 58701, 10238, '2022-10-30', 'Clear', 1),
(33, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(34, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(35, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(36, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(37, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(38, 291.13, 291.95, 289.79, 58, 290.5, 58701, 10238, '2022-10-30', 'Clear', 1),
(39, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(40, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(41, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(42, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(43, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(44, 291, 291.95, 289.79, 58, 290.36, 58701, 10238, '2022-10-30', 'Clear', 1),
(45, 290.95, 291.82, 289.79, 58, 290.3, 58701, 10238, '2022-10-30', 'Clear', 1),
(46, 290.95, 291.82, 289.79, 58, 290.3, 58701, 10238, '2022-10-30', 'Clear', 1),
(47, 290.95, 291.82, 289.79, 58, 290.3, 58701, 10238, '2022-10-30', 'Clear', 1),
(48, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(49, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(50, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(51, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(52, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(53, 290.85, 291.82, 289.74, 58, 290.19, 58701, 10238, '2022-10-30', 'Clear', 1),
(54, 290.14, 291.93, 288.57, 61, 289.49, 58701, 10238, '2022-10-30', 'Clear', 1),
(55, 290.51, 292.28, 288.75, 61, 289.89, 58702, 10240, '2022-10-30', 'Clear', 1),
(56, 290, 291.93, 287.35, 59, 289.28, 58701, 10238, '2022-10-30', 'Clear', 1),
(57, 290, 291.93, 287.35, 59, 289.28, 58701, 10238, '2022-10-30', 'Clear', 1),
(58, 290.09, 291.93, 287.98, 58, 289.35, 58701, 10238, '2022-10-30', 'Clear', 1),
(59, 297.06, 298.79, 295.58, 45, 296.68, 58771, 10163, '2022-10-31', 'Clear', 1);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `air_pollution`
--
ALTER TABLE `air_pollution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Ευρετήρια για πίνακα `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Loc_id`);

--
-- Ευρετήρια για πίνακα `mean`
--
ALTER TABLE `mean`
  ADD PRIMARY KEY (`mean_id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Ευρετήρια για πίνακα `mean_air`
--
ALTER TABLE `mean_air`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Ευρετήρια για πίνακα `median`
--
ALTER TABLE `median`
  ADD PRIMARY KEY (`median_id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- Ευρετήρια για πίνακα `median_air`
--
ALTER TABLE `median_air`
  ADD KEY `loca_id` (`loca_id`);

--
-- Ευρετήρια για πίνακα `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `loca_id` (`loca_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `air_pollution`
--
ALTER TABLE `air_pollution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT για πίνακα `location`
--
ALTER TABLE `location`
  MODIFY `Loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT για πίνακα `mean`
--
ALTER TABLE `mean`
  MODIFY `mean_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT για πίνακα `mean_air`
--
ALTER TABLE `mean_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `median`
--
ALTER TABLE `median`
  MODIFY `median_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT για πίνακα `weather`
--
ALTER TABLE `weather`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `air_pollution`
--
ALTER TABLE `air_pollution`
  ADD CONSTRAINT `air_pollution_ibfk_1` FOREIGN KEY (`loca_id`) REFERENCES `location` (`Loc_id`);

--
-- Περιορισμοί για πίνακα `mean`
--
ALTER TABLE `mean`
  ADD CONSTRAINT `mean_ibfk_1` FOREIGN KEY (`loca_id`) REFERENCES `location` (`Loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `mean_air`
--
ALTER TABLE `mean_air`
  ADD CONSTRAINT `mean_air_ibfk_1` FOREIGN KEY (`loca_id`) REFERENCES `location` (`Loc_id`);

--
-- Περιορισμοί για πίνακα `median`
--
ALTER TABLE `median`
  ADD CONSTRAINT `median_ibfk_1` FOREIGN KEY (`loca_id`) REFERENCES `location` (`Loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `weather`
--
ALTER TABLE `weather`
  ADD CONSTRAINT `weather_ibfk_1` FOREIGN KEY (`loca_id`) REFERENCES `location` (`Loc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
