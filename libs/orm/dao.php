<?php

require_once 'column.php';
require_once 'db_connection.php';
require_once 'query_helper.php';

class DAO {

    private $_tableName;
    private $_columns;
    private $_autoId;
    var $error;

    function __construct() {
        $this->_columns = array();
        $this->init();
    }

    protected function init() {
        
    }

    protected function setTableName($tableName) {
        $this->_tableName = $tableName;
    }

    private function getPrimaryKeys() {
        $primaryKeys = array();
        foreach ($this->_columns as $item) {
            if ($item->isPK) {
                $name = $item->name;
                $item->value = $this->$name;
                array_push($primaryKeys, $item);
            }
        }
        return $primaryKeys;
    }

    private function getColumns() {
        $columns = array();
        foreach ($this->_columns as $item) {
            $name = $item->name;
            $item->value = $this->$name;
            if (isset($item->value)) {
                array_push($columns, $item);
            }
        }
        return $columns;
    }

    protected function addColumn($name, $dbName, $type, $isPK, $isAutoInc) {
        $col = new Column($name, $dbName, $type, $isPK, $isAutoInc);
        $this->_columns[$dbName] = $col;
        if ($isAutoInc) {
            $this->_autoId = $name;
        }
    }

    function read() {
        $query = QueryHelper::createRead($this->_tableName, $this->getPrimaryKeys(), NULL, NULL);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);

        while ($row = mysqli_fetch_array($result)) {
            foreach ($row as $key => $value) {
                if (array_key_exists($key, $this->_columns)) {
                    $col = $this->_columns[$key];
                    $name = $col->name;
                    $this->$name = $value;
                }
            }
        }
    }

    function readWithWhere($whereClause) {
        $query = QueryHelper::createRead($this->_tableName, NULL, NULL, $whereClause);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);

        while ($row = mysqli_fetch_array($result)) {
            foreach ($row as $key => $value) {
                if (array_key_exists($key, $this->_columns)) {
                    $col = $this->_columns[$key];
                    $name = $col->name;
                    $this->$name = $value;
                }
            }
        }
    }

    function delete() {
        $query = QueryHelper::createDelete($this->_tableName, $this->getPrimaryKeys());
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        $this->error = $mysqli->error;
        return $result;
    }

    function deleteAll() {
        $query = QueryHelper::createDelete($this->_tableName, NULL);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        $this->error = $mysqli->error;
        return $result;
    }

    static function deleteMultiRow($tableName, $where) {
        $mysqli = DBConnection::createConnection();
        $query = "Delete from " . $tableName;
        if (isset($where)) {
            $query = $query . " WHERE  " . $where;
        }
        $mysqli->query($query);
    }

    function insert() {
        $mysqli = DBConnection::createConnection();
        $query = QueryHelper::createInsert($this->_tableName, $this->getColumns());
//        echo 'Queruy: ' .  $query;
        $result = $mysqli->query($query);
        $this->error = $mysqli->error;

        if ($mysqli->insert_id > 0) {
            $name = $this->_autoId;
            $this->$name = $mysqli->insert_id;
        }

        return $result;
    }

    function update() {
        $query = QueryHelper::createUpdate($this->_tableName, $this->getColumns());
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        $this->error = $mysqli->error;
        return $result;
    }

    static function count($tableName, $where) {
        $query = QueryHelper::createCount($tableName, $where);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }

    static function getPaging($tableName, $pageNo, $pageSize, $where, $withLimit=TRUE) {
        $result = array();
        $result["total"] = self::count($tableName, $where);
        $query = QueryHelper::createPaging($tableName, $pageNo, $pageSize, $where, $withLimit);
        $mysqli = DBConnection::createConnection();
        $rs = $mysqli->query($query);
        $items = array();
        while ($row = mysqli_fetch_object($rs)) {
            array_push($items, $row);
        }
        $result["rows"] = $items;
        return $result;
    }

    function isExist() {
        $columns = array();
        array_push($columns, "COUNT(*)");
        $query = QueryHelper::createRead($this->_tableName, $this->getPrimaryKeys(), $columns, NULL);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        if ($result == false) {
            $exists = false;
        } else {
            if ($mysqli->affected_rows > 0) {
                $row = mysqli_fetch_row($result);
                $exists = ($row[0] > 0);
            }
        }
        return $exists;
    }

    function save() {
        if ($this->isExist()) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    function readAll($columns, $where) {
        $query = QueryHelper::createRead($this->_tableName, NULL, $columns, $where);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        $data = array();

        if ($result == FALSE) {
            return $data;
        }

        while ($row = mysqli_fetch_array($result)) {
            $ins = new static;
            foreach ($row as $key => $value) {
                if (array_key_exists($key, $this->_columns)) {
                    $col = $this->_columns[$key];
                    $name = $col->name;
                    $ins->$name = $value;
                }
            }
            array_push($data, $ins);
        }

        return $data;
    }

    static function readAllArray($view_name, $columns, $where) {
        $query = QueryHelper::createRead($view_name, NULL, $columns, $where);
//        echo 'Query : ' . $query . '<br>';
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

    static function execProcedure($procedure_name) {
        $query = QueryHelper::createProcedure($procedure_name);
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        if ($result == FALSE) {
            return FALSE;
        }

        $rows = array();
        if (!is_bool($result)) {
            while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            }
        }
        return $rows;
    }

    static function getScalar($query) {
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        if ($result == FALSE) {
            return FALSE;
        }
        while ($r = mysqli_fetch_assoc($result)) {
            return $r["id"];
        }
        return null;
    }

    static function execute($query) {
        $mysqli = DBConnection::createConnection();
        $result = $mysqli->query($query);
        return $result;
    }

}

?>
