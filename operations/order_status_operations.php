<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/order_status.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
    case 0: // new insert
        $item = new OrderStatus();
        $item->name = $_REQUEST['name'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new OrderStatus();
        $item->id = intval($_REQUEST['id']);
        $item->name = $_REQUEST['name'];
        $result = $item->update();
        break;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new OrderStatus();
        $item->id = $id;
        $result = $item->delete();
        break;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $where = NULL;
        $result = OrderStatus::getPaging(OrderStatus::table_name, $offset, $rows, $where, FALSE, ' ORDER BY name ASC');
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new OrderStatus();
        $result = $inst->readAll($columns, $where);

        echo json_encode($result);
        exit;
    case 5:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new OrderStatus();
        $res = $inst->readAll($columns, $where);
        $result = array(array("error" => null, "id" => "0", "name" => "Tüm Siparişler"));
        foreach($res as $r){
            array_push($result, array("error" => $r->error, "id" => $r->id, "name" =>  $r->name));
        }
        echo json_encode($result);
        exit;
}

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => $item->error));
}
?>
