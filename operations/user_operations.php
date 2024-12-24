<?php

include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/user.php';
include '../dao/log.php';

$op = intval($_REQUEST["op"]);
$id = intval($_REQUEST["id"]);
$new_password = $_REQUEST["password"];
session_start();

switch ($op) {
    /*    case 0: // new insert
      $item = new Supplier();
      $item->name = $_REQUEST['name'];
      $item->address = $_REQUEST['address'];
      $item->tax_office = $_REQUEST['tax_office'];
      $item->tax_number = $_REQUEST['tax_number'];
      $item->bill_address = $_REQUEST['bill_address'];
      $result = $item->insert();
      break;
      case 1:  // update
      $item = new Supplier();
      $item->id = intval($_REQUEST['id']);
      $item->name = $_REQUEST['name'];
      $item->address = $_REQUEST['address'];
      $item->tax_office = $_REQUEST['tax_office'];
      $item->tax_number = $_REQUEST['tax_number'];
      $item->bill_address = $_REQUEST['bill_address'];
      $result = $item->update();
      break;
      case 2: // delete
      $id = intval($_REQUEST['id']);
      $item = new Order();
      $item->id = $id;
      $result = $item->delete();
      break;
      case 3: //get list
      $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
      $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
      $pageNo = ($page - 1) * $pageSize;
      $where = NULL;
      $result = Supplier::getPaging(Supplier::table_name, $pageNo, $pageSize, $where);
      echo json_encode($result);
      exit;
      case 4:// get all list for combobox
      $columns = array("id", "name");
      $where = null;
      $inst = new Supplier();
      $result = $inst->readAll($columns, $where);

      echo json_encode($result);
      exit; */
    case 5: //change password
        $user = new User();
        $where = User::col_id . " = " . $id;
        $item = $user->readAll(null, $where);
        $result = false;
        if (count($item) != 0) {
            $user = $item[0];
            $user->password = md5($new_password);
            $user->update();
            $result = true;
            $log = new Log();
            $log->user_id = $_SESSION['id'];
            $log->operation = "profile_update";
            $log->operation_detail = "Kullanıcı şifresi değiştirildi";
            $log->insert();
        }
}

if ($result) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'msg' => $item->error));
}
?>
