<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$conn = mysqli_connect('127.0.0.1','root','');
	mysqli_select_db($conn, 'deppo_db');
	
	$rs = mysqli_query($conn, "select count(*) from deppo_stock_card_list");
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysqli_query($conn, "select * from deppo_stock_card_list limit $offset,$rows");
	
	$rows = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>