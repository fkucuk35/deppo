<?php

require_once("../libs/orm/dao.php");
require_once("../libs/orm/query_helper.php");
require_once("../libs/orm/data_type.php");

class OrderView extends DAO
{

    const table_name = "deppo_order_list_view";
    const col_id = "id";
    const col_supplier_id = "supplier_id";
    const col_number = "number";
    const col_date = "date";
    const col_description = "description";
    const col_supplier_name = "supplier_name";

    var $id, $supplier_id, $name, $date, $description, $supplier_name;

    protected function init()
    {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("supplier_id", self::col_supplier_id, DataType::Integer, FALSE, FALSE);
        $this->addColumn("number", self::col_number, DataType::String, FALSE, FALSE);
        $this->addColumn("date", self::col_date, DataType::Date, FALSE, FALSE);
        $this->addColumn("description", self::col_description, DataType::String, FALSE, FALSE);
        $this->addColumn("supplier_name", self::col_supplier_name, DataType::String, FALSE, FALSE);
    }
}
