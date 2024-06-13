-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2024, 13:30:03
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `pizza`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order2pizza`
--

CREATE TABLE `order2pizza` (
  `pizza_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `count` tinyint(3) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `order2pizza`
--

INSERT INTO `order2pizza` (`pizza_id`, `order_id`, `count`, `price`) VALUES
(2, 14, 2, 3131),
(2, 15, 2, 3131),
(2, 16, 2, 3131),
(2, 17, 2, 3131),
(2, 25, 1, 456),
(3, 25, 1, 111),
(1, 26, 1, 123),
(2, 27, 1, 456),
(11, 27, 1, 199);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `order2pizza`
--
ALTER TABLE `order2pizza`
  ADD KEY `pizza_id` (`pizza_id`,`order_id`),
  ADD KEY `pizza_id_2` (`pizza_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `order2pizza`
--
ALTER TABLE `order2pizza`
  ADD CONSTRAINT `order2pizza_ibfk_1` FOREIGN KEY (`pizza_id`) REFERENCES `pizzas` (`pizza_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order2pizza_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
