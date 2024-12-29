-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `deppo_order_detail_list`
--

CREATE TABLE `deppo_order_detail_list` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `ordered_quantity` smallint(5) UNSIGNED NOT NULL,
  `received_quantity` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `description` varchar(255) NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `deppo_order_list`
--

CREATE TABLE `deppo_order_list` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------
--
-- Tablo döküm verisi `deppo_personel_list`
--

INSERT INTO `deppo_order_list` (`id`, `supplier_id`, `number`, `description`) VALUES
(1, 1, 'SIP-2024-0001', 'Deneme Açıklama');

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

-- --------------------------------------------------------
--
-- Tablo döküm verisi `deppo_personel_list`
--

INSERT INTO `deppo_personel_list` (`id`, `name`, `image_url`, `active`) VALUES
(1, 'Fatih KÜÇÜK', 'FATIH-KUCUK.jpg', 'ü');

-- --------------------------------------------------------
--
-- Tablo için tablo yapısı `deppo_receipt_types`
--

CREATE TABLE `deppo_receipt_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------
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

-- --------------------------------------------------------
--
-- Tablo döküm verisi `deppo_stock_card_list`
--

INSERT INTO `deppo_stock_card_list` (`id`, `code`, `name`, `quantity`, `image_url`, `active`) VALUES
(1, 'M8X15BB', 'Metrik 8x15 Bombebaş Civata', 0, 'M8X15BB.jpg', 'ü'),
(2, 'M8X20BB', 'Metrik 8x20 Bombebaş Civata', 0, 'M8X20BB.jpg', 'ü');

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

-- --------------------------------------------------------
--
-- Tablo döküm verisi `deppo_supplier_list`
--

INSERT INTO `deppo_supplier_list` (`id`, `name`, `address`, `tax_office`, `tax_number`, `bill_address`) VALUES
(1, 'MER TEKNİK', '1082 SOKAK NO: 9/F YENİŞEHİR KONAK/İZMİR', 'EGE', '6180664606', '1082 SOKAK NO: 9/F YENİŞEHİR KONAK/İZMİR');

--
-- Veritabanı: `deppo_db` (23.12.2024)
--

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
`email_activation_key` varchar(150) NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- --------------------------------------------------------
--
-- Tablo döküm verisi `deppo_users`
--

INSERT INTO `deppo_users` (`id`, `username`, `email`, `password`, `name`, `image_url`, `active`, `date_added`, `user_type`) VALUES
(1, 'depo', 'depo@yapisanpark.com', 'e10adc3949ba59abbe56e057f20f883e', 'Depo Sorumlusu', '', 'ü', '2024-12-23 14:09:43', 'admin'),
(2, 'satinalma', 'satinalma@yapisanpark.com', 'e10adc3949ba59abbe56e057f20f883e', 'Seren AYDOĞDU', '', 'ü', '2024-12-23 14:24:25', 'admin'),
(3, 'fatih.kucuk', 'fatihkucuk@live.com', '3c308e560d3fb3508b166bca45c3cb93', 'Fatih KÜÇÜK', 'FATIH-KUCUK.jpg', 'ü', '2024-12-23 15:26:25', 'admin');

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
