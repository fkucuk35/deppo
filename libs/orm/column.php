<?php

require_once 'data_type.php';

class Column {

    var $name;
    var $dbName;
    var $isPK;
    var $isAutoInc;
    var $type;
    var $value;

    function __construct($name, $fieldName, $type, $isPK, $isAutoInc) {
        $this->name = $name;
        $this->dbName = $fieldName;
        $this->isAutoInc = $isAutoInc;
        $this->isPK = $isPK;
        $this->type = $type;
    }

    // returns the value in appropriate format
    function 
    getQueryValue() {
        switch ($this->type) {
            case DataType::String:
                return '\'' . $this->value . '\'';
                break;
            case DataType::Integer:                
                //TODO Jafar Save Null for integer
                //empty return null when 0
                //if (!isset($this->value) || empty($this->value)) {
                if (!isset($this->value)) {          
                    return "NULL";
                }  else {
                    if (empty($this->value))
                        return "''";
                    return $this->value;
                }                
                break;
            case DataType::Boolean:
                if ($this->value) {
                    return 1;
                } else {
                    return 0;
                }
                break;
            case DataType::Date:
                $v = $this->value;
                $date;
                if (is_array($v)) {
                    $date = $v["year"] . "-" . $v["mon"] . "-" . $v["mday"]
                            . " " . $v["hours"] . ":" . $v["minutes"] . ":" . $v["seconds"];
                } else {
                    if (strpos($v,':') !== false) {
                        $date = date('Y-m-d H:i:s', strtotime($v));
                    }  else {
                        $date = date('Y-m-d', strtotime($v));                    
                    }
                    
                }
                return "'" . $date . "'";
                break;
            case DataType::Float:                
                if (!isset($this->value) || empty($this->value)) {                 
                    return "NULL";
                }  else {
                    return $this->value;
                }
                break;
        }
    }

}

?>
