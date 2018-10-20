<?php
include_once 'header.php';
if(isset($_SESSION["logged_in"])){
		
}else {
	header("location: login.php");
}
include_once 'footer.php';
?>