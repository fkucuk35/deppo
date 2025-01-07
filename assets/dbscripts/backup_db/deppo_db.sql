-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Oca 2025, 15:01:41
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `deppo_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_logs`
--

CREATE TABLE `deppo_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `operation` varchar(50) NOT NULL,
  `operation_detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `deppo_logs`
--

INSERT INTO `deppo_logs` (`id`, `user_id`, `created_at`, `operation`, `operation_detail`) VALUES
(1, 3, '2025-01-07 16:36:13', 'login', 'Kullanıcı girişi yapıldı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_order`
--

CREATE TABLE `deppo_order` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_order`
--

INSERT INTO `deppo_order` (`id`, `supplier_id`, `number`, `date`, `description`) VALUES
(1, 1, 'SIP-2025-000001', '2025-01-03 22:04:06', '03/01/2025 SİPARİŞ LİSTESİ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_order_detail`
--

CREATE TABLE `deppo_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `ordered_quantity` smallint(5) UNSIGNED NOT NULL,
  `received_quantity` smallint(5) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_order_detail`
--

INSERT INTO `deppo_order_detail` (`id`, `order_id`, `stock_id`, `ordered_quantity`, `received_quantity`, `description`) VALUES
(1, 1, 41, 240, 240, ''),
(2, 1, 46, 4000, 0, '5/16 İnce Pul gönderilmiş yanlışlıkla'),
(3, 1, 39, 20, 0, ''),
(4, 1, 40, 10, 10, ''),
(5, 1, 38, 1000, 400, 'Faturada 815 olarak gözükmesine rağmen 400 adet gelmiş. Eksik gönderilmiş.'),
(6, 1, 44, 20, 20, ''),
(7, 1, 45, 20, 20, ''),
(8, 1, 37, 1600, 1600, ''),
(9, 1, 43, 1600, 1600, ''),
(10, 1, 36, 5000, 5000, ''),
(11, 1, 1, 2000, 2000, ''),
(12, 1, 42, 24, 24, '');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `deppo_order_detail_list_view`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `deppo_order_detail_list_view` (
`id` int(11)
,`order_id` int(11)
,`stock_id` int(11)
,`ordered_quantity` smallint(5) unsigned
,`received_quantity` smallint(5)
,`description` varchar(255)
,`code` varchar(50)
,`name` varchar(100)
);

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `deppo_order_list_view`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `deppo_order_list_view` (
`id` int(11)
,`supplier_id` int(11)
,`number` varchar(20)
,`date` datetime
,`description` text
,`supplier_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_personel_list`
--

CREATE TABLE `deppo_personel_list` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `deppo_personel_list`
--

INSERT INTO `deppo_personel_list` (`id`, `name`, `image_url`, `active`) VALUES
(1, 'Fatih KÜÇÜK', 'FATIH-KUCUK.jpg', 'ü'),
(2, 'Seren AYDOĞDU', '', 'ü'),
(3, 'Ercan BOYRAZ', '', 'ü');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_receipt_types`
--

CREATE TABLE `deppo_receipt_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_receipt_types`
--

INSERT INTO `deppo_receipt_types` (`id`, `name`) VALUES
(1, 'Alım Fişi'),
(2, 'Sarf Fişi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_stock_card_list`
--

CREATE TABLE `deppo_stock_card_list` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `deppo_stock_card_list`
--

INSERT INTO `deppo_stock_card_list` (`id`, `code`, `name`, `quantity`, `image_url`, `active`) VALUES
(1, 'M8X16BB', 'Metrik 8x16 Bombebaş Civata', 0, 'M8X15BB.jpg', 'ü'),
(2, 'M8X20BB', 'Metrik 8x20 Bombebaş Civata', 0, 'M8X20BB.jpg', 'ü'),
(3, 'M8X25BB', 'Metrik 8x25 Bombebaş Civata', 0, 'M8X25BB.jpg', 'ü'),
(4, 'M8X30BB', 'Metrik 8X30 Bombebaş Civata', 0, 'M8X30BB.jpg', 'ü'),
(5, 'M8X35BB', 'Metrik 8X35 Bombebaş Civata', 0, 'M8X35BB.jpg', 'ü'),
(6, 'M8X40BB', 'Metrik 8X40 Bombebaş Civata', 0, 'M8X40BB.jpg', 'ü'),
(7, 'M8X45BB', 'Metrik 8X45 Bombebaş Civata', 0, 'M8X45BB.jpg', 'ü'),
(8, 'M8X50BB', 'Metrik 8X50 Bombebaş Civata', 0, 'M8X50BB.jpg', 'ü'),
(9, 'M8X60BB', 'Metrik 8X60 Bombebaş Civata', 0, 'M8X60BB.jpg', 'ü'),
(10, 'M8X80BB', 'Metrik 8X80 Bombebaş Civata', 0, 'M8X80BB.jpg', 'ü'),
(11, 'M6X12BB', 'Metrik 6x12 Bombebaş Civata', 0, '', 'ü'),
(13, 'M8X15IB', 'Metrik 8x15 Imbus Baş Civata', 0, '', 'ü'),
(14, 'M8X20IB', 'Metrik 8X20 Imbus Baş Civata', 0, '', 'ü'),
(15, 'M8X25IB', 'Metrik 8X25 Imbus Baş Civata', 0, '', 'ü'),
(16, 'M8X30IB', 'Metrik 8X30 Imbus Baş Civata', 0, '', 'ü'),
(17, 'M8X35IB', 'Metrik 8X35 Imbus Baş Civata', 0, '', 'ü'),
(18, 'M8X40IB', 'Metrik 8X40 Imbus Baş Civata', 0, '', 'ü'),
(19, 'M8X45IB', 'Metrik 8X45 Imbus Baş Civata', 0, '', 'ü'),
(20, 'M8X50IB', 'Metrik 8X50 Imbus Baş Civata', 0, '', 'ü'),
(21, 'M8X60IB', 'Metrik 8X60 Imbus Baş Civata', 0, '', 'ü'),
(22, 'M8X70IB', 'Metrik 8X70 Imbus Baş Civata', 0, '', 'ü'),
(23, 'M8X80IB', 'Metrik 8X80 Imbus Baş Civata', 0, '', 'ü'),
(24, 'M8X90IB', 'Metrik 8X90 Imbus Baş Civata', 0, '', 'ü'),
(25, 'M8X100IB', 'Metrik 8X100 Imbus Baş Civata', 0, '', 'ü'),
(26, 'M8X110IB', 'Metrik 8X110 Imbus Baş Civata', 0, '', 'ü'),
(27, 'M8X120IB', 'Metrik 8X120 Imbus Baş Civata', 0, '', 'ü'),
(28, 'M8X130IB', 'Metrik 8X130 Imbus Baş Civata', 0, '', 'ü'),
(29, 'M8X140IB', 'Metrik 8X140 Imbus Baş Civata', 0, '', 'ü'),
(30, 'M8X150IB', 'Metrik 8X150 Imbus Baş Civata', 0, '', 'ü'),
(31, 'M8X160IB', 'Metrik 8X160 Imbus Baş Civata', 0, '', 'ü'),
(32, 'M8X170IB', 'Metrik 8X170 Imbus Baş Civata', 0, '', 'ü'),
(33, 'M8X180IB', 'Metrik 8X180 Imbus Baş Civata', 0, '', 'ü'),
(34, 'M8X190IB', 'Metrik 8X190 Imbus Baş Civata', 0, '', 'ü'),
(35, 'M8X200IB', 'Metrik 8X200 Imbus Baş Civata', 0, '', 'ü'),
(36, 'M8FS', 'Metrik 8 Fiberli Somun', 0, '', 'ü'),
(37, 'M5FS', 'Metrik 5 Fiberli Somun', 0, '', 'ü'),
(38, 'M10FS', 'M10 Fiberli Somun', 0, '', 'ü'),
(39, '7016SRB', '7016 Sprey Rütuş Boyası', 0, '', 'ü'),
(40, 'EB', 'Elektrikçi Bantı', 0, '', 'ü'),
(41, '40KUMFLAP', '40 Kum Flap', 0, '', 'ü'),
(42, 'SE', 'Siyah Eldiven', 0, '', 'ü'),
(43, 'M5X10YHB', 'Metrik 5x10 Yıldız Havşabaşlı Civata', 0, '', 'ü'),
(44, 'M10TIJ', 'M10 Tij', 0, '', 'ü'),
(45, 'M12TIJ', 'M12 Tij', 0, '', 'ü'),
(46, '516KP', '5/16 Kalın Pul', 0, '', 'ü'),
(47, '150.03.0302.00263', 'H:100CM TEKLI DUZ KAYDIRAK YESIL (ROTAMEGA)', 0, '', 'ü');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_supplier_list`
--

CREATE TABLE `deppo_supplier_list` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `tax_office` varchar(100) NOT NULL,
  `tax_number` varchar(20) NOT NULL,
  `bill_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_supplier_list`
--

INSERT INTO `deppo_supplier_list` (`id`, `name`, `address`, `tax_office`, `tax_number`, `bill_address`) VALUES
(1, 'MER TEKNİK', '1082 SOKAK NO: 9/F YENİŞEHİR KONAK/İZMİR', 'EGE', '6180664606', '1082 SOKAK NO: 9/F YENİŞEHİR KONAK/İZMİR'),
(2, 'ROTO MEGA', 'ANKARA ORTİM', 'ANKARA', '1111111', 'ANKARA ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_users`
--

CREATE TABLE `deppo_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `email_activation_key` varchar(150) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_users`
--

INSERT INTO `deppo_users` (`id`, `username`, `email`, `password`, `name`, `image_url`, `active`, `date_added`, `email_activation_key`, `user_type`) VALUES
(1, 'depo', 'depo@yapisanpark.com', 'e10adc3949ba59abbe56e057f20f883e', 'Depo Sorumlusu', '', 'ü', '2024-12-23 14:09:43', '', 'admin'),
(2, 'satinalma', 'satinalma@yapisanpark.com', 'e10adc3949ba59abbe56e057f20f883e', 'Seren AYDOĞDU', '', 'ü', '2024-12-23 14:24:25', '', 'admin'),
(3, 'fatih.kucuk', 'fatihkucuk@live.com', '3c308e560d3fb3508b166bca45c3cb93', 'Fatih KÜÇÜK', 'FATIH-KUCUK.jpg', 'ü', '2024-12-23 15:26:25', '', 'admin');

-- --------------------------------------------------------

--
-- Görünüm yapısı `deppo_order_detail_list_view`
--
DROP TABLE IF EXISTS `deppo_order_detail_list_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `deppo_order_detail_list_view`  AS SELECT `od`.`id` AS `id`, `od`.`order_id` AS `order_id`, `od`.`stock_id` AS `stock_id`, `od`.`ordered_quantity` AS `ordered_quantity`, `od`.`received_quantity` AS `received_quantity`, `od`.`description` AS `description`, `scl`.`code` AS `code`, `scl`.`name` AS `name` FROM (`deppo_order_detail` `od` left join `deppo_stock_card_list` `scl` on(`od`.`stock_id` = `scl`.`id`)) ;

-- --------------------------------------------------------

--
-- Görünüm yapısı `deppo_order_list_view`
--
DROP TABLE IF EXISTS `deppo_order_list_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `deppo_order_list_view`  AS SELECT `do`.`id` AS `id`, `do`.`supplier_id` AS `supplier_id`, `do`.`number` AS `number`, `do`.`date` AS `date`, `do`.`description` AS `description`, `dsl`.`name` AS `supplier_name` FROM (`deppo_order` `do` left join `deppo_supplier_list` `dsl` on(`do`.`supplier_id` = `dsl`.`id`)) ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `deppo_logs`
--
ALTER TABLE `deppo_logs`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_order`
--
ALTER TABLE `deppo_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Tablo için indeksler `deppo_order_detail`
--
ALTER TABLE `deppo_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_personel_list`
--
ALTER TABLE `deppo_personel_list`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_receipt_types`
--
ALTER TABLE `deppo_receipt_types`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_stock_card_list`
--
ALTER TABLE `deppo_stock_card_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Tablo için indeksler `deppo_supplier_list`
--
ALTER TABLE `deppo_supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_users`
--
ALTER TABLE `deppo_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `deppo_logs`
--
ALTER TABLE `deppo_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_order`
--
ALTER TABLE `deppo_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_order_detail`
--
ALTER TABLE `deppo_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_personel_list`
--
ALTER TABLE `deppo_personel_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_receipt_types`
--
ALTER TABLE `deppo_receipt_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_stock_card_list`
--
ALTER TABLE `deppo_stock_card_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_supplier_list`
--
ALTER TABLE `deppo_supplier_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_users`
--
ALTER TABLE `deppo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
