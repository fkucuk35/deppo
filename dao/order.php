<?php

require_once($GLOBALS['FULL_ROOT'] . "libs/orm/dao.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/query_helper.php");
require_once($GLOBALS['FULL_ROOT'] . "libs/orm/data_type.php");
require_once($GLOBALS['FULL_ROOT'] . "dao/order_detail.php");

class Order extends DAO {

    const table_name = "deppo_order";
    const col_id = "id";
    const col_supplier_id = "supplier_id";
    const col_number = "number";
    const col_date = "date";
    const col_description = "description";

    var $id, $supplier_id, $number, $date, $description;
    var $detail;

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

    static function getDetail($id) {
        $inst = new OrderDetail();
        $where = OrderDetail::col_order_id . "=" . $id;
        $orderBy = " ORDER BY code ASC";
        return $inst->readAllArray('deppo_order_detail_list_view', null, $where, $orderBy);
    }

    function saveDetail($detail) {
        $rows = json_decode($detail);
        for ($i = 0; $i < count($rows); $i++) {
            $detail = new OrderDetail();

            $detail->order_id = $this->id;
            $detail->stock_id = intval($rows[$i]->stock_id);
            $detail->ordered_quantity = $rows[$i]->ordered_quantity;
            $detail->received_quantity = $rows[$i]->received_quantity;
            $detail->description = $rows[$i]->description;
            if (isset($rows[$i]->id)) {
                $detail->id = intval($rows[$i]->id);
                $detail->update();
            } else {
                $detail->insert();
            }
        }
    }

    function deleteAllDetail() {
        $where = OrderDetail::col_order_id . "=" . $this->id;
        DAO::deleteMultiRow(OrderDetail::table_name, $where);
    }

    function deleteSpecificDetail($deleted_details) {
        if (count($deleted_details) > 0) {
            foreach ($deleted_details as $deleted_detail) {
                $where = OrderDetail::col_order_id . "=" . $this->id . " AND " . OrderDetail::col_id . "=" . $deleted_detail;
                DAO::deleteMultiRow(OrderDetail::table_name, $where);
            }
        }
    }

    function editDetail($detail, $deleted_details) {
        $this->deleteSpecificDetail($deleted_details);
        $this->saveDetail($detail);
    }
}
