<?php

$conn = new mysqli("localhost", "root", "admin.1234", "deppo_db");
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
?>