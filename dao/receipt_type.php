<?php

require_once ( "../libs/orm/dao.php");
require_once ( "../libs/orm/query_helper.php");
require_once ( "../libs/orm/data_type.php");

class Receipt_Type extends DAO {

    const table_name = "deppo_receipt_types";
    const col_id = "id";
    const col_name = "name";
    
    var $id, $name;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
    }
}

?>
