<?php

class QueryHelper {

    public static function createRead($tableName, $primaryKeys, $columns, $whereClause) {
        $select = "";

        if ($columns != NULL) {
            $columnCount = count($columns);
            for ($i = 0; $i < $columnCount; $i++) {
                $select .= $columns[$i];
                if ($i != $columnCount - 1) {
                    $select = $select . " , ";
                }
            }
        } else {
            $select = " * ";
        }

        $query = "SELECT " . $select . " FROM " . $tableName;

        if ($whereClause != NULL) {
            $query .= " WHERE " . $whereClause;
        }

        if ($primaryKeys == NULL) {
            return $query;
        }

        $size = count($primaryKeys);
        if ($size == 0) {
            return $query;
        }

        if ($whereClause == null) {
            $query .= " WHERE ";
        } else {
            $query .= " AND ";
        }

        for ($i = 0; $i < $size; $i++) {
            $col = $primaryKeys[$i];
            $query .= $col->dbName . " = " . $col->getQueryValue();
            if ($i != $size - 1) {
                $query .= " AND ";
            }
        }
        return $query;
    }

    public static function createDelete($tableName, $primaryKeys) {
        $query = "DELETE FROM " . $tableName;
        $size = count($primaryKeys);
        if ($size == 0)
            return $query;
        $query .= ' WHERE ';
        for ($i = 0; $i < $size; $i++) {
            $col = $primaryKeys[$i];
            $query .= $col->dbName . ' = ' . $col->getQueryValue();
            if ($i != $size - 1) {
                $query .= ' AND ';
            }
        }
        return $query;
    }

    public static function createInsert($tableName, $columns) {
        $query = 'INSERT INTO ' . $tableName . ' (';
        $size = count($columns);

        for ($i = 0; $i < $size; $i++) {
            $col = $columns[$i];
            if (!$col->isAutoInc) {
                $query .= $col->dbName;
                if ($i != $size - 1) {
                    $query .= ', ';
                }
            }
        }
        $query .= ') VALUES (';
        for ($i = 0; $i < $size; $i++) {
            $col = $columns[$i];
            if (!$col->isAutoInc) {
                $query .= $col->getQueryValue();
                if ($i != $size - 1) {
                    $query .= ', ';
                }
            }
        }
        $query .= ')';

        return $query;
    }

    public static function createUpdate($tableName, $columns) {
        $query = 'UPDATE ' . $tableName . ' SET ';
        $size = count($columns);

        $where = ' WHERE ';
        $andNeeded = FALSE;
        for ($i = 0; $i < $size; $i++) {
            $col = $columns[$i];
            if ($col->isPK) {
                if ($andNeeded) {
                    $where .= ' AND ' . $col->dbName . ' = ' . $col->getQueryValue();
                } else {
                    $where .= $col->dbName . ' = ' . $col->getQueryValue();
                    $andNeeded = TRUE;
                }
            } else {
                $query .= $col->dbName . ' = ' . $col->getQueryValue();
                if ($i != $size - 1) {
                    $query .= ', ';
                }
            }
        }

        return $query . $where;
    }

    public static function createCount($tableName, $where) {
        $query = "SELECT COUNT(*) FROM  $tableName ";

        if ($where != NULL) {
            $query .= " WHERE " . $where;
        }
        return $query;
    }

    public static function createPaging($tableName, $pageNo, $pageSize , $where, $withLimit) {
        $query =  "SELECT * FROM $tableName ";        
        if (!empty($where)) {
            $query .= " WHERE " . $where;
        }
        if ($withLimit){
            $query.= " LIMIT $pageNo,$pageSize";   
        }            
        return $query; 
    }

    public static function createProcedure($procedureName) {
        return "call " . $procedureName;
    }

}

?>
