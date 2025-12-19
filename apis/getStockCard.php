<?php
include 'dbconfig.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $result = $conn->query("SELECT * FROM deppo_stock_card_list WHERE code='$code'");
            $data = $result->fetch_assoc();
            echo json_encode($data);
        }
	else {
		echo json_encode(["message" => "Parameter not found!"]);
	}
	break;
    default:
        echo json_encode(["message" => "Invalid request method!"]);
        break;
}

$conn->close();
?>
