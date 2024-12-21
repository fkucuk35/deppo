<?php
require_once 'libs/orm/db_connection.php';

switch($GLOBALS['HOST']){
	case 'local':
		$host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db = "deppo_db";
	break;
	case 'remote':
		$host = "sql206.epizy.com";
		$db_username = "epiz_32368278";
		$db_password = "Fk102428";
		$db = "epiz_32368278_deppo";
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