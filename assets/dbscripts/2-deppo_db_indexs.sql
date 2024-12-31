
--
-- Veritabanı: `deppo_db` (23.12.2024)
--

-- --------------------------------------------------------
--
-- Dökümü yapılmış tablolar için indeksler
--

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_order_detail`
--

ALTER TABLE `deppo_order_detail`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_order`
--

ALTER TABLE `deppo_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_personel_list`
--

ALTER TABLE `deppo_personel_list`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_receipt_types`
--

ALTER TABLE `deppo_receipt_types`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_stock_card_list`
--

ALTER TABLE `deppo_stock_card_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_supplier_list`
--

ALTER TABLE `deppo_supplier_list`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
--
-- Tablo için indeksler `deppo_users`
--

ALTER TABLE `deppo_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

-- --------------------------------------------------------
--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_order_detail`
--

ALTER TABLE `deppo_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_order`
--

ALTER TABLE `deppo_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_personel_list`
--

ALTER TABLE `deppo_personel_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_receipt_types`
--

ALTER TABLE `deppo_receipt_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_stock_card_list`
--
ALTER TABLE `deppo_stock_card_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_supplier_list`
--

ALTER TABLE `deppo_supplier_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_users`
--

ALTER TABLE `deppo_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için indeksler `deppo_logs`
--
ALTER TABLE `deppo_logs`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
--
-- Tablo için AUTO_INCREMENT değeri `deppo_logs`
--

ALTER TABLE `deppo_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;