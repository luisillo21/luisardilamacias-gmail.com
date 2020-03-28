<?php
	session_start();
	if(isset($_SESSION['_user']))
	{
		unset($_SESSION['_user']);
		unset($_SESSION['_rol']);
		unset($_SESSION['_system']);
	}
	session_destroy();
	header("location: ../index.php");
?>