<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
	setcookie("user", "", time() - 3600);
// Redirecting To Home Page
header("Location: login.php");
}
?>