<?php
	if (isset($_REQUEST))
	{
		require_once 'require/database.php';
		$database = new Database();
		$database->login($_POST);
	}else{
		header("location:index.php?msg=Access Denied");
	}

?>