<?php
session_start();
if(isset($_SESSION['logged_in']))
{	
	$user="";
	session_destroy();
}

header("location: login.php");

?>
