<?php

class DBConnection {

    private static $host;
    private static $username;
    private static $password;
    private static $dbname;
    private static $port;

    static function setConnection($host, $username, $password, $dbname, $port) {
        self::$host = $host;
        self::$username = $username;
        self::$password = $password;
        self::$dbname = $dbname;
        self::$port = $port;
    }

    static function createConnection() {
        $mysqli = new mysqli(self::$host, self::$username, self::$password, self::$dbname, self::$port);
        $mysqli->query("SET NAMES 'utf8'  ");
        $mysqli->query("SET CHARACTER SET utf8");
        $mysqli->query("SET COLLATION_CONNECTION = 'utf8_turkish_ci' ");
        return $mysqli;
    }

    static function readAll($table_name, $where) {
        $query = "SELECT * FROM " . $table_name . " WHERE " . $where;
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);

        if ($result == FALSE) {
            return FALSE;
        }

        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }
}

?>
