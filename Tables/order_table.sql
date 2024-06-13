-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2024, 13:30:16
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
-- Tablo için tablo yapısı `order_table`
--

CREATE TABLE `order_table` (
  `order_id` int(50) NOT NULL,
  `adres_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `order_time` datetime NOT NULL DEFAULT current_timestamp(),
  `delivery` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `order_table`
--

INSERT INTO `order_table` (`order_id`, `adres_id`, `customer_id`, `order_time`, `delivery`) VALUES
(14, 1, 8, '2024-06-01 15:42:38', 1),
(15, 1, 8, '2024-06-01 15:45:16', 1),
(16, 1, 8, '2024-06-01 15:45:36', 1),
(17, 1, 8, '2024-06-01 15:45:59', 1),
(25, 26, 8, '2024-06-05 10:39:15', 1),
(26, 27, 8, '2024-06-05 10:57:26', 1),
(27, 28, 8, '2024-06-05 14:28:22', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `adres_id` (`adres_id`,`customer_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `order_table`
--
ALTER TABLE `order_table`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `order_table`
--
ALTER TABLE `order_table`
  ADD CONSTRAINT `order_table_ibfk_1` FOREIGN KEY (`adres_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_table_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
