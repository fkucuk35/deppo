--
-- Veritabanı: `deppo_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `deppo_personel_list`
--

CREATE TABLE `deppo_personel_list` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
-- Tablo için tablo yapısı `deppo_users`
--

CREATE TABLE `deppo_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `deppo_users`
--

INSERT INTO `deppo_users` (`username`, `email`, `password`, `name`, `surname`, `active`, `user_type`) VALUES
('fkucuk4235', 'fatihkucuk@live.com', '$2y$10$8TPm05Cpny6kMzBv5JImJuRV/1/3Gapg1UP5vzc/26EV7vdGDAGXe', 'Fatih', 'Küçük', 'ü', 'admin');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `deppo_personel_list`
--
ALTER TABLE `deppo_personel_list`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `deppo_stock_card_list`
--
ALTER TABLE `deppo_stock_card_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

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
-- Tablo için AUTO_INCREMENT değeri `deppo_personel_list`
--
ALTER TABLE `deppo_personel_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_stock_card_list`
--
ALTER TABLE `deppo_stock_card_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Tablo için AUTO_INCREMENT değeri `deppo_users`
--
ALTER TABLE `deppo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
