<?php

require_once ( $GLOBALS['FULL_ROOT']."libs/orm/dao.php");
require_once ( $GLOBALS['FULL_ROOT']."libs/orm/query_helper.php");
require_once ( $GLOBALS['FULL_ROOT']."libs/orm/data_type.php");

class Log extends DAO {

    const table_name = "deppo_logs";
    const col_id = "id";
    const col_user_id = "user_id";
    const col_created_at = "created_at";
    const col_operation = "operation";
    const col_operation_detail = "operation_detail";

    var $id, $user_id, $created_at, $operation, $operation_detail;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("user_id", self::col_user_id, DataType::Integer, FALSE, FALSE);
        $this->addColumn("created_at", self::col_created_at, DataType::Date, FALSE, FALSE);
        $this->addColumn("operation", self::col_operation, DataType::String, FALSE, FALSE);
        $this->addColumn("operation_detail", self::col_operation_detail, DataType::String, FALSE, FALSE);
    }
}

?>