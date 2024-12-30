<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/order.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
    case 0: // new insert
        $item = new Order();
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new Order();
        $item->id = intval($_REQUEST['id']);
        $item->supplier_id = $_REQUEST['supplier_id'];
        $item->number = $_REQUEST['number'];
        $item->description = $_REQUEST['description'];
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
        $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $pageNo = ($page - 1) * $pageSize;
        $where = NULL;
        $result = Order::getPaging(Order::table_name, $pageNo, $pageSize, $where);
        break;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new Order();
        $result = $inst->readAll($columns, $where);
        break;
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
        break;
}
echo json_encode($result);
?>
