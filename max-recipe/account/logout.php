<?php
	error_reporting(1);
	include '../includes/settings.php';
	session_start();
	$_SESSION = array();
	session_destroy();
	header("location:".ACCOUNT_BASEURL);
	exit();
?>