
--
-- Veritabanı: `deppo_db`
--

-- --------------------------------------------------------
--
-- Görünüm için görünüm yapısı `deppo_order_list_view`
--

CREATE VIEW `deppo_order_list_view`
AS SELECT `do`.*, `dsl`.`name` `supplier_name`
FROM `deppo_order` `do`
LEFT JOIN `deppo_supplier_list` `dsl` ON `do`.`supplier_id`=`dsl`.`id`;

-- --------------------------------------------------------
--
-- Görünüm için görünüm yapısı `deppo_order_detail_list_view`
--

CREATE VIEW deppo_order_detail_list_view AS
SELECT od.*, scl.code, scl.name FROM deppo_order_detail od
LEFT JOIN deppo_stock_card_list scl ON od.stock_id=scl.id;
