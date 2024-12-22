<?php

require_once("../libs/orm/dao.php");
require_once("../libs/orm/query_helper.php");
require_once("../libs/orm/data_type.php");

class Supplier extends DAO
{

    const table_name = "deppo_supplier_list";
    const col_id = "id";
    const col_name = "name";
    const col_address = "address";
    const col_tax_office = "tax_office";
    const col_tax_number = "tax_number";
    const col_bill_address = "bill_address";

    var $id, $name, $address, $tax_office, $tax_number, $bill_address;

    protected function init()
    {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
        $this->addColumn("address", self::col_address, DataType::String, FALSE, FALSE);
        $this->addColumn("tax_office", self::col_tax_office, DataType::Date, FALSE, FALSE);
        $this->addColumn("tax_number", self::col_tax_number, DataType::String, FALSE, FALSE);
        $this->addColumn("bill_address", self::col_bill_address, DataType::String, FALSE, FALSE);
    }
}
