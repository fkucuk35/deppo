<?php

include '../dao/settings.php';
include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/stock_card.php';


$op = intval($_REQUEST["op"]);
switch ($op) {
	    case 0: // new insert
        $item = new Stock_Card();
        $item->code = $_REQUEST['code'];
        $item->name = $_REQUEST['name'];
        $item->image_url= "";//$_REQUEST['image_url'];
        $item->active= $_REQUEST['active_status'];
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new Stock_Card();
        $item->id = intval($_REQUEST['id']);
        $item->code = $_REQUEST['code'];
        $item->name = $_REQUEST['name'];
        $item->image_url= $_REQUEST['image_url'];
		$item->active = $_REQUEST['active_status'];
        $result = $item->update();
        break;
    case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new Stock_Card();
        $item->id = $id;
        $result = $item->delete();
        break;
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $pageNo = ($page - 1) * $pageSize;
        $where = NULL;
        $result = Stock_Card::getPaging(Stock_Card::table_name, $pageNo, $pageSize, $where);
        echo json_encode($result);
        exit;
    case 4:// get all list for combobox
        $columns = array("id", "name");
        $where = null;
        $inst = new Stock_Card();
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
