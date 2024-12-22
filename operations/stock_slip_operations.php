<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/stock_slip.php';
include '../dao/stock_slip_view.php';

$op = intval($_REQUEST["op"]);
switch ($op) {
	case 0: // new insert
        $item = new Stock_Slip();
        $item->slip_datetime = $_REQUEST['slip_datetime'];
	$item->slip_code = $_REQUEST['slip_code'];
	$item->slip_type_id = $_REQUEST['slip_type_id'];
//      $item->slip_detail_id = $_REQUEST['slip_detail_id'];
        $item->slip_detail_id = NULL;
	$item->personel_id = $_REQUEST['personel_id'];
	$item->slip_comment = $_REQUEST['slip_comment'];
//	$item->slip_attachment = $_REQUEST['slip_attachment'];
        $item->slip_attachment = NULL;
        $result = $item->insert();
        break;
    case 1:  // update
        $item = new Stock_Slip();
        $item->id = intval($_REQUEST['id']);
	$item->slip_type_id = $_REQUEST['slip_type_id'];
        $item->slip_datetime = $_REQUEST['slip_datetime'];
	$item->slip_code = $_REQUEST['slip_code'];
	$item->personel_id = $_REQUEST['personel_id'];
	$item->slip_comment = $_REQUEST['slip_comment'];
	$item->slip_attachment = $_REQUEST['slip_attachment'];
        $result = $item->update();
	break;
	case 2: // delete
        $id = intval($_REQUEST['id']);
        $item = new Stock_Slip();
        $item->id = $id;
        $result = $item->delete();
        break;
		
    case 3: //get list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $pageNo = ($page - 1) * $pageSize;
        $where = NULL;
        $result = Stock_Slip::getPaging(Stock_Slip::table_name, $pageNo, $pageSize, $where);
        echo json_encode($result);
        exit;
		
    case 4: //get view list
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
        $pageNo = ($page - 1) * $pageSize;
        $where = NULL;
        $result = Stock_Slip_View::getPaging(Stock_Slip_View::table_name, $pageNo, $pageSize, $where);
        echo json_encode($result);
        exit;
}

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('msg' => $item->error));
}
?>
