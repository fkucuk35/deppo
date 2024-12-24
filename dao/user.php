<?php

require_once ( $GLOBALS['FULL_ROOT']."libs/orm/dao.php");
require_once ( $GLOBALS['FULL_ROOT']."libs/orm/query_helper.php");
require_once ( $GLOBALS['FULL_ROOT']."libs/orm/data_type.php");

class User extends DAO {

    const table_name = "deppo_users";
    const col_id = "id";
    const col_username = "username";
    const col_email = "email";
    const col_password = "password";
    const col_name = "name";
    const col_image_url = "image_url";
    const col_active = "active";
    const col_date_added = "date_added";
    const col_user_type = "user_type";

    var $id, $username, $email, $password, $name, $image_url, $active, $date_added, $user_type;

    protected function init() {
        $this->setTableName(self::table_name);

        $this->addColumn("id", self::col_id, DataType::Integer, TRUE, TRUE);
        $this->addColumn("username", self::col_username, DataType::String, FALSE, FALSE);
        $this->addColumn("email", self::col_email, DataType::String, FALSE, FALSE);
        $this->addColumn("password", self::col_password, DataType::String, FALSE, FALSE);
        $this->addColumn("name", self::col_name, DataType::String, FALSE, FALSE);
        $this->addColumn("image_url", self::col_image_url, DataType::String, FALSE, FALSE);
        $this->addColumn("active", self::col_active, DataType::String, FALSE, FALSE);
        $this->addColumn("date_added", self::col_date_added, DataType::Date, FALSE, FALSE);
        $this->addColumn("user_type", self::col_user_type, DataType::String, FALSE, FALSE);
    }

    static function checkLogin($username, $password) {
        $where = User::col_username . " = '" . $username . "' AND " . User::col_password . " = '" . md5($password) . "' AND " . User::col_active . " = 'ü'";
        $user = new User();
        $result = $user->readAll(null, $where);
        if (count($result) != 0) {
            return json_decode(json_encode($result[0]), true);
        }
        return NULL;
    }

    static function checkUsernameValid($username) {
        $where = User::col_username . " = '" . $username . "'";
        $user = new User();
        $result = $user->readAll(null, $where);
        if (count($result) != 0) {
            return json_decode(json_encode($result[0]), true);
        }
        return NULL;
    }

    static function checkEmailValid($email) {
        $where = User::col_email . " = '" . $email . "'";
        $user = new User();
        $result = $user->readAll(null, $where);
        if (count($result) != 0) {
            return json_decode(json_encode($result[0]), true);
        }
        return NULL;
    }
}

?>