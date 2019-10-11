<?php
	session_start();
	setcookie("user", "user", time() + 3600, '/');
	if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit(); }
?>