<?php

require_once($GLOBALS['FULL_ROOT'] . "libs/orm/dao.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/query_helper.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/data_type.php");

class OrderDetail extends DAO {

    const table_name = "deppo_order_detail";
    const col_id = "id";
    const col_order_id = "order_id";
    const col_stock_id = "stock_id";
    const col_ordered_quantity = "ordered_quantity";
    const col_received_quantity = "received_quantity";
    const col_description = "description";

    var $id, $order_id, $stock_id, $ordered_quantity, $received_quantity, $description;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("order_id", self::col_order_id, DataType::Integer, FALSE, FALSE);
        $this->addColumn("stock_id", self::col_stock_id, DataType::Integer, FALSE, FALSE);
        $this->addColumn("ordered_quantity", self::col_ordered_quantity, DataType::Integer, FALSE, FALSE);
        $this->addColumn("received_quantity", self::col_received_quantity, DataType::Integer, FALSE, FALSE);
        $this->addColumn("description", self::col_description, DataType::String, FALSE, FALSE);
    }
}
