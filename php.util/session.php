<?php
	include_once 'restrict.php';
	//restrict();
	header('Content-Type: application/json');
	echo json_encode($_SESSION['user_logged']);
?>