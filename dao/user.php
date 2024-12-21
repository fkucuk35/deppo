<?php

require_once ( "../libs/orm/dao.php");
require_once ( "../libs/orm/query_helper.php");
require_once ( "../libs/orm/data_type.php");

class User extends DAO {

    const table_name = "deppo_users";
    const col_id = "id";
    const col_username = "username";
    const col_email = "email";
    const col_password = "password";
    const col_name = "name";
    const col_image_url = "image_url";
    const col_active = "active";

    var $id, $username, $email, $password, $name, $surname, $image_url, $active;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("username", self::col_username, DataType::String, FALSE, FALSE);
        $this->addColumn("email", self::col_email, DataType::String, FALSE, FALSE);
        $this->addColumn("password", self::col_password, DataType::String, FALSE, FALSE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
        $this->addColumn("image_url", self::col_image_url, DataType::String, FALSE, FALSE);
        $this->addColumn("active", self::col_active, DataType::String, FALSE, FALSE);
    }

    static function checkLogin($email, $password) {
        $where = User::col_email . " = '" . $email . "' AND " . User::col_password . " = '" . md5($password) . "' AND " . User::col_active . " = 'ü'";
        $user = new User();
        $result = $user->readAll(null, $where);
        if (count($result) != 0) {
            return $result[0];
        }
        return NULL;
    }
}

?>
