<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/order.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
    case 0: // new insert
        $item = new Order();
        $rows = $_REQUEST['rows'];
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
        $result["success"] = $item->insert();
        if ($result["success"]) {
            $result["saveDetail"] = $item->saveDetail($rows);
        }
        $result["msg"] = $item->error;
        echo json_encode($result);
        exit;
    case 1:  // update
        $rows = $_REQUEST['rows'];
        $deleted_details = json_decode($_REQUEST['deleted_details']);
        $item = new Order();
        $item->id = intval($_REQUEST['id']);
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
        $result["success"] = $item->update();
        if ($result["success"]) {
            $result["editDetail"] = $item->editDetail($rows, $deleted_details);
        }
        $result["msg"] = $item->error;
        echo json_encode($result);
        exit;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new Order();
        $item->id = $id;
        $result["success"] = $item->delete();
        if ($result["success"]) {
            $result["deleteDetail"] = $item->deleteAllDetail();
        }
        $result["msg"] = $item->error;
        echo json_encode($result);
        exit;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $where = NULL;
        $result = Order::getPaging(Order::table_name, $offset, $rows, $where, FALSE, ' ORDER BY number ASC');
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new Order();
        $result = $inst->readAll($columns, $where);
        echo json_encode($result);
        exit;
    /* case 5: // get detail        
      $item = new Order();
      $result = $item->getDetail($_REQUEST['id']);
      json_encode($result);
      exit; */
    case 8: //generate number automatically.                
        $new_order_number = Order::generateNumber($GLOBALS['ORDER_NUMBER_PREFIX']);
        echo json_encode(array('success' => true, 'orderNum' => $new_order_number));
        exit;
    case 9: // get detail        
        $item = new Order();
        $result = $item->getDetail($_REQUEST['id']);
        echo json_encode($result);
        exit;
}

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => $item->error));
}
?>
