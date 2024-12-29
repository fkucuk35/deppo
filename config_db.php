<?php

require_once 'libs/orm/db_connection.php';
include 'libs/variables.php';

switch($GLOBALS['HOST']){
	case 'local':
		$host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db = "deppo_db";
	break;
	case 'remote':
		$host = "sql.freedb.tech";
		$db_username = "freedb_deppo";
		$db_password = "u@WB23UJQqA&4hw";
		$db = "freedb_deppo_db";
	break;
	default: 
		$host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db = "deppo_db";
	break;
}



date_default_timezone_set('Europe/Istanbul');

DBConnection::setConnection($host, $db_username, $db_password, $db);
?>