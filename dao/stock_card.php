<?php

require_once("../libs/orm/dao.php");
require_once("../libs/orm/query_helper.php");
require_once("../libs/orm/data_type.php");

class Stock_Card extends DAO
{

    const table_name = "deppo_stock_card_list";
    const col_id = "id";
    const col_code = "code";
    const col_name = "name";
    const col_quantity = "quantity";
    const col_image_url = "image_url";
    const col_active = "active";

    var $id, $code, $name, $quantity, $image_url, $active;

    protected function init()
    {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("code", self::col_code, DataType::String, FALSE, FALSE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
        $this->addColumn("quantity", self::col_quantity, DataType::Integer, FALSE, FALSE);
        $this->addColumn("image_url", self::col_image_url, DataType::String, FALSE, FALSE);
        $this->addColumn("active", self::col_active, DataType::String, FALSE, FALSE);
    }
}
