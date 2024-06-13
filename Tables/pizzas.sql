-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 13 Haz 2024, 13:30:28
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
-- Tablo için tablo yapısı `pizzas`
--

CREATE TABLE `pizzas` (
  `pizza_id` int(50) NOT NULL,
  `pizza_name` varchar(100) NOT NULL,
  `pizza_description` varchar(550) NOT NULL,
  `pizza_price` double NOT NULL,
  `pizza_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `pizzas`
--

INSERT INTO `pizzas` (`pizza_id`, `pizza_name`, `pizza_description`, `pizza_price`, `pizza_image`) VALUES
(1, 'Margherita', 'Classic pizza with tomato sauce, fresh mozzarella, fresh basil, salt, and olive oil.', 123, 'pizza1.jpg'),
(2, 'Four Cheese', 'A blend of mozzarella, parmesan, gorgonzola, and fontina cheeses.', 456, 'pizza2.jpg'),
(3, 'Hawaiian', 'Tomato sauce, mozzarella cheese, ham, and pineapple.', 111, 'pizza3.jpg'),
(4, 'BBQ Chicken', 'Barbecue sauce, grilled chicken, red onions, mozzarella, and cilantro.', 200, 'pizza4.jpg'),
(5, 'Pepperoni', 'Tomato sauce, mozzarella cheese, and pepperoni slices.', 123, 'pizza1.jpg'),
(6, 'Vegetarian', 'Tomato sauce, mozzarella, and a variety of vegetables such as bell peppers, onions, mushrooms, olives, and tomatoes.', 190, 'pizza2.jpg'),
(7, 'Meat Lover\'s', 'Tomato sauce, mozzarella, pepperoni, sausage, bacon, ham, and sometimes ground beef.', 420, 'pizza3.jpg'),
(8, 'Buffalo Chicken', 'Buffalo sauce, grilled chicken, mozzarella, and sometimes blue cheese or ranch dressing.', 100, 'pizza4.jpg'),
(9, 'Mushroom', 'Tomato sauce, mozzarella, and various types of mushrooms, often with a touch of garlic and herbs.', 150, 'pizza1.jpg'),
(10, 'Sicilian', 'Thick, square crust with tomato sauce, mozzarella, and often anchovies, onions, and herbs.', 140, 'pizza2.jpg'),
(11, 'Supreme', 'Tomato sauce, mozzarella, pepperoni, sausage, bell peppers, onions, mushrooms, and olives.', 199, 'pizza3.jpg'),
(13, 'White Pizza', 'Thick, square crust with tomato sauce, mozzarella, and often anchovies, onions, and herbs.', 210, 'pizza4.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`pizza_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `pizza_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
