<?php

class DataType {

    const String = 0;
    const Integer = 1;
    const Boolean = 2;
    const Date = 3;
    const Float = 4;

    static function convertDBDate($tempDate) {
        $date = date('Y-m-d', strtotime($tempDate));
        //$date = date_create_from_format('Y-m-d:H:i:s', $tempDate);
        return "'" . $date . "'";
    }

    static function convertDBDateEnd($tempDate) {
        $date = date('Y-m-d 23:59:59', strtotime($tempDate));
        //$date = date_create_from_format('Y-m-d:H:i:s', $tempDate);
        return "'" . $date . "'";
    }

}

?>
