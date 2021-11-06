<?php
	session_start();
	require_once 'require/database.php';

	$database = new Database();

	$database->login($_POST);

?>