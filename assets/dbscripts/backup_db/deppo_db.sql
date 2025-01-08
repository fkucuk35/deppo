-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Oca 2025, 11:13:37
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
(1, 3, '2025-01-07 16:36:13', 'login', 'Kullanıcı girişi yapıldı'),
(2, 3, '2025-01-07 17:38:44', 'login', 'Kullanıcı girişi yapıldı'),
(3, 3, '2025-01-08 08:44:02', 'login', 'Kullanıcı girişi yapıldı');

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
(1, 1, 'SIP-2025-000001', '2025-01-03 22:04:06', '03/01/2025 SİPARİŞ LİSTESİ'),
(2, 1, 'SIP-2025-000002', '2025-01-08 09:51:45', '07/01/2025 SİPARİŞ LİSTESİ');

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
(2, 1, 48, 4000, 4000, ''),
(3, 1, 39, 20, 0, ''),
(4, 1, 40, 10, 10, ''),
(5, 1, 38, 1000, 400, 'Faturada 815 olarak gözükmesine rağmen 400 adet gelmiş. Eksik gönderilmiş.'),
(6, 1, 44, 20, 20, ''),
(7, 1, 45, 20, 20, ''),
(8, 1, 37, 1600, 1600, ''),
(9, 1, 43, 1600, 1600, ''),
(10, 1, 36, 5000, 5000, ''),
(11, 1, 1, 2000, 2000, ''),
(12, 1, 42, 24, 24, ''),
(13, 2, 46, 2000, 2000, '');

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
(48, '516IP', '5/16 İnce Pul', 0, '', 'ü'),
(49, '150.01.0116.00292', '1150x1150 KARE PLATFORM PVC', 0, '', 'ü'),
(50, '150.01.0124.00001', '4 BASAMAKLI H:50CM PVC KAPLI MERDIVEN(MERIDA)', 0, '', 'ü'),
(51, '150.01.0124.00002', '5 BASAMAKLI H:100CM PVC KAPLI MERDIVEN (MERIDA)', 0, '', 'ü'),
(52, '150.01.0124.00003', '7 BASAMAKLI H:150CM PVC KAPLI MERDIVEN (MERIDA)', 0, '', 'ü'),
(53, '150.01.0124.00006', '60X70CM PVC KAPLI PLATFORM (MERIDA)', 0, '', 'ü'),
(54, '150.01.0124.00007', '60X90CM PVC KAPLI PLATFORM (MERIDA)', 0, '', 'ü'),
(55, '150.01.0124.00008', '60X100CM PVC KAPLI PLATFORM (MERIDA)', 0, '', 'ü'),
(56, '150.01.0124.00009', 'UCGEN PLATFORM PVC KAPLI (MERIDA)', 0, '', 'ü'),
(57, '150.01.0124.00010', '116X116CM PVC KAPLI KARE PLATFORM(MERIDA)', 0, '', 'ü'),
(58, '150.01.0124.00011', 'RAMPA PLATFORM PVC KAPLI(100X240CM)(MERIDA)', 0, '', 'ü'),
(59, '150.01.0124.00012', 'PLATFORM KÖPRÜ 2M PVC KAPLI', 0, '', 'ü'),
(60, '150.03.0301.00044', 'SARI SUMO SALINCAK SEPETI', 0, '', 'ü'),
(61, '150.03.0302.00001', 'H:150CM IKILI EGIMLI KAYDIRAK (SOLA) CEMER MODEL', 0, '', 'ü'),
(62, '150.03.0302.00002', 'H:100CM EGIMLI IKILI KAYDIRAK (SAGA)', 0, '', 'ü'),
(63, '150.03.0302.00003', 'H:100CM DALGALI KAYDIRAK ASILSAN', 0, '', 'ü'),
(64, '150.03.0302.00005', 'H:100CM IKILI DUZ KAYDIRAK (KOCAKPARK)', 0, '', 'ü'),
(65, '150.03.0302.00007', 'H:100CM DALGALI KAYDIRAK KAHVERENGI ASILSAN', 0, '', 'ü'),
(66, '150.03.0302.00009', 'H:150CM EGIMLI KAYDIRAK SARI (ISKONPARK)', 0, '', 'ü'),
(67, '150.03.0302.00010', 'H:150CM DALGALI KAYDIRAK (KOCAKPARK)', 0, '', 'ü'),
(68, '150.03.0302.00012', 'H:100CM IKILI DALGALI KAYDIRAK FIRMA?', 0, '', 'ü'),
(69, '150.03.0302.00015', 'SPIRAL KAYDIRAK GIRISI CEMER MODEL', 0, '', 'ü'),
(70, '150.03.0302.00016', 'MAYMUN TEKLI KAYDIRAK GIRISI', 0, '', 'ü'),
(71, '150.03.0302.00018', 'IKILI KAYDIRAK GIRISI YAPISAN MODEL', 0, '', 'ü'),
(72, '150.03.0302.00021', 'KIRPI TIRMANMA H:100CM CEMER MODELI', 0, '', 'ü'),
(73, '150.03.0302.00022', 'SPIRAL KAYDIRAK GIRISI KOCAK MODEL', 0, '', 'ü'),
(74, '150.03.0302.00033', 'ROBOT BACAK GIYDIRME', 0, '', 'ü'),
(75, '150.03.0302.00036', 'TOMRUK CATI', 0, '', 'ü'),
(76, '150.03.0302.00037', 'H:100CM PE TIRMANMA (ROTAMEGA)', 0, '', 'ü'),
(77, '150.03.0302.00045', 'KULAHLI CATI KOCAKPARK', 0, '', 'ü'),
(78, '150.03.0302.00046', 'TREN CATI YEKPARE', 0, '', 'ü'),
(79, '150.03.0302.00047', 'TREN CATI PARCALI', 0, '', 'ü'),
(80, '150.03.0302.00048', 'TREN CATI KEMERI', 0, '', 'ü'),
(81, '150.03.0302.00056', 'KOCAK KALE FIGURLU TEKLI KAYDIRAK GIRISI', 0, '', 'ü'),
(82, '150.03.0302.00059', 'YUNUS FIGURLU TEKLI KAYDIRAK GIRISI KOCAK', 0, '', 'ü'),
(83, '150.03.0302.00060', 'YUNUS FIGURLU PARCALI KAYDIRAK GIRISI KOCAK', 0, '', 'ü'),
(84, '150.03.0302.00061', 'CIT PANO ISKONPARK', 0, '', 'ü'),
(85, '150.03.0302.00064', 'ROBOT PANO SARI (KOCAK)', 0, '', 'ü'),
(86, '150.03.0302.00065', 'EBEVEYN-BEBEK SALINCAK SEPETI ROTAMEGA', 0, '', 'ü'),
(87, '150.03.0302.00067', 'AYI FIGURLU PANO KOCAK', 0, '', 'ü'),
(88, '150.03.0302.00068', 'KELEBEK FIGURLU PANO KOCAK', 0, '', 'ü'),
(89, '150.03.0302.00069', 'SINCAP FIGURLU PANO KOCAK', 0, '', 'ü'),
(90, '150.03.0302.00072', 'MANTAR BORU FIGURU KOCAK', 0, '', 'ü'),
(91, '150.03.0302.00073', 'FUZE BORU FIGURU (KOCAK)', 0, '', 'ü'),
(92, '150.03.0302.00085', 'ORMAN CATI MERIDA', 0, '', 'ü'),
(93, '150.03.0302.00104', 'TAHTEREVALLI OTURAGI FLANSLI (KOCAK)', 0, '', 'ü'),
(94, '150.03.0302.00106', 'SALINCAK SEPETI (KOCAK)', 0, '', 'ü'),
(95, '150.03.0302.00109', 'C. MODELI SALINCAK SEPETI', 0, '', 'ü'),
(96, '150.03.0302.00111', 'SALINCAK SEPETI - TAMPONSUZ (OZTEPE)', 0, '', 'ü'),
(97, '150.03.0302.00113', 'YETISKIN SALINCAK SEPETI', 0, '', 'ü'),
(98, '150.03.0302.00120', 'H:150CM SPIRAL KAYDIRAK (ROTAMEGA /45KG)', 0, '', 'ü'),
(99, '150.03.0302.00122', 'ORMAN CATI(KOCAKPARK)', 0, '', 'ü'),
(100, '150.03.0302.00129', 'H:150CM IKILI DUZ KAYDIRAK YESIL (KOCAK)', 0, '', 'ü'),
(101, '150.03.0302.00133', 'H:100CM PARCALI DUZ KAYDIRAK (SET)', 0, '', 'ü'),
(102, '150.03.0302.00136', 'EV PANO', 0, '', 'ü'),
(103, '150.03.0302.00137', 'TUP KAYDIRAK GIRIS PANOSU', 0, '', 'ü'),
(104, '150.03.0302.00138', 'TIK TAK PANO(ROTAMEGA)', 0, '', 'ü'),
(105, '150.03.0302.00139', 'BORU FIGURU - PALMIYE (ROTOMEGA)', 0, '', 'ü'),
(106, '150.03.0302.00140', 'H:150CM SPIRAL KAYDIRAK MERIDA 35KG', 0, '', 'ü'),
(107, '150.03.0302.00144', 'H:150CM DUZ KAYDIRAK (MERIDA-35KG)', 0, '', 'ü'),
(108, '150.03.0302.00149', 'KORKULUK - TIKTAK PANO UCLU (KOCAK)', 0, '', 'ü'),
(109, '150.03.0302.00151', 'PALMIYE FIGUR (KOCAK)', 0, '', 'ü'),
(110, '150.03.0302.00156', 'IKIZ BEBEK SALINCAK SEPETI', 0, '', 'ü'),
(111, '150.03.0302.00157', 'H:100CM DUZ KAYDIRAK YESIL (KYP-77)', 0, '', 'ü'),
(112, '150.03.0302.00160', 'H:100CM PE MERDIVEN KORKULUGU', 0, '', 'ü'),
(113, '150.03.0302.00165', 'BORU FIGURU-ROBOT KANAT (KOCAK)', 0, '', 'ü'),
(114, '150.03.0302.00172', 'CATI-ROBOT (KOCAK)', 0, '', 'ü'),
(115, '150.03.0302.00179', 'PANO-TREN KUCUK PANO (KOCAK)', 0, '', 'ü'),
(116, '150.03.0302.00180', 'PANO-KALE FIGURLU BUYUK (KOCAK)', 0, '', 'ü'),
(117, '150.03.0302.00181', 'PANO-KALE FIGURLU KUCUK (KOCAK)', 0, '', 'ü'),
(118, '150.03.0302.00183', 'PANO-SUR KALE (KOCAK)', 0, '', 'ü'),
(119, '150.03.0302.00184', 'PANO-SUR UZAY (ROTOMEGA)', 0, '', 'ü'),
(120, '150.03.0302.00186', 'PANO-TREN BÜYÜK PANO (KOCAK)', 0, '', 'ü'),
(121, '150.03.0302.00187', 'PANO-TUP KAYDIRAK GIRIS PANOSU YAPRAK FIGURLU SARI (KOCAK)', 0, '', 'ü'),
(122, '150.03.0302.00190', 'SALINCAK SEPETI-PE KULUCKA (ISKON)', 0, '', 'ü'),
(123, '150.03.0302.00197', 'BORU FIGURU-GULEN GUNES', 0, '', 'ü'),
(124, '150.03.0302.00199', 'SALINCAK SEPETI - ENGELSIZ (TAMPONSUZ) MOR', 0, '', 'ü'),
(125, '150.03.0302.00208', 'ISILTI ENGELSIZ SALINCAK SEPETI', 0, '', 'ü'),
(126, '150.03.0302.00209', '35 LIK TUP TURKUAZ (ROTAMEGA)', 0, '', 'ü'),
(127, '150.03.0302.00210', '35 LIK TUP KAHVERENGI (ROTAMEGA)', 0, '', 'ü'),
(128, '150.03.0302.00211', '35 LIK TUP GRI (ROTAMEGA)', 0, '', 'ü'),
(129, '150.03.0302.00212', '90 LIK TUP DIRSEK SARI (ROTOMEGA)', 0, '', 'ü'),
(130, '150.03.0302.00213', '90 LIK TUP DIRSEK KAHVERENGI (ROTOMEGA)', 0, '', 'ü'),
(131, '150.03.0302.00214', '80 LIK TUP TURKUAZ (ROTAMEGA)', 0, '', 'ü'),
(132, '150.03.0302.00215', '80 LIK TUP GRI (ROTAMEGA)', 0, '', 'ü'),
(133, '150.03.0302.00216', 'TUP CIKIS GRI (ROTAMEGA)', 0, '', 'ü'),
(134, '150.03.0302.00217', 'TUP CIKIS TURKUAZ (ROTAMEGA)', 0, '', 'ü'),
(135, '150.03.0302.00218', 'TUP CIKIS KAHVERENGI (ROTAMEGA)', 0, '', 'ü'),
(136, '150.03.0302.00219', '110 LUK TUP SARI (ROTAMEGA)', 0, '', 'ü'),
(137, '150.03.0302.00220', '110 LUK TUP TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(138, '150.03.0302.00221', 'EKO CATI AHTAPOT SARI (ROTAMEGA)', 0, '', 'ü'),
(139, '150.03.0302.00222', 'EKO CATI AHTAPOT MOR (ROTAMEGA)', 0, '', 'ü'),
(140, '150.03.0302.00223', 'EKO CATI AHTAPOT YESIL (ROTAMEGA)', 0, '', 'ü'),
(141, '150.03.0302.00239', 'PANO-TUP KAYDIRAK GIRIS PANOSU YAPRAK FIGURLU MOR (KOCAK)', 0, '', 'ü'),
(142, '150.03.0302.00240', 'PANO-TUP KAYDIRAK GIRIS PANOSU YAPRAK FIGURLU YESIL (KOCAK)', 0, '', 'ü'),
(143, '150.03.0302.00245', 'EV CATI SARI (KOCAK)', 0, '', 'ü'),
(144, '150.03.0302.00246', 'EV CATI YESIL (KOCAK)', 0, '', 'ü'),
(145, '150.03.0302.00247', 'EV CATI MOR (KOCAK)', 0, '', 'ü'),
(146, '150.03.0302.00248', 'EV CATI KIRMIZI (KOCAK)', 0, '', 'ü'),
(147, '150.03.0302.00253', 'H:150CM SPIRAL KAYDIRAK 60KG SARI (ROTAMEGA)', 0, '', 'ü'),
(148, '150.03.0302.00254', 'H:150CM SPIRAL KAYDIRAK 60KG YESIL (ROTAMEGA)', 0, '', 'ü'),
(149, '150.03.0302.00255', 'H:150CM SPIRAL KAYDIRAK 60KG MOR (ROTAMEGA)', 0, '', 'ü'),
(150, '150.03.0302.00256', 'H:150CM SPIRAL KAYDIRAK 60KG TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(151, '150.03.0302.00261', 'H:100CM TEKLI DUZ KAYDIRAK SARI (ROTAMEGA)', 0, '', 'ü'),
(152, '150.03.0302.00262', 'H:100CM TEKLI DUZ KAYDIRAK MOR (ROTAMEGA)', 0, '', 'ü'),
(153, '150.03.0302.00263', 'H:100CM TEKLI DUZ KAYDIRAK YESIL (ROTAMEGA)', 0, '', 'ü'),
(154, '150.03.0302.00264', 'H:100CM TEKLI DUZ KAYDIRAK TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(155, '150.03.0302.00265', 'H:100CM PE TIRMANMA SARI', 0, '', 'ü'),
(156, '150.03.0302.00266', 'H:100CM PE TIRMANMA YESIL', 0, '', 'ü'),
(157, '150.03.0302.00267', 'H:100CM PE TIRMANMA MOR', 0, '', 'ü'),
(158, '150.03.0302.00268', 'H:100CM PE TIRMANMA TURUNCU', 0, '', 'ü'),
(159, '150.03.0302.00269', 'H:100CM PE TIRMANMA MAVI', 0, '', 'ü'),
(160, '150.03.0302.00272', 'ORMAN BACAK GIYDIRME KAHVERENGI', 0, '', 'ü'),
(161, '150.03.0302.00273', 'ORMAN BACAK GIYDIRME MAVI', 0, '', 'ü'),
(162, '150.03.0302.00274', 'ROBOT SUR PANO SARI (KOCAK)', 0, '', 'ü'),
(163, '150.03.0302.00275', 'ROBOT PANO MOR (KOCAK)', 0, '', 'ü'),
(164, '150.03.0302.00279', 'SPIRAL KAYDIRAK GIRISI TURUNCU YAPISAN MODEL', 0, '', 'ü'),
(165, '150.03.0302.00280', 'SPIRAL KAYDIRAK GIRISI SARI YAPISAN MODEL', 0, '', 'ü'),
(166, '150.03.0302.00281', 'SPIRAL KAYDIRAK GIRISI YESIL YAPISAN MODEL', 0, '', 'ü'),
(167, '150.03.0302.00282', 'IKILI KAYDIRAK GIRISI SARI (KOCAK)', 0, '', 'ü'),
(168, '150.03.0302.00283', 'IKILI KAYDIRAK GIRISI YESIL (KOCAK)', 0, '', 'ü'),
(169, '150.03.0302.00284', 'IKILI KAYDIRAK GIRISI TURUNCU (KOCAK)', 0, '', 'ü'),
(170, '150.03.0302.00285', 'IKILI KAYDIRAK GIRISI MOR (KOCAK)', 0, '', 'ü'),
(171, '150.03.0302.00286', 'SPIRAL KAYDIRAK GIRISI 12KG SARI (ROTAMEGA)', 0, '', 'ü'),
(172, '150.03.0302.00287', 'SPIRAL KAYDIRAK GIRISI 12KG YESIL (ROTAMEGA)', 0, '', 'ü'),
(173, '150.03.0302.00288', 'SPIRAL KAYDIRAK GIRISI 12KG MOR (ROTAMEGA)', 0, '', 'ü'),
(174, '150.03.0302.00289', 'SPIRAL KAYDIRAK GIRISI 12KG KIRMIZI (ROTAMEGA)', 0, '', 'ü'),
(175, '150.03.0302.00290', 'SPIRAL KAYDIRAK GIRISI 12KG TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(176, '150.03.0302.00291', 'SPIRAL KAYDIRAK GIRISI 12KG MAVI (ROTAMEGA)', 0, '', 'ü'),
(177, '150.03.0302.00296', 'H:150CM DALGALI KAYDIRAK KAHVERENGI (KOCAKPARK)', 0, '', 'ü'),
(178, '150.03.0302.00297', 'H:150CM DALGALI KAYDIRAK SARI (KOCAKPARK)', 0, '', 'ü'),
(179, '150.03.0302.00298', 'H:150CM DALGALI KAYDIRAK YESIL (KOCAKPARK)', 0, '', 'ü'),
(180, '150.03.0302.00299', 'H:150CM DALGALI KAYDIRAK MOR (KOCAKPARK)', 0, '', 'ü'),
(181, '150.03.0302.00300', 'H:100CM SAGA EGIMLI KAYDIRAK SARI (KOCAK)', 0, '', 'ü'),
(182, '150.03.0302.00301', 'H:100CM SAGA EGIMLI KAYDIRAK YESIL (KOCAK)', 0, '', 'ü'),
(183, '150.03.0302.00302', 'H:100CM SAGA EGIMLI KAYDIRAK MOR (KOCAK)', 0, '', 'ü'),
(184, '150.03.0302.00305', 'H:100CM IKILI DUZ KAYDIRAK SARI (KOCAKPARK)', 0, '', 'ü'),
(185, '150.03.0302.00306', 'H:100CM IKILI DUZ KAYDIRAK YESIL (KOCAKPARK)', 0, '', 'ü'),
(186, '150.03.0302.00307', 'H:100CM IKILI DUZ KAYDIRAK MOR (KOCAKPARK)', 0, '', 'ü'),
(187, '150.03.0302.00308', 'H:100CM IKILI DUZ KAYDIRAK TURUNCU (KOCAKPARK)', 0, '', 'ü'),
(188, '150.03.0302.00309', 'H:100CM IKILI DUZ KAYDIRAK KIRMIZI (KOCAKPARK)', 0, '', 'ü'),
(189, '150.03.0302.00310', 'H:150CM EGIMLI KAYDIRAK SARI (IRMAK)', 0, '', 'ü'),
(190, '150.03.0302.00311', 'H:150CM EGIMLI KAYDIRAK YESIL (IRMAK)', 0, '', 'ü'),
(191, '150.03.0302.00312', 'H:150CM EGIMLI KAYDIRAK MOR (IRMAK)', 0, '', 'ü'),
(192, '150.03.0302.00316', 'H:150CM IKILI DUZ KAYDIRAK SARI (KOCAK)', 0, '', 'ü'),
(193, '150.03.0302.00317', 'H:150CM IKILI DUZ KAYDIRAK MOR (KOCAK)', 0, '', 'ü'),
(194, '150.03.0302.00326', 'H:150CM SPIRAL KAYDIRAK SARI (ROTAMEGA /45KG)', 0, '', 'ü'),
(195, '150.03.0302.00327', 'H:150CM SPIRAL KAYDIRAK YESIL (ROTAMEGA /45KG)', 0, '', 'ü'),
(196, '150.03.0302.00328', 'H:150CM SPIRAL KAYDIRAK MOR (ROTAMEGA /45KG)', 0, '', 'ü'),
(197, '150.03.0302.00334', 'SALINCAK SEPETI - TAMPONSUZ SARI (OZTEPE)', 0, '', 'ü'),
(198, '150.03.0302.00335', 'SALINCAK SEPETI - TAMPONSUZ TURUNCU (OZTEPE)', 0, '', 'ü'),
(199, '150.03.0302.00341', 'ROBOT SUR PANO MOR (KOCAK)', 0, '', 'ü'),
(200, '150.03.0302.00342', 'DONER TAHTEREVALLI OTURAGI ALTI GRI YAPISAN', 0, '', 'ü'),
(201, '150.03.0302.00343', 'DONER TAHTEREVALLI OTURAGI ALTI SIYAH YAPISAN', 0, '', 'ü'),
(202, '150.03.0302.00344', 'DONER TAHTEREVALLI OTURAGI YESIL YAPISAN', 0, '', 'ü'),
(203, '150.03.0302.00345', 'DONER TAHTEREVALLI OTURAGI TURUNCU YAPISAN', 0, '', 'ü'),
(204, '150.03.0302.00346', '1,2,3 TEKLI KAYDIRAK GIRISI SARI (YAPISAN)', 0, '', 'ü'),
(205, '150.03.0302.00347', '1,2,3 TEKLI KAYDIRAK GIRISI YESIL (YAPISAN)', 0, '', 'ü'),
(206, '150.03.0302.00348', '1,2,3 TEKLI KAYDIRAK GIRISI MOR (YAPISAN)', 0, '', 'ü'),
(207, '150.03.0302.00349', '1,2,3 TEKLI KAYDIRAK GIRISI TURUNCU (YAPISAN)', 0, '', 'ü'),
(208, '150.03.0302.00350', 'H:100CM DALGALI KAYDIRAK SARI ASILSAN', 0, '', 'ü'),
(209, '150.03.0302.00351', 'H:100CM DALGALI KAYDIRAK YESIL ASILSAN', 0, '', 'ü'),
(210, '150.03.0302.00352', 'H:100CM DALGALI KAYDIRAK MOR ASILSAN', 0, '', 'ü'),
(211, '150.03.0302.00354', 'PANO-TUP KAYDIRAK GIRIS PANOSU NOTA FIGURLU KAHVERENGI (KOCAK)', 0, '', 'ü'),
(212, '150.03.0302.00358', 'EKO CATI AHTAPOT SARI (MERIDA)', 0, '', 'ü'),
(213, '150.03.0302.00359', 'EKO CATI AHTAPOT YESIL (MERIDA)', 0, '', 'ü'),
(214, '150.03.0302.00363', 'TUP PANO MOR (MERIDA)', 0, '', 'ü'),
(215, '150.03.0302.00364', 'TUP PANO YESIL (MERIDA)', 0, '', 'ü'),
(216, '150.03.0302.00365', 'TUP PANO SARI (MERIDA)', 0, '', 'ü'),
(217, '150.03.0302.00366', 'TUP PANO KAHVERENGI (MERIDA)', 0, '', 'ü'),
(218, '150.03.0302.00367', 'TUP PANO TURUNCU (MERIDA)', 0, '', 'ü'),
(219, '150.03.0302.00368', '35 LIK TUP YESIL (MERIDA)', 0, '', 'ü'),
(220, '150.03.0302.00369', '35 LIK TUP SARI (MERIDA)', 0, '', 'ü'),
(221, '150.03.0302.00370', '35 LIK TUP KAHVERENGI (MERIDA)', 0, '', 'ü'),
(222, '150.03.0302.00374', '40 LIK TUP SARI (MERIDA)', 0, '', 'ü'),
(223, '150.03.0302.00375', '40 LIK TUP YESIL (MERIDA)', 0, '', 'ü'),
(224, '150.03.0302.00376', '40 LIK TUP MOR (MERIDA)', 0, '', 'ü'),
(225, '150.03.0302.00377', '40 LIK TUP KAHVERENGI (MERIDA)', 0, '', 'ü'),
(226, '150.03.0302.00378', '90 LIK TUP DIRSEK KAHVERENGI (MERIDA)', 0, '', 'ü'),
(227, '150.03.0302.00379', '90 LIK TUP DIRSEK YESIL (MERIDA)', 0, '', 'ü'),
(228, '150.03.0302.00380', 'TUP CIKIS SARI (MERIDA)', 0, '', 'ü'),
(229, '150.03.0302.00381', 'TUP CIKIS YESIL (MERIDA)', 0, '', 'ü'),
(230, '150.03.0302.00382', 'TUP CIKIS KAHVERENGI (MERIDA)', 0, '', 'ü'),
(231, '150.03.0302.00383', 'AGAC DESENLI KAYDIRAK GIRISI (MERIDA)', 0, '', 'ü'),
(232, '150.03.0302.00384', 'H:100CM DUZ KAYDIRAK MOR (KYP-77)', 0, '', 'ü'),
(233, '150.03.0302.00385', 'TOMBUL DUNYA KAYDIRAK GIRISI SARI (KOCAK)', 0, '', 'ü'),
(234, '150.03.0302.00386', 'TOMBUL DUNYA KAYDIRAK GIRISI TURUNCU (KOCAK)', 0, '', 'ü'),
(235, '150.03.0302.00387', 'EKO CATI AHTAPOT TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(236, '150.03.0302.00388', '80 LIK TUP SARI (ROTAMEGA)', 0, '', 'ü'),
(237, '150.03.0302.00390', 'TAHTEREVALLI OTURAGI-SISIRME (MERIDA)', 0, '', 'ü'),
(238, '150.03.0302.00391', '90 LIK TUP DIRSEK YESIL (ROTAMEGA)', 0, '', 'ü'),
(239, '150.03.0302.00398', 'TUP CIKIS TURUNCU (ROTAMEGA)', 0, '', 'ü'),
(240, '150.03.0302.00399', 'TUP CIKIS MOR (MERIDA)', 0, '', 'ü'),
(241, '150.03.0302.00405', 'H:100 SAG EGIK KAYDIRAK (MERIDA)', 0, '', 'ü'),
(242, '150.03.0302.00406', 'H:100 SOL EGIK KAYDIRAK (MERIDA)', 0, '', 'ü'),
(243, '150.03.0302.00409', '35 LIK DUZ TUP YESIL (KOCAKPARK)', 0, '', 'ü'),
(244, '150.03.0302.00410', '35 LIK DESENLI TUP YESIL (KOCAKPARK)', 0, '', 'ü'),
(245, '150.03.0302.00413', 'TUP CIKIS TURKUAZ (KOCAKPARK)', 0, '', 'ü'),
(246, '150.03.0302.00415', 'TUP CIKIS KIRMIZI (ROTAMEGA)', 0, '', 'ü'),
(247, '150.03.0302.00416', 'H:100CM DUZ KAYDIRAK (MERIDA)', 0, '', 'ü'),
(248, '150.03.0302.00421', 'SEMERLI TAHTEREVALLI OTURAGI (ROTAMEGA 89MM)', 0, '', 'ü'),
(249, '150.03.0302.00423', 'PANO-SUR UZAY (CEMER)', 0, '', 'ü'),
(250, '150.03.0302.00425', 'H:150CM S KAYDIRAK (KOCAK)', 0, '', 'ü'),
(251, '150.03.0302.00427', 'EKO CATI AHTAPOT MAVI (MERIDA)', 0, '', 'ü'),
(252, '150.03.0302.00428', 'H:100CM IKILI KAYDIRAK DUZ KIRMIZI(MERIDA)', 0, '', 'ü'),
(253, '150.03.0302.00429', 'TUP CIKIS TURKUAZ (MERIDA)', 0, '', 'ü'),
(254, '150.03.0303.00002', 'YETISKIN SALINCAK SEPETI KAUCUK (SIMAT)', 0, '', 'ü'),
(255, '150.03.0303.00004', 'OTURAK-TAHTEREVALLI ARMUT 6MM (HAS)', 0, '', 'ü'),
(256, '150.04.0404.00004', 'YETISKIN SALINCAK SEPETI KAUCUK (HASANKARA)', 0, '', 'ü'),
(257, '150.04.0404.00018', 'SALINCAK SEPETI-KAUCUK SUMO TURKUAZ', 0, '', 'ü'),
(258, '150.04.0404.00019', 'SALINCAK SEPETI-KAUCUK SUMO SIYAH', 0, '', 'ü'),
(259, '150.05.0521.00001', '40*40*2,5CM KARO KAUCUK(YESIL)', 0, '', 'ü'),
(260, '150.05.0521.00002', '40*40*2CM KARO KAUCUK(YESIL)', 0, '', 'ü'),
(261, '150.05.0521.00003', '40*40*3CM KARO KAUCUK(YESIL)', 0, '', 'ü'),
(262, '150.05.0521.00004', 'KAUCUK ZEMIN POLIURETAN YAPISTIRICI', 0, '', 'ü'),
(263, '150.05.0521.00013', 'KAUCUK ZEMIN HIZLANDIRICI', 0, '', 'ü'),
(264, '150.05.0521.00014', '40*40*2CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(265, '150.05.0521.00015', '40*40*2,5CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(266, '150.05.0521.00016', '40*40*3CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(267, '150.05.0521.00017', '50*50*2CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(268, '150.05.0521.00018', '50*50*2CM KARO KAUCUK(YESIL)', 0, '', 'ü'),
(269, '150.05.0521.00019', '50*50*2,5CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(270, '150.05.0521.00020', '50*50*2,5CM KARO KAUCUK(YESIL)', 0, '', 'ü'),
(271, '150.05.0521.00021', '50*50*3CM KARO KAUCUK(BORDO)', 0, '', 'ü'),
(272, '150.05.0521.00022', '50*50*3CM KARO KAUCUK(YESIL)', 0, '', 'ü');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_order`
--
ALTER TABLE `deppo_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_order_detail`
--
ALTER TABLE `deppo_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

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
