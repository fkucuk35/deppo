<?php

//include 'db_connection.php';
//include './action_type.php';

class Log {

    const ACTION_INSERT = 0;
    const ACTION_DELETE = 1;
    const ACTION_UPDATE = 2;
    
    const TYPE_ERROR = 0;
    const TYPE_WARNING = 1;
    const TYPE_INFO = 2;

    static function d($type, $user, $section, $action, $message) {
        $mysqli = DBConnection::createConnection();
        $query = "INSERT into log (log_type,user,date,section,action,message) VALUES("
                . $type . "," . $user . ",'" . date('Y-m-d H:i:s') . "','" . $section . "'," . $action . ",'" . $message . "')";
        $result = $mysqli->query($query);
    }

}

?>
