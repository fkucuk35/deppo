<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
//initialize our api
include_once('core/initialize.php');
//instantiate stock card
$stock_card = new Stock_Card($db);
$stock_card ->code = isset($_GET["code"]) ? $_GET["code"] : die();
$stock_card ->getStockCard();
$stock_arr = array(
    'id'    => $stock_card ->id,
    'code'    => $stock_card ->code,
    'name'    => $stock_card ->name,
    'quantity'    => $stock_card ->quantity,
    'image_url'    => $stock_card ->image_url,
    'active'    => $stock_card ->active
);

//make a json
print_r(json_encode($stock_arr));
?>