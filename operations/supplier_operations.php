<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/supplier.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
    case 0: // new insert
        $item = new Supplier();
        $item->name = $_REQUEST['name'];
        $item->address = $_REQUEST['address'];
        $item->tax_office = $_REQUEST['tax_office'];
        $item->tax_number = $_REQUEST['tax_number'];
        $item->bill_address = $_REQUEST['bill_address'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new Supplier();
        $item->id = intval($_REQUEST['id']);
        $item->name = $_REQUEST['name'];
        $item->address = $_REQUEST['address'];
        $item->tax_office = $_REQUEST['tax_office'];
        $item->tax_number = $_REQUEST['tax_number'];
        $item->bill_address = $_REQUEST['bill_address'];
        $result = $item->update();
        break;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new Order();
        $item->id = $id;
        $result = $item->delete();
        break;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $where = NULL;
        $result = Supplier::getPaging(Supplier::table_name, $offset, $rows, $where, FALSE, ' ORDER BY name ASC');
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new Supplier();
        $result = $inst->readAll($columns, $where);

        echo json_encode($result);
        exit;
}

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => $item->error));
}
?>
