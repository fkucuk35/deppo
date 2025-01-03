<?php

$conn = @mysqli_connect('127.0.0.1','root','');
if (!$conn) {
	die('Could not connect: ' . mysqli_error($conn));
}
mysqli_select_db($conn, 'deppo_db');

?>