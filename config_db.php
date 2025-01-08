<?php

require_once 'libs/orm/db_connection.php';
include 'settings.php';

switch($GLOBALS['HOST']){
	case 'local':
		$host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db = "deppo_db";
                $port = 3306;
	break;
	case 'remote':
		$host = "zwopi.h.filess.io";
		$db_username = "deppodb_shoutdoor";
		$db_password = "71c8c041283df7cda1ebe333843203d7f9bba74e";
		$db = "deppodb_shoutdoor";
                $port = 3307;
	break;
	default: 
		$host = "localhost";
		$db_username = "root";
		$db_password = "";
		$db = "deppo_db";
                $port = 3306;
	break;
}



date_default_timezone_set('Europe/Istanbul');

DBConnection::setConnection($host, $db_username, $db_password, $db, $port);
?>