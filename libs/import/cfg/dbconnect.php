<?php

$conn = new mysqli("localhost", "root", "", "deppo_db");
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
?>