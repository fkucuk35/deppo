
--
-- Veritabanı: `deppo_db`
--

-- --------------------------------------------------------
--
-- Görünüm için görünüm yapısı `deppo_order_list_view`
--

CREATE VIEW `deppo_order_list_view`
AS SELECT `dol`.*, `dsl`.`name` `supplier_name`
FROM `deppo_order_list` `dol`
LEFT JOIN `deppo_supplier_list` `dsl` ON `dol`.`supplier_id`=`dsl`.`id`;

-- --------------------------------------------------------
--
-- Görünüm için görünüm yapısı `deppo_order_detail_list_view`
--

CREATE VIEW deppo_order_detail_list_view AS
SELECT odl.*, scl.code, scl.name FROM deppo_order_detail_list odl
LEFT JOIN deppo_stock_card_list scl ON scl.id = odl.stock_id;
