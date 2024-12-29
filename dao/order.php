<?php

require_once($GLOBALS['FULL_ROOT'] . "libs/orm/dao.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/query_helper.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/data_type.php");

class Order extends DAO {

    const table_name = "deppo_order_list";
    const col_id = "id";
    const col_supplier_id = "supplier_id";
    const col_number = "number";
    const col_date = "date";
    const col_description = "description";

    var $id, $supplier_id, $number, $date, $description;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("supplier_id", self::col_supplier_id, DataType::Integer, FALSE, FALSE);
        $this->addColumn("number", self::col_number, DataType::String, FALSE, FALSE);
        $this->addColumn("date", self::col_date, DataType::Date, FALSE, FALSE);
        $this->addColumn("description", self::col_description, DataType::String, FALSE, FALSE);
    }

    static function generateNumber($orderNumberPrefix) {
        $date = new DateTime();
        $count = DAO::count(Order::table_name, $where = NULL);
        $year = $date->format("Y");
        $result = "-" . $year . "-" . str_pad($count + 1, 6, '0', STR_PAD_LEFT);
        return $orderNumberPrefix . $result;
    }
}
