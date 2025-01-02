<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/order_list_view.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
    case 0: // new insert
        $item = new OrderListView();
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
        $item->supplier_name = $_REQUEST['supplier_name'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new OrderListView();
        $item->id = intval($_REQUEST['id']);
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
        $item->supplier_name = $_REQUEST['supplier_name'];
        $result = $item->update();
        break;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new OrderListView();
        $item->id = $id;
        $result = $item->delete();
        break;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $where = NULL;
        $result = OrderListView::getPaging(OrderListView::table_name, $offset, $rows, $where, TRUE, ' ORDER BY number ASC');
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new OrderListView();
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
