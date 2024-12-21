<?php

require_once ( "../libs/orm/dao.php");
require_once ( "../libs/orm/query_helper.php");
require_once ( "../libs/orm/data_type.php");

class Personel extends DAO {

    const table_name = "deppo_personel_list";
    const col_id = "id";
    const col_name = "name";
    const col_surname = "surname";
    const col_image_url = "image_url";
    const col_active = "active";

    var $id, $name, $surname, $image_url, $active;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
        $this->addColumn("surname", self::col_surname, DataType::String, FALSE, FALSE);
        $this->addColumn("image_url", self::col_image_url, DataType::String, FALSE, FALSE);
        $this->addColumn("active", self::col_active, DataType::String, FALSE, FALSE);
    }
}

?>
