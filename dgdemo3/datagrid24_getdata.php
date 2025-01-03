<?php
	include 'conn.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$code = isset($_POST['code']) ? mysqli_real_escape_string($_POST['code']) : '';
	$name = isset($_POST['name']) ? mysqli_real_escape_string($_POST['name']) : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = "code like '%$code%' and name like '%$name%'";
	$rs = mysqli_query($conn, "select count(*) from deppo_stock_card_list where " . $where);
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysqli_query($conn, "select * from deppo_stock_card_list where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>