<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/receipt_type.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
	    case 0: // new insert
        $item = new Receipt_Type();
        $item->name = $_REQUEST['name'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new Receipt_Type();
        $item->id = intval($_REQUEST['id']);
        $item->name = $_REQUEST['name'];
        $result = $item->update();
        break;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new Receipt_Type();
        $item->id = $id;
        $result = $item->delete();
        break;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $pageNo = ($page - 1) * $pageSize;
        $where = NULL;
        $result = Receipt_Type::getPaging(Receipt_Type::table_name, $pageNo, $pageSize, $where, TRUE, NULL);
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new Receipt_Type();
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
