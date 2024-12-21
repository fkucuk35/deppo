<?php

include '../dao/settings.php';
include '../config_db.php';
include '../libs/orm/dao.php';
include '../dao/user.php';

if (!isset($_SESSION)) {
    session_start();
}

$op = intval($_REQUEST["op"]);
$email = (isset($_REQUEST["email"])) ? $_REQUEST["email"] : NULL;
$password = (isset($_REQUEST["password"])) ? $_REQUEST["password"] : NULL;
switch ($op) {
    case 0: //Login
        $item = new User();
        $r = $item->checkLogin($email, $password);
        $result['success'] = ($r !== null);
        $result['msg'] = $item->error;
        if($result['success']){
            $_SESSION["logined"] = true;
        }
        echo json_encode($result);
        break;
    case 1:  // Logout
        echo json_encode(array('success' => true, 'msg' => NULL));
        exit;
    /*   case 2: // delete
      $id = intval($_REQUEST['id']);
      $item = new Personel();
      $item->id = $id;
      $result = $item->delete();
      break;

      case 3: //get list
      $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
      $pageSize = isset($_POST['rows']) ? intval($_POST['rows']) : 20;
      $pageNo = ($page - 1) * $pageSize;
      $where = NULL;
      $result = Personel::getPaging(Personel::table_name, $pageNo, $pageSize, $where);
      echo json_encode($result);
      exit;
      case 4:// get all list for combobox
      $columns = array("id", "name");
      $where = null;
      $inst = new Personel();
      $result = $inst->readAll($columns, $where);

      echo json_encode($result);
      exit; */
}
